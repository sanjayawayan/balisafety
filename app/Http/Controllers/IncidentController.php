<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class IncidentController extends Controller
{
    /**
     * Show report incident form
     */
    public function create()
    {
        $regencies = [
            'Badung' => 'Kab. Badung (Kuta, Seminyak, Canggu, Nusa Dua, Jimbaran, Uluwatu)',
            'Denpasar' => 'Kota Denpasar (Sanur, Renon, Kesiman, Panjer)',
            'Gianyar' => 'Kab. Gianyar (Ubud, Sukawati, Tegalalang, Blahbatuh)',
            'Tabanan' => 'Kab. Tabanan (Bedugul, Tanah Lot, Kediri, Jatiluwih)',
            'Buleleng' => 'Kab. Buleleng (Lovina, Singaraja, Banjar, Tejakula)',
            'Karangasem' => 'Kab. Karangasem (Amed, Candidasa, Besakih, Tulamben)',
            'Bangli' => 'Kab. Bangli (Kintamani, Batur, Penglipuran)',
            'Klungkung' => 'Kab. Klungkung (Nusa Penida, Nusa Lembongan, Ceningan, Semarapura)',
            'Jembrana' => 'Kab. Jembrana (Gilimanuk, Negara, Medewi)',
        ];

        $categories = [
            'theft' => 'Pencurian / Kemalingan / Copet',
            'scam' => 'Penipuan Wisata / Valas / Pemerasan',
            'traffic_accident' => 'Kecelakaan Lalu Lintas / Rental Motor',
            'medical' => 'Keadaan Darurat Medis / Rabies / Cidera',
            'lost_document' => 'Kehilangan Paspor / Dompet / Dokumen',
            'harassment' => 'Pelecehan / Gangguan Keamanan Asusila',
            'property_damage' => 'Kerusakan Properti / Konflik Penginapan',
            'other' => 'Insiden Keamanan Lainnya',
        ];

        return view('report.create', compact('regencies', 'categories'));
    }

    /**
     * Submit and store incident report
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reporter_name' => 'required|string|max:150',
            'reporter_email' => 'nullable|email|max:150',
            'reporter_phone' => 'required|string|max:50',
            'reporter_nationality' => 'required|string|max:100',
            'passport_or_id' => 'nullable|string|max:50',
            'category' => 'required|string',
            'regency' => 'required|string',
            'incident_location' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'incident_date' => 'required',
            'description' => 'required|string|min:20',
        ], [
            'reporter_name.required' => 'Nama lengkap pelapor wajib diisi.',
            'reporter_phone.required' => 'Nomor WhatsApp / telepon wajib diisi.',
            'reporter_nationality.required' => 'Kewarganegaraan wajib diisi.',
            'category.required' => 'Pilih kategori insiden yang dialami.',
            'regency.required' => 'Pilih wilayah / kabupaten kejadian.',
            'incident_location.required' => 'Lokasi spesifik kejadian wajib diisi.',
            'incident_date.required' => 'Waktu kejadian wajib diisi.',
            'description.required' => 'Deskripsi kronologi kejadian wajib diisi.',
            'description.min' => 'Deskripsi kronologi minimal 20 karakter agar dapat ditindaklanjuti.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try {
            // Assign initial agency based on category & regency
            $assignedAgency = match($validated['category']) {
                'theft', 'scam', 'harassment' => 'Polres ' . $validated['regency'] . ' & Polisi Pariwisata',
                'traffic_accident' => 'Satlantas Polres ' . $validated['regency'],
                'medical' => 'Dinas Kesehatan Bali & Faskes Wilayah ' . $validated['regency'],
                'lost_document' => 'Sat Intelkam Polres ' . $validated['regency'] . ' & Kantor Imigrasi',
                default => 'Pusat Kendali Satpol PP & BPBD Bali',
            };

            // Safely parse incident date
            try {
                $incidentDate = Carbon::parse($validated['incident_date']);
            } catch (\Throwable $dateErr) {
                $incidentDate = now();
            }

            $report = IncidentReport::create([
                'tracking_code' => IncidentReport::generateTrackingCode(),
                'reporter_name' => trim($validated['reporter_name']),
                'reporter_email' => !empty($validated['reporter_email']) ? trim($validated['reporter_email']) : null,
                'reporter_phone' => trim($validated['reporter_phone']),
                'reporter_nationality' => trim($validated['reporter_nationality']),
                'passport_or_id' => !empty($validated['passport_or_id']) ? trim($validated['passport_or_id']) : null,
                'category' => $validated['category'],
                'regency' => $validated['regency'],
                'incident_location' => trim($validated['incident_location']),
                'latitude' => !empty($validated['latitude']) ? (float) $validated['latitude'] : null,
                'longitude' => !empty($validated['longitude']) ? (float) $validated['longitude'] : null,
                'incident_date' => $incidentDate,
                'description' => trim($validated['description']),
                'status' => 'SUBMITTED',
                'priority' => in_array($validated['category'], ['theft', 'harassment', 'medical']) ? 'HIGH' : 'MEDIUM',
                'assigned_agency' => $assignedAgency,
            ]);

            return redirect()->route('report.track', ['code' => $report->tracking_code])
                ->with('success', 'Laporan Anda berhasil dikirim ke Pusat Kendali BaliGuard! Simpan kode pelacakan di bawah ini.');
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan laporan insiden: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'input' => $request->except(['_token']),
            ]);

            return back()->withInput()->with('error', 'Terjadi kesalahan sistem saat menyimpan laporan: ' . $e->getMessage() . '. Silakan coba kembali.');
        }
    }

    /**
     * Track incident report status
     */
    public function track(Request $request, $code = null)
    {
        $trackingCode = $code ?: $request->input('code');
        $report = null;

        if ($trackingCode) {
            $report = IncidentReport::where('tracking_code', trim(strtoupper($trackingCode)))->first();
        }

        return view('report.track', compact('report', 'trackingCode'));
    }
}
