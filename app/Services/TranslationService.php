<?php

namespace App\Services;

class TranslationService
{
    public static function getTranslations(): array
    {
        return [
            // Navigation & Brand
            'app_tag' => [
                'id' => 'Pusat Keamanan Wisatawan Terpadu',
                'en' => 'Integrated Tourist Safety & Emergency Hub',
                'zh' => '巴厘岛综合游客安全应急中心',
                'ja' => 'バリ島総合観光客安全・緊急対応ハブ',
            ],
            'nav_home' => [
                'id' => 'Beranda',
                'en' => 'Home',
                'zh' => '首页',
                'ja' => 'ホーム',
            ],
            'nav_map' => [
                'id' => 'Peta Keamanan',
                'en' => 'Safety Map',
                'zh' => '安全地图',
                'ja' => '安全マップ',
            ],
            'nav_report' => [
                'id' => 'Lapor Insiden',
                'en' => 'Report Incident',
                'zh' => '报告事件',
                'ja' => '事件報告',
            ],
            'nav_track' => [
                'id' => 'Lacak Laporan',
                'en' => 'Track Status',
                'zh' => '追踪进度',
                'ja' => '状況追跡',
            ],
            'nav_guidelines' => [
                'id' => 'Tata Tertib',
                'en' => 'Guidelines',
                'zh' => '行为指南',
                'ja' => 'マナー規範',
            ],
            'nav_sos' => [
                'id' => 'SOS DARURAT',
                'en' => 'PANIC SOS',
                'zh' => '紧急求救',
                'ja' => '緊急SOS',
            ],
            'nav_chat' => [
                'id' => 'Tanya AI',
                'en' => 'Ask AI',
                'zh' => '咨询AI',
                'ja' => 'AI相談',
            ],
            'nav_admin' => [
                'id' => 'Pusat Komando',
                'en' => 'Command Center',
                'zh' => '指挥中心',
                'ja' => '司令センター',
            ],

            // Hero Section
            'hero_badge' => [
                'id' => 'Layanan Keselamatan Resmi Wisatawan Bali',
                'en' => 'Official Bali Tourist Safety & Protection Service',
                'zh' => '巴厘岛官方游客安全与应急救援平台',
                'ja' => 'バリ島公式観光客安全・緊急救援プラットフォーム',
            ],
            'hero_title_1' => [
                'id' => 'Keselamatan & Perlindungan',
                'en' => 'Safety & Integrated Protection',
                'zh' => '全天候安全保障与应急救援',
                'ja' => '観光客の安全と総合保護',
            ],
            'hero_title_2' => [
                'id' => 'Terpadu Wisatawan Bali',
                'en' => 'for Bali Tourists',
                'zh' => '守护您的巴厘岛之旅',
                'ja' => 'バリ島観光の総合支援',
            ],
            'hero_desc' => [
                'id' => 'Bantuan darurat 24 jam dengan deteksi GPS, pelaporan insiden daring, panduan tata krama adat & Pura (Perda No. 2/2024), serta konsultasi AI keselamatan Google Gemini multibahasa.',
                'en' => '24/7 emergency dispatch with automatic GPS satellite lock, incident reporting, temple etiquette guidelines (Perda No. 2/2024), and multilingual Google Gemini AI safety advisory.',
                'zh' => '24小时自动GPS卫星定位紧急调度、在线事件报警追踪、寺庙与民俗文化规范指南（巴厘岛第2/2024号条例），以及谷歌Gemini多语言安全AI助手。',
                'ja' => '自動GPS測位による24時間緊急出動、事件報告追跡、寺院マナー規範（バリ州条例2024年第2号）、Google Gemini多言語AI安全アシスタントを統合。',
            ],
            'btn_panic_sos' => [
                'id' => 'TOMBOL DARURAT CEPAT (SOS)',
                'en' => 'QUICK PANIC SOS 24/7',
                'zh' => '一键紧急求救 (SOS 24/7)',
                'ja' => '緊急SOSボタン (24時間)',
            ],
            'btn_panic_sub' => [
                'id' => 'Deteksi koordinat satelit GPS otomatis ke pos siaga',
                'en' => 'Automatic satellite GPS coordinates to nearest responders',
                'zh' => '自动GPS定位并直传至最近警局与救生队',
                'ja' => '最寄りの救助隊へGPS位置情報を直ちに送信',
            ],
            'btn_report_incident' => [
                'id' => 'Lapor Insiden Online',
                'en' => 'Report Incident Online',
                'zh' => '在线提交事件报案',
                'ja' => 'オンライン事件報告',
            ],
            'btn_safety_map' => [
                'id' => 'Peta Pos & Faskes',
                'en' => 'Safety Map & Facilities',
                'zh' => '安全地图与医疗救助',
                'ja' => '安全マップ・医療施設',
            ],

            // Status Bar & Metrics
            'system_status' => [
                'id' => 'Status Sistem: Aktif 24/7 &bull; Siaga Hijau Terpadu',
                'en' => 'System Status: Active 24/7 &bull; Green Alert Code',
                'zh' => '系统状态：24/7全天候运行 &bull; 绿色常态戒备',
                'ja' => 'システム状況：24時間稼働中 &bull; 通常警戒体制',
            ],
            'security_level_title' => [
                'id' => 'Status Keamanan 9 Kabupaten di Bali',
                'en' => 'Security Status across 9 Regencies in Bali',
                'zh' => '巴厘岛9个县市最新安全态势',
                'ja' => 'バリ島全9県の最新安全状況',
            ],

            // Report Form
            'report_form_title' => [
                'id' => 'Formulir Laporan Insiden Wisatawan',
                'en' => 'Tourist Incident Report Form',
                'zh' => '游客事件在线报案表',
                'ja' => '観光客インシデント報告フォーム',
            ],
            'report_form_subtitle' => [
                'id' => 'Laporkan pencurian, penipuan, kecelakaan, kehilangan paspor/dokumen, atau kendala keselamatan lainnya. Laporan Anda langsung diteruskan ke instansi berwenang.',
                'en' => 'Report theft, scams, accidents, lost passports/documents, or other safety concerns. Your report is directly dispatched to verified authorities.',
                'zh' => '报告盗窃、诈骗、交通事故、护照证件遗失或其他安全问题。您的报告将直接移交至主管部门。',
                'ja' => '盗難、詐欺、交通事故、パスポート紛失、その他の安全上の問題を報告してください。関係当局に直ちに通報されます。',
            ],
            'sec_reporter_info' => [
                'id' => 'Data Identitas Pelapor',
                'en' => 'Reporter Identity Information',
                'zh' => '报案人身份信息',
                'ja' => '報告者の身元情報',
            ],
            'lbl_fullname' => [
                'id' => 'Nama Lengkap Sesuai ID',
                'en' => 'Full Name as per ID/Passport',
                'zh' => '证件姓名（与护照/身份证一致）',
                'ja' => '身元確認書類の氏名（パスポート等）',
            ],
            'lbl_phone' => [
                'id' => 'Nomor WhatsApp / HP Aktif',
                'en' => 'Active WhatsApp / Phone Number',
                'zh' => '有效的WhatsApp/手机号码',
                'ja' => '連絡先電話番号 / WhatsApp',
            ],
            'lbl_email' => [
                'id' => 'Alamat Email (Opsional)',
                'en' => 'Email Address (Optional)',
                'zh' => '电子邮箱（选填）',
                'ja' => 'メールアドレス（任意）',
            ],
            'lbl_nationality' => [
                'id' => 'Kewarganegaraan / Asal',
                'en' => 'Nationality / Country of Origin',
                'zh' => '国籍 / 出发地',
                'ja' => '国籍 / 出身国',
            ],
            'lbl_id_number' => [
                'id' => 'Nomor Paspor / KTP / KITAS (Opsional)',
                'en' => 'Passport / National ID Number (Optional)',
                'zh' => '护照号 / 身份证号（选填）',
                'ja' => 'パスポート番号 / 身分証番号（任意）',
            ],
            'sec_incident_info' => [
                'id' => 'Rincian Kejadian / Insiden',
                'en' => 'Incident Details',
                'zh' => '事件详情',
                'ja' => '事件・事故の詳細',
            ],
            'lbl_category' => [
                'id' => 'Kategori Kejadian',
                'en' => 'Incident Category',
                'zh' => '事件类型',
                'ja' => '事案件名・種別',
            ],
            'lbl_regency' => [
                'id' => 'Kabupaten / Wilayah di Bali',
                'en' => 'Regency / District in Bali',
                'zh' => '巴厘岛所在县市区域',
                'ja' => '発生地域（県・市）',
            ],
            'lbl_incident_time' => [
                'id' => 'Waktu Kejadian',
                'en' => 'Date & Time of Incident',
                'zh' => '发生时间',
                'ja' => '発生日時',
            ],
            'lbl_location_spec' => [
                'id' => 'Lokasi Spesifik / Patokan',
                'en' => 'Specific Location / Landmark',
                'zh' => '具体地点 / 地标参照物',
                'ja' => '具体的な発生場所・目印',
            ],
            'btn_detect_gps' => [
                'id' => 'Deteksi GPS',
                'en' => 'Detect GPS',
                'zh' => 'GPS定位',
                'ja' => 'GPS検出',
            ],
            'lbl_description' => [
                'id' => 'Deskripsi Lengkap Kronologi Kejadian',
                'en' => 'Detailed Description & Chronology',
                'zh' => '事件详细经过说明',
                'ja' => '事件の経緯・詳細説明',
            ],
            'desc_hint' => [
                'id' => 'Minimal 20 karakter agar petugas dapat memahami kronologi dengan jelas.',
                'en' => 'Minimum 20 characters so officers can properly assess the situation.',
                'zh' => '至少填写20个字符以便救援人员核实案情。',
                'ja' => '担当者が状況を正確に把握できるよう20文字以上入力してください。',
            ],
            'consent_text' => [
                'id' => 'Saya menyatakan bahwa keterangan yang saya berikan adalah benar dan dapat dipertanggungjawabkan sesuai hukum perlindungan pelapor kepolisian.',
                'en' => 'I hereby state that all provided information is true, accurate, and accountable under lawful reporting protections.',
                'zh' => '我声明所提供的情况属实，并依据合法报案人保护法承担相应法律责任。',
                'ja' => '私は提供した情報が真実かつ正確であり、法令に基づく報告責任を負うことを誓約します。',
            ],
            'btn_submit_report' => [
                'id' => 'KIRIM LAPORAN KE PUSAT KENDALI',
                'en' => 'SUBMIT REPORT TO COMMAND CENTER',
                'zh' => '立即向指挥中心提交报告',
                'ja' => '司令センターへ報告を送信',
            ],

            // Categories
            'cat_theft' => [
                'id' => 'Pencurian / Kemalingan / Copet',
                'en' => 'Theft / Robbery / Pickpocketing',
                'zh' => '盗窃 / 抢劫 / 扒窃',
                'ja' => '盗難 / スリ / ひったくり',
            ],
            'cat_scam' => [
                'id' => 'Penipuan Wisata / Valas / Pemerasan',
                'en' => 'Tourist Scam / Money Changer Fraud / Extortion',
                'zh' => '旅游诈骗 / 假汇兑 / 勒索',
                'ja' => '観光詐欺 / 換金詐欺 / 恐喝',
            ],
            'cat_traffic_accident' => [
                'id' => 'Kecelakaan Lalu Lintas / Rental Motor',
                'en' => 'Traffic Accident / Motorbike Rental Crash',
                'zh' => '交通事故 / 租车剐蹭事故',
                'ja' => '交通事故 / レンタルバイク事故',
            ],
            'cat_medical' => [
                'id' => 'Keadaan Darurat Medis / Rabies / Cidera',
                'en' => 'Medical Emergency / Rabies Exposure / Injury',
                'zh' => '医疗急救 / 狂犬病暴露 / 严重受伤',
                'ja' => '救急医療 / 狂犬病の疑い / 重傷',
            ],
            'cat_lost_document' => [
                'id' => 'Kehilangan Paspor / Dompet / Dokumen',
                'en' => 'Lost Passport / Wallet / Essential Documents',
                'zh' => '护照遗失 / 钱包丢失 / 重要证件遗失',
                'ja' => 'パスポート紛失 / 財布・貴重品紛失',
            ],
            'cat_harassment' => [
                'id' => 'Pelecehan / Gangguan Keamanan Asusila',
                'en' => 'Harassment / Inappropriate Conduct',
                'zh' => '骚扰 / 侵犯人身安全事件',
                'ja' => '嫌がらせ / ハラスメント行為',
            ],
            'cat_property_damage' => [
                'id' => 'Kerusakan Properti / Konflik Penginapan',
                'en' => 'Property Damage / Accommodation Dispute',
                'zh' => '财产损坏 / 酒店住宿纠纷',
                'ja' => '器物破損 / 宿泊施設トラブル',
            ],
            'cat_other' => [
                'id' => 'Insiden Keamanan Lainnya',
                'en' => 'Other Safety Incidents',
                'zh' => '其他安全事件',
                'ja' => 'その他の安全問題',
            ],

            // Tracking Page
            'track_title' => [
                'id' => 'Lacak Penanganan Laporan Insiden',
                'en' => 'Track Incident Resolution Status',
                'zh' => '追踪案件调查与处理进展',
                'ja' => 'インシデント対応状況の追跡',
            ],
            'track_subtitle' => [
                'id' => 'Masukkan Kode Pelacakan (Tracking Code) resmi untuk melihat perkembangan penyelidikan dan tindakan tim lapangan.',
                'en' => 'Enter your official Tracking Code to check real-time progress and actions taken by field responders.',
                'zh' => '输入官方追踪代码以查看现场处置与调查进度。',
                'ja' => '公式追跡コードを入力して、現場対応や調査の進捗状況を確認してください。',
            ],
            'track_placeholder' => [
                'id' => 'Masukkan kode (cth: BG-26-8841A)',
                'en' => 'Enter code (e.g., BG-26-8841A)',
                'zh' => '输入代码 (例: BG-26-8841A)',
                'ja' => 'コードを入力 (例: BG-26-8841A)',
            ],
            'btn_track' => [
                'id' => 'Lacak',
                'en' => 'Track',
                'zh' => '查询',
                'ja' => '追跡',
            ],
            'stage_1' => [
                'id' => 'Laporan Masuk',
                'en' => 'Submitted',
                'zh' => '已接收报案',
                'ja' => '報告受付',
            ],
            'stage_2' => [
                'id' => 'Verifikasi Berkas',
                'en' => 'Under Investigation',
                'zh' => '核实案情',
                'ja' => '書類確認・調査',
            ],
            'stage_3' => [
                'id' => 'Tindakan Lapangan',
                'en' => 'In Action',
                'zh' => '现场行动',
                'ja' => '現場対応中',
            ],
            'stage_4' => [
                'id' => 'Selesai Ditangani',
                'en' => 'Resolved',
                'zh' => '处理完毕',
                'ja' => '対応完了',
            ],
            'not_found_title' => [
                'id' => 'Kode Laporan Tidak Ditemukan',
                'en' => 'Tracking Code Not Found',
                'zh' => '未找到该报案代码',
                'ja' => '追跡コードが見つかりません',
            ],
            'not_found_desc' => [
                'id' => 'Pastikan penulisan kode sudah sesuai. Jika Anda baru saja mengirim laporan dari perangkat ini, data laporan akan dimuat secara otomatis dari penyimpanan lokal.',
                'en' => 'Please verify your code format. If you recently filed a report from this device, local recovery will restore your record automatically.',
                'zh' => '请确认代码输入无误。如果您刚刚在此设备上提交过报告，本地存储将自动为您恢复。',
                'ja' => 'コードの入力内容をご確認ください。この端末から送信したばかりの場合、ローカル保存から自動的に復元されます。',
            ],

            // SOS Modal
            'sos_modal_title' => [
                'id' => 'PUSAT PANGGILAN DARURAT CEPAT SOS',
                'en' => 'RAPID EMERGENCY SOS DISPATCH',
                'zh' => '游客紧急快速求救中心 (SOS)',
                'ja' => '緊急SOS迅速出動センター',
            ],
            'sos_modal_sub' => [
                'id' => 'Koordinat satelit GPS Anda akan dikirim langsung ke pos Polisi Pariwisata, Balawista, BPBD, atau RS terdekat.',
                'en' => 'Your satellite GPS coordinates will be sent directly to nearest Tourist Police, Balawista lifeguards, BPBD, or hospitals.',
                'zh' => '您的GPS卫星定位将直接传送至最近的旅游警察、救生员哨所、灾害防御局或医院。',
                'ja' => 'GPS位置情報が最寄りの観光警察、ライフガード、防災局、救急病院へ直ちに送信されます。',
            ],
            'sos_type_medical' => [
                'id' => 'Medis / Ambulans',
                'en' => 'Medical / Ambulance',
                'zh' => '医疗急救 / 救护车',
                'ja' => '医療救急 / 救急車',
            ],
            'sos_type_police' => [
                'id' => 'Kriminalitas / Polisi',
                'en' => 'Crime / Police Assistance',
                'zh' => '犯罪报警 / 治安求助',
                'ja' => '犯罪被害 / 警察出動',
            ],
            'sos_type_rescue' => [
                'id' => 'Tenggelam / Balawista',
                'en' => 'Ocean Rescue / Lifeguards',
                'zh' => '溺水救助 / 海岸巡逻队',
                'ja' => '水難救助 / ライフガード',
            ],
            'sos_type_disaster' => [
                'id' => 'Bencana / Cuaca Ekstrem',
                'en' => 'Natural Disaster / Storm',
                'zh' => '自然灾害 / 极端天气',
                'ja' => '自然災害 / 暴風雨',
            ],
            'sos_type_harassment' => [
                'id' => 'Pelecehan Keamanan',
                'en' => 'Harassment / Security',
                'zh' => '骚扰危害 / 人身安全',
                'ja' => '嫌がらせ / 安全脅威',
            ],
            'btn_trigger_sos' => [
                'id' => 'PANCARKAN SINYAL SOS SEKARANG',
                'en' => 'BROADCAST SOS SIGNAL NOW',
                'zh' => '立即呼叫紧急救援信号',
                'ja' => '今すぐ緊急SOS信号を送信',
            ],

            // Direct Form & Track Keys
            'form_title' => [
                'id' => 'Formulir Laporan Insiden Wisatawan',
                'en' => 'Tourist Incident Report Form',
                'zh' => '游客事件在线报案表',
                'ja' => '観光客インシデント報告フォーム',
            ],
            'form_desc' => [
                'id' => 'Kirim laporan kejadian pencurian, penipuan, kecelakaan, kehilangan dokumen, atau insiden keamanan lainnya.',
                'en' => 'Report theft, scams, accidents, lost passports/documents, or other safety concerns.',
                'zh' => '在线报告盗窃、诈骗、交通事故、护照证件遗失或其他突发安全事件。',
                'ja' => '盗難、詐欺、交通事故、パスポート紛失、その他の緊急事態を報告してください。',
            ],
            'form_sec_1' => [
                'id' => 'Data Identitas Pelapor',
                'en' => 'Reporter Identity Information',
                'zh' => '报案人身份信息',
                'ja' => '報告者の身元情報',
            ],
            'form_name' => [
                'id' => 'Nama Lengkap Sesuai ID',
                'en' => 'Full Name as per ID',
                'zh' => '证件姓名',
                'ja' => '身元確認書類の氏名',
            ],
            'form_phone' => [
                'id' => 'Nomor WhatsApp / HP Aktif',
                'en' => 'Active WhatsApp / Phone Number',
                'zh' => '联系电话 / WhatsApp',
                'ja' => '連絡先電話番号 / WhatsApp',
            ],
            'form_email' => [
                'id' => 'Alamat Email (Opsional)',
                'en' => 'Email Address (Optional)',
                'zh' => '电子邮箱（选填）',
                'ja' => 'メールアドレス（任意）',
            ],
            'form_nationality' => [
                'id' => 'Kewarganegaraan / Asal',
                'en' => 'Nationality / Country of Origin',
                'zh' => '国籍 / 出发地',
                'ja' => '国籍 / 出身国',
            ],
            'form_passport' => [
                'id' => 'Nomor Paspor / KTP / KITAS (Opsional)',
                'en' => 'Passport / National ID Number (Optional)',
                'zh' => '护照号 / 身份证号（选填）',
                'ja' => 'パスポート番号 / 身分証番号（任意）',
            ],
            'form_sec_2' => [
                'id' => 'Rincian Kejadian / Insiden',
                'en' => 'Incident Details',
                'zh' => '事件详情',
                'ja' => '事件・事故の詳細',
            ],
            'form_category' => [
                'id' => 'Kategori Kejadian',
                'en' => 'Incident Category',
                'zh' => '事件类型',
                'ja' => '事案件名・種別',
            ],
            'form_regency' => [
                'id' => 'Kabupaten / Wilayah di Bali',
                'en' => 'Regency / District in Bali',
                'zh' => '巴厘岛所在县市区域',
                'ja' => '発生地域（県・市）',
            ],
            'form_time' => [
                'id' => 'Waktu Kejadian',
                'en' => 'Date & Time of Incident',
                'zh' => '发生时间',
                'ja' => '発生日時',
            ],
            'form_location' => [
                'id' => 'Lokasi Spesifik / Patokan',
                'en' => 'Specific Location / Landmark',
                'zh' => '具体地点 / 地标参照物',
                'ja' => '具体的な発生場所・目印',
            ],
            'form_desc_label' => [
                'id' => 'Deskripsi Lengkap Kronologi Kejadian',
                'en' => 'Detailed Description & Chronology',
                'zh' => '事件详细经过说明',
                'ja' => '事件の経緯・詳細説明',
            ],
            'form_consent' => [
                'id' => 'Saya menyatakan bahwa keterangan yang saya berikan adalah benar dan dapat dipertanggungjawabkan sesuai hukum perlindungan pelapor kepolisian.',
                'en' => 'I hereby state that all provided information is true, accurate, and accountable under lawful reporting protections.',
                'zh' => '我声明所提供的情况属实，并依据合法报案人保护法承担相应法律责任。',
                'ja' => '私は提供した情報が真実かつ正確であり、法令に基づく報告責任を負うことを誓約します。',
            ],
            'form_btn_submit' => [
                'id' => 'KIRIM LAPORAN KE PUSAT KENDALI',
                'en' => 'SUBMIT REPORT TO COMMAND CENTER',
                'zh' => '立即向指挥中心提交报告',
                'ja' => '司令センターへ報告を送信',
            ],
            'track_desc' => [
                'id' => 'Masukkan Kode Pelacakan (Tracking Code) resmi untuk melihat perkembangan penyelidikan dan tindakan tim lapangan.',
                'en' => 'Enter your official Tracking Code to check real-time progress and actions taken by field responders.',
                'zh' => '输入官方追踪代码以查看现场处置与调查进度。',
                'ja' => '公式追跡コードを入力して、現場対応や調査の進捗状況を確認してください。',
            ],
            'track_input_ph' => [
                'id' => 'Masukkan kode (cth: BG-26-8841A)',
                'en' => 'Enter code (e.g., BG-26-8841A)',
                'zh' => '输入代码 (例: BG-26-8841A)',
                'ja' => 'コードを入力 (例: BG-26-8841A)',
            ],
            'track_btn' => [
                'id' => 'Lacak',
                'en' => 'Track',
                'zh' => '查询',
                'ja' => '追跡',
            ],
            'track_status_title' => [
                'id' => 'Tahapan Penanganan Kasus',
                'en' => 'Case Resolution Stages',
                'zh' => '案件调查处置阶段',
                'ja' => '事件対応プロセス',
            ],
            'track_stage_1' => [
                'id' => 'Laporan Masuk',
                'en' => 'Submitted',
                'zh' => '已接收报案',
                'ja' => '報告受付',
            ],
            'track_stage_2' => [
                'id' => 'Verifikasi Berkas',
                'en' => 'Under Investigation',
                'zh' => '核实案情',
                'ja' => '書類確認・調査',
            ],
            'track_stage_3' => [
                'id' => 'Tindakan Lapangan',
                'en' => 'In Action',
                'zh' => '现场行动',
                'ja' => '現場対応中',
            ],
            'track_stage_4' => [
                'id' => 'Selesai Ditangani',
                'en' => 'Resolved',
                'zh' => '处理完毕',
                'ja' => '対応完了',
            ],
            'track_detail_title' => [
                'id' => 'Rincian Informasi Laporan',
                'en' => 'Report Details',
                'zh' => '报案信息详情',
                'ja' => '報告内容の詳細',
            ],
            'track_officer_title' => [
                'id' => 'Catatan Tindak Lanjut Petugas',
                'en' => 'Officer Follow-up Notes',
                'zh' => '现场处置警官处理记录',
                'ja' => '担当捜査員の対応記録',
            ],
            'track_urgent_help' => [
                'id' => 'Butuh bantuan mendesak lainnya terkait laporan ini?',
                'en' => 'Need urgent help regarding this report?',
                'zh' => '需要关于此案的紧急援助？',
                'ja' => 'この報告に関して緊急の支援が必要ですか？',
            ],
            'track_call_112' => [
                'id' => 'Hubungi 112',
                'en' => 'Call 112',
                'zh' => '拨打 112',
                'ja' => '112に電話',
            ],
            'track_ask_ai' => [
                'id' => 'Tanya AI Gemini',
                'en' => 'Ask Gemini AI',
                'zh' => '咨询 Gemini AI',
                'ja' => 'Gemini AIに相談',
            ],
            'sos_btn_send' => [
                'id' => 'KIRIM SINYAL SOS SEKARANG!',
                'en' => 'SEND SOS EMERGENCY NOW!',
                'zh' => '立即发送SOS紧急警报！',
                'ja' => '今すぐ緊急SOSを送信！',
            ],

            // Chatbot
            'chat_title' => [
                'id' => 'Asisten AI Keselamatan Bali',
                'en' => 'Bali Safety AI Copilot',
                'zh' => '巴厘岛安全智能AI助手',
                'ja' => 'バリ島安全AIアシスタント',
            ],
            'chat_badge' => [
                'id' => 'Ditenagai Google Gemini AI',
                'en' => 'Powered by Google Gemini AI',
                'zh' => '由 Google Gemini AI 驱动',
                'ja' => 'Google Gemini AI 搭載',
            ],
            'chat_input_placeholder' => [
                'id' => 'Tanyakan keamanan, RS terdekat, aturan Pura, rabies...',
                'en' => 'Ask about safety, nearest hospital, temple rules, rabies...',
                'zh' => '咨询安全问题、就近医院、寺庙禁忌、狂犬疫苗...',
                'ja' => '安全性、最寄りの病院、寺院マナー、狂犬病について質問...',
            ],
            'prompt_hospital' => [
                'id' => 'Rumah sakit internasional rujukan rabies terdekat?',
                'en' => 'Nearest international hospital with rabies vaccine (VAR)?',
                'zh' => '附近有狂犬疫苗(VAR)的国际医院在哪里？',
                'ja' => '狂犬病ワクチン対応の最寄りの国際病院は？',
            ],
            'prompt_temple' => [
                'id' => 'Aturan berpakaian dan larangan cuntaka masuk Pura?',
                'en' => 'Dress code & sacred restrictions for entering Bali temples?',
                'zh' => '进入巴厘岛寺庙的服装规定与禁忌事项？',
                'ja' => 'バリ島の寺院参拝マナーと服装規定は？',
            ],
            'prompt_ripcurrent' => [
                'id' => 'Pantai mana yang rawan arus ombak berbahaya (rip current)?',
                'en' => 'Which beaches have dangerous rip currents and wave hazards?',
                'zh' => '哪些海滩存在危险离岸流(Rip Current)与巨浪风险？',
                'ja' => '離岸流や高波の危険があるビーチはどこですか？',
            ],
            'prompt_money' => [
                'id' => 'Ciri Money Changer resmi berizin Bank Indonesia?',
                'en' => 'How to identify an authorized Money Changer with BI permit?',
                'zh' => '如何识别印尼央行官方认证的合法货币兑换点？',
                'ja' => 'インドネシア中央銀行公認の両替所の見分け方は？',
            ],
        ];
    }

    public static function trans(string $key, ?string $default = null): string
    {
        $locale = app()->getLocale();
        $translations = self::getTranslations();

        if (isset($translations[$key][$locale])) {
            return $translations[$key][$locale];
        }

        if (isset($translations[$key]['id'])) {
            return $translations[$key]['id'];
        }

        return $default ?? $key;
    }
}
