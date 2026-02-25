<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Laporan Penjualan
                </h1>
                <p class="text-sm text-gray-500 mt-1">Analisis transaksi penjualan per periode</p>
            </div>
            <div class="flex gap-2">
                <button 
                    wire:click="exportPDF"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl shadow-lg transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Export PDF
                </button>
            </div>
        </div>

        {{-- Tab Navigation --}}
        <x-laporan-navigation active="transaksi" />

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

        {{-- Ringkasan --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Total Transaksi</p>
                    <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold">{{ number_format($this->ringkasanTransaksi()['total_transaksi']) }}</h3>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Total Pendapatan</p>
                    <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold">Rp {{ number_format($this->ringkasanTransaksi()['total_pendapatan'], 0, ',', '.') }}</h3>
            </div>

            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Total Keuntungan</p>
                    <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold">Rp {{ number_format($this->ringkasanTransaksi()['total_keuntungan'], 0, ',', '.') }}</h3>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Item Terjual</p>
                    <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold">{{ number_format($this->ringkasanTransaksi()['total_item_terjual']) }}</h3>
            </div>
        </div>

        {{-- Grafik --}}
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Grafik Penjualan Harian</h3>
            <div class="h-80" 
                x-data="{ 
                    chart: null,
                    init() {
                        const ctx = this.$refs.canvas.getContext('2d');
                        this.chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: @js($this->grafikHarian()['labels']),
                                datasets: [{
                                    label: 'Pendapatan (Rp)',
                                    data: @js($this->grafikHarian()['values']),
                                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                    borderColor: 'rgb(59, 130, 246)',
                                    borderWidth: 2,
                                    borderRadius: 8,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: { display: false },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            callback: function(value) {
                                                return 'Rp ' + (value / 1000) + 'k';
                                            }
                                        },
                                        grid: {
                                            color: 'rgba(0, 0, 0, 0.05)'
                                        }
                                    },
                                    x: {
                                        grid: {
                                            display: false
                                        }
                                    }
                                }
                            }
                        });
                    }
                }">
                <canvas x-ref="canvas"></canvas>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush