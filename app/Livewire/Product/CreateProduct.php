<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Unit;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
#[Title('Tambah Produk')]
class CreateProduct extends Component
{
    use WithFileUploads;

    #[Validate('required|exists:categories,id')]
    public $category_id = '';
    
    #[Validate('required|exists:sub_categories,id')]
    public $sub_category_id = '';
    
    #[Validate('required|exists:units,id')]
    public $unit_id = '';
    
    public $kode_produk = '';
    
    #[Validate('required|string|max:255')]
    public $nama_produk = '';
    
    #[Validate('nullable|string')]
    public $deskripsi = '';
    
    #[Validate('required|numeric|min:0')]
    public $harga_jual = '';
    
    #[Validate('required|integer|min:0')]
    public $stok_tersedia = '';
    
    #[Validate('required|integer|min:0')]
    public $stok_minimum = '';
    
    #[Validate('nullable|image|max:2048')]
    public $gambar_barang;
    
    #[Validate('required|in:Tersedia,Tidak-Tersedia')]
    public $status_product = 'Tersedia';

    public $subCategories = [];
    public $message;

    protected $messages = [
        'category_id.required' => 'Kategori wajib dipilih',
        'sub_category_id.required' => 'Sub kategori wajib dipilih',
        'unit_id.required' => 'Unit wajib dipilih',
        'nama_produk.required' => 'Nama produk wajib diisi',
        'harga_jual.required' => 'Harga jual wajib diisi',
        'harga_jual.numeric' => 'Harga jual harus berupa angka',
        'stok_tersedia.required' => 'Stok tersedia wajib diisi',
        'stok_minimum.required' => 'Stok minimum wajib diisi',
        'gambar_barang.image' => 'File harus berupa gambar',
        'gambar_barang.max' => 'Ukuran gambar maksimal 2MB',
        'status_product.required' => 'Status produk wajib dipilih',
    ];

    public function mount()
    {
        $this->generateKodeProduk();
    }

    public function updatedCategoryId($value)
    {
        $this->subCategories = SubCategory::where('category_id', $value)->get();
        $this->sub_category_id = '';
    }

    public function generateKodeProduk()
    {
        $this->kode_produk = strtoupper(Str::random(6));
    }

    public function store()
    {
        $this->validate();

        $imagePath = null;
        if ($this->gambar_barang) {
            $imagePath = $this->gambar_barang->store('products', 'public');
        }
        $kode_category = Category::find($this->category_id)->kode_kategori;
        $kode_sub_category = SubCategory::find($this->sub_category_id)->kode_sub_kategori;
        $kode_unit = Unit::find($this->unit_id)->kode_unit;
        $barcode = $kode_category . $kode_sub_category . $kode_unit . $this->kode_produk;

        Product::create([
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
            'barcode_product' => $barcode,
            'status_product' => $this->status_product,
        ]);

        session()->flash('message', 'Produk berhasil ditambahkan dengan barcode otomatis!');
        return redirect()->route('product.index');
    }

    public function render()
    {
        return view('livewire.product.create-product', [
            'categories' => Category::all(),
            'units' => Unit::all(),
        ]);
    }
}