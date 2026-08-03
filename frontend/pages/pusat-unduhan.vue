<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Dokumen Publik</p>
        <h1>Pusat Unduhan Dokumentasi Korporat</h1>
        <p class="sub-lead">
          Unduh dokumen profil perusahaan (Company Profile PDF), katalog produk per unit usaha, dan berkas presentasi resmi PT Wanciruso Group Indonesia.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="download-list">
        <div v-for="doc in downloads" :key="doc.id" class="download-item">
          <div class="doc-icon">PDF</div>
          <div class="doc-details">
            <h3>{{ doc.title }}</h3>
            <p>{{ doc.desc }}</p>
            <span class="doc-meta">Ukuran File: {{ doc.size }} &bull; Versi: {{ doc.version }}</span>
          </div>
          <div>
            <a :href="doc.url" class="btn btn-primary" download>Unduh File PDF</a>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
const downloads = [
  {
    id: 1,
    title: 'Company Profile PT Wanciruso Group Indonesia (Holding)',
    desc: 'Dokumen lengkap profil holding, struktur 8 unit usaha, legalitas ISPM#15, dan rekam jejak perusahaan.',
    size: '4.8 MB',
    version: '2026.1',
    url: '#'
  },
  {
    id: 2,
    title: 'Katalog Kemasan Kayu Industri & Heat Treatment (ISPM#15)',
    desc: 'Spesifikasi teknis palet kayu, wooden box, crates, dan prosedur sertifikasi BARANTAN.',
    size: '3.2 MB',
    version: '2026.1',
    url: '#'
  },
  {
    id: 3,
    title: 'Brosur Layanan Alat Berat & Armada Transportasi Logistik',
    desc: 'Daftar armada sewa excavator, heavy duty truck, dan paket layanan maintenance.',
    size: '2.9 MB',
    version: '2026.1',
    url: '#'
  }
]

useSeoMeta({
  title: 'Pusat Unduhan PDF — PT Wanciruso Group Indonesia',
  description: 'Unduh dokumen PDF Company Profile dan katalog produk 8 unit usaha PT Wanciruso Group Indonesia.'
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

.download-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.download-item {
  display: grid;
  grid-template-columns: 80px 1fr 200px;
  align-items: center;
  gap: 30px;
  background: var(--charcoal);
  padding: 32px;
  border: 1px solid var(--grey-line);
}

.doc-icon {
  width: 56px;
  height: 56px;
  background: var(--red);
  color: #fff;
  font-family: 'IBM Plex Mono', monospace;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
}

.doc-details h3 {
  font-size: 20px;
  margin-bottom: 6px;
  font-family: 'Inter', sans-serif;
  font-weight: 600;
}

.doc-details p {
  color: var(--grey-lt);
  font-size: 14px;
  font-weight: 300;
  margin-bottom: 8px;
}

.doc-meta {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  color: var(--grey);
}

@media (max-width: 768px) {
  .download-item { grid-template-columns: 1fr; }
}
</style>
