@extends('layouts.admin')

@section('title', 'Panggilan Darurat SOS Live - BaliGuard')

@section('content')
<div class="space-y-6">
    
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight font-serif">Pusat Panggilan Darurat SOS 24/7</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Daftar sinyal SOS real-time dari wisatawan dengan geolokasi dan koordinasi unit respon cepat.</p>
        </div>
        <div>
            <button onclick="window.location.reload()" class="px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold text-xs rounded-xl shadow-sm transition flex items-center">
                <i class="fa-solid fa-rotate-right mr-1.5 text-blue-600"></i> Refresh Sinyal
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm flex flex-wrap items-center justify-between gap-3 text-xs">
        <div class="flex flex-wrap items-center gap-2">
            <span class="font-bold text-slate-500">Filter Status:</span>
            <a href="{{ route('admin.sos.index') }}" class="px-3 py-1.5 rounded-lg {{ !request('status') ? 'bg-slate-900 text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Semua</a>
            <a href="{{ route('admin.sos.index', ['status' => 'PENDING']) }}" class="px-3 py-1.5 rounded-lg {{ request('status') === 'PENDING' ? 'bg-red-600 text-white font-bold' : 'bg-red-50 text-red-700 hover:bg-red-100' }}">Pending</a>
            <a href="{{ route('admin.sos.index', ['status' => 'DISPATCHED']) }}" class="px-3 py-1.5 rounded-lg {{ request('status') === 'DISPATCHED' ? 'bg-amber-500 text-white font-bold' : 'bg-amber-50 text-amber-800 hover:bg-amber-100' }}">Petugas Meluncur</a>
            <a href="{{ route('admin.sos.index', ['status' => 'RESOLVED']) }}" class="px-3 py-1.5 rounded-lg {{ request('status') === 'RESOLVED' ? 'bg-emerald-600 text-white font-bold' : 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100' }}">Selesai</a>
        </div>
    </div>

    <!-- SOS Cards Grid -->
    <div class="space-y-4">
        @forelse($alerts as $sos)
            @php $badge = $sos->status_badge; @endphp
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center text-lg font-bold flex-shrink-0">
                            <i class="fa-solid fa-tower-broadcast"></i>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <span class="font-mono font-black text-slate-900 text-base">{{ $sos->ticket_id }}</span>
                                <span class="text-[10px] font-black uppercase px-2.5 py-0.5 rounded {{ $badge['class'] }}">
                                    {{ $badge['label'] }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">
                                Terdeteksi pada {{ $sos->created_at->format('d M Y, H:i:s') }} WITA ({{ $sos->created_at->diffForHumans() }})
                            </p>
                        </div>
                    </div>

                    @if($sos->latitude && $sos->longitude)
                    <div class="flex items-center space-x-2">
                        <a href="https://maps.google.com/?q={{ $sos->latitude }},{{ $sos->longitude }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-blue-50 text-blue-700 hover:bg-blue-100 font-bold text-xs flex items-center border border-blue-200 transition">
                            <i class="fa-solid fa-map-location-dot mr-1.5 text-blue-600"></i> Buka Google Maps
                        </a>
                    </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4 text-xs">
                    
                    <!-- Col 1: Pelapor & Lokasi -->
                    <div class="space-y-2">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Informasi Wisatawan</span>
                        <p class="text-slate-900 font-bold text-sm">{{ $sos->reporter_name }}</p>
                        <p class="text-slate-600 flex items-center">
                            <i class="fa-solid fa-phone text-slate-400 mr-1.5"></i>
                            <a href="tel:{{ $sos->reporter_phone }}" class="text-blue-600 font-bold hover:underline">{{ $sos->reporter_phone }}</a>
                        </p>
                        <p class="text-slate-600 flex items-start">
                            <i class="fa-solid fa-location-dot text-red-500 mr-1.5 mt-0.5 flex-shrink-0"></i>
                            <span>{{ $sos->location_name }}</span>
                        </p>
                        @if($sos->latitude)
                        <p class="font-mono text-[11px] text-slate-400">
                            Lat: {{ $sos->latitude }}, Lng: {{ $sos->longitude }}
                        </p>
                        @endif
                    </div>

                    <!-- Col 2: Kategori & Catatan -->
                    <div class="space-y-2">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Kategori & Situasi</span>
                        <p class="font-bold text-red-600 text-sm">{{ $sos->emergency_label }}</p>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 leading-relaxed text-xs">
                            {{ $sos->notes ?: 'Tidak ada catatan tambahan dari pelapor.' }}
                        </div>
                    </div>

                    <!-- Col 3: Tindakan Dispatcher -->
                    <div class="bg-slate-50/70 p-4 rounded-2xl border border-slate-200 space-y-3">
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block">Tindakan Dispatcher</span>
                        
                        <form action="{{ route('admin.sos.update', $sos->id) }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 mb-1">Status Penanganan</label>
                                <select name="status" class="w-full text-xs px-3 py-1.5 border border-slate-300 rounded-lg bg-white font-semibold">
                                    <option value="PENDING" {{ $sos->status === 'PENDING' ? 'selected' : '' }}>PENDING (Belum Ditangani)</option>
                                    <option value="DISPATCHED" {{ $sos->status === 'DISPATCHED' ? 'selected' : '' }}>DISPATCHED (Petugas Meluncur)</option>
                                    <option value="IN_PROGRESS" {{ $sos->status === 'IN_PROGRESS' ? 'selected' : '' }}>IN_PROGRESS (Di Lokasi)</option>
                                    <option value="RESOLVED" {{ $sos->status === 'RESOLVED' ? 'selected' : '' }}>RESOLVED (Tuntas / Selesai)</option>
                                    <option value="CANCELLED" {{ $sos->status === 'CANCELLED' ? 'selected' : '' }}>CANCELLED (Panggilan Palsu/Batal)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 mb-1">Unit Respon Terjun</label>
                                <input type="text" name="responder_unit" value="{{ $sos->responder_unit }}" placeholder="Cth: Balawista Pos 4 / Polsek Kuta" class="w-full text-xs px-3 py-1.5 border border-slate-300 rounded-lg bg-white">
                            </div>

                            <button type="submit" class="w-full py-2 bg-slate-900 hover:bg-slate-800 text-amber-400 font-bold text-xs rounded-lg transition shadow-sm">
                                Simpan Pembaruan Sinyal
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl p-12 text-center text-slate-400 text-xs">
                Tidak ada riwayat panggilan darurat SOS yang sesuai filter.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pt-4">
        {{ $alerts->links() }}
    </div>

</div>
@endsection
