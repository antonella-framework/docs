<!DOCTYPE html>
<html lang="@php echo ((strpos($page->getPath(), '/es/') === 0 || $page->getPath() === '/es') ? 'es' : 'en'); @endphp">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @php
            $isEs = (strpos($page->getPath(), '/es/') === 0 || $page->getPath() === '/es');
            $lang = $isEs ? 'es' : 'en';
            $localized = $page->languages[$lang] ?? [];
            $siteNameLoc = $localized['siteName'] ?? $page->siteName;
            $siteDescLoc = $localized['siteDescription'] ?? ($page->siteDescription ?? '');

            $base = rtrim($page->baseUrl, '/');
            $pathRaw = trim($page->getPath(), '/');
            if ($isEs) {
                $englishPath = ltrim(substr($pathRaw, 3), '/');
            } else {
                $englishPath = $pathRaw;
            }
            $spanishPath = trim('es/' . $englishPath, '/');

            $enUrl = $base . '/' . $englishPath;
            $esUrl = $base . '/' . $spanishPath;
            if ($englishPath === '') { $enUrl = $base . '/'; }
            if ($spanishPath === 'es') { $esUrl = $base . '/es/'; }
        @endphp
        <link rel="canonical" href="{{ $page->getUrl() }}">
        <meta name="robots" content="index,follow" />
        <meta name="description" content="{{ $page->description ?? $siteDescLoc }}">
        <meta name="keywords" content="@php echo $isEs
            ? 'framework wordpress, antonella framework, desarrollar plugins, programar plugins wordpress, blade, gutenberg, rest api, docker, php 8, consola antonella'
            : 'wordpress framework, antonella framework, develop plugins, build wordpress plugins, blade, gutenberg, rest api, docker, php 8, antonella cli'; @endphp" />
        <link rel="alternate" hreflang="en" href="@php echo $enUrl; @endphp" />
        <link rel="alternate" hreflang="es" href="@php echo $esUrl; @endphp" />
        <link rel="alternate" hreflang="x-default" href="@php echo $enUrl; @endphp" />

        <!-- Open Graph / Twitter -->
        <meta property="og:site_name" content="{{ $siteNameLoc }}"/>
        <meta property="og:title" content="{{ $page->title ?  $page->title . ' | ' : '' }}{{ $siteNameLoc }}"/>
        <meta property="og:description" content="{{ $page->description ?? $siteDescLoc }}"/>
        <meta property="og:url" content="{{ $page->getUrl() }}"/>
        <meta property="og:image" content="{{ $page->baseUrl }}/assets/img/antonella-logo.png"/>
        <meta property="og:type" content="website"/>
        <meta property="og:locale" content="@php echo $isEs ? 'es_ES' : 'en_US'; @endphp"/>
        <meta property="og:locale:alternate" content="@php echo $isEs ? 'en_US' : 'es_ES'; @endphp"/>

        <meta name="twitter:title" content="{{ $page->title ?  $page->title . ' | ' : '' }}{{ $siteNameLoc }}">
        <meta name="twitter:description" content="{{ $page->description ?? $siteDescLoc }}">
        <meta name="twitter:image" content="{{ $page->baseUrl }}/assets/img/antonella-logo.png">
        <meta name="twitter:image:alt" content="{{ $siteNameLoc }}">
        <meta name="twitter:card" content="summary_large_image">

        <title>{{ $siteNameLoc }}{{ $page->title ? ' | ' . $page->title : '' }}</title>
        @viteRefresh()
        <link rel="stylesheet" href="{{ vite('source/_assets/css/main.css') }}">
        <script defer type="module" src="{{ vite('source/_assets/js/main.js') }}"></script>
    </head>
    <body class="text-gray-900 font-sans antialiased">
        @yield('body')
    </body>
</html>
