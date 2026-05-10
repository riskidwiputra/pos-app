<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Laporan  Transaksi
                </h1>
                
            </div>
            <div class="flex gap-2">
                <button 
                    wire:click="exportPDF"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-70 cursor-not-allowed"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl shadow-lg transition-all">
                    
                    {{-- Tampil saat normal --}}
                    <span wire:loading.remove wire:target="exportPDF" class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Cetak Laporan PDF
                    </span>

                    {{-- Tampil saat loading --}}
                    <span wire:loading wire:target="exportPDF" class="flex items-center gap-2">
                        <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Memproses...
                    </span>

                </button>
            </div>
        </div>

        
         {{-- Ringkasan --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Total Transaksi</p>
                   
                </div>
                <h3 class="text-3xl font-bold">{{ number_format($this->ringkasanTransaksi()['total_transaksi']) }}</h3>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Total Pendapatan</p>
                    
                </div>
                <h3 class="text-2xl font-bold">Rp {{ number_format($this->ringkasanTransaksi()['total_pendapatan'], 0, ',', '.') }}</h3>
            </div>

            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Total Keuntungan</p>
                   
                </div>
                <h3 class="text-2xl font-bold">Rp {{ number_format($this->ringkasanTransaksi()['total_keuntungan'], 0, ',', '.') }}</h3>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Item Terjual</p>
                  
                </div>
                <h3 class="text-3xl font-bold">{{ number_format($this->ringkasanTransaksi()['total_item_terjual']) }}</h3>
            </div>
        </div>

        {{-- Filter Section --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                    <input 
                        type="date" 
                        wire:model.live="tanggalMulai"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all"
                    />
                </div>

                <div class="md:col-span-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Selesai</label>
                    <input 
                        type="date" 
                        wire:model.live="tanggalSelesai"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all"
                    />
                </div>

                <div class="md:col-span-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pencarian</label>
                    <input 
                        type="text" 
                        wire:model.live.debounce.500ms="pencarian"
                        placeholder="Cari Invoice / Nama Pelanggan..."
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all"
                    />
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select 
                        wire:model.live="statusFilter"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 cursor-pointer transition-all">
                        <option value="">Semua Status</option>
                        <option value="Lunas">Lunas</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Tabel Data --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-50 via-blue-50 to-slate-50 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">No Invoice</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">Pelanggan</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest text-gray-600">Total Item</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-widest text-gray-600">Total Harga</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-widest text-gray-600">Keuntungan</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest text-gray-600">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($this->laporanTransaksi() as $index => $penjualan)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">
                                    {{ $this->laporanTransaksi()->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ $penjualan->transaction_date->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $penjualan->transaction_date->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-blue-600">
                                        {{ $penjualan->invoice_number }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900">
                                        {{ $penjualan->customer->fullname ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-800 text-sm font-semibold">
                                        {{ $penjualan->items->sum('quantity') }} item
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-bold text-gray-900">
                                        Rp {{ number_format($penjualan->total, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-bold text-green-600">
                                        Rp {{ number_format($this->hitungKeuntungan($penjualan), 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span @class([
                                        'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold',
                                        'bg-emerald-100 text-emerald-700' => $penjualan->status === 'Lunas',
                                        'bg-red-100 text-red-700' => $penjualan->status === 'Dibatalkan'
                                    ])>
                                        {{ $penjualan->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a 
                                        href="{{ route('sale.detail', $penjualan->id) }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-lg font-semibold">Tidak ada data transaksi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $this->laporanTransaksi()->links() }}
            </div>
        </div>
        

       
        

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush