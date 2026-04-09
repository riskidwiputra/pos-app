<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Kasir' }}</title>
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- CRITICAL: Livewire Styles - WAJIB ADA --}}
    @livewireStyles
    
    <style>
        [wire\:loading] {
            display: none;
        }
        [wire\:loading].block {
            display: block;
        }
        [wire\:loading].inline {
            display: inline;
        }
    </style>
</head>
<body class="bg-gray-50">
    {{-- Main Content --}}
    {{ $slot }}
    
    {{-- CRITICAL: Livewire Scripts - WAJIB ADA DI AKHIR BODY --}}
    @livewireScripts
    
    {{-- Toast Notification Handler --}}
    <script>
        // Toast notification handler
        window.addEventListener('toast', event => {
            const { type, message } = event.detail;
            
            // Sementara menggunakan alert, nanti bisa diganti dengan library toast
            if (type === 'success') {
                alert('✅ ' + message);
            } else if (type === 'error') {
                alert('❌ ' + message);
            } else {
                alert(message);
            }
            
            console.log('Toast:', type, message);
        });
        
        // Debug: Cek apakah Livewire ter-load
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Livewire !== 'undefined') {
                console.log('✅ Livewire loaded successfully!');
            } else {
                console.error('❌ Livewire NOT loaded!');
            }
        });
    </script>
</body>
</html>