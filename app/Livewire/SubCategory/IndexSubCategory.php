<?php

namespace App\Livewire\SubCategory;

use App\Models\SubCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('layouts.app')]
#[Title('Manajemen Sub Kategori')]
class IndexSubCategory extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $subCategoryId = null;
    public $message = '';

    protected $updatesQueryString = ['search', 'perPage'];
    protected $paginationTheme = 'tailwind';

    public function subCategories()
    {
        return SubCategory::with('category')->where(function($query) {
            $query->where('kode_subkategori', 'like', '%' . $this->search . '%')
                  ->orWhere('nama_subkategori', 'like', '%' . $this->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->perPage);
    }

    public function updatingSearch() 
    { 
        $this->resetPage(); 
    }

    public function updatingPerPage() 
    { 
        $this->resetPage(); 
    }

    public function confirmDelete($id)
    {
        $this->subCategoryId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->subCategoryId) {
            $subCategory = SubCategory::findOrFail($this->subCategoryId);
            

            $subCategory->delete();
            $this->message = 'Kategori berhasil dihapus!';
            $this->resetPage();
        }
        $this->closeDeleteModal();
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->subCategoryId = null;
    }


    public function render()
    {
        return view('livewire.sub-category.index-sub-category', [
            'subcategories' => $this->subCategories(),
        ]);
        return view('livewire.sub-category.index-sub-category');
    }
}
