<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Manajemen Pembelian
                </h1>
                <p class="text-sm text-gray-500 mt-1">Kelola pembelian dari supplier dan stok masuk</p>
            </div>
            <a href="{{ route('purchase.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Pembelian
            </a>
        </div>

        <!-- Flash Message -->
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
            </div>
        </div>
        @endif

        <!-- Alert Utang -->
        @if($totalBelumLunas > 0)
        <div class="mb-6 animate-in slide-in-from-top fade-in">
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-500 rounded-lg p-4 flex items-center gap-3">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex-1">
                    <p class="font-semibold text-amber-900">Total Utang Supplier</p>
                    <p class="text-sm text-amber-700">Rp {{ number_format($totalBelumLunas, 0, ',', '.') }} belum dilunasi</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Filters -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-3 relative">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari kode/invoice..." class="w-full pl-4 pr-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm"/>
            </div>
            <div class="md:col-span-2">
                <select wire:model.live="filterSupplier" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm cursor-pointer">
                    <option value="">Semua Supplier</option>
                    @foreach($suppliers as $sup)
                        <option value="{{ $sup->id }}">{{ $sup->nama_supplier }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <select wire:model.live="filterStatusPembayaran" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm cursor-pointer">
                    <option value="">Semua Status Bayar</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <input type="date" wire:model.live="startDate" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm"/>
            </div>
            <div class="md:col-span-2">
                <input type="date" wire:model.live="endDate" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm"/>
            </div>
            <div class="md:col-span-1">
                <button wire:click="resetFilters" class="w-full px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-all duration-200 shadow-sm">
                    Reset
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-50 via-blue-50 to-slate-50 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">No</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Kode & Invoice</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Supplier</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Tanggal</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Total</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Pembayaran</span>
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
                        @forelse($purchases as $index => $purchase)
                            <tr wire:key="purchase-{{ $purchase->id }}" 
                                class="group hover:bg-gradient-to-r hover:from-blue-50 hover:via-indigo-50 hover:to-blue-50 transition-all duration-300 border-l-4 border-transparent hover:border-indigo-500">
                                
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 text-sm font-bold text-indigo-700 group-hover:from-indigo-500 group-hover:to-blue-500 group-hover:text-white transition-all duration-300">
                                        {{ $purchases->firstItem() + $index }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                            {{ $purchase->purchase_code }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $purchase->nomor_invoice }}</p>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-900">{{ $purchase->supplier->nama_supplier }}</p>
                                </td>

                                <td class="px-6 py-4">
                                    <div>
                                        <p class="text-sm text-gray-700">{{ $purchase->tanggal_terima_barang->format('d M Y') }}</p>
                                        <p class="text-xs text-gray-500">Inv: {{ $purchase->tgl_invoice->format('d M Y') }}</p>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900">Rp {{ number_format($purchase->total_harga, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-500">{{ $purchase->items->count() }} item</p>
                                </td>

                                <td class="px-6 py-4">
                                    <div>
                                        <p class="text-sm font-medium text-green-600">Rp {{ number_format($purchase->jumlah_dibayar, 0, ',', '.') }}</p>
                                        @if($purchase->sisa_tagihan > 0)
                                            <p class="text-xs text-red-600">Sisa: Rp {{ number_format($purchase->sisa_tagihan, 0, ',', '.') }}</p>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if($purchase->status_pembayaran === 'Lunas')
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-emerald-100 text-emerald-700">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>
                                            Lunas
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">
                                            <span class="w-2 h-2 bg-amber-500 rounded-full mr-2"></span>
                                            Belum Lunas
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('purchase.detail', $purchase->id) }}" 
                                        class="inline-flex items-center gap-1 px-3 py-2 rounded-lg bg-gradient-to-r from-green-500 to-teal-600 text-white font-medium text-xs shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('purchase.edit', $purchase->id) }}" 
                                        class="inline-flex items-center gap-1 px-3 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium text-xs shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <button wire:click.prevent="confirmDelete({{ $purchase->id }})" 
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
                                <td colspan="8" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center gap-4">
                                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-lg font-semibold text-gray-700">Tidak ada data pembelian</p>
                                            <p class="text-sm text-gray-500">Mulai dengan menambahkan pembelian baru</p>
                                        </div>
                                        <a href="{{ route('purchase.create') }}" 
                                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Tambah Pembelian Pertama
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
            {{ $purchases->links() }}
        </div>

        <!-- Delete Modal -->
        @if($showDeleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md">
                <h3 class="text-lg font-bold text-center mb-4">Hapus Pembelian?</h3>
                <p class="text-center mb-6">Apakah Anda yakin ingin menghapus pembelian ini? Stok akan dikurangi kembali.</p>
                <div class="flex gap-3">
                    <button wire:click.prevent="closeDeleteModal" class="flex-1 px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">Batal</button>
                    <button wire:click.prevent="delete" class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Hapus Sekarang</button>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
