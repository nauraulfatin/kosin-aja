@extends('layouts.public')

@section('title', $kamar->nomor_kamar . ' — ' . $kos->nama_kos . ' - KosinAja!')

@section('styles')
<style>
/* MAP */
#map-detail {
    height: 200px;
    border-radius: 14px;
    border: 1px solid #e8efe9;
}

/* GALLERY */
.gallery-grid {
    display: grid;
    grid-template-columns: 1fr 200px;
    gap: 10px;
    margin-bottom: 28px;
}

.gallery-main-img {
    width: 100%;
    height: 380px;
    object-fit: cover;
    border-radius: 20px;
    cursor: pointer;
    display: block;
    background: #F0F5F1;
    transition: opacity .2s;
}

.gallery-main-img:hover {
    opacity: .92;
}

.gallery-side-inner {
    display: flex;
    flex-direction: column;
    gap: 10px;
    height: 380px;
}

.gallery-thumb {
    width: 100%;
    flex: 1;
    object-fit: cover;
    border-radius: 14px;
    cursor: pointer;
    display: block;
    background: #F0F5F1;
    transition: opacity .2s;
    min-height: 0;
}

.gallery-thumb:hover {
    opacity: .85;
}

/* PAGE LAYOUT */
.page-grid {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 28px;
    align-items: start;
}

.sidebar-sticky {
    position: sticky;
    top: 104px;
}

/* LIGHTBOX */
#lightbox {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, .9);
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
    border-radius: 14px;
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
    background: rgba(255, 255, 255, .28);
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
    background: rgba(255, 255, 255, .15);
    border: none;
    color: #fff;
    font-size: 1.4rem;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s;
}

#lb-close:hover {
    background: rgba(255, 255, 255, .28);
}

#lb-counter {
    position: absolute;
    bottom: 18px;
    left: 50%;
    transform: translateX(-50%);
    color: rgba(255, 255, 255, .7);
    font-size: .82rem;
}

/* KAMAR LIST */
.kamar-card {
    display: grid;
    grid-template-columns: 100px 1fr auto;
    gap: 14px;
    align-items: center;
    background: #fff;
    border: 1px solid #e8efe9;
    border-radius: 16px;
    padding: 14px;
    transition: box-shadow .25s, border-color .25s, transform .25s;
}

.kamar-card:hover {
    box-shadow: 0 6px 20px rgba(108, 139, 107, .12);
    border-color: rgba(108, 139, 107, .3);
    transform: translateY(-2px);
}

.kamar-card.active-kamar {
    border-color: #6C8B6B;
    background: #F5FAF5;
    box-shadow: 0 4px 16px rgba(108, 139, 107, .18);
}

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

/* FASILITAS CHIP */
.fac-chip {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 9px 14px;
    background: #F0F5F1;
    border-radius: 12px;
    font-size: 0.82rem;
    color: #2a4a2c;
    font-weight: 600;
    border: 1px solid #E0EBE2;
    transition: background .2s;
}

.fac-chip:hover {
    background: #E2EDE3;
}

.fac-chip svg {
    width: 15px;
    height: 15px;
    fill: #6C8B6B;
    flex-shrink: 0;
}

@media(max-width: 1024px) {
    .page-grid {
        grid-template-columns: 1fr;
    }

    .sidebar-sticky {
        position: static;
    }
}

@media(max-width: 768px) {
    .gallery-grid {
        grid-template-columns: 1fr;
    }

    .gallery-side-inner {
        display: none;
    }

    .gallery-main-img {
        height: 260px;
    }

    .kamar-card {
        grid-template-columns: 80px 1fr;
    }
}
</style>
@endsection

@section('content')

@php
/* ── foto kamar ── */
$fotoKamarList = $kamar->foto_kamar ?? [];
$fotoUtamaKamar = count($fotoKamarList) > 0
? Storage::url($fotoKamarList[0])
: ($kos->foto_utama ? Storage::url($kos->foto_utama)
: 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&q=80');
$allPhotos = count($fotoKamarList) > 0
? array_map(fn($f) => Storage::url($f), $fotoKamarList)
: [$fotoUtamaKamar];

/* ── data kos ── */
$kamars = $kamars ?? \App\Models\Kamar::where('user_id', $kos->user_id)->get();
$kamarKosong = $kamars->where('status','kosong')->count();
$noWa = $kos->no_telepon
? '62'.ltrim(preg_replace('/[^0-9]/','', $kos->no_telepon),'0')
: null;
@endphp

<div class="bg-[#F8F7F4] min-h-screen">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-8 pb-24">

        {{-- BREADCRUMB --}}
        <p class="text-xs text-gray-400 mb-6">
            <a href="{{ route('home') }}"
                class="hover:text-[#6C8B6B] transition-colors no-underline text-gray-400">Beranda</a>
            <span class="mx-1">›</span>
            <a href="{{ route('katalog.detail', $kos->id) }}"
                class="hover:text-[#6C8B6B] transition-colors no-underline text-gray-400">{{ $kos->nama_kos }}</a>
            <span class="mx-1">›</span>
            <span class="text-[#4a5e4c]">Kamar {{ $kamar->nomor_kamar }}</span>
        </p>

        {{-- GALLERY --}}
        <div class="gallery-grid">
            <div>
                <img src="{{ $fotoUtamaKamar }}" alt="Kamar {{ $kamar->nomor_kamar }}" class="gallery-main-img"
                    onclick="openLightbox(0)">
            </div>
            <div class="gallery-side-inner">
                @for($i = 1; $i <= 3; $i++) @if(isset($allPhotos[$i])) @if($i===3 && count($allPhotos)> 4)
                    <div class="relative flex-1 rounded-[14px] overflow-hidden cursor-pointer"
                        onclick="openLightbox({{ $i }})">
                        <img src="{{ $allPhotos[$i] }}" alt="foto" class="w-full h-full object-cover brightness-50">
                        <span class="absolute inset-0 flex items-center justify-center text-white font-bold text-sm"
                            style="font-family:'Plus Jakarta Sans',sans-serif;">
                            +{{ count($allPhotos) - 3 }} Foto
                        </span>
                    </div>
                    @else
                    <img src="{{ $allPhotos[$i] }}" alt="foto" class="gallery-thumb flex-1"
                        onclick="openLightbox({{ $i }})">
                    @endif
                    @else
                    <div class="rounded-[14px] bg-[#F0F5F1] flex-1"></div>
                    @endif
                    @endfor

                    <button onclick="openLightbox(0)"
                        class="flex items-center justify-center gap-2 text-white text-xs font-bold py-2.5 rounded-xl transition-colors w-full border-none cursor-pointer flex-shrink-0"
                        style="background:#6C8B6B;">
                        <svg class="w-3.5 h-3.5" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z" />
                        </svg>
                        Lihat Semua Foto
                    </button>
            </div>
        </div>

        {{-- TWO-COLUMN --}}
        <div class="page-grid">

            {{-- KOLOM KIRI --}}
            <div class="flex flex-col gap-5">

                {{-- INFO KAMAR --}}
                <div class="bg-white border border-[#E8EFE9] rounded-2xl p-6"
                    style="box-shadow:0 2px 12px rgba(26,47,36,.05);">

                    <div class="flex items-start justify-between gap-4 mb-3 flex-wrap">
                        <div>
                            <h1
                                style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.7rem;color:#1F3A2C;line-height:1.2;margin-bottom:4px;">
                                Kamar {{ $kamar->nomor_kamar }}
                            </h1>
                            <p class="text-sm text-[#7A8A7C]">{{ $kos->nama_kos }}</p>
                        </div>
                        @if($kamar->status == 'kosong')
                        <span class="badge-kosong mt-1">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full inline-block"></span>Tersedia
                        </span>
                        @else
                        <span class="badge-penuh mt-1">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full inline-block"></span>Penuh
                        </span>
                        @endif
                    </div>

                    {{-- META --}}
                    <div class="flex flex-wrap gap-4 mb-4 text-sm text-[#4a5e4c]">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="#6C8B6B" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                            </svg>
                            {{ $kos->alamat }}@if($kos->kota), {{ $kos->kota }}@endif
                        </div>
                        @if($kamar->ukuran)
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="#6C8B6B" viewBox="0 0 24 24">
                                <path
                                    d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H4V4h16v16z" />
                            </svg>
                            {{ $kamar->ukuran }}
                        </div>
                        @endif
                        @if($kamar->kapasitas)
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="#6C8B6B" viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                            {{ $kamar->kapasitas }} Orang
                        </div>
                        @endif
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="#6C8B6B" viewBox="0 0 24 24">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                            </svg>
                            Kos {{ ucfirst($kos->tipe_kos) }}
                        </div>
                    </div>

                    @if($kamar->keterangan)
                    <p class="text-sm text-[#4a5e4c] leading-relaxed">{{ $kamar->keterangan }}</p>
                    @endif

                </div>

                {{-- FASILITAS KAMAR --}}
                @if($kamar->fasilitas && count($kamar->fasilitas) > 0)
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
                'Kolam' => '
                <path d="M2 20h20v2H2v-2zM6 3v14h2V3H6zm6 2v12h2V5h-2zm6 4v8h2V9h-2z" />',
                'Kasur' => '
                <path
                    d="M7 13c1.66 0 3-1.34 3-3S8.66 7 7 7s-3 1.34-3 3 1.34 3 3 3zm12-6h-8v7H3V5H1v15h2v-3h18v3h2v-9c0-2.21-1.79-4-4-4z" />
                ',
                'Lemari' => '
                <path d="M3 3h8v18H3V3zm10 0h8v18h-8V3zM5 7h4M5 11h4M5 15h4M15 7h4M15 11h4M15 15h4" />',
                'Meja Kursi' => '
                <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z" />',
                'default' => '
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />',
                ];
                @endphp
                <div class="bg-white border border-[#E8EFE9] rounded-2xl p-6"
                    style="box-shadow:0 2px 12px rgba(26,47,36,.05);">
                    <h2
                        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1rem;color:#1F3A2C;margin-bottom:16px;">
                        Fasilitas Kamar
                    </h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($kamar->fasilitas as $f)
                        @php $ico = $fasIcons[$f] ?? $fasIcons['default']; @endphp
                        <div class="flex flex-col items-center gap-1.5 px-3 py-2.5 rounded-xl text-center cursor-default transition-colors"
                            style="background:#F0F5F1;border:1px solid #E0EBE2;min-width:68px;"
                            onmouseover="this.style.background='#E2EDE3'" onmouseout="this.style.background='#F0F5F1'">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                                style="background:#6C8B6B;">
                                <svg class="w-5 h-5" fill="white" viewBox="0 0 24 24">{!! $ico !!}</svg>
                            </div>
                            <span style="font-size:11px;color:#4a5e4c;font-weight:600;line-height:1.3;">{{ $f }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- FASILITAS UMUM KOS --}}
                @if($kos->fasilitas && count($kos->fasilitas) > 0)
                <div class="bg-white border border-[#E8EFE9] rounded-2xl p-6"
                    style="box-shadow:0 2px 12px rgba(26,47,36,.05);">
                    <h2
                        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1rem;color:#1F3A2C;margin-bottom:4px;">
                        Fasilitas Umum Kos
                    </h2>
                    <p class="text-xs text-[#8a9e8c] mb-4">Fasilitas bersama yang tersedia di {{ $kos->nama_kos }}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($kos->fasilitas as $f)
                        <div class="fac-chip">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                            </svg>
                            {{ $f }}
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- KAMAR LAIN DI KOS INI --}}
                @if($kamars->count() > 1)
                <div class="bg-white border border-[#E8EFE9] rounded-2xl p-6"
                    style="box-shadow:0 2px 12px rgba(26,47,36,.05);">
                    <h2
                        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1rem;color:#1F3A2C;margin-bottom:4px;">
                        Kamar Lain di {{ $kos->nama_kos }}
                    </h2>
                    <p class="text-xs text-[#8a9e8c] mb-4">Pilih kamar lain yang sesuai kebutuhanmu</p>
                    <div class="flex flex-col gap-3">
                        @foreach($kamars as $k)
                        @php
                        $fotoK = ($k->foto_kamar && count($k->foto_kamar) > 0)
                        ? Storage::url($k->foto_kamar[0])
                        : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=200&q=80';
                        @endphp
                        <div class="kamar-card {{ $k->id == $kamar->id ? 'active-kamar' : '' }}">
                            <div class="rounded-xl overflow-hidden flex-shrink-0"
                                style="width:100px;height:72px;background:#F0F5F1;">
                                <img src="{{ $fotoK }}" alt="Kamar {{ $k->nomor_kamar }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                    <p
                                        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.88rem;color:#1F3A2C;">
                                        Kamar {{ $k->nomor_kamar }}
                                        @if($k->id == $kamar->id)
                                        <span style="font-size:10px;color:#6C8B6B;font-weight:600;"> · Sedang
                                            dilihat</span>
                                        @endif
                                    </p>
                                    @if($k->status == 'kosong')
                                    <span class="badge-kosong">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full inline-block"></span>Tersedia
                                    </span>
                                    @else
                                    <span class="badge-penuh">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full inline-block"></span>Penuh
                                    </span>
                                    @endif
                                </div>
                                @if($k->fasilitas && count($k->fasilitas) > 0)
                                <div class="flex flex-wrap gap-1">
                                    @foreach(array_slice($k->fasilitas, 0, 4) as $f)
                                    <span
                                        style="padding:2px 8px;background:#F0F5F1;border-radius:5px;font-size:10px;color:#4a5e4c;font-weight:600;border:1px solid #E0EBE2;">{{ $f }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="flex flex-col items-end gap-1.5 flex-shrink-0">
                                <div
                                    style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:0.95rem;color:#1F3A2C;text-align:right;">
                                    Rp {{ number_format($k->harga,0,',','.') }}
                                </div>
                                <div style="font-size:10px;color:#8a9e8c;">/ bulan</div>
                                @if($k->id != $kamar->id)
                                <a href="{{ route('katalog.kamar.detail', [$kos->id, $k->id]) }}"
                                    style="padding:6px 14px;background:#6C8B6B;color:white;font-size:11px;font-weight:700;border-radius:10px;text-decoration:none;transition:background .2s;"
                                    onmouseover="this.style.background='#5a7a59'"
                                    onmouseout="this.style.background='#6C8B6B'">
                                    Lihat
                                </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- SEMUA FOTO --}}
                @if(count($allPhotos) > 1)
                <div class="bg-white border border-[#E8EFE9] rounded-2xl p-6"
                    style="box-shadow:0 2px 12px rgba(26,47,36,.05);">
                    <h2
                        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1rem;color:#1F3A2C;margin-bottom:16px;">
                        Semua Foto
                    </h2>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach($allPhotos as $i => $foto)
                        <img src="{{ $foto }}" onclick="openLightbox({{ $i }})"
                            class="w-full object-cover rounded-xl cursor-pointer transition-opacity hover:opacity-85"
                            style="height:110px;">
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
            {{-- end kolom kiri --}}

            {{-- KOLOM KANAN STICKY --}}
            <div class="sidebar-sticky flex flex-col gap-4">

                {{-- HARGA CARD --}}
                <div class="bg-white border border-[#E8EFE9] rounded-2xl p-6"
                    style="box-shadow:0 2px 12px rgba(26,47,36,.06);">
                    <p
                        style="font-size:11px;color:#8a9e8c;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">
                        Harga sewa
                    </p>
                    <div
                        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.9rem;color:#1F3A2C;line-height:1.1;margin-bottom:2px;">
                        Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                    </div>
                    <p style="font-size:12px;color:#8a9e8c;margin-bottom:20px;">/ bulan</p>

                    <div style="height:1px;background:#F0F5F1;margin-bottom:16px;"></div>

                    <div class="space-y-2.5 mb-5">
                        <div class="flex justify-between text-sm">
                            <span style="color:#8a9e8c;">Nomor Kamar</span>
                            <span style="font-weight:700;color:#1F3A2C;">{{ $kamar->nomor_kamar }}</span>
                        </div>
                        @if($kamar->ukuran)
                        <div class="flex justify-between text-sm">
                            <span style="color:#8a9e8c;">Ukuran</span>
                            <span style="font-weight:700;color:#1F3A2C;">{{ $kamar->ukuran }}</span>
                        </div>
                        @endif
                        @if($kamar->kapasitas)
                        <div class="flex justify-between text-sm">
                            <span style="color:#8a9e8c;">Kapasitas</span>
                            <span style="font-weight:700;color:#1F3A2C;">{{ $kamar->kapasitas }} Orang</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-sm">
                            <span style="color:#8a9e8c;">Status</span>
                            @if($kamar->status == 'kosong')
                            <span class="badge-kosong">Tersedia</span>
                            @else
                            <span class="badge-penuh">Penuh</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-sm">
                            <span style="color:#8a9e8c;">Tipe Kost</span>
                            <span style="font-weight:700;color:#1F3A2C;">{{ ucfirst($kos->tipe_kos) }}</span>
                        </div>
                    </div>

                    @if($noWa)
                    <a href="https://wa.me/{{ $noWa }}?text=Halo,%20saya%20tertarik%20dengan%20Kamar%20{{ $kamar->nomor_kamar }}%20di%20{{ urlencode($kos->nama_kos) }}"
                        target="_blank"
                        class="flex items-center justify-center gap-2.5 w-full no-underline font-bold text-sm text-white rounded-2xl transition-all"
                        style="padding:14px;background:#6C8B6B;box-shadow:0 6px 20px rgba(108,139,107,.25);margin-bottom:10px;"
                        onmouseover="this.style.background='#5a7a59';this.style.transform='translateY(-2px)'"
                        onmouseout="this.style.background='#6C8B6B';this.style.transform='none'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Chat via WhatsApp
                    </a>

                    <a href="tel:{{ $kos->no_telepon }}"
                        class="flex items-center justify-center gap-2.5 w-full no-underline font-bold text-sm rounded-2xl transition-all border"
                        style="padding:12px;background:#F0F5F1;color:#1F3A2C;border-color:#E0EBE2;"
                        onmouseover="this.style.background='#E2EDE3'" onmouseout="this.style.background='#F0F5F1'">
                        <svg class="w-4 h-4 flex-shrink-0" fill="#6C8B6B" viewBox="0 0 24 24">
                            <path
                                d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        </svg>
                        {{ $kos->no_telepon }}
                    </a>

                    <p class="text-center text-xs mt-3" style="color:#8a9e8c;">⏱ Biasanya membalas dalam beberapa menit
                    </p>
                    @else
                    <p class="text-center text-sm mt-2" style="color:#8a9e8c;">Nomor telepon belum tersedia</p>
                    @endif
                </div>

                {{-- PEMILIK CARD --}}
                <div class="bg-white border border-[#E8EFE9] rounded-2xl p-5"
                    style="box-shadow:0 2px 12px rgba(26,47,36,.05);">

                    <p
                        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1rem;color:#1F3A2C;margin-bottom:16px;">
                        Pemilik Kost
                    </p>

                    {{-- Avatar + Nama --}}
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center flex-shrink-0"
                            style="background:#D6E5D6;">
                            <svg class="w-8 h-8" fill="#6C8B6B" viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                            </svg>
                        </div>
                        <div>
                            <div
                                style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.95rem;color:#1F3A2C;">
                                {{ $kos->admin->name }}
                            </div>
                            <div style="font-size:12px;color:#8a9e8c;margin-top:2px;">
                                Bergabung sejak {{ $kos->admin->created_at->format('Y') }}
                            </div>
                        </div>
                    </div>

                    {{-- Responsif Box --}}
                    <div class="rounded-xl p-4 mb-5" style="background:#F5FAF5;border:1px solid #E0EBE2;">
                        <p
                            style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.82rem;color:#1F3A2C;margin-bottom:12px;">
                            Responsif
                        </p>
                        <div class="flex items-center gap-2 mb-2.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="#6C8B6B" stroke-width="2"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path stroke-linecap="round" d="M12 6v6l4 2" />
                            </svg>
                            <div>
                                <span style="font-size:12px;color:#4a5e4c;font-weight:600;">Waktu respon
                                    rata-rata</span>
                                <br>
                                <span style="font-size:11px;color:#6C8B6B;font-weight:700;">30 Menit</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="#6C8B6B" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                            </svg>
                            <span style="font-size:12px;color:#4a5e4c;font-weight:600;">98% chat dibalas</span>
                        </div>
                    </div>

                    <div style="height:1px;background:#F0F5F1;margin-bottom:16px;"></div>

                    <p
                        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.82rem;color:#1F3A2C;margin-bottom:12px;">
                        Hubungi Langsung
                    </p>

                    {{-- Tombol WA --}}
                    @if($kos->no_telepon)
                    @php
                    $noWaCard = '62'.ltrim(preg_replace('/[^0-9]/','', $kos->no_telepon),'0');
                    @endphp
                    <a href="https://wa.me/{{ $noWaCard }}?text=Halo,%20saya%20tertarik%20dengan%20{{ urlencode($kos->nama_kos) }}"
                        target="_blank"
                        class="flex items-center justify-center gap-2.5 w-full no-underline font-bold text-sm text-white rounded-xl mb-3"
                        style="padding:12px;background:#6C8B6B;" onmouseover="this.style.background='#5a7a59'"
                        onmouseout="this.style.background='#6C8B6B'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Chat Whatsapp
                    </a>
                    @endif

                    {{-- Tombol Instagram (opsional, kosongkan href kalau tidak ada) --}}
                    <a href="#"
                        class="flex items-center justify-center gap-2.5 w-full no-underline font-bold text-sm text-white rounded-xl"
                        style="padding:12px;background:#6C8B6B;" onmouseover="this.style.background='#5a7a59'"
                        onmouseout="this.style.background='#6C8B6B'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                        Instagram
                    </a>

                </div>

                {{-- LOKASI CARD --}}
                @if($kos->latitude && $kos->longitude)
                <div class="bg-white border border-[#E8EFE9] rounded-2xl p-5"
                    style="box-shadow:0 2px 12px rgba(26,47,36,.05);">
                    <h2
                        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1rem;color:#1F3A2C;margin-bottom:8px;">
                        Lokasi
                    </h2>
                    <div class="flex items-start gap-1.5 text-sm mb-3" style="color:#4a5e4c;">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="#6C8B6B" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                        </svg>
                        {{ $kos->alamat }}@if($kos->kota), {{ $kos->kota }}@endif
                    </div>
                    <div id="map-detail" data-lat="{{ $kos->latitude }}" data-lng="{{ $kos->longitude }}"
                        data-nama="{{ $kos->nama_kos }}">
                    </div>
                    <a href="https://www.google.com/maps?q={{ $kos->latitude }},{{ $kos->longitude }}" target="_blank"
                        class="inline-flex items-center justify-center gap-1.5 w-full no-underline font-bold text-xs rounded-xl transition-colors border"
                        style="margin-top:10px;padding:10px;background:#F0F5F1;color:#1F3A2C;border-color:#E0EBE2;"
                        onmouseover="this.style.background='#E2EDE3'" onmouseout="this.style.background='#F0F5F1'">
                        <svg class="w-3.5 h-3.5" fill="#6C8B6B" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                        </svg>
                        Lihat di Google Maps
                    </a>
                </div>
                @endif

            </div>
            {{-- end kolom kanan --}}

        </div>
        {{-- end page-grid --}}

    </div>
</div>

{{-- LIGHTBOX --}}
<div id="lightbox">
    <button id="lb-close" onclick="closeLightbox()">✕</button>
    <button id="lb-prev" onclick="shiftPhoto(-1)">&#8249;</button>
    <img id="lb-img" src="" alt="foto">
    <button id="lb-next" onclick="shiftPhoto(1)">&#8250;</button>
    <span id="lb-counter"></span>
</div>

{{-- SCRIPTS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
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
    if (!document.getElementById('lightbox').classList.contains('open')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') shiftPhoto(-1);
    if (e.key === 'ArrowRight') shiftPhoto(1);
});

/* LEAFLET */
window.addEventListener('load', function() {
    var el = document.getElementById('map-detail');
    if (!el) return;
    var lat = parseFloat(el.dataset.lat || '0');
    var lng = parseFloat(el.dataset.lng || '0');
    var nama = el.dataset.nama || '';
    if (!lat || !lng) return;
    var map = L.map('map-detail').setView([lat, lng], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);
    L.marker([lat, lng])
        .addTo(map)
        .bindPopup('<b>' + nama + '</b>')
        .openPopup();
});
</script>

@endsection