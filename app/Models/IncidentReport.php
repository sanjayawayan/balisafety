<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'reporter_name',
        'reporter_email',
        'reporter_phone',
        'reporter_nationality',
        'passport_or_id',
        'category',
        'regency',
        'incident_location',
        'latitude',
        'longitude',
        'incident_date',
        'description',
        'attachment_path',
        'status',
        'priority',
        'officer_notes',
        'assigned_agency',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'incident_date' => 'datetime',
    ];

    public static function generateTrackingCode(): string
    {
        return 'BG-' . date('y') . '-' . strtoupper(bin2hex(random_bytes(8)));
    }

    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'theft' => 'Pencurian / Kemalingan',
            'scam' => 'Penipuan Wisata / Pemerasan',
            'traffic_accident' => 'Kecelakaan Lalu Lintas',
            'medical' => 'Keadaan Darurat Kesehatan',
            'lost_document' => 'Kehilangan Paspor / Dokumen',
            'harassment' => 'Pelecehan / Gangguan Asusila',
            'property_damage' => 'Kerusakan Properti / Rental',
            default => 'Laporan Keamanan Umum',
        };
    }

    public function getStatusMetaAttribute(): array
    {
        return match($this->status) {
            'SUBMITTED' => [
                'step' => 1,
                'label' => 'Laporan Diterima',
                'color' => 'bg-amber-100 text-amber-800 border-amber-300',
                'desc' => 'Laporan telah masuk ke sistem BaliGuard dan menunggu verifikasi petugas piket.'
            ],
            'UNDER_INVESTIGATION' => [
                'step' => 2,
                'label' => 'Diverifikasi Petugas',
                'color' => 'bg-blue-100 text-blue-800 border-blue-300',
                'desc' => 'Petugas telah memvalidasi laporan dan sedang berkoordinasi dengan otoritas terkait di wilayah kejadian.'
            ],
            'IN_ACTION' => [
                'step' => 3,
                'label' => 'Tim Bertindak',
                'color' => 'bg-purple-100 text-purple-800 border-purple-300',
                'desc' => 'Unit lapangan (Polisi Pariwisata / Pecalang / Tim Medis) sedang menangani laporan di lokasi.'
            ],
            'RESOLVED' => [
                'step' => 4,
                'label' => 'Penanganan Selesai',
                'color' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
                'desc' => 'Insiden telah selesai ditangani dengan berita acara penanganan lengkap.'
            ],
            'REJECTED' => [
                'step' => 0,
                'label' => 'Laporan Ditolak',
                'color' => 'bg-rose-100 text-rose-800 border-rose-300',
                'desc' => 'Laporan tidak dapat diproses karena data tidak valid atau fiktif.'
            ],
            default => [
                'step' => 1,
                'label' => $this->status,
                'color' => 'bg-slate-100 text-slate-800 border-slate-300',
                'desc' => 'Status laporan saat ini.'
            ],
        };
    }
}
