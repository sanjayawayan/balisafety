@extends('layouts.admin')

@section('title', 'Peringatan Dini & Early Warning - BaliGuard')

@section('content')
<div class="space-y-8">
    
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight font-serif">Peringatan Dini (Early Warning System)</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Siarkan informasi gelombang laut BMKG, cuaca ekstrem, dan peringatan keselamatan pariwisata.</p>
        </div>
    </div>

    <!-- Create Warning Form Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <h3 class="text-base font-extrabold text-slate-900 mb-4 flex items-center">
            <i class="fa-solid fa-bullhorn text-amber-500 mr-2"></i>
            <span>Publikasikan Peringatan Baru</span>
        </h3>

        <form action="{{ route('admin.warnings.store') }}" method="POST" class="space-y-4 text-xs sm:text-sm">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block font-bold text-slate-700 mb-1">Judul Peringatan <span class="text-red-600">*</span></label>
                    <input type="text" name="title" placeholder="Cth: Peringatan Gelombang Tinggi Pantai Kuta (2m - 3m)" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-amber-500" required>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Tingkat Bahaya (Severity) <span class="text-red-600">*</span></label>
                    <select name="severity" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-amber-500" required>
                        <option value="INFO">INFO (Imbauan Ringan)</option>
                        <option value="WARNING" selected>WARNING (Peringatan Waspada)</option>
                        <option value="DANGER">DANGER (Berbahaya)</option>
                        <option value="CRITICAL">CRITICAL (Kritis / Evakuasi)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Kategori <span class="text-red-600">*</span></label>
                    <select name="category" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-amber-500" required>
                        <option value="ocean_wave">Gelombang Laut & Rip Current</option>
                        <option value="weather">Cuaca Ekstrem / Hujan Badai BMKG</option>
                        <option value="volcanic">Gunung Api (Agung / Batur)</option>
                        <option value="traffic">Lalu Lintas / Kemacetan Berat</option>
                        <option value="security">Keamanan Umum</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Wilayah / Kabupaten <span class="text-red-600">*</span></label>
                    <input type="text" name="regency" placeholder="Cth: Kab. Badung / Semua Wilayah" value="Semua Wilayah" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-amber-500" required>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Berlaku Sampai (Opsional)</label>
                    <input type="datetime-local" name="valid_until" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-amber-500">
                </div>

                <div class="sm:col-span-3">
                    <label class="block font-bold text-slate-700 mb-1">Isi Peringatan & Petunjuk Keselamatan <span class="text-red-600">*</span></label>
                    <textarea name="content" rows="3" placeholder="Jelaskan kondisi bahaya dan petunjuk yang harus ditaati wisatawan..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-amber-500" required></textarea>
                </div>
            </div>

            <div class="pt-2 text-right">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-extrabold text-xs rounded-xl shadow-md transition">
                    Siarkan Peringatan ke Beranda
                </button>
            </div>
        </form>
    </div>

    <!-- Active Warnings List -->
    <div class="space-y-4">
        <h3 class="font-extrabold text-slate-900 text-base font-serif">Daftar Peringatan yang Pernah Diterbitkan</h3>

        <div class="space-y-3">
            @forelse($warnings as $w)
                @php $badge = $w->severity_badge; @endphp
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-start space-x-3.5">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 {{ $badge['badge'] }} text-sm mt-0.5">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded {{ $badge['badge'] }}">
                                    {{ $w->severity }} &bull; {{ $w->regency }}
                                </span>
                                <span class="text-xs text-slate-400">&bull; {{ $w->created_at->format('d M Y, H:i') }}</span>
                                @if(!$w->is_active)
                                    <span class="text-[10px] font-bold bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded">TIDAK AKTIF</span>
                                @else
                                    <span class="text-[10px] font-bold bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded">TAYANG LIVE</span>
                                @endif
                            </div>
                            <h4 class="font-bold text-slate-900 text-sm mt-1">{{ $w->title }}</h4>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $w->content }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 self-end md:self-center flex-shrink-0">
                        <form action="{{ route('admin.warnings.toggle', $w->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 rounded-lg border text-xs font-bold transition {{ $w->is_active ? 'border-amber-300 bg-amber-50 text-amber-800 hover:bg-amber-100' : 'border-emerald-300 bg-emerald-50 text-emerald-800 hover:bg-emerald-100' }}">
                                {{ $w->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.warnings.destroy', $w->id) }}" method="POST" onsubmit="return confirm('Hapus peringatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition text-xs font-bold" title="Hapus Peringatan">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl p-8 text-center text-slate-400 text-xs">
                    Belum ada peringatan dini yang diterbitkan.
                </div>
            @endforelse
        </div>

        <div class="pt-4">
            {{ $warnings->links() }}
        </div>
    </div>

</div>
@endsection
