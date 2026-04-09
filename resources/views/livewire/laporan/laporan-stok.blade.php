<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Laporan Stok Barang
                </h1>
            </div>
            
        </div>


       

        {{-- Statistik Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium text-gray-500">Total Produk</p>
                    
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ number_format($this->ringkasanStok()['total_produk']) }}</h3>
                <p class="text-xs text-gray-500 mt-1">Jenis produk</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium text-gray-500">Total Item</p>
                   
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ number_format($this->ringkasanStok()['total_item']) }}</h3>
                <p class="text-xs text-gray-500 mt-1">Quantity tersedia</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium text-gray-500">Nilai Stok</p>
                    
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Rp {{ number_format($this->ringkasanStok()['nilai_stok'], 0, ',', '.') }}</h3>
                <p class="text-xs text-gray-500 mt-1">Total nilai inventori</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-emerald-500">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium text-gray-500">Stok Aman</p>
                 
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ number_format($this->ringkasanStok()['stok_aman']) }}</h3>
                <p class="text-xs text-gray-500 mt-1">Produk stok mencukupi</p>
            </div>
        </div>

        {{-- Filter Section --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pencarian</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input 
                            type="text" 
                            wire:model.live.debounce.500ms="pencarian"
                            placeholder="Cari kode / nama produk..."
                            class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all"
                        />
                    </div>
                </div>

                <div class="md:col-span-3">
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

                <div class="md:col-span-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status Stok</label>
                    <select 
                        wire:model.live="statusStok"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 cursor-pointer transition-all">
                        <option value="semua">Semua Status</option>
                        <option value="habis"> Habis (0)</option>
                        <option value="kritis"> Kritis (1-{{ $batasKritis }})</option>
                        <option value="rendah"> Rendah ({{ $batasKritis + 1 }}-{{ $batasRendah }})</option>
                        <option value="aman"> Aman (>{{ $batasRendah }})</option>
                    </select>
                </div>

                
            </div>
        </div>

         {{-- Alert Cards - Peringatan Stok --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            {{-- Stok Habis --}}
            @if($this->ringkasanStok()['stok_habis'] > 0)
            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl shadow-lg p-6 text-white animate-pulse">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        
                        <div>
                            <p class="text-sm font-medium opacity-90">STOK HABIS!</p>
                            <p class="text-3xl font-bold">{{ $this->ringkasanStok()['stok_habis'] }}</p>
                        </div>
                    </div>
                    <button 
                        wire:click="$set('statusStok', 'habis')"
                        class="px-3 py-1 bg-white/20 hover:bg-white/30 rounded-lg text-xs font-semibold transition-all">
                        Lihat
                    </button>
                </div>
                <p class="text-xs opacity-75">Produk memerlukan restock segera!</p>
            </div>
            @endif

            {{-- Stok Kritis --}}
            @if($this->ringkasanStok()['stok_kritis'] > 0)
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        
                        <div>
                            <p class="text-sm font-medium opacity-90">STOK KRITIS</p>
                            <p class="text-3xl font-bold">{{ $this->ringkasanStok()['stok_kritis'] }}</p>
                        </div>
                    </div>
                    <button 
                        wire:click="$set('statusStok', 'kritis')"
                        class="px-3 py-1 bg-white/20 hover:bg-white/30 rounded-lg text-xs font-semibold transition-all">
                        Lihat
                    </button>
                </div>
                <p class="text-xs opacity-75">Stok ≤ {{ $batasKritis }} - Perlu segera diorder</p>
            </div>
            @endif

            {{-- Stok Rendah --}}
            @if($this->ringkasanStok()['stok_rendah'] > 0)
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        
                        <div>
                            <p class="text-sm font-medium opacity-90">STOK RENDAH</p>
                            <p class="text-3xl font-bold">{{ $this->ringkasanStok()['stok_rendah'] }}</p>
                        </div>
                    </div>
                    <button 
                        wire:click="$set('statusStok', 'rendah')"
                        class="px-3 py-1 bg-white/20 hover:bg-white/30 rounded-lg text-xs font-semibold transition-all">
                        Lihat
                    </button>
                </div>
                <p class="text-xs opacity-75">Stok {{ $batasKritis + 1 }}-{{ $batasRendah }} - Perhatikan stok</p>
            </div>
            @endif
        </div>
        {{-- Tabel Stok --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-50 via-blue-50 to-slate-50 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">Kode Produk</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-gray-600">Nama Produk</th>
                            <th class="px-6 py-4 text-center">
                                <button wire:click="sortByColumn('stok_tersedia')" class="flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-gray-600 hover:text-blue-600 mx-auto">
                                    Stok Tersedia
                                    @if($sortBy === 'stok_tersedia')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                        </svg>
                                    @endif
                                </button>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest text-gray-600">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-widest text-gray-600">Harga Jual</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-widest text-gray-600">Nilai Stok</th>
                            
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($this->laporanStok() as $index => $produk)
                            @php
                                $statusInfo = $this->getStatusStok($produk->stok_tersedia);
                            @endphp
                            <tr class="hover:bg-blue-50 transition-colors {{ $statusInfo['alert_level'] === 'danger' ? 'bg-red-50' : ($statusInfo['alert_level'] === 'critical' ? 'bg-orange-50' : '') }}">
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">
                                    {{ $this->laporanStok()->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-mono text-sm text-gray-700">{{ $produk->kode_produk }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $produk->nama_produk }}</p>
                                        @if($produk->category)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700 mt-1">
                                                {{ $produk->category->nama_kategori }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="text-2xl font-bold {{ $statusInfo['icon_class'] }}">
                                            {{ $produk->stok_tersedia }}
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $produk->unit->singkatan ?? 'pcs' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold border-2 {{ $statusInfo['class'] }}">
                                        @if($statusInfo['status'] === 'Habis')
                                           
                                        @elseif($statusInfo['status'] === 'Kritis')
                                           
                                        @elseif($statusInfo['status'] === 'Rendah')
                                          
                                        @else
                                           
                                        @endif
                                        {{ $statusInfo['status'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-semibold text-gray-900">
                                        Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-bold text-green-600">
                                        Rp {{ number_format($produk->stok_tersedia * $produk->harga_jual, 0, ',', '.') }}
                                    </span>
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                        </svg>
                                        <p class="text-lg font-semibold">Tidak ada data stok</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $this->laporanStok()->links() }}
            </div>
        </div>

        
        

    </div>
</div>

