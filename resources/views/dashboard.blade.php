<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight font-sans">
                Hallo, {{ Auth::user()->name }} 👋
            </h1>
            <p class="text-sm text-gray-500 mt-0.5">
                Verwalte deine Terminabstimmungen und finde schnell den passenden Termin.
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-[calc(100vh-140px)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-400 text-emerald-800 px-4 py-3 rounded-2xl font-semibold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Hero Quick Action Banner -->
            <div class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-indigo-900 to-slate-900 rounded-3xl p-8 text-white shadow-xl">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-500/20 text-blue-300 border border-blue-400/30 mb-4 uppercase tracking-wider">
                        ✨ Doodle Gruppen-Umfrage
                    </span>
                    <h2 class="text-3xl font-black text-white tracking-tight sm:text-4xl">
                        Terminfindung ohne Chaos.
                    </h2>
                    <p class="text-blue-100 text-base mt-2 mb-6">
                        Erstelle in wenigen Sekunden eine neue Umfrage, teile den Link mit deinem Team oder Freunden und finde sofort das beste Datum.
                    </p>
                    <a href="{{ route('polls.create') }}" class="inline-flex items-center space-x-3 bg-white text-blue-900 hover:bg-blue-50 font-black text-base px-7 py-3.5 rounded-full shadow-lg transition transform hover:scale-105 active:scale-95">
                        <svg class="w-6 h-6 stroke-[3] text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Jetzt Umfrage erstellen</span>
                    </a>
                </div>
            </div>

            <!-- Dashboard Key Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Erstellte Umfragen</p>
                        <p class="text-3xl font-black text-slate-900 mt-1">{{ $polls->count() }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Abgegebene Stimmen</p>
                        <p class="text-3xl font-black text-slate-900 mt-1">{{ $polls->sum(fn($p) => $p->participants->count()) }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Aktivste Umfrage</p>
                        <p class="text-lg font-extrabold text-slate-900 mt-1 truncate max-w-[180px]">
                            {{ $polls->sortByDesc(fn($p) => $p->participants->count())->first()?->title ?? '-' }}
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Polls Overview Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 sm:p-8">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Meine Umfragen</h3>
                    <a href="{{ route('polls.create') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 uppercase tracking-wider flex items-center gap-1 hover:underline">
                        <span>+ Umfrage hinzufügen</span>
                    </a>
                </div>

                @if($polls->isEmpty())
                    <div class="py-16 text-center max-w-md mx-auto">
                        <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-5 shadow-inner">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-extrabold text-slate-900">Du hast noch keine Umfragen erstellt</h4>
                        <p class="text-sm text-slate-500 mt-2 mb-8 leading-relaxed">
                            Starte deine erste Abstimmung für Meetings, Events oder Gruppen-Treffen in wenigen Schritten.
                        </p>
                        <a href="{{ route('polls.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold text-base px-8 py-3.5 rounded-full shadow-lg shadow-blue-500/25 transition transform hover:scale-105">
                            <svg class="w-5 h-5 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Erste Umfrage erstellen</span>
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-xs font-extrabold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                    <th class="py-3 px-4">Umfrage</th>
                                    <th class="py-3 px-4">Optionen</th>
                                    <th class="py-3 px-4">Teilnehmer</th>
                                    <th class="py-3 px-4">Datum</th>
                                    <th class="py-3 px-4 text-right">Aktionen</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($polls as $poll)
                                    <tr class="hover:bg-slate-50/80 transition">
                                        <td class="py-4 px-4">
                                            <a href="{{ route('polls.show', $poll->uuid) }}" class="font-extrabold text-slate-900 hover:text-blue-600 text-base block transition">
                                                {{ $poll->title }}
                                            </a>
                                            @if($poll->description)
                                                <span class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $poll->description }}</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                                                {{ $poll->options->count() }} Optionen
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                                ✓ {{ $poll->participants->count() }} Stimmen
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-sm text-slate-400 font-medium">
                                            {{ $poll->created_at->format('d.m.Y') }}
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <div class="inline-flex items-center justify-end gap-2">
                                                <a href="{{ route('polls.show', $poll->uuid) }}" class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 hover:bg-blue-100 font-bold text-xs rounded-full transition">
                                                    Öffnen →
                                                </a>
                                                <form action="{{ route('polls.destroy', $poll->uuid) }}" method="POST" onsubmit="return confirm('Möchtest du die Umfrage wirklich löschen?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-50 text-red-600 hover:bg-red-100 font-bold text-xs rounded-full transition" title="Umfrage löschen">
                                                        🗑️ Löschen
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
