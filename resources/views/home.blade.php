@php
    use Illuminate\Support\Str;

    $imageUrl = fn (?string $path) => $path
        ? (Str::startsWith($path, ['http://', 'https://']) ? $path : asset('storage/'.$path))
        : null;
    $siteUrl = url('/');
    $heroImage = $imageUrl($setting->hero_image);
    $posterImage = $imageUrl($setting->poster_image);
    $aboutImage = $imageUrl($setting->about_image);
    $waNumber = preg_replace('/\D+/', '', $contact->whatsapp ?? '');
    $dailyPackage = $packages->firstWhere('is_featured', true) ?: $packages->first();

    $svgPaths = [
        'fish' => '<path d="M6.5 12c.94-3.46 4.94-6 8.5-6 3.56 0 6.06 2.54 7 6-.94 3.47-3.44 6-7 6s-7.56-2.53-8.5-6Z"/><path d="M18 12v.5"/><path d="M16 17.93a9.77 9.77 0 0 1 0-11.86"/><path d="M7 10.67C7 8 5.58 5.97 2.73 5.5c-1 1.5-1 5 .23 6.5-1.24 1.5-1.24 5-.23 6.5C5.58 18.03 7 16 7 13.33"/>',
        'waves' => '<path d="M2 6c2.2 0 2.8 1.8 5 1.8S9.8 6 12 6s2.8 1.8 5 1.8S19.8 6 22 6"/><path d="M2 12c2.2 0 2.8 1.8 5 1.8s2.8-1.8 5-1.8 2.8 1.8 5 1.8 2.8-1.8 5-1.8"/><path d="M2 18c2.2 0 2.8 1.8 5 1.8s2.8-1.8 5-1.8 2.8 1.8 5 1.8 2.8-1.8 5-1.8"/>',
        'shelter' => '<path d="m3 10 9-7 9 7"/><path d="M5 8.5V21h14V8.5"/><path d="M9 21v-6h6v6"/>',
        'food' => '<path d="M17 9h1a4 4 0 1 1 0 8h-1"/><path d="M3 9h14v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4Z"/><path d="M7 2v3M11 2v3M15 2v3"/>',
        'parking' => '<path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/>',
        'pray' => '<path d="M12 3a6.4 6.4 0 0 0 8.7 8.7A9 9 0 1 1 12 3Z"/><path d="M19 3v4M17 5h4"/>',
        'droplet' => '<path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7Z"/>',
        'wifi' => '<path d="M2 8.8a15 15 0 0 1 20 0"/><path d="M5 12.5a11 11 0 0 1 14 0"/><path d="M8.5 16.1a6 6 0 0 1 7 0"/><path d="M12 20h.01"/>',
        'zap' => '<path d="M13 2 3 14h9l-1 8 10-12h-9l1-8Z"/>',
        'check' => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
        'map-pin' => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
        'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'phone' => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.8 2.1Z"/>',
        'mail' => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>',
        'arrow' => '<path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>',
        'chevron' => '<path d="m6 9 6 6 6-6"/>',
    ];

    $icon = fn (string $name, int $size = 22) => '<svg class="ic" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'.($svgPaths[$name] ?? $svgPaths['fish']).'</svg>';

    $facilityIcon = function (string $title) {
        $t = Str::lower($title);
        $map = [
            'waves' => ['kolam', 'air', 'pemancingan'],
            'shelter' => ['saung', 'gazebo', 'teduh', 'lapak'],
            'food' => ['kantin', 'makan', 'minum', 'menu', 'kopi', 'warung'],
            'parking' => ['parkir', 'mobil', 'motor', 'kendaraan'],
            'pray' => ['mushola', 'musala', 'masjid', 'ibadah', 'sholat', 'shalat'],
            'droplet' => ['toilet', 'kamar mandi', 'wc', 'bilas', 'cuci'],
            'wifi' => ['wifi', 'internet'],
            'zap' => ['lampu', 'penerangan', 'listrik'],
        ];
        foreach ($map as $name => $keywords) {
            if (Str::contains($t, $keywords)) {
                return $name;
            }
        }
        return 'fish';
    };
@endphp
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->meta_title ?: $setting->site_name }}</title>
    <meta name="description" content="{{ $setting->meta_description }}">
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <link rel="canonical" href="{{ $siteUrl }}">
    <meta property="og:title" content="{{ $setting->meta_title ?: $setting->site_name }}">
    <meta property="og:description" content="{{ $setting->meta_description }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $siteUrl }}">
    @if($heroImage)
        <meta property="og:image" content="{{ $heroImage }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/site.css') }}?v={{ filemtime(public_path('assets/site.css')) }}">
    <script src="{{ asset('assets/app.js') }}?v={{ filemtime(public_path('assets/app.js')) }}" defer></script>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "LocalBusiness",
            "name": @json($setting->site_name),
            "image": @json($heroImage),
            "address": @json($contact->address),
            "telephone": @json($contact->phone ?: $contact->whatsapp),
            "url": @json($siteUrl)
        }
    </script>
</head>
<body>
    <a class="skip-link" href="#beranda">Lewati ke konten</a>
    <header class="site-nav" id="navbar">
        <div class="container nav-inner">
            <a class="brand" href="#beranda" aria-label="{{ $setting->site_name }}">
                {!! $icon('fish', 26) !!}
                <span>{{ $setting->site_name }}</span>
            </a>
            <nav class="nav-menu" id="navMenu" aria-label="Navigasi utama">
                <a class="nav-link active" href="#beranda">Beranda</a>
                <a class="nav-link" href="#paket">Paket</a>
                <a class="nav-link" href="#peserta">Peserta</a>
                <a class="nav-link" href="#tentang">Tentang</a>
                <a class="nav-link" href="#fasilitas">Fasilitas</a>
                <a class="nav-link" href="#galeri">Galeri</a>
                <a class="nav-link" href="#kontak">Kontak</a>
            </nav>
            <div class="nav-actions">
                @if($waNumber)
                    <a class="btn btn-nav" href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener">Reservasi</a>
                @endif
                <button class="hamburger" id="hamburger" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="navMenu">
                    <span></span><span></span>
                </button>
            </div>
        </div>
    </header>

    <main>
        <section class="hero" id="beranda" @if($heroImage) style="--hero-image: url('{{ $heroImage }}')" @endif>
            <div class="hero-bg" aria-hidden="true"></div>
            <div class="container hero-inner">
                <div class="hero-copy">
                    @if($setting->hero_eyebrow)
                        <p class="eyebrow eyebrow-light">{{ $setting->hero_eyebrow }}</p>
                    @endif
                    <h1>{{ $setting->hero_title }}</h1>
                    <p class="lead">{{ $setting->hero_subtitle }}</p>
                    <div class="actions">
                        @if($setting->hero_cta_text)
                            <a class="btn btn-light" href="{{ $setting->hero_cta_link ?: '#paket' }}">
                                {{ $setting->hero_cta_text }}
                                {!! $icon('arrow', 18) !!}
                            </a>
                        @endif
                        @if($setting->hero_secondary_text)
                            <a class="btn btn-glass" href="{{ $setting->hero_secondary_link ?: '#kontak' }}">{{ $setting->hero_secondary_text }}</a>
                        @endif
                    </div>
                </div>
            </div>
            @if($setting->highlights)
                <div class="hero-strip">
                    <div class="container hero-strip-inner">
                        @foreach($setting->highlights as $item)
                            <div class="hero-fact">
                                <span>{{ $item['label'] ?? '' }}</span>
                                <strong>{{ $item['value'] ?? '' }}</strong>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        <section class="section section-alt reveal" id="paket">
            <div class="container">
                <div class="section-head section-head-center">
                    <p class="eyebrow">Paket &amp; Harga</p>
                    <h2>Galatama Harian</h2>
                    <p>Info jadwal, lapak, dan harga terbaru langsung dari pengelola kolam.</p>
                </div>
                @if($posterImage)
                    <figure class="poster-figure">
                        <button class="poster-frame" type="button" aria-label="Perbesar poster galatama">
                            <img src="{{ $posterImage }}" alt="Poster galatama {{ $setting->site_name }}" loading="lazy">
                        </button>
                        <figcaption>Klik poster untuk memperbesar.</figcaption>
                        @if($waNumber)
                            <a class="btn btn-primary poster-cta" href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo '.$setting->site_name.', saya ingin daftar galatama harian.') }}" target="_blank" rel="noopener">
                                Daftar via WhatsApp
                                {!! $icon('arrow', 18) !!}
                            </a>
                        @endif
                    </figure>
                @elseif($dailyPackage)
                    <article class="price-panel">
                        <p class="price-tag">Update Hari Ini</p>
                        <h3>{{ $dailyPackage->name }}</h3>
                        @if($dailyPackage->description)
                            <p class="price-desc">{{ $dailyPackage->description }}</p>
                        @endif
                        <p class="price-amount">{{ $dailyPackage->price }}</p>
                        @if($dailyPackage->features)
                            <ul class="price-features">
                                @foreach($dailyPackage->features as $feature)
                                    <li>{!! $icon('check', 17) !!}{{ $feature }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if($waNumber)
                            <a class="btn btn-light" href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo '.$setting->site_name.', saya ingin ikut galatama harian.') }}" target="_blank" rel="noopener">
                                Daftar via WhatsApp
                                {!! $icon('arrow', 18) !!}
                            </a>
                        @endif
                    </article>
                @endif
            </div>
        </section>

        <section class="section reveal" id="peserta">
            <div class="container">
                <div class="section-head section-head-row">
                    <div>
                        <p class="eyebrow">Peserta</p>
                        <h2>Daftar peserta galatama</h2>
                    </div>
                    <p class="section-note">Peserta aktif untuk sesi galatama harian.</p>
                </div>
                @if($participants->isNotEmpty())
                    <details class="participant-accordion">
                        <summary>
                            <span class="participant-summary-label">Lihat daftar peserta</span>
                            <span class="participant-summary-meta">
                                <span class="participant-count">{{ $participants->count() }} peserta</span>
                                {!! $icon('chevron', 20) !!}
                            </span>
                        </summary>
                        <div class="participant-list">
                            @foreach($participants as $participant)
                                <article class="participant-item">
                                    <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div>
                                        <h3>{{ $participant->name }}</h3>
                                        @if($participant->note)
                                            <p>{{ $participant->note }}</p>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </details>
                @else
                    <p class="empty-note">Belum ada peserta terdaftar untuk sesi hari ini.</p>
                @endif
            </div>
        </section>

        @php
            $aboutSlides = collect();

            if ($aboutImage) {
                $aboutSlides->push([
                    'src' => $aboutImage,
                    'alt' => 'Pemenang galatama harian '.$setting->site_name,
                    'caption' => 'Galatama Harian',
                ]);
            }

            foreach ($winners as $winner) {
                $src = $imageUrl($winner->image);
                if ($src && ! $aboutSlides->contains('src', $src)) {
                    $aboutSlides->push([
                        'src' => $src,
                        'alt' => $winner->caption ?: 'Pemenang galatama harian '.$setting->site_name,
                        'caption' => $winner->caption ?: 'Pemenang Galatama',
                    ]);
                }
            }
        @endphp

        <section class="section reveal" id="tentang">
            <div class="container split">
                @if($aboutSlides->isNotEmpty())
                    <div class="about-media">
                        <div class="about-slider" data-slider aria-label="Slider foto pemenang galatama harian">
                            <div class="about-slider-track">
                                @foreach($aboutSlides as $slide)
                                    <figure class="about-slide @if($loop->first) active @endif" data-slide>
                                        <img src="{{ $slide['src'] }}" alt="{{ $slide['alt'] }}" width="560" height="420" loading="lazy">
                                        <figcaption>{{ $slide['caption'] }}</figcaption>
                                    </figure>
                                @endforeach
                            </div>
                            <div class="slider-progress" aria-hidden="true"></div>
                        </div>
                    </div>
                @endif
                <div class="about-copy">
                    <p class="eyebrow">Tentang Kami</p>
                    <h2>{{ $setting->about_title }}</h2>
                    <p>{{ $setting->about_description }}</p>
                </div>
            </div>
        </section>

        <section class="section section-dark reveal" id="fasilitas">
            <div class="container">
                <div class="section-head">
                    <p class="eyebrow">Fasilitas</p>
                    <h2>Semua yang Anda butuhkan, sudah tersedia di lokasi</h2>
                </div>
                <div class="facility-grid" data-stagger>
                    @foreach($facilities as $facility)
                        <article class="facility-item">
                            <span class="facility-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            @if($facility->image)
                                <img class="facility-img" src="{{ $imageUrl($facility->image) }}" alt="{{ $facility->title }}" width="48" height="48" loading="lazy">
                            @else
                                <span class="facility-icon">{!! $icon($facilityIcon($facility->title), 26) !!}</span>
                            @endif
                            <h3>{{ $facility->title }}</h3>
                            <p>{{ $facility->description }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section reveal" id="galeri">
            <div class="container">
                <div class="section-head section-head-row">
                    <div>
                        <p class="eyebrow">Galeri</p>
                        <h2>Suasana di kolam</h2>
                    </div>
                    <p class="section-note">Area kolam, saung, dan momen pemenang galatama.</p>
                </div>
                <div class="gallery-grid" data-stagger aria-label="Galeri foto">
                    @foreach($galleries as $gallery)
                        <button class="gallery-item" type="button" aria-label="Buka foto {{ $loop->iteration }}">
                            <img src="{{ $imageUrl($gallery->image) }}" alt="{{ $gallery->caption ?: 'Galeri '.$setting->site_name }}" width="420" height="300" loading="lazy">
                            @if($gallery->caption)
                                <span>{{ $gallery->caption }}</span>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section section-alt reveal" id="kontak">
            <div class="container">
                <div class="section-head">
                    <p class="eyebrow">Kontak</p>
                    <h2>Reservasi &amp; lokasi</h2>
                </div>
                <div class="contact-grid">
                    <div class="map-panel">
                        @if($contact->maps_embed)
                            <iframe title="Peta {{ $setting->site_name }}" src="{{ $contact->maps_embed }}" width="640" height="420" loading="lazy"></iframe>
                        @endif
                    </div>
                    <div class="contact-card">
                        <h3>{{ $setting->site_name }}</h3>
                        <ul class="contact-list">
                            @if($contact->address)
                                <li>{!! $icon('map-pin', 20) !!}<span>{{ $contact->address }}</span></li>
                            @endif
                            @if($contact->opening_hours)
                                <li>{!! $icon('clock', 20) !!}<span>{{ $contact->opening_hours }}</span></li>
                            @endif
                            @if($contact->phone)
                                <li>{!! $icon('phone', 20) !!}<a href="tel:{{ preg_replace('/\s+/', '', $contact->phone) }}">{{ $contact->phone }}</a></li>
                            @endif
                            @if($contact->email)
                                <li>{!! $icon('mail', 20) !!}<a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></li>
                            @endif
                        </ul>
                        <div class="actions">
                            @if($waNumber)
                                <a class="btn btn-primary" href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo Pemancingan Galatama AURI, saya ingin reservasi.') }}" target="_blank" rel="noopener">Chat WhatsApp</a>
                            @endif
                            @if($contact->maps_url)
                                <a class="btn btn-outline" href="{{ $contact->maps_url }}" target="_blank" rel="noopener">Buka Maps</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <p class="footer-brand">{{ $setting->site_name }}</p>
                <nav class="footer-nav" aria-label="Navigasi footer">
                    <a href="#paket">Paket</a>
                    <a href="#peserta">Peserta</a>
                    <a href="#tentang">Tentang</a>
                    <a href="#fasilitas">Fasilitas</a>
                    <a href="#galeri">Galeri</a>
                    <a href="#kontak">Kontak</a>
                </nav>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ $setting->site_name }}. Semua hak dilindungi.</p>
                <div class="social">
                    @foreach(['instagram' => 'Instagram', 'facebook' => 'Facebook', 'tiktok' => 'TikTok'] as $field => $label)
                        @if($contact->{$field})
                            <a href="{{ $contact->{$field} }}" target="_blank" rel="noopener">{{ $label }}</a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </footer>

    <div class="lightbox" id="lightbox" aria-hidden="true" role="dialog" aria-label="Galeri">
        <button class="lightbox-close" id="lightboxClose" type="button" aria-label="Tutup galeri">&times;</button>
        <button class="lightbox-nav" id="lightboxPrev" type="button" aria-label="Gambar sebelumnya">&lsaquo;</button>
        <img id="lightboxImage" alt="" width="960" height="640">
        <button class="lightbox-nav" id="lightboxNext" type="button" aria-label="Gambar berikutnya">&rsaquo;</button>
    </div>
</body>
</html>
