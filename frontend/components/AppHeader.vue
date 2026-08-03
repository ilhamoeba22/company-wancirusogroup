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
        <NuxtLink to="/tata-kelola">GCG</NuxtLink>
        <NuxtLink to="/unit-usaha">Unit Usaha</NuxtLink>
        <NuxtLink to="/investor-relations">Investor</NuxtLink>
        <NuxtLink to="/berita">Berita</NuxtLink>
        <NuxtLink to="/sertifikasi">Sertifikasi</NuxtLink>
        <NuxtLink to="/pusat-unduhan">Unduhan</NuxtLink>
        <NuxtLink to="/karir">Karir</NuxtLink>
        <NuxtLink to="/kontak">Kontak</NuxtLink>
      </div>

      <div class="nav-actions">
        <!-- Theme Mode Toggle -->
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
      <NuxtLink to="/tata-kelola" @click="mobileMenuOpen = false">Tata Kelola (GCG)</NuxtLink>
      <NuxtLink to="/unit-usaha" @click="mobileMenuOpen = false">Unit Usaha</NuxtLink>
      <NuxtLink to="/investor-relations" @click="mobileMenuOpen = false">Investor Relations</NuxtLink>
      <NuxtLink to="/berita" @click="mobileMenuOpen = false">Berita & Media</NuxtLink>
      <NuxtLink to="/sertifikasi" @click="mobileMenuOpen = false">Sertifikasi & Legalitas</NuxtLink>
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
  transition: all 0.4s ease;
  border-bottom: 1px solid transparent;
}

.site-header.scrolled {
  background: var(--glass-bg);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
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
  gap: 20px;
  font-size: 12px;
  font-weight: 500;
  letter-spacing: 0.04em;
  text-transform: uppercase;
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

.nav-actions {
  display: flex;
  align-items: center;
  gap: 14px;
}

.theme-toggle-btn {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  color: var(--white);
  width: 36px;
  height: 36px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  transition: all 0.3s ease;
  backdrop-filter: blur(8px);
}

.theme-toggle-btn:hover {
  border-color: var(--red-hi);
  transform: scale(1.1);
}

.nav-cta {
  padding: 10px 20px;
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
