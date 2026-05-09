<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

#[Layout('layouts.app')]
#[Title('Daftar Pembelian')]
class IndexPurchase extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $purchaseId = null;
    public $message = '';
    public $filterSupplier = '';
    public $filterStatusPembayaran = '';
    public $startDate = '';
    public $endDate = '';

    protected $updatesQueryString = ['search', 'perPage', 'filterSupplier', 'filterStatusPembayaran'];
    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->startDate = '';
        $this->endDate = '';
    }

    public function purchases()
    {
        return Purchase::with(['supplier', 'items.product'])
            ->where(function($query) {
                $query->where('purchase_code', 'like', '%' . $this->search . '%')
                      ->orWhere('nomor_invoice', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterSupplier, function($query) {
                $query->where('supplier_id', $this->filterSupplier);
            })
            ->when($this->filterStatusPembayaran, function($query) {
                $query->where('status_pembayaran', $this->filterStatusPembayaran);
            })
            ->when($this->startDate !== '' && $this->endDate !== '', function($query) {
                $query->whereBetween('tanggal_terima_barang', [$this->startDate, $this->endDate]);
            })
            ->latest('tanggal_terima_barang')
            ->paginate($this->perPage);
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }
    public function updatingFilterSupplier() { $this->resetPage(); }
    public function updatingFilterStatusPembayaran() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->purchaseId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->purchaseId) {
            $purchase = Purchase::findOrFail($this->purchaseId);
            
            // Kurangi stok kembali sebelum menghapus
            foreach ($purchase->items as $item) {
                $product = $item->product;
                $product->stok_tersedia -= $item->qty;
                $product->save();
            }
            
            $purchase->delete();
            $this->message = 'Pembelian berhasil dihapus dan stok telah disesuaikan!';
            $this->resetPage();
        }
        $this->closeDeleteModal();
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->purchaseId = null;
    }


    public function render()
    {
        return view('livewire.purchase.index-purchase', [
            'purchases' => $this->purchases(),
            'suppliers' => Supplier::all(),
            'totalBelumLunas' => Purchase::where('status_pembayaran', 'Belum Lunas')
                                        ->where('status', 'Aktif')
                                        ->sum('sisa_tagihan'),
        ]);
    }
}
