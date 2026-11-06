<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected ?string $apiKey;
    protected string $model;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY') ?: config('services.gemini.key');
        $this->model = env('GEMINI_MODEL', 'gemini-1.5-flash');
        $this->baseUrl = env('GEMINI_BASE_URL', 'https://generativelanguage.googleapis.com/v1beta');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Send message to Gemini API with strict token limits (Max Input & Output Token-Efficient)
     */
    public function generateResponse(string $userMessage, array $conversationHistory = []): array
    {
        // 1. Token-Efficiency: Truncate user input to max 250 characters
        $cleanMessage = mb_substr(trim($userMessage), 0, 250);

        if (!$this->isConfigured()) {
            return $this->fallbackResponse($cleanMessage, false);
        }

        try {
            $systemInstruction = $this->getSystemPrompt();

            // 2. Token-Efficiency: Only keep the last 2 turns (1 user, 1 assistant)
            // and truncate each past message to max 120 characters to drastically minimize prompt tokens.
            $contents = [];
            $recentHistory = array_slice($conversationHistory, -2);
            foreach ($recentHistory as $msg) {
                $role = ($msg['role'] === 'assistant' || $msg['role'] === 'model') ? 'model' : 'user';
                $text = mb_substr($msg['message'] ?? $msg['text'] ?? '', 0, 120);
                if (!empty($text)) {
                    $contents[] = [
                        'role' => $role,
                        'parts' => [
                            ['text' => $text]
                        ]
                    ];
                }
            }

            // Append current user message
            $contents[] = [
                'role' => 'user',
                'parts' => [
                    ['text' => $cleanMessage]
                ]
            ];

            $endpoint = "{$this->baseUrl}/models/{$this->model}:generateContent?key={$this->apiKey}";

            // 3. Token-Efficiency: maxOutputTokens set to 250 (fast, concise, low token usage)
            $response = Http::timeout(10)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($endpoint, [
                    'system_instruction' => [
                        'parts' => [
                            ['text' => $systemInstruction]
                        ]
                    ],
                    'contents' => $contents,
                    'generationConfig' => [
                        'temperature' => 0.3,
                        'maxOutputTokens' => 250,
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $replyText = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

                if ($replyText) {
                    return [
                        'success' => true,
                        'message' => trim($replyText),
                        'source' => 'gemini-live',
                        'model' => $this->model,
                        'tokens_optimized' => true,
                    ];
                }
            }

            Log::warning('Gemini API returned error: ' . $response->body());
            return $this->fallbackResponse($cleanMessage, true, 'Gemini API Error: ' . $response->status());

        } catch (\Throwable $e) {
            Log::error('Gemini Exception: ' . $e->getMessage());
            return $this->fallbackResponse($cleanMessage, true, $e->getMessage());
        }
    }

    /**
     * Compact, high-density system instruction designed to minimize token usage
     */
    protected function getSystemPrompt(): string
    {
        return <<<PROMPT
Anda "BaliGuard AI", asisten darurat & keselamatan wisatawan di Bali (Dinas Pariwisata, Polda Bali, Balawista, Pecalang).

ATURAN HEMAT TOKEN:
- Jawablah SANGAT SINGKAT, padat, to-the-point (< 80 kata / maks 3-4 butir poin). Dilarang membuat esai panjang atau basa-basi pembuka/penutup.
- Selalu cetak tebal (bold) nomor darurat penting:
  * Darurat Bebas Pulsa: **112**
  * Polisi: **110** | Tourist Police: **+62 361 224111**
  * Medis/Ambulans: **118** / **119**
  * SAR Laut: **115** (BASARNAS)
  * RS Utama: **BIMC Kuta (+62 361 761263)**, **Siloam (+62 361 779900)**, **RSUP Sanglah / Rabies (+62 361 227911)**
- Aturan wajib: Helm SNI & SIM Internasional, Sarong & Selendang di Pura, larangan berenang di bendera merah, Money Changer resmi BI.
- Deteksi bahasa penanya (ID/EN/dll) dan jawab dalam bahasa tersebut secara ringkas.
PROMPT;
    }

    /**
     * Compact intelligent local fallback if API key is not configured
     */
    public function fallbackResponse(string $message, bool $hadError = false, ?string $errorDetail = null): array
    {
        $m = mb_strtolower($message);

        if (str_contains($m, 'polisi') || str_contains($m, 'police') || str_contains($m, 'curi') || str_contains($m, 'theft') || str_contains($m, 'copet') || str_contains($m, 'hilang')) {
            $reply = "🚨 **Bantuan Polisi & Kriminalitas Bali:**\n"
                . "• Call Center Polisi: **110** (24 Jam)\n"
                . "• Layanan Darurat Bebas Pulsa: **112**\n"
                . "• Tourist Police Polda Bali: **+62 361 224111** / **+62 361 754599**\n"
                . "• Buat pengaduan resmi via menu **Lapor Insiden** untuk lacak penanganan.";
        } elseif (str_contains($m, 'rumah sakit') || str_contains($m, 'hospital') || str_contains($m, 'dokter') || str_contains($m, 'medis') || str_contains($m, 'ambulans') || str_contains($m, 'ambulance') || str_contains($m, 'rabies') || str_contains($m, 'anjing')) {
            $reply = "🏥 **Kontak Medis & Rujukan Rabies Bali:**\n"
                . "• Panggilan Ambulans: **118** atau **119**\n"
                . "• **RSUP Ngoerah (Sanglah):** **+62 361 227911** (Pusat Rujukan & Vaksin Rabies VAR)\n"
                . "• **BIMC Hospital Kuta (UGD 24 Jam):** **+62 361 761263**\n"
                . "• **Siloam Hospitals Sunset Road:** **+62 361 779900**\n"
                . "• **RS Ari Canti Ubud:** **+62 361 974573**";
        } elseif (str_contains($m, 'pantai') || str_contains($m, 'ombak') || str_contains($m, 'beach') || str_contains($m, 'tenggelam') || str_contains($m, 'berenang') || str_contains($m, 'sar')) {
            $reply = "🌊 **Keselamatan Pantai & Laut Bali:**\n"
                . "• **BASARNAS Bali (SAR Laut):** **115** atau **+62 361 705538**\n"
                . "• **Bendera Merah:** DILARANG BERENANG (arus rip current berbahaya!)\n"
                . "• **Bendera Merah-Kuning:** Zona aman berenang pantauan Balawista\n"
                . "• Sengatan ubur-ubur: Bilas segera dengan cuka (*vinegar*).";
        } elseif (str_contains($m, 'motor') || str_contains($m, 'scooter') || str_contains($m, 'helm') || str_contains($m, 'sim') || str_contains($m, 'rental')) {
            $reply = "🛵 **Aturan Sewa Motor di Bali (Perda 2/2024):**\n"
                . "• Wajib memakai helm standar SNI setiap saat\n"
                . "• Wajib memiliki SIM Internasional (IDP) yang berlaku\n"
                . "• Berpakaian sopan (dilarang tanpa busana atas di jalan umum)\n"
                . "• Sewa hanya dari penyedia resmi berizin.";
        } elseif (str_contains($m, 'pura') || str_contains($m, 'temple') || str_contains($m, 'sarong') || str_contains($m, 'adat')) {
            $reply = "🛕 **Etika Tempat Suci (Pura) Bali:**\n"
                . "• Wajib kenakan kain kamen/sarong & selendang terikat di pinggang\n"
                . "• Dilarang masuk bagi wanita yang sedang datang bulan (cuntaka)\n"
                . "• Dilarang memanjat pohon suci atau menduduki pelinggih/patung\n"
                . "• Jangan melangkahi sesajen (*canang sari*) di tanah.";
        } else {
            $reply = "🛡️ **BaliGuard AI Assistant (Hemat Token):**\n"
                . "• Panggilan Darurat Terpadu: **112** (Bebas Pulsa)\n"
                . "• Polisi: **110** | Tourist Police: **+62 361 224111**\n"
                . "• Ambulans: **118** | SAR Laut: **115**\n"
                . "• RS Rujukan Utama: **BIMC Kuta** & **RSUP Sanglah**\n"
                . "Ketik pertanyaan spesifik (cth: *'Nomor polisi di Kuta'*, *'RS Ubud'*).";
        }

        $note = "";
        if (!$this->isConfigured()) {
            $note = "\n\n💡 _Mode knowledge base aktif. Atur `GEMINI_API_KEY` di Vercel Project Settings > Environment Variables, lalu redeploy untuk mengaktifkan Gemini._";
        }

        return [
            'success' => true,
            'message' => $reply . $note,
            'source' => $hadError ? 'fallback-error' : 'intelligent-kb',
            'model' => 'BaliGuard-TokenEfficient',
            'tokens_optimized' => true,
        ];
    }
}
