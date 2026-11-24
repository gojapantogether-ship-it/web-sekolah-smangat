<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Login Admin Sekolah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: linear-gradient(135deg, #0f172a 0%, #134e4a 55%, #0d9488 100%);
            color: #0f172a;
        }
        .card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 20px;
            padding: 32px 28px;
            border-top: 5px solid #f59e0b;
            box-shadow: 0 24px 50px rgba(4, 47, 46, 0.35);
        }
        h1 {
            margin: 0 0 6px;
            font-size: 1.6rem;
            font-weight: 800;
            color: #0f172a;
        }
        .subtitle {
            margin: 0 0 20px;
            font-size: 0.9rem;
            color: #64748b;
        }
        label {
            display: block;
            font-weight: 700;
            font-size: 0.88rem;
            margin-top: 14px;
            color: #1e293b;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 11px 13px;
            margin-top: 6px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.95rem;
        }
        input:focus {
            outline: none;
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.16);
        }
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 18px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            color: #1e293b;
            font-weight: 700;
            font-size: 0.92rem;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-primary {
            flex: 1;
            border: none;
            background: linear-gradient(135deg, #0d9488, #0f172a);
            color: #fff;
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(15, 23, 42, 0.14);
        }
        .error {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            color: #b91c1c;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 600;
            margin-bottom: 14px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Login Admin</h1>
        <p class="subtitle">Masuk untuk mengelola konten website sekolah.</p>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label style="font-weight: 500; display:flex; align-items:center; gap:8px; cursor:pointer;">
                <input type="checkbox" name="remember" style="width:auto; margin:0;"> Ingat saya
            </label>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Masuk</button>
                <a href="{{ route('home') }}" class="btn">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
