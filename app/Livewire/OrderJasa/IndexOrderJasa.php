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
#[Title('Kelola Order Jasa')]
class IndexOrderJasa extends Component
{
    use WithPagination;

    public $pencarian = '';
    public $statusFilter = '';
    public $perPage = 10;

    // Delete Modal
    public $showDeleteModal = false;
    public $orderToDelete = null;

    // Approve/Reject Modal
    public $showApproveModal = false;
    public $showRejectModal = false;
    public $orderToProcess = null;
    public $rejectionReason = '';

    protected $queryString = [
        'pencarian',
        'statusFilter'
    ];

    protected $listeners = ['refreshOrders' => '$refresh'];

    #[Computed]
    public function orders()
    {
        return ServiceOrder::with(['user', 'category', 'subCategory', 'approver'])
            ->when($this->pencarian, function($query) {
                $query->where(function($q) {
                    $q->where('order_code', 'like', '%' . $this->pencarian . '%')
                      ->orWhere('customer_name', 'like', '%' . $this->pencarian . '%')
                      ->orWhere('order_title', 'like', '%' . $this->pencarian . '%');
                });
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->latest()
            ->paginate($this->perPage);
    }

    #[Computed]
    public function statistik()
    {
        return [
            'total' => ServiceOrder::all()->count(),
            'pending' => ServiceOrder::pending()->count(),
            'approved' => ServiceOrder::approved()->count(),
            'rejected' => ServiceOrder::rejected()->count(),
            'in_progress' => ServiceOrder::inProgress()->count(),
            'completed' => ServiceOrder::completed()->count(),
        ];
    }

    public function confirmDelete($orderId)
    {
        $this->orderToDelete = ServiceOrder::find($orderId);
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->orderToDelete) {
            // Delete file jika ada
            // if ($this->orderToDelete->design_file) {
            //     \Storage::disk('public')->delete($this->orderToDelete->design_file);
            // }

            $this->orderToDelete->delete();
            
            $this->showDeleteModal = false;
            $this->orderToDelete = null;
            
            session()->flash('success', 'Order jasa berhasil dihapus');
        }
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->orderToDelete = null;
    }

    public function confirmApprove($orderId)
    {
        $this->orderToProcess = ServiceOrder::find($orderId);
        
        if ($this->orderToProcess && $this->orderToProcess->canBeApproved()) {
            $this->showApproveModal = true;
        } else {
            session()->flash('error', 'Order tidak dapat disetujui');
        }
    }

    public function approve()
    {
        if ($this->orderToProcess && $this->orderToProcess->canBeApproved()) {
            $this->orderToProcess->update([
                'status' => 'approved',
                'approved_by' => Auth::id(),
                'approved_at' => now(),
            ]);
            
            $this->showApproveModal = false;
            $this->orderToProcess = null;
            
            session()->flash('success', 'Order jasa berhasil disetujui');
            $this->dispatch('refreshOrders');
        }
    }

    public function closeApproveModal()
    {
        $this->showApproveModal = false;
        $this->orderToProcess = null;
    }

    public function confirmReject($orderId)
    {
        $this->orderToProcess = ServiceOrder::find($orderId);
        
        if ($this->orderToProcess && $this->orderToProcess->canBeRejected()) {
            $this->showRejectModal = true;
        } else {
            session()->flash('error', 'Order tidak dapat ditolak');
        }
    }

    public function reject()
    {
        $this->validate([
            'rejectionReason' => 'required|min:10',
        ], [
            'rejectionReason.required' => 'Alasan penolakan wajib diisi',
            'rejectionReason.min' => 'Alasan penolakan minimal 10 karakter',
        ]);

        if ($this->orderToProcess && $this->orderToProcess->canBeRejected()) {
            $this->orderToProcess->update([
                'status' => 'rejected',
                'rejection_reason' => $this->rejectionReason,
                'approved_by' => Auth::id(),
                'approved_at' => now(),
            ]);
            
            $this->showRejectModal = false;
            $this->orderToProcess = null;
            $this->rejectionReason = '';
            
            session()->flash('success', 'Order jasa berhasil ditolak');
            $this->dispatch('refreshOrders');
        }
    }

    public function closeRejectModal()
    {
        $this->showRejectModal = false;
        $this->orderToProcess = null;
        $this->rejectionReason = '';
    }

    public function updateStatus($orderId, $newStatus)
    {
        $order = ServiceOrder::find($orderId);
        
        if ($order) {
            $order->update(['status' => $newStatus]);
            
            if ($newStatus === 'completed') {
                $order->update(['actual_completion_date' => now()]);
            }
            
            session()->flash('success', 'Status order berhasil diperbarui');
        }
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
        return view('livewire.order-jasa.index-order-jasa');
    }
}