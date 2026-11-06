<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'reporter_name',
        'reporter_phone',
        'emergency_type',
        'latitude',
        'longitude',
        'location_name',
        'notes',
        'status',
        'responder_unit',
        'dispatched_at',
        'resolved_at',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'dispatched_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    public static function generateTicketId(): string
    {
        return 'SOS-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }

    public function getEmergencyLabelAttribute(): string
    {
        return match($this->emergency_type) {
            'medical' => 'Darurat Medis / Ambulans',
            'police' => 'Tindak Kriminal / Polisi',
            'rescue' => 'Penyelamatan Laut / SAR',
            'disaster' => 'Bencana Alam / Gempa / Cuaca',
            'harassment' => 'Pelecehan / Gangguan Keamanan',
            default => 'Bantuan Darurat Umum',
        };
    }

    public function getStatusBadgeAttribute(): array
    {
        return match($this->status) {
            'PENDING' => ['class' => 'bg-red-500 text-white animate-pulse', 'label' => 'Mendesak / Menunggu Respon'],
            'DISPATCHED' => ['class' => 'bg-amber-500 text-white', 'label' => 'Petugas Meluncur'],
            'IN_PROGRESS' => ['class' => 'bg-blue-600 text-white', 'label' => 'Dalam Penanganan'],
            'RESOLVED' => ['class' => 'bg-emerald-600 text-white', 'label' => 'Selesai'],
            'CANCELLED' => ['class' => 'bg-gray-400 text-white', 'label' => 'Dibatalkan'],
            default => ['class' => 'bg-gray-500 text-white', 'label' => $this->status],
        };
    }
}
