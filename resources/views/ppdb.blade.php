@extends('layouts.app')

@section('title', 'Informasi PPDB - ' . $profile->nama_sekolah)

@section('main-class', 'ppdb-page')

@push('styles')
<style>
    .ppdb-page {
        width: 100%;
        background: linear-gradient(180deg, var(--toska-50) 0%, #f8fafc 45%, var(--toska-50) 100%);
        padding-bottom: 64px;
    }

    @keyframes ppdbPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.12); }
    }

    @keyframes ppdbHeroZoom {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.08); }
    }

    @keyframes badgeBeacon {
        0%, 100% { box-shadow: 0 0 0 0 rgba(20, 184, 166, 0.5); }
        50% { box-shadow: 0 0 0 10px rgba(20, 184, 166, 0); }
    }

    .zoom-reveal {
        opacity: 0;
        transform: scale(0.92);
        transition: opacity 0.6s cubic-bezier(0.22, 1, 0.36, 1), transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .zoom-reveal.in-view {
        opacity: 1;
        transform: scale(1);
    }

    /* Hero Banner PPDB */
    .ppdb-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--navy-950) 0%, var(--navy-900) 48%, var(--toska-800) 100%);
        color: #fff;
        padding: clamp(44px, 7vw, 84px) 20px clamp(56px, 8vw, 96px);
        text-align: center;
    }

    .ppdb-hero-bg {
        position: absolute;
        inset: 0;
        background-image: url('{{ asset('images/school-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        opacity: 0.2;
        animation: ppdbHeroZoom 18s ease-in-out infinite;
    }

    .ppdb-orb {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        animation: ppdbPulse 9s ease-in-out infinite;
    }

    .ppdb-orb-1 {
        width: 320px;
        height: 320px;
        top: -90px;
        left: -70px;
        background: radial-gradient(circle, rgba(45, 212, 191, 0.35), transparent 70%);
    }

    .ppdb-orb-2 {
        width: 260px;
        height: 260px;
        bottom: -80px;
        right: -50px;
        background: radial-gradient(circle, rgba(153, 246, 228, 0.25), transparent 70%);
        animation-delay: 2s;
    }

    .ppdb-hero-inner {
        position: relative;
        z-index: 2;
        max-width: 780px;
        margin: 0 auto;
    }

    .ppdb-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.55);
        border: 1px solid rgba(251, 191, 36, 0.45);
        color: var(--gold-100);
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 14px;
        animation: badgeBeacon 2.4s infinite;
    }

    .ppdb-hero h1 {
        font-family: 'Merriweather', Georgia, serif;
        font-size: clamp(1.85rem, 4vw, 2.8rem);
        font-weight: 900;
        margin: 0 0 12px;
        letter-spacing: -0.025em;
    }

    .ppdb-hero p {
        color: var(--toska-100);
        margin: 0;
        font-size: clamp(0.95rem, 1.5vw, 1.08rem);
    }

    /* Container */
    .ppdb-container {
        max-width: 1060px;
        margin: -38px auto 0;
        padding: 0 20px;
        position: relative;
        z-index: 5;
    }

    /* Alur Pendaftaran 3 Langkah */
    .steps-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 32px;
    }

    .step-card {
        background: var(--surface);
        border: 1px solid var(--toska-200);
        border-radius: 18px;
        padding: 20px;
        box-shadow: var(--shadow-sm);
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s ease;
    }

    .step-card:hover {
        transform: scale(1.04) translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .step-num {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--toska-600), var(--toska-500));
        color: #fff;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .step-card h3 {
        margin: 0 0 6px;
        font-size: 1.02rem;
        color: var(--toska-950);
    }

    .step-card p {
        margin: 0;
        font-size: 0.88rem;
        color: var(--text-muted);
    }

    /* Kartu Info PPDB */
    .ppdb-card {
        background: var(--surface);
        border: 1px solid var(--toska-200);
        border-radius: 22px;
        padding: clamp(22px, 4vw, 34px);
        margin-bottom: 24px;
        box-shadow: var(--shadow-md);
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s ease;
        position: relative;
        overflow: hidden;
    }

    .ppdb-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--toska-700), var(--toska-400));
    }

    .ppdb-card:hover {
        transform: scale(1.015);
        box-shadow: var(--shadow-lg);
    }

    .ppdb-card-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 18px;
    }

    .ppdb-card-head h2 {
        margin: 0;
        font-size: clamp(1.3rem, 2.5vw, 1.7rem);
        color: var(--toska-950);
        font-weight: 800;
    }

    .ppdb-year-badge {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 999px;
        background: var(--toska-100);
        color: var(--toska-800);
        font-weight: 700;
        font-size: 0.85rem;
    }

    .ppdb-schedule-bar {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--toska-50);
        border: 1px solid var(--toska-200);
        padding: 10px 16px;
        border-radius: 12px;
        color: var(--toska-900);
        font-weight: 600;
        font-size: 0.92rem;
        margin-bottom: 18px;
    }

    .ppdb-desc {
        color: var(--text-dark);
        font-size: 1rem;
        line-height: 1.75;
        white-space: pre-line;
        margin: 0 0 20px;
    }

    .ppdb-req-box {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-left: 4px solid var(--toska-500);
        border-radius: 0 14px 14px 0;
        padding: 18px 20px;
        margin-bottom: 22px;
    }

    .ppdb-req-box h3 {
        margin: 0 0 8px;
        font-size: 1.05rem;
        color: var(--toska-900);
    }

    .ppdb-req-box p {
        margin: 0;
        white-space: pre-line;
        color: var(--text-muted);
        line-height: 1.7;
    }

    .ppdb-cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 26px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--gold-400), var(--gold-500));
        color: var(--navy-950);
        text-decoration: none;
        font-weight: 800;
        box-shadow: 0 10px 24px rgba(245, 158, 11, 0.32);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .ppdb-cta-btn:hover {
        transform: scale(1.05) translateY(-2px);
        box-shadow: 0 14px 30px rgba(13, 148, 136, 0.38);
    }

    @media (max-width: 768px) {
        .steps-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
    <section class="ppdb-hero">
        <div class="ppdb-hero-bg" aria-hidden="true"></div>
        <div class="ppdb-orb ppdb-orb-1"></div>
        <div class="ppdb-orb ppdb-orb-2"></div>
        <div class="ppdb-hero-inner">
            <span class="ppdb-status-pill">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                Penerimaan Peserta Didik Baru
            </span>
            <h1>Informasi PPDB {{ $profile->nama_sekolah }}</h1>
            <p>Jadwal resmi, persyaratan berkas, dan panduan pendaftaran siswa baru yang dikelola langsung oleh panitia sekolah.</p>
        </div>
    </section>

    <div class="ppdb-container">
        {{-- Alur Singkat PPDB --}}
        <div class="steps-grid">
            <div class="step-card zoom-reveal">
                <span class="step-num">1</span>
                <h3>Cek Jadwal &amp; Syarat</h3>
                <p>Pelajari jadwal gelombang pendaftaran dan lengkapi seluruh berkas persyaratan yang diminta.</p>
            </div>
            <div class="step-card zoom-reveal" style="transition-delay: 0.08s;">
                <span class="step-num">2</span>
                <h3>Daftar Online / Sekolah</h3>
                <p>Isi formulir pendaftaran melalui tautan resmi PPDB atau datang langsung ke sekretariat sekolah.</p>
            </div>
            <div class="step-card zoom-reveal" style="transition-delay: 0.16s;">
                <span class="step-num">3</span>
                <h3>Verifikasi &amp; Pengumuman</h3>
                <p>Panitia memverifikasi berkas calon siswa dan mengumumkan hasil seleksi sesuai jadwal.</p>
            </div>
        </div>

        {{-- Daftar Gelombang PPDB Aktif --}}
        @forelse ($ppdbInfos as $info)
            <article class="ppdb-card zoom-reveal">
                <div class="ppdb-card-head">
                    <h2>{{ $info->judul }}</h2>
                    @if ($info->tahun_ajaran)
                        <span class="ppdb-year-badge">Tahun Ajaran {{ $info->tahun_ajaran }}</span>
                    @endif
                </div>

                @if ($info->tanggal_mulai || $info->tanggal_selesai)
                    <div class="ppdb-schedule-bar">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <span>Jadwal: {{ $info->tanggal_mulai?->format('d M Y') ?? '-' }} s/d {{ $info->tanggal_selesai?->format('d M Y') ?? '-' }}</span>
                    </div>
                @endif

                <p class="ppdb-desc">{{ $info->deskripsi }}</p>

                @if ($info->persyaratan)
                    <div class="ppdb-req-box">
                        <h3 style="display:flex; align-items:center; gap:8px;">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="var(--toska-700)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                            Persyaratan Pendaftaran
                        </h3>
                        <p>{{ $info->persyaratan }}</p>
                    </div>
                @endif

                <div style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
                    @if ($info->link_pendaftaran)
                        <a class="ppdb-cta-btn" href="{{ $info->link_pendaftaran }}" target="_blank" rel="noopener">
                            Daftar Sekarang &rarr;
                        </a>
                    @endif
                    <a class="btn" style="background:#fff; color:var(--toska-800); border-color:var(--toska-300);" href="{{ route('home') }}#kontak">
                        Hubungi Panitia
                    </a>
                </div>
            </article>
        @empty
            <div class="ppdb-card zoom-reveal" style="text-align: center; padding: 48px 24px;">
                <h2 style="margin-top:0; color:var(--toska-900);">Belum Ada Informasi PPDB Aktif</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px;">Silakan pantau kembali halaman ini atau hubungi kontak resmi sekolah untuk informasi pendaftaran terbaru.</p>
                <a class="btn" href="{{ route('home') }}">&larr; Kembali ke Home</a>
            </div>
        @endforelse

        <p style="margin-top: 24px;"><a class="btn" href="{{ route('home') }}">&larr; Kembali ke Home</a></p>
    </div>
@endsection

@push('scripts')
<script>
    (function () {
        const els = document.querySelectorAll('.zoom-reveal');
        if (!('IntersectionObserver' in window)) {
            els.forEach(el => el.classList.add('in-view'));
            return;
        }
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('in-view');
            });
        }, { threshold: 0.12 });
        els.forEach(el => obs.observe(el));
    })();
</script>
@endpush
