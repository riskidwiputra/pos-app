<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Manajemen Kategori')]
class IndexCategory extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $categoryId = null;
    public $message = '';

    protected $updatesQueryString = ['search', 'perPage'];
    protected $paginationTheme = 'tailwind';

    public function categories()
    {
        return Category::where(function($query) {
            $query->where('kode_kategori', 'like', '%' . $this->search . '%')
                  ->orWhere('nama_kategori', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->perPage);
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }


    public function confirmDelete($id)
    {
        $this->categoryId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->categoryId) {
            $category = Category::findOrFail($this->categoryId);
            
            if ($category->subCategories()->count() > 0) {
                $this->message = 'Kategori tidak dapat dihapus karena masih memiliki sub kategori!';
                $this->closeDeleteModal();
                return;
            }

            $category->delete();
            $this->message = 'Kategori berhasil dihapus!';
            $this->resetPage();
        }
        $this->closeDeleteModal();
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->categoryId = null;
    }

    public function render()
    {
        return view('livewire.category.index-category', [
            'categories' => $this->categories(),
        ]);
    }
}