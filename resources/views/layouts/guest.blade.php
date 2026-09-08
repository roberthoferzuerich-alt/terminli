@props([
    'heroImage' => asset('images/hero.jpg'),
    'heroBadge' => '🇨🇭 Terminfindung ohne Chaos',
    'heroTitle' => 'Gemeinsam den besten Termin finden.',
    'heroSubtitle' => 'Plane Ausflüge, Wanderungen oder Team-Events in wenigen Sekunden. Keine Registrierung für deine Gäste notwendig.'
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Terminli') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-950 selection:bg-blue-600 selection:text-white">
        <div class="min-h-screen grid grid-cols-1 md:grid-cols-12">
            
            <!-- LEFT SIDE: Image Panel (Grafik/Bild links) -->
            <div class="relative md:col-span-6 lg:col-span-7 bg-slate-900 flex flex-col justify-between p-8 md:p-12 lg:p-16 min-h-[360px] md:min-h-screen overflow-hidden">
                <!-- Background Image -->
                <div class="absolute inset-0 z-0">
                    <img src="{{ $heroImage }}" alt="Terminli Hero" class="w-full h-full object-cover opacity-90 filter brightness-110 contrast-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/40 to-slate-950/10"></div>
                </div>

                <!-- Logo Header -->
                <div class="relative z-10">
                    <a href="/" class="inline-flex items-center space-x-2.5 group">
                        <div class="w-11 h-11 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-blue-500/30 group-hover:scale-105 transition transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-black tracking-tight text-white font-sans">
                            Terminli<span class="text-blue-500">.</span>
                        </span>
                    </a>
                </div>

                <!-- Bottom Quote/Banner Overlay -->
                <div class="relative z-10 max-w-xl mt-12 md:mt-0">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-extrabold bg-blue-500/25 text-blue-300 border border-blue-400/30 backdrop-blur-md mb-4 uppercase tracking-wider">
                        {{ $heroBadge }}
                    </span>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                        {{ $heroTitle }}
                    </h1>
                    <p class="text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                        {{ $heroSubtitle }}
                    </p>
                </div>
            </div>

            <!-- RIGHT SIDE: Form Content Area (Anmeldefelder rechts) -->
            <div class="md:col-span-6 lg:col-span-5 bg-white flex items-center justify-center p-8 sm:p-12 lg:p-16 min-h-[500px] md:min-h-screen">
                <div class="w-full max-w-md space-y-6">
                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>
