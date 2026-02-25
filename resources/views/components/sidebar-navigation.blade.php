<div x-data="navigationSidebar()" x-init="init()">
    {{-- Overlay untuk Mobile --}}
    <div 
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="closeSidebar()"
        class="fixed inset-0 bg-black/50 z-40 lg:hidden"
        style="display: none;"
    ></div>

    {{-- Sidebar --}}
    <aside 
    :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
    class="fixed top-0 left-0 z-50 h-screen transition-transform duration-300 ease-in-out lg:translate-x-0 bg-white border-r border-gray-200 shadow-xl"
    style="width: 240px;"
>
        <div class="h-full flex flex-col">
            
            {{-- Header/Logo --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold text-gray-700">toko matahari</h1>
                </a>
                
                {{-- Close Button (Mobile Only) --}}
                <button 
                    @click="closeSidebar()"
                    class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            {{-- Navigation Menu --}}
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1 sidebar-scroll">
                
                {{-- Dashboard --}}
                <a 
                    href="{{ route('dashboard') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                {{-- Kasir --}}
                <a 
                    href="{{ route('cashier') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('cashier') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <span>Kasir</span>
                </a>

                {{-- Supplier --}}
                <a 
                    href="{{ route('supplier.index') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span>Supplier</span>
                </a>

                {{-- Manajemen Produk --}}
                <a 
                    href="{{ route('product.index') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('product.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span>Manajemen Produk</span>
                </a>

                {{-- Pembelian --}}
                <a 
                    href="{{ route('purchase.index') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('purchase.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>Pembelian</span>
                </a>

                {{-- Penjualan --}}
                <a 
                    href="{{ route('sale.index') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('sale.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Penjualan</span>
                </a>

                {{-- Order Jasa --}}
                <a 
                    href="{{ route('order-jasa.index') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('order-jasa.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Order Jasa</span>
                </a>

                {{-- Data User (Dropdown) --}}
                <div x-data="{ expanded: {{ request()->routeIs('karyawan.*', 'admin.*', 'customer.*') ? 'true' : 'false' }} }">
                    <button 
                        @click="expanded = !expanded"
                        class="nav-item {{ request()->routeIs('karyawan.*', 'admin.*', 'customer.*') ? 'active' : '' }}"
                        style="width: 100%; justify-content: space-between;">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Data User</span>
                        </div>
                        <svg 
                            :class="{ 'rotate-90': expanded }"
                            class="w-5 h-5 transition-transform duration-200" 
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>

                    <div 
                        x-show="expanded"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2"
                        class="mt-1 ml-4 space-y-1">
                        <a 
                            href="{{ route('karyawan.index') }}"
                            @click="closeSidebar()"
                            class="nav-sub-item {{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            Data Karyawan
                        </a>
                        <a 
                            href="{{ route('admin.index') }}"
                            @click="closeSidebar()"
                            class="nav-sub-item {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            Data Admin
                        </a>
                        <a 
                            href="{{ route('customer.index') }}"
                            @click="closeSidebar()"
                            class="nav-sub-item {{ request()->routeIs('customer.*') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            Data Pelanggan
                        </a>
                    </div>
                </div>

                {{-- Master Data (Dropdown) --}}
                <div x-data="{ expanded: {{ request()->routeIs('category.*', 'subcategory.*', 'unit.*') ? 'true' : 'false' }} }">
                    <button 
                        @click="expanded = !expanded"
                        class="nav-item {{ request()->routeIs('category.*', 'subcategory.*', 'unit.*') ? 'active' : '' }}"
                        style="width: 100%; justify-content: space-between;">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                            </svg>
                            <span>Master Data</span>
                        </div>
                        <svg 
                            :class="{ 'rotate-90': expanded }"
                            class="w-5 h-5 transition-transform duration-200" 
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>

                    <div 
                        x-show="expanded"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2"
                        class="mt-1 ml-4 space-y-1">
                        <a 
                            href="{{ route('category.index') }}"
                            @click="closeSidebar()"
                            class="nav-sub-item {{ request()->routeIs('category.*') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            Kategori
                        </a>
                        <a 
                            href="{{ route('subcategory.index') }}"
                            @click="closeSidebar()"
                            class="nav-sub-item {{ request()->routeIs('subcategory.*') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            Sub Kategori
                        </a>
                        <a 
                            href="{{ route('unit.index') }}"
                            @click="closeSidebar()"
                            class="nav-sub-item {{ request()->routeIs('unit.*') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            Unit
                        </a>
                    </div>
                </div>

                {{-- Laporan (Dropdown) --}}
                <div x-data="{ expanded: {{ request()->routeIs('laporan.*') ? 'true' : 'false' }} }">
                    <button 
                        @click="expanded = !expanded"
                        class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}"
                        style="width: 100%; justify-content: space-between;">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Laporan</span>
                        </div>
                        <svg 
                            :class="{ 'rotate-90': expanded }"
                            class="w-5 h-5 transition-transform duration-200" 
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>

                    <div 
                        x-show="expanded"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2"
                        class="mt-1 ml-4 space-y-1">
                        <a 
                            href="{{ route('laporan.penjualan.transaksi') }}"
                            @click="closeSidebar()"
                            class="nav-sub-item {{ request()->routeIs('laporan.penjualan.*') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            Laporan Penjualan
                        </a>
                        <a 
                            href="{{ route('laporan.stok') }}"
                            @click="closeSidebar()"
                            class="nav-sub-item {{ request()->routeIs('laporan.stok') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            Laporan Stok
                        </a>
                    </div>
                </div>

                {{-- Logout --}}
                <button 
                    onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin keluar?')) document.getElementById('logout-form').submit();"
                    class="nav-item text-red-600 hover:bg-red-50"
                    style="width: 100%;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Logout</span>
                </button>

            </nav>

            {{-- User Profile Footer --}}
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->fullname ?? 'U', 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->fullname ?? 'User' }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? '' }}</p>
                    </div>
                </div>
            </div>

        </div>
    </aside>

    {{-- Hamburger Button (Mobile Only) --}}
    <button 
        @click="toggleSidebar()"
        class="lg:hidden fixed top-4 left-4 z-30 p-2 bg-white rounded-lg shadow-lg border border-gray-200 hover:bg-gray-50 transition-colors">
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
</div>

{{-- Form Logout (Hidden) --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
function navigationSidebar() {
    return {
        sidebarOpen: false,
        
        init() {
            // Auto close sidebar on route change (for SPA-like behavior)
            if (window.Livewire) {
                window.Livewire.hook('message.processed', () => {
                    if (window.innerWidth < 1024) {
                        this.closeSidebar();
                    }
                });
            }
        },
        
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            
            // Prevent body scroll when sidebar is open on mobile
            if (this.sidebarOpen && window.innerWidth < 1024) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        },
        
        closeSidebar() {
            this.sidebarOpen = false;
            document.body.style.overflow = '';
        }
    }
}
</script>

<style>
/* Navigation Styles - Ukuran lebih kecil */
.nav-item {
    display: flex;
    align-items: center;
    gap: 0.625rem; /* Dikurangi dari 0.75rem */
    padding: 0.625rem 0.875rem; /* Dikurangi dari 0.75rem 1rem */
    border-radius: 0.625rem; /* Dikurangi dari 0.75rem */
    font-weight: 500;
    font-size: 0.875rem; /* 14px - Tambahkan ini */
    transition: all 0.2s;
    text-decoration: none;
    color: #374151;
}

.nav-item svg {
    width: 1.125rem; /* 18px - Dikurangi dari 1.25rem (20px) */
    height: 1.125rem;
    flex-shrink: 0;
}

.nav-item:hover {
    background-color: #f3f4f6;
}

.nav-item.active {
    background-color: #eef2ff;
    color: #4f46e5;
    border-right: 3px solid #4f46e5; /* Dikurangi dari 4px */
}

.nav-sub-item {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.5rem 0.875rem; /* Dikurangi sedikit */
    border-radius: 0.5rem;
    font-size: 0.8125rem; /* 13px - Dikurangi dari 0.875rem */
    font-weight: 500;
    transition: all 0.2s;
    text-decoration: none;
    color: #6b7280;
}

.nav-sub-item:hover {
    background-color: #f9fafb;
}

.nav-sub-item.active {
    background-color: #e0e7ff;
    color: #4338ca;
}

/* Custom Scrollbar */
.sidebar-scroll::-webkit-scrollbar {
    width: 5px; /* Dikurangi dari 6px */
}

.sidebar-scroll::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-scroll::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 2.5px;
}

.sidebar-scroll::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Rotate animation */
.rotate-90 {
    transform: rotate(90deg);
}

/* Responsive adjustments */
@media (min-width: 1024px) and (max-width: 1440px) {
    .nav-item {
        padding: 0.5rem 0.75rem;
        font-size: 0.8125rem; /* 13px untuk layar medium */
    }
    
    .nav-item svg {
        width: 1rem;
        height: 1rem;
    }
    
    .nav-sub-item {
        font-size: 0.75rem; /* 12px */
        padding: 0.4375rem 0.75rem;
    }
}
</style>