<?php

namespace Database\Seeders;

use App\Models\IncidentReport;
use App\Models\SosAlert;
use App\Models\WarningAlert;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Early Warning Alerts
        WarningAlert::create([
            'title' => 'Peringatan Gelombang Tinggi Pantai Kuta, Seminyak & Canggu (1.8m - 2.5m)',
            'severity' => 'WARNING',
            'category' => 'ocean_wave',
            'regency' => 'Kab. Badung',
            'content' => 'BMKG Wilayah III Denpasar mengeluarkan peringatan potensi gelombang laut tinggi dan arus pecah (rip current) di pesisir barat dan selatan Bali. Wisatawan diimbau mematuhi rambu bendera merah Balawista.',
            'valid_until' => now()->addDays(3),
            'is_active' => true,
        ]);

        WarningAlert::create([
            'title' => 'Waspada Jalur Rawan Licin Bedugul - Kintamani Karena Kabut Tebal & Hujan Ringan',
            'severity' => 'INFO',
            'category' => 'weather',
            'regency' => 'Kab. Tabanan & Bangli',
            'content' => 'Pengemudi mobil dan sepeda motor sewaan diimbau menyalakan lampu utama, mengurangi kecepatan, serta memastikan rem kendaraan dalam kondisi prima saat melintasi jalur perbukitan.',
            'valid_until' => now()->addDays(2),
            'is_active' => true,
        ]);

        WarningAlert::create([
            'title' => 'Peringatan Larangan Berenang di Pantai Kelingking & Diamond Beach Nusa Penida',
            'severity' => 'DANGER',
            'category' => 'ocean_wave',
            'regency' => 'Kab. Klungkung',
            'content' => 'Demi keselamatan nyawa wisatawan, dilarang keras berenang atau bermain ombak di tepi pantai Kelingking dan Diamond Beach Nusa Penida karena kontur pantai yang curam dan arus bawah laut yang sangat kuat.',
            'valid_until' => now()->addMonths(1),
            'is_active' => true,
        ]);

        // 2. Seed Sample Incident Reports
        IncidentReport::create([
            'tracking_code' => 'BG-26-8841A',
            'reporter_name' => 'Michael Jenkins',
            'reporter_email' => 'm.jenkins@example.com',
            'reporter_phone' => '+61 412 345 678',
            'reporter_nationality' => 'Australia',
            'passport_or_id' => 'PA9823101',
            'category' => 'theft',
            'regency' => 'Badung',
            'incident_location' => 'Pantai Batu Bolong, Canggu',
            'latitude' => -8.6595,
            'longitude' => 115.1301,
            'incident_date' => now()->subHours(8),
            'description' => 'Tas selempang berisi ponsel iPhone 15 Pro dan dompet diambil dari bagasi jok motor saat diparkir di dekat pintu masuk pantai.',
            'status' => 'IN_ACTION',
            'priority' => 'HIGH',
            'officer_notes' => 'Petugas Polsek Kuta Utara dan Pecalang Desa Canggu sedang memeriksa rekaman CCTV parkiran kafe sekitar.',
            'assigned_agency' => 'Polsek Kuta Utara & Pecalang Canggu',
        ]);

        IncidentReport::create([
            'tracking_code' => 'BG-26-3912B',
            'reporter_name' => 'Sarah Schmidt',
            'reporter_email' => 'sarah.s@example.de',
            'reporter_phone' => '+49 170 889911',
            'reporter_nationality' => 'Jerman',
            'passport_or_id' => 'C9340192',
            'category' => 'lost_document',
            'regency' => 'Gianyar',
            'incident_location' => 'Jl. Monkey Forest No. 12, Ubud',
            'latitude' => -8.5132,
            'longitude' => 115.2604,
            'incident_date' => now()->subDay(),
            'description' => 'Dompet dokumen berisi Paspor Jerman tertinggal di salah satu kedai kopi di kawasan Monkey Forest.',
            'status' => 'UNDER_INVESTIGATION',
            'priority' => 'MEDIUM',
            'officer_notes' => 'Petugas Tourist Police Ubud telah mengonfirmasi pihak kafe dan sedang mengamankan dokumen yang ditemukan.',
            'assigned_agency' => 'Tourist Police Ubud',
        ]);

        IncidentReport::create([
            'tracking_code' => 'BG-26-5519C',
            'reporter_name' => 'Agus Hendrawan',
            'reporter_email' => 'agus.hendra@gmail.com',
            'reporter_phone' => '081234567890',
            'reporter_nationality' => 'Indonesia',
            'passport_or_id' => '5171029988770001',
            'category' => 'traffic_accident',
            'regency' => 'Badung',
            'incident_location' => 'Simpang Sunset Road - Dewi Sri, Kuta',
            'latitude' => -8.7051,
            'longitude' => 115.1783,
            'incident_date' => now()->subDays(2),
            'description' => 'Tabrakan ringan sesama pengendara sepeda motor sewaan karena salah satu turis ragu saat berbelok arah.',
            'status' => 'RESOLVED',
            'priority' => 'MEDIUM',
            'officer_notes' => 'Telah dilakukan mediasi damai oleh Satlantas Polresta Denpasar, kedua belah pihak sepakat ganti rugi wajar.',
            'assigned_agency' => 'Satlantas Polresta Denpasar',
        ]);

        // 3. Seed Sample SOS Alert
        SosAlert::create([
            'ticket_id' => 'SOS-20261106-9A12',
            'reporter_name' => 'Liam Connor',
            'reporter_phone' => '+44 7911 123456',
            'emergency_type' => 'medical',
            'latitude' => -8.6942,
            'longitude' => 115.1612,
            'location_name' => 'Pantai Double Six, Seminyak',
            'notes' => 'Wisatawan tersengat ubur-ubur beracun saat berselancar, sesak nafas ringan.',
            'status' => 'RESOLVED',
            'responder_unit' => 'Balawista Pos 4 & Ambulans BIMC Hospital Kuta',
            'dispatched_at' => now()->subHours(5),
            'resolved_at' => now()->subHours(3),
        ]);
    }
}
