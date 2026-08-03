# PRD — Website Company Profile PT Wanciruso Group Indonesia (WGI)
### Product Requirements Document | Semi-CMS Company Profile Website

**Versi Dokumen:** 1.0
**Konsep Desain Acuan:** Mockup V1 (dominan gelap, aksen merah-hitam, grid korporat)
**Status:** Draft untuk direview klien

---

## 1. Ringkasan Eksekutif

PT Wanciruso Group Indonesia (WGI) membutuhkan website company profile korporat yang mampu merepresentasikan identitas perusahaan sebagai holding nasional dengan 8 unit usaha lintas sektor. Website bersifat **semi-CMS** — seluruh konten di sisi frontend (teks, gambar, data unit usaha, sertifikasi, tim, dsb) dapat diubah oleh admin melalui dashboard backend tanpa perlu mengubah kode program.

Website ini **bukan** e-commerce dan tidak memiliki transaksi — fokus utamanya adalah membangun kredibilitas korporat, menampilkan portofolio unit usaha, dan menjadi kanal utama komunikasi kemitraan/investasi.

---

## 2. Latar Belakang & Tujuan

PT WGI berkembang dari CV. Wanciruso (spesialis kemasan kayu industri bersertifikasi ISPM#15, berdiri 2007) menjadi perusahaan holding dengan 8 unit usaha: Perdagangan & Ekspor-Impor, Alat Berat, Transportasi & Angkutan, Otomotif, Manufaktur, Konstruksi & Real Estate, Percetakan, dan Agribisnis.

**Tujuan Website:**
- Membangun kredibilitas sebagai holding company nasional di mata mitra bisnis, klien, dan calon investor.
- Menjadi pusat informasi resmi seluruh unit usaha PT WGI.
- Memfasilitasi kontak/pengajuan kemitraan bisnis secara terstruktur.
- Memungkinkan tim internal PT WGI mengelola & memperbarui konten secara mandiri tanpa developer.

---

## 3. Ruang Lingkup

### 3.1 Dalam Ruang Lingkup (In Scope)
- Website public-facing (company profile) — desain mengikuti Mockup V1 yang disepakati.
- Dashboard admin (backend) untuk mengelola seluruh konten dinamis.
- Sistem autentikasi admin dengan role dasar.
- Form pengajuan kemitraan/kontak dengan penyimpanan data submission.
- Optimasi dasar SEO (meta tag, sitemap.xml, robots.txt, structured data).
- Responsif penuh (desktop, tablet, mobile).
- Unduh Company Profile dalam format PDF (file diunggah admin, bukan digenerate otomatis).

### 3.2 Di Luar Ruang Lingkup (Out of Scope — Fase 1)
- E-commerce / transaksi online.
- Portal karir dengan sistem lamaran online (jika dibutuhkan, jadi fase terpisah).
- Multi-bahasa (disiapkan strukturnya, tapi aktivasi penuh di fase selanjutnya jika dibutuhkan).
- Live chat / chatbot.
- Integrasi CRM/ERP internal.

---

## 4. Definisi Pengguna & Peran

| Peran | Deskripsi | Akses |
|---|---|---|
| **Pengunjung Publik** | Calon mitra, investor, klien, masyarakat umum | Baca-saja seluruh halaman publik, isi form kemitraan/kontak |
| **Admin — Super Admin** | Pemilik/pengelola utama sistem (biasanya tim IT internal WGI) | Akses penuh: kelola konten, kelola user admin, kelola pengaturan sistem |
| **Admin — Content Editor** | Staf marketing/komunikasi yang update konten sehari-hari | Kelola konten (unit usaha, berita, galeri, sertifikasi) — tidak bisa kelola user/pengaturan sistem |

---

## 5. Rekomendasi Arsitektur Teknis

### 5.1 Ringkasan Stack

| Layer | Teknologi | Catatan |
|---|---|---|
| Backend / API / CMS | **Laravel 11** (PHP) | Sesuai permintaan; direkomendasikan pakai **FilamentPHP** untuk mempercepat pembangunan dashboard admin |
| Frontend | **Nuxt 3** (berbasis Vue 3) — direkomendasikan, bukan Vue SPA murni | Lihat justifikasi di 5.2 |
| Autentikasi Admin | Laravel Sanctum (token-based) | Untuk komunikasi aman antara dashboard admin dan API |
| Database | MySQL / MariaDB | Standar, kompatibel luas dengan hosting Laravel |
| Penyimpanan Media | Local storage (awal) → S3-compatible (opsional, jika volume foto tinggi) | Lihat catatan resolusi tinggi di 5.4 |
| Cache | Laravel Cache (Redis/file) untuk data yang jarang berubah | Unit usaha, sertifikasi, dsb |

### 5.2 Kenapa Nuxt 3, Bukan Vue SPA Murni?

Vue.js sebagai Single Page Application (SPA) merender konten di sisi browser (client-side rendering). Ini bermasalah untuk website company profile korporat karena:
- Mesin pencari (Google) butuh effort ekstra meng-index konten yang di-render client-side — berisiko konten unit usaha/sertifikasi tidak muncul optimal di hasil pencarian.
- Calon mitra/investor sering mencari nama perusahaan atau sektor usaha lewat Google — SEO yang lemah berarti kehilangan calon prospek.

**Keputusan:** karena "mudah dicari di Google" menjadi prioritas eksplisit, frontend **ditetapkan menggunakan Nuxt 3** (framework di atas Vue 3, jadi stack tetap Vue.js seperti diminta) dengan mode **SSR (Server-Side Rendering)** — bukan Vue SPA murni. Setiap halaman ter-render penuh sebagai HTML di server sebelum sampai ke browser/crawler, sehingga Google bisa langsung membaca seluruh konten (teks unit usaha, sertifikasi, dsb) tanpa hambatan JavaScript rendering. Ini juga mempercepat waktu tampil pertama (First Contentful Paint) yang ikut memengaruhi ranking Google.

Detail lengkap strategi SEO ada di **Bagian 10**.

### 5.3 Arsitektur Sistem (Headless)

```
[ Pengunjung / Browser ]
         │
         ▼
[ Frontend — Nuxt 3 (Vue 3) ]  ──── konsumsi ────▶  [ REST API — Laravel ]
         ▲                                                    │
         │                                                    ▼
[ Admin Dashboard — FilamentPHP ]  ◀──── akses langsung ───  [ Database MySQL ]
                                                               │
                                                               ▼
                                                     [ Storage Media/Gambar ]
```

- Laravel bertindak sebagai **backend tunggal**: menyediakan REST API untuk frontend publik, sekaligus meng-host dashboard admin (FilamentPHP berjalan di atas Laravel, route terpisah dari API publik, mis. `/admin`).
- Nuxt 3 hanya mengonsumsi API publik (read-only untuk pengunjung), tidak punya akses langsung ke database.
- Autentikasi admin terpisah total dari akses publik — tidak ada login pengunjung di fase ini.

### 5.4 Catatan Khusus: Optimasi Gambar

Mengacu pada checklist kebutuhan foto sebelumnya (resolusi tinggi, sampai foto drone/video profil), sistem **wajib** memiliki pipeline optimasi gambar otomatis saat admin upload:
- Auto-resize ke beberapa varian ukuran (thumbnail, medium, full) menggunakan library seperti `Intervention Image` di Laravel.
- Konversi otomatis ke format WebP untuk performa loading, dengan fallback JPEG.
- Validasi ukuran file maksimum saat upload agar tidak membebani server/loading halaman.

### 5.5 Rekomendasi Hosting

- **Backend (Laravel + Admin)**: VPS (misal DigitalOcean/AWS Lightsail/Niagahoster Cloud VPS) dengan PHP 8.3+, MySQL, dan cukup storage untuk media resolusi tinggi.
- **Frontend (Nuxt 3)**: bisa di-deploy terpisah di platform seperti Vercel/Netlify (jika SSR) untuk performa CDN global, atau satu VPS yang sama dengan Node.js process manager (PM2) jika ingin konsolidasi infrastruktur.

---

## 6. Struktur Halaman / Sitemap

Mengikuti struktur desain **Mockup V1** yang telah disepakati:

1. **Beranda** — hero, marquee sektor usaha, ringkasan tentang, unit usaha (grid), statistik, testimoni ringkas, CTA kemitraan
2. **Tentang Kami** — narasi lengkap, sejarah/timeline, visi & misi, nilai perusahaan
3. **Unit Usaha** — halaman indeks berisi grid 8 pilar bisnis, **dengan sub-halaman URL tersendiri per unit** (`/unit-usaha/alat-berat`, `/unit-usaha/manufaktur`, dst) — penting agar tiap sektor bisa muncul di hasil pencarian spesifik (mis. orang mencari "jasa sewa alat berat" bisa langsung menemukan halaman unit tersebut, bukan cuma halaman utama)
4. **Manajemen & Tim** *(opsional, sesuai keputusan klien)*
5. **Sertifikasi & Legalitas** — badge ISPM#15, BARANTAN, dsb
6. **Proyek & Klien** *(opsional)* — portofolio & logo mitra
7. **Kantor & Kontak** — daftar lokasi, peta, form pengajuan kemitraan
8. **Halaman Unduh Company Profile (PDF)**

---

## 7. Model Data / Struktur Konten CMS

Seluruh entitas berikut dikelola penuh dari dashboard admin (CRUD = Create, Read, Update, Delete):

### 7.1 Pengaturan Situs (Site Settings) — *single record*
`nama_perusahaan`, `tagline`, `deskripsi_singkat`, `logo_utama`, `logo_putih`, `favicon`, `warna_brand_hex`, `alamat_kantor_pusat`, `telepon`, `email`, `link_medsos[]`

### 7.2 Hero / Banner — *repeatable*
`judul`, `sub_judul`, `gambar`, `urutan_tampil`, `status_aktif`

### 7.3 Tentang Kami — *single record*
`deskripsi_singkat`, `deskripsi_lengkap`, `kutipan_direktur` (opsional)

### 7.4 Timeline / Milestone — *repeatable*
`tahun`, `judul_peristiwa`, `deskripsi`, `urutan_tampil`

### 7.5 Visi — *single record*
`isi_visi`

### 7.6 Misi — *repeatable*
`urutan`, `isi_misi`

### 7.7 Nilai Perusahaan (Core Values) — *repeatable*
`nama_nilai`, `deskripsi`, `icon`, `urutan_tampil`

### 7.8 Unit Usaha — *repeatable*
`nama_unit`, `slug`, `deskripsi_umum`, `layanan_utama[]`, `keunggulan`, `target_pasar`, `foto_utama`, `galeri_foto[]`, `icon`, `urutan_tampil`, `status_publish`

### 7.9 Manajemen & Tim — *repeatable*
`nama`, `jabatan`, `bio_singkat`, `foto`, `urutan_tampil`, `status_publish`

### 7.10 Sertifikasi & Legalitas — *repeatable*
`nama_sertifikasi`, `diterbitkan_oleh`, `tahun`, `file_gambar`, `tampil_publik` (boolean)

### 7.11 Proyek & Klien — *repeatable*
`nama_proyek_klien`, `unit_usaha_terkait` (relasi ke 7.8), `deskripsi`, `tahun`, `logo_foto`, `tampil_publik` (boolean)

### 7.12 Kantor & Lokasi — *repeatable*
`nama_lokasi`, `jenis` (Kantor Pusat/Cabang/Site Operasional), `alamat`, `telepon`, `email`, `link_google_maps`

### 7.13 Pengajuan Kemitraan / Pesan Masuk — *submission log*
`nama_pengirim`, `perusahaan`, `email`, `telepon`, `pesan`, `status` (Baru/Diproses/Selesai), `tanggal_masuk`
> Admin dapat melihat, mengubah status, dan mengekspor data ini — bukan untuk diedit isinya oleh admin.

### 7.14 File Company Profile (PDF)
`file_pdf`, `tanggal_upload`, `versi`

### 7.15 Pengaturan SEO per Halaman *(opsional, fase 2)*
`halaman`, `meta_title`, `meta_description`, `og_image`

---

## 8. Fitur Dashboard Admin

| Modul | Fitur CRUD | Role Akses |
|---|---|---|
| Pengaturan Situs | Update (single record) | Super Admin |
| Hero/Banner | Create, Read, Update, Delete, atur urutan | Super Admin, Content Editor |
| Tentang & Sejarah | Update | Content Editor |
| Timeline Milestone | CRUD, atur urutan | Content Editor |
| Visi & Misi | Update | Content Editor |
| Nilai Perusahaan | CRUD | Content Editor |
| Unit Usaha | CRUD, upload galeri, atur urutan, publish/unpublish | Content Editor |
| Manajemen & Tim | CRUD, atur urutan | Content Editor |
| Sertifikasi | CRUD, toggle tampil publik | Content Editor |
| Proyek & Klien | CRUD, toggle tampil publik | Content Editor |
| Kantor & Lokasi | CRUD | Content Editor |
| Pesan Masuk/Kemitraan | Read, update status, export | Super Admin, Content Editor |
| File Company Profile PDF | Upload, ganti versi | Super Admin |
| Manajemen User Admin | CRUD user & role | Super Admin saja |

---

## 9. Kebutuhan Non-Fungsional

- **Performa**: waktu muat halaman utama < 3 detik pada koneksi 4G standar; gambar wajib melalui pipeline optimasi (lihat 5.4).
- **Keamanan**: validasi & sanitasi input di seluruh form (termasuk form kemitraan), proteksi CSRF, rate-limiting pada endpoint publik & form submission, validasi tipe/ukuran file upload.
- **Aksesibilitas**: setiap upload gambar wajib mengisi alt text di admin (field wajib, bukan opsional — juga berkontribusi ke SEO gambar).
- **Responsif**: teruji baik di breakpoint mobile (< 480px), tablet (768px), desktop (1200px+) — mengikuti breakpoint yang sudah ada di mockup V1.
- **Kompatibilitas Browser**: Chrome, Safari, Edge, Firefox versi 2 tahun terakhir.
- **Backup**: backup database & storage media terjadwal (rekomendasi harian).

---

## 10. Strategi SEO (Search Engine Optimization)

Karena tujuan utamanya "mudah dicari di Google", SEO diperlakukan sebagai kebutuhan inti sistem sejak awal desain arsitektur — bukan tambahan di akhir — dan dipecah menjadi 4 lapisan:

### 10.1 SEO Teknis (Fondasi Sistem)
- **Rendering SSR via Nuxt 3** (lihat 5.2) — syarat utama agar seluruh konten terbaca penuh oleh crawler Google.
- `sitemap.xml` **digenerate otomatis** dari data CMS — setiap kali ada Unit Usaha/halaman baru yang di-publish admin, otomatis masuk sitemap tanpa perlu update manual.
- `robots.txt` mengatur agar halaman admin (`/admin`) tidak ter-index.
- **Canonical URL** di setiap halaman untuk mencegah duplikasi konten.
- **HTTPS/SSL wajib aktif** — Google memprioritaskan situs aman dalam ranking.
- **Core Web Vitals**: target Largest Contentful Paint (LCP) < 2.5 detik, Cumulative Layout Shift (CLS) minimal — didukung pipeline optimasi gambar WebP & lazy-load (lihat 5.4).
- Struktur URL bersih & deskriptif: `/unit-usaha/manufaktur`, bukan `/page?id=5`.

### 10.2 SEO On-Page (Dikelola dari CMS)
- **Meta title & meta description dinamis per halaman** — field ini dinaikkan menjadi **wajib di Fase 1** (bukan opsional Fase 2 seperti draf sebelumnya, lihat 7.15) untuk Beranda, Tentang, dan tiap Unit Usaha.
- **Heading terstruktur** (satu H1 per halaman, H2/H3 mengikuti hierarki konten) — diterapkan konsisten di template frontend.
- **Alt text deskriptif** di setiap gambar (bukan nama file asal) — terhubung ke field alt text wajib di bagian 9.
- **Internal linking**: halaman Unit Usaha saling terhubung ke Proyek/Klien terkait, dan Sertifikasi terhubung ke Unit Usaha relevan.
- **Structured Data (Schema.org)**:
  - `Organization` schema di Beranda (nama, logo, kontak, media sosial).
  - `LocalBusiness` / `Place` schema di setiap halaman Kantor & Lokasi (7.12) — penting untuk pencarian berbasis lokasi (mis. "perusahaan alat berat di [kota]").
  - `BreadcrumbList` schema untuk halaman Unit Usaha & sub-halamannya.

### 10.3 SEO Konten
- Setiap Unit Usaha ditulis dengan deskripsi mengandung kata kunci relevan secara alami (mis. "jasa penyewaan alat berat", "kemasan kayu ISPM#15") — bukan sekadar nama unit, tapi paragraf yang menjelaskan layanan secara spesifik dan informatif.
- Modul **Berita/Artikel Korporat** (sebelumnya opsional di ruang lingkup) **disarankan diaktifkan sejak Fase 1** — konten baru berkala adalah salah satu sinyal SEO terkuat untuk situs korporat, sekaligus memperkuat kredibilitas di mata mitra/investor.
- Halaman unduh Company Profile PDF diberi teks pendamping deskriptif (bukan tombol unduh polos tanpa konteks) agar ada konten yang bisa terindeks.

### 10.4 SEO Off-Page & Lokal
- Setup **Google Business Profile** untuk kantor pusat & tiap site operasional — data harus konsisten dengan field di 7.12 (nama, alamat, telepon sama persis — dikenal sebagai *NAP consistency*).
- Pastikan halaman **LinkedIn perusahaan** ditautkan dan brandingnya konsisten dengan website (LinkedIn berbobot tinggi untuk kredibilitas pencarian B2B).
- Daftarkan situs ke **Google Search Console** sejak hari pertama go-live untuk memonitor indexing & error crawl secara berkelanjutan.

---

## 11. Asumsi & Ketergantungan

- Klien menyediakan seluruh konten teks & data mengacu pada dokumen *Checklist Kebutuhan Website* (sheet konten) sebelum development konten dimulai.
- Klien menyediakan aset foto/gambar sesuai spesifikasi teknis pada sheet *"Kebutuhan Foto & Gambar"* — keterlambatan aset dapat menggeser timeline pengisian konten (bukan pengembangan sistem).
- Desain final mengacu pada Mockup V1 yang telah disetujui; perubahan besar pada desain di tengah development berpotensi memengaruhi timeline.
- Dokumen legalitas/sertifikasi yang ditampilkan publik adalah yang sudah difilter klien (bukan dokumen internal rahasia).
- Klien bersedia menyediakan/memperbarui data Google Business Profile & LinkedIn perusahaan untuk mendukung strategi SEO off-page di 10.4.

---

## 12. Tahapan Pengembangan (High-Level)

| Tahap | Cakupan |
|---|---|
| 1. Setup & Arsitektur | Inisialisasi repo Laravel + Nuxt 3 (SSR), setup database, setup FilamentPHP, struktur API |
| 2. Development Backend/CMS | Model data (bagian 7), API endpoint publik, dashboard admin CRUD (bagian 8) |
| 3. Development Frontend | Implementasi halaman publik sesuai Mockup V1, integrasi ke API, implementasi SSR & meta tag dinamis |
| 4. Integrasi Konten & SEO Dasar | Input konten & aset oleh admin/klien, setup sitemap/robots.txt/structured data, submit ke Google Search Console |
| 5. QA & Testing | Uji fungsi CRUD, responsif, form kemitraan, audit SEO (Core Web Vitals, structured data validator) |
| 6. Deployment | Setup hosting, domain, SSL, go-live, setup Google Business Profile |

---

## 13. Lampiran

- **Referensi Desain**: Mockup HTML V1 — `wgi-company-profile-mockup.html`
- **Referensi Konten**: `Checklist_Kebutuhan_Website_PT_WGI.xlsx` (11 sheet: identitas, konten, unit usaha, kebutuhan foto, dsb)

---

*Dokumen ini adalah draft awal PRD untuk kebutuhan development — terbuka untuk direvisi bersama tim/klien sebelum masuk tahap development.*
