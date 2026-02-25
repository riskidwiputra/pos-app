<?php

namespace App\Livewire\Laporan;

use App\Models\Sale;
use App\Models\Category;
use App\Models\SaleItem;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
#[Title('Laporan Penjualan')]
class LaporanPenjualan extends Component
{
    use WithPagination;

    public $tanggalMulai;
    public $tanggalSelesai;
    public $pencarian = '';
    public $kategoriTerpilih = '';
    public $statusTerpilih = '';
    public $perPage = 25;
    public $sortBy = 'transaction_date';
    public $sortDirection = 'desc';

    // Stats
    public $showStats = true;

    protected $queryString = [
        'tanggalMulai',
        'tanggalSelesai',
        'pencarian',
        'kategoriTerpilih',
        'statusTerpilih'
    ];

    public function mount()
    {
        $this->tanggalMulai = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->tanggalSelesai = Carbon::now()->format('Y-m-d');
    }

    #[Computed]
    public function penjualanData()
    {
        return Sale::with(['items.product.category', 'users'])
            ->whereBetween('transaction_date', [$this->tanggalMulai, $this->tanggalSelesai])
            ->when($this->pencarian, function($query) {
                $query->where(function($q) {
                    $q->where('invoice_number', 'like', '%' . $this->pencarian . '%')
                      ->orWhereHas('users', function($customerQuery) {
                          $customerQuery->where('name', 'like', '%' . $this->pencarian . '%');
                      });
                });
            })
            ->when($this->kategoriTerpilih, function($query) {
                $query->whereHas('items.product', function($q) {
                    $q->where('category_id', $this->kategoriTerpilih);
                });
            })
            ->when($this->statusTerpilih, function($query) {
                $query->where('status', $this->statusTerpilih);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    #[Computed]
    public function statistik()
    {
        $query = Sale::whereBetween('transaction_date', [$this->tanggalMulai, $this->tanggalSelesai])
            ->where('status', 'Lunas');

        return [
            'total_transaksi' => $query->count(),
            'total_pendapatan' => $query->sum('total'),
            'total_tunai' => $query->where('payment_method', 'cash')->sum('total'),
            'total_transfer' => $query->where('payment_method', 'transfer')->sum('total'),
            'rata_rata_transaksi' => $query->avg('total') ?? 0,
            'transaksi_tertinggi' => $query->max('total') ?? 0,
            'total_item_terjual' => SaleItem::join('sales', 'sale_items.sale_id', '=', 'sales.id')
                ->whereBetween('sales.transaction_date', [$this->tanggalMulai, $this->tanggalSelesai])
                ->where('sales.status', 'lunas')
                ->sum('sale_items.quantity'),
        ];
    }

    // #[Computed]
    public function topProduk()
    {
        return SaleItem::join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->join('products', 'sale_items.product_id', '=', 'products.id')
            ->whereBetween('sales.transaction_date', [$this->tanggalMulai, $this->tanggalSelesai])
            ->where('sales.status', 'Lunas')
            ->select(
                'products.nama_produk',
                DB::raw('SUM(sale_items.quantity) as total_terjual'),
                DB::raw('SUM(sale_items.subtotal) as total_pendapatan')
            )
            ->groupBy('products.id', 'products.nama_produk')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();
    }

    #[Computed]
    public function grafikPenjualan()
    {
        $data = Sale::whereBetween('transaction_date', [$this->tanggalMulai, $this->tanggalSelesai])
            ->where('status', 'Lunas')
            ->selectRaw('DATE(transaction_date) as tanggal, SUM(total) as total_harian, COUNT(*) as jumlah_transaksi')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return [
            'labels' => $data->pluck('tanggal')->map(fn($d) => Carbon::parse($d)->format('d M'))->toArray(),
            'pendapatan' => $data->pluck('total_harian')->toArray(),
            'transaksi' => $data->pluck('jumlah_transaksi')->toArray(),
        ];
    }

    #[Computed]
    public function kategoriList()
    {
        return Category::withCount(['products'])->get();
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
        $this->tanggalMulai = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->tanggalSelesai = Carbon::now()->format('Y-m-d');
        $this->pencarian = '';
        $this->kategoriTerpilih = '';
        $this->statusTerpilih = '';
        $this->resetPage();
    }

    public function exportPDF()
    {
        $data = [
            'penjualan' => $this->penjualanData,
            'statistik' => $this->statistik(),
            'topProduk' => $this->topProduk(),
            'tanggalMulai' => $this->tanggalMulai,
            'tanggalSelesai' => $this->tanggalSelesai,
        ];

        // $pdf = Pdf::loadView('laporan.pdf.penjualan', $data);
        // return response()->streamDownload(
        //     fn() => print($pdf->output()),
        //     'laporan-penjualan-' . Carbon::now()->format('Y-m-d') . '.pdf'
        // );
    }

    public function exportExcel()
    {
        // Implementasi export Excel akan saya buat di response berikutnya
        $this->dispatch('toast', type: 'info', message: 'Fitur export Excel sedang dalam development');
    }

    public function updatingPencarian()
    {
        $this->resetPage();
    }

    public function updatingKategoriTerpilih()
    {
        $this->resetPage();
    }

    public function updatingStatusTerpilih()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.laporan.laporan-penjualan');
    }
}