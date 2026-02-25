<?php

namespace App\Livewire\OrderJasa;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
#[Title('Setting Kategori Order Jasa')]
class SettingKategoriOrder extends Component
{
    public $category_id = '';
     public Category $kategori;
    protected $rules = [
        'category_id' => 'required|exists:categories,id',
    ];

    protected $messages = [
        'category_id.required' => 'Kategori wajib dipilih',
        'category_id.exists' => 'Kategori tidak valid',
    ];

    public function mount()
    {
       $this->category_id = Category::where('is_service', true)->first()?->id ?? '';
    }

    #[Computed]
    public function categories()
    {
        return Category::orderBy('nama_kategori')
            ->get();
    }
    
    public function update()
    {
        try {
            $this->validate();

            Category::where('is_service', true)->update(['is_service' => false]);
            Category::where('id', $this->category_id)->update(['is_service' => true]);

            session()->flash('success', 'Setting kategori order jasa berhasil disimpan');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.order-jasa.setting-kategori-order');
    }
}