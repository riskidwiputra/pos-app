<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        {{-- ═══════════════════════════════════════════════════════════════════════
             HEADER
        ═══════════════════════════════════════════════════════════════════════ --}}
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

                <div>
                    <a href="{{ route('order-jasa.index') }}"
                       class="inline-flex items-center gap-1 text-sm text-indigo-500 hover:text-indigo-700 font-medium mb-2 group">
                        <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali ke Kelola Order
                    </a>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Setting Kategori Jasa
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">Kelola daftar jasa percetakan beserta harga dan spesifikasi bahan</p>
                </div>

                <button
                    wire:click="openCreate"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600
                           hover:from-blue-600 hover:to-indigo-700 text-white text-sm font-semibold
                           rounded-xl shadow-md transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Kategori Jasa
                </button>

            </div>

            {{-- Flash Messages --}}
            @if(session()->has('success'))
                <div class="mb-6 rounded-xl bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-emerald-500 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="mb-6 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-red-500 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif
        </div>

       

        {{-- ═══════════════════════════════════════════════════════════════════════
             FILTER & SEARCH
        ═══════════════════════════════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-lg p-5 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-5">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Cari Jasa</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input
                            type="text"
                            wire:model.live.debounce.400ms="pencarian"
                            placeholder="Cari nama jasa atau kode..."
                            class="w-full pl-9 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm transition-all"
                        />
                    </div>
                </div>

                <div class="md:col-span-3">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Status</label>
                    <select wire:model.live="filterStatus"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm cursor-pointer transition-all">
                        <option value="">Semua Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Per Halaman</label>
                    <select wire:model.live="perPage"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm cursor-pointer transition-all">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex items-end">
                    <button wire:click="resetFilter"
                            class="w-full px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition-all">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════════════════
             TABLE
        ═══════════════════════════════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-50 via-blue-50 to-slate-50 border-b-2 border-gray-200">
                            <th class="px-5 py-3.5 text-left text-xs font-bold uppercase tracking-widest text-gray-600">No</th>
                            <th class="px-5 py-3.5 text-left text-xs font-bold uppercase tracking-widest text-gray-600">Jasa</th>
                            <th class="px-5 py-3.5 text-left text-xs font-bold uppercase tracking-widest text-gray-600">Harga</th>
                            <th class="px-5 py-3.5 text-left text-xs font-bold uppercase tracking-widest text-gray-600">Bahan / Material</th>
                            <th class="px-5 py-3.5 text-center text-xs font-bold uppercase tracking-widest text-gray-600">Status</th>
                            <th class="px-5 py-3.5 text-center text-xs font-bold uppercase tracking-widest text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($this->kategoris as $index => $item)
                            <tr class="hover:bg-blue-50/50 transition-colors group">
                                {{-- No --}}
                                <td class="px-5 py-4 text-sm font-semibold text-gray-500">
                                    {{ $this->kategoris->firstItem() + $index }}
                                </td>

                                {{-- Nama Jasa --}}
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                       
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <p class="font-bold text-gray-900 text-sm">{{ $item->nama_jasa }}</p>
                                            </div>
                                           
                                            @if($item->deskripsi)
                                                <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $item->deskripsi }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Harga --}}
                                <td class="px-5 py-4">
                                    <p class="font-bold text-gray-900 text-sm">Rp {{ number_format($item->harga_dasar, 0, ',', '.') }}</p>
                                    @if($item->harga_maksimal)
                                        <p class="text-xs text-gray-400">s/d Rp {{ number_format($item->harga_maksimal, 0, ',', '.') }}</p>
                                    @endif
                                    
                                </td>

                                {{-- Bahan --}}
                                <td class="px-5 py-4 max-w-xs">
                                    @if($item->keterangan_bahan)
                                        <p class="text-xs text-gray-700 line-clamp-2">{{ $item->keterangan_bahan }}</p>
                                    @else
                                        <p class="text-xs text-gray-300 italic">—</p>
                                    @endif
                                    
                                </td>

                                {{-- Status --}}
                                <td class="px-5 py-4 text-center">
                                    <button wire:click="toggleStatus({{ $item->id }})"
                                            title="Klik untuk toggle status"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold transition-all
                                                   {{ $item->is_active
                                                      ? 'bg-green-100 text-green-700 hover:bg-green-200'
                                                      : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                        <div class="w-1.5 h-1.5 rounded-full {{ $item->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></div>
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-center gap-1.5">

                                        {{-- Detail --}}
                                        <button wire:click="openDetail({{ $item->id }})"
                                                title="Lihat Detail"
                                                class="p-2 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>

                                        {{-- Edit --}}
                                        <button wire:click="openEdit({{ $item->id }})"
                                                title="Edit"
                                                class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>

                                        {{-- Hapus --}}
                                        <button wire:click="confirmDelete({{ $item->id }})"
                                                title="Hapus"
                                                class="p-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-500 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center text-gray-300">
                                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                        <p class="text-lg font-semibold text-gray-400">Belum ada kategori jasa</p>
                                        <p class="text-sm text-gray-300 mt-1">Klik "Tambah Kategori Jasa" untuk memulai</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $this->kategoris->links() }}
            </div>
        </div>

    </div>{{-- end max-w-7xl --}}


    {{-- ═══════════════════════════════════════════════════════════════════════════
         MODAL: FORM TAMBAH / EDIT
    ═══════════════════════════════════════════════════════════════════════════ --}}
    @if($showFormModal)
        <div class="fixed inset-0 z-50 overflow-y-auto"
             x-data
             @keydown.escape.window="$wire.closeFormModal()">
            <div class="flex items-start justify-center min-h-screen p-4 pt-10">

                {{-- Backdrop --}}
                <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
                     wire:click="closeFormModal"></div>

                {{-- Panel --}}
                <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl z-10 overflow-hidden">

                    {{-- Modal Header --}}
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-white">
                                    {{ $isEditMode ? ' Edit Kategori Jasa' : 'Tambah Kategori Jasa' }}
                                </h3>
                                <p class="text-blue-100 text-sm mt-0.5">
                                    {{ $isEditMode ? 'Perbarui informasi jasa percetakan' : 'Buat kategori jasa baru' }}
                                </p>
                            </div>
                            <button wire:click="closeFormModal"
                                    class="text-white/70 hover:text-white p-1 rounded-lg transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Modal Body --}}
                    <form wire:submit.prevent="save">
                        <div class="p-6 space-y-6 max-h-[75vh] overflow-y-auto">

                            {{-- ── Informasi Dasar ── --}}
                            <div>
                                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100">
                                    Informasi Dasar
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                            Nama Jasa <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" wire:model="nama_jasa"
                                               placeholder="Contoh: Cetak Banner, Sablon Kaos..."
                                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 text-sm
                                                      @error('nama_jasa') border-red-400 @enderror"/>
                                        @error('nama_jasa')
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                            Deskripsi Singkat
                                        </label>
                                        <textarea wire:model="deskripsi" rows="2"
                                                  placeholder="Deskripsi singkat tentang jasa ini..."
                                                  class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 text-sm resize-none
                                                         @error('deskripsi') border-red-400 @enderror"></textarea>
                                        @error('deskripsi')
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                  

                                </div>
                            </div>

                            {{-- ── Harga ── --}}
                            <div>
                                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100">
                                    Informasi Harga
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                            Harga Dasar (Rp) <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-semibold">Rp</span>
                                            <input type="number" wire:model="harga_dasar" min="0" step="500"
                                                   class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 text-sm
                                                          @error('harga_dasar') border-red-400 @enderror"/>
                                        </div>
                                        @error('harga_dasar')
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                            Harga Maksimal (Rp)
                                            <span class="text-gray-400 font-normal text-xs">(opsional)</span>
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-semibold">Rp</span>
                                            <input type="number" wire:model="harga_maksimal" min="0" step="500"
                                                   class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 text-sm
                                                          @error('harga_maksimal') border-red-400 @enderror"/>
                                        </div>
                                        @error('harga_maksimal')
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                   

                                   

                                </div>
                            </div>

                            {{-- ── Bahan & Material ── --}}
                            <div>
                                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100">
                                    Bahan & Material
                                </h4>
                                <div class="space-y-4">

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                            Keterangan Bahan yang Digunakan
                                        </label>
                                        <textarea wire:model="keterangan_bahan" rows="3"
                                                  placeholder="Jelaskan bahan/material utama yang digunakan, kualitas, dan karakteristiknya..."
                                                  class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 text-sm resize-none"></textarea>
                                    </div>

                                    

                                   

                                </div>
                            </div>

                            {{-- ── Gambar & Status ── --}}
                            <div>
                                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100">
                                    Gambar & Status
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                            Gambar Contoh
                                            <span class="text-gray-400 font-normal text-xs">(JPG/PNG, maks 2MB)</span>
                                        </label>
                                        <input type="file" wire:model="gambar_contoh"
                                               accept="image/jpg,image/jpeg,image/png,image/webp"
                                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl
                                                      file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600
                                                      hover:file:bg-indigo-100 border-2 border-gray-200 rounded-xl px-3 py-2"/>
                                        @error('gambar_contoh')
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                        @if($gambar_existing && !$gambar_contoh)
                                            <p class="mt-1.5 text-xs text-blue-600">
                                                <span class="font-semibold">Gambar saat ini:</span> {{ basename($gambar_existing) }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-3 p-3 bg-green-50 rounded-xl border border-green-100">
                                        <input type="checkbox" wire:model="is_active" id="is_active"
                                               class="w-4 h-4 text-green-500 rounded cursor-pointer"/>
                                        <label for="is_active" class="text-sm font-semibold text-green-700 cursor-pointer">
                                            Kategori Aktif
                                        </label>
                                    </div>

                                </div>
                            </div>

                        </div>{{-- end scrollable body --}}

                        {{-- Modal Footer --}}
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex gap-3">
                            <button type="button" wire:click="closeFormModal"
                                    class="flex-1 px-5 py-2.5 bg-white hover:bg-gray-100 text-gray-700 font-semibold rounded-xl border-2 border-gray-200 transition-all text-sm">
                                Batal
                            </button>
                            <button type="submit"
                                    class="flex-1 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700
                                           text-white font-semibold rounded-xl shadow-md transition-all text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $isEditMode ? 'Simpan Perubahan' : 'Tambah Kategori' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endif


    {{-- ═══════════════════════════════════════════════════════════════════════════
         MODAL: DETAIL
    ═══════════════════════════════════════════════════════════════════════════ --}}
    @if($showDetailModal && $selectedRecord)
        <div class="fixed inset-0 z-50 overflow-y-auto"
             x-data
             @keydown.escape.window="$wire.closeDetailModal()">
            <div class="flex items-start justify-center min-h-screen p-4 pt-10">
                <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" wire:click="closeDetailModal"></div>

                <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl z-10 overflow-hidden">

                    {{-- Header --}}
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-4">
                                
                                <div>
                                    <h3 class="text-xl font-bold text-white">{{ $selectedRecord->nama_jasa }}</h3>
                                    @if($selectedRecord->deskripsi)
                                        <p class="text-indigo-200 text-sm mt-0.5">{{ $selectedRecord->deskripsi }}</p>
                                    @endif
                                </div>
                            </div>
                            <button wire:click="closeDetailModal" class="text-white/60 hover:text-white p-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        {{-- Badge row --}}
                        <div class="flex flex-wrap gap-2 mt-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                         {{ $selectedRecord->is_active ? 'bg-green-400/30 text-green-100' : 'bg-gray-400/30 text-gray-200' }}">
                                {{ $selectedRecord->is_active ? '● Aktif' : '● Nonaktif' }}
                            </span>
                          
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="p-6 space-y-5 max-h-[60vh] overflow-y-auto">

                        {{-- Harga --}}
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-blue-50 rounded-xl p-3 text-center">
                                <p class="text-xs text-blue-500 font-semibold mb-1">Harga Dasar</p>
                                <p class="text-lg font-bold text-blue-700">Rp {{ number_format($selectedRecord->harga_dasar, 0, ',', '.') }}</p>
                               
                            </div>
                            <div class="bg-indigo-50 rounded-xl p-3 text-center">
                                <p class="text-xs text-indigo-500 font-semibold mb-1">Harga Maks</p>
                                <p class="text-lg font-bold text-indigo-700">
                                    @if($selectedRecord->harga_maksimal)
                                        Rp {{ number_format($selectedRecord->harga_maksimal, 0, ',', '.') }}
                                    @else
                                        <span class="text-gray-300 text-base">—</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{-- Bahan --}}
                        @if($selectedRecord->keterangan_bahan)
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Keterangan Bahan</p>
                                <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-xl leading-relaxed">{{ $selectedRecord->keterangan_bahan }}</p>
                            </div>
                        @endif

                        

                    </div>

                    {{-- Footer --}}
                    <div class="px-6 py-4 bg-gray-50 border-t flex gap-3">
                        <button wire:click="closeDetailModal"
                                class="flex-1 px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition-all">
                            Tutup
                        </button>
                        <button wire:click="openEdit({{ $selectedRecord->id }}); closeDetailModal()"
                                class="flex-1 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-xl text-sm transition-all flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Kategori
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- ═══════════════════════════════════════════════════════════════════════════
         MODAL: DELETE CONFIRM
    ═══════════════════════════════════════════════════════════════════════════ --}}
    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto"
             x-data
             @keydown.escape.window="$wire.closeDeleteModal()">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" wire:click="closeDeleteModal"></div>

                <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full z-10 overflow-hidden">

                    <div class="p-6 text-center">
                        <div class="mx-auto w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Kategori Jasa?</h3>

                        @if($selectedRecord)
                            <div class="mb-4 p-3 bg-red-50 rounded-xl border border-red-100">
                                <p class="text-sm font-semibold text-red-800"> {{ $selectedRecord->nama_jasa }}</p>
                             
                            </div>
                        @endif

                        <p class="text-gray-500 text-sm mb-6">
                            Data kategori yang dihapus tidak dapat dikembalikan. Pastikan tidak ada order aktif yang menggunakan kategori ini.
                        </p>

                        <div class="flex gap-3">
                            <button wire:click="closeDeleteModal"
                                    class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition-all">
                                Batal
                            </button>
                            <button wire:click="delete"
                                    class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl text-sm transition-all">
                                Ya, Hapus
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif

</div>