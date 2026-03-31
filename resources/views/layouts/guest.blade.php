<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="/favicon.ico">

        <!-- Ganti jadi -->
        <link rel="icon" type="image/png" href="https://i.ibb.co.com/B5RDsQKQ/Logo-jpg.jpg">
                <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/css/template/core.css',
            'resources/css/template/demo.css',
            'resources/css/template/theme-default.css',
            'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">


            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
              <!-- Logo -->
              <div class="app-brand justify-content-center mt-4 mb-4">
                <a href="#" class="app-brand-link gap-2">
                 <img src="https://i.ibb.co.com/B5RDsQKQ/Logo-jpg.jpg" width="60px" height="60px" alt="Logo jpg" border="0">
      
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to Toko Matahari Kisaran</h4>
           
                 
            {{ $slot }}
            </div>
        </div>
    </body>
</html>
