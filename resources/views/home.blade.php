@extends('layouts.app')

@section('title', 'BaliGuard - Pusat Keselamatan & Tanggap Darurat Wisatawan Bali')

@section('content')

<!-- Hero Section with Balinese Pattern & Dark Gradient -->
<section class="relative bg-slate-950 text-white hero-pattern overflow-hidden pt-8 pb-16 md:pt-14 md:pb-24 border-b border-slate-800">
    <!-- Ambient Glow Circles -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-amber-500/10 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute -top-10 -right-10 w-80 h-80 bg-red-600/15 blur-[100px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Official Partner Logos & Tagline -->
        <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-6 mb-8 text-slate-400 text-xs">
            <div class="flex items-center space-x-2 bg-slate-900/80 border border-slate-800 px-3 py-1.5 rounded-full">
                <i class="fa-solid fa-building-columns text-amber-400"></i>
                <span class="font-medium text-slate-300">Dinas Pariwisata Bali</span>
            </div>
            <div class="flex items-center space-x-2 bg-slate-900/80 border border-slate-800 px-3 py-1.5 rounded-full">
                <i class="fa-solid fa-shield-halved text-blue-400"></i>
                <span class="font-medium text-slate-300">Polda Bali & Polisi Pariwisata</span>
            </div>
            <div class="flex items-center space-x-2 bg-slate-900/80 border border-slate-800 px-3 py-1.5 rounded-full">
                <i class="fa-solid fa-life-ring text-red-400"></i>
                <span class="font-medium text-slate-300">BASARNAS & Balawista</span>
            </div>
            <div class="flex items-center space-x-2 bg-slate-900/80 border border-slate-800 px-3 py-1.5 rounded-full">
                <i class="fa-solid fa-handshake-angle text-emerald-400"></i>
                <span class="font-medium text-slate-300">Pecalang Adat Bali</span>
            </div>
        </div>

        <!-- Main Headline -->
        <div class="text-center max-w-4xl mx-auto space-y-4">
            <span class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-extrabold bg-gradient-to-r from-amber-500/20 to-red-500/20 text-amber-300 border border-amber-500/30 uppercase tracking-widest shadow-inner">
                <i class="fa-solid fa-shield-cat mr-2 text-amber-400"></i> Platform Keamanan & Early Warning Terpadu
            </span>
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight font-serif">
                Menjaga Harmoni & <span class="gold-gradient-text">Keselamatan Anda</span> di Pulau Dewata
            </h1>
            <p class="text-slate-300 text-sm sm:text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                Sistem tanggap darurat 24/7 resmi untuk wisatawan di Bali. Dilengkapi Tombol SOS cepat, pelaporan insiden terverifikasi, peta zonasi risiko, dan AI Chatbot Gemini.
            </p>
        </div>

        <!-- Primary Action Center (Responsive Grid) -->
        <div class="mt-10 max-w-3xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-4">
            
            <!-- Action 1: Huge SOS Panic Button -->
            <button onclick="openSosModal()" class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-red-600 via-rose-600 to-red-700 p-6 text-left shadow-2xl shadow-red-600/30 hover:shadow-red-600/50 hover:scale-[1.02] active:scale-[0.98] transition-all border border-red-500/50">
                <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center text-white text-2xl group-hover:rotate-12 transition-transform">
                        <i class="fa-solid fa-bell-exclamation animate-bounce"></i>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-white text-red-700 uppercase tracking-wider animate-pulse">
                        Panggilan Darurat
                    </span>
                </div>
                <h3 class="text-xl font-extrabold text-white tracking-wide">TOMBOL SOS CEPAT</h3>
                <p class="text-xs text-red-100 mt-1 leading-relaxed">
                    Satu ketukan kirim koordinat GPS Anda ke kepolisian, ambulans, dan SAR terdekat.
                </p>
            </button>

            <!-- Action 2: Report Incident -->
            <a href="{{ route('report.create') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-900 to-slate-800 p-6 text-left shadow-xl border border-slate-700 hover:border-amber-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center text-amber-400 text-2xl group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-file-shield"></i>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30 uppercase tracking-wider">
                        Formulir Online
                    </span>
                </div>
                <h3 class="text-xl font-extrabold text-white tracking-wide">LAPOR INSIDEN</h3>
                <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                    Laporkan kehilangan dokumen, pencurian, kecelakaan, atau konflik secara aman & resmi.
                </p>
            </a>

        </div>

        <!-- Quick Search Tracking & AI Trigger Bar -->
        <div class="mt-6 max-w-3xl mx-auto bg-slate-900/90 border border-slate-800 rounded-2xl p-4 shadow-xl backdrop-blur-md">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                
                <!-- Quick Tracking Form -->
                <form action="{{ route('report.track') }}" method="GET" class="w-full sm:w-auto flex-1 flex items-center gap-2">
                    <div class="relative flex-1">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                        <input 
                            type="text" 
                            name="code" 
                            placeholder="Cek status laporan (cth: BG-26-8841A)..." 
                            class="w-full pl-9 pr-3 py-2 text-xs bg-slate-950 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:border-amber-500 focus:outline-none"
                            required
                        >
                    </div>
                    <button type="submit" class="px-3.5 py-2 bg-slate-800 hover:bg-slate-700 text-amber-400 text-xs font-bold rounded-xl border border-slate-700 whitespace-nowrap transition">
                        Lacak
                    </button>
                </form>

                <div class="hidden sm:block w-px h-6 bg-slate-800"></div>

                <!-- Chatbot Quick Launch -->
                <button onclick="toggleChatbot(true)" class="w-full sm:w-auto px-4 py-2 bg-gradient-to-r from-amber-500/20 to-amber-600/20 hover:from-amber-500/30 hover:to-amber-600/30 text-amber-300 border border-amber-500/40 text-xs font-bold rounded-xl flex items-center justify-center space-x-2 transition">
                    <i class="fa-solid fa-sparkles text-amber-400"></i>
                    <span>Tanya Asisten AI Gemini</span>
                </button>
            </div>
        </div>

        <!-- Live Status Bar: Bali Tourism Safety Index -->
        <div class="mt-8 max-w-4xl mx-auto bg-slate-900/60 border border-slate-800/80 rounded-2xl p-4 text-xs text-slate-300">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center sm:text-left divide-y sm:divide-y-0 sm:divide-x divide-slate-800">
                
                <!-- Col 1: Safety Status -->
                <div class="flex items-center space-x-3 justify-center sm:justify-start pb-3 sm:pb-0 sm:pr-4">
                    <div class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400 text-lg flex-shrink-0">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Kondisi Pariwisata</p>
                        <p class="text-sm font-extrabold text-emerald-400 flex items-center">
                            <span>{{ $overallSafety['status'] }}</span>
                            <span class="ml-1.5 text-[10px] font-bold bg-emerald-500/20 px-1.5 py-0.5 rounded text-emerald-300">{{ $overallSafety['score'] }}%</span>
                        </p>
                    </div>
                </div>

                <!-- Col 2: Ocean Wave Info -->
                <div class="flex items-center space-x-3 justify-center sm:justify-start py-3 sm:py-0 sm:px-4">
                    <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 text-lg flex-shrink-0">
                        <i class="fa-solid fa-water"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Kondisi Gelombang Laut</p>
                        <p class="text-xs font-semibold text-slate-200 line-clamp-1" title="{{ $overallSafety['wave_condition'] }}">
                            {{ $overallSafety['wave_condition'] }}
                        </p>
                    </div>
                </div>

                <!-- Col 3: BMKG Weather -->
                <div class="flex items-center space-x-3 justify-center sm:justify-start pt-3 sm:pt-0 sm:pl-4">
                    <div class="w-10 h-10 rounded-full bg-amber-500/20 flex items-center justify-center text-amber-400 text-lg flex-shrink-0">
                        <i class="fa-solid fa-sun-cloud"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Cuaca BMKG Denpasar</p>
                        <p class="text-xs font-semibold text-slate-200">
                            {{ $overallSafety['weather'] }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- Early Warning Broadcasts Section -->
@if($warnings->count() > 0)
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-20">
    <div class="space-y-3">
        @foreach($warnings as $warn)
            @php $badge = $warn->severity_badge; @endphp
            <div class="p-4 rounded-2xl border shadow-lg flex flex-col md:flex-row items-start md:items-center justify-between gap-4 {{ $badge['bg'] }} backdrop-blur-md">
                <div class="flex items-start space-x-3.5">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 {{ $badge['badge'] }} shadow-sm">
                        @if($badge['icon'] === 'alert-triangle')
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        @elseif($badge['icon'] === 'alert-octagon')
                            <i class="fa-solid fa-circle-exclamation"></i>
                        @elseif($badge['icon'] === 'flame')
                            <i class="fa-solid fa-fire-flame-curved"></i>
                        @else
                            <i class="fa-solid fa-info"></i>
                        @endif
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded {{ $badge['badge'] }}">
                                {{ $warn->severity }} &bull; {{ $warn->regency }}
                            </span>
                            <span class="text-xs text-slate-500">{{ $warn->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 class="text-sm md:text-base font-bold text-slate-900 mt-1">{{ $warn->title }}</h4>
                        <p class="text-xs text-slate-700 mt-0.5 leading-relaxed">{{ $warn->content }}</p>
                    </div>
                </div>
                <div class="flex-shrink-0 self-end md:self-center">
                    <a href="{{ route('map') }}" class="inline-flex items-center text-xs font-bold px-3 py-1.5 rounded-lg bg-white border border-slate-300 text-slate-800 hover:bg-slate-50 transition shadow-sm">
                        <i class="fa-solid fa-map-pin mr-1.5 text-red-600"></i> Cek di Peta
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

<!-- Regional Tourist Safety Zones (9 Kabupaten / Kota) -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-14">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs font-bold text-amber-600 uppercase tracking-widest">
                <i class="fa-solid fa-location-dot"></i>
                <span>Zonasi Wilayah Wisata</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1 font-serif">Indeks Keamanan Wilayah Bali</h2>
            <p class="text-slate-600 text-sm mt-1">Pemantauan live respon keamanan dan pos penyelamatan lintas kabupaten di Bali.</p>
        </div>
        <a href="{{ route('map') }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800">
            <span>Buka Peta Interaktif Lengkap</span>
            <i class="fa-solid fa-arrow-right ml-1.5 text-xs"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($zones as $z)
        <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between mb-3">
                <h3 class="font-bold text-slate-900 text-sm md:text-base leading-snug">{{ $z['name'] }}</h3>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold {{ $z['badge'] === 'emerald' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
                    <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $z['badge'] === 'emerald' ? 'bg-emerald-500' : 'bg-amber-500 animate-pulse' }}"></span>
                    {{ $z['status'] }}
                </span>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed">{{ $z['note'] }}</p>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                <span class="flex items-center"><i class="fa-solid fa-shield-cat text-slate-400 mr-1"></i> Pos Siaga Aktif</span>
                <a href="{{ route('map') }}" class="font-semibold text-blue-600 hover:underline">Lihat Pos & Faskes</a>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Interactive Map Preview Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
        <div class="p-6 md:p-8 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold text-amber-400 uppercase tracking-widest flex items-center">
                    <i class="fa-solid fa-map-location-dot mr-1.5"></i> Geographic Safety Monitoring
                </span>
                <h3 class="text-xl md:text-2xl font-extrabold text-white mt-1 font-serif">Peta Lokasi Kantor Polisi, RS & Titik Rawan</h3>
                <p class="text-xs md:text-sm text-slate-300 mt-1">Temukan pos pertolongan medis, pos penyelamatan pantai (Balawista), dan pos polisi terdekat di sekitar Anda.</p>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('map') }}" class="px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs shadow-md transition flex items-center">
                    <i class="fa-solid fa-up-right-and-down-left-from-center mr-1.5"></i> Perbesar Peta
                </a>
            </div>
        </div>

        <!-- Interactive Leaflet Map Container -->
        <div id="homeMap" class="h-80 sm:h-96 md:h-[450px] w-full z-10 bg-slate-100"></div>

        <!-- Map Legend Bar -->
        <div class="p-4 bg-slate-50 border-t border-slate-200 flex flex-wrap items-center justify-center gap-4 text-xs font-semibold text-slate-700">
            <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-blue-600 mr-1.5"></span> Kantor Polisi & Polisi Wisata</span>
            <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-red-600 mr-1.5"></span> Rumah Sakit & Klinik UGD</span>
            <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-amber-500 mr-1.5"></span> Pos Balawista Pantai (SAR)</span>
            <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-purple-600 mr-1.5"></span> Konsulat Asing & Diplomatik</span>
            <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-rose-600 animate-ping mr-1.5"></span> Zona Waspada / Arus Kuat</span>
        </div>
    </div>
</section>

<!-- Official Bali Tourist Regulations & Etiquette (Do's & Don'ts) -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <div class="text-center max-w-2xl mx-auto mb-10">
        <span class="text-xs font-bold text-amber-600 uppercase tracking-widest">Surat Edaran Gubernur Bali</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1 font-serif">Tata Tertib & Do's and Don'ts Wisatawan</h2>
        <p class="text-slate-600 text-sm mt-2">Ketahui norma adat istiadat, keselamatan berkendara, dan hukum yang berlaku di Bali agar liburan Anda aman dan menyenangkan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- DO'S CARD -->
        <div class="bg-gradient-to-br from-emerald-50/60 to-white rounded-3xl p-6 md:p-8 border-2 border-emerald-200 shadow-sm">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-lg font-bold shadow-md shadow-emerald-600/20">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div>
                    <h3 class="text-lg font-extrabold text-emerald-950 uppercase tracking-wide">Hal yang Wajib Dilakukan (DO'S)</h3>
                    <p class="text-xs text-emerald-700">Patuhi etika untuk kenyamanan bersama</p>
                </div>
            </div>

            <ul class="space-y-4 text-xs md:text-sm text-slate-800">
                <li class="flex items-start space-x-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong>Kenakan Sarong & Selendang di Pura:</strong> Wajib memakai pakaian sopan dan tertutup saat memasuki area tempat suci persembahyangan.
                    </div>
                </li>
                <li class="flex items-start space-x-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong>Helm SNI & SIM Internasional:</strong> Wajib memakai helm standar saat naik motor dan mengantongi SIM Internasional yang sah.
                    </div>
                </li>
                <li class="flex items-start space-x-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong>Tukar Uang di Tempat Resmi:</strong> Selalu tukar mata uang asing di *Authorized Money Changer* berizin Bank Indonesia berlogo resmi.
                    </div>
                </li>
                <li class="flex items-start space-x-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong>Hormati Canang & Upacara Adat:</strong> Tidak melangkahi atau menginjak sesajen (*canang sari*) yang diletakkan di tanah.
                    </div>
                </li>
                <li class="flex items-start space-x-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong>Sewa Kendaraan Berizin:</strong> Rental kendaraan dari perusahaan berbadan hukum terdaftar yang memiliki perlindungan asuransi.
                    </div>
                </li>
            </ul>
        </div>

        <!-- DON'TS CARD -->
        <div class="bg-gradient-to-br from-rose-50/60 to-white rounded-3xl p-6 md:p-8 border-2 border-rose-200 shadow-sm">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-red-600 text-white flex items-center justify-center text-lg font-bold shadow-md shadow-red-600/20">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div>
                    <h3 class="text-lg font-extrabold text-rose-950 uppercase tracking-wide">Hal yang Dilarang Keras (DON'TS)</h3>
                    <p class="text-xs text-rose-700">Dapat dikenakan sanksi pidana & deportasi</p>
                </div>
            </div>

            <ul class="space-y-4 text-xs md:text-sm text-slate-800">
                <li class="flex items-start space-x-3">
                    <i class="fa-solid fa-circle-xmark text-red-600 text-base mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong>Dilarang Masuk Pura Saat Cuntaka:</strong> Wanita sedang haid atau keluarga berduka dilarang memasuki area suci persembahyangan.
                    </div>
                </li>
                <li class="flex items-start space-x-3">
                    <i class="fa-solid fa-circle-xmark text-red-600 text-base mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong>Dilarang Memanjat Pohon Keramat:</strong> Memanjat pohon beringin pura atau menduduki patung suci adalah penodaan tempat ibadah.
                    </div>
                </li>
                <li class="flex items-start space-x-3">
                    <i class="fa-solid fa-circle-xmark text-red-600 text-base mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong>Dilarang Bekerja Ilegal dengan Visa Wisata:</strong> Menyalahgunakan izin tinggal turis untuk bekerja akan berakibat deportasi dan blacklist.
                    </div>
                </li>
                <li class="flex items-start space-x-3">
                    <i class="fa-solid fa-circle-xmark text-red-600 text-base mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong>Dilarang Berkendara Tanpa Baju:</strong> Naik motor tanpa mengenakan pakaian sopan di jalan umum melanggar ketertiban umum.
                    </div>
                </li>
                <li class="flex items-start space-x-3">
                    <i class="fa-solid fa-circle-xmark text-red-600 text-base mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong>Dilarang Berenang Saat Bendera Merah:</strong> Jangan menentang peringatan Balawista di pantai selatan (ancaman rip current mematikan).
                    </div>
                </li>
            </ul>
        </div>

    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('guidelines') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-slate-900 text-white hover:bg-slate-800 text-xs md:text-sm font-bold shadow-md transition">
            <i class="fa-solid fa-book-open mr-2 text-amber-400"></i>
            <span>Baca Selengkapnya Perda Tata Tertib Wisatawan Bali</span>
        </a>
    </div>
</section>

<!-- Emergency Hotlines Directory Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
    <div class="bg-gradient-to-br from-slate-900 to-slate-950 rounded-3xl p-6 sm:p-10 text-white border border-slate-800 shadow-2xl relative overflow-hidden">
        
        <div class="relative z-10 max-w-2xl mb-8">
            <span class="text-xs font-bold text-amber-400 uppercase tracking-widest">24 Jam Bebas Pulsa</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1 font-serif">Direktori Kontak Cepat Tanggap Darurat</h2>
            <p class="text-slate-400 text-xs sm:text-sm mt-1">Simpan nomor darurat ini di ponsel Anda sebelum bepergian di Pulau Bali.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 relative z-10">
            
            <!-- Hotline 1: 112 -->
            <a href="tel:112" class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 hover:border-red-500 hover:bg-slate-800 transition group">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold text-slate-400">Terpadu Bebas Pulsa</span>
                    <i class="fa-solid fa-phone text-red-500 group-hover:scale-125 transition-transform"></i>
                </div>
                <div class="text-3xl font-extrabold text-white">112</div>
                <p class="text-xs text-slate-400 mt-1">Gawat Darurat Umum Bali</p>
            </a>

            <!-- Hotline 2: Polisi 110 -->
            <a href="tel:110" class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 hover:border-blue-500 hover:bg-slate-800 transition group">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold text-slate-400">Kepolisian RI</span>
                    <i class="fa-solid fa-shield text-blue-400 group-hover:scale-125 transition-transform"></i>
                </div>
                <div class="text-3xl font-extrabold text-white">110</div>
                <p class="text-xs text-slate-400 mt-1">Polda Bali & Kriminalitas</p>
            </a>

            <!-- Hotline 3: Ambulans 118 -->
            <a href="tel:118" class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 hover:border-emerald-500 hover:bg-slate-800 transition group">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold text-slate-400">Medis & Kesehatan</span>
                    <i class="fa-solid fa-truck-medical text-emerald-400 group-hover:scale-125 transition-transform"></i>
                </div>
                <div class="text-3xl font-extrabold text-white">118 / 119</div>
                <p class="text-xs text-slate-400 mt-1">Ambulans Gawat Darurat</p>
            </a>

            <!-- Hotline 4: BASARNAS 115 -->
            <a href="tel:115" class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 hover:border-amber-500 hover:bg-slate-800 transition group">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold text-slate-400">Penyelamatan Laut</span>
                    <i class="fa-solid fa-life-ring text-amber-400 group-hover:scale-125 transition-transform"></i>
                </div>
                <div class="text-3xl font-extrabold text-white">115</div>
                <p class="text-xs text-slate-400 mt-1">BASARNAS Bali (Air & SAR)</p>
            </a>

        </div>

        <div class="mt-6 pt-6 border-t border-slate-800 flex flex-wrap items-center justify-between gap-4 text-xs text-slate-400">
            <div>
                <strong>Tourist Police Call Center:</strong> <a href="tel:+62361224111" class="text-amber-400 hover:underline">+62 361 224111</a> / <a href="tel:+62361754599" class="text-amber-400 hover:underline">+62 361 754599</a>
            </div>
            <div>
                <strong>Pusat Rujukan Rabies (RSUP Sanglah):</strong> <a href="tel:+62361227911" class="text-amber-400 hover:underline">+62 361 227911</a>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Leaflet Map on Homepage Preview with Google Maps Verified Locations
        const mapElement = document.getElementById('homeMap');
        if (mapElement) {
            const map = L.map('homeMap', {
                scrollWheelZoom: false
            }).setView([-8.5069, 115.1889], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors | Ref: Google Maps Bali'
            }).addTo(map);

            const points = @json($locations);

            const catColors = {
                'police': '#2563eb',    // blue
                'hospital': '#dc2626',  // red
                'rescue': '#d97706',    // amber
                'hazard': '#e11d48',    // rose
                'consulate': '#7c3aed', // purple
                'embassy': '#7c3aed'    // purple
            };

            const catIcons = {
                'police': 'fa-shield-halved',
                'hospital': 'fa-hospital',
                'rescue': 'fa-life-ring',
                'hazard': 'fa-triangle-exclamation',
                'embassy': 'fa-building-columns'
            };

            const catLabels = {
                'police': 'Polisi',
                'hospital': 'RS & UGD',
                'rescue': 'Balawista & SAR',
                'hazard': 'Zona Bahaya',
                'embassy': 'Konsulat'
            };

            points.forEach(pt => {
                const color = catColors[pt.cat] || '#0284c7';
                const isHazard = pt.cat === 'hazard';

                const marker = L.circleMarker([pt.lat, pt.lng], {
                    radius: isHazard ? 9 : 7,
                    fillColor: color,
                    color: '#ffffff',
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.9
                }).addTo(map);

                const iconName = catIcons[pt.cat] || 'fa-location-dot';
                const labelName = catLabels[pt.cat] || pt.cat;

                marker.bindPopup(`
                    <div class="text-xs p-1" style="min-width: 230px; max-width: 290px;">
                        <div class="flex items-center space-x-1.5 mb-1.5">
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold text-white uppercase" style="background-color: ${color}">
                                <i class="fa-solid ${iconName} mr-1"></i> ${labelName}
                            </span>
                            <span class="text-[10px] text-slate-500 font-semibold">${pt.regency}</span>
                        </div>
                        <strong class="text-sm font-bold block text-slate-900 leading-snug mb-1">${pt.name}</strong>
                        <p class="text-slate-600 mb-1 leading-relaxed text-[11px]">${pt.address}</p>
                        ${pt.note ? `<p class="text-slate-500 italic mb-2 leading-relaxed text-[10px]">${pt.note}</p>` : ''}
                        
                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[11px]">
                            ${pt.phone ? `<a href="tel:${pt.phone}" class="font-bold text-emerald-700 hover:underline flex items-center"><i class="fa-solid fa-phone mr-1"></i> ${pt.phone}</a>` : '<span></span>'}
                            <a href="${pt.maps_url}" target="_blank" rel="noopener noreferrer" class="font-bold text-blue-600 hover:text-blue-800 hover:underline flex items-center ml-auto">
                                <i class="fa-brands fa-google mr-1"></i> Rute Maps <i class="fa-solid fa-arrow-up-right-from-square ml-1 text-[9px]"></i>
                            </a>
                        </div>
                    </div>
                `);
            });
        }
    });
</script>
@endpush
