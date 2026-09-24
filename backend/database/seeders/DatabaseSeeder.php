<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UnitUsaha;
use App\Models\Sertifikasi;
use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@wancirusogroup.co.id'],
            [
                'name' => 'Super Admin WGI',
                'password' => Hash::make('password123'),
            ]
        );

        // Seed 8 Unit Usaha
        $units = [
            [
                'nama_unit' => 'Perdagangan & Ekspor-Impor',
                'slug' => 'perdagangan-ekspor-impor',
                'deskripsi_umum' => 'Perdagangan umum serta kegiatan ekspor dan impor barang komoditas industri.',
                'layanan_utama' => ['Perdagangan Komoditas', 'Jasa Ekspor-Impor', 'Customs Clearance'],
                'keunggulan' => 'Jaringan kemitraan perdagangan global terpercaya.',
                'target_pasar' => 'Perusahaan manufaktur, eksportir, dan pedagang komoditas.',
                'urutan_tampil' => 1,
            ],
            [
                'nama_unit' => 'Alat Berat & Perawatan',
                'slug' => 'alat-berat',
                'deskripsi_umum' => 'Jasa penyewaan & perawatan armada forklift dan mobile crane untuk operasional industri & pergudangan.',
                'layanan_utama' => ['Sewa Forklift & Mobile Crane', 'Maintenance Service Berkala', 'Sparepart Support'],
                'keunggulan' => 'Armada forklift & mobile crane terawat prima, bersertifikasi K3, dan tim mekanik siaga 24/7.',
                'target_pasar' => 'Pabrik industri, kawasan pergudangan, logistik, dan proyek konstruksi.',
                'foto_utama' => '/images/heavy_equipment.jpg',
                'galeri_foto' => [
                    '/images/alat-berat/alat_berat_01.webp',
                    '/images/alat-berat/alat_berat_02.webp',
                    '/images/alat-berat/alat_berat_03.webp',
                    '/images/alat-berat/alat_berat_04.webp',
                    '/images/alat-berat/alat_berat_05.webp',
                    '/images/alat-berat/alat_berat_06.webp',
                    '/images/alat-berat/alat_berat_07.webp',
                    '/images/alat-berat/alat_berat_08.webp',
                    '/images/alat-berat/alat_berat_09.webp',
                    '/images/alat-berat/alat_berat_10.webp',
                    '/images/alat-berat/alat_berat_11.webp',
                    '/images/alat-berat/alat_berat_12.webp',
                    '/images/alat-berat/alat_berat_13.webp',
                ],
                'urutan_tampil' => 2,
            ],
            [
                'nama_unit' => 'Transportasi & Angkutan Logistics',
                'slug' => 'transportasi-angkutan',
                'deskripsi_umum' => 'Armada angkutan darat dan solusi logistik terpadu untuk pengiriman barang industri.',
                'layanan_utama' => ['Sewa Truk & Trailer', 'Angkutan Logistik', 'Distribusi Regional'],
                'keunggulan' => 'Pengiriman tepat waktu dengan armada terlacak GPS.',
                'target_pasar' => 'Perusahaan logistik, distributor, dan industri manufaktur.',
                'urutan_tampil' => 3,
            ],
            [
                'nama_unit' => 'Otomotif & Maintenance',
                'slug' => 'otomotif',
                'deskripsi_umum' => 'Layanan pencucian dan salon perawatan mobil profesional.',
                'layanan_utama' => ['Auto Detailing', 'Car Wash Services', 'Perawatan Kendaraan'],
                'keunggulan' => 'Peralatan modern dan bahan perawatan kualitas premium.',
                'target_pasar' => 'Pemilik kendaraan pribadi dan armada operasional perusahaan.',
                'urutan_tampil' => 4,
            ],
            [
                'nama_unit' => 'Manufaktur Kemasan Kayu (ISPM#15)',
                'slug' => 'manufaktur-ispm15',
                'deskripsi_umum' => 'Produksi kemasan kayu industri (palet, crates, boxes) bersertifikasi internasional ISPM#15 & BARANTAN sejak 2007.',
                'layanan_utama' => ['Palet Kayu Standar Ekspor', 'Fasilitas Heat Treatment (HT)', 'Wooden Crates & Boxes'],
                'keunggulan' => 'Berpengalaman sejak 2007 (CV. Wanciruso) dengan sertifikasi verifikasi resmi BARANTAN.',
                'target_pasar' => 'Perusahaan manufaktur ekspor, pergudangan, dan logistik internasional.',
                'urutan_tampil' => 5,
            ],
            [
                'nama_unit' => 'Konstruksi & Real Estate',
                'slug' => 'konstruksi-real-estate',
                'deskripsi_umum' => 'Jasa kontraktor konstruksi fisik, pengembangan properti komersial, dan perumahan.',
                'layanan_utama' => ['Kontraktor Bangunan', 'Pengembangan Real Estate', 'Manajemen Properti'],
                'keunggulan' => 'Konstruksi berkualitas tinggi dan desain bangunan fungsional.',
                'target_pasar' => 'Pengembang perumahan, pemilik kawasan industri, dan komersial.',
                'urutan_tampil' => 6,
            ],
            [
                'nama_unit' => 'Percetakan Komersial',
                'slug' => 'percetakan',
                'deskripsi_umum' => 'Layanan percetakan offset dan digital untuk kebutuhan promosi & kemasan.',
                'layanan_utama' => ['Cetak Offset & Digital', 'Kemasan Cetak', 'Percetakan Korporat'],
                'keunggulan' => 'Hasil cetak tajam, konsisten, dan waktu pengerjaan cepat.',
                'target_pasar' => 'Perusahaan, instansi, dan pelaku UMKM.',
                'urutan_tampil' => 7,
            ],
            [
                'nama_unit' => 'Agribisnis & Peternakan',
                'slug' => 'agribisnis',
                'deskripsi_umum' => 'Pengembangan sektor pertanian, peternakan, dan perikanan terpadu berkelanjutan.',
                'layanan_utama' => ['Pertanian Terpadu', 'Peternakan', 'Perikanan Darat'],
                'keunggulan' => 'Pengelolaan lahan ramah lingkungan & hasil panen berkualitas.',
                'target_pasar' => 'Distributor bahan pangan, pasar komoditas, dan industri olahan.',
                'urutan_tampil' => 8,
            ],
        ];

        foreach ($units as $u) {
            UnitUsaha::updateOrCreate(['slug' => $u['slug']], $u);
        }

        // Seed Sertifikasi
        Sertifikasi::updateOrCreate(
            ['nama_sertifikasi' => 'Sertifikasi ISPM#15 (Kemasan Kayu)'],
            [
                'diterbitkan_oleh' => 'International Plant Protection Convention (IPPC)',
                'tahun' => '2010',
                'deskripsi' => 'Sertifikat standar internasional perlakuan panas kayu ekspor.',
                'tampil_publik' => true,
            ]
        );

        Sertifikasi::updateOrCreate(
            ['nama_sertifikasi' => 'Verifikasi Fasilitas Heat Treatment'],
            [
                'diterbitkan_oleh' => 'Badan Karantina Pertanian (BARANTAN) Kementan RI',
                'tahun' => '2008',
                'deskripsi' => 'Surat verifikasi kelayakan fasilitas Heat Treatment oven pengeringan kayu 56°C.',
                'tampil_publik' => true,
            ]
        );

        // Seed Berita
        Berita::updateOrCreate(
            ['slug' => 'perluasan-fasilitas-heat-treatment-ispm15'],
            [
                'judul' => 'PT WGI Perluas Kapasitas Fasilitas Heat Treatment Bersertifikasi BARANTAN',
                'kategori' => 'Manufaktur & Ekspor',
                'ringkasan' => 'Untuk memenuhi lonjakan permintaan kemasan kayu ekspor bersertifikat ISPM#15, PT WGI melakukan modernisasi kamar pengeringan heat treatment.',
                'isi' => 'PT Wanciruso Group Indonesia (WGI) memperluas kapasitas oven heat treatment...',
                'tanggal_publish' => now(),
                'status_publish' => true,
            ]
        );
    }
}
