<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - KosinAja!</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #1a1a1a;
            display: flex;
            min-height: 100vh;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: 210px;
            background: #FDFAF4;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 22px 0 0 0;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            border-right: 1px solid #e8e8e8;
            z-index: 10;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 0 18px 26px 18px;
        }

        .logo-icon img {
            width: 38px;
            height: 38px;
            object-fit: contain;
        }

        .logo-text {
            font-size: 15px;
            font-weight: 700;
            color: #111111;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding: 0 10px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 9px 13px;
            border-radius: 9px;
            text-decoration: none;
            color: #888888;
            font-size: 13px;
            font-weight: 500;
            transition: background 0.15s, color 0.15s;
            white-space: nowrap;
        }

        .nav-item:hover {
            background: #f5f5f2;
            color: #333333;
        }

        .nav-item.active {
            background: #ddebd5;
            color: #3a6632;
            font-weight: 600;
        }

        .nav-item svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
        }

        /* ========== MAIN ========== */
        .main-content {
            margin-left: 210px;
            flex: 1;
            padding: 26px 32px;
            min-height: 100vh;
            background-color: #f9f9f7;
        }

        /* ========== HEADER ========== */
        .header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 18px;
        }

        .user-greeting {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 14px;
            font-weight: 600;
            color: #111111;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ffffff;
            border: 1.5px solid #cccccc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666666;
        }

        .user-avatar svg {
            width: 19px;
            height: 19px;
        }

        /* ========== PAGE TITLE ========== */
        .page-title {
            font-size: 20px;
            font-weight: 700;
            color: #111111;
            margin-bottom: 18px;
        }

        /* ========== STAT CARDS ========== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 18px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08), 0 0 0 1px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 120px;
        }

        .stat-label {
            font-size: 12px;
            font-weight: 600;
            color: #666666;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #111111;
            line-height: 1;
        }

        /* ========== BOTTOM CARDS ========== */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 22px 22px 16px 22px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08), 0 0 0 1px rgba(0,0,0,0.05);
        }

        .card-title {
            font-size: 15px;
            font-weight: 700;
            color: #111111;
            margin-bottom: 16px;
        }

        /* ========== RIWAYAT ========== */
        .payment-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 11px 0;
            border-bottom: 1px solid #f0f0ee;
        }

        .payment-item:last-of-type {
            border-bottom: none;
        }

        .payment-name {
            font-size: 13px;
            font-weight: 700;
            color: #111111;
            min-width: 108px;
        }

        .payment-month {
            font-size: 12px;
            color: #aaaaaa;
            flex: 1;
            padding: 0 8px;
        }

        .payment-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 3px;
        }

        .payment-amount {
            font-size: 12px;
            font-weight: 700;
            color: #111111;
        }

        /* ========== BADGES ========== */
        .badge {
            font-size: 10.5px;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 20px;
        }

        .badge-diproses {
            background: #fde68a;
            color: #854d0e;
        }

        .badge-selesai {
            background: #bbf7d0;
            color: #14532d;
        }

        /* ========== LIHAT SEMUA ========== */
        .lihat-semua {
            display: block;
            text-align: center;
            margin-top: 14px;
            font-size: 12px;
            font-weight: 500;
            color: #888888;
            text-decoration: none;
            transition: color 0.15s;
        }

        .lihat-semua:hover {
            color: #3a6632;
        }

        /* ========== ADUAN ========== */
        .aduan-item {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 11px 0;
            border-bottom: 1px solid #f0f0ee;
        }

        .aduan-item:last-of-type {
            border-bottom: none;
        }

        .aduan-left {
            flex: 1;
        }

        .aduan-title {
            font-size: 13px;
            font-weight: 700;
            color: #111111;
            margin-bottom: 3px;
        }

        .aduan-meta {
            font-size: 11px;
            color: #aaaaaa;
        }

        .aduan-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 4px;
            padding-left: 12px;
        }

        .aduan-time {
            font-size: 11px;
            color: #aaaaaa;
        }
    </style>
</head>
<body>

    <!-- ========== SIDEBAR ========== -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <img src="/logo.png" alt="KosinAja!">
            </div>
            <span class="logo-text">KosinAja!</span>
        </div>

        <nav class="sidebar-nav">
            <a href="/admin/dashboard" class="nav-item active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="/admin/kamar" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Daftar Kamar
            </a>

            <a href="/admin/penghuni" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Penghuni
            </a>

            <a href="/admin/pembayaran" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                Pembayaran
            </a>

            <a href="/admin/aduan" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Tanggapan Aduan
            </a>

            <a href="/admin/aturan" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                </svg>
                Aturan Kos
            </a>

            <a href="/admin/info" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Informasi Kos
            </a>
        </nav>
    </aside>

    <!-- ========== MAIN ========== -->
    <main class="main-content">

        <!-- Header -->
        <div class="header">
            <div class="user-greeting">
                Halo, {{ auth()->user()->name ?? 'Naura' }}
                <div class="user-avatar">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Page Title -->
        <h1 class="page-title">Dashboard admin</h1>

        <!-- Stat Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Kamar Total</div>
                <div class="stat-value">{{ $totalKamar ?? 12 }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Kamar Kosong</div>
                <div class="stat-value">{{ $kamarKosong ?? 1 }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Kamar Terisi</div>
                <div class="stat-value">{{ $kamarTerisi ?? 11 }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Penghuni</div>
                <div class="stat-value">{{ $totalPenghuni ?? 11 }}</div>
            </div>
        </div>

        <!-- Bottom Cards -->
        <div class="bottom-grid">

            <!-- Riwayat Terakhir -->
            <div class="card">
                <div class="card-title">Riwayat Terakhir</div>

                @forelse($riwayatPembayaran ?? [] as $pembayaran)
                <div class="payment-item">
                    <div class="payment-name">{{ $pembayaran->penghuni->name }}</div>
                    <div class="payment-month">{{ \Carbon\Carbon::parse($pembayaran->bulan)->translatedFormat('F Y') }}</div>
                    <div class="payment-right">
                        <div class="payment-amount">Rp. {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</div>
                        <span class="badge {{ $pembayaran->status === 'diproses' ? 'badge-diproses' : 'badge-selesai' }}">
                            {{ ucfirst($pembayaran->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="payment-item">
                    <div class="payment-name">Naura Ulfatin</div>
                    <div class="payment-month">April 2026</div>
                    <div class="payment-right">
                        <div class="payment-amount">Rp. 500.000</div>
                        <span class="badge badge-diproses">Diproses</span>
                    </div>
                </div>
                <div class="payment-item">
                    <div class="payment-name">Shavira Nindy</div>
                    <div class="payment-month">April 2026</div>
                    <div class="payment-right">
                        <div class="payment-amount">Rp. 500.000</div>
                        <span class="badge badge-selesai">Selesai</span>
                    </div>
                </div>
                @endforelse

                <a href="/admin/pembayaran" class="lihat-semua">Lihat Semua</a>
            </div>

            <!-- Aduan Terbaru -->
            <div class="card">
                <div class="card-title">Aduan Terbaru</div>

                @forelse($aduanTerbaru ?? [] as $aduan)
                <div class="aduan-item">
                    <div class="aduan-left">
                        <div class="aduan-title">{{ $aduan->judul }}</div>
                        <div class="aduan-meta">{{ ucfirst($aduan->status) }}</div>
                    </div>
                    <div class="aduan-right">
                        <span class="badge {{ $aduan->status === 'diproses' ? 'badge-diproses' : 'badge-selesai' }}">
                            {{ ucfirst($aduan->status) }}
                        </span>
                        <div class="aduan-time">{{ $aduan->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @empty
                <div class="aduan-item">
                    <div class="aduan-left">
                        <div class="aduan-title">AC bocor di kamar</div>
                        <div class="aduan-meta">Diproses</div>
                    </div>
                    <div class="aduan-right">
                        <span class="badge badge-diproses">Diproses</span>
                        <div class="aduan-time">2 hari lalu</div>
                    </div>
                </div>
                <div class="aduan-item">
                    <div class="aduan-left">
                        <div class="aduan-title">Lampu kurang terang</div>
                        <div class="aduan-meta">Selesai</div>
                    </div>
                    <div class="aduan-right">
                        <span class="badge badge-selesai">Selesai</span>
                        <div class="aduan-time">2 hari lalu</div>
                    </div>
                </div>
                @endforelse

                <a href="/admin/aduan" class="lihat-semua">Lihat Semua</a>
            </div>

        </div>
    </main>

</body>
</html>