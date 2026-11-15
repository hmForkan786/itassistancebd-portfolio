<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Factual public metadata. Kept conservative — no claims about clients, ratings or outcomes. --}}
        <title>IT Assistance BD — Digital Solutions Developer &amp; Creative Problem Solver</title>
        <meta
            name="description"
            content="Portfolio of IT Assistance BD: Laravel and Vue web development, API integration, WordPress, digital marketing and graphic design, with selected project initiatives and skills."
        >
        <meta name="robots" content="index, follow">

        {{-- Canonical URL (strategy: current origin + path; production domain is configured via APP_URL). --}}
        <link rel="canonical" href="{{ url('/') }}">

        {{-- Open Graph (base defaults; updated per route by the SPA router). --}}
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="IT Assistance BD">
        <meta property="og:locale" content="en_US">
        <meta property="og:title" content="IT Assistance BD — Digital Solutions Developer &amp; Creative Problem Solver">
        <meta
            property="og:description"
            content="Portfolio of IT Assistance BD: Laravel and Vue web development, API integration, WordPress, digital marketing and graphic design, with selected project initiatives and skills."
        >
        <meta property="og:url" content="{{ url('/') }}">

        {{-- Twitter / X card (summary: no image asset is verified yet). --}}
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="IT Assistance BD — Digital Solutions Developer &amp; Creative Problem Solver">
        <meta
            name="twitter:description"
            content="Portfolio of IT Assistance BD: Laravel and Vue web development, API integration, WordPress, digital marketing and graphic design, with selected project initiatives and skills."
        >

        {{-- Structured data: verified facts only (Person + WebSite). No address/phone/ratings/reviews/clients/certifications/awards/hours. --}}
        <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    '@id' => url('/') . '#website',
                    'url' => url('/'),
                    'name' => 'IT Assistance BD Portfolio',
                    'description' => 'Portfolio of IT Assistance BD: Laravel and Vue web development, API integration, WordPress, digital marketing and graphic design, with selected project initiatives and skills.',
                    'inLanguage' => 'en',
                ],
                [
                    '@type' => 'Person',
                    '@id' => url('/') . '#person',
                    'name' => 'IT Assistance BD',
                    'url' => url('/'),
                    'jobTitle' => 'Digital Solutions Developer & Creative Problem Solver',
                    'description' => 'I build web applications with Laravel and Vue, connect them to the services they depend on, and support the surrounding brand work: digital marketing and graphic design.',
                    'email' => 'hmforkan99@gmail.com',
                    'knowsAbout' => [
                        'Laravel',
                        'Vue.js',
                        'TypeScript',
                        'Vite',
                        'Tailwind CSS',
                        'API development and integration',
                        'WordPress',
                        'Digital marketing',
                        'Graphic design',
                    ],
                    'sameAs' => [],
                ],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>

        {{-- Preload primary latin fonts (self-hosted) to reduce font discovery latency. --}}
        <link rel="preload" as="font" type="font/woff2" crossorigin
            href="{{ Vite::asset('node_modules/@fontsource-variable/inter/files/inter-latin-wght-normal.woff2') }}">
        <link rel="preload" as="font" type="font/woff2" crossorigin
            href="{{ Vite::asset('node_modules/@fontsource-variable/plus-jakarta-sans/files/plus-jakarta-sans-latin-wght-normal.woff2') }}">

        {{-- Laravel Vite integration: compiled CSS + Vue/TypeScript entry point. --}}
        @vite(['resources/css/app.css', 'resources/js/app.ts'])
    </head>
    <body>
        {{-- Vue mounts here (see resources/js/app.ts). --}}
        <div id="app"></div>
    </body>
</html>