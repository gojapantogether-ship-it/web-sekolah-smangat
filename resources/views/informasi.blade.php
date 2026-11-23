@extends('layouts.app')

@section('title', 'Informasi & Pengumuman Sekolah - ' . $profile->nama_sekolah)

@push('styles')
<style>
    /* Header Halaman Informasi */
    .info-header {
        background: linear-gradient(135deg, var(--navy-950) 0%, var(--navy-900) 48%, var(--toska-800) 100%);
        color: #fff;
        padding: clamp(36px, 6vw, 64px) 24px;
        border-radius: var(--radius-lg);
        margin-bottom: 36px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border-bottom: 4px solid var(--gold-500);
    }

    .info-header-orb {
        position: absolute;
        width: 320px;
        height: 320px;
        right: -80px;
        top: -80px;
        background: radial-gradient(circle, rgba(45, 212, 191, 0.3) 0%, rgba(45, 212, 191, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .info-header-content {
        position: relative;
        z-index: 2;
        max-width: 720px;
    }

    .info-header h1 {
        font-family: 'Merriweather', Georgia, serif;
        font-size: clamp(1.8rem, 3.5vw, 2.5rem);
        margin: 0 0 10px;
        font-weight: 900;
        letter-spacing: -0.02em;
    }

    .info-header p {
        font-size: 1.05rem;
        color: var(--toska-100);
        margin: 0;
    }

    /* Filter & Search Bar */
    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 28px;
    }

    .category-pills {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .cat-pill {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        background: #fff;
        border: 1px solid var(--border);
        color: var(--text-muted);
        transition: all 0.25s ease;
    }

    .cat-pill:hover,
    .cat-pill.active {
        background: var(--toska-600);
        color: #fff;
        border-color: var(--toska-600);
        transform: scale(1.05);
    }

    .search-box {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .search-box input {
        padding: 8px 14px;
        border-radius: 10px;
        border: 1px solid var(--border);
        font-size: 0.92rem;
        outline: none;
        background: #fff;
    }

    .search-box input:focus {
        border-color: var(--toska-500);
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.15);
    }

    /* Grid Informasi */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 26px;
    }

    .info-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-sm);
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.35s ease,
                    border-color 0.35s ease;
        text-decoration: none;
        color: inherit;
    }

    .info-card:hover {
        transform: scale(1.03) translateY(-6px);
        box-shadow: var(--shadow-md);
        border-color: var(--toska-400);
    }

    .info-card-img-wrap {
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: linear-gradient(135deg, var(--toska-100), var(--toska-50));
        position: relative;
    }

    .info-card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .info-card:hover .info-card-img-wrap img {
        transform: scale(1.1);
    }

    .info-card-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--toska-600);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .info-card-body {
        padding: 22px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .info-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 0.82rem;
    }

    .info-badge {
        background: var(--toska-100);
        color: var(--toska-800);
        padding: 3px 10px;
        border-radius: 999px;
        font-weight: 700;
    }

    .info-date {
        color: var(--text-muted);
    }

    .info-title {
        font-size: 1.18rem;
        font-weight: 700;
        line-height: 1.35;
        margin: 0 0 10px;
        color: var(--text-dark);
        transition: color 0.25s ease;
    }

    .info-card:hover .info-title {
        color: var(--toska-700);
    }

    .info-desc {
        color: var(--text-muted);
        font-size: 0.92rem;
        line-height: 1.55;
        margin: 0 0 18px;
        flex-grow: 1;
    }

    .info-cta {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--toska-700);
        transition: gap 0.25s ease;
    }

    .info-card:hover .info-cta {
        gap: 10px;
    }

    @media (max-width: 640px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
    {{-- Header Banner Informasi --}}
    <div class="info-header">
        <div class="info-header-orb"></div>
        <div class="info-header-content">
            <h1>Pusat Informasi &amp; Berita</h1>
            <p>Dapatkan kabar terbaru, jadwal pengumuman, dan liputan kegiatan resmi dari {{ $profile->nama_sekolah }}.</p>
        </div>
    </div>

    {{-- Filter Kategori & Pencarian --}}
    <div class="filter-bar">
        <div class="category-pills">
            <a href="{{ route('informasi') }}" class="cat-pill {{ !request('kategori') ? 'active' : '' }}">Semua</a>
            @foreach ($categories as $cat)
                <a href="{{ route('informasi', ['kategori' => $cat]) }}" class="cat-pill {{ request('kategori') == $cat ? 'active' : '' }}">{{ $cat }}</a>
            @endforeach
        </div>

        <form action="{{ route('informasi') }}" method="GET" class="search-box">
            @if(request('kategori'))
                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari informasi...">
            <button type="submit" class="btn" style="padding: 8px 14px;">Cari</button>
        </form>
    </div>

    {{-- Daftar Kartu Informasi --}}
    @if ($informationList->isEmpty())
        <div class="card" style="text-align: center; padding: 48px 20px;">
            <p style="font-size: 1.1rem; color: var(--text-muted); margin: 0 0 16px;">Belum ada informasi yang sesuai dengan pencarian Anda.</p>
            <a href="{{ route('informasi') }}" class="btn">Lihat Semua Informasi</a>
        </div>
    @else
        <div class="info-grid">
            @foreach ($informationList as $item)
                <a href="{{ route('informasi.detail', $item->slug) }}" class="info-card">
                    <div class="info-card-img-wrap">
                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                        @else
                            <div class="info-card-placeholder" style="gap: 8px;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                {{ $item->kategori }}
                            </div>
                        @endif
                    </div>
                    <div class="info-card-body">
                        <div class="info-meta">
                            <span class="info-badge">{{ $item->kategori }}</span>
                            <span class="info-date">{{ $item->tanggal_publikasi?->format('d M Y') ?? '-' }}</span>
                        </div>
                        <h2 class="info-title">{{ $item->judul }}</h2>
                        <p class="info-desc">
                            {{ $item->ringkasan ?: \Illuminate\Support\Str::limit(strip_tags($item->konten), 120) }}
                        </p>
                        <span class="info-cta">Baca Selengkapnya &rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>

        <div style="margin-top: 36px; display: flex; justify-content: center;">
            {{ $informationList->links() }}
        </div>
    @endif
@endsection
