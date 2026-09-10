<template>
  <footer>
    <div class="wrap">
      <div class="foot-grid">
        <div>
          <NuxtLink to="/" class="foot-brand" title="Kembali ke Beranda">
            <img src="/logo_wgi.png" alt="Wanciruso Group Indonesia Logo" class="foot-logo-img" />
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

        <div class="foot-col">
          <h4>Informasi & Legal</h4>
          <NuxtLink to="/sertifikasi">Sertifikasi & Legalitas</NuxtLink>
          <NuxtLink to="/pusat-unduhan">Pusat Unduhan PDF</NuxtLink>
          <NuxtLink to="/karir">Karir & Peluang</NuxtLink>
          <NuxtLink to="/kontak">Kontak Kantor Pusat</NuxtLink>
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
  grid-template-columns: 1.4fr 1fr 1.2fr 1fr;
  gap: 44px;
  padding-bottom: 44px;
}

.foot-brand {
  display: inline-flex;
  align-items: center;
  margin-bottom: 22px;
  text-decoration: none;
}

.foot-logo-img {
  height: clamp(72px, 6.5vw, 92px);
  width: auto;
  max-width: 280px;
  object-fit: contain;
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.foot-brand:hover .foot-logo-img {
  transform: scale(1.03);
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
