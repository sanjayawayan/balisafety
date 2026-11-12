# BaliGuard - Sistem Keselamatan & Perlindungan Wisatawan Terpadu Bali

## Description
**BaliGuard** adalah platform web responsif terpadu (*mobile-first*) yang dirancang khusus untuk memperkuat keamanan, keselamatan, dan kenyamanan wisatawan mancanegara maupun nusantara selama berlibur di Pulau Bali. 

Mengintegrasikan tombol darurat sinyal SOS instan, formulir pelaporan insiden daring dengan pelacakan *real-time*, peta keselamatan interaktif fasilitas vital, dukungan multibahasa 4 bahasa internasional (**Bahasa Indonesia, English, 中文, 日本語**), arsitektur *Zero-Loss Incident Persistence*, serta asisten keselamatan cerdas berbasis **Google Gemini AI**, BaliGuard menjembatani kesenjangan koordinasi dan komunikasi cepat antara wisatawan dengan berbagai instansi garis depan: Polisi Pariwisata (*Polda Bali*), Badan Penyelamat Wisata Tirta (*Balawista*), Badan Penanggulangan Bencana Daerah (*BPBD Bali*), Satuan Keamanan Adat (*Pecalang*), dan jejaring fasilitas kesehatan rujukan internasional di Bali.

Platform ini dikembangkan merujuk pada tata kelola keamanan pariwisata daerah serta Peraturan Daerah (Perda) Provinsi Bali No. 2 Tahun 2024 tentang Tata Kelola Kepariwisataan Bali.

---

## Problem & Target User

### Permasalahan yang Dihadapi (Problem)
1. **Saluran Kontak Darurat yang Terpecah-pecah:** Saat mengalami situasi genting (kecelakaan lalu lintas sewa motor, gigitan hewan penular rabies seperti anjing/kera, arus pecah laut *rip current*, kehilangan dokumen paspor, penipuan valuta asing, atau tindak kriminalitas), wisatawan kerap bingung menentukan nomor darurat yang tepat serta kesulitan memberikan titik lokasi koordinat mereka secara akurat.
2. **Ketiadaan Sistem Dispatcher Terpadu Lintas Instansi:** Unit penanggap pertama di Bali (Polisi Pariwisata, Balawista penjaga pantai, unit ambulans rumah sakit, dan Pecalang satgas desa adat) beroperasi di pos masing-masing tanpa satu sistem koordinasi pelacakan tiket darurat terpusat.
3. **Kendala Bahasa & Ketidaktahuan Budaya:** Wisatawan mancanegara dari berbagai belahan dunia (Australia, Tiongkok, Jepang, Eropa) kerap menghadapi hambatan bahasa saat membutuhkan bantuan, memahami aturan kesucian Pura (*cuntaka*, busana kain kamen), serta mewaspadai penipuan di *money changer* liar tanpa izin Bank Indonesia.
4. **Data Laporan Sering Hilang di Lingkungan Cloud Serverless:** Pada sistem serverless modern tanpa database eksternal berbayar, instansiasi kontainer yang bersifat *ephemeral* rentan menghilangkan data laporan baru ketika kontainer di-*recycle*, sehingga nomor pelacakan menjadi *Not Found* dan admin tidak dapat menindaklanjuti.
5. **Minimnya Transparansi Perkembangan Kasus:** Wisatawan yang melapor sering kali tidak mengetahui apakah laporannya telah ditindaklanjuti atau instansi mana yang sedang bergerak ke tempat kejadian perkara (TKP).

### Pengguna Sasaran (Target User)
- **Wisatawan Mancanegara & Domestik:** Pengguna utama yang memerlukan akses tombol darurat cepat (SOS), pelaporan insiden daring, pelacakan berkas aduan, peta fasilitas kesehatan & pos pengamanan, serta konsultasi keselamatan 24 jam dalam 4 bahasa internasional dengan AI Google Gemini.
- **Petugas Dispatcher & Tim Reaksi Cepat (Pusdalops):** Petugas piket terpadu, Polisi Pariwisata, petugas Balawista, BPBD, dan Satgas Adat Pecalang yang mengelola panggilan darurat masuk dan memperbarui status penanganan laporan.
- **Dinas Pariwisata & Pemangku Kepentingan Daerah:** Otoritas pemerintah daerah untuk pemantauan tren keamanan pariwisata dan penyebaran peringatan dini BMKG.

---

## Key Features

### 1. 🚨 Tombol Darurat Cepat 24/7 (Panic SOS Button)
- **Deteksi Koordinat Satelit Otomatis:** Mendeteksi posisi lintang (*latitude*) dan bujur (*longitude*) pengguna secara akurat melalui browser Geolocation API tanpa perlu pengetikan manual.
- **Kategori Darurat Lengkap:** Pilihan satu ketukan untuk Darurat Medis/Ambulans, Kriminal/Polisi, Penyelamatan Laut/SAR (Balawista), Bencana Alam, dan Pelecehan.
- **Tiket Sinyal Darurat Unik:** Menerbitkan nomor tiket darurat instan (cth: `SOS-20261112-9A12`) yang langsung masuk ke radar pemantauan Pusat Komando.
- **Panggilan Satu Ketukan (Direct Hotlines):** Akses cepat langsung menelepon 112 (Bebas Pulsa), 110 (Polisi), 118/119 (Ambulans), 115 (BASARNAS), dan Call Center Tourist Police Polda Bali (`+62 361 224111`).

### 2. 📋 Formulir Pengaduan Insiden & Pelacakan Live 4 Tahap
- **Formulir Pengaduan Terstruktur (`/report`):** Pengisian data identitas (KTP/Paspor), kabupaten kejadian, kategori insiden, waktu kronologi, deskripsi terperinci, dan tombol kunci koordinat GPS otomatis.
- **Kode Pelacakan Resmi Unik:** Menerbitkan kode pelacakan resmi (cth: `BG-26-8841A`).
- **Timeline Progres Live 4 Tahap (`/track/{code}`):**
  1. *Laporan Masuk (Submitted)* &rarr; 2. *Verifikasi Berkas (Under Investigation)* &rarr; 3. *Tindakan Lapangan (In Action)* &rarr; 4. *Selesai Ditangani (Resolved)*.
- **Transparansi Penanganan:** Menampilkan instansi penanggung jawab yang ditugaskan (cth: *Polsek Kuta Utara & Pecalang Canggu*) serta catatan resmi perkembangan penyelidikan petugas lapangan.
- **Riwayat Laporan Pengguna:** Menampilkan daftar laporan terakhir yang pernah dikirimkan dari perangkat pengguna sehingga pelacakan dapat dibuka kembali hanya dengan satu klik.

### 3. 🌐 Dukungan Penuh Multi-Bahasa (ID, EN, ZH, JA)
- **4 Bahasa Utama Internasional:**
  - 🇮🇩 **Bahasa Indonesia (`id`)**: Bahasa default resmi pemerintah daerah Bali.
  - 🇬🇧 **English (`en`)**: Bahasa internasional untuk wisatawan Australia, Eropa, dan Amerika.
  - 🇨🇳 **简体中文 (`zh`)**: Bahasa Mandarin untuk wisatawan Tiongkok & Asia Timur.
  - 🇯🇵 **日本語 (`ja`)**: Bahasa Jepang untuk komunitas wisatawan Jepang.
- **Peralihan Bahasa Instan:** Tersedia tombol bendera di bilah status atas, dropdown header, dan rute instan `/lang/{locale}` dengan persistensi via cookie `baliguard_locale` dan session.
- **Cakupan Terjemahan Menyeluruh:** Meliputi Navigasi, Hero, Status BMKG & Indeks Pariwisata, Formulir Laporan, 4 Tahapan Pelacakan, Modal Panggilan SOS, serta Prompt Cepat Chatbot AI.

### 4. 🔒 Arsitektur Zero-Loss Incident Persistence & Auto-Recovery
- **Sinkronisasi Multi-Lapisan:** Setiap laporan disimpan ke database SQLite, dicadangkan ke file registri kontainer `storage/app/reports_storage.json`, serta disinkronkan ke shared cloud key-value store secara *real-time*.
- **Auto-Hydration di Admin & Tracking:** Ketika halaman `/admin`, `/admin/incidents`, atau `/track/{code}` dibuka oleh siapapun di container mana pun, sistem secara otomatis menghidrasi dan memulihkan semua laporan ke SQLite.
- **Client-Side Vault & Auto-Recovery:** Browser pengguna menyimpan data laporan di cookie `baliguard_my_reports` dan `localStorage`. Jika serverless container baru dinyalakan (*cold start*), data otomatis dipulihkan ke server melalui endpoint sinkronisasi `/api/incidents/sync`.

### 5. 🤖 Chatbot AI Keselamatan Terpadu Google Gemini
- **Ditenagai Google Gemini AI:** Memanfaatkan model resmi `gemini-3.5-flash-lite` melalui antarmuka REST API Google AI Studio.
- **Knowledge Base Khusus Keselamatan Bali:** Dilengkapi pemahaman mendalam mengenai tata tertib kawasan Pura (Perda Bali No. 2/2024), protokol penanganan gigitan anjing/kera dan faskes rujukan Vaksin Anti Rabies / VAR (RSUP Prof. Ngoerah/Sanglah, BIMC, Siloam), zona bahaya arus pecah (*rip current*), aturan legal sewa sepeda motor & helm SNI, dan ciri *money changer* resmi berizin Bank Indonesia.
- **Multibahasa Otomatis:** Merespons secara luwes dalam Bahasa Indonesia, Inggris, Mandarin, Jepang, Rusia, Jerman, Prancis, dan bahasa internasional lainnya.
- **Simulator Cerdas Tanpa Kuota / Offline (Fallback):** Jika API key tidak diisi atau terjadi gangguan internet, sistem otomatis beralih ke pencocok maksud heuristik (*intent matcher*) lokal berpengetahuan Bali tanpa menimbulkan error.

### 6. 🗺️ Peta Interaktif Fasilitas Keamanan & Pos Vital (`/map`)
- **Berbasis Leaflet.js & OpenStreetMap:** Ringan, interaktif, dan mulus dibuka pada smartphone wisatawan.
- **Titik Fasilitas Vital 9 Kabupaten:** Menampilkan Rumah Sakit Standar Internasional & Faskes Rujukan Rabies, Pos Polisi 24 Jam & Polisi Pariwisata, Menara Pengawas Lifeguard Balawista, serta Zona Rawan Ombak (Pantai Kelingking Nusa Penida, Double Six Seminyak).
- **Fitur Lokasi Pengguna:** Tombol penunjuk posisi pengguna saat ini secara instan di atas peta.

### 7. 🛕 Panduan Resmi Tata Krama & Do's and Don'ts (`/guidelines`)
- Rangkuman aturan resmi Perda Provinsi Bali No. 2 Tahun 2024.
- Etika busana adat kain kamen/sarong di tempat suci serta larangan masuk saat masa berduka/haid (*cuntaka*).
- Tata tertib berlalu lintas: kewajiban helm SNI, SIM Internasional, larangan berkendara tanpa pakaian pantas.
- Kiat aman bertransaksi valas di *Authorized Money Changer* berlogo resmi Bank Indonesia (PVA Berizin).

### 8. 🛡️ Pusat Komando & Dashboard Dispatcher Petugas (`/admin`)
- **Metrik Statistik Real-Time:** Total Kasus, Kasus Menunggu, Kasus Tuntas, dan Sinyal SOS Aktif yang membutuhkan respons.
- **Radar Pantauan SOS Live:** Tautan langsung membuka titik koordinat di Google Maps serta form penugasan unit reaksi cepat.
- **Pengelolaan Berkas Insiden:** Filter status dan wilayah kabupaten, penugasan instansi mitra, dan pengisian catatan hasil tindakan lapangan.
- **Publikasi Peringatan BMKG:** Penambahan dan penonaktifan siaran bahaya gelombang tinggi laut dan cuaca ekstrem secara langsung.
- **Otentikasi Aman Petugas (`/admin/login`):** Dilengkapi sistem login berbasis sesi, proteksi reverse proxy HTTPS, dan tombol logout.

### 9. 📱 Kompatibilitas Penuh HP & PC (Dual Redundant CDN)
- Seluruh ikon menggunakan **Font Awesome 6 Free** standar yang kompatibel 100% pada semua peramban seluler (iOS Safari, Android Chrome, Samsung Internet) dan desktop (Chrome, Firefox, Edge, Safari, Opera).
- Dilengkapi **Dual Redundant CDN** (*cdnjs* + *jsdelivr*) untuk menjamin ikon dan aset visual selalu termuat tanpa ada kotak kosong `[ ]`.

---

## Tech Stack

| Komponen | Teknologi yang Digunakan |
|---|---|
| **Backend Framework** | PHP 8.4, Laravel 11 |
| **Web Server & Runtime** | FrankenPHP (Caddy Go Web Server), PHP-FPM / Worker Mode |
| **Database & ORM** | SQLite (dilengkapi auto-sync cloud, migrasi otomatis & seeder idempotent; siap MySQL) |
| **Persistensi Data** | Multi-Tier Persistence (SQLite + Cloud KV Sync + JSON Backup + Cookie Vault) |
| **Frontend & UI/UX** | Blade Templating Engine, Tailwind CSS, Dual CDN Font Awesome 6 Icons |
| **Multibahasa** | Custom SetLocale Middleware & Kamus Terjemahan Komprehensif (ID, EN, ZH, JA) |
| **Peta & Geolokasi** | Leaflet.js, OpenStreetMap Cartography, HTML5 Geolocation API |
| **Kecerdasan Buatan (AI)** | Google Gemini API (`gemini-3.5-flash-lite`) via Google AI Studio |
| **Kontainerisasi** | Docker (Multi-stage build OCI compliant, eksekusi non-root `www-data`) |
| **Cloud Hosting & CI/CD** | Vercel (Fluid Compute OCI Container Runtime), GitHub Integration |

---

## AI Implementation

BaliGuard mengintegrasikan **Google Gemini AI** sebagai pendamping keselamatan virtual wisatawan selama 24 jam penuh:

```
[Pengguna Mengirim Pesan di Widget Chatbot]
                       │
                       ▼
       [ChatbotController & GeminiService]
                       │
                       ├─► 1. Domain Grounding Prompt Injection
                       │      - Aturan Perda No. 2/2024 (Kawasan suci Pura, tata busana, larangan cuntaka)
                       │      - Protokol Penanganan Gigitan Hewan / Rabies (Faskes VAR: Sanglah, BIMC, Siloam)
                       │      - Keselamatan Laut (Arus rip current, kepatuhan bendera merah Balawista)
                       │      - Nomor Darurat Resmi (112, 110, 115, Balawista, Tourist Police)
                       │      - Ketentuan Money Changer Berizin Bank Indonesia (Logo PVA)
                       │
                       ├─► 2. Deteksi Bahasa Pengguna Otomatis (ID, EN, ZH, JA, dll.)
                       │
                       ├─► 3. Komunikasi REST API ke Google AI Studio (gemini-3.5-flash-lite)
                       │
                       └─► 4. Fallback Heuristik Lokal Cerdas (Jika Offline / Tanpa API Key)
                              - Otomatis aktif saat koneksi API terputus atau kunci belum dipasang
                              - Menjamin layanan tetap aktif tanpa downtime dan memberikan jawaban akurat
```

- **Safety Guardrails & Boundaries:** Chatbot dilengkapi instruksi sistem ketat untuk hanya merespons topik keamanan, kesehatan, tata tertib, dan navigasi darurat di Bali. Pada kondisi kritis darurat medis/kejahatan aktif, asisten secara eksplisit memandu wisatawan untuk menekan tombol merah SOS atau menghubungi nomor 112.
- **Manajemen Riwayat Sesi:** Mempertahankan histori percakapan terkini dalam sesi agar dialog tanya-jawab berjalan secara kontekstual dan natural.

---

## Architecture / Data Flow

```mermaid
flowchart TD
    subgraph Clients["Pengguna & Admin (Smartphone / Laptop)"]
        T["Wisatawan (ID / EN / ZH / JA)"]
        A["Petugas Dispatcher (Pusat Komando)"]
    end

    subgraph ClientStorage["Client Vault Storage"]
        Cookie["Encrypted Session Cookie & baliguard_my_reports"]
        LocalStore["Browser LocalStorage (Auto-Recovery Vault)"]
    end

    subgraph Edge["Jaringan Hosting (Vercel)"]
        V["Vercel Edge Network / Reverse Proxy (HTTPS)"]
    end

    subgraph Container["FrankenPHP Container Runtime (PHP 8.4)"]
        Caddy["FrankenPHP / Caddy Server (:80)"]
        LocaleMW["SetLocale Middleware (ID, EN, ZH, JA Detection)"]
        Kernel["Laravel 11 HTTP Kernel & TrustProxies"]
        
        subgraph Services["Layanan & Utilitas"]
            PersistSvc["IncidentPersistenceService (Zero-Loss Engine)"]
            TransSvc["TranslationService & __t() Dictionary"]
            GeminiSvc["GeminiService (AI Inference & Local Fallback)"]
        end

        subgraph Controllers["Lapisan Logika Aplikasi"]
            HomeCtrl["HomeController (Beranda, Peta, Panduan Perda)"]
            SosCtrl["SosController (API SOS & Geolokasi Satelit)"]
            IncCtrl["IncidentController (Pelaporan, Tracking, Sync API)"]
            ChatCtrl["ChatbotController (Interaksi AI Gemini)"]
            AdmCtrl["AdminController & WarningController"]
        end

        subgraph LocalStorage["Penyimpanan Lokal Kontainer"]
            SQLite[("Database SQLite (/tmp/balisafety.sqlite)")]
            BackupFile["Registry JSON (storage/app/reports_storage.json)"]
        end
    end

    subgraph External["Layanan Cloud & Eksternal"]
        CloudKV["Shared Cloud Key-Value Store (Auto-Sync)"]
        Gemini["Google Gemini AI REST API"]
        OSM["Tile Peta OpenStreetMap & Leaflet"]
        Hotlines["Hotline Darurat Telepon (112, 110, Balawista)"]
    end

    T -->|"Permintaan Akses HTTPS"| V
    A -->|"Akses Pusat Komando HTTPS"| V
    V -->|"Port 80 Ingress"| Caddy
    Caddy --> LocaleMW
    LocaleMW --> Kernel
    Kernel --> HomeCtrl
    Kernel --> SosCtrl
    Kernel --> IncCtrl
    Kernel --> ChatCtrl
    Kernel --> AdmCtrl

    IncCtrl <-->|"1. Catat ke SQLite"| SQLite
    IncCtrl <-->|"2. Cadangkan ke File"| BackupFile
    PersistSvc <-->|"3. Sinkronisasi Real-Time"| CloudKV
    IncCtrl <-->|"4. Simpan Riwayat di Browser"| Cookie
    IncCtrl <-->|"5. Auto-Recovery jika Perlu"| LocalStore
    AdmCtrl <-->|"Hydrate Semua Laporan saat Buka Dashboard"| PersistSvc

    SosCtrl <-->|"Simpan / Baca Tiket SOS"| SQLite
    ChatCtrl <-->|"Prompt & Respons AI Multibahasa"| Gemini
    HomeCtrl -->|"Render Titik Koordinat Peta"| OSM
    SosCtrl -.->|"Tautan Panggilan Cepat"| Hotlines
```

---

## Installation / Run Instructions

### Prasyarat Sistem
- **PHP:** Versi 8.2 atau lebih baru (PHP 8.3 / 8.4 direkomendasikan)
- **Composer:** Versi 2.x
- **Ekstensi PHP Aktif:** `pdo_sqlite`, `curl`, `mbstring`, `intl`, `zip`

### Langkah Menjalankan di Lingkungan Lokal (Localhost)

1. **Clone repository dari GitHub:**
   ```bash
   git clone https://github.com/sanjayawayan/balisafety.git
   cd balisafety
   ```

2. **Pasang dependensi pustaka PHP:**
   ```bash
   composer install
   ```

3. **Konfigurasi file environment (`.env`):**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Siapkan database SQLite dan data simulasi:**
   ```bash
   touch database/database.sqlite
   php artisan migrate --seed
   ```

5. **Konfigurasi Google Gemini AI (Opsional):**
   Dapatkan API Key gratis di [Google AI Studio](https://aistudio.google.com/) lalu masukkan ke dalam file `.env`:
   ```env
   GEMINI_API_KEY=AIzaSy...masukkan_api_key_gemini_anda...
   GEMINI_MODEL=gemini-3.5-flash-lite
   ```
   *(Jika dikosongkan, fitur chatbot tetap berfungsi penuh dengan simulator basis pengetahuan lokal BaliGuard tanpa error).*

6. **Jalankan server aplikasi lokal:**
   ```bash
   php artisan serve
   ```
   Buka peramban pada alamat: **`http://127.0.0.1:8000`**

---

## Deployment URL

- **URL Aplikasi Utama (Produksi):** [https://balisafety.vercel.app](https://balisafety.vercel.app)
- **Bahasa Indonesia:** [https://balisafety.vercel.app/?lang=id](https://balisafety.vercel.app/?lang=id)
- **English:** [https://balisafety.vercel.app/?lang=en](https://balisafety.vercel.app/?lang=en)
- **简体中文 (Mandarin):** [https://balisafety.vercel.app/?lang=zh](https://balisafety.vercel.app/?lang=zh)
- **日本語 (Japanese):** [https://balisafety.vercel.app/?lang=ja](https://balisafety.vercel.app/?lang=ja)
- **Formulir Lapor Insiden:** [https://balisafety.vercel.app/report](https://balisafety.vercel.app/report)
- **Contoh Pelacakan Kasus (Live):** [https://balisafety.vercel.app/track/BG-26-8841A](https://balisafety.vercel.app/track/BG-26-8841A)
- **Peta Interaktif Keamanan:** [https://balisafety.vercel.app/map](https://balisafety.vercel.app/map)
- **Panduan Tata Tertib & Perda:** [https://balisafety.vercel.app/guidelines](https://balisafety.vercel.app/guidelines)
- **Login Pusat Komando / Admin:** [https://balisafety.vercel.app/admin/login](https://balisafety.vercel.app/admin/login)

---

## Demo Account (jika diperlukan - jangan simpan password sensitif di public repo)

Untuk keperluan penilaian juri dan evaluasi fitur Pusat Komando & Dispatcher:

- **Halaman Login:** [https://balisafety.vercel.app/admin/login](https://balisafety.vercel.app/admin/login)
- **Username:** `admin`
- **Password:** `baliguard2026`
- **Peran Akun:** Petugas Piket Terpadu Pusdalops BaliGuard

> [!NOTE]
> Pada lingkungan produksi sesungguhnya, kredensial ini dapat diubah kapan saja secara aman tanpa mengubah kode program melalui variabel lingkungan `ADMIN_USERNAME` dan `ADMIN_PASSWORD` pada panel pengaturan hosting Vercel.

---

## Known Limitations

1. **Sinkronisasi Serverless Kontainer:** Pada lingkungan serverless Vercel, kontainer bersifat *stateless*. BaliGuard telah mengatasi hal ini dengan **Zero-Loss Multi-Tier Persistence Engine** (SQLite + Cloud Key-Value Sync + Backup File Kontainer + Browser Cookie/LocalStorage Vault) sehingga laporan insiden tidak hilang. Namun, untuk skala enterprise dengan jutaan rekaman riwayat transaksi, disarankan menyambungkan ke klaster database relasional terkelola (seperti Supabase PostgreSQL atau AWS RDS MySQL).
2. **Izin Geolokasi Peramban:** Fitur kunci titik koordinat GPS otomatis bergantung pada persetujuan izin geolokasi pada peramban perangkat wisatawan. Apabila izin ditolak, sistem menyediakan pengisian patokan alamat manual.
3. **Batas Kuota AI Gratis (Rate Limits):** Paket gratis Google Gemini API memiliki batasan frekuensi panggilan (*Rate Limits*). Ketika kuota API tercapai, sistem BaliGuard secara mulus mengalihkan respons ke mesin heuristik lokal agar panduan keselamatan wisatawan tidak terputus.

---

## Third-party Resources / Credits

- **Google Gemini API:** Mesin kecerdasan buatan generatif dan pemrosesan bahasa alami multibahasa.
- **Leaflet.js & OpenStreetMap:** Pustaka dan peta kartografi interaktif sumber terbuka (*open-source*).
- **Tailwind CSS & Font Awesome 6 (Dual CDN):** Kerangka kerja tata letak antarmuka dan paket ikon vektor modern.
- **FrankenPHP:** Server aplikasi web PHP modern berkinerja tinggi berbasis Go buatan Kévin Dunglas.
- **Dinas Pariwisata Provinsi Bali & Satpol PP Pariwisata:** Rujukan kebijakan Perda Provinsi Bali No. 2 Tahun 2024.
- **Balawista Badung, Polda Bali, & BMKG Wilayah III Denpasar:** Rujukan parameter keselamatan pesisir laut dan tanggap darurat kepolisian.

---

## Team Member
1. **I Putu Nayaka Widhyadana**
2. **I Wayan Karang Sanjaya**
