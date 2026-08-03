<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Prinsip Korporat</p>
        <h1>Tata Kelola Perusahaan (GCG)</h1>
        <p class="sub-lead">
          Penerapan Good Corporate Governance sebagai pilar akuntabilitas, transparansi, dan tanggung jawab di seluruh unit usaha PT Wanciruso Group Indonesia.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="gcg-intro">
        <h2>Pilar Utama GCG di PT WGI</h2>
        <p>
          Sebagai grup holding nasional, PT WGI meyakini bahwa tata kelola perusahaan yang sehat adalah pondasi pertumbuhan bisnis yang tangguh dan berkelanjutan.
        </p>
      </div>

      <div class="gcg-grid">
        <div class="gcg-card">
          <div class="gcg-num">01</div>
          <h3>Transparansi (*Transparency*)</h3>
          <p>Keterbukaan dalam menyajikan informasi material yang akurat, relevan, dan mudah diakses oleh para pemangku kepentingan dan mitra bisnis.</p>
        </div>

        <div class="gcg-card">
          <div class="gcg-num">02</div>
          <h3>Akuntabilitas (*Accountability*)</h3>
          <p>Kejelasan fungsi, pelaksanaan, dan pertanggungjawaban organ perusahaan agar pengelolaan holding berjalan efektif dan terukur.</p>
        </div>

        <div class="gcg-card">
          <div class="gcg-num">03</div>
          <h3>Responsibilitas (*Responsibility*)</h3>
          <p>Kepatuhan terhadap peraturan perundang-undangan, standar keselamatan K3, sertifikasi industri (ISPM#15), serta kelestarian lingkungan.</p>
        </div>

        <div class="gcg-card">
          <div class="gcg-num">04</div>
          <h3>Independensi (*Independency*)</h3>
          <p>Pengelolaan holding secara profesional tanpa benturan kepentingan dan bebas dari tekanan pihak manapun.</p>
        </div>

        <div class="gcg-card">
          <div class="gcg-num">05</div>
          <h3>Kewajaran (*Fairness*)</h3>
          <p>Keadilan dan kesetaraan dalam memenuhi hak-hak pemangku kepentingan (*stakeholders*) yang timbul berdasarkan perjanjian dan peraturan.</p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
useSeoMeta({
  title: 'Tata Kelola Perusahaan (GCG) — PT Wanciruso Group Indonesia',
  description: 'Penerapan 5 prinsip Good Corporate Governance (GCG) pada PT Wanciruso Group Indonesia.'
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

.gcg-intro {
  max-width: 700px;
  margin-bottom: 50px;
}

.gcg-intro h2 {
  font-size: 32px;
  margin-bottom: 16px;
}

.gcg-intro p {
  color: var(--grey-lt);
  font-size: 16px;
  font-weight: 300;
}

.gcg-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

.gcg-card {
  background: var(--charcoal);
  padding: 36px;
  border: 1px solid var(--grey-line);
}

.gcg-num {
  font-family: 'IBM Plex Mono', monospace;
  color: var(--red-hi);
  font-size: 14px;
  margin-bottom: 16px;
}

.gcg-card h3 {
  font-family: 'Inter', sans-serif;
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 12px;
}

.gcg-card p {
  color: var(--grey-lt);
  font-size: 14px;
  font-weight: 300;
  line-height: 1.7;
}

@media (max-width: 900px) {
  .gcg-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 600px) {
  .gcg-grid { grid-template-columns: 1fr; }
}
</style>
