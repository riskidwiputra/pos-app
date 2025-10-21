<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
         @vite([
            'resources/css/app.css',
            'resources/css/template/fonts/boxicons.css',
            'resources/css/template/core.css',
            'resources/css/template/demo.css',
            'resources/css/template/theme-default.css',
            'resources/css/template/perfect-scrollbar.css',
            'resources/js//template/bootstrap.js',
            'resources/js//template/helpers.js',
            'resources/js//template/menu.js',
             'resources/js//template/main.js',
            'resources/js//template/apexcharts.js',
            'resources/js/app.js'])
            
            @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">    
                @include('layouts.navigation')
                <div class="layout-page">
                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                        </div>

                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input
                                type="text"
                                class="form-control border-0 shadow-none"
                                placeholder="Search..."
                                aria-label="Search..."
                            />
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                <img src="{{ Vite::asset('resources/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                        <img src="" alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">John Doe</span>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                    </div>
                                </a>
                                </li>
                                <li>
                                <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bx bx-user me-2"></i>
                                    <span class="align-middle">My Profile</span>
                                </a>
                                </li>
                            
                                <li>
                                <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                <a class="dropdown-item" href="auth-login-basic.html">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                        </div>
                    </nav>
                    <!-- Page Heading -->
                    <!-- @if (isset($header)) -->
                        <!-- <header class="bg-white shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header> -->
                    <!-- @endif -->

                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
        @livewireScripts
            <script>
                // Initialize helpers dan menu dengan lebih aman
                document.addEventListener('DOMContentLoaded', () => {
                    console.log('🚀 Page loaded - initializing layout...');
                    initializeLayout();
                });

                document.addEventListener('livewire:navigated', () => {
                    console.log('🔁 Livewire navigated - reinitializing layout...');
                    
                    // Delay untuk memastikan DOM sudah siap
                    setTimeout(() => {
                        initializeLayout();
                    }, 100);
                });

                function initializeLayout() {
                    // 1. Init Helpers - Jangan gunakan condition yg kompleks
                    if (typeof window.Helpers !== 'undefined' && typeof window.Helpers.init === 'function') {
                        try {
                            window.Helpers.init();
                            window.Helpers.update();
                        } catch (e) {
                            console.warn('⚠️ Helpers init error:', e);
                        }
                    }

                    // 2. Re-init menu dengan cara yang lebih aman
                    try {
                        const layoutMenu = document.querySelector('.layout-menu');
                        if (!layoutMenu) return;

                        // Destroy menu lama jika ada
                        if (window.Helpers?.mainMenu && typeof window.Helpers.mainMenu.destroy === 'function') {
                            window.Helpers.mainMenu.destroy();
                            window.Helpers.mainMenu = null;
                        }

                        // Buat instance menu baru
                        if (typeof window.Menu === 'function') {
                            window.Helpers = window.Helpers || {};
                            window.Helpers.mainMenu = new window.Menu(layoutMenu, {});
                            console.log('✅ Menu initialized');
                        }
                    } catch (e) {
                        console.warn('⚠️ Menu init error:', e);
                    }
                }
            </script>


    </body>
</html>
