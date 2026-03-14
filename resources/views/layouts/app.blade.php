<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
        <div class="lg:ml-[240px] min-h-screen">
            {{-- Content Wrapper dengan Max Width --}}
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