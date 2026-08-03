<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Media Center</p>
        <h1>Berita & Press Release Korporat</h1>
        <p class="sub-lead">
          Kabar terbaru mengenai aktivitas bisnis, ekspansi unit usaha, dan pengumuman resmi PT Wanciruso Group Indonesia.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="news-grid">
        <article v-for="item in newsList" :key="item.slug" class="news-card">
          <div class="news-meta">
            <span class="category">{{ item.category }}</span>
            <span class="date">{{ item.date }}</span>
          </div>
          <h2>{{ item.title }}</h2>
          <p>{{ item.excerpt }}</p>
          <NuxtLink :to="`/berita/${item.slug}`" class="btn-line" style="margin-top: 16px;">
            Baca Selengkapnya &rarr;
          </NuxtLink>
        </article>
      </div>
    </section>
  </div>
</template>

<script setup>
const newsList = [
  {
    slug: 'perluasan-fasilitas-heat-treatment-ispm15',
    title: 'PT WGI Perluas Kapasitas Fasilitas Heat Treatment Bersertifikasi BARANTAN',
    category: 'Manufaktur & Ekspor',
    date: '15 Juli 2026',
    excerpt: 'Untuk memenuhi lonjakan permintaan kemasan kayu ekspor bersertifikat ISPM#15, PT WGI melakukan modernisasi kamar pengeringan heat treatment.'
  },
  {
    slug: 'penambahan-armada-alat-berat-2026',
    title: 'Unit Usaha Alat Berat WGI Tambah 15 Unit Heavy Excavator untuk Proyek Infrastruktur',
    category: 'Alat Berat',
    date: '02 Juni 2026',
    excerpt: 'Langkah strategis peremajaan armada alat berat guna mendukung pengerjaan proyek konstruksi nasional skala besar.'
  },
  {
    slug: 'penerapan-standar-esg-holding',
    title: 'Komitmen ESG: PT WGI Terapkan Program Kemasan Kayu Ramah Lingkungan',
    category: 'Keberlanjutan & CSR',
    date: '10 Mei 2026',
    excerpt: 'Menerapkan tata kelola lingkungan yang bertanggung jawab dalam pengadaan bahan baku kayu bersumber legal.'
  }
]

useSeoMeta({
  title: 'Berita & Press Release — PT Wanciruso Group Indonesia',
  description: 'Pusat informasi berita resmi, pengumuman holding, dan press release PT Wanciruso Group Indonesia.'
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

.news-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
}

.news-card {
  background: var(--charcoal);
  padding: 36px;
  border: 1px solid var(--grey-line);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.news-meta {
  display: flex;
  justify-content: space-between;
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  color: var(--grey);
  margin-bottom: 16px;
}

.category {
  color: var(--red-hi);
  text-transform: uppercase;
}

.news-card h2 {
  font-size: 20px;
  margin-bottom: 12px;
  font-family: 'Inter', sans-serif;
  font-weight: 600;
  line-height: 1.4;
}

.news-card p {
  color: var(--grey-lt);
  font-size: 14px;
  font-weight: 300;
  line-height: 1.7;
}

@media (max-width: 900px) {
  .news-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 600px) {
  .news-grid { grid-template-columns: 1fr; }
}
</style>
