<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Laporan Penjualan  Item
                </h1>
                
            </div>
           
        </div>


        {{-- Filter Section (PERTAMA) --}}
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
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input 
                            type="text" 
                            wire:model.live.debounce.500ms="pencarian"
                            placeholder="Cari nama produk..."
                            class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all"
                        />
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <select 
                        wire:model.live="kategoriFilter"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 cursor-pointer transition-all">
                        <option value="">Semua Kategori</option>
                        @foreach($this->kategoriList() as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Menampilkan {{ $this->laporanPerItem()->total() }} produk</span>
                </div>
                
            </div>
        </div>

        {{-- Tabel Data (KEDUA) --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-50 via-blue-50 to-slate-50 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">Nama Produk</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-widest text-gray-600">Harga Jual</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-widest text-gray-600">Harga Beli</th>
                            <th class="px-6 py-4 text-center">
                                <button wire:click="sortByColumn('total_terjual')" class="flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-gray-600 hover:text-blue-600 mx-auto">
                                    Total Terjual
                                    @if($sortBy === 'total_terjual')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                        </svg>
                                    @endif
                                </button>
                            </th>
                            <th class="px-6 py-4 text-right">
                                <button wire:click="sortByColumn('total_pendapatan')" class="flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-gray-600 hover:text-blue-600 ml-auto">
                                    Total Pendapatan
                                    @if($sortBy === 'total_pendapatan')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                        </svg>
                                    @endif
                                </button>
                            </th>
                          
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-widest text-gray-600">Total Keuntungan</th>
                           
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($this->laporanPerItem() as $index => $item)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">
                                    {{ $this->laporanPerItem()->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $item->nama_produk }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs text-gray-500">{{ $item->kode_produk }}</span>
                                            @if($item->nama_kategori)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                                    {{ $item->nama_kategori }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-semibold text-gray-900">
                                        Rp {{ number_format($item->harga_jual_avg, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-semibold text-gray-700">
                                        Rp {{ number_format($item->harga_beli_avg, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-purple-100 text-purple-800 text-sm font-bold">
                                            {{ number_format($item->total_terjual) }}
                                        </span>
                                        <span class="text-xs text-gray-500 mt-1">
                                            {{ $item->jumlah_transaksi }} transaksi
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-bold text-green-600">
                                        Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex flex-col items-end">
                                        <span class="font-bold {{ $item->total_keuntungan >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                            Rp {{ number_format($item->total_keuntungan, 0, ',', '.') }}
                                        </span>
                                       
                                    </div>
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                      
                                        <p class="text-lg font-semibold">Tidak ada data produk</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $this->laporanPerItem()->links() }}
            </div>
        </div>

       

        

    </div>
</div>

