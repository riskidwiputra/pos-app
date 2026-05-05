<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-6 px-4">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Dashboard
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">Selamat datang, {{ Auth::user()->name }}</p>
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

      

        {{-- Tables --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Produk Terlaris --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-5 border-b">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                       
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