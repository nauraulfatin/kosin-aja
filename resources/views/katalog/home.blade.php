@extends('layouts.public')

@section('title', 'KosinAja! - Cari Kos Jadi Lebih Mudah')

@section('styles')
<style>
:root {
    --badge-premium: #7CA385;
    --badge-favorit: #f5a623;
    --star: #f5a623
}

.container{
    width:90%;
    max-width:1350px;
    margin:0 auto;
}

/* HERO */
/* HERO */
.hero {
    padding: 15px 0 20px;
    position: relative;
    overflow: hidden;
}

/* WRAPPER HERO */
.hero-wrap{
    display:grid;
    grid-template-columns: 1fr 1.1fr;
    align-items:center;
    gap:80px;
    min-height:88vh;
}

.hero-blur{
    position:absolute;
    width:420px;
    height:420px;
    background:#DDEADF;
    border-radius:999px;
    filter:blur(120px);
    opacity:.5;
    left:-120px;
    top:120px;
    z-index:-1;
}

.hero-trust{
    display:flex;
    gap:18px;
    flex-wrap:wrap;
    margin-top:22px;
}

.hero-trust span{
    font-size:.92rem;
    color:#6B7B6D;
    background:#F4F7F4;
    border:1px solid #E4ECE5;
    padding:10px 16px;
    border-radius:999px;
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
    padding: 8px 16px;
    font-size: 1rem;
    font-weight: 600;
    color: var(--cta);
    margin-bottom: 40px
}

.hero-text h1 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: clamp(2.3rem, 5vw, 4.5rem);
    line-height: 1.1;
    letter-spacing: -2.3px;
    color: #1F3A2C;
    margin-bottom: 30px;
}
.hero-text h1 em {
    font-style: normal;
    color: #729a7b;
}

.hero-text p {
    font-size: 1.08rem;
    color: var(--text-mid);
    line-height: 1.9;
    max-width: 520px;
    margin-bottom: 30px;
}

.hero-search {
    display: flex;
    align-items: center;
    gap: 16px;
    background: #fff;
    border: 1px solid #e6ece7;
    border-radius: 24px;
    padding: 10px;
    max-width: 580px;
    width: 100%;
    margin-bottom: 30px;
    box-shadow:
        0 10px 35px rgba(124, 163, 133, 0.12),
        0 2px 10px rgba(0,0,0,0.03);
}

.hero-search input {
    flex: 1;
    min-width: 0;
    border: none;
    outline: none;
    padding: 0 8px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.9rem;
    background: transparent;
    color: var(--text-dark)
}

.hero-search input::placeholder {
    color: var(--text-light)
}

.hero-search button {
    flex-shrink: 0;
    padding: 12px 20px;
    background: linear-gradient(135deg, #7CA385, #5F8568);
    color: #ffffff !important;
    border: none;
    outline: none;
    border-radius: 18px;
    font-weight: 700;
    font-size: 0.95rem;
    cursor: pointer;
    white-space: nowrap;
    transition: all .25s ease;
    box-shadow:0 10px 24px rgba(124,163,133,.28);
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 220px;
}

.hero-search button:hover{
    transform: translateY(-2px);
    box-shadow:0 14px 28px rgba(124,163,133,.35);
    background: linear-gradient(135deg, #6C8B6B, #56725D);
}
.hero-search button:active{ transform: scale(.98);}
.hero-search button:focus{outline:none;}

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

.hero-image{
    position:relative;
    display:flex;
    justify-content:center;
    align-items:center;
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

.hero-float-card.card-1{
    top:70px;
    left:-20px;
}
.hero-float-card.card-2{
    bottom:70px;
    left:-30px;
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

/* REKOMENDASI KOS */

.section{
    padding: 20px 0 70px;
    background: #F8F7F4;
    position: relative;
    overflow: hidden;
}

/* HEADER */
.section-header{
    display:flex;
    align-items:end;
    justify-content:space-between;
    margin-bottom:38px;
    gap:20px;
}

.section-header .left h2{
    font-family:'Plus Jakarta Sans', sans-serif;
    font-weight:800;
    font-size:2rem;
    line-height:1.1; 
    color: #1F3A2C;
    margin-bottom:10px;
}

.section-header .left p{
    font-size:1.08rem;
    color: #7A8A7C;
    line-height:1.7;
}

/* BUTTON LIHAT SEMUA */
.btn-lihat-semua{
    display:flex;
    align-items:center;
    justify-content:center;
    padding:14px 20px;
    border-radius:16px;
    background: #6C8B6B;
    color:#fff;
    text-decoration:none;
    font-weight:700;
    font-size:.92rem;
    transition:.3s ease;
    box-shadow:
    0 10px 25px rgba(40,69,53,.15);
}

.btn-lihat-semua:hover{
    transform:translateY(-2px);
    background: #284535;
    box-shadow:
    0 18px 35px rgba(40,69,53,.22);
}

/* GRID */
.kos-grid{
    display:flex;
    flex-wrap:wrap;
    gap:24px;
}

/* CARD */
/* CARD */
.kos-card{
    width:340px;
    flex-shrink:0;
    background:#284535;
    border-radius:32px;
    overflow:hidden;
    transition:.35s ease;
    position:relative;
    border:1px solid rgba(255,255,255,.05);
    box-shadow:
        0 10px 30px rgba(26, 47, 36, 0.18),
        0 25px 60px rgba(26, 47, 36, 0.10);
}

.kos-card:hover{
    transform:translateY(-10px);
    box-shadow:
        0 18px 40px rgba(26, 47, 36, 0.25),
        0 35px 80px rgba(26, 47, 36, 0.16);
}

/* THUMB */
.kos-thumb{
    position:relative;
    height:180px;
    overflow:hidden;
}

.kos-thumb img{
    width:100%;
    height:100%;
    object-fit:cover;

    transition:transform .5s ease;
}

.kos-card:hover .kos-thumb img{
    transform:scale(1.07);
}

/* BADGE */
.kos-badge{
    position:absolute;
    top:16px;
    left:16px;
    padding:7px 14px;
    border-radius:999px;
    font-size:.72rem;
    font-weight:700;
    color:#fff;
    backdrop-filter:blur(10px);
}

.badge-premium{
    background:#D6A84F;
}

.badge-favorit{
    background:#E86D6D;
}

/* BODY */
.kos-body{
    padding:14px;
}

/* TITLE */
.kos-name{
    font-family:'Plus Jakarta Sans', sans-serif;
    font-size:1.4rem;
    font-weight:800;
    color:#fff;
    margin-bottom:4px;
}

/* LOCATION */
.kos-loc{
    font-size:.92rem;
    color:#C8D5CB;
    margin-bottom:4px;
}

/* PRICE */
.kos-price{
    font-family:'Plus Jakarta Sans', sans-serif;
    font-size:0.9rem;
    font-weight:800;
    color:#F8F7F4;
    margin-bottom:6px;
}

.kos-price span{
    font-size:.90rem;
    font-weight:500;
    color:#C8D5CB;
}

/* TAG */
.kos-tags{
    display:flex;
    flex-wrap:wrap;
    gap:8px;
    margin-bottom:14px;
}

.kos-tag{
    padding:7px 12px;
    border-radius:999px;
    background:rgba(255,255,255,.12);
    color: #E7EFE8;
    font-size:.75rem;
    font-weight:600;
}

/* INFO */
.kos-info{
    display:flex;
    justify-content:space-between;
    margin-bottom:14px;
    color: #C8D5CB;
    font-size:.82rem;
}

/* ACTIONS */
.kos-actions{
    display:flex;
    gap:12px;
}

/* BUTTON DETAIL */
.btn-detail{
    flex:1;
    padding:6px 6px;
    border-radius:14px;
    background:#F8F7F4;
    color:#284535;
    text-decoration:none;
    font-weight:700;
    font-size:.9rem;
    text-align:center;
    transition:.25s ease;
}

.btn-detail:hover{
    background:#ECE7DE;
    transform:translateY(-2px);
}

/* BUTTON HUBUNGI */
.btn-hubungi{
    flex:1;
    padding:6px 6px;
    border-radius:16px;
    background: #7CA385;
    color:#fff;
    text-decoration:none;
    font-weight:700;
    font-size:.9rem;
    text-align:center;
    transition:.25s ease;
}

.btn-hubungi:hover{
    background:#6B8E73;

    transform:translateY(-2px);
}

/* RESPONSIVE */
@media(max-width:768px){
    .hero-wrap{
        grid-template-columns:1fr;
        gap:40px;
    }
    .hero{
        padding:30px 0 50px;
    }
    .hero-text{
        text-align:center;
    }
    .hero-search{
        margin-inline:auto;
    }
    .hero-trust{
        justify-content:center;
    }
    .hero-image{
        justify-content:center;
    }
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
    font-family:'Plus Jakarta Sans', sans-serif;
    font-weight:800;
    font-size:2rem;
    line-height:1.1; 
    color: #1F3A2C;
    margin-bottom:10px;
}

.feature-box .sub {
    font-size:1.08rem;
    color: #7A8A7C;
    line-height:1.7;
    margin-bottom: 24px
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
    background: #5F8568;
    font-size: 1rem;
    color: #F4F7F4;
    font-weight: 600;
    text-align: center;
    transition: background 0.2s, transform 0.2s;
    cursor: pointer
}

.facility-item:hover {
    background: #56725D;
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
    width: 20px;
    height: 20px;
    fill: #1F3A2C
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
    font-family:'Plus Jakarta Sans', sans-serif;
    font-weight:800;
    font-size:2rem;
    line-height:1.1; 
    color: #1F3A2C;
    margin-bottom:10px;
}

.why-box .sub {
    font-size:1.08rem;
    color: #7A8A7C;
    line-height:1.7;
    margin-bottom: 24px
}

.why-list {
    display: flex;
    flex-direction: column;
    gap: 18px;
    margin-bottom: 24px
}

.why-item {
    display: flex;
    align-items: flex-start;
    gap: 14px
}

.why-icon {
    width: 38px;
    height: 38px;
    background: #5F8568;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0
}

.why-icon svg {
    width: 18px;
    height: 18px;
    fill: #1F3A2C
}

.why-item-text strong {
    display: block;
    font-size: 0.98rem;
    font-weight: 700;
    color: #1F3A2C;
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

/* CTA BANNER */
.cta-banner {
    margin: 0 64px 40px;
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
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.82);
    margin-bottom: 28px;
    max-width: 420px
}

.btn-cta-white {
    padding: 14px 36px;
    background: #5e8a68;
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
    background: #56725D;
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
    <div class="container hero-wrap">
    <div class="hero-text">
        <div class="hero-blur"></div>
        <div class="hero-badge"><span></span> Bingung nyari kos? yuuk cari di KosinAja!</div>
        <h1>Cari Kos Jadi <em>Lebih Mudah</em> & Nyaman</h1>
        <p>Jelajahi pilihan kos terbaik dan lihat detail lengkap sebelum memilih. Cepat, mudah, dan terpercaya.
        </p>
        <div class="hero-search">
            <input type="text" placeholder="Cari kos di kota atau daerah...">
            <button>Jelajahi Sekarang</button>
        </div>
        <div class="hero-trust">

    <span>✓ Informasi Lengkap</span>
    <span>✓ Harga Transparan</span>
    <span>✓ Lihat Lokasi dan Fasilitas</span>

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
            <div class="float-text"><strong>Temukan kos</strong><span>Sesuai Lokasimu</span></div>
        </div>
        <img src="{{ asset('hero.png') }}" alt="Ilustrasi Cari Kos">
    </div>
    </div>
</section>

{{-- REKOMENDASI KOS --}}
<section class="section">

    <div class="container">

        {{-- HEADER --}}
        <div class="section-header">

            <div class="left">
                <h2>Rekomendasi Kos</h2>
                <p>
                    Temukan kos nyaman dengan fasilitas lengkap,
                    lokasi strategis, dan harga terbaik untuk kebutuhanmu.
                </p>
            </div>
            <a href="#" class="btn-lihat-semua">Lihat Semua</a>
        </div>

        {{-- GRID --}}
        <div class="kos-grid">
            @forelse($katalogKos as $kos)
            <div class="kos-card">
                {{-- THUMB --}}
                <div class="kos-thumb">
                    @if($kos->foto_utama)
                        <img
                            src="{{ Storage::url($kos->foto_utama) }}"
                            alt="{{ $kos->nama_kos }}"
                        >
                    @else
                        <img
                            src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=800&q=80"
                            alt="{{ $kos->nama_kos }}"
                        >
                    @endif

                    {{-- BADGE --}}
                    <div class="kos-badge badge-premium">
                        {{ ucfirst($kos->tipe_kos) }}
                    </div>
                </div>

                {{-- BODY --}}
                <div class="kos-body">
                    <div class="kos-name">
                        {{ $kos->nama_kos }}
                    </div>
                    <div class="kos-loc">
                        📍 {{ $kos->kota ?? $kos->alamat }}
                    </div>
                    {{-- PRICE --}}
                    <div class="kos-price">
                        @if($kos->harga_mulai)
                            Rp {{ number_format($kos->harga_mulai, 0, ',', '.') }}
                            <span>/ bulan</span>
                        @else
                            Hubungi Kami
                        @endif

                    </div>

                    {{-- FASILITAS --}}
                    @if($kos->fasilitas && count($kos->fasilitas) > 0)

                    <div class="kos-tags">

                        @foreach(array_slice($kos->fasilitas, 0, 4) as $f)

                            <span class="kos-tag">
                                {{ $f }}
                            </span>

                        @endforeach

                        @if(count($kos->fasilitas) > 4)

                            <span class="kos-tag">
                                +{{ count($kos->fasilitas) - 4 }}
                            </span>

                        @endif

                    </div>

                    @endif

                    {{-- INFO --}}
                    <div class="kos-info">
                        <span>
                            🏠 {{ ucfirst($kos->tipe_kos) }}
                        </span>
                    </div>

                    {{-- BUTTON --}}
                    <div class="kos-actions">

                        <a
                            href="{{ route('katalog.detail', $kos->id) }}"
                            class="btn-detail"
                        >
                            Lihat Detail
                        </a>

                        @if($kos->no_telepon)

                        <a
                            href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $kos->no_telepon), '0') }}"
                            class="btn-hubungi"
                            target="_blank"
                        >
                            Hubungi
                        </a>

                        @else

                        <a
                            href="{{ route('hubungi') }}"
                            class="btn-hubungi"
                        >
                            Hubungi
                        </a>

                        @endif

                    </div>

                </div>

            </div>

            @empty

            {{-- EMPTY STATE --}}
            <div class="empty-kos">

                <div class="empty-icon">
                    🏡
                </div>

                <h3>Belum Ada Kos Tersedia</h3>
                <p>
                    Kos akan muncul di sini setelah admin
                    menambahkan informasi kos.
                </p>
            </div>
            @endforelse
        </div>
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
    </div>
</div>

{{-- CTA BANNER --}}
<div class="cta-banner">
    <img src="{{ asset('why.png') }}" alt="Kelola Kos">
    <div class="cta-overlay"></div>
    <div class="cta-content">
        <h2>Punya kos? Kelola di KosinAja!</h2>
        <p>Daftarkan dan Kelola Kos Anda dengan Mudah dan Praktis</p>
        <a href="{{ route('register') }}" class="btn-cta-white">DAFTAR SEKARANG</a>
    </div>
</div>

@endsection