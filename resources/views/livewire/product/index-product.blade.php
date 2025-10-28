<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Manajemen Produk
                </h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data produk dengan mudah dan efisien</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('product.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Produk
                </a>
            </div>
        </div>


        @if(session()->has('message'))
        <div class="mb-6 animate-in slide-in-from-top fade-in duration-500">
            <div class="group relative overflow-hidden rounded-xl backdrop-blur-md bg-gradient-to-r from-emerald-50 via-green-50 to-emerald-50 border border-emerald-200/50 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-emerald-400/20 via-green-300/20 to-emerald-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative px-6 py-4 flex items-start gap-4">
                    <div class="flex-shrink-0 relative">
                        <div class="absolute inset-0 bg-emerald-400 rounded-full blur-md opacity-30 animate-pulse"></div>
                        <div class="relative w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white animate-in zoom-in-50 duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 pt-1">
                        <h3 class="text-sm font-bold text-emerald-900 mb-1">Berhasil!</h3>
                        <p class="text-sm text-emerald-800/80 leading-relaxed">{{ session('message') }}</p>
                    </div>
                    <button wire:click="$set('message','')" class="flex-shrink-0 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-200/50 rounded-lg p-2 transition-all duration-200 hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r from-emerald-400 to-green-500 animate-in" style="animation: slideOut 4s ease-in-out forwards;"></div>
            </div>
        </div>
        @endif

        <!-- Low Stock Alert -->
        @if($lowStockCount > 0)
        <div class="mb-6 animate-in slide-in-from-top fade-in">
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-500 rounded-lg p-4 flex items-center gap-3">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <div class="flex-1">
                    <p class="font-semibold text-amber-900">Peringatan Stok Menipis!</p>
                    <p class="text-sm text-amber-700">Ada {{ $lowStockCount }} produk dengan stok di bawah minimum.</p>
                </div>
                <button wire:click="$toggle('showLowStock')" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg text-sm font-medium transition">
                    {{ $showLowStock ? 'Tampilkan Semua' : 'Lihat Produk' }}
                </button>
            </div>
        </div>
        @endif

        <!-- Search, Filter & Per Page -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-4 relative">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari nama, kode, atau barcode..." class="w-full pl-4 pr-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm"/>
            </div>
            <div class="md:col-span-2">
                <select wire:model.live="filterCategory" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <select wire:model.live="filterStatus" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <select wire:model.live="perPage" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm cursor-pointer">
                    <option value="10">10 per halaman</option>
                    <option value="25">25 per halaman</option>
                    <option value="50">50 per halaman</option>
                    <option value="100">100 per halaman</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <button wire:click="resetFilters" class="w-full px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-all duration-200 shadow-sm">
                    Reset Filter
                </button>
            </div>
        </div>

        <!-- Premium Table -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-50 via-blue-50 to-slate-50 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">No</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Gambar</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Produk</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Kategori</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Barcode</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Stok</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Harga</span>
                            </th>
                            <th class="px-6 py-4 text-center">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Status</span>
                            </th>
                            <th class="px-6 py-4 text-center">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $index => $product)
                            <tr wire:key="product-{{ $product->id }}" 
                                class="group hover:bg-gradient-to-r hover:from-blue-50 hover:via-indigo-50 hover:to-blue-50 transition-all duration-300 border-l-4 {{ $product->isLowStock() ? 'border-amber-500' : 'border-transparent' }} hover:border-indigo-500">
                                
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 text-sm font-bold text-indigo-700 group-hover:from-indigo-500 group-hover:to-blue-500 group-hover:text-white transition-all duration-300">
                                        {{ $products->firstItem() + $index }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @if($product->gambar_barang)
                                        <img src="{{ asset('storage/' . $product->gambar_barang) }}" alt="{{ $product->nama_produk }}" class="w-16 h-16 rounded-lg object-cover shadow-md">
                                    @else
                                        <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                            {{ $product->nama_produk }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $product->kode_produk }}</p>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div>
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">
                                            {{ $product->category->nama_kategori ?? '-' }}
                                        </span>
                                        <p class="text-xs text-gray-500 mt-1">{{ $product->subCategory->nama_subkategori ?? '-' }}</p>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-mono text-xs bg-gray-100 px-2 py-1 rounded">
                                        {{ $product->barcode_product }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold {{ $product->isLowStock() ? 'text-amber-600' : 'text-gray-900' }}">
                                            {{ $product->stok_tersedia }} {{ $product->unit->nama_unit ?? '' }}
                                        </p>
                                        <p class="text-xs text-gray-500">Min: {{ $product->stok_minimum }}</p>
                                        @if($product->isLowStock())
                                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-amber-100 text-amber-700 mt-1">
                                                Stok Menipis
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="text-sm font-semibold text-gray-900">
                                        Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if($product->status_product === 'Tersedia')
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-emerald-100 text-emerald-700">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                                            <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                                            Tidak Tersedia
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('product.edit', $product->id) }}" 
                                        class="inline-flex items-center gap-1 px-3 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium text-xs shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <button wire:click.prevent="confirmDelete({{ $product->id }})" 
                                                class="inline-flex items-center gap-1 px-3 py-2 rounded-lg bg-gradient-to-r from-red-500 to-pink-600 text-white font-medium text-xs shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center gap-4">
                                        <div class="relative">
                                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-lg font-semibold text-gray-700">Tidak ada data produk</p>
                                            <p class="text-sm text-gray-500">Mulai dengan menambahkan produk baru</p>
                                        </div>
                                        <a href="{{ route('product.create') }}" 
                                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Tambah Produk Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $products->links() }}
        </div>

        <!-- Delete Modal -->
        @if($showDeleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md">
                <h3 class="text-lg font-bold text-center mb-4">Hapus Produk?</h3>
                <p class="text-center mb-6">Apakah Anda yakin ingin menghapus produk ini? Data yang dihapus tidak dapat dikembalikan.</p>
                <div class="flex gap-3">
                    <button wire:click.prevent="closeDeleteModal" class="flex-1 px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">Batal</button>
                    <button wire:click.prevent="delete" class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Hapus Sekarang</button>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

