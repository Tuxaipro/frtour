<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'India Tourisme') }} - Admin</title>

        @if($siteFaviconUrl ?? false)
            <link rel="icon" type="image/x-icon" href="{{ $siteFaviconUrl }}">
            <link rel="shortcut icon" href="{{ $siteFaviconUrl }}">
        @else
            <link rel="icon" type="image/x-icon" href="/favicon.ico">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @php
            $hasViteManifest = file_exists(public_path('build/manifest.json'));
        @endphp
        
        @if($hasViteManifest)
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <!-- Fallback for production without Vite build -->
            <script src="https://cdn.tailwindcss.com"></script>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
                body { font-family: 'Inter', sans-serif; }
            </style>
        @endif
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Auth Card -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white rounded-xl shadow-sm">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
