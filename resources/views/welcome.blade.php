<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Terminli - Einfach gemeinsam den besten Termin finden</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-950 selection:bg-blue-600 selection:text-white">
        
        <!-- Navigation Header -->
        <nav class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center justify-between">
            <a href="/" class="flex items-center space-x-2.5 group">
                <div class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30 group-hover:scale-105 transition transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <span class="text-2xl font-black tracking-tight text-white font-sans">
                    Terminli<span class="text-blue-500">.</span>
                </span>
            </a>

            <div class="flex items-center space-x-2 sm:space-x-4">
                <a href="{{ route('handbuch') }}" class="text-slate-300 hover:text-white font-bold text-sm px-3 sm:px-4 py-2 transition inline-flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Benutzerhandbuch
                </a>
                <a href="{{ route('about_me') }}" class="text-slate-300 hover:text-white font-bold text-sm px-3 sm:px-4 py-2 transition inline-flex items-center gap-2">
                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Über mich
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-sm px-5 py-2.5 rounded-full shadow-lg transition">
                        Zum Dashboard →
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-300 hover:text-white font-bold text-sm px-4 py-2 transition">
                        Anmelden
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-sm px-5 py-2.5 rounded-full shadow-lg shadow-blue-500/25 transition transform hover:scale-105">
                        Registrieren
                    </a>
                @endauth
            </div>
        </nav>

        <!-- Hero Section with Generated Image Background -->
        <div class="relative overflow-hidden min-h-[calc(100vh-80px)] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/hero.jpg') }}" alt="Terminli Swiss Hiking Hero" class="w-full h-full object-cover opacity-80 scale-105 filter brightness-105">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-slate-950/20"></div>
            </div>

            <!-- Content Container -->
            <div class="relative z-10 max-w-4xl text-center space-y-8">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs sm:text-sm font-extrabold bg-blue-500/30 text-blue-300 border border-blue-400/30 backdrop-blur-md uppercase tracking-wider shadow-lg">
                    🇨🇭 Schweizer Qualität & Einfachheit
                </span>

                <h1 class="text-4xl sm:text-6xl md:text-7xl font-black text-white tracking-tight leading-tight drop-shadow-md">
                    Terminfindung ohne Chaos.
                </h1>

                <p class="text-slate-200 text-lg sm:text-xl max-w-2xl mx-auto font-medium leading-relaxed drop-shadow">
                    Egal ob Tageswanderung an der Aare, Team-Events oder Freizeit-Treffen: Erstelle in Sekunden eine Umfrage und finde sofort das beste Datum.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                    @auth
                        <a href="{{ route('polls.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center space-x-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-lg px-9 py-4 rounded-full shadow-2xl shadow-blue-500/40 transition transform hover:scale-105">
                            <svg class="w-6 h-6 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Neue Umfrage erstellen</span>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center space-x-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-lg px-9 py-4 rounded-full shadow-2xl shadow-blue-500/40 transition transform hover:scale-105">
                            <span>Jetzt starten</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    @endauth
                </div>

                <!-- 3 Key Value Props -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-12 text-left max-w-3xl mx-auto">
                    <div class="bg-slate-900/60 backdrop-blur-md border border-slate-800 p-5 rounded-2xl">
                        <div class="text-2xl mb-2">⚡</div>
                        <h3 class="text-white font-extrabold text-base">Ohne Gast-Login</h3>
                        <p class="text-slate-400 text-xs mt-1">Deine Gäste tragen sich mit 1 Klick ein, ohne Konto zu erstellen.</p>
                    </div>

                    <div class="bg-slate-900/60 backdrop-blur-md border border-slate-800 p-5 rounded-2xl">
                        <div class="text-2xl mb-2">📅</div>
                        <h3 class="text-white font-extrabold text-base">Tage & Stunden</h3>
                        <p class="text-slate-400 text-xs mt-1">Wähle reine Tage für Ausflüge oder Stunden für Meetings.</p>
                    </div>

                    <div class="bg-slate-900/60 backdrop-blur-md border border-slate-800 p-5 rounded-2xl">
                        <div class="text-2xl mb-2">🏆</div>
                        <h3 class="text-white font-extrabold text-base">Bester Termin sofort</h3>
                        <p class="text-slate-400 text-xs mt-1">Das System errechnet automatisch die höchste Übereinstimmung.</p>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
