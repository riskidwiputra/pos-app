<div>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* Copy semua CSS dari HTML register */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #ff6b35;
            --biru : #004e89;
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
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 8px 40px rgba(0, 0, 0, 0.15);
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
            max-width: 900px;
            display: grid;
            grid-template-columns: 1fr;
            background: var(--white);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .auth-brand {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            padding: 60px 40px;
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .auth-brand::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .auth-brand::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -20%;
            width: 350px;
            height: 350px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .brand-content {
            position: relative;
            z-index: 1;
        }

        .back-home {
            position: absolute;
            top: 30px;
            left: 40px;
            color: var(--white);
            text-decoration: none;
            font-size: 14px;
            opacity: 0.9;
            transition: opacity 0.3s;
            z-index: 2;
        }

        .back-home:hover {
            opacity: 1;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 800;
            color: var(--white);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
        }

        .logo-text .brand {
            font-size: 24px;
            font-weight: 700;
            display: block;
            margin-bottom: 5px;
        }

        .logo-text .tagline {
            font-size: 12px;
            opacity: 0.9;
        }

        .brand-content h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .brand-content p {
            font-size: 15px;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .benefits-list {
            list-style: none;
        }

        .benefits-list li {
            padding: 12px 0;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .benefits-list li::before {
            content: '✓';
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-weight: 700;
        }

        .auth-form-container {
            padding: 60px 50px;
            
            max-height: 90vh;
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .form-header p {
            color: var(--text-light);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .required {
            color: var(--error);
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
            background: var(--white);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
        }

        .form-input.error {
            border-color: var(--error);
        }

        .form-input.success {
            border-color: var(--success);
        }

        .form-textarea {
            resize: vertical;
            min-height: 80px;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            cursor: pointer;
            font-size: 18px;
        }

        .error-message {
            font-size: 12px;
            color: var(--error);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .success-message {
            font-size: 12px;
            color: var(--success);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .password-strength {
            margin-top: 12px;
            padding: 12px;
            background: var(--bg-light);
            border-radius: 8px;
        }

        .strength-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-dark);
            display: block;
            margin-bottom: 8px;
        }

        .strength-bars {
            display: flex;
            gap: 6px;
            margin-bottom: 8px;
        }

        .strength-bar {
            flex: 1;
            height: 6px;
            background: #e0e0e0;
            border-radius: 3px;
            transition: all 0.3s;
        }

        .strength-bar.active {
            background: var(--success);
        }

        .strength-bar.active.weak {
            background: var(--error);
        }

        .strength-bar.active.medium {
            background: #ff9800;
        }

        .strength-text {
            font-size: 11px;
            color: var(--text-light);
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .checkbox-input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            margin-top: 2px;
        }

        .checkbox-label {
            font-size: 13px;
            color: var(--text-dark);
            cursor: pointer;
            line-height: 1.5;
        }

        .checkbox-label a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .checkbox-label a:hover {
            text-decoration: underline;
        }

        .form-submit {
            width: 100%;
            padding: 16px;
            /* background: linear-gradient(135deg, var(--biru), var(--primary-dark)); */
            background-color : var(--biru);
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            font-family: 'Poppins', sans-serif;
        }

        .form-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
        }

        .form-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .form-divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
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

        .form-divider span {
            background: var(--white);
            padding: 0 20px;
            font-size: 13px;
            color: var(--text-light);
            position: relative;
            z-index: 1;
        }

        .social-login {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 25px;
        }

        .social-button {
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            background: var(--white);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Poppins', sans-serif;
        }

        .social-button:hover {
            border-color: var(--primary);
            background: rgba(255, 107, 53, 0.05);
        }

        .auth-footer {
            text-align: center;
            font-size: 14px;
            color: var(--text-light);
        }

        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .auth-container {
                grid-template-columns: 1fr;
            }

            .auth-brand {
                display: none;
            }

            .auth-form-container {
                padding: 40px 30px;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 20px 15px;
            }

            .auth-form-container {
                padding: 30px 20px;
            }

            .form-header h1 {
                font-size: 24px;
            }

            .social-login {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="auth-container">
        <!-- Left Side - Branding -->
        

        <!-- Right Side - Register Form -->
        <div class="auth-form-container">
            <div class="form-header">
                <h1>Buat Akun Baru</h1>

            </div>

            <form wire:submit="register">
                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label class="form-label">
                        Nama Lengkap <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-input @error('fullname') error @enderror" 
                        wire:model.blur="fullname"
                        placeholder="Masukkan nama lengkap"
                        autofocus
                    >
                    @error('fullname')
                        <span class="error-message">❌ {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">
                        Username <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-input @error('username') error @enderror" 
                        wire:model.blur="username"
                        placeholder="Masukkan Username"
                        autofocus
                    >
                    @error('username')
                        <span class="error-message">❌ {{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label">
                        Email <span class="required">*</span>
                    </label>
                    <input 
                        type="email" 
                        class="form-input @error('email') error @enderror" 
                        wire:model.blur="email"
                        placeholder="contoh@email.com"
                    >
                    @error('email')
                        <span class="error-message">❌ {{ $message }}</span>
                    @else
                        @if($email && !$errors->has('email'))
                            <span class="success-message">✓ Email valid</span>
                        @endif
                    @enderror
                </div>


                

              

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label">
                        Password <span class="required">*</span>
                    </label>
                    <div class="input-group" x-data="{ show: false }">
                        <input 
                            :type="show ? 'text' : 'password'"
                            class="form-input @error('password') error @enderror" 
                            wire:model.live="password"
                            placeholder="Minimal 8 karakter"
                        >
                        {{-- <span class="input-icon" @click="show = !show" x-text="show ? '🙈' : '👁️'"></span> --}}
                    </div>
                    @error('password')
                        <span class="error-message"> {{ $message }}</span>
                    @enderror

                    <!-- Password Strength Indicator -->
                    @if($password)
                        <div class="password-strength">
                            <span class="strength-label">Kekuatan Password:</span>
                            <div class="strength-bars">
                                <div class="strength-bar {{ strlen($password) >= 8 ? 'active' : '' }}"></div>
                                <div class="strength-bar {{ strlen($password) >= 8 && preg_match('/[A-Z]/', $password) ? 'active' : '' }}"></div>
                                <div class="strength-bar {{ strlen($password) >= 8 && preg_match('/[0-9]/', $password) ? 'active' : '' }}"></div>
                                <div class="strength-bar {{ strlen($password) >= 8 && preg_match('/[^a-zA-Z0-9]/', $password) ? 'active' : '' }}"></div>
                            </div>
                            <span class="strength-text">
                                @php
                                    $score = 0;
                                    if(strlen($password) >= 8) $score++;
                                    if(preg_match('/[A-Z]/', $password)) $score++;
                                    if(preg_match('/[0-9]/', $password)) $score++;
                                    if(preg_match('/[^a-zA-Z0-9]/', $password)) $score++;
                                @endphp
                                @if($score <= 1)
                                    Lemah - Tambahkan huruf besar, angka, atau simbol
                                @elseif($score == 2)
                                    Sedang - Tambahkan simbol untuk lebih kuat
                                @elseif($score == 3)
                                    Kuat - Password Anda cukup aman
                                @else
                                    Sangat Kuat - Password Anda sangat aman
                                @endif
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group">
                    <label class="form-label">
                        Konfirmasi Password <span class="required">*</span>
                    </label>
                    <div class="input-group" x-data="{ show: false }">
                        <input 
                            :type="show ? 'text' : 'password'"
                            class="form-input @error('confirmPassword') error @enderror" 
                            wire:model.live="confirmPassword"
                            placeholder="Ulangi password"
                        >
                        {{-- <span class="input-icon" @click="show = !show" x-text="show ? '🙈' : '👁️'"></span> --}}
                    </div>
                    @error('confirmPassword')
                        <span class="error-message">❌ {{ $message }}</span>
                    @else
                        @if($confirmPassword && $confirmPassword === $password)
                            <span class="success-message">✓ Password cocok</span>
                        @endif
                    @enderror
                </div>

                <!-- Terms & Conditions -->
                <div class="form-group">
                    <div class="checkbox-group">
                        <input 
                            type="checkbox" 
                            class="checkbox-input" 
                            id="terms"
                            wire:model="terms"
                        >
                        <label class="checkbox-label" for="terms">
                            Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> Percetakan Matahari
                        </label>
                    </div>
                    @error('terms')
                        <span class="error-message">❌ {{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="form-submit" wire:loading.attr="disabled">
                    <span wire:loading.remove> Daftar Sekarang</span>
                    <span wire:loading> Memproses...</span>
                </button>
            </form>

           

            <!-- Footer -->
            <div class="auth-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </div>
    </div>
</div>