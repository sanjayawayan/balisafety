<!-- Emergency SOS Modal -->
<div id="sosModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/80 backdrop-blur-sm transition-opacity">
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 w-full max-w-lg border-2 border-red-500">
            
            <!-- Modal Header (Red Emergency Pulse) -->
            <div class="bg-gradient-to-r from-red-600 to-rose-600 px-6 py-4 text-white flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center animate-pulse">
                        <i class="fa-solid fa-triangle-exclamation text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold tracking-wide uppercase">Panggilan Darurat SOS</h3>
                        <p class="text-xs text-red-100">Pusat Tanggap Darurat & Komando BaliGuard</p>
                    </div>
                </div>
                <button type="button" onclick="closeSosModal()" class="text-white/80 hover:text-white text-2xl font-bold">&times;</button>
            </div>

            <!-- Modal Body (Form view) -->
            <div id="sosFormContainer" class="p-6 space-y-5">
                
                <!-- Notice Alert -->
                <div class="p-3.5 rounded-xl bg-amber-50 border border-amber-300 text-amber-900 text-xs flex items-start space-x-2.5">
                    <i class="fa-solid fa-circle-info text-amber-600 text-base mt-0.5"></i>
                    <p class="leading-relaxed">
                        Gunakan tombol ini saat menghadapi <strong>situasi darurat nyata</strong>. Koordinat lokasi GPS Anda akan otomatis dikirimkan ke petugas terdekat (Kepolisian, Balawista, BPBD, atau Medis).
                    </p>
                </div>

                <!-- Emergency Category Select -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Pilih Jenis Keadaan Darurat <span class="text-red-600">*</span></label>
                    <div class="grid grid-cols-2 gap-2.5 text-xs font-semibold">
                        <label class="cursor-pointer border-2 border-slate-200 rounded-xl p-3 flex items-center space-x-2.5 hover:border-red-500 transition has-[:checked]:border-red-600 has-[:checked]:bg-red-50">
                            <input type="radio" name="sos_emergency_type" value="medical" class="accent-red-600" checked>
                            <span class="flex items-center text-slate-800"><i class="fa-solid fa-truck-medical text-red-600 text-base mr-2"></i> Medis / Ambulans</span>
                        </label>
                        <label class="cursor-pointer border-2 border-slate-200 rounded-xl p-3 flex items-center space-x-2.5 hover:border-red-500 transition has-[:checked]:border-red-600 has-[:checked]:bg-red-50">
                            <input type="radio" name="sos_emergency_type" value="police" class="accent-red-600">
                            <span class="flex items-center text-slate-800"><i class="fa-solid fa-shield-halved text-blue-600 text-base mr-2"></i> Kejahatan / Polisi</span>
                        </label>
                        <label class="cursor-pointer border-2 border-slate-200 rounded-xl p-3 flex items-center space-x-2.5 hover:border-red-500 transition has-[:checked]:border-red-600 has-[:checked]:bg-red-50">
                            <input type="radio" name="sos_emergency_type" value="rescue" class="accent-red-600">
                            <span class="flex items-center text-slate-800"><i class="fa-solid fa-life-ring text-amber-600 text-base mr-2"></i> Arus Laut / SAR</span>
                        </label>
                        <label class="cursor-pointer border-2 border-slate-200 rounded-xl p-3 flex items-center space-x-2.5 hover:border-red-500 transition has-[:checked]:border-red-600 has-[:checked]:bg-red-50">
                            <input type="radio" name="sos_emergency_type" value="disaster" class="accent-red-600">
                            <span class="flex items-center text-slate-800"><i class="fa-solid fa-volcano text-orange-600 text-base mr-2"></i> Bencana / Cuaca</span>
                        </label>
                        <label class="cursor-pointer border-2 border-slate-200 rounded-xl p-3 flex items-center space-x-2.5 hover:border-red-500 transition has-[:checked]:border-red-600 has-[:checked]:bg-red-50">
                            <input type="radio" name="sos_emergency_type" value="harassment" class="accent-red-600">
                            <span class="flex items-center text-slate-800"><i class="fa-solid fa-hand text-purple-600 text-base mr-2"></i> Pelecehan</span>
                        </label>
                        <label class="cursor-pointer border-2 border-slate-200 rounded-xl p-3 flex items-center space-x-2.5 hover:border-red-500 transition has-[:checked]:border-red-600 has-[:checked]:bg-red-50">
                            <input type="radio" name="sos_emergency_type" value="other" class="accent-red-600">
                            <span class="flex items-center text-slate-800"><i class="fa-solid fa-circle-question text-slate-600 text-base mr-2"></i> Bantuan Lainnya</span>
                        </label>
                    </div>
                </div>

                <!-- GPS Location Detector -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3.5 space-y-2">
                    <div class="flex items-center justify-between text-xs font-bold text-slate-700">
                        <span class="flex items-center"><i class="fa-solid fa-location-crosshairs text-red-600 mr-1.5"></i> Lokasi GPS Saat Ini</span>
                        <button type="button" onclick="detectSosLocation()" class="text-blue-600 hover:text-blue-800 text-[11px] underline">
                            <i class="fa-solid fa-rotate-right mr-1"></i> Perbarui GPS
                        </button>
                    </div>
                    <div id="sosGpsStatus" class="text-xs text-slate-600 flex items-center">
                        <span class="inline-block w-2.5 h-2.5 bg-amber-500 rounded-full mr-2 animate-ping"></span>
                        <span>Mendeteksi koordinat satelit GPS Anda...</span>
                    </div>
                    <input type="hidden" id="sosLatitude" name="sos_latitude">
                    <input type="hidden" id="sosLongitude" name="sos_longitude">
                    <input type="text" id="sosLocationName" placeholder="Patokan lokasi (cth: Pantai Kuta depan Hotel Grand Inna)" class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- Reporter Identity (Optional but recommended) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nama Pelapor (Opsional)</label>
                        <input type="text" id="sosReporterName" placeholder="Nama Anda" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nomor WhatsApp / HP Aktif</label>
                        <input type="tel" id="sosReporterPhone" placeholder="08xxxxxxxxxx / +62..." class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none">
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="text-xs">
                    <label class="block font-semibold text-slate-700 mb-1">Keterangan Tambahan / Korban</label>
                    <textarea id="sosNotes" rows="2" placeholder="Tuliskan kondisi korban atau situasi singkat..." class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none"></textarea>
                </div>

                <!-- Trigger Button -->
                <button type="button" id="btnSubmitSos" onclick="sendSosSignal()" class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-extrabold text-base shadow-xl shadow-red-600/40 hover:shadow-red-600/60 active:scale-98 transition flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-satellite-dish text-xl animate-pulse"></i>
                    <span>KIRIM SINYAL SOS SEKARANG!</span>
                </button>
            </div>

            <!-- Modal Result View (Shown after trigger) -->
            <div id="sosResultContainer" class="p-6 space-y-5 hidden text-center">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto text-3xl shadow-inner animate-bounce">
                    <i class="fa-solid fa-tower-broadcast"></i>
                </div>

                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-red-600 text-white uppercase tracking-wider mb-2 animate-pulse">
                        Sinyal Darurat Terkirim
                    </span>
                    <h4 class="text-xl font-extrabold text-slate-900" id="resTicketId">SOS-2026-XXXX</h4>
                    <p class="text-xs text-slate-500 mt-1" id="resTimestamp"></p>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-left text-xs space-y-2">
                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                        <span class="text-slate-500">Unit Tanggap Darurat:</span>
                        <span class="font-bold text-red-600 text-right" id="resResponder">Pusat Komando BaliGuard</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                        <span class="text-slate-500">Status Penanganan:</span>
                        <span class="font-bold text-amber-600" id="resStatus">SEDANG DIARAHKAN</span>
                    </div>
                    <p class="text-slate-600 pt-1 leading-relaxed" id="resMessage">
                        Petugas telah menerima koordinat Anda. Tetap berada di tempat yang aman dan pastikan ponsel Anda dapat dihubungi.
                    </p>
                </div>

                <!-- Direct Hotlines Call Grid -->
                <div class="space-y-2 pt-2">
                    <p class="text-xs font-bold text-slate-700 uppercase tracking-wider">Atau Panggil Hotline Darurat Langsung:</p>
                    <div class="grid grid-cols-2 gap-2 text-xs font-bold">
                        <a href="tel:112" class="p-2.5 rounded-lg bg-red-600 text-white hover:bg-red-700 flex items-center justify-center space-x-1.5 shadow">
                            <i class="fa-solid fa-phone"></i>
                            <span>112 (Bebas Pulsa)</span>
                        </a>
                        <a href="tel:110" class="p-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 flex items-center justify-center space-x-1.5 shadow">
                            <i class="fa-solid fa-phone"></i>
                            <span>110 (Polisi)</span>
                        </a>
                        <a href="tel:118" class="p-2.5 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 flex items-center justify-center space-x-1.5 shadow">
                            <i class="fa-solid fa-phone"></i>
                            <span>118 / 119 (Medis)</span>
                        </a>
                        <a href="tel:115" class="p-2.5 rounded-lg bg-amber-600 text-white hover:bg-amber-700 flex items-center justify-center space-x-1.5 shadow">
                            <i class="fa-solid fa-phone"></i>
                            <span>115 (SAR Laut)</span>
                        </a>
                    </div>
                </div>

                <div class="pt-3">
                    <button type="button" onclick="closeSosModal()" class="w-full py-2.5 px-4 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-semibold text-xs">
                        Tutup Jendela SOS
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    let activeSosTicket = null;

    function openSosModal() {
        document.getElementById('sosModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        detectSosLocation();
        playEmergencyChime();
    }

    function closeSosModal() {
        document.getElementById('sosModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Play subtle audio alert via Web Audio API (cross-platform, zero dependencies)
    function playEmergencyChime() {
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(880, ctx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(440, ctx.currentTime + 0.3);
            gain.gain.setValueAtTime(0.15, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.3);
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.start();
            osc.stop(ctx.currentTime + 0.3);
        } catch(e) {}
    }

    // Geolocation detection
    function detectSosLocation() {
        const gpsStatus = document.getElementById('sosGpsStatus');
        const latInput = document.getElementById('sosLatitude');
        const lngInput = document.getElementById('sosLongitude');
        const locInput = document.getElementById('sosLocationName');

        if (!navigator.geolocation) {
            gpsStatus.innerHTML = '<span class="text-amber-600 font-semibold">Browser Anda tidak mendukung geolokasi otomatis. Harap isi patokan lokasi manual.</span>';
            return;
        }

        gpsStatus.innerHTML = '<span class="inline-block w-2.5 h-2.5 bg-amber-500 rounded-full mr-2 animate-ping"></span><span>Mencari koordinat satelit GPS...</span>';

        navigator.geolocation.getCurrentPosition(
            (pos) => {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;
                latInput.value = lat;
                lngInput.value = lng;
                gpsStatus.innerHTML = `<span class="inline-block w-2.5 h-2.5 bg-emerald-500 rounded-full mr-2"></span><span class="text-emerald-700 font-bold">GPS Terkunci: ${lat.toFixed(5)}, ${lng.toFixed(5)}</span>`;
                
                if (!locInput.value) {
                    locInput.value = `Koordinat (${lat.toFixed(4)}, ${lng.toFixed(4)})`;
                }
            },
            (err) => {
                // Fallback default coordinates (Bali Denpasar/Kuta)
                latInput.value = -8.7185;
                lngInput.value = 115.1686;
                gpsStatus.innerHTML = '<span class="text-slate-500">Izin GPS dinonaktifkan. Menggunakan koordinat area umum Bali. Anda dapat melengkapi patokan lokasi.</span>';
            },
            { enableHighAccuracy: true, timeout: 8000, maximumAge: 0 }
        );
    }

    // Send SOS Signal via API
    function sendSosSignal() {
        const btn = document.getElementById('btnSubmitSos');
        const emergencyType = document.querySelector('input[name="sos_emergency_type"]:checked').value;
        const lat = document.getElementById('sosLatitude').value;
        const lng = document.getElementById('sosLongitude').value;
        const locName = document.getElementById('sosLocationName').value;
        const reporterName = document.getElementById('sosReporterName').value;
        const reporterPhone = document.getElementById('sosReporterPhone').value;
        const notes = document.getElementById('sosNotes').value;

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Mengirimkan Sinyal SOS...';

        fetch("{{ route('api.sos.trigger') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                emergency_type: emergencyType,
                latitude: lat,
                longitude: lng,
                location_name: locName,
                reporter_name: reporterName,
                reporter_phone: reporterPhone,
                notes: notes
            })
        })
        .then(res => res.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-satellite-dish text-xl animate-pulse"></i> <span>KIRIM SINYAL SOS SEKARANG!</span>';

            if (data.success) {
                activeSosTicket = data.ticket_id;
                document.getElementById('sosFormContainer').classList.add('hidden');
                document.getElementById('sosResultContainer').classList.remove('hidden');

                document.getElementById('resTicketId').innerText = data.ticket_id;
                document.getElementById('resTimestamp').innerText = data.created_at;
                document.getElementById('resResponder').innerText = data.responder_unit;
                document.getElementById('resStatus').innerText = data.status === 'PENDING' ? 'DARURAT DITERIMA' : data.status;
                document.getElementById('resMessage').innerText = data.message;
            } else {
                alert('Gagal mengirimkan sinyal SOS. Silakan panggil nomor darurat 112 secara langsung!');
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-satellite-dish text-xl animate-pulse"></i> <span>KIRIM SINYAL SOS SEKARANG!</span>';
            alert('Koneksi bermasalah. Harap segera hubungi 112 atau 110 melalui telepon biasa!');
        });
    }
</script>
