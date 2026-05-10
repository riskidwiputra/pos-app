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
          
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
                @if(auth()->user()->isCustomer())
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
@else
    <a href="{{ route('dashboard-admin') }}" class="flex items-center gap-2">
@endif
                     <img src="https://i.ibb.co.com/B5RDsQKQ/Logo-jpg.jpg" width="30px" height="30px" alt="Logo jpg" border="0">
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
                @if(auth()->user()->hasPermission('dashboard'))
                    @if(auth()->user()->isCustomer())
                        <a href="{{ route('dashboard') }}"  class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" @click="closeSidebar()">
                    @else
                        <a href="{{ route('dashboard-admin') }}"  class="nav-item {{ request()->routeIs('dashboard-admin') ? 'active' : '' }}" @click="closeSidebar()">
                    @endif
                
                   <i class='bx bx-home-alt text-lg'></i>
                    <span>Dashboard</span>
                </a>
                @endif

                {{-- Kasir --}}
                @if(auth()->user()->hasPermission('kasir'))
                <a 
                    href="{{ route('cashier') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('cashier') ? 'active' : '' }}">
                    <i class='bx bx-calculator text-lg'></i>
                    <span>Kasir</span>
                </a>
                @endif
                {{-- Supplier --}}
                @if(auth()->user()->hasPermission('supplier.view'))
                <a 
                    href="{{ route('supplier.index') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
                    <i class='bx bx-buildings text-lg'></i>
                    <span>Supplier</span>
                </a>
                @endif
                {{--  Produk --}}
                @if(auth()->user()->hasPermission('produk.view'))
                <a 
                    href="{{ route('product.index') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('product.*') ? 'active' : '' }}">
                   <i class='bx bx-package text-lg'></i>
                    <span> Produk</span>
                </a>
                @endif

                {{-- Pembelian --}}
                @if(auth()->user()->hasPermission('purchase.view'))
                <a 
                    href="{{ route('purchase.index') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('purchase.*') ? 'active' : '' }}">
                    <i class='bx bx-shopping-bag text-lg'></i>
                    <span>Pembelian</span>
                </a>
                @endif
                @if(auth()->user()->hasPermission('sale.view'))
                {{-- Penjualan --}}
                <a 
                    href="{{ route('sale.index') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('sale.*') ? 'active' : '' }}">
                    <i class='bx bx-cart text-lg'></i>
                    <span>Penjualan</span>
                </a>
                @endif
                @if(auth()->user()->isCustomer())
                <a 
                    href="{{ route('order-jasa.tambah-pesanan') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('order-jasa.tambah-pesanan') ? 'active' : '' }}">
                   <i class='bx bx-cog text-lg'></i>
                    <span>Tambah Pesanan</span>
                </a>    

                <a 
                    href="{{ route('order-jasa.riwayat-pesanan') }}"
                    @click="closeSidebar()"
                   class="nav-item {{ request()->routeIs(
                        'order-jasa.riwayat-pesanan',
                        'order-jasa.detail-pesanan',
                        'order-jasa.ubah-pesanan'
                    ) ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Riwayat Pesanan</span>
                </a>
                 @endif
                {{-- Order Jasa --}}
                @if(auth()->user()->hasPermission('order-jasa.view'))
                <a 
                    href="{{ route('order-jasa.index') }}"
                    @click="closeSidebar()"
                    class="nav-item {{ request()->routeIs('order-jasa.*') ? 'active' : '' }}">
                   <i class='bx bx-cog text-lg'></i>
                    <span>Order Jasa</span>
                </a>
                @endif

                {{-- Data User (Dropdown) --}}
                @if(auth()->user()->hasPermission('user-management'))
                <div x-data="{ expanded: {{ request()->routeIs('karyawan.*', 'admin.*', 'customer.*') ? 'true' : 'false' }} }">
                    <button 
                        @click="expanded = !expanded"
                        class="nav-item {{ request()->routeIs('karyawan.*', 'admin.*', 'customer.*') ? 'active' : '' }}"
                        style="width: 100%; justify-content: space-between;">
                        <div class="flex items-center gap-3">
                           <i class='bx bx-group text-lg'></i>
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
                @endif
                {{-- Master Data (Dropdown) --}}
                @if(auth()->user()->hasPermission('master-data'))
                <div x-data="{ expanded: {{ request()->routeIs('category.*', 'subcategory.*', 'unit.*', 'auth.*') ? 'true' : 'false' }} }">
                    <button 
                        @click="expanded = !expanded"
                        class="nav-item {{ request()->routeIs('category.*', 'subcategory.*', 'unit.*', 'auth.*') ? 'active' : '' }}"
                        style="width: 100%; justify-content: space-between;">
                        <div class="flex items-center gap-3">
                           <i class='bx bx-data text-lg'></i>
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
                        {{-- Role --}}
                        <a 
                            href="{{ route('auth.role-management') }}"
                            @click="closeSidebar()"
                            class="nav-item {{ request()->routeIs('auth.role-management') ? 'active' : '' }}">
                              <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            <span>Role</span>
                        </a>
                         {{-- Permission --}}
                        <a 
                            href="{{ route('auth.permissions') }}"
                            @click="closeSidebar()"
                            class="nav-item {{ request()->routeIs('auth.permissions') ? 'active' : '' }}">
                              <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            <span>Permission</span>
                        </a>
                        
                    </div>
                </div>
                @endif
                {{-- Laporan (Dropdown) --}}
                @if(auth()->user()->hasPermission('laporan'))
                <div x-data="{ expanded: {{ request()->routeIs('laporan.*') ? 'true' : 'false' }} }">
                    <button 
                        @click="expanded = !expanded"
                        class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}"
                        style="width: 100%; justify-content: space-between;">
                        <div class="flex items-center gap-3">
                          <i class='bx bx-bar-chart-alt-2 text-lg'></i>
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
                            class="nav-sub-item {{ request()->routeIs('laporan.penjualan.transaksi') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            Laporan Per Transksi
                        </a>
                        <a 
                            href="{{ route('laporan.penjualan.per-item') }}"
                            @click="closeSidebar()"
                            class="nav-sub-item {{ request()->routeIs('laporan.penjualan.per-item') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            Laporan Per Item
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
                @endif

               
            </nav>

            {{-- User Profile Footer --}}
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center gap-3">
                     {{-- Logout --}}
                <button 
                    onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin keluar?')) document.getElementById('logout-form').submit();"
                    class="nav-item text-red-600 hover:bg-red-50"
                    style="width: 100%;">
                   <i class='bx bx-log-out text-lg'></i>
                    <span>Logout</span>
                </button>

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