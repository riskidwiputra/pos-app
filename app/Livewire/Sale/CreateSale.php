<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

#[Layout('layouts.app')]
#[Title('Tambah Penjualan')]
class CreateSale extends Component
{
    public $customer_name = '';
    public $transaction_date = '';
    public $payment_method = 'cash';
    public $notes = '';
    public $paid_amount = 0;
    
    // Items
    public $items = [];
    public $products = [];
    
    // Calculated
    public $total = 0;
    public $change_amount = 0;

    protected $rules = [
        'transaction_date' => 'required|date',
        'payment_method' => 'required|in:cash,transfer',
        'paid_amount' => 'required|numeric|min:0',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|integer|min:1',
    ];

    protected $messages = [
        'transaction_date.required' => 'Tanggal transaksi wajib diisi',
        'paid_amount.required' => 'Jumlah dibayar wajib diisi',
        'items.*.product_id.required' => 'Produk wajib dipilih',
        'items.*.quantity.required' => 'Jumlah wajib diisi',
        'items.*.quantity.min' => 'Jumlah minimal 1',
    ];

    public function mount()
    {
        $this->products = Product::where('status_product', 'Tersedia')
                                 ->where('stok_tersedia', '>', 0)
                                 ->get();
        $this->transaction_date = Carbon::now()->format('Y-m-d');
        $this->addItem();
    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => '',
            'product_name' => '',
            'price' => 0,
            'quantity' => 1,
            'unit' => '',
            'stock_available' => 0,
            'subtotal' => 0,
        ];
        dump($this->items);
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->calculateTotal();
    }

    public function updatedItems($value, $name)
    {
       
        $parts = explode('.', $name);
        
        if (count($parts) === 2) {
            
            $index = $parts[0];
            $field = $parts[1];
          
            if ($field === 'product_id' && !empty($value)) {
                $product = Product::find($value);
                if ($product) {
                    $this->items[$index]['product_name'] = $product->nama_produk;
                    $this->items[$index]['price'] = $product->harga_jual;
                    $this->items[$index]['unit'] = $product->unit->nama_unit ?? 'Unit';
                    $this->items[$index]['stock_available'] = $product->stok_tersedia;
                }
            }
            
        }
        
        $this->calculateTotal();
    }

    public function updatedPaidAmount()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        
        foreach ($this->items as $index => $item) {
            if (isset($item['price']) && isset($item['quantity'])) {
                $subtotal = (float)$item['price'] * (int)$item['quantity'];
                $this->items[$index]['subtotal'] = $subtotal;
                $this->total += $subtotal;
            }
        }
        // dump($this->total);
        $this->change_amount = (float) $this->paid_amount - (float) $this->total;
    }

    public function generateInvoiceNumber()
    {
        $date = Carbon::now()->format('Ymd');
        $lastSale = Sale::whereDate('created_at', Carbon::today())
                        ->orderBy('id', 'desc')
                        ->first();
        
        $sequence = $lastSale ? intval(substr($lastSale->invoice_number, -4)) + 1 : 1;
        
        return 'INV-' . $date . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function store()
    {
        $this->validate();

        if (empty($this->items)) {
            session()->flash('error', 'Minimal harus ada 1 item penjualan!');
            return;
        }

        // Validasi stok
        foreach ($this->items as $item) {
            $product = Product::find($item['product_id']);
            if ($product->stok_tersedia < $item['quantity']) {
                session()->flash('error', 'Stok ' . $product->nama_produk . ' tidak mencukupi! Tersedia: ' . $product->stok_tersedia);
                return;
            }
        }

        // Validasi pembayaran
        if ($this->paid_amount < $this->total) {
            session()->flash('error', 'Jumlah dibayar kurang dari total!');
            return;
        }

        DB::beginTransaction();
        
        try {
            // Generate invoice number
            $invoiceNumber = $this->generateInvoiceNumber();
            
            // Create sale
            $sale = Sale::create([
                'invoice_number' => $invoiceNumber,
                'customer_id' => null, // Bisa dikembangkan untuk customer terdaftar
                'transaction_date' => $this->transaction_date,
                'payment_method' => $this->payment_method,
                'notes' => $this->notes,
                'total' => $this->total,
                'paid_amount' => $this->paid_amount,
                'change_amount' => $this->change_amount,
                'status' => 'Lunas',
                'created_by' => Auth::id(),
            ]);
            
            // Create sale items and update stock
            foreach ($this->items as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'subtotal' => $item['subtotal'],
                ]);
                
                // Update product stock
                $product = Product::find($item['product_id']);
                $product->stok_tersedia -= $item['quantity'];
                $product->save();
            }
            
            DB::commit();
            
            session()->flash('message', 'Penjualan berhasil! Invoice: ' . $invoiceNumber);
            return redirect()->route('sale.Index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.sale.create-sale');
    }
}