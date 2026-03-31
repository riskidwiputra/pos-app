<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Percetakan Matahari Kisaran - Solusi Cetak Profesional Anda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #ff6b35;
            --primary-dark: #e55a2b;
            --secondary: #004e89;
            --secondary-dark: #003d6b;
            --accent: #ffd23f;
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
            overflow-x: hidden;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: var(--white);
            box-shadow: var(--shadow);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 10px 0;
            box-shadow: var(--shadow-lg);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 800;
            color: var(--white);
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-text .brand {
            font-size: 22px;
            font-weight: 700;
            color: var(--secondary);
            line-height: 1;
        }

        .logo-text .tagline {
            font-size: 11px;
            color: var(--text-light);
            font-weight: 400;
        }

        .nav-menu {
            display: flex;
            gap: 35px;
            list-style: none;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 15px;
            transition: color 0.3s;
            position: relative;
        }

        .nav-menu a:hover {
            color: var(--primary);
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(255, 107, 53, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: var(--secondary);
            padding: 12px 30px;
            border-radius: 50px;
            border: 2px solid var(--secondary);
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: var(--secondary);
            color: var(--white);
        }

        /* Hero Section */
        .hero {
            margin-top: 80px;
            background: linear-gradient(135deg, #004e89 0%, #1a759f 100%);
            color: var(--white);
            padding: 100px 30px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><path d="M0,300 Q300,100 600,300 T1200,300 L1200,600 L0,600 Z" fill="rgba(255,255,255,0.05)"/></svg>') no-repeat center;
            background-size: cover;
            opacity: 0.3;
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-content h1 {
            font-size: 56px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--white), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-content .highlight {
            color: var(--accent);
            -webkit-text-fill-color: var(--accent);
        }

        .hero-content p {
            font-size: 18px;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            margin-top: 40px;
        }

        .hero-image {
            position: relative;
        }

        .hero-image-placeholder {
            width: 100%;
            height: 450px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 120px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 60px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .stat-item .number {
            font-size: 42px;
            font-weight: 800;
            color: var(--accent);
            display: block;
            margin-bottom: 5px;
        }

        .stat-item .label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }

        /* Services Section */
        .services {
            padding: 100px 30px;
            background: var(--bg-light);
        }

        .section-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 60px;
        }

        .section-subtitle {
            color: var(--primary);
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 42px;
            font-weight: 800;
            color: var(--secondary);
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .section-description {
            font-size: 16px;
            color: var(--text-light);
            line-height: 1.8;
        }

        .services-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .service-card {
            background: var(--white);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            transform: scaleX(0);
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.2);
        }

        .service-card h3 {
            font-size: 22px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 15px;
        }

        .service-card p {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .service-features {
            list-style: none;
            margin-bottom: 20px;
        }

        .service-features li {
            padding: 8px 0;
            font-size: 13px;
            color: var(--text-light);
            position: relative;
            padding-left: 25px;
        }

        .service-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: 700;
        }

        .service-link {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: gap 0.3s;
        }

        .service-link:hover {
            gap: 10px;
        }

        /* How It Works */
        .how-it-works {
            padding: 100px 30px;
            background: var(--white);
        }

        .steps-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-top: 60px;
        }

        .step-card {
            text-align: center;
            position: relative;
        }

        .step-number {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 800;
            margin: 0 auto 25px;
            box-shadow: 0 10px 30px rgba(0, 78, 137, 0.3);
            position: relative;
        }

        .step-card::after {
            content: '→';
            position: absolute;
            top: 40px;
            right: -20px;
            font-size: 32px;
            color: var(--accent);
            font-weight: 700;
        }

        .step-card:last-child::after {
            display: none;
        }

        .step-card h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 15px;
        }

        .step-card p {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.8;
        }

        /* Portfolio/Gallery */
        .portfolio {
            padding: 100px 30px;
            background: var(--bg-light);
        }

        .portfolio-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 60px;
        }

        .portfolio-item {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s;
            cursor: pointer;
        }

        .portfolio-item:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
        }

        .portfolio-image {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, #e0e0e0, #f5f5f5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px;
            position: relative;
        }

        .portfolio-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            padding: 30px;
            transform: translateY(100%);
            transition: transform 0.3s;
        }

        .portfolio-item:hover .portfolio-overlay {
            transform: translateY(0);
        }

        .portfolio-overlay h3 {
            color: var(--white);
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .portfolio-overlay p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
        }

        /* Testimonials */
        .testimonials {
            padding: 100px 30px;
            background: var(--white);
        }

        .testimonials-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 60px;
        }

        .testimonial-card {
            background: var(--bg-light);
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            position: relative;
        }

        .quote-icon {
            font-size: 48px;
            color: var(--primary);
            opacity: 0.2;
            position: absolute;
            top: 20px;
            left: 30px;
        }

        .testimonial-content {
            position: relative;
            z-index: 1;
        }

        .testimonial-text {
            font-size: 15px;
            line-height: 1.8;
            color: var(--text-dark);
            margin-bottom: 25px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 700;
            font-size: 18px;
        }

        .author-info h4 {
            font-size: 16px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 3px;
        }

        .author-info p {
            font-size: 13px;
            color: var(--text-light);
        }

        .rating {
            margin-top: 15px;
            color: var(--accent);
            font-size: 18px;
        }

        /* CTA Section */
        .cta {
            padding: 100px 30px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .cta::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .cta h2 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .cta p {
            font-size: 18px;
            margin-bottom: 40px;
            opacity: 0.95;
            line-height: 1.8;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn-white {
            background: var(--white);
            color: var(--primary);
            padding: 15px 40px;
            border-radius: 50px;
            border: none;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        }

        /* Footer */
        .footer {
            background: var(--secondary-dark);
            color: var(--white);
            padding: 80px 30px 30px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 50px;
        }

        .footer-about h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--accent);
        }

        .footer-about p {
            line-height: 1.8;
            margin-bottom: 25px;
            opacity: 0.8;
            font-size: 14px;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: var(--white);
            transition: all 0.3s;
        }

        .social-link:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .footer-links h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--accent);
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links ul li {
            margin-bottom: 12px;
        }

        .footer-links ul li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            display: inline-block;
        }

        .footer-links ul li a:hover {
            color: var(--accent);
            padding-left: 5px;
        }

        .footer-contact h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--accent);
        }

        .contact-item {
            display: flex;
            gap: 12px;
            margin-bottom: 15px;
            font-size: 14px;
            opacity: 0.8;
            line-height: 1.6;
        }

        .contact-item .icon {
            color: var(--accent);
            font-size: 18px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
            text-align: center;
            opacity: 0.7;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .nav-menu {
                display: none;
            }

            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-content h1 {
                font-size: 42px;
            }

            .hero-buttons {
                justify-content: center;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 32px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .cta h2 {
                font-size: 36px;
            }

            .cta-buttons {
                flex-direction: column;
            }
        }

        @media (max-width: 640px) {
            .hero-content h1 {
                font-size: 32px;
            }

            .services-grid,
            .portfolio-grid,
            .testimonials-grid {
                grid-template-columns: 1fr;
            }

            .steps-grid {
                grid-template-columns: 1fr;
            }

            .step-card::after {
                content: '↓';
                top: auto;
                bottom: -30px;
                right: 50%;
                transform: translateX(50%);
            }
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 24px;
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
            cursor: pointer;
            transition: all 0.3s;
            z-index: 999;
            text-decoration: none;
        }

        .fab:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 35px rgba(255, 107, 53, 0.5);
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#home" class="logo">
                <div class="logo-icon">PM</div>
                <div class="logo-text">
                    <span class="brand">Percetakan Matahari</span>
                    <span class="tagline">Kisaran - Sumatera Utara</span>
                </div>
            </a>
            <ul class="nav-menu">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#services">Layanan</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#testimonials">Testimoni</a></li>
                <li><a href="#contact">Kontak</a></li>
                <li><a href="{{ route('login') }}" class="btn-primary">Masuk</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-content">
                <h1>Solusi Cetak <span class="highlight">Profesional</span> untuk Semua Kebutuhan Anda</h1>
                <p>Percetakan Matahari Kisaran hadir sebagai mitra terpercaya Anda dalam mewujudkan semua kebutuhan percetakan dengan kualitas terbaik, harga kompetitif, dan layanan cepat.</p>
                <div class="hero-buttons">
                    <a href="#order" class="btn-primary"> Order Sekarang</a>
                    <a href="#services" class="btn-secondary"> Lihat Layanan</a>
                </div>
                
               
            </div>
            
            <div class="hero-image">
                <div class="hero-image-placeholder">🖨️</div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="services-container">
            <div class="section-header">
                <div class="section-subtitle">Layanan Kami</div>
                <h2 class="section-title">Percetakan Lengkap untuk Semua Kebutuhan</h2>
                <p class="section-description">Kami menyediakan berbagai layanan percetakan profesional dengan teknologi modern dan tim berpengalaman untuk menghasilkan produk berkualitas tinggi.</p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🖼️</div>
                    <h3>Spanduk & Banner</h3>
                    <p>Cetak spanduk berkualitas untuk promosi, event, dan kebutuhan bisnis Anda.</p>
                    <ul class="service-features">
                        <li>Spanduk Flexi & Albatros</li>
                        <li>Banner Stand & X-Banner</li>
                        <li>Roll Banner & Backdrop</li> 
                        <li>Ukuran Custom</li>
                    </ul>
                    <a href="#order" class="service-link">Order Sekarang →</a>
                </div>

                <div class="service-card">
                    <div class="service-icon">📅</div>
                    <h3>Kalender Custom</h3>
                    <p>Buat kalender dengan desain unik untuk promosi perusahaan atau kenang-kenangan.</p>
                    <ul class="service-features">
                        <li>Kalender Dinding</li>
                        <li>Kalender Meja</li>
                        <li>Kalender Duduk</li>
                        <li>Design Custom Gratis</li>
                    </ul>
                    <a href="#order" class="service-link">Order Sekarang →</a>
                </div>

                <div class="service-card">
                    <div class="service-icon">💍</div>
                    <h3>Undangan Pernikahan</h3>
                    <p>Undangan pernikahan eksklusif dengan berbagai pilihan desain dan bahan premium.</p>
                    <ul class="service-features">
                        <li>Softcover & Hardcover</li>
                        <li>Desain Elegant & Modern</li>
                        <li>Amplop & Box Eksklusif</li>
                        <li>Konsultasi Gratis</li>
                    </ul>
                    <a href="#order" class="service-link">Order Sekarang →</a>
                </div>

                <div class="service-card">
                    <div class="service-icon">📋</div>
                    <h3>Stempel </h3>
                    <p>Pembuatan stempel profesional untuk kebutuhan bisnis dan instansi.</p>
                    <ul class="service-features">
                        <li>Stempel Kayu & Flash</li>
                        <li>Stempel Warna</li>
                        <li>Stempel Digital</li>
                        <li>Proses Cepat 1 Hari</li>
                    </ul>
                    <a href="#order" class="service-link">Order Sekarang →</a>
                </div>

                <div class="service-card">
                    <div class="service-icon">📄</div>
                    <h3>Cetak Dokumen</h3>
                    <p>Layanan fotocopy, print, dan penjilidan untuk keperluan administrasi.</p>
                    <ul class="service-features">
                        <li>Fotocopy Hitam Putih & Warna</li>
                        <li>Print Dokumen</li>
                        <li>Penjilidan Soft & Hard Cover</li>
                        <li>Laminating</li>
                    </ul>
                    <a href="#order" class="service-link">Order Sekarang →</a>
                </div>

                <div class="service-card">
                    <div class="service-icon">🖨️</div>
                    <h3>Cetak Lainnya</h3>
                    <p>Berbagai layanan cetak khusus untuk kebutuhan promosi dan souvenir.</p>
                    <ul class="service-features">
                        <li>Sticker & Label</li>
                        <li>ID Card & Pin</li>
                        <li>Gantungan Kunci</li>
                        <li>Mug & Mouse Pad</li>
                    </ul>
                    <a href="#order" class="service-link">Order Sekarang →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="steps-container">
            <div class="section-header">
                <div class="section-subtitle">Cara Order</div>
                <h2 class="section-title">Order Online Mudah & Cepat</h2>
                <p class="section-description">Pesan layanan percetakan kami dengan mudah melalui website. Proses yang simple dan transparan.</p>
            </div>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3>Daftar/Login</h3>
                    <p>Buat akun gratis atau login jika sudah memiliki akun. Proses pendaftaran hanya membutuhkan waktu 1 menit.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3>Pilih Layanan</h3>
                    <p>Pilih jenis layanan yang Anda butuhkan dan isi detail pesanan seperti ukuran, jumlah, dan spesifikasi.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3>Upload Desain</h3>
                    <p>Upload file desain Anda (PDF, AI, CDR, JPG, PNG). Jika belum ada, kami bisa bantu buatkan.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">4</div>
                    <h3>Konfirmasi Order</h3>
                    <p>Tim kami akan review dan konfirmasi pesanan Anda dalam 1-2 jam kerja via WhatsApp atau email.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">5</div>
                    <h3>Pembayaran</h3>
                    <p>Lakukan pembayaran via transfer bank atau e-wallet. DP 50% untuk order khusus.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">6</div>
                    <h3>Ambil Pesanan</h3>
                    <p>Pesanan siap diambil sesuai estimasi waktu atau bisa request pengiriman ke alamat Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio -->
    <section class="portfolio" id="portfolio">
        <div class="portfolio-container">
            <div class="section-header">
                <div class="section-subtitle">Portfolio Kami</div>
                <h2 class="section-title">Hasil Karya Terbaik Kami</h2>
                <p class="section-description">Lihat beberapa contoh hasil pekerjaan kami yang telah dipercaya oleh ratusan klien di Kisaran dan sekitarnya.</p>
            </div>

            <div class="portfolio-grid">
                <div class="portfolio-item">
                    <div class="portfolio-image">🖼️</div>
                    <div class="portfolio-overlay">
                        <h3>Spanduk Event Grand Opening</h3>
                        <p>Toko Elektronik Jaya - Spanduk Flexi 4x2 meter</p>
                    </div>
                </div>

                <div class="portfolio-item">
                    <div class="portfolio-image">💍</div>
                    <div class="portfolio-overlay">
                        <h3>Undangan Pernikahan Premium</h3>
                        <p>Budi & Sari - Hardcover Gold Foil 500 pcs</p>
                    </div>
                </div>

                <div class="portfolio-item">
                    <div class="portfolio-image">📅</div>
                    <div class="portfolio-overlay">
                        <h3>Kalender Perusahaan 2026</h3>
                        <p>PT. Sejahtera Abadi - Kalender Dinding 1000 pcs</p>
                    </div>
                </div>

                <div class="portfolio-item">
                    <div class="portfolio-image">👕</div>
                    <div class="portfolio-overlay">
                        <h3>Kaos Seragam Event</h3>
                        <p>Festival Budaya Kisaran - 500 Kaos DTF Full Color</p>
                    </div>
                </div>

                <div class="portfolio-item">
                    <div class="portfolio-image">📋</div>
                    <div class="portfolio-overlay">
                        <h3>Stempel Perusahaan</h3>
                        <p>CV. Maju Jaya - Stempel Flash & Warna</p>
                    </div>
                </div>

                <div class="portfolio-item">
                    <div class="portfolio-image">🎨</div>
                    <div class="portfolio-overlay">
                        <h3>Desain Logo & Branding</h3>
                        <p>Kafe Santai - Logo + Business Card + Menu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials" id="testimonials">
        <div class="testimonials-container">
            <div class="section-header">
                <div class="section-subtitle">Testimoni</div>
                <h2 class="section-title">Apa Kata Pelanggan Kami</h2>
                <p class="section-description">Kepuasan pelanggan adalah prioritas utama kami. Berikut beberapa testimoni dari pelanggan setia kami.</p>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="quote-icon">"</div>
                    <div class="testimonial-content">
                        <p class="testimonial-text">Pelayanan sangat memuaskan! Spanduk untuk grand opening toko saya dicetak dengan kualitas bagus dan selesai tepat waktu. Harga juga sangat kompetitif. Pasti order lagi!</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">BS</div>
                            <div class="author-info">
                                <h4>Budi Santoso</h4>
                                <p>Pemilik Toko Elektronik Jaya</p>
                            </div>
                        </div>
                        <div class="rating">⭐⭐⭐⭐⭐</div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="quote-icon">"</div>
                    <div class="testimonial-content">
                        <p class="testimonial-text">Undangan pernikahan kami dicetak di Percetakan Matahari. Hasilnya luar biasa! Desainnya elegant dan kualitas cetaknya premium. Banyak tamu yang memuji undangannya. Terima kasih!</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">SA</div>
                            <div class="author-info">
                                <h4>Siti Aminah</h4>
                                <p>Customer</p>
                            </div>
                        </div>
                        <div class="rating">⭐⭐⭐⭐⭐</div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="quote-icon">"</div>
                    <div class="testimonial-content">
                        <p class="testimonial-text">Sudah langganan di sini untuk cetak kalender perusahaan tiap tahun. Prosesnya mudah, hasil bagus, dan harga terjangkau. Tim nya juga responsif dan profesional.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">AW</div>
                            <div class="author-info">
                                <h4>Ahmad Wijaya</h4>
                                <p>HRD PT. Sejahtera Abadi</p>
                            </div>
                        </div>
                        <div class="rating">⭐⭐⭐⭐⭐</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="order">
        <div class="cta-content">
            <h2>Siap Mewujudkan Kebutuhan Cetak Anda?</h2>
            <p>Daftar sekarang dan dapatkan konsultasi gratis untuk project cetak Anda. Tim kami siap membantu mewujudkan ide Anda menjadi kenyataan!</p>
            <div class="cta-buttons">
                <a href="{{ route('register') }}" class="btn-white"> Daftar Sekarang</a>
                <a href="https://wa.me/6281234567890" class="btn-secondary" style="background: rgba(255,255,255,0.2); border-color: white; color: white;"> Chat WhatsApp</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-about">
                    <h3>Percetakan Matahari</h3>
                    <p>Percetakan terpercaya di Kisaran yang menyediakan berbagai layanan cetak profesional dengan kualitas terbaik, harga kompetitif, dan layanan cepat untuk memenuhi semua kebutuhan Anda.</p>
                    
                </div>

                <div class="footer-links">
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="#services">Spanduk & Banner</a></li>
                        <li><a href="#services">Kalender</a></li>
                        <li><a href="#services">Undangan</a></li>
                        <li><a href="#services">Stempel</a></li>
                        <li><a href="#services">Cetak Dokumen</a></li>
                        
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Perusahaan</h4>
                    <ul>
                        <li><a href="#home">Tentang Kami</a></li>
                        <li><a href="#portfolio">Portfolio</a></li>
                        <li><a href="#testimonials">Testimoni</a></li>
                        <li><a href="#order">Cara Order</a></li>
                       
                    </ul>
                </div>

                <div class="footer-contact">
                    <h4>Hubungi Kami</h4>
                    <div class="contact-item">
                        <span class="icon">📍</span>
                        <span>Jl. Raya Kisaran No. 123<br>Kisaran, Sumatera Utara 21224</span>
                    </div>
                    <div class="contact-item">
                        <span class="icon">📞</span>
                        <span>+62 812-3456-7890</span>
                    </div>
                    <div class="contact-item">
                        <span class="icon">✉️</span>
                        <span>info@percetakanmatahari.com</span>
                    </div>
                    <div class="contact-item">
                        <span class="icon">⏰</span>
                        <span>Senin - Sabtu: 08:00 - 17:00<br>Minggu & Libur: Tutup</span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Percetakan Matahari Kisaran. All Rights Reserved. Made with ❤️ in Kisaran</p>
            </div>
        </div>
    </footer>



    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>