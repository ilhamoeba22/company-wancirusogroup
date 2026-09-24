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
            <a 
              :href="`https://wa.me/628133032313?text=${encodeURIComponent('Halo CS PT Wanciruso Group Indonesia, saya tertarik untuk konsultasi mengenai unit usaha ' + (currentUnit.name || 'ini') + '.')}`" 
              target="_blank" 
              rel="noopener noreferrer" 
              class="btn btn-wa" 
              style="margin-top: 18px; width: 100%; justify-content: center; gap: 8px;"
            >
              <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
              </svg>
              Konsultasi Cepat via WhatsApp
            </a>
            <NuxtLink to="/kontak" class="btn btn-primary" style="margin-top: 10px; width: 100%; justify-content: center;">
              Hubungi Kantor Pusat &rarr;
            </NuxtLink>
            <NuxtLink to="/unit-usaha" class="btn btn-outline" style="margin-top: 10px; width: 100%; justify-content: center;">
              &larr; Kembali ke 8 Unit
            </NuxtLink>
          </div>
        </div>
      </div>

      <!-- INTERACTIVE GALLERY SECTION (3D SPIRAL & GRID TOGGLE) -->
      <div v-if="currentUnit.gallery && currentUnit.gallery.length" class="gallery-section" :class="{ 'theme-light': theme === 'light' }">
        <div class="gallery-head-bar">
          <div class="gallery-head-text">
            <p class="eyebrow">Dokumentasi &amp; Portofolio</p>
            <h2>Galeri Fasilitas &amp; Armada Alat Berat</h2>
            <p class="gallery-lead">
              Dokumentasi autentik kesiapan armada, fasilitas workshop, dan standar pemeliharaan teknis PT Wanciruso Group Indonesia. Jelajahi dalam visual 3D interaktif atau beralih ke tampilan grid.
            </p>
          </div>

          <!-- View Switcher -->
          <div class="gallery-view-switcher">
            <button 
              class="view-toggle-btn" 
              :class="{ active: galleryViewMode === '3d' }"
              @click="galleryViewMode = '3d'"
              title="Tampilan 3D Spiral Interaktif"
            >
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="toggle-icon">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 2a10 10 0 1 0 10 10 7 7 0 1 0-7-7 4 4 0 1 0 4 4" />
              </svg>
              <span>Visual 3D Spiral</span>
            </button>
            <button 
              class="view-toggle-btn" 
              :class="{ active: galleryViewMode === 'grid' }"
              @click="galleryViewMode = 'grid'"
              title="Tampilan Grid Tradisional"
            >
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="toggle-icon">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
              </svg>
              <span>Grid Standar</span>
            </button>
          </div>
        </div>

        <!-- 3D SPIRAL VIEW -->
        <div v-if="galleryViewMode === '3d'" class="gallery-3d-container">
          <Gallery3DSpiral 
            :items="currentUnit.gallery" 
            @open-lightbox="openLightbox" 
          />
        </div>

        <!-- 2D GRID VIEW -->
        <div v-else class="gallery-grid">
          <div 
            v-for="(item, idx) in currentUnit.gallery" 
            :key="idx" 
            class="gallery-item glass-card"
            @click="openLightbox(idx)"
          >
            <div class="gallery-img-wrap">
              <img :src="getImageSrc(item)" :alt="currentUnit.name" loading="lazy" class="gallery-img" />
              <div class="gallery-overlay">
                <span class="gallery-zoom-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="zoom-icon">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                  </svg>
                  Perbesar
                </span>
              </div>
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
                    :src="getImageSrc(currentUnit.gallery[activeImageIndex])" 
                    :alt="currentUnit.name" 
                    class="lightbox-main-img" 
                  />
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
import Gallery3DSpiral from '~/components/Gallery3DSpiral.vue'
import { useTheme } from '~/composables/useTheme'

const route = useRoute()
const slug = route.params.slug

const { theme, initTheme } = useTheme()
const galleryViewMode = ref('3d')
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

let themeObserver = null

onMounted(() => {
  if (typeof window !== 'undefined') {
    window.addEventListener('keydown', handleKeydown)
    initTheme()
    const initialTheme = document.documentElement.getAttribute('data-theme')
    if (initialTheme && (initialTheme === 'light' || initialTheme === 'dark')) {
      theme.value = initialTheme
    }
    themeObserver = new MutationObserver(() => {
      const currentTheme = document.documentElement.getAttribute('data-theme')
      if (currentTheme && (currentTheme === 'light' || currentTheme === 'dark')) {
        theme.value = currentTheme
      }
    })
    themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] })
  }
})

onUnmounted(() => {
  if (themeObserver) {
    themeObserver.disconnect()
    themeObserver = null
  }
  if (typeof window !== 'undefined') {
    window.removeEventListener('keydown', handleKeydown)
    document.body.style.overflow = ''
  }
})

const getImageSrc = (item) => {
  if (!item) return ''
  return typeof item === 'string' ? item : (item.src || item)
}

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
    desc: 'Jasa penyewaan, perawatan (service), dan pengadaan armada alat berat forklift dan mobile crane untuk kebutuhan operasional pabrik, pergudangan, logistik, dan proyek industri.',
    services: [
      'Sewa Forklift Diesel & Elektrik Berbagai Kapasitas Tonase',
      'Sewa Mobile Crane & Telescopic Crane Berlisensi',
      'Kontrak Service, Perawatan Berkala & Preventive Maintenance',
      'Penyediaan Suku Cadang (Sparepart) Original & Operator Bersertifikasi'
    ],
    advantage: 'Armada forklift dan mobile crane terawat prima dengan sertifikasi kelaikan operasi (K3), serta kesiapan tim mekanik spesialis 24/7 di lokasi proyek.',
    targetMarket: 'Pabrik manufaktur, kawasan industri, pergudangan logistik, kontraktor, dan pelabuhan.',
    image: '/images/heavy_equipment.jpg',
    badge: 'Industrial Forklift & Mobile Crane Fleet',
    gallery: [
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
      '/images/alat-berat/alat_berat_13.webp'
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

.gallery-head-bar {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 24px;
  margin-bottom: 36px;
  flex-wrap: wrap;
}

.gallery-head-text {
  flex: 1;
  min-width: 280px;
}

.gallery-head-text h2 {
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

.gallery-view-switcher {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--charcoal);
  border: 1px solid var(--glass-border);
  padding: 4px;
  border-radius: 30px;
}

.view-toggle-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  background: transparent;
  border: 1px solid transparent;
  border-radius: 20px;
  color: var(--grey-lt);
  font-size: 12.5px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.25s ease;
}

.view-toggle-btn:hover {
  color: var(--white);
}

.view-toggle-btn.active {
  background: rgba(224, 43, 32, 0.2);
  border-color: rgba(224, 43, 32, 0.5);
  color: var(--white);
}

.toggle-icon {
  width: 15px;
  height: 15px;
}

.view-toggle-btn.active .toggle-icon {
  color: var(--red-hi);
}

.gallery-3d-container {
  width: 100%;
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

/* ==========================================================
   LIGHT MODE ADAPTATIONS FOR GALLERY (.theme-light)
   ========================================================== */
.gallery-section.theme-light {
  border-top-color: var(--grey-line);
}

.gallery-section.theme-light .gallery-head-text h2 {
  color: #0F172A;
}

.gallery-section.theme-light .gallery-lead {
  color: #475569;
}

.gallery-section.theme-light .gallery-view-switcher {
  background: #FFFFFF;
  border-color: var(--grey-line);
  box-shadow: 0 2px 10px rgba(15, 23, 42, 0.06);
}

.gallery-section.theme-light .view-toggle-btn {
  color: #64748B;
}

.gallery-section.theme-light .view-toggle-btn:hover {
  color: #0F172A;
  background: rgba(15, 23, 42, 0.04);
}

.gallery-section.theme-light .view-toggle-btn.active {
  background: rgba(214, 66, 52, 0.1);
  border-color: rgba(214, 66, 52, 0.35);
  color: var(--red-hi);
}

.gallery-section.theme-light .gallery-item {
  background: #FFFFFF;
  border-color: var(--grey-line);
  box-shadow: 0 6px 20px rgba(15, 23, 42, 0.06);
}

.gallery-section.theme-light .gallery-caption {
  background: #FFFFFF;
}

.gallery-section.theme-light .gallery-caption h4 {
  color: #0F172A;
}

.gallery-section.theme-light .gallery-zoom-badge {
  background: rgba(255, 255, 255, 0.92);
  border-color: var(--grey-line);
  color: #0F172A;
  box-shadow: 0 4px 14px rgba(15, 23, 42, 0.1);
}

/* Lightbox Modal: always cinema dark so photo colors remain pure and dramatic */
.lightbox-content {
  background: #141312 !important;
  border-color: rgba(255, 255, 255, 0.15) !important;
}

.lightbox-title-bar {
  background: #141312 !important;
  border-top-color: rgba(255, 255, 255, 0.1) !important;
}

.lightbox-title-bar p {
  color: #F9F8F6 !important;
}

.lightbox-counter {
  color: #C2BFB9 !important;
}
</style>
