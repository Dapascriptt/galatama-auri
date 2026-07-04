<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin | Pemancingan AURI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}?v={{ filemtime(public_path('assets/app.css')) }}">
    <script src="{{ asset('assets/app.js') }}?v={{ filemtime(public_path('assets/app.js')) }}" defer></script>
</head>
<body class="admin-auth">
    <main class="login-shell">
        <section class="login-card">
            <span class="login-mark">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6.5 12c.94-3.46 4.94-6 8.5-6 3.56 0 6.06 2.54 7 6-.94 3.47-3.44 6-7 6s-7.56-2.53-8.5-6Z"/><path d="M18 12v.5"/><path d="M16 17.93a9.77 9.77 0 0 1 0-11.86"/><path d="M7 10.67C7 8 5.58 5.97 2.73 5.5c-1 1.5-1 5 .23 6.5-1.24 1.5-1.24 5-.23 6.5C5.58 18.03 7 16 7 13.33"/></svg>
            </span>
            <h1>Login Admin</h1>
            <p>Kelola konten Pemancingan Galatama AURI.</p>
            <form method="POST" action="{{ route('login.store') }}" class="stack-form">
                @csrf
                <label>
                    Email
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <small class="form-error">{{ $message }}</small> @enderror
                </label>
                <label>
                    Password
                    <input type="password" name="password" required>
                    @error('password') <small class="form-error">{{ $message }}</small> @enderror
                </label>
                <label class="check-row">
                    <input type="checkbox" name="remember" value="1">
                    Ingat saya
                </label>
                <button class="btn btn-primary" type="submit">Masuk</button>
            </form>
        </section>
    </main>
</body>
</html>
