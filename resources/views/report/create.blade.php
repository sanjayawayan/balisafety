@extends('layouts.app')

@section('title', 'Lapor Insiden Wisatawan - BaliGuard')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-xs text-slate-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-amber-600">Beranda</a>
        <span>&bull;</span>
        <span class="text-slate-800 font-semibold">Lapor Insiden</span>
    </nav>

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white rounded-3xl p-6 sm:p-8 border border-slate-800 shadow-xl mb-8">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-amber-400 text-2xl">
                <i class="fa-solid fa-file-shield"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-amber-400 uppercase tracking-widest">Layanan Pengaduan Resmi</span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white font-serif">Formulir Laporan Insiden Wisatawan</h1>
                <p class="text-xs sm:text-sm text-slate-300 mt-1">
                    Kirim laporan kejadian pencurian, penipuan, kecelakaan, kehilangan dokumen, atau insiden keamanan lainnya. Anda akan mendapatkan kode pelacakan resmi.
                </p>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="p-4 mb-6 rounded-2xl bg-rose-50 border border-rose-300 text-rose-800 text-xs sm:text-sm">
        <strong class="font-bold flex items-center mb-1"><i class="fa-solid fa-triangle-exclamation mr-1.5"></i> Mohon lengkapi data berikut:</strong>
        <ul class="list-disc pl-5 space-y-0.5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Form Container -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl p-6 sm:p-10">
        <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Section 1: Reporter Info -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2 pb-2 border-b border-slate-200">
                    <span class="w-6 h-6 rounded-full bg-amber-500 text-slate-950 font-bold text-xs flex items-center justify-center">1</span>
                    <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wide">Data Identitas Pelapor</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nama Lengkap Sesuai ID <span class="text-red-600">*</span></label>
                        <input type="text" name="reporter_name" value="{{ old('reporter_name') }}" placeholder="Cth: John Doe / Made Aryawan" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" required>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nomor WhatsApp / HP Aktif <span class="text-red-600">*</span></label>
                        <input type="tel" name="reporter_phone" value="{{ old('reporter_phone') }}" placeholder="Cth: +62 812 3456 7890" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" required>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Alamat Email (Opsional)</label>
                        <input type="email" name="reporter_email" value="{{ old('reporter_email') }}" placeholder="email@anda.com" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Kewarganegaraan / Asal <span class="text-red-600">*</span></label>
                        <input type="text" name="reporter_nationality" value="{{ old('reporter_nationality', 'Indonesia') }}" placeholder="Cth: Indonesia, Australia, Jerman, dll." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" required>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block font-bold text-slate-700 mb-1">Nomor Paspor / KTP / KITAS (Opsional)</label>
                        <input type="text" name="passport_or_id" value="{{ old('passport_or_id') }}" placeholder="Nomor dokumen identitas" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Section 2: Incident Details -->
            <div class="space-y-4 pt-4">
                <div class="flex items-center space-x-2 pb-2 border-b border-slate-200">
                    <span class="w-6 h-6 rounded-full bg-amber-500 text-slate-950 font-bold text-xs flex items-center justify-center">2</span>
                    <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wide">Rincian Kejadian / Insiden</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Kategori Kejadian <span class="text-red-600">*</span></label>
                        <select name="category" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $key => $lbl)
                                <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Kabupaten / Wilayah di Bali <span class="text-red-600">*</span></label>
                        <select name="regency" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" required>
                            <option value="">-- Pilih Wilayah --</option>
                            @foreach($regencies as $rKey => $rLabel)
                                <option value="{{ $rKey }}" {{ old('regency') == $rKey ? 'selected' : '' }}>{{ $rLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Waktu Kejadian <span class="text-red-600">*</span></label>
                        <input type="datetime-local" name="incident_date" value="{{ old('incident_date', date('Y-m-d\TH:i')) }}" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" required>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block font-bold text-slate-700">Lokasi Spesifik / Patokan <span class="text-red-600">*</span></label>
                            <button type="button" onclick="detectIncidentLocation()" id="btnGps" class="text-[11px] font-bold text-amber-600 hover:text-amber-700 flex items-center">
                                <i class="fa-solid fa-location-crosshairs mr-1"></i> <span id="gpsText">Deteksi GPS</span>
                            </button>
                        </div>
                        <input type="text" name="incident_location" id="incident_location" value="{{ old('incident_location') }}" placeholder="Cth: Depan Cafe Luwak, Jl. Pantai Batu Bolong, Canggu" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" required>
                        <input type="hidden" name="latitude" id="incident_lat" value="{{ old('latitude') }}">
                        <input type="hidden" name="longitude" id="incident_lng" value="{{ old('longitude') }}">
                        <p id="gpsStatus" class="text-[10px] text-slate-400 mt-1 hidden"></p>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block font-bold text-slate-700 mb-1">Deskripsi Lengkap Kronologi Kejadian <span class="text-red-600">*</span></label>
                        <textarea name="description" rows="4" placeholder="Ceritakan kronologi kejadian secara runtut, ciri-ciri pelaku/barang hilang, atau rincian pertolongan yang dibutuhkan..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" required>{{ old('description') }}</textarea>
                        <p class="text-[11px] text-slate-500 mt-1">Minimal 20 karakter agar petugas dapat memahami duduk perkara dengan jelas.</p>
                    </div>

                </div>
            </div>

            <!-- Submit Button & Disclaimer -->
            <div class="pt-6 border-t border-slate-200 space-y-4">
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-600 flex items-start space-x-2.5">
                    <input type="checkbox" id="consent" required class="accent-amber-600 mt-0.5">
                    <label for="consent" class="cursor-pointer leading-relaxed">
                        Saya menyatakan bahwa keterangan yang saya berikan adalah benar dan dapat dipertanggungjawabkan sesuai hukum perlindungan pelapor kepolisian.
                    </label>
                </div>

                <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-extrabold text-base shadow-xl shadow-amber-500/25 active:scale-98 transition flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-paper-plane mr-1"></i>
                    <span>KIRIM LAPORAN KE PUSAT KENDALI</span>
                </button>
            </div>

        </form>
    </div>

</div>

<script>
    function detectIncidentLocation() {
        const statusEl = document.getElementById('gpsStatus');
        const textEl = document.getElementById('gpsText');
        const locInput = document.getElementById('incident_location');
        const latInput = document.getElementById('incident_lat');
        const lngInput = document.getElementById('incident_lng');

        if (!navigator.geolocation) {
            statusEl.innerText = 'Peramban tidak mendukung geolokasi GPS.';
            statusEl.classList.remove('hidden');
            return;
        }

        textEl.innerText = 'Mendeteksi...';
        statusEl.innerText = 'Menghubungkan satelit GPS...';
        statusEl.classList.remove('hidden');

        navigator.geolocation.getCurrentPosition(
            (pos) => {
                const lat = pos.coords.latitude.toFixed(6);
                const lng = pos.coords.longitude.toFixed(6);
                latInput.value = lat;
                lngInput.value = lng;
                textEl.innerText = 'GPS Terkunci ✓';
                statusEl.innerHTML = '<span class="text-emerald-600 font-semibold">Koordinat GPS (' + lat + ', ' + lng + ') berhasil dilampirkan.</span>';
                if (!locInput.value) {
                    locInput.value = 'Koordinat GPS: ' + lat + ', ' + lng;
                }
            },
            (err) => {
                textEl.innerText = 'Deteksi GPS';
                statusEl.innerHTML = '<span class="text-rose-600">Izin lokasi GPS ditolak atau tidak tersedia. Masukkan patokan manual.</span>';
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 60000 }
        );
    }
</script>
@endsection
