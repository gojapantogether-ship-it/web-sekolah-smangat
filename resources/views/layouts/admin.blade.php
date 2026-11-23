<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - Admin Panel</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --toska-950: #042f2e;
            --toska-900: #134e4a;
            --toska-800: #115e59;
            --toska-700: #0f766e;
            --toska-600: #0d9488;
            --toska-500: #14b8a6;
            --toska-400: #2dd4bf;
            --toska-100: #ccfbf1;
            --toska-50:  #f0fdfa;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg-page: #f1f5f9;
            --surface: #ffffff;
            --border: #e2e8f0;
            --radius-md: 10px;
            --radius-lg: 16px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.55;
            color: var(--text-dark);
            background: var(--bg-page);
        }

        .admin-shell {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .admin-sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--toska-950) 0%, var(--toska-900) 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 50;
            transition: transform 0.25s ease;
        }

        .sidebar-brand {
            padding: 20px 20px 18px;
            border-bottom: 1px solid rgba(153, 246, 228, 0.14);
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 1.05rem;
        }

        .sidebar-badge {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--toska-500), var(--toska-400));
            color: var(--toska-950);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.9rem;
        }

        .sidebar-logo {
            width: 34px;
            height: 34px;
            object-fit: contain;
            border-radius: 8px;
            background: #ffffff;
            padding: 2px;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .sidebar-menu {
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex-grow: 1;
        }

        .menu-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(153, 246, 228, 0.65);
            font-weight: 700;
            padding: 12px 12px 4px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            color: rgba(240, 253, 250, 0.85);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, var(--toska-600), var(--toska-500));
            color: #fff;
            box-shadow: 0 6px 16px rgba(20, 184, 166, 0.28);
        }

        .sidebar-footer {
            padding: 14px 12px 18px;
            border-top: 1px solid rgba(153, 246, 228, 0.14);
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* Main Area */
        .admin-main-wrap {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-toggle {
            display: none;
            background: var(--toska-50);
            border: 1px solid var(--toska-200);
            color: var(--toska-800);
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 1.15rem;
            cursor: pointer;
        }

        .topbar-title {
            font-weight: 700;
            font-size: 0.98rem;
            color: var(--toska-950);
        }

        .admin-content {
            padding: 24px;
            max-width: 1180px;
            width: 100%;
            margin: 0 auto;
        }

        /* Components */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-dark);
            background: #fff;
            cursor: pointer;
            font-size: 0.88rem;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .btn:hover {
            background: var(--toska-50);
            border-color: var(--toska-500);
            color: var(--toska-800);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--toska-600), var(--toska-700));
            color: #fff;
            border-color: var(--toska-700);
        }

        .btn-primary:hover {
            background: var(--toska-800);
            color: #fff;
        }

        .btn-danger {
            background: #fee2e2;
            color: #b91c1c;
            border-color: #fca5a5;
        }

        .btn-danger:hover {
            background: #fecaca;
            color: #7f1d1d;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 22px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 16px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid #86efac;
            background: #f0fdf4;
            color: #166534;
            margin-bottom: 18px;
            font-weight: 600;
            font-size: 0.92rem;
        }

        .alert-error {
            background: #fef2f2;
            border-color: #fca5a5;
            color: #991b1b;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 620px;
        }

        th, td {
            border-bottom: 1px solid var(--border);
            padding: 12px 14px;
            text-align: left;
            vertical-align: middle;
            font-size: 0.92rem;
        }

        th {
            background: var(--toska-50);
            color: var(--toska-900);
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #f8fafc;
        }

        label {
            display: block;
            font-weight: 700;
            margin-top: 14px;
            font-size: 0.9rem;
            color: var(--text-dark);
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="date"], input[type="url"], select, textarea {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.94rem;
            background: #fff;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--toska-500);
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.15);
        }

        textarea {
            min-height: 110px;
        }

        h1 {
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--toska-950);
            margin: 0 0 6px;
        }

        h2 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--toska-900);
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(4, 47, 46, 0.45);
            z-index: 45;
        }

        @media (max-width: 900px) {
            .sidebar-toggle {
                display: inline-flex;
            }

            .admin-sidebar {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                transform: translateX(-100%);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .sidebar-backdrop.open {
                display: block;
            }

            .admin-content {
                padding: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="admin-shell">
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="sidebar-logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-flex';">
                <span class="sidebar-badge" style="display: none;">AD</span>
                <span>Admin Sekolah</span>
            </div>

            <nav class="sidebar-menu">
                <span class="menu-label">Utama</span>
                <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    Dashboard
                </a>
                <a class="sidebar-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}" href="{{ route('admin.profil.edit') }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/></svg>
                    Profil, Kepsek &amp; Kontak
                </a>
                <a class="sidebar-link {{ request()->routeIs('admin.hero-slides.*') ? 'active' : '' }}" href="{{ route('admin.hero-slides.index') }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m10 9 5 3-5 3V9z"/></svg>
                    Background Home
                </a>

                <span class="menu-label">Konten Sekolah</span>
                <a class="sidebar-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}" href="{{ route('admin.guru.index') }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Direktori Guru &amp; GTK
                </a>
                <a class="sidebar-link {{ request()->routeIs('admin.ekskul.*') ? 'active' : '' }}" href="{{ route('admin.ekskul.index') }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    Ekstrakurikuler
                </a>
                <a class="sidebar-link {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}" href="{{ route('admin.prestasi.index') }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                    Pojok Prestasi
                </a>
                <a class="sidebar-link {{ request()->routeIs('admin.informasi.*') ? 'active' : '' }}" href="{{ route('admin.informasi.index') }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    Informasi &amp; Berita
                </a>
                <a class="sidebar-link {{ request()->routeIs('admin.ppdb.*') ? 'active' : '' }}" href="{{ route('admin.ppdb.index') }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    Informasi PPDB
                </a>
                <a class="sidebar-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}" href="{{ route('admin.galeri.index') }}">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    Galeri Foto
                </a>
            </nav>

            <div class="sidebar-footer">
                <a class="sidebar-link" href="{{ route('home') }}" target="_blank" style="background: rgba(255,255,255,0.08);">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    Lihat Web Publik
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="width:100%;">Logout</button>
                </form>
            </div>
        </aside>

        <div class="admin-main-wrap">
            <header class="admin-topbar">
                <div class="topbar-left">
                    <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Buka menu admin">&#9776;</button>
                    <span class="topbar-title">@yield('title', 'Dashboard Admin')</span>
                </div>
                <div style="font-size:0.85rem; color:var(--text-muted); font-weight:600;">
                    {{ auth()->user()->name ?? 'Admin' }}
                </div>
            </header>

            <main class="admin-content">
                @if (session('success'))
                    <div class="alert">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul style="margin:0; padding-left:18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        (function () {
            const toggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

            function closeSidebar() {
                sidebar?.classList.remove('open');
                backdrop?.classList.remove('open');
            }

            toggle?.addEventListener('click', function () {
                sidebar?.classList.toggle('open');
                backdrop?.classList.toggle('open');
            });

            backdrop?.addEventListener('click', closeSidebar);
        })();
    </script>
</body>
</html>
