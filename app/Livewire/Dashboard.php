<?php

namespace App\Livewire;

use App\Models\Sale;
use App\Models\Product;
use App\Models\ServiceOrder;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public $periode = 'hari_ini'; // hari_ini, minggu_ini, bulan_ini, tahun_ini

    #[Computed]
    public function dateRange()
    {
        return match($this->periode) {
            'hari_ini' => [now()->startOfDay(), now()->endOfDay()],
            'minggu_ini' => [now()->startOfWeek(), now()->endOfWeek()],
            'bulan_ini' => [now()->startOfMonth(), now()->endOfMonth()],
            'tahun_ini' => [now()->startOfYear(), now()->endOfYear()],
            'semua' => [null, null],
            default => [now()->startOfDay(), now()->endOfDay()],
        };
    }

    #[Computed]
    public function summaryPenjualan()
    {
        [$start, $end] = $this->dateRange();

        $query = Sale::with('items');
        if ($start && $end) {
            $query->whereBetween('transaction_date', [$start, $end]);
        }
        $sales = $query->get();
        $totalPenjualan = $sales->sum('total');
        $totalTransaksi = $sales->count();
        $totalLunas = $sales->where('status', 'lunas')->sum('total');
        
        // Hitung keuntungan
        $keuntungan = 0;
        foreach($sales as $sale) {
            foreach($sale->items as $item) {
                $profit = ($item->price - ($item->price_purchase ?? 0)) * $item->quantity;
                $keuntungan += $profit;
            }
        }

        return [
            'total_penjualan' => $totalPenjualan,
            'total_transaksi' => $totalTransaksi,
            'total_lunas' => $totalLunas,
            'keuntungan' => $keuntungan,
        ];
    }

    #[Computed]
    public function summaryStok()
    {
        return [
            'total_produk' => Product::count(),
            'produk_tersedia' => Product::where('status_product', 'Tersedia')->count(),
            'stok_menipis' => Product::where('stok_tersedia', '<=', 10)->where('stok_tersedia', '>', 0)->count(),
            'stok_habis' => Product::where('stok_tersedia', 0)->count(),
        ];
    }

    

    #[Computed]
    public function summaryUser()
    {
        return [
            'total_customer' => User::where('role', 3)->count(),
            'total_karyawan' => Employee::count(),
            'total_admin' => User::where('role', 2)->count(),
        ];
    }

    #[Computed]
    public function grafikPenjualanMingguan()
    {
        $data = Sale::where('transaction_date', '>=', now()->subDays(7))
            ->where('status', 'lunas')
            ->selectRaw('DATE(transaction_date) as tanggal, SUM(total) as total_harian, COUNT(*) as jumlah')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return [
            'labels' => $data->pluck('tanggal')->map(fn($d) => Carbon::parse($d)->format('d M'))->toArray(),
            'values' => $data->pluck('total_harian')->toArray(),
            'counts' => $data->pluck('jumlah')->toArray(),
        ];
    }

    #[Computed]
    public function grafikPenjualanBulanan()
    {
        $data = Sale::where('transaction_date', '>=', now()->startOfYear())
            ->where('status', 'lunas')
            ->selectRaw('MONTH(transaction_date) as bulan, SUM(total) as total_bulanan')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Oct', 'Nov', 'Des'];
        $values = array_fill(0, 12, 0);

        foreach($data as $item) {
            $values[$item->bulan - 1] = $item->total_bulanan;
        }

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    #[Computed]
    public function produkTerlaris()
    {
        return DB::table('sale_items')
            ->select('product_name', DB::raw('SUM(quantity) as total_terjual'), DB::raw('SUM(subtotal) as total_pendapatan'))
            ->groupBy('product_name')
            ->orderBy('total_terjual', 'desc')
            ->limit(5)
            ->get();
    }

    #[Computed]
    public function transaksiTerbaru()
    {
        return Sale::with(['customer'])
            ->latest('transaction_date')
            ->limit(5)
            ->get();
    }

    #[Computed]
    public function stokMenipis()
    {
        return Product::with('category')
            ->where('stok_tersedia', '<=', 10)
            ->where('stok_tersedia', '>', 0)
            ->orderBy('stok_tersedia', 'asc')
            ->limit(5)
            ->get();
    }

    #[Computed]
    public function orderJasaTerbaru()
    {
        return ServiceOrder::with(['category'])
            ->latest('created_at')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}