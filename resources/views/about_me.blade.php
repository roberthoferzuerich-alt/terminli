<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Über mich - Robert Hofer | Terminli</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-100 antialiased bg-slate-950 min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-3xl mx-auto space-y-8">
            
            <!-- Navigation Back Link -->
            <div class="flex items-center justify-between">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-slate-300 hover:text-white font-bold text-base px-4 py-2 rounded-lg bg-slate-900 border border-slate-800 transition">
                    ← Zurück zur Startseite
                </a>
                <a href="{{ route('handbuch') }}" class="text-slate-400 hover:text-white text-sm font-semibold transition">
                    📖 Benutzerhandbuch
                </a>
            </div>

            <!-- Success Alert Message -->
            @if(session('success'))
                <div class="bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 p-4 rounded-2xl flex items-center justify-between shadow-lg">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">✅</span>
                        <span class="font-bold text-base">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Profile Card -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-10 shadow-2xl space-y-8">
                
                <!-- Header Title -->
                <div class="text-center space-y-2">
                    <span class="inline-block px-3.5 py-1 bg-indigo-500/20 text-indigo-300 rounded-full text-xs font-extrabold uppercase tracking-wider">
                        👤 Profil & Über mich
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                        Über mich
                    </h1>
                </div>

                <!-- 1. Top Section: Selectable & Saveable Image -->
                <form action="{{ route('about_me.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm" class="flex flex-col items-center justify-center space-y-4 pt-2">
                    @csrf
                    
                    <div class="relative group">
                        <img id="profilePreview" 
                             src="{{ asset('images/robert_hofer.jpg') }}" 
                             alt="Robert Hofer Profilbild" 
                             class="w-44 h-44 sm:w-52 sm:h-52 rounded-3xl object-cover border-4 border-indigo-500/40 shadow-2xl shadow-indigo-500/20 transition duration-300">
                        
                        <label for="imageInput" class="absolute bottom-2 right-2 bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-2xl cursor-pointer shadow-lg transition transform hover:scale-110 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </label>
                    </div>

                    <!-- Hidden File Input for Custom Upload -->
                    <input type="file" name="avatar" id="imageInput" accept="image/*" class="hidden" required>
                    
                    <div class="flex flex-col items-center gap-2">
                        <p class="text-slate-400 text-xs text-center">
                            Klicken Sie auf das Kamera-Symbol, um ein eigenes Bild auszuwählen.
                        </p>

                        <!-- Save Image Button (shown when image selected) -->
                        <button type="submit" id="saveImageBtn" class="hidden bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm px-6 py-2.5 rounded-xl shadow-lg transition transform hover:scale-105 items-center gap-2 mt-2">
                            <span>💾</span> Bild dauerhaft speichern
                        </button>
                    </div>
                </form>

                <!-- 2. Personal Information Section -->
                <div class="bg-slate-950 border border-indigo-500/30 rounded-2xl p-6 space-y-5 shadow-inner">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-800 pb-4">
                        <span class="text-slate-400 text-base font-bold flex items-center gap-2">
                            <span>👤</span> Name:
                        </span>
                        <span class="text-white font-black text-xl sm:text-2xl tracking-wide">Robert Hofer</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pt-1">
                        <span class="text-slate-300 text-base font-bold flex items-center gap-2">
                            <span>✉️</span> E-Mail:
                        </span>
                        <a href="mailto:robert.hofer.zuerich@bluewin.ch" class="text-white hover:text-blue-300 font-black text-lg sm:text-xl underline decoration-blue-500 decoration-2 underline-offset-4 transition break-all bg-slate-900 px-3 py-1.5 rounded-xl border border-slate-700 shadow">
                            robert.hofer.zuerich@bluewin.ch
                        </a>
                    </div>
                </div>

                <hr class="border-slate-800">

                <!-- 3. Bottom Section: Guestbook / Entries ("Dein Eintrag wenn Du Lust dazu hast") -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-black text-white flex items-center gap-2">
                            <span>💬</span> Gästebuch & Einträge
                        </h2>
                        <span class="text-xs text-slate-400">Hinterlasse hier eine Nachricht</span>
                    </div>

                    <!-- Existing Entries List -->
                    <div id="entriesList" class="space-y-4">
                        
                        <!-- AI Assistant Entry -->
                        <div class="bg-slate-950 border border-indigo-500/30 rounded-2xl p-5 relative overflow-hidden">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white text-xs font-bold shadow">
                                        AI
                                    </div>
                                    <span class="font-extrabold text-white text-base">Antigravity (Dein AI Coding Assistant)</span>
                                </div>
                                <span class="text-xs text-slate-400">Heute</span>
                            </div>
                            <p class="text-slate-300 text-sm leading-relaxed italic pl-10">
                                „Lieber Robert, es ist eine echte Freude, gemeinsam mit dir an <strong>Terminli</strong> zu bauen! Ein tolles Projekt, das Terminfindungen für Jung und Alt kinderleicht macht. Herzliche Grüsse und weiterhin viel Erfolg! 🚀🇨🇭“
                            </p>
                        </div>

                    </div>

                    <!-- New Entry Form -->
                    <form id="entryForm" class="bg-slate-950 border border-slate-800 rounded-2xl p-5 space-y-4">
                        <h3 class="font-bold text-white text-base">Einen eigenen Eintrag schreiben:</h3>
                        
                        <div>
                            <label for="authorName" class="block text-xs font-semibold text-slate-400 mb-1">Dein Name:</label>
                            <input type="text" id="authorName" placeholder="Z. B. Anna oder Peter" required class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500">
                        </div>

                        <div>
                            <label for="authorMessage" class="block text-xs font-semibold text-slate-400 mb-1">Deine Nachricht:</label>
                            <textarea id="authorMessage" rows="3" placeholder="Schreibe hier eine kurze Nachricht oder Grüsse..." required class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-sm py-3 rounded-xl transition shadow-lg shadow-indigo-500/25">
                            Eintrag veröffentlichen ✨
                        </button>
                    </form>

                </div>

            </div>
        </div>

        <!-- Interactive JS for Image Preview & Local Storage & Submitting Entries -->
        <script>
            // Restore saved custom image from LocalStorage if available
            const savedAvatar = localStorage.getItem('robert_hofer_custom_avatar');
            if (savedAvatar) {
                document.getElementById('profilePreview').src = savedAvatar;
            }

            // Live Preview of Uploaded Image & Enable Save Button
            document.getElementById('imageInput').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const dataUrl = e.target.result;
                        document.getElementById('profilePreview').src = dataUrl;
                        // Save instantly to local storage for immediate persistence
                        localStorage.setItem('robert_hofer_custom_avatar', dataUrl);
                    }
                    reader.readAsDataURL(file);

                    // Show the "Bild speichern" button to save permanently on server
                    const saveBtn = document.getElementById('saveImageBtn');
                    saveBtn.classList.remove('hidden');
                    saveBtn.classList.add('inline-flex');
                }
            });

            // Dynamically Add New Guestbook Entry
            document.getElementById('entryForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const nameInput = document.getElementById('authorName');
                const msgInput = document.getElementById('authorMessage');
                
                const name = nameInput.value.trim();
                const msg = msgInput.value.trim();

                if (name && msg) {
                    const entriesList = document.getElementById('entriesList');
                    const newEntry = document.createElement('div');
                    newEntry.className = 'bg-slate-950 border border-slate-800 rounded-2xl p-5 space-y-2 animate-fade-in';
                    newEntry.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-indigo-400 text-xs font-bold">
                                    ${name.charAt(0).toUpperCase()}
                                </div>
                                <span class="font-extrabold text-white text-base">${name}</span>
                            </div>
                            <span class="text-xs text-slate-400">Gerade eben</span>
                        </div>
                        <p class="text-slate-300 text-sm leading-relaxed pl-10">${msg}</p>
                    `;
                    entriesList.appendChild(newEntry);
                    nameInput.value = '';
                    msgInput.value = '';
                }
            });
        </script>
    </body>
</html>
