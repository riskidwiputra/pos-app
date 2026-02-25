<?php

namespace App\Livewire\Laporan;

use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
#[Title('Laporan Stok Barang')]
class LaporanStok extends Component
{
    use WithPagination;

    // Filter
    public $pencarian = '';
    public $kategoriFilter = '';
    public $statusStok = 'semua'; // semua, kritis, rendah, aman, habis
    public $sortBy = 'stok_tersedia';
    public $sortDirection = 'asc';
    public $perPage = 15;

    // Threshold Settings
    public $batasKritis = 5;    // Stok <= 5 (Merah - Kritis)
    public $batasRendah = 10;   // Stok <= 10 (Kuning - Rendah)
    public $batasAman = 11;     // Stok > 10 (Hijau - Aman)

    protected $queryString = [
        'pencarian',
        'kategoriFilter',
        'statusStok',
        'sortBy',
        'sortDirection'
    ];

    #[Computed]
    public function laporanStok()
    {
        return Product::with(['category', 'unit'])
            ->when($this->pencarian, function($query) {
                $query->where(function($q) {
                    $q->where('nama_produk', 'like', '%' . $this->pencarian . '%')
                      ->orWhere('kode_produk', 'like', '%' . $this->pencarian . '%');
                });
            })
            ->when($this->kategoriFilter, function($query) {
                $query->where('category_id', $this->kategoriFilter);
            })
            ->when($this->statusStok !== 'semua', function($query) {
                switch($this->statusStok) {
                    case 'habis':
                        $query->where('stok_tersedia', '=', 0);
                        break;
                    case 'kritis':
                        $query->where('stok_tersedia', '>', 0)
                              ->where('stok_tersedia', '<=', $this->batasKritis);
                        break;
                    case 'rendah':
                        $query->where('stok_tersedia', '>', $this->batasKritis)
                              ->where('stok_tersedia', '<=', $this->batasRendah);
                        break;
                    case 'aman':
                        $query->where('stok_tersedia', '>', $this->batasRendah);
                        break;
                }
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    #[Computed]
    public function ringkasanStok()
    {
        $total = Product::count();
        $stokHabis = Product::where('stok_tersedia', 0)->count();
        $stokKritis = Product::where('stok_tersedia', '>', 0)
                            ->where('stok_tersedia', '<=', $this->batasKritis)
                            ->count();
        $stokRendah = Product::where('stok_tersedia', '>', $this->batasKritis)
                            ->where('stok_tersedia', '<=', $this->batasRendah)
                            ->count();
        $stokAman = Product::where('stok_tersedia', '>', $this->batasRendah)->count();

        $nilaiStok = Product::selectRaw('SUM(stok_tersedia * harga_jual) as total')->value('total') ?? 0;
        $totalItem = Product::sum('stok_tersedia');

        return [
            'total_produk' => $total,
            'stok_habis' => $stokHabis,
            'stok_kritis' => $stokKritis,
            'stok_rendah' => $stokRendah,
            'stok_aman' => $stokAman,
            'nilai_stok' => $nilaiStok,
            'total_item' => $totalItem,
            'perlu_restock' => $stokHabis + $stokKritis + $stokRendah,
        ];
    }

    #[Computed]
    public function produkHabis()
    {
        return Product::with(['category'])
            ->where('stok_tersedia', 0)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();
    }

    #[Computed]
    public function produkKritis()
    {
        return Product::with(['category'])
            ->where('stok_tersedia', '>', 0)
            ->where('stok_tersedia', '<=', $this->batasKritis)
            ->orderBy('stok_tersedia', 'asc')
            ->limit(10)
            ->get();
    }

    #[Computed]
    public function kategoriList()
    {
        return Category::orderBy('nama_kategori')->get();
    }

    #[Computed]
    public function grafikStokPerKategori()
    {
        $data = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->select(
                'categories.nama_kategori',
                DB::raw('COALESCE(SUM(products.stok_tersedia), 0) as total_stok')
            )
            ->groupBy('categories.id', 'categories.nama_kategori')
            ->orderByDesc('total_stok')
            ->limit(8)
            ->get();

        return [
            'labels' => $data->pluck('nama_kategori')->toArray(),
            'values' => $data->pluck('total_stok')->toArray(),
        ];
    }

   

    public function getStatusStok($stok)
    {
        if ($stok == 0) {
            return [
                'status' => 'Habis',
                'class' => 'bg-red-100 text-red-700 border-red-300',
                'icon_class' => 'text-red-500',
                'alert_level' => 'danger'
            ];
        } elseif ($stok <= $this->batasKritis) {
            return [
                'status' => 'Kritis',
                'class' => 'bg-orange-100 text-orange-700 border-orange-300',
                'icon_class' => 'text-orange-500',
                'alert_level' => 'critical'
            ];
        } elseif ($stok <= $this->batasRendah) {
            return [
                'status' => 'Rendah',
                'class' => 'bg-yellow-100 text-yellow-700 border-yellow-300',
                'icon_class' => 'text-yellow-500',
                'alert_level' => 'warning'
            ];
        } else {
            return [
                'status' => 'Aman',
                'class' => 'bg-green-100 text-green-700 border-green-300',
                'icon_class' => 'text-green-500',
                'alert_level' => 'safe'
            ];
        }
    }

    public function sortByColumn($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function resetFilter()
    {
        $this->pencarian = '';
        $this->kategoriFilter = '';
        $this->statusStok = 'semua';
        $this->sortBy = 'stok_tersedia';
        $this->sortDirection = 'asc';
        $this->resetPage();
    }

  

    public function updatingPencarian()
    {
        $this->resetPage();
    }

    public function updatingKategoriFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusStok()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.laporan.laporan-stok');
    }
}