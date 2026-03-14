@extends('layouts.kasir-layout2')

@section('title', 'Kasir')

@section('content')
<div class="h-screen flex bg-gray-50 overflow-hidden">
    {{-- Sidebar --}}
    <aside class="no-print flex-shrink-0 w-16 lg:w-20 bg-gradient-to-r from-blue-500 to-indigo-600 m-2 lg:m-4 rounded-2xl lg:rounded-3xl shadow-2xl flex flex-col items-center py-4 lg:py-6">
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

    {{-- Mobile Toggle Buttons --}}
   <div class="lg:hidden fixed bottom-4 left-0 right-0 z-50 flex gap-2 px-4 pointer-events-none">
    <div class="w-full flex gap-2 pointer-events-auto">
        <button 
            onclick="toggleSection('produk')"
            id="btn-produk"
            class="flex-1 bg-cyan-600 text-white font-bold py-3 rounded-xl shadow-lg transition-all">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Produk
        </button>
        <button 
            onclick="toggleSection('keranjang')"
            id="btn-keranjang"
            class="flex-1 bg-gray-600 text-white font-bold py-3 rounded-xl shadow-lg transition-all">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Keranjang
            <span id="badge-total-item" class="ml-1 bg-white text-cyan-600 px-2 py-0.5 rounded-full text-xs font-bold hidden">0</span>
        </button>
    </div>
</div>

    {{-- Main Content --}}
    <main class="flex-1 flex gap-2 lg:gap-4 p-2 lg:p-4 overflow-hidden pb-4 lg:pb-4">
        {{-- Area Produk --}}
        
        <section id="section-produk" class="no-print flex flex-col overflow-hidden w-full lg:w-[65%] lg:block">
        {{-- Search Bar --}}
        <form method="GET" action="{{ route('cashier') }}" class="relative mb-3 lg:mb-4 flex-shrink-0">
            <svg class="absolute left-4 lg:left-6 top-3 lg:top-5 w-5 h-5 lg:w-6 lg:h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input 
                type="text" 
                name="search"
                value="{{ $searchTerm }}"
                placeholder="Cari menu..."
                class="w-full h-12 lg:h-16 pl-12 lg:pl-16 pr-4 lg:pr-6 text-sm lg:text-lg bg-white rounded-2xl lg:rounded-3xl shadow-lg focus:outline-none focus:ring-4 focus:ring-cyan-200 transition-all"
            />
            <input type="hidden" name="category" value="{{ $selectedCategoryId }}">
        </form>

        {{-- Filter Kategori --}}
        <div class="flex gap-2 mb-3 lg:mb-4 overflow-x-auto pb-2 scrollbar-hide flex-shrink-0">
            <a 
                href="{{ route('cashier') }}"
                class="px-3 lg:px-5 py-1.5 lg:py-2 rounded-full text-xs lg:text-sm font-semibold whitespace-nowrap transition-all flex-shrink-0 {{ is_null($selectedCategoryId) ? 'bg-cyan-500 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                Semua Produk
            </a>
            
            @foreach($categories as $kategori)
                <a 
                    href="{{ route('cashier', ['category' => $kategori->id, 'search' => $searchTerm]) }}"
                    class="px-3 lg:px-5 py-1.5 lg:py-2 rounded-full text-xs lg:text-sm font-semibold whitespace-nowrap transition-all flex-shrink-0 {{ $selectedCategoryId == $kategori->id ? 'bg-cyan-500 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    {{ $kategori->nama_kategori }} ({{ $kategori->products_count }})
                </a>
            @endforeach
        </div>

        {{-- Grid Produk + Pagination --}}
        <div class="flex-1 overflow-y-auto scrollbar-hide">
            <div class="min-h-full pb-20 lg:pb-6">
                @if($products->isEmpty())
                    <div class="h-full min-h-[400px] flex items-center justify-center bg-white rounded-2xl lg:rounded-3xl">
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
                    {{-- Grid Produk --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-2 lg:gap-4">
                        @foreach($products as $produk)
                            <button 
                                onclick="tambahKeKeranjang({{ $produk['id'] }})"
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
                    </div>
                    
                    {{-- Pagination --}}
                    <div class="mt-6 mb-4 relative z-10">
                        {{ $products->appends(['search' => $searchTerm, 'category' => $selectedCategoryId])->links() }}
                    </div>
                @endif
            </div>
        </div>
        </section>

        {{-- Area Keranjang --}}
        <aside id="section-keranjang" class="no-print flex flex-col bg-white rounded-2xl lg:rounded-3xl shadow-2xl overflow-hidden w-full lg:w-[35%] hidden lg:flex">
            {{-- Header --}}
            <header class="h-14 lg:h-20 flex items-center justify-between px-4 lg:px-6 border-b flex-shrink-0">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 lg:w-6 lg:h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span id="badge-item" class="bg-cyan-500 text-white text-xs font-bold w-5 h-5 lg:w-6 lg:h-6 rounded-full flex items-center justify-center hidden">0</span>
                </div>
                <button 
                    onclick="kosongkanKeranjang()"
                    class="text-gray-400 hover:text-red-500 transition-colors hidden"
                    id="btn-kosongkan">
                    <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </header>

            {{-- Daftar Item --}}
            <div id="keranjang-items" class="flex-1 overflow-y-auto px-3 lg:px-4 py-3 lg:py-4 scrollbar-hide">
                <div class="h-full flex items-center justify-center opacity-25">
                    <div class="text-center">
                        <svg class="w-16 h-16 lg:w-20 lg:h-20 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-gray-600 font-bold text-xs lg:text-sm">KERANJANG KOSONG</p>
                    </div>
                </div>
            </div>

            {{-- Area Pembayaran --}}
            <footer class="border-t p-3 lg:p-6 bg-gray-50 space-y-2 lg:space-y-4 flex-shrink-0">
                <div class="flex justify-between items-center">
                    <span class="text-sm lg:text-lg font-bold text-gray-700">TOTAL</span>
                    <span id="total-belanja" class="text-xl lg:text-2xl font-bold text-gray-900">Rp 0</span>
                </div>

                <div class="bg-white rounded-xl p-3 lg:p-4 space-y-2 lg:space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700 text-xs lg:text-base">TUNAI</span>
                        <div class="flex items-center gap-1 lg:gap-2">
                            <span class="text-gray-600 text-xs lg:text-base">Rp</span>
                            <input 
                                type="number"
                                id="input-tunai"
                                min="0"
                                step="1000"
                                value="0"
                                oninput="hitungKembalian()"
                                class="w-24 lg:w-32 text-right bg-gray-50 border-2 border-gray-200 rounded-lg px-2 lg:px-3 py-1 lg:py-2 focus:outline-none focus:border-cyan-500 font-bold text-xs lg:text-base"
                                placeholder="0"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-1 lg:gap-2">
                        <button onclick="tambahTunai(2000)" class="bg-gray-100 hover:bg-cyan-50 border-2 border-gray-200 hover:border-cyan-500 rounded-lg py-1 lg:py-2 text-xs lg:text-sm font-bold transition-colors">+2k</button>
                        <button onclick="tambahTunai(5000)" class="bg-gray-100 hover:bg-cyan-50 border-2 border-gray-200 hover:border-cyan-500 rounded-lg py-1 lg:py-2 text-xs lg:text-sm font-bold transition-colors">+5k</button>
                        <button onclick="tambahTunai(10000)" class="bg-gray-100 hover:bg-cyan-50 border-2 border-gray-200 hover:border-cyan-500 rounded-lg py-1 lg:py-2 text-xs lg:text-sm font-bold transition-colors">+10k</button>
                        <button onclick="tambahTunai(20000)" class="bg-gray-100 hover:bg-cyan-50 border-2 border-gray-200 hover:border-cyan-500 rounded-lg py-1 lg:py-2 text-xs lg:text-sm font-bold transition-colors">+20k</button>
                        <button onclick="tambahTunai(50000)" class="bg-gray-100 hover:bg-cyan-50 border-2 border-gray-200 hover:border-cyan-500 rounded-lg py-1 lg:py-2 text-xs lg:text-sm font-bold transition-colors">+50k</button>
                        <button onclick="tambahTunai(100000)" class="bg-gray-100 hover:bg-cyan-50 border-2 border-gray-200 hover:border-cyan-500 rounded-lg py-1 lg:py-2 text-xs lg:text-sm font-bold transition-colors">+100k</button>
                    </div>
                </div>

                <div id="area-kembalian"></div>

                <button 
                    onclick="prosesPembayaran()"
                    id="btn-bayar"
                    disabled
                    class="w-full py-2 lg:py-4 rounded-xl lg:rounded-2xl text-white text-sm lg:text-lg font-bold shadow-lg transition-all bg-gray-300 cursor-not-allowed">
                    BAYAR SEKARANG
                </button>
            </footer>
        </aside>
    </main>
</div>

{{-- Modal Struk --}}
<div id="modal-struk" class="no-print fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl w-full max-w-sm lg:max-w-md overflow-hidden">
        <div id="area-cetak" class="p-6 lg:p-8 max-h-[70vh] overflow-y-auto">
            <!-- Akan diisi dengan JavaScript -->
        </div>
        <div id="area-tombol"></div>
        
    </div>
</div>

{{-- Toast Notification --}}
<div id="toast" class="no-print fixed top-4 right-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl p-4 flex items-center gap-3 min-w-72">
        <div id="toast-icon"></div>
        <p id="toast-message" class="font-semibold"></p>
    </div>
</div>

{{-- Custom Styles --}}
<style>
    .scrollbar-hide::-webkit-scrollbar { 
        display: none; 
    }
    .scrollbar-hide { 
        -ms-overflow-style: none; 
        scrollbar-width: none; 
    }

    /* Fix untuk pagination */
    nav[role="navigation"] {
        position: relative;
        z-index: 20;
    }

    nav[role="navigation"] a,
    nav[role="navigation"] button,
    nav[role="navigation"] span {
        pointer-events: auto !important;
        cursor: pointer;
        position: relative;
        z-index: 21;
    }

    /* Desktop: pastikan scroll area cukup */
    @media (min-width: 1024px) {
        #section-produk {
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
        }
    }

    /* Mobile: kasih ruang untuk toggle buttons */
    @media (max-width: 1023px) {
        #section-produk > div:last-child {
            padding-bottom: 10px !important;
        }
    }
</style>

<script>
// State Management
let keranjang = [];

let totalBelanja = 0;

// Load keranjang dari localStorage saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    loadKeranjangFromStorage();
    updateUI();
});

// Save ke localStorage
function saveKeranjangToStorage() {
    localStorage.setItem('kasir_keranjang', JSON.stringify(keranjang));
}

// Load dari localStorage
function loadKeranjangFromStorage() {
    const saved = localStorage.getItem('kasir_keranjang');
    if (saved) {
        keranjang = JSON.parse(saved);
    }
}

// Tambah ke Keranjang
async function tambahKeKeranjang(productId) {
    try {
          const response = await fetch(`{{ url('/sb-admin/cashier/product') }}/${productId}`);
         if (!response.ok) {
            throw new Error('Server error: ' + response.status);
        }
        const product = await response.json();

        if (response.status === 404) {
            showToast('error', product.error);
            return;
        }

        // Cek apakah sudah ada di keranjang
        const existingIndex = keranjang.findIndex(item => item.product_id === productId);
        
        if (existingIndex !== -1) {
            // Cek stok
            if (keranjang[existingIndex].jumlah >= product.stok) {
                showToast('error', 'Stok tidak cukup');
                return;
            }
            keranjang[existingIndex].jumlah++;
        } else {
            keranjang.push({
                product_id: product.id,
                nama: product.nama,
                harga: product.harga,
                jumlah: 1,
                stok: product.stok,
                satuan: product.satuan,
                foto: product.foto,
                harga_beli: product.harga_beli
            });
        }

        saveKeranjangToStorage();
        updateUI();
        showToast('success', 'Ditambahkan ke keranjang');
        
        // Di mobile, pindah ke keranjang
        if (window.innerWidth < 1024) {
            setTimeout(() => {
                toggleSection('keranjang');
            }, 200);
        }
    } catch (error) {
        console.error(error);
        showToast('error', 'Gagal menambahkan produk');
    }
}

// Ubah Jumlah
function ubahJumlah(index, perubahan) {
    const jumlahBaru = keranjang[index].jumlah + perubahan;

    if (jumlahBaru <= 0) {
        hapusDariKeranjang(index);
        return;
    }

    if (jumlahBaru > keranjang[index].stok) {
        showToast('error', 'Stok tidak cukup');
        return;
    }

    keranjang[index].jumlah = jumlahBaru;
    saveKeranjangToStorage();
    updateUI();
}

// Set Jumlah Manual
function setJumlahManual(index, jumlah) {
    jumlah = Math.max(1, parseInt(jumlah) || 1);

    if (jumlah > keranjang[index].stok) {
        keranjang[index].jumlah = keranjang[index].stok;
        showToast('error', 'Stok tidak cukup');
    } else {
        keranjang[index].jumlah = jumlah;
    }

    saveKeranjangToStorage();
    updateUI();
}

// Hapus dari Keranjang
function hapusDariKeranjang(index) {
    keranjang.splice(index, 1);
    saveKeranjangToStorage();
    updateUI();
    showToast('success', 'Item dihapus');
}

// Kosongkan Keranjang
function kosongkanKeranjang() {
    if (!confirm('Yakin ingin mengosongkan keranjang?')) return;
    
    keranjang = [];
    document.getElementById('input-tunai').value = 0;
    saveKeranjangToStorage();
    updateUI();
    showToast('success', 'Keranjang dikosongkan');
}

// Update UI
function updateUI() {
    updateKeranjangItems();
    updateTotalBelanja();
    updateBadges();
    hitungKembalian();
}

// Update Keranjang Items
function updateKeranjangItems() {
    const container = document.getElementById('keranjang-items');
    
    if (keranjang.length === 0) {
        container.innerHTML = `
            <div class="h-full flex items-center justify-center opacity-25">
                <div class="text-center">
                    <svg class="w-16 h-16 lg:w-20 lg:h-20 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <p class="text-gray-600 font-bold text-xs lg:text-sm">KERANJANG KOSONG</p>
                </div>
            </div>
        `;
        document.getElementById('btn-kosongkan').classList.add('hidden');
        return;
    }

    document.getElementById('btn-kosongkan').classList.remove('hidden');
    
    let html = '<div class="space-y-2 lg:space-y-3">';
    
    keranjang.forEach((item, index) => {
        html += `
            <div class="bg-gray-50 rounded-lg lg:rounded-xl p-2 lg:p-3 flex gap-2 lg:gap-3">
                
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-gray-800 text-xs lg:text-sm truncate">${item.nama}</h4>
                    <p class="text-cyan-600 font-bold text-xs lg:text-base">Rp ${formatRupiah(item.harga)}</p>
                </div>
                <div class="flex flex-col justify-center flex-shrink-0">
                    <div class="flex items-center gap-1">
                        <button 
                            onclick="ubahJumlah(${index}, -1)"
                            class="w-6 h-6 lg:w-7 lg:h-7 rounded-lg bg-gray-600 hover:bg-gray-700 text-white flex items-center justify-center transition-colors">
                            <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                        </button>
                        <input 
                            type="number"
                            value="${item.jumlah}"
                            onchange="setJumlahManual(${index}, this.value)"
                            class="w-10 h-6 lg:w-12 lg:h-7 text-center bg-white border-2 border-gray-200 rounded-lg focus:outline-none focus:border-cyan-500 text-xs lg:text-sm font-bold"
                        />
                        <button 
                            onclick="ubahJumlah(${index}, 1)"
                            class="w-6 h-6 lg:w-7 lg:h-7 rounded-lg bg-gray-600 hover:bg-gray-700 text-white flex items-center justify-center transition-colors">
                            <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    
    html += '</div>';
    container.innerHTML = html;
}

// Update Total Belanja
function updateTotalBelanja() {
    totalBelanja = keranjang.reduce((sum, item) => sum + (item.harga * item.jumlah), 0);
    document.getElementById('total-belanja').textContent = 'Rp ' + formatRupiah(totalBelanja);
}

// Update Badges
function updateBadges() {
    const totalItem = keranjang.reduce((sum, item) => sum + item.jumlah, 0);
    
    const badge = document.getElementById('badge-item');
    const badgeMobile = document.getElementById('badge-total-item');
    
    if (totalItem > 0) {
        badge.textContent = totalItem;
        badge.classList.remove('hidden');
        badgeMobile.textContent = totalItem;
        badgeMobile.classList.remove('hidden');
    } else {
        badge.classList.add('hidden');
        badgeMobile.classList.add('hidden');
    }
}

// Tambah Tunai
function tambahTunai(nominal) {
    const input = document.getElementById('input-tunai');
    input.value = parseInt(input.value || 0) + nominal;
    hitungKembalian();
}

// Hitung Kembalian
function hitungKembalian() {
    const tunai = parseInt(document.getElementById('input-tunai').value || 0);
    const kembalian = tunai - totalBelanja;
    const areaKembalian = document.getElementById('area-kembalian');
    const btnBayar = document.getElementById('btn-bayar');

    if (kembalian > 0) {
        areaKembalian.innerHTML = `
            <div class="bg-cyan-50 border-2 border-cyan-200 rounded-xl p-3 lg:p-4 flex justify-between items-center">
                <span class="font-bold text-cyan-800 text-xs lg:text-base">KEMBALIAN</span>
                <span class="text-lg lg:text-2xl font-bold text-cyan-600">Rp ${formatRupiah(kembalian)}</span>
            </div>
        `;
    } else if (kembalian < 0 && tunai > 0) {
        areaKembalian.innerHTML = `
            <div class="bg-red-50 border-2 border-red-200 rounded-xl p-3 lg:p-4 flex justify-end">
                <span class="text-base lg:text-xl font-bold text-red-600">Rp ${formatRupiah(kembalian)}</span>
            </div>
        `;
    } else if (kembalian === 0 && keranjang.length > 0 && tunai > 0) {
        areaKembalian.innerHTML = `
            <div class="bg-green-50 border-2 border-green-200 rounded-xl p-3 lg:p-4 flex justify-center items-center gap-2">
                <svg class="w-5 h-5 lg:w-6 lg:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                </svg>
                <span class="font-bold text-green-700 text-xs lg:text-base">UANG PAS</span>
            </div>
        `;
    } else {
        areaKembalian.innerHTML = '';
    }

    // Update button bayar
    if (keranjang.length > 0 && tunai >= totalBelanja) {
        btnBayar.disabled = false;
        btnBayar.className = 'w-full py-2 lg:py-4 rounded-xl lg:rounded-2xl text-white text-sm lg:text-lg font-bold shadow-lg transition-all bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 transform hover:scale-105';
    } else {
        btnBayar.disabled = true;
        btnBayar.className = 'w-full py-2 lg:py-4 rounded-xl lg:rounded-2xl text-white text-sm lg:text-lg font-bold shadow-lg transition-all bg-gray-300 cursor-not-allowed';
    }
}

// Proses Pembayaran
async function prosesPembayaran() {
    if (keranjang.length === 0) {
        showToast('error', 'Keranjang masih kosong');
        return;
    }

    const tunai = parseInt(document.getElementById('input-tunai').value || 0);
    if (tunai < totalBelanja) {
        showToast('error', 'Uang tidak cukup');
        return;
    }

     if (!confirm('Apakah Anda yakin ingin memproses pembayaran ini?')) {
        return;
    }

    const btnBayar = document.getElementById('btn-bayar');
    btnBayar.disabled = true;
    btnBayar.innerHTML = '<span class="animate-pulse">⏳ Memproses...</span>';

    try {
        const response = await fetch('/sb-admin/cashier/process', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                keranjang: keranjang,
                tunai: tunai
            })
        });

        const result = await response.json();

        if (response.ok && result.success) {
            tampilkanStruk(result);
            showToast('success', 'Transaksi berhasil');
            btnBayar.disabled = false;
        } else {
            showToast('error', result.error || 'Transaksi gagal');
            btnBayar.disabled = false;
            hitungKembalian();
        }
        btnBayar.disabled = false;
        btnBayar.innerHTML = 'BAYAR SEKARANG';
    } catch (error) {
        console.error(error);
        showToast('error', 'Terjadi kesalahan');
        btnBayar.disabled = false;
        hitungKembalian();
    }
}

// Tampilkan Struk
function tampilkanStruk(data) {
    const modal = document.getElementById('modal-struk');
    const areaCetak = document.getElementById('area-cetak');
    const areaTombol = document.getElementById('area-tombol');

    let itemsHtml = '';
    data.items.forEach(item => {
        itemsHtml += `
            <tr class="border-b">
                <td class="py-2">
                    <div class="font-medium">${item.nama}</div>
                    <div class="text-xs text-gray-600">@ Rp ${formatRupiah(item.harga)}</div>
                </td>
                <td class="text-center py-2">${item.jumlah}</td>
                <td class="text-right py-2 font-semibold">Rp ${formatRupiah(item.subtotal)}</td>
            </tr>
        `;
    });

    areaCetak.innerHTML = `
        <div class="text-center mb-4 lg:mb-6">
            <h2 class="text-xl lg:text-2xl font-bold text-gray-900">TOKO PERCETAKAN</h2>
            <h3 class="text-lg lg:text-xl font-bold text-cyan-600">MATAHARI KISARAN</h3>
            <p class="text-xs lg:text-sm text-gray-600 mt-1 lg:mt-2">Jl. Merdeka No. 123, Kisaran</p>
            <p class="text-xs lg:text-sm text-gray-600">Telp: (0812) 3456-7890</p>
        </div>

        <div class="border-t-2 border-dashed border-gray-300 pt-3 lg:pt-4 mb-3 lg:mb-4 text-xs lg:text-sm">
            <div class="flex justify-between mb-1">
                <span class="font-semibold">No Invoice:</span>
                <span>${data.invoice}</span>
            </div>
            <div class="flex justify-between mb-1">
                <span class="font-semibold">Tanggal:</span>
                <span>${data.tanggal}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Kasir:</span>
                <span>${data.kasir}</span>
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
                ${itemsHtml}
            </tbody>
        </table>

        <div class="border-t-2 border-dashed border-gray-300 pt-3 lg:pt-4 space-y-1 lg:space-y-2">
            <div class="flex justify-between text-base lg:text-lg font-bold">
                <span>TOTAL:</span>
                <span>Rp ${formatRupiah(data.total)}</span>
            </div>
            <div class="flex justify-between text-xs lg:text-sm">
                <span>Bayar:</span>
                <span>Rp ${formatRupiah(data.tunai)}</span>
            </div>
            <div class="flex justify-between text-base lg:text-lg font-bold text-cyan-600">
                <span>KEMBALIAN:</span>
                <span>Rp ${formatRupiah(data.kembalian)}</span>
            </div>
        </div>

        <div class="mt-4 lg:mt-6 text-center text-xs text-gray-600 border-t-2 border-dashed border-gray-300 pt-3 lg:pt-4">
            <p>Terima kasih atas kunjungan Anda</p>
            <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
        </div>
    `;
    areaTombol.innerHTML = `
        <div class="p-4 lg:p-6 bg-gray-50 border-t flex gap-2 lg:gap-3">
            <button 
                onclick="PrintStruk(${data.sale_id})"
                class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-2 lg:py-3 rounded-xl transition-all text-xs lg:text-base">
                <svg class="w-4 h-4 lg:w-5 lg:h-5 inline mr-1 lg:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak
            </button>
            <button 
                onclick="tutupModalStruk()"
                class="flex-1 bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white font-bold py-2 lg:py-3 rounded-xl transition-all text-xs lg:text-base">
                Transaksi Baru
            </button>
        </div>
    `;

    modal.classList.remove('hidden');
}

function PrintStruk(saleId) {
    fetch(`/sb-admin/nota/${saleId}`)
        .then(response => response.text())
        .then(html => {

            let printFrame = document.getElementById('printFrame');

            if (!printFrame) {
                printFrame = document.createElement('iframe');
                printFrame.id = 'printFrame';
                printFrame.style.position = 'absolute';
                printFrame.style.width = '0';
                printFrame.style.height = '0';
                printFrame.style.border = '0';
                document.body.appendChild(printFrame);
            }

            let doc = printFrame.contentWindow.document;

            doc.open();
            doc.write(html);
            doc.close();

            setTimeout(() => {
                printFrame.contentWindow.focus();
                printFrame.contentWindow.print();
            }, 500);

        })
        .catch(error => {
            console.error('Gagal print:', error);
        });

      document.getElementById('modal-struk').classList.add('hidden');
    keranjang = [];
    document.getElementById('input-tunai').value = 0;
    saveKeranjangToStorage();
    updateUI();
}
// Tutup Modal Struk
function tutupModalStruk() {
    document.getElementById('modal-struk').classList.add('hidden');
    keranjang = [];
    document.getElementById('input-tunai').value = 0;
    saveKeranjangToStorage();
    updateUI();
}

// Toggle Section (Mobile)
function toggleSection(section) {
    const produkSection = document.getElementById('section-produk');
    const keranjangSection = document.getElementById('section-keranjang');
    const btnProduk = document.getElementById('btn-produk');
    const btnKeranjang = document.getElementById('btn-keranjang');

    if (section === 'produk') {
        produkSection.classList.remove('hidden');
        keranjangSection.classList.add('hidden');
        btnProduk.classList.remove('bg-gray-600');
        btnProduk.classList.add('bg-cyan-600');
        btnKeranjang.classList.remove('bg-cyan-600');
        btnKeranjang.classList.add('bg-gray-600');
    } else {
        produkSection.classList.add('hidden');
        keranjangSection.classList.remove('hidden');
        btnProduk.classList.remove('bg-cyan-600');
        btnProduk.classList.add('bg-gray-600');
        btnKeranjang.classList.remove('bg-gray-600');
        btnKeranjang.classList.add('bg-cyan-600');
    }
}

// Show Toast
function showToast(type, message) {
    const toast = document.getElementById('toast');
    const icon = document.getElementById('toast-icon');
    const msg = document.getElementById('toast-message');

    if (type === 'success') {
        icon.innerHTML = `
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        `;
    } else {
        icon.innerHTML = `
            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        `;
    }

    msg.textContent = message;
    toast.classList.remove('hidden');

    setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
}

// Format Rupiah
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID').format(angka);
}
</script>
@endsection