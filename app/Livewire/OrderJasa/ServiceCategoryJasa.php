<?php

namespace App\Livewire\OrderJasa;

use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
#[Title('Setting Kategori Jasa')]
class ServiceCategoryJasa extends Component
{
    use WithPagination, WithFileUploads;

    // ─── Filter & Search ────────────────────────────────────────────────────────
    public string $pencarian    = '';
    public string $filterStatus = '';
    public int    $perPage      = 10;

    // ─── Modal State ────────────────────────────────────────────────────────────
    public bool $showFormModal   = false;
    public bool $showDetailModal = false;
    public bool $showDeleteModal = false;
    public bool $isEditMode      = false;

    // ─── Selected Record ────────────────────────────────────────────────────────
    public ?int $selectedId  = null;
    public ?ServiceCategory $selectedRecord = null;

    // ─── Form Fields ────────────────────────────────────────────────────────────
    public string  $nama_jasa              = '';
    public string  $deskripsi              = '';
    public int     $harga_dasar            = 0;
    public ?int    $harga_maksimal         = null;
    public string  $keterangan_bahan       = '';
    public bool    $is_active              = true;
    public $gambar_contoh;
    public ?string $gambar_existing        = null;

    protected $queryString = ['pencarian', 'filterStatus'];

    // ─── Computed ───────────────────────────────────────────────────────────────

    #[Computed]
    public function kategoris()
    {
        return ServiceCategory::query()
            ->when($this->pencarian, fn($q) =>
                $q->where(function ($q2) {
                    $q2->where('nama_jasa',     'like', "%{$this->pencarian}%")

                       ->orWhere('deskripsi',   'like', "%{$this->pencarian}%");
                })
            )
            ->when($this->filterStatus !== '', fn($q) =>
                $q->where('is_active', (bool) $this->filterStatus)
            )
            ->orderBy('nama_jasa')
            ->paginate($this->perPage);
    }


    // ─── Modal: Buka Tambah ──────────────────────────────────────────────────────

    public function openCreate(): void
    {
        $this->resetForm();
        $this->isEditMode    = false;
        $this->showFormModal = true;
    }

    // ─── Modal: Buka Edit ────────────────────────────────────────────────────────

    public function openEdit(int $id): void
    {
        $kategori = ServiceCategory::findOrFail($id);
        $this->resetForm();

        $this->selectedId   = $id;
        $this->isEditMode   = true;

        // Isi fields
        $this->nama_jasa              = $kategori->nama_jasa;
        $this->deskripsi              = $kategori->deskripsi ?? '';
        $this->harga_dasar            = $kategori->harga_dasar;
        $this->harga_maksimal         = $kategori->harga_maksimal;
        $this->keterangan_bahan       = $kategori->keterangan_bahan ?? '';
        $this->is_active              = $kategori->is_active;
        $this->gambar_existing        = $kategori->gambar_contoh;

        $this->showFormModal = true;
    }

    // ─── Modal: Detail ───────────────────────────────────────────────────────────

    public function openDetail(int $id): void
    {
        $this->selectedRecord  = ServiceCategory::findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeDetailModal(): void
    {
        $this->showDetailModal = false;
        $this->selectedRecord  = null;
    }

    // ─── Modal: Delete ───────────────────────────────────────────────────────────

    public function confirmDelete(int $id): void
    {
        $this->selectedId      = $id;
        $this->selectedRecord  = ServiceCategory::findOrFail($id);
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $kategori = ServiceCategory::findOrFail($this->selectedId);

        if ($kategori->gambar_contoh) {
            Storage::disk('public')->delete($kategori->gambar_contoh);
        }

        $kategori->delete();

        $this->showDeleteModal = false;
        $this->selectedId      = null;
        $this->selectedRecord  = null;

        session()->flash('success', "Kategori jasa \"{$kategori->nama_jasa}\" berhasil dihapus.");
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->selectedId     = null;
        $this->selectedRecord = null;
    }

    // ─── Modal: Tutup Form ───────────────────────────────────────────────────────

    public function closeFormModal(): void
    {
        $this->showFormModal = false;
        $this->resetForm();
        $this->resetValidation();
    }

    // ─── Toggle Status ───────────────────────────────────────────────────────────

    public function toggleStatus(int $id): void
    {
        $kategori = ServiceCategory::findOrFail($id);
        $kategori->update([
            'is_active'  => ! $kategori->is_active,
            'updated_by' => Auth::id(),
        ]);

        session()->flash('success', 'Status kategori berhasil diubah.');
    }

    // ─── Save (Create / Update) ──────────────────────────────────────────────────

    public function save(): void
    {
        $rules = [
            'nama_jasa'            => 'required|string|max:150',
            'deskripsi'            => 'nullable|string|max:500',
            'harga_dasar'          => 'required|integer|min:0',
            'harga_maksimal'       => 'nullable|integer|min:0|gte:harga_dasar',
            'keterangan_bahan'     => 'nullable|string',
            'is_active'            => 'boolean',
            'gambar_contoh'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        $messages = [
            'nama_jasa.required'      => 'Nama jasa wajib diisi.',
            'harga_dasar.required'    => 'Harga dasar wajib diisi.',
            'harga_dasar.min'         => 'Harga dasar tidak boleh negatif.',
            'harga_maksimal.gte'      => 'Harga maksimal harus lebih besar dari harga dasar.',
            'gambar_contoh.image'     => 'File harus berupa gambar.',
            'gambar_contoh.max'       => 'Ukuran gambar maksimal 2MB.',
        ];

        $this->validate($rules, $messages);

        try {
            $gambarPath = $this->gambar_existing;

            if ($this->gambar_contoh) {
                // Hapus gambar lama jika edit
                if ($this->isEditMode && $this->gambar_existing) {
                    Storage::disk('public')->delete($this->gambar_existing);
                }
                $gambarPath = $this->gambar_contoh->store('service-categories', 'public');
            }


            $payload = [
                'nama_jasa'            => $this->nama_jasa,
                'deskripsi'            => $this->deskripsi ?: null,
                'harga_dasar'          => $this->harga_dasar,
                'harga_maksimal'       => $this->harga_maksimal ?: null,
                'keterangan_bahan'     => $this->keterangan_bahan ?: null,
                'is_active'            => $this->is_active,
                'gambar_contoh'        => $gambarPath,
                'updated_by'           => Auth::id(),
            ];

            if ($this->isEditMode) {
                ServiceCategory::findOrFail($this->selectedId)->update($payload);
                $msg = 'Kategori jasa berhasil diperbarui.';
            } else {
                $payload['created_by'] = Auth::id();
                ServiceCategory::create($payload);
                $msg = 'Kategori jasa berhasil ditambahkan.';
            }

            $this->showFormModal = false;
            $this->resetForm();
            session()->flash('success', $msg);

        } catch (\Throwable $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            dd($e->getMessage());
        }
    }

    // ─── Reset Filter ────────────────────────────────────────────────────────────

    public function resetFilter(): void
    {
        $this->pencarian    = '';
        $this->filterStatus = '';
        $this->resetPage();
    }

    public function updatingPencarian(): void  { $this->resetPage(); }
    public function updatingFilterStatus(): void { $this->resetPage(); }

    // ─── Helpers ─────────────────────────────────────────────────────────────────

    private function resetForm(): void
    {
        $this->selectedId            = null;
        $this->nama_jasa             = '';
        $this->deskripsi             = '';
        $this->harga_dasar           = 0;
        $this->harga_maksimal        = null;
        $this->keterangan_bahan      = '';
        $this->is_active             = true;
        $this->gambar_contoh         = null;
        $this->gambar_existing       = null;
    }

    public function render()
    {
        return view('livewire.order-jasa.setting-kategori-jasa');
    }
}