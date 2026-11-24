<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Portal informasi resmi ' . ($profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN') . ': profil sekolah, direktori guru, ekstrakurikuler, prestasi, informasi PPDB, dan galeri kegiatan.')">
    <title>@yield('title', $profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:opsz,wght@6..72,600;6..72,700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tokens.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <script>document.documentElement.classList.add('js');</script>
    @stack('styles')
</head>
<body>
    <div class="scroll-progress" id="scrollProgress" aria-hidden="true"></div>
    @php
        $navSchoolParts = preg_split('/\s+/', trim($profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN'));
        $navLastIdx = count($navSchoolParts) - 1;
    @endphp
    <header class="site-header" id="siteHeader">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="brand" aria-label="Beranda {{ $profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN' }}">
                <img src="{{ asset('images/logo.png') }}"
                     alt=""
                     width="38"
                     height="38"
                     class="brand-logo"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-flex';">
                <span class="brand-badge" style="display: none;" aria-hidden="true">{{ strtoupper(substr($profile->nama_sekolah ?? 'S', 0, 1)) }}</span>
                <span>
                    @foreach ($navSchoolParts as $i => $word)
                        @if (is_numeric($word))
                            <span class="name-number">{{ $word }}</span>
                        @elseif ($i === $navLastIdx && $navLastIdx > 0)
                            <span class="name-accent">{{ $word }}</span>
                        @else
                            <span class="name-primary">{{ $word }}</span>
                        @endif
                    @endforeach
                </span>
            </a>

            <button type="button" class="nav-toggle" id="navToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <nav class="nav-links" id="navLinks" aria-label="Navigasi utama">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>

                <div class="nav-item" data-dropdown>
                    <button type="button" class="nav-link {{ request()->routeIs('profil', 'guru', 'ekstrakurikuler', 'prestasi') ? 'active' : '' }}" aria-expanded="false">
                        Tentang sekolah
                        <svg class="nav-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="nav-dropdown">
                        <a class="dropdown-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/></svg>
                            Profil &amp; Kepala Sekolah
                        </a>
                        <a class="dropdown-link {{ request()->routeIs('guru') ? 'active' : '' }}" href="{{ route('guru') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Direktori Guru &amp; GTK
                        </a>
                        <a class="dropdown-link {{ request()->routeIs('ekstrakurikuler') ? 'active' : '' }}" href="{{ route('ekstrakurikuler') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                            Ekstrakurikuler
                        </a>
                        <a class="dropdown-link {{ request()->routeIs('prestasi') ? 'active' : '' }}" href="{{ route('prestasi') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                            Pojok Prestasi
                        </a>
                    </div>
                </div>

                <a class="nav-link {{ request()->routeIs('informasi*') ? 'active' : '' }}" href="{{ route('informasi') }}">Informasi</a>
                <a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ route('galeri') }}">Galeri</a>
                <a class="nav-link nav-action {{ request()->routeIs('ppdb') ? 'active' : '' }}" href="{{ route('ppdb') }}">Informasi PPDB</a>

                @auth
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="@yield('main-class', 'page-main')">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-mast">
                <a href="{{ route('home') }}" class="footer-brand">
                    <img src="{{ asset('images/logo.png') }}"
                         alt=""
                         width="36"
                         height="36"
                         class="brand-logo"
                         onerror="this.style.display='none'">
                    <span class="footer-brand-name">
                        @foreach ($navSchoolParts as $i => $word)
                            @if (is_numeric($word))
                                <span class="name-number">{{ $word }}</span>
                            @elseif ($i === $navLastIdx && $navLastIdx > 0)
                                <span class="name-accent">{{ $word }}</span>
                            @else
                                <span class="name-primary">{{ $word }}</span>
                            @endif
                        @endforeach
                    </span>
                </a>

                <nav class="footer-nav" aria-label="Navigasi footer">
                    <a href="{{ route('home') }}">Beranda</a>
                    <a href="{{ route('profil') }}">Profil</a>
                    <a href="{{ route('guru') }}">Guru &amp; GTK</a>
                    <a href="{{ route('ekstrakurikuler') }}">Ekstrakurikuler</a>
                    <a href="{{ route('prestasi') }}">Prestasi</a>
                    <a href="{{ route('informasi') }}">Informasi</a>
                    <a href="{{ route('ppdb') }}">PPDB</a>
                    <a href="{{ route('galeri') }}">Galeri</a>
                </nav>
            </div>

            <div class="footer-colophon">
                <p>
                    &copy; {{ date('Y') }} {{ $profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN' }}@if (!empty($profile->alamat)), {{ $profile->alamat }}@endif.
                </p>
                @auth
                    <a class="footer-admin-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                @else
                    <a class="footer-admin-link" href="{{ route('login') }}">Portal Admin</a>
                @endauth
            </div>
        </div>
    </footer>

    <script>
        (function () {
            const toggle = document.getElementById('navToggle');
            const links = document.getElementById('navLinks');
            const header = document.getElementById('siteHeader');

            if (toggle && links) {
                toggle.addEventListener('click', function () {
                    const isOpen = links.classList.toggle('open');
                    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            }

            document.querySelectorAll('[data-dropdown] > button').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const parent = btn.closest('[data-dropdown]');
                    const wasOpen = parent.classList.contains('open');
                    document.querySelectorAll('[data-dropdown].open').forEach(function (item) {
                        item.classList.remove('open');
                        const b = item.querySelector('button');
                        if (b) b.setAttribute('aria-expanded', 'false');
                    });
                    if (!wasOpen) {
                        parent.classList.add('open');
                        btn.setAttribute('aria-expanded', 'true');
                    }
                });
            });

            document.addEventListener('click', function () {
                document.querySelectorAll('[data-dropdown].open').forEach(function (item) {
                    item.classList.remove('open');
                    const b = item.querySelector('button');
                    if (b) b.setAttribute('aria-expanded', 'false');
                });
            });

            const progressBar = document.getElementById('scrollProgress');
            let scrollTicking = false;

            function onScrollFrame() {
                if (header) {
                    header.classList.toggle('scrolled', window.scrollY > 12);
                }
                if (progressBar) {
                    const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
                    const ratio = maxScroll > 0 ? Math.min(window.scrollY / maxScroll, 1) : 0;
                    progressBar.style.transform = 'scaleX(' + ratio.toFixed(4) + ')';
                }
                scrollTicking = false;
            }

            window.addEventListener('scroll', function () {
                if (!scrollTicking) {
                    window.requestAnimationFrame(onScrollFrame);
                    scrollTicking = true;
                }
            }, { passive: true });
            onScrollFrame();
        })();
    </script>
    @stack('scripts')
</body>
</html>
