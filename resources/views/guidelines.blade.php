@extends('layouts.app')

@section('title', 'Tata Tertib & Panduan Wisatawan Bali - BaliGuard')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-xs text-slate-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-amber-600">Beranda</a>
        <span>&bull;</span>
        <span class="text-slate-800 font-semibold">Tata Tertib Wisatawan</span>
    </nav>

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white rounded-3xl p-6 sm:p-10 border border-slate-800 shadow-xl mb-10">
        <div class="max-w-3xl space-y-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30 uppercase tracking-widest">
                <i class="fa-solid fa-scale-balanced mr-1.5"></i> Perda Provinsi Bali No. 2 Tahun 2024
            </span>
            <h1 class="text-2xl sm:text-4xl font-extrabold text-white font-serif leading-tight">
                Panduan Tata Tertib Resmi Wisatawan di Pulau Bali
            </h1>
            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                Pemerintah Provinsi Bali bersama Majelis Desa Adat dan Kepolisian Daerah Bali menetapkan pedoman etika, keselamatan berwisata, dan hukum positif demi menjaga kesucian alam, manusia, dan kebudayaan Bali (*Sad Kerthi Loka Bali*).
            </p>
        </div>
    </div>

    <!-- Quick Filter Tabs -->
    <div class="flex items-center space-x-2 overflow-x-auto pb-4 mb-8 text-xs font-bold scrollbar-none">
        <button onclick="filterGuideline('all')" class="tab-btn px-4 py-2 rounded-xl bg-slate-900 text-white shadow-sm transition">Semua Tata Tertib</button>
        <button onclick="filterGuideline('temple')" class="tab-btn px-4 py-2 rounded-xl bg-white text-slate-700 border border-slate-300 hover:bg-slate-100 transition">Tempat Suci & Pura</button>
        <button onclick="filterGuideline('traffic')" class="tab-btn px-4 py-2 rounded-xl bg-white text-slate-700 border border-slate-300 hover:bg-slate-100 transition">Lalu Lintas & Motor</button>
        <button onclick="filterGuideline('beach')" class="tab-btn px-4 py-2 rounded-xl bg-white text-slate-700 border border-slate-300 hover:bg-slate-100 transition">Pantai & Laut</button>
        <button onclick="filterGuideline('money')" class="tab-btn px-4 py-2 rounded-xl bg-white text-slate-700 border border-slate-300 hover:bg-slate-100 transition">Valas & Uang</button>
        <button onclick="filterGuideline('health')" class="tab-btn px-4 py-2 rounded-xl bg-white text-slate-700 border border-slate-300 hover:bg-slate-100 transition">Kesehatan & Rabies</button>
    </div>

    <!-- Guideline Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="guidelinesContainer">
        
        <!-- Card 1: Pura & Kesucian Tempat Ibadah -->
        <div class="guideline-card bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition space-y-4" data-category="temple">
            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-place-of-worship"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-amber-600 uppercase tracking-widest">Kawasan Suci</span>
                    <h3 class="text-base font-extrabold text-slate-900">Etika Mengunjungi Tempat Suci (Pura)</h3>
                </div>
            </div>
            <ul class="text-xs sm:text-sm text-slate-700 space-y-2.5">
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-check text-emerald-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Pakaian Sopan:</strong> Wajib memakai kain kamen/sarong dan selendang (*senteng*) yang terikat rapi di pinggang.</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-xmark text-red-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Masa Cuntaka:</strong> Dilarang masuk ke area utama (*jeroan*) Pura bagi wanita yang sedang datang bulan (menstruasi).</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-xmark text-red-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Pohon Suci & Bangunan:</strong> Dilarang keras memanjat pohon keramat (seperti pohon beringin pura) atau berpose tidak sopan di pelinggih.</span>
                </li>
            </ul>
        </div>

        <!-- Card 2: Lalu Lintas & Sewa Motor -->
        <div class="guideline-card bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition space-y-4" data-category="traffic">
            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-motorcycle"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">Transportasi</span>
                    <h3 class="text-base font-extrabold text-slate-900">Lalu Lintas & Sewa Sepeda Motor</h3>
                </div>
            </div>
            <ul class="text-xs sm:text-sm text-slate-700 space-y-2.5">
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-check text-emerald-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Helm SNI:</strong> Wajib memakai helm keselamatan standar SNI untuk pengemudi dan pembonceng setiap saat.</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-check text-emerald-600 mt-1 flex-shrink-0"></i>
                    <span><strong>SIM Internasional:</strong> Wisatawan asing wajib memiliki International Driving Permit (IDP) yang masih berlaku.</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-xmark text-red-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Berpakaian Layak:</strong> Dilarang berkendara tanpa busana atas atau hanya mengenakan bikini di jalan raya umum.</span>
                </li>
            </ul>
        </div>

        <!-- Card 3: Pantai & Laut -->
        <div class="guideline-card bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition space-y-4" data-category="beach">
            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-water"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-cyan-600 uppercase tracking-widest">Aktivitas Bahari</span>
                    <h3 class="text-base font-extrabold text-slate-900">Keselamatan Pantai & Bendera Balawista</h3>
                </div>
            </div>
            <ul class="text-xs sm:text-sm text-slate-700 space-y-2.5">
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-flag text-red-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Bendera Merah:</strong> DILARANG KERAS berenang! Titik arus pusaran rip current yang berbahaya.</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-flag text-amber-500 mt-1 flex-shrink-0"></i>
                    <span><strong>Bendera Merah-Kuning:</strong> Area aman berenang yang diawasi oleh petugas penjaga pantai Balawista.</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-shield-virus text-purple-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Ubur-ubur:</strong> Jika tersengat, basuh segera dengan air cuka (*vinegar*) dan hubungi pos Balawista.</span>
                </li>
            </ul>
        </div>

        <!-- Card 4: Penukaran Uang Valas -->
        <div class="guideline-card bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition space-y-4" data-category="money">
            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Keuangan Aman</span>
                    <h3 class="text-base font-extrabold text-slate-900">Penukaran Valas & Transaksi Resmi</h3>
                </div>
            </div>
            <ul class="text-xs sm:text-sm text-slate-700 space-y-2.5">
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-check text-emerald-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Authorized Money Changer:</strong> Pastikan tempat penukaran uang memiliki logo resmi Bank Indonesia dan sertifikat PVA Berizin.</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-xmark text-red-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Hindari Rate Tak Wajar:</strong> Waspada terhadap kios money changer pinggir jalan yang menawarkan kurs jauh di atas rata-rata pasar.</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-calculator text-blue-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Hitung Ulang di Tempat:</strong> Selalu hitung kembali lembaran uang rupiah di depan kasir sebelum meninggalkan loket.</span>
                </li>
            </ul>
        </div>

        <!-- Card 5: Kesehatan & Rabies -->
        <div class="guideline-card bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition space-y-4" data-category="health">
            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-rose-600 uppercase tracking-widest">Kesehatan</span>
                    <h3 class="text-base font-extrabold text-slate-900">Kesehatan Wisatawan & Pencegahan Rabies</h3>
                </div>
            </div>
            <ul class="text-xs sm:text-sm text-slate-700 space-y-2.5">
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-soap text-blue-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Cuci Luka Gigitan Hewan:</strong> Jika digigit anjing/kera, segera cuci luka dengan sabun dan air mengalir selama 15 menit.</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-syringe text-emerald-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Vaksin Anti Rabies (VAR):</strong> Segera datangi Rabies Center di RSUP Sanglah, BIMC, atau RSUD terdekat untuk suntik VAR/SAR.</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-shield text-amber-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Asuransi Perjalanan:</strong> Pastikan asuransi Anda mencakup evakuasi darurat dan rawat inap rumah sakit internasional.</span>
                </li>
            </ul>
        </div>

        <!-- Card 6: Hukum & Adat Pecalang -->
        <div class="guideline-card bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition space-y-4" data-category="temple">
            <div class="flex items-center space-x-3 pb-3 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-users-viewfinder"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-purple-600 uppercase tracking-widest">Keharmonisan Desa Adat</span>
                    <h3 class="text-base font-extrabold text-slate-900">Peran Pecalang & Ketertiban Desa</h3>
                </div>
            </div>
            <ul class="text-xs sm:text-sm text-slate-700 space-y-2.5">
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-check text-emerald-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Patuhi Pecalang:</strong> Hormati arahan petugas keamanan adat (*Pecalang*) saat pengalihan arus jalan upacara keagamaan.</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-moon text-indigo-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Hari Raya Nyepi:</strong> Selama 24 jam Nyepi, seluruh warga dan wisatawan wajib berdiam di dalam hotel/vila tanpa menyalakan lampu terang dan dilarang keluar ke jalan raya.</span>
                </li>
                <li class="flex items-start space-x-2">
                    <i class="fa-solid fa-scale-balanced text-red-600 mt-1 flex-shrink-0"></i>
                    <span><strong>Narkotika:</strong> Indonesia menerapkan sanksi hukuman penjara sangat berat hingga hukuman mati atas kepemilikan dan penyelundupan narkoba.</span>
                </li>
            </ul>
        </div>

    </div>

    <!-- AI Assistance Prompt Box -->
    <div class="mt-12 p-6 sm:p-8 bg-slate-900 rounded-3xl text-white flex flex-col sm:flex-row items-center justify-between gap-6 border border-slate-800 shadow-xl">
        <div class="space-y-2 text-center sm:text-left">
            <span class="text-xs font-bold text-amber-400 uppercase tracking-wider flex items-center justify-center sm:justify-start">
                <i class="fa-solid fa-sparkles mr-1.5"></i> Pertanyaan Spesifik Regulasi?
            </span>
            <h3 class="text-lg sm:text-xl font-bold">Konsultasikan dengan Asisten AI Gemini BaliGuard</h3>
            <p class="text-xs sm:text-sm text-slate-300">Tanyakan hukum lalu lintas, etika pura, atau perizinan turis secara langsung dalam bahasa Anda.</p>
        </div>
        <button onclick="toggleChatbot(true)" class="px-6 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-extrabold text-xs sm:text-sm shadow-md transition whitespace-nowrap">
            Buka Chat AI Sekarang
        </button>
    </div>

</div>

<script>
    function filterGuideline(category) {
        // Update active tab styles
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-slate-900', 'text-white');
            btn.classList.add('bg-white', 'text-slate-700');
        });
        event.currentTarget.classList.remove('bg-white', 'text-slate-700');
        event.currentTarget.classList.add('bg-slate-900', 'text-white');

        // Filter cards
        const cards = document.querySelectorAll('.guideline-card');
        cards.forEach(card => {
            if (category === 'all' || card.getAttribute('data-category') === category) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endsection
