<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Berita Korporat</p>
        <h1>{{ article.title }}</h1>
        <div class="meta-bar">
          <span>Kategori: <strong>{{ article.category }}</strong></span>
          <span>Dipublikasikan: <strong>{{ article.date }}</strong></span>
        </div>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="article-body">
        <p class="lead-p">{{ article.excerpt }}</p>
        <p>
          PT Wanciruso Group Indonesia (WGI) terus menunjukkan komitmen tinggi dalam menjaga mutu pelayanan dan keandalan operasional di seluruh lini bisnis. Melalui inovasi berkelanjutan dan investasi fasilitas modern, PT WGI memastikan nilai tambah optimal bagi mitra bisnis dan pemangku kepentingan.
        </p>
        <p>
          "Inisiatif ini merupakan wujud nyata dari strategi jangka panjang holding untuk memperkuat posisi di pasar nasional maupun internasional, berlandaskan prinsip Good Corporate Governance," ujar manajemen PT WGI.
        </p>
      </div>

      <div style="margin-top: 50px;">
        <NuxtLink to="/berita" class="btn btn-outline">&larr; Kembali ke Pusat Berita</NuxtLink>
      </div>
    </section>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'

const route = useRoute()
const slug = route.params.slug

const article = computed(() => ({
  title: slug.replace(/-/g, ' ').toUpperCase(),
  category: 'Siaran Pers Korporat',
  date: '03 Agustus 2026',
  excerpt: 'Ringkasan resmi pengumuman dan langkah strategis PT Wanciruso Group Indonesia dalam mengembangkan bisnis terpadu.'
}))

useSeoMeta({
  title: computed(() => `${article.value.title} — PT WGI`),
  description: computed(() => article.value.excerpt)
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
  font-size: clamp(28px, 3.5vw, 44px);
  margin-top: 16px;
  line-height: 1.2;
}

.meta-bar {
  display: flex;
  gap: 24px;
  color: var(--grey);
  font-family: 'IBM Plex Mono', monospace;
  font-size: 12px;
  margin-top: 20px;
}

.meta-bar strong {
  color: var(--red-hi);
}

.content-section {
  padding: 80px 0 120px;
  max-width: 840px;
}

.article-body p {
  color: var(--grey-lt);
  font-size: 16px;
  font-weight: 300;
  line-height: 1.9;
  margin-bottom: 24px;
}

.lead-p {
  font-size: 20px !important;
  color: var(--white) !important;
  font-family: 'Cormorant Garamond', serif;
  font-weight: 500;
  line-height: 1.6 !important;
  border-left: 3px solid var(--red-hi);
  padding-left: 20px;
}
</style>
