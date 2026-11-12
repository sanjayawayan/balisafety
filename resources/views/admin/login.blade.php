<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Masuk Pusat Komando - BaliGuard</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Cinzel:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
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
<body class="bg-slate-950 text-slate-100 font-sans min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Logo and Brand -->
        <div class="text-center mb-8">
            <div class="inline-flex w-16 h-16 rounded-3xl bg-amber-500 items-center justify-center text-slate-950 font-black text-3xl shadow-xl shadow-amber-500/20 mb-3">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h1 class="text-2xl font-black tracking-wide font-serif text-white">BALI<span class="text-amber-400">GUARD</span></h1>
            <p class="text-xs text-slate-400 mt-1 uppercase tracking-widest font-semibold">Pusat Komando & Dispatcher Darurat</p>
        </div>

        <!-- Alert Notification -->
        @if(session('error'))
        <div class="mb-4 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs flex items-center space-x-2.5">
            <i class="fa-solid fa-triangle-exclamation text-rose-400 text-sm flex-shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        @if(session('warning'))
        <div class="mb-4 p-4 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs flex items-center space-x-2.5">
            <i class="fa-solid fa-circle-exclamation text-amber-400 text-sm flex-shrink-0"></i>
            <span>{{ session('warning') }}</span>
        </div>
        @endif

        @if(session('success'))
        <div class="mb-4 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs flex items-center space-x-2.5">
            <i class="fa-solid fa-circle-check text-emerald-400 text-sm flex-shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Login Form Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
            <div class="border-b border-slate-800 pb-4">
                <h2 class="text-base font-bold text-white">Otorisasi Petugas Piket</h2>
                <p class="text-xs text-slate-400 mt-0.5">Masukkan kredensial akun dispatcher untuk mengakses instrumen kendali.</p>
            </div>

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1.5 uppercase tracking-wider">Username Petugas</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                        <input 
                            type="text" 
                            name="username" 
                            value="{{ old('username', 'admin') }}" 
                            placeholder="admin" 
                            required 
                            autofocus
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-950 border border-slate-700 rounded-xl text-white placeholder-slate-600 text-xs sm:text-sm focus:border-amber-500 focus:outline-none transition"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1.5 uppercase tracking-wider">Kata Sandi</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="••••••••" 
                            required 
                            class="w-full pl-9 pr-3.5 py-2.5 bg-slate-950 border border-slate-700 rounded-xl text-white placeholder-slate-600 text-xs sm:text-sm focus:border-amber-500 focus:outline-none transition"
                        >
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800 text-[11px] text-slate-400 flex items-center justify-between">
                    <span class="text-slate-500">Default Sandbox/Demo:</span>
                    <span class="font-mono text-amber-400 font-bold">admin / baliguard2026</span>
                </div>

                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-extrabold text-xs sm:text-sm rounded-xl shadow-lg shadow-amber-500/20 active:scale-98 transition flex items-center justify-center space-x-2"
                >
                    <i class="fa-solid fa-right-to-bracket mr-1"></i>
                    <span>MASUK PUSAT KOMANDO</span>
                </button>
            </form>

            <div class="pt-2 border-t border-slate-800 text-center">
                <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-amber-400 transition flex items-center justify-center space-x-1.5">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke Portal Wisatawan</span>
                </a>
            </div>
        </div>

        <p class="text-center text-[11px] text-slate-600 mt-6">
            &copy; 2026 BaliGuard &bull; Sistem Terpadu Pengamanan & Tanggap Insiden Wisatawan Bali
        </p>
    </div>

</body>
</html>
