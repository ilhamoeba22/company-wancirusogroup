<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Pusat Informasi &amp; PDF</p>
        <h1>Pusat Unduhan Dokumen Resmi</h1>
        <p class="sub-lead">
          Unduh profil perusahaan (Company Profile), brosur 8 unit usaha, serta berkas publikasi resmi PT Wanciruso Group Indonesia dalam format PDF.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="download-grid">
        <div v-for="doc in docs" :key="doc.id || doc.judul" class="download-card glass-card">
          <div class="doc-icon">📄</div>
          <div class="doc-info">
            <span class="category-tag">{{ doc.kategori || 'Holding' }}</span>
            <h2>{{ doc.judul }}</h2>
            <p>{{ doc.deskripsi }}</p>
            <div class="doc-meta">
              <span>Versi {{ doc.versi || '1.0' }}</span> &bull;
              <span>PDF Document</span>
            </div>
          </div>
          <div class="doc-action">
            <a :href="doc.file_path || '#'" target="_blank" class="btn btn-outline" download>
              Unduh PDF &darr;
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const fallbackDocs = [
  {
    judul: 'Company Profile PT Wanciruso Group Indonesia (2026 Edition)',
    kategori: 'Corporate Holding',
    deskripsi: 'Profil lengkap holding korporat, visi-misi, sejarah sejak 2007, struktur 8 unit bisnis, sertifikasi ISPM#15, dan tata kelola GCG.',
    versi: '2026.1',
    file_path: '/files/Company_Profile_PT_WGI.pdf'
  },
  {
    judul: 'Brosur Spesifikasi Kemasan Kayu & Heat Treatment ISPM#15',
    kategori: 'Manufaktur Kayu',
    deskripsi: 'Katalog teknis kemasan kayu ekspor, spesifikasi oven Heat Treatment terverifikasi BARANTAN, serta standar palet kayu industri.',
    versi: '1.4',
    file_path: '/files/Brosur_ISPM15_Wanciruso.pdf'
  },
  {
    judul: 'Katalog Penyewaan & Perawatan Alat Berat Industri',
    kategori: 'Alat Berat',
    deskripsi: 'Daftar armada excavator, crane, loader, serta syarat kemitraan jasa perawatan (maintenance & service) alat berat industri.',
    versi: '2.0',
    file_path: '/files/Katalog_Alat_Berat_WGI.pdf'
  }
]

const docs = ref(fallbackDocs)

useSeoMeta({
  title: 'Pusat Unduhan PDF — PT Wanciruso Group Indonesia',
  description: 'Unduh dokumen resmi Company Profile, brosur unit usaha, dan katalog perizinan PT Wanciruso Group Indonesia.'
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

.download-grid {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.download-card {
  padding: 32px 36px;
  display: grid;
  grid-template-columns: 60px 1fr 200px;
  gap: 28px;
  align-items: center;
  border-radius: 4px;
}

.doc-icon {
  font-size: 38px;
}

.category-tag {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  color: var(--red-hi);
  text-transform: uppercase;
  letter-spacing: 0.1em;
}

.doc-info h2 {
  font-size: 20px;
  margin-top: 4px;
  margin-bottom: 8px;
}

.doc-info p {
  color: var(--grey-lt);
  font-size: 14px;
  font-weight: 300;
}

.doc-meta {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  color: var(--grey);
  margin-top: 10px;
}

.doc-action {
  text-align: right;
}

@media (max-width: 860px) {
  .download-card {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  .doc-action { text-align: left; }
}
</style>
