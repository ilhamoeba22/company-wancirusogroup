<template>
  <footer>
    <div class="wrap">
      <div class="foot-grid">
        <div>
          <NuxtLink to="/" class="foot-brand" title="Kembali ke Beranda">
            <img src="/icon_wgi.png" alt="WGI Icon" class="foot-brand-icon" />
            <span class="foot-brand-name">
              Wanciruso Group
              <small>PT WGI · Est. 2007</small>
            </span>
          </NuxtLink>
          <p>Perusahaan holding nasional yang menaungi 8 unit usaha lintas sektor, berakar dari rekam jejak profesional sejak 2007 (CV. Wanciruso) dengan sertifikasi ISPM#15 &amp; BARANTAN.</p>
        </div>

        <div class="foot-col">
          <h4>Navigasi Halaman</h4>
          <NuxtLink to="/tentang-kami">Tentang Kami</NuxtLink>
          <NuxtLink to="/unit-usaha">Unit Usaha</NuxtLink>
          <NuxtLink to="/berita">Berita & Media</NuxtLink>
          <NuxtLink to="/sertifikasi">Sertifikasi & Legalitas</NuxtLink>
        </div>

        <div class="foot-col">
          <h4>8 Pilar Bisnis</h4>
          <NuxtLink to="/unit-usaha/perdagangan-ekspor-impor">Perdagangan & Ekspor-Impor</NuxtLink>
          <NuxtLink to="/unit-usaha/alat-berat">Alat Berat & Perawatan</NuxtLink>
          <NuxtLink to="/unit-usaha/transportasi-angkutan">Transportasi & Angkutan</NuxtLink>
          <NuxtLink to="/unit-usaha/manufaktur-ispm15">Manufaktur (ISPM#15)</NuxtLink>
          <NuxtLink to="/unit-usaha/konstruksi-real-estate">Konstruksi & Real Estate</NuxtLink>
        </div>

        <div class="foot-col foot-contact-col">
          <h4>Kantor Pusat & Kontak</h4>
          <div class="foot-contact-item">
            <span class="foot-contact-label">Head Office:</span>
            <p>Jl. Jeruk III C Kav. 159 Wage – Taman, Sidoarjo – Jawa Timur</p>
          </div>
          <div class="foot-contact-item">
            <span class="foot-contact-label">Email Resmi:</span>
            <a href="mailto:pt.wancirusogroupindonesia@gmail.com" class="foot-contact-link">
              pt.wancirusogroupindonesia@gmail.com
            </a>
          </div>
          <div class="foot-contact-item">
            <span class="foot-contact-label">Customer Service CS:</span>
            <a 
              href="https://wa.me/628133032313?text=Halo%20Admin%20PT%20Wanciruso%20Group%20Indonesia,%20saya%20ingin%20berkonsultasi%20mengenai%20layanan%20perusahaan." 
              target="_blank" 
              rel="noopener noreferrer" 
              class="foot-wa-link"
              title="Chat WhatsApp Resmi"
            >
              <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
              </svg>
              <span>+62 813-3032-313</span>
            </a>
          </div>
          <div class="foot-sub-links" style="margin-top: 14px; padding-top: 10px; border-top: 1px solid var(--grey-line);">
            <NuxtLink to="/karir" style="margin-bottom: 6px;">Karir & Peluang</NuxtLink>
            <NuxtLink to="/kontak">Halaman Kontak & Peta &rarr;</NuxtLink>
          </div>
        </div>
      </div>

      <div class="foot-bottom">
        <span>© 2026 PT Wanciruso Group Indonesia (WGI). Seluruh hak cipta dilindungi.</span>
        <span>Revisi Holding Est. 2007 (CV. Wanciruso)</span>
      </div>
    </div>
  </footer>
</template>

<style scoped>
footer {
  padding: 80px 0 32px;
  background: var(--charcoal);
  border-top: 1px solid var(--grey-line);
}

.foot-grid {
  display: grid;
  grid-template-columns: 1.25fr 0.85fr 1.05fr 1.35fr;
  gap: 36px;
  padding-bottom: 44px;
}

.foot-brand {
  display: inline-flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 20px;
  text-decoration: none;
}

.foot-brand-icon {
  height: 52px;
  width: auto;
  object-fit: contain;
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.foot-brand:hover .foot-brand-icon {
  transform: scale(1.08);
}

.foot-brand-name {
  font-family: 'Cormorant Garamond', serif;
  font-weight: 600;
  font-size: 19px;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  line-height: 1.2;
  color: var(--white);
}

.foot-brand-name small {
  display: block;
  font-family: 'IBM Plex Mono', monospace;
  font-size: 10px;
  letter-spacing: 0.14em;
  color: var(--grey);
  font-weight: 400;
  margin-top: 3px;
}

footer p {
  color: var(--grey);
  font-size: 13px;
  max-width: 320px;
  font-weight: 300;
  line-height: 1.75;
}

.foot-col h4 {
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  color: var(--grey);
  margin-bottom: 18px;
  font-family: 'IBM Plex Mono', monospace;
  font-weight: 500;
}

.foot-col a {
  display: block;
  font-size: 13.5px;
  margin-bottom: 12px;
  color: var(--grey-lt);
  font-weight: 400;
  transition: color 0.25s ease;
}

.foot-col a:hover {
  color: var(--red-hi);
}

.foot-contact-item {
  margin-bottom: 12px;
}

.foot-contact-label {
  display: block;
  font-family: 'IBM Plex Mono', monospace;
  font-size: 10px;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--grey);
  margin-bottom: 2px;
}

.foot-contact-item p {
  color: var(--grey-lt);
  font-size: 13px;
  line-height: 1.5;
  margin: 0;
}

.foot-contact-link {
  display: inline-block !important;
  color: var(--grey-lt) !important;
  font-size: 12.5px !important;
  word-break: break-all;
  margin-bottom: 0 !important;
}

.foot-contact-link:hover {
  color: var(--red-hi) !important;
}

.foot-wa-link {
  display: inline-flex !important;
  align-items: center;
  gap: 8px;
  background: rgba(37, 211, 102, 0.12);
  color: #25D366 !important;
  border: 1px solid rgba(37, 211, 102, 0.3);
  padding: 6px 12px;
  border-radius: 4px;
  font-family: 'IBM Plex Mono', monospace;
  font-size: 12px !important;
  font-weight: 500;
  margin-top: 4px;
  margin-bottom: 0 !important;
  transition: all 0.25s ease;
}

.foot-wa-link:hover {
  background: #25D366;
  color: #ffffff !important;
  border-color: #25D366;
  transform: translateY(-2px);
}

.foot-bottom {
  display: flex;
  justify-content: space-between;
  padding-top: 28px;
  border-top: 1px solid var(--grey-line);
  font-size: 12px;
  color: var(--grey);
  flex-wrap: wrap;
  gap: 10px;
}

@media (max-width: 980px) {
  .foot-grid {
    grid-template-columns: 1fr 1fr;
  }
}

@media (max-width: 640px) {
  .foot-grid {
    grid-template-columns: 1fr;
  }
}
</style>
