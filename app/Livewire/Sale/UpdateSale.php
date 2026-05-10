<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

#[Layout('layouts.app')]
#[Title('Edit Penjualan')]
class UpdateSale extends Component
{
    public Sale $sale;
    public $jumlah_dibayar = 0;
    // Form Fields
    public $customer_id = '';
    public $customer_name = '';
    public $transaction_date;
    public $payment_method = 'cash';
    public $status = 'Lunas';
    public $notes = '';
    
    // Items
    public $items = [];
    
    public $deletedItems = [];
    public $products = [];
     public $total_harga = 0;
    public $sisa_tagihan = 0;
    public $change_amount = 0;
    public $status_pembayaran = '';
    
    protected $rules = [
        'transaction_date' => 'required|date',
        'payment_method' => 'required|in:cash,transfer',
        'notes' => 'nullable|string',
        'items' => 'required|array|min:1',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|integer|min:1',
        'jumlah_dibayar' => 'required|numeric|min:0',
    ];


    public function mount($id)
    {
        $this->sale = Sale::with('items')->findOrFail($id);
        $this->products = Product::where('status_product', 'Tersedia')->get();
        $this->customer_id = $this->sale->customer_id;
        $this->customer_name = $this->sale->customer ? $this->sale->customer->name : '';
        $this->transaction_date = $this->sale->transaction_date->format('Y-m-d');
        $this->payment_method = $this->sale->payment_method;
        $this->change_amount = $this->sale->change_amount;
        $this->status = $this->sale->status;
        $this->jumlah_dibayar = $this->sale->paid_amount;
        $this->notes = $this->sale->notes;
        // Load existing items
        foreach ($this->sale->items as $item) {
            $this->items[] = [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product_name,
                'quantity' => $item->quantity,
                'add' => false,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
                'old_qty' => $item->quantity, 
                'change_amount' => $item->change_amount,
            ];
        }   

        $this->calculateTotal();
    }

      public function addItem()
    {
        $this->items[] = [
            'id' => null,
            'product_id' => '',
            'product_name' => 0,
            'quantity' => 1,
            'add' => true,
            'price' => 0,
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
        if (str_contains($name, 'product_id')) {

            $index = explode('.', $name)[0];

            $product = Product::find($value);

            $this->items[$index]['price'] = $product?->harga_jual ?? 0;

            // FORCE refresh nested array
            $this->items = $this->items;
        }

         $this->calculateTotal();
       
    }
    public function setPrice($index)
{
    $productId = $this->items[$index]['product_id'];

    if (!$productId) {
        $this->items[$index]['price'] = 0;
        return;
    }

    $product = Product::select('harga_jual')
                ->find($productId);

    $this->items[$index]['price'] = $product?->harga_jual ?? 0;

    $this->calculateTotal();

    // FORCE refresh
    $this->items = $this->items;
}

    public function setSubtotal($index)
    {
        $price = $this->items[$index]['price'] ?? 0;
        $quantity = $this->items[$index]['quantity'] ?? 0;
        $this->items[$index]['subtotal'] = $price * $quantity;

        $this->calculateTotal();

        // FORCE refresh
        $this->items = $this->items;
    }

    public function updatedJumlahDibayar()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total_harga = 0;
        
        foreach ($this->items as $index => $item) {
            if (isset($item['price']) && isset($item['quantity'])) {
                $subtotal = $item['price'] * $item['quantity'];
                $this->items[$index]['subtotal'] = $subtotal;
                $this->total_harga += $subtotal;
            }
        }
        
        $this->sisa_tagihan = $this->jumlah_dibayar >= $this->total_harga ? 0 : $this->total_harga - $this->jumlah_dibayar;
        $this->change_amount = $this->jumlah_dibayar > $this->total_harga ? $this->jumlah_dibayar - $this->total_harga : 0;
        
        if ($this->jumlah_dibayar >= $this->total_harga) {
            $this->status_pembayaran = 'lunas';
        } else {
            $this->status_pembayaran = 'belum-lunas';
        }
    }

    public function updateSale()
    {
        $this->validate();

        if (empty($this->items)) {
            session()->flash('error', 'Minimal harus ada 1 item produk');
            return;
        }

        try {
            DB::beginTransaction();

             $this->calculateTotal();

            // Update sale
            $this->sale->update([
                'customer_id' => $this->customer_id ? '': null,
                'transaction_date' => $this->transaction_date,
                'payment_method' => $this->payment_method,
                'status' => $this->status_pembayaran,
                'notes' => $this->notes,
                'total' => $this->total_harga,
                'paid_amount' => $this->jumlah_dibayar,
                'change_amount' => $this->change_amount,
            ]);

            // Get existing items
            $existingItems = $this->sale->items->keyBy('id');
            $updatedItemIds = [];

            // Process items
            foreach ($this->items as $item) {
                if (isset($item['id']) && $item['id']) {
                    // Update existing item
                    $saleItem = SaleItem::find($item['id']);
                    
                    if ($saleItem) {
                        $product = Product::find($item['product_id']);
                        
                        // Adjust stock: return old quantity, subtract new quantity
                        $stockDiff = $saleItem->quantity - $item['quantity'];
                        $product->increment('stok_tersedia', $stockDiff);

                        $saleItem->update([
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                            'subtotal' => $item['subtotal'],
                        ]);

                        $updatedItemIds[] = $item['id'];
                    }
                } else {
                    // Create new item
                    $product = Product::find($item['product_id']);
                    
                    if ($product->stok_tersedia < $item['quantity']) {
                        throw new \Exception("Stok {$product->nama_produk} tidak cukup");
                    }

                    SaleItem::create([
                        'sale_id' => $this->sale->id,
                        'product_id' => $item['product_id'],
                        'product_name' => $product->nama_produk,
                        'quantity' => $item['quantity'],
                        'unit' => $product->unit->singkatan ?? 'pcs',
                        'price' => $item['price'],
                        'price_purchase' => $product->harga_beli ?? 0,
                        'subtotal' => $item['subtotal'],
                    ]);

                    // Reduce stock
                    $product->decrement('stok_tersedia', $item['quantity']);

                    $updatedItemIds[] = 'new';
                }
            }

            // Delete removed items and restore stock
            foreach ($existingItems as $existingItem) {
                if (!in_array($existingItem->id, $updatedItemIds)) {
                    $product = Product::find($existingItem->product_id);
                    if ($product) {
                        $product->increment('stok_tersedia', $existingItem->quantity);
                    }
                    $existingItem->delete();
                }
            }

            DB::commit();

            session()->flash('success', 'Data penjualan berhasil diperbarui');
            return redirect()->route('sale.index');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.sale.update-sale');
    }
}