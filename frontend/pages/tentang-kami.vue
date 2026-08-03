<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Profil Korporat</p>
        <h1>Tentang PT Wanciruso Group Indonesia</h1>
        <p class="sub-lead">
          Rekam jejak profesional yang berawal dari keahlian spesialis kemasan kayu industri sejak 2007, berkembang menjadi grup holding nasional 8 pilar bisnis.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="about-grid">
        <div class="story-card">
          <h2>Sejarah & Transformasi</h2>
          <p>
            PT Wanciruso Group Indonesia (WGI) tumbuh dari akar usaha <strong>CV. Wanciruso</strong> yang berdiri pada tahun 2007. CV. Wanciruso memposisikan diri sebagai produsen utama kemasan kayu industri (palet kayu, *wooden box*, *crates*, dan *dunnage*) bersertifikasi internasional <strong>ISPM#15</strong>.
          </p>
          <p>
            Fasilitas *heat treatment* kami diinspeksi dan diverifikasi oleh Badan Karantina Pertanian (BARANTAN) Kementerian Pertanian Republik Indonesia, memastikan seluruh kemasan bebas dari hama perusak kayu untuk standar ekspor global.
          </p>
          <p>
            Seiring pertumbuhan kepercayaan mitra dan tuntutan diversifikasi usaha, CV. Wanciruso bertransformasi menjadi **PT Wanciruso Group Indonesia** sebagai *holding company* yang menaungi 8 unit bisnis lintas sektor secara terpadu.
          </p>
        </div>

        <div class="values-card">
          <h2>Nilai-Nilai Utama (Core Values)</h2>
          <div class="value-item">
            <div class="v-num">01</div>
            <div>
              <h4>Integritas & Kepercayaan</h4>
              <p>Menjunjung tinggi komitmen, kejujuran, dan transparansi dalam setiap kemitraan bisnis.</p>
            </div>
          </div>
          <div class="value-item">
            <div class="v-num">02</div>
            <div>
              <h4>Kualitas Tanpa Kompromi</h4>
              <p>Mengabdi pada standar mutu internasional di seluruh lini produk dan jasa layanan.</p>
            </div>
          </div>
          <div class="value-item">
            <div class="v-num">03</div>
            <div>
              <h4>Inovasi & Berkelanjutan</h4>
              <p>Mengadopsi teknologi modern dan praktik ramah lingkungan untuk pertumbuhan jangka panjang.</p>
            </div>
          </div>
          <div class="value-item">
            <div class="v-num">04</div>
            <div>
              <h4>Sinergi Holding</h4>
              <p>Memaksimalkan kolaborasi antar unit bisnis untuk memberikan nilai tambah menyeluruh.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
useSeoMeta({
  title: 'Tentang Kami — PT Wanciruso Group Indonesia (WGI)',
  description: 'Sejarah perkembangan PT Wanciruso Group Indonesia dari CV. Wanciruso (2007) spesialis ISPM#15 hingga menjadi holding company dengan 8 unit usaha.'
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

.about-grid {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 60px;
}

.story-card h2, .values-card h2 {
  font-size: 30px;
  margin-bottom: 24px;
}

.story-card p {
  color: var(--grey-lt);
  font-size: 16px;
  font-weight: 300;
  line-height: 1.85;
  margin-bottom: 20px;
}

.story-card strong {
  color: var(--white);
  font-weight: 600;
}

.values-card {
  background: var(--charcoal);
  padding: 44px;
  border: 1px solid var(--grey-line);
}

.value-item {
  display: flex;
  gap: 20px;
  padding: 20px 0;
  border-top: 1px solid var(--grey-line);
}

.value-item:first-of-type {
  border-top: none;
}

.v-num {
  font-family: 'Cormorant Garamond', serif;
  font-size: 28px;
  color: var(--red-hi);
  font-weight: 600;

}

.value-item h4 {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 4px;
}

.value-item p {
  color: var(--grey);
  font-size: 13.5px;
  font-weight: 300;
}

@media (max-width: 900px) {
  .about-grid { grid-template-columns: 1fr; }
}
</style>
