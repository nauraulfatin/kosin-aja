@extends('layouts.public')

@section('title', 'Tentang Kami - KosinAja!')

@section('styles')
<style>
/* HERO TENTANG */
.hero-tentang{padding:56px 64px 40px;display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:40px;position:relative;overflow:hidden}
.hero-tentang::before{content:'';position:absolute;top:-80px;right:-80px;width:400px;height:400px;background:radial-gradient(circle,rgba(124,163,133,0.12) 0%,transparent 70%);border-radius:50%;pointer-events:none}
.hero-tentang-text{position:relative;z-index:2}
.hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(124,163,133,0.12);border:1px solid rgba(124,163,133,0.3);border-radius:20px;padding:6px 16px;font-size:0.82rem;font-weight:600;color:var(--cta);margin-bottom:20px}
.hero-tentang-text h1{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(2rem,3.5vw,2.8rem);line-height:1.15;color:var(--text-dark);margin-bottom:16px}
.hero-tentang-text p{font-size:1rem;color:var(--text-mid);line-height:1.7;max-width:400px}
.hero-tentang-image{display:flex;justify-content:flex-end;position:relative;z-index:2}
.hero-tentang-image img{width:100%;max-width:none;height:auto}

/* KISAH */
.kisah-section{padding:20px 64px 48px;display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:center}
.kisah-image img{width:100%;max-height:340px;object-fit:cover;border-radius:20px}
.kisah-text h2{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.5rem;margin-bottom:16px;color:var(--text-dark)}
.kisah-text p{font-size:0.9rem;color:var(--text-mid);line-height:1.8;margin-bottom:14px}

/* VISI MISI */
.visimisi-section{padding:0 64px 48px;display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vm-box{background:var(--card-bg);border:1px solid var(--border);border-radius:20px;padding:32px}
.vm-icon{width:44px;height:44px;background:#f0f5f1;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:16px}
.vm-icon svg{width:22px;height:22px;fill:var(--cta)}
.vm-box h3{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.15rem;color:var(--text-dark);margin-bottom:12px}
.vm-box p{font-size:0.88rem;color:var(--text-mid);line-height:1.7;margin-bottom:14px}
.vm-box ul{list-style:none;display:flex;flex-direction:column;gap:10px}
.vm-box ul li{font-size:0.85rem;color:var(--text-mid);display:flex;align-items:flex-start;gap:8px;line-height:1.5}
.vm-box ul li::before{content:'▸';color:var(--cta);font-size:0.75rem;margin-top:2px;flex-shrink:0}

/* KEUNGGULAN */
.keunggulan-section{padding:0 64px 48px}
.section-title-center{text-align:center;margin-bottom:36px}
.section-title-center .divider-row{display:flex;align-items:center;justify-content:center;gap:16px;margin-bottom:4px}
.section-title-center h2{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.45rem;color:var(--text-dark)}
.section-title-center p{font-size:0.88rem;color:var(--text-light);margin-top:6px}
.keunggulan-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.keunggulan-card{background:var(--card-bg);border:1px solid var(--border);border-radius:16px;padding:28px 24px;text-align:center;transition:transform 0.2s,box-shadow 0.2s}
.keunggulan-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(124,163,133,0.15)}
.keunggulan-icon{width:52px;height:52px;background:#f0f5f1;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px}
.keunggulan-icon svg{width:26px;height:26px;fill:var(--cta)}
.keunggulan-card h4{font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:var(--text-dark);margin-bottom:8px}
.keunggulan-card p{font-size:0.82rem;color:var(--text-light);line-height:1.7}

/* STATS */
.stats-section{padding:0 64px 48px}
.stats-bar{background:var(--card-bg);border:1px solid var(--border);border-radius:20px;padding:36px 48px;display:grid;grid-template-columns:repeat(3,1fr);gap:20px;text-align:center}
.stat-item{display:flex;flex-direction:column;align-items:center;gap:6px}
.stat-item:not(:last-child){border-right:1px solid var(--border)}
.stat-item strong{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;color:var(--cta)}
.stat-item span{font-size:0.85rem;color:var(--text-light)}

/* CTA JOIN */
.cta-join{margin:0 64px 56px;background:var(--card-bg);border:1px solid var(--border);border-radius:24px;padding:48px 56px;display:flex;align-items:center;justify-content:space-between;gap:40px}
.cta-join-text h2{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.6rem;color:var(--text-dark);margin-bottom:10px}
.cta-join-text p{font-size:0.9rem;color:var(--text-mid);line-height:1.7;max-width:480px}
.cta-join-actions{display:flex;gap:12px;flex-shrink:0}
.btn-cta-green{padding:13px 28px;background:var(--cta);color:#fff;border:none;border-radius:12px;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9rem;text-decoration:none;cursor:pointer;transition:background 0.2s,transform 0.2s;white-space:nowrap}
.btn-cta-green:hover{background:var(--cta-hover);transform:translateY(-2px)}
.btn-cta-outline{padding:13px 28px;background:transparent;color:var(--cta);border:1.5px solid var(--cta);border-radius:12px;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9rem;text-decoration:none;cursor:pointer;transition:all 0.2s;white-space:nowrap}
.btn-cta-outline:hover{background:var(--cta);color:#fff}
.cta-join-image img{width:160px;object-fit:contain}

@media(max-width:768px){.hero-tentang{grid-template-columns:1fr;padding:36px 20px;text-align:center}.kisah-section,.visimisi-section{grid-template-columns:1fr;padding:0 20px 32px}.keunggulan-section,.stats-section{padding:0 20px 32px}.keunggulan-grid{grid-template-columns:1fr}.stats-bar{grid-template-columns:1fr}.cta-join{flex-direction:column;text-align:center;margin:0 20px 32px;padding:32px 24px}}
</style>
@endsection

@section('content')

{{-- HERO --}}
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

{{-- KISAH --}}
<section class="kisah-section">
    <div class="kisah-image">
        <img src="{{ asset('fasilitas.png') }}" alt="Ruangan Kost">
    </div>
    <div class="kisah-text">
        <h2>Kisah Kami</h2>
        <p>KosinAja hadir untuk mempermudah pencarian kost bagi penghuni dan membantu pemilik kost dalam mengelola bisnisnya secara digital, praktis, dan efisien.</p>
        <p>Kami menggabungkan teknologi dan kemudahan dalam satu platform untuk pengalaman yang lebih baik.</p>
    </div>
</section>

{{-- VISI MISI --}}
<div class="visimisi-section">
    <div class="vm-box">
        <div class="vm-icon"><svg viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg></div>
        <h3>Visi Kami</h3>
        <p>Menjadi platform kost terdepan di Indonesia yang memberikan solusi terbaik bagi penghuni dan pemilik kost.</p>
    </div>
    <div class="vm-box">
        <div class="vm-icon"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg></div>
        <h3>Misi Kami</h3>
        <ul>
            <li>Memudahkan pencarian kost terbaik</li>
            <li>Membantu pemilik kost mengelola bisnis dengan lebih efisien</li>
            <li>Memberikan pengalaman aman, nyaman, dan terpercaya</li>
        </ul>
    </div>
</div>

{{-- KEUNGGULAN --}}
<section class="keunggulan-section">
    <div class="section-title-center">
        <div class="divider-row"><h2>Keunggulan Kami</h2></div>
    </div>
    <div class="keunggulan-grid">
        <div class="keunggulan-card">
            <div class="keunggulan-icon"><svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5z"/></svg></div>
            <h4>Mudah Cari Kost</h4>
            <p>Temukan pilihan kost terbaik sesuai lokasi, harga, dan fasilitas yang Anda butuhkan.</p>
        </div>
        <div class="keunggulan-card">
            <div class="keunggulan-icon"><svg viewBox="0 0 24 24"><path d="M20 4H4c-1.11 0-2 .89-2 2v12c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg></div>
            <h4>Pembayaran Aman</h4>
            <p>Sistem pembayaran terintegrasi dan aman untuk kemudahan transaksi.</p>
        </div>
        <div class="keunggulan-card">
            <div class="keunggulan-icon"><svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg></div>
            <h4>Kelola Kost Praktis</h4>
            <p>Pemilik kost dapat mengelola kamar, penghuni, dan pembayaran dalam satu platform.</p>
        </div>
    </div>
</section>

{{-- STATS --}}
<section class="stats-section">
    <div class="stats-bar">
        <div class="stat-item"><strong>2.400+</strong><span>Kost Tersedia</span></div>
        <div class="stat-item"><strong>18</strong><span>Kota di Indonesia</span></div>
        <div class="stat-item"><strong>12K+</strong><span>Pengguna Aktif</span></div>
    </div>
</section>

{{-- CTA JOIN --}}
<div class="cta-join">
    <div class="cta-join-text">
        <h2>Bersama KosinAja, semua jadi lebih mudah!</h2>
        <p>Temukan kost impianmu atau kelola kostmu sekarang juga.</p>
    </div>
    <div class="cta-join-actions">
        <a href="/" class="btn-cta-green">Cari Kost Sekarang</a>
        <a href="{{ route('register') }}" class="btn-cta-outline">Daftarkan Kost Anda</a>
    </div>
    <div class="cta-join-image">
        <img src="{{ asset('daon (1).png') }}" alt="Ilustrasi">
    </div>
</div>

@endsection