<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Standar & Legalitas</p>
        <h1>Sertifikasi & Legalitas Resmi Korporat</h1>
        <p class="sub-lead">
          Kepatuhan pada regulasi dan sertifikasi standar internasional untuk memastikan kredibilitas legalitas PT Wanciruso Group Indonesia.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="cert-grid">
        <div class="cert-card">
          <div class="cert-badge">Internasional</div>
          <h2>Sertifikasi ISPM#15 (Kemasan Kayu Industri)</h2>
          <p class="issuer">Diterbitkan oleh: International Plant Protection Convention (IPPC)</p>
          <p class="desc">
            Sertifikat standar internasional untuk pengolahan bahan kemasan kayu (palet, wooden box, crates, dunnage) guna menjamin kebebasan dari hama tanaman dalam perdagangan ekspor global.
          </p>
        </div>

        <div class="cert-card">
          <div class="cert-badge">Pemerintah RI</div>
          <h2>Verifikasi Kelayakan Fasilitas Heat Treatment</h2>
          <p class="issuer">Diterbitkan oleh: Badan Karantina Pertanian (BARANTAN) Kementan RI</p>
          <p class="desc">
            Verifikasi resmi terhadap fasilitas pengeringan kayu (heat treatment oven) dengan standar suhu minimal 56°C selama 30 menit sesuai regulasi karantina Indonesia.
          </p>
        </div>

        <div class="cert-card">
          <div class="cert-badge">Legalitas Usaha</div>
          <h2>Nomor Induk Berusaha (NIB) Holding</h2>
          <p class="issuer">Diterbitkan oleh: Pemerintah Republik Indonesia (OSS RBA)</p>
          <p class="desc">
            Izijn usaha resmi holding PT Wanciruso Group Indonesia yang menaungi 8 Klasifikasi Baku Lapangan Usaha Indonesia (KBLI) lintas sektor.
          </p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
useSeoMeta({
  title: 'Sertifikasi & Legalitas — PT Wanciruso Group Indonesia',
  description: 'Sertifikasi ISPM#15, verifikasi BARANTAN, dan legalitas resmi PT Wanciruso Group Indonesia.'
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
  gap: 30px;
}

.cert-card {
  background: var(--charcoal);
  padding: 40px;
  border: 1px solid var(--grey-line);
  position: relative;
}

.cert-badge {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  color: var(--red-hi);
  border: 1px solid var(--red-hi);
  display: inline-block;
  padding: 3px 10px;
  margin-bottom: 20px;
  text-transform: uppercase;
}

.cert-card h2 {
  font-size: 22px;
  margin-bottom: 8px;
  font-family: 'Inter', sans-serif;
  font-weight: 700;
}

.issuer {
  color: var(--grey);
  font-size: 13px;
  font-family: 'IBM Plex Mono', monospace;
  margin-bottom: 16px;
}

.desc {
  color: var(--grey-lt);
  font-size: 14.5px;
  font-weight: 300;
  line-height: 1.7;
}

@media (max-width: 900px) {
  .cert-grid { grid-template-columns: 1fr; }
}
</style>
