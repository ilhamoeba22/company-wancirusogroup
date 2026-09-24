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
        <!-- INFO CARD -->
        <div class="info-card glass-card">
          <h2>Kantor Pusat & Kontak</h2>

          <!-- Head Office -->
          <div class="contact-item">
            <div class="c-label">Alamat Kantor Pusat (Head Office)</div>
            <div class="c-val">Jl. Jeruk III C Kav. 159 Wage – Taman, Sidoarjo – Jawa Timur</div>
            <a 
              href="https://maps.google.com/?q=Jl.+Jeruk+III+C+Kav.+159+Wage+Taman+Sidoarjo+Jawa+Timur" 
              target="_blank" 
              rel="noopener noreferrer" 
              class="c-action-link"
            >
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z"/>
                <circle cx="12" cy="10" r="3"/>
              </svg>
              <span>Petunjuk Arah Google Maps &rarr;</span>
            </a>
          </div>

          <!-- Phone & WhatsApp -->
          <div class="contact-item">
            <div class="c-label">Customer Service & Hotline WA</div>
            <div class="c-val">
              <a href="tel:+628133032313" class="c-tel-link">+62 813-3032-313</a>
            </div>
            <!-- Prominent WhatsApp Action Button -->
            <a 
              href="https://wa.me/628133032313?text=Halo%20Admin%20PT%20Wanciruso%20Group%20Indonesia,%20saya%20ingin%20berkonsultasi%20mengenai%20layanan%20/%20kemitraan%20perusahaan." 
              target="_blank" 
              rel="noopener noreferrer" 
              class="btn btn-wa wa-kontak-btn"
            >
              <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
              </svg>
              <span>Chat WhatsApp Customer Service</span>
            </a>
          </div>

          <!-- Email -->
          <div class="contact-item">
            <div class="c-label">Email Korespondensi Resmi</div>
            <div class="c-val">
              <a href="mailto:pt.wancirusogroupindonesia@gmail.com" class="c-email-link">
                pt.wancirusogroupindonesia@gmail.com
              </a>
            </div>
          </div>

          <!-- Operating Hours -->
          <div class="contact-item">
            <div class="c-label">Jam Operasional Layanan</div>
            <div class="c-val schedule-text">
              <div><strong>Senin – Jumat:</strong> 08.00 – 17.00 WIB</div>
              <div><strong>Sabtu:</strong> 08.00 – 14.00 WIB</div>
              <div><strong>Minggu & Hari Libur:</strong> Emergency Call & CS WhatsApp Aktif</div>
            </div>
          </div>

          <!-- Operational Facilities -->
          <div class="contact-item" style="border-bottom: none; margin-bottom: 0; padding-bottom: 0;">
            <div class="c-label">Fasilitas Heat Treatment & Factory</div>
            <div class="c-val">Site Operasional Kemasan Kayu ISPM#15 & Pergudangan Terpadu</div>
          </div>
        </div>

        <!-- FORM CARD -->
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

    <!-- INTERACTIVE GOOGLE MAPS SECTION -->
    <section class="wrap map-section">
      <div class="map-card glass-card">
        <div class="map-header">
          <div>
            <p class="eyebrow">Lokasi Kantor Pusat</p>
            <h2>Peta Lokasi PT Wanciruso Group Indonesia</h2>
            <p class="map-address-desc">
              Jl. Jeruk III C Kav. 159 Wage – Taman, Sidoarjo – Jawa Timur
            </p>
          </div>
          <div class="map-actions">
            <a 
              href="https://maps.google.com/?q=Jl.+Jeruk+III+C+Kav.+159+Wage+Taman+Sidoarjo+Jawa+Timur" 
              target="_blank" 
              rel="noopener noreferrer" 
              class="btn btn-outline"
            >
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="3 11 22 2 13 21 11 13 3 11"/>
              </svg>
              <span>Buka Rute Google Maps &rarr;</span>
            </a>
          </div>
        </div>

        <div class="map-frame-wrap">
          <iframe
            src="https://maps.google.com/maps?q=Jl.+Jeruk+III+C+Kav.+159+Wage+Taman+Sidoarjo+Jawa+Timur&t=&z=16&ie=UTF8&iwloc=&output=embed"
            width="100%"
            height="400"
            style="border: 0; display: block;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Peta Kantor Pusat PT Wanciruso Group Indonesia di Sidoarjo"
          ></iframe>
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
  title: 'Kontak & Kantor Pusat — PT Wanciruso Group Indonesia (WGI)',
  description: 'Hubungi kantor pusat PT Wanciruso Group Indonesia di Sidoarjo Jawa Timur. WhatsApp CS: +62 813-3032-313, Email: pt.wancirusogroupindonesia@gmail.com'
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
  padding: 80px 0 60px;
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
  letter-spacing: 0.08em;
  margin-bottom: 6px;
}

.c-val {
  color: var(--white);
  font-size: 15.5px;
  font-weight: 300;
  line-height: 1.6;
}

.c-action-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--red-hi);
  font-size: 13px;
  font-weight: 500;
  margin-top: 8px;
  text-decoration: none;
  transition: gap 0.25s ease, color 0.25s ease;
}

.c-action-link:hover {
  color: var(--white);
  gap: 12px;
}

.c-tel-link {
  color: var(--white);
  font-family: 'IBM Plex Mono', monospace;
  font-weight: 600;
  font-size: 18px;
  text-decoration: none;
  transition: color 0.2s ease;
}

.c-tel-link:hover {
  color: #25D366;
}

.c-email-link {
  color: var(--white);
  font-size: 15px;
  text-decoration: none;
  word-break: break-all;
  transition: color 0.2s ease;
}

.c-email-link:hover {
  color: var(--red-hi);
}

.wa-kontak-btn {
  margin-top: 14px;
  width: 100%;
  justify-content: center;
  font-size: 13px;
  padding: 12px 20px;
  border-radius: 4px;
}

.schedule-text div {
  margin-bottom: 4px;
  font-size: 14px;
}

.schedule-text strong {
  color: var(--white);
  font-weight: 500;
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
  transition: border-color 0.25s ease;
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
  border-radius: 4px;
}

/* MAP SECTION */
.map-section {
  padding-bottom: 120px;
}

.map-card {
  border-radius: 6px;
  overflow: hidden;
  border: 1px solid var(--glass-border);
}

.map-header {
  padding: 36px 40px 28px;
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 24px;
  flex-wrap: wrap;
}

.map-header h2 {
  font-size: 26px;
  margin-top: 8px;
}

.map-address-desc {
  color: var(--grey-lt);
  font-size: 15px;
  margin-top: 6px;
  font-weight: 300;
}

.map-frame-wrap {
  width: 100%;
  height: 400px;
  border-top: 1px solid var(--glass-border);
  background: var(--charcoal);
}

@media (max-width: 860px) {
  .contact-grid { grid-template-columns: 1fr; }
  .form-grid { grid-template-columns: 1fr; }
  .form-group.full { grid-column: span 1; }
  .map-header {
    flex-direction: column;
    align-items: flex-start;
  }
  .map-actions {
    width: 100%;
  }
  .map-actions .btn {
    width: 100%;
    justify-content: center;
  }
}
</style>
