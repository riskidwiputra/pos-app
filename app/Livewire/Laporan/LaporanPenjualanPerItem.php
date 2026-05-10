<?php

namespace App\Livewire\Laporan;


use App\Models\SaleItem;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
#[Title('Laporan Penjualan - Per Item')]
class LaporanPenjualanPerItem extends Component
{
    use WithPagination;

    public $tanggalMulai;
    public $tanggalSelesai;
    public $pencarian = '';
    public $kategoriFilter = '';
    public $sortBy = 'total_terjual'; // total_terjual, total_pendapatan, total_keuntungan
    public $sortDirection = 'desc';
    public $perPage = 15;

    protected $queryString = [
        'tanggalMulai',
        'tanggalSelesai',
        'pencarian',
        'kategoriFilter',
        'sortBy',
        'sortDirection'
    ];

    public function mount()
    {
        $this->tanggalMulai = "";
        $this->tanggalSelesai = "";
    }

    #[Computed]
    public function laporanPerItem()
    {

        $query = SaleItem::join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->join('products', 'sale_items.product_id', '=', 'products.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->when($this->tanggalMulai !== '' && $this->tanggalSelesai !== '', function($query) {
                $query->whereBetween('sales.transaction_date', [$this->tanggalMulai, $this->tanggalSelesai]);
            })
            ->where('sales.status', 'Lunas')
            ->when($this->pencarian, function($q) {
                $q->where('products.nama_produk', 'like', '%' . $this->pencarian . '%');
            })
            ->when($this->kategoriFilter, function($q) {
                $q->where('products.category_id', $this->kategoriFilter);
            })
            ->select(
                'sale_items.product_id',
                'products.nama_produk',
                'products.kode_produk',
                'categories.nama_kategori',
                DB::raw('AVG(sale_items.price) as harga_jual_avg'),
                DB::raw('AVG(sale_items.price_purchase) as harga_beli_avg'),
                DB::raw('SUM(sale_items.quantity) as total_terjual'),
                DB::raw('SUM(sale_items.subtotal) as total_pendapatan'),
                DB::raw('COUNT(DISTINCT sale_items.sale_id) as jumlah_transaksi')
            )
            ->groupBy('sale_items.product_id', 'products.nama_produk', 'products.kode_produk', 'categories.nama_kategori');

        // Sorting
        switch($this->sortBy) {
            case 'total_pendapatan':
                $query->orderBy('total_pendapatan', $this->sortDirection);
                break;
            case 'total_keuntungan':
                $query->orderBy('total_keuntungan', $this->sortDirection);
                break;
            default:
                $query->orderBy('total_terjual', $this->sortDirection);
        }

        $results = $query->get();

        $results = $results->map(function($item) {

            
            $item->total_keuntungan = ($item->harga_jual_avg - $item->harga_beli_avg) * $item->total_terjual;
            $item->margin_persen = $item->harga_beli_avg > 0 ? (($item->harga_jual_avg - $item->harga_beli_avg) / $item->harga_beli_avg) * 100 : 0;

            return $item;
        });

        $page = request()->get('page', 1);
        $offset = ($page - 1) * $this->perPage;
        
        return new \Illuminate\Pagination\LengthAwarePaginator(
            $results->slice($offset, $this->perPage)->values(),
            $results->count(),
            $this->perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    

    #[Computed]
    public function kategoriList()
    {
        return Category::orderBy('nama_kategori')->get();
    }

    

    public function sortByColumn($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'desc';
        }
    }

   

    public function updatingPencarian()
    {
        $this->resetPage();
    }

    public function updatingKategoriFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.laporan.laporan-penjualan-per-item');
    }
}