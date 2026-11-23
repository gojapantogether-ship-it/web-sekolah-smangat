@extends('layouts.app')

@section('title', 'Galeri Foto Sekolah - ' . $profile->nama_sekolah)

@section('main-class', 'galeri-page')

@push('styles')
<style>
    .galeri-page {
        width: 100%;
        min-height: 80vh;
        background: linear-gradient(180deg, var(--toska-50) 0%, #f8fafc 45%, var(--toska-50) 100%);
        padding-bottom: 64px;
    }

    @keyframes floatOrb {
        0%, 100% { transform: scale(1) translate(0, 0); }
        50% { transform: scale(1.15) translate(12px, -10px); }
    }

    @keyframes slideZoomIn {
        0% { opacity: 0; transform: scale(1.08); }
        100% { opacity: 1; transform: scale(1); }
    }

    @keyframes kenBurnsSlow {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.07); }
    }

    /* Hero Banner Galeri */
    .galeri-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--navy-950) 0%, var(--navy-900) 48%, var(--toska-800) 100%);
        color: #fff;
        padding: clamp(40px, 7vw, 76px) 20px clamp(52px, 8vw, 90px);
        text-align: center;
    }

    .galeri-hero-bg {
        position: absolute;
        inset: 0;
        background-image: url('{{ asset('images/school-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        opacity: 0.22;
        animation: kenBurnsSlow 20s ease-in-out infinite;
    }

    .galeri-orb {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        animation: floatOrb 10s ease-in-out infinite;
    }

    .galeri-orb-1 {
        width: 300px;
        height: 300px;
        top: -90px;
        right: -60px;
        background: radial-gradient(circle, rgba(45, 212, 191, 0.35), transparent 70%);
    }

    .galeri-orb-2 {
        width: 240px;
        height: 240px;
        bottom: -80px;
        left: -50px;
        background: radial-gradient(circle, rgba(153, 246, 228, 0.25), transparent 70%);
        animation-delay: 2s;
    }

    .galeri-hero-inner {
        position: relative;
        z-index: 2;
        max-width: 740px;
        margin: 0 auto;
    }

    .galeri-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 5px 14px;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.55);
        border: 1px solid rgba(251, 191, 36, 0.45);
        color: var(--gold-100);
        font-size: 0.84rem;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .galeri-hero h1 {
        font-family: 'Merriweather', Georgia, serif;
        font-size: clamp(1.85rem, 4vw, 2.8rem);
        font-weight: 900;
        margin: 0 0 10px;
        letter-spacing: -0.025em;
    }

    .galeri-hero p {
        color: var(--toska-100);
        margin: 0;
        font-size: clamp(0.95rem, 1.5vw, 1.08rem);
    }

    /* Container */
    .galeri-container {
        max-width: 1140px;
        margin: -36px auto 0;
        padding: 0 20px;
        position: relative;
        z-index: 5;
    }

    /* ========== SLIDESHOW UTAMA ========== */
    .slider-card {
        background: var(--surface);
        border: 1px solid var(--toska-200);
        border-radius: 24px;
        padding: clamp(14px, 2.5vw, 24px);
        box-shadow: var(--shadow-lg);
        margin-bottom: 42px;
    }

    .slider-stage {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        max-height: 540px;
        border-radius: 18px;
        overflow: hidden;
        background: var(--toska-950);
    }

    .slide-item {
        position: absolute;
        inset: 0;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.55s ease;
    }

    .slide-item.active {
        opacity: 1;
        pointer-events: auto;
        z-index: 2;
    }

    .slide-item.active img {
        animation: slideZoomIn 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }

    .slide-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        cursor: zoom-in;
    }

    .slide-gradient {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(4, 47, 46, 0.92) 0%,
            rgba(4, 47, 46, 0.45) 38%,
            rgba(4, 47, 46, 0.05) 75%
        );
        pointer-events: none;
    }

    .slide-caption {
        position: absolute;
        left: clamp(16px, 3vw, 32px);
        right: clamp(16px, 3vw, 32px);
        bottom: clamp(16px, 3vw, 28px);
        color: #fff;
        z-index: 3;
        pointer-events: none;
    }

    .slide-badge-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
        flex-wrap: wrap;
    }

    .slide-counter {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 999px;
        background: rgba(20, 184, 166, 0.88);
        color: #fff;
        font-size: 0.78rem;
        font-weight: 700;
        backdrop-filter: blur(6px);
    }

    .slide-title {
        font-size: clamp(1.15rem, 2.5vw, 1.75rem);
        font-weight: 800;
        margin: 0 0 6px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.35);
    }

    .slide-desc {
        font-size: clamp(0.88rem, 1.4vw, 1rem);
        color: var(--toska-100);
        margin: 0;
        max-width: 720px;
        line-height: 1.5;
    }

    /* Nav Buttons */
    .slider-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 4;
        width: 46px;
        height: 46px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.35);
        background: rgba(4, 47, 46, 0.55);
        color: #fff;
        font-size: 1.5rem;
        line-height: 1;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(8px);
        transition: transform 0.25s ease, background 0.25s ease;
    }

    .slider-nav-btn:hover {
        background: var(--toska-600);
        transform: translateY(-50%) scale(1.12);
    }

    .slider-prev { left: 14px; }
    .slider-next { right: 14px; }

    /* Controls Bar & Thumbnails */
    .slider-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 16px;
        padding-top: 14px;
        border-top: 1px solid var(--border);
    }

    .thumb-strip {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding: 4px 2px;
        flex: 1;
    }

    .thumb-btn {
        position: relative;
        width: 84px;
        height: 54px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid transparent;
        padding: 0;
        cursor: pointer;
        flex-shrink: 0;
        opacity: 0.6;
        transition: transform 0.25s ease, opacity 0.25s ease, border-color 0.25s ease;
    }

    .thumb-btn:hover {
        opacity: 0.9;
        transform: scale(1.06);
    }

    .thumb-btn.active {
        opacity: 1;
        border-color: var(--toska-600);
        transform: scale(1.06);
        box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
    }

    .thumb-btn img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .autoplay-btn {
        padding: 8px 14px;
        border-radius: 10px;
        border: 1px solid var(--toska-300);
        background: var(--toska-50);
        color: var(--toska-800);
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .autoplay-btn:hover {
        background: var(--toska-600);
        color: #fff;
    }

    /* ========== GRID SEMUA FOTO ========== */
    .galeri-section-title {
        font-size: clamp(1.35rem, 2.5vw, 1.8rem);
        font-weight: 800;
        color: var(--toska-950);
        margin: 0 0 6px;
    }

    .galeri-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 22px;
        margin-top: 20px;
    }

    .galeri-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s ease, border-color 0.35s ease;
        cursor: pointer;
    }

    .galeri-card:hover {
        transform: scale(1.03) translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: var(--toska-400);
    }

    .galeri-card-img {
        height: 200px;
        overflow: hidden;
        background: var(--toska-100);
    }

    .galeri-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
        display: block;
    }

    .galeri-card:hover .galeri-card-img img {
        transform: scale(1.1);
    }

    .galeri-card-body {
        padding: 16px 18px;
    }

    .galeri-card-body h3 {
        margin: 0 0 6px;
        font-size: 1.05rem;
        color: var(--text-dark);
    }

    .galeri-card-body p {
        margin: 0;
        font-size: 0.88rem;
        color: var(--text-muted);
        line-height: 1.5;
    }

    /* Lightbox Zoom Modal */
    .lightbox-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 999;
        background: rgba(4, 47, 46, 0.92);
        backdrop-filter: blur(8px);
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .lightbox-modal.open {
        display: flex;
        animation: slideZoomIn 0.25s ease forwards;
    }

    .lightbox-content {
        max-width: 920px;
        width: 100%;
        text-align: center;
        color: #fff;
        position: relative;
    }

    .lightbox-content img {
        max-width: 100%;
        max-height: 76vh;
        border-radius: 14px;
        border: 2px solid rgba(153, 246, 228, 0.35);
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.5);
    }

    .lightbox-close {
        position: absolute;
        top: -42px;
        right: 0;
        background: rgba(255, 255, 255, 0.16);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 999px;
        padding: 6px 14px;
        font-weight: 700;
        cursor: pointer;
    }

    @media (max-width: 640px) {
        .slider-stage {
            aspect-ratio: 4 / 3;
        }

        .slider-nav-btn {
            width: 38px;
            height: 38px;
            font-size: 1.2rem;
        }
    }
</style>
@endpush

@section('content')
    <section class="galeri-hero">
        <div class="galeri-hero-bg" aria-hidden="true"></div>
        <div class="galeri-orb galeri-orb-1"></div>
        <div class="galeri-orb galeri-orb-2"></div>
        <div class="galeri-hero-inner">
            <span class="galeri-kicker">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                Dokumentasi Resmi
            </span>
            <h1>Galeri Foto {{ $profile->nama_sekolah }}</h1>
            <p>Jelajahi momen terbaik, kegiatan belajar, fasilitas, dan prestasi siswa dalam tampilan slide interaktif.</p>
        </div>
    </section>

    <div class="galeri-container">
        @if ($galleries->isEmpty())
            <div class="slider-card" style="text-align: center; padding: 48px 20px;">
                <p style="font-size: 1.05rem; color: var(--text-muted); margin: 0 0 16px;">Belum ada foto di galeri sekolah.</p>
                <a class="btn" href="{{ route('home') }}">&larr; Kembali ke Home</a>
            </div>
        @else
            {{-- SLIDE FOTO INTERAKTIF --}}
            <div class="slider-card" id="gallerySlider">
                <div class="slider-stage">
                    @foreach ($galleries as $index => $item)
                        <div class="slide-item {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                 alt="{{ $item->judul }}"
                                 data-title="{{ $item->judul }}"
                                 data-desc="{{ $item->deskripsi }}"
                                 onclick="openLightbox(this.src, this.dataset.title, this.dataset.desc)">
                            <div class="slide-gradient"></div>
                            <div class="slide-caption">
                                <div class="slide-badge-row">
                                    <span class="slide-counter">Foto {{ $index + 1 }} / {{ $galleries->count() }}</span>
                                    <span class="slide-counter" style="background: rgba(255,255,255,0.18);">Klik foto untuk Zoom</span>
                                </div>
                                <h2 class="slide-title">{{ $item->judul }}</h2>
                                @if ($item->deskripsi)
                                    <p class="slide-desc">{{ $item->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @if ($galleries->count() > 1)
                        <button type="button" class="slider-nav-btn slider-prev" id="prevSlide" aria-label="Foto sebelumnya">&#8249;</button>
                        <button type="button" class="slider-nav-btn slider-next" id="nextSlide" aria-label="Foto berikutnya">&#8250;</button>
                    @endif
                </div>

                @if ($galleries->count() > 1)
                    <div class="slider-controls">
                        <div class="thumb-strip" id="thumbStrip">
                            @foreach ($galleries as $index => $item)
                                <button type="button"
                                        class="thumb-btn {{ $index === 0 ? 'active' : '' }}"
                                        data-index="{{ $index }}"
                                        aria-label="Lihat foto {{ $item->judul }}">
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
                                </button>
                            @endforeach
                        </div>
                        <button type="button" class="autoplay-btn" id="toggleAutoplay">⏸ Jeda Slide</button>
                    </div>
                @endif
            </div>

            {{-- DAFTAR SEMUA FOTO (RINCIAN NAMA & DESKRIPSI) --}}
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                <div>
                    <h2 class="galeri-section-title">Semua Koleksi Foto</h2>
                    <p style="margin:0; color:var(--text-muted);">Klik kartu foto untuk menampilkan pada slide utama atau memperbesar gambar.</p>
                </div>
                <a class="btn" href="{{ route('home') }}">&larr; Kembali ke Home</a>
            </div>

            <div class="galeri-grid">
                @foreach ($galleries as $index => $item)
                    <article class="galeri-card" onclick="selectSlideAndScroll({{ $index }})">
                        <div class="galeri-card-img">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
                        </div>
                        <div class="galeri-card-body">
                            <h3>{{ $item->judul }}</h3>
                            <p>{{ $item->deskripsi ?: 'Dokumentasi kegiatan sekolah.' }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>

    {{-- MODAL LIGHTBOX ZOOM --}}
    <div class="lightbox-modal" id="lightboxModal" onclick="if(event.target === this) closeLightbox()">
        <div class="lightbox-content">
            <button type="button" class="lightbox-close" onclick="closeLightbox()">&times; Tutup</button>
            <img id="lightboxImg" src="" alt="Preview Foto">
            <h3 id="lightboxTitle" style="margin: 14px 0 4px;"></h3>
            <p id="lightboxDesc" style="margin: 0; color: var(--toska-100); font-size: 0.95rem;"></p>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (function () {
        const slides = document.querySelectorAll('.slide-item');
        const thumbs = document.querySelectorAll('.thumb-btn');
        const prevBtn = document.getElementById('prevSlide');
        const nextBtn = document.getElementById('nextSlide');
        const autoplayBtn = document.getElementById('toggleAutoplay');

        if (!slides.length) return;

        let current = 0;
        let isPlaying = true;
        let timer = null;

        function goToSlide(index) {
            slides[current].classList.remove('active');
            if (thumbs[current]) thumbs[current].classList.remove('active');

            current = (index + slides.length) % slides.length;

            slides[current].classList.add('active');
            if (thumbs[current]) {
                thumbs[current].classList.add('active');
                thumbs[current].scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            }
        }

        function startAutoplay() {
            stopAutoplay();
            if (slides.length > 1 && isPlaying) {
                timer = setInterval(function () {
                    goToSlide(current + 1);
                }, 4500);
            }
        }

        function stopAutoplay() {
            if (timer) clearInterval(timer);
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                goToSlide(current - 1);
                startAutoplay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                goToSlide(current + 1);
                startAutoplay();
            });
        }

        thumbs.forEach(function (btn) {
            btn.addEventListener('click', function () {
                goToSlide(parseInt(btn.dataset.index, 10));
                startAutoplay();
            });
        });

        if (autoplayBtn) {
            autoplayBtn.addEventListener('click', function () {
                isPlaying = !isPlaying;
                autoplayBtn.textContent = isPlaying ? '⏸ Jeda Slide' : '▶ Putar Slide';
                if (isPlaying) startAutoplay();
                else stopAutoplay();
            });
        }

        window.selectSlideAndScroll = function (idx) {
            goToSlide(idx);
            startAutoplay();
            document.getElementById('gallerySlider')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        };

        startAutoplay();
    })();

    function openLightbox(src, title, desc) {
        const modal = document.getElementById('lightboxModal');
        document.getElementById('lightboxImg').src = src;
        document.getElementById('lightboxTitle').textContent = title || '';
        document.getElementById('lightboxDesc').textContent = desc || '';
        modal.classList.add('open');
    }

    function closeLightbox() {
        document.getElementById('lightboxModal').classList.remove('open');
    }
</script>
@endpush
