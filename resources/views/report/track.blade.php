@extends('layouts.app')

@section('title', 'Lacak Status Laporan - BaliGuard')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-xs text-slate-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-amber-600">Beranda</a>
        <span>&bull;</span>
        <span class="text-slate-800 font-semibold">Lacak Laporan</span>
    </nav>

    <!-- Header & Search Box -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white rounded-3xl p-6 sm:p-8 border border-slate-800 shadow-xl mb-8">
        <div class="max-w-xl mx-auto text-center space-y-3 mb-6">
            <span class="text-[10px] font-bold text-amber-400 uppercase tracking-widest">Real-time Tracking</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white font-serif">Lacak Penanganan Laporan Insiden</h1>
            <p class="text-xs sm:text-sm text-slate-300">
                Masukkan Kode Pelacakan (Tracking Code) yang Anda dapatkan saat membuat laporan untuk melihat perkembangan penyelidikan dan tindakan tim lapangan.
            </p>
        </div>

        <!-- Tracking Search Input -->
        <form action="{{ route('report.track') }}" method="GET" class="max-w-md mx-auto flex items-center gap-2">
            <div class="relative flex-1">
                <i class="fa-solid fa-barcode absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input 
                    type="text" 
                    name="code" 
                    value="{{ $trackingCode ?? '' }}" 
                    placeholder="Masukkan kode (cth: BG-26-8841A)" 
                    class="w-full pl-10 pr-4 py-3 bg-slate-950 border border-slate-700 rounded-2xl text-white placeholder-slate-500 text-sm focus:border-amber-500 focus:outline-none uppercase" 
                    required
                >
            </div>
            <button type="submit" class="px-5 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-extrabold text-sm rounded-2xl shadow-lg transition flex-shrink-0">
                <i class="fa-solid fa-magnifying-glass mr-1.5"></i> Lacak
            </button>
        </form>
    </div>

    <!-- Tracking Result -->
    @if($report)
        @php $meta = $report->status_meta; @endphp
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden p-6 sm:p-10 space-y-8">
            
            <!-- Result Header -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-6 border-b border-slate-200">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kode Laporan</span>
                    <h2 class="text-2xl font-black text-slate-900 mt-0.5">{{ $report->tracking_code }}</h2>
                    <p class="text-xs text-slate-500 mt-1">
                        Didaftarkan pada: <strong>{{ $report->created_at->format('d M Y, H:i') }} WITA</strong>
                    </p>
                </div>
                <div class="self-start sm:self-center">
                    <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider border {{ $meta['color'] }}">
                        <span class="w-2 h-2 rounded-full mr-2 bg-current animate-pulse"></span>
                        {{ $meta['label'] }}
                    </span>
                </div>
            </div>

            <!-- 4-Stage Progress Timeline -->
            <div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Tahapan Penanganan Kasus</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 relative">
                    <!-- Step 1 -->
                    <div class="p-4 rounded-2xl border {{ $meta['step'] >= 1 ? 'border-amber-500 bg-amber-50/50' : 'border-slate-200 bg-slate-50 opacity-60' }} relative">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $meta['step'] >= 1 ? 'bg-amber-500 text-slate-950' : 'bg-slate-300 text-slate-600' }}">1</span>
                            <span class="text-xs font-bold text-slate-900">Laporan Masuk</span>
                        </div>
                        <p class="text-[11px] text-slate-600 leading-snug">Laporan diterima di sistem pusat kendali BaliGuard.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="p-4 rounded-2xl border {{ $meta['step'] >= 2 ? 'border-blue-500 bg-blue-50/50' : 'border-slate-200 bg-slate-50 opacity-60' }} relative">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $meta['step'] >= 2 ? 'bg-blue-600 text-white' : 'bg-slate-300 text-slate-600' }}">2</span>
                            <span class="text-xs font-bold text-slate-900">Verifikasi Berkas</span>
                        </div>
                        <p class="text-[11px] text-slate-600 leading-snug">Petugas memvalidasi data dan bukti kejadian.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="p-4 rounded-2xl border {{ $meta['step'] >= 3 ? 'border-purple-500 bg-purple-50/50' : 'border-slate-200 bg-slate-50 opacity-60' }} relative">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $meta['step'] >= 3 ? 'bg-purple-600 text-white' : 'bg-slate-300 text-slate-600' }}">3</span>
                            <span class="text-xs font-bold text-slate-900">Tindakan Lapangan</span>
                        </div>
                        <p class="text-[11px] text-slate-600 leading-snug">Unit reaksi cepat/polsek bergerak melakukan penanganan.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="p-4 rounded-2xl border {{ $meta['step'] >= 4 ? 'border-emerald-500 bg-emerald-50/50' : 'border-slate-200 bg-slate-50 opacity-60' }} relative">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $meta['step'] >= 4 ? 'bg-emerald-600 text-white' : 'bg-slate-300 text-slate-600' }}">4</span>
                            <span class="text-xs font-bold text-slate-900">Selesai Ditangani</span>
                        </div>
                        <p class="text-[11px] text-slate-600 leading-snug">Kasus dinyatakan tuntas dengan berita acara.</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 text-xs sm:text-sm">
                <p class="text-slate-700 leading-relaxed">
                    Status laporan diperbarui oleh petugas. Rincian laporan dan data pelapor hanya tersedia bagi petugas berwenang.
                </p>
            </div>

            <!-- Follow-up Support -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-200">
                <p class="text-xs text-slate-500 text-center sm:text-left">
                    Butuh bantuan mendesak lainnya terkait laporan ini?
                </p>
                <div class="flex items-center space-x-2">
                    <a href="tel:112" class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-sm flex items-center">
                        <i class="fa-solid fa-phone mr-1.5"></i> Hubungi 112
                    </a>
                    <button onclick="toggleChatbot(true)" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-amber-400 font-bold text-xs shadow-sm flex items-center">
                        <i class="fa-solid fa-sparkles mr-1.5"></i> Tanya AI Gemini
                    </button>
                </div>
            </div>

        </div>
    @elseif($trackingCode)
        <!-- Not Found State -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 text-center space-y-4 shadow-sm">
            <div class="w-16 h-16 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto text-2xl">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Kode Laporan Tidak Ditemukan</h3>
            <p class="text-xs sm:text-sm text-slate-600 max-w-md mx-auto">
                Nomor <strong>{{ $trackingCode }}</strong> tidak terdaftar dalam database sistem BaliGuard. Pastikan penulisan kode sudah sesuai (cth: <span class="font-mono font-bold text-amber-600">BG-26-9F3A7C12D4B65E81</span>).
            </p>
            <div class="pt-2">
                <a href="{{ route('report.create') }}" class="inline-flex items-center px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl transition">
                    Buat Laporan Baru Sekarang
                </a>
            </div>
        </div>
    @else
        <!-- Initial Guidance State -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 text-center space-y-4 shadow-sm">
            <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto text-2xl">
                <i class="fa-solid fa-magnifying-glass-location"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Contoh Kode Pelacakan Demo</h3>
            <p class="text-xs sm:text-sm text-slate-600 max-w-md mx-auto">
                Anda dapat mencoba melacak salah satu contoh laporan yang telah terdaftar dalam sistem simulasi:
            </p>
            <div class="flex flex-wrap items-center justify-center gap-2 pt-1">
                <a href="{{ route('report.track', ['code' => 'BG-26-8841A']) }}" class="px-3.5 py-1.5 bg-slate-100 hover:bg-amber-100 text-slate-800 hover:text-amber-900 font-mono text-xs font-bold rounded-lg border border-slate-300 transition">
                    BG-26-8841A (Pencurian Canggu)
                </a>
                <a href="{{ route('report.track', ['code' => 'BG-26-3912B']) }}" class="px-3.5 py-1.5 bg-slate-100 hover:bg-amber-100 text-slate-800 hover:text-amber-900 font-mono text-xs font-bold rounded-lg border border-slate-300 transition">
                    BG-26-3912B (Paspor Ubud)
                </a>
                <a href="{{ route('report.track', ['code' => 'BG-26-5519C']) }}" class="px-3.5 py-1.5 bg-slate-100 hover:bg-amber-100 text-slate-800 hover:text-amber-900 font-mono text-xs font-bold rounded-lg border border-slate-300 transition">
                    BG-26-5519C (Laka Lantas Kuta)
                </a>
            </div>
        </div>
    @endif

</div>
@endsection
