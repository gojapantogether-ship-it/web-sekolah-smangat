@extends('layouts.app')

@section('title', $informasi->judul . ' - ' . $profile->nama_sekolah)

@push('styles')
<style>
    .article-container {
        max-width: 900px;
        margin: 0 auto;
    }

    /* Breadcrumbs */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.88rem;
        color: var(--text-muted);
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .breadcrumb a {
        color: var(--toska-700);
        text-decoration: none;
        font-weight: 600;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    /* Article Header */
    .article-header {
        margin-bottom: 28px;
    }

    .article-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 999px;
        background: var(--toska-100);
        color: var(--toska-800);
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .article-title {
        font-size: clamp(1.85rem, 4vw, 2.6rem);
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.25;
        letter-spacing: -0.025em;
        margin: 0 0 14px;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 0.92rem;
        color: var(--text-muted);
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border);
    }

    /* ======================================================== */
    /* 🖼️ TEMPLATE MENARUH GAMBAR INFORMASI                     */
    /* ======================================================== */
    .article-image-template {
        margin-bottom: 32px;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
        background: #000;
        position: relative;
    }

    .article-image-template img {
        width: 100%;
        max-height: 480px;
        object-fit: cover;
        display: block;
        transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .article-image-template:hover img {
        transform: scale(1.03);
    }

    .article-image-caption {
        padding: 10px 18px;
        background: #ffffff;
        font-size: 0.85rem;
        color: var(--text-muted);
        border-top: 1px solid var(--border);
        font-style: italic;
    }

    /* ======================================================== */
    /* 📝 TEMPLATE MENARUH TULISAN INFORMASI                    */
    /* ======================================================== */
    .article-body-template {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: clamp(24px, 4vw, 40px);
        box-shadow: var(--shadow-sm);
        margin-bottom: 40px;
    }

    .article-lead {
        font-size: 1.15rem;
        font-weight: 600;
        line-height: 1.7;
        color: var(--navy-900);
        background: var(--toska-50);
        border-left: 4px solid var(--gold-500);
        padding: 16px 20px;
        border-radius: 0 12px 12px 0;
        margin-bottom: 28px;
    }

    .article-content {
        font-size: 1.05rem;
        line-height: 1.85;
        color: #1e293b;
        white-space: pre-line;
        word-break: break-word;
    }

    /* Related Section */
    .related-wrap {
        margin-top: 48px;
        padding-top: 32px;
        border-top: 1px solid var(--border);
    }

    .related-title {
        font-size: 1.4rem;
        font-weight: 800;
        margin: 0 0 20px;
        color: var(--toska-900);
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 18px;
    }

    .related-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 18px;
        text-decoration: none;
        color: inherit;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .related-card:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: var(--shadow-md);
        border-color: var(--toska-400);
    }
</style>
@endpush

@section('content')
    <div class="article-container">
        {{-- Breadcrumb Navigasi --}}
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>&rsaquo;</span>
            <a href="{{ route('informasi') }}">Informasi</a>
            <span>&rsaquo;</span>
            <span style="color:var(--text-dark);">{{ \Illuminate\Support\Str::limit($informasi->judul, 35) }}</span>
        </nav>

        {{-- Header Judul & Metadata --}}
        <header class="article-header">
            <span class="article-badge">{{ $informasi->kategori }}</span>
            <h1 class="article-title">{{ $informasi->judul }}</h1>
            <div class="article-meta">
                <span style="display:inline-flex; align-items:center; gap:6px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--toska-700)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ $informasi->tanggal_publikasi?->format('d F Y') ?? '-' }}
                </span>
                <span style="display:inline-flex; align-items:center; gap:6px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--toska-700)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/></svg>
                    {{ $profile->nama_sekolah }}
                </span>
            </div>
        </header>

        {{-- TEMPLATE MENARUH GAMBAR INFORMASI --}}
        @if ($informasi->gambar)
            <figure class="article-image-template">
                <img src="{{ asset('storage/' . $informasi->gambar) }}" alt="{{ $informasi->judul }}">
                <figcaption class="article-image-caption">
                    Dokumentasi: {{ $informasi->judul }}
                </figcaption>
            </figure>
        @endif

        {{-- TEMPLATE MENARUH TULISAN INFORMASI --}}
        <article class="article-body-template">
            @if ($informasi->ringkasan)
                <div class="article-lead">
                    {{ $informasi->ringkasan }}
                </div>
            @endif

            <div class="article-content">
                {{ $informasi->konten }}
            </div>

            <div style="margin-top: 32px; padding-top: 20px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <a href="{{ route('informasi') }}" class="btn">&larr; Kembali ke Daftar Informasi</a>
                <a href="{{ route('home') }}" class="btn" style="background: transparent; color: var(--toska-700); border-color: var(--border);">Halaman Utama</a>
            </div>
        </article>

        {{-- Informasi Terkait --}}
        @if ($relatedInfo->isNotEmpty())
            <section class="related-wrap">
                <h3 class="related-title">Informasi Sekolah Lainnya</h3>
                <div class="related-grid">
                    @foreach ($relatedInfo as $rel)
                        <a href="{{ route('informasi.detail', $rel->slug) }}" class="related-card">
                            <span style="font-size:0.78rem; font-weight:700; color:var(--toska-700); text-transform:uppercase;">{{ $rel->kategori }}</span>
                            <h4 style="margin: 6px 0 8px; font-size: 1.05rem; line-height: 1.35;">{{ $rel->judul }}</h4>
                            <p style="margin: 0; font-size: 0.85rem; color: var(--text-muted);">{{ $rel->tanggal_publikasi?->format('d M Y') ?? '-' }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
