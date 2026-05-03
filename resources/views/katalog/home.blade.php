@extends('layouts.public')

@section('title', 'KosinAja! - Cari Kos Jadi Lebih Mudah')

@section('styles')
<style>
:root {
    --badge-premium: #7CA385;
    --badge-favorit: #f5a623;
    --star: #f5a623
}

/* HERO */
.hero {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    align-items: center;
    gap: 40px;
    padding: 40px 64px 48px;
    min-height: 580px;
    position: relative;
    overflow: hidden
}

.hero::before {
    content: '';
    position: absolute;
    top: -80px;
    right: -80px;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(124, 163, 133, 0.12) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none
}

.hero::after {
    content: '';
    position: absolute;
    bottom: -60px;
    left: -60px;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(124, 163, 133, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none
}

.hero-text {
    position: relative;
    z-index: 2
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
    margin-bottom: 20px
}

.hero-text h1 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: clamp(2rem, 3.5vw, 3rem);
    line-height: 1.15;
    color: var(--text-dark);
    margin-bottom: 16px
}

.hero-text h1 em {
    font-style: normal;
    color: var(--cta)
}

.hero-text p {
    font-size: 1rem;
    color: var(--text-mid);
    line-height: 1.7;
    max-width: 380px;
    margin-bottom: 28px
}

.hero-search {
    display: flex;
    align-items: center;
    background: #fff;
    border: 1.5px solid var(--border);
    border-radius: 14px;
    padding: 6px 6px 6px 18px;
    max-width: 420px;
    margin-bottom: 28px;
    box-shadow: 0 4px 16px rgba(124, 163, 133, 0.1)
}

.hero-search input {
    flex: 1;
    border: none;
    outline: none;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.9rem;
    background: transparent;
    color: var(--text-dark)
}

.hero-search input::placeholder {
    color: var(--text-light)
}

.hero-search button {
    padding: 10px 20px;
    background: var(--cta);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.88rem;
    cursor: pointer;
    white-space: nowrap;
    transition: background 0.2s
}

.hero-search button:hover {
    background: var(--cta-hover)
}

.hero-stats {
    display: flex;
    gap: 24px;
    flex-wrap: wrap
}

.hero-stat {
    display: flex;
    flex-direction: column
}

.hero-stat strong {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.3rem;
    color: var(--text-dark)
}

.hero-stat span {
    font-size: 0.78rem;
    color: var(--text-light)
}

.hero-stat-divider {
    width: 1px;
    height: 36px;
    background: var(--border);
    align-self: center
}

.hero-image {
    display: flex;
    justify-content: flex-end;
    position: relative;
    z-index: 2
}

.hero-image img {
    max-width: 100%;
    max-height: 560px;
    width: 100%;
    object-fit: contain;
    animation: float 4s ease-in-out infinite
}

.hero-float-card {
    position: absolute;
    background: #fff;
    border-radius: 14px;
    padding: 12px 16px;
    box-shadow: 0 8px 28px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 5;
    animation: floatCard 3s ease-in-out infinite
}

.hero-float-card.card-1 {
    top: 60px;
    left: -10px;
    animation-delay: 0s
}

.hero-float-card.card-2 {
    bottom: 100px;
    left: -20px;
    animation-delay: 1.5s
}

@keyframes floatCard {

    0%,
    100% {
        transform: translateY(0)
    }

    50% {
        transform: translateY(-8px)
    }
}

.float-icon {
    width: 36px;
    height: 36px;
    background: #f0f5f1;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center
}

.float-icon svg {
    width: 18px;
    height: 18px;
    fill: var(--cta)
}

.float-text strong {
    display: block;
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--text-dark)
}

.float-text span {
    font-size: 0.75rem;
    color: var(--text-light)
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0)
    }

    50% {
        transform: translateY(-14px)
    }
}

/* REKOMENDASI */
.section {
    padding: 56px 64px
}

.section-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 32px
}

.section-header .left h2 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.45rem;
    color: var(--text-dark)
}

.section-header .left p {
    font-size: 0.88rem;
    color: var(--text-light);
    margin-top: 4px
}

.btn-lihat-semua {
    padding: 8px 20px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    background: transparent;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--text-mid);
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s
}

.btn-lihat-semua:hover {
    border-color: var(--cta);
    color: var(--cta)
}

.kos-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px
}

.kos-card {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid var(--border);
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative
}

.kos-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(124, 163, 133, 0.15)
}

.kos-thumb {
    position: relative;
    height: 160px;
    overflow: hidden
}

.kos-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s
}

.kos-card:hover .kos-thumb img {
    transform: scale(1.05)
}

.kos-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 700;
    color: #fff
}

.badge-premium {
    background: var(--badge-premium)
}

.badge-favorit {
    background: var(--badge-favorit)
}

.kos-wish {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 30px;
    height: 30px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.9rem;
    border: none
}

.kos-body {
    padding: 14px 14px 6px
}

.kos-name {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 0.98rem;
    color: var(--text-dark)
}

.kos-loc {
    font-size: 0.78rem;
    color: var(--text-light);
    margin: 3px 0 6px
}

.kos-rating {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.78rem;
    color: var(--text-mid)
}

.kos-rating .star {
    color: var(--star);
    font-weight: 700
}

.kos-price {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.05rem;
    color: var(--cta);
    margin: 10px 0 6px
}

.kos-price span {
    font-family: 'DM Sans', sans-serif;
    font-weight: 400;
    font-size: 0.78rem;
    color: var(--text-light)
}

.kos-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin: 8px 0
}

.kos-tag {
    padding: 3px 8px;
    background: #f0f5f1;
    border-radius: 6px;
    font-size: 0.72rem;
    color: var(--text-mid);
    font-weight: 500
}

.kos-info {
    display: flex;
    justify-content: space-between;
    font-size: 0.75rem;
    color: var(--text-light);
    margin: 6px 0
}

.kos-actions {
    display: flex;
    gap: 8px;
    padding: 10px 14px 14px
}

.btn-detail {
    flex: 1;
    padding: 9px;
    border: 1.5px solid var(--border);
    border-radius: 9px;
    background: transparent;
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--text-mid);
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s
}

.btn-detail:hover {
    border-color: var(--cta);
    color: var(--cta)
}

.btn-hubungi {
    flex: 1;
    padding: 9px;
    background: var(--cta);
    border: none;
    border-radius: 9px;
    font-size: 0.82rem;
    font-weight: 700;
    color: #fff;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: background 0.2s
}

.btn-hubungi:hover {
    background: var(--cta-hover)
}

/* FASILITAS + WHY */
.two-col {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    padding: 0 64px 56px
}

.feature-box {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 36px
}

.feature-box h3 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.4rem;
    margin-bottom: 8px
}

.feature-box .sub {
    font-size: 0.9rem;
    color: var(--text-light);
    margin-bottom: 28px
}

.facility-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 24px
}

.facility-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: 16px 8px;
    border-radius: 14px;
    background: #f5f9f6;
    font-size: 0.82rem;
    color: var(--text-mid);
    font-weight: 600;
    text-align: center;
    transition: background 0.2s, transform 0.2s;
    cursor: pointer
}

.facility-item:hover {
    background: #e8f0ea;
    transform: translateY(-2px)
}

.facility-item .fac-icon {
    width: 36px;
    height: 36px;
    background: var(--cta);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center
}

.facility-item .fac-icon svg {
    width: 18px;
    height: 18px;
    fill: #fff
}

.facility-cta-bar {
    background: var(--cta);
    border-radius: 14px;
    padding: 16px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #fff
}

.facility-cta-bar span {
    font-size: 0.9rem;
    font-weight: 500
}

.facility-cta-bar button {
    padding: 9px 22px;
    background: #fff;
    color: var(--cta);
    border: none;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.88rem;
    cursor: pointer;
    white-space: nowrap;
    transition: opacity 0.2s
}

.why-box {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 36px;
    display: flex;
    flex-direction: column;
    justify-content: space-between
}

.why-box h3 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.4rem;
    margin-bottom: 8px
}

.why-box .sub {
    font-size: 0.9rem;
    color: var(--text-light);
    margin-bottom: 28px
}

.why-list {
    display: flex;
    flex-direction: column;
    gap: 18px;
    margin-bottom: 28px
}

.why-item {
    display: flex;
    align-items: flex-start;
    gap: 14px
}

.why-icon {
    width: 38px;
    height: 38px;
    background: #f0f5f1;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0
}

.why-icon svg {
    width: 18px;
    height: 18px;
    fill: var(--cta)
}

.why-item-text strong {
    display: block;
    font-size: 0.98rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 3px
}

.why-item-text p {
    font-size: 0.82rem;
    color: var(--text-light);
    line-height: 1.6
}

.why-house {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 8px;
    opacity: 0.12
}

.why-house svg {
    width: 80px;
    height: 80px;
    fill: var(--cta)
}

/* TESTIMONIAL */
.testimonial-section {
    padding: 0 64px 56px
}

.testimonial-section h2 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.45rem;
    margin-bottom: 6px
}

.testimonial-section .sub {
    font-size: 0.88rem;
    color: var(--text-light);
    margin-bottom: 28px
}

.testi-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px
}

.testi-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 24px
}

.testi-quote {
    font-size: 2rem;
    color: var(--cta);
    opacity: 0.3;
    line-height: 1;
    margin-bottom: 10px
}

.testi-card p {
    font-size: 0.88rem;
    color: var(--text-mid);
    line-height: 1.7;
    margin-bottom: 20px
}

.testi-user {
    display: flex;
    align-items: center;
    gap: 10px
}

.testi-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: var(--cta);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 0.9rem
}

.testi-name {
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--text-dark)
}

.testi-role {
    font-size: 0.75rem;
    color: var(--text-light)
}

/* CTA BANNER */
.cta-banner {
    margin: 0 64px 56px;
    border-radius: 28px;
    overflow: hidden;
    position: relative;
    min-height: 400px
}

.cta-banner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    inset: 0
}

.cta-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(20, 40, 22, 0.82) 0%, rgba(20, 40, 22, 0.55) 100%)
}

.cta-content {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 400px;
    text-align: center;
    padding: 60px 40px
}

.cta-content h2 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    color: #fff;
    margin-bottom: 12px
}

.cta-content p {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.82);
    margin-bottom: 28px;
    max-width: 420px
}

.btn-cta-white {
    padding: 14px 36px;
    background: var(--cta);
    color: #fff;
    border-radius: 12px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s
}

.btn-cta-white:hover {
    background: #5e8a68;
    transform: translateY(-2px)
}

@media(max-width:1024px) {
    .hero {
        padding: 48px 32px
    }

    .section {
        padding: 40px 32px
    }

    .two-col,
    .testimonial-section {
        padding: 0 32px 40px
    }

    .cta-banner {
        margin: 0 32px 40px
    }

    .kos-grid {
        grid-template-columns: repeat(2, 1fr)
    }
}

@media(max-width:768px) {
    .hero {
        grid-template-columns: 1fr;
        padding: 36px 20px;
        text-align: center
    }

    .hero-image {
        justify-content: center
    }

    .section {
        padding: 32px 20px
    }

    .two-col {
        grid-template-columns: 1fr;
        padding: 0 20px 32px
    }

    .testi-grid {
        grid-template-columns: 1fr
    }

    .kos-grid {
        grid-template-columns: 1fr
    }

    .testimonial-section {
        padding: 0 20px 32px
    }

    .cta-banner {
        margin: 0 20px 32px
    }
}
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="hero-text">
        <div class="hero-badge"><span></span> #1 Platform Kos Terpercaya di Indonesia</div>
        <h1>Cari Kos Jadi <em>Lebih Mudah</em> & Nyaman</h1>
        <p>Jelajahi ribuan pilihan kos terbaik dan lihat detail lengkap sebelum memilih. Cepat, mudah, dan terpercaya.
        </p>
        <div class="hero-search">
            <input type="text" placeholder="Cari kos di kota atau daerah...">
            <button>Jelajahi Sekarang</button>
        </div>
        <div class="hero-stats">
            <div class="hero-stat"><strong>2.400+</strong><span>Kos Tersedia</span></div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat"><strong>18 Kota</strong><span>Se-Indonesia</span></div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat"><strong>12K+</strong><span>Pengguna Aktif</span></div>
        </div>
    </div>
    <div class="hero-image">
        <div class="hero-float-card card-1">
            <div class="float-icon"><svg viewBox="0 0 24 24">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                </svg></div>
            <div class="float-text"><strong>Terverifikasi</strong><span>Semua kos sudah dicek</span></div>
        </div>
        <div class="hero-float-card card-2">
            <div class="float-icon"><svg viewBox="0 0 24 24">
                    <path
                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                </svg></div>
            <div class="float-text"><strong>18+ Kota</strong><span>Se-Indonesia</span></div>
        </div>
        <img src="{{ asset('hero.png') }}" alt="Ilustrasi Cari Kos">
    </div>
</section>

{{-- REKOMENDASI KOS --}}
<section class="section">
    <div class="section-header">
        <div class="left">
            <h2>Rekomendasi Kos</h2>
            <p>Kos pilihan dengan fasilitas terbaik di berbagai kota</p>
        </div>
        <a href="#" class="btn-lihat-semua">Lihat Semua</a>
    </div>
    <div class="kos-grid">
        @forelse($katalogKos as $kos)
        <div class="kos-card">
            <div class="kos-thumb">
                @if($kos->foto_utama)
                    <img src="{{ Storage::url($kos->foto_utama) }}" alt="{{ $kos->nama_kos }}">
                @else
                    <img src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=400&q=80" alt="{{ $kos->nama_kos }}">
                @endif
                <button class="kos-wish">♡</button>
            </div>
            <div class="kos-body">
                <div class="kos-name">{{ $kos->nama_kos }}</div>
                <div class="kos-loc">{{ $kos->kota ?? $kos->alamat }}</div>
                <div class="kos-price">
                    {{ $kos->harga_mulai ? 'Rp '.number_format($kos->harga_mulai, 0, ',', '.') : 'Hubungi Kami' }}
                    @if($kos->harga_mulai)
                        <span>/ bulan</span>
                    @endif
                </div>
                @if($kos->fasilitas && count($kos->fasilitas) > 0)
                <div class="kos-tags">
                    @foreach(array_slice($kos->fasilitas, 0, 4) as $f)
                        <span class="kos-tag">{{ $f }}</span>
                    @endforeach
                    @if(count($kos->fasilitas) > 4)
                        <span class="kos-tag">+{{ count($kos->fasilitas) - 4 }}</span>
                    @endif
                </div>
                @endif
                <div class="kos-info">
                    <span>Tipe: {{ ucfirst($kos->tipe_kos) }}</span>
                </div>
            </div>
            <div class="kos-actions">
                <a href="{{ route('katalog.detail', $kos->id) }}" class="btn-detail">Lihat Detail</a>
                @if($kos->no_telepon)
                    <a href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $kos->no_telepon), '0') }}" 
                       class="btn-hubungi" target="_blank">Hubungi</a>
                @else
                    <a href="{{ route('hubungi') }}" class="btn-hubungi">Hubungi</a>
                @endif
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:60px 20px;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:64px;height:64px;fill:#d1d5db;margin:0 auto 16px;display:block;" viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
            <p style="font-size:1rem;font-weight:700;color:#6b7280;margin-bottom:6px;">Belum ada kos tersedia</p>
            <p style="font-size:0.85rem;color:#9ca3af;">Kos akan muncul di sini setelah admin mendaftarkan informasi kos mereka.</p>
        </div>
        @endforelse
    </div>
</section>

{{-- FASILITAS + WHY --}}
<div class="two-col">
    <div class="feature-box">
        <h3>Fasilitas Populer</h3>
        <p class="sub">Fasilitas lengkap untuk kehidupan yang nyaman</p>
        <div class="facility-grid">
            <div class="facility-item">
                <div class="fac-icon"><svg viewBox="0 0 24 24">
                        <path d="M1 6l5 5 4-4 4 4 5-5M1 12l5 5 4-4 4 4 5-5" />
                    </svg></div>WiFi
            </div>
            <div class="facility-item">
                <div class="fac-icon"><svg viewBox="0 0 24 24">
                        <path
                            d="M9.5 2A2.5 2.5 0 0 1 12 4.5v15a2.5 2.5 0 0 1-5 0V4.5A2.5 2.5 0 0 1 9.5 2zM14.5 8A2.5 2.5 0 0 1 17 10.5v9a2.5 2.5 0 0 1-5 0v-9A2.5 2.5 0 0 1 14.5 8z" />
                    </svg></div>AC
            </div>
            <div class="facility-item">
                <div class="fac-icon"><svg viewBox="0 0 24 24">
                        <path
                            d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7z" />
                    </svg></div>KM Dalam
            </div>
            <div class="facility-item">
                <div class="fac-icon"><svg viewBox="0 0 24 24">
                        <path d="M3 2h18v2H3V2zm0 4h18v2H3V6zm2 4h14v10H5V10zm2 2v6h10v-6H7z" />
                    </svg></div>Dapur
            </div>
            <div class="facility-item">
                <div class="fac-icon"><svg viewBox="0 0 24 24">
                        <path
                            d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2zm0 2a8 8 0 1 1 0 16A8 8 0 0 1 12 4zm-1 3v6l5 3-1 1.73-6-3.73V7h2z" />
                    </svg></div>CCTV
            </div>
            <div class="facility-item">
                <div class="fac-icon"><svg viewBox="0 0 24 24">
                        <path
                            d="M18 2.01L6 2c-1.1 0-2 .89-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.11-.9-1.99-2-1.99z" />
                    </svg></div>Laundry
            </div>
            <div class="facility-item">
                <div class="fac-icon"><svg viewBox="0 0 24 24">
                        <path
                            d="M19 9h-2V7h-2v2H9V7H7v2H5c-1.1 0-2 .9-2 2v9c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-9c0-1.1-.9-2-2-2z" />
                    </svg></div>Parkir
            </div>
            <div class="facility-item">
                <div class="fac-icon"><svg viewBox="0 0 24 24">
                        <path d="M2 20h20v2H2v-2zM6 3v14h2V3H6zm6 2v12h2V5h-2zm6 4v8h2V9h-2z" />
                    </svg></div>Kolam
            </div>
        </div>
        <div class="facility-cta-bar">
            <span>Fasilitas lengkap bikin hidup lebih nyaman!</span>
            <button>Cari Sekarang</button>
        </div>
    </div>
    <div class="why-box">
        <div>
            <h3>Kenapa Pilih KosinAja?</h3>
            <p class="sub">Kami hadir untuk memudahkan pencarian dan pengelolaan kos</p>
            <div class="why-list">
                <div class="why-item">
                    <div class="why-icon"><svg viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                        </svg></div>
                    <div class="why-item-text"><strong>Pilihan Kos Terpercaya</strong>
                        <p>Semua kos sudah terverifikasi dengan ketat oleh tim kami.</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><svg viewBox="0 0 24 24">
                            <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6z" />
                        </svg></div>
                    <div class="why-item-text"><strong>Informasi Lengkap & Transparan</strong>
                        <p>Foto asli, harga jelas, dan fasilitas lengkap tanpa biaya tersembunyi.</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><svg viewBox="0 0 24 24">
                            <path
                                d="M13 2.05v2.02c3.95.49 7 3.85 7 7.93 0 3.21-1.81 6-4.72 7.72L13 17v5h5l-1.22-1.22C19.91 19.07 22 15.76 22 12c0-5.18-3.95-9.45-9-9.95z" />
                        </svg></div>
                    <div class="why-item-text"><strong>Proses Mudah & Cepat</strong>
                        <p>Temukan dan hubungi pemilik kos hanya dalam beberapa klik.</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><svg viewBox="0 0 24 24">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z" />
                        </svg></div>
                    <div class="why-item-text"><strong>Aman & Terjamin</strong>
                        <p>Privasi data Anda aman bersama kami. Transaksi terproteksi.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="why-house"><svg viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
            </svg></div>
    </div>
</div>

{{-- TESTIMONIAL --}}
<div class="testimonial-section">
    <h2>Apa Kata Mereka?</h2>
    <p class="sub">Pengalaman penghuni yang telah menggunakan KosinAja!</p>
    <div class="testi-grid">
        <div class="testi-card">
            <div class="testi-quote">"</div>
            <p>Kos saya ditemukan dengan cepat dan detail. Laporan dari pembayaran pun sangat transparan. Sangat
                membantu!</p>
            <div class="testi-user">
                <div class="testi-avatar">B</div>
                <div>
                    <div class="testi-name">Budi Santoso</div>
                    <div class="testi-role">Penghuni Kos</div>
                </div>
            </div>
        </div>
        <div class="testi-card">
            <div class="testi-quote">"</div>
            <p>Cari kos jadi sangat mudah! Informasi lengkap dan bisa langsung kontak pemilik dengan cepat dan aman.</p>
            <div class="testi-user">
                <div class="testi-avatar">A</div>
                <div>
                    <div class="testi-name">Andi Pratama</div>
                    <div class="testi-role">Mahasiswa</div>
                </div>
            </div>
        </div>
        <div class="testi-card">
            <div class="testi-quote">"</div>
            <p>Platform terbaik untuk para pencari kos. Pas buat saya yang punya keterbatasan waktu. Highly recommended!
            </p>
            <div class="testi-user">
                <div class="testi-avatar">R</div>
                <div>
                    <div class="testi-name">Risa Martha</div>
                    <div class="testi-role">Karyawan</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CTA BANNER --}}
<div class="cta-banner">
    <img src="{{ asset('why.png') }}" alt="Kelola Kos">
    <div class="cta-overlay"></div>
    <div class="cta-content">
        <h2>Punya kos? Kelola di KosinAja!</h2>
        <p>Daftarkan dan Kelola Kos Anda dengan Mudah dan Praktis</p>
        <a href="{{ route('register') }}" class="btn-cta-white">DAFTAR</a>
    </div>
</div>

@endsection