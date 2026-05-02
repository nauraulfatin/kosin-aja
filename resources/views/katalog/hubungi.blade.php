@extends('layouts.public')

@section('title', 'Hubungi Kami - KosinAja!')

@section('styles')
<style>
/* ───── HERO HUBUNGI ───── */
.hero-hubungi {
    padding: 56px 64px 40px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: 40px;
    position: relative;
    overflow: hidden
}

.hero-hubungi::before {
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

.hero-hubungi-text {
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

.hero-hubungi-text h1 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: clamp(2rem, 3.5vw, 2.8rem);
    line-height: 1.15;
    color: var(--text-dark);
    margin-bottom: 16px
}

.hero-hubungi-text p {
    font-size: 1rem;
    color: var(--text-mid);
    line-height: 1.7;
    max-width: 380px
}

.hero-hubungi-image {
    display: flex;
    justify-content: flex-end;
    position: relative;
    z-index: 2
}

.hero-hubungi-image img {
    max-width: 100%;
    max-height: 300px;
    object-fit: contain
}

/* CARA */
.cara-section {
    padding: 0 64px 40px
}

.section-title-center {
    text-align: center;
    margin-bottom: 28px
}

.section-title-center .divider-row {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px
}

.section-title-center h2 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.3rem;
    color: var(--text-dark)
}

.cara-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px
}

.cara-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 28px 20px;
    text-align: center;
    transition: transform 0.2s, box-shadow 0.2s
}

.cara-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 28px rgba(124, 163, 133, 0.13)
}

.cara-icon {
    width: 52px;
    height: 52px;
    background: #f0f5f1;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px
}

.cara-icon svg {
    width: 26px;
    height: 26px;
    fill: var(--cta)
}

.cara-card h4 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 0.95rem;
    color: var(--text-dark);
    margin-bottom: 8px
}

.cara-card p {
    font-size: 0.82rem;
    color: var(--text-light);
    line-height: 1.6
}

/* FAQ + MAP */
.faq-map-section {
    padding: 0 64px 40px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px
}

/* FAQ */
.faq-box {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 32px
}

.faq-box h3 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.15rem;
    color: var(--text-dark);
    margin-bottom: 24px
}

.faq-item {
    border-bottom: 1px solid var(--border)
}

.faq-item:last-child {
    border-bottom: none
}

.faq-question {
    width: 100%;
    background: none;
    border: none;
    text-align: left;
    padding: 16px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    gap: 12px
}

.faq-question span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--text-dark);
    line-height: 1.4
}

.faq-icon {
    width: 24px;
    height: 24px;
    min-width: 24px;
    background: #f0f5f1;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s, transform 0.3s
}

.faq-icon svg {
    width: 12px;
    height: 12px;
    fill: var(--cta);
    transition: transform 0.3s
}

.faq-item.open .faq-icon {
    background: var(--cta)
}

.faq-item.open .faq-icon svg {
    fill: #fff;
    transform: rotate(180deg)
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, padding 0.3s ease
}

.faq-answer p {
    font-size: 0.85rem;
    color: var(--text-mid);
    line-height: 1.7;
    padding-bottom: 16px
}

/* MAP */
.map-box {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 20px;
    overflow: hidden;
    display: flex;
    flex-direction: column
}

.map-box h3 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.15rem;
    color: var(--text-dark);
    padding: 24px 28px 16px
}

.map-embed {
    flex: 1;
    min-height: 260px;
    background: #e8efe9;
    position: relative;
    overflow: hidden
}

.map-embed iframe {
    width: 100%;
    height: 100%;
    border: none;
    display: block
}

.map-location-label {
    padding: 16px 28px 24px;
    display: flex;
    align-items: center;
    gap: 10px
}

.map-loc-icon {
    width: 30px;
    height: 30px;
    background: #f0f5f1;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0
}

.map-loc-icon svg {
    width: 15px;
    height: 15px;
    fill: var(--cta)
}

.map-location-label span {
    font-size: 0.85rem;
    color: var(--text-mid);
    font-weight: 500
}

/* BANTUAN */
.bantuan-section {
    padding: 0 64px 56px
}

.bantuan-box {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 36px 48px;
    display: flex;
    align-items: center;
    gap: 40px
}

.bantuan-image img {
    width: 140px;
    object-fit: contain
}

.bantuan-text {
    flex: 1
}

.bantuan-text h3 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.25rem;
    color: var(--text-dark);
    margin-bottom: 8px
}

.bantuan-text p {
    font-size: 0.88rem;
    color: var(--text-mid);
    line-height: 1.7;
    margin-bottom: 20px
}

.bantuan-btns {
    display: flex;
    gap: 12px;
    flex-wrap: wrap
}

.btn-wa {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 24px;
    background: var(--cta);
    color: #fff;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 700;
    font-size: 0.88rem;
    text-decoration: none;
    transition: background 0.2s
}

.btn-wa:hover {
    background: var(--cta-hover)
}

.btn-wa svg {
    width: 16px;
    height: 16px;
    fill: #fff
}

.btn-email {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 24px;
    background: transparent;
    color: var(--cta);
    border: 1.5px solid var(--cta);
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 700;
    font-size: 0.88rem;
    text-decoration: none;
    transition: all 0.2s
}

.btn-email:hover {
    background: var(--cta);
    color: #fff
}

.btn-email svg {
    width: 16px;
    height: 16px;
    fill: var(--cta);
    transition: fill 0.2s
}

.btn-email:hover svg {
    fill: #fff
}

@media(max-width:768px) {
    .hero-hubungi {
        grid-template-columns: 1fr;
        padding: 36px 20px;
        text-align: center
    }

    .cara-section,
    .faq-map-section,
    .bantuan-section {
        padding: 0 20px 32px
    }

    .cara-grid {
        grid-template-columns: 1fr
    }

    .faq-map-section {
        grid-template-columns: 1fr
    }

    .bantuan-box {
        flex-direction: column;
        text-align: center;
        padding: 28px 20px
    }
}
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="hero-hubungi">
    <div class="hero-hubungi-text">
        <div class="hero-badge">Kami Siap Membantu</div>
        <h1>Hubungi Kami</h1>
        <p>Punya pertanyaan atau butuh bantuan? Kami siap membantu Anda kapan saja.</p>
    </div>
    <div class="hero-hubungi-image">
        <img src="{{ asset('Ilustrasi Hubungi Kami.png') }}" alt="Ilustrasi Hubungi Kami">
    </div>
</section>

{{-- CARA MENGHUBUNGI --}}
<section class="cara-section">
    <div class="section-title-center">
        <div class="divider-row">
            <h2>Cara Menghubungi Kami</h2>
        </div>
    </div>
    <div class="cara-grid">
        <div class="cara-card">
            <div class="cara-icon">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                </svg>
            </div>
            <h4>Alamat</h4>
            <p>Banyuwangi, Jawa Timur<br>Indonesia</p>
        </div>
        <div class="cara-card">
            <div class="cara-icon">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                </svg>
            </div>
            <h4>Telepon</h4>
            <p>0822-6467-6843<br>(08.00 - 20.00 WIB)</p>
        </div>
        <div class="cara-card">
            <div class="cara-icon">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                </svg>
            </div>
            <h4>Email</h4>
            <p><br>support@kosinaja.id</p>
        </div>
    </div>
</section>

{{-- FAQ + MAP --}}
<div class="faq-map-section">

    {{-- FAQ --}}
    <div class="faq-box">
        <h3>Pertanyaan yang Sering Ditanya</h3>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">
                <span>Bagaimana cara mencari kos di KosinAja?</span>
                <div class="faq-icon"><svg viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z" />
                    </svg></div>
            </button>
            <div class="faq-answer">
                <p>Klik tombol "Jelajahi Sekarang" di halaman beranda, lalu gunakan filter kota, harga, dan fasilitas
                    untuk menemukan kos yang sesuai kebutuhanmu.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">
                <span>Apakah mendaftar di KosinAja gratis?</span>
                <div class="faq-icon"><svg viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z" />
                    </svg></div>
            </button>
            <div class="faq-answer">
                <p>Ya, mendaftar sebagai penghuni sepenuhnya gratis. Kamu bisa langsung membuat akun dan mulai mencari
                    kos tanpa biaya apapun.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">
                <span>Bagaimana cara mendaftarkan kos saya?</span>
                <div class="faq-icon"><svg viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z" />
                    </svg></div>
            </button>
            <div class="faq-answer">
                <p>Daftar sebagai Admin/Owner, lalu masuk ke dashboard dan klik "Tambah Kos". Isi detail kos seperti
                    nama, alamat, harga, fasilitas, dan foto.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">
                <span>Apakah bisa survey kos sebelum menyewa?</span>
                <div class="faq-icon"><svg viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z" />
                    </svg></div>
            </button>
            <div class="faq-answer">
                <p>Tentu bisa. Kamu bisa menghubungi pemilik kos langsung melalui kontak yang tersedia di halaman detail
                    kos untuk mengatur jadwal survey.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">
                <span>Bagaimana jika kos tidak sesuai deskripsi?</span>
                <div class="faq-icon"><svg viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z" />
                    </svg></div>
            </button>
            <div class="faq-answer">
                <p>Segera hubungi tim KosinAja melalui WhatsApp atau email. Kami akan menindaklanjuti laporan kamu dan
                    membantu menyelesaikan masalah tersebut.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">
                <span>Apakah data saya aman di KosinAja?</span>
                <div class="faq-icon"><svg viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z" />
                    </svg></div>
            </button>
            <div class="faq-answer">
                <p>Ya, kami menjaga keamanan data pengguna dengan serius. Data pribadimu tidak akan dibagikan kepada
                    pihak ketiga tanpa izin.</p>
            </div>
        </div>

    </div>

    {{-- MAP --}}
    <div class="map-box">
        <h3>Lokasi Kami</h3>
        <div class="map-embed">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126220.11088888127!2d114.27890!3d-8.21946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd159b47c81bf45%3A0xf7990bde7d64a8b2!2sBanyuwangi%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1690000000000!5m2!1sid!2sid"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="map-location-label">
            <div class="map-loc-icon">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                </svg>
            </div>
            <span>Banyuwangi, Jawa Timur<br>Indonesia</span>
        </div>
    </div>

</div>

{{-- BANTUAN WHATSAPP --}}
<section class="bantuan-section">
    <div class="bantuan-box">
        <div class="bantuan-image">
            <img src="{{ asset('Ilustrasi WhatsApp.png') }}" alt="Ilustrasi WhatsApp">
        </div>
        <div class="bantuan-text">
            <h3>Masih butuh bantuan?</h3>
            <p>Hubungi kami melalui WhatsApp atau email, kami akan merespons secepat mungkin.</p>
            <div class="bantuan-btns">
                <a href="https://wa.me/6282264676843" class="btn-wa" target="_blank">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    Chat WhatsApp
                </a>
                <a href="mailto:admin@kosinaja.id" class="btn-email">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                    </svg>
                    Kirim Email
                </a>
            </div>
        </div>
    </div>
</section>

<script>
function toggleFaq(btn) {
    const item = btn.parentElement;
    const answer = item.querySelector('.faq-answer');
    const isOpen = item.classList.contains('open');

    // tutup semua
    document.querySelectorAll('.faq-item.open').forEach(el => {
        el.classList.remove('open');
        el.querySelector('.faq-answer').style.maxHeight = '0';
    });

    // buka yang diklik kalau belum open
    if (!isOpen) {
        item.classList.add('open');
        answer.style.maxHeight = answer.scrollHeight + 'px';
    }
}
</script>

@endsection