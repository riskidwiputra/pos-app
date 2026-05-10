<x-guest-layout>
    <div class="w-full">
        <h2 class="text-2xl font-bold text-center text-indigo-600 mb-6">Buat Aksun Baru</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            {{-- Nama Lengkap --}}
            <div>
                <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input id="fullname" type="text" name="fullname"
                       value="{{ old('fullname') }}"
                       placeholder="Masukkan nama lengkap"
                       required autofocus
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all
                              @error('fullname') border-red-400 bg-red-50 @enderror"/>
                @error('fullname')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Username --}}
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                    Username <span class="text-red-500">*</span>
                </label>
                <input id="username" type="text" name="username"
                       value="{{ old('username') }}"
                       placeholder="Masukkan Username"
                       required
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all
                              @error('username') border-red-400 bg-red-50 @enderror"/>
                @error('username')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Email <span class="text-red-500">*</span>
                </label>
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="contoh@email.com"
                       required
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all
                              @error('email') border-red-400 bg-red-50 @enderror"/>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password <span class="text-red-500">*</span>
                </label>
                <input id="password" type="password" name="password"
                       placeholder="Minimal 8 karakter"
                       required autocomplete="new-password"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all
                              @error('password') border-red-400 bg-red-50 @enderror"/>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                    Konfirmasi Password <span class="text-red-500">*</span>
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       placeholder="Ulangi password"
                       required autocomplete="new-password"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all"/>
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Syarat & Ketentuan --}}
            <div class="flex items-start gap-2">
                <input id="terms" type="checkbox" name="terms" required
                       class="mt-1 w-4 h-4 rounded accent-indigo-600 cursor-pointer"/>
                <label for="terms" class="text-sm text-gray-600 cursor-pointer">
                    Saya setuju dengan
                    <a href="#" class="text-indigo-600 font-semibold hover:underline">Syarat & Ketentuan</a>
                    dan
                    <a href="#" class="text-orange-500 font-semibold hover:underline">Kebijakan Privasi</a>
                    Percetakan Matahari
                </label>
            </div>

            {{-- Tombol Daftar --}}
            <button type="submit"
                    class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition-all duration-200">
                Daftar Sekarang
            </button>

            {{-- Link Login --}}
            <p class="text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">
                    Masuk di sini
                </a>
            </p>

        </form>
    </div>
</x-guest-layout>