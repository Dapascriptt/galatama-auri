@php
    $adminIcons = [
        'fish' => '<path d="M6.5 12c.94-3.46 4.94-6 8.5-6 3.56 0 6.06 2.54 7 6-.94 3.47-3.44 6-7 6s-7.56-2.53-8.5-6Z"/><path d="M18 12v.5"/><path d="M16 17.93a9.77 9.77 0 0 1 0-11.86"/><path d="M7 10.67C7 8 5.58 5.97 2.73 5.5c-1 1.5-1 5 .23 6.5-1.24 1.5-1.24 5-.23 6.5C5.58 18.03 7 16 7 13.33"/>',
        'grid' => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>',
        'sliders' => '<path d="M4 21v-7M4 10V3M12 21v-9M12 8V3M20 21v-5M20 12V3"/><path d="M2 14h4M10 8h4M18 16h4"/>',
        'waves' => '<path d="M2 6c2.2 0 2.8 1.8 5 1.8S9.8 6 12 6s2.8 1.8 5 1.8S19.8 6 22 6"/><path d="M2 12c2.2 0 2.8 1.8 5 1.8s2.8-1.8 5-1.8 2.8 1.8 5 1.8 2.8-1.8 5-1.8"/><path d="M2 18c2.2 0 2.8 1.8 5 1.8s2.8-1.8 5-1.8 2.8 1.8 5 1.8 2.8-1.8 5-1.8"/>',
        'image' => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"/>',
        'tag' => '<path d="M12 2H2v10l9.3 9.3a1.7 1.7 0 0 0 2.4 0l7.6-7.6a1.7 1.7 0 0 0 0-2.4Z"/><path d="M7 7h.01"/>',
        'users' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'phone' => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.8 2.1Z"/>',
        'external' => '<path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M21 14v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h6"/>',
        'logout' => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/>',
        'check' => '<circle cx="12" cy="12" r="9"/><path d="m8.5 12.5 2.5 2.5 5-5"/>',
    ];

    $adminIcon = fn (string $name, int $size = 19) => '<svg class="ic" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'.($adminIcons[$name] ?? '').'</svg>';

    $adminMenu = [
        ['route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'icon' => 'grid', 'label' => 'Dashboard'],
        ['route' => 'admin.settings.edit', 'match' => 'admin.settings.*', 'icon' => 'sliders', 'label' => 'Home Settings'],
        ['route' => 'admin.facilities.index', 'match' => 'admin.facilities.*', 'icon' => 'waves', 'label' => 'Fasilitas'],
        ['route' => 'admin.galleries.index', 'match' => 'admin.galleries.*', 'icon' => 'image', 'label' => 'Galeri'],
        ['route' => 'admin.packages.index', 'match' => 'admin.packages.*', 'icon' => 'tag', 'label' => 'Paket'],
        ['route' => 'admin.participants.index', 'match' => 'admin.participants.*', 'icon' => 'users', 'label' => 'Peserta'],
        ['route' => 'admin.contacts.edit', 'match' => 'admin.contacts.*', 'icon' => 'phone', 'label' => 'Kontak'],
    ];
@endphp
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | Pemancingan AURI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}?v={{ filemtime(public_path('assets/app.css')) }}">
    <script src="{{ asset('assets/app.js') }}?v={{ filemtime(public_path('assets/app.js')) }}" defer></script>
</head>
<body class="admin-body">
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <a class="admin-brand" href="{{ route('admin.dashboard') }}">
                {!! $adminIcon('fish', 24) !!}
                <span>Admin AURI</span>
            </a>
            <p class="admin-menu-label">Menu</p>
            <nav class="admin-menu" aria-label="Navigasi admin">
                @foreach($adminMenu as $item)
                    <a href="{{ route($item['route']) }}" @class(['active' => request()->routeIs($item['match'])])>
                        {!! $adminIcon($item['icon']) !!}
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
            <div class="admin-sidebar-foot">
                <a class="admin-menu-link" href="{{ route('home') }}" target="_blank" rel="noopener">
                    {!! $adminIcon('external') !!}
                    <span>Lihat Website</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="admin-menu-link admin-logout" type="submit">
                        {!! $adminIcon('logout') !!}
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>
        <main class="admin-main">
            <header class="admin-topbar">
                <div>
                    <p class="eyebrow">Pemancingan Galatama AURI</p>
                    <h1>@yield('title')</h1>
                </div>
                <a class="btn btn-outline" href="{{ route('home') }}" target="_blank" rel="noopener">
                    Lihat Website
                    {!! $adminIcon('external', 16) !!}
                </a>
            </header>
            @if(session('success'))
                <div class="flash">
                    {!! $adminIcon('check', 20) !!}
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
