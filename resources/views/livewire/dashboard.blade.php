<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-6 px-4">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Dashboard
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">Selamat datang, {{ Auth::user()->fullname }}</p>
                </div>
                <div class="flex gap-2">
                    <select 
                        wire:model.live="periode"
                        class="px-4 py-2 text-sm border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 bg-white">
                        <option value="hari_ini">Hari Ini</option>
                        <option value="minggu_ini">Minggu Ini</option>
                        <option value="bulan_ini">Bulan Ini</option>
                        <option value="tahun_ini">Tahun Ini</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Summary Cards - Penjualan --}}
        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Ringkasan Penjualan
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Total Penjualan --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-5 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-green-100 to-emerald-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1">Total Penjualan</p>
                    <p class="text-xl lg:text-2xl font-bold text-gray-900">Rp {{ number_format($this->summaryPenjualan()['total_penjualan'], 0, ',', '.') }}</p>
                </div>

                {{-- Total Transaksi --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-5 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1">Total Transaksi</p>
                    <p class="text-xl lg:text-2xl font-bold text-gray-900">{{ number_format($this->summaryPenjualan()['total_transaksi']) }}</p>
                </div>

                {{-- Lunas --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-5 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1">Penjualan Lunas</p>
                    <p class="text-xl lg:text-2xl font-bold text-gray-900">Rp {{ number_format($this->summaryPenjualan()['total_lunas'], 0, ',', '.') }}</p>
                </div>

                {{-- Keuntungan --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-5 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-amber-100 to-orange-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1">Keuntungan</p>
                    <p class="text-xl lg:text-2xl font-bold text-gray-900">Rp {{ number_format($this->summaryPenjualan()['keuntungan'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- Summary Cards - Stok & Order Jasa --}}
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-12 mb-6">
            {{-- Stok Produk --}}
            <div>
                <h2 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Status Stok Produk
                </h2>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4">
                        <p class="text-xs text-gray-500 font-medium mb-1">Total Produk</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($this->summaryStok()['total_produk']) }}</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4">
                        <p class="text-xs text-gray-500 font-medium mb-1">Tersedia</p>
                        <p class="text-2xl font-bold text-green-600">{{ number_format($this->summaryStok()['produk_tersedia']) }}</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4">
                        <p class="text-xs text-gray-500 font-medium mb-1">Stok Menipis</p>
                        <p class="text-2xl font-bold text-amber-600">{{ number_format($this->summaryStok()['stok_menipis']) }}</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4">
                        <p class="text-xs text-gray-500 font-medium mb-1">Stok Habis</p>
                        <p class="text-2xl font-bold text-red-600">{{ number_format($this->summaryStok()['stok_habis']) }}</p>
                    </div>
                </div>
            </div>

           
        </div>

        {{-- Charts --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            {{-- Grafik Penjualan 7 Hari --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-5">
                <h3 class="text-base font-bold text-gray-900 mb-4">Penjualan 7 Hari Terakhir</h3>
                <div class="h-64" 
                    x-data="{ 
                        chart: null,
                        init() {
                            const ctx = this.$refs.canvas.getContext('2d');
                            this.chart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: @js($this->grafikPenjualanMingguan()['labels']),
                                    datasets: [{
                                        label: 'Pendapatan (Rp)',
                                        data: @js($this->grafikPenjualanMingguan()['values']),
                                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                        borderColor: 'rgb(59, 130, 246)',
                                        borderWidth: 3,
                                        fill: true,
                                        tension: 0.4,
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

            {{-- Grafik Penjualan Bulanan --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-5">
                <h3 class="text-base font-bold text-gray-900 mb-4">Penjualan Per Bulan (Tahun Ini)</h3>
                <div class="h-64" 
                    x-data="{ 
                        chart: null,
                        init() {
                            const ctx = this.$refs.canvas.getContext('2d');
                            this.chart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: @js($this->grafikPenjualanBulanan()['labels']),
                                    datasets: [{
                                        label: 'Pendapatan (Rp)',
                                        data: @js($this->grafikPenjualanBulanan()['values']),
                                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                                        borderColor: 'rgb(16, 185, 129)',
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
                                                    return 'Rp ' + (value / 1000000) + 'jt';
                                                }
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

        {{-- Tables --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Produk Terlaris --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-5 border-b">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Top 5 Produk Terlaris
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600">PRODUK</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-600">TERJUAL</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-gray-600">PENDAPATAN</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse($this->produkTerlaris() as $index => $produk)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold flex items-center justify-center">
                                                {{ $index + 1 }}
                                            </span>
                                            <span class="text-sm font-semibold text-gray-900">{{ $produk->product_name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="text-sm font-bold text-gray-900">{{ number_format($produk->total_terjual) }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <span class="text-sm font-bold text-green-600">Rp {{ number_format($produk->total_pendapatan, 0, ',', '.') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-8 text-center text-sm text-gray-500">
                                        Belum ada data penjualan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Transaksi Terbaru --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-5 border-b">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Transaksi Terbaru
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600">INVOICE</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600">CUSTOMER</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-gray-600">TOTAL</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-600">STATUS</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse($this->transaksiTerbaru() as $transaksi)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="text-xs font-semibold text-blue-600">{{ $transaksi->invoice_number }}</div>
                                        <div class="text-xs text-gray-500">{{ $transaksi->transaction_date->format('d/m/Y H:i') }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-xs text-gray-900">{{ $transaksi->customer->fullname ?? 'Umum' }}</td>
                                    <td class="px-4 py-3 text-right text-xs font-bold text-gray-900">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $transaksi->status === 'Lunas' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $transaksi->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">
                                        Belum ada transaksi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Stok Menipis --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-5 border-b">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        Stok Menipis
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600">PRODUK</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600">KATEGORI</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-600">STOK</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse($this->stokMenipis() as $produk)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-xs font-semibold text-gray-900">{{ $produk->nama_produk }}</td>
                                    <td class="px-4 py-3 text-xs text-gray-600">{{ $produk->category->nama_kategori ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                            {{ $produk->stok_tersedia }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-8 text-center text-sm text-gray-500">
                                        Stok aman
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Order Jasa Terbaru --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-5 border-b">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Order Jasa Terbaru
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600">KODE ORDER</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600">JASA</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-600">STATUS</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse($this->orderJasaTerbaru() as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="text-xs font-semibold text-purple-600">{{ $order->order_code }}</div>
                                        <div class="text-xs text-gray-500">{{ $order->created_at->format('d/m/Y') }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-xs text-gray-900">{{ $order->subCategory->nama_sub_kategori ?? $order->category->nama_kategori }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span @class([
                                            'inline-flex px-2 py-1 rounded-full text-xs font-semibold',
                                            'bg-yellow-100 text-yellow-700' => $order->status === 'pending',
                                            'bg-blue-100 text-blue-700' => $order->status === 'approved',
                                            'bg-indigo-100 text-indigo-700' => $order->status === 'in_progress',
                                            'bg-green-100 text-green-700' => $order->status === 'completed',
                                        ])>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-8 text-center text-sm text-gray-500">
                                        Belum ada order jasa
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush