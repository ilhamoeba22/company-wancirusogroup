<template>
  <header :class="['site-header', { scrolled: isScrolled }]">
    <nav>
      <NuxtLink to="/" class="brand">
        <img src="/icon_wgi.png" alt="WGI Icon" class="brand-icon-img" />
        <span class="name">
          Wanciruso Group
          <small>PT WGI · Est. 2007</small>
        </span>
      </NuxtLink>

      <div class="navlinks">
        <NuxtLink to="/tentang-kami">Tentang</NuxtLink>
        
        <!-- Interactive Luxury Dropdown for Unit Usaha -->
        <div class="dropdown-item" @mouseenter="showDropdown = true" @mouseleave="showDropdown = false">
          <NuxtLink to="/unit-usaha" class="dropdown-trigger">
            Unit Usaha <span class="arrow-icon">&#9662;</span>
          </NuxtLink>
          <div :class="['dropdown-menu', 'glass-card', { active: showDropdown }]">
            <div class="dropdown-grid">
              <NuxtLink to="/unit-usaha/perdagangan-ekspor-impor" class="sub-link">
                <span class="sub-icon">📦</span>
                <div>
                  <div class="sub-title">Perdagangan &amp; Ekspor-Impor</div>
                  <div class="sub-desc">Ekspor komoditas &amp; barang industri</div>
                </div>
              </NuxtLink>

              <NuxtLink to="/unit-usaha/alat-berat" class="sub-link">
                <span class="sub-icon">🚜</span>
                <div>
                  <div class="sub-title">Alat Berat &amp; Service</div>
                  <div class="sub-desc">Sewa &amp; pemeliharaan mesin berat</div>
                </div>
              </NuxtLink>

              <NuxtLink to="/unit-usaha/transportasi-angkutan" class="sub-link">
                <span class="sub-icon">🚚</span>
                <div>
                  <div class="sub-title">Transportasi &amp; Angkutan</div>
                  <div class="sub-desc">Armada pengangkutan logistik B2B</div>
                </div>
              </NuxtLink>

              <NuxtLink to="/unit-usaha/otomotif" class="sub-link">
                <span class="sub-icon">🚘</span>
                <div>
                  <div class="sub-title">Otomotif &amp; Detailing</div>
                  <div class="sub-desc">Perawatan &amp; pencucian profesional</div>
                </div>
              </NuxtLink>

              <NuxtLink to="/unit-usaha/manufaktur-ispm15" class="sub-link">
                <span class="sub-icon">🪵</span>
                <div>
                  <div class="sub-title">Manufaktur (ISPM#15)</div>
                  <div class="sub-desc">Kemasan kayu ekspor &amp; Heat Treatment</div>
                </div>
              </NuxtLink>

              <NuxtLink to="/unit-usaha/konstruksi-real-estate" class="sub-link">
                <span class="sub-icon">🏢</span>
                <div>
                  <div class="sub-title">Konstruksi &amp; Real Estate</div>
                  <div class="sub-desc">Kontraktor &amp; pengembang properti</div>
                </div>
              </NuxtLink>

              <NuxtLink to="/unit-usaha/percetakan" class="sub-link">
                <span class="sub-icon">🖨️</span>
                <div>
                  <div class="sub-title">Percetakan Komersial</div>
                  <div class="sub-desc">Cetak offset &amp; digital korporat</div>
                </div>
              </NuxtLink>

              <NuxtLink to="/unit-usaha/agribisnis" class="sub-link">
                <span class="sub-icon">🌾</span>
                <div>
                  <div class="sub-title">Agribisnis Terpadu</div>
                  <div class="sub-desc">Pertanian &amp; peternakan modern</div>
                </div>
              </NuxtLink>
            </div>
            <div class="dropdown-footer">
              <NuxtLink to="/unit-usaha" class="btn-line">Lihat Ringkasan 8 Pilar &rarr;</NuxtLink>
            </div>
          </div>
        </div>

        <NuxtLink to="/berita">Berita</NuxtLink>
        <NuxtLink to="/sertifikasi">Sertifikasi</NuxtLink>
        <NuxtLink to="/pusat-unduhan">Unduhan</NuxtLink>
        <NuxtLink to="/karir">Karir</NuxtLink>
        <NuxtLink to="/kontak">Kontak</NuxtLink>
      </div>

      <div class="nav-actions">
        <!-- Luxury Theme Mode Toggle Button -->
        <button @click="toggleTheme" class="theme-toggle-btn" :title="theme === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
          <span v-if="theme === 'dark'" class="theme-icon">&#9728;&#65039;</span>
          <span v-else class="theme-icon">&#127769;</span>
        </button>

        <NuxtLink to="/kontak" class="btn btn-outline nav-cta">Hubungi Kami</NuxtLink>

        <!-- Mobile Menu Button -->
        <button class="mobile-toggle" @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Toggle Menu">
          <span :class="['hamburger', { open: mobileMenuOpen }]"></span>
        </button>
      </div>
    </nav>

    <!-- Mobile Drawer -->
    <div v-if="mobileMenuOpen" class="mobile-drawer">
      <NuxtLink to="/" @click="mobileMenuOpen = false">Beranda</NuxtLink>
      <NuxtLink to="/tentang-kami" @click="mobileMenuOpen = false">Tentang Kami</NuxtLink>
      <NuxtLink to="/unit-usaha" @click="mobileMenuOpen = false">8 Pilar Unit Usaha</NuxtLink>
      <NuxtLink to="/berita" @click="mobileMenuOpen = false">Berita &amp; Media</NuxtLink>
      <NuxtLink to="/sertifikasi" @click="mobileMenuOpen = false">Sertifikasi &amp; Legalitas</NuxtLink>
      <NuxtLink to="/pusat-unduhan" @click="mobileMenuOpen = false">Pusat Unduhan</NuxtLink>
      <NuxtLink to="/karir" @click="mobileMenuOpen = false">Karir</NuxtLink>
      <NuxtLink to="/kontak" @click="mobileMenuOpen = false">Kontak Kami</NuxtLink>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useTheme } from '~/composables/useTheme'

const isScrolled = ref(false)
const mobileMenuOpen = ref(false)
const showDropdown = ref(false)

const { theme, toggleTheme, initTheme } = useTheme()

const handleScroll = () => {
  isScrolled.value = window.scrollY > 10
}

onMounted(() => {
  initTheme()
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
.site-header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 100;
  transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  border-bottom: 1px solid transparent;
}

.site-header.scrolled {
  background: var(--glass-bg);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border-bottom-color: var(--glass-border);
  box-shadow: var(--glass-shadow);
}

nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 18px 32px;
  max-width: 1220px;
  margin: 0 auto;
}

.brand {
  display: flex;
  align-items: center;
  gap: 12px;
}

.brand-icon-img {
  height: 38px;
  width: auto;
  object-fit: contain;
  transition: transform 0.3s ease;
}

.brand:hover .brand-icon-img {
  transform: scale(1.06);
}

.brand .name {
  font-family: 'Cormorant Garamond', serif;
  font-weight: 600;
  font-size: 15.5px;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  line-height: 1.2;
}

.brand .name small {
  display: block;
  font-family: 'IBM Plex Mono', monospace;
  font-size: 9px;
  letter-spacing: 0.14em;
  color: var(--grey);
  font-weight: 400;
  margin-top: 2px;
}

.navlinks {
  display: flex;
  gap: 22px;
  font-size: 12px;
  font-weight: 500;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  align-items: center;
}

.navlinks a {
  color: var(--grey-lt);
  position: relative;
  padding-bottom: 4px;
  transition: color 0.3s ease;
}

.navlinks a::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  width: 0;
  height: 1px;
  background: var(--red-hi);
  transition: width 0.3s ease;
}

.navlinks a:hover,
.navlinks a.router-link-active {
  color: var(--white);
}

.navlinks a:hover::after,
.navlinks a.router-link-active::after {
  width: 100%;
}

/* INTERACTIVE DROPDOWN */
.dropdown-item {
  position: relative;
}

.dropdown-trigger {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  cursor: pointer;
}

.arrow-icon {
  font-size: 10px;
  transition: transform 0.3s ease;
}

.dropdown-item:hover .arrow-icon {
  transform: rotate(180deg);
  color: var(--red-hi);
}

.dropdown-menu {
  position: absolute;
  top: calc(100% + 14px);
  left: -120px;
  width: 580px;
  padding: 24px;
  opacity: 0;
  visibility: hidden;
  transform: translateY(12px) scale(0.98);
  transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  pointer-events: none;
  z-index: 120;
}

.dropdown-menu.active {
  opacity: 1;
  visibility: visible;
  transform: translateY(0) scale(1);
  pointer-events: auto;
}

.dropdown-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}

.sub-link {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 10px 12px;
  border-radius: 4px;
  transition: background 0.25s ease;
}

.sub-link:hover {
  background: rgba(214, 66, 52, 0.1);
}

.sub-icon {
  font-size: 20px;
}

.sub-title {
  font-size: 12.5px;
  font-weight: 600;
  color: var(--white);
  text-transform: none;
}

.sub-desc {
  font-size: 11px;
  color: var(--grey);
  text-transform: none;
  font-weight: 300;
  margin-top: 2px;
}

.dropdown-footer {
  margin-top: 16px;
  padding-top: 14px;
  border-top: 1px solid var(--glass-border);
  text-align: right;
}

/* NAV ACTIONS & THEME TOGGLE */
.nav-actions {
  display: flex;
  align-items: center;
  gap: 14px;
}

.theme-toggle-btn {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  color: var(--white);
  width: 38px;
  height: 38px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  backdrop-filter: blur(10px);
}

.theme-toggle-btn:hover {
  border-color: var(--red-hi);
  transform: rotate(25deg) scale(1.1);
  box-shadow: 0 0 15px var(--glow-color);
}

.nav-cta {
  padding: 11px 22px;
  font-size: 11px;
}

.mobile-toggle {
  display: none;
  background: none;
  border: none;
  cursor: pointer;
  padding: 10px;
}

.hamburger {
  display: block;
  width: 24px;
  height: 2px;
  background: var(--white);
  position: relative;
}

.hamburger::before,
.hamburger::after {
  content: '';
  position: absolute;
  width: 24px;
  height: 2px;
  background: var(--white);
  left: 0;
}

.hamburger::before { top: -6px; }
.hamburger::after { top: 6px; }

.mobile-drawer {
  display: flex;
  flex-direction: column;
  background: var(--charcoal);
  padding: 24px 32px;
  border-bottom: 1px solid var(--grey-line);
}

.mobile-drawer a {
  padding: 12px 0;
  font-size: 14px;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  border-bottom: 1px solid var(--grey-line);
  color: var(--grey-lt);
}

@media (max-width: 1024px) {
  .navlinks, .nav-cta {
    display: none;
  }
  .mobile-toggle {
    display: block;
  }
}
</style>
