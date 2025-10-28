<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Unit;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
#[Title('Edit Produk')]
class UpdateProduct extends Component
{
    use WithFileUploads;

    public Product $product;
    public $category_id = '';
    public $sub_category_id = '';
    public $unit_id = '';
    public $kode_produk = '';
    public $nama_produk = '';
    public $deskripsi = '';
    public $harga_jual = '';
    public $stok_tersedia = '';
    public $stok_minimum = '';
    public $gambar_barang;
    public $existing_image;
    public $status_product = '';
    public $subCategories = [];

    protected $rules = [
        'category_id' => 'required|exists:categories,id',
        'sub_category_id' => 'required|exists:sub_categories,id',
        'unit_id' => 'required|exists:units,id',
        'nama_produk' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'harga_jual' => 'required|numeric|min:0',
        'stok_tersedia' => 'required|integer|min:0',
        'stok_minimum' => 'required|integer|min:0',
        'gambar_barang' => 'nullable|image|max:2048',
        'status_product' => 'required|in:Tersedia,Tidak Tersedia',
    ];

    protected $messages = [
        'category_id.required' => 'Kategori wajib dipilih',
        'sub_category_id.required' => 'Sub kategori wajib dipilih',
        'unit_id.required' => 'Unit wajib dipilih',
        'harga_jual.required' => 'Harga jual wajib diisi',
        'stok_tersedia.required' => 'Stok tersedia wajib diisi',
        'stok_minimum.required' => 'Stok minimum wajib diisi',
        'gambar_barang.image' => 'File harus berupa gambar',
        'gambar_barang.max' => 'Ukuran gambar maksimal 2MB',
    ];

    public function mount($id)
    {
        $product = Product::findOrFail($id);
        $this->product = $product;
        $this->category_id = $product->category_id;
        $this->sub_category_id = $product->sub_category_id;
        $this->unit_id = $product->unit_id;
        $this->kode_produk = $product->kode_produk;
        $this->nama_produk = $product->nama_produk;
        $this->deskripsi = $product->deskripsi;
        $this->harga_jual = $product->harga_jual;
        $this->stok_tersedia = $product->stok_tersedia;
        $this->stok_minimum = $product->stok_minimum;
        $this->existing_image = $product->gambar_barang;
        $this->status_product = $product->status_product;
        
        $this->subCategories = SubCategory::where('category_id', $this->category_id)->get();
    }

    public function updatedCategoryId($value)
    {
        $this->subCategories = SubCategory::where('category_id', $value)->get();
        $this->sub_category_id = '';
    }

    public function deleteImage()
    {
        if ($this->existing_image && Storage::disk('public')->exists($this->existing_image)) {
            Storage::disk('public')->delete($this->existing_image);
        }
        
        $this->product->update(['gambar_barang' => null]);
        $this->existing_image = null;
        session()->flash('message', 'Gambar berhasil dihapus!');
    }

    public function update()
    {
        $this->validate();

        $imagePath = $this->existing_image;
        
        if ($this->gambar_barang) {
            // Delete old image
            if ($this->existing_image && Storage::disk('public')->exists($this->existing_image)) {
                Storage::disk('public')->delete($this->existing_image);
            }
            
            $imagePath = $this->gambar_barang->store('products', 'public');
        }

        $this->product->update([
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'unit_id' => $this->unit_id,
            'kode_produk' => $this->kode_produk,
            'nama_produk' => $this->nama_produk,
            'deskripsi' => $this->deskripsi,
            'harga_jual' => $this->harga_jual,
            'stok_tersedia' => $this->stok_tersedia,
            'stok_minimum' => $this->stok_minimum,
            'gambar_barang' => $imagePath,
            'status_product' => $this->status_product,
        ]);

        session()->flash('message', 'Data produk berhasil diupdate!');
        return redirect()->route('product.index');
    }

    public function render()
    {
        return view('livewire.product.update-product', [
            'categories' => Category::all(),
            'units' => Unit::all(),
        ]);
    }
}