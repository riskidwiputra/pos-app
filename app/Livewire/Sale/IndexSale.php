<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
#[Title('Manajemen Penjualan')]
class IndexSale extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $saleId = null;
    public $message = '';
    public $filterStatus = '';
    public $startDate = '';
    public $endDate = '';

    protected $updatesQueryString = ['search', 'perPage', 'filterStatus'];
    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
    }

    public function sales()
    {
        return Sale::where(function($query) {
                $query->where('invoice_number', 'like', '%' . $this->search . '%');
            })->when($this->filterStatus, function($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->startDate && $this->endDate, function($query) {
                $query->whereBetween('transaction_date', [$this->startDate, $this->endDate]);
            })
            ->latest('transaction_date')
            ->paginate($this->perPage);
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }
    public function updatingFilterStatus() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->saleId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->saleId) {
            DB::beginTransaction();
            
            try {
                $sale = Sale::findOrFail($this->saleId);
                
                // Kembalikan stok produk
                foreach ($sale->items as $item) {
                    $product = $item->product;
                    $product->stok_tersedia += $item->quantity;
                    $product->save();
                }
                // delete produk item 
                $sale->items()->delete();
                
                $sale->delete();
                
                DB::commit();
                
                $this->message = 'Penjualan berhasil dihapus dan stok telah dikembalikan!';
                $this->resetPage();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->message = 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }
        $this->closeDeleteModal();
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->saleId = null;
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterStatus = '';
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.sale.index-sale', [
            'sales' => $this->sales(),
            // 'totalPenjualanHariIni' => Sale::whereDate('transaction_date', Carbon::today())
            //                               ->where('status', 'Lunas')
            //                               ->sum('total'),
        ]);
    }
}