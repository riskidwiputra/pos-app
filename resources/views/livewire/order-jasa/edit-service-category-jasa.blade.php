<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">

        {{-- ══════════════════════════════════════════
             HEADER
        ══════════════════════════════════════════ --}}
        <div class="mb-8">
            <a href="{{ route('order-jasa.setting-kategori') }}"
               wire:navigate
               class="inline-flex items-center gap-1.5 text-sm text-indigo-500 hover:text-indigo-700 font-medium mb-3 group">
                <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar Kategori
            </a>

            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Kategori Jasa</h1>
                    
                </div>
               
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session()->has('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <p class="text-emerald-800 font-medium text-sm">{{ session('success') }}</p>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <p class="text-red-800 font-medium text-sm">{{ session('error') }}</p>
            </div>
        @endif

        <form wire:submit.prevent="save" class="space-y-6">

            
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 overflow-hidden">

                {{-- Card Header --}}
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-slate-50 to-blue-50/40 flex items-center gap-3">
                    
                    <div>
                        <h2 class="text-sm font-bold text-gray-800">Informasi Kategori</h2>
                       
                    </div>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-3">

                    {{-- Nama Jasa --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                            Nama Jasa <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            wire:model="nama_jasa"
                            placeholder="cth. Cetak Banner, Sablon Kaos, Undangan Digital..."
                            class="w-full px-4 py-2.5 border-2 rounded-xl text-sm transition-all
                                   focus:outline-none focus:border-indigo-500
                                   @error('nama_jasa') border-red-400 bg-red-50 @else border-gray-200 @enderror"
                        >
                        @error('nama_jasa')
                            <p class="mt-1 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                            Harga Dasar (Rp) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-sm font-semibold text-gray-400 pointer-events-none">Rp</span>
                            <input
                                type="number"
                                wire:model="total_harga"
                                min="0"
                                step="500"
                                placeholder="0"
                                class="w-full pl-10 pr-4 py-2.5 border-2 rounded-xl text-sm transition-all
                                       focus:outline-none focus:border-indigo-500
                                       @error('total_harga') border-red-400 bg-red-50 @else border-gray-200 @enderror"
                            >
                        </div>
                        @error('total_harga')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                
                    {{-- Deskripsi --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">Deskripsi</label>
                        <textarea
                            wire:model="deskripsi"
                            rows="2"
                            placeholder="Deskripsi singkat kategori jasa ini..."
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm resize-none
                                   focus:outline-none focus:border-indigo-500 transition-all"
                        ></textarea>
                    </div>

                    {{-- Keterangan Bahan --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">Keterangan Bahan</label>
                        <textarea
                            wire:model="keterangan_bahan"
                            rows="3"
                            placeholder="Jelaskan bahan/material utama yang digunakan, kualitas, dan karakteristiknya..."
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm resize-none
                                   focus:outline-none focus:border-indigo-500 transition-all"
                        ></textarea>
                    </div>

                    {{-- Gambar Contoh --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                            Gambar Contoh
                            <span class="text-gray-400 font-normal normal-case tracking-normal">JPG/PNG/WebP · maks 2MB</span>
                        </label>
                        <div class="flex items-start gap-4">

                            {{-- Preview gambar existing --}}
                            @if ($gambar_existing && !$gambar_contoh)
                                <div class="shrink-0 relative group/img">
                                    <img
                                        src="{{ Storage::url($gambar_existing) }}"
                                        alt="Gambar saat ini"
                                        class="h-24 w-24 rounded-xl object-cover ring-2 ring-gray-200"
                                    >
                                    <button
                                        type="button"
                                        wire:click="removeGambar"
                                        wire:confirm="Hapus gambar ini?"
                                        class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 hover:bg-red-600
                                               text-white rounded-full flex items-center justify-center
                                               opacity-0 group-hover/img:opacity-100 transition-opacity shadow"
                                        title="Hapus gambar"
                                    >
                                       
                                    </button>
                                    <p class="mt-1 text-center text-[10px] text-gray-400">Gambar saat ini</p>
                                </div>
                            @endif

                            {{-- Preview upload baru --}}
                            @if ($gambar_contoh)
                                <div class="shrink-0">
                                    <img
                                        src="{{ $gambar_contoh->temporaryUrl() }}"
                                        alt="Preview"
                                        class="h-24 w-24 rounded-xl object-cover ring-2 ring-indigo-400"
                                    >
                                    <p class="mt-1 text-center text-[10px] text-indigo-500 font-medium">Preview baru</p>
                                </div>
                            @endif

                            {{-- Upload area --}}
                            <div class="flex-1">
                                <label class="flex cursor-pointer flex-col items-center justify-center gap-1.5
                                              rounded-xl border-2 border-dashed border-gray-200 bg-gray-50
                                              px-4 py-5 transition hover:border-indigo-300 hover:bg-indigo-50/30">
                                   
                                    <span class="text-xs font-medium text-gray-500">
                                        {{ $gambar_existing ? 'Klik untuk ganti gambar' : 'Klik untuk upload gambar' }}
                                    </span>
                                    <input type="file" wire:model="gambar_contoh" accept="image/*" class="sr-only">
                                </label>
                                @error('gambar_contoh')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">Status</label>
                        <div class="flex items-center h-[42px]">
                            <label class="relative inline-flex cursor-pointer items-center gap-3">
                                <input type="checkbox" wire:model="is_active" class="peer sr-only">
                                <div class="peer relative h-6 w-11 rounded-full bg-gray-200
                                            after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5
                                            after:rounded-full after:bg-white after:shadow after:transition-all after:content-['']
                                            peer-checked:bg-indigo-500 peer-checked:after:translate-x-5
                                            peer-focus:ring-2 peer-focus:ring-indigo-200 transition-colors">
                                </div>
                                <span class="text-sm font-medium text-gray-700">
                                    {{ $is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 overflow-hidden">

                {{-- Card Header --}}
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-slate-50 to-amber-50/40 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        
                        <div>
                            <h2 class="text-sm font-bold text-gray-800">Produk yang Digunakan</h2>
                            <p class="text-xs text-gray-500">Material/produk yang dipakai saat mengerjakan jasa ini</p>
                        </div>
                    </div>
                  
                </div>

                <div class="p-6">

                    {{-- Error duplikat --}}
                    @error('bom_items')
                        <div class="mb-4 flex items-center gap-2.5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- Tabel Header --}}
                    @if (count($bom_items) > 0)
                        <div class="hidden sm:grid sm:grid-cols-12 gap-3 mb-2 px-1">
                            <div class="col-span-9 text-[10px] font-bold uppercase tracking-widest text-gray-400">Produk</div>
                            <div class="col-span-2 text-[10px] font-bold uppercase tracking-widest text-gray-400 text-center">Qty / Order</div>
                            <div class="col-span-1"></div>
                        </div>
                    @endif

                    {{-- BOM Rows --}}
                    <div class="space-y-2.5">
                        @forelse ($bom_items as $index => $item)
                            <div
                                wire:key="bom-{{ $index }}"
                                class="grid grid-cols-12 gap-2 sm:gap-3 items-start
                                       rounded-xl border border-gray-100 bg-gray-50/60 p-3
                                       hover:border-gray-200 hover:bg-gray-50 transition-colors"
                            >
                                {{-- Nomor urut --}}
                                <div class="col-span-12 sm:hidden mb-1">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Produk #{{ $index + 1 }}</span>
                                </div>

                                {{-- Pilih Produk --}}
                                <div class="col-span-11 sm:col-span-9">
                                    <select
                                        wire:model="bom_items.{{ $index }}.product_id"
                                        class="w-full rounded-lg border-2 bg-white px-3 py-2 text-sm text-gray-800
                                               focus:outline-none focus:border-indigo-500 transition-all
                                               @error('bom_items.'.$index.'.product_id') border-red-400 bg-red-50 @else border-gray-200 @enderror"
                                    >
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">
                                                {{ $product->nama_produk }}
                                                @if($product->stok_tersedia !== null)
                                                    · Stok: {{ number_format($product->stok_tersedia) }} {{ $product->satuan ?? 'pcs' }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bom_items.'.$index.'.product_id')
                                        <p class="mt-0.5 text-[10px] text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Qty --}}
                                <div class="col-span-3 sm:col-span-2">
                                    <input
                                        type="number"
                                        wire:model="bom_items.{{ $index }}.quantity"
                                        min="1"
                                        placeholder="1"
                                        class="w-full rounded-lg border-2 bg-white px-3 py-2 text-sm text-center text-gray-800
                                               focus:outline-none focus:border-indigo-500 transition-all"
                                    >
                                    @error('bom_items.'.$index.'.quantity')
                                        <p class="mt-0.5 text-[10px] text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                             

                                {{-- Hapus --}}
                                <div class="col-span-2 sm:col-span-1 flex items-center justify-center pt-0.5">
                                    <button
                                        type="button"
                                        wire:click="removeBomItem({{ $index }})"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg text-red-500"
                                        title="Hapus baris"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        @empty
                            
                        @endforelse
                    </div>

                    {{-- Tombol Tambah Produk --}}
                    <button
                        type="button"
                        wire:click="addBomItem"
                        class="mt-4 w-full flex items-center justify-center gap-2
                               rounded-xl border-2  px-4 py-3 text-sm "
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Produk
                    </button>

                    
                </div>
            </div>

            {{-- ══════════════════════════════════════════
                 FOOTER ACTION
            ══════════════════════════════════════════ --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3
                        bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 px-6 py-4 ">

                

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <a href="{{ route('order-jasa.setting-kategori') }}"
                       wire:navigate
                       class="flex-1 sm:flex-none px-5 py-2.5 rounded-xl border-2 border-gray-200 bg-white
                              text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all text-center">
                        Batal
                    </a>
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70 cursor-not-allowed"
                        class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2
                               px-6 py-2.5 rounded-xl
                               bg-gradient-to-r from-blue-500 to-indigo-600
                               hover:from-blue-600 hover:to-indigo-700
                               text-white text-sm font-semibold shadow-md
                               transition-all active:scale-[0.98] disabled:opacity-70"
                    >
                        
                        <span wire:loading wire:target="save">
                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                            </svg>
                        </span>
                        <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                        <span wire:loading wire:target="save">Menyimpan...</span>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>