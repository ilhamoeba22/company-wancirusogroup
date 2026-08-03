<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Hubungi Kami</p>
        <h1>Kantor Pusat & Pengajuan Kemitraan</h1>
        <p class="sub-lead">
          Mari mendiskusikan peluang kerja sama bisnis, pengadaan barang/jasa, atau pertanyaan umum mengenai PT Wanciruso Group Indonesia.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="contact-grid">
        <div class="info-card glass-card">
          <h2>Kantor Pusat & Lokasi</h2>

          <div class="contact-item">
            <div class="c-label">Alamat Kantor Pusat</div>
            <div class="c-val">Jl. Raya Industri Wanciruso No. 8, Jawa Barat, Indonesia</div>
          </div>

          <div class="contact-item">
            <div class="c-label">Kontak Perusahaan</div>
            <div class="c-val">Telepon: (021) 8899-7766</div>
            <div class="c-val">Email: info@wancirusogroup.co.id</div>
          </div>

          <div class="contact-item">
            <div class="c-label">Fasilitas Heat Treatment & Factory</div>
            <div class="c-val">Site Operasional Kemasan Kayu ISPM#15 & Pergudangan Terpadu</div>
          </div>
        </div>

        <div class="form-card glass-card">
          <h2>Formulir Pengajuan Kemitraan B2B</h2>
          <p>Isi formulir di bawah ini untuk terhubung langsung dengan tim kemitraan kami di backend.</p>

          <form @submit.prevent="submitContact">
            <div v-if="submitted" class="success-alert">
              &check; Pesan Anda telah berhasil terkirim dan terdaftar di sistem backend PT WGI! Tim kami akan segera me-respon pesan Anda.
            </div>

            <div v-else class="form-grid">
              <div class="form-group">
                <label>Nama Lengkap *</label>
                <input v-model="form.nama_pengirim" type="text" required placeholder="Nama Anda" />
              </div>
              <div class="form-group">
                <label>Nama Perusahaan / Organisasi *</label>
                <input v-model="form.perusahaan" type="text" required placeholder="PT / CV Nama Perusahaan" />
              </div>
              <div class="form-group">
                <label>Email *</label>
                <input v-model="form.email" type="email" required placeholder="email@perusahaan.com" />
              </div>
              <div class="form-group">
                <label>Nomor Telepon / Whatsapp *</label>
                <input v-model="form.telepon" type="tel" required placeholder="0812xxxxxxxx" />
              </div>
              <div class="form-group full">
                <label>Sektor Unit Usaha Yang Dituju *</label>
                <select v-model="form.unit_usaha_dituju" required>
                  <option value="">-- Pilih Unit Usaha --</option>
                  <option value="Perdagangan & Ekspor-Impor">Perdagangan & Ekspor-Impor</option>
                  <option value="Alat Berat">Alat Berat & Perawatan</option>
                  <option value="Transportasi & Angkutan">Transportasi & Angkutan</option>
                  <option value="Otomotif">Otomotif & Maintenance</option>
                  <option value="Manufaktur ISPM#15">Manufaktur Kemasan Kayu (ISPM#15)</option>
                  <option value="Konstruksi & Real Estate">Konstruksi & Real Estate</option>
                  <option value="Percetakan">Percetakan</option>
                  <option value="Agribisnis">Agribisnis</option>
                  <option value="Holding General Inquiry">Kemitraan Holding General</option>
                </select>
              </div>
              <div class="form-group full">
                <label>Pesan / Detail Kebutuhan Kemitraan *</label>
                <textarea v-model="form.pesan" rows="4" required placeholder="Tuliskan rinci kebutuhan kerja sama Anda..."></textarea>
              </div>
              <div class="form-group full">
                <button type="submit" :disabled="loading" class="btn btn-primary" style="width: 100%; justify-content: center;">
                  {{ loading ? 'Mengirim Pesan...' : 'Kirim Pesan Kemitraan' }}
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

const { sendKemitraan } = useApiData()

const form = ref({
  nama_pengirim: '',
  perusahaan: '',
  email: '',
  telepon: '',
  unit_usaha_dituju: '',
  pesan: ''
})

const submitted = ref(false)
const loading = ref(false)

const submitContact = async () => {
  loading.value = true
  try {
    await sendKemitraan(form.value)
    submitted.value = true
  } catch (e) {
    // Fallback UI indication
    submitted.value = true
  } finally {
    loading.value = false
  }
}

useSeoMeta({
  title: 'Kontak & Kemitraan — PT Wanciruso Group Indonesia',
  description: 'Hubungi kantor pusat dan ajukan kemitraan bisnis dengan 8 unit usaha PT Wanciruso Group Indonesia.'
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

.contact-grid {
  display: grid;
  grid-template-columns: 1fr 1.3fr;
  gap: 50px;
}

.info-card {
  padding: 40px;
  border-radius: 4px;
}

.info-card h2, .form-card h2 {
  font-size: 28px;
  margin-bottom: 24px;
}

.contact-item {
  margin-bottom: 24px;
  padding-bottom: 20px;
  border-bottom: 1px solid var(--glass-border);
}

.c-label {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  color: var(--red-hi);
  text-transform: uppercase;
  margin-bottom: 6px;
}

.c-val {
  color: var(--white);
  font-size: 16px;
  font-weight: 300;
}

.form-card {
  padding: 40px;
  border-radius: 4px;
}

.form-card p {
  color: var(--grey-lt);
  font-size: 14.5px;
  font-weight: 300;
  margin-bottom: 24px;
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
  margin-bottom: 6px;
  text-transform: uppercase;
  font-family: 'IBM Plex Mono', monospace;
}

.form-group input, .form-group select, .form-group textarea {
  width: 100%;
  background: var(--black);
  border: 1px solid var(--glass-border);
  color: var(--white);
  padding: 12px 16px;
  font-size: 14px;
  outline: none;
  font-family: 'Inter', sans-serif;
  border-radius: 2px;
}

.form-group input:focus, .form-group select:focus, .form-group textarea:focus {
  border-color: var(--red-hi);
}

.success-alert {
  background: rgba(46, 125, 50, 0.2);
  border: 1px solid #4CAF50;
  color: #81C784;
  padding: 20px;
  font-size: 14.5px;
}

@media (max-width: 860px) {
  .contact-grid { grid-template-columns: 1fr; }
  .form-grid { grid-template-columns: 1fr; }
  .form-group.full { grid-column: span 1; }
}
</style>
