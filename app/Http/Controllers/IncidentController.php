<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use App\Services\IncidentPersistenceService;
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
            'theft' => 'Pencurian / Kemalingan / Copet (Theft / Robbery)',
            'scam' => 'Penipuan Wisata / Valas / Pemerasan (Tourist Scam / Money Changer)',
            'traffic_accident' => 'Kecelakaan Lalu Lintas / Rental Motor (Traffic Accident)',
            'medical' => 'Keadaan Darurat Medis / Rabies / Cidera (Medical Emergency / Rabies)',
            'lost_document' => 'Kehilangan Paspor / Dompet / Dokumen (Lost Passport / ID)',
            'harassment' => 'Pelecehan / Gangguan Keamanan Asusila (Harassment)',
            'property_damage' => 'Kerusakan Properti / Konflik Penginapan (Property / Hotel Dispute)',
            'other' => 'Insiden Keamanan Lainnya (Other Incident)',
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

            // Multi-layer persistence: Sync to cloud KV store and local file backup
            IncidentPersistenceService::persistReport($report);

            // Store in user session
            $request->session()->push('my_submitted_reports', $report->toArray());

            // Prepare cookie with user's reports list (max 20)
            $existingCookie = $request->cookie('baliguard_my_reports');
            $userReports = [];
            if ($existingCookie) {
                $decoded = json_decode($existingCookie, true);
                if (is_array($decoded)) {
                    $userReports = $decoded;
                }
            }
            $userReports[strtoupper($report->tracking_code)] = [
                'tracking_code' => $report->tracking_code,
                'category' => $report->category,
                'category_label' => $report->category_label,
                'incident_location' => $report->incident_location,
                'created_at' => $report->created_at->format('Y-m-d H:i:s'),
                'status' => $report->status,
            ];
            // Keep recent 20
            if (count($userReports) > 20) {
                $userReports = array_slice($userReports, -20, 20, true);
            }

            $cookie = cookie('baliguard_my_reports', json_encode(array_values($userReports)), 60 * 24 * 365);

            return redirect()->route('report.track', ['code' => $report->tracking_code])
                ->with('success', 'Laporan Anda berhasil dikirim ke Pusat Kendali BaliGuard! Simpan kode pelacakan di bawah ini.')
                ->withCookie($cookie);
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
            $cleanCode = trim(strtoupper($trackingCode));
            $report = IncidentReport::where('tracking_code', $cleanCode)->first();

            // If not found in current SQLite instance (e.g. freshly spun Vercel container),
            // synchronize from Cloud & Local Backup immediately!
            if (!$report) {
                IncidentPersistenceService::syncToDatabase();
                $report = IncidentReport::where('tracking_code', $cleanCode)->first();
            }

            // If still not found, check if it exists in the user's cookie / session
            if (!$report) {
                $userReports = IncidentPersistenceService::getUserReports($request);
                foreach ($userReports as $uReport) {
                    if (strtoupper($uReport['tracking_code'] ?? '') === $cleanCode) {
                        try {
                            $report = IncidentReport::create([
                                'tracking_code' => $cleanCode,
                                'reporter_name' => $uReport['reporter_name'] ?? 'Pelapor',
                                'reporter_email' => $uReport['reporter_email'] ?? null,
                                'reporter_phone' => $uReport['reporter_phone'] ?? '-',
                                'reporter_nationality' => $uReport['reporter_nationality'] ?? 'Indonesia',
                                'passport_or_id' => $uReport['passport_or_id'] ?? null,
                                'category' => $uReport['category'] ?? 'other',
                                'regency' => $uReport['regency'] ?? 'Badung',
                                'incident_location' => $uReport['incident_location'] ?? 'Bali',
                                'latitude' => !empty($uReport['latitude']) ? (float) $uReport['latitude'] : null,
                                'longitude' => !empty($uReport['longitude']) ? (float) $uReport['longitude'] : null,
                                'incident_date' => now(),
                                'description' => $uReport['description'] ?? 'Laporan insiden keamanan.',
                                'status' => 'SUBMITTED',
                                'priority' => 'MEDIUM',
                                'assigned_agency' => 'Pusat Kendali BaliGuard',
                            ]);
                            IncidentPersistenceService::persistReport($report);
                        } catch (\Throwable $err) {
                            Log::warning('Cookie recovery insert failed: ' . $err->getMessage());
                        }
                        break;
                    }
                }
            }
        }

        // Retrieve user's previous reports list for convenient history switching
        $myReports = IncidentPersistenceService::getUserReports($request);

        return view('report.track', compact('report', 'trackingCode', 'myReports'));
    }

    /**
     * API endpoint to synchronize report payload from client localStorage
     */
    public function syncFromClient(Request $request)
    {
        $reports = $request->input('reports', []);
        if (!is_array($reports)) {
            return response()->json(['status' => 'ERROR', 'message' => 'Invalid payload'], 400);
        }

        $synced = 0;
        foreach ($reports as $data) {
            if (empty($data['tracking_code'])) {
                continue;
            }

            $code = trim(strtoupper($data['tracking_code']));
            $exists = IncidentReport::where('tracking_code', $code)->first();

            if (!$exists) {
                try {
                    $rep = IncidentReport::create([
                        'tracking_code' => $code,
                        'reporter_name' => $data['reporter_name'] ?? 'Wisatawan',
                        'reporter_email' => $data['reporter_email'] ?? null,
                        'reporter_phone' => $data['reporter_phone'] ?? '-',
                        'reporter_nationality' => $data['reporter_nationality'] ?? 'Indonesia',
                        'passport_or_id' => $data['passport_or_id'] ?? null,
                        'category' => $data['category'] ?? 'other',
                        'regency' => $data['regency'] ?? 'Badung',
                        'incident_location' => $data['incident_location'] ?? 'Bali',
                        'latitude' => !empty($data['latitude']) ? (float) $data['latitude'] : null,
                        'longitude' => !empty($data['longitude']) ? (float) $data['longitude'] : null,
                        'incident_date' => now(),
                        'description' => $data['description'] ?? 'Laporan dari perangkat pelapor.',
                        'status' => $data['status'] ?? 'SUBMITTED',
                        'priority' => 'MEDIUM',
                        'assigned_agency' => $data['assigned_agency'] ?? 'Pusat Kendali Satpol PP & BPBD Bali',
                    ]);

                    IncidentPersistenceService::persistReport($rep);
                    $synced++;
                } catch (\Throwable $e) {
                    Log::warning('Client sync insert failed: ' . $e->getMessage());
                }
            }
        }

        return response()->json(['status' => 'OK', 'synced' => $synced]);
    }
}
