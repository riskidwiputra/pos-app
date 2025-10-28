<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="container-xxl w-full">
        
        <!-- Header with Back Button -->
        <div class="mb-8">
            <a href="{{ route('product.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold mb-6 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>

            <div class="flex items-center gap-4 mb-2">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Produk Baru</h1>
                   
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            
           

            <!-- Form Content -->
            <form wire:submit.prevent="store" class="p-8 space-y-6">
                
               

                <!-- Nama Produk -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nama Produk <span class="text-red-500 font-bold">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            wire:model="nama_produk" 
                            placeholder="Contoh: Minyak Goreng Bimoli 2L"
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('nama_produk') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                    </div>
                    @error('nama_produk') 
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Grid: Kategori, Sub Kategori, Unit -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Kategori -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Kategori <span class="text-red-500 font-bold">*</span>
                        </label>
                        <select 
                            wire:model.live="category_id"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 cursor-pointer @error('category_id') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('category_id') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Sub Kategori -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Sub Kategori <span class="text-red-500 font-bold">*</span>
                        </label>
                        <select 
                            wire:model="sub_category_id"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 cursor-pointer @error('sub_category_id') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                            {{ !$category_id ? 'disabled' : '' }}
                        >
                            <option value="">Pilih Sub Kategori</option>
                            @foreach($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}">{{ $subCategory->nama_subkategori }}</option>
                            @endforeach
                        </select>
                        @error('sub_category_id') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Unit -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Unit <span class="text-red-500 font-bold">*</span>
                        </label>
                        <select 
                            wire:model="unit_id"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 cursor-pointer @error('unit_id') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                            <option value="">Pilih Unit</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                            @endforeach
                        </select>
                        @error('unit_id') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Deskripsi
                    </label>
                    <div class="relative">
                        <textarea 
                            wire:model="deskripsi" 
                            rows="4"
                            placeholder="Deskripsi produk (opsional)"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 resize-none @error('deskripsi') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        ></textarea>
                    </div>
                    @error('deskripsi') 
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Grid: Harga & Stok -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Harga Jual -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Harga Jual (Rp) <span class="text-red-500 font-bold">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <input 
                                type="number" 
                                wire:model="harga_jual" 
                                placeholder="15000"
                                step="0.01"
                                min="0"
                                class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('harga_jual') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                            >
                        </div>
                        @error('harga_jual') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Stok Tersedia -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Stok Tersedia <span class="text-red-500 font-bold">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <input 
                                type="number" 
                                wire:model="stok_tersedia" 
                                placeholder="100"
                                min="0"
                                class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('stok_tersedia') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                            >
                        </div>
                        @error('stok_tersedia') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Stok Minimum -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Stok Minimum <span class="text-red-500 font-bold">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <input 
                                type="number" 
                                wire:model="stok_minimum" 
                                placeholder="10"
                                min="0"
                                class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('stok_minimum') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                            >
                        </div>
                        @error('stok_minimum') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Grid: Gambar & Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Gambar Barang -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Gambar Produk
                        </label>
                        <div class="relative">
                            <input 
                                type="file" 
                                wire:model="gambar_barang" 
                                accept="image/*"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('gambar_barang') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                            >
                        </div>
                        @if($gambar_barang)
                            <div class="mt-3">
                                <img src="{{ $gambar_barang->temporaryUrl() }}" alt="Preview" class="w-32 h-32 rounded-lg object-cover shadow-md">
                            </div>
                        @endif
                        @error('gambar_barang') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG. Maksimal 2MB</p>
                    </div>

                    <!-- Status Produk -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Status Produk <span class="text-red-500 font-bold">*</span>
                        </label>
                        <select 
                            wire:model="status_product"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 cursor-pointer @error('status_product') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak-Tersedia">Tidak Tersedia</option>
                        </select>
                        @error('status_product') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

               

                <!-- Button Section -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <a 
                        href="{{ route('product.index') }}"
                        class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                    <button 
                        type="submit"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>