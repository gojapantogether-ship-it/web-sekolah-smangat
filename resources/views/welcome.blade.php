@extends('layouts.app')

@section('title', 'Home - ' . $profile->nama_sekolah)

@section('main-class', 'welcome-main')

@push('styles')
<style>
    .welcome-main {
        width: 100%;
    }

    /* ========== Keyframes: Zoom In & Zoom Out ========== */
    @keyframes ambientZoomPulse {
        0%, 100% {
            transform: scale(1) translate(0, 0);
        }
        50% {
            transform: scale(1.14) translate(10px, -10px);
        }
    }

    @keyframes ambientZoomReverse {
        0%, 100% {
            transform: scale(1.1) translate(0, 0);
        }
        50% {
            transform: scale(0.92) translate(-12px, 12px);
        }
    }

    @keyframes heroZoomIn {
        0% {
            opacity: 0;
            transform: scale(0.92);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes iconBreathingZoom {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.08);
        }
    }

    @keyframes heroBgZoom {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }

    /* Scroll-triggered Zoom In & Zoom Out */
    .zoom-reveal {
        opacity: 0;
        transform: scale(0.9);
        transition: opacity 0.65s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.65s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .zoom-reveal.in-view {
        opacity: 1;
        transform: scale(1);
    }

    .zoom-out-reveal {
        opacity: 0;
        transform: scale(1.08);
        transition: opacity 0.65s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.65s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .zoom-out-reveal.in-view {
        opacity: 1;
        transform: scale(1);
    }

    /* ========== Hero Section (Hijau Toska + Background Foto Sekolah) ========== */
    .hero-toska {
        position: relative;
        overflow: hidden;
        background: var(--toska-950);
        color: #fff;
        padding: clamp(56px, 9vw, 110px) 20px clamp(64px, 10vw, 118px);
    }

    .hero-bg-photo,
    .hero-bg-slide {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        animation: heroBgZoom 18s ease-in-out infinite;
        z-index: 0;
        will-change: transform, opacity;
        transition: opacity 1.4s ease-in-out;
        opacity: 0;
    }

    .hero-bg-slide.active {
        opacity: 1;
    }

    .hero-bg-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(15, 23, 42, 0.72) 0%,
            rgba(15, 23, 42, 0.62) 50%,
            rgba(4, 47, 46, 0.78) 100%
        );
        z-index: 1;
    }

    .hero-orb {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        filter: blur(2px);
        z-index: 1;
    }

    .hero-orb-1 {
        width: 360px;
        height: 360px;
        top: -100px;
        right: -80px;
        background: radial-gradient(circle, rgba(45, 212, 191, 0.32) 0%, rgba(45, 212, 191, 0) 70%);
        animation: ambientZoomPulse 9s ease-in-out infinite;
    }

    .hero-orb-2 {
        width: 280px;
        height: 280px;
        bottom: -90px;
        left: -60px;
        background: radial-gradient(circle, rgba(153, 246, 228, 0.22) 0%, rgba(153, 246, 228, 0) 70%);
        animation: ambientZoomReverse 11s ease-in-out infinite;
    }

    .hero-orb-ring {
        width: 480px;
        height: 480px;
        top: 50%;
        right: 6%;
        margin-top: -240px;
        border: 1px solid rgba(153, 246, 228, 0.16);
        animation: ambientZoomPulse 12s ease-in-out infinite;
    }

    .hero-inner {
        position: relative;
        z-index: 2;
        max-width: 1140px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1.3fr 0.7fr;
        gap: 36px;
        align-items: center;
        animation: heroZoomIn 0.75s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }

    .hero-main-col {
        text-align: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.55);
        border: 1px solid rgba(251, 191, 36, 0.45);
        color: var(--gold-100);
        font-size: 0.84rem;
        font-weight: 600;
        margin-bottom: 18px;
        backdrop-filter: blur(8px);
    }

    .hero-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--gold-400);
        animation: iconBreathingZoom 2s ease-in-out infinite;
    }

    .hero-title {
        font-family: 'Merriweather', Georgia, serif;
        font-size: clamp(2rem, 4.4vw, 3.25rem);
        line-height: 1.22;
        font-weight: 900;
        margin: 0 0 14px;
        letter-spacing: -0.015em;
        text-shadow: 0 4px 18px rgba(0, 0, 0, 0.45);
    }

    .hero-accent {
        color: var(--toska-400);
    }

    .hero-subjudul {
        font-size: clamp(1rem, 1.6vw, 1.15rem);
        font-weight: 600;
        color: #f8fafc;
        margin: 0 auto 10px;
        max-width: 620px;
    }

    .hero-desc {
        font-size: clamp(0.92rem, 1.4vw, 1.02rem);
        color: rgba(226, 232, 240, 0.9);
        margin: 0 auto 28px;
        white-space: pre-line;
        max-width: 620px;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
    }

    .btn-hero-primary,
    .btn-hero-glass {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px 24px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 0.92rem;
        letter-spacing: 0.02em;
        text-decoration: none;
        transition: transform 0.28s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.28s ease,
                    background 0.28s ease;
        min-height: 46px;
    }

    .btn-hero-primary {
        background: linear-gradient(135deg, var(--gold-400), var(--gold-500));
        color: var(--navy-950);
        box-shadow: 0 10px 26px rgba(245, 158, 11, 0.35);
    }

    .btn-hero-primary:hover {
        transform: scale(1.06) translateY(-2px);
        box-shadow: 0 14px 32px rgba(245, 158, 11, 0.48);
    }

    .btn-hero-primary:active {
        transform: scale(0.97);
    }

    .btn-hero-glass {
        background: rgba(255, 255, 255, 0.14);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.32);
        backdrop-filter: blur(8px);
    }

    .btn-hero-glass:hover {
        background: rgba(255, 255, 255, 0.24);
        transform: scale(1.05) translateY(-2px);
    }

    .btn-hero-glass:active {
        transform: scale(0.97);
    }

    /* Hero Right Summary Card */
    .hero-side-card {
        background: rgba(255, 255, 255, 0.11);
        border: 1px solid rgba(153, 246, 228, 0.28);
        border-radius: 22px;
        padding: 24px;
        backdrop-filter: blur(12px);
        box-shadow: 0 20px 40px rgba(4, 47, 46, 0.28);
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .hero-side-card:hover {
        transform: scale(1.03);
    }

    .hero-side-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--toska-200);
        font-weight: 700;
        margin-bottom: 14px;
    }

    .hero-mini-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 16px;
    }

    .hero-mini-box {
        background: rgba(4, 47, 46, 0.35);
        border: 1px solid rgba(153, 246, 228, 0.2);
        border-radius: 14px;
        padding: 14px;
        text-align: center;
        transition: transform 0.25s ease;
    }

    .hero-mini-box:hover {
        transform: scale(1.05);
    }

    .hero-mini-box strong {
        display: block;
        font-size: 1.7rem;
        line-height: 1.1;
        color: #fff;
    }

    .hero-mini-box span {
        font-size: 0.82rem;
        color: var(--toska-200);
    }

    .hero-side-info {
        font-size: 0.88rem;
        color: var(--toska-100);
        margin: 0;
        line-height: 1.5;
    }

    /* ========== Content Sections ========== */
    .section-wrap {
        max-width: 1140px;
        margin: 0 auto;
        padding: 52px 20px 0;
    }

    .section-head {
        text-align: center;
        max-width: 640px;
        margin: 0 auto 32px;
    }

    .section-kicker {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 999px;
        background: var(--toska-100);
        color: var(--toska-800);
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .section-title {
        font-size: clamp(1.45rem, 2.8vw, 2.05rem);
        font-weight: 800;
        color: var(--text-dark);
        margin: 0 0 8px;
        letter-spacing: -0.02em;
    }

    .section-subtitle {
        color: var(--text-muted);
        margin: 0;
        font-size: 0.98rem;
    }

    /* ========== Interactive Menu Cards (Zoom In / Zoom Out) ========== */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .menu-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 26px;
        text-decoration: none;
        color: inherit;
        box-shadow: var(--shadow-sm);
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.35s ease,
                    border-color 0.35s ease;
        position: relative;
        overflow: hidden;
    }

    .menu-card::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(20, 184, 166, 0.08), rgba(15, 118, 110, 0.02));
        opacity: 0;
        transition: opacity 0.35s ease;
        pointer-events: none;
    }

    .menu-card:hover {
        transform: scale(1.04) translateY(-6px);
        box-shadow: var(--shadow-md);
        border-color: var(--toska-400);
    }

    .menu-card:hover::after {
        opacity: 1;
    }

    .menu-card:active {
        transform: scale(0.98);
    }

    .menu-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--toska-100), var(--toska-50));
        color: var(--toska-700);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        transition: transform 0.35s ease, background 0.35s ease, color 0.35s ease;
    }

    .menu-card:hover .menu-icon {
        transform: scale(1.12);
        background: linear-gradient(135deg, var(--toska-600), var(--toska-500));
        color: #fff;
    }

    .menu-card h3 {
        margin: 0 0 8px;
        font-size: 1.18rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .menu-card p {
        margin: 0 0 18px;
        color: var(--text-muted);
        font-size: 0.94rem;
    }

    .menu-card-cta {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        font-size: 0.92rem;
        color: var(--toska-700);
        transition: gap 0.25s ease;
    }

    .menu-card:hover .menu-card-cta {
        gap: 10px;
    }

    /* ========== Statistik Guru & Siswa ========== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 22px;
    }

    .stat-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid var(--border);
        border-top: 4px solid var(--toska-600);
        border-radius: 22px;
        padding: 28px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: var(--shadow-sm);
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s ease;
        cursor: default;
    }

    .stat-card.stat-gold {
        border-top-color: var(--gold-500);
    }

    .stat-card:hover {
        transform: scale(1.03);
        box-shadow: var(--shadow-md);
    }

    .stat-icon-wrap {
        width: 68px;
        height: 68px;
        border-radius: 18px;
        background: linear-gradient(135deg, var(--toska-600), var(--navy-900));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.22);
        animation: iconBreathingZoom 4s ease-in-out infinite;
    }

    .stat-card.stat-gold .stat-icon-wrap {
        background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
        box-shadow: 0 10px 22px rgba(245, 158, 11, 0.28);
    }

    .stat-label {
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--toska-800);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin: 0 0 4px;
    }

    .stat-number {
        font-size: clamp(2rem, 4vw, 2.75rem);
        font-weight: 800;
        line-height: 1.1;
        color: var(--toska-950);
        margin: 0;
    }

    .stat-note {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin: 4px 0 0;
    }

    /* ========== Spotlight Kepala Sekolah ========== */
    .principal-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 22px;
        padding: 28px;
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 26px;
        align-items: center;
        box-shadow: var(--shadow-sm);
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }

    .principal-card:hover {
        transform: scale(1.015);
        box-shadow: var(--shadow-md);
    }

    .principal-photo-wrap {
        width: 120px;
        height: 120px;
        border-radius: 20px;
        overflow: hidden;
        border: 3px solid var(--toska-200);
        background: linear-gradient(135deg, var(--toska-100), var(--toska-50));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--toska-700);
        font-weight: 800;
        font-size: 2rem;
        flex-shrink: 0;
    }

    .principal-photo-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.45s ease;
    }

    .principal-card:hover .principal-photo-wrap img {
        transform: scale(1.1);
    }

    /* ========== Kontak Resmi Sekolah ========== */
    .contact-panel {
        background: linear-gradient(135deg, var(--navy-950) 0%, var(--navy-900) 55%, var(--toska-900) 100%);
        border-radius: 24px;
        padding: clamp(28px, 4vw, 44px);
        color: #fff;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
        border-top: 4px solid var(--gold-500);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-top: 24px;
        position: relative;
        z-index: 2;
    }

    .contact-item {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(153, 246, 228, 0.24);
        border-radius: 16px;
        padding: 18px;
        backdrop-filter: blur(8px);
        transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1), background 0.3s ease;
    }

    .contact-item:hover {
        transform: scale(1.04) translateY(-4px);
        background: rgba(255, 255, 255, 0.16);
    }

    .contact-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: rgba(45, 212, 191, 0.22);
        color: var(--toska-200);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
    }

    .contact-item h4 {
        margin: 0 0 4px;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--toska-200);
    }

    .contact-item p {
        margin: 0;
        font-size: 0.96rem;
        font-weight: 600;
        color: #fff;
        word-break: break-word;
    }

    @media (max-width: 960px) {
        .contact-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 540px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }

    /* ========== Responsive Breakpoints (HP & Tablet) ========== */
    @media (max-width: 1024px) {
        .menu-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 900px) {
        .hero-inner {
            grid-template-columns: 1fr;
        }

        .menu-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .principal-card {
            grid-template-columns: 1fr;
            text-align: center;
            justify-items: center;
        }

        .hero-actions {
            flex-direction: column;
        }

        .btn-hero-primary,
        .btn-hero-glass {
            width: 100%;
        }
    }

    /* Aksesibilitas: hormati preferensi reduced motion */
    @media (prefers-reduced-motion: reduce) {
        .hero-bg-photo,
        .hero-orb-1,
        .hero-orb-2,
        .hero-orb-ring,
        .hero-dot,
        .stat-icon-wrap {
            animation: none !important;
        }

        .zoom-reveal,
        .zoom-out-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
    }
</style>
@endpush

@section('content')
    {{-- HERO SAMBUTAN SEKOLAH --}}
    <section class="hero-toska">
        @if (isset($heroSlides) && $heroSlides->isNotEmpty())
            @foreach ($heroSlides as $idx => $slide)
                <div class="hero-bg-slide {{ $idx === 0 ? 'active' : '' }}"
                     style="background-image: url('{{ asset('storage/' . $slide->gambar) }}');"
                     aria-hidden="true"></div>
            @endforeach
        @else
            <div class="hero-bg-slide active"
                 style="background-image: url('{{ asset('images/school-hero.jpg') }}');"
                 aria-hidden="true"></div>
        @endif
        <div class="hero-bg-overlay" aria-hidden="true"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-orb hero-orb-ring"></div>

        <div class="hero-inner">
            <div class="hero-main-col">
                <div class="hero-badge" style="gap: 8px; display: inline-flex; align-items: center;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo {{ $profile->nama_sekolah }}" style="width: 22px; height: 22px; object-fit: contain; filter: drop-shadow(0 1px 2px rgba(0,0,0,0.25));" onerror="this.style.display='none'">
                    Portal Resmi Sekolah
                </div>

                <h1 class="hero-title">
                    Selamat Datang<br>
                    di <span class="hero-accent">{{ $profile->nama_sekolah }}</span>
                </h1>
                <p class="hero-subjudul">{{ $profile->sambutan_judul }}</p>
                <p class="hero-desc">{{ $profile->sambutan_isi }}</p>

                <div class="hero-actions">
                    <a class="btn-hero-primary" href="{{ route('profil') }}">
                        SELENGKAPNYA
                    </a>
                    <a class="btn-hero-glass" href="{{ route('informasi') }}">
                        Informasi Sekolah
                    </a>
                    <a class="btn-hero-glass" href="{{ route('ppdb') }}">
                        Informasi PPDB
                    </a>
                    <a class="btn-hero-glass" href="{{ route('galeri') }}">
                        Galeri Foto
                    </a>
                </div>
            </div>

            <aside class="hero-side-card" aria-label="Ringkasan Data Sekolah">
                <div class="hero-side-label">Sekilas Data Sekolah</div>
                <div class="hero-mini-stats">
                    <div class="hero-mini-box">
                        <strong class="js-counter" data-target="{{ $profile->jumlah_guru }}">{{ $profile->jumlah_guru }}</strong>
                        <span>Guru</span>
                    </div>
                    <div class="hero-mini-box">
                        <strong class="js-counter" data-target="{{ $profile->jumlah_siswa }}">{{ $profile->jumlah_siswa }}</strong>
                        <span>Siswa</span>
                    </div>
                </div>
                <p class="hero-side-info">
                    @if ($profile->alamat)
                        <strong>Alamat:</strong> {{ $profile->alamat }}<br>
                    @endif
                    @if ($profile->kontak)
                        <strong>Kontak:</strong> {{ $profile->kontak }}
                    @endif
                </p>
            </aside>
        </div>
    </section>

    {{-- MENU UTAMA INTERAKTIF --}}
    <section class="section-wrap">
        <div class="section-head zoom-reveal">
            <span class="section-kicker">Akses Cepat</span>
            <h2 class="section-title">Jelajahi Informasi Sekolah</h2>
            <p class="section-subtitle">Pilih layanan informasi sekolah yang Anda butuhkan dengan cepat.</p>
        </div>

        <div class="menu-grid">
            <a href="{{ route('profil') }}" class="menu-card zoom-reveal">
                <div>
                    <div class="menu-icon" aria-hidden="true">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 21h18"></path>
                            <path d="M5 21V7l8-4v18"></path>
                            <path d="M19 21V11l-6-4"></path>
                        </svg>
                    </div>
                    <h3>Profil Sekolah &amp; Kepala Sekolah</h3>
                    <p>Kenali visi, misi, sejarah sekolah, serta profil pimpinan kepala sekolah kami.</p>
                </div>
                <span class="menu-card-cta">Lihat Profil &rarr;</span>
            </a>

            <a href="{{ route('informasi') }}" class="menu-card zoom-reveal" style="transition-delay: 0.06s;">
                <div>
                    <div class="menu-icon" aria-hidden="true">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                    <h3>Informasi &amp; Berita</h3>
                    <p>Pengumuman agenda penting, liputan kegiatan, dan kabar prestasi terkini sekolah.</p>
                </div>
                <span class="menu-card-cta">Buka Informasi &rarr;</span>
            </a>

            <a href="{{ route('ppdb') }}" class="menu-card zoom-reveal" style="transition-delay: 0.12s;">
                <div>
                    <div class="menu-icon" aria-hidden="true">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    </div>
                    <h3>Informasi PPDB</h3>
                    <p>Jadwal penerimaan peserta didik baru, persyaratan berkas, dan tautan pendaftaran terbaru.</p>
                </div>
                <span class="menu-card-cta">Cek Info PPDB &rarr;</span>
            </a>

            <a href="{{ route('galeri') }}" class="menu-card zoom-reveal" style="transition-delay: 0.16s;">
                <div>
                    <div class="menu-icon" aria-hidden="true">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </div>
                    <h3>Galeri Foto Sekolah</h3>
                    <p>Dokumentasi kegiatan siswa, prestasi, dan fasilitas lingkungan sekolah.</p>
                </div>
                <span class="menu-card-cta">Buka Galeri &rarr;</span>
            </a>
        </div>

        <div class="menu-grid" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); margin-top: 20px;">
            <a href="{{ route('guru') }}" class="menu-card zoom-reveal">
                <div>
                    <div class="menu-icon" aria-hidden="true">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3>Direktori Guru &amp; GTK</h3>
                    <p>Profil tenaga pendidik, wali kelas, dan staf tata usaha sekolah.</p>
                </div>
                <span class="menu-card-cta">Lihat Guru &amp; GTK &rarr;</span>
            </a>

            <a href="{{ route('ekstrakurikuler') }}" class="menu-card zoom-reveal" style="transition-delay: 0.08s;">
                <div>
                    <div class="menu-icon" aria-hidden="true">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                    </div>
                    <h3>Ekstrakurikuler</h3>
                    <p>Kegiatan pengembangan bakat, minat, olahraga, dan organisasi siswa.</p>
                </div>
                <span class="menu-card-cta">Lihat Ekskul &rarr;</span>
            </a>

            <a href="{{ route('prestasi') }}" class="menu-card zoom-reveal" style="transition-delay: 0.16s;">
                <div>
                    <div class="menu-icon" aria-hidden="true">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                        </svg>
                    </div>
                    <h3>Pojok Prestasi</h3>
                    <p>Deretan piala, medali, dan penghargaan siswa di berbagai tingkatan.</p>
                </div>
                <span class="menu-card-cta">Lihat Prestasi &rarr;</span>
            </a>
        </div>
    </section>

    {{-- INFORMASI TERBARU (DIKONTROL DARI ADMIN) --}}
    @if (isset($latestInfo) && $latestInfo->isNotEmpty())
        <section class="section-wrap">
            <div class="section-head zoom-reveal">
                <span class="section-kicker">Kabar Sekolah</span>
                <h2 class="section-title">Informasi &amp; Berita Terbaru</h2>
                <p class="section-subtitle">Pengumuman resmi, kegiatan, dan prestasi terkini yang dipublikasikan oleh pihak sekolah.</p>
            </div>

            <div class="menu-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));">
                @foreach ($latestInfo as $info)
                    <a href="{{ route('informasi.detail', $info->slug) }}" class="menu-card zoom-reveal" style="padding: 0; overflow: hidden;">
                        <div style="height: 180px; overflow: hidden; background: linear-gradient(135deg, var(--toska-100), var(--toska-50));">
                            @if ($info->gambar)
                                <img src="{{ asset('storage/' . $info->gambar) }}" alt="{{ $info->judul }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                            @else
                                <div style="height: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; color: var(--toska-700); font-weight: 700;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                    {{ $info->kategori }}
                                </div>
                            @endif
                        </div>
                        <div style="padding: 20px; display: flex; flex-direction: column; flex-grow: 1;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 0.78rem; font-weight: 700; background: var(--toska-100); color: var(--toska-800); padding: 2px 8px; border-radius: 999px;">
                                    {{ $info->kategori }}
                                </span>
                                <span style="font-size: 0.8rem; color: var(--text-muted);">
                                    {{ $info->tanggal_publikasi?->format('d M Y') ?? '-' }}
                                </span>
                            </div>
                            <h3 style="font-size: 1.1rem; line-height: 1.35; margin: 0 0 8px;">{{ $info->judul }}</h3>
                            <p style="font-size: 0.88rem; color: var(--text-muted); margin: 0 0 16px; flex-grow: 1;">
                                {{ $info->ringkasan ?: \Illuminate\Support\Str::limit(strip_tags($info->konten), 90) }}
                            </p>
                            <span class="menu-card-cta">Baca Selengkapnya &rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div style="text-align: center; margin-top: 28px;">
                <a href="{{ route('informasi') }}" class="btn">Lihat Semua Informasi &rarr;</a>
            </div>
        </section>
    @endif

    {{-- STATISTIK JUMLAH GURU & SISWA --}}
    <section class="section-wrap">
        <div class="section-head zoom-out-reveal">
            <span class="section-kicker">Statistik Terkini</span>
            <h2 class="section-title">Data Guru &amp; Siswa</h2>
            <p class="section-subtitle">Informasi jumlah pendidik dan peserta didik yang dikelola melalui dashboard admin.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card zoom-reveal">
                <div class="stat-icon-wrap" aria-hidden="true">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div>
                    <p class="stat-label">Jumlah Guru</p>
                    <p class="stat-number js-counter" data-target="{{ $profile->jumlah_guru }}">{{ $profile->jumlah_guru }}</p>
                    <p class="stat-note">Tenaga pendidik aktif</p>
                </div>
            </div>

            <div class="stat-card stat-gold zoom-reveal" style="transition-delay: 0.1s;">
                <div class="stat-icon-wrap" aria-hidden="true">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                    </svg>
                </div>
                <div>
                    <p class="stat-label">Jumlah Siswa</p>
                    <p class="stat-number js-counter" data-target="{{ $profile->jumlah_siswa }}">{{ $profile->jumlah_siswa }}</p>
                    <p class="stat-note">Peserta didik terdaftar</p>
                </div>
            </div>
        </div>
    </section>

    {{-- SPOTLIGHT KEPALA SEKOLAH --}}
    @if ($profile->nama_kepala_sekolah || $profile->profil_kepala_sekolah)
        <section class="section-wrap">
            <div class="principal-card zoom-reveal">
                <div class="principal-photo-wrap">
                    @if ($profile->foto_kepala_sekolah)
                        <img src="{{ asset('storage/' . $profile->foto_kepala_sekolah) }}" alt="Foto {{ $profile->nama_kepala_sekolah ?? 'Kepala Sekolah' }}">
                    @else
                        {{ strtoupper(substr($profile->nama_kepala_sekolah ?? 'KS', 0, 2)) }}
                    @endif
                </div>
                <div>
                    <span class="section-kicker" style="margin-bottom: 6px;">Kepala Sekolah</span>
                    <h3 style="margin: 0 0 6px; font-size: 1.25rem;">{{ $profile->nama_kepala_sekolah ?? 'Kepala Sekolah' }}</h3>
                    <p style="margin: 0 0 10px; color: var(--text-muted);">{{ \Illuminate\Support\Str::limit($profile->profil_kepala_sekolah, 180) }}</p>
                    @if ($profile->motivasi_kepala_sekolah)
                        <p style="margin: 0 0 14px; font-style: italic; color: var(--toska-800); font-weight: 600;">
                            {{ \Illuminate\Support\Str::limit($profile->motivasi_kepala_sekolah, 160) }}
                        </p>
                    @endif
                    <a href="{{ route('profil') }}" class="btn">Baca Profil Lengkap &rarr;</a>
                </div>
            </div>
        </section>
    @endif

    {{-- KONTAK RESMI SEKOLAH (DIKONTROL DARI PANEL ADMIN) --}}
    <section class="section-wrap" id="kontak">
        <div class="contact-panel zoom-reveal">
            <div style="position:relative; z-index:2; max-width:620px;">
                <span class="hero-badge" style="margin-bottom: 10px;">
                    <span class="hero-dot"></span>
                    Hubungi Kami
                </span>
                <h2 style="margin: 0 0 6px; font-size: clamp(1.45rem, 2.8vw, 2rem); font-weight: 800;">
                    Kontak Resmi {{ $profile->nama_sekolah }}
                </h2>
                <p style="margin: 0; color: var(--toska-100); font-size: 0.96rem;">
                    Silakan hubungi kami melalui telepon, fax, atau email resmi sekolah untuk informasi lebih lanjut.
                </p>
            </div>

            <div class="contact-grid">
                <div class="contact-item">
                    <div class="contact-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </div>
                    <h4>Telepon</h4>
                    <p>{{ $profile->kontak ?: '-' }}</p>
                </div>

                <div class="contact-item">
                    <div class="contact-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                            <rect x="6" y="14" width="12" height="8"></rect>
                        </svg>
                    </div>
                    <h4>Fax</h4>
                    <p>{{ $profile->fax ?: '-' }}</p>
                </div>

                <div class="contact-item">
                    <div class="contact-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <h4>Email</h4>
                    <p>{{ $profile->email ?: '-' }}</p>
                </div>

                <div class="contact-item">
                    <div class="contact-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <h4>Alamat</h4>
                    <p>{{ $profile->alamat ?: '-' }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    (function () {
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const revealEls = document.querySelectorAll('.zoom-reveal, .zoom-out-reveal');

        if (prefersReduced || !('IntersectionObserver' in window)) {
            revealEls.forEach(function (el) {
                el.classList.add('in-view');
            });
            return;
        }

        // Scroll-triggered Zoom In & Zoom Out
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                } else {
                    entry.target.classList.remove('in-view');
                }
            });
        }, { threshold: 0.14 });

        revealEls.forEach(function (el) {
            observer.observe(el);
        });

        // Animasi hitung angka (count-up) untuk Jumlah Guru & Siswa
        const counters = document.querySelectorAll('.js-counter');
        const counterObserver = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;

                const el = entry.target;
                const target = parseInt(el.getAttribute('data-target') || '0', 10);
                if (isNaN(target) || target <= 0) {
                    el.textContent = target;
                    obs.unobserve(el);
                    return;
                }

                const duration = 900;
                const startTime = performance.now();

                function tick(now) {
                    const progress = Math.min((now - startTime) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.round(eased * target);
                    if (progress < 1) {
                        requestAnimationFrame(tick);
                    } else {
                        el.textContent = target;
                    }
                }

                requestAnimationFrame(tick);
                obs.unobserve(el);
            });
        }, { threshold: 0.3 });

        counters.forEach(function (el) {
            counterObserver.observe(el);
        });

        // Slideshow background Home berganti setiap 10 detik
        const bgSlides = document.querySelectorAll('.hero-bg-slide');
        if (bgSlides.length > 1) {
            let bgIndex = 0;
            setInterval(function () {
                bgSlides[bgIndex].classList.remove('active');
                bgIndex = (bgIndex + 1) % bgSlides.length;
                bgSlides[bgIndex].classList.add('active');
            }, 10000);
        }
    })();
</script>
@endpush
