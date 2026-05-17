<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Percetakan Matahari</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://i.ibb.co.com/B5RDsQKQ/Logo-jpg.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .form-input:focus {
            outline: none;
            border-color: #ff6b35;
            box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
        }
        .form-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e0e0e0;
        }
    </style>
</head>
<body class="min-h-screen bg-[#f5f5f9] flex items-center justify-center py-10 px-5">

    <div class="w-full max-w-[900px] grid grid-cols-2 bg-white rounded-[30px] overflow-hidden shadow-[0_8px_40px_rgba(0,0,0,0.15)] max-[968px]:grid-cols-1">

        {{-- ======= LEFT SIDE - Branding ======= --}}
        <div class="relative bg-gradient-to-b from-[#0d1423] to-[#17458f] px-10 py-[60px] text-white flex flex-col justify-center overflow-hidden max-[968px]:hidden">

            <a href="/" class="absolute top-[30px] left-10 text-white text-sm opacity-90 hover:opacity-100 no-underline transition-opacity duration-300 z-10">
                ← Kembali ke Beranda
            </a>

            <div class="relative z-10">
                {{-- Logo --}}
                <div class="flex items-center gap-4 mb-10">
                    @php
                        $path = public_path('img/logo/logo-remove.png');
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    @endphp
                    <img src="{{ $image }}" width="370">
                </div>

                <h2 class="text-[32px] font-bold mb-5 leading-snug">Selamat Datang Kembali!</h2>
                <p class="text-[15px] opacity-90 mb-8 leading-[1.8]">
                    Login untuk melanjutkan pesanan Anda dan nikmati berbagai layanan percetakan.
                </p>
            </div>
        </div>

        {{-- ======= RIGHT SIDE - Form ======= --}}
        <div class="px-[50px] py-[60px] flex flex-col justify-center max-[640px]:px-5 max-[640px]:py-8">

            {{-- Header --}}
            <div class="text-center mb-10">
                <h1 class="text-[28px] font-bold text-[#004e89] mb-2.5">Masuk ke Akun Anda</h1>
                <p class="text-[#666] text-sm">Masukkan email dan password untuk login</p>
            </div>

            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="px-5 py-4 rounded-xl mb-6 text-sm bg-[#ffebee] border border-[#f44336] text-[#c62828]">
                    <strong>Login Gagal!</strong><br>
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Success Alert --}}
            @if (session('status'))
                <div class="px-5 py-4 rounded-xl mb-6 text-sm bg-[#e8f5e9] border border-[#4caf50] text-[#2e7d32]">
                    <strong>✓ Berhasil!</strong><br>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email / Username --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-[#1a1a1a] mb-2">
                        Email atau Username <span class="text-[#f44336]">*</span>
                    </label>
                    <input
                        type="text"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email atau Username"
                        required
                        autofocus
                        class="form-input w-full px-[18px] py-3.5 border-2 rounded-xl text-sm font-[Poppins] transition-all duration-300 bg-white @error('email') border-[#f44336] @else border-[#e0e0e0] @enderror"/>
                    @error('email')
                        <span class="flex items-center gap-1 text-xs text-[#f44336] mt-1.5">{{ $message }}</span>
                    @enderror
                </div>

               <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-semibold text-[#1a1a1a]">
                        Password <span class="text-[#f44336]">*</span>
                    </label>
                    <a href="{{ route('password.request') }}" 
                    class="text-xs text-[#ff6b35] font-semibold no-underline hover:underline">
                        Lupa Password?
                    </a>
                </div>
                <div class="relative">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Masukkan password"
                        required
                        class="form-input w-full px-[18px] py-3.5 pr-12 border-2 rounded-xl text-sm font-[Poppins] transition-all duration-300 bg-white @error('password') border-[#f44336] @else border-[#e0e0e0] @enderror"/>
                    <button type="button"
                            onclick="togglePassword('password', 'eye-icon-password')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-[#666] hover:text-[#004e89] transition-colors duration-200 focus:outline-none">
                        <svg id="eye-icon-password" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="flex items-center gap-1 text-xs text-[#f44336] mt-1.5">{{ $message }}</span>
                @enderror
            </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-[#3B82F6] to-[#1E3A8A] text-white border-none rounded-xl text-base font-bold cursor-pointer transition-all duration-300 font-[Poppins] hover:-translate-y-0.5 hover:shadow-[0_8px_25px_rgba(255,107,53,0.3)]">
                    Login
                </button>
            </form>

            {{-- Footer --}}
            <div class="text-center text-sm text-[#666] mt-4">
                Belum punya akun? <a href="{{ route('register') }}" class="text-[#ff6b35] no-underline font-semibold hover:underline">Daftar di sini</a>
            </div>

        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon  = document.getElementById(iconId);
            const isPassword = input.type === 'password';

            input.type = isPassword ? 'text' : 'password';

        
        }
    </script>

</body>
</html>