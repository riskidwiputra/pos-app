<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Percetakan Matahari</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co.com/B5RDsQKQ/Logo-jpg.jpg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    .warnacard {
      background: linear-gradient(195deg, #0436a1, #17458f);
    }
</style>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">
    {{-- Navbar --}}
    <nav class="bg-white shadow-lg ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo & Brand --}}
                <div class="flex items-center gap-3">
                    <img src="https://i.ibb.co.com/B5RDsQKQ/Logo-jpg.jpg" width="30px" height="30px" alt="Logo jpg" border="0">
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">Percetakan Matahari</h1>
                        <p class="text-xs text-gray-500">Kisaran - Sumatera Utara</p>
                    </div>
                </div>

                {{-- User Menu --}}
                <div class="flex items-center gap-4">
                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                       
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded-lg transition-all shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Welcome Card --}}
        <div class="warnacard rounded-3xl shadow-2xl overflow-hidden mb-8">
            <div class="relative p-8 lg:p-12">
                {{-- Decorative Elements --}}
               
                
                {{-- Content --}}
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        
                        <h1 class="text-3xl lg:text-4xl font-bold text-white">
                            Selamat Datang, {{ Auth::user()->name }}! 
                        </h1>
                    </div>
                    
                    <p class="text-lg lg:text-xl text-white/90 leading-relaxed mb-6">
                        Terima kasih telah mendaftar di <span class="font-bold">Percetakan Matahari Kisaran</span>. 
                   
                    </p> 
                </div>
            </div>
        </div>

        {{-- Feature Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            {{-- Order Jasa --}}
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                <div class="p-6">
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Order Jasa</h3>
                    <p class="text-gray-600 text-sm mb-4">Pesan layanan percetakan yang Anda butuhkan dengan mudah</p>
                    <a href="{{ route('order-jasa.tambah-pesanan') }}" class="inline-flex items-center text-indigo-600 font-semibold text-sm hover:text-indigo-700">
                        Mulai Order
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- History --}}
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                <div class="p-6">
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Riwayat Order</h3>
                    <p class="text-gray-600 text-sm mb-4">Lihat dan lacak status pesanan Anda</p>
                    <a href="{{ route('order-jasa.index') }}" class="inline-flex items-center text-emerald-600 font-semibold text-sm hover:text-emerald-700">
                        Lihat Riwayat
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Profile --}}
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                <div class="p-6">
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Profil Saya</h3>
                    <p class="text-gray-600 text-sm mb-4">Kelola informasi akun dan preferensi Anda</p>
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center text-purple-600 font-semibold text-sm hover:text-purple-700">
                        Lihat Profil
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

      

        {{-- Contact Info --}}
        <div class="mt-8 bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200">
            <div class="text-center">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Butuh Bantuan?</h3>
                
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://wa.me/082283821173" class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5 -.669 -.51 -.173 -.008 -.371 -.01 -.57 -.01 -.198 0 -.52 .074 -.792 .372 -.272 .297 -1.04 1.016 -1.04 2.479 0 1.462 1.065 2.875 1.2₁₃ 3.074 .₁₄₉ .₁₉₈ ₂₀₉₆ ₃.₂ ₅.₀₇₇ ₄.₄₈₇ .₇₀₉ .₃₀₆ ₁₂₆₂ .₄₈₉ ₁.₆₉₄ .₆₂⁵ .₇₁₂ .₂₂⁷ ₁.³⁶ .₁⁹⁵ ₁.⁸⁷₁ .₁¹⁸ .⁵⁷¹ -.₀⁸⁵ ₁.⁷⁵⁸ -.⁷¹⁹ ₂.₀₀⁶ -¹.{¹} .²⁴⁸ -.⁶⁹⁴ .²⁴⁸ -¹.{²} .₁⁷³ -¹.{³} -.₀⁷⁴ -.¹²⁴ -.²⁷² -.¹⁹ͺ -.五百 seventy -."/>
                        </svg>
                        WhatsApp
                    </a>
                    
                </div>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="mt-12 py-6 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                &copy; 2026 Percetakan Matahari Kisaran. All Rights Reserved. Made with Rizky 
            
            </p>
        </div>
    </footer>
</body>
</html>