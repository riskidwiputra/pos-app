<?php

namespace App\Livewire\OrderJasa;

use App\Models\ServiceOrder;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
#[Title('Detail Order Jasa')]
class DetailOrderJasa extends Component
{
    public ServiceOrder $order;

    // ─── Modal state ─────────────────────────────────────────────────────────────
    public bool   $showApproveModal  = false;
    public bool   $showRejectModal   = false;
    public bool   $showDeleteModal   = false;
    public bool   $showProgressModal = false;
    public string $rejectionReason   = '';

    // ─── Lifecycle ───────────────────────────────────────────────────────────────

    public function mount($id)
    {
        $this->order = ServiceOrder::findOrFail($id);
    }

    // ─── Approve ─────────────────────────────────────────────────────────────────

    public function approve()
    {
        if (! $this->order->canBeApproved()) {
            session()->flash('error', 'Order tidak dapat disetujui.');
            return;
        }

        $this->order->update([
            'status'      => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        $this->order->refresh()->load(['category', 'user', 'approver']);
        $this->showApproveModal = false;
        session()->flash('success', 'Order jasa berhasil disetujui.');
    }

    // ─── Reject ──────────────────────────────────────────────────────────────────

    public function reject()
    {
        $this->validate([
            'rejectionReason' => 'required|min:10',
        ], [
            'rejectionReason.required' => 'Alasan penolakan wajib diisi.',
            'rejectionReason.min'      => 'Alasan penolakan minimal 10 karakter.',
        ]);

        if (! $this->order->canBeRejected()) {
            session()->flash('error', 'Order tidak dapat ditolak.');
            return;
        }

        $this->order->update([
            'status'           => 'rejected',
            'rejection_reason' => $this->rejectionReason,
            'approved_by'      => Auth::id(),
            'approved_at'      => now(),
        ]);

        $this->order->refresh()->load(['category', 'user', 'approver']);
        $this->showRejectModal = false;
        $this->rejectionReason = '';
        session()->flash('success', 'Order jasa berhasil ditolak.');
    }

    // ─── Update Status Cepat ─────────────────────────────────────────────────────

    public function updateStatus(string $status)
    {
        $allowed = ['pending', 'approved', 'in_progress', 'completed', 'cancelled'];
        if (! in_array($status, $allowed)) return;

        $data = ['status' => $status];

        if ($status === 'completed') {
            $data['actual_completion_date'] = now();
        }
        if (in_array($status, ['approved', 'rejected'])) {
            $data['approved_by'] = Auth::id();
            $data['approved_at'] = now();
        }

        $this->order->update($data);
        $this->order->refresh()->load(['category', 'user', 'approver']);
        $this->showProgressModal = false;
        session()->flash('success', 'Status order berhasil diperbarui.');
    }

    // ─── Delete ──────────────────────────────────────────────────────────────────

    public function delete()
    {
        if ($this->order->design_file) {
            Storage::disk('public')->delete($this->order->design_file);
        }

        $this->order->delete();
        session()->flash('success', 'Order jasa berhasil dihapus.');
        return redirect()->route('order-jasa.index');
    }

    // ─── Modal helpers ────────────────────────────────────────────────────────────

    public function closeApproveModal()  { $this->showApproveModal  = false; }
    public function closeRejectModal()   { $this->showRejectModal   = false; $this->rejectionReason = ''; }
    public function closeDeleteModal()   { $this->showDeleteModal   = false; }
    public function closeProgressModal() { $this->showProgressModal = false; }

    public function render()
    {
        return view('livewire.order-jasa.detail-order-jasa');
    }
}