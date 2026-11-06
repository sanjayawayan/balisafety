<?php

namespace App\Http\Controllers;

use App\Models\SosAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SosController extends Controller
{
    /**
     * Handle incoming Panic Button / SOS Trigger
     */
    public function trigger(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emergency_type' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'location_name' => 'nullable|string|max:255',
            'reporter_name' => 'nullable|string|max:100',
            'reporter_phone' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Determine nearest response unit automatically
        $emergencyType = $request->emergency_type;
        $loc = strtolower($request->location_name ?? '');
        
        $responder = 'Pusat Komando BaliGuard & BPBD Bali';
        if (str_contains($loc, 'kuta') || str_contains($loc, 'seminyak') || str_contains($loc, 'canggu') || str_contains($loc, 'badung')) {
            $responder = $emergencyType === 'medical' ? 'Ambulans BIMC Kuta / RS Siloam' : 'Unit Reaksi Cepat Polsek Kuta & Balawista Badung';
        } elseif (str_contains($loc, 'ubud') || str_contains($loc, 'gianyar')) {
            $responder = $emergencyType === 'medical' ? 'RS Ari Canti Ubud' : 'Polisi Pariwisata Gianyar & Pecalang Ubud';
        } elseif (str_contains($loc, 'sanur') || str_contains($loc, 'denpasar')) {
            $responder = $emergencyType === 'medical' ? 'UGD RSUP Prof. Ngoerah (Sanglah)' : 'Polda Bali & Linmas Denpasar';
        } elseif (str_contains($loc, 'penida') || str_contains($loc, 'pantai') || $emergencyType === 'rescue') {
            $responder = 'BASARNAS Bali (Air & Laut) + Balawista';
        }

        $alert = SosAlert::create([
            'ticket_id' => SosAlert::generateTicketId(),
            'reporter_name' => $request->reporter_name ?: 'Wisatawan (Anonim)',
            'reporter_phone' => $request->reporter_phone ?: '-',
            'emergency_type' => $emergencyType,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'location_name' => $request->location_name ?: 'Koordinat GPS Terdeteksi',
            'notes' => $request->notes,
            'status' => 'PENDING',
            'responder_unit' => $responder,
            'dispatched_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'ticket_id' => $alert->ticket_id,
            'responder_unit' => $alert->responder_unit,
            'status' => $alert->status,
            'created_at' => $alert->created_at->format('d M Y, H:i:s'),
            'hotlines' => [
                ['name' => 'Darurat Bebas Pulsa', 'number' => '112'],
                ['name' => 'Kepolisian Polda Bali', 'number' => '110'],
                ['name' => 'Ambulans & Gawat Darurat', 'number' => '118'],
                ['name' => 'BASARNAS Bali (SAR)', 'number' => '115'],
                ['name' => 'Tourist Police Service', 'number' => '+62361224111'],
            ],
            'message' => 'Sinyal Darurat SOS Anda telah diterima Pusat Komando BaliGuard! Unit respons darurat sedang diarahkan ke lokasi Anda.'
        ]);
    }

    /**
     * Check status of a specific SOS ticket
     */
    public function checkStatus($ticket_id)
    {
        $alert = SosAlert::where('ticket_id', $ticket_id)->first();

        if (!$alert) {
            return response()->json(['success' => false, 'message' => 'Tiket SOS tidak ditemukan.'], 404);
        }

        return response()->json([
            'success' => true,
            'ticket' => [
                'ticket_id' => $alert->ticket_id,
                'status' => $alert->status,
                'status_badge' => $alert->status_badge,
                'responder_unit' => $alert->responder_unit,
                'emergency_label' => $alert->emergency_label,
                'location_name' => $alert->location_name,
                'latitude' => $alert->latitude,
                'longitude' => $alert->longitude,
                'created_at' => $alert->created_at->format('d M Y, H:i'),
                'dispatched_at' => $alert->dispatched_at ? $alert->dispatched_at->format('d M Y, H:i') : null,
            ]
        ]);
    }
}
