<div>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .form-input:focus {
            outline: none;
            border-color: #ff6b35;
            box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
        }
    </style>

    <div class="min-h-screen bg-[#f5f5f9] flex items-center justify-center py-10 px-5">
        <div class="w-full max-w-[500px] bg-white rounded-[30px] overflow-hidden shadow-[0_8px_40px_rgba(0,0,0,0.15)]">
            <div class="px-10 py-[50px]">

                {{-- Header --}}
                <div class="text-center mb-7">
                    <h1 class="text-[26px] font-bold text-[#004e89] mb-1.5">Buat Akun Baru</h1>
                </div>

                <form wire:submit.prevent="register">

                    {{-- Nama Lengkap --}}
                    <div class="mb-[18px]">
                        <label class="block text-[13px] font-semibold text-[#1a1a1a] mb-1.5">
                            Nama Lengkap <span class="text-[#f44336]">*</span>
                        </label>
                        <input type="text"
                               wire:model.blur="fullname"
                               placeholder="Masukkan nama lengkap"
                               autofocus
                               class="form-input w-full px-4 py-3 border-2 border-[#e0e0e0] rounded-xl text-sm font-[Poppins] transition-all duration-300 bg-white @error('fullname') border-[#f44336] @enderror"/>
                        @error('fullname')
                            <span class="flex items-center gap-1 text-xs text-[#f44336] mt-1.5">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Username --}}
                    <div class="mb-[18px]">
                        <label class="block text-[13px] font-semibold text-[#1a1a1a] mb-1.5">
                            Username <span class="text-[#f44336]">*</span>
                        </label>
                        <input type="text"
                               wire:model.blur="username"
                               placeholder="Masukkan username"
                               class="form-input w-full px-4 py-3 border-2 border-[#e0e0e0] rounded-xl text-sm font-[Poppins] transition-all duration-300 bg-white @error('username') border-[#f44336] @enderror"/>
                        @error('username')
                            <span class="flex items-center gap-1 text-xs text-[#f44336] mt-1.5">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-[18px]">
                        <label class="block text-[13px] font-semibold text-[#1a1a1a] mb-1.5">
                            Email <span class="text-[#f44336]">*</span>
                        </label>
                        <input type="email"
                               wire:model.blur="email"
                               placeholder="contoh@email.com"
                               class="form-input w-full px-4 py-3 border-2 rounded-xl text-sm font-[Poppins] transition-all duration-300 bg-white
                                   @error('email') border-[#f44336]
                                   @else {{ $email && !$errors->has('email') ? 'border-[#4caf50]' : 'border-[#e0e0e0]' }}
                                   @enderror"/>
                        @error('email')
                            <span class="flex items-center gap-1 text-xs text-[#f44336] mt-1.5">{{ $message }}</span>
                        @else
                            @if($email && !$errors->has('email'))
                                <span class="flex items-center gap-1 text-xs text-[#4caf50] mt-1.5">✓ Email valid</span>
                            @endif
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-[18px]">
                        <label class="block text-[13px] font-semibold text-[#1a1a1a] mb-1.5">
                            Password <span class="text-[#f44336]">*</span>
                        </label>
                        <div class="relative">
                            <input id="password-input"
                                   type="password"
                                   wire:model.live="password"
                                   placeholder="Minimal 8 karakter"
                                   class="form-input w-full px-4 py-3 pr-11 border-2 border-[#e0e0e0] rounded-xl text-sm font-[Poppins] transition-all duration-300 bg-white @error('password') border-[#f44336] @enderror"/>
                            <button type="button"
                                    onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[#666] hover:text-[#004e89] transition-colors duration-200 focus:outline-none">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="flex items-center gap-1 text-xs text-[#f44336] mt-1.5">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-[18px]">
                        <label class="block text-[13px] font-semibold text-[#1a1a1a] mb-1.5">
                            Konfirmasi Password <span class="text-[#f44336]">*</span>
                        </label>
                        <div class="relative">
                            <input id="confirm-password-input"
                                   type="password"
                                   wire:model.live="confirmPassword"
                                   placeholder="Ulangi password"
                                   class="form-input w-full px-4 py-3 pr-11 border-2 rounded-xl text-sm font-[Poppins] transition-all duration-300 bg-white
                                       @error('confirmPassword') border-[#f44336]
                                       @else {{ ($confirmPassword && $confirmPassword === $password && !$errors->has('confirmPassword')) ? 'border-[#4caf50]' : 'border-[#e0e0e0]' }}
                                       @enderror"/>
                              <button type="button"
                                    onclick="togglePassword2()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[#666] hover:text-[#004e89] transition-colors duration-200 focus:outline-none">
                                <i class="fa fa-eye"></i>
                        </div>
                        @error('confirmPassword')
                            <span class="flex items-center gap-1 text-xs text-[#f44336] mt-1.5">{{ $message }}</span>
                        @else
                            @if($confirmPassword && $confirmPassword === $password)
                                <span class="flex items-center gap-1 text-xs text-[#4caf50] mt-1.5">Password cocok</span>
                            @endif
                        @enderror
                    </div>

                    {{-- Terms & Conditions --}}
                    <div class="mb-[18px]">
                        <div class="flex items-start gap-2">
                            <input type="checkbox"
                                   class="w-4 h-4 cursor-pointer mt-[3px] shrink-0"
                                   id="terms"
                                   wire:model="terms"/>
                            <label class="text-[13px] text-[#1a1a1a] cursor-pointer leading-relaxed" for="terms">
                                Saya setuju dengan
                                <a href="#" class="text-[#ff6b35] no-underline font-semibold hover:underline">Syarat & Ketentuan</a>
                                dan
                                <a href="#" class="text-[#ff6b35] no-underline font-semibold hover:underline">Kebijakan Privasi</a>
                                Percetakan Matahari
                            </label>
                        </div>
                        @error('terms')
                            <span class="flex items-center gap-1 text-xs text-[#f44336] mt-1.5">❌ {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full py-3.5 mt-2 bg-[#004e89] text-white border-none rounded-xl text-[15px] font-bold cursor-pointer transition-all duration-300 font-[Poppins] hover:-translate-y-0.5 hover:shadow-[0_8px_25px_rgba(0,78,137,0.3)] disabled:opacity-60 disabled:cursor-not-allowed disabled:translate-y-0"
                            wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
                        <span wire:loading wire:target="register">Memproses...</span>
                    </button>

                </form>

                {{-- Footer --}}
                <div class="text-center text-[13px] text-[#666] mt-5">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-[#ff6b35] no-underline font-semibold hover:underline">Login di sini</a>
                </div>

            </div>
        </div>
    </div>

    <script>
      
        function togglePassword() {
            const field = document.getElementById('password-input');
            field.type = field.type === 'password' ? 'text' : 'password';
        }
        function togglePassword2() {
            const field = document.getElementById('confirm-password-input');
            field.type = field.type === 'password' ? 'text' : 'password';
        }
 
    </script>
</div>