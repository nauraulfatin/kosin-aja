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
        --border: #e8efe9;
        --sidebar-w: 220px;
        --danger: #e57373;
        --warning: #f6a623;
        --success: #7CA385
    }

    body {
        font-family: 'DM Sans', sans-serif;
        background: #f4f6f4;
        color: var(--text-dark);
        display: flex;
        min-height: 100vh
    }

    /* SIDEBAR */
    .sidebar {
        width: var(--sidebar-w);
        min-height: 100vh;
        background: var(--bg);
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 50
    }

    .sidebar-logo {
        padding: 20px 20px 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid var(--border);
        text-decoration: none
    }

    .sidebar-logo img {
        width: 30px;
        height: 30px;
        object-fit: contain
    }

    .sidebar-logo span {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.05rem;
        color: var(--text-dark)
    }

    .sidebar-nav {
        flex: 1;
        padding: 16px 12px
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 10px;
        text-decoration: none;
        color: var(--text-mid);
        font-size: 0.88rem;
        font-weight: 500;
        transition: all 0.2s;
        margin-bottom: 4px
    }

    .nav-item:hover {
        background: #f0f5f1;
        color: var(--cta)
    }

    .nav-item.active {
        background: var(--cta);
        color: #fff
    }

    .nav-item svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0
    }

    .nav-item.active svg {
        fill: #fff
    }

    .nav-item svg {
        fill: var(--text-mid)
    }

    .nav-item:hover svg {
        fill: var(--cta)
    }

    .nav-item.active:hover svg {
        fill: #fff
    }

    .sidebar-logout {
        padding: 16px 12px;
        border-top: 1px solid var(--border)
    }

    .logout-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 10px;
        color: var(--danger);
        font-size: 0.88rem;
        font-weight: 500;
        cursor: pointer;
        background: none;
        border: none;
        width: 100%;
        transition: background 0.2s
    }

    .logout-btn:hover {
        background: #fdf0f0
    }

    .logout-btn svg {
        width: 18px;
        height: 18px;
        fill: var(--danger)
    }

    /* MAIN */
    .main-wrap {
        margin-left: var(--sidebar-w);
        flex: 1;
        display: flex;
        flex-direction: column;
        min-height: 100vh
    }

    .topbar {
        background: var(--bg);
        border-bottom: 1px solid var(--border);
        padding: 0 32px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        position: sticky;
        top: 0;
        z-index: 40
    }

    .topbar-greeting {
        font-size: 0.88rem;
        color: var(--text-mid);
        font-weight: 500
    }

    .topbar-greeting span {
        color: var(--text-dark);
        font-weight: 700
    }

    .topbar-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--cta);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer
    }

    .topbar-avatar svg {
        width: 18px;
        height: 18px;
        fill: #fff
    }

    .main-content {
        padding: 28px 32px;
        flex: 1
    }

    /* CARDS */
    .card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px
    }

    .card-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--text-dark);
        margin-bottom: 16px
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600
    }

    .badge-success {
        background: #e8f5e9;
        color: #2e7d32
    }

    .badge-warning {
        background: #fff8e1;
        color: #f57f17
    }

    .badge-danger {
        background: #ffebee;
        color: #c62828
    }

    .badge-info {
        background: #e3f2fd;
        color: #1565c0
    }
    </style>
    @yield('styles')
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <a href="{{ route('penghuni.dashboard') }}" class="sidebar-logo">
            <img src="{{ asset('logo.png') }}" alt="KosinAja">
            <span>KosinAja!</span>
        </a>
        <nav class="sidebar-nav">
            <a href="{{ route('penghuni.dashboard') }}"
                class="nav-item {{ request()->routeIs('penghuni.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('penghuni.pembayaran') }}"
                class="nav-item {{ request()->routeIs('penghuni.pembayaran') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" />
                </svg>
                Pembayaran
            </a>
            <a href="{{ route('penghuni.aduan') }}"
                class="nav-item {{ request()->routeIs('penghuni.aduan') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 9h-2V5h2v6zm0 4h-2v-2h2v2z" />
                </svg>
                Aduan
            </a>
            <a href="{{ route('penghuni.aturan') }}"
                class="nav-item {{ request()->routeIs('penghuni.aturan') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
                Aturan Kos
            </a>
            <a href="{{ route('penghuni.profil') }}"
                class="nav-item {{ request()->routeIs('penghuni.profil') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                </svg>
                Profil
            </a>
        </nav>
        <div class="sidebar-logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="main-wrap">
        <header class="topbar">
            <span class="topbar-greeting">Halo, <span>Shavira</span></span>
            <div class="topbar-avatar">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                </svg>
            </div>
        </header>
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>

</html>