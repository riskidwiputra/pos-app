@props(['active' => ''])

<div class="bg-white rounded-2xl shadow-lg mb-6 overflow-hidden">
    <div class="flex border-b">
        <a 
            href="{{ route('laporan.penjualan.transaksi') }}"
            @class([
                'flex-1 px-6 py-4 font-semibold transition-all relative',
                'text-blue-600 bg-blue-50' => $active === 'transaksi',
                'text-gray-600 hover:bg-gray-50' => $active !== 'transaksi'
            ])>
            <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Laporan Per Transaksi
            </div>
            @if($active === 'transaksi')
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-blue-600"></div>
            @endif
        </a>

        <a 
            href="{{ route('laporan.penjualan.per-item') }}"
            @class([
                'flex-1 px-6 py-4 font-semibold transition-all relative',
                'text-blue-600 bg-blue-50' => $active === 'per-item',
                'text-gray-600 hover:bg-gray-50' => $active !== 'per-item'
            ])>
            <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Laporan Per Item
            </div>
            @if($active === 'per-item')
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-blue-600"></div>
            @endif
        </a>

        

        <a 
            href="{{ route('laporan.stok') }}"
            @class([
                'flex-1 px-6 py-4 font-semibold transition-all relative',
                'text-blue-600 bg-blue-50' => $active === 'stok',
                'text-gray-600 hover:bg-gray-50' => $active !== 'stok'
            ])>
            <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Laporan Stok
            </div>
            @if($active === 'stok')
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-blue-600"></div>
            @endif
        </a>
    </div>
</div>