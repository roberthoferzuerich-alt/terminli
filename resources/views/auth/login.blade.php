<x-guest-layout 
    :heroImage="asset('images/hero.jpg')"
    heroBadge="🇨🇭 Willkommen zurück"
    heroTitle="Gemeinsam den besten Termin finden."
    heroSubtitle="Plane Ausflüge, Wanderungen oder Team-Events in wenigen Sekunden. Keine Registrierung für deine Gäste notwendig."
>
    <div>
        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Anmelden</h2>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Willkommen zurück! Bitte melde dich an.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4 mt-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="E-Mail-Adresse" class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1" />
            <x-text-input id="email" class="block mt-1 w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="deine@email.ch" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1">
                <x-input-label for="password" value="Passwort" class="font-bold text-slate-800 text-xs uppercase tracking-wider" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-blue-600 hover:text-blue-700 font-semibold" href="{{ route('password.request') }}">
                        Passwort vergessen?
                    </a>
                @endif
            </div>
            <x-text-input id="password" class="block mt-1 w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 w-4 h-4" name="remember">
                <span class="ms-2 text-xs font-semibold text-slate-600">Angemeldet bleiben</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-base py-3.5 px-4 rounded-xl shadow-lg shadow-blue-500/25 transition transform active:scale-98">
                Anmelden
            </button>
        </div>
    </form>

    <div class="pt-4 text-center border-t border-slate-100 mt-6">
        <p class="text-xs text-slate-500 font-medium">
            Noch kein Konto?
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-extrabold ml-1 hover:underline">
                Jetzt registrieren
            </a>
        </p>
    </div>
</x-guest-layout>
