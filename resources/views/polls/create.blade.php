<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
                Gruppenumfrage erstellen
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-slate-500 hover:text-slate-700">
                ← Zurück zum Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <form action="{{ route('polls.store') }}" method="POST" id="create-poll-form">
                @csrf

                <!-- Section 1: Main Poll Information Box -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 space-y-6 shadow-sm">
                    
                    <!-- Email Address -->
                    <div>
                        <label class="block text-sm font-bold text-slate-800 mb-2">Deine E-Mail-Adresse</label>
                        <input type="email" value="{{ auth()->user()->email }}" readonly class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 text-sm font-medium focus:outline-none cursor-not-allowed">
                        
                        <div class="mt-3 p-4 bg-blue-50/70 border border-blue-200/60 rounded-xl flex items-start gap-3 text-sm text-blue-900">
                            <span class="text-blue-600 font-black text-base">ℹ</span>
                            <div>
                                Angemeldet als <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }}). Erstelle Gruppenumfragen im Handumdrehen.
                            </div>
                        </div>
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-bold text-slate-800 mb-2">Titel <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" required placeholder="Was ist der Anlass?" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-900 text-base font-medium placeholder-slate-400 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                    </div>

                    <!-- Description with Formatting Toolbar -->
                    <div>
                        <label for="description" class="block text-sm font-bold text-slate-800 mb-2">Beschreibung (optional)</label>
                        
                        <div class="border border-slate-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-blue-600 focus-within:border-blue-600 transition">
                            <!-- Mini Toolbar -->
                            <div class="bg-slate-50 border-b border-slate-200 px-3 py-2 flex items-center gap-2 text-slate-600 text-xs font-bold select-none">
                                <button type="button" onclick="formatText('bold')" class="p-1.5 hover:bg-slate-200 rounded text-slate-800 font-black" title="Fett">B</button>
                                <button type="button" onclick="formatText('underline')" class="p-1.5 hover:bg-slate-200 rounded text-slate-800 underline font-black" title="Unterstrichen">U</button>
                                <span class="text-slate-300">|</span>
                                <button type="button" onclick="formatText('list')" class="p-1.5 hover:bg-slate-200 rounded text-slate-700" title="Aufzählung">• Liste</button>
                                <button type="button" onclick="formatText('numlist')" class="p-1.5 hover:bg-slate-200 rounded text-slate-700" title="Nummerierung">1. Liste</button>
                                <span class="text-slate-300">|</span>
                                <button type="button" onclick="formatText('line')" class="p-1.5 hover:bg-slate-200 rounded text-slate-700" title="Trennlinie">— Linie</button>
                            </div>
                            
                            <textarea id="description" name="description" rows="3" placeholder="Hier kannst du Dinge wie eine Agenda, Anweisungen oder andere Details hinzufügen." class="w-full px-4 py-3 text-slate-900 text-sm placeholder-slate-400 border-none outline-none resize-y"></textarea>
                        </div>
                    </div>

                    <!-- Location (optional) -->
                    <div>
                        <label for="location" class="block text-sm font-bold text-slate-800 mb-2">Ort (optional)</label>
                        <div class="relative">
                            <input type="text" id="location" name="location" placeholder="Wo findet es statt?" class="w-full pl-4 pr-10 py-3 border border-slate-200 rounded-xl text-slate-900 text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Video Conference -->
                    <div class="flex items-center justify-between pt-2">
                        <div>
                            <span class="block text-sm font-bold text-slate-800">Videokonferenz</span>
                            <span class="text-xs text-slate-500">Füge automatisch einen Meeting-Link hinzu (z. B. Zoom, Teams, Meet)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="text" name="meeting_url" placeholder="Meeting-Link (optional)" class="px-3 py-1.5 border border-slate-200 rounded-lg text-xs text-slate-800 focus:ring-2 focus:ring-blue-600 outline-none w-48 sm:w-64">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Termine / Tage / Zeiten hinzufügen -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 space-y-6 shadow-sm mt-8">
                    <div class="flex items-center justify-between flex-wrap gap-4 border-b border-slate-100 pb-4">
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900">Termine zur Auswahl hinzufügen</h3>
                            <p class="text-xs text-slate-500 mt-1">Wähle Tage aus oder schalte auf das Stunden-Raster um.</p>
                        </div>
                        
                        <!-- Mode Switcher Tabs -->
                        <div class="inline-flex bg-slate-100 p-1 rounded-xl border border-slate-200">
                            <button type="button" onclick="switchMode('days')" id="mode-btn-days" class="px-4 py-2 text-xs font-extrabold rounded-lg bg-blue-600 text-white shadow-sm transition">
                                📅 Tage auswählen
                            </button>
                            <button type="button" onclick="switchMode('hours')" id="mode-btn-hours" class="px-4 py-2 text-xs font-extrabold rounded-lg text-slate-600 hover:text-slate-900 transition">
                                🕒 Uhrzeiten auswählen
                            </button>
                        </div>
                    </div>

                    <!-- MODE 1: DAY SELECTION (Tage) -->
                    <div id="mode-view-days" class="space-y-6">
                        <!-- Direct Date Picker Input & Quick Add -->
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-3">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Datum direkt im Kalender wählen</label>
                            <div class="flex flex-wrap items-center gap-3">
                                <input type="date" id="single-date-input" class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-800 outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition shadow-sm">
                                <button type="button" onclick="addSelectedDateInput()" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-extrabold rounded-xl shadow-sm transition">
                                    + Tag hinzufügen
                                </button>
                            </div>
                        </div>

                        <!-- Interactive Week Cards for Day Selection -->
                        <div class="space-y-3 pt-2">
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Oder Tage per Klick auswählen</label>
                                
                                <!-- Navigation arrows & Week Label -->
                                <div class="flex items-center gap-2">
                                    <div class="inline-flex rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                                        <button type="button" onclick="prevWeek()" class="px-3 py-1 text-slate-600 hover:bg-slate-50 border-r border-slate-200 text-sm font-bold" title="Vorherige Woche">←</button>
                                        <button type="button" onclick="nextWeek()" class="px-3 py-1 text-slate-600 hover:bg-slate-50 text-sm font-bold" title="Nächste Woche">→</button>
                                    </div>
                                    <button type="button" onclick="goToday()" class="px-3 py-1 text-xs font-bold border border-slate-200 rounded-xl hover:bg-slate-50 transition">Heute</button>
                                    <span class="text-xs font-extrabold text-slate-800 ml-1" id="week-date-label-days">Woche lädt...</span>
                                </div>
                            </div>

                            <!-- 7 Day Cards Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-2.5" id="day-cards-grid">
                                <!-- Populated dynamically by JS -->
                            </div>
                        </div>
                    </div>

                    <!-- MODE 2: HOURLY GRID SELECTION (Uhrzeiten) -->
                    <div id="mode-view-hours" class="space-y-6 hidden">
                        <!-- Duration selector buttons -->
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Dauer pro Termin</label>
                            <div class="flex flex-wrap gap-2" id="duration-buttons">
                                <button type="button" data-minutes="15" onclick="setDuration(15, this)" class="duration-btn px-4 py-2 text-xs font-bold border border-slate-200 rounded-xl hover:bg-slate-50 transition">15 Min.</button>
                                <button type="button" data-minutes="30" onclick="setDuration(30, this)" class="duration-btn px-4 py-2 text-xs font-bold border border-slate-200 rounded-xl hover:bg-slate-50 transition">30 Min.</button>
                                <button type="button" data-minutes="60" onclick="setDuration(60, this)" class="duration-btn px-4 py-2 text-xs font-bold bg-blue-600 text-white border border-blue-600 rounded-xl transition">60 Min.</button>
                                <button type="button" data-minutes="90" onclick="setDuration(90, this)" class="duration-btn px-4 py-2 text-xs font-bold border border-slate-200 rounded-xl hover:bg-slate-50 transition">90 Min.</button>
                                <button type="button" data-minutes="120" onclick="setDuration(120, this)" class="duration-btn px-4 py-2 text-xs font-bold border border-slate-200 rounded-xl hover:bg-slate-50 transition">120 Min.</button>
                            </div>
                        </div>

                        <!-- View & Week Navigation bar for Hours -->
                        <div class="flex flex-wrap items-center justify-between gap-4 pt-2">
                            <div class="flex items-center gap-2">
                                <div class="inline-flex rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                                    <button type="button" onclick="prevWeek()" class="px-3 py-1.5 text-slate-600 hover:bg-slate-50 border-r border-slate-200 text-sm font-bold" title="Vorherige Woche">←</button>
                                    <button type="button" onclick="nextWeek()" class="px-3 py-1.5 text-slate-600 hover:bg-slate-50 text-sm font-bold" title="Nächste Woche">→</button>
                                </div>
                                <button type="button" onclick="goToday()" class="px-3 py-1.5 text-xs font-bold border border-slate-200 rounded-xl hover:bg-slate-50 transition">Heute</button>
                                <span class="text-sm font-extrabold text-slate-800 ml-2" id="week-date-label-hours">Woche lädt...</span>
                            </div>
                        </div>

                        <!-- Interactive Calendar Grid with Hours -->
                        <div class="border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                            <div class="overflow-x-auto">
                                <table class="w-full text-center border-collapse select-none min-w-[600px]">
                                    <thead>
                                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-extrabold text-slate-500">
                                            <th class="p-3 border-r border-slate-200 w-16 text-slate-400 font-semibold">Zeit</th>
                                            @for($d = 0; $d < 7; $d++)
                                                <th class="p-3 border-r border-slate-200">
                                                    <span class="block text-[11px] uppercase text-blue-600 font-bold" id="grid-day-{{ $d }}-name"></span>
                                                    <span class="text-base font-extrabold text-slate-900" id="grid-day-{{ $d }}-num"></span>
                                                    <span class="block text-[10px] text-slate-400 font-bold" id="grid-day-{{ $d }}-month"></span>
                                                </th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-xs text-slate-500">
                                        @php
                                            $hours = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
                                        @endphp
                                        @foreach($hours as $hour)
                                            <tr>
                                                <td class="p-2 border-r border-slate-200 font-bold bg-slate-50/50 text-[11px] text-slate-400">{{ $hour }}</td>
                                                @for($d = 0; $d < 7; $d++)
                                                    <td class="p-2 border-r border-slate-100 h-10 hover:bg-blue-50 cursor-pointer transition text-center cell-slot" data-day="{{ $d }}" data-hour="{{ $hour }}" onclick="toggleSlot({{ $d }}, '{{ $hour }}', this)">
                                                        <span class="slot-indicator hidden inline-block bg-blue-600 text-white font-bold px-2 py-1 rounded text-[10px] shadow-sm">+</span>
                                                    </td>
                                                @endfor
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Selected Options Chips Area -->
                    <div class="pt-4 border-t border-slate-100">
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Ausgewählte Option(en) (<span id="selected-count">0</span>)</label>
                            <span class="text-[11px] text-slate-400 font-medium" id="selection-counter">0 von 10 ausgewählt</span>
                        </div>
                        
                        <div id="options-chips-container" class="flex flex-wrap gap-2 min-h-[52px] p-3 bg-slate-50 rounded-xl border border-slate-200 items-center">
                            <p class="text-xs text-slate-400 py-1 px-2 italic" id="empty-options-hint">Noch keine Optionen ausgewählt. Nutze oben die Tages-Karten oder das Stunden-Raster.</p>
                        </div>

                        <!-- Manual custom Option Input -->
                        <div class="mt-4 flex gap-2">
                            <input type="text" id="custom-option-input" placeholder="Oder eigene Bezeichnung eingeben (z. B. Samstag 22. August)" class="flex-1 px-4 py-2.5 border border-slate-200 rounded-xl text-xs text-slate-800 outline-none focus:ring-2 focus:ring-blue-600">
                            <button type="button" onclick="addCustomOption()" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl transition">
                                + Hinzufügen
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Submit Action -->
                <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-xs text-slate-500">
                        Mit dem Erstellen stimmst du den Nutzungsbedingungen zu.
                    </div>
                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-base px-8 py-4 rounded-full shadow-xl shadow-blue-500/25 transition transform hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-5 h-5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                        <span>Umfrage erstellen und teilen</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- JavaScript for Dual Mode: Day Selection & Hourly Grid -->
    <script>
        let activeMode = 'days'; // 'days' or 'hours'
        let selectedDuration = 60; // 60 min default for hours
        let selectedOptionsMap = new Map(); // key -> option text
        const dayNamesShort = ['Mo.', 'Di.', 'Mi.', 'Do.', 'Fr.', 'Sa.', 'So.'];
        const monthNamesGerman = [
            'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
            'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
        ];
        const monthNamesShortGerman = [
            'Jan.', 'Feb.', 'März', 'April', 'Mai', 'Juni',
            'Juli', 'Aug.', 'Sept.', 'Okt.', 'Nov.', 'Dez.'
        ];

        function getMonday(d) {
            const date = new Date(d);
            const day = date.getDay();
            const diff = date.getDate() - day + (day === 0 ? -6 : 1);
            date.setDate(diff);
            date.setHours(0, 0, 0, 0);
            return date;
        }

        let currentMonday = getMonday(new Date());
        let currentWeekDays = [];

        function switchMode(mode) {
            activeMode = mode;
            const btnDays = document.getElementById('mode-btn-days');
            const btnHours = document.getElementById('mode-btn-hours');
            const viewDays = document.getElementById('mode-view-days');
            const viewHours = document.getElementById('mode-view-hours');

            if (mode === 'days') {
                btnDays.className = 'px-4 py-2 text-xs font-extrabold rounded-lg bg-blue-600 text-white shadow-sm transition';
                btnHours.className = 'px-4 py-2 text-xs font-extrabold rounded-lg text-slate-600 hover:text-slate-900 transition';
                viewDays.classList.remove('hidden');
                viewHours.classList.add('hidden');
            } else {
                btnHours.className = 'px-4 py-2 text-xs font-extrabold rounded-lg bg-blue-600 text-white shadow-sm transition';
                btnDays.className = 'px-4 py-2 text-xs font-extrabold rounded-lg text-slate-600 hover:text-slate-900 transition';
                viewHours.classList.remove('hidden');
                viewDays.classList.add('hidden');
            }
            updateCalendar();
        }

        function setDuration(minutes, btn) {
            selectedDuration = minutes;
            document.querySelectorAll('.duration-btn').forEach(b => {
                b.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                b.classList.add('border-slate-200', 'text-slate-700');
            });
            btn.classList.remove('border-slate-200', 'text-slate-700');
            btn.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
        }

        function calculateEndTime(startTimeStr, minutes) {
            const [h, m] = startTimeStr.split(':').map(Number);
            const totalMinutes = h * 60 + m + parseInt(minutes);
            const endH = String(Math.floor(totalMinutes / 60) % 24).padStart(2, '0');
            const endM = String(totalMinutes % 60).padStart(2, '0');
            return `${endH}:${endM}`;
        }

        function formatDateISO(d) {
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        function formatDayLabel(dateObj) {
            const dayName = dayNamesShort[(dateObj.getDay() + 6) % 7];
            const dayNum = String(dateObj.getDate()).padStart(2, '0');
            const monthNum = String(dateObj.getMonth() + 1).padStart(2, '0');
            const yearStr = dateObj.getFullYear();
            return `${dayName} ${dayNum}.${monthNum}.${yearStr}`;
        }

        function updateCalendar() {
            currentWeekDays = [];
            for (let i = 0; i < 7; i++) {
                const day = new Date(currentMonday);
                day.setDate(currentMonday.getDate() + i);
                currentWeekDays.push(day);

                // Update Grid headers for Hours view
                const nameEl = document.getElementById(`grid-day-${i}-name`);
                const numEl = document.getElementById(`grid-day-${i}-num`);
                const monthEl = document.getElementById(`grid-day-${i}-month`);
                if (nameEl) nameEl.innerText = dayNamesShort[i];
                if (numEl) numEl.innerText = day.getDate();
                if (monthEl) monthEl.innerText = monthNamesShortGerman[day.getMonth()];
            }

            const startDay = currentWeekDays[0];
            const endDay = currentWeekDays[6];

            let label = '';
            if (startDay.getMonth() === endDay.getMonth()) {
                label = `${startDay.getDate()}.–${endDay.getDate()}. ${monthNamesGerman[startDay.getMonth()]} ${startDay.getFullYear()}`;
            } else {
                label = `${startDay.getDate()}. ${monthNamesShortGerman[startDay.getMonth()]} – ${endDay.getDate()}. ${monthNamesShortGerman[endDay.getMonth()]} ${endDay.getFullYear()}`;
            }

            const daysLabel = document.getElementById('week-date-label-days');
            const hoursLabel = document.getElementById('week-date-label-hours');
            if (daysLabel) daysLabel.innerText = label;
            if (hoursLabel) hoursLabel.innerText = label;

            renderDayCards();
            updateCellHighlights();
        }

        function renderDayCards() {
            const grid = document.getElementById('day-cards-grid');
            if (!grid) return;

            let html = '';
            currentWeekDays.forEach((dateObj, index) => {
                const dateISO = formatDateISO(dateObj);
                const isSelected = selectedOptionsMap.has(dateISO);
                const dayName = dayNamesShort[index];
                const isWeekend = index >= 5;

                html += `
                    <button type="button" onclick="toggleDay('${dateISO}')" class="p-3 rounded-xl border text-center transition flex flex-col items-center justify-between ${
                        isSelected 
                            ? 'bg-blue-600 border-blue-600 text-white shadow-md transform scale-[1.02]' 
                            : 'bg-white border-slate-200 text-slate-800 hover:border-blue-400 hover:bg-blue-50/50'
                    }">
                        <span class="text-[11px] uppercase font-extrabold ${isSelected ? 'text-blue-100' : (isWeekend ? 'text-blue-600' : 'text-slate-500')}">${dayName}</span>
                        <span class="text-xl font-black my-1">${dateObj.getDate()}</span>
                        <span class="text-[10px] font-bold ${isSelected ? 'text-blue-100' : 'text-slate-400'}">${monthNamesShortGerman[dateObj.getMonth()]}</span>
                    </button>
                `;
            });
            grid.innerHTML = html;
        }

        function toggleDay(dateISO) {
            if (selectedOptionsMap.has(dateISO)) {
                selectedOptionsMap.delete(dateISO);
            } else {
                if (selectedOptionsMap.size >= 10) {
                    alert('Du kannst maximal 10 Optionen pro Umfrage auswählen.');
                    return;
                }
                const [y, m, d] = dateISO.split('-').map(Number);
                const dateObj = new Date(y, m - 1, d);
                const label = formatDayLabel(dateObj);
                selectedOptionsMap.set(dateISO, label);
            }
            renderChips();
            renderDayCards();
        }

        function toggleSlot(dayIndex, hourStr, cell) {
            const dateObj = currentWeekDays[dayIndex];
            const dayName = dayNamesShort[dayIndex];
            const dayNum = String(dateObj.getDate()).padStart(2, '0');
            const monthNum = String(dateObj.getMonth() + 1).padStart(2, '0');
            const yearStr = dateObj.getFullYear();
            const dateISO = formatDateISO(dateObj);

            const endTime = calculateEndTime(hourStr, selectedDuration);
            const optionText = `${dayName} ${dayNum}.${monthNum}.${yearStr}, ${hourStr} - ${endTime}`;
            const key = `slot-${dateISO}-${hourStr}`;

            if (selectedOptionsMap.has(key)) {
                selectedOptionsMap.delete(key);
            } else {
                if (selectedOptionsMap.size >= 10) {
                    alert('Du kannst maximal 10 Optionen pro Umfrage auswählen.');
                    return;
                }
                selectedOptionsMap.set(key, optionText);
            }
            renderChips();
            updateCellHighlights();
        }

        function updateCellHighlights() {
            document.querySelectorAll('.cell-slot').forEach(cell => {
                const dayIndex = parseInt(cell.getAttribute('data-day'));
                const hourStr = cell.getAttribute('data-hour');
                const dateObj = currentWeekDays[dayIndex];
                if (!dateObj) return;

                const dateISO = formatDateISO(dateObj);
                const slotKey = `slot-${dateISO}-${hourStr}`;

                if (selectedOptionsMap.has(slotKey)) {
                    cell.classList.add('bg-blue-100');
                    cell.querySelector('.slot-indicator').classList.remove('hidden');
                } else {
                    cell.classList.remove('bg-blue-100');
                    cell.querySelector('.slot-indicator').classList.add('hidden');
                }
            });
        }

        function addSelectedDateInput() {
            const input = document.getElementById('single-date-input');
            const val = input.value;
            if (!val) {
                alert('Bitte wähle zuerst ein Datum im Kalenderfeld aus.');
                return;
            }
            toggleDay(val);
            input.value = '';
        }

        function prevWeek() {
            currentMonday.setDate(currentMonday.getDate() - 7);
            updateCalendar();
        }

        function nextWeek() {
            currentMonday.setDate(currentMonday.getDate() + 7);
            updateCalendar();
        }

        function goToday() {
            currentMonday = getMonday(new Date());
            updateCalendar();
        }

        function addCustomOption() {
            const input = document.getElementById('custom-option-input');
            const val = input.value.trim();
            if (!val) return;

            if (selectedOptionsMap.size >= 10) {
                alert('Du kannst maximal 10 Optionen pro Umfrage auswählen.');
                return;
            }

            const key = `custom-${Date.now()}`;
            selectedOptionsMap.set(key, val);
            input.value = '';
            renderChips();
        }

        function removeOption(key) {
            selectedOptionsMap.delete(key);
            renderChips();
            renderDayCards();
            updateCellHighlights();
        }

        function renderChips() {
            const container = document.getElementById('options-chips-container');
            const count = selectedOptionsMap.size;
            
            document.getElementById('selected-count').innerText = count;
            document.getElementById('selection-counter').innerText = `${count} von 10 ausgewählt`;

            if (count === 0) {
                container.innerHTML = '<p class="text-xs text-slate-400 py-1 px-2 italic" id="empty-options-hint">Noch keine Optionen ausgewählt. Nutze oben die Tages-Karten oder das Stunden-Raster.</p>';
                return;
            }

            let html = '';
            selectedOptionsMap.forEach((text, key) => {
                html += `
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-white border border-blue-200 text-blue-900 rounded-xl text-xs font-bold shadow-sm">
                        <input type="hidden" name="options[]" value="${text.replace(/"/g, '&quot;')}">
                        <span>📅 ${text}</span>
                        <button type="button" onclick="removeOption('${key}')" class="text-blue-400 hover:text-red-500 font-black ml-1 text-sm">×</button>
                    </div>
                `;
            });
            container.innerHTML = html;
        }

        function formatText(command) {
            const textarea = document.getElementById('description');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const sel = textarea.value.substring(start, end);

            let replace = '';
            if (command === 'bold') replace = `**${sel || 'fetter Text'}**`;
            else if (command === 'underline') replace = `_${sel || 'unterstrichener Text'}_`;
            else if (command === 'list') replace = `\n• ${sel || 'Listenelement'}`;
            else if (command === 'numlist') replace = `\n1. ${sel || 'Listenelement'}`;
            else if (command === 'line') replace = `\n---\n`;

            textarea.value = textarea.value.substring(0, start) + replace + textarea.value.substring(end);
            textarea.focus();
        }

        // Initialize calendar on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCalendar();
        });

        // Form Validation on Submit
        document.getElementById('create-poll-form').addEventListener('submit', function(e) {
            if (selectedOptionsMap.size === 0) {
                e.preventDefault();
                alert('Bitte wähle mindestens 1 Option aus oder füge eine eigene Option hinzu.');
            }
        });
    </script>
</x-app-layout>
