@extends('layouts.app')

@section('title', 'Direktori Guru & GTK - ' . $profile->nama_sekolah)

@section('main-class', 'guru-page')

@push('styles')
<style>
    .guru-page {
        width: 100%;
        background: linear-gradient(180deg, var(--toska-50) 0%, #f8fafc 45%, var(--toska-50) 100%);
        padding-bottom: 64px;
    }

    @keyframes guruHeroZoom {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.08); }
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

    .guru-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--navy-950) 0%, var(--navy-900) 48%, var(--toska-800) 100%);
        color: #fff;
        padding: clamp(44px, 7vw, 80px) 20px clamp(54px, 8vw, 92px);
        text-align: center;
    }

    .guru-hero-bg {
        position: absolute;
        inset: 0;
        background-image: url('{{ asset('images/school-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        opacity: 0.2;
        animation: guruHeroZoom 18s ease-in-out infinite;
    }

    .guru-hero-inner {
        position: relative;
        z-index: 2;
        max-width: 760px;
        margin: 0 auto;
    }

    .guru-kicker {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.55);
        border: 1px solid rgba(251, 191, 36, 0.45);
        color: var(--gold-100);
        font-size: 0.84rem;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .guru-hero h1 {
        font-family: 'Merriweather', Georgia, serif;
        font-size: clamp(1.85rem, 4vw, 2.75rem);
        font-weight: 900;
        margin: 0 0 10px;
    }

    .guru-hero p {
        margin: 0;
        color: var(--toska-100);
        font-size: 1rem;
    }

    .guru-container {
        max-width: 1140px;
        margin: -34px auto 0;
        padding: 0 20px;
        position: relative;
        z-index: 5;
    }

    .filter-card {
        background: var(--surface);
        border: 1px solid var(--toska-200);
        border-radius: 18px;
        padding: 16px 20px;
        box-shadow: var(--shadow-md);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 28px;
    }

    .filter-pills {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pill {
        padding: 7px 15px;
        border-radius: 999px;
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 700;
        background: var(--toska-50);
        color: var(--toska-800);
        border: 1px solid var(--toska-200);
        transition: all 0.25s ease;
    }

    .pill:hover,
    .pill.active {
        background: var(--toska-600);
        color: #fff;
        border-color: var(--toska-600);
        transform: scale(1.04);
    }

    .search-form {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .search-form input {
        padding: 8px 14px;
        border-radius: 10px;
        border: 1px solid var(--border);
        font-size: 0.92rem;
        min-width: 210px;
    }

    .guru-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 22px;
    }

    .guru-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        display: flex;
        flex-direction: column;
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s ease, border-color 0.35s ease;
    }

    .guru-card:hover {
        transform: scale(1.03) translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: var(--toska-400);
    }

    .guru-photo {
        height: 220px;
        background: linear-gradient(135deg, var(--toska-700), var(--toska-500));
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 2.6rem;
        font-weight: 800;
        position: relative;
    }

    .guru-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
        display: block;
    }

    .guru-card:hover .guru-photo img {
        transform: scale(1.08);
    }

    .guru-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 4px 10px;
        border-radius: 999px;
        background: rgba(4, 47, 46, 0.8);
        color: var(--toska-100);
        font-size: 0.75rem;
        font-weight: 700;
        backdrop-filter: blur(6px);
    }

    .guru-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .guru-name {
        margin: 0 0 4px;
        font-size: 1.12rem;
        font-weight: 800;
        color: var(--toska-950);
    }

    .guru-role {
        margin: 0 0 10px;
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--toska-700);
    }

    .guru-meta {
        font-size: 0.84rem;
        color: var(--text-muted);
        margin-bottom: 10px;
    }

    .guru-bio {
        font-size: 0.88rem;
        color: var(--text-muted);
        margin: 0;
        line-height: 1.55;
    }

    @media (max-width: 640px) {
        .search-form {
            width: 100%;
        }

        .search-form input {
            flex: 1;
            min-width: 0;
        }
    }
</style>
@endpush

@section('content')
    <section class="guru-hero">
        <div class="guru-hero-bg" aria-hidden="true"></div>
        <div class="guru-hero-inner">
            <span class="guru-kicker" style="display:inline-flex; align-items:center; gap:6px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Tenaga Pendidik &amp; Kependidikan
            </span>
            <h1>Direktori Guru &amp; GTK</h1>
            <p>Mengenal para pendidik dan staf kependidikan berdedikasi di {{ $profile->nama_sekolah }}.</p>
        </div>
    </section>

    <div class="guru-container">
        <div class="filter-card">
            <div class="filter-pills">
                <a href="{{ route('guru') }}" class="pill {{ !request('kategori') ? 'active' : '' }}">Semua</a>
                <a href="{{ route('guru', ['kategori' => 'Guru']) }}" class="pill {{ request('kategori') === 'Guru' ? 'active' : '' }}">Guru</a>
                <a href="{{ route('guru', ['kategori' => 'Tenaga Kependidikan']) }}" class="pill {{ request('kategori') === 'Tenaga Kependidikan' ? 'active' : '' }}">Tenaga Kependidikan</a>
            </div>

            <form action="{{ route('guru') }}" method="GET" class="search-form">
                @if (request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama / mapel...">
                <button type="submit" class="btn">Cari</button>
            </form>
        </div>

        @if ($teachers->isEmpty())
            <div class="card" style="text-align: center; padding: 48px 20px;">
                <p style="color: var(--text-muted); margin: 0 0 14px;">Belum ada data Guru / GTK yang sesuai.</p>
                <a href="{{ route('guru') }}" class="btn">Reset Filter</a>
            </div>
        @else
            <div class="guru-grid">
                @foreach ($teachers as $guru)
                    <article class="guru-card zoom-reveal">
                        <div class="guru-photo">
                            <span class="guru-badge">{{ $guru->kategori }}</span>
                            @if ($guru->foto)
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto {{ $guru->nama }}">
                            @else
                                {{ strtoupper(substr($guru->nama, 0, 2)) }}
                            @endif
                        </div>
                        <div class="guru-body">
                            <h2 class="guru-name">{{ $guru->nama }}</h2>
                            <p class="guru-role">
                                {{ $guru->mata_pelajaran ? $guru->mata_pelajaran : ($guru->jabatan ?? $guru->kategori) }}
                            </p>
                            @if ($guru->jabatan || $guru->nip)
                                <div class="guru-meta">
                                    @if ($guru->jabatan)
                                        <div><strong>Jabatan:</strong> {{ $guru->jabatan }}</div>
                                    @endif
                                    @if ($guru->nip)
                                        <div><strong>NIP/NUPTK:</strong> {{ $guru->nip }}</div>
                                    @endif
                                </div>
                            @endif
                            @if ($guru->bio)
                                <p class="guru-bio">{{ $guru->bio }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        <p style="margin-top: 28px;"><a class="btn" href="{{ route('home') }}">&larr; Kembali ke Home</a></p>
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
