<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Detail Unit Usaha</p>
        <h1>{{ currentUnit.name }}</h1>
        <p class="sub-lead">{{ currentUnit.desc }}</p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="detail-grid">
        <div class="main-content">
          <div class="content-box">
            <h2>Layanan &amp; Produk Utama</h2>
            <ul class="service-list">
              <li v-for="srv in currentUnit.services" :key="srv">
                <span class="bullet">&bull;</span> {{ srv }}
              </li>
            </ul>
          </div>

          <div class="content-box" style="margin-top: 40px;">
            <h2>Keunggulan Unit Usaha</h2>
            <p>{{ currentUnit.advantage }}</p>
          </div>
        </div>

        <div class="sidebar">
          <div class="side-card">
            <h3>Target Pasar / Klien</h3>
            <p>{{ currentUnit.targetMarket }}</p>
          </div>

          <div class="side-card" style="margin-top: 24px;">
            <h3>Konsultasi & Kemitraan</h3>
            <p>Ingin bekerja sama atau menggunakan jasa dari unit bisnis ini?</p>
            <NuxtLink to="/kontak" class="btn btn-primary" style="margin-top: 16px; width: 100%; justify-content: center;">
              Ajukan Kemitraan
            </NuxtLink>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'

const route = useRoute()
const slug = route.params.slug

const unitData = {
  'perdagangan-ekspor-impor': {
    name: 'Perdagangan & Ekspor-Impor',
    desc: 'Perdagangan umum komoditas serta kegiatan ekspor dan impor barang industri lintas batas.',
    services: ['Perdagangan Komoditas', 'Jasa Ekspor-Impor', 'Customs Clearance & Logistik Internasional'],
    advantage: 'Jaringan mitra global yang luas dan proses kepabeanan cepat.',
    targetMarket: 'Perusahaan manufaktur, eksportir, dan komoditas nasional.'
  },
  'manufaktur-ispm15': {
    name: 'Manufaktur Kemasan Kayu (ISPM#15)',
    desc: 'Produksi kemasan kayu industri (palet, crates, boxes, dunnage) bersertifikasi internasional ISPM#15 & BARANTAN sejak 2007.',
    services: ['Palet Kayu Standar Ekspor', 'Fasilitas Heat Treatment (HT) Terverifikasi', 'Wooden Crates & Heavy Boxes'],
    advantage: 'Berpengalaman sejak 2007 (CV. Wanciruso) dengan sertifikasi resmi BARANTAN & ISPM#15.',
    targetMarket: 'Industri manufaktur ekspor, logistik, dan pergudangan.'
  },
  'alat-berat': {
    name: 'Alat Berat & Perawatan',
    desc: 'Jasa penyewaan, perawatan (service), dan pengadaan alat berat untuk kebutuhan proyek konstruksi dan industri.',
    services: ['Sewa Excavator & Heavy Duty', 'Maintenance & Repair Service', 'Sparepart Support'],
    advantage: 'Kondisi alat prima dengan dukungan mekanik bersertifikasi.',
    targetMarket: 'Kontraktor gedung/infrastruktur, tambang, dan fasilitas industri.'
  }
}

const currentUnit = computed(() => {
  return unitData[slug] || {
    name: slug.replace(/-/g, ' ').toUpperCase(),
    desc: 'Unit usaha strategis PT Wanciruso Group Indonesia.',
    services: ['Layanan Utama Unit Usaha', 'Konsultasi Layanan', 'Dukungan Operasional'],
    advantage: 'Standar profesionalisme tinggi dari PT Wanciruso Group Indonesia.',
    targetMarket: 'Mitra bisnis korporat dan industri nasional.'
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
  padding-bottom: 60px;
  background: linear-gradient(180deg, var(--charcoal) 0%, var(--black) 100%);
  border-bottom: 1px solid var(--grey-line);
}

.page-header h1 {
  font-size: clamp(32px, 4vw, 54px);
  margin-top: 16px;
  text-transform: capitalize;
}

.sub-lead {
  color: var(--grey-lt);
  font-size: 18px;
  font-weight: 300;
  max-width: 720px;
  margin-top: 20px;
}

.content-section {
  padding: 80px 0 120px;
}

.detail-grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 48px;
}

.content-box {
  background: var(--charcoal);
  padding: 40px;
  border: 1px solid var(--grey-line);
}

.content-box h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

.service-list {
  list-style: none;
}

.service-list li {
  padding: 12px 0;
  border-bottom: 1px solid var(--grey-line);
  color: var(--grey-lt);
  font-size: 16px;
  font-weight: 300;
}

.bullet {
  color: var(--red-hi);
  font-weight: bold;
  margin-right: 8px;
}

.side-card {
  background: var(--charcoal);
  padding: 32px;
  border: 1px solid var(--grey-line);
}

.side-card h3 {
  font-size: 18px;
  margin-bottom: 12px;
}

.side-card p {
  color: var(--grey-lt);
  font-size: 14px;
  font-weight: 300;
  line-height: 1.6;
}

@media (max-width: 860px) {
  .detail-grid { grid-template-columns: 1fr; }
}
</style>
