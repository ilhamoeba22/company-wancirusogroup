<template>
  <div class="wa-float-container">
    <!-- Gentle Speech Bubble Notification (Dismissable) -->
    <Transition name="fade-bubble">
      <div v-if="showBubble" class="wa-speech-bubble glass-card" @click="openWhatsApp">
        <button class="bubble-close-btn" @click.stop="showBubble = false" aria-label="Tutup pesan">
          &times;
        </button>
        <div class="bubble-content">
          <div class="bubble-header">
            <span class="online-indicator"></span>
            <strong>Customer Service WGI</strong>
          </div>
          <p>Halo! Ada yang bisa kami bantu seputar kemitraan atau unit usaha PT WGI?</p>
          <span class="bubble-cta">Klik untuk chat langsung di WhatsApp &rarr;</span>
        </div>
      </div>
    </Transition>

    <!-- Floating Action Button -->
    <a 
      :href="waUrl" 
      target="_blank" 
      rel="noopener noreferrer" 
      class="wa-float-btn"
      :class="{ expanded: isHovered }"
      @mouseenter="isHovered = true"
      @mouseleave="isHovered = false"
      aria-label="Hubungi Customer Service PT Wanciruso Group Indonesia via WhatsApp"
      title="Chat WhatsApp Resmi (+62 813-3032-313)"
    >
      <div class="wa-icon-wrap">
        <!-- Official WhatsApp SVG Icon -->
        <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor" class="wa-svg">
          <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        <span class="wa-status-badge"></span>
      </div>
      
      <div class="wa-btn-text">
        <span class="wa-label">Chat WhatsApp</span>
        <span class="wa-sub">CS Aktif · Sidoarjo</span>
      </div>
    </a>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const showBubble = ref(false)
const isHovered = ref(false)

const waPhone = '628133032313'
const defaultMessage = 'Halo CS PT Wanciruso Group Indonesia, saya ingin menanyakan informasi terkait layanan/kemitraan perusahaan.'
const waUrl = `https://wa.me/${waPhone}?text=${encodeURIComponent(defaultMessage)}`

const openWhatsApp = () => {
  if (typeof window !== 'undefined') {
    window.open(waUrl, '_blank', 'noopener,noreferrer')
  }
}

onMounted(() => {
  // Show gentle greeting bubble after 3.5 seconds
  const timer = setTimeout(() => {
    showBubble.value = true
  }, 3500)

  return () => clearTimeout(timer)
})
</script>

<style scoped>
.wa-float-container {
  position: fixed;
  bottom: 26px;
  right: 26px;
  z-index: 998;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  pointer-events: none;
}

/* GENTLE SPEECH BUBBLE */
.wa-speech-bubble {
  pointer-events: auto;
  margin-bottom: 12px;
  padding: 16px 18px;
  max-width: 290px;
  background: var(--charcoal);
  border: 1px solid rgba(37, 211, 102, 0.35);
  box-shadow: 0 16px 36px rgba(0, 0, 0, 0.45);
  border-radius: 12px;
  position: relative;
  cursor: pointer;
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
}

.wa-speech-bubble:hover {
  transform: translateY(-3px);
  border-color: #25D366;
  box-shadow: 0 20px 42px rgba(37, 211, 102, 0.25);
}

.bubble-close-btn {
  position: absolute;
  top: 8px;
  right: 10px;
  background: transparent;
  border: none;
  color: var(--grey);
  font-size: 18px;
  line-height: 1;
  cursor: pointer;
  padding: 4px;
  transition: color 0.2s;
}

.bubble-close-btn:hover {
  color: var(--white);
}

.bubble-header {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 6px;
}

.online-indicator {
  width: 8px;
  height: 8px;
  background-color: #25D366;
  border-radius: 50%;
  box-shadow: 0 0 0 2px rgba(37, 211, 102, 0.3);
  animation: pulse-dot 2s infinite;
}

.bubble-header strong {
  font-size: 13px;
  color: var(--white);
  font-weight: 600;
}

.wa-speech-bubble p {
  font-size: 12.5px;
  line-height: 1.45;
  color: var(--grey-lt);
  margin-bottom: 8px;
}

.bubble-cta {
  font-size: 11.5px;
  font-weight: 600;
  color: #25D366;
  display: inline-block;
}

/* FLOATING ACTION BUTTON */
.wa-float-btn {
  pointer-events: auto;
  display: inline-flex;
  align-items: center;
  gap: 12px;
  background: linear-gradient(135deg, #25D366 0%, #1da851 100%);
  color: #ffffff !important;
  text-decoration: none;
  padding: 12px 20px 12px 14px;
  border-radius: 50px;
  box-shadow: 0 10px 28px rgba(37, 211, 102, 0.4), 0 4px 12px rgba(0, 0, 0, 0.25);
  border: 1.5px solid rgba(255, 255, 255, 0.3);
  cursor: pointer;
  transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  animation: wa-glow 3s infinite;
}

.wa-float-btn:hover {
  transform: translateY(-4px) scale(1.03);
  box-shadow: 0 16px 36px rgba(37, 211, 102, 0.6), 0 6px 16px rgba(0, 0, 0, 0.35);
  background: linear-gradient(135deg, #2ae16d 0%, #20bd5a 100%);
}

.wa-icon-wrap {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
}

.wa-svg {
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.15));
}

.wa-status-badge {
  position: absolute;
  top: 1px;
  right: 1px;
  width: 10px;
  height: 10px;
  background-color: #ffffff;
  border: 2px solid #25D366;
  border-radius: 50%;
}

.wa-btn-text {
  display: flex;
  flex-direction: column;
  text-align: left;
}

.wa-label {
  font-family: 'Inter', sans-serif;
  font-size: 13.5px;
  font-weight: 700;
  letter-spacing: 0.02em;
  color: #ffffff;
  line-height: 1.2;
}

.wa-sub {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 10px;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.9);
  line-height: 1.1;
  margin-top: 1px;
}

/* ANIMATIONS */
@keyframes wa-glow {
  0% {
    box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.55), 0 8px 24px rgba(0, 0, 0, 0.3);
  }
  70% {
    box-shadow: 0 0 0 14px rgba(37, 211, 102, 0), 0 8px 24px rgba(0, 0, 0, 0.3);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(37, 211, 102, 0), 0 8px 24px rgba(0, 0, 0, 0.3);
  }
}

@keyframes pulse-dot {
  0% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
  }
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 6px rgba(37, 211, 102, 0);
  }
  100% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
  }
}

/* BUBBLE TRANSITION */
.fade-bubble-enter-active,
.fade-bubble-leave-active {
  transition: opacity 0.4s ease, transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.fade-bubble-enter-from,
.fade-bubble-leave-to {
  opacity: 0;
  transform: translateY(12px) scale(0.95);
}

/* RESPONSIVE DESIGN */
@media (max-width: 640px) {
  .wa-float-container {
    bottom: 20px;
    right: 18px;
  }
  .wa-float-btn {
    padding: 10px 14px;
    gap: 8px;
  }
  .wa-sub {
    display: none;
  }
  .wa-label {
    font-size: 12.5px;
  }
  .wa-speech-bubble {
    max-width: 250px;
    padding: 12px 14px;
  }
}
</style>
