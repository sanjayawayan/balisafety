@extends('layouts.admin')

@section('title', 'Kelola Laporan Insiden - BaliGuard')

@section('content')
<div class="space-y-6">
    
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight font-serif">Kelola Laporan Insiden Wisatawan</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Penugasan instansi, validasi bukti, dan pembaruan catatan perkembangan kasus.</p>
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('report.create') }}" target="_blank" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow-sm transition flex items-center">
                <i class="fa-solid fa-plus mr-1.5"></i> Input Manual
            </a>
        </div>
    </div>

    <!-- Search & Filter Card -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm">
        <form action="{{ route('admin.incidents.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-3 text-xs">
            <div class="sm:col-span-2 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode tracking, nama pelapor, atau lokasi..." class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-amber-500">
            </div>

            <div>
                <select name="status" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-amber-500">
                    <option value="">-- Semua Status --</option>
                    <option value="SUBMITTED" {{ request('status') === 'SUBMITTED' ? 'selected' : '' }}>SUBMITTED (Menunggu)</option>
                    <option value="UNDER_INVESTIGATION" {{ request('status') === 'UNDER_INVESTIGATION' ? 'selected' : '' }}>UNDER_INVESTIGATION (Verifikasi)</option>
                    <option value="IN_ACTION" {{ request('status') === 'IN_ACTION' ? 'selected' : '' }}>IN_ACTION (Tindakan Tim)</option>
                    <option value="RESOLVED" {{ request('status') === 'RESOLVED' ? 'selected' : '' }}>RESOLVED (Selesai)</option>
                    <option value="REJECTED" {{ request('status') === 'REJECTED' ? 'selected' : '' }}>REJECTED (Ditolak)</option>
                </select>
            </div>

            <div class="flex items-center space-x-2">
                <select name="regency" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:outline-none focus:ring-1 focus:ring-amber-500">
                    <option value="">-- Semua Wilayah --</option>
                    <option value="Badung" {{ request('regency') === 'Badung' ? 'selected' : '' }}>Kab. Badung</option>
                    <option value="Denpasar" {{ request('regency') === 'Denpasar' ? 'selected' : '' }}>Kota Denpasar</option>
                    <option value="Gianyar" {{ request('regency') === 'Gianyar' ? 'selected' : '' }}>Kab. Gianyar</option>
                    <option value="Tabanan" {{ request('regency') === 'Tabanan' ? 'selected' : '' }}>Kab. Tabanan</option>
                    <option value="Klungkung" {{ request('regency') === 'Klungkung' ? 'selected' : '' }}>Kab. Klungkung (Nusa Penida)</option>
                    <option value="Karangasem" {{ request('regency') === 'Karangasem' ? 'selected' : '' }}>Kab. Karangasem</option>
                    <option value="Buleleng" {{ request('regency') === 'Buleleng' ? 'selected' : '' }}>Kab. Buleleng</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition">Filter</button>
            </div>
        </form>
    </div>

    <!-- Incidents Table Card -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase font-bold tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-5 py-3">Kode Tracking</th>
                        <th class="px-5 py-3">Pelapor</th>
                        <th class="px-5 py-3">Kategori & Waktu</th>
                        <th class="px-5 py-3">Lokasi</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Instansi Ditugaskan</th>
                        <th class="px-5 py-3 text-right">Kelola Kasus</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($incidents as $inc)
                        @php $meta = $inc->status_meta; @endphp
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-5 py-4 font-mono font-bold text-slate-900">
                                <a href="{{ route('report.track', ['code' => $inc->tracking_code]) }}" target="_blank" class="hover:text-amber-600 underline">
                                    {{ $inc->tracking_code }}
                                </a>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-900 text-xs">{{ $inc->reporter_name }}</p>
                                <p class="text-[11px] text-slate-500">{{ $inc->reporter_nationality }} &bull; {{ $inc->reporter_phone }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-slate-800">{{ $inc->category_label }}</p>
                                <p class="text-[11px] text-slate-400">{{ $inc->incident_date->format('d M Y, H:i') }}</p>
                            </td>
                            <td class="px-5 py-4 text-slate-600">
                                <span class="font-bold text-slate-800">{{ $inc->regency }}</span>
                                <p class="text-[11px] text-slate-500 truncate max-w-[160px]">{{ $inc->incident_location }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold border {{ $meta['color'] }}">
                                    {{ $meta['label'] }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="text-slate-800 font-semibold">{{ $inc->assigned_agency ?: 'Belum ditugaskan' }}</span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <button onclick="openIncidentModal({{ $inc->id }}, '{{ $inc->tracking_code }}', '{{ $inc->status }}', '{{ $inc->priority }}', '{{ addslashes($inc->assigned_agency) }}', '{{ addslashes($inc->officer_notes) }}')" class="px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-amber-400 font-bold rounded-lg text-xs shadow-sm transition">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i> Perbarui
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-slate-400">
                                Tidak ada laporan yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $incidents->links() }}
        </div>
    </div>

</div>

<!-- Modal Update Incident -->
<div id="incidentModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/80 backdrop-blur-sm">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-3xl max-w-lg w-full p-6 text-left shadow-2xl space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="font-bold text-base text-slate-900" id="incModalTitle">Perbarui Laporan</h3>
                <button onclick="closeIncidentModal()" class="text-slate-400 hover:text-slate-600 text-xl font-bold">&times;</button>
            </div>

            <form id="incidentForm" method="POST" class="space-y-4 text-xs">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Status Penanganan</label>
                        <select name="status" id="modalStatus" class="w-full px-3 py-2 border border-slate-300 rounded-xl bg-slate-50 focus:bg-white">
                            <option value="SUBMITTED">SUBMITTED (Laporan Masuk)</option>
                            <option value="UNDER_INVESTIGATION">UNDER_INVESTIGATION (Verifikasi)</option>
                            <option value="IN_ACTION">IN_ACTION (Tim Meluncur)</option>
                            <option value="RESOLVED">RESOLVED (Kasus Selesai)</option>
                            <option value="REJECTED">REJECTED (Ditolak / Fiktif)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Prioritas</label>
                        <select name="priority" id="modalPriority" class="w-full px-3 py-2 border border-slate-300 rounded-xl bg-slate-50 focus:bg-white">
                            <option value="LOW">LOW</option>
                            <option value="MEDIUM">MEDIUM</option>
                            <option value="HIGH">HIGH</option>
                            <option value="CRITICAL">CRITICAL</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Instansi Penanggung Jawab</label>
                    <input type="text" name="assigned_agency" id="modalAgency" placeholder="Cth: Polres Gianyar & Polsek Ubud" class="w-full px-3 py-2 border border-slate-300 rounded-xl bg-slate-50 focus:bg-white">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Catatan Perkembangan Petugas (Bisa dilihat pelapor)</label>
                    <textarea name="officer_notes" id="modalNotes" rows="3" placeholder="Tuliskan perkembangan kasus di lapangan..." class="w-full px-3 py-2 border border-slate-300 rounded-xl bg-slate-50 focus:bg-white"></textarea>
                </div>

                <div class="pt-2 flex items-center justify-end space-x-2">
                    <button type="button" onclick="closeIncidentModal()" class="px-4 py-2 border border-slate-300 rounded-xl text-slate-700 hover:bg-slate-100 font-bold">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-slate-900 hover:bg-slate-800 text-amber-400 rounded-xl font-bold">Simpan Pembaruan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openIncidentModal(id, code, status, priority, agency, notes) {
        document.getElementById('incModalTitle').innerText = 'Perbarui Kasus: ' + code;
        document.getElementById('incidentForm').action = '/admin/incidents/' + id;
        document.getElementById('modalStatus').value = status;
        document.getElementById('modalPriority').value = priority;
        document.getElementById('modalAgency').value = agency;
        document.getElementById('modalNotes').value = notes;
        document.getElementById('incidentModal').classList.remove('hidden');
    }

    function closeIncidentModal() {
        document.getElementById('incidentModal').classList.add('hidden');
    }
</script>
@endsection
