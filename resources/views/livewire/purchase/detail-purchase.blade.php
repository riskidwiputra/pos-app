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

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-2">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Detail Pembelian
                    </h1>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 text-indigo-700 border border-indigo-200">
                            {{ $purchase->purchase_code }}
                        </span>
                        @if($purchase->status === 'Dibatalkan')
                            <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-700">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></span>
                                Dibatalkan
                            </span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    {{-- @if($purchase->status_pembayaran !== 'Lunas' && $purchase->status === 'Aktif')
                        <button wire:click="openPaymentModal" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Tambah Pembayaran
                        </button>
                    @endif --}}
                    
                  
                </div>
            </div>
        </div>

        <!-- Flash Message -->
        @if($message)
        <div class="mb-6 animate-in slide-in-from-top fade-in duration-500">
            <div class="group relative overflow-hidden rounded-xl backdrop-blur-md bg-gradient-to-r from-emerald-50 via-green-50 to-emerald-50 border border-emerald-200/50 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-emerald-400/20 via-green-300/20 to-emerald-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative px-6 py-4 flex items-start gap-4">
                    <div class="flex-shrink-0 relative">
                        <div class="absolute inset-0 bg-emerald-400 rounded-full blur-md opacity-30 animate-pulse"></div>
                        <div class="relative w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 pt-1">
                        <p class="text-sm text-emerald-800/80 leading-relaxed">{{ $message }}</p>
                    </div>
                    <button wire:click="$set('message', '')" class="flex-shrink-0 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-200/50 rounded-lg p-2 transition-all duration-200 hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Side - Details -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Info Pembelian -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Pembelian</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Supplier -->
                            <div class="group">
                                <p class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">Supplier</p>
                                <div class="flex items-center gap-3">
                                    
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $purchase->supplier->nama_supplier }}</p>
                                        <p class="text-sm text-gray-500">{{ $purchase->supplier->alamat_supplier ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Nomor Invoice -->
                            <div class="group">
                                <p class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">Nomor Invoice</p>
                                <div class="flex items-center gap-3">
                                   
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $purchase->nomor_invoice }}</p>
                                        <p class="text-sm text-gray-500">Tgl Invoice: {{ Carbon\Carbon::parse($purchase->tgl_invoice)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal Terima -->
                            <div class="group">
                                <p class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">Tanggal Terima</p>
                                <div class="flex items-center gap-3">
                                    
                                    <div>
                                        <p class="font-bold text-gray-900">{{ Carbon\Carbon::parse($purchase->tanggal_terima_barang)->format('d F Y') }}</p>
                                        <p class="text-sm text-gray-500">{{ Carbon\Carbon::parse($purchase->tanggal_terima_barang)->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="group">
                                <p class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">Status Dokumen</p>
                                <div class="flex items-center gap-3">
                                    
                                    <div>
                                        <p class="font-bold {{ $purchase->status === 'Aktif' ? 'text-emerald-700' : 'text-red-700' }}">
                                            {{ $purchase->status }}
                                        </p>
                                        <p class="text-sm text-gray-500">Status dokumen pembelian</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($purchase->catatan)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">Catatan</p>
                            <div class="bg-gradient-to-r from-amber-50 to-yellow-50 rounded-xl p-4 border border-amber-200">
                                <p class="text-gray-800 italic">{{ $purchase->catatan }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Daftar Barang -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">Daftar Barang</h2>
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-700">
                            {{ $purchase->items->count() }} Item
                        </span>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-200">
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Harga Beli</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Qty</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($purchase->items as $index => $item)
                                    <tr class="group hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200">
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 text-sm font-bold text-indigo-700">
                                                {{ $index + 1 }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                
                                                <div>
                                                    <p class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                                        {{ $item->product->nama_produk }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">Kode: {{ $item->product->kode_produk ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <p class="font-semibold text-gray-900">Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 font-bold text-sm">
                                                {{ $item->qty }} {{ $item->product->unit->nama_unit ?? 'Unit' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <p class="text-lg font-bold text-indigo-600">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-to-r from-indigo-50 to-blue-50 border-t-2 border-indigo-200">
                                    <td colspan="4" class="px-6 py-4 text-right">
                                        <span class="text-lg font-bold text-gray-900">Total Pembelian:</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">
                                            Rp {{ number_format($purchase->total_harga, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

               
            </div>

            <!-- Right Side - Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 sticky top-8">
                    <div class="bg-gradient-to-r from-indigo-500 to-blue-600 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white">Ringkasan Pembayaran</h2>
                    </div>

                    <div class="p-6 space-y-4">
                        <!-- Total & Progress -->
                        <div class="pb-4 border-b border-gray-200">
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-600">Total Pembelian</span>
                                    <span class="text-xl font-bold text-gray-900">
                                        Rp {{ number_format($purchase->total_harga, 0, ',', '.') }}
                                    </span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-600">Total Dibayar</span>
                                    <span class="text-lg font-semibold text-green-600">
                                        Rp {{ number_format($purchase->jumlah_dibayar, 0, ',', '.') }}
                                    </span>
                                </div>
                                
                                <!-- Progress Bar -->
                                @php
                                    $percentage = $purchase->total_harga > 0 ? ($purchase->jumlah_dibayar / $purchase->total_harga) * 100 : 0;
                                @endphp
                                <div class="mt-3">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Progress Pembayaran</span>
                                        <span class="font-semibold">{{ number_format($percentage, 1) }}%</span>
                                    </div>
                                    
                                </div>
                                
                                <div class="pt-3 flex justify-between items-center">
                                    <span class="text-sm font-bold text-gray-700">Sisa Tagihan</span>
                                    <span class="text-2xl font-bold {{ $purchase->sisa_tagihan > 0 ? 'text-red-600' : 'text-green-600' }}">
                                        Rp {{ number_format($purchase->sisa_tagihan, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Status Card -->
                        <div class="bg-gradient-to-r {{ $purchase->status_pembayaran === 'Lunas' ? 'from-green-50 to-emerald-50' : 'from-amber-50 to-orange-50' }} rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Status Pembayaran</p>
                                    <p class="text-lg font-bold {{ $purchase->status_pembayaran === 'Lunas' ? 'text-green-700' : 'text-amber-700' }}">
                                        {{ $purchase->status_pembayaran }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4">
                            <div class="flex gap-3">
                                
                                <div class="text-sm text-blue-700">
                                    <p class="font-semibold mb-1">Informasi</p>
                                    @if($purchase->status_pembayaran === 'Lunas')
                                        <p>Pembelian ini telah lunas dibayar.</p>
                                    @else
                                        <p>Pembayaran dapat dilakukan secara bertahap hingga lunas.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                       
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Payment Modal -->
        @if($showPaymentModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all animate-in slide-in-from-bottom fade-in duration-300">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4 rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white">Tambah Pembayaran</h3>
                        <button wire:click="closePaymentModal" class="text-white/80 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <form wire:submit.prevent="addPayment" class="p-6 space-y-4">
                    <!-- Info Sisa Tagihan -->
                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl p-4 border border-amber-200">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-amber-700">Sisa Tagihan</span>
                            <span class="text-lg font-bold text-amber-900">
                                Rp {{ number_format($purchase->sisa_tagihan, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Tanggal Bayar -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Tanggal Pembayaran <span class="text-red-500">*</span>
                        </label>
                        <input type="date" wire:model="tanggal_bayar" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all @error('tanggal_bayar') border-red-500 @enderror">
                        @error('tanggal_bayar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Bayar -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Jumlah Pembayaran <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                            <input type="number" wire:model="jumlah_bayar" step="1" min="1" max="{{ $purchase->sisa_tagihan }}" 
                                   class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all @error('jumlah_bayar') border-red-500 @enderror"
                                   placeholder="0">
                        </div>
                        @error('jumlah_bayar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div class="mt-2 flex gap-2">
                            <button type="button" wire:click="$set('jumlah_bayar', {{ $purchase->sisa_tagihan }})" 
                                    class="px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-medium rounded-lg transition">
                                Bayar Lunas
                            </button>
                            <button type="button" wire:click="$set('jumlah_bayar', {{ round($purchase->sisa_tagihan / 2) }})" 
                                    class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
                                50%
                            </button>
                        </div>
                    </div>

                    <!-- Metode Bayar -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Metode Pembayaran <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-2">
                            <button type="button" wire:click="$set('metode_bayar', 'Cash')"
                                    class="px-4 py-3 rounded-xl border-2 transition-all {{ $metode_bayar === 'Cash' ? 'border-emerald-500 bg-emerald-50 text-emerald-700 font-semibold' : 'border-gray-200 hover:border-gray-300' }}">
                                <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Cash
                            </button>
                            <button type="button" wire:click="$set('metode_bayar', 'Transfer')"
                                    class="px-4 py-3 rounded-xl border-2 transition-all {{ $metode_bayar === 'Transfer' ? 'border-emerald-500 bg-emerald-50 text-emerald-700 font-semibold' : 'border-gray-200 hover:border-gray-300' }}">
                                <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Transfer
                            </button>
                            <button type="button" wire:click="$set('metode_bayar', 'E-Wallet')"
                                    class="px-4 py-3 rounded-xl border-2 transition-all {{ $metode_bayar === 'E-Wallet' ? 'border-emerald-500 bg-emerald-50 text-emerald-700 font-semibold' : 'border-gray-200 hover:border-gray-300' }}">
                                <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                E-Wallet
                            </button>
                        </div>
                        @error('metode_bayar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catatan -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Catatan (Opsional)
                        </label>
                        <textarea wire:model="catatan_pembayaran" rows="3" placeholder="Tambahkan catatan pembayaran..." 
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 resize-none transition-all"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="button" wire:click="closePaymentModal" 
                                class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-xl transition-all duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Pembayaran
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif --}}

    </div>
</div>
