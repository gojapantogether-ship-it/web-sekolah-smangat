@extends('layouts.app')

@section('title', 'Beranda - ' . $profile->nama_sekolah)

@section('main-class', 'welcome-main')

@section('content')
    @php
        $activeSlides = collect();
        if (isset($heroSlides) && $heroSlides->isNotEmpty()) {
            foreach ($heroSlides as $slide) {
                if ($slide->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($slide->gambar)) {
                    $activeSlides->push(asset('storage/' . $slide->gambar));
                }
            }
        }
        if ($activeSlides->isEmpty()) {
            $activeSlides->push(asset('images/school-hero.jpg'));
        }

        $principalPhoto = ($profile->foto_kepala_sekolah && \Illuminate\Support\Facades\Storage::disk('public')->exists($profile->foto_kepala_sekolah))
            ? asset('storage/' . $profile->foto_kepala_sekolah)
            : asset('images/kepala-sekolah-default.jpg');
    @endphp

    {{-- HERO: POSTER POSTURE + ARCHITECTURAL FROSTED GLASS BAR --}}
    <section class="hero-poster" id="heroSection" aria-label="Sambutan utama sekolah">
        @foreach ($activeSlides as $idx => $slideUrl)
            <div class="hero-bg-slide {{ $idx === 0 ? 'active' : '' }}"
                 style="background-image: url('{{ $slideUrl }}');"
                 aria-hidden="true"></div>
        @endforeach
        <div class="hero-scrim" aria-hidden="true"></div>

        <div class="hero-content">
            @php
                $schoolNameParts = preg_split('/\s+/', trim($profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN'));
                $lastIdx = count($schoolNameParts) - 1;
            @endphp
            <div class="hero-copy">
                <h1 class="hero-title">
                    @foreach ($schoolNameParts as $i => $word)
                        @if (is_numeric($word))
                            <span class="name-number">{{ $word }}</span>
                        @elseif ($i === $lastIdx && $lastIdx > 0)
                            <span class="name-accent">{{ $word }}</span>
                        @else
                            <span class="name-primary">{{ $word }}</span>
                        @endif
                    @endforeach
                </h1>
                <p class="hero-lead">{{ $profile->sambutan_judul }}</p>

                <div class="hero-actions">
                    <a class="btn-primary" href="{{ route('ppdb') }}">Informasi PPDB</a>
                    <a class="btn-glass" href="{{ route('profil') }}">Profil Sekolah</a>
                </div>
            </div>

            <div class="hero-glass-bar glass-interactive" aria-label="Ringkasan data sekolah">
                <div class="hero-stat">
                    <span class="hero-stat-value js-counter" data-target="{{ $profile->jumlah_guru }}">{{ $profile->jumlah_guru }}</span>
                    <span class="hero-stat-label">Guru &amp; pendidik</span>
                </div>

                <div class="hero-stat">
                    <span class="hero-stat-value js-counter" data-target="{{ $profile->jumlah_siswa }}">{{ $profile->jumlah_siswa }}</span>
                    <span class="hero-stat-label">Peserta didik</span>
                </div>

                <div class="hero-location">
                    @if ($profile->alamat)
                        <p class="hero-location-primary">{{ $profile->alamat }}</p>
                    @endif
                    @if ($profile->kontak)
                        <p class="hero-location-secondary">Telepon {{ $profile->kontak }}</p>
                    @endif
                </div>

                @if ($activeSlides->count() > 1)
                    <button type="button"
                            class="hero-slide-control"
                            id="heroSlideToggle"
                            aria-pressed="false"
                            aria-label="Jeda pergantian latar belakang">
                        <span id="heroSlideLabel">Jeda slide</span>
                    </button>
                @endif
            </div>
        </div>
    </section>

    {{-- SAMBUTAN & FOTO KEPALA SEKOLAH (SPLIT 5:7) --}}
    <section class="section-band">
        <div class="container">
            <div class="split-profile reveal-item">
                <div class="split-profile-text">
                    <h2 class="section-heading">Sambutan Kepala Sekolah</h2>

                    @if ($profile->motivasi_kepala_sekolah)
                        <blockquote class="principal-quote">
                            {{ $profile->motivasi_kepala_sekolah }}
                        </blockquote>
                    @endif

                    <p style="white-space: pre-line;">{{ $profile->sambutan_isi ?: $profile->profil_sekolah }}</p>

                    <dl class="facts-list">
                        @if ($profile->nama_kepala_sekolah)
                            <div>
                                <dt>Kepala Sekolah</dt>
                                <dd>{{ $profile->nama_kepala_sekolah }}</dd>
                            </div>
                        @endif
                        @if ($profile->npsn)
                            <div>
                                <dt>NPSN</dt>
                                <dd>{{ $profile->npsn }}</dd>
                            </div>
                        @endif
                        @if ($profile->akreditasi)
                            <div>
                                <dt>Akreditasi</dt>
                                <dd>{{ $profile->akreditasi }}</dd>
                            </div>
                        @endif
                        @if ($profile->email)
                            <div>
                                <dt>Surel resmi</dt>
                                <dd>{{ $profile->email }}</dd>
                            </div>
                        @endif
                    </dl>

                    <a href="{{ route('profil') }}" class="btn-outline">Baca profil lengkap sekolah</a>
                </div>

                <figure class="split-profile-media" style="margin: 0;">
                    <img src="{{ $principalPhoto }}"
                         alt="Foto {{ $profile->nama_kepala_sekolah ?: 'Kepala Sekolah ' . $profile->nama_sekolah }}"
                         width="640"
                         height="800"
                         loading="lazy"
                         onerror="this.src='{{ asset('images/kepala-sekolah-default.jpg') }}'">
                    <figcaption class="media-glass-caption">
                        <div>
                            <strong>{{ $profile->nama_kepala_sekolah ?: 'Kepala Sekolah' }}</strong>
                            <span>Kepala {{ $profile->nama_sekolah }}</span>
                        </div>
                        @if ($profile->akreditasi)
                            <span>Akreditasi {{ $profile->akreditasi }}</span>
                        @endif
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    {{-- INFORMASI & BERITA TERBARU (TINTED BAND + FROSTED EDITORIAL GRID) --}}
    @if (isset($latestInfo) && $latestInfo->isNotEmpty())
        <section class="section-band section-band--tinted">
            <div class="container">
                <div class="section-head-split reveal-item">
                    <h2 class="section-heading">Informasi dan berita terbaru</h2>
                    <p class="section-head-note">Pengumuman akademik, liputan kegiatan siswa, dan kabar terbaru dari lingkungan sekolah.</p>
                </div>

                <div class="news-grid">
                    @foreach ($latestInfo as $idx => $info)
                        @php
                            $infoImg = ($info->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($info->gambar))
                                ? asset('storage/' . $info->gambar)
                                : asset('images/informasi/dummy-' . (($idx % 3) + 1) . '.jpg');
                        @endphp
                        <a href="{{ route('informasi.detail', $info->slug) }}" class="news-article reveal-item" style="--i: {{ $idx }};">
                            <div class="news-thumb">
                                <img src="{{ $infoImg }}"
                                     alt="{{ $info->judul }}"
                                     width="600"
                                     height="375"
                                     loading="lazy"
                                     onerror="this.src='{{ asset('images/school-hero.jpg') }}'">
                            </div>
                            <div class="news-body">
                                <div class="news-meta">
                                    <span class="news-category">{{ $info->kategori }}</span>
                                    @if ($info->tanggal_publikasi)
                                        <time datetime="{{ $info->tanggal_publikasi }}">{{ \Carbon\Carbon::parse($info->tanggal_publikasi)->translatedFormat('d M Y') }}</time>
                                    @endif
                                </div>
                                <h3 class="news-title">{{ $info->judul }}</h3>
                                @if ($info->ringkasan)
                                    <p class="news-excerpt">{{ \Illuminate\Support\Str::limit($info->ringkasan, 105) }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="section-foot-action">
                    <a href="{{ route('informasi') }}" class="btn-outline">Lihat semua informasi</a>
                </div>
            </div>
        </section>
    @endif

    {{-- LAYANAN & KEHIDUPAN SEKOLAH (HAIRLINE EDITORIAL ROWS) --}}
    <section class="section-band">
        <div class="container">
            <div class="directory-layout">
                <div class="reveal-item">
                    <h2 class="section-heading">Kehidupan dan layanan sekolah</h2>
                    <p class="section-head-note" style="margin-top: var(--space-md);">Akses langsung ke direktori pendidik, kegiatan kesiswaan, rekam prestasi, dan dokumentasi sekolah.</p>
                </div>

                <div class="directory-list">
                    <a href="{{ route('guru') }}" class="directory-row reveal-item" style="--i: 0;">
                        <h3 class="directory-name">Direktori Guru &amp; GTK</h3>
                        <p class="directory-desc">Daftar tenaga pendidik, mata pelajaran, wali kelas, dan staf tata usaha.</p>
                        <span class="directory-action">Buka direktori</span>
                    </a>

                    <a href="{{ route('ekstrakurikuler') }}" class="directory-row reveal-item" style="--i: 1;">
                        <h3 class="directory-name">Ekstrakurikuler</h3>
                        <p class="directory-desc">Wadah pengembangan minat, bakat, olahraga, sains, dan organisasi siswa.</p>
                        <span class="directory-action">Lihat kegiatan</span>
                    </a>

                    <a href="{{ route('prestasi') }}" class="directory-row reveal-item" style="--i: 2;">
                        <h3 class="directory-name">Pojok Prestasi</h3>
                        <p class="directory-desc">Catatan kejuaraan akademik maupun non-akademik di tingkat daerah hingga nasional.</p>
                        <span class="directory-action">Lihat prestasi</span>
                    </a>

                    <a href="{{ route('galeri') }}" class="directory-row reveal-item" style="--i: 3;">
                        <h3 class="directory-name">Galeri Foto Sekolah</h3>
                        <p class="directory-desc">Dokumentasi kegiatan belajar, fasilitas kampus, dan acara resmi sekolah.</p>
                        <span class="directory-action">Buka galeri</span>
                    </a>

                    <a href="{{ route('ppdb') }}" class="directory-row reveal-item" style="--i: 4;">
                        <h3 class="directory-name">Penerimaan Peserta Didik Baru</h3>
                        <p class="directory-desc">Jadwal pendaftaran, persyaratan berkas, dan panduan calon siswa baru.</p>
                        <span class="directory-action">Cek jadwal</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- KONTAK RESMI (DEEP TEAL-NAVY BAND + FROSTED GLASS PANEL) --}}
    <section class="section-band section-band--field">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-intro reveal-item">
                    <h2 class="section-heading">Kontak resmi sekolah</h2>
                    <p>Untuk pertanyaan seputar penerimaan siswa baru, surat menyurat, atau kunjungan sekolah, silakan hubungi tata usaha kami melalui saluran resmi berikut.</p>
                    <a href="{{ route('ppdb') }}" class="btn-primary">Lihat informasi PPDB</a>
                </div>

                <div class="contact-glass-panel glass-interactive reveal-item" style="--i: 1;">
                    <dl class="contact-dl">
                        <div>
                            <dt>Alamat sekolah</dt>
                            <dd>{{ $profile->alamat ?: 'Belum diisi' }}</dd>
                        </div>
                        <div>
                            <dt>Telepon</dt>
                            <dd>{{ $profile->kontak ?: 'Belum diisi' }}</dd>
                        </div>
                        <div>
                            <dt>Email resmi</dt>
                            <dd>{{ $profile->email ?: 'Belum diisi' }}</dd>
                        </div>
                        <div>
                            <dt>Fax</dt>
                            <dd>{{ $profile->fax ?: 'Belum diisi' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    (function () {
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // Gentle one-time reveal (visible by default when scripting is off)
        const revealEls = document.querySelectorAll('.reveal-item');
        if (prefersReduced || !('IntersectionObserver' in window)) {
            revealEls.forEach(function (el) {
                el.classList.add('is-visible');
            });
        } else {
            const observer = new IntersectionObserver(function (entries, obs) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });

            revealEls.forEach(function (el) {
                observer.observe(el);
            });
        }

        // Smooth count-up on hero stat numbers (tabular-nums)
        const counters = document.querySelectorAll('.js-counter');
        if (!prefersReduced && 'IntersectionObserver' in window && counters.length > 0) {
            const counterObserver = new IntersectionObserver(function (entries, obs) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-target') || '0', 10);
                    if (isNaN(target) || target <= 0) {
                        obs.unobserve(el);
                        return;
                    }
                    const duration = 900;
                    const start = performance.now();
                    function tick(now) {
                        const progress = Math.min((now - start) / duration, 1);
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
        }

        // Interactive pointer-tracking glass sheen
        if (!prefersReduced) {
            document.querySelectorAll('.glass-interactive').forEach(function (panel) {
                panel.addEventListener('pointermove', function (e) {
                    const rect = panel.getBoundingClientRect();
                    const x = ((e.clientX - rect.left) / rect.width) * 100;
                    const y = ((e.clientY - rect.top) / rect.height) * 100;
                    panel.style.setProperty('--mx', x.toFixed(1) + '%');
                    panel.style.setProperty('--my', y.toFixed(1) + '%');
                }, { passive: true });
            });
        }

        // Hero background slideshow every 10s with pause on hover, focus, and visible control (Floor 18)
        const heroSection = document.getElementById('heroSection');
        const bgSlides = document.querySelectorAll('.hero-bg-slide');
        const toggleBtn = document.getElementById('heroSlideToggle');
        const toggleLabel = document.getElementById('heroSlideLabel');

        if (bgSlides.length > 1) {
            let bgIndex = 0;
            let userPaused = prefersReduced;
            let hoverPaused = false;

            function syncPausedState() {
                if (heroSection) {
                    heroSection.classList.toggle('is-paused', userPaused || hoverPaused);
                }
                if (toggleBtn && toggleLabel) {
                    toggleBtn.setAttribute('aria-pressed', userPaused ? 'true' : 'false');
                    toggleLabel.textContent = userPaused ? 'Putar slide' : 'Jeda slide';
                }
            }

            syncPausedState();

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    userPaused = !userPaused;
                    syncPausedState();
                });
            }

            if (heroSection) {
                heroSection.addEventListener('mouseenter', function () { hoverPaused = true; syncPausedState(); });
                heroSection.addEventListener('mouseleave', function () { hoverPaused = false; syncPausedState(); });
                heroSection.addEventListener('focusin', function () { hoverPaused = true; syncPausedState(); });
                heroSection.addEventListener('focusout', function () { hoverPaused = false; syncPausedState(); });
            }

            setInterval(function () {
                if (userPaused || hoverPaused) return;
                bgSlides[bgIndex].classList.remove('active');
                bgIndex = (bgIndex + 1) % bgSlides.length;
                bgSlides[bgIndex].classList.add('active');
            }, 10000);
        }
    })();
</script>
@endpush
