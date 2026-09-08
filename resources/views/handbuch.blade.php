<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Benutzerhandbuch - Terminli</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-100 antialiased bg-slate-950 min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-4xl mx-auto">
            <!-- Navigation Back Link -->
            <div class="mb-8 flex items-center justify-between">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-slate-300 hover:text-white font-bold text-base px-4 py-2 rounded-lg bg-slate-900 border border-slate-800 transition">
                    ← Zurück zur Startseite
                </a>
                <span class="text-2xl font-black text-white">Terminli<span class="text-blue-500">.</span></span>
            </div>

            <!-- Manual Header -->
            <div class="bg-gradient-to-r from-blue-900/60 to-indigo-900/60 border border-blue-500/30 rounded-3xl p-6 sm:p-10 mb-8 shadow-xl">
                <div class="inline-block px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm font-semibold mb-3">
                    📖 Schritt-für-Schritt Anleitung
                </div>
                <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4">
                    Benutzerhandbuch für Terminli
                </h1>
                <p class="text-slate-200 text-lg sm:text-xl font-medium leading-relaxed">
                    Herzlich willkommen! Diese Anleitung erklärt Ihnen leicht verständlich und Schritt für Schritt, wie Sie mit Terminli gemeinsame Termine für Ausflüge, Treffen oder Feiern finden.
                </p>
            </div>

            <!-- Main Content Card -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-10 text-slate-200 space-y-10 shadow-2xl leading-relaxed text-lg">
                
                <!-- Section 1 -->
                <section class="space-y-4">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white flex items-center gap-3">
                        <span class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl shrink-0">1</span>
                        Was ist Terminli?
                    </h2>
                    <p class="pl-13 text-slate-300">
                        <strong>Terminli</strong> ist ein einfaches Hilfsmittel im Internet. Wenn Sie etwas mit Freunden, Bekannten oder der Familie unternehmen möchten (zum Beispiel eine Wanderung oder ein gemeinsames Essen), hilft Ihnen Terminli herauszufinden, an welchem Tag die meisten Menschen Zeit haben.
                    </p>
                </section>

                <hr class="border-slate-800">

                <!-- Section 2 -->
                <section class="space-y-4">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white flex items-center gap-3">
                        <span class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl shrink-0">2</span>
                        An einer Umfrage teilnehmen (Als Gast)
                    </h2>
                    <p class="text-slate-300">
                        Wenn jemand Sie zu einer Terminabsprache eingeladen hat, müssen Sie <strong>kein Passwort</strong> und <strong>kein Benutzerkonto</strong> erstellen.
                    </p>
                    <ol class="list-decimal list-inside space-y-3 pl-2 text-slate-200 font-medium">
                        <li><strong>Link öffnen:</strong> Klicken Sie auf den Link, den Sie per E-Mail, WhatsApp oder SMS erhalten haben.</li>
                        <li><strong>Namen eingeben:</strong> Schreiben Sie Ihren Vor- und Nachnamen in das Feld „Ihr Name“.</li>
                        <li><strong>Tage auswählen:</strong>
                            <ul class="list-disc list-inside pl-6 mt-1 space-y-1 text-slate-300">
                                ><span class="text-green-400 font-bold">Ja (Grün):</span> Sie haben an diesem Tag Zeit.</li>
                                ><span class="text-yellow-400 font-bold">Vielleicht (Gelb):</span> Sie sind unsicher oder es passt nur bedingt.</li>
                                ><span class="text-red-400 font-bold">Nein (Rot):</span> Sie haben keine Zeit.</li>
                            </ul>
                        </li>
                        <li><strong>Speichern:</strong> Klicken Sie auf die blaue Schaltfläche <strong>„Eintragen“</strong> oder <strong>„Stimme abgeben“</strong>. Fertig!</li>
                    </ol>
                </section>

                <hr class="border-slate-800">

                <!-- Section 3 -->
                <section class="space-y-4">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white flex items-center gap-3">
                        <span class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl shrink-0">3</span>
                        Eine eigene Umfrage erstellen
                    </h2>
                    <p class="text-slate-300">
                        Möchten Sie selbst ein Treffen organisieren? Dazu erstellen Sie in wenigen Schritten eine neue Umfrage:
                    </p>
                    <ol class="list-decimal list-inside space-y-3 pl-2 text-slate-200 font-medium">
                        <li>Klicken Sie auf der Startseite auf die Schaltfläche <strong>„Neue Umfrage erstellen“</strong> oder <strong>„Jetzt starten“</strong>.</li>
                        <li>Geben Sie einen <strong>Titel</strong> ein (z. B. <em>„Aare-Wanderung im Sommer“</em>).</li>
                        <li>Wählen Sie im Kalender die Tage aus, die zur Auswahl stehen sollen.</li>
                        <li>Klicken Sie auf <strong>„Umfrage erstellen“</strong>.</li>
                        <li>Kopieren Sie den Internet-Link und senden Sie ihn an Ihre Freunde oder Familie.</li>
                    </ol>
                </section>

                <hr class="border-slate-800">

                <!-- Section 4 -->
                <section class="space-y-4">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white flex items-center gap-3">
                        <span class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl shrink-0">4</span>
                        Häufig gestellte Fragen (Hilfe)
                    </h2>
                    <div class="space-y-4 text-slate-300">
                        <div class="bg-slate-950 p-5 rounded-2xl border border-slate-800">
                            <h3 class="font-bold text-white text-lg">Muss ich mich registrieren?</h3>
                            <p class="mt-1">Nein. Wenn Sie nur an einer Umfrage teilnehmen möchten, ist keine Registrierung nötig.</p>
                        </div>
                        <div class="bg-slate-950 p-5 rounded-2xl border border-slate-800">
                            <h3 class="font-bold text-white text-lg">Ich habe mich vertippt. Kann ich meine Antwort ändern?</h3>
                            <p class="mt-1">Ja! Wenn Sie nach der Stimmabgabe auf derselben Seite bleiben oder den speziellen Änderungs-Link nutzen, können Sie Ihre Antworten jederzeit korrigieren.</p>
                        </div>
                    </div>
                </section>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-black text-lg px-8 py-3.5 rounded-full shadow-lg transition">
                    ← Zurück zur Startseite
                </a>
            </div>
        </div>

    </body>
</html>
