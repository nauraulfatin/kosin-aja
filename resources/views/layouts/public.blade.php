<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KosinAja!')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0
    }

    :root {
        --bg: #FDFAF4;
        --cta: #7CA385;
        --cta-hover: #5e8a68;
        --text-dark: #1a2e1c;
        --text-mid: #4a5e4c;
        --text-light: #8a9e8c;
        --card-bg: #ffffff;
        --border: #e8efe9
    }

    body {
        font-family: 'DM Sans', sans-serif;
        background-color: var(--bg);
        color: var(--text-dark);
        overflow-x: hidden
    }

    /* NAVBAR */
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
        backdrop-filter: blur(8px)
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none
    }

    .nav-logo img {
        width: 36px;
        height: 36px;
        object-fit: contain
    }

    .nav-logo span {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.25rem;
        color: var(--text-dark)
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 36px;
        list-style: none
    }

    .nav-links a {
        text-decoration: none;
        color: var(--text-mid);
        font-size: 0.95rem;
        font-weight: 500;
        transition: color 0.2s
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: var(--cta);
        border-bottom: 2px solid var(--cta);
        padding-bottom: 2px
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 12px
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
        transition: all 0.2s
    }

    .btn-outline:hover {
        background: var(--cta);
        color: #fff
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
        transition: background 0.2s
    }

    .btn-primary:hover {
        background: var(--cta-hover)
    }

    /* FOOTER */
    footer {
        background: var(--bg);
        position: relative;
        overflow: hidden;
        border-top: 1px solid var(--border)
    }

    .footer-leaf {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: auto;
        display: block;
        opacity: 0.5;
        pointer-events: none
    }

    .footer-inner {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 60px 64px 40px
    }

    .footer-top {
        display: grid;
        grid-template-columns: repeat(3, auto);
        justify-content: center;
        align-items: start;
        gap: 80px;
        width: 100%;
        text-align: center
    }

    .footer-brand .logo-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 12px
    }

    .footer-brand .logo-row img {
        width: 34px;
        height: 34px;
        object-fit: contain
    }

    .footer-brand .logo-row span {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.1rem;
        color: var(--text-dark)
    }

    .footer-brand p {
        font-size: 0.8rem;
        color: var(--text-light);
        line-height: 1.8;
        text-align: center
    }

    .footer-col {
        text-align: center
    }

    .footer-col h4 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 0.95rem;
        color: var(--text-dark);
        margin-bottom: 16px
    }

    .footer-col ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: center
    }

    .footer-col ul li a {
        font-size: 0.8rem;
        color: var(--text-light);
        text-decoration: none;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        gap: 6px
    }

    .footer-col ul li a:hover {
        color: var(--cta)
    }

    .footer-col ul li a::before {
        content: '▸';
        font-size: 0.75rem;
        color: var(--cta)
    }

    .contact-item {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 0.8rem;
        color: var(--text-light);
        margin-bottom: 12px
    }

    .contact-icon {
        width: 26px;
        height: 26px;
        background: #f0f5f1;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0
    }

    .contact-icon svg {
        width: 13px;
        height: 13px;
        fill: var(--cta)
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
        z-index: 2
    }

    @media(max-width:768px) {
        nav {
            padding: 0 20px
        }

        .nav-links {
            display: none
        }

        .footer-inner {
            padding: 32px 20px 20px
        }

        .footer-top {
            grid-template-columns: 1fr;
            gap: 28px
        }
    }
    </style>
    @yield('styles')
</head>

<body>

    {{-- NAVBAR --}}
    <nav>
        <a href="/" class="nav-logo">
            <img src="{{ asset('logo.png') }}" alt="KosinAja Logo">
            <span>KosinAja!</span>
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('hubungi') }}" class="{{ request()->is('hubungi') ? 'active' : '' }}">Hubungi Kami</a>
            </li>
            <li><a href="{{ route('tentang') }}" class="{{ request()->is('tentang') ? 'active' : '' }}">Tentang Kami</a>
            </li>
        </ul>
        <div class="nav-actions">
            @auth
            <span style="font-size:0.9rem;color:var(--text-mid);font-weight:500;">Halo,
                {{ auth()->user()->name }}</span>
            @if(auth()->user()->role == 'super_admin')
            <a href="{{ route('superadmin.dashboard') }}" class="btn-outline">Dashboard</a>
            @elseif(auth()->user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="btn-outline">Dashboard</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-primary">Logout</button>
            </form>
            @else
            <button onclick="document.getElementById('modal-masuk').style.display='flex'"
                class="btn-outline">Masuk</button>
            @endauth
        </div>
    </nav>

    {{-- KONTEN HALAMAN --}}
    @yield('content')

    {{-- FOOTER --}}
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
                        <li><a href="/">Beranda</a></li>
                        <li><a href="/hubungi">Hubungi Kami</a></li>
                        <li><a href="/tentang">Tentang Kami</a></li>
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
                        admin@kosinaja.id
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                            </svg>
                        </div>
                        (+62) 82264676843
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">COPYRIGHT ORBIT</div>
    </footer>

    {{-- MODAL MASUK --}}
    <div id="modal-masuk"
        style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.3); align-items:center; justify-content:center;"
        onclick="if(event.target===this)this.style.display='none'">
        <div
            style="position:relative;background:#FDFAF4;border-radius:24px;padding:48px 40px;width:560px;max-width:90%;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,0.15);">

            <button onclick="document.getElementById('modal-masuk').style.display='none'"
                style="position:absolute;top:16px;right:20px;background:none;border:none;font-size:1.4rem;color:#8a9e8c;cursor:pointer;">✕</button>

            <h2
                style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.4rem;color:#1a2e1c;margin-bottom:8px;">
                Masuk ke KosinAja</h2>
            <p style="font-size:0.9rem;color:#8a9e8c;margin-bottom:32px;">Pilih masuk sebagai</p>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

                {{-- Penghuni --}}
                <a href="{{ route('login') }}?role=penghuni"
                    style="display:flex;flex-direction:column;align-items:center;justify-content:center;gap:16px;padding:32px 20px;border:1.5px solid #e8efe9;border-radius:16px;background:#fff;text-decoration:none;transition:all 0.2s;cursor:pointer;"
                    onmouseover="this.style.borderColor='#7CA385';this.style.boxShadow='0 8px 24px rgba(124,163,133,0.15)'"
                    onmouseout="this.style.borderColor='#e8efe9';this.style.boxShadow='none'">
                    <img src="{{ asset('penghuni.png') }}" alt="Penghuni"
                        style="width:100px;height:120px;object-fit:contain;">
                    <span
                        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:600;font-size:0.95rem;color:#1a2e1c;">Penghuni</span>
                </a>

                {{-- Admin/Owner --}}
                <a href="{{ route('login') }}?role=admin"
                    style="display:flex;flex-direction:column;align-items:center;justify-content:center;gap:16px;padding:32px 20px;border:1.5px solid #e8efe9;border-radius:16px;background:#fff;text-decoration:none;transition:all 0.2s;cursor:pointer;"
                    onmouseover="this.style.borderColor='#7CA385';this.style.boxShadow='0 8px 24px rgba(124,163,133,0.15)'"
                    onmouseout="this.style.borderColor='#e8efe9';this.style.boxShadow='none'">
                    <img src="{{ asset('admin.png') }}" alt="Admin/Owner"
                        style="width:100px;height:120px;object-fit:contain;">
                    <span
                        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:600;font-size:0.95rem;color:#1a2e1c;">Admin/Owner</span>
                </a>

            </div>
        </div>
    </div>

</body>

</html>