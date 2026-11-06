<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $validated = $request->validate([
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
            'incident_date' => 'required|date',
            'description' => 'required|string|min:20',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $attachmentPath = $file->storeAs('reports', $filename);
        }

        // Assign initial agency based on category & regency
        $assignedAgency = match($validated['category']) {
            'theft', 'scam', 'harassment' => 'Polres ' . $validated['regency'] . ' & Polisi Pariwisata',
            'traffic_accident' => 'Satlantas Polres ' . $validated['regency'],
            'medical' => 'Dinas Kesehatan Bali & Faskes Wilayah ' . $validated['regency'],
            'lost_document' => 'Sat Intelkam Polres ' . $validated['regency'] . ' & Kantor Imigrasi',
            default => 'Pusat Kendali Satpol PP & BPBD Bali',
        };

        $report = IncidentReport::create([
            'tracking_code' => IncidentReport::generateTrackingCode(),
            'reporter_name' => $validated['reporter_name'],
            'reporter_email' => $validated['reporter_email'] ?? null,
            'reporter_phone' => $validated['reporter_phone'],
            'reporter_nationality' => $validated['reporter_nationality'],
            'passport_or_id' => $validated['passport_or_id'] ?? null,
            'category' => $validated['category'],
            'regency' => $validated['regency'],
            'incident_location' => $validated['incident_location'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'incident_date' => $validated['incident_date'],
            'description' => $validated['description'],
            'attachment_path' => $attachmentPath,
            'status' => 'SUBMITTED',
            'priority' => in_array($validated['category'], ['theft', 'harassment', 'medical']) ? 'HIGH' : 'MEDIUM',
            'assigned_agency' => $assignedAgency,
        ]);

        return redirect()->route('report.track', ['code' => $report->tracking_code])
            ->with('success', 'Laporan Anda berhasil dikirim! Simpan kode pelacakan di bawah ini.');
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
