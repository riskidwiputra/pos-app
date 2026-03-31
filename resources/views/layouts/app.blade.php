<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ($title ?? '') ? $title . ' - Toko Matahari' : 'Toko Matahari' }}</title>
     <link rel="icon" type="image/x-icon" href="/favicon.ico">

        <!-- Ganti jadi -->
    <link rel="icon" type="image/png" href="https://i.ibb.co.com/B5RDsQKQ/Logo-jpg.jpg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/css/template/fonts/boxicons.css',
        'resources/js/app.js'
    ])
    
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        {{-- Sidebar Navigation --}}
        <x-sidebar-navigation />
        
        {{-- Main Content Area --}} 
        {{-- Main Content Area --}} 
<div class="lg:ml-[240px] min-h-screen">


    <div class="sticky top-0 z-20 bg-white border-b border-gray-200 px-6 h-14 flex items-center justify-between">
        
        {{-- Kiri: Tanggal --}}
        <p class="text-sm text-gray-400">
            {{ now()->translatedFormat('l, d F Y') }}
        </p>

        {{-- Kanan: Notifikasi + Profile --}}
        <div class="flex items-center gap-3">
            
           

            <div class="w-px h-6 bg-gray-200"></div>

            {{-- Profile Dropdown --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="text-left hidden sm:block">
                        <p class="text-sm font-medium text-gray-800 leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ auth()->user()->email }}</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown --}}
                <div 
                    x-show="open" 
                    @click.outside="open = false"
                    x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg py-1 z-50">
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-xs text-gray-400">Login sebagai</p>
                        <p class="text-sm font-medium text-gray-700 truncate">{{ auth()->user()->name }}</p>
                    </div>
                    
                    <a 
                    href="{{ route('profile-admin.edit') }}"
                    @click="closeSidebar()"
                    class="nav-item ">
                    <i class='bx bx-user'></i> 
                    <span>Profile</span>
                </a>
                </div>
            </div>

        </div>
    </div>

    {{-- Content Wrapper --}}
    <div class="w-full">
        <div class="max-w-[2000px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
            {{ $slot }}
        </div>
    </div>
</div>
    </div>
    
    @livewireScripts
    @stack('scripts')
    
   
</body>
</html>