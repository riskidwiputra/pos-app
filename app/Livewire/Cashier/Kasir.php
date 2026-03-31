<?php

namespace App\Livewire\Cashier;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\SaleItem;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

#[Layout('layouts.kasir-layout')]
#[Title('Kasir')]
class Kasir extends Component
{
    use WithPagination;
    public $searchTerm = '';
    public $selectedCategoryId = null;
    public $keranjang = [];
    public $tunai = 0;
    public $showModalStruk = false;
    public $showModalKonfirmasi = false; 
    public $nomorInvoice = '';
    public $tanggalTransaksi = '';

    protected $listeners = ['productClicked' => 'tambahKeKeranjang'];

    #[Computed]
    public function produkList()
    {
         return Product::with(['category', 'unit'])
            ->where(['status_product' => 'Tersedia'])
            ->where('stok_tersedia', '>', 0)
            ->when($this->searchTerm, fn($q) => $q->where('nama_produk', 'like', "%{$this->searchTerm}%"))
            ->when($this->selectedCategoryId, fn($q) => $q->where('category_id', $this->selectedCategoryId))
            ->paginate(20)
            ->through(fn($p) => [
                'id'     => $p->id,
                'nama'   => $p->nama_produk,
                'harga'  => $p->harga_jual,
                'stok'   => $p->stok_tersedia,
                'satuan' => $p->unit->singkatan ?? 'pcs',
                'foto'   => $p->gambar_barang ? asset("storage/{$p->gambar_barang}") : $this->defaultImage(),
            ]);
    }

    #[Computed]
    public function kategoriList()
    {
        return Category::withCount(['products' => function($q) {
            $q->where('status_product', 'Tersedia')->where('stok_tersedia', '>', 0);
        }])
        ->having('products_count', '>', 0)
        ->get();
    }

    #[Computed]
    public function totalBelanja()
    {
        return collect($this->keranjang)->sum(fn($item) => $item['harga'] * $item['jumlah']);
    }

    #[Computed]
    public function kembalian()
    {
        return $this->tunai - $this->totalBelanja();
    }

    #[Computed]
    public function totalItem()
    {
        return collect($this->keranjang)->sum('jumlah');
    }

    public function tambahKeKeranjang($productId)
    {
        $produk = Product::find($productId);
        
        if (!$produk || $produk->stok_tersedia <= 0) {
            $this->dispatch('toast', type: 'error', message: 'Produk tidak tersedia');
            return;
        }

        $indexKeranjang = collect($this->keranjang)->search(fn($item) => $item['product_id'] == $productId);

        if ($indexKeranjang !== false) {
            if ($this->keranjang[$indexKeranjang]['jumlah'] >= $produk->stok_tersedia) {
                $this->dispatch('toast', type: 'error', message: 'Stok tidak cukup');
                return;
            }
            $this->keranjang[$indexKeranjang]['jumlah']++;
        } else {
            $this->keranjang[] = [
                'product_id' => $produk->id,
                'nama' => $produk->nama_produk,
                'harga' => $produk->harga_jual,
                'jumlah' => 1,
                'stok' => $produk->stok_tersedia,
                'satuan' => $produk->unit->singkatan ?? 'pcs',
                'foto' => $produk->gambar_barang ? asset('storage/' . $produk->gambar_barang) : $this->defaultImage(),
            ];
        }

        $this->dispatch('toast', type: 'success', message: 'Ditambahkan ke keranjang');
    }

    public function ubahJumlah($index, $perubahan)
    {
        if (!isset($this->keranjang[$index])) return;

        $jumlahBaru = $this->keranjang[$index]['jumlah'] + $perubahan;

        if ($jumlahBaru <= 0) {
            $this->hapusDariKeranjang($index);
            return;
        }

        if ($jumlahBaru > $this->keranjang[$index]['stok']) {
            $this->dispatch('toast', type: 'error', message: 'Stok tidak cukup');
            return;
        }

        $this->keranjang[$index]['jumlah'] = $jumlahBaru;
    }

    public function setJumlahManual($index, $jumlah)
    {
        if (!isset($this->keranjang[$index])) return;

        $jumlah = max(1, intval($jumlah));

        if ($jumlah > $this->keranjang[$index]['stok']) {
            $this->keranjang[$index]['jumlah'] = $this->keranjang[$index]['stok'];
            $this->dispatch('toast', type: 'error', message: 'Stok tidak cukup');
            return;
        }

        $this->keranjang[$index]['jumlah'] = $jumlah;
    }

    public function hapusDariKeranjang($index)
    {
        unset($this->keranjang[$index]);
        $this->keranjang = array_values($this->keranjang);
        $this->dispatch('toast', type: 'success', message: 'Item dihapus');
    }

    public function kosongkanKeranjang()
    {
        $this->keranjang = [];
        $this->tunai = 0;
    }

    public function tambahTunai($nominal)
    {
        $this->tunai += $nominal;
    }

     public function showKonfirmasiPembayaran()
    {
        if (empty($this->keranjang)) {
            $this->dispatch('toast', type: 'error', message: 'Keranjang masih kosong');
            return;
        }

        if ($this->tunai < $this->totalBelanja()) {
            $this->dispatch('toast', type: 'error', message: 'Uang tidak cukup');
            return;
        }

        $this->showModalKonfirmasi = true;
    }

    public function batalkanPembayaran()
    {
        $this->showModalKonfirmasi = false;
    }

    public function prosesPembayaran()
    {
        if (empty($this->keranjang)) {
            $this->dispatch('toast', type: 'error', message: 'Keranjang masih kosong');
            return;
        }

        if ($this->tunai < $this->totalBelanja()) {
            $this->dispatch('toast', type: 'error', message: 'Uang tidak cukup');
            return;
        }

        DB::beginTransaction();
        
        try {
            $invoice = $this->generateInvoice();
            
            $sale = Sale::create([
                'invoice_number' => $invoice,
                'customer_id' => null,
                'transaction_date' => now(),
                'payment_method' => 'cash',
                'notes' => null,
                'total' => $this->totalBelanja(),
                'paid_amount' => $this->tunai,
                'change_amount' => $this->kembalian(),
                'status' => 'lunas',
                'created_by' => Auth::id(),
            ]);

            foreach ($this->keranjang as $item) {
             
                $produk = Product::find($item['product_id']);
                $hargaBeli = $produk->harga_beli ?? 0;
               
                $produk->decrement('stok_tersedia', $item['jumlah']);
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['nama'],
                    'price' => $item['harga'],
                    'price_purchase' => $hargaBeli,
                    'quantity' => $item['jumlah'],
                    'unit' => $item['satuan'],
                    'subtotal' => $item['harga'] * $item['jumlah'],
                ]);

            }

            DB::commit();

            $this->nomorInvoice = $invoice;
            $this->tanggalTransaksi = now()->format('d/m/Y H:i');
            $this->showModalStruk = true;

            $this->dispatch('toast', type: 'success', message: 'Transaksi berhasil');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('toast', type: 'error', message: 'Transaksi gagal: ' . $e->getMessage());
        }
    }

    public function tutupModalStruk()
    {
        $this->showModalStruk = false;
        $this->kosongkanKeranjang();
        $this->nomorInvoice = '';
        $this->tanggalTransaksi = '';
    }

    private function generateInvoice()
    {
        $tanggal = now()->format('Ymd');
        $terakhir = Sale::whereDate('created_at', today())
                       ->latest('id')
                       ->first();
        
        $urutan = $terakhir ? intval(substr($terakhir->invoice_number, -4)) + 1 : 1;
        
        return 'INV-' . $tanggal . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
    }

    private function defaultImage()
    {
        return 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="200" height="200"%3E%3Crect fill="%23e5e7eb" width="200" height="200"/%3E%3Ctext fill="%236b7280" font-family="sans-serif" font-size="16" dy="10.5" font-weight="bold" x="50%25" y="50%25" text-anchor="middle"%3ENo Image%3C/text%3E%3C/svg%3E';
    }

    public function render()
    {
        return view('livewire.cashier.kasir');
    }
}