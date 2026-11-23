<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --toska-950: #042f2e;
            --toska-900: #134e4a;
            --toska-800: #115e59;
            --toska-700: #0f766e;
            --toska-600: #0d9488;
            --toska-500: #14b8a6;
            --toska-400: #2dd4bf;
            --toska-200: #99f6e4;
            --toska-100: #ccfbf1;
            --toska-50:  #f0fdfa;
            --navy-950:  #0f172a;
            --navy-900:  #1e293b;
            --navy-800:  #334155;
            --gold-500:  #f59e0b;
            --gold-400:  #fbbf24;
            --gold-600:  #d97706;
            --gold-100:  #fef3c7;
            --text-dark: #0f172a;
            --text-muted: #475569;
            --bg-page: #f8fafc;
            --surface: #ffffff;
            --border: #e2e8f0;
            --radius-lg: 18px;
            --radius-md: 12px;
            --shadow-sm: 0 4px 14px rgba(15, 23, 42, 0.06);
            --shadow-md: 0 12px 30px rgba(15, 23, 42, 0.11);
            --shadow-lg: 0 20px 45px rgba(15, 23, 42, 0.16);
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.65;
            color: var(--text-dark);
            background-color: var(--bg-page);
            overflow-x: hidden;
        }

        /* ========== Elegan Single-Line Navbar ========== */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
            transition: box-shadow 0.3s ease;
        }

        .site-header.scrolled {
            box-shadow: 0 8px 28px rgba(15, 23, 42, 0.09);
        }

        .nav-container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            text-decoration: none;
            color: var(--navy-950);
            font-weight: 800;
            font-size: 1.05rem;
            letter-spacing: -0.02em;
            white-space: nowrap;
        }

        .brand-badge {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: linear-gradient(135deg, var(--toska-600), var(--navy-900));
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.28);
            flex-shrink: 0;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
            border-radius: 10px;
            flex-shrink: 0;
            background: #ffffff;
            padding: 2px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.9);
        }

        .nav-toggle {
            display: none;
            background: var(--bg-page);
            border: 1px solid var(--border);
            color: var(--navy-900);
            border-radius: 10px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 1.2rem;
            line-height: 1;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            color: var(--navy-800);
            font-weight: 600;
            font-size: 0.92rem;
            padding: 8px 14px;
            border-radius: 10px;
            transition: all 0.22s ease;
            white-space: nowrap;
            cursor: pointer;
            background: transparent;
            border: none;
            font-family: inherit;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--toska-700);
            background: var(--toska-50);
        }

        .nav-chevron {
            font-size: 0.72rem;
            transition: transform 0.2s ease;
        }

        .nav-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            min-width: 230px;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 8px;
            box-shadow: 0 18px 38px rgba(15, 23, 42, 0.14);
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: all 0.22s cubic-bezier(0.22, 1, 0.36, 1);
            z-index: 120;
        }

        .nav-item:hover .nav-dropdown,
        .nav-item.open .nav-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-item:hover .nav-chevron,
        .nav-item.open .nav-chevron {
            transform: rotate(180deg);
        }

        .dropdown-link {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 12px;
            border-radius: 9px;
            text-decoration: none;
            color: var(--navy-800);
            font-weight: 600;
            font-size: 0.88rem;
            transition: all 0.18s ease;
        }

        .dropdown-link:hover,
        .dropdown-link.active {
            background: var(--toska-50);
            color: var(--toska-700);
            padding-left: 16px;
        }

        .nav-link.nav-cta {
            margin-left: 6px;
            background: linear-gradient(135deg, var(--navy-900), var(--toska-700));
            color: #fff;
            padding: 9px 18px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.2);
        }

        .nav-link.nav-cta:hover {
            transform: translateY(-1px) scale(1.03);
            box-shadow: 0 8px 20px rgba(13, 148, 136, 0.3);
            color: #fff;
        }

        /* Shared container & utility classes */
        .page-main {
            max-width: 1140px;
            margin: 0 auto;
            padding: 28px 20px 48px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 10px;
            border: 1px solid var(--toska-600);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            color: #fff;
            background: linear-gradient(135deg, var(--toska-600), var(--toska-700));
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            cursor: pointer;
        }

        .btn:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: var(--shadow-md);
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        /* Footer */
        .site-footer {
            background: var(--navy-950);
            color: #cbd5e1;
            margin-top: 56px;
            padding: 36px 20px;
            border-top: 3px solid var(--gold-500);
        }

        .footer-inner {
            max-width: 1140px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            font-size: 0.92rem;
        }

        .footer-inner p {
            margin: 0;
        }

        .footer-links {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: var(--toska-200);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: var(--gold-400);
        }

        /* Mobile Navigation */
        @media (max-width: 860px) {
            .nav-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .nav-container {
                flex-wrap: wrap;
                padding: 12px 18px;
            }

            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                padding-top: 12px;
                border-top: 1px solid var(--border);
                gap: 4px;
            }

            .nav-links.open {
                display: flex;
                animation: navSlideDown 0.25s ease forwards;
            }

            .nav-link {
                width: 100%;
                justify-content: space-between;
                padding: 11px 14px;
            }

            .nav-dropdown {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                box-shadow: none;
                border: none;
                background: var(--bg-page);
                padding: 4px 8px 8px 16px;
                display: none;
            }

            .nav-item.open .nav-dropdown {
                display: block;
            }

            .nav-link.nav-cta {
                margin-left: 0;
                margin-top: 6px;
                justify-content: center;
            }
        }

        @keyframes navSlideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @stack('styles')
</head>
<body>
    <header class="site-header" id="siteHeader">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo {{ $profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN' }}" class="brand-logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-flex';">
                <span class="brand-badge" style="display: none;">{{ strtoupper(substr($profile->nama_sekolah ?? 'S', 0, 1)) }}</span>
                <span>{{ $profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN' }}</span>
            </a>

            <button type="button" class="nav-toggle" id="navToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                &#9776;
            </button>

            <nav class="nav-links" id="navLinks">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>

                <div class="nav-item" data-dropdown>
                    <button type="button" class="nav-link {{ request()->routeIs('profil', 'guru', 'ekstrakurikuler', 'prestasi') ? 'active' : '' }}">
                        Tentang Sekolah <span class="nav-chevron">&#9662;</span>
                    </button>
                    <div class="nav-dropdown">
                        <a class="dropdown-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/></svg>
                            Profil &amp; Kepala Sekolah
                        </a>
                        <a class="dropdown-link {{ request()->routeIs('guru') ? 'active' : '' }}" href="{{ route('guru') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Direktori Guru &amp; GTK
                        </a>
                        <a class="dropdown-link {{ request()->routeIs('ekstrakurikuler') ? 'active' : '' }}" href="{{ route('ekstrakurikuler') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                            Ekstrakurikuler
                        </a>
                        <a class="dropdown-link {{ request()->routeIs('prestasi') ? 'active' : '' }}" href="{{ route('prestasi') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                            Pojok Prestasi
                        </a>
                    </div>
                </div>

                <div class="nav-item" data-dropdown>
                    <button type="button" class="nav-link {{ request()->routeIs('informasi*', 'ppdb') ? 'active' : '' }}">
                        Info &amp; PPDB <span class="nav-chevron">&#9662;</span>
                    </button>
                    <div class="nav-dropdown">
                        <a class="dropdown-link {{ request()->routeIs('informasi*') ? 'active' : '' }}" href="{{ route('informasi') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            Berita &amp; Pengumuman
                        </a>
                        <a class="dropdown-link {{ request()->routeIs('ppdb') ? 'active' : '' }}" href="{{ route('ppdb') }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                            Informasi PPDB
                        </a>
                    </div>
                </div>

                <a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ route('galeri') }}">Galeri</a>

                @auth
                    <a class="nav-link nav-cta" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                @else
                    <a class="nav-link nav-cta" href="{{ route('login') }}">Login Admin</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="@yield('main-class', 'page-main')">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="footer-inner">
            <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 10px;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo {{ $profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN' }}" style="height: 32px; width: auto; object-fit: contain; background: #fff; padding: 2px; border-radius: 6px;">
                <span style="font-weight: 700; color: #fff;">{{ $profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN' }}</span>
            </div>
            <p>&copy; {{ date('Y') }} <strong>{{ $profile->nama_sekolah ?? 'SMA NEGERI 1 BENDUNGAN' }}</strong>
                @if (!empty($profile->alamat)) &bull; {{ $profile->alamat }} @endif
                @if (!empty($profile->kontak)) &bull; {{ $profile->kontak }} @endif
            </p>
            <div class="footer-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('profil') }}">Profil</a>
                <a href="{{ route('guru') }}">Guru &amp; GTK</a>
                <a href="{{ route('ekstrakurikuler') }}">Ekskul</a>
                <a href="{{ route('prestasi') }}">Prestasi</a>
                <a href="{{ route('informasi') }}">Informasi</a>
                <a href="{{ route('ppdb') }}">PPDB</a>
                <a href="{{ route('galeri') }}">Galeri</a>
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
                    });
                    if (!wasOpen) parent.classList.add('open');
                });
            });

            document.addEventListener('click', function () {
                document.querySelectorAll('[data-dropdown].open').forEach(function (item) {
                    item.classList.remove('open');
                });
            });

            window.addEventListener('scroll', function () {
                if (!header) return;
                if (window.scrollY > 12) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }, { passive: true });
        })();
    </script>
    @stack('scripts')
</body>
</html>
