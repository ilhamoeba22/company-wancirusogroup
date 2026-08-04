<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Hubungan Investor &amp; Korporat</p>
        <h1>Investor Relations &amp; Financial Governance</h1>
        <p class="sub-lead">
          Informasi keterbukaan kinerja holding, kepatuhan GCG, dan mekanisme pengajuan akses dokumen laporan keuangan audited PT Wanciruso Group Indonesia.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <!-- HIGHLIGHT KINERJA PUBLIK -->
      <div class="ir-highlight">
        <div class="section-head">
          <p class="eyebrow">Pertumbuhan Berkelanjutan</p>
          <h2>Ringkasan Kinerja Korporat</h2>
        </div>
        <div class="stats-grid">
          <div class="stat-card glass-card">
            <div class="s-val">8</div>
            <div class="s-lbl">Unit Usaha Strategis Terintegrasi</div>
          </div>
          <div class="stat-card glass-card">
            <div class="s-val">19+</div>
            <div class="s-lbl">Tahun Rekam Jejak (Sejak 2007)</div>
          </div>
          <div class="stat-card glass-card">
            <div class="s-val">100%</div>
            <div class="s-lbl">Kepatuhan Standar BARANTAN &amp; ISPM#15</div>
          </div>
        </div>
      </div>

      <!-- GATED ACCESS FORM -->
      <div class="gated-section glass-card">
        <div class="gated-box">
          <div class="gated-info">
            <span class="lock-badge">&check; Gated Access Verified Document</span>
            <h2>Permintaan Laporan Keuangan Audited</h2>
            <p>
              Dokumen laporan keuangan terperinci dan prospektus holding bersifat terbatas untuk mitra bisnis, perbankan, dan calon investor terverifikasi. Silakan lengkapi formulir di bawah ini untuk menerima tautan enkripsi.
            </p>
          </div>

          <form @submit.prevent="submitRequest" class="gated-form">
            <div v-if="submitted" class="success-alert">
              &check; Permintaan Anda telah berhasil terdaftar. Tim Investor Relations PT WGI akan meninjau kelayakan profil dan mengirimkan dokumen terenkripsi via email institusi Anda.
            </div>

            <div v-else class="form-grid">
              <div class="form-group">
                <label>Nama Lengkap *</label>
                <input v-model="form.name" type="text" required placeholder="Contoh: Budi Santoso" />
              </div>
              <div class="form-group">
                <label>Perusahaan / Institusi *</label>
                <input v-model="form.company" type="text" required placeholder="Contoh: PT Capital Investama" />
              </div>
              <div class="form-group">
                <label>Jabatan *</label>
                <input v-model="form.jobTitle" type="text" required placeholder="Contoh: Investment Director" />
              </div>
              <div class="form-group">
                <label>Email Institusi *</label>
                <input v-model="form.email" type="email" required placeholder="budi@capital.co.id" />
              </div>
              <div class="form-group full">
                <label>Nomor Telepon / Whatsapp *</label>
                <input v-model="form.phone" type="tel" required placeholder="0812xxxxxxxx" />
              </div>
              <div class="form-group full">
                <label>Tujuan Permintaan Akses *</label>
                <textarea v-model="form.purpose" rows="3" required placeholder="Jelaskan rencana investasi, pembiayaan, atau kemitraan..."></textarea>
              </div>
              <div class="form-group full">
                <button type="submit" :disabled="loading" class="btn btn-primary" style="width: 100%; justify-content: center;">
                  {{ loading ? 'Memproses Request...' : 'Kirim Permintaan Akses Dokumen' }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useApiData } from '~/composables/useApiData'

const { sendInvestorRequest } = useApiData()

const form = ref({
  name: '',
  company: '',
  jobTitle: '',
  email: '',
  phone: '',
  purpose: ''
})

const submitted = ref(false)
const loading = ref(false)

const submitRequest = async () => {
  loading.value = true
  try {
    await sendInvestorRequest(form.value)
    submitted.value = true
  } catch (e) {
    submitted.value = true
  } finally {
    loading.value = false
  }
}

useSeoMeta({
  title: 'Investor Relations — PT Wanciruso Group Indonesia',
  description: 'Informasi kinerja korporat & pengajuan akses dokumen laporan keuangan audited PT Wanciruso Group Indonesia.'
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

.ir-highlight {
  margin-bottom: 70px;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

.stat-card {
  padding: 36px;
  border-radius: 4px;
}

.s-val {
  font-family: 'Cormorant Garamond', serif;
  font-size: 48px;
  color: var(--red-hi);
  font-weight: 600;
}

.s-lbl {
  color: var(--grey-lt);
  font-size: 14px;
  margin-top: 8px;
  font-weight: 300;
}

.gated-section {
  padding: 50px;
  border-radius: 4px;
}

.lock-badge {
  display: inline-block;
  background: rgba(214, 66, 52, 0.15);
  border: 1px solid var(--red-hi);
  color: var(--red-hi);
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  padding: 6px 14px;
  margin-bottom: 18px;
  text-transform: uppercase;
  letter-spacing: 0.08em;
}

.gated-info h2 {
  font-size: 28px;
  margin-bottom: 12px;
}

.gated-info p {
  color: var(--grey-lt);
  font-size: 15px;
  font-weight: 300;
  max-width: 700px;
  margin-bottom: 36px;
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.form-group.full {
  grid-column: span 2;
}

.form-group label {
  display: block;
  font-size: 12px;
  color: var(--grey-lt);
  margin-bottom: 8px;
  text-transform: uppercase;
  font-family: 'IBM Plex Mono', monospace;
}

.form-group input, .form-group textarea {
  width: 100%;
  background: var(--black);
  border: 1px solid var(--glass-border);
  color: var(--white);
  padding: 14px 18px;
  font-size: 14px;
  font-family: 'Inter', sans-serif;
  outline: none;
  transition: border-color 0.3s ease;
  border-radius: 2px;
}

.form-group input:focus, .form-group textarea:focus {
  border-color: var(--red-hi);
}

.success-alert {
  background: rgba(46, 125, 50, 0.2);
  border: 1px solid #4CAF50;
  color: #81C784;
  padding: 24px;
  font-size: 15px;
}

@media (max-width: 768px) {
  .stats-grid { grid-template-columns: 1fr; }
  .form-grid { grid-template-columns: 1fr; }
  .form-group.full { grid-column: span 1; }
  .gated-section { padding: 30px; }
}
</style>
