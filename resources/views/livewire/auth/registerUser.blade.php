<div>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary: #ff6b35;
            --biru: #004e89;
            --primary-dark: #e55a2b;
            --secondary: #004e89;
            --secondary-dark: #003d6b;
            --accent: #ffd23f;
            --success: #4caf50;
            --error: #f44336;
            --text-dark: #1a1a1a;
            --text-light: #666;
            --bg-light: #f8f9fa;
            --white: #ffffff;
            --shadow: 0 4px 20px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 40px rgba(0,0,0,0.15);
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: #f5f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
            background: var(--white);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .auth-form-container {
            padding: 50px 40px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .form-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 6px;
        }

        .form-header p {
            color: var(--text-light);
            font-size: 13px;
        }

        .form-group { margin-bottom: 18px; }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .required { color: var(--error); }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
            background: var(--white);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
        }

        .form-input.error { border-color: var(--error); }
        .form-input.success-input { border-color: var(--success); }

        .error-message {
            font-size: 12px;
            color: var(--error);
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .success-message {
            font-size: 12px;
            color: var(--success);
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .password-strength {
            margin-top: 10px;
            padding: 10px 12px;
            background: var(--bg-light);
            border-radius: 8px;
        }

        .strength-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-dark);
            display: block;
            margin-bottom: 6px;
        }

        .strength-bars {
            display: flex;
            gap: 5px;
            margin-bottom: 6px;
        }

        .strength-bar {
            flex: 1;
            height: 5px;
            background: #e0e0e0;
            border-radius: 3px;
            transition: all 0.3s;
        }

        .strength-bar.active { background: var(--success); }
        .strength-bar.active.weak { background: var(--error); }
        .strength-bar.active.medium { background: #ff9800; }

        .strength-text { font-size: 11px; color: var(--text-light); }

        .checkbox-group { display: flex; align-items: flex-start; gap: 8px; }

        .checkbox-input { width: 16px; height: 16px; cursor: pointer; margin-top: 3px; flex-shrink: 0; }

        .checkbox-label {
            font-size: 13px;
            color: var(--text-dark);
            cursor: pointer;
            line-height: 1.5;
        }

        .checkbox-label a { color: var(--primary); text-decoration: none; font-weight: 600; }
        .checkbox-label a:hover { text-decoration: underline; }

        .form-submit {
            width: 100%;
            padding: 14px;
            background-color: var(--biru);
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s, opacity 0.3s;
            font-family: 'Poppins', sans-serif;
            margin-top: 8px;
        }

        .form-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 78, 137, 0.3);
        }

        .form-submit:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

        .auth-footer {
            text-align: center;
            font-size: 13px;
            color: var(--text-light);
            margin-top: 20px;
        }

        .auth-footer a { color: var(--primary); text-decoration: none; font-weight: 600; }
        .auth-footer a:hover { text-decoration: underline; }

        @media (max-width: 640px) {
            body { padding: 20px 15px; }
            .auth-form-container { padding: 35px 25px; }
            .form-header h1 { font-size: 22px; }
        }
    </style>

    <div class="auth-container">
        <div class="auth-form-container">

            {{-- Header --}}
            <div class="form-header">
                <h1>Buat Akun Baru</h1>
              
            </div>

            <form wire:submit.prevent="register">

                {{-- Nama Lengkap --}}
                <div class="form-group">
                    <label class="form-label">
                        Nama Lengkap <span class="required">*</span>
                    </label>
                    <input type="text"
                           wire:model.blur="fullname"
                           placeholder="Masukkan nama lengkap"
                           autofocus
                           class="form-input @error('fullname') error @enderror"/>
                    @error('fullname')
                        <span class="error-message"> {{ $message }}</span>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="form-group">
                    <label class="form-label">
                        Username <span class="required">*</span>
                    </label>
                    <input type="text"
                           wire:model.blur="username"
                           placeholder="Masukkan username"
                           class="form-input @error('username') error @enderror"/>
                    @error('username')
                        <span class="error-message"> {{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label">
                        Email <span class="required">*</span>
                    </label>
                    <input type="email"
                           wire:model.blur="email"
                           placeholder="contoh@email.com"
                           class="form-input @error('email') error @enderror @if($email && !$errors->has('email')) success-input @endif"/>
                    @error('email')
                        <span class="error-message"> {{ $message }}</span>
                    @else
                        @if($email && !$errors->has('email'))
                            <span class="success-message">✓ Email valid</span>
                        @endif
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label">
                        Password <span class="required">*</span>
                    </label>
                    <input type="password"
                           wire:model.live="password"
                           placeholder="Minimal 8 karakter"
                           class="form-input @error('password') error @enderror"/>
                    @error('password')
                        <span class="error-message"> {{ $message }}</span>
                    @enderror

                    
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group">
                    <label class="form-label">
                        Konfirmasi Password <span class="required">*</span>
                    </label>
                    <input type="password"
                           wire:model.live="confirmPassword"
                           placeholder="Ulangi password"
                           class="form-input @error('confirmPassword') error @enderror @if($confirmPassword && $confirmPassword === $password && !$errors->has('confirmPassword')) success-input @endif"/>
                    @error('confirmPassword')
                        <span class="error-message"> {{ $message }}</span>
                    @else
                        @if($confirmPassword && $confirmPassword === $password)
                            <span class="success-message"> Password cocok</span>
                        @endif
                    @enderror
                </div>

                {{-- Terms & Conditions --}}
                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox"
                               class="checkbox-input"
                               id="terms"
                               wire:model="terms"/>
                        <label class="checkbox-label" for="terms">
                            Saya setuju dengan
                            <a href="#">Syarat & Ketentuan</a>
                            dan
                            <a href="#">Kebijakan Privasi</a>
                            Percetakan Matahari
                        </label>
                    </div>
                    @error('terms')
                        <span class="error-message">❌ {{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="form-submit"
                        wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
                    <span wire:loading wire:target="register">Memproses...</span>
                </button>

            </form>

            {{-- Footer --}}
            <div class="auth-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>

        </div>
    </div>
</div>