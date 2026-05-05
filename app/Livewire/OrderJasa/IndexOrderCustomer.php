<?php

namespace App\Livewire\OrderJasa;

use App\Models\ServiceOrder;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
#[Title('Riwayat Pesanan Jasa')]
class IndexOrderCustomer     extends Component
{
    use WithPagination;

    public $pencarian = '';
    public $statusFilter = '';
    public $perPage = 10;



    protected $queryString = [
        'pencarian',
        'statusFilter'
    ];

    protected $listeners = ['refreshOrders' => '$refresh'];

    #[Computed]
    public function orders()
    {
        $userId = Auth::id();
       
        return ServiceOrder::with(['user'])
            ->when($this->pencarian, function($query) {
                $query->where(function($q) {
                    $q->where('order_code', 'like', '%' . $this->pencarian . '%')
                      ->orWhere('order_title', 'like', '%' . $this->pencarian . '%');
                });
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->where('user_id', $userId)
            ->latest()
            ->paginate($this->perPage);
    }

    #[Computed]
    public function statistik()
    {
         $userId = Auth::id();
        return [
            'total' => ServiceOrder::where('user_id', $userId)->all()->count(),
            'pending' => ServiceOrder::where('user_id', $userId)->pending()->count(),
            'approved' => ServiceOrder::where('user_id', $userId)->approved()->count(),
            'rejected' => ServiceOrder::where('user_id', $userId)->rejected()->count(),
            'in_progress' => ServiceOrder::where('user_id', $userId)->inProgress()->count(),
            'completed' => ServiceOrder::where('user_id', $userId)->completed()->count(),
        ];
    }


    public function resetFilter()
    {
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

    public function render()
    {
        return view('livewire.order-jasa.index-customer-order-jasa');
    }
}