<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="container-xxl w-full">
        
        <!-- Header with Back Button -->
        <div class="mb-8">
            <a href="{{ route('sale.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold mb-6 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>

            <div class="flex items-center gap-4 mb-2">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Penjualan Baru</h1>
                    <p class="text-sm text-gray-500 mt-1">Catat transaksi penjualan produk kepada pelanggan</p>
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
                    
                    <!-- Info Penjualan Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                        <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Informasi Penjualan</h2>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <!-- Nama Pelanggan (Opsional) -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Nama Pelanggan <span class="text-gray-400 text-xs">(Opsional)</span>
                                </label>
                                <input type="text" wire:model="customer_name" placeholder="Nama pelanggan..." class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                            </div>

                            <!-- Grid: Tanggal Transaksi & Metode Pembayaran -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Tanggal Transaksi <span class="text-red-500 font-bold">*</span>
                                    </label>
                                    <input type="date" wire:model="transaction_date" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('transaction_date') border-red-500 @enderror">
                                    @error('transaction_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Metode Pembayaran <span class="text-red-500 font-bold">*</span>
                                    </label>
                                    <select wire:model="payment_method" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 cursor-pointer @error('payment_method') border-red-500 @enderror">
                                        <option value="cash">Cash</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                    @error('payment_method')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Catatan -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Catatan <span class="text-gray-400 text-xs">(Opsional)</span>
                                </label>
                                <textarea wire:model="notes" rows="3" placeholder="Catatan tambahan..." class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Items Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                        <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900">Daftar Produk</h2>
                            <button type="button" wire:click="addItem" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Produk
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

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <!-- Product -->
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Produk</label>
                                            <select wire:model.live="items.{{ $index }}.product_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 @error('items.'.$index.'.product_id') border-red-500 @enderror">
                                                <option value="">Pilih Produk</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->nama_produk }} (Stok: {{ $product->stok_tersedia }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('items.'.$index.'.product_id')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                            @if(isset($item['stock_available']) && $item['stock_available'] > 0)
                                                <p class="mt-1 text-xs text-blue-600">Stok tersedia: {{ $item['stock_available'] }} {{ $item['unit'] ?? '' }}</p>
                                            @endif
                                        </div>

                                        <!-- Qty -->
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Jumlah</label>
                                            <input type="number" wire:model.live="items.{{ $index }}.quantity" placeholder="1" min="1" max="{{ $item['stock_available'] ?? 999 }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 @error('items.'.$index.'.quantity') border-red-500 @enderror">
                                            @error('items.'.$index.'.quantity')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Product Info & Subtotal -->
                                    @if(isset($item['product_name']) && $item['product_name'])
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <div class="grid grid-cols-2 gap-2 mb-2">
                                            <div>
                                                <p class="text-xs text-gray-500">Harga Satuan</p>
                                                <p class="text-sm font-semibold text-gray-700">Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-xs text-gray-500">Subtotal</p>
                                                <p class="text-lg font-bold text-indigo-600">
                                                    Rp {{ number_format($item['subtotal'] ?? 0, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @endforeach

                            @if(empty($items))
                                <div class="text-center py-8 text-gray-500">
                                    <p>Belum ada produk. Klik "Tambah Produk" untuk menambahkan.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Side - Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 sticky top-8">
                        <div class="bg-gradient-to-r from-indigo-500 to-blue-600 px-6 py-4">
                            <h2 class="text-lg font-semibold text-white">Ringkasan Penjualan</h2>
                        </div>

                        <div class="p-6 space-y-4">
                            <!-- Total -->
                            <div class="pb-4 border-b border-gray-200">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-600">Total Item:</span>
                                    <span class="font-semibold text-gray-900">{{ count($items) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Total Harga:</span>
                                    <span class="text-2xl font-bold text-gray-900">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Jumlah Dibayar -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Jumlah Dibayar <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                    <input type="number" wire:model.live="paid_amount" placeholder="0" step="1000" min="0" 
                                           class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('paid_amount') border-red-500 @enderror"
                                           placeholder="0">
                                </div>
                                @error('paid_amount')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <div class="mt-2 flex gap-2 flex-wrap">
                                    <button type="button" wire:click="$set('paid_amount', {{ $total }})" 
                                            class="px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded-lg transition">
                                        Uang Pas
                                    </button>
                                    @foreach([50000, 100000, 200000, 500000] as $amount)
                                        <button type="button" wire:click="$set('paid_amount', {{ $amount }})" 
                                                class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg transition">
                                            {{ number_format($amount/1000, 0) }}k
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Kembalian -->
                            <div class="pb-4 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 font-semibold">Kembalian:</span>
                                    <span class="text-xl font-bold {{ $change_amount >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        Rp {{ number_format($change_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Status Pembayaran Indicator -->
                            <div class="bg-gradient-to-r {{ $change_amount >= 0 && $paid_amount >= $total ? 'from-green-50 to-emerald-50' : 'from-amber-50 to-orange-50' }} rounded-xl p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full {{ $change_amount >= 0 && $paid_amount >= $total ? 'bg-green-500' : 'bg-amber-500' }} flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($change_amount >= 0 && $paid_amount >= $total)
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            @endif
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Status</p>
                                        <p class="font-bold {{ $change_amount >= 0 && $paid_amount >= $total ? 'text-green-700' : 'text-amber-700' }}">
                                            {{ $change_amount >= 0 && $paid_amount >= $total ? 'Pembayaran Cukup' : 'Pembayaran Kurang' }}
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
                                        <p>Stok akan otomatis berkurang setelah penjualan disimpan.</p>
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
                                        Proses Penjualan
                                    </span>
                                </button>
                                
                                <a href="{{ route('sale.index') }}" class="block w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-xl transition-all duration-200 text-center">
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