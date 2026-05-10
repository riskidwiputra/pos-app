<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Percetakan Matahari</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://i.ibb.co.com/B5RDsQKQ/Logo-jpg.jpg">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #ff6b35;
            --primary-dark: #e55a2b;
            --secondary: #1F2937;
            --secondary-dark: #111827;
            --accent: #ffd23f;
            --success: #4caf50;
            --error: #f44336;
            --text-dark: #1a1a1a;
            --text-light: #666;
            --bg-light: #f8f9fa;
            --white: #ffffff;
            --biru: #004e89;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 8px 40px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            /* background: linear-gradient(135deg, #004e89 0%, #1a759f 100%); */
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
            grid-template-columns: 1fr 1fr;
            background: var(--white);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        /* Left Side - Branding */
        .auth-brand {
            background: linear-gradient(195deg, #0d1423, #17458f);
            padding: 60px 40px;
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* .auth-brand::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        } */

        /* .auth-brand::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -20%;
            width: 350px;
            height: 350px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        } */

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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 20px 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 800;
            color: var(--accent);
            display: block;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 11px;
            opacity: 0.9;
        }

        /* Right Side - Form */
        .auth-form-container {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--biru);
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

        .form-input {
            width: 100%;
            padding: 14px 18px;
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

        .form-input.error {
            border-color: var(--error);
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

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-input {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-label {
            font-size: 14px;
            color: var(--text-dark);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 14px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .form-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #3B82F6, #1E3A8A);
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

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .alert-error {
            background: #ffebee;
            border: 1px solid #f44336;
            color: #c62828;
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

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Left Side - Branding -->
        <div class="auth-brand">
            <a href="/" class="back-home">
                ← Kembali ke Beranda
            </a>
            
            <div class="brand-content">
                <div class="logo-container">
                     @php
                    $path = public_path('img/logo/Logo-remove.png');
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp
                <img src="{{ $image }}" width="370">
                   
                </div>

                <h2>Selamat Datang Kembali!</h2>
                <p>Login untuk melanjutkan pesanan Anda dan nikmati berbagai layanan percetakan.</p>

                
            </div>
        </div>
        {{-- Success dari Register --}}

        <!-- Right Side - Login Form -->
        <div class="auth-form-container">
       

       
            <div class="form-header">
                 
                <h1>Masuk ke Akun Anda</h1>
                <p>Masukkan email dan password untuk login</p>
            </div>

            <!-- Error Alert -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <strong> Login Gagal!</strong><br>
                    {{ $errors->first() }}
                </div>
            @endif
             @if (session('status'))
            <div class="alert" style="background: #e8f5e9; border: 1px solid #4caf50; color: #2e7d32;">
                <strong>✓ Berhasil!</strong><br>
                {{ session('status') }}
            </div>
        @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email or Phone -->
                <div class="form-group">
                    <label class="form-label">
                        Email atau Username <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-input @error('email') error @enderror" 
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email atau Username"
                        required
                        autofocus
                    >
                    @error('email')
                        <span class="error-message"> {{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label">
                        Password <span class="required">*</span>
                    </label>
                    <div class="input-group">
                        <input 
                            type="password" 
                            class="form-input @error('password') error @enderror" 
                            name="password"
                            id="password"
                            placeholder="Masukkan password"
                            required
                        >
                        {{-- <span class="input-icon" onclick="togglePassword()">👁️</span> --}}
                    </div>
                    @error('password')
                        <span class="error-message"> {{ $message }}</span>
                    @enderror
                </div>

                

                <!-- Submit Button -->
                <button type="submit" class="form-submit">
                     Login
                </button>
            </form>

          
            <!-- Footer -->
            <div class="auth-footer mt-4" style="margin-top: 15px;">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const field = document.getElementById('password');
            field.type = field.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>