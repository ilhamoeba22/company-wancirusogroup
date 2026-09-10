<template>
  <header :class="['site-header', { scrolled: isScrolled }]">
    <nav>
      <NuxtLink to="/" class="brand" @click="closeMobileMenu">
        <img src="/icon_wgi.png" alt="WGI Icon" class="brand-icon-img" />
        <span class="name">
          Wanciruso Group
          <small>PT WGI · Est. 2007</small>
        </span>
      </NuxtLink>

      <div class="navlinks">
        <NuxtLink to="/tentang-kami">Tentang</NuxtLink>
        
        <!-- Interactive Luxury Dropdown for Unit Usaha (Desktop) -->
        <div 
          class="dropdown-item" 
          @mouseenter="onDropdownEnter" 
          @mouseleave="onDropdownLeave"
        >
          <button 
            type="button" 
            class="dropdown-trigger" 
            @click.stop="toggleDropdown"
            aria-haspopup="true"
            :aria-expanded="showDropdown"
          >
            <span>Unit Usaha</span>
            <span :class="['arrow-icon', { open: showDropdown }]">&#9662;</span>
          </button>

          <div 
            :class="['dropdown-menu', 'glass-card', { active: showDropdown }]"
            @mouseenter="onDropdownEnter" 
            @mouseleave="onDropdownLeave"
          >
            <div class="dropdown-grid">
              <NuxtLink 
                v-for="u in unitsNav" 
                :key="u.slug" 
                :to="`/unit-usaha/${u.slug}`" 
                class="sub-link"
                @click="showDropdown = false"
              >
                <span class="sub-icon">{{ u.icon }}</span>
                <div>
                  <div class="sub-title">{{ u.title }}</div>
                  <div class="sub-desc">{{ u.desc }}</div>
                </div>
              </NuxtLink>
            </div>
            <div class="dropdown-footer">
              <NuxtLink to="/unit-usaha" class="btn-line" @click="showDropdown = false">
                Lihat Ringkasan 8 Pilar &rarr;
              </NuxtLink>
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
        <button class="mobile-toggle" @click="toggleMobileMenu" aria-label="Toggle Menu">
          <span :class="['hamburger', { open: mobileMenuOpen }]"></span>
        </button>
      </div>
    </nav>

    <!-- Mobile Drawer with Responsive Accordion -->
    <div v-if="mobileMenuOpen" class="mobile-drawer">
      <NuxtLink to="/" @click="closeMobileMenu">Beranda</NuxtLink>
      <NuxtLink to="/tentang-kami" @click="closeMobileMenu">Tentang Kami</NuxtLink>
      
      <!-- Mobile Unit Usaha Accordion -->
      <div class="mobile-accordion">
        <button type="button" class="mobile-accordion-btn" @click="mobileUnitsOpen = !mobileUnitsOpen">
          <span>8 Pilar Unit Usaha</span>
          <span :class="['m-arrow', { open: mobileUnitsOpen }]">&#9662;</span>
        </button>
        <div v-show="mobileUnitsOpen" class="mobile-sub-list">
          <NuxtLink to="/unit-usaha" @click="closeMobileMenu" class="m-sub-all">
            &bull; Semua Unit Usaha (Overview 8 Pilar) &rarr;
          </NuxtLink>
          <NuxtLink
            v-for="unit in unitsNav"
            :key="unit.slug"
            :to="`/unit-usaha/${unit.slug}`"
            @click="closeMobileMenu"
            class="m-sub-item"
          >
            <span class="m-icon">{{ unit.icon }}</span>
            <div class="m-content">
              <div class="m-title">{{ unit.title }}</div>
              <div class="m-desc">{{ unit.desc }}</div>
            </div>
          </NuxtLink>
        </div>
      </div>

      <NuxtLink to="/berita" @click="closeMobileMenu">Berita &amp; Media</NuxtLink>
      <NuxtLink to="/sertifikasi" @click="closeMobileMenu">Sertifikasi &amp; Legalitas</NuxtLink>
      <NuxtLink to="/pusat-unduhan" @click="closeMobileMenu">Pusat Unduhan</NuxtLink>
      <NuxtLink to="/karir" @click="closeMobileMenu">Karir</NuxtLink>
      <NuxtLink to="/kontak" @click="closeMobileMenu">Kontak Kami</NuxtLink>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useTheme } from '~/composables/useTheme'

const isScrolled = ref(false)
const mobileMenuOpen = ref(false)
const mobileUnitsOpen = ref(false)
const showDropdown = ref(false)
let dropdownTimer = null

const unitsNav = [
  { slug: 'perdagangan-ekspor-impor', icon: '📦', title: 'Perdagangan & Ekspor-Impor', desc: 'Ekspor komoditas & barang industri' },
  { slug: 'alat-berat', icon: '🚜', title: 'Alat Berat & Service', desc: 'Sewa & pemeliharaan mesin berat' },
  { slug: 'transportasi-angkutan', icon: '🚚', title: 'Transportasi & Angkutan', desc: 'Armada pengangkutan logistik B2B' },
  { slug: 'otomotif', icon: '🚘', title: 'Otomotif & Detailing', desc: 'Perawatan & pencucian profesional' },
  { slug: 'manufaktur-ispm15', icon: '🪵', title: 'Manufaktur (ISPM#15)', desc: 'Kemasan kayu ekspor & Heat Treatment' },
  { slug: 'konstruksi-real-estate', icon: '🏢', title: 'Konstruksi & Real Estate', desc: 'Kontraktor & pengembang properti' },
  { slug: 'percetakan', icon: '🖨️', title: 'Percetakan Komersial', desc: 'Cetak offset & digital korporat' },
  { slug: 'agribisnis', icon: '🌾', title: 'Agribisnis Terpadu', desc: 'Pertanian & peternakan modern' }
]

const { theme, toggleTheme, initTheme } = useTheme()

const onDropdownEnter = () => {
  if (dropdownTimer) {
    clearTimeout(dropdownTimer)
    dropdownTimer = null
  }
  showDropdown.value = true
}

const onDropdownLeave = () => {
  if (dropdownTimer) clearTimeout(dropdownTimer)
  dropdownTimer = setTimeout(() => {
    showDropdown.value = false
  }, 260) // Safe buffer to traverse gap without losing hover state
}

const toggleDropdown = () => {
  if (dropdownTimer) {
    clearTimeout(dropdownTimer)
    dropdownTimer = null
  }
  showDropdown.value = !showDropdown.value
}

const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value
}

const closeMobileMenu = () => {
  mobileMenuOpen.value = false
  mobileUnitsOpen.value = false
}

const handleGlobalClick = (e) => {
  // If clicked outside header or dropdown
  if (!e.target.closest('.dropdown-item')) {
    showDropdown.value = false
  }
}

const handleScroll = () => {
  isScrolled.value = window.scrollY > 10
}

onMounted(() => {
  initTheme()
  window.addEventListener('scroll', handleScroll)
  document.addEventListener('click', handleGlobalClick)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  document.removeEventListener('click', handleGlobalClick)
  if (dropdownTimer) clearTimeout(dropdownTimer)
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
  text-transform: uppercase;
  letter-spacing: 0.12em;
  align-items: center;
  font-family: 'IBM Plex Mono', monospace;
}

.navlinks a,
.dropdown-trigger {
  color: var(--grey-lt);
  position: relative;
  transition: color 0.25s ease;
  text-decoration: none;
}

.navlinks a::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
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

/* INTERACTIVE DROPDOWN (DESKTOP) */
.dropdown-item {
  position: relative;
  display: flex;
  align-items: center;
}

.dropdown-trigger {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  background: transparent;
  border: none;
  font-family: inherit;
  font-size: inherit;
  letter-spacing: inherit;
  text-transform: inherit;
  cursor: pointer;
  padding: 4px 0;
}

.dropdown-trigger:hover,
.dropdown-item:hover .dropdown-trigger {
  color: var(--white);
}

.arrow-icon {
  font-size: 10px;
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), color 0.3s ease;
}

.arrow-icon.open,
.dropdown-item:hover .arrow-icon {
  transform: rotate(180deg);
  color: var(--red-hi);
}

.dropdown-menu {
  position: absolute;
  top: calc(100% + 12px);
  left: -120px;
  width: 590px;
  padding: 24px;
  opacity: 0;
  visibility: hidden;
  transform: translateY(12px) scale(0.98);
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  pointer-events: none;
  z-index: 120;
}

/* Invisible bridge so mouse hover doesn't break when moving into dropdown */
.dropdown-menu::before {
  content: '';
  position: absolute;
  top: -20px;
  left: 0;
  right: 0;
  height: 20px;
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
  gap: 14px;
}

.sub-link {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 10px 12px;
  border-radius: 4px;
  transition: background 0.25s ease;
  border-bottom: none !important;
}

.sub-link::after {
  display: none !important;
}

.sub-link:hover {
  background: rgba(214, 66, 52, 0.12);
}

.sub-icon {
  font-size: 20px;
}

.sub-title {
  font-size: 12.5px;
  font-weight: 600;
  color: var(--white);
  text-transform: none;
  letter-spacing: normal;
}

.sub-desc {
  font-size: 11px;
  color: var(--grey);
  text-transform: none;
  font-weight: 300;
  margin-top: 2px;
  letter-spacing: normal;
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
  backdrop-filter: blur(10px);
  width: 38px;
  height: 38px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.theme-toggle-btn:hover {
  border-color: var(--red-hi);
  transform: scale(1.08);
}

.theme-icon {
  font-size: 16px;
  line-height: 1;
}

.nav-cta {
  padding: 8px 18px;
  font-size: 11px;
  letter-spacing: 0.08em;
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
  transition: all 0.3s ease;
}

.hamburger::before,
.hamburger::after {
  content: '';
  position: absolute;
  width: 24px;
  height: 2px;
  background: var(--white);
  left: 0;
  transition: all 0.3s ease;
}

.hamburger::before { top: -7px; }
.hamburger::after { top: 7px; }

.hamburger.open {
  background: transparent;
}

.hamburger.open::before {
  top: 0;
  transform: rotate(45deg);
}

.hamburger.open::after {
  top: 0;
  transform: rotate(-45deg);
}

/* MOBILE DRAWER & ACCORDION */
.mobile-drawer {
  display: flex;
  flex-direction: column;
  background: var(--charcoal);
  padding: 20px 24px;
  border-bottom: 1px solid var(--grey-line);
  max-height: 80vh;
  overflow-y: auto;
}

.mobile-drawer a {
  padding: 14px 0;
  font-size: 13.5px;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  border-bottom: 1px solid var(--grey-line);
  color: var(--grey-lt);
  text-decoration: none;
}

.mobile-drawer a:hover {
  color: var(--white);
}

.mobile-accordion {
  border-bottom: 1px solid var(--grey-line);
}

.mobile-accordion-btn {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 0;
  background: none;
  border: none;
  font-size: 13.5px;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--grey-lt);
  font-family: inherit;
  cursor: pointer;
  text-align: left;
}

.mobile-accordion-btn:hover {
  color: var(--white);
}

.m-arrow {
  font-size: 11px;
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), color 0.3s ease;
}

.m-arrow.open {
  transform: rotate(180deg);
  color: var(--red-hi);
}

.mobile-sub-list {
  padding: 6px 0 14px 10px;
  display: flex;
  flex-direction: column;
  gap: 6px;
  background: rgba(0, 0, 0, 0.25);
  border-radius: 4px;
  margin-bottom: 12px;
}

.m-sub-all {
  padding: 10px 12px !important;
  font-size: 12px !important;
  color: var(--red-hi) !important;
  border-bottom: 1px solid var(--glass-border) !important;
  font-family: 'IBM Plex Mono', monospace;
  display: block;
}

.m-sub-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 10px 12px !important;
  border-bottom: none !important;
  color: var(--grey-lt) !important;
  border-radius: 3px;
  transition: background 0.2s ease, color 0.2s ease;
}

.m-sub-item:hover {
  background: rgba(214, 66, 52, 0.12);
  color: var(--white) !important;
}

.m-icon {
  font-size: 18px;
  line-height: 1.2;
}

.m-content {
  display: flex;
  flex-direction: column;
}

.m-title {
  font-size: 13px;
  font-weight: 600;
  text-transform: none;
  letter-spacing: normal;
  color: var(--white);
}

.m-desc {
  font-size: 11px;
  color: var(--grey);
  text-transform: none;
  letter-spacing: normal;
  font-weight: 300;
  margin-top: 2px;
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
