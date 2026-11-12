@extends('layouts.admin')

@section('title', 'Dashboard Pusat Komando - BaliGuard')

@section('content')
<div class="space-y-8">
    
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight font-serif">Pusat Kendali Operasi & Tanggap Darurat</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Pemantauan real-time insiden wisatawan dan koordinasi lintas instansi (Polda Bali, Balawista, BPBD, Pecalang).</p>
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.sos.index') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold text-xs rounded-xl shadow transition flex items-center">
                <i class="fa-solid fa-tower-broadcast mr-1.5 animate-pulse"></i> Monitor SOS Live
            </a>
            <a href="{{ route('admin.warnings.index') }}" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-amber-400 font-bold text-xs rounded-xl shadow transition flex items-center">
                <i class="fa-solid fa-bullhorn mr-1.5"></i> Siarkan Peringatan
            </a>
        </div>
    </div>

    <!-- Metrics Cards Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Metric 1: Active SOS -->
        <div class="bg-gradient-to-br from-red-600 to-rose-700 text-white rounded-3xl p-5 shadow-lg shadow-red-600/20 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-red-100">SOS Aktif / Belum Selesai</span>
                <i class="fa-solid fa-bell text-xl text-red-200"></i>
            </div>
            <div class="mt-3 text-3xl sm:text-4xl font-black">{{ $stats['active_sos'] }}</div>
            <p class="text-[11px] text-red-100 mt-1">Sinyal darurat butuh respon</p>
        </div>

        <!-- Metric 2: Pending Incidents -->
        <div class="bg-white rounded-3xl p-5 border border-slate-200 shadow-sm relative">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Laporan Menunggu</span>
                <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <div class="mt-3 text-3xl sm:text-4xl font-black text-slate-900">{{ $stats['pending_incidents'] }}</div>
            <p class="text-[11px] text-slate-400 mt-1">Perlu verifikasi data petugas</p>
        </div>

        <!-- Metric 3: Total Incidents -->
        <div class="bg-white rounded-3xl p-5 border border-slate-200 shadow-sm relative">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Insiden Masuk</span>
                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
            </div>
            <div class="mt-3 text-3xl sm:text-4xl font-black text-slate-900">{{ $stats['total_incidents'] }}</div>
            <p class="text-[11px] text-slate-400 mt-1">Tercatat dalam sistem BaliGuard</p>
        </div>

        <!-- Metric 4: Resolved Incidents -->
        <div class="bg-white rounded-3xl p-5 border border-slate-200 shadow-sm relative">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Kasus Selesai Ditangani</span>
                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
            <div class="mt-3 text-3xl sm:text-4xl font-black text-emerald-600">{{ $stats['resolved_incidents'] }}</div>
            <p class="text-[11px] text-slate-400 mt-1">Dituntaskan dengan BAP/Mediasi</p>
        </div>

    </div>

    <!-- Active SOS Alerts Monitoring Feed -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 sm:p-6 bg-slate-950 text-white flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <span class="w-3 h-3 rounded-full bg-red-500 animate-ping"></span>
                <h3 class="font-bold text-sm sm:text-base tracking-wide uppercase">Panggilan Darurat SOS Masuk Terkini</h3>
            </div>
            <a href="{{ route('admin.sos.index') }}" class="text-xs font-bold text-amber-400 hover:underline">
                Lihat Semua SOS &rarr;
            </a>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($recentSos as $sos)
                @php $badge = $sos->status_badge; @endphp
                <div class="p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-slate-50 transition">
                    <div class="flex items-start space-x-3.5">
                        <div class="w-10 h-10 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center text-lg flex-shrink-0 mt-0.5">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <span class="font-mono font-bold text-slate-900 text-sm">{{ $sos->ticket_id }}</span>
                                <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded {{ $badge['class'] }}">
                                    {{ $badge['label'] }}
                                </span>
                                <span class="text-xs text-slate-400">&bull; {{ $sos->created_at->diffForHumans() }}</span>
                            </div>
                            <h4 class="font-bold text-slate-900 text-xs sm:text-sm mt-1">
                                {{ $sos->emergency_label }} &mdash; <span class="text-slate-600 font-normal">{{ $sos->location_name }}</span>
                            </h4>
                            <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500 mt-1">
                                <span><i class="fa-solid fa-user text-slate-400 mr-1"></i> {{ $sos->reporter_name }}</span>
                                @if($sos->reporter_phone && $sos->reporter_phone !== '-')
                                <span><i class="fa-solid fa-phone text-slate-400 mr-1"></i> <a href="tel:{{ $sos->reporter_phone }}" class="text-blue-600 font-semibold hover:underline">{{ $sos->reporter_phone }}</a></span>
                                @endif
                                <span><i class="fa-solid fa-truck-fast text-slate-400 mr-1"></i> Responden: <strong class="text-slate-800">{{ $sos->responder_unit }}</strong></span>
                            </div>
                        </div>
                    </div>

                    <!-- Dispatch Status Form -->
                    <form action="{{ route('admin.sos.update', $sos->id) }}" method="POST" class="flex items-center space-x-2 flex-shrink-0 self-end md:self-center">
                        @csrf
                        <select name="status" class="text-xs px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-amber-500 bg-white font-semibold">
                            <option value="PENDING" {{ $sos->status === 'PENDING' ? 'selected' : '' }}>Pending</option>
                            <option value="DISPATCHED" {{ $sos->status === 'DISPATCHED' ? 'selected' : '' }}>Petugas Meluncur</option>
                            <option value="IN_PROGRESS" {{ $sos->status === 'IN_PROGRESS' ? 'selected' : '' }}>Dalam Penanganan</option>
                            <option value="RESOLVED" {{ $sos->status === 'RESOLVED' ? 'selected' : '' }}>Selesai</option>
                            <option value="CANCELLED" {{ $sos->status === 'CANCELLED' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        <button type="submit" class="px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-lg transition">
                            Update
                        </button>
                    </form>
                </div>
            @empty
                <div class="p-8 text-center text-slate-400 text-xs">
                    Tidak ada sinyal darurat SOS aktif saat ini. Kondisi aman dan kondusif.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Incident Reports Management Table -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="font-black text-slate-900 text-base font-serif">Laporan Insiden Masuk Terbaru</h3>
                <p class="text-xs text-slate-500">Pembaruan investigasi laporan wisatawan oleh Polisi Pariwisata & Satgas Adat.</p>
            </div>
            <a href="{{ route('admin.incidents.index') }}" class="text-xs font-bold text-blue-600 hover:underline">
                Kelola Semua Laporan &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase font-bold tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-5 py-3">Kode Tracking</th>
                        <th class="px-5 py-3">Pelapor</th>
                        <th class="px-5 py-3">Kategori</th>
                        <th class="px-5 py-3">Wilayah</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Prioritas</th>
                        <th class="px-5 py-3">Aksi Petugas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentIncidents as $inc)
                        @php $meta = $inc->status_meta; @endphp
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-5 py-3.5 font-mono font-bold text-slate-900">
                                <a href="{{ route('report.track', ['code' => $inc->tracking_code]) }}" target="_blank" class="hover:text-amber-600 underline">
                                    {{ $inc->tracking_code }}
                                </a>
                            </td>
                            <td class="px-5 py-3.5">
                                <p class="font-bold text-slate-900">{{ $inc->reporter_name }}</p>
                                <p class="text-[11px] text-slate-400">{{ $inc->reporter_nationality }} &bull; {{ $inc->reporter_phone }}</p>
                            </td>
                            <td class="px-5 py-3.5 font-semibold text-slate-800">
                                {{ $inc->category_label }}
                            </td>
                            <td class="px-5 py-3.5 text-slate-600">
                                <span class="font-bold text-slate-800">{{ $inc->regency }}</span>
                                <p class="text-[11px] truncate max-w-[180px] text-slate-400">{{ $inc->incident_location }}</p>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold border {{ $meta['color'] }}">
                                    {{ $meta['label'] }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold {{ $inc->priority === 'HIGH' || $inc->priority === 'CRITICAL' ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-700' }}">
                                    {{ $inc->priority }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <a href="{{ route('admin.incidents.index', ['search' => $inc->tracking_code]) }}" class="px-2.5 py-1 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-lg text-xs shadow-sm transition">
                                    Tindak Lanjut
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-8 text-center text-slate-400">
                                Belum ada laporan insiden yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
