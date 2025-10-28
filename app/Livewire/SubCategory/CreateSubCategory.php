<?php

namespace App\Livewire\SubCategory;

use App\Helpers\CodeGenerator;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Tambah Sub Kategori')]
class CreateSubCategory extends Component
{
    public $kode_subkategori = '';
    
    #[Validate('required|string|max:255|unique:sub_categories,nama_subkategori')]
    public $nama_subkategori = '';
    
    #[Validate('nullable|string')]
    public $deskripsi = '';

    #[Validate('required|string|max:255')]
    public $category_id;

    public $message;
    

    protected $messages = [
        'category_id.required' => 'kategori wajib diisi',
        'nama_subkategori.required' => 'Nama sub kategori wajib diisi',
        'nama_subkategori.unique' => 'Nama sub kategori sudah digunakan',
    ];

    public function store()
    {
        $this->validate();
        
        $kode_subkategori = CodeGenerator::generate(SubCategory::class, 'kode_subkategori', 2);

        SubCategory::create([
            'kode_subkategori' => $kode_subkategori,
            'category_id' => $this->category_id,
            'nama_subkategori' => $this->nama_subkategori,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message', 'sub Kategori berhasil ditambahkan!');
        return redirect()->route('subcategory.index');
    }


    public function render()
    {
         return view('livewire.sub-category.create-sub-category', [
            'categories' => Category::all(),
        ]);
    }
}
