<?php

namespace App\Services;

use App\Models\IncidentReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IncidentPersistenceService
{
    private const CLOUD_ENDPOINT = 'https://api.restful-api.dev/objects/ff808181a09d98f701a1cf2f2f5b1373';
    private const LOCAL_BACKUP_PATH = 'reports_storage.json';

    /**
     * Synchronize all known reports from Cloud & Local Backup into SQLite
     */
    public static function syncToDatabase(): void
    {
        try {
            $reports = self::fetchAllReports();

            foreach ($reports as $data) {
                if (empty($data['tracking_code'])) {
                    continue;
                }

                $code = trim(strtoupper($data['tracking_code']));
                $existing = IncidentReport::where('tracking_code', $code)->first();

                $date = now();
                if (!empty($data['incident_date'])) {
                    try {
                        $date = Carbon::parse($data['incident_date']);
                    } catch (\Throwable $e) {
                        $date = now();
                    }
                }

                $reportFields = [
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
                    'incident_date' => $date,
                    'description' => $data['description'] ?? 'Laporan insiden keamanan.',
                    'status' => $data['status'] ?? 'SUBMITTED',
                    'priority' => $data['priority'] ?? 'MEDIUM',
                    'officer_notes' => $data['officer_notes'] ?? null,
                    'assigned_agency' => $data['assigned_agency'] ?? 'Pusat Kendali BaliGuard',
                ];

                if (!$existing) {
                    IncidentReport::create($reportFields);
                } else {
                    $existing->update([
                        'status' => $reportFields['status'],
                        'priority' => $reportFields['priority'],
                        'officer_notes' => $reportFields['officer_notes'],
                        'assigned_agency' => $reportFields['assigned_agency'],
                    ]);
                }
            }
        } catch (\Throwable $e) {
            Log::warning('Incident syncToDatabase notice: ' . $e->getMessage());
        }
    }

    /**
     * Fetch reports from Cloud Store with Local Storage fallback
     */
    public static function fetchAllReports(): array
    {
        $cloudReports = [];

        // 1. Try Cloud Store
        try {
            $ch = curl_init(self::CLOUD_ENDPOINT);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && $response) {
                $json = json_decode($response, true);
                if (isset($json['data']['reports']) && is_array($json['data']['reports'])) {
                    $cloudReports = $json['data']['reports'];
                }
            }
        } catch (\Throwable $e) {
            Log::info('Cloud store read error: ' . $e->getMessage());
        }

        // 2. Read Local Storage Backup
        $localReports = self::readLocalBackup();

        // 3. Merge by tracking_code
        $merged = [];
        foreach ($localReports as $r) {
            if (!empty($r['tracking_code'])) {
                $merged[strtoupper($r['tracking_code'])] = $r;
            }
        }
        foreach ($cloudReports as $r) {
            if (!empty($r['tracking_code'])) {
                $merged[strtoupper($r['tracking_code'])] = $r;
            }
        }

        return array_values($merged);
    }

    /**
     * Save newly created report to SQLite, Local Backup, and Cloud Store
     */
    public static function persistReport(IncidentReport $report): void
    {
        $reportArray = $report->toArray();
        $code = strtoupper($report->tracking_code);

        // 1. Update Local File Backup
        $currentReports = self::readLocalBackup();
        $merged = [];
        foreach ($currentReports as $r) {
            if (!empty($r['tracking_code'])) {
                $merged[strtoupper($r['tracking_code'])] = $r;
            }
        }
        $merged[$code] = $reportArray;
        self::writeLocalBackup(array_values($merged));

        // 2. Sync to Cloud Store
        self::pushToCloud(array_values($merged));
    }

    /**
     * Update existing report status across all storage layers
     */
    public static function updateReportStatus(string $trackingCode, array $attributes): void
    {
        $code = strtoupper($trackingCode);
        $currentReports = self::fetchAllReports();

        foreach ($currentReports as &$r) {
            if (!empty($r['tracking_code']) && strtoupper($r['tracking_code']) === $code) {
                foreach ($attributes as $k => $v) {
                    $r[$k] = $v;
                }
                break;
            }
        }
        unset($r);

        self::writeLocalBackup($currentReports);
        self::pushToCloud($currentReports);
    }

    /**
     * Push full reports array to cloud
     */
    private static function pushToCloud(array $reports): void
    {
        try {
            $ch = curl_init(self::CLOUD_ENDPOINT);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
                'name' => 'baliguard_report_store',
                'data' => [
                    'reports' => array_values($reports),
                    'updated_at' => now()->toIso8601String(),
                ]
            ]));
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_exec($ch);
            curl_close($ch);
        } catch (\Throwable $e) {
            Log::warning('Cloud push error: ' . $e->getMessage());
        }
    }

    /**
     * Read local storage JSON
     */
    public static function readLocalBackup(): array
    {
        $path = storage_path('app/' . self::LOCAL_BACKUP_PATH);
        if (!file_exists($path)) {
            return [];
        }

        $content = @file_get_contents($path);
        if (!$content) {
            return [];
        }

        $decoded = json_decode($content, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Write local storage JSON
     */
    public static function writeLocalBackup(array $reports): void
    {
        try {
            $path = storage_path('app/' . self::LOCAL_BACKUP_PATH);
            $dir = dirname($path);
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            @file_put_contents($path, json_encode(array_values($reports), JSON_PRETTY_PRINT));
        } catch (\Throwable $e) {
            Log::warning('writeLocalBackup notice: ' . $e->getMessage());
        }
    }

    /**
     * Get user's own submitted reports from cookie or session
     */
    public static function getUserReports(Request $request): array
    {
        $reports = [];

        // Check session
        $sessionReports = $request->session()->get('my_submitted_reports', []);
        if (is_array($sessionReports)) {
            foreach ($sessionReports as $r) {
                if (!empty($r['tracking_code'])) {
                    $reports[strtoupper($r['tracking_code'])] = $r;
                }
            }
        }

        // Check cookie
        $cookieValue = $request->cookie('baliguard_my_reports');
        if ($cookieValue) {
            $decoded = json_decode($cookieValue, true);
            if (is_array($decoded)) {
                foreach ($decoded as $r) {
                    if (!empty($r['tracking_code'])) {
                        $reports[strtoupper($r['tracking_code'])] = $r;
                    }
                }
            }
        }

        return array_values($reports);
    }
}
