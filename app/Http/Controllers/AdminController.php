<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\IncidentReport;
use App\Models\SosAlert;
use App\Models\WarningAlert;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dispatcher & Admin Overview Dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_incidents' => IncidentReport::count(),
            'pending_incidents' => IncidentReport::where('status', 'SUBMITTED')->count(),
            'resolved_incidents' => IncidentReport::where('status', 'RESOLVED')->count(),
            'active_sos' => SosAlert::whereIn('status', ['PENDING', 'DISPATCHED', 'IN_PROGRESS'])->count(),
            'total_sos' => SosAlert::count(),
            'total_chat_messages' => ChatMessage::count(),
            'active_warnings' => WarningAlert::where('is_active', true)->count(),
        ];

        $recentSos = SosAlert::orderByDesc('created_at')->take(6)->get();
        $recentIncidents = IncidentReport::orderByDesc('created_at')->take(8)->get();
        $activeWarnings = WarningAlert::where('is_active', true)->orderByDesc('created_at')->get();

        return view('admin.dashboard', compact('stats', 'recentSos', 'recentIncidents', 'activeWarnings'));
    }

    /**
     * SOS Alerts Dispatch List
     */
    public function sosIndex(Request $request)
    {
        $query = SosAlert::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('emergency_type', $request->type);
        }

        $alerts = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.sos', compact('alerts'));
    }

    /**
     * Update SOS Status and Responder
     */
    public function updateSos(Request $request, $id)
    {
        $alert = SosAlert::findOrFail($id);

        $request->validate([
            'status' => 'required|in:PENDING,DISPATCHED,IN_PROGRESS,RESOLVED,CANCELLED',
            'responder_unit' => 'nullable|string|max:150',
            'notes' => 'nullable|string|max:500',
        ]);

        $alert->status = $request->status;
        if ($request->filled('responder_unit')) {
            $alert->responder_unit = $request->responder_unit;
        }
        if ($request->filled('notes')) {
            $alert->notes = $request->notes;
        }

        if ($request->status === 'DISPATCHED' && !$alert->dispatched_at) {
            $alert->dispatched_at = now();
        }
        if ($request->status === 'RESOLVED') {
            $alert->resolved_at = now();
        }

        $alert->save();

        return back()->with('success', 'Status Tiket Darurat ' . $alert->ticket_id . ' berhasil diperbarui.');
    }

    /**
     * Incident Reports Management
     */
    public function incidentsIndex(Request $request)
    {
        $query = IncidentReport::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('tracking_code', 'like', "%{$search}%")
                  ->orWhere('reporter_name', 'like', "%{$search}%")
                  ->orWhere('reporter_phone', 'like', "%{$search}%")
                  ->orWhere('incident_location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('regency')) {
            $query->where('regency', $request->regency);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $incidents = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.incidents', compact('incidents'));
    }

    /**
     * Update Incident Report Status and Action
     */
    public function updateIncident(Request $request, $id)
    {
        $incident = IncidentReport::findOrFail($id);

        $request->validate([
            'status' => 'required|in:SUBMITTED,UNDER_INVESTIGATION,IN_ACTION,RESOLVED,REJECTED',
            'priority' => 'required|in:LOW,MEDIUM,HIGH,CRITICAL',
            'assigned_agency' => 'nullable|string|max:150',
            'officer_notes' => 'nullable|string|max:1000',
        ]);

        $incident->update([
            'status' => $request->status,
            'priority' => $request->priority,
            'assigned_agency' => $request->assigned_agency,
            'officer_notes' => $request->officer_notes,
        ]);

        return back()->with('success', 'Laporan Insiden ' . $incident->tracking_code . ' berhasil diperbarui.');
    }
}
