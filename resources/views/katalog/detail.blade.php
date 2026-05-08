@extends('layouts.public')

@section('title', $kos->nama_kos . ' - KosinAja!')

@section('styles')
<style>
.detail-container {
    max-width: 860px;
    margin: 0 auto;
    padding: 32px 64px 56px;
}

.breadcrumb {
    font-size: 0.82rem;
    color: #8a9e8c;
    margin-bottom: 20px;
}

.breadcrumb a {
    color: #8a9e8c;
    text-decoration: none;
}

.breadcrumb a:hover {
    color: #7CA385;
}

/* GALERI */
.galeri-grid {
    display: grid;
    grid-template-columns: 1fr 200px;
    gap: 12px;
    margin-bottom: 28px;
}

.galeri-main img {
    width: 100%;
    height: 360px;
    object-fit: cover;
    border-radius: 16px;
    background: #e5e7eb;
}

.galeri-side {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.galeri-side img {
    width: 100%;
    height: 108px;
    object-fit: cover;
    border-radius: 12px;
    background: #e5e7eb;
}

.galeri-more {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
}

.galeri-more img {
    width: 100%;
    height: 108px;
    object-fit: cover;
    filter: brightness(0.5);
}

.galeri-more span {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.1rem;
}

.btn-lihat-semua-foto {
    display: inline-block;
    background: #6C8B6B;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    margin-top: 8px;
    width: 100%;
    text-align: center;
}

/* INFO UTAMA */
.kos-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 2rem;
    color: #1a2e1c;
    margin-bottom: 8px;
}

.kos-meta {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}

.kos-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.9rem;
    color: #4a5e4c;
}

.kos-meta-item svg {
    width: 16px;
    height: 16px;
    fill: #7CA385;
    flex-shrink: 0;
}

.kos-desc {
    font-size: 0.92rem;
    color: #4a5e4c;
    line-height: 1.8;
    margin-bottom: 12px;
}

.tersedia-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 24px;
}

.tersedia-badge span {
    color: #dc2626;
}

/* SECTION */
.section-box {
    background: white;
    border: 1px solid #e8efe9;
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 20px;
}

.section-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.1rem;
    color: #1a2e1c;
    margin-bottom: 16px;
}

/* FASILITAS */
.fasilitas-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.fasilitas-chip {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    padding: 12px 16px;
    background: #f5f9f6;
    border-radius: 12px;
    font-size: 0.78rem;
    color: #4a5e4c;
    font-weight: 600;
    min-width: 70px;
    text-align: center;
}

.fasilitas-chip svg {
    width: 22px;
    height: 22px;
    fill: #7CA385;
}

/* LOKASI */
.lokasi-alamat {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 0.88rem;
    color: #4a5e4c;
    margin-bottom: 12px;
}

.lokasi-alamat svg {
    width: 16px;
    height: 16px;
    fill: #7CA385;
    flex-shrink: 0;
    margin-top: 2px;
}

#map-detail {
    height: 280px;
    border-radius: 12px;
    border: 1px solid #e8efe9;
}

.btn-gmaps {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 10px;
    background: #f0f5f1;
    color: #3a5c3a;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 0.82rem;
    font-weight: 600;
    text-decoration: none;
}

/* DAFTAR KAMAR */
.kamar-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px 0;
    border-bottom: 1px solid #f0f0f0;
}

.kamar-item:last-child {
    border-bottom: none;
}

.kamar-foto {
    width: 100px;
    height: 72px;
    object-fit: cover;
    border-radius: 10px;
    background: #e5e7eb;
    flex-shrink: 0;
}

.kamar-info {
    flex: 1;
}

.kamar-nama {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 0.95rem;
    color: #1a2e1c;
    margin-bottom: 4px;
}

.kamar-fasilitas {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    margin-top: 6px;
}

.kamar-tag {
    padding: 2px 8px;
    background: #f0f5f1;
    border-radius: 4px;
    font-size: 0.7rem;
    color: #4a5e4c;
    font-weight: 500;
}

.kamar-harga {
    text-align: right;
    flex-shrink: 0;
}

.kamar-harga .harga {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1rem;
    color: #7CA385;
}

.kamar-harga .per {
    font-size: 0.75rem;
    color: #8a9e8c;
}

.kamar-harga .sisa {
    font-size: 0.75rem;
    color: #8a9e8c;
    margin-top: 2px;
}

.btn-detail-kamar {
    display: inline-block;
    background: #6C8B6B;
    color: white;
    padding: 7px 16px;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    text-decoration: none;
    margin-top: 8px;
}

/* HUBUNGI */
.hubungi-box {
    display: flex;
    align-items: center;
    gap: 24px;
    flex-wrap: wrap;
}

.pemilik-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.pemilik-avatar {
    width: 48px;
    height: 48px;
    background: #D6E5D6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pemilik-avatar svg {
    width: 24px;
    height: 24px;
    fill: #6C8B6B;
}

.pemilik-nama {
    font-weight: 700;
    font-size: 0.9rem;
    color: #1a2e1c;
}

.pemilik-role {
    font-size: 0.75rem;
    color: #8a9e8c;
}

.hubungi-actions {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    flex: 1;
}

.hubungi-card {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    background: #f5f9f6;
    border-radius: 12px;
    text-decoration: none;
    flex: 1;
    min-width: 160px;
}

.hubungi-card svg {
    width: 28px;
    height: 28px;
    fill: #7CA385;
    flex-shrink: 0;
}

.hubungi-card .label {
    font-size: 0.75rem;
    color: #8a9e8c;
}

.hubungi-card .value {
    font-size: 0.88rem;
    font-weight: 700;
    color: #1a2e1c;
}

.hubungi-note {
    font-size: 0.75rem;
    color: #8a9e8c;
    text-align: center;
    margin-top: 12px;
}

/* MODAL FOTO */
.modal-foto {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.85);
    z-index: 999;
    align-items: center;
    justify-content: center;
}

.modal-foto.active {
    display: flex;
}

.modal-foto img {
    max-width: 90vw;
    max-height: 90vh;
    border-radius: 12px;
    object-fit: contain;
}

.modal-close {
    position: absolute;
    top: 20px;
    right: 24px;
    color: white;
    font-size: 2rem;
    cursor: pointer;
    background: none;
    border: none;
}

@media(max-width:768px) {
    .detail-container {
        padding: 20px;
    }

    .galeri-grid {
        grid-template-columns: 1fr;
    }

    .galeri-side {
        display: none;
    }

    .kos-title {
        font-size: 1.5rem;
    }

    .hubungi-box {
        flex-direction: column;
    }
}
</style>
@endsection

@section('content')
<div class="detail-container">

    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> › Detail Kost
    </div>

    {{-- GALERI FOTO --}}
    @php
    $fotoUtama = $kos->foto_utama ? Storage::url($kos->foto_utama) :
    'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=800&q=80';
    $galeri = $kos->foto_galeri ?? [];
    @endphp

    <div class="galeri-grid">
        <div class="galeri-main">
            <img src="{{ $fotoUtama }}" alt="{{ $kos->nama_kos }}" onclick="bukaModal('{{ $fotoUtama }}')"
                style="cursor:pointer;">
        </div>
        <div class="galeri-side">
            @forelse(array_slice($galeri, 0, 2) as $foto)
            <img src="{{ Storage::url($foto) }}" alt="Foto" onclick="bukaModal('{{ Storage::url($foto) }}')"
                style="cursor:pointer;">
            @empty
            <div style="height:108px;background:#f0f0f0;border-radius:12px;"></div>
            <div style="height:108px;background:#f0f0f0;border-radius:12px;"></div>
            @endforelse

            @if(count($galeri) > 2)
            <div class="galeri-more" onclick="bukaModal('{{ Storage::url($galeri[2]) }}')">
                <img src="{{ Storage::url($galeri[2]) }}" alt="Foto">
                <span>+{{ count($galeri) - 2 }} Foto</span>
            </div>
            @else
            <div style="height:108px;background:#f0f0f0;border-radius:12px;"></div>
            @endif

            <a href="#semua-foto" class="btn-lihat-semua-foto">Lihat Semua</a>
        </div>
    </div>

    {{-- INFO UTAMA --}}
    <h1 class="kos-title">{{ $kos->nama_kos }}</h1>

    <div class="kos-meta">
        <div class="kos-meta-item">
            <svg viewBox="0 0 24 24">
                <path
                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
            </svg>
            {{ $kos->alamat }}@if($kos->kota), {{ $kos->kota }}@endif
        </div>
    </div>

    @if($kos->deskripsi)
    <p class="kos-desc">{{ $kos->deskripsi }}</p>
    @endif

    @php $kamarKosong = $kamars->where('status', 'kosong')->count(); @endphp
    <div class="tersedia-badge">
        <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;fill:#6C8B6B;" viewBox="0 0 24 24">
            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
        </svg>
        Tersedia <span>{{ $kamarKosong }} Kamar</span>
    </div>

    {{-- FASILITAS UMUM --}}
    @if($kos->fasilitas && count($kos->fasilitas) > 0)
    <div class="section-box">
        <div class="section-title">Fasilitas Umum</div>
        <div class="fasilitas-grid">
            @foreach($kos->fasilitas as $f)
            <div class="fasilitas-chip">
                <svg viewBox="0 0 24 24">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                </svg>
                {{ $f }}
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- LOKASI --}}
    @if($kos->latitude && $kos->longitude)
    <div class="section-box">
        <div class="section-title">Lokasi</div>
        <div class="lokasi-alamat">
            <svg viewBox="0 0 24 24">
                <path
                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
            </svg>
            {{ $kos->alamat }}@if($kos->kota), {{ $kos->kota }}@endif
        </div>
        <div id="map-detail"></div>
        <a href="https://www.google.com/maps?q={{ $kos->latitude }},{{ $kos->longitude }}" target="_blank"
            class="btn-gmaps">
            📍 Lihat di Google Maps
        </a>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    window.addEventListener('load', function() {
        const map = L.map('map-detail').setView([{
            {
                $kos - > latitude
            }
        }, {
            {
                $kos - > longitude
            }
        }], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);
        L.marker([{
                {
                    $kos - > latitude
                }
            }, {
                {
                    $kos - > longitude
                }
            }])
            .addTo(map)
            .bindPopup('<b>{{ $kos->nama_kos }}</b>')
            .openPopup();
    });
    </script>
    @endif

    {{-- DAFTAR KAMAR --}}
    <div class="section-box">
        <div class="section-title">Daftar Kamar</div>
        <p style="font-size:0.82rem;color:#8a9e8c;margin-top:-10px;margin-bottom:16px;">Pilih kamar yang sesuai dengan
            kebutuhan Anda</p>

        @forelse($kamars as $kamar)
        <div class="kamar-item">

            {{-- Foto Kamar --}}
            @php $fotoKamar = ($kamar->foto_kamar && count($kamar->foto_kamar) > 0) ?
            Storage::url($kamar->foto_kamar[0]) : null; @endphp
            @if($fotoKamar)
            <img src="{{ $fotoKamar }}" alt="Kamar {{ $kamar->nomor_kamar }}" class="kamar-foto">
            @else
            <div class="kamar-foto" style="display:flex;align-items:center;justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:32px;height:32px;fill:#d1d5db;"
                    viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
            </div>
            @endif

            <div class="kamar-info">
                <div class="kamar-nama">Kamar {{ $kamar->nomor_kamar }}</div>
                @if($kamar->fasilitas && count($kamar->fasilitas) > 0)
                <div class="kamar-fasilitas">
                    @foreach(array_slice($kamar->fasilitas, 0, 5) as $f)
                    <span class="kamar-tag">{{ $f }}</span>
                    @endforeach
                    @if(count($kamar->fasilitas) > 5)
                    <span class="kamar-tag">+{{ count($kamar->fasilitas) - 5 }}</span>
                    @endif
                </div>
                @endif
                @if($kamar->keterangan)
                <p style="font-size:0.78rem;color:#8a9e8c;margin-top:4px;">{{ $kamar->keterangan }}</p>
                @endif
            </div>

            <div class="kamar-harga">
                <div class="harga">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</div>
                <div class="per">/ bulan</div>
                <div class="sisa" style="color:{{ $kamar->status == 'kosong' ? '#dc2626' : '#8a9e8c' }}">
                    {{ $kamar->status == 'kosong' ? 'Tersedia' : 'Terisi' }}
                </div>
                @if($kamar->status == 'kosong')
                <a href="#hubungi" class="btn-detail-kamar">Lihat Detail</a>
                @endif
            </div>

        </div>
        @empty
        <p style="text-align:center;color:#8a9e8c;padding:20px 0;font-size:0.88rem;">Belum ada kamar yang tersedia</p>
        @endforelse
    </div>

    {{-- SEMUA FOTO GALERI --}}
    @if(count($galeri) > 0)
    <div id="semua-foto" class="section-box">
        <div class="section-title">Semua Foto</div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;">
            <img src="{{ $fotoUtama }}"
                style="width:100%;height:120px;object-fit:cover;border-radius:10px;cursor:pointer;"
                onclick="bukaModal('{{ $fotoUtama }}')">
            @foreach($galeri as $foto)
            <img src="{{ Storage::url($foto) }}"
                style="width:100%;height:120px;object-fit:cover;border-radius:10px;cursor:pointer;"
                onclick="bukaModal('{{ Storage::url($foto) }}')">
            @endforeach
        </div>
    </div>
    @endif

    {{-- HUBUNGI PEMILIK --}}
    <div id="hubungi" class="section-box">
        <div class="section-title">Hubungi Pemilik</div>
        <p style="font-size:0.82rem;color:#8a9e8c;margin-top:-10px;margin-bottom:20px;">
            Tertarik dengan {{ $kos->nama_kos }}? Hubungi pemilik untuk informasi lebih lanjut.
        </p>

        <div class="hubungi-box">
            {{-- Info Pemilik --}}
            <div class="pemilik-info">
                <div class="pemilik-avatar">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                </div>
                <div>
                    <div class="pemilik-nama">{{ $kos->admin->name }}</div>
                    <div class="pemilik-role">Pemilik Kost</div>
                </div>
            </div>

            {{-- Tombol Hubungi --}}
            <div class="hubungi-actions">
                @if($kos->no_telepon)
                @php
                $noWa = '62' . ltrim(preg_replace('/[^0-9]/', '', $kos->no_telepon), '0');
                @endphp
                <a href="https://wa.me/{{ $noWa }}?text=Halo,%20saya%20tertarik%20dengan%20{{ urlencode($kos->nama_kos) }}"
                    target="_blank" class="hubungi-card">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    <div>
                        <div class="label">WhatsApp</div>
                        <div class="value">+{{ $noWa }}</div>
                        <div class="label">Chat via WhatsApp</div>
                    </div>
                </a>

                <a href="tel:{{ $kos->no_telepon }}" class="hubungi-card">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                    </svg>
                    <div>
                        <div class="label">Telepon</div>
                        <div class="value">{{ $kos->no_telepon }}</div>
                        <div class="label">Jam Operasional 08.00 - 20.00</div>
                    </div>
                </a>
                @else
                <p style="font-size:0.85rem;color:#8a9e8c;">Nomor telepon belum tersedia</p>
                @endif
            </div>
        </div>

        <p class="hubungi-note">⏱ Biasanya membalas dalam beberapa menit</p>
    </div>

</div>

{{-- MODAL FOTO --}}
<div class="modal-foto" id="modalFoto" onclick="tutupModal()">
    <button class="modal-close" onclick="tutupModal()">✕</button>
    <img id="modalImg" src="" alt="Foto">
</div>

<script>
function bukaModal(src) {
    document.getElementById('modalImg').src = src;
    document.getElementById('modalFoto').classList.add('active');
}

function tutupModal() {
    document.getElementById('modalFoto').classList.remove('active');
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') tutupModal();
});
</script>

@endsection