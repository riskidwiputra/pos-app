<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <!-- SVG Logo -->
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Toko Matahari</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none" id="menu-toggle">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <!-- PENTING: Tambahkan wrapper untuk scroll -->
  <div class="menu-scroll-wrapper">
    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="menu-link" wire:navigate.hover>
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Dashboard">Dashboard</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Master Data</span>
      </li>

      <!-- Supplier -->
      <li class="menu-item {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
        <a href="{{ route('supplier.index') }}" class="menu-link" wire:navigate.hover>
          <i class="menu-icon tf-icons bx bx-store"></i>
          <div data-i18n="Supplier">Supplier</div>
        </a>
      </li>

      <!-- Data Karyawan -->
      <li class="menu-item {{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
        <a href="#" class="menu-link" wire:navigate>
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div data-i18n="Karyawan">Data Karyawan</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pengaturan</span>
      </li>

      <!-- Profile -->
      <li class="menu-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
        <a href="{{ route('profile.edit') }}" class="menu-link" wire:navigate.hover>
          <i class="menu-icon tf-icons bx bx-user-circle"></i>
          <div data-i18n="Profile">Profile</div>
        </a>
      </li>

      <!-- Logout -->
      <li class="menu-item">
        <a href="{{ route('logout') }}" class="menu-link" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="menu-icon tf-icons bx bx-log-out"></i>
          <div data-i18n="Logout">Logout</div>
        </a>
      </li>
    </ul>
  </div>
</aside>

<!-- Form Logout (Hidden) -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>