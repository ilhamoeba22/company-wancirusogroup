<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Pilar Bisnis PT WGI</p>
        <h1>{{ currentUnit.name }}</h1>
        <p class="sub-lead">{{ currentUnit.desc }}</p>
      </div>
    </section>

    <section class="wrap content-section">
      <!-- HERO IMAGE SHOWCASE FOR THE UNIT -->
      <div class="unit-hero-showcase glass-card">
        <img :src="currentUnit.image" :alt="currentUnit.name" class="unit-hero-img" />
        <div class="unit-hero-overlay"></div>
        <div class="unit-badge-tag">{{ currentUnit.badge || 'Unit Bisnis Terintegrasi' }}</div>
      </div>

      <div class="detail-grid">
        <div class="main-content">
          <div class="content-box glass-card">
            <h2>Layanan &amp; Portofolio Produk</h2>
            <ul class="service-list">
              <li v-for="srv in currentUnit.services" :key="srv">
                <span class="bullet">&check;</span> {{ srv }}
              </li>
            </ul>
          </div>

          <div class="content-box glass-card" style="margin-top: 32px;">
            <h2>Keunggulan Kompetitif &amp; Standar Mutu</h2>
            <p>{{ currentUnit.advantage }}</p>
          </div>
        </div>

        <div class="sidebar">
          <div class="side-card glass-card">
            <h3>Target Pasar &amp; Klien</h3>
            <p>{{ currentUnit.targetMarket }}</p>
          </div>

          <div class="side-card glass-card" style="margin-top: 24px;">
            <h3>Konsultasi &amp; Kerja Sama</h3>
            <p>Tertarik menjalin kemitraan strategis atau pengadaan dengan unit bisnis ini?</p>
            <NuxtLink to="/kontak" class="btn btn-primary" style="margin-top: 20px; width: 100%; justify-content: center;">
              Hubungi Tim Kami &rarr;
            </NuxtLink>
            <NuxtLink to="/unit-usaha" class="btn btn-outline" style="margin-top: 12px; width: 100%; justify-content: center;">
              &larr; Kembali ke 8 Unit
            </NuxtLink>
          </div>
        </div>
      </div>

      <!-- INTERACTIVE GALLERY SECTION (LIGHTBOX MODAL) -->
      <div v-if="currentUnit.gallery && currentUnit.gallery.length" class="gallery-section">
        <div class="gallery-head">
          <p class="eyebrow">Dokumentasi &amp; Portofolio</p>
          <h2>Galeri Fasilitas &amp; Armada Alat Berat</h2>
          <p class="gallery-lead">
            Dokumentasi autentik kesiapan armada, fasilitas workshop, dan standar pemeliharaan teknis PT Wanciruso Group Indonesia. Klik foto untuk melihat resolusi penuh.
          </p>
        </div>

        <div class="gallery-grid">
          <div 
            v-for="(item, idx) in currentUnit.gallery" 
            :key="idx" 
            class="gallery-item glass-card"
            @click="openLightbox(idx)"
          >
            <div class="gallery-img-wrap">
              <img :src="item.src" :alt="item.title || currentUnit.name" loading="lazy" class="gallery-img" />
              <div class="gallery-overlay">
                <span class="gallery-zoom-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="zoom-icon">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    <line x1="11" y1="8" x2="11" y2="14"/>
                    <line x1="8" y1="11" x2="14" y2="11"/>
                  </svg>
                  Perbesar
                </span>
              </div>
            </div>
            <div class="gallery-caption">
              <h4>{{ item.title }}</h4>
            </div>
          </div>
        </div>
      </div>

      <!-- LIGHTBOX MODAL -->
      <Teleport to="body">
        <Transition name="lightbox-fade">
          <div v-if="lightboxOpen" class="lightbox-backdrop" @click="closeLightbox">
            <div class="lightbox-dialog" @click.stop>
              <!-- Close Button -->
              <button class="lightbox-close-btn" @click="closeLightbox" aria-label="Tutup Galeri">
                &times;
              </button>

              <!-- Counter -->
              <div class="lightbox-counter">
                {{ activeImageIndex + 1 }} / {{ currentUnit.gallery.length }}
              </div>

              <!-- Main Stage -->
              <div class="lightbox-stage">
                <button class="lightbox-arrow prev" @click.stop="prevImage" aria-label="Foto Sebelumnya">
                  &#10094;
                </button>

                <div class="lightbox-content">
                  <img 
                    :src="currentUnit.gallery[activeImageIndex].src" 
                    :alt="currentUnit.gallery[activeImageIndex].title" 
                    class="lightbox-main-img" 
                  />
                  <div class="lightbox-title-bar">
                    <p>{{ currentUnit.gallery[activeImageIndex].title }}</p>
                  </div>
                </div>

                <button class="lightbox-arrow next" @click.stop="nextImage" aria-label="Foto Berikutnya">
                  &#10095;
                </button>
              </div>
            </div>
          </div>
        </Transition>
      </Teleport>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const slug = route.params.slug

const lightboxOpen = ref(false)
const activeImageIndex = ref(0)

const openLightbox = (index) => {
  activeImageIndex.value = index
  lightboxOpen.value = true
  if (typeof document !== 'undefined') {
    document.body.style.overflow = 'hidden'
  }
}

const closeLightbox = () => {
  lightboxOpen.value = false
  if (typeof document !== 'undefined') {
    document.body.style.overflow = ''
  }
}

const prevImage = () => {
  if (!currentUnit.value.gallery) return
  if (activeImageIndex.value > 0) {
    activeImageIndex.value--
  } else {
    activeImageIndex.value = currentUnit.value.gallery.length - 1
  }
}

const nextImage = () => {
  if (!currentUnit.value.gallery) return
  if (activeImageIndex.value < currentUnit.value.gallery.length - 1) {
    activeImageIndex.value++
  } else {
    activeImageIndex.value = 0
  }
}

const handleKeydown = (e) => {
  if (!lightboxOpen.value) return
  if (e.key === 'Escape') closeLightbox()
  if (e.key === 'ArrowLeft') prevImage()
  if (e.key === 'ArrowRight') nextImage()
}

onMounted(() => {
  if (typeof window !== 'undefined') {
    window.addEventListener('keydown', handleKeydown)
  }
})

onUnmounted(() => {
  if (typeof window !== 'undefined') {
    window.removeEventListener('keydown', handleKeydown)
    document.body.style.overflow = ''
  }
})

const unitData = {
  'perdagangan-ekspor-impor': {
    name: 'Perdagangan & Ekspor-Impor',
    desc: 'Perdagangan umum komoditas serta kegiatan ekspor dan impor barang industri lintas batas dengan jaringan logistik internasional.',
    services: [
      'Perdagangan Komoditas Pertanian, Hasil Hutan & Manufaktur',
      'Jasa Ekspor & Impor Barang Industri Lintas Batas',
      'Customs Clearance & Kepabeanan Terpadu',
      'Manajemen Freight Forwarding & Kontainer'
    ],
    advantage: 'Didukung lisensi legalitas ekspor-impor lengkap, koneksi pelabuhan utama nasional, serta proses kepabeanan cepat dan transparan.',
    targetMarket: 'Perusahaan manufaktur, eksportir komoditas, buyer luar negeri, dan distributor industri nasional.',
    image: '/images/trade_export_import.jpg',
    badge: 'International Trade & Global Sourcing'
  },
  'alat-berat': {
    name: 'Alat Berat & Perawatan',
    desc: 'Jasa penyewaan, perawatan (service), dan pengadaan armada alat berat untuk kebutuhan proyek konstruksi, infrastruktur, dan tambang.',
    services: [
      'Sewa Excavator, Crane, Bulldozer & Wheel Loader',
      'Kontrak Service, Perawatan Berkala & Preventive Maintenance',
      'Penyediaan Suku Cadang (Sparepart) Original',
      'Mobilisasi Alat Berat & Operator Bersertifikasi'
    ],
    advantage: 'Armada mesin terawat prima dengan standar keselamatan K3 tinggi, serta kesiapan tim mekanik spesialis 24/7 di lokasi proyek.',
    targetMarket: 'Kontraktor gedung & infrastruktur, pengembang kawasan industri, pertambangan, dan instansi pemerintah.',
    image: '/images/heavy_equipment.jpg',
    badge: 'Heavy Machinery Fleet & Maintenance Support',
    gallery: [
      { src: '/images/alat-berat/alat_berat_01.webp', title: 'Excavator Heavy Duty - Armada Unit 01' },
      { src: '/images/alat-berat/alat_berat_02.webp', title: 'Inspeksi & Pemeliharaan Komponen Utama' },
      { src: '/images/alat-berat/alat_berat_03.webp', title: 'Fasilitas Workshop Perawatan & Service' },
      { src: '/images/alat-berat/alat_berat_04.webp', title: 'Kesiapan Armada Operasional Proyek' },
      { src: '/images/alat-berat/alat_berat_05.webp', title: 'Pengecekan Sistem Hidrolik & Kontrol' },
      { src: '/images/alat-berat/alat_berat_06.webp', title: 'Armada Heavy Duty Terawat Siap Kerja' },
      { src: '/images/alat-berat/alat_berat_07.webp', title: 'Area Workshop Mekanik Bersertifikasi' },
      { src: '/images/alat-berat/alat_berat_08.webp', title: 'Unit Excavator Siaga Lapangan' },
      { src: '/images/alat-berat/alat_berat_09.webp', title: 'Manajemen Preventive Maintenance Berkala' },
      { src: '/images/alat-berat/alat_berat_10.webp', title: 'Armada Siap Kerja Proyek Industri' },
      { src: '/images/alat-berat/alat_berat_11.webp', title: 'Pemeriksaan Detail Komponen & Sparepart' },
      { src: '/images/alat-berat/alat_berat_12.webp', title: 'Operasional Lapangan & Dukungan Teknis' },
      { src: '/images/alat-berat/alat_berat_13.webp', title: 'Standar Keselamatan K3 Armada Mesin' },
      { src: '/images/alat-berat/alat_berat_14.webp', title: 'Pengecekan Mesin & Engine Unit Berkala' },
      { src: '/images/alat-berat/alat_berat_15.webp', title: 'Unit Siap Mobilisasi ke Lokasi Proyek' }
    ]
  },
  'transportasi-angkutan': {
    name: 'Transportasi & Angkutan Logistics',
    desc: 'Armada angkutan darat dan solusi logistik terpadu untuk pengiriman barang industri, kontainer, dan material curah.',
    services: [
      'Sewa Truk Tronton, Wingbox, Trailer & Fuso',
      'Jasa Angkutan Logistik Reguler & Charter Antarkota/Provinsi',
      'Distribusi Material Industri & Komoditas Perdagangan',
      'Sistem Pelacakan Pengiriman (Fleet Management)'
    ],
    advantage: 'Ratusan rute terhubung dengan armada prima, ketepatan waktu pengiriman terjamin, serta proteksi keamanan muatan barang.',
    targetMarket: 'Pabrik manufaktur, distributor FMCG, operator logistik pihak ketiga (3PL), dan pedagang besar.',
    image: '/images/transport_logistics.jpg',
    badge: 'Commercial Freight & Logistics Distribution'
  },
  'otomotif': {
    name: 'Otomotif & Maintenance',
    desc: 'Layanan pencucian modern, auto detailing profesional, dan salon perawatan estetika kendaraan roda empat maupun armada korporat.',
    services: [
      'Premium Auto Detailing & Paint Protection Film (PPF)',
      'Ceramic Nano Coating 9H',
      'Car Wash & Undercarriage High-Pressure Wash',
      'Paket Perawatan Armada Operasional Perusahaan (Fleet Detailing)'
    ],
    advantage: 'Penggunaan bahan kimia detailing kelas dunia, teknisi bersertifikasi, serta fasilitas studio modern dengan pencahayaan inspeksi presisi.',
    targetMarket: 'Pemilik kendaraan pribadi, kolektor otomotif, instansi korporat, dan penyedia rental mobil.',
    image: '/images/automotive_detailing.jpg',
    badge: 'Precision Auto Detailing & Care Studio'
  },
  'manufaktur-ispm15': {
    name: 'Manufaktur Kemasan Kayu (ISPM#15)',
    desc: 'Produsen kemasan kayu industri (palet, crates, boxes, dunnage) bersertifikasi internasional ISPM#15 & BARANTAN sejak 2007.',
    services: [
      'Palet Kayu Standar Ekspor (Two-Way & Four-Way Pallets)',
      'Fasilitas Heat Treatment (HT) Terverifikasi Suhu 56°C BARANTAN',
      'Custom Heavy-Duty Wooden Boxes & Crates Mesin Industri',
      'Sertifikat Karantina & Stempel Resmi ISPM#15'
    ],
    advantage: 'Pondasi legasi utama grup sejak 2007 (CV. Wanciruso), oven HT berkapasitas ribuan palet per siklus, dan kepatuhan 100% regulasi karantina internasional.',
    targetMarket: 'Eksportir komponen otomotif, elektronik, industri kimia, logistik farmasi, dan kargo ekspor.',
    image: '/images/about_factory.jpg',
    badge: 'Certified ISPM#15 & BARANTAN Heat Treatment'
  },
  'konstruksi-real-estate': {
    name: 'Konstruksi & Real Estate',
    desc: 'Jasa kontraktor konstruksi fisik, pengembangan properti komersial, perumahan, dan manajemen kawasan.',
    services: [
      'General Contractor Gedung Komersial & Pergudangan',
      'Pembangunan Kawasan Perumahan & Ruko Usaha',
      'Pekerjaan Sipil, Struktur Baja & Arsitektur',
      'Manajemen & Pengembangan Properti Strategis'
    ],
    advantage: 'Perencanaan desain terintegrasi, efisiensi rantai pasok material langsung dari grup, serta ketepatan jadwal serah terima bangunan.',
    targetMarket: 'Investor properti, korporat perbankan/ritel, pembeli rumah tinggal, dan pengembang kawasan industri.',
    image: '/images/construction_realestate.jpg',
    badge: 'Integrated Property & Civil Construction'
  },
  'percetakan': {
    name: 'Percetakan Komersial & Industri',
    desc: 'Layanan percetakan cetak offset dan digital skala besar untuk kebutuhan promosi, kemasan produk, dan dokumen resmi korporat.',
    services: [
      'Cetak Offset Skala Besar (Katalog, Buku, Kalender)',
      'Kemasan Karton Produk & Packaging Box',
      'Digital Printing Cepat Kebutuhan Event & Promosi',
      'Finishing Mewah (Hot Stamping Foil, Emboss, UV Spot, Laminating)'
    ],
    advantage: 'Mesin cetak multi-warna berkecepatan tinggi, akurasi reproduksi warna tajam, serta fleksibilitas kuantitas pesanan.',
    targetMarket: 'Departemen marketing korporat, produsen makanan & minuman, penerbit, dan agensi periklanan.',
    image: '/images/printing_press.jpg',
    badge: 'Commercial Offset & Industrial Packaging Print'
  },
  'agribisnis': {
    name: 'Agribisnis & Peternakan',
    desc: 'Pengembangan sektor pertanian modern, peternakan, dan perikanan terpadu berkelanjutan untuk ketahanan pangan nasional.',
    services: [
      'Budidaya Pertanian Modern & Greenhouse',
      'Pengembangan Peternakan Terpadu',
      'Pengelolaan Perikanan Darat & Pasca Panen',
      'Penyediaan Komoditas Segar untuk Rantai Pasok Industri'
    ],
    advantage: 'Penerapan teknologi pertanian ramah lingkungan, manajemen rantai pasok dingin (cold chain), serta hasil panen berkualitas konsisten.',
    targetMarket: 'Industri pengolahan makanan, pasar induk & supermarket modern, horeka (hotel, resto, kafe), dan eksportir agrikultur.',
    image: '/images/agribusiness_farm.jpg',
    badge: 'Sustainable Agriculture & Livestock Development'
  }
}

const currentUnit = computed(() => {
  return unitData[slug] || {
    name: slug.replace(/-/g, ' ').toUpperCase(),
    desc: 'Unit usaha strategis PT Wanciruso Group Indonesia.',
    services: ['Layanan Utama Unit Usaha', 'Konsultasi Layanan', 'Dukungan Operasional'],
    advantage: 'Standar profesionalisme tinggi dari PT Wanciruso Group Indonesia.',
    targetMarket: 'Mitra bisnis korporat dan industri nasional.',
    image: '/images/hero_bg.jpg',
    badge: 'PT WGI Business Pillar'
  }
})

useSeoMeta({
  title: computed(() => `${currentUnit.value.name} — PT Wanciruso Group Indonesia`),
  description: computed(() => currentUnit.value.desc)
})
</script>

<style scoped>
.page-header {
  padding-top: 160px;
  padding-bottom: 50px;
  background: linear-gradient(180deg, var(--charcoal) 0%, var(--black) 100%);
  border-bottom: 1px solid var(--grey-line);
}

.page-header h1 {
  font-size: clamp(32px, 4vw, 54px);
  margin-top: 16px;
}

.sub-lead {
  color: var(--grey-lt);
  font-size: 18px;
  font-weight: 300;
  max-width: 760px;
  margin-top: 20px;
  line-height: 1.7;
}

.content-section {
  padding: 50px 0 120px;
}

/* UNIT HERO SHOWCASE */
.unit-hero-showcase {
  position: relative;
  width: 100%;
  height: 400px;
  border-radius: 4px;
  overflow: hidden;
  margin-bottom: 50px;
}

.unit-hero-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}

.unit-hero-showcase:hover .unit-hero-img {
  transform: scale(1.04);
}

.unit-hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(14, 13, 12, 0.2) 0%, rgba(14, 13, 12, 0.75) 100%);
}

.unit-badge-tag {
  position: absolute;
  bottom: 24px;
  left: 24px;
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  backdrop-filter: blur(12px);
  padding: 8px 18px;
  border-radius: 2px;
  color: var(--white);
  font-family: 'IBM Plex Mono', monospace;
  font-size: 12px;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}

/* DETAIL GRID */
.detail-grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 40px;
}

.content-box {
  padding: 40px;
  border-radius: 4px;
}

.content-box h2 {
  font-size: 24px;
  margin-bottom: 22px;
}

.content-box p {
  color: var(--grey-lt);
  font-size: 15.5px;
  font-weight: 300;
  line-height: 1.8;
}

.service-list {
  list-style: none;
}

.service-list li {
  padding: 14px 0;
  border-bottom: 1px solid var(--glass-border);
  color: var(--grey-lt);
  font-size: 15.5px;
  font-weight: 300;
  display: flex;
  align-items: center;
}

.service-list li:last-child {
  border-bottom: none;
}

.bullet {
  color: var(--red-hi);
  font-weight: bold;
  margin-right: 12px;
  font-size: 14px;
}

.side-card {
  padding: 32px;
  border-radius: 4px;
}

.side-card h3 {
  font-size: 18px;
  margin-bottom: 14px;
}

.side-card p {
  color: var(--grey-lt);
  font-size: 14px;
  font-weight: 300;
  line-height: 1.7;
}

/* GALLERY SECTION */
.gallery-section {
  margin-top: 80px;
  padding-top: 60px;
  border-top: 1px solid var(--grey-line);
}

.gallery-head {
  margin-bottom: 36px;
}

.gallery-head h2 {
  font-size: clamp(26px, 3.2vw, 36px);
  margin-top: 8px;
}

.gallery-lead {
  color: var(--grey-lt);
  font-size: 16px;
  font-weight: 300;
  line-height: 1.7;
  max-width: 740px;
  margin-top: 12px;
}

.gallery-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

.gallery-item {
  border-radius: 4px;
  overflow: hidden;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.4s ease;
}

.gallery-item:hover {
  transform: translateY(-5px);
  border-color: var(--red-hi);
}

.gallery-img-wrap {
  position: relative;
  width: 100%;
  height: 220px;
  overflow: hidden;
  background: var(--charcoal);
}

.gallery-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.gallery-item:hover .gallery-img {
  transform: scale(1.08);
}

.gallery-overlay {
  position: absolute;
  inset: 0;
  background: rgba(14, 13, 12, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
  opacity: 1;
}

.gallery-zoom-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  background: var(--glass-bg);
  backdrop-filter: blur(10px);
  border: 1px solid var(--glass-border);
  color: var(--white);
  border-radius: 20px;
  font-size: 12px;
  font-family: 'IBM Plex Mono', monospace;
  letter-spacing: 0.05em;
  transform: scale(0.9);
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.gallery-item:hover .gallery-zoom-badge {
  transform: scale(1);
}

.zoom-icon {
  width: 16px;
  height: 16px;
  color: var(--red-hi);
}

.gallery-caption {
  padding: 16px 18px;
}

.gallery-caption h4 {
  font-size: 13.5px;
  font-weight: 500;
  color: var(--white);
  line-height: 1.4;
  margin: 0;
}

/* LIGHTBOX MODAL */
.lightbox-backdrop {
  position: fixed;
  inset: 0;
  z-index: 9999;
  background: rgba(10, 9, 8, 0.94);
  backdrop-filter: blur(16px);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

.lightbox-dialog {
  position: relative;
  max-width: 1100px;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.lightbox-close-btn {
  position: absolute;
  top: -46px;
  right: 0;
  background: none;
  border: none;
  color: var(--white);
  font-size: 38px;
  line-height: 1;
  cursor: pointer;
  transition: color 0.25s ease, transform 0.25s ease;
  z-index: 10;
}

.lightbox-close-btn:hover {
  color: var(--red-hi);
  transform: rotate(90deg);
}

.lightbox-counter {
  position: absolute;
  top: -36px;
  left: 0;
  font-family: 'IBM Plex Mono', monospace;
  font-size: 13px;
  color: var(--grey-lt);
  letter-spacing: 0.1em;
}

.lightbox-stage {
  position: relative;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.lightbox-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  backdrop-filter: blur(10px);
  color: var(--white);
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  z-index: 5;
}

.lightbox-arrow:hover {
  background: var(--red-hi);
  border-color: var(--red-hi);
  transform: translateY(-50%) scale(1.1);
}

.lightbox-arrow.prev {
  left: -20px;
}

.lightbox-arrow.next {
  right: -20px;
}

.lightbox-content {
  max-width: 960px;
  width: 100%;
  border-radius: 4px;
  overflow: hidden;
  background: var(--charcoal);
  border: 1px solid var(--glass-border);
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7);
}

.lightbox-main-img {
  width: 100%;
  max-height: 70vh;
  object-fit: contain;
  display: block;
  background: #000;
}

.lightbox-title-bar {
  padding: 16px 24px;
  background: var(--charcoal);
  border-top: 1px solid var(--glass-border);
}

.lightbox-title-bar p {
  color: var(--white);
  font-size: 14.5px;
  font-weight: 500;
  margin: 0;
}

/* TRANSITION ANIMATIONS */
.lightbox-fade-enter-active,
.lightbox-fade-leave-active {
  transition: opacity 0.3s ease;
}

.lightbox-fade-enter-from,
.lightbox-fade-leave-to {
  opacity: 0;
}

@media (max-width: 980px) {
  .detail-grid {
    grid-template-columns: 1fr;
  }
  .unit-hero-showcase {
    height: 280px;
  }
  .gallery-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .lightbox-arrow.prev {
    left: 10px;
  }
  .lightbox-arrow.next {
    right: 10px;
  }
}

@media (max-width: 640px) {
  .gallery-grid {
    grid-template-columns: 1fr;
  }
  .gallery-img-wrap {
    height: 200px;
  }
  .unit-hero-showcase {
    height: 220px;
  }
  .lightbox-arrow {
    width: 40px;
    height: 40px;
    font-size: 16px;
  }
}
</style>
