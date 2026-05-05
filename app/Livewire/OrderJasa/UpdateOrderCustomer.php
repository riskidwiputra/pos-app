<?php

namespace App\Livewire\OrderJasa;

use App\Models\ServiceOrder;
use App\Models\ServiceCategory;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

#[Layout('layouts.app')]
#[Title('Ubah Pesanan Saya')]
class UpdateOrderCustomer extends Component
{
    use WithFileUploads;

    public ServiceOrder $order;

    // ─── Customer 
    public $customer_name  = '';
    public $customer_phone = '';
    public $customer_email = '';

    // ─── Order ───
    public $category_id       = '';
    public $order_title       = '';
    public $order_description = '';
    public $quantity          = 1;
    public $unit              = 'pcs';

    // ─── Dates ───
    public $order_date                = '';
    public $estimated_completion_date = '';

    // ─── Pricing ─
    public $total_price  = 0;
    public $payment      = 0;
    public $down_payment = 0;

    // ─── Misc ────
    public $design_file;
    public $existing_design_file = null;
    public $hapus_design_file    = false;
    public $notes  = '';
    public $status = 'pending';

    // ─── Preview info kategori terpilih ──────────────────────────────────────────
    public $selectedCategoryInfo = null;

    // ─── Lifecycle ───────────────────────────────────────────────────────────────

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
        $this->unit                      = $order->unit;
        $this->order_date                = Carbon::parse($order->order_date)->format('Y-m-d');
        $this->estimated_completion_date = Carbon::parse($order->estimated_completion_date)->format('Y-m-d');
        $this->total_price               = (int) $order->total_price;
        $this->payment                   = (int) $order->payment;
        $this->down_payment              = (int) ($order->down_payment ?? 0);
        $this->notes                     = $order->notes ?? '';
        $this->status                    = $order->status;
        $this->existing_design_file      = $order->design_file;

        // Populate preview info kategori
        if ($this->category_id) {
            $cat = ServiceCategory::find($this->category_id);
            if ($cat) {
                $this->selectedCategoryInfo = $this->buildCategoryInfo($cat);
            }
        }
    }

    // ─── Computed 

    #[Computed]
    public function kategori()
    {
        return ServiceCategory::orderBy('nama_jasa')->get();
    }

    // ─── Helper ──

    private function buildCategoryInfo(ServiceCategory $cat): array
    {
        return [
            'icon'                 => $cat->icon ?? '🖨️',
            'nama_jasa'            => $cat->nama_jasa,
            'harga_format'         => $cat->harga_format,
            'keterangan_bahan'     => $cat->keterangan_bahan,
            'finishing'            => $cat->finishing,
            'harga_bisa_negosiasi' => $cat->harga_bisa_negosiasi,
        ];
    }

    // ─── Reactive: saat kategori berubah ─────────────────────────────────────────

    public function updatedCategoryId($value)
    {
        if ($value) {
            $cat = ServiceCategory::find($value);
            if ($cat) {
                $this->unit = $cat->satuan_harga;
                $this->selectedCategoryInfo = $this->buildCategoryInfo($cat);
            }
        } else {
            $this->selectedCategoryInfo = null;
        }
    }

    // ─── Save ────

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
            'unit'                      => 'required|string|max:50',
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

        try {
            $designFilePath = $this->existing_design_file;

            // Hapus file lama jika dicentang
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
                'unit'                      => $this->unit,
                'order_date'                => $this->order_date,
                'estimated_completion_date' => $this->estimated_completion_date,
                'total_price'               => $this->total_price,
                'payment'                   => $this->payment,
                'down_payment'              => $this->down_payment ?: 0,
                'design_file'               => $designFilePath,
                'notes'                     => $this->notes ?: null,
                'status'                    => $this->status,
                'status_pembayaran'         => $statusPembayaran,
                'updated_by'                => Auth::id(),
            ];

            // Tandai waktu selesai jika status completed
            if ($this->status === 'completed' && !$this->order->actual_completion_date) {
                $updateData['actual_completion_date'] = now();
            }

            $this->order->update($updateData);

            session()->flash('success', 'Order jasa berhasil diperbarui.');
            return redirect()->route('order-jasa.riwayat-pesanan');

        } catch (\Throwable $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.order-jasa.update-order-customer');
    }
}