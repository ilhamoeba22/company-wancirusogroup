<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Legalitas &amp; Sertifikasi Internasional</p>
        <h1>Sertifikasi Resmikan Standar Kualitas WGI</h1>
        <p class="sub-lead">
          Komitmen penuh PT Wanciruso Group Indonesia dalam mematuhi regulasi internasional kemasan kayu ekspor (ISPM#15), verifikasi Badan Karantina Pertanian (BARANTAN), serta legalitas holding terpadu.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="cert-grid">
        <div v-for="cert in certs" :key="cert.slug || cert.nama" class="cert-card glass-card">
          <div class="cert-badge">&check; {{ cert.nomor || 'TERVERIFIKASI' }}</div>
          <h2>{{ cert.nama }}</h2>
          <div class="issuer">Diterbitkan oleh: {{ cert.penerbit }}</div>
          <p>{{ cert.deskripsi }}</p>
          <div class="cert-meta">
            <span class="meta-tag">Standar: {{ cert.standar || 'ISPM#15 / BARANTAN' }}</span>
            <span class="meta-tag">Status: Aktif</span>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useApiData } from '~/composables/useApiData'

const { fetchSertifikasi } = useApiData()

const fallbackCerts = [
  {
    nama: 'Sertifikasi ISPM#15 (Kemasan Kayu Ekspor)',
    nomor: 'ID-03-087-HT',
    penerbit: 'Badan Karantina Pertanian (BARANTAN) / IPPC',
    deskripsi: 'Sertifikasi internasional wajib untuk seluruh kemasan kayu ekspor (palet kayu, crates, boxes) dengan perlakuan Heat Treatment (HT) suhu inti 56°C minimal 30 menit.',
    standar: 'IPPC ISPM#15 International Standard'
  },
  {
    nama: 'Verifikasi Operasional Oven Heat Treatment',
    nomor: 'BARANTAN-HT-VERIFIED',
    penerbit: 'Badan Karantina Pertanian Kementan RI',
    deskripsi: 'Fasilitas oven Heat Treatment milik CV. Wanciruso / PT WGI terdaftar resmi dan diawasi berkala oleh petugas BARANTAN untuk menjamin kebebasan dari hama OPTK.',
    standar: 'Permentan No. 12/2009'
  },
  {
    nama: 'NIB & Perizinan Berusaha Berbasis Risiko',
    nomor: 'NIB-9120301928471',
    penerbit: 'Kementerian Investasi / BKPM RI (OSS RBA)',
    deskripsi: 'Perizinan legalitas induk holding PT Wanciruso Group Indonesia untuk 8 sektor usaha (Perdagangan, Alat Berat, Transportasi, Otomotif, Manufaktur, Konstruksi, Percetakan, Agribisnis).',
    standar: 'OSS RBA Legal Holding'
  }
]

const certs = ref(fallbackCerts)

onMounted(async () => {
  const apiCerts = await fetchSertifikasi()
  if (apiCerts && apiCerts.length > 0) {
    certs.value = apiCerts
  }
})

useSeoMeta({
  title: 'Sertifikasi & Legalitas — PT Wanciruso Group Indonesia',
  description: 'Daftar sertifikasi internasional ISPM#15, BARANTAN, dan perizinan legal holding PT Wanciruso Group Indonesia.'
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

.cert-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 28px;
}

.cert-card {
  padding: 40px 32px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.cert-badge {
  display: inline-block;
  background: rgba(214, 66, 52, 0.15);
  border: 1px solid var(--red-hi);
  color: var(--red-hi);
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  padding: 4px 12px;
  margin-bottom: 20px;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  width: fit-content;
}

.cert-card h2 {
  font-size: 22px;
  margin-bottom: 8px;
}

.issuer {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11.5px;
  color: var(--red-hi);
  margin-bottom: 16px;
}

.cert-card p {
  color: var(--grey);
  font-size: 14px;
  font-weight: 300;
  line-height: 1.7;
  margin-bottom: 28px;
}

.cert-meta {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  padding-top: 16px;
  border-top: 1px solid var(--glass-border);
}

.meta-tag {
  font-size: 11px;
  color: var(--grey-lt);
  background: rgba(255, 255, 255, 0.04);
  padding: 4px 10px;
  border-radius: 2px;
}

@media (max-width: 980px) {
  .cert-grid { grid-template-columns: 1fr; }
}
</style>
