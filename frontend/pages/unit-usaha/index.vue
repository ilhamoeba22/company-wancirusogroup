<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Portfolio Bisnis</p>
        <h1>Empat Pilar Unit Usaha PT WGI</h1>
        <p class="sub-lead">
          Perusahaan holding nasional dengan portofolio bisnis terintegrasi di 4 sektor unggulan strategis untuk mendukung pertumbuhan industri dan operasional mitra.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="units-list">
        <div v-for="(unit, index) in units" :key="unit.slug" class="unit-row-card glass-card">
          <div class="unit-num">0{{ index + 1 }}</div>
          
          <div class="unit-thumb-box">
            <img :src="unit.image" :alt="unit.name" class="unit-thumb-img" />
          </div>

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
    slug: 'alat-berat',
    name: 'Alat Berat & Service',
    desc: 'Jasa penyewaan, perawatan (service), dan pengadaan armada forklift dan mobile crane untuk operasional industri, pergudangan, dan proyek.',
    services: ['Sewa Forklift & Mobile Crane', 'Maintenance Service & Perawatan', 'Sparepart Support'],
    image: '/images/heavy_equipment.jpg'
  },
  {
    slug: 'transportasi-angkutan',
    name: 'Transportasi & Angkutan Logistics',
    desc: 'Armada angkutan darat dan solusi logistik terpadu untuk pengiriman barang industri dan material.',
    services: ['Sewa Truk & Trailer', 'Angkutan Logistik', 'Distribusi Regional'],
    image: '/images/transport_logistics.jpg'
  },
  {
    slug: 'percetakan',
    name: 'Percetakan Komersil',
    desc: 'Layanan percetakan cetak offset dan digital untuk kebutuhan promosi, kemasan, dan dokumen resmi.',
    services: ['Cetak Offset & Digital', 'Kemasan Cetak', 'Percetakan Korporat'],
    image: '/images/printing_press.jpg'
  },
  {
    slug: 'otomotif',
    name: 'Otomotif & Detailing',
    desc: 'Layanan pencucian, perataan, dan salon perawatan mobil profesional.',
    services: ['Auto Detailing', 'Car Wash Services', 'Perawatan Kendaraan'],
    image: '/images/automotive_detailing.jpg'
  }
]

useSeoMeta({
  title: 'Unit Usaha — PT Wanciruso Group Indonesia',
  description: '4 Pilar Bisnis Unggulan PT Wanciruso Group Indonesia: Alat Berat & Service, Transportasi & Angkutan Logistics, Percetakan Komersil, dan Otomotif & Detailing.'
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
  gap: 24px;
}

.unit-row-card {
  display: grid;
  grid-template-columns: 60px 220px 1fr 180px;
  align-items: center;
  gap: 32px;
  padding: 28px 32px;
  border-radius: 4px;
}

.unit-num {
  font-family: 'Cormorant Garamond', serif;
  font-size: 36px;
  color: var(--red-hi);
  font-weight: 600;
  text-align: center;
}

.unit-thumb-box {
  width: 100%;
  height: 140px;
  border-radius: 4px;
  overflow: hidden;
  border: 1px solid var(--glass-border);
}

.unit-thumb-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

.unit-row-card:hover .unit-thumb-img {
  transform: scale(1.08);
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
  line-height: 1.6;
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
  border-radius: 2px;
}

.unit-action {
  text-align: right;
}

@media (max-width: 1024px) {
  .unit-row-card {
    grid-template-columns: 50px 180px 1fr;
  }
  .unit-action {
    grid-column: span 3;
    text-align: left;
    margin-top: 10px;
  }
}

@media (max-width: 768px) {
  .unit-row-card {
    grid-template-columns: 1fr;
    gap: 18px;
    padding: 24px;
  }
  .unit-num {
    text-align: left;
  }
  .unit-thumb-box {
    height: 180px;
  }
  .unit-action {
    grid-column: span 1;
    margin-top: 0;
  }
}
</style>
