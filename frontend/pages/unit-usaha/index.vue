<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Portfolio Bisnis</p>
        <h1>Delapan Pilar Unit Usaha PT WGI</h1>
        <p class="sub-lead">
          Perusahaan holding nasional dengan bisnis terintegrasi di 8 sektor strategis untuk mendukung pertumbuhan industri Indonesia.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="units-list">
        <div v-for="(unit, index) in units" :key="unit.slug" class="unit-row-card">
          <div class="unit-num">0{{ index + 1 }}</div>
          <div class="unit-info">
            <h2>{{ unit.name }}</h2>
            <p>{{ unit.desc }}</p>
            <div class="unit-services">
              <span v-for="srv in unit.services" :key="srv" class="tag">{{ srv }}</span>
            </div>
          </div>
          <div class="unit-action">
            <NuxtLink :to="`/unit-usaha/${unit.slug}`" class="btn btn-outline">Lihat Detail &rarr;</NuxtLink>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
const units = [
  {
    slug: 'perdagangan-ekspor-impor',
    name: 'Perdagangan & Ekspor-Impor',
    desc: 'Perdagangan umum komoditas serta kegiatan ekspor dan impor barang industri lintas batas.',
    services: ['Perdagangan Komoditas', 'Jasa Ekspor-Impor', 'Customs Clearance']
  },
  {
    slug: 'alat-berat',
    name: 'Alat Berat & Perawatan',
    desc: 'Jasa penyewaan, perawatan (service), dan pengadaan alat berat untuk kebutuhan proyek konstruksi dan industri.',
    services: ['Sewa Excavator & Heavy Duty', 'Maintenance Service', 'Sparepart Support']
  },
  {
    slug: 'transportasi-angkutan',
    name: 'Transportasi & Angkutan Logistics',
    desc: 'Armada angkutan darat dan solusi logistik terpadu untuk pengiriman barang industri dan material.',
    services: ['Sewa Truk & Trailer', 'Angkutan Logistik', 'Distribusi Regional']
  },
  {
    slug: 'otomotif',
    name: 'Otomotif & Maintenance',
    desc: 'Layanan pencucian, perataan, dan salon perawatan mobil profesional.',
    services: ['Auto Detailing', 'Car Wash Services', 'Perawatan Kendaraan']
  },
  {
    slug: 'manufaktur-ispm15',
    name: 'Manufaktur Kemasan Kayu (ISPM#15)',
    desc: 'Produsen kemasan kayu industri (palet, crates, boxes, dunnage) bersertifikasi internasional ISPM#15 & BARANTAN sejak 2007.',
    services: ['Palet Kayu Ekspor', 'Fasilitas Heat Treatment (HT)', 'Wooden Crates & Boxes']
  },
  {
    slug: 'konstruksi-real-estate',
    name: 'Konstruksi & Real Estate',
    desc: 'Jasa kontraktor konstruksi fisik, pengembangan properti komersial, dan perumahan.',
    services: ['Kontraktor Bangunan', 'Pengembangan Real Estate', 'Manajemen Properti']
  },
  {
    slug: 'percetakan',
    name: 'Percetakan Komersial & Industri',
    desc: 'Layanan percetakan cetak offset dan digital untuk kebutuhan promosi, kemasan, dan dokumen resmi.',
    services: ['Cetak Offset & Digital', 'Kemasan Cetak', 'Percetakan Korporat']
  },
  {
    slug: 'agribisnis',
    name: 'Agribisnis & Peternakan',
    desc: 'Pengembangan sektor pertanian, peternakan, dan perikanan terpadu berkelanjutan.',
    services: ['Pertanian Terpadu', 'Peternakan', 'Perikanan Darat']
  }
]

useSeoMeta({
  title: 'Unit Usaha — PT Wanciruso Group Indonesia',
  description: '8 Pilar Bisnis PT Wanciruso Group Indonesia: Perdagangan, Alat Berat, Transportasi, Otomotif, Manufaktur ISPM#15, Konstruksi, Percetakan, dan Agribisnis.'
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

.units-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.unit-row-card {
  display: grid;
  grid-template-columns: 80px 1fr 200px;
  align-items: center;
  gap: 30px;
  background: var(--charcoal);
  padding: 36px;
  border: 1px solid var(--grey-line);
  transition: border-color 0.3s ease;
}

.unit-row-card:hover {
  border-color: var(--red-hi);
}

.unit-num {
  font-family: 'Cormorant Garamond', serif;
  font-size: 36px;
  color: var(--red-hi);
  font-weight: 600;
}

.unit-info h2 {
  font-size: 22px;
  margin-bottom: 8px;
  font-family: 'Inter', sans-serif;
  font-weight: 700;
}

.unit-info p {
  color: var(--grey-lt);
  font-size: 14.5px;
  font-weight: 300;
  margin-bottom: 14px;
}

.unit-services {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}

.tag {
  background: var(--panel);
  border: 1px solid var(--grey-line);
  color: var(--grey-lt);
  font-size: 11px;
  padding: 4px 10px;
  font-family: 'IBM Plex Mono', monospace;
}

.unit-action {
  text-align: right;
}

@media (max-width: 860px) {
  .unit-row-card {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  .unit-action {
    text-align: left;
  }
}
</style>
