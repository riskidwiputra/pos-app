<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Edit Kategori')]
class UpdateCategory extends Component
{
    public Category $category;
    public $category_id;
    public $kode_kategori = '';
    public $nama_kategori = '';
    public $deskripsi = '';

    protected function rules()
    {
        return [
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori,' . $this->category_id,
            'deskripsi' => 'nullable|string',
        ];
    }

    protected $messages = [
        'nama_kategori.required' => 'Nama kategori wajib diisi',
        'nama_kategori.unique' => 'Nama kategori sudah digunakan',
    ];

    public function mount($id)
    {
        $category = Category::findOrFail($id);
        $this->category = $category;
        $this->kode_kategori = $category->kode_kategori;
        $this->nama_kategori = $category->nama_kategori;
        $this->deskripsi = $category->deskripsi;
    }

    public function update()
    {
        
        $this->validate();
        $this->category->update([
            'nama_kategori' => $this->nama_kategori,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message', 'Kategori berhasil diupdate!');
        return redirect()->route('category.index');
    }

    public function render()
    {
        return view('livewire.category.update-category');
    }
}