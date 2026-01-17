<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if(isset($globalSettings) && !empty($globalSettings->ga_tracking_id))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $globalSettings->ga_tracking_id }}"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '{{ $globalSettings->ga_tracking_id }}');
        </script>
    @endif
    
    <title>@yield('title', 'Lucas Ternel | Développeur Web & Étudiant MMI à Lens')</title>
    <meta name="description" content="@yield('description', 'Portfolio de Lucas Ternel, Développeur Web spécialisé Laravel. Création de sites sur mesure, vitrines et e-commerce.')">
    <meta name="author" content="Lucas Ternel">
    <meta name="robots" content="index, follow">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicons/favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicons/apple-touch-icon.png') }}">
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
            "image" => asset('images/logo.png'),
            "jobTitle" => "Développeur Web & Étudiant",
            "worksFor" => [
                "@type" => "EducationalOrganization",
                "name" => "Université de Lens"
            ],
            "sameAs" => [
                "https://www.linkedin.com/in/lucas-ternel/",
                "https://github.com/lucas-ternel"
            ]
        ];
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