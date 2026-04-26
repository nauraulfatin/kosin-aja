<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KosinAja! - Cari Kos Jadi Lebih Mudah</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
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
        --badge-premium: #7CA385;
        --badge-favorit: #f5a623;
        --star: #f5a623;
    }

    body {
        font-family: 'DM Sans', sans-serif;
        background-color: var(--bg);
        color: var(--text-dark);
        overflow-x: hidden;
    }

    /* ───── NAVBAR ───── */
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
        backdrop-filter: blur(8px);
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .nav-logo img {
        width: 36px;
        height: 36px;
        object-fit: contain;
    }

    .nav-logo span {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.25rem;
        color: var(--text-dark);
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 36px;
        list-style: none;
    }

    .nav-links a {
        text-decoration: none;
        color: var(--text-mid);
        font-size: 0.95rem;
        font-weight: 500;
        transition: color 0.2s;
    }

    .nav-links a:hover {
        color: var(--cta);
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 12px;
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
        transition: all 0.2s;
    }

    .btn-outline:hover {
        background: var(--cta);
        color: #fff;
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
        transition: background 0.2s;
    }

    .btn-primary:hover {
        background: var(--cta-hover);
    }

    /* ───── HERO ───── */
    .hero {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        align-items: center;
        gap: 40px;
        padding: 40px 64px 48px;
        min-height: 580px;
        position: relative;
        overflow: hidden;
    }

    /* decorative blobs */
    .hero::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(124, 163, 133, 0.12) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
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
        pointer-events: none;
    }

    .hero-text {
        position: relative;
        z-index: 2;
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
        margin-bottom: 20px;
    }

    .hero-badge span {
        font-size: 1rem;
    }

    .hero-text h1 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: clamp(2rem, 3.5vw, 3rem);
        line-height: 1.15;
        color: var(--text-dark);
        margin-bottom: 16px;
    }

    .hero-text h1 em {
        font-style: normal;
        color: var(--cta);
        position: relative;
    }

    .hero-text p {
        font-size: 1rem;
        color: var(--text-mid);
        line-height: 1.7;
        max-width: 380px;
        margin-bottom: 28px;
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
        box-shadow: 0 4px 16px rgba(124, 163, 133, 0.1);
    }

    .hero-search input {
        flex: 1;
        border: none;
        outline: none;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        background: transparent;
        color: var(--text-dark);
    }

    .hero-search input::placeholder {
        color: var(--text-light);
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
        transition: background 0.2s;
    }

    .hero-search button:hover {
        background: var(--cta-hover);
    }

    .hero-stats {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
    }

    .hero-stat {
        display: flex;
        flex-direction: column;
    }

    .hero-stat strong {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.3rem;
        color: var(--text-dark);
    }

    .hero-stat span {
        font-size: 0.78rem;
        color: var(--text-light);
    }

    .hero-stat-divider {
        width: 1px;
        height: 36px;
        background: var(--border);
        align-self: center;
    }

    .hero-image {
        display: flex;
        justify-content: flex-end;
        position: relative;
        z-index: 2;
    }

    .hero-image img {
        max-width: 100%;
        max-height: 560px;
        width: 100%;
        object-fit: contain;
        animation: float 4s ease-in-out infinite;
    }

    /* floating cards on hero image */
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
        animation: floatCard 3s ease-in-out infinite;
    }

    .hero-float-card.card-1 {
        top: 60px;
        left: -10px;
        animation-delay: 0s;
    }

    .hero-float-card.card-2 {
        bottom: 100px;
        left: -20px;
        animation-delay: 1.5s;
    }

    @keyframes floatCard {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-8px);
        }
    }

    .float-icon {
        width: 36px;
        height: 36px;
        background: #f0f5f1;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .float-icon svg {
        width: 18px;
        height: 18px;
        fill: var(--cta);
    }

    .float-text strong {
        display: block;
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .float-text span {
        font-size: 0.75rem;
        color: var(--text-light);
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-14px);
        }
    }

    /* ───── REKOMENDASI KOS ───── */
    .section {
        padding: 56px 64px;
    }

    .section-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 32px;
    }

    .section-header .left h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.45rem;
        color: var(--text-dark);
    }

    .section-header .left p {
        font-size: 0.88rem;
        color: var(--text-light);
        margin-top: 4px;
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
        transition: all 0.2s;
    }

    .btn-lihat-semua:hover {
        border-color: var(--cta);
        color: var(--cta);
    }

    .kos-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .kos-card {
        background: var(--card-bg);
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
    }

    .kos-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(124, 163, 133, 0.15);
    }

    .kos-thumb {
        position: relative;
        height: 160px;
        overflow: hidden;
    }

    .kos-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }

    .kos-card:hover .kos-thumb img {
        transform: scale(1.05);
    }

    .kos-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
        color: #fff;
    }

    .badge-premium {
        background: var(--badge-premium);
    }

    .badge-favorit {
        background: var(--badge-favorit);
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
        border: none;
    }

    .kos-body {
        padding: 14px 14px 6px;
    }

    .kos-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.98rem;
        color: var(--text-dark);
    }

    .kos-loc {
        font-size: 0.78rem;
        color: var(--text-light);
        margin: 3px 0 6px;
    }

    .kos-rating {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.78rem;
        color: var(--text-mid);
    }

    .kos-rating .star {
        color: var(--star);
        font-weight: 700;
    }

    .kos-price {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.05rem;
        color: var(--cta);
        margin: 10px 0 6px;
    }

    .kos-price span {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 0.78rem;
        color: var(--text-light);
    }

    .kos-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin: 8px 0;
    }

    .kos-tag {
        padding: 3px 8px;
        background: #f0f5f1;
        border-radius: 6px;
        font-size: 0.72rem;
        color: var(--text-mid);
        font-weight: 500;
    }

    .kos-info {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: var(--text-light);
        margin: 6px 0;
    }

    .kos-actions {
        display: flex;
        gap: 8px;
        padding: 10px 14px 14px;
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
        transition: all 0.2s;
    }

    .btn-detail:hover {
        border-color: var(--cta);
        color: var(--cta);
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
        transition: background 0.2s;
    }

    .btn-hubungi:hover {
        background: var(--cta-hover);
    }

    /* ───── FASILITAS POPULER ───── */
    .two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        padding: 0 64px 56px;
    }

    .feature-box {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 36px;
    }

    .feature-box h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.4rem;
        margin-bottom: 8px;
    }

    .feature-box .sub {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-bottom: 28px;
    }

    .facility-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 24px;
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
        cursor: pointer;
    }

    .facility-item:hover {
        background: #e8f0ea;
        transform: translateY(-2px);
    }

    .facility-item .fac-icon {
        width: 36px;
        height: 36px;
        background: var(--cta);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .facility-item .fac-icon svg {
        width: 18px;
        height: 18px;
        fill: #fff;
    }

    .facility-cta-bar {
        background: var(--cta);
        border-radius: 14px;
        padding: 16px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #fff;
    }

    .facility-cta-bar span {
        font-size: 0.9rem;
        font-weight: 500;
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
        transition: opacity 0.2s;
    }

    .facility-cta-bar button:hover {
        opacity: 0.9;
    }

    /* WHY BOX */
    .why-box {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 36px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .why-box h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.4rem;
        margin-bottom: 8px;
    }

    .why-box .sub {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-bottom: 28px;
    }

    .why-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
        margin-bottom: 28px;
    }

    .why-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .why-icon {
        width: 38px;
        height: 38px;
        background: #f0f5f1;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .why-icon svg {
        width: 18px;
        height: 18px;
        fill: var(--cta);
    }

    .why-item-text strong {
        display: block;
        font-size: 0.98rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 3px;
    }

    .why-item-text p {
        font-size: 0.82rem;
        color: var(--text-light);
        line-height: 1.6;
    }

    .why-house {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 8px;
        opacity: 0.12;
    }

    .why-house svg {
        width: 80px;
        height: 80px;
        fill: var(--cta);
    }

    /* ───── TESTIMONIAL ───── */
    .testimonial-section {
        padding: 0 64px 56px;
    }

    .testimonial-section h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.45rem;
        margin-bottom: 6px;
    }

    .testimonial-section .sub {
        font-size: 0.88rem;
        color: var(--text-light);
        margin-bottom: 28px;
    }

    .testi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .testi-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px;
    }

    .testi-quote {
        font-size: 2rem;
        color: var(--cta);
        opacity: 0.3;
        line-height: 1;
        margin-bottom: 10px;
    }

    .testi-card p {
        font-size: 0.88rem;
        color: var(--text-mid);
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .testi-user {
        display: flex;
        align-items: center;
        gap: 10px;
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
        font-size: 0.9rem;
    }

    .testi-name {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .testi-role {
        font-size: 0.75rem;
        color: var(--text-light);
    }

    /* ───── CTA BANNER ───── */
    .cta-banner {
        margin: 0 64px 56px;
        border-radius: 28px;
        overflow: hidden;
        position: relative;
        min-height: 400px;
    }

    .cta-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        inset: 0;
    }

    .cta-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(20, 40, 22, 0.82) 0%, rgba(20, 40, 22, 0.55) 100%);
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
        padding: 60px 40px;
    }

    .cta-content h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: clamp(1.6rem, 3vw, 2.4rem);
        color: #fff;
        margin-bottom: 12px;
    }

    .cta-content p {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.82);
        margin-bottom: 28px;
        max-width: 420px;
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
        transition: background 0.2s, transform 0.2s;
    }

    .btn-cta-white:hover {
        background: #5e8a68;
        transform: translateY(-2px);
    }

    /* ───── FOOTER ───── */
    footer {
        background: var(--bg);
        position: relative;
        overflow: hidden;
        border-top: 1px solid var(--border);
    }

    .footer-leaf {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: auto;
        display: block;
        opacity: 0.5;
        pointer-events: none;
    }

    .footer-inner {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 32px 64px 0;
    }

    .footer-top {
        display: grid;
        grid-template-columns: repeat(3, auto);
        /* ukuran mengikuti isi */
        justify-content: center;
        /* INI KUNCINYA */
        align-items: start;
        gap: 80px;
        /* jarak antar kolom */
        width: 100%;
        text-align: center;
    }

    .footer-col ul {
        align-items: center;
    }

    .contact-item {
        justify-content: center;
    }

    .footer-brand .logo-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .footer-brand .logo-row img {
        width: 34px;
        height: 34px;
        object-fit: contain;
    }

    .footer-brand .logo-row span {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.1rem;
        color: var(--text-dark);
    }

    .footer-brand p {
        font-size: 0.8rem;
        color: var(--text-light);
        line-height: 1.8;
        text-align: center;
    }

    .footer-col {
        text-align: center;
    }

    .footer-col h4 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 0.95rem;
        color: var(--text-dark);
        margin-bottom: 16px;
        text-align: center;
    }

    .footer-col ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: center;
    }

    .footer-col ul li a {
        font-size: 0.8rem;
        color: var(--text-light);
        text-decoration: none;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .footer-col ul li a:hover {
        color: var(--cta);
    }

    .footer-col ul li a::before {
        content: '▸';
        font-size: 0.75rem;
        color: var(--cta);
    }

    .contact-item {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 0.8rem;
        color: var(--text-light);
        margin-bottom: 12px;
        text-align: center;
    }

    .contact-icon {
        width: 26px;
        height: 26px;
        background: #f0f5f1;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .contact-icon svg {
        width: 13px;
        height: 13px;
        fill: var(--cta);
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
        z-index: 2;
        background: transparent;
        margin-top: 0;
    }

    /* ───── RESPONSIVE ───── */
    @media (max-width: 1024px) {
        nav {
            padding: 0 32px;
        }

        .hero {
            padding: 48px 32px;
        }

        .section {
            padding: 40px 32px;
        }

        .two-col,
        .testimonial-section {
            padding: 0 32px 40px;
        }

        .cta-banner {
            margin: 0 32px 40px;
        }

        .footer-inner {
            padding: 40px 32px 24px;
        }

        .kos-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        nav {
            padding: 0 20px;
        }

        .nav-links {
            display: none;
        }

        .hero {
            grid-template-columns: 1fr;
            padding: 36px 20px;
            text-align: center;
        }

        .hero-text p {
            max-width: 100%;
        }

        .hero-image {
            justify-content: center;
        }

        .section {
            padding: 32px 20px;
        }

        .two-col {
            grid-template-columns: 1fr;
            padding: 0 20px 32px;
        }

        .testi-grid {
            grid-template-columns: 1fr;
        }

        .kos-grid {
            grid-template-columns: 1fr;
        }

        .testimonial-section {
            padding: 0 20px 32px;
        }

        .cta-banner {
            margin: 0 20px 32px;
        }

        .footer-inner {
            padding: 32px 20px 20px;
        }

        .footer-top {
            grid-template-columns: 1fr;
            gap: 28px;
        }
    }
    </style>
</head>

<body>

    {{-- ───── NAVBAR ───── --}}
    <nav>
        <a href="/" class="nav-logo">
            <img src="{{ asset('logo.png') }}" alt="KosinAja Logo">
            <span>KosinAja!</span>
        </a>

        <ul class="nav-links">
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Hubungi Kami</a></li>
            <li><a href="#">Tentang Kami</a></li>

        </ul>

        <div class="nav-actions">
            <a href="#" class="btn-outline">Masuk</a>
            <a href="#" class="btn-primary">Daftar</a>
        </div>
    </nav>

    {{-- ───── HERO ───── --}}
    <section class="hero">
        <div class="hero-text">
            <div class="hero-badge">
                <span></span> #1 Platform Kos Terpercaya di Indonesia
            </div>
            <h1>Cari Kos Jadi <em>Lebih Mudah</em> & Nyaman</h1>
            <p>Jelajahi ribuan pilihan kos terbaik dan lihat detail lengkap sebelum memilih. Cepat, mudah, dan
                terpercaya.</p>

            <div class="hero-search">
                <input type="text" placeholder="Cari kos di kota atau daerah...">
                <button>Jelajahi Sekarang</button>
            </div>

            <div class="hero-stats">
                <div class="hero-stat">
                    <strong>2.400+</strong>
                    <span>Kos Tersedia</span>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat">
                    <strong>18 Kota</strong>
                    <span>Se-Indonesia</span>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat">
                    <strong>12K+</strong>
                    <span>Pengguna Aktif</span>
                </div>
            </div>
        </div>

        <div class="hero-image">
            <div class="hero-float-card card-1">
                <div class="float-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                    </svg>
                </div>
                <div class="float-text">
                    <strong>Terverifikasi</strong>
                    <span>Semua kos sudah dicek</span>
                </div>
            </div>

            <div class="hero-float-card card-2">
                <div class="float-icon">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5 14.5 7.62 14.5 9 13.38 11.5 12 11.5z" />
                    </svg>
                </div>
                <div class="float-text">
                    <strong>18+ Kota</strong>
                    <span>Se-Indonesia</span>
                </div>
            </div>

            <img src="{{ asset('hero.png') }}" alt="Ilustrasi Cari Kos">
        </div>
    </section>

    {{-- ───── REKOMENDASI KOS ───── --}}
    <section class="section">
        <div class="section-header">
            <div class="left">
                <h2>Rekomendasi Kos</h2>
                <p>Kos pilihan dengan fasilitas terbaik di berbagai kota</p>
            </div>
            <a href="#" class="btn-lihat-semua">Lihat Semua</a>
        </div>

        <div class="kos-grid">

            {{-- Card 1 --}}
            <div class="kos-card">
                <div class="kos-thumb">
                    <img src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=400&q=80" alt="Kost Mawar">
                    <span class="kos-badge badge-premium"></span>
                    <button class="kos-wish">♡</button>
                </div>
                <div class="kos-body">
                    <div class="kos-name">Kost Mawar</div>
                    <div class="kos-loc">Banyuwangi, Jawa Timur</div>
                    <div class="kos-rating">
                        <span class="star">★ 4.8</span>
                        <span>(124)</span>
                        <span>• 1.2 km dari Kampus</span>
                    </div>
                    <div class="kos-price">Rp 1.500.000 <span>/ bulan</span></div>
                    <div class="kos-tags">
                        <span class="kos-tag">AC</span>
                        <span class="kos-tag">WiFi</span>
                        <span class="kos-tag">KM Dalam</span>
                        <span class="kos-tag">Dapur</span>
                        <span class="kos-tag">+2</span>
                    </div>
                    <div class="kos-info">
                        <span> 5 Kamar Tersedia</span>
                        <span>Single</span>
                    </div>
                </div>
                <div class="kos-actions">
                    <a href="#" class="btn-detail">Lihat Detail</a>
                    <a href="#" class="btn-hubungi"> Hubungi</a>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="kos-card">
                <div class="kos-thumb">
                    <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=400&q=80"
                        alt="Kost Melati">
                    <span class="kos-badge badge-favorit"></span>
                    <button class="kos-wish">♡</button>
                </div>
                <div class="kos-body">
                    <div class="kos-name">Kost Melati</div>
                    <div class="kos-loc">Malang, Jawa Timur</div>
                    <div class="kos-rating">
                        <span class="star">★ 4.7</span>
                        <span>(98)</span>
                        <span>• 800 m dari Kampus</span>
                    </div>
                    <div class="kos-price">Rp 1.200.000 <span>/ bulan</span></div>
                    <div class="kos-tags">
                        <span class="kos-tag">WiFi</span>
                        <span class="kos-tag">KM Dalam</span>
                        <span class="kos-tag">Dapur</span>
                        <span class="kos-tag">Parkir</span>
                    </div>
                    <div class="kos-info">
                        <span> 3 Kamar Tersedia</span>
                        <span>Single</span>
                    </div>
                </div>
                <div class="kos-actions">
                    <a href="#" class="btn-detail">Lihat Detail</a>
                    <a href="#" class="btn-hubungi"> Hubungi</a>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="kos-card">
                <div class="kos-thumb">
                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&q=80"
                        alt="Kost Anggrek">
                    <span class="kos-badge badge-premium"></span>
                    <button class="kos-wish">♡</button>
                </div>
                <div class="kos-body">
                    <div class="kos-name">Kost Anggrek</div>
                    <div class="kos-loc">Surabaya, Jawa Timur</div>
                    <div class="kos-rating">
                        <span class="star">★ 4.9</span>
                        <span>(54)</span>
                        <span>• 1.5 km dari Kampus</span>
                    </div>
                    <div class="kos-price">Rp 1.600.000 <span>/ bulan</span></div>
                    <div class="kos-tags">
                        <span class="kos-tag">AC</span>
                        <span class="kos-tag">WiFi</span>
                        <span class="kos-tag">Laundry</span>
                        <span class="kos-tag">Parkir</span>
                        <span class="kos-tag">+1</span>
                    </div>
                    <div class="kos-info">
                        <span> 3 Kamar Tersedia</span>
                        <span>Single / Double</span>
                    </div>
                </div>
                <div class="kos-actions">
                    <a href="#" class="btn-detail">Lihat Detail</a>
                    <a href="#" class="btn-hubungi"> Hubungi</a>
                </div>
            </div>

            {{-- Card 4 --}}
            <div class="kos-card">
                <div class="kos-thumb">
                    <img src="https://images.unsplash.com/photo-1540518614846-7eded433c457?w=400&q=80"
                        alt="Kost Sakura">
                    <span class="kos-badge badge-favorit"></span>
                    <button class="kos-wish">♡</button>
                </div>
                <div class="kos-body">
                    <div class="kos-name">Kost Sakura</div>
                    <div class="kos-loc">Yogyakarta, DI Yogyakarta</div>
                    <div class="kos-rating">
                        <span class="star">★ 4.8</span>
                        <span>(87)</span>
                        <span>• 1.1 km dari Kampus</span>
                    </div>
                    <div class="kos-price">Rp 1.300.000 <span>/ bulan</span></div>
                    <div class="kos-tags">
                        <span class="kos-tag">WiFi</span>
                        <span class="kos-tag">KM Dalam</span>
                        <span class="kos-tag">CCTV</span>
                    </div>
                    <div class="kos-info">
                        <span> 4 Kamar Tersedia</span>
                        <span>Single</span>
                    </div>
                </div>
                <div class="kos-actions">
                    <a href="#" class="btn-detail">Lihat Detail</a>
                    <a href="#" class="btn-hubungi"> Hubungi</a>
                </div>
            </div>

        </div>
    </section>

    {{-- ───── FASILITAS POPULER + KENAPA KOSINAJA ───── --}}
    <div class="two-col">

        <div class="feature-box">
            <h3>Fasilitas Populer</h3>
            <p class="sub">Fasilitas lengkap untuk kehidupan yang nyaman</p>
            <div class="facility-grid">
                <div class="facility-item">
                    <div class="fac-icon"><svg viewBox="0 0 24 24">
                            <path d="M1 6l5 5 4-4 4 4 5-5M1 12l5 5 4-4 4 4 5-5" />
                        </svg></div>
                    WiFi
                </div>
                <div class="facility-item">
                    <div class="fac-icon"><svg viewBox="0 0 24 24">
                            <path
                                d="M9.5 2A2.5 2.5 0 0 1 12 4.5v15a2.5 2.5 0 0 1-5 0V4.5A2.5 2.5 0 0 1 9.5 2zM14.5 8A2.5 2.5 0 0 1 17 10.5v9a2.5 2.5 0 0 1-5 0v-9A2.5 2.5 0 0 1 14.5 8z" />
                        </svg></div>
                    AC
                </div>
                <div class="facility-item">
                    <div class="fac-icon"><svg viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7zm0 2a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5zm-2 13h4v1h-4v-1zm1 2h2v1h-2v-1z" />
                        </svg></div>
                    KM Dalam
                </div>
                <div class="facility-item">
                    <div class="fac-icon"><svg viewBox="0 0 24 24">
                            <path d="M3 2h18v2H3V2zm0 4h18v2H3V6zm2 4h14v10H5V10zm2 2v6h10v-6H7z" />
                        </svg></div>
                    Dapur
                </div>
                <div class="facility-item">
                    <div class="fac-icon"><svg viewBox="0 0 24 24">
                            <path
                                d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2zm0 2a8 8 0 1 1 0 16A8 8 0 0 1 12 4zm-1 3v6l5 3-1 1.73-6-3.73V7h2z" />
                        </svg></div>
                    CCTV
                </div>
                <div class="facility-item">
                    <div class="fac-icon"><svg viewBox="0 0 24 24">
                            <path
                                d="M18 2.01L6 2c-1.1 0-2 .89-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.11-.9-1.99-2-1.99zM18 20H6v-9.02h12V20zm0-11H6V4h12v5zM9 5H7v3h2V5zm8 0h-2v3h2V5zM9 12H7v5h2v-5zm4 0h-2v5h2v-5zm4 0h-2v5h2v-5z" />
                        </svg></div>
                    Laundry
                </div>
                <div class="facility-item">
                    <div class="fac-icon"><svg viewBox="0 0 24 24">
                            <path
                                d="M19 9h-2V7h-2v2H9V7H7v2H5c-1.1 0-2 .9-2 2v9c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-9c0-1.1-.9-2-2-2zm0 11H5v-9h14v9zM7 13h10v2H7v-2zm0 4h7v2H7v-2z" />
                        </svg></div>
                    Parkir
                </div>
                <div class="facility-item">
                    <div class="fac-icon"><svg viewBox="0 0 24 24">
                            <path d="M2 20h20v2H2v-2zM6 3v14h2V3H6zm6 2v12h2V5h-2zm6 4v8h2V9h-2z" />
                        </svg></div>
                    Kolam
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
                        <div class="why-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                            </svg>
                        </div>
                        <div class="why-item-text">
                            <strong>Pilihan Kos Terpercaya</strong>
                            <p>Semua kos sudah terverifikasi dengan ketat oleh tim kami.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-icon">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11zM8 15h8v2H8v-2zm0-4h8v2H8v-2z" />
                            </svg>
                        </div>
                        <div class="why-item-text">
                            <strong>Informasi Lengkap & Transparan</strong>
                            <p>Foto asli, harga jelas, dan fasilitas lengkap tanpa biaya tersembunyi.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-icon">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M13 2.05v2.02c3.95.49 7 3.85 7 7.93 0 3.21-1.81 6-4.72 7.72L13 17v5h5l-1.22-1.22C19.91 19.07 22 15.76 22 12c0-5.18-3.95-9.45-9-9.95zM11 2.05C5.95 2.55 2 6.82 2 12c0 3.76 2.09 7.07 5.22 8.78L6 22h5v-5l-2.28 2.28C7.28 18.06 6 15.17 6 12c0-4.08 3.05-7.44 7-7.93V2.05z" />
                            </svg>
                        </div>
                        <div class="why-item-text">
                            <strong>Proses Mudah & Cepat</strong>
                            <p>Temukan dan hubungi pemilik kos hanya dalam beberapa klik.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-icon">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 2.18l7 3.12V11c0 4.52-3.03 8.76-7 9.93-3.97-1.17-7-5.41-7-9.93V6.3l7-3.12zm-1 5.82v6h2v-6h-2zm0-4v2h2V5h-2z" />
                            </svg>
                        </div>
                        <div class="why-item-text">
                            <strong>Aman & Terjamin</strong>
                            <p>Privasi data Anda aman bersama kami. Transaksi terproteksi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="why-house">
                <svg viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
            </div>
        </div>

    </div>

    {{-- ───── TESTIMONIAL ───── --}}
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
                <p>Cari kos jadi sangat mudah! Informasi lengkap dan bisa langsung kontak pemilik dengan cepat dan aman.
                </p>
                <div class="testi-user">
                    <div class="testi-avatar">A</div>
                    <div>
                        <div class="testi-name">AndiPratama</div>
                        <div class="testi-role">Mahasiswa</div>
                    </div>
                </div>
            </div>

            <div class="testi-card">
                <div class="testi-quote">"</div>
                <p>Platform terbaik untuk para pencari kos. Pas buat saya yang punya keterbatasan waktu. Highly
                    recommended!</p>
                <div class="testi-user">
                    <div class="testi-avatar">R</div>
                    <div>
                        <div class="testi-name">RisaMartha</div>
                        <div class="testi-role">Karyawan</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ───── CTA BANNER ───── --}}
    <div class="cta-banner">
        <img src="{{ asset('why.png') }}" alt="Kelola Kos">
        <div class="cta-overlay"></div>
        <div class="cta-content">
            <h2>Punya kos? Kelola di KosinAja!</h2>
            <p>Daftarkan dan Kelola Kos Anda dengan Mudah dan Praktis</p>
            <a href="#" class="btn-cta-white">DAFTAR</a>
        </div>
    </div>

    {{-- ───── FOOTER ───── --}}
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
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Tentang Kami</a></li>
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
                        Hello@Email.com
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                            </svg>
                        </div>
                        ( +62 ) 82264676843
                    </div>
                </div>

            </div>
        </div>

        <div class="footer-bottom">
            COPYRIGHT ORBIT
        </div>
    </footer>

</body>

</html>