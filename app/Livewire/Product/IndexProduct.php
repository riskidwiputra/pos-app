<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Manajemen Produk')]
class IndexProduct extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $productId = null;
    public $message = '';
    public $filterCategory = '';
    public $filterStatus = '';
    public $showLowStock = false;

    protected $updatesQueryString = ['search', 'perPage', 'filterCategory', 'filterStatus', 'showLowStock'];
    protected $paginationTheme = 'tailwind';

    public function products()
    {
        return Product::with(['category', 'subCategory', 'unit'])
            ->where(function($query) {
                $query->where('nama_produk', 'like', '%' . $this->search . '%')
                      ->orWhere('kode_produk', 'like', '%' . $this->search . '%')
                      ->orWhere('barcode_product', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterCategory, function($query) {
                $query->where('category_id', $this->filterCategory);
            })
            ->when($this->filterStatus, function($query) {
                $query->where('status_product', $this->filterStatus);
            })
            ->when($this->showLowStock, function($query) {
                $query->lowStock();
            })
            ->latest()
            ->paginate($this->perPage);
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }
    public function updatingFilterCategory() { $this->resetPage(); }
    public function updatingFilterStatus() { $this->resetPage(); }
    public function updatingShowLowStock() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->productId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->productId) {
            $product = Product::findOrFail($this->productId);
            
            if ($product->gambar_barang && file_exists(storage_path('app/public/' . $product->gambar_barang))) {
                unlink(storage_path('app/public/' . $product->gambar_barang));
            }
            
            $product->delete();
            $this->message = 'Produk berhasil dihapus!';
            $this->resetPage();
        }
        $this->closeDeleteModal();
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->productId = null;
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterCategory = '';
        $this->filterStatus = '';
        $this->showLowStock = false;
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.product.index-product', [
            'products' => $this->products(),
            'categories' => Category::all(),
            'lowStockCount' => Product::lowStock()->count(),
        ]);
    }
}