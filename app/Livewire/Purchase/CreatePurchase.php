<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
#[Title('Tambah Pembelian')]
class CreatePurchase extends Component
{
    public $supplier_id = '';
    public $nomor_invoice = '';
    public $tgl_invoice = '';
    public $tanggal_terima_barang = '';
    public $catatan = '';
    public $jumlah_dibayar = 0;
    
    // Items
    public $items = [];
    public $products = [];
    
    // Calculated
    public $total_harga = 0;
    public $sisa_tagihan = 0;
    public $status_pembayaran = 'Belum Lunas';

    protected $rules = [
        'supplier_id' => 'required|exists:suppliers,id',
        'nomor_invoice' => 'required|string|max:100',
        'tgl_invoice' => 'required|date',
        'tanggal_terima_barang' => 'required|date',
        'jumlah_dibayar' => 'required|numeric|min:0',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.harga_beli' => 'required|integer|min:0',
        'items.*.qty' => 'required|integer|min:1',
    ];

    protected $messages = [
        'supplier_id.required' => 'Supplier wajib dipilih',
        'nomor_invoice.required' => 'Nomor invoice wajib diisi',
        'tgl_invoice.required' => 'Tanggal invoice wajib diisi',
        'tanggal_terima_barang.required' => 'Tanggal terima barang wajib diisi',
        'items.*.product_id.required' => 'Produk wajib dipilih',
        'items.*.harga_beli.required' => 'Harga beli wajib diisi',
        'items.*.qty.required' => 'Jumlah wajib diisi',
    ];

    public function mount()
    {
        $this->products = Product::where('status_product', 'Tersedia')->get();
        $this->tgl_invoice = Carbon::now()->format('Y-m-d');
        $this->tanggal_terima_barang = Carbon::now()->format('Y-m-d');
        $this->addItem();
    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => '',
            'harga_beli' => 0,
            'qty' => 1,
            'subtotal' => 0,
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->calculateTotal();
    }

    public function updatedItems($value, $name)
    {
        $this->calculateTotal();
    }

    public function updatedJumlahDibayar()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total_harga = 0;
        
        foreach ($this->items as $index => $item) {
            if (isset($item['harga_beli']) && isset($item['qty'])) {
                
                $subtotal = (int)$item['harga_beli'] * (int)$item['qty'];
              
                $this->items[$index]['subtotal'] = $subtotal;
                $this->total_harga += $subtotal;
                //   dd($this->total_harga);

            }
        }
        
        $this->sisa_tagihan = $this->total_harga - $this->jumlah_dibayar;
        
        if ($this->jumlah_dibayar >= $this->total_harga) {
            $this->status_pembayaran = 'Lunas';
        } else {
            $this->status_pembayaran = 'Belum Lunas';
        }
    }

    public function generatePurchaseCode()
    {
        $date = Carbon::now()->format('Ymd');
        $lastPurchase = Purchase::whereDate('created_at', Carbon::today())
                                ->orderBy('id', 'desc')
                                ->first();
        
        $sequence = $lastPurchase ? intval(substr($lastPurchase->purchase_code, -3)) + 1 : 1;
        
        return 'PO-' . $date . '-' . str_pad($sequence, 3, '0', STR_PAD_LEFT);
    }

    public function store()
    {
        $this->validate();

        if (empty($this->items)) {
            session()->flash('error', 'Minimal harus ada 1 item pembelian!');
            return;
        }

        DB::beginTransaction();
        
        try {
            // Generate purchase code
            $purchaseCode = $this->generatePurchaseCode();
            
            // Create purchase
            $purchase = Purchase::create([
                'purchase_code' => $purchaseCode,
                'supplier_id' => $this->supplier_id,
                'nomor_invoice' => $this->nomor_invoice,
                'tgl_invoice' => $this->tgl_invoice,
                'tanggal_terima_barang' => $this->tanggal_terima_barang,
                'total_harga' => $this->total_harga,
                'jumlah_dibayar' => $this->jumlah_dibayar,
                'sisa_tagihan' => $this->sisa_tagihan,
                'status_pembayaran' => $this->status_pembayaran,
                'status' => 'Aktif',
                'catatan' => $this->catatan,
            ]);
            
            // Create purchase items and update stock
            foreach ($this->items as $item) {
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'harga_beli' => $item['harga_beli'],
                    'qty' => $item['qty'],
                    'subtotal' => $item['subtotal'],
                ]);
                
                // Update product stock
                $product = Product::find($item['product_id']);
                $product->stok_tersedia += $item['qty'];
                $product->save();
            }
            
            DB::commit();
            
            session()->flash('message', 'Pembelian berhasil ditambahkan! Kode: ' . $purchaseCode);
            return redirect()->route('purchase.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.purchase.create-purchase', [
            'suppliers' => Supplier::all(),
        ]);
    }
}