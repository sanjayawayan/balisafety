# BaliGuard - Sistem Keselamatan & Perlindungan Wisatawan Terpadu Bali
*(Integrated Bali Tourist Safety, Early Warning & Emergency Response System with Google Gemini AI Chatbot)*

Platform resmi berbasis web responsif yang dirancang untuk mendukung keamanan, keselamatan, dan kenyamanan wisatawan di Pulau Bali (merujuk pada inisiatif BaliGuard Dinas Pariwisata Provinsi Bali & Kertha Jaya).

---

## 🌟 Fitur Utama Sistem

### 1. 🚨 Tombol Darurat SOS Cepat (Panic Button 24/7)
- **Geolokasi Otomatis:** Mendeteksi koordinat GPS satelit wisatawan secara langsung (`navigator.geolocation`).
- **Kategori Darurat:** Medis/Ambulans, Tindak Kriminal/Polisi, Penyelamatan Laut/SAR (Balawista), Bencana Alam, dan Pelecehan.
- **Sistem Tiket Sinyal Darurat:** Menghasilkan kode tiket darurat unik (cth: `SOS-20261106-XXXX`) yang otomatis diarahkan ke Pusat Komando BaliGuard dan pos siaga terdekat.
- **Panggilan Satu Ketukan (Direct Hotlines):** 112 (Bebas Pulsa), 110 (Polisi), 118/119 (Ambulans), 115 (BASARNAS), dan Tourist Police Polda Bali (`+62 361 224111`).

### 2. 🤖 Chatbot AI Keselamatan Terintegrasi Google Gemini
- **Ditenagai Google Gemini:** Menggunakan model `gemini-1.5-flash` melalui REST API resmi Google AI Studio.
- **Trained Knowledge Base Bali:** Dilengkapi pemahaman mendalam tentang tata tertib Pura (Perda Bali No. 2/2024), aturan sewa motor & helm, penanganan gigitan anjing/kera (Rabies) & faskes rujukan VAR, lokasi RS standar internasional (BIMC, Siloam, Sanglah), serta mitigasi arus laut (*rip current*).
- **Multibahasa:** Merespons secara otomatis dalam bahasa wisatawan (Bahasa Indonesia, Inggris, Rusia, Mandarin, dll.).
- **Fallback Simulator Pintar:** Sistem tetap berfungsi optimal memberikan jawaban akurat meskipun API Key belum diisi atau saat offline.

### 3. 📋 Sistem Pelaporan Insiden & Pelacakan (Tracking)
- **Formulir Pengaduan Online:** Formulir terstruktur dengan unggah bukti foto, kategori kejadian, data identitas (KTP/Paspor), dan titik lokasi.
- **Kode Pelacakan Unik:** Setiap laporan menerbitkan kode unik (cth: `BG-26-8841A`).
- **Live Progress Timeline 4 Tahap:**
  1. *Laporan Masuk* &rarr; 2. *Verifikasi Petugas* &rarr; 3. *Tindakan Lapangan* &rarr; 4. *Kasus Selesai*.
- Transparansi catatan petugas dan instansi penanggung jawab.

### 4. 🗺️ Peta Interaktif Keamanan & Fasilitas (Interactive Safety Map)
- Didukung peta Leaflet.js yang responsif di smartphone maupun desktop.
- Menampilkan lokasi:
  - Pos Polisi & Polisi Pariwisata (Kuta, Seminyak, Canggu, Ubud, Denpasar).
  - Rumah Sakit Internasional & Pusat Rujukan Rabies (BIMC, Siloam, RSUP Sanglah).
  - Pos Penjaga Pantai / Lifeguard Balawista (Kuta, Echo Beach, dll.).
  - Zona Waspada Arus Ombak (Pantai Kelingking Nusa Penida, Double Six Seminyak).
- Filter kategori titik dan fitur deteksi lokasi pengguna.

### 5. 🛕 Panduan Tata Tertib Resmi Wisatawan (Do's & Don'ts)
- Ringkasan Peraturan Daerah (Perda) No. 2 Tahun 2024 & Surat Edaran Gubernur Bali.
- Etika berpakaian kain kamen/sarong di Pura dan larangan masuk bagi masa cuntaka.
- Tata tertib berlalu lintas: wajib helm SNI, SIM Internasional, larangan berkendara tanpa busana.
- Panduan penukaran valuta asing di *Authorized Money Changer* berizin Bank Indonesia.

### 6. 🛡️ Pusat Komando & Dashboard Dispatcher (`/admin`)
- Ringkasan metrik statistik real-time (Total Kasus, Kasus Pending, Kasus Selesai, Sinyal SOS Aktif).
- Feed Live Sinyal Darurat SOS dengan tautan koordinat langsung ke Google Maps.
- Tabel manajemen laporan insiden dengan filter wilayah & kategori, serta pembaruan status dan penugasan instansi.
- Manajemen siaran peringatan dini BMKG (Early Warning System).

### 7. 📱 Desain Full Responsif (Mobile-First UX)
- Dioptimalkan untuk smartphone wisatawan dengan navigasi bawah (*bottom bar navigation*), modal SOS cepat, dan chat drawer yang adaptif.

---

## 🚀 Panduan Menjalankan Sistem

### Persyaratan Lingkungan
- **PHP:** Versi 8.2 atau lebih tinggi (sudah terpasang PHP 8.4)
- **Composer:** Versi 2.x (sudah terpasang Composer 2.11)
- **Database:** SQLite (file `database/database.sqlite` sudah terkonfigurasi otomatis)

### 1. Menjalankan Server Lokal
Di terminal direktori proyek:
```bash
php artisan serve
```
Server akan berjalan di: **http://127.0.0.1:8000**

### 2. Mengaktifkan Google Gemini Live API
Untuk menghubungkan Chatbot langsung ke Google Gemini:
1. Dapatkan API Key gratis di [Google AI Studio](https://aistudio.google.com/).
2. Buka file `.env` dan masukkan API Key:
   ```env
   GEMINI_API_KEY=AIzaSy...masukkan_api_key_anda_disini...
   GEMINI_MODEL=gemini-1.5-flash
   ```
3. Simpan file `.env`. Chatbot akan otomatis beralih ke mode **Gemini Live AI**.
*(Jika API key dikosongkan, chatbot tetap berjalan dengan basis pengetahuan lokal BaliGuard tanpa error).*

### 3. Akses Halaman Utama
- **Portal Wisatawan:** `http://127.0.0.1:8000/`
- **Peta Keamanan:** `http://127.0.0.1:8000/map`
- **Formulir Lapor Insiden:** `http://127.0.0.1:8000/report`
- **Lacak Laporan:** `http://127.0.0.1:8000/track/BG-26-9F3A7C12D4B65E81`
- **Tata Tertib & Do's & Don'ts:** `http://127.0.0.1:8000/guidelines`
- **Portal Dispatcher / Petugas:** `http://127.0.0.1:8000/admin`
- **Monitor SOS Live:** `http://127.0.0.1:8000/admin/sos`
- **Manajemen Insiden:** `http://127.0.0.1:8000/admin/incidents`
- **Peringatan Dini BMKG:** `http://127.0.0.1:8000/admin/warnings`

---

## 📁 Struktur Direktori Utama

```
balisafety/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php      # Portal beranda, peta, dan tata tertib
│   │   ├── SosController.php       # Handler sinyal darurat SOS & geolokasi
│   │   ├── IncidentController.php  # Pengaduan insiden & pelacakan
│   │   ├── ChatbotController.php   # API Chatbot Gemini & riwayat sesi
│   │   ├── AdminController.php     # Dashboard dispatcher & penugasan tim
│   │   └── WarningController.php   # Siaran peringatan dini BMKG
│   ├── Models/
│   │   ├── SosAlert.php            # Model tiket SOS
│   │   ├── IncidentReport.php      # Model laporan insiden
│   │   ├── WarningAlert.php        # Model peringatan dini
│   │   └── ChatMessage.php         # Model pesan chat AI
│   └── Services/
│       └── GeminiService.php       # Integrasi REST API Google Gemini & Prompt Grounding
├── database/
│   ├── migrations/                 # Migrasi tabel SOS, Insiden, Warnings, Chat
│   ├── seeders/                    # Data awal simulasi BaliGuard
│   └── database.sqlite             # Database SQLite lokal
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php           # Layout utama wisatawan responsif
│   │   └── admin.blade.php         # Layout pusat komando dispatcher
│   ├── components/
│   │   ├── sos-modal.blade.php     # Modal darurat SOS & deteksi GPS
│   │   └── chatbot.blade.php       # Widget & drawer AI Chatbot Gemini
│   ├── home.blade.php              # Beranda & status keamanan 9 kabupaten
│   ├── map.blade.php               # Peta faskes, pos polisi & zona waspada
│   ├── guidelines.blade.php        # Panduan Perda Do's & Don'ts
│   ├── report/
│   │   ├── create.blade.php        # Form laporan insiden
│   │   └── track.blade.php         # Pelacakan status 4 tahap
│   └── admin/
│       ├── dashboard.blade.php     # Ringkasan operasional
│       ├── sos.blade.php           # Pemantauan sinyal SOS live
│       ├── incidents.blade.php     # Pengelolaan berkas insiden
│       └── warnings.blade.php      # Publikasi peringatan dini
└── routes/
    ├── web.php                     # Rute aplikasi web
    └── api.php                     # Rute API eksternal
```

---
*Dikembangkan untuk keselamatan wisatawan dan keharmonisan budaya Pulau Dewata.*

## Deploy ke Vercel

Proyek ini memakai container Vercel dengan FrankenPHP dan PHP 8.4. Runtime container Vercel masih Beta. Database SQLite dan filesystem lokal tidak digunakan untuk data produksi.

1. Push repository ke GitHub, lalu import repository tersebut ke Vercel dengan root directory proyek ini.
2. Buat MySQL eksternal dan bucket Cloudflare R2 privat. Tambahkan environment variables berikut di Vercel:
  - `APP_KEY`: hasil `php artisan key:generate --show`; simpan hanya di Vercel.
  - `APP_URL`: URL deployment produksi.
  - `DB_CONNECTION=mysql`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
  - `FILESYSTEM_DISK=s3`, `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION=auto`, `AWS_BUCKET`, `AWS_ENDPOINT`, `AWS_USE_PATH_STYLE_ENDPOINT=true`.
  - `ADMIN_USERNAME` dan `ADMIN_PASSWORD` untuk Basic Auth pada `/admin`; gunakan password kuat.
  - `GEMINI_API_KEY` jika chatbot akan memakai Gemini.
3. Setelah environment variables database tersedia, jalankan `php artisan migrate --force` satu kali dari environment tepercaya yang dapat terhubung ke MySQL. Jangan jalankan migrasi saat container dimulai.
4. Deploy dari Vercel dan periksa endpoint `/up`. Lampiran disimpan privat di R2; halaman tracking publik hanya menampilkan progres laporan.

Jangan commit `.env`, kredensial database, key R2, `APP_KEY`, atau database SQLite lokal.
