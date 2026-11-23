@extends('layouts.app')

@section('title', 'Ekstrakurikuler - ' . $profile->nama_sekolah)

@section('main-class', 'ekskul-page')

@push('styles')
<style>
    .ekskul-page {
        width: 100%;
        background: linear-gradient(180deg, var(--toska-50) 0%, #f8fafc 45%, var(--toska-50) 100%);
        padding-bottom: 64px;
    }

    @keyframes ekskulZoom {
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

    .ekskul-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--navy-950) 0%, var(--navy-900) 48%, var(--toska-800) 100%);
        color: #fff;
        padding: clamp(44px, 7vw, 80px) 20px clamp(54px, 8vw, 92px);
        text-align: center;
    }

    .ekskul-hero-bg {
        position: absolute;
        inset: 0;
        background-image: url('{{ asset('images/school-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        opacity: 0.2;
        animation: ekskulZoom 18s ease-in-out infinite;
    }

    .ekskul-hero-inner {
        position: relative;
        z-index: 2;
        max-width: 760px;
        margin: 0 auto;
    }

    .ekskul-kicker {
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

    .ekskul-hero h1 {
        font-family: 'Merriweather', Georgia, serif;
        font-size: clamp(1.85rem, 4vw, 2.75rem);
        font-weight: 900;
        margin: 0 0 10px;
    }

    .ekskul-hero p {
        margin: 0;
        color: var(--toska-100);
        font-size: 1rem;
    }

    .ekskul-container {
        max-width: 1140px;
        margin: -34px auto 0;
        padding: 0 20px;
        position: relative;
        z-index: 5;
    }

    .ekskul-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .ekskul-card {
        background: var(--surface);
        border: 1px solid var(--toska-200);
        border-radius: 22px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        display: flex;
        flex-direction: column;
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s ease;
    }

    .ekskul-card:hover {
        transform: scale(1.03) translateY(-6px);
        box-shadow: var(--shadow-lg);
    }

    .ekskul-img {
        height: 210px;
        background: linear-gradient(135deg, var(--toska-700), var(--toska-500));
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 800;
        font-size: 1.4rem;
    }

    .ekskul-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.55s ease;
        display: block;
    }

    .ekskul-card:hover .ekskul-img img {
        transform: scale(1.1);
    }

    .ekskul-body {
        padding: 22px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .ekskul-title {
        margin: 0 0 10px;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--toska-950);
    }

    .ekskul-tags {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 14px;
        padding: 10px 14px;
        background: var(--toska-50);
        border: 1px solid var(--toska-100);
        border-radius: 12px;
        font-size: 0.86rem;
        color: var(--toska-900);
    }

    .ekskul-desc {
        margin: 0;
        color: var(--text-muted);
        font-size: 0.94rem;
        line-height: 1.65;
    }

    @media (max-width: 640px) {
        .ekskul-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
    <section class="ekskul-hero">
        <div class="ekskul-hero-bg" aria-hidden="true"></div>
        <div class="ekskul-hero-inner">
            <span class="ekskul-kicker" style="display:inline-flex; align-items:center; gap:6px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                Bakat, Minat &amp; Kreativitas
            </span>
            <h1>Ekstrakurikuler Sekolah</h1>
            <p>Wadah pengembangan potensi, kepemimpinan, seni, olahraga, dan sains bagi seluruh siswa {{ $profile->nama_sekolah }}.</p>
        </div>
    </section>

    <div class="ekskul-container">
        @if ($extracurriculars->isEmpty())
            <div class="card" style="text-align: center; padding: 48px 20px;">
                <p style="color: var(--text-muted); margin: 0 0 16px;">Belum ada data ekstrakurikuler yang ditambahkan.</p>
                <a class="btn" href="{{ route('home') }}">&larr; Kembali ke Home</a>
            </div>
        @else
            <div class="ekskul-grid">
                @foreach ($extracurriculars as $item)
                    <article class="ekskul-card zoom-reveal">
                        <div class="ekskul-img">
                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
                            @else
                                {{ $item->nama }}
                            @endif
                        </div>
                        <div class="ekskul-body">
                            <h2 class="ekskul-title">{{ $item->nama }}</h2>
                            @if ($item->pembina || $item->jadwal)
                                <div class="ekskul-tags">
                                    @if ($item->pembina)
                                        <div style="display:flex; align-items:center; gap:6px;">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                            <span><strong>Pembina:</strong> {{ $item->pembina }}</span>
                                        </div>
                                    @endif
                                    @if ($item->jadwal)
                                        <div style="display:flex; align-items:center; gap:6px;">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                            <span><strong>Jadwal:</strong> {{ $item->jadwal }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <p class="ekskul-desc">{{ $item->deskripsi ?: 'Kegiatan pengembangan minat dan bakat siswa.' }}</p>
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
