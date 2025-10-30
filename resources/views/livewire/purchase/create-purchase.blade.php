<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="container-xxl w-full">
        
        <!-- Header with Back Button -->
        <div class="mb-8">
            <a href="{{ route('purchase.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold mb-6 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>

            <div class="flex items-center gap-4 mb-2">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Pembelian Baru</h1>
                    <p class="text-sm text-gray-500 mt-1">Catat pembelian barang dari supplier</p>
                </div>
            </div>
        </div>

        @if(session()->has('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
        @endif

        <!-- Main Form Card -->
        <form wire:submit.prevent="store">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Side - Form Input -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Info Pembelian Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                        <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Informasi Pembelian</h2>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <!-- Supplier -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Supplier <span class="text-red-500 font-bold">*</span>
                                </label>
                                <select wire:model="supplier_id" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 cursor-pointer @error('supplier_id') border-red-500 @enderror">
                                    <option value="">Pilih Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Grid: Nomor Invoice & Tanggal Invoice -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Nomor Invoice <span class="text-red-500 font-bold">*</span>
                                    </label>
                                    <input type="text" wire:model="nomor_invoice" placeholder="INV-001" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('nomor_invoice') border-red-500 @enderror">
                                    @error('nomor_invoice')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Tanggal Invoice <span class="text-red-500 font-bold">*</span>
                                    </label>
                                    <input type="date" wire:model="tgl_invoice" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('tgl_invoice') border-red-500 @enderror">
                                    @error('tgl_invoice')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tanggal Terima Barang -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Tanggal Terima Barang <span class="text-red-500 font-bold">*</span>
                                </label>
                                <input type="date" wire:model="tanggal_terima_barang" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('tanggal_terima_barang') border-red-500 @enderror">
                                @error('tanggal_terima_barang')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Catatan -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Catatan (Opsional)
                                </label>
                                <textarea wire:model="catatan" rows="3" placeholder="Catatan tambahan..." class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Items Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                        <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900">Daftar Barang</h2>
                            <button type="button" wire:click="addItem" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Item
                            </button>
                        </div>

                        <div class="p-6 space-y-4">
                            @foreach($items as $index => $item)
                            
                                <div wire:key="item-{{ $index }}" class="p-4 border-2 border-gray-200 rounded-xl hover:border-indigo-300 transition">
                                    <div class="flex items-start justify-between mb-3">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 font-bold text-sm">
                                            {{ $index + 1 }}
                                        </span>
                                        @if(count($items) > 1)
                                            <button type="button" wire:click="removeItem({{ $index }})" class="text-red-500 hover:text-red-700 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                        <!-- Product -->
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Produk</label>
                                            <select wire:model.live="items.{{ $index }}.product_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 @error('items.'.$index.'.product_id') border-red-500 @enderror">
                                                <option value="">Pilih Produk</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->nama_produk }}</option>
                                                @endforeach
                                            </select>
                                            @error('items.'.$index.'.product_id')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Harga Beli -->
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Harga Beli</label>
                                            <input type="number" wire:model.live="items.{{ $index }}.harga_beli" placeholder="0"  min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 @error('items.'.$index.'.harga_beli') border-red-500 @enderror">
                                            @error('items.'.$index.'.harga_beli')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Qty -->
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Jumlah</label>
                                            <input type="number" wire:model.live="items.{{ $index }}.qty" placeholder="1" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 @error('items.'.$index.'.qty') border-red-500 @enderror">
                                            @error('items.'.$index.'.qty')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Subtotal -->
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Subtotal:</span>
                                            <span class="text-lg font-bold text-indigo-600">
                                                Rp {{ number_format($item['subtotal'] ?? 0, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if(empty($items))
                                <div class="text-center py-8 text-gray-500">
                                    <p>Belum ada item. Klik "Tambah Item" untuk menambahkan barang.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Side - Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 sticky top-8">
                        <div class="bg-gradient-to-r from-indigo-500 to-blue-600 px-6 py-4">
                            <h2 class="text-lg font-semibold text-white">Ringkasan Pembelian</h2>
                        </div>

                        <div class="p-6 space-y-4">
                            <!-- Total Harga -->
                            <div class="pb-4 border-b border-gray-200">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-600">Total Item:</span>
                                    <span class="font-semibold text-gray-900">{{ count($items) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Total Harga:</span>
                                    <span class="text-xl font-bold text-gray-900">
                                        Rp {{ number_format($total_harga, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Jumlah Dibayar -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Jumlah Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="number" wire:model.live="jumlah_dibayar" placeholder="0" step="0.01" min="0" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('jumlah_dibayar') border-red-500 @enderror">
                                @error('jumlah_dibayar')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-xs text-gray-500">
                                    Rp {{ number_format($jumlah_dibayar, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Sisa Tagihan -->
                            <div class="pb-4 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 font-semibold">Sisa Tagihan:</span>
                                    <span class="text-xl font-bold {{ $sisa_tagihan > 0 ? 'text-red-600' : 'text-green-600' }}">
                                        Rp {{ number_format($sisa_tagihan, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Status Pembayaran -->
                            <div class="bg-gradient-to-r {{ $status_pembayaran === 'Lunas' ? 'from-green-50 to-emerald-50' : 'from-amber-50 to-orange-50' }} rounded-xl p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full {{ $status_pembayaran === 'Lunas' ? 'bg-green-500' : 'bg-amber-500' }} flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($status_pembayaran === 'Lunas')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            @endif
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Status Pembayaran</p>
                                        <p class="font-bold {{ $status_pembayaran === 'Lunas' ? 'text-green-700' : 'text-amber-700' }}">
                                            {{ $status_pembayaran }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Box -->
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="text-sm text-blue-700">
                                        <p class="font-semibold mb-1">Informasi</p>
                                        <p>Stok akan otomatis bertambah setelah pembelian disimpan.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3 pt-4">
                                <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Simpan Pembelian
                                    </span>
                                </button>
                                
                                <a href="{{ route('purchase.index') }}" class="block w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-xl transition-all duration-200 text-center">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>