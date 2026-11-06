@extends('layouts.app')

@section('title', 'Peta Interaktif Keamanan, Faskes & Pos Darurat Bali (Google Maps Ref) - BaliGuard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-xs text-slate-500 mb-4">
        <a href="{{ route('home') }}" class="hover:text-amber-600">Beranda</a>
        <span>&bull;</span>
        <span class="text-slate-800 font-semibold">Peta Keamanan Wisatawan</span>
    </nav>

    <!-- Header & Search/Filter Controls -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm mb-6 space-y-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase bg-blue-100 text-blue-800 border border-blue-200">
                        <i class="fa-solid fa-map-location mr-1"></i> Terverifikasi Google Maps
                    </span>
                    <span class="text-xs text-slate-400">&bull; {{ count($locations) }} Titik Penting Bali</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 font-serif mt-1">Peta Faskes, Pos Keamanan & Zona Waspada</h1>
                <p class="text-xs sm:text-sm text-slate-600 mt-0.5">Pemetaan presisi kantor polisi pariwisata, RS rujukan (VAR rabies & UGD), pos penjaga pantai Balawista, dan imigrasi.</p>
            </div>

            <!-- Emergency Trigger -->
            <div class="flex-shrink-0">
                <button onclick="openSosModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-extrabold text-xs shadow-md transition flex items-center space-x-2">
                    <i class="fa-solid fa-bell-exclamation animate-bounce"></i>
                    <span>TOMBOL SOS DARURAT</span>
                </button>
            </div>
        </div>

        <!-- Filter Controls Row -->
        <div class="pt-3 border-t border-slate-100 grid grid-cols-1 md:grid-cols-12 gap-3 text-xs">
            
            <!-- Live Search Bar (5 cols) -->
            <div class="md:col-span-5 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input 
                    type="text" 
                    id="mapSearchInput" 
                    placeholder="Cari RS, Polsek, Canggu, Ubud, Rabies, atau nama jalan..." 
                    class="w-full pl-9 pr-8 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500 font-medium"
                    oninput="filterAllMapData()"
                >
                <button type="button" onclick="clearMapSearch()" id="btnClearSearch" class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 font-bold">&times;</button>
            </div>

            <!-- Regency Dropdown (3 cols) -->
            <div class="md:col-span-3">
                <select id="regencySelect" onchange="filterAllMapData()" class="w-full px-3 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500 font-bold text-slate-700">
                    <option value="all">📍 Semua Kabupaten / Kota</option>
                    <option value="Badung">Kab. Badung (Kuta, Seminyak, Canggu, Uluwatu)</option>
                    <option value="Denpasar">Kota Denpasar (Sanur, Renon)</option>
                    <option value="Gianyar">Kab. Gianyar (Ubud, Sukawati)</option>
                    <option value="Klungkung">Kab. Klungkung (Nusa Penida)</option>
                    <option value="Tabanan">Kab. Tabanan (Bedugul, Tanah Lot)</option>
                    <option value="Karangasem">Kab. Karangasem (Amed, Padangbai)</option>
                    <option value="Buleleng">Kab. Buleleng (Lovina, Singaraja)</option>
                    <option value="Bangli">Kab. Bangli (Kintamani, Batur)</option>
                    <option value="Jembrana">Kab. Jembrana (Gilimanuk, Medewi)</option>
                </select>
            </div>

            <!-- Category Pills (4 cols) -->
            <div class="md:col-span-4 flex items-center space-x-1.5 overflow-x-auto pb-1 md:pb-0 scrollbar-none font-bold">
                <button type="button" onclick="setCategoryFilter('all')" class="cat-pill px-3 py-2 rounded-xl bg-slate-900 text-white shadow-sm transition whitespace-nowrap">Semua</button>
                <button type="button" onclick="setCategoryFilter('police')" class="cat-pill px-3 py-2 rounded-xl bg-slate-100 text-blue-700 hover:bg-blue-50 transition whitespace-nowrap"><i class="fa-solid fa-shield mr-1"></i>Polisi</button>
                <button type="button" onclick="setCategoryFilter('hospital')" class="cat-pill px-3 py-2 rounded-xl bg-slate-100 text-red-700 hover:bg-red-50 transition whitespace-nowrap"><i class="fa-solid fa-truck-medical mr-1"></i>RS/UGD</button>
                <button type="button" onclick="setCategoryFilter('rescue')" class="cat-pill px-3 py-2 rounded-xl bg-slate-100 text-amber-700 hover:bg-amber-50 transition whitespace-nowrap"><i class="fa-solid fa-life-ring mr-1"></i>Balawista</button>
                <button type="button" onclick="setCategoryFilter('hazard')" class="cat-pill px-3 py-2 rounded-xl bg-slate-100 text-rose-700 hover:bg-rose-50 transition whitespace-nowrap"><i class="fa-solid fa-triangle-exclamation mr-1"></i>Waspada</button>
            </div>

        </div>
    </div>

    <!-- Map & Sidebar Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Interactive Map Container (2 cols on large screen) -->
        <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden relative">
            <div id="fullMap" class="h-[520px] sm:h-[620px] w-full z-10 bg-slate-100"></div>
            
            <!-- Floating Map Overlay Buttons -->
            <div class="absolute bottom-5 right-5 z-20 flex items-center space-x-2">
                <button onclick="locateUserOnMap()" class="px-3.5 py-2.5 bg-white text-slate-900 font-bold text-xs rounded-xl shadow-xl border border-slate-300 hover:bg-slate-50 flex items-center space-x-1.5 transition">
                    <i class="fa-solid fa-crosshairs text-red-600 text-sm"></i>
                    <span>Lokasi Saya (GPS)</span>
                </button>
                <button onclick="resetMapView()" class="px-3 py-2.5 bg-white text-slate-700 font-bold text-xs rounded-xl shadow-xl border border-slate-300 hover:bg-slate-50 transition" title="Lihat Seluruh Bali">
                    <i class="fa-solid fa-expand"></i>
                </button>
            </div>
        </div>

        <!-- Directory List Sidebar (1 col) -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl p-5 flex flex-col h-[520px] sm:h-[620px]">
            <div class="pb-3 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="font-black text-sm text-slate-900 uppercase tracking-wide">Daftar Titik Terpilih</h3>
                    <p class="text-[11px] text-slate-400">Klik titik untuk mengarahkan kamera peta</p>
                </div>
                <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded-lg border border-amber-200" id="markerCount">
                    {{ count($locations) }} Titik
                </span>
            </div>

            <!-- Scrollable Locations List -->
            <div class="flex-1 overflow-y-auto space-y-3 py-3 pr-1 text-xs" id="locationsList">
                <!-- Dynamically generated location cards -->
            </div>

            <!-- Direct Google Maps Hotline Tip -->
            <div class="pt-3 border-t border-slate-100 text-[11px] text-slate-500 flex items-center justify-between">
                <span class="flex items-center text-slate-600">
                    <i class="fa-brands fa-google text-blue-600 mr-1.5"></i> Koordinat Google Maps Presisi
                </span>
                <a href="tel:112" class="font-bold text-red-600 hover:underline">112 Hotline</a>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    const allLocations = @json($locations);
    let mapInstance;
    let markersLayer = [];
    let userMarker = null;
    let activeCategory = 'all';

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Leaflet Map centered on Bali
        mapInstance = L.map('fullMap', {
            zoomControl: true,
            scrollWheelZoom: true
        }).setView([-8.4500, 115.1889], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors &bull; Ref Google Maps'
        }).addTo(mapInstance);

        // Initial render
        filterAllMapData();
    });

    function setCategoryFilter(cat) {
        activeCategory = cat;
        document.querySelectorAll('.cat-pill').forEach(btn => {
            btn.classList.remove('bg-slate-900', 'text-white');
            btn.classList.add('bg-slate-100');
        });
        event.currentTarget.classList.remove('bg-slate-100');
        event.currentTarget.classList.add('bg-slate-900', 'text-white');

        filterAllMapData();
    }

    function clearMapSearch() {
        document.getElementById('mapSearchInput').value = '';
        document.getElementById('btnClearSearch').classList.add('hidden');
        filterAllMapData();
    }

    function filterAllMapData() {
        const query = document.getElementById('mapSearchInput').value.toLowerCase().trim();
        const regency = document.getElementById('regencySelect').value;
        const btnClear = document.getElementById('btnClearSearch');

        if (query.length > 0) {
            btnClear.classList.remove('hidden');
        } else {
            btnClear.classList.add('hidden');
        }

        const filtered = allLocations.filter(item => {
            // Category check
            const matchCat = (activeCategory === 'all') || (item.cat === activeCategory);
            // Regency check
            const matchRegency = (regency === 'all') || (item.regency.toLowerCase() === regency.toLowerCase());
            // Search query check
            const matchSearch = !query || 
                item.name.toLowerCase().includes(query) ||
                item.address.toLowerCase().includes(query) ||
                item.note.toLowerCase().includes(query) ||
                item.regency.toLowerCase().includes(query);

            return matchCat && matchRegency && matchSearch;
        });

        renderMarkers(filtered);
        renderSidebarList(filtered);
    }

    function renderMarkers(items) {
        // Clear previous markers
        markersLayer.forEach(m => mapInstance.removeLayer(m));
        markersLayer = [];

        items.forEach(pt => {
            let color = '#0284c7'; // default police blue
            let iconText = 'P';
            if (pt.cat === 'hospital') { color = '#dc2626'; iconText = '+'; }
            if (pt.cat === 'rescue') { color = '#d97706'; iconText = 'S'; }
            if (pt.cat === 'hazard') { color = '#e11d48'; iconText = '!'; }
            if (pt.cat === 'embassy') { color = '#4f46e5'; iconText = 'I'; }

            const marker = L.circleMarker([pt.lat, pt.lng], {
                radius: pt.cat === 'hazard' ? 10 : 8,
                fillColor: color,
                color: '#ffffff',
                weight: 2,
                opacity: 1,
                fillOpacity: 0.9
            }).addTo(mapInstance);

            const popupHtml = `
                <div class="text-xs space-y-1.5 p-1 max-w-[240px]">
                    <div class="flex items-center justify-between">
                        <span class="text-[9px] font-black uppercase px-1.5 py-0.5 rounded bg-slate-100 text-slate-800">${pt.regency}</span>
                        <span class="text-[9px] font-bold text-slate-400 uppercase">${pt.cat}</span>
                    </div>
                    <strong class="text-sm font-extrabold text-slate-900 block leading-snug">${pt.name}</strong>
                    <p class="text-[11px] text-slate-600 leading-snug">${pt.address}</p>
                    <p class="text-[11px] text-slate-500 italic">${pt.note}</p>
                    <div class="pt-2 border-t border-slate-200 flex items-center justify-between">
                        <a href="tel:${pt.phone}" class="font-bold text-red-600 hover:underline flex items-center">
                            <i class="fa-solid fa-phone mr-1"></i>${pt.phone}
                        </a>
                        <a href="${pt.maps_url}" target="_blank" class="px-2 py-1 rounded bg-blue-50 text-blue-700 font-bold text-[10px] hover:bg-blue-100 border border-blue-200 flex items-center">
                            <i class="fa-solid fa-diamond-turn-right mr-1"></i>Google Maps
                        </a>
                    </div>
                </div>
            `;
            marker.bindPopup(popupHtml);
            markersLayer.push(marker);
        });

        // Auto zoom if results exist
        if (items.length > 0 && items.length < allLocations.length) {
            const group = new L.featureGroup(markersLayer);
            mapInstance.fitBounds(group.getBounds().pad(0.15));
        }
    }

    function renderSidebarList(items) {
        const list = document.getElementById('locationsList');
        list.innerHTML = '';
        document.getElementById('markerCount').innerText = `${items.length} Titik`;

        if (items.length === 0) {
            list.innerHTML = `
                <div class="p-8 text-center text-slate-400 text-xs">
                    <i class="fa-solid fa-location-dot text-2xl mb-2 text-slate-300"></i>
                    <p>Tidak ada lokasi yang cocok dengan filter atau kata kunci Anda.</p>
                </div>
            `;
            return;
        }

        items.forEach(item => {
            let icon = 'fa-shield';
            let iconColor = 'text-blue-600 bg-blue-50 border-blue-200';
            if (item.cat === 'hospital') { icon = 'fa-truck-medical'; iconColor = 'text-red-600 bg-red-50 border-red-200'; }
            if (item.cat === 'rescue') { icon = 'fa-life-ring'; iconColor = 'text-amber-600 bg-amber-50 border-amber-200'; }
            if (item.cat === 'hazard') { icon = 'fa-triangle-exclamation'; iconColor = 'text-rose-600 bg-rose-50 border-rose-200'; }
            if (item.cat === 'embassy') { icon = 'fa-passport'; iconColor = 'text-indigo-600 bg-indigo-50 border-indigo-200'; }

            const el = document.createElement('div');
            el.className = 'p-3.5 rounded-2xl border border-slate-200 hover:border-amber-400 hover:bg-slate-50 transition cursor-pointer space-y-1.5 shadow-sm';
            el.onclick = () => {
                mapInstance.setView([item.lat, item.lng], 15);
                // Trigger marker popup
                const match = markersLayer.find(m => {
                    const l = m.getLatLng();
                    return Math.abs(l.lat - item.lat) < 0.0001 && Math.abs(l.lng - item.lng) < 0.0001;
                });
                if (match) match.openPopup();
            };

            el.innerHTML = `
                <div class="flex items-start space-x-2.5">
                    <div class="w-8 h-8 rounded-xl ${iconColor} border flex items-center justify-center flex-shrink-0 text-xs">
                        <i class="fa-solid ${icon}"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">${item.regency}</span>
                            <span class="text-[9px] font-semibold text-slate-400 uppercase">${item.cat}</span>
                        </div>
                        <h4 class="font-extrabold text-slate-900 text-xs leading-snug mt-0.5">${item.name}</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1">${item.address}</p>
                    </div>
                </div>
                <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[11px]">
                    <a href="tel:${item.phone}" class="font-bold text-red-600 hover:underline flex items-center" onclick="event.stopPropagation()">
                        <i class="fa-solid fa-phone mr-1"></i>${item.phone}
                    </a>
                    <a href="${item.maps_url}" target="_blank" class="text-blue-600 font-bold hover:underline flex items-center" onclick="event.stopPropagation()">
                        <i class="fa-brands fa-google mr-1"></i>Google Maps &rarr;
                    </a>
                </div>
            `;
            list.appendChild(el);
        });
    }

    function locateUserOnMap() {
        if (!navigator.geolocation) {
            alert('Geolokasi tidak didukung oleh browser Anda.');
            return;
        }

        navigator.geolocation.getCurrentPosition((pos) => {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;

            if (userMarker) {
                mapInstance.removeLayer(userMarker);
            }

            userMarker = L.marker([lat, lng]).addTo(mapInstance);
            userMarker.bindPopup('<strong class="text-xs">Lokasi Anda Saat Ini</strong>').openPopup();
            mapInstance.setView([lat, lng], 13);
        }, () => {
            alert('Tidak dapat mendeteksi koordinat GPS.');
        });
    }

    function resetMapView() {
        mapInstance.setView([-8.4500, 115.1889], 10);
    }
</script>
@endpush
