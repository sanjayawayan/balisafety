<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BaliGuard - Pusat Keselamatan & Perlindungan Wisatawan Bali')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Cinzel:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Leaflet Map CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <!-- Tailwind CSS CDN with custom config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Cinzel"', 'serif'],
                    },
                    colors: {
                        bali: {
                            dark: '#0a0f1d',
                            navy: '#0f172a',
                            slate: '#1e293b',
                            gold: '#d97706',
                            goldlight: '#f59e0b',
                            red: '#dc2626',
                            redhover: '#b91c1c',
                            blue: '#0284c7',
                            emerald: '#059669',
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slight': 'bounce 2s infinite',
                    }
                }
            }
        }
    </script>

    <style>
        /* Balinese Pattern Accent */
        .bali-gradient {
            background: linear-gradient(135deg, #0a0f1d 0%, #0f172a 50%, #1e1b4b 100%);
        }
        .gold-gradient-text {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 50%, #d97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-pattern {
            background-color: #0a0f1d;
            background-image: radial-gradient(#1e293b 1px, transparent 1px), radial-gradient(#1e293b 1px, #0a0f1d 1px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
        }
        /* Mobile Safe Bottom Padding */
        .pb-mobile-nav {
            padding-bottom: 5.5rem;
        }
        @media (min-width: 768px) {
            .pb-mobile-nav {
                padding-bottom: 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-amber-500 selection:text-white pb-mobile-nav">

    <!-- Top Emergency Announcement Bar -->
    <div class="bg-gradient-to-r from-red-600 via-rose-600 to-amber-600 text-white text-xs md:text-sm font-medium py-2 px-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-white text-red-600 uppercase tracking-wider animate-pulse">
                    <i class="fa-solid fa-triangle-exclamation mr-1"></i> Hotlines
                </span>
                <span class="truncate">Nomor Darurat Terpadu Bali: <strong>112</strong> (Bebas Pulsa) | Polisi: <strong>110</strong> | Ambulans: <strong>118/119</strong></span>
            </div>
            <div class="hidden sm:flex items-center space-x-4 text-xs font-semibold">
                <a href="tel:112" class="hover:underline flex items-center"><i class="fa-solid fa-phone mr-1"></i> Panggil 112</a>
                <span class="text-white/40">|</span>
                <a href="https://wa.me/6281234567890" target="_blank" class="hover:underline flex items-center text-emerald-200">
                    <i class="fa-brands fa-whatsapp mr-1"></i> WhatsApp Hotline
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-40 bg-slate-900/95 backdrop-blur-md border-b border-slate-800 text-white transition-all shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-amber-500 via-red-500 to-amber-400 p-0.5 shadow-lg shadow-amber-500/20 group-hover:scale-105 transition-transform">
                        <div class="w-full h-full bg-slate-950 rounded-[10px] flex items-center justify-center">
                            <i class="fa-solid fa-shield-halved text-xl text-amber-400"></i>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xl md:text-2xl font-bold tracking-tight text-white font-serif">BALI<span class="text-amber-400">GUARD</span></span>
                            <span class="bg-red-500/20 text-red-400 border border-red-500/30 text-[10px] font-bold px-1.5 py-0.5 rounded uppercase">24/7 Respon</span>
                        </div>
                        <p class="text-[11px] text-slate-400 hidden sm:block tracking-wide">Tourist Safety & Early Warning System</p>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center space-x-1 lg:space-x-2 text-sm font-semibold">
                    <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-lg hover:text-amber-400 hover:bg-slate-800/60 transition {{ request()->routeIs('home') ? 'text-amber-400 bg-slate-800/80' : 'text-slate-300' }}">
                        <i class="fa-solid fa-house mr-1.5 opacity-70"></i> Beranda
                    </a>
                    <a href="{{ route('map') }}" class="px-3.5 py-2 rounded-lg hover:text-amber-400 hover:bg-slate-800/60 transition {{ request()->routeIs('map') ? 'text-amber-400 bg-slate-800/80' : 'text-slate-300' }}">
                        <i class="fa-solid fa-map-location-dot mr-1.5 opacity-70"></i> Peta Keamanan
                    </a>
                    <a href="{{ route('guidelines') }}" class="px-3.5 py-2 rounded-lg hover:text-amber-400 hover:bg-slate-800/60 transition {{ request()->routeIs('guidelines') ? 'text-amber-400 bg-slate-800/80' : 'text-slate-300' }}">
                        <i class="fa-solid fa-book-bookmark mr-1.5 opacity-70"></i> Tata Tertib
                    </a>
                    <a href="{{ route('report.create') }}" class="px-3.5 py-2 rounded-lg hover:text-amber-400 hover:bg-slate-800/60 transition {{ request()->routeIs('report.create') ? 'text-amber-400 bg-slate-800/80' : 'text-slate-300' }}">
                        <i class="fa-solid fa-file-shield mr-1.5 opacity-70"></i> Lapor Insiden
                    </a>
                    <a href="{{ route('report.track') }}" class="px-3.5 py-2 rounded-lg hover:text-amber-400 hover:bg-slate-800/60 transition {{ request()->routeIs('report.track') ? 'text-amber-400 bg-slate-800/80' : 'text-slate-300' }}">
                        <i class="fa-solid fa-magnifying-glass-location mr-1.5 opacity-70"></i> Cek Status
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 text-xs font-bold text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition ml-2 border border-slate-700">
                        <i class="fa-solid fa-user-shield mr-1"></i> Petugas
                    </a>
                </nav>

                <!-- SOS Emergency Call Button Trigger -->
                <div class="flex items-center space-x-3">
                    <button onclick="openSosModal()" class="relative inline-flex items-center justify-center px-4 md:px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 rounded-xl shadow-lg shadow-red-600/30 hover:shadow-red-600/50 hover:scale-105 active:scale-95 transition-all">
                        <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-red-500 border-2 border-slate-900"></span>
                        </span>
                        <i class="fa-solid fa-triangle-exclamation mr-2 animate-bounce-slight"></i>
                        <span>SOS DARURAT</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Global Flash Notification -->
    @if(session('success'))
    <div class="max-w-5xl mx-auto px-4 mt-4">
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 flex items-start space-x-3 shadow-sm animate-fade-in">
            <i class="fa-solid fa-circle-check text-xl text-emerald-600 mt-0.5"></i>
            <div class="flex-1 font-medium text-sm md:text-base">
                {{ session('success') }}
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 font-bold">&times;</button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-5xl mx-auto px-4 mt-4">
        <div class="p-4 rounded-xl bg-rose-50 border border-rose-300 text-rose-800 flex items-start space-x-3 shadow-sm animate-fade-in">
            <i class="fa-solid fa-circle-exclamation text-xl text-rose-600 mt-0.5"></i>
            <div class="flex-1 font-medium text-sm md:text-base">
                {{ session('error') }}
            </div>
            <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-800 font-bold">&times;</button>
        </div>
    </div>
    @endif

    <!-- Main Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 border-t border-slate-800 mt-20 pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <!-- Col 1: Brand Info -->
                <div class="space-y-4 md:col-span-1">
                    <div class="flex items-center space-x-2">
                        <i class="fa-solid fa-shield-halved text-2xl text-amber-400"></i>
                        <span class="text-xl font-bold text-white font-serif">BALI<span class="text-amber-400">GUARD</span></span>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-400">
                        Sistem Informasi & Tanggap Darurat Perlindungan Keselamatan Wisatawan Bali terpadu. Kolaborasi Dinas Pariwisata Bali, Kepolisian Daerah Bali, BASARNAS, dan Pecalang Adat.
                    </p>
                    <div class="pt-2 text-xs text-slate-500">
                        <p class="font-semibold text-slate-400">Pusat Komando & Layanan:</p>
                        <p>Denpasar, Bali - Indonesia</p>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h3 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Layanan Utama</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-amber-400 transition">Pusat Informasi & Status Cuaca</a></li>
                        <li><a href="javascript:void(0)" onclick="openSosModal()" class="text-red-400 hover:text-red-300 font-semibold transition">Tombol Panic / SOS Darurat</a></li>
                        <li><a href="{{ route('report.create') }}" class="hover:text-amber-400 transition">Formulir Laporan Insiden</a></li>
                        <li><a href="{{ route('report.track') }}" class="hover:text-amber-400 transition">Lacak Progres Laporan</a></li>
                        <li><a href="{{ route('map') }}" class="hover:text-amber-400 transition">Peta Faskes & Pos Pengamanan</a></li>
                        <li><a href="{{ route('guidelines') }}" class="hover:text-amber-400 transition">Do's & Don'ts Wisatawan Bali</a></li>
                    </ul>
                </div>

                <!-- Col 3: Emergency Directory -->
                <div>
                    <h3 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Kontak Darurat Resmi</h3>
                    <ul class="space-y-2 text-xs">
                        <li class="flex justify-between py-1 border-b border-slate-800">
                            <span>Darurat Terpadu:</span>
                            <a href="tel:112" class="font-bold text-white hover:text-amber-400">112 (Bebas Pulsa)</a>
                        </li>
                        <li class="flex justify-between py-1 border-b border-slate-800">
                            <span>Polisi (Polda Bali):</span>
                            <a href="tel:110" class="font-bold text-white hover:text-amber-400">110</a>
                        </li>
                        <li class="flex justify-between py-1 border-b border-slate-800">
                            <span>Tourist Police:</span>
                            <a href="tel:+62361224111" class="font-bold text-white hover:text-amber-400">+62 361 224111</a>
                        </li>
                        <li class="flex justify-between py-1 border-b border-slate-800">
                            <span>Ambulans Medis:</span>
                            <a href="tel:118" class="font-bold text-white hover:text-amber-400">118 / 119</a>
                        </li>
                        <li class="flex justify-between py-1 border-b border-slate-800">
                            <span>BASARNAS (Laut/SAR):</span>
                            <a href="tel:115" class="font-bold text-white hover:text-amber-400">115</a>
                        </li>
                        <li class="flex justify-between py-1">
                            <span>BIMC Hospital 24 Jam:</span>
                            <a href="tel:+62361761263" class="font-bold text-white hover:text-amber-400">+62 361 761263</a>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Gemini AI Chatbot Info -->
                <div class="space-y-4">
                    <h3 class="text-white font-bold text-sm tracking-wider uppercase">Dukungan AI Gemini</h3>
                    <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 text-xs text-slate-300 space-y-2.5">
                        <div class="flex items-center space-x-2 text-amber-400 font-semibold">
                            <i class="fa-solid fa-sparkles"></i>
                            <span>BaliGuard AI Assistant</span>
                        </div>
                        <p class="leading-relaxed">
                            Dilengkapi kecerdasan buatan Google Gemini untuk merespons pertanyaan keselamatan, etika Pura, panduan medis, dan rujukan darurat secara interaktif.
                        </p>
                        <button onclick="toggleChatbot(true)" class="w-full py-2 px-3 rounded-lg bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs flex items-center justify-center space-x-1.5 transition">
                            <i class="fa-solid fa-comments"></i>
                            <span>Mulai Chat dengan AI</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-800/80 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} BaliGuard - Kertha Jaya & Dinas Pariwisata Provinsi Bali. All rights reserved.</p>
                <div class="flex items-center space-x-4">
                    <span>Versi Responsif 2.0</span>
                    <span class="text-slate-700">&bull;</span>
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-400">Portal Admin</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation Bar (App-like UX) -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-slate-950/95 backdrop-blur-lg border-t border-slate-800 text-slate-400 px-2 py-2">
        <div class="grid grid-cols-5 text-center text-[10px] font-semibold">
            <a href="{{ route('home') }}" class="flex flex-col items-center py-1 {{ request()->routeIs('home') ? 'text-amber-400 font-bold' : 'hover:text-white' }}">
                <i class="fa-solid fa-house text-base mb-1"></i>
                <span>Beranda</span>
            </a>
            <a href="{{ route('map') }}" class="flex flex-col items-center py-1 {{ request()->routeIs('map') ? 'text-amber-400 font-bold' : 'hover:text-white' }}">
                <i class="fa-solid fa-map-location-dot text-base mb-1"></i>
                <span>Peta</span>
            </a>
            <button onclick="openSosModal()" class="flex flex-col items-center -mt-5">
                <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-red-600 to-rose-500 text-white flex items-center justify-center shadow-lg shadow-red-600/50 border-2 border-slate-900 animate-pulse">
                    <i class="fa-solid fa-bell text-lg"></i>
                </div>
                <span class="text-red-400 font-bold mt-0.5">SOS</span>
            </button>
            <a href="{{ route('report.create') }}" class="flex flex-col items-center py-1 {{ request()->routeIs('report.create') ? 'text-amber-400 font-bold' : 'hover:text-white' }}">
                <i class="fa-solid fa-file-pen text-base mb-1"></i>
                <span>Lapor</span>
            </a>
            <button onclick="toggleChatbot(true)" class="flex flex-col items-center py-1 hover:text-white relative">
                <i class="fa-solid fa-robot text-base mb-1 text-amber-400"></i>
                <span>AI Chat</span>
                <span class="absolute top-1 right-3 w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
            </button>
        </div>
    </div>

    <!-- Include Panic SOS Modal Component -->
    @include('components.sos-modal')

    <!-- Include Gemini AI Chatbot Component -->
    @include('components.chatbot')

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    @stack('scripts')
</body>
</html>
