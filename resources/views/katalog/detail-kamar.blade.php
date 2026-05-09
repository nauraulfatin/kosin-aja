<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kos->nama_kos }} - KosinAja!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#7CA385',
                    'primary-dark': '#5e8a68',
                    'primary-muted': '#6C8B6B',
                    'primary-light': '#f0f5f1',
                    bg: '#FDFAF4',
                    'text-dark': '#1a2e1c',
                    'text-mid': '#4a5e4c',
                    'text-light': '#8a9e8c',
                    border: '#e8efe9',
                },
                fontFamily: {
                    jakarta: ['"Plus Jakarta Sans"', 'sans-serif'],
                    dm: ['"DM Sans"', 'sans-serif'],
                },
            }
        }
    }
    </script>
    <style>
    body {
        font-family: 'DM Sans', sans-serif;
        background: #FDFAF4;
        color: #1a2e1c;
    }

    /* ── GALLERY GRID ── */
    .gallery-grid {
        display: grid;
        grid-template-columns: 1fr 220px;
        gap: 10px;
    }

    .gallery-main-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 16px;
        cursor: pointer;
        display: block;
        background: #e5e7eb;
    }

    .gallery-side {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .gallery-thumb {
        width: 100%;
        flex: 1;
        object-fit: cover;
        border-radius: 12px;
        cursor: pointer;
        display: block;
        background: #e5e7eb;
        transition: opacity .2s;
        min-height: 0;
    }

    .gallery-thumb:hover {
        opacity: .85;
    }

    .gallery-side-inner {
        display: flex;
        flex-direction: column;
        gap: 10px;
        height: 400px;
    }

    /* ── PAGE LAYOUT ── */
    .page-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 28px;
        align-items: start;
    }

    /* ── STICKY SIDEBAR ── */
    .sidebar-sticky {
        position: sticky;
        top: 80px;
    }

    /* ── MAP ── */
    #map-detail {
        height: 200px;
        border-radius: 12px;
        border: 1px solid #e8efe9;
    }

    /* ── LIGHTBOX ── */
    #lightbox {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .88);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    #lightbox.open {
        display: flex;
    }

    #lightbox img {
        max-width: 90vw;
        max-height: 88vh;
        border-radius: 12px;
        object-fit: contain;
    }

    #lb-prev,
    #lb-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, .15);
        border: none;
        color: #fff;
        font-size: 2rem;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .2s;
    }

    #lb-prev:hover,
    #lb-next:hover {
        background: rgba(255, 255, 255, .3);
    }

    #lb-prev {
        left: 20px;
    }

    #lb-next {
        right: 20px;
    }

    #lb-close {
        position: absolute;
        top: 18px;
        right: 22px;
        background: none;
        border: none;
        color: #fff;
        font-size: 2rem;
        cursor: pointer;
        line-height: 1;
    }

    #lb-counter {
        position: absolute;
        bottom: 18px;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255, 255, 255, .7);
        font-size: .82rem;
    }

    /* ── KAMAR CARD ── */
    .kamar-card {
        display: grid;
        grid-template-columns: 110px 1fr auto;
        gap: 16px;
        align-items: center;
        background: #fff;
        border: 1px solid #e8efe9;
        border-radius: 16px;
        padding: 16px;
        transition: box-shadow .2s, border-color .2s;
    }

    .kamar-card:hover {
        box-shadow: 0 4px 16px rgba(124, 163, 133, .12);
        border-color: rgba(124, 163, 133, .4);
    }

    /* ── FOOTER LEAF ── */
    .footer-leaf {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: auto;
        display: block;
        opacity: .5;
        pointer-events: none;
    }

    /* ── BADGE STATUS ── */
    .badge-kosong {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #dcfce7;
        color: #16a34a;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 999px;
    }

    .badge-penuh {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #fee2e2;
        color: #dc2626;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 999px;
    }
    </style>
</head>

<body class="bg-bg">

    {{-- ═══════════════════ NAVBAR ═══════════════════ --}}
    <nav class="sticky top-0 z-50 bg-bg border-b border-border flex items-center justify-between px-16 h-16">
        <a href="{{ route('home') }}" class="flex items-center gap-2 no-underline">
            <img src="{{ asset('logo.png') }}" alt="KosinAja" class="w-9 h-9 object-contain">
            <span class="font-jakarta font-extrabold text-xl text-text-dark">KosinAja!</span>
        </a>
        <ul class="flex items-center gap-9 list-none m-0 p-0">
            <li><a href="{{ route('home') }}"
                    class="text-primary font-semibold text-sm border-b-2 border-primary pb-0.5 no-underline">Beranda</a>
            </li>
            <li><a href="#hubungi"
                    class="text-text-mid font-medium text-sm hover:text-primary transition-colors no-underline">Hubungi
                    Kami</a></li>
            <li><a href="#"
                    class="text-text-mid font-medium text-sm hover:text-primary transition-colors no-underline">Tentang
                    Kami</a></li>
        </ul>
        <a href="{{ route('login') }}"
            class="px-5 py-2 border border-text-dark text-text-dark rounded-lg font-semibold text-sm hover:bg-text-dark hover:text-white transition-all no-underline">Masuk</a>
    </nav>

    {{-- ═══════════════════ PAGE BODY ═══════════════════ --}}
    <div class="max-w-7xl mx-auto px-8 pb-20">

        {{-- BREADCRUMB --}}
        <p class="text-xs text-text-light pt-5 pb-4 font-dm">
            <a href="{{ route('home') }}"
                class="hover:text-primary transition-colors no-underline text-text-light">Beranda</a>
            <span class="mx-1">›</span>
            <span class="text-text-mid">Detail Kost</span>
        </p>

        {{-- ══════════ GALLERY (full width) ══════════ --}}
        @php
        $fotoUtama = $kos->foto_utama ? Storage::url($kos->foto_utama)
        : 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=800&q=80';
        $galeri = $kos->foto_galeri ?? [];
        $allPhotos = array_merge([$fotoUtama], array_map(fn($f) => Storage::url($f), $galeri));
        @endphp

        <div class="gallery-grid mb-8">
            {{-- Main --}}
            <div>
                <img src="{{ $fotoUtama }}" alt="{{ $kos->nama_kos }}" class="gallery-main-img"
                    onclick="openLightbox(0)">
            </div>

            {{-- Side --}}
            <div class="gallery-side-inner">
                @for($i = 1; $i <= 3; $i++) @if(isset($allPhotos[$i])) @if($i===3 && count($allPhotos)> 4)
                    <div class="relative flex-1 rounded-xl overflow-hidden cursor-pointer"
                        onclick="openLightbox({{ $i }})">
                        <img src="{{ $allPhotos[$i] }}" alt="foto" class="w-full h-full object-cover brightness-50">
                        <span
                            class="absolute inset-0 flex items-center justify-center text-white font-jakarta font-bold text-sm">
                            +{{ count($allPhotos) - 3 }} Foto
                        </span>
                    </div>
                    @else
                    <img src="{{ $allPhotos[$i] }}" alt="foto" class="gallery-thumb flex-1"
                        onclick="openLightbox({{ $i }})">
                    @endif
                    @else
                    <div class="rounded-xl bg-gray-200 flex-1"></div>
                    @endif
                    @endfor

                    <button onclick="openLightbox(0)"
                        class="flex items-center justify-center gap-1.5 bg-primary-muted text-white text-xs font-bold py-2.5 rounded-xl hover:bg-primary-dark transition-colors w-full border-none cursor-pointer flex-shrink-0">
                        <svg class="w-3.5 h-3.5 fill-white" viewBox="0 0 24 24">
                            <path
                                d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z" />
                        </svg>
                        Lihat Semua
                    </button>
            </div>
        </div>

        {{-- ══════════ TWO-COLUMN LAYOUT ══════════ --}}
        <div class="page-grid">

            {{-- ════ LEFT COLUMN (main content) ════ --}}
            <div class="flex flex-col gap-5">

                {{-- INFO UTAMA --}}
                <div>
                    <h1 class="font-jakarta font-extrabold text-3xl text-text-dark mb-3">{{ $kos->nama_kos }}</h1>

                    <div class="flex flex-wrap items-center gap-5 mb-3">
                        <div class="flex items-center gap-1.5 text-sm text-text-mid">
                            <svg class="w-4 h-4 fill-primary flex-shrink-0" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                            </svg>
                            {{ $kos->alamat }}@if($kos->kota), {{ $kos->kota }}@endif
                        </div>
                        @if($kos->jumlah_penghuni ?? false)
                        <div class="flex items-center gap-1.5 text-sm text-text-mid">
                            <svg class="w-4 h-4 fill-primary flex-shrink-0" viewBox="0 0 24 24">
                                <path
                                    d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                            </svg>
                            {{ $kos->jumlah_penghuni }} Penyewa Kost
                        </div>
                        @endif
                    </div>

                    @if($kos->deskripsi)
                    <p class="text-sm text-text-mid leading-relaxed mb-3">{{ $kos->deskripsi }}</p>
                    @endif

                    @php $kamarKosong = $kamars->where('status','kosong')->count(); @endphp
                    <div class="flex items-center gap-1.5 text-sm">
                        <svg class="w-4 h-4 fill-primary-muted" viewBox="0 0 24 24">
                            <path
                                d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z" />
                        </svg>
                        <span class="text-text-mid">Tersedia</span>
                        <span class="text-red-600 font-bold">{{ $kamarKosong }} Kamar</span>
                    </div>
                </div>

                {{-- FASILITAS UMUM --}}
                @if($kos->fasilitas && count($kos->fasilitas) > 0)
                @php
                $fasIcons = [
                'WiFi' => '
                <path
                    d="M1 9l2 2c4.97-4.97 13.03-4.97 18 0l2-2C16.93 2.93 7.08 2.93 1 9zm8 8l3 3 3-3c-1.66-1.65-4.34-1.65-6 0zm-4-4l2 2c2.76-2.76 7.24-2.76 10 0l2-2C15.14 9.14 8.87 9.14 5 13z" />
                ',
                'AC' => '
                <path
                    d="M22 11h-4.17l3.24-3.24-1.41-1.42L15 11h-2V9l4.66-4.66-1.42-1.41L13 6.17V2h-2v4.17L7.76 2.93 6.34 4.34 11 9v2H9L4.34 6.34 2.93 7.76 6.17 11H2v2h4.17l-3.24 3.24 1.41 1.42L9 13h2v2l-4.66 4.66 1.42 1.41L11 17.83V22h2v-4.17l3.24 3.24 1.42-1.41L13 15v-2h2l4.66 4.66 1.41-1.42L17.83 13H22v-2z" />
                ',
                'KM Dalam' => '
                <path
                    d="M7 2v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-2V2h-2v2H9V2H7zm0 7h10v9H7V9z" />
                ',
                'Dapur' => '
                <path
                    d="M18 2.01L6 2c-1.1 0-2 .89-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.11-.9-1.99-2-1.99zM18 20H6v-9.02h12V20zm0-11H6V4h12v5zM9 5H7v3h2V5zm8 0h-2v3h2V5z" />
                ',
                'Laundry' => '
                <path
                    d="M9.17 16.83a4 4 0 1 0 5.66-5.66 4 4 0 0 0-5.66 5.66zM18 2.01L6 2C4.9 2 4 2.89 4 4v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.11-.9-1.99-2-1.99zM10 4h1v1h-1V4zm-2 0h1v1H8V4zm-2 0h1v1H6V4zm12 16H6V7h12v13z" />
                ',
                'Parkir' => '
                <path d="M13 3H6v18h4v-6h3c3.31 0 6-2.69 6-6s-2.69-6-6-6zm.2 8H10V7h3.2c1.1 0 2 .9 2 2s-.9 2-2 2z" />',
                'CCTV' => '
                <path
                    d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z" />
                ',
                'Akses 24 Jam' => '
                <path
                    d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z" />
                ',
                'Musholla' => '
                <path d="M12 3L2 12h3v7h6v-4h2v4h6v-7h3L12 3z" />',
                'default' => '
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />',
                ];
                @endphp
                <div class="bg-white border border-border rounded-2xl p-5">
                    <h2 class="font-jakarta font-bold text-base text-text-dark mb-4">Fasilitas Umum</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($kos->fasilitas as $f)
                        @php $ico = $fasIcons[$f] ?? $fasIcons['default']; @endphp
                        <div
                            class="flex flex-col items-center gap-1.5 px-3 py-2.5 bg-primary-light rounded-xl min-w-[64px] text-center hover:bg-green-100 transition-colors">
                            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 fill-white" viewBox="0 0 24 24">{!! $ico !!}</svg>
                            </div>
                            <span class="text-[11px] text-text-mid font-semibold leading-tight">{{ $f }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- DAFTAR KAMAR --}}
                <div>
                    <h2 class="font-jakarta font-bold text-base text-text-dark mb-0.5">Daftar Kamar</h2>
                    <p class="text-xs text-text-light mb-4">Pilih kamar yang sesuai dengan kebutuhan Anda</p>
                    <div class="flex flex-col gap-3">
                        @forelse($kamars as $kamar)
                        @php
                        $fotoKamar = ($kamar->foto_kamar && count($kamar->foto_kamar) > 0)
                        ? Storage::url($kamar->foto_kamar[0])
                        : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=200&q=80';
                        $sisaKamar = $kamars->where('tipe', $kamar->tipe)->where('status','kosong')->count();
                        @endphp
                        <div class="kamar-card">
                            {{-- Foto --}}
                            <div class="rounded-xl overflow-hidden bg-gray-100 flex-shrink-0"
                                style="width:110px;height:80px;">
                                <img src="{{ $fotoKamar }}" alt="{{ $kamar->nomor_kamar }}"
                                    class="w-full h-full object-cover">
                            </div>

                            {{-- Info --}}
                            <div class="min-w-0">
                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                    <p class="font-jakarta font-bold text-sm text-text-dark">
                                        Kamar {{ $kamar->nomor_kamar }}
                                        @if($kamar->tipe)<span class="font-normal text-text-light text-xs">–
                                            {{ $kamar->tipe }}</span>@endif
                                    </p>
                                    @if($kamar->status == 'kosong')
                                    <span class="badge-kosong">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full inline-block"></span>Tersedia
                                    </span>
                                    @else
                                    <span class="badge-penuh">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full inline-block"></span>Penuh
                                    </span>
                                    @endif
                                </div>

                                <div class="flex flex-wrap items-center gap-3 text-xs text-text-light mb-2">
                                    @if($kamar->ukuran)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3 fill-text-light" viewBox="0 0 24 24">
                                            <path
                                                d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H4V4h16v16z" />
                                        </svg>
                                        {{ $kamar->ukuran }}
                                    </span>
                                    @endif
                                    @if($kamar->kapasitas)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3 fill-text-light" viewBox="0 0 24 24">
                                            <path
                                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                        {{ $kamar->kapasitas }} Orang
                                    </span>
                                    @endif
                                    <span class="text-text-light">Sisa {{ $sisaKamar }} kamar</span>
                                </div>

                                @if($kamar->fasilitas && count($kamar->fasilitas) > 0)
                                <div class="flex flex-wrap gap-1">
                                    @foreach(array_slice($kamar->fasilitas, 0, 5) as $f)
                                    <span
                                        class="px-2 py-0.5 bg-primary-light text-text-mid text-[11px] rounded font-medium">{{ $f }}</span>
                                    @endforeach
                                    @if(count($kamar->fasilitas) > 5)
                                    <span
                                        class="px-2 py-0.5 bg-primary-light text-text-mid text-[11px] rounded font-medium">+{{ count($kamar->fasilitas)-5 }}</span>
                                    @endif
                                </div>
                                @endif
                            </div>

                            {{-- Harga & CTA --}}
                            <div class="flex flex-col items-end gap-2 flex-shrink-0 pl-2">
                                <div>
                                    <div
                                        class="font-jakarta font-extrabold text-primary text-lg leading-none text-right">
                                        Rp {{ number_format($kamar->harga,0,',','.') }}
                                    </div>
                                    <div class="text-[11px] text-text-light text-right">/ bulan</div>
                                </div>
                                @if($kamar->status == 'kosong')
                                <a href="#hubungi"
                                    class="px-4 py-2 bg-primary-muted text-white text-xs font-bold rounded-lg hover:bg-primary-dark transition-colors no-underline whitespace-nowrap">
                                    Lihat Detail
                                </a>
                                @endif
                            </div>
                        </div>
                        @empty
                        <p class="text-center py-8 text-text-light text-sm">Belum ada kamar tersedia</p>
                        @endforelse
                    </div>
                </div>

            </div>{{-- end left column --}}

            {{-- ════ RIGHT COLUMN (sidebar) ════ --}}
            <div class="sidebar-sticky flex flex-col gap-4">

                {{-- LOKASI --}}
                @if($kos->latitude && $kos->longitude)
                <div class="bg-white border border-border rounded-2xl p-5">
                    <h2 class="font-jakarta font-bold text-base text-text-dark mb-2">Lokasi</h2>
                    <div class="flex items-start gap-1.5 text-sm text-text-mid mb-3">
                        <svg class="w-4 h-4 fill-primary flex-shrink-0 mt-0.5" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                        </svg>
                        {{ $kos->alamat }}@if($kos->kota), {{ $kos->kota }}@endif
                    </div>
                    <div id="map-detail" data-lat="{{ $kos->latitude }}" data-lng="{{ $kos->longitude }}"
                        data-nama="{{ $kos->nama_kos }}"></div>
                    <a href="https://www.google.com/maps?q={{ $kos->latitude }},{{ $kos->longitude }}" target="_blank"
                        class="inline-flex items-center gap-1.5 mt-3 bg-primary text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-primary-dark transition-colors no-underline w-full justify-center">
                        <svg class="w-3.5 h-3.5 fill-white" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                        </svg>
                        Lihat di Google Maps
                    </a>
                </div>
                @endif

                {{-- HUBUNGI PEMILIK --}}
                <div id="hubungi" class="bg-white border border-border rounded-2xl p-5">
                    <h2 class="font-jakarta font-bold text-base text-text-dark mb-0.5">Hubungi Pemilik</h2>
                    <p class="text-xs text-text-light mb-4">Tertarik dengan {{ $kos->nama_kos }}? Hubungi pemilik untuk
                        informasi lebih lanjut.</p>

                    {{-- Avatar pemilik --}}
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-11 h-11 rounded-full bg-[#D6E5D6] flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 fill-primary-muted" viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] text-text-light">Pemilik Kost</div>
                            <div class="font-jakarta font-bold text-sm text-text-dark">{{ $kos->admin->name }}</div>
                        </div>
                    </div>

                    @if($kos->no_telepon)
                    @php $noWa = '62'.ltrim(preg_replace('/[^0-9]/','', $kos->no_telepon),'0'); @endphp
                    <div class="flex flex-col gap-3">
                        {{-- WA --}}
                        <a href="https://wa.me/{{ $noWa }}?text=Halo,%20saya%20tertarik%20dengan%20{{ urlencode($kos->nama_kos) }}"
                            target="_blank"
                            class="flex items-center gap-3 px-4 py-3 bg-primary-light rounded-xl hover:bg-green-100 transition-colors no-underline">
                            <div
                                class="w-9 h-9 rounded-full bg-[#25D366] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 fill-white" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-[10px] text-text-light">WhatsApp</div>
                                <div class="font-jakarta font-bold text-sm text-text-dark">+{{ $noWa }}</div>
                                <div class="text-[10px] text-text-light">Chat via WhatsApp</div>
                            </div>
                        </a>

                        {{-- Telepon --}}
                        <a href="tel:{{ $kos->no_telepon }}"
                            class="flex items-center gap-3 px-4 py-3 bg-primary-light rounded-xl hover:bg-green-100 transition-colors no-underline">
                            <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 fill-white" viewBox="0 0 24 24">
                                    <path
                                        d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-[10px] text-text-light">Telepon</div>
                                <div class="font-jakarta font-bold text-sm text-text-dark">{{ $kos->no_telepon }}</div>
                                <div class="text-[10px] text-text-light">Jam Operasional 08.00 – 20.00</div>
                            </div>
                        </a>
                    </div>

                    <div class="flex items-center justify-center gap-1.5 mt-4 text-xs text-text-light">
                        <svg class="w-3.5 h-3.5 fill-text-light" viewBox="0 0 24 24">
                            <path
                                d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm4.24 16L12 15.45 7.77 18l1.12-4.81-3.73-3.23 4.92-.42L12 5l1.92 4.53 4.92.42-3.73 3.23L16.23 18z" />
                        </svg>
                        Biasanya membalas dalam beberapa menit
                    </div>
                    @endif
                </div>

            </div>{{-- end right column --}}

        </div>{{-- end page-grid --}}

    </div>{{-- end max-w-7xl --}}

    {{-- ═══════════════════ FOOTER ═══════════════════ --}}
    <footer class="bg-bg border-t border-border relative overflow-hidden">
        <img src="{{ asset('footer.png') }}" alt="daun" class="footer-leaf">

        <div class="relative z-10 flex flex-col items-center px-16 pt-16">
            <div class="grid grid-cols-3 gap-16 w-full max-w-4xl mb-10 text-center justify-items-center">
                {{-- Brand --}}
                <div>
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <img src="{{ asset('logo.png') }}" alt="KosinAja" class="w-9 h-9 object-contain">
                        <span class="font-jakarta font-extrabold text-lg text-text-dark">KosinAja!</span>
                    </div>
                    <p class="text-xs text-text-light leading-loose">Aplikasi terbaik layanan kos.<br>Temukan kos
                        impianmu dengan mudah.</p>
                </div>
                {{-- Site Links --}}
                <div>
                    <h4 class="font-jakarta font-extrabold text-sm text-text-dark mb-4">Site Links</h4>
                    <ul class="space-y-3 list-none p-0 flex flex-col items-center">
                        @foreach(['Syarat dan ketentuan','Disclaimer','Hubungi kami'] as $link)
                        <li><a href="#"
                                class="flex items-center gap-1.5 text-xs text-text-light hover:text-primary transition-colors no-underline">
                                <span class="text-primary text-xs">▸</span>{{ $link }}
                            </a></li>
                        @endforeach
                    </ul>
                </div>
                {{-- Kontak --}}
                <div>
                    <h4 class="font-jakarta font-extrabold text-sm text-text-dark mb-4">Tetap bersama kami</h4>
                    <div class="flex flex-col items-center gap-3">
                        @foreach([
                        ['icon'=>'
                        <path
                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                        ', 'text'=>'Banyuwangi, Indonesia'],
                        ['icon'=>'
                        <path
                            d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        ', 'text'=>'Hello@Email.com'],
                        ['icon'=>'
                        <path
                            d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        ', 'text'=>'( +62 ) 82264676843'],
                        ] as $c)
                        <div class="flex items-center gap-2 text-xs text-text-light">
                            <div
                                class="w-6 h-6 bg-primary-light rounded-md flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 fill-primary" viewBox="0 0 24 24">{!! $c['icon'] !!}</svg>
                            </div>
                            {{ $c['text'] }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="relative z-10 border-t border-border py-3 text-center text-xs text-text-light tracking-widest">
            COPYRIGHT ORBIT
        </div>
    </footer>

    {{-- ═══════════════════ LIGHTBOX ═══════════════════ --}}
    <div id="lightbox">
        <button id="lb-close" onclick="closeLightbox()">✕</button>
        <button id="lb-prev" onclick="shiftPhoto(-1)">&#8249;</button>
        <img id="lb-img" src="" alt="foto">
        <button id="lb-next" onclick="shiftPhoto(1)">&#8250;</button>
        <span id="lb-counter"></span>
    </div>

    {{-- ═══════════════════ SCRIPTS ═══════════════════ --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    /* ── All photos array ── */
    const photos = @json($allPhotos);
    let currentIdx = 0;

    function openLightbox(idx) {
        currentIdx = idx;
        updateLightbox();
        document.getElementById('lightbox').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }

    function shiftPhoto(dir) {
        currentIdx = (currentIdx + dir + photos.length) % photos.length;
        updateLightbox();
    }

    function updateLightbox() {
        document.getElementById('lb-img').src = photos[currentIdx];
        document.getElementById('lb-counter').textContent = (currentIdx + 1) + ' / ' + photos.length;
    }

    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });

    document.addEventListener('keydown', function(e) {
        const lb = document.getElementById('lightbox');
        if (!lb.classList.contains('open')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') shiftPhoto(-1);
        if (e.key === 'ArrowRight') shiftPhoto(1);
    });

    /* ── Leaflet map ── */
    window.addEventListener('load', function() {
        var el = document.getElementById('map-detail');
        if (!el) return;
        var lat = parseFloat(el.dataset.lat || '0');
        var lng = parseFloat(el.dataset.lng || '0');
        var nama = el.dataset.nama || '';
        if (!lat || !lng) return;
        var map = L.map('map-detail').setView([lat, lng], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '\u00a9 OpenStreetMap'
        }).addTo(map);
        L.marker([lat, lng])
            .addTo(map)
            .bindPopup('<b>' + nama + '</b>')
            .openPopup();
    });
    </script>

</body>

</html>