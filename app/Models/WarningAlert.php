<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarningAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'severity',
        'category',
        'regency',
        'content',
        'valid_until',
        'is_active',
    ];

    protected $casts = [
        'valid_until' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function getSeverityBadgeAttribute(): array
    {
        return match($this->severity) {
            'INFO' => ['bg' => 'bg-sky-50 border-sky-300 text-sky-800', 'badge' => 'bg-sky-500 text-white', 'icon' => 'info'],
            'WARNING' => ['bg' => 'bg-amber-50 border-amber-300 text-amber-800', 'badge' => 'bg-amber-500 text-white', 'icon' => 'alert-triangle'],
            'DANGER' => ['bg' => 'bg-orange-50 border-orange-300 text-orange-800', 'badge' => 'bg-orange-600 text-white', 'icon' => 'alert-octagon'],
            'CRITICAL' => ['bg' => 'bg-rose-50 border-rose-300 text-rose-800 animate-pulse', 'badge' => 'bg-rose-600 text-white', 'icon' => 'flame'],
            default => ['bg' => 'bg-slate-50 border-slate-300 text-slate-800', 'badge' => 'bg-slate-500 text-white', 'icon' => 'bell'],
        };
    }
}
