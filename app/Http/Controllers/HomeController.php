<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use App\Models\SosAlert;
use App\Models\WarningAlert;
use App\Services\BaliLocationsService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Active early warnings
        $warnings = WarningAlert::where('is_active', true)
            ->orderByRaw("CASE 
                WHEN severity = 'CRITICAL' THEN 1 
                WHEN severity = 'DANGER' THEN 2 
                WHEN severity = 'WARNING' THEN 3 
                ELSE 4 END")
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        // Recent stats for the dashboard indicator
        $totalIncidents = IncidentReport::count();
        $resolvedIncidents = IncidentReport::where('status', 'RESOLVED')->count();
        $activeSos = SosAlert::whereIn('status', ['PENDING', 'DISPATCHED', 'IN_PROGRESS'])->count();

        // Bali safety status calculation
        $overallSafety = [
            'status' => $activeSos > 3 ? 'Waspada' : 'Kondusif & Aman',
            'badge' => $activeSos > 3 ? 'bg-amber-500 text-white' : 'bg-emerald-500 text-white',
            'score' => $activeSos > 3 ? 88 : 96,
            'wave_condition' => 'Ombak Sedang (1.2m - 1.8m) - Pantai Selatan Harap Waspada Bendera Merah',
            'weather' => 'Cerah Berawan / 28°C - 31°C',
        ];

        // Key tourist zones with safety indicators
        $zones = [
            ['name' => 'Badung Selatan (Kuta, Seminyak, Canggu, Uluwatu)', 'status' => 'Aman / Ramai', 'badge' => 'emerald', 'note' => 'Pos Balawista & Polisi Wisata aktif 24 jam'],
            ['name' => 'Denpasar (Sanur, Renon, Kota)', 'status' => 'Sangat Aman', 'badge' => 'emerald', 'note' => 'Penyeberangan Sanur - Nusa Penida normal'],
            ['name' => 'Gianyar (Ubud, Sukawati, Tegalalang)', 'status' => 'Aman', 'badge' => 'emerald', 'note' => 'Arus lalu lintas lancar, Pecalang bertugas'],
            ['name' => 'Tabanan (Bedugul, Tanah Lot)', 'status' => 'Aman / Cuaca Sejuk', 'badge' => 'emerald', 'note' => 'Waspada kabut sore di jalur Bedugul'],
            ['name' => 'Klungkung (Nusa Penida & Lembongan)', 'status' => 'Waspada Arus Ombak', 'badge' => 'amber', 'note' => 'Dilarang berenang di bibir tebing Diamond Beach & Kelingking'],
            ['name' => 'Karangasem (Amed, Besakih, Candidasa)', 'status' => 'Kondusif', 'badge' => 'emerald', 'note' => 'Aktivitas Gunung Agung Normal (Level I)'],
            ['name' => 'Buleleng (Lovina, Singaraja)', 'status' => 'Sangat Aman', 'badge' => 'emerald', 'note' => 'Wisata lumba-lumba Lovina tenang'],
            ['name' => 'Bangli (Kintamani & Batur)', 'status' => 'Aman', 'badge' => 'emerald', 'note' => 'Kawasan kaldera Batur kondusif'],
            ['name' => 'Jembrana (Gilimanuk & Medewi)', 'status' => 'Sangat Aman', 'badge' => 'emerald', 'note' => 'Pintu gerbang penyeberangan barat lancar'],
        ];

        // Verified Google Maps locations across Bali
        $locations = BaliLocationsService::getLocations();

        return view('home', compact('warnings', 'overallSafety', 'zones', 'totalIncidents', 'resolvedIncidents', 'activeSos', 'locations'));
    }

    public function guidelines()
    {
        return view('guidelines');
    }

    public function map()
    {
        $warnings = WarningAlert::where('is_active', true)->get();
        $locations = BaliLocationsService::getLocations();
        
        return view('map', compact('warnings', 'locations'));
    }
}
