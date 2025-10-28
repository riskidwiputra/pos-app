<?php

namespace App\Livewire\Unit;

use App\Models\Unit;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Manajemen Unit')]
class IndexUnit extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $unitId = null;
    public $message = '';

    protected $updatesQueryString = ['search', 'perPage'];
    protected $paginationTheme = 'tailwind'; 

    public function units()
    {
        return Unit::where(function($query) {
            $query->where('nama_unit', 'like', '%' . $this->search . '%')
                  ->orWhere('singkatan', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->perPage);
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }
   
    public function confirmDelete($id)
    {
        $this->unitId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->unitId) {
            Unit::findOrFail($this->unitId)->delete();
            $this->message = 'Unit berhasil dihapus!';
            $this->resetPage();
        }
        $this->closeDeleteModal();
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->unitId = null;
    }

    public function render()
    {
        return view('livewire.unit.index-unit', [
            'units' => $this->units(),
        ]);

    }
}
