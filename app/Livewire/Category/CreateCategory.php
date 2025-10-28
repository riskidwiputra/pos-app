<?php

namespace App\Livewire\Category;

use App\Helpers\CodeGenerator;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Tambah Kategori')]
class CreateCategory extends Component
{
 
    
    #[Validate('required|string|max:255|unique:categories,nama_kategori')]
    public $nama_kategori = '';
    
    #[Validate('nullable|string')]
    public $deskripsi = '';

    public $message;

    protected $rules = [
        'nama_kategori' => 'required|string|max:255',
        'deskripsi' => 'string',
    ];


    protected $messages = [
        'nama_kategori.required' => 'Nama kategori wajib diisi',
        'nama_kategori.unique' => 'Nama kategori sudah digunakan',
    ];

    public function store()
    {
        $this->validate();

        $kode_kategori = CodeGenerator::generate(Category::class, 'kode_kategori', 2);

        Category::create([
            'kode_kategori' => $kode_kategori,
            'nama_kategori' => $this->nama_kategori,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message', 'Kategori berhasil ditambahkan!');
        return redirect()->route('category.index');
    }

    public function render()
    {
        return view('livewire.category.create-category');
    }
}
