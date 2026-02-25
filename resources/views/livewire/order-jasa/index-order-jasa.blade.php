<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <!-- Header -->
    <div>
        <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Kelola Order Jasa
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Manajemen pesanan jasa percetakan
        </p>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-3">

        <!-- Setting Kategori -->
        <a 
            href="{{ route('order-jasa.setting-kategori') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 
                   bg-gradient-to-r from-blue-500 to-indigo-600 
                   hover:from-blue-600 hover:to-indigo-700
                   text-white text-sm font-semibold
                   rounded-xl shadow-md 
                   transition-all duration-200 transform hover:scale-105"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M11.983 2.25c.414 0 .75.336.75.75v1.257a7.501 7.501 0 012.196.91l.889-.889a.75.75 0 011.06 0l1.344 1.344a.75.75 0 010 1.06l-.889.889c.39.68.696 1.412.91 2.196H21a.75.75 0 01.75.75v1.5a.75.75 0 01-.75.75h-1.257a7.501 7.501 0 01-.91 2.196l.889.889a.75.75 0 010 1.06l-1.344 1.344a.75.75 0 01-1.06 0l-.889-.889a7.501 7.501 0 01-2.196.91V21a.75.75 0 01-.75.75h-1.5a.75.75 0 01-.75-.75v-1.257a7.501 7.501 0 01-2.196-.91l-.889.889a.75.75 0 01-1.06 0l-1.344-1.344a.75.75 0 010-1.06l.889-.889a7.501 7.501 0 01-.91-2.196H3a.75.75 0 01-.75-.75v-1.5A.75.75 0 013 9.75h1.257c.214-.784.52-1.516.91-2.196l-.889-.889a.75.75 0 010-1.06L5.622 4.26a.75.75 0 011.06 0l.889.889a7.501 7.501 0 012.196-.91V3a.75.75 0 01.75-.75h1.466z" />
    <circle cx="12" cy="12" r="3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
</svg>
            Setting Kategori
        </a>

        <!-- Tambah Order -->
        <a 
            href="{{ route('order-jasa.create') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 
                   bg-gradient-to-r from-blue-500 to-indigo-600 
                   hover:from-blue-600 hover:to-indigo-700
                   text-white text-sm font-semibold
                   rounded-xl shadow-md 
                   transition-all duration-200 transform hover:scale-105"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Order
        </a>

    </div>
</div>

            {{-- Flash Message --}}
            @if(session()->has('success'))
                <div class="mb-6 animate-in slide-in-from-top fade-in duration-500">
                    <div class="rounded-xl bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="mb-6 animate-in slide-in-from-top fade-in duration-500">
                    <div class="rounded-xl bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-red-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <p class="text-red-800 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Statistik Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-gray-400">
                <p class="text-xs font-medium text-gray-500 mb-1">Total Order</p>
                <p class="text-2xl font-bold text-gray-900">{{ $this->statistik()['total'] }}</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-yellow-400">
                <p class="text-xs font-medium text-gray-500 mb-1">Menunggu</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $this->statistik()['pending'] }}</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-blue-400">
                <p class="text-xs font-medium text-gray-500 mb-1">Disetujui</p>
                <p class="text-2xl font-bold text-blue-600">{{ $this->statistik()['approved'] }}</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-red-400">
                <p class="text-xs font-medium text-gray-500 mb-1">Ditolak</p>
                <p class="text-2xl font-bold text-red-600">{{ $this->statistik()['rejected'] }}</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-purple-400">
                <p class="text-xs font-medium text-gray-500 mb-1">Diproses</p>
                <p class="text-2xl font-bold text-purple-600">{{ $this->statistik()['in_progress'] }}</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-green-400">
                <p class="text-xs font-medium text-gray-500 mb-1">Selesai</p>
                <p class="text-2xl font-bold text-green-600">{{ $this->statistik()['completed'] }}</p>
            </div>
        </div>

        {{-- Filter & Search --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pencarian</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input 
                            type="text" 
                            wire:model.live.debounce.500ms="pencarian"
                            placeholder="Cari kode order / nama customer / judul order..."
                            class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all"
                        />
                    </div>
                </div>

                <div class="md:col-span-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select 
                        wire:model.live="statusFilter"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 cursor-pointer transition-all">
                        <option value="">Semua Status</option>
                        <option value="pending">Menunggu Persetujuan</option>
                        <option value="approved">Disetujui</option>
                        <option value="rejected">Ditolak</option>
                        <option value="in_progress">Sedang Diproses</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Per Halaman</label>
                    <select 
                        wire:model.live="perPage"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 cursor-pointer transition-all">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex items-end">
                    <button 
                        wire:click="resetFilter"
                        class="w-full px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-50 via-blue-50 to-slate-50 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">Kode Order</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">Jasa</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-widest text-gray-600">Total</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest text-gray-600">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($this->orders() as $index => $order)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    {{ $this->orders()->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-bold text-blue-600">{{ $order->order_code }}</p>
                                        <p class="text-xs text-gray-500">{{ $order->order_date->format('d M Y') }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $order->customer_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $order->customer_phone }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $order->order_title }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">
                                                {{ $order->category->nama_kategori }}
                                            </span>
                                            @if($order->subCategory)
                                                <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">
                                                    {{ $order->subCategory->nama_sub_kategori }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <p class="font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    @if($order->down_payment > 0)
                                        <p class="text-xs text-green-600">DP: Rp {{ number_format($order->down_payment, 0, ',', '.') }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-{{ $order->status_color }}-100 text-{{ $order->status_color }}-700">
                                        {{ $order->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a 
                                            href="{{ route('order-jasa.detail', $order->id) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Detail
                                        </a>

                                        @if($order->canBeApproved())
                                            <button 
                                                wire:click="confirmApprove({{ $order->id }})"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-xs font-semibold rounded-lg transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Setujui
                                            </button>
                                        @endif

                                        @if($order->canBeRejected())
                                            <button 
                                                wire:click="confirmReject({{ $order->id }})"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Tolak
                                            </button>
                                        @endif

                                        <button 
                                            wire:click="confirmDelete({{ $order->id }})"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-gray-500 hover:bg-gray-600 text-white text-xs font-semibold rounded-lg transition-all">
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
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-lg font-semibold">Belum ada order jasa</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $this->orders()->links() }}
            </div>
        </div>

    </div>

    {{-- Modal Approve --}}
    @if($showApproveModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data @keydown.escape.window="$wire.closeApproveModal()">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 bg-black/50 transition-opacity" wire:click="closeApproveModal"></div>
                
                <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Setujui Order Jasa?</h3>
                        <p class="text-gray-600 mb-6">
                            Apakah Anda yakin ingin menyetujui order jasa ini? Order akan masuk ke tahap pengerjaan.
                        </p>
                    </div>

                    <div class="flex gap-3">
                        <button 
                            wire:click="closeApproveModal"
                            class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all">
                            Batal
                        </button>
                        <button 
                            wire:click="approve"
                            class="flex-1 px-4 py-2.5 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl transition-all">
                            Ya, Setujui
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal Reject --}}
    @if($showRejectModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data @keydown.escape.window="$wire.closeRejectModal()">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 bg-black/50 transition-opacity" wire:click="closeRejectModal"></div>
                
                <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                    <div class="text-center mb-4">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                            <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Tolak Order Jasa?</h3>
                        <p class="text-gray-600 mb-4">
                            Silakan berikan alasan penolakan order ini.
                        </p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan Penolakan *</label>
                        <textarea 
                            wire:model="rejectionReason"
                            rows="4"
                            placeholder="Tuliskan alasan penolakan..."
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-red-500 resize-none"
                        ></textarea>
                        @error('rejectionReason')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button 
                            wire:click="closeRejectModal"
                            class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all">
                            Batal
                        </button>
                        <button 
                            wire:click="reject"
                            class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition-all">
                            Tolak Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal Delete --}}
    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data @keydown.escape.window="$wire.closeDeleteModal()">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 bg-black/50 transition-opacity" wire:click="closeDeleteModal"></div>
                
                <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                            <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Order Jasa?</h3>
                        <p class="text-gray-600 mb-6">
                            Data order yang dihapus tidak dapat dikembalikan. Apakah Anda yakin?
                        </p>
                    </div>

                    <div class="flex gap-3">
                        <button 
                            wire:click="closeDeleteModal"
                            class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all">
                            Batal
                        </button>
                        <button 
                            wire:click="delete"
                            class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition-all">
                            Ya, Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>