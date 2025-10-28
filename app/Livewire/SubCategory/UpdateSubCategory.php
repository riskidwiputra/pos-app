<?php

namespace App\Livewire\SubCategory;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Edit Sub Kategori')]
class UpdateSubCategory extends Component
{

    public SubCategory $subcategory;
    public $subcategory_id;
    public $category_id;
    public $kode_subkategori = '';
    public $nama_subkategori = '';
    public $deskripsi = '';
    public $nama_kategory = '';


    protected function rules()
    {
        return [
            'nama_subkategori' => 'required|string|max:255|unique:sub_categories,nama_subkategori,' . $this->subcategory_id,
            'deskripsi' => 'nullable|string',
        ];
    }

    protected $messages = [
        'nama_subkategori.required' => 'Nama kategori wajib diisi',
        'nama_subkategori.unique' => 'Nama kategori sudah digunakan',
    ];

    public function mount($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $this->subcategory = $subcategory;
        $this->kode_subkategori = $subcategory->kode_subkategori;
        $this->nama_subkategori = $subcategory->nama_subkategori;
        $this->category_id = $subcategory->category_id;
        $this->deskripsi = $subcategory->deskripsi;
        $this->nama_kategory = $subcategory->category->nama_kategori;
    }

    public function update()
    {
        
        $this->validate();
        $this->subcategory->update([
            'category_id' => $this->category_id,
            'nama_subkategori' => $this->nama_subkategori,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message', 'Sub Kategori berhasil diupdate!');
        return redirect()->route('subcategory.index');
    }


    public function render()
    {
        return view('livewire.sub-category.update-sub-category',[
             'categories' => Category::all(),
        ]);
    }
}
