@extends('layouts.app')

@section('title', 'Pojok Prestasi - ' . $profile->nama_sekolah)

@section('main-class', 'prestasi-page')

@push('styles')
<style>
    .prestasi-page {
        width: 100%;
        background: linear-gradient(180deg, var(--toska-50) 0%, #f8fafc 45%, var(--toska-50) 100%);
        padding-bottom: 64px;
    }

    @keyframes prestasiZoom {
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

    .prestasi-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--navy-950) 0%, var(--navy-900) 48%, var(--toska-800) 100%);
        color: #fff;
        padding: clamp(44px, 7vw, 80px) 20px clamp(54px, 8vw, 92px);
        text-align: center;
    }

    .prestasi-hero-bg {
        position: absolute;
        inset: 0;
        background-image: url('{{ asset('images/school-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        opacity: 0.2;
        animation: prestasiZoom 18s ease-in-out infinite;
    }

    .prestasi-hero-inner {
        position: relative;
        z-index: 2;
        max-width: 760px;
        margin: 0 auto;
    }

    .prestasi-kicker {
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

    .prestasi-hero h1 {
        font-family: 'Merriweather', Georgia, serif;
        font-size: clamp(1.85rem, 4vw, 2.75rem);
        font-weight: 900;
        margin: 0 0 10px;
    }

    .prestasi-hero p {
        margin: 0;
        color: var(--toska-100);
        font-size: 1rem;
    }

    .prestasi-container {
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
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 28px;
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

    .prestasi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .prestasi-card {
        background: var(--surface);
        border: 1px solid var(--toska-200);
        border-radius: 22px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        display: flex;
        flex-direction: column;
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s ease;
    }

    .prestasi-card:hover {
        transform: scale(1.03) translateY(-6px);
        box-shadow: var(--shadow-lg);
    }

    .prestasi-img {
        height: 210px;
        background: linear-gradient(135deg, var(--toska-800), var(--toska-500));
        overflow: hidden;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 2.5rem;
    }

    .prestasi-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.55s ease;
        display: block;
    }

    .prestasi-card:hover .prestasi-img img {
        transform: scale(1.1);
    }

    .prestasi-level {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 5px 12px;
        border-radius: 999px;
        background: rgba(4, 47, 46, 0.85);
        color: var(--toska-200);
        font-size: 0.78rem;
        font-weight: 700;
        backdrop-filter: blur(6px);
    }

    .prestasi-year {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 5px 12px;
        border-radius: 999px;
        background: linear-gradient(135deg, var(--gold-400), var(--gold-500));
        color: var(--navy-950);
        font-size: 0.78rem;
        font-weight: 800;
    }

    .prestasi-body {
        padding: 22px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .prestasi-title {
        margin: 0 0 8px;
        font-size: 1.18rem;
        font-weight: 800;
        color: var(--toska-950);
        line-height: 1.35;
    }

    .prestasi-winner {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 10px;
        background: var(--toska-50);
        color: var(--toska-800);
        font-size: 0.86rem;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .prestasi-desc {
        margin: 0;
        color: var(--text-muted);
        font-size: 0.92rem;
        line-height: 1.6;
    }

    @media (max-width: 640px) {
        .prestasi-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
    <section class="prestasi-hero">
        <div class="prestasi-hero-bg" aria-hidden="true"></div>
        <div class="prestasi-hero-inner">
            <span class="prestasi-kicker" style="display:inline-flex; align-items:center; gap:6px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                Hall of Fame
            </span>
            <h1>Pojok Prestasi Sekolah</h1>
            <p>Catatan kebanggaan dan pencapaian gemilang siswa serta guru {{ $profile->nama_sekolah }}.</p>
        </div>
    </section>

    <div class="prestasi-container">
        @if ($levels->isNotEmpty())
            <div class="filter-card">
                <a href="{{ route('prestasi') }}" class="pill {{ !request('tingkat') ? 'active' : '' }}">Semua Tingkat</a>
                @foreach ($levels as $level)
                    <a href="{{ route('prestasi', ['tingkat' => $level]) }}" class="pill {{ request('tingkat') === $level ? 'active' : '' }}">
                        {{ $level }}
                    </a>
                @endforeach
            </div>
        @endif

        @if ($achievements->isEmpty())
            <div class="card" style="text-align: center; padding: 48px 20px;">
                <p style="color: var(--text-muted); margin: 0 0 16px;">Belum ada data prestasi yang ditambahkan.</p>
                <a class="btn" href="{{ route('home') }}">&larr; Kembali ke Home</a>
            </div>
        @else
            <div class="prestasi-grid">
                @foreach ($achievements as $item)
                    <article class="prestasi-card zoom-reveal">
                        <div class="prestasi-img">
                            <span class="prestasi-level">{{ $item->tingkat }}</span>
                            @if ($item->tahun)
                                <span class="prestasi-year">{{ $item->tahun }}</span>
                            @endif
                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
                            @else
                                <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                            @endif
                        </div>
                        <div class="prestasi-body">
                            <h2 class="prestasi-title">{{ $item->judul }}</h2>
                            @if ($item->peraih)
                                <div class="prestasi-winner" style="display:inline-flex; align-items:center; gap:6px;">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
                                    Peraih: {{ $item->peraih }}
                                </div>
                            @endif
                            <p class="prestasi-desc">{{ $item->deskripsi ?: 'Prestasi membanggakan civitas akademika sekolah.' }}</p>
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
