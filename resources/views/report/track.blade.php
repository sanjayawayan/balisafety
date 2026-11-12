@extends('layouts.app')

@section('title', __t('track_title') . ' - BaliGuard')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-xs text-slate-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-amber-600">{{ __t('nav_home') }}</a>
        <span>&bull;</span>
        <span class="text-slate-800 font-semibold">{{ __t('nav_track') }}</span>
    </nav>

    <!-- Header & Search Box -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white rounded-3xl p-6 sm:p-8 border border-slate-800 shadow-xl mb-8">
        <div class="max-w-xl mx-auto text-center space-y-3 mb-6">
            <span class="text-[10px] font-bold text-amber-400 uppercase tracking-widest">Real-time Tracking</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white font-serif">{{ __t('track_title') }}</h1>
            <p class="text-xs sm:text-sm text-slate-300">
                {{ __t('track_desc') }}
            </p>
        </div>

        <!-- Tracking Search Input -->
        <form action="{{ route('report.track') }}" method="GET" class="max-w-md mx-auto flex items-center gap-2">
            <div class="relative flex-1">
                <i class="fa-solid fa-barcode absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input 
                    type="text" 
                    name="code" 
                    id="tracking_code_input"
                    value="{{ $trackingCode ?? '' }}" 
                    placeholder="{{ __t('track_input_ph') }}" 
                    class="w-full pl-10 pr-4 py-3 bg-slate-950 border border-slate-700 rounded-2xl text-white placeholder-slate-500 text-sm focus:border-amber-500 focus:outline-none uppercase" 
                    required
                >
            </div>
            <button type="submit" class="px-5 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-extrabold text-sm rounded-2xl shadow-lg transition flex-shrink-0">
                <i class="fa-solid fa-magnifying-glass mr-1.5"></i> {{ __t('track_btn') }}
            </button>
        </form>
    </div>

    <!-- User's Recent Reports Switcher -->
    @if(!empty($myReports) && count($myReports) > 0)
    <div class="mb-6 p-4 rounded-2xl bg-amber-500/10 border border-amber-500/30">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-bold text-amber-800 uppercase tracking-wide flex items-center">
                <i class="fa-solid fa-clock-rotate-left mr-1.5"></i> Riwayat Laporan Terakhir Anda:
            </span>
            <span class="text-[11px] text-amber-700 font-semibold">{{ count($myReports) }} Tersimpan</span>
        </div>
        <div class="flex flex-wrap gap-2">
            @foreach($myReports as $myRep)
                @php $c = strtoupper($myRep['tracking_code'] ?? ''); @endphp
                @if($c)
                <a href="{{ route('report.track', ['code' => $c]) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold border transition flex items-center space-x-1.5 {{ (isset($report) && $report->tracking_code === $c) ? 'bg-amber-500 text-slate-950 border-amber-600 shadow-sm' : 'bg-white text-slate-800 border-slate-200 hover:border-amber-400' }}">
                    <span class="font-mono">{{ $c }}</span>
                    <span class="text-[10px] opacity-75">({{ $myRep['category_label'] ?? $myRep['category'] ?? 'Insiden' }})</span>
                </a>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    <!-- Tracking Result -->
    @if($report)
        @php $meta = $report->status_meta; @endphp
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden p-6 sm:p-10 space-y-8">
            
            <!-- Result Header -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-6 border-b border-slate-200">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kode Pelacakan Resmi</span>
                    <h2 class="text-2xl font-black text-slate-900 mt-0.5 font-mono">{{ $report->tracking_code }}</h2>
                    <p class="text-xs text-slate-500 mt-1">
                        Didaftarkan: <strong>{{ $report->created_at->format('d M Y, H:i') }} WITA</strong> &bull; Pelapor: <strong>{{ $report->reporter_name }}</strong>
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
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">{{ __t('track_status_title') }}</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 relative">
                    <!-- Step 1 -->
                    <div class="p-4 rounded-2xl border {{ $meta['step'] >= 1 ? 'border-amber-500 bg-amber-50/50' : 'border-slate-200 bg-slate-50 opacity-60' }} relative">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $meta['step'] >= 1 ? 'bg-amber-500 text-slate-950' : 'bg-slate-300 text-slate-600' }}">1</span>
                            <span class="text-xs font-bold text-slate-900">{{ __t('track_stage_1') }}</span>
                        </div>
                        <p class="text-[11px] text-slate-600 leading-snug">Laporan diterima di sistem pusat kendali BaliGuard.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="p-4 rounded-2xl border {{ $meta['step'] >= 2 ? 'border-blue-500 bg-blue-50/50' : 'border-slate-200 bg-slate-50 opacity-60' }} relative">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $meta['step'] >= 2 ? 'bg-blue-600 text-white' : 'bg-slate-300 text-slate-600' }}">2</span>
                            <span class="text-xs font-bold text-slate-900">{{ __t('track_stage_2') }}</span>
                        </div>
                        <p class="text-[11px] text-slate-600 leading-snug">Petugas memvalidasi data dan bukti kejadian.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="p-4 rounded-2xl border {{ $meta['step'] >= 3 ? 'border-purple-500 bg-purple-50/50' : 'border-slate-200 bg-slate-50 opacity-60' }} relative">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $meta['step'] >= 3 ? 'bg-purple-600 text-white' : 'bg-slate-300 text-slate-600' }}">3</span>
                            <span class="text-xs font-bold text-slate-900">{{ __t('track_stage_3') }}</span>
                        </div>
                        <p class="text-[11px] text-slate-600 leading-snug">Unit reaksi cepat/polsek bergerak melakukan penanganan.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="p-4 rounded-2xl border {{ $meta['step'] >= 4 ? 'border-emerald-500 bg-emerald-50/50' : 'border-slate-200 bg-slate-50 opacity-60' }} relative">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $meta['step'] >= 4 ? 'bg-emerald-600 text-white' : 'bg-slate-300 text-slate-600' }}">4</span>
                            <span class="text-xs font-bold text-slate-900">{{ __t('track_stage_4') }}</span>
                        </div>
                        <p class="text-[11px] text-slate-600 leading-snug">Kasus dinyatakan tuntas dengan berita acara.</p>
                    </div>
                </div>
            </div>

            <!-- Incident Details & Officer Notes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-xs sm:text-sm space-y-2.5">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">{{ __t('track_detail_title') }}</span>
                    <div class="flex justify-between border-b border-slate-200/60 pb-1.5">
                        <span class="text-slate-500">Kategori Insiden:</span>
                        <span class="font-bold text-slate-800">{{ $report->category_label }}</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-200/60 pb-1.5">
                        <span class="text-slate-500">Wilayah / Kabupaten:</span>
                        <span class="font-bold text-slate-800">{{ $report->regency }}</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-200/60 pb-1.5">
                        <span class="text-slate-500">Lokasi Kejadian:</span>
                        <span class="font-semibold text-slate-800 text-right max-w-[200px] truncate">{{ $report->incident_location }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Instansi Penanggung Jawab:</span>
                        <span class="font-bold text-amber-700 text-right">{{ $report->assigned_agency ?: 'Pusat Kendali Satpol PP & BPBD Bali' }}</span>
                    </div>
                </div>

                <div class="bg-amber-50/50 rounded-2xl p-5 border border-amber-200 text-xs sm:text-sm space-y-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-800 block flex items-center">
                        <i class="fa-solid fa-clipboard-check mr-1.5"></i> {{ __t('track_officer_title') }}
                    </span>
                    @if($report->officer_notes)
                        <p class="text-slate-800 leading-relaxed whitespace-pre-line font-medium">{{ $report->officer_notes }}</p>
                    @else
                        <p class="text-slate-500 italic">Petugas piket sedang memvalidasi berkas laporan. Catatan perkembangan lapangan akan segera dimutakhirkan di sini.</p>
                    @endif
                </div>
            </div>

            <!-- Follow-up Support -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-200">
                <p class="text-xs text-slate-500 text-center sm:text-left">
                    {{ __t('track_urgent_help') }}
                </p>
                <div class="flex items-center space-x-2">
                    <a href="tel:112" class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-sm flex items-center">
                        <i class="fa-solid fa-phone mr-1.5"></i> {{ __t('track_call_112') }}
                    </a>
                    <button onclick="toggleChatbot(true)" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-amber-400 font-bold text-xs shadow-sm flex items-center">
                        <i class="fa-solid fa-wand-magic-sparkles mr-1.5"></i> {{ __t('track_ask_ai') }}
                    </button>
                </div>
            </div>

        </div>
    @elseif($trackingCode)
        <!-- Not Found State with Auto Recovery from Browser -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 text-center space-y-4 shadow-sm" id="notFoundBox">
            <div class="w-16 h-16 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto text-2xl">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Kode Laporan Tidak Ditemukan</h3>
            <p class="text-xs sm:text-sm text-slate-600 max-w-md mx-auto">
                Nomor <strong>{{ $trackingCode }}</strong> belum tercatat di instance saat ini. Sistem sedang mencoba pemulihan otomatis...
            </p>
            <div class="pt-2">
                <a href="{{ route('report.create') }}" class="inline-flex items-center px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl transition">
                    Buat Laporan Baru Sekarang
                </a>
            </div>
        </div>

        <script>
            // Auto Recovery from localStorage if available
            (function() {
                try {
                    const rawDraft = localStorage.getItem('baliguard_last_submitted_draft');
                    if (rawDraft) {
                        const parsed = JSON.parse(rawDraft);
                        const code = "{{ $trackingCode }}";
                        parsed.tracking_code = code;
                        fetch("{{ route('api.incidents.sync') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]')?.getAttribute('content') || ''
                            },
                            body: JSON.stringify({ reports: [parsed] })
                        }).then(r => r.json()).then(data => {
                            if (data.status === 'OK' && data.synced > 0) {
                                window.location.reload();
                            }
                        }).catch(e => console.log('Sync recovery error:', e));
                    }
                } catch(e) {}
            })();
        </script>
    @else
        <!-- Initial Guidance State -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 text-center space-y-4 shadow-sm">
            <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto text-2xl">
                <i class="fa-solid fa-magnifying-glass"></i>
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
