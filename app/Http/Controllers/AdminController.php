<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\IncidentReport;
use App\Models\SosAlert;
use App\Models\WarningAlert;
use App\Services\IncidentPersistenceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Show Admin Login Form
     */
    public function showLoginForm(Request $request)
    {
        if ($request->session()->get('admin_logged_in') === true) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Process Admin Login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $configuredUser = config('services.admin.username', 'admin') ?: 'admin';
        $configuredPass = config('services.admin.password', 'baliguard2026') ?: 'baliguard2026';

        if (hash_equals($configuredUser, (string) $request->input('username')) &&
            hash_equals($configuredPass, (string) $request->input('password'))) {
            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_user', $configuredUser);
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang di Pusat Komando BaliGuard.');
        }

        return back()->withInput()->with('error', 'Username atau password administrator tidak cocok.');
    }

    /**
     * Process Admin Logout
     */
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_user']);
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah keluar dari sesi Pusat Komando.');
    }

    /**
     * Dispatcher & Admin Overview Dashboard
     */
    public function dashboard()
    {
        // Hydrate from cloud store & backup so admin always sees all submitted reports
        IncidentPersistenceService::syncToDatabase();

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

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:PENDING,DISPATCHED,IN_PROGRESS,RESOLVED,CANCELLED',
            'responder_unit' => 'nullable|string|max:150',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

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
        // Hydrate from cloud store & backup so admin always sees all submitted reports
        IncidentPersistenceService::syncToDatabase();

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

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:SUBMITTED,UNDER_INVESTIGATION,IN_ACTION,RESOLVED,REJECTED',
            'priority' => 'required|in:LOW,MEDIUM,HIGH,CRITICAL',
            'assigned_agency' => 'nullable|string|max:150',
            'officer_notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $incident->update([
            'status' => $request->status,
            'priority' => $request->priority,
            'assigned_agency' => $request->assigned_agency,
            'officer_notes' => $request->officer_notes,
        ]);

        // Sync status update across cloud store & local backup
        IncidentPersistenceService::updateReportStatus($incident->tracking_code, [
            'status' => $request->status,
            'priority' => $request->priority,
            'assigned_agency' => $request->assigned_agency,
            'officer_notes' => $request->officer_notes,
        ]);

        return back()->with('success', 'Laporan Insiden ' . $incident->tracking_code . ' berhasil diperbarui.');
    }
}
