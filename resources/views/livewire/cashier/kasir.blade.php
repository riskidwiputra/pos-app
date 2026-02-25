<div>
    <div class="h-screen flex bg-gray-50 overflow-hidden">
        {{-- Sidebar --}}
        <aside class="no-print flex-shrink-0 w-16 lg:w-20 bg-gradient-to-r from-blue-500 to-indigo-600  m-2 lg:m-4 rounded-2xl lg:rounded-3xl shadow-2xl flex flex-col items-center py-4 lg:py-6">
            <a href="{{ route('sale.index') }}" class="w-10 h-10 lg:w-14 lg:h-14 bg-white rounded-xl lg:rounded-2xl flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow">
                <svg class="w-6 h-6 lg:w-8 lg:h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </a>
            
            <div class="mt-8 lg:mt-12 flex flex-col items-center gap-3 lg:gap-4">
                <div class="w-10 h-10 lg:w-14 lg:h-14 bg-cyan-400 rounded-xl lg:rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </aside>

        {{-- Main Content Container --}}
        <main class="flex-1 flex gap-2 lg:gap-4 p-2 lg:p-4 overflow-hidden">
            {{-- Area Produk (65% dari lebar) --}}
            <section class="no-print flex flex-col overflow-hidden" style="width: 65%;">
                {{-- Search Bar --}}
                <div class="relative mb-3 lg:mb-4">
                    <svg class="absolute left-4 lg:left-6 top-3 lg:top-5 w-5 h-5 lg:w-6 lg:h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="searchTerm"
                        placeholder="Cari menu..."
                        class="w-full h-12 lg:h-16 pl-12 lg:pl-16 pr-4 lg:pr-6 text-sm lg:text-lg bg-white rounded-2xl lg:rounded-3xl shadow-lg focus:outline-none focus:ring-4 focus:ring-cyan-200 transition-all"
                    />
                </div>

                {{-- Filter Kategori --}}
                <div class="flex gap-2 mb-3 lg:mb-4 overflow-x-auto pb-2 scrollbar-hide">
                    <button 
                        wire:click="$set('selectedCategoryId', null)"
                        @class([
                            'px-3 lg:px-5 py-1.5 lg:py-2 rounded-full text-xs lg:text-sm font-semibold whitespace-nowrap transition-all flex-shrink-0',
                            'bg-cyan-500 text-white shadow-lg' => is_null($this->selectedCategoryId),
                            'bg-white text-gray-700 hover:bg-gray-50' => !is_null($this->selectedCategoryId)
                        ])>
                        Semua Produk
                    </button>
                    
                    @foreach($this->kategoriList as $kategori)
                        <button 
                            wire:click="$set('selectedCategoryId', {{ $kategori->id }})"
                            @class([
                                'px-3 lg:px-5 py-1.5 lg:py-2 rounded-full text-xs lg:text-sm font-semibold whitespace-nowrap transition-all flex-shrink-0',
                                'bg-cyan-500 text-white shadow-lg' => $this->selectedCategoryId === $kategori->id,
                                'bg-white text-gray-700 hover:bg-gray-50' => $this->selectedCategoryId !== $kategori->id
                            ])>
                            {{ $kategori->nama_kategori }} ({{ $kategori->products_count }})
                        </button>
                    @endforeach
                </div>

                {{-- Grid Produk --}}
                <div class="flex-1 overflow-y-auto scrollbar-hide">
                    @if($this->produkList->isEmpty())
                        <div class="h-full flex items-center justify-center bg-white rounded-2xl lg:rounded-3xl">
                            <div class="text-center opacity-40 p-4">
                                <svg class="w-16 h-16 lg:w-24 lg:h-24 mx-auto mb-2 lg:mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="text-base lg:text-xl font-bold text-gray-500">
                                    @if($searchTerm)
                                        Tidak ada hasil untuk "{{ $searchTerm }}"
                                    @else
                                        Tidak ada produk
                                    @endif
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-2 lg:gap-4 pb-4">
                            @foreach($this->produkList as $produk)
                                <button 
                                    wire:key="produk-{{ $produk['id'] }}"
                                    wire:click="tambahKeKeranjang({{ $produk['id'] }})"
                                    class="bg-white rounded-xl lg:rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:scale-105">
                                    <div class="aspect-square overflow-hidden bg-gray-100">
                                        <img 
                                            src="{{ $produk['foto'] }}" 
                                            alt="{{ $produk['nama'] }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                            loading="lazy"
                                        />
                                    </div>
                                    <div class="p-2 lg:p-3">
                                        <h3 class="font-bold text-gray-800 truncate text-xs lg:text-sm mb-0.5 lg:mb-1" title="{{ $produk['nama'] }}">
                                            {{ $produk['nama'] }}
                                        </h3>
                                        <p class="text-cyan-600 font-bold text-sm lg:text-lg">
                                            Rp {{ number_format($produk['harga'], 0, ',', '.') }}
                                        </p>
                                    </div>
                                </button>
                            @endforeach
                              <!-- Pagination -->
                           
                        </div>
                         <div class="mt-6">
                            {{ $this->produkList->links() }}
                        </div>
                    @endif
                </div>
            </section>

            {{-- Area Keranjang (35% dari lebar) --}}
            <aside class="no-print flex flex-col bg-white rounded-2xl lg:rounded-3xl shadow-2xl overflow-hidden" style="width: 35%;">
                {{-- Header Keranjang --}}
                <header class="h-14 lg:h-20 flex items-center justify-between px-4 lg:px-6 border-b flex-shrink-0">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        @if($this->totalItem > 0)
                            <span class="bg-cyan-500 text-white text-xs font-bold w-5 h-5 lg:w-6 lg:h-6 rounded-full flex items-center justify-center">
                                {{ $this->totalItem }}
                            </span>
                        @endif
                    </div>
                    @if(count($keranjang) > 0)
                        <button 
                            wire:click="kosongkanKeranjang"
                            wire:confirm="Yakin ingin mengosongkan keranjang?"
                            class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    @endif
                </header>

                {{-- Daftar Item Keranjang --}}
                <div class="flex-1 overflow-y-auto px-3 lg:px-4 py-3 lg:py-4 scrollbar-hide">
                    @if(empty($keranjang))
                        <div class="h-full flex items-center justify-center opacity-25">
                            <div class="text-center">
                                <svg class="w-16 h-16 lg:w-20 lg:h-20 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <p class="text-gray-600 font-bold text-xs lg:text-sm">KERANJANG KOSONG</p>
                            </div>
                        </div>
                    @else
                        <div class="space-y-2 lg:space-y-3">
                            @foreach($keranjang as $index => $item)
                                <div class="bg-gray-50 rounded-lg lg:rounded-xl p-2 lg:p-3 flex gap-2 lg:gap-3">
                                    <img 
                                        src="{{ $item['foto'] }}" 
                                        alt="{{ $item['nama'] }}"
                                        class="w-12 h-12 lg:w-16 lg:h-16 rounded-lg object-cover bg-white shadow flex-shrink-0"
                                    />
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-bold text-gray-800 text-xs lg:text-sm truncate">{{ $item['nama'] }}</h4>
                                        <p class="text-cyan-600 font-bold text-xs lg:text-base">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                                    </div>
                                    <div class="flex flex-col justify-center flex-shrink-0">
                                        <div class="flex items-center gap-1">
                                            <button 
                                                wire:click="ubahJumlah({{ $index }}, -1)"
                                                class="w-6 h-6 lg:w-7 lg:h-7 rounded-lg bg-gray-600 hover:bg-gray-700 text-white flex items-center justify-center transition-colors">
                                                <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                            <input 
                                                type="number"
                                                value="{{ $item['jumlah'] }}"
                                                wire:change="setJumlahManual({{ $index }}, $event.target.value)"
                                                class="w-10 h-6 lg:w-12 lg:h-7 text-center bg-white border-2 border-gray-200 rounded-lg focus:outline-none focus:border-cyan-500 text-xs lg:text-sm font-bold"
                                            />
                                            <button 
                                                wire:click="ubahJumlah({{ $index }}, 1)"
                                                class="w-6 h-6 lg:w-7 lg:h-7 rounded-lg bg-gray-600 hover:bg-gray-700 text-white flex items-center justify-center transition-colors">
                                                <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Area Pembayaran --}}
                <footer class="border-t p-3 lg:p-6 bg-gray-50 space-y-2 lg:space-y-4 flex-shrink-0">
                    <div class="flex justify-between items-center">
                        <span class="text-sm lg:text-lg font-bold text-gray-700">TOTAL</span>
                        <span class="text-xl lg:text-2xl font-bold text-gray-900">Rp {{ number_format($this->totalBelanja(), 0, ',', '.') }}</span>
                    </div>

                    <div class="bg-white rounded-xl p-3 lg:p-4 space-y-2 lg:space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-gray-700 text-xs lg:text-base">TUNAI</span>
                            <div class="flex items-center gap-1 lg:gap-2">
                                <span class="text-gray-600 text-xs lg:text-base">Rp</span>
                                <input 
                                    type="text"
                                    wire:model.live="tunai"
                                    class="w-24 lg:w-32 text-right bg-gray-50 border-2 border-gray-200 rounded-lg px-2 lg:px-3 py-1 lg:py-2 focus:outline-none focus:border-cyan-500 font-bold text-xs lg:text-base"
                                    placeholder="0"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-1 lg:gap-2">
                            @foreach([2000, 5000, 10000, 20000, 50000, 100000] as $nominal)
                                <button 
                                    wire:click="tambahTunai({{ $nominal }})"
                                    class="bg-gray-100 hover:bg-cyan-50 border-2 border-gray-200 hover:border-cyan-500 rounded-lg py-1 lg:py-2 text-xs lg:text-sm font-bold transition-colors">
                                    +{{ number_format($nominal/1000, 0) }}k
                                </button>
                            @endforeach
                        </div>
                    </div>

                    @if($this->kembalian() > 0)
                        <div class="bg-cyan-50 border-2 border-cyan-200 rounded-xl p-3 lg:p-4 flex justify-between items-center">
                            <span class="font-bold text-cyan-800 text-xs lg:text-base">KEMBALIAN</span>
                            <span class="text-lg lg:text-2xl font-bold text-cyan-600">Rp {{ number_format($this->kembalian(), 0, ',', '.') }}</span>
                        </div>
                    @elseif($this->kembalian() < 0 && $tunai > 0)
                        <div class="bg-red-50 border-2 border-red-200 rounded-xl p-3 lg:p-4 flex justify-end">
                            <span class="text-base lg:text-xl font-bold text-red-600">Rp {{ number_format($this->kembalian(), 0, ',', '.') }}</span>
                        </div>
                    @elseif($this->kembalian() == 0 && count($keranjang) > 0 && $tunai > 0)
                        <div class="bg-green-50 border-2 border-green-200 rounded-xl p-3 lg:p-4 flex justify-center items-center gap-2">
                            <svg class="w-5 h-5 lg:w-6 lg:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                            </svg>
                            <span class="font-bold text-green-700 text-xs lg:text-base">UANG PAS</span>
                        </div>
                    @endif

                    <button 
                        wire:click="prosesPembayaran"
                        @disabled(empty($keranjang) || $tunai < $this->totalBelanja())
                        @class([
                            'w-full py-2 lg:py-4 rounded-xl lg:rounded-2xl text-white text-sm lg:text-lg font-bold shadow-lg transition-all',
                            'bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 transform hover:scale-105' => !empty($keranjang) && $tunai >= $this->totalBelanja(),
                            'bg-gray-300 cursor-not-allowed' => empty($keranjang) || $tunai < $this->totalBelanja()
                        ])>
                        BAYAR SEKARANG
                    </button>
                </footer>
            </aside>
        </main>
    </div>

    {{-- Modal Struk --}}
    @if($showModalStruk)
        <div class="no-print fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50" wire:click.self="tutupModalStruk">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl w-full max-w-sm lg:max-w-md overflow-hidden">
                <div id="area-cetak" class="p-6 lg:p-8 max-h-[70vh] overflow-y-auto">
                    <div class="text-center mb-4 lg:mb-6">
                        <h2 class="text-xl lg:text-2xl font-bold text-gray-900">TOKO PERCETAKAN</h2>
                        <h3 class="text-lg lg:text-xl font-bold text-cyan-600">MATAHARI KISARAN</h3>
                        <p class="text-xs lg:text-sm text-gray-600 mt-1 lg:mt-2">Jl. Merdeka No. 123, Kisaran</p>
                        <p class="text-xs lg:text-sm text-gray-600">Telp: (0812) 3456-7890</p>
                    </div>

                    <div class="border-t-2 border-dashed border-gray-300 pt-3 lg:pt-4 mb-3 lg:mb-4 text-xs lg:text-sm">
                        <div class="flex justify-between mb-1">
                            <span class="font-semibold">No Invoice:</span>
                            <span>{{ $nomorInvoice }}</span>
                        </div>
                        <div class="flex justify-between mb-1">
                            <span class="font-semibold">Tanggal:</span>
                            <span>{{ $tanggalTransaksi }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Kasir:</span>
                            <span>{{ Auth::user()->fullname }}</span>
                        </div>
                    </div>

                    <table class="w-full text-xs lg:text-sm border-t-2 border-dashed border-gray-300 pt-3 lg:pt-4">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2">Item</th>
                                <th class="text-center py-2 w-12">Qty</th>
                                <th class="text-right py-2 w-20 lg:w-24">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keranjang as $item)
                                <tr class="border-b">
                                    <td class="py-2">
                                        <div class="font-medium">{{ $item['nama'] }}</div>
                                        <div class="text-xs text-gray-600">@ Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
                                    </td>
                                    <td class="text-center py-2">{{ $item['jumlah'] }}</td>
                                    <td class="text-right py-2 font-semibold">Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="border-t-2 border-dashed border-gray-300 pt-3 lg:pt-4 space-y-1 lg:space-y-2">
                        <div class="flex justify-between text-base lg:text-lg font-bold">
                            <span>TOTAL:</span>
                            <span>Rp {{ number_format($this->totalBelanja(), 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-xs lg:text-sm">
                            <span>Bayar:</span>
                            <span>Rp {{ number_format($tunai, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-base lg:text-lg font-bold text-cyan-600">
                            <span>KEMBALIAN:</span>
                            <span>Rp {{ number_format($this->kembalian(), 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-4 lg:mt-6 text-center text-xs text-gray-600 border-t-2 border-dashed border-gray-300 pt-3 lg:pt-4">
                        <p>Terima kasih atas kunjungan Anda</p>
                        <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
                    </div>
                </div>

                <div class="p-4 lg:p-6 bg-gray-50 border-t flex gap-2 lg:gap-3">
                    <button 
                        onclick="window.print()"
                        class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-2 lg:py-3 rounded-xl transition-all text-xs lg:text-base">
                        <svg class="w-4 h-4 lg:w-5 lg:h-5 inline mr-1 lg:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak
                    </button>
                    <button 
                        wire:click="tutupModalStruk"
                        class="flex-1 bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white font-bold py-2 lg:py-3 rounded-xl transition-all text-xs lg:text-base">
                        Transaksi Baru
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Custom Styles --}}
    <style>
        /* Hide scrollbar */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</div>
