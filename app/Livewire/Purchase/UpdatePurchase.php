<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
#[Title('Edit Pembelian')]
class UpdatePurchase extends Component
{
    public Purchase $purchase;
    public $supplier_id = '';
    public $nomor_invoice = '';
    public $tgl_invoice = '';
    public $tanggal_terima_barang = '';
    public $catatan = '';
    public $jumlah_dibayar = 0;
    public $status = '';
    
    // Items
    public $items = [];
    public $deletedItems = [];
    public $products = [];
    
    // Calculated
    public $total_harga = 0;
    public $sisa_tagihan = 0;
    public $status_pembayaran = '';

    protected $rules = [
        'supplier_id' => 'required|exists:suppliers,id',
        'nomor_invoice' => 'required|string|max:100',
        'tgl_invoice' => 'required|date',
        'tanggal_terima_barang' => 'required|date',
        'jumlah_dibayar' => 'required|numeric|min:0',
        'status' => 'required|in:Aktif,Dibatalkan',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.harga_beli' => 'required|numeric|min:0',
        'items.*.qty' => 'required|integer|min:1',
    ];

    public function mount($id)
    {
        $this->purchase = Purchase::with('items')->findOrFail($id);
        $this->products = Product::where('status_product', 'Tersedia')->get();
        
        $this->supplier_id = $this->purchase->supplier_id;
        $this->nomor_invoice = $this->purchase->nomor_invoice;
        $this->tgl_invoice = $this->purchase->tgl_invoice->format('Y-m-d');
        $this->tanggal_terima_barang = $this->purchase->tanggal_terima_barang->format('Y-m-d');
        $this->catatan = $this->purchase->catatan;
        $this->jumlah_dibayar = $this->purchase->jumlah_dibayar;
        $this->status = $this->purchase->status;
        
        // Load existing items
        foreach ($this->purchase->items as $item) {
            $this->items[] = [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'harga_beli' => $item->harga_beli,
                'qty' => $item->qty,
                'subtotal' => $item->subtotal,
                'old_qty' => $item->qty, // Store original qty for stock adjustment
            ];
        }
        
        $this->calculateTotal();
    }

    public function addItem()
    {
        $this->items[] = [
            'id' => null,
            'product_id' => '',
            'harga_beli' => 0,
            'qty' => 1,
            'subtotal' => 0,
            'old_qty' => 0,
        ];
    }

    public function removeItem($index)
    {
        if (isset($this->items[$index]['id'])) {
            $this->deletedItems[] = $this->items[$index]['id'];
        }
        
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
                $subtotal = $item['harga_beli'] * $item['qty'];
                $this->items[$index]['subtotal'] = $subtotal;
                $this->total_harga += $subtotal;
            }
        }
        
        $this->sisa_tagihan = $this->total_harga - $this->jumlah_dibayar;
        
        if ($this->jumlah_dibayar >= $this->total_harga) {
            $this->status_pembayaran = 'Lunas';
        } else {
            $this->status_pembayaran = 'Belum Lunas';
        }
    }

    public function update()
    {
        $this->validate();

        if (empty($this->items)) {
            session()->flash('error', 'Minimal harus ada 1 item pembelian!');
            return;
        }

        DB::beginTransaction();
        
        try {
            // Update purchase
            $this->purchase->update([
                'supplier_id' => $this->supplier_id,
                'nomor_invoice' => $this->nomor_invoice,
                'tgl_invoice' => $this->tgl_invoice,
                'tanggal_terima_barang' => $this->tanggal_terima_barang,
                'total_harga' => $this->total_harga,
                'jumlah_dibayar' => $this->jumlah_dibayar,
                'sisa_tagihan' => $this->sisa_tagihan,
                'status_pembayaran' => $this->status_pembayaran,
                'status' => $this->status,
                'catatan' => $this->catatan,
            ]);
            
            // Handle deleted items
            foreach ($this->deletedItems as $itemId) {
                $item = PurchaseItem::find($itemId);
                if ($item) {
                    // Adjust stock back
                    $product = Product::find($item->product_id);
                    $product->stok_tersedia -= $item->qty;
                    $product->save();
                    
                    $item->delete();
                }
            }
            
            // Update or create items
            foreach ($this->items as $itemData) {
                if (isset($itemData['id']) && $itemData['id']) {
                    // Update existing item
                    $item = PurchaseItem::find($itemData['id']);
                    
                    // Adjust stock if qty changed
                    if ($item->qty != $itemData['qty']) {
                        $product = Product::find($itemData['product_id']);
                        $qtyDiff = $itemData['qty'] - $item->qty;
                        $product->stok_tersedia += $qtyDiff;
                        $product->save();
                    }
                    
                    $item->update([
                        'product_id' => $itemData['product_id'],
                        'harga_beli' => $itemData['harga_beli'],
                        'qty' => $itemData['qty'],
                        'subtotal' => $itemData['subtotal'],
                    ]);
                } else {
                    // Create new item
                    PurchaseItem::create([
                        'purchase_id' => $this->purchase->id,
                        'product_id' => $itemData['product_id'],
                        'harga_beli' => $itemData['harga_beli'],
                        'qty' => $itemData['qty'],
                        'subtotal' => $itemData['subtotal'],
                    ]);
                    
                    // Update stock
                    $product = Product::find($itemData['product_id']);
                    $product->stok_tersedia += $itemData['qty'];
                    $product->save();
                }
            }
            
            DB::commit();
            
            session()->flash('message', 'Pembelian berhasil diupdate!');
            return redirect()->route('purchase.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.purchase.update-purchase', [
            'suppliers' => Supplier::all(),
        ]);
    }
}