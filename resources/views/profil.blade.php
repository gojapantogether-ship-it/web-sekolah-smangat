@extends('layouts.app')

@section('title', 'Profil Sekolah & Kepala Sekolah - ' . $profile->nama_sekolah)

@section('main-class', 'profil-page')

@push('styles')
<style>
    .profil-page {
        width: 100%;
        background: linear-gradient(180deg, var(--toska-50) 0%, #f8fafc 45%, var(--toska-50) 100%);
        padding-bottom: 64px;
    }

    @keyframes profilZoom {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.08); }
    }

    .zoom-reveal {
        opacity: 0;
        transform: scale(0.93);
        transition: opacity 0.65s cubic-bezier(0.22, 1, 0.36, 1), transform 0.65s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .zoom-reveal.in-view {
        opacity: 1;
        transform: scale(1);
    }

    /* Hero */
    .profil-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--navy-950) 0%, var(--navy-900) 48%, var(--toska-800) 100%);
        color: #fff;
        padding: clamp(44px, 7vw, 80px) 20px clamp(54px, 8vw, 90px);
        text-align: center;
    }

    .profil-hero-bg {
        position: absolute;
        inset: 0;
        background-image: url('{{ $profile->foto_sekolah ? asset('storage/' . $profile->foto_sekolah) : asset('images/school-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        opacity: 0.22;
        animation: profilZoom 18s ease-in-out infinite;
    }

    .profil-hero-inner {
        position: relative;
        z-index: 2;
        max-width: 820px;
        margin: 0 auto;
    }

    .profil-badges {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 14px;
    }

    .profil-pill {
        padding: 5px 14px;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.55);
        border: 1px solid rgba(251, 191, 36, 0.45);
        color: var(--gold-100);
        font-size: 0.84rem;
        font-weight: 700;
    }

    .profil-hero h1 {
        font-family: 'Merriweather', Georgia, serif;
        font-size: clamp(1.85rem, 4vw, 2.75rem);
        font-weight: 900;
        margin: 0 0 10px;
    }

    .profil-hero p {
        margin: 0;
        color: var(--toska-100);
        font-size: 1.02rem;
    }

    /* Main Container */
    .profil-container {
        max-width: 1080px;
        margin: -36px auto 0;
        padding: 0 20px;
        position: relative;
        z-index: 5;
    }

    /* School Profile Card */
    .school-showcase {
        background: var(--surface);
        border: 1px solid var(--toska-200);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        margin-bottom: 32px;
        display: grid;
        grid-template-columns: 1.05fr 1fr;
    }

    .school-photo-box {
        position: relative;
        min-height: 320px;
        overflow: hidden;
        background: var(--toska-900);
    }

    .school-photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .school-showcase:hover .school-photo-box img {
        transform: scale(1.06);
    }

    .school-info-box {
        padding: clamp(24px, 4vw, 36px);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .kicker {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 999px;
        background: var(--toska-100);
        color: var(--toska-800);
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 10px;
        align-self: flex-start;
    }

    .school-info-box h2 {
        margin: 0 0 12px;
        font-size: 1.55rem;
        color: var(--toska-950);
    }

    .school-meta-list {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid var(--border);
        display: grid;
        gap: 8px;
        font-size: 0.92rem;
        color: var(--text-muted);
    }

    /* Detail Grid: Sejarah & Visi Misi */
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 22px;
        margin-bottom: 32px;
    }

    .detail-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 26px;
        box-shadow: var(--shadow-sm);
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }

    .detail-card:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-md);
    }

    .detail-card h3 {
        margin: 0 0 12px;
        font-size: 1.25rem;
        color: var(--toska-900);
    }

    .detail-card p {
        margin: 0;
        white-space: pre-line;
        color: var(--text-muted);
        line-height: 1.75;
    }

    /* Principal Card */
    .principal-showcase {
        background: linear-gradient(145deg, #ffffff 0%, var(--toska-50) 100%);
        border: 1px solid var(--toska-200);
        border-radius: 24px;
        padding: clamp(24px, 4vw, 38px);
        box-shadow: var(--shadow-md);
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 30px;
        align-items: center;
        margin-bottom: 28px;
    }

    .principal-avatar {
        width: 240px;
        height: 280px;
        border-radius: 20px;
        overflow: hidden;
        border: 4px solid #fff;
        box-shadow: var(--shadow-md);
        background: var(--toska-100);
    }

    .principal-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.55s ease;
        display: block;
    }

    .principal-showcase:hover .principal-avatar img {
        transform: scale(1.07);
    }

    .principal-quote {
        margin-top: 16px;
        padding: 16px 20px;
        background: #fff;
        border-left: 4px solid var(--gold-500);
        border-radius: 0 14px 14px 0;
        color: var(--navy-900);
        font-style: italic;
        font-weight: 600;
        line-height: 1.65;
        box-shadow: var(--shadow-sm);
        white-space: pre-line;
    }

    @media (max-width: 860px) {
        .school-showcase,
        .detail-grid,
        .principal-showcase {
            grid-template-columns: 1fr;
        }

        .principal-avatar {
            width: 190px;
            height: 220px;
            margin: 0 auto;
        }
    }
</style>
@endpush

@section('content')
    <section class="profil-hero">
        <div class="profil-hero-bg" aria-hidden="true"></div>
        <div class="profil-hero-inner">
            <div class="profil-badges">
                @if ($profile->npsn)
                    <span class="profil-pill">NPSN: {{ $profile->npsn }}</span>
                @endif
                @if ($profile->akreditasi)
                    <span class="profil-pill">Akreditasi: {{ $profile->akreditasi }}</span>
                @endif
            </div>
            <div style="display: inline-flex; align-items: center; justify-content: center; width: 72px; height: 72px; background: rgba(255,255,255,0.95); border-radius: 18px; padding: 6px; box-shadow: 0 10px 25px rgba(0,0,0,0.18); margin-bottom: 14px;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo {{ $profile->nama_sekolah }}" style="width: 100%; height: 100%; object-fit: contain;" onerror="this.parentElement.style.display='none'">
            </div>
            <h1>{{ $profile->nama_sekolah }}</h1>
            <p>Mengenal lebih dekat sejarah, visi misi, dan pimpinan kepala sekolah kami.</p>
        </div>
    </section>

    <div class="profil-container">
        {{-- FOTO SEKOLAH + PROFIL DETAIL --}}
        <section class="school-showcase zoom-reveal">
            <div class="school-photo-box">
                <img src="{{ $profile->foto_sekolah ? asset('storage/' . $profile->foto_sekolah) : asset('images/school-hero.jpg') }}"
                     alt="Foto {{ $profile->nama_sekolah }}">
            </div>
            <div class="school-info-box">
                <span class="kicker">Profil Sekolah</span>
                <h2>{{ $profile->nama_sekolah }}</h2>
                <p style="margin:0; white-space: pre-line; color: var(--text-muted); line-height: 1.75;">
                    {{ $profile->profil_sekolah }}
                </p>

                <div class="school-meta-list">
                    @if ($profile->alamat)
                        <div style="display:flex; align-items:center; gap:8px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--toska-700)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span><strong>Alamat:</strong> {{ $profile->alamat }}</span>
                        </div>
                    @endif
                    @if ($profile->kontak)
                        <div style="display:flex; align-items:center; gap:8px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--toska-700)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <span><strong>Telepon:</strong> {{ $profile->kontak }}</span>
                        </div>
                    @endif
                    @if ($profile->fax)
                        <div style="display:flex; align-items:center; gap:8px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--toska-700)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                            <span><strong>Fax:</strong> {{ $profile->fax }}</span>
                        </div>
                    @endif
                    @if ($profile->email)
                        <div style="display:flex; align-items:center; gap:8px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--toska-700)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            <span><strong>Email:</strong> {{ $profile->email }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- SEJARAH & VISI MISI --}}
        <section class="detail-grid">
            <div class="detail-card zoom-reveal">
                <span class="kicker">Sejarah</span>
                <h3>Sejarah Singkat Sekolah</h3>
                <p>{{ $profile->sejarah_sekolah ?: 'Informasi sejarah sekolah belum diisi.' }}</p>
            </div>

            <div class="detail-card zoom-reveal" style="transition-delay: 0.08s;">
                <span class="kicker">Arah &amp; Tujuan</span>
                <h3>Visi &amp; Misi</h3>
                <p>{{ $profile->visi_misi ?: 'Informasi visi dan misi sekolah belum diisi.' }}</p>
            </div>
        </section>

        {{-- PROFIL KEPALA SEKOLAH: FOTO, BIO SINGKAT, MOTIVASI --}}
        <section class="principal-showcase zoom-reveal">
            <div class="principal-avatar">
                @if ($profile->foto_kepala_sekolah)
                    <img src="{{ asset('storage/' . $profile->foto_kepala_sekolah) }}" alt="Foto {{ $profile->nama_kepala_sekolah }}">
                @else
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:3rem; font-weight:800; color:var(--toska-700);">
                        {{ strtoupper(substr($profile->nama_kepala_sekolah ?? 'KS', 0, 2)) }}
                    </div>
                @endif
            </div>

            <div>
                <span class="kicker">Profil Kepala Sekolah</span>
                <h2 style="margin: 0 0 10px; font-size: clamp(1.35rem, 2.5vw, 1.85rem); color: var(--toska-950);">
                    {{ $profile->nama_kepala_sekolah ?? 'Belum diisi' }}
                </h2>
                <p style="margin: 0; white-space: pre-line; color: var(--text-muted); line-height: 1.75;">
                    {{ $profile->profil_kepala_sekolah }}
                </p>

                @if ($profile->motivasi_kepala_sekolah)
                    <blockquote class="principal-quote">
                        {{ $profile->motivasi_kepala_sekolah }}
                    </blockquote>
                @endif
            </div>
        </section>

        <p><a class="btn" href="{{ route('home') }}">&larr; Kembali ke Home</a></p>
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
