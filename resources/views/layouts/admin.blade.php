<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pusat Komando & Kendali - BaliGuard')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Cinzel:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Cinzel"', 'serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased">

    <div class="min-h-screen flex flex-col md:flex-row">
        
        <!-- Admin Sidebar -->
        <aside class="w-full md:w-64 bg-slate-950 text-white flex-shrink-0 border-r border-slate-800">
            <!-- Sidebar Header -->
            <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-500 flex items-center justify-center text-slate-950 font-bold">
                        <i class="fa-solid fa-shield-halved text-lg"></i>
                    </div>
                    <div>
                        <span class="font-bold text-base tracking-wide font-serif">BALI<span class="text-amber-400">GUARD</span></span>
                        <p class="text-[10px] text-slate-400">Pusat Komando Respon</p>
                    </div>
                </a>
                <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping" title="Sistem Aktif 24 Jam"></span>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1 text-xs font-semibold">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-chart-line w-5 text-sm mr-2.5"></i>
                    <span>Dashboard Utama</span>
                </a>

                <a href="{{ route('admin.sos.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.sos.*') ? 'bg-red-600 text-white font-bold shadow' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <div class="flex items-center">
                        <i class="fa-solid fa-bell-exclamation w-5 text-sm mr-2.5 text-red-500"></i>
                        <span>Live Sinyal SOS</span>
                    </div>
                    <span class="bg-red-500/20 text-red-400 border border-red-500/30 text-[10px] font-bold px-1.5 py-0.5 rounded">24/7</span>
                </a>

                <a href="{{ route('admin.incidents.index') }}" class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.incidents.*') ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-file-shield w-5 text-sm mr-2.5"></i>
                    <span>Kelola Laporan Insiden</span>
                </a>

                <a href="{{ route('admin.warnings.index') }}" class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.warnings.*') ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-triangle-exclamation w-5 text-sm mr-2.5"></i>
                    <span>Peringatan Dini (BMKG)</span>
                </a>

                <div class="pt-6 pb-2 px-4 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                    Akses Cepat
                </div>

                <a href="{{ route('home') }}" target="_blank" class="flex items-center px-4 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-900 transition">
                    <i class="fa-solid fa-arrow-up-right-from-square w-5 text-sm mr-2.5 text-amber-400"></i>
                    <span>Buka Portal Wisatawan</span>
                </a>

                <a href="{{ route('map') }}" target="_blank" class="flex items-center px-4 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-900 transition">
                    <i class="fa-solid fa-map-location-dot w-5 text-sm mr-2.5 text-blue-400"></i>
                    <span>Peta Faskes & Pos</span>
                </a>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 mt-auto border-t border-slate-800 text-[11px] text-slate-400">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-slate-800 text-amber-400 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-user-shield text-xs"></i>
                        </div>
                        <div>
                            <p class="font-bold text-white text-xs">{{ session('admin_user', 'Administrator') }}</p>
                            <p class="text-[10px] text-slate-500">Pusdalops BaliGuard</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2 px-3 bg-slate-900 hover:bg-rose-950/60 hover:text-rose-400 text-slate-300 font-bold rounded-xl transition flex items-center justify-center space-x-2 border border-slate-800 text-xs">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Keluar (Logout)</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Bar -->
            <header class="h-20 bg-white border-b border-slate-200 px-6 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest hidden sm:inline">Pusat Komando Keamanan Bali:</span>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
                        Status Siaga Hijau (Kondusif)
                    </span>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-slate-900">{{ date('l, d F Y') }}</p>
                        <p class="text-[11px] text-slate-500">Waktu Indonesia Tengah (WITA)</p>
                    </div>
                    <a href="tel:112" class="px-3 py-1.5 rounded-lg bg-red-600 text-white font-bold text-xs flex items-center shadow hover:bg-red-700 transition">
                        <i class="fa-solid fa-phone mr-1.5"></i> 112 Hotline
                    </a>
                </div>
            </header>

            <!-- Flash Alerts -->
            @if(session('success'))
            <div class="px-6 pt-4">
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs sm:text-sm font-semibold flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fa-solid fa-circle-check text-emerald-600 mr-2 text-base"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 font-bold">&times;</button>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="px-6 pt-4">
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-300 text-rose-800 text-xs sm:text-sm font-semibold flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fa-solid fa-triangle-exclamation text-rose-600 mr-2 text-base"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900 font-bold">&times;</button>
                </div>
            </div>
            @endif

            @if(session('warning'))
            <div class="px-6 pt-4">
                <div class="p-4 rounded-xl bg-amber-50 border border-amber-300 text-amber-800 text-xs sm:text-sm font-semibold flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fa-solid fa-circle-exclamation text-amber-600 mr-2 text-base"></i>
                        <span>{{ session('warning') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-amber-700 hover:text-amber-900 font-bold">&times;</button>
                </div>
            </div>
            @endif

            <!-- Main Page View -->
            <main class="flex-1 overflow-y-auto p-6 lg:p-8">
                @yield('content')
            </main>

        </div>

    </div>

    @stack('scripts')
</body>
</html>
