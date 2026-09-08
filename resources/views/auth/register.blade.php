<x-guest-layout 
    :heroImage="asset('images/register_hero.jpg')"
    heroBadge="🚀 Starte mit Terminli"
    heroTitle="Planung wird zum Kinderspiel."
    heroSubtitle="Erstelle dein Konto, erstelle deine erste Umfrage und lade dein Team oder deine Freunde ein."
>
    <div>
        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Konto erstellen</h2>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Erstelle dein Konto und starte deine erste Umfrage.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4 mt-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Vollständiger Name" class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1" />
            <x-text-input id="name" class="block mt-1 w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Max Muster" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="E-Mail-Adresse" class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1" />
            <x-text-input id="email" class="block mt-1 w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="deine@email.ch" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Passwort" class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1" />
            <x-text-input id="password" class="block mt-1 w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Mindestens 8 Zeichen" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Passwort bestätigen" class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-1" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Passwort wiederholen" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-base py-3.5 px-4 rounded-xl shadow-lg shadow-blue-500/25 transition transform active:scale-98">
                Konto erstellen
            </button>
        </div>
    </form>

    <div class="pt-4 text-center border-t border-slate-100 mt-6">
        <p class="text-xs text-slate-500 font-medium">
            Bereits ein Konto?
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-extrabold ml-1 hover:underline">
                Hier anmelden
            </a>
        </p>
    </div>
</x-guest-layout>
