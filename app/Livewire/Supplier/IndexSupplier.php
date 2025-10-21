<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Manajemen Supplier')]
class IndexSupplier extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $supplierId = null;
    public $message = '';

    protected $updatesQueryString = ['search', 'perPage'];
    protected $paginationTheme = 'tailwind'; // Livewire pagination Tailwind

    // Ambil data supplier
    public function suppliers()
    {
        return Supplier::where(function($query) {
            $query->where('nama_supplier', 'like', '%' . $this->search . '%')
                  ->orWhere('no_telepon', 'like', '%' . $this->search . '%')
                  ->orWhere('alamat', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->perPage);
    }

    // Reset halaman saat search/perPage berubah
    public function updatingSearch() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }

    // Delete modal
    public function confirmDelete($id)
    {
        $this->supplierId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->supplierId) {
            Supplier::findOrFail($this->supplierId)->delete();
            $this->message = 'Supplier berhasil dihapus!';
            $this->resetPage();
        }
        $this->closeDeleteModal();
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->supplierId = null;
    }

    public function render()
    {
        return view('livewire.supplier.index-supplier', [
            'suppliers' => $this->suppliers(),
        ]);
    }
}
