<?php

namespace App\Livewire\OrderJasa;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\ServiceOrder;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

#[Layout('layouts.app')]
#[Title('Edit Order Jasa')]
class UpdateOrderJasa extends Component
{
    use WithFileUploads;

    public ServiceOrder $order;


    public $customer_name  = '';
    public $customer_phone = '';
    public $customer_email = '';

    public $category_id       = '';
    public $order_title       = '';
    public $order_description = '';
    public $quantity          = 1;


    public $order_date                = '';
    public $estimated_completion_date = '';


    public $total_price  = 0;
    public $payment      = 0;
    public $down_payment = 0;


    public $design_file;
    public $existing_design_file = null;
    public $hapus_design_file    = false;
    public $notes  = '';
    public $status = 'pending';


    public $selectedCategoryInfo = null;

    public function mount($id)
    {
        $order = ServiceOrder::findOrFail($id);
        $this->order = $order;

        $this->customer_name             = $order->customer_name;
        $this->customer_phone            = $order->customer_phone;
        $this->customer_email            = $order->customer_email ?? '';
        $this->category_id               = (string) ($order->category_id ?? '');
        $this->order_title               = $order->order_title;
        $this->order_description         = $order->order_description;
        $this->quantity                  = $order->quantity;
        $this->order_date                = Carbon::parse($order->order_date)->format('Y-m-d');
        $this->estimated_completion_date = Carbon::parse($order->estimated_completion_date)->format('Y-m-d');
        $this->total_price               = (int) $order->total_price;
        $this->payment                   = (int) $order->payment;
        $this->down_payment              = (int) ($order->down_payment ?? 0);
        $this->notes                     = $order->notes ?? '';
        $this->status                    = $order->status;
        $this->existing_design_file      = $order->design_file;

        
    }


    #[Computed]
    public function kategori()
    {
        return ServiceCategory::orderBy('nama_jasa')->get();
    }
    private function generateInvoiceNumber()
    {
        $date    = now()->format('Ymd');
        $prefix  = 'INV-' . $date . '-';
    
        // Cari nomor urut terakhir hari ini berdasarkan prefix
        $last = Sale::where('invoice_number', 'like', $prefix . '%')
                    ->orderBy('id', 'desc')
                    ->first();
    
        $sequence = $last
            ? intval(substr($last->invoice_number, -4)) + 1
            : 1;
        
        $uniqueId = substr(uniqid(), -4);
        $sequence = $sequence . $uniqueId;
    
        return $prefix . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function save()
    {
        
        $this->validate([
            'customer_name'             => 'required|string|max:255',
            'customer_phone'            => 'required|string|max:20',
            'customer_email'            => 'nullable|email|max:255',
            'category_id'               => 'required|exists:service_categories,id',
            'order_title'               => 'required|string|max:255',
            'order_description'         => 'required|string',
            'quantity'                  => 'required|integer|min:1',

            'order_date'                => 'required|date',
            'estimated_completion_date' => 'required|date|after_or_equal:order_date',
            'total_price'               => 'required|integer|min:0',
            'payment'                   => 'required|integer|min:0',
            'down_payment'              => 'nullable|integer|min:0',
            'design_file'               => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar,ai,psd,cdr|max:10240',
            'notes'                     => 'nullable|string',
            'status'                    => 'required|in:pending,approved,rejected,in_progress,completed,cancelled',
        ], [
            'customer_name.required'             => 'Nama customer wajib diisi.',
            'customer_phone.required'            => 'Nomor telepon wajib diisi.',
            'customer_email.email'               => 'Format email tidak valid.',
            'category_id.required'               => 'Kategori jasa wajib dipilih.',
            'category_id.exists'                 => 'Kategori jasa tidak valid.',
            'order_title.required'               => 'Judul order wajib diisi.',
            'order_description.required'         => 'Deskripsi order wajib diisi.',
            'quantity.min'                       => 'Jumlah minimal 1.',
            'order_date.required'                => 'Tanggal order wajib diisi.',
            'estimated_completion_date.required' => 'Estimasi selesai wajib diisi.',
            'estimated_completion_date.after_or_equal' => 'Estimasi selesai tidak boleh sebelum tanggal order.',
            'total_price.required'               => 'Total harga wajib diisi.',
            'payment.required'                   => 'Jumlah pembayaran wajib diisi.',
            'design_file.mimes'                  => 'File harus berformat: pdf, jpg, jpeg, png, zip, rar, ai, psd, cdr.',
            'design_file.max'                    => 'Ukuran file maksimal 10MB.',
        ]);
        DB::beginTransaction();

        try {
            $designFilePath = $this->existing_design_file;

        //     // Hapus file lama jika dicentang
            if ($this->hapus_design_file && $this->existing_design_file) {
                Storage::disk('public')->delete($this->existing_design_file);
                $designFilePath = null;
            }

            // Upload file baru jika ada
            if ($this->design_file) {
                if ($designFilePath) {
                    Storage::disk('public')->delete($designFilePath);
                }
                $designFilePath = $this->design_file->store('service-orders', 'public');
            }
            
            // ── State saat ini ───────────────────────────────────────────────────
            $statusYangKurangiStok  = ['in_progress', 'completed'];
            $statusYangRollbackStok = ['cancelled', 'rejected'];
    
            $statusLama     = $this->order->status;
            $statusBaru     = $this->status;
            $sudahDikurangi = $this->order->stock_deducted;
            $sudahAdaSale   = ! is_null($this->order->sale_id);
    
            // ── Load kategori + produk BOM (dipakai di beberapa kondisi) ─────────
            $kategori = ServiceCategory::with('products')->find($this->category_id);
            $adaProdukBOM = $kategori && $kategori->products->isNotEmpty();
    
            // ════════════════════════════════════════════════════════════════════
            // KONDISI A: ROLLBACK STOK + HAPUS SALE
            // Terjadi ketika:
            // - Status baru = cancelled / rejected
            // - Status lama = in_progress / completed (stok sudah pernah dikurangi)
            // - stock_deducted = true (penanda stok memang sudah dikurangi)
            // ════════════════════════════════════════════════════════════════════
            $perluRollbackStok = in_array($statusBaru, $statusYangRollbackStok)
                && in_array($statusLama, $statusYangKurangiStok)
                && $sudahDikurangi;
    
            if ($perluRollbackStok && $adaProdukBOM) {
    
                // Kembalikan stok tiap produk
                foreach ($kategori->products as $product) {
                    $kebutuhan = $product->pivot->quantity * $this->quantity;
                    $product->increment('stok_tersedia', $kebutuhan);
                }
    
                // Hapus SaleItem dulu, baru Sale (jika ada)
                if ($sudahAdaSale) {
                    $sale = Sale::find($this->order->sale_id);
                    if ($sale) {
                        $sale->items()->delete(); // pastikan relasi items() ada di model Sale
                        $sale->delete();
                    }
                }
            }
    
            // ════════════════════════════════════════════════════════════════════
            // KONDISI B: KURANGI STOK + BUAT SALE
            // Terjadi ketika:
            // - Status baru = in_progress / completed
            // - Stok belum pernah dikurangi
            // - Status lama bukan in_progress/completed
            // ════════════════════════════════════════════════════════════════════
            $perluKurangiStok = in_array($statusBaru, $statusYangKurangiStok)
                && ! $sudahDikurangi
                && ! in_array($statusLama, $statusYangKurangiStok);
    
            $perluBuatSale = $perluKurangiStok && ! $sudahAdaSale;
            $saleId        = $sudahAdaSale ? $this->order->sale_id : null;
            $invoiceNumber = null;
    
            if ($perluKurangiStok && $adaProdukBOM) {
    
                // Validasi stok semua produk dulu
                foreach ($kategori->products as $product) {
                    $kebutuhan = $product->pivot->quantity * $this->quantity;
    
                    if ($product->stok_tersedia < $kebutuhan) {
                        DB::rollBack();
                        session()->flash('error',
                            "Stok produk \"{$product->nama_produk}\" tidak mencukupi! " .
                            "Dibutuhkan: {$kebutuhan} {$product->satuan}, " .
                            "Tersedia: {$product->stok_tersedia} {$product->satuan}."
                        );
                        return;
                    }
                }
    
                // Buat Sale jika belum ada
                if ($perluBuatSale) {
                    $totalHargaProduk = 0;
                    foreach ($kategori->products as $product) {
                        $kebutuhan         = $product->pivot->quantity * $this->quantity;
                        $totalHargaProduk += ($product->harga_jual ?? 0) * $kebutuhan;
                    }
    
                    $invoiceNumber = $this->generateInvoiceNumber();
    
                    $sale = Sale::create([
                        'invoice_number'   => $invoiceNumber,
                        'customer_id'      => null,
                        'transaction_date' => $this->order_date,
                        'payment_method'   => 'transfer',
                        'notes'            => "Order Jasa: {$this->order_title} | Customer: {$this->customer_name} | Telp: {$this->customer_phone}",
                        'total'            => $totalHargaProduk,
                        'paid_amount'      => $this->payment,
                        'change_amount'    => max(0, $this->payment - $totalHargaProduk),
                        'status'           => ($this->total_price > 0 && $this->payment >= $this->total_price)
                                                ? 'lunas'
                                                : 'belum-lunas',
                        'created_by'       => Auth::id(),
                    ]);
    
                    $saleId = $sale->id;
    
                    foreach ($kategori->products as $product) {
                        $kebutuhan = $product->pivot->quantity * $this->quantity;
    
                        SaleItem::create([
                            'sale_id'        => $sale->id,
                            'product_id'     => $product->id,
                            'product_name'   => $product->nama_produk,
                            'price'          => $product->harga_jual ?? 0,
                            'price_purchase' => $product->harga_beli ?? 0,
                            'quantity'       => $kebutuhan,
                            'unit'           => $product->satuan ?? 'pcs',
                            'subtotal'       => ($product->harga_jual ?? 0) * $kebutuhan,
                        ]);
                    }
                }
    
                // Kurangi stok
                foreach ($kategori->products as $product) {
                    $kebutuhan = $product->pivot->quantity * $this->quantity;
                    $product->decrement('stok_tersedia', $kebutuhan);
                }
            }
    
            // ── Tentukan nilai stock_deducted & sale_id untuk update ─────────────
            // Jika rollback → reset keduanya ke false/null
            // Jika kurangi  → set true dan isi sale_id
            // Jika tidak ada perubahan → pertahankan nilai lama
            if ($perluRollbackStok) {
                $stockDeducted = false;
                $saleId        = null;
            } elseif ($perluKurangiStok) {
                $stockDeducted = true;
                // $saleId sudah di-set di atas
            } else {
                $stockDeducted = $sudahDikurangi;
                $saleId        = $this->order->sale_id;
            }

 

            $statusPembayaran = ($this->total_price > 0 && $this->payment >= $this->total_price)
                ? 'lunas'
                : 'belum_lunas';

            $updateData = [
                'category_id'               => $this->category_id,
                'customer_name'             => $this->customer_name,
                'customer_phone'            => $this->customer_phone,
                'customer_email'            => $this->customer_email ?: null,
                'order_title'               => $this->order_title,
                'order_description'         => $this->order_description,
                'quantity'                  => $this->quantity,
                'order_date'                => $this->order_date,
                'estimated_completion_date' => $this->estimated_completion_date,
                'total_price'               => $this->total_price,
                'payment'                   => $this->payment,
                'down_payment'              => $this->down_payment ?: 0,
                'design_file'               => $designFilePath,
                'notes'                     => $this->notes ?: null,
                'status'                    => $this->status,
                'status_pembayaran'         => $statusPembayaran,
                'stock_deducted'            => $stockDeducted,
                'sale_id'                   => $saleId,
                'updated_by'                => Auth::id(),
            ];

            // Tandai waktu selesai jika status completed
            if ($this->status === 'completed' && !$this->order->actual_completion_date) {
                $updateData['actual_completion_date'] = now();
            }

            $this->order->update($updateData);
            DB::commit();
            
            session()->flash('success', 'Order jasa berhasil diperbarui.');
            return redirect()->route('order-jasa.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.order-jasa.update-order-jasa');
    }
}