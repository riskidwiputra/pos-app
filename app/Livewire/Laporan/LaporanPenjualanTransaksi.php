<?php

namespace App\Livewire\Laporan;

use App\Models\Product;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
#[Title('Laporan Penjualan - Per Transaksi')]
class LaporanPenjualanTransaksi extends Component
{
    use WithPagination;

    public $tanggalMulai;
    public $tanggalSelesai;
    public $pencarian = '';
    public $statusFilter = '';
    public $perPage = 15;

    protected $queryString = [
        'tanggalMulai',
        'tanggalSelesai',
        'pencarian',
        'statusFilter'
    ];

    public function mount()
    {
        $this->tanggalMulai = '';
        $this->tanggalSelesai = '';
    }

    #[Computed]
    public function laporanTransaksi()
    {
        return Sale::with(['users', 'items.product'])
            ->when($this->tanggalMulai !== '' && $this->tanggalSelesai !== '', function($query) {
                $query->whereBetween('transaction_date', [$this->tanggalMulai, $this->tanggalSelesai]);
            })->when($this->pencarian, function($query) {
                $query->where(function($q) {
                    $q->where('invoice_number', 'like', '%' . $this->pencarian . '%')
                      ->orWhereHas('users', function($cq) {
                          $cq->where('name', 'like', '%' . $this->pencarian . '%');
                      });
                });
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->latest('transaction_date')
            ->paginate($this->perPage);
    }

    #[Computed]
    public function ringkasanTransaksi()
    {
        $sales = Sale::when($this->tanggalMulai !== '' && $this->tanggalSelesai !== '', function($query) {
                $query->whereBetween('transaction_date', [$this->tanggalMulai, $this->tanggalSelesai]);
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            });

        $totalKeuntungan = 0;
        $totalItemTerjual = 0;
        
        foreach($sales->get() as $sale) {
            foreach($sale->items as $item) {
          
                $keuntungan = ($item->price - $item->price_purchase) * $item->quantity;
                $totalKeuntungan += $keuntungan;
                $totalItemTerjual += $item->quantity;
            }
        }

        return [
            'total_transaksi' => $sales->count(),
            'total_pendapatan' => $sales->sum('total'),
            'total_keuntungan' => $totalKeuntungan,
            'total_item_terjual' => $totalItemTerjual,
        ];
    }


    public function hitungKeuntungan($sale)
    {
        $totalKeuntungan = 0;
        
        foreach($sale->items as $item) {
            $keuntungan = ($item->price - $item->price_purchase) * $item->quantity;
            $totalKeuntungan += $keuntungan;
        }
        
        return $totalKeuntungan;
    }

    public function resetFilter()
    {
        $this->tanggalMulai = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->tanggalSelesai = Carbon::now()->format('Y-m-d');
        $this->pencarian = '';
        $this->statusFilter = '';
        $this->resetPage();
    }

    public function updatingPencarian()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
    public function exportPDF()
    {
        $sales = Sale::with(['users', 'items.product'])
            ->when($this->tanggalMulai !== '' && $this->tanggalSelesai !== '', function($query) {
                $query->whereBetween('transaction_date', [$this->tanggalMulai, $this->tanggalSelesai]);
            })
            ->when($this->pencarian, function($query) {
                $query->where(function($q) {
                    $q->where('invoice_number', 'like', '%' . $this->pencarian . '%')
                      ->orWhereHas('users', function($cq) {
                          $cq->where('name', 'like', '%' . $this->pencarian . '%');
                      });
                });
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->latest('transaction_date')
            ->get();

        $ringkasan = $this->ringkasanTransaksi();

        $filters = [
            'tanggal_mulai' => Carbon::parse($this->tanggalMulai)->format('d F Y'),
            'tanggal_selesai' => Carbon::parse($this->tanggalSelesai)->format('d F Y'),
            'status' => $this->statusFilter ?: 'Semua Status',
            'pencarian' => $this->pencarian ?: '-',
        ];

        $pdf = Pdf::loadView('livewire.print.laporan-penjualan-transaksi', [
            'sales' => $sales,
            'ringkasan' => $ringkasan,
            'filters' => $filters,
            'component' => $this, // Pass component untuk akses method hitungKeuntungan
        ]);

        $pdf->setPaper('a4', 'landscape'); // Landscape karena banyak kolom

        $filename = 'Laporan-Penjualan-' . date('Y-m-d-His') . '.pdf';

        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    public function render()
    {
        return view('livewire.laporan.laporan-penjualan-transaksi');
    }
}