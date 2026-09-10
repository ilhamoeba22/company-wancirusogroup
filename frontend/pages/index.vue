<template>
  <div class="home-page">
    <!-- HERO SECTION WITH LUXURY BACKGROUND IMAGE -->
    <section class="hero">
      <div class="hero-bg" :style="{ backgroundImage: `url('/images/hero_bg.jpg')` }"></div>
      <div class="hero-overlay"></div>
      <div class="hero-num-bg">01</div>
      <div class="wrap">
        <div class="hero-content">
          <div class="hero-text-block">
            <p class="eyebrow floating">Holding Company Lintas Sektor</p>
            <h1>Satu Grup, <br class="desktop-only" />Banyak <em>Sektor</em>, <br class="desktop-only" />Satu Komitmen Mitra.</h1>
            <p class="sub">
              PT Wanciruso Group Indonesia (WGI) memposisikan diri sebagai perusahaan holding terkemuka yang menaungi 8 unit bisnis strategis. Kami menghadirkan standar internasional (ISPM#15 & BARANTAN), efisiensi operasional, dan tata kelola korporat terbaik bagi seluruh mitra bisnis dan investor.
            </p>
            <div class="hero-actions">
              <NuxtLink to="/unit-usaha" class="btn btn-primary">Jelajahi 8 Pilar Bisnis</NuxtLink>
              <NuxtLink to="/kontak" class="btn btn-outline">Konsultasi Kemitraan</NuxtLink>
            </div>
          </div>
          <div class="hero-meta glass-card">
            <div>
              <div class="num">2007</div>
              <div class="lbl">Awal Berdiri</div>
            </div>
            <div>
              <div class="num">8</div>
              <div class="lbl">Pilar Bisnis</div>
            </div>
            <div>
              <div class="num">ISPM#15</div>
              <div class="lbl">Sertifikasi Internasional</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- MARQUEE SECTORS TRACK -->
    <div class="marquee-wrap">
      <div class="marquee-track">
        <div class="grp">
          <span>Perdagangan &amp; Ekspor-Impor</span>
          <span>Alat Berat &amp; Service</span>
          <span>Transportasi &amp; Angkutan</span>
          <span>Otomotif &amp; Detailing</span>
          <span>Manufaktur (ISPM#15)</span>
          <span>Konstruksi &amp; Real Estate</span>
          <span>Percetakan</span>
          <span>Agribisnis</span>
        </div>
        <div class="grp">
          <span>Perdagangan &amp; Ekspor-Impor</span>
          <span>Alat Berat &amp; Service</span>
          <span>Transportasi &amp; Angkutan</span>
          <span>Otomotif &amp; Detailing</span>
          <span>Manufaktur (ISPM#15)</span>
          <span>Konstruksi &amp; Real Estate</span>
          <span>Percetakan</span>
          <span>Agribisnis</span>
        </div>
      </div>
    </div>

    <!-- TENTANG KAMI HIGHLIGHT WITH FACTORY IMAGE -->
    <section id="tentang">
      <div class="wrap about-wrap">
        <div>
          <div class="about-figure glass-card">
            <img src="/images/about_factory.jpg" alt="Fasilitas Manufaktur Kayu ISPM#15 WGI" class="about-img" />
            <div class="year-badge">Est. 2007 &bull; ISPM#15</div>
          </div>
        </div>
        <div>
          <p class="eyebrow">Rekam Jejak & Legasi</p>
          <h2 style="margin-top:16px; font-size:clamp(24px,3.6vw,40px);">
            Dari Usaha Spesialis Kemasan Kayu,<br class="desktop-only" />Menjadi Holding Nasional Terpercaya
          </h2>
          <div class="about-body" style="margin-top:24px;">
            <p>Perjalanan PT WGI membuktikan ketangguhan dan profesionalisme dalam melayani kebutuhan industri nasional hingga mancanegara.</p>
            <p>
              Berawal dari <strong>CV. Wanciruso</strong> pada tahun 2007 — produsen spesialis kemasan kayu ekspor bersertifikasi <strong>ISPM#15</strong> dan terverifikasi oleh <strong>Badan Karantina Pertanian (BARANTAN)</strong> — kami bertransformasi menjadi induk holding yang menaungi 8 sektor bisnis unggulan.
            </p>
          </div>

          <div class="timeline">
            <div class="tl-item glass-card">
              <div class="tl-year">2007</div>
              <div class="tl-body">
                <h4>CV. Wanciruso Didirikan</h4>
                <p>Spesialis kemasan kayu ekspor &amp; fasilitas Heat Treatment oven terverifikasi BARANTAN.</p>
              </div>
            </div>
            <div class="tl-item glass-card" style="margin-top: 14px;">
              <div class="tl-year">Kini</div>
              <div class="tl-body">
                <h4>Transformasi Menjadi PT WGI</h4>
                <p>Holding company nasional terintegrasi di 8 sektor usaha strategis.</p>
              </div>
            </div>
          </div>

          <div style="margin-top: 32px;">
            <NuxtLink to="/tentang-kami" class="btn-line">Baca Profil Selengkapnya &rarr;</NuxtLink>
          </div>
        </div>
      </div>
    </section>


    <!-- UNIT USAHA (8 PILAR BISNIS) - DYNAMIC REST API CONSUMPTION -->
    <section id="unit">
      <div class="wrap">
        <div class="section-head">
          <p class="eyebrow">Portfolio Bisnis</p>
          <h2>Delapan Pilar Bisnis PT WGI</h2>
          <p>Beragam sektor strategis, dipandu oleh komitmen kualitas dan tata kelola korporat yang profesional.</p>
        </div>

        <div class="grid-units">
          <NuxtLink
            v-for="(unit, index) in displayUnits"
            :key="unit.slug"
            :to="`/unit-usaha/${unit.slug}`"
            class="unit-card glass-card"
          >
            <div class="unit-card-img-wrap">
              <img :src="unit.image || getUnitImage(unit.slug)" :alt="unit.nama_unit || unit.name" class="unit-card-img" />
              <div class="unit-card-img-overlay"></div>
              <div class="unit-idx">0{{ index + 1 }}</div>
            </div>
            <h3>{{ unit.nama_unit || unit.name }}</h3>
            <p>{{ unit.deskripsi_umum || unit.desc }}</p>
            <span class="unit-card-link">Eksplorasi Pilar &rarr;</span>
          </NuxtLink>
        </div>
      </div>
    </section>

    <!-- KEUNGGULAN KORPORAT -->
    <section id="keunggulan" class="adv-section">
      <div class="wrap">
        <div class="section-head">
          <p class="eyebrow">Keunggulan Solusi</p>
          <h2>Mengapa Bermitra Dengan PT WGI</h2>
        </div>
        <div class="adv-grid">
          <div class="adv-item glass-card">
            <div class="adv-num">01</div>
            <h3>Rekam Jejak Terpercaya</h3>
            <p>Berakar dari usaha bersertifikasi internasional ISPM#15 sejak 2007, diverifikasi oleh Badan Karantina Pertanian BARANTAN.</p>
          </div>
          <div class="adv-item glass-card">
            <div class="adv-num">02</div>
            <h3>Diversifikasi Sektor</h3>
            <p>Delapan lini usaha strategis yang saling melengkapi dan terintegrasi dalam satu grup holding.</p>
          </div>
          <div class="adv-item glass-card">
            <div class="adv-num">03</div>
            <h3>Tata Kelola Profesional</h3>
            <p>Didukung SDM kompeten, kepatuhan regulasi tinggi, serta manajemen terpadu di setiap unit usaha.</p>
          </div>
          <div class="adv-item glass-card">
            <div class="adv-num">04</div>
            <h3>Berorientasi Kolaborasi</h3>
            <p>Terbuka bermitra lintas sektor untuk pertumbuhan bisnis B2B dan investasi yang berkelanjutan.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- STATS BAND -->
    <div class="stats-band">
      <div class="wrap stats-grid">
        <div>
          <div class="stat-num">2007</div>
          <div class="stat-lbl">Tahun Berdiri</div>
        </div>
        <div>
          <div class="stat-num">8</div>
          <div class="stat-lbl">Sektor Usaha</div>
        </div>
        <div>
          <div class="stat-num">56°C</div>
          <div class="stat-lbl">Standar Heat Treatment</div>
        </div>
        <div>
          <div class="stat-num">ISPM#15</div>
          <div class="stat-lbl">Sertifikasi Internasional</div>
        </div>
      </div>
    </div>

    <!-- CTA SECTION -->
    <section id="kontak" class="cta-section">
      <div class="wrap">
        <p class="eyebrow center">Kemitraan Strategic</p>
        <h2>Mari Kembangkan Bisnis Bersama PT WGI</h2>
        <p>Untuk kerja sama bisnis, kemitraan B2B, maupun informasi lebih lanjut mengenai unit usaha kami, silakan hubungi tim kami.</p>
        <div class="cta-actions">
          <NuxtLink to="/kontak" class="btn btn-primary">Hubungi Kami</NuxtLink>
          <NuxtLink to="/pusat-unduhan" class="btn btn-outline">Unduh Company Profile</NuxtLink>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useApiData } from '~/composables/useApiData'

const { fetchUnitUsaha } = useApiData()

const unitImages = {
  'perdagangan-ekspor-impor': '/images/trade_export_import.jpg',
  'alat-berat': '/images/heavy_equipment.jpg',
  'transportasi-angkutan': '/images/transport_logistics.jpg',
  'otomotif': '/images/automotive_detailing.jpg',
  'manufaktur-ispm15': '/images/about_factory.jpg',
  'konstruksi-real-estate': '/images/construction_realestate.jpg',
  'percetakan': '/images/printing_press.jpg',
  'agribisnis': '/images/agribusiness_farm.jpg'
}

const getUnitImage = (slug) => {
  return unitImages[slug] || '/images/hero_bg.jpg'
}

const fallbackUnits = [
  { slug: 'perdagangan-ekspor-impor', name: 'Perdagangan & Ekspor-Impor', desc: 'Perdagangan umum serta kegiatan ekspor dan impor barang komoditas industri.', image: unitImages['perdagangan-ekspor-impor'] },
  { slug: 'alat-berat', name: 'Alat Berat & Perawatan', desc: 'Jasa penyewaan & perawatan (service) alat berat untuk kebutuhan proyek industri.', image: unitImages['alat-berat'] },
  { slug: 'transportasi-angkutan', name: 'Transportasi & Angkutan', desc: 'Jasa sewa angkutan dan armada transportasi logistik terpadu.', image: unitImages['transportasi-angkutan'] },
  { slug: 'otomotif', name: 'Otomotif & Detailing', desc: 'Usaha pencucian dan salon perawatan mobil profesional.', image: unitImages['otomotif'] },
  { slug: 'manufaktur-ispm15', name: 'Manufaktur (ISPM#15)', desc: 'Produksi kemasan kayu ekspor (palet, crates) bersertifikasi ISPM#15 sejak 2007.', image: unitImages['manufaktur-ispm15'] },
  { slug: 'konstruksi-real-estate', name: 'Konstruksi & Real Estate', desc: 'Kegiatan kontraktor konstruksi serta pengembangan properti komersial.', image: unitImages['konstruksi-real-estate'] },
  { slug: 'percetakan', name: 'Percetakan Komersial', desc: 'Kegiatan percetakan offset & digital untuk kebutuhan komersial.', image: unitImages['percetakan'] },
  { slug: 'agribisnis', name: 'Agribisnis', desc: 'Kegiatan pertanian, peternakan, dan perikanan terpadu.', image: unitImages['agribisnis'] }
]

const displayUnits = ref(fallbackUnits)

onMounted(async () => {
  const apiUnits = await fetchUnitUsaha()
  if (apiUnits && apiUnits.length > 0) {
    displayUnits.value = apiUnits
  }
})

useSeoMeta({
  title: 'PT Wanciruso Group Indonesia (WGI) — Perusahaan Holding Nasional',
  description: 'PT Wanciruso Group Indonesia (WGI) menaungi 8 unit usaha lintas sektor dengan standar internasional ISPM#15 & BARANTAN.'
})
</script>

<style scoped>
.desktop-only {
  display: inline;
}

/* HERO */
.hero {
  position: relative;
  min-height: auto;
  display: flex;
  align-items: center;
  padding-top: 140px;
  padding-bottom: 80px;
  overflow: hidden;
}

.hero-bg {
  position: absolute;
  inset: 0;
  z-index: 0;
  background-size: cover;
  background-position: center;
  filter: brightness(0.4) contrast(1.1);
  transform: scale(1.05);
  transition: transform 10s ease;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  z-index: 1;
  background: var(--bg-gradient);
}

.hero-num-bg {
  position: absolute;
  top: -2%;
  right: -4%;
  font-family: 'Cormorant Garamond', serif;
  font-weight: 600;
  font-size: min(46vw, 560px);
  color: transparent;
  -webkit-text-stroke: 1px var(--glass-border);
  line-height: 1;
  z-index: 1;
  pointer-events: none;
  user-select: none;
}

.hero-content {
  position: relative;
  z-index: 2;
  width: 100%;
}

.hero-text-block {
  max-width: 900px;
}

.hero h1 {
  font-size: clamp(28px, 5.2vw, 76px);
  line-height: 1.15;
  margin-top: 18px;
  word-break: break-word;
}

.hero h1 em {
  font-style: italic;
  color: var(--red-hi);
}

.hero p.sub {
  margin-top: 22px;
  max-width: 720px;
  color: var(--grey-lt);
  font-size: clamp(14px, 1.8vw, 17.5px);
  font-weight: 300;
  line-height: 1.7;
}

.hero-actions {
  display: flex;
  gap: 18px;
  margin-top: 36px;
  flex-wrap: wrap;
}

.hero-meta {
  display: flex;
  gap: 20px;
  margin-top: 50px;
  padding: 28px 36px;
  width: 100%;
  max-width: 100%;
  border-radius: 4px;
}

.hero-meta div {
  flex: 1;
  padding-right: 20px;
}

.hero-meta .num {
  font-family: 'Cormorant Garamond', serif;
  font-weight: 600;
  font-size: 32px;
  color: var(--red-hi);
}

.hero-meta .lbl {
  font-size: 10.5px;
  color: var(--grey);
  text-transform: uppercase;
  letter-spacing: 0.1em;
  margin-top: 6px;
  font-family: 'IBM Plex Mono', monospace;
}

/* MARQUEE SECTORS */
.marquee-wrap {
  position: relative;
  border-top: 1px solid var(--grey-line);
  border-bottom: 1px solid var(--grey-line);
  background: var(--charcoal);
  overflow: hidden;
  padding: 22px 0;
}

.marquee-track {
  display: flex;
  width: max-content;
  animation: marquee 34s linear infinite;
}

.marquee-track .grp {
  display: flex;
  gap: 0;
}

.marquee-track span {
  font-family: 'IBM Plex Mono', monospace;
  font-weight: 500;
  font-size: 12.5px;
  color: var(--grey);
  text-transform: uppercase;
  letter-spacing: 0.12em;
  white-space: nowrap;
  padding: 0 28px;
  border-right: 1px solid var(--grey-line);
}

@keyframes marquee {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

/* TENTANG */
.about-wrap {
  display: grid;
  grid-template-columns: 0.8fr 1fr;
  gap: 60px;
  align-items: center;
}

.about-figure {
  position: relative;
  aspect-ratio: 4/3;
  border-radius: 4px;
  overflow: hidden;
}

.about-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s ease;
}

.about-figure:hover .about-img {
  transform: scale(1.05);
}

.about-figure .year-badge {
  position: absolute;
  bottom: 20px;
  left: 20px;
  background: var(--red);
  color: #fff;
  padding: 10px 16px;
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}

.about-body p {
  color: var(--grey-lt);
  font-size: 15.5px;
  font-weight: 300;
  line-height: 1.9;
  margin-bottom: 20px;
}

.about-body p:first-child {
  font-size: 19px;
  color: var(--white);
  font-family: 'Cormorant Garamond', serif;
  font-weight: 500;
  line-height: 1.6;
}

.timeline {
  margin-top: 36px;
  display: flex;
  flex-direction: column;
  gap: 0;
}

.tl-item {
  display: grid;
  grid-template-columns: 90px 1fr;
  gap: 24px;
  padding: 24px;
  border-radius: 4px;
}

.tl-year {
  font-family: 'Cormorant Garamond', serif;
  font-weight: 600;
  font-size: 26px;
  color: var(--red-hi);
}

.tl-body h4 {
  font-size: 14.5px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}

.tl-body p {
  color: var(--grey);
  font-size: 13.5px;
  margin-top: 6px;
  font-weight: 300;
}


/* UNIT USAHA */
.grid-units {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

.unit-card {
  padding: 18px;
  display: flex;
  flex-direction: column;
  border-radius: 4px;
  overflow: hidden;
  transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.4s ease;
}

.unit-card:hover {
  transform: translateY(-4px);
  border-color: var(--red-hi);
}

.unit-card-img-wrap {
  position: relative;
  width: 100%;
  height: 140px;
  border-radius: 3px;
  overflow: hidden;
  margin-bottom: 16px;
  border: 1px solid var(--glass-border);
}

.unit-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.unit-card:hover .unit-card-img {
  transform: scale(1.08);
}

.unit-card-img-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(0, 0, 0, 0.1) 0%, rgba(14, 13, 12, 0.6) 100%);
}

.unit-idx {
  position: absolute;
  top: 10px;
  right: 10px;
  background: rgba(14, 13, 12, 0.75);
  backdrop-filter: blur(8px);
  border: 1px solid var(--glass-border);
  padding: 3px 8px;
  border-radius: 2px;
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  color: var(--red-hi);
  font-weight: 500;
  letter-spacing: 0.06em;
}

.unit-card h3 {
  font-family: 'Inter', sans-serif;
  font-weight: 700;
  font-size: 15.5px;
  text-transform: uppercase;
  letter-spacing: 0.01em;
  margin-top: 2px;
  line-height: 1.35;
}

.unit-card p {
  color: var(--grey);
  font-size: 12.5px;
  margin-top: 8px;
  font-weight: 300;
  line-height: 1.6;
  flex-grow: 1;
}

.unit-card-link {
  display: inline-block;
  margin-top: 16px;
  font-size: 12px;
  color: var(--red-hi);
  font-family: 'IBM Plex Mono', monospace;
  transition: transform 0.25s ease;
}

.unit-card:hover .unit-card-link {
  transform: translateX(4px);
}

/* KEUNGGULAN */
.adv-section {
  background: var(--charcoal);
}

.adv-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}

.adv-item {
  padding: 32px;
  border-radius: 4px;
}

.adv-num {
  font-family: 'Cormorant Garamond', serif;
  font-weight: 600;
  font-size: 44px;
  color: transparent;
  -webkit-text-stroke: 1px var(--red-hi);
  margin-bottom: 18px;
}

.adv-item h3 {
  font-size: 16.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.02em;
  font-family: 'Inter', sans-serif;
}

.adv-item p {
  color: var(--grey);
  font-size: 13.5px;
  margin-top: 10px;
  font-weight: 300;
  line-height: 1.7;
}

/* STATS BAND */
.stats-band {
  background: var(--red);
  padding: 70px 0;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  text-align: center;
}

.stat-num {
  font-family: 'Cormorant Garamond', serif;
  font-weight: 600;
  font-size: 46px;
  color: #fff;
}

.stat-lbl {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 0.75);
  margin-top: 10px;
}

/* CTA */
.cta-section {
  text-align: center;
}

.cta-section h2 {
  font-size: clamp(32px, 4.6vw, 54px);
  max-width: 760px;
  margin: 18px auto 0;
}

.cta-section p {
  color: var(--grey-lt);
  font-weight: 300;
  max-width: 480px;
  margin: 24px auto 40px;
  font-size: 15.5px;
}

.cta-actions {
  display: flex;
  gap: 18px;
  justify-content: center;
  flex-wrap: wrap;
}

@media (max-width: 980px) {
  .about-wrap { grid-template-columns: 1fr; }
  .grid-units { grid-template-columns: repeat(2, 1fr); }
  .adv-grid { grid-template-columns: repeat(2, 1fr); }
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .hero-num-bg { display: none; }
}

@media (max-width: 768px) {
  .desktop-only { display: none; }
  .hero {
    padding-top: 110px;
    padding-bottom: 50px;
  }
  .hero-actions {
    margin-top: 28px;
    flex-direction: column;
    width: 100%;
  }
  .hero-actions .btn {
    width: 100%;
    justify-content: center;
  }
  .hero-meta {
    margin-top: 36px;
    padding: 20px;
    flex-direction: column;
    gap: 16px;
  }
  .hero-meta div {
    padding-right: 0;
    border-bottom: 1px solid var(--glass-border);
    padding-bottom: 12px;
  }
  .hero-meta div:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }
}

@media (max-width: 580px) {
  .grid-units { grid-template-columns: 1fr; }
  .adv-grid { grid-template-columns: 1fr; }
  .stats-grid { grid-template-columns: 1fr; }
}
</style>
