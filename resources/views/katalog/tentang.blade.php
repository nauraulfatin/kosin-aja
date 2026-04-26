<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - KosinAja!</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --bg: #FDFAF4;
        --cta: #7CA385;
        --cta-hover: #5e8a68;
        --text-dark: #1a2e1c;
        --text-mid: #4a5e4c;
        --text-light: #8a9e8c;
        --card-bg: #ffffff;
        --border: #e8efe9;
    }

    body {
        font-family: 'DM Sans', sans-serif;
        background-color: var(--bg);
        color: var(--text-dark);
        overflow-x: hidden;
    }

    /* ───── NAVBAR ───── */
    nav {
        position: sticky;
        top: 0;
        z-index: 100;
        background: var(--bg);
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 64px;
        height: 68px;
        backdrop-filter: blur(8px);
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .nav-logo img {
        width: 36px;
        height: 36px;
        object-fit: contain;
    }

    .nav-logo span {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.25rem;
        color: var(--text-dark);
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 36px;
        list-style: none;
    }

    .nav-links a {
        text-decoration: none;
        color: var(--text-mid);
        font-size: 0.95rem;
        font-weight: 500;
        transition: color 0.2s;
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: var(--cta);
        border-bottom: 2px solid var(--cta);
        padding-bottom: 2px;
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-outline {
        padding: 9px 24px;
        border: 1.5px solid var(--cta);
        color: var(--cta);
        border-radius: 10px;
        background: transparent;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-outline:hover {
        background: var(--cta);
        color: #fff;
    }

    .btn-primary {
        padding: 9px 24px;
        background: var(--cta);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s;
    }

    .btn-primary:hover {
        background: var(--cta-hover);
    }

    /* ───── HERO TENTANG ───── */
    .hero-tentang {
        padding: 56px 64px 40px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 40px;
        position: relative;
        overflow: hidden;
    }

    .hero-tentang::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(124, 163, 133, 0.12) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-tentang-text {
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(124, 163, 133, 0.12);
        border: 1px solid rgba(124, 163, 133, 0.3);
        border-radius: 20px;
        padding: 6px 16px;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--cta);
        margin-bottom: 20px;
    }

    .hero-tentang-text h1 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: clamp(2rem, 3.5vw, 2.8rem);
        line-height: 1.15;
        color: var(--text-dark);
        margin-bottom: 16px;
    }

    .hero-tentang-text p {
        font-size: 1rem;
        color: var(--text-mid);
        line-height: 1.7;
        max-width: 400px;
    }

    .hero-tentang-image {
        display: flex;
        justify-content: flex-end;
        position: relative;
        z-index: 2;
    }

    .hero-tentang-image img {
        width: 100%;
        max-width: none;
        height: auto;
    }


    /* ───── KISAH KAMI ───── */
    .kisah-section {
        padding: 20px 64px 48px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 56px;
        align-items: center;
    }

    .kisah-image img {
        width: 100%;
        max-height: 340px;
        object-fit: cover;
        border-radius: 20px;
    }

    .kisah-text h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.5rem;
        margin-bottom: 16px;
        color: var(--text-dark);
    }

    .kisah-text p {
        font-size: 0.9rem;
        color: var(--text-mid);
        line-height: 1.8;
        margin-bottom: 14px;
    }

    /* ───── VISI MISI ───── */
    .visimisi-section {
        padding: 0 64px 48px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .vm-box {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 32px;
    }

    .vm-icon {
        width: 44px;
        height: 44px;
        background: #f0f5f1;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .vm-icon svg {
        width: 22px;
        height: 22px;
        fill: var(--cta);
    }

    .vm-box h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.15rem;
        color: var(--text-dark);
        margin-bottom: 12px;
    }

    .vm-box p {
        font-size: 0.88rem;
        color: var(--text-mid);
        line-height: 1.7;
        margin-bottom: 14px;
    }

    .vm-box ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .vm-box ul li {
        font-size: 0.85rem;
        color: var(--text-mid);
        display: flex;
        align-items: flex-start;
        gap: 8px;
        line-height: 1.5;
    }

    .vm-box ul li::before {
        content: '▸';
        color: var(--cta);
        font-size: 0.75rem;
        margin-top: 2px;
        flex-shrink: 0;
    }

    /* ───── KEUNGGULAN ───── */
    .keunggulan-section {
        padding: 0 64px 48px;
    }

    .section-title-center {
        text-align: center;
        margin-bottom: 36px;
    }

    .section-title-center .divider-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        margin-bottom: 4px;
    }

    .section-title-center .divider-row::before,
    .section-title-center .divider-row::after {
        content: '';
        width: 48px;
        height: 1.5px;
        background: var(--border);
    }

    .section-title-center h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.45rem;
        color: var(--text-dark);
    }

    .section-title-center p {
        font-size: 0.88rem;
        color: var(--text-light);
        margin-top: 6px;
    }

    .keunggulan-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .keunggulan-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 28px 24px;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .keunggulan-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(124, 163, 133, 0.15);
    }

    .keunggulan-icon {
        width: 52px;
        height: 52px;
        background: #f0f5f1;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .keunggulan-icon svg {
        width: 26px;
        height: 26px;
        fill: var(--cta);
    }

    .keunggulan-card h4 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .keunggulan-card p {
        font-size: 0.82rem;
        color: var(--text-light);
        line-height: 1.7;
    }

    /* ───── STATS ───── */
    .stats-section {
        padding: 0 64px 48px;
    }

    .stats-bar {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 36px 48px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        text-align: center;
    }

    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }

    .stat-item:not(:last-child) {
        border-right: 1px solid var(--border);
    }

    .stat-item strong {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 2rem;
        color: var(--cta);
    }

    .stat-item span {
        font-size: 0.85rem;
        color: var(--text-light);
    }

    /* ───── CTA JOIN ───── */
    .cta-join {
        margin: 0 64px 56px;
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 48px 56px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }

    .cta-join-text h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        margin-bottom: 10px;
    }

    .cta-join-text p {
        font-size: 0.9rem;
        color: var(--text-mid);
        line-height: 1.7;
        max-width: 480px;
    }

    .cta-join-actions {
        display: flex;
        gap: 12px;
        flex-shrink: 0;
    }

    .btn-cta-green {
        padding: 13px 28px;
        background: var(--cta);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.2s, transform 0.2s;
        white-space: nowrap;
    }

    .btn-cta-green:hover {
        background: var(--cta-hover);
        transform: translateY(-2px);
    }

    .btn-cta-outline {
        padding: 13px 28px;
        background: transparent;
        color: var(--cta);
        border: 1.5px solid var(--cta);
        border-radius: 12px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .btn-cta-outline:hover {
        background: var(--cta);
        color: #fff;
    }

    .cta-join-image img {
        width: 160px;
        object-fit: contain;
    }

    /* ───── FOOTER ───── */
    footer {
        background: var(--bg);
        position: relative;
        overflow: hidden;
        border-top: 1px solid var(--border);
    }

    .footer-leaf {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: auto;
        display: block;
        opacity: 0.5;
        pointer-events: none;
    }

    .footer-inner {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 32px 64px 0;
    }

    .footer-top {
        display: grid;
        grid-template-columns: repeat(3, auto);
        justify-content: center;
        align-items: start;
        gap: 80px;
        width: 100%;
        text-align: center;
    }

    .footer-col ul {
        align-items: center;
    }

    .contact-item {
        justify-content: center;
    }

    .footer-brand .logo-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .footer-brand .logo-row img {
        width: 34px;
        height: 34px;
        object-fit: contain;
    }

    .footer-brand .logo-row span {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.1rem;
        color: var(--text-dark);
    }

    .footer-brand p {
        font-size: 0.8rem;
        color: var(--text-light);
        line-height: 1.8;
        text-align: center;
    }

    .footer-col {
        text-align: center;
    }

    .footer-col h4 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 0.95rem;
        color: var(--text-dark);
        margin-bottom: 16px;
        text-align: center;
    }

    .footer-col ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: center;
    }

    .footer-col ul li a {
        font-size: 0.8rem;
        color: var(--text-light);
        text-decoration: none;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .footer-col ul li a:hover {
        color: var(--cta);
    }

    .footer-col ul li a::before {
        content: '▸';
        font-size: 0.75rem;
        color: var(--cta);
    }

    .contact-item {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 0.8rem;
        color: var(--text-light);
        margin-bottom: 12px;
        text-align: center;
    }

    .contact-icon {
        width: 26px;
        height: 26px;
        background: #f0f5f1;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .contact-icon svg {
        width: 13px;
        height: 13px;
        fill: var(--cta);
    }

    .footer-bottom {
        width: 100%;
        border-top: 1px solid var(--border);
        padding: 12px 0;
        text-align: center;
        font-size: 0.72rem;
        color: var(--text-light);
        letter-spacing: 0.12em;
        position: relative;
        z-index: 2;
        background: transparent;
        margin-top: 0;
    }

    /* ───── RESPONSIVE ───── */
    @media (max-width: 1024px) {
        nav {
            padding: 0 32px;
        }

        .hero-tentang,
        .kisah-section,
        .visimisi-section {
            padding-left: 32px;
            padding-right: 32px;
        }

        .keunggulan-section,
        .stats-section,
        .cta-join {
            padding-left: 32px;
            padding-right: 32px;
        }

        .footer-inner {
            padding: 40px 32px 24px;
        }

        .keunggulan-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        nav {
            padding: 0 20px;
        }

        .nav-links {
            display: none;
        }

        .hero-tentang {
            grid-template-columns: 1fr;
            padding: 36px 20px;
            text-align: center;
        }

        .hero-tentang-image {
            justify-content: center;
        }

        .kisah-section,
        .visimisi-section {
            grid-template-columns: 1fr;
            padding: 0 20px 32px;
        }

        .keunggulan-section,
        .stats-section {
            padding: 0 20px 32px;
        }

        .keunggulan-grid {
            grid-template-columns: 1fr;
        }

        .stats-bar {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .stat-item:not(:last-child) {
            border-right: none;
            border-bottom: 1px solid var(--border);
            padding-bottom: 20px;
        }

        .cta-join {
            flex-direction: column;
            text-align: center;
            margin: 0 20px 32px;
            padding: 32px 24px;
        }

        .cta-join-actions {
            justify-content: center;
            flex-wrap: wrap;
        }

        .footer-inner {
            padding: 32px 20px 20px;
        }

        .footer-top {
            grid-template-columns: 1fr;
            gap: 28px;
        }
    }
    </style>
</head>

<body>

    {{-- ───── NAVBAR ───── --}}
    <nav>
        <a href="/" class="nav-logo">
            <img src="{{ asset('logo.png') }}" alt="KosinAja Logo">
            <span>KosinAja!</span>
        </a>

        <ul class="nav-links">
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Hubungi Kami</a></li>
            <li><a href="#" class="active">Tentang Kami</a></li>
        </ul>

        <div class="nav-actions">
            <a href="#" class="btn-outline">Masuk</a>
            <a href="#" class="btn-primary">Daftar</a>
        </div>
    </nav>

    {{-- ───── HERO TENTANG ───── --}}
    <section class="hero-tentang">
        <div class="hero-tentang-text">
            <div class="hero-badge">Tentang Kami</div>
            <h1>Tentang KosinAja</h1>
            <p>Platform pencarian dan pengelolaan kost modern dan terpercaya di Indonesia.</p>
        </div>
        <div class="hero-tentang-image">
            <img src="{{ asset('Ilustrasi Tentang KosinAja.png') }}" alt="Ilustrasi Tentang KosinAja">
        </div>
    </section>

    {{-- ───── KISAH KAMI ───── --}}
    <section class="kisah-section">
        <div class="kisah-image">
            <img src="{{ asset('about-room.png') }}" alt="Ruangan Kost">
        </div>
        <div class="kisah-text">
            <h2>Kisah Kami</h2>
            <p>KosinAja hadir untuk mempermudah pencarian kost bagi penghuni dan membantu pemilik kost dalam mengelola
                bisnisnya secara digital, praktis, dan efisien.</p>
            <p>Kami menggabungkan teknologi dan kemudahan dalam satu platform untuk pengalaman yang lebih baik.</p>
        </div>
    </section>

    {{-- ───── VISI & MISI ───── --}}
    <div class="visimisi-section">
        <div class="vm-box">
            <div class="vm-icon">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                </svg>
            </div>
            <h3>Visi Kami</h3>
            <p>Menjadi platform kost terdepan di Indonesia yang memberikan solusi terbaik bagi penghuni dan pemilik
                kost.</p>
        </div>
        <div class="vm-box">
            <div class="vm-icon">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z" />
                </svg>
            </div>
            <h3>Misi Kami</h3>
            <ul>
                <li>Memudahkan pencarian kost terbaik</li>
                <li>Membantu pemilik kost mengelola bisnis dengan lebih efisien</li>
                <li>Memberikan pengalaman aman, nyaman, dan terpercaya</li>
            </ul>
        </div>
    </div>

    {{-- ───── KEUNGGULAN KAMI ───── --}}
    <section class="keunggulan-section">
        <div class="section-title-center">
            <div class="divider-row">
                <h2>Keunggulan Kami</h2>
            </div>
        </div>
        <div class="keunggulan-grid">
            <div class="keunggulan-card">
                <div class="keunggulan-icon">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                    </svg>
                </div>
                <h4>Mudah Cari Kost</h4>
                <p>Temukan pilihan kost terbaik sesuai lokasi, harga, dan fasilitas yang Anda butuhkan.</p>
            </div>
            <div class="keunggulan-card">
                <div class="keunggulan-icon">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M20 4H4c-1.11 0-2 .89-2 2v12c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" />
                    </svg>
                </div>
                <h4>Pembayaran Aman</h4>
                <p>Sistem pembayaran terintegrasi dan aman untuk kemudahan transaksi.</p>
            </div>
            <div class="keunggulan-card">
                <div class="keunggulan-icon">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z" />
                    </svg>
                </div>
                <h4>Kelola Kost Praktis</h4>
                <p>Pemilik kost dapat mengelola kamar, penghuni, dan pembayaran dalam satu platform.</p>
            </div>
        </div>
    </section>

    {{-- ───── STATS ───── --}}
    <section class="stats-section">
        <div class="stats-bar">
            <div class="stat-item">
                <strong>2.400+</strong>
                <span>Kost Tersedia</span>
            </div>
            <div class="stat-item">
                <strong>18</strong>
                <span>Kota di Indonesia</span>
            </div>
            <div class="stat-item">
                <strong>12K+</strong>
                <span>Pengguna Aktif</span>
            </div>
        </div>
    </section>

    {{-- ───── CTA JOIN ───── --}}
    <div class="cta-join">
        <div class="cta-join-text">
            <h2>Bersama KosinAja, semua jadi lebih mudah!</h2>
            <p>Temukan kost impianmu atau kelola kostmu sekarang juga.</p>
        </div>
        <div class="cta-join-actions">
            <a href="#" class="btn-cta-green">Cari Kost Sekarang</a>
            <a href="#" class="btn-cta-outline">Daftarkan Kost Anda</a>
        </div>
        <div class="cta-join-image">
            <img src="{{ asset('daon (1).png') }}" alt="Ilustrasi">
        </div>
    </div>

    {{-- ───── FOOTER ───── --}}
    <footer>
        <img src="{{ asset('footer.png') }}" alt="background daun" class="footer-leaf">

        <div class="footer-inner">
            <div class="footer-top">

                <div class="footer-brand">
                    <div class="logo-row">
                        <img src="{{ asset('logo.png') }}" alt="KosinAja Logo">
                        <span>KosinAja!</span>
                    </div>
                    <p>Aplikasi terbaik layanan kos.<br>Temukan kos impianmu dengan mudah.</p>
                </div>

                <div class="footer-col">
                    <h4>Site Links</h4>
                    <ul>
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Tetap bersama kami</h4>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                            </svg>
                        </div>
                        Banyuwangi, Indonesia
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                        </div>
                        Hello@Email.com
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                            </svg>
                        </div>
                        ( +62 ) 82264676843
                    </div>
                </div>

            </div>
        </div>

        <div class="footer-bottom">
            COPYRIGHT ORBIT
        </div>
    </footer>

</body>

</html>