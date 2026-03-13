<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if(isset($globalSettings) && !empty($globalSettings->ga_tracking_id))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $globalSettings->ga_tracking_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', '{{ $globalSettings->ga_tracking_id }}');
        </script>
    @endif

    <title>@yield('title', 'Lucas Ternel | Développeur Web & Étudiant MMI à Lens')</title>
    <meta name="description"
        content="@yield('description', 'Portfolio de Lucas Ternel, Développeur Web, étudiant en 2ème année de BUT MMI à Lens. Création de sites sur mesure, vitrines et e-commerce.')">
    <meta name="author" content="Lucas Ternel">
    <meta name="robots" content="{{ request()->is('admin-lt*') ? 'noindex, nofollow' : 'index, follow' }}">
    <link rel="canonical" href="https://lucasternel.com/">


    <link rel="icon" type="image/svg+xml" href="{{ asset('favicons/favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicons/web-app-manifest-192x191.png') }}">
    <link rel="manifest" href="{{ asset('favicons/site.webmanifest') }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Lucas Ternel - Développeur Web')">
    <meta property="og:description" content="@yield('description', 'Portfolio de Lucas Ternel.')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Lucas Ternel')">
    <meta name="twitter:description" content="@yield('description', 'Portfolio de Lucas Ternel.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo.png'))">

    @php
        $jsonLd = [
            "@context" => "https://schema.org",
            "@type" => "Person",
            "name" => "Lucas Ternel",
            "url" => "https://lucasternel.com",
            "image" => asset('images/logo_2.png'),
            "jobTitle" => isset($info) ? $info->job_title : "Développeur Web & Étudiant MMI",
            "worksFor" => [
                "@type" => "Organization",
                "name" => "Université de Lens"
            ],
            "sameAs" => [
                isset($info) && $info->linkedin ? (str_starts_with($info->linkedin, 'http') ? $info->linkedin : 'https://' . $info->linkedin) : null,
                isset($info) && $info->github ? (str_starts_with($info->github, 'http') ? $info->github : 'https://' . $info->github) : null,
                isset($info) && $info->instagram ? (str_starts_with($info->instagram, 'http') ? $info->instagram : 'https://' . $info->instagram) : null,
                isset($info) && $info->youtube ? (str_starts_with($info->youtube, 'http') ? $info->youtube : 'https://' . $info->youtube) : null
            ]
        ];

        if (isset($jsonLd['sameAs']) && is_array($jsonLd['sameAs'])) {
            $jsonLd['sameAs'] = array_values(array_filter($jsonLd['sameAs']));
        }
    @endphp

    <script type="application/ld+json">
        {!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="{{ !request()->routeIs(['home', 'links' , 'admin.dashboard']) ? 'blur-mode' : '' }}">
    
    <main class="page-transition">
        @yield('content')
    </main>
    
    <div class="bottom-blur-zone"></div>

    @if(request()->is('admin-lt*'))
        @include('layouts.partials.navbar-admin')
    @else
        @include('layouts.partials.navbar')
    @endif

</body>
</html>