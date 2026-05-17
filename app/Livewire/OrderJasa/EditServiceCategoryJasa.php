<?php

namespace App\Livewire\OrderJasa;

use App\Models\Product;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
#[Title('Edit Kategori Jasa')]
class EditServiceCategoryJasa extends Component
{
    use WithFileUploads;

    // ─── Record ──────────────────────────────────────────────────────────────────
    public ServiceCategory $category;

    // ─── Form Fields ─────────────────────────────────────────────────────────────
    public string  $nama_jasa        = '';
    public string  $deskripsi        = '';
    public int     $total_harga      = 0;
    public string  $keterangan_bahan = '';
    public bool    $is_active        = true;
    public         $gambar_contoh    = null;
    public ?string $gambar_existing  = null;

    // ─── BOM ─────────────────────────────────────────────────────────────────────
    public array $bom_items = [];
    // Setiap item: ['product_id' => '', 'quantity' => 1, 'keterangan' => '']

    // ─── Data Dropdown ───────────────────────────────────────────────────────────
    public $products;

    // ─── Mount ───────────────────────────────────────────────────────────────────
    public function mount(ServiceCategory $category)
    {
        $this->category = $category->load('products');

        // Isi form fields
        $this->nama_jasa        = $category->nama_jasa;
        $this->deskripsi        = $category->deskripsi ?? '';
        $this->total_harga      = $category->total_harga;
        $this->keterangan_bahan = $category->keterangan_bahan ?? '';
        $this->is_active        = $category->is_active;
        $this->gambar_existing  = $category->gambar_contoh;

        // Load BOM dari pivot
        $this->bom_items = $category->products->map(fn ($p) => [
            'product_id'  => (string) $p->id,
            'quantity'    => (int) $p->pivot->quantity,
        ])->toArray();

        // Load semua produk untuk dropdown
        $this->products = Product::orderBy('nama_produk')
            ->get();
    }

    // ─── BOM Methods ─────────────────────────────────────────────────────────────

    public function addBomItem()
    {
        $this->bom_items[] = [
            'product_id' => '',
            'quantity'   => 1,
        ];
    }

    public function removeBomItem(int $index)
    {
        unset($this->bom_items[$index]);
        $this->bom_items = array_values($this->bom_items);
    }

    // ─── Save ────────────────────────────────────────────────────────────────────

    public function save()
    {
        $this->validate([
            'nama_jasa'                       => 'required|string|max:150',
            'deskripsi'                       => 'nullable|string|max:500',
            'total_harga'                     => 'required|integer|min:0',
            'keterangan_bahan'                => 'nullable|string',
            'is_active'                       => 'boolean',
            'gambar_contoh'                   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bom_items'                       => 'array',
            'bom_items.*.product_id'          => 'required|exists:products,id',
            'bom_items.*.quantity'            => 'required|integer|min:1',
        ], [
            'nama_jasa.required'              => 'Nama jasa wajib diisi.',
            'total_harga.required'            => 'Total harga wajib diisi.',
            'total_harga.min'                 => 'Total harga tidak boleh negatif.',
            'gambar_contoh.image'             => 'File harus berupa gambar.',
            'gambar_contoh.max'               => 'Ukuran gambar maksimal 2MB.',
            'bom_items.*.product_id.required' => 'Pilih produk untuk setiap baris.',
            'bom_items.*.product_id.exists'   => 'Produk tidak valid.',
            'bom_items.*.quantity.min'        => 'Jumlah minimal 1.',
        ]);

        // Cek duplikat product_id di BOM
        $productIds = collect($this->bom_items)->pluck('product_id')->filter();
        if ($productIds->count() !== $productIds->unique()->count()) {
            $this->addError('bom_items', 'Terdapat produk yang sama, harap gabungkan kuantitasnya.');
            return;
        }

        try {
            $gambarPath = $this->gambar_existing;

            if ($this->gambar_contoh) {
                if ($this->gambar_existing) {
                    Storage::disk('public')->delete($this->gambar_existing);
                }
                $gambarPath = $this->gambar_contoh->store('service-categories', 'public');
            }

            $this->category->update([
                'nama_jasa'        => $this->nama_jasa,
                'deskripsi'        => $this->deskripsi ?: null,
                'total_harga'      => $this->total_harga,
                'keterangan_bahan' => $this->keterangan_bahan ?: null,
                'is_active'        => $this->is_active,
                'gambar_contoh'    => $gambarPath,
                'updated_by'       => Auth::id(),
            ]);

            // Sync BOM produk
            $syncData = [];
            foreach ($this->bom_items as $item) {
                if (!empty($item['product_id'])) {
                    $syncData[(int) $item['product_id']] = [
                        'quantity'   => (int) $item['quantity'],
                    ];
                }
            }
            $this->category->products()->sync($syncData);

            session()->flash('success', 'Kategori jasa berhasil diperbarui.');
            $this->redirect(route('order-jasa.setting-kategori'), navigate: true);

        } catch (\Throwable $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function removeGambar()
    {
        if ($this->gambar_existing) {
            Storage::disk('public')->delete($this->gambar_existing);
            $this->category->update(['gambar_contoh' => null]);
            $this->gambar_existing = null;
        }
    }

    public function render()
    {
        return view('livewire.order-jasa.edit-service-category-jasa');
    }
}