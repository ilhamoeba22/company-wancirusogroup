<template>
  <div class="page-container">
    <section class="page-header">
      <div class="wrap">
        <p class="eyebrow">Karir & Peluang</p>
        <h1>Bekerja Bersama PT Wanciruso Group Indonesia</h1>
        <p class="sub-lead">
          Bergabung bersama tim profesional yang dinamis dan bertumbuh dalam grup holding 8 unit usaha lintas sektor.
        </p>
      </div>
    </section>

    <section class="wrap content-section">
      <div class="career-grid">
        <div class="culture-box">
          <h2>Budaya Kerja WGI</h2>
          <p>
            Di PT Wanciruso Group Indonesia, kami meyakini bahwa Sumber Daya Manusia (SDM) adalah aset terbesar perusahaan. Kami mendorong lingkungan kerja yang kolaboratif, profesional, dan berorientasi pada inovasi.
          </p>
          <div class="perks">
            <div class="perk-item">&check; Pengembangan Karir Lintas Unit Usaha</div>
            <div class="perk-item">&check; Standar Keselamatan Kerja (K3) Terjamin</div>
            <div class="perk-item">&check; Lingkungan Kerja Profesional & Suasana Kekeluargaan</div>
          </div>
        </div>

        <div class="apply-box">
          <h2>Formulir Talenta Umum (General Application)</h2>
          <p>Kirimkan CV dan profil Anda untuk kesempatan bergabung di berbagai posisi unit bisnis kami.</p>

          <form @submit.prevent="submitApplication">
            <div v-if="submitted" class="success-alert">
              &check; Terima kasih! Berkas Anda telah tersimpan di database talenta PT WGI. Tim HR akan menghubungi Anda jika ada posisi yang sesuai.
            </div>

            <div v-else class="form-grid">
              <div class="form-group">
                <label>Nama Lengkap *</label>
                <input v-model="form.name" type="text" required placeholder="Contoh: Rian Pratama" />
              </div>
              <div class="form-group">
                <label>Email *</label>
                <input v-model="form.email" type="email" required placeholder="rian@gmail.com" />
              </div>
              <div class="form-group">
                <label>Nomor Whatsapp *</label>
                <input v-model="form.phone" type="tel" required placeholder="0812xxxxxxxx" />
              </div>
              <div class="form-group">
                <label>Minat Sektor Unit Usaha *</label>
                <select v-model="form.sector" required>
                  <option value="">-- Pilih Sektor --</option>
                  <option value="Manufaktur & Kayu">Manufaktur (Kemasan Kayu / ISPM#15)</option>
                  <option value="Alat Berat & Transportasi">Alat Berat & Transportasi</option>
                  <option value="Perdagangan">Perdagangan & Ekspor-Impor</option>
                  <option value="Konstruksi">Konstruksi & Real Estate</option>
                  <option value="Holding Staff">Staf Operasional Holding</option>
                </select>
              </div>
              <div class="form-group full">
                <label>Link LinkedIn / Ringkasan Pengalaman *</label>
                <textarea v-model="form.notes" rows="3" required placeholder="Tautkan link profil LinkedIn Anda atau tuliskan ringkasan latar belakang pekerjaan..."></textarea>
              </div>
              <div class="form-group full">
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                  Kirim Data Talenta
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

const form = ref({
  name: '',
  email: '',
  phone: '',
  sector: '',
  notes: ''
})

const submitted = ref(false)

const submitApplication = () => {
  submitted.value = true
}

useSeoMeta({
  title: 'Karir & Peluang — PT Wanciruso Group Indonesia',
  description: 'Bergabung bersama PT Wanciruso Group Indonesia (WGI). Kirimkan data talenta Anda untuk unit usaha kami.'
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

.career-grid {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 50px;
}

.culture-box h2, .apply-box h2 {
  font-size: 28px;
  margin-bottom: 16px;
}

.culture-box p, .apply-box p {
  color: var(--grey-lt);
  font-size: 15px;
  font-weight: 300;
  line-height: 1.8;
  margin-bottom: 24px;
}

.perks {
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.perk-item {
  color: var(--white);
  font-size: 15px;
  font-weight: 500;
}

.apply-box {
  background: var(--charcoal);
  padding: 40px;
  border: 1px solid var(--grey-line);
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
  border: 1px solid var(--grey-line);
  color: var(--white);
  padding: 12px 16px;
  font-size: 14px;
  outline: none;
  font-family: 'Inter', sans-serif;
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
  .career-grid { grid-template-columns: 1fr; }
  .form-grid { grid-template-columns: 1fr; }
  .form-group.full { grid-column: span 1; }
}
</style>
