<template>
  <div 
    class="gallery-3d-wrapper"
    ref="containerRef"
    @mouseenter="onMouseEnter"
    @mouseleave="onMouseLeave"
    @wheel.prevent="onWheel"
    @pointerdown="onPointerDown"
    @pointermove="onPointerMove"
    @pointerup="onPointerUp"
    @pointercancel="onPointerUp"
  >
    <!-- Background Ambient Glow -->
    <div class="ambient-glow" :style="ambientStyle"></div>
    <div class="radial-grid-overlay"></div>

    <!-- Active Item Top Header -->
    <div class="gallery-3d-header">
      <div class="active-badge">
        <span class="pulse-dot"></span>
        <span class="active-tag">FOKUS UNIT #{{ formattedIndex(currentIndex + 1) }}</span>
      </div>
      <h3 class="active-title">{{ currentItem?.title || 'Armada & Fasilitas Alat Berat' }}</h3>
      <p class="active-hint">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="hint-icon">
          <circle cx="11" cy="11" r="8"/>
          <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        Klik foto tengah untuk Fullscreen Lightbox &bull; Geser/scroll untuk rotasi
      </p>
    </div>

    <!-- 3D Stage / Viewport -->
    <div class="stage-3d">
      <div class="scene-3d">
        <div 
          v-for="(item, idx) in items" 
          :key="idx"
          class="card-3d"
          :class="{ 'is-active': idx === currentIndex }"
          :style="getCardStyle(idx)"
          @click="onCardClick(idx)"
        >
          <div class="card-inner glass-card">
            <div class="card-image-wrap">
              <img 
                :src="item.src" 
                :alt="item.title" 
                class="card-img" 
                loading="lazy" 
                draggable="false"
              />
              <div class="card-glass-shine"></div>
              
              <!-- Active Glow Tag -->
              <div v-if="idx === currentIndex" class="active-zoom-callout">
                <span class="callout-pill">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="callout-icon">
                    <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/>
                  </svg>
                  Perbesar Resolusi Penuh
                </span>
              </div>
            </div>

            <!-- Card Bottom Bar -->
            <div class="card-footer">
              <span class="card-num">#{{ formattedIndex(idx + 1) }}</span>
              <p class="card-title">{{ item.title }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Floating Control Panel -->
    <div class="floating-panel glass-card">
      <!-- Layout Modes Switcher -->
      <div class="panel-section modes-group">
        <span class="panel-label">BENTUK:</span>
        <button 
          v-for="mode in layoutModes" 
          :key="mode.id"
          class="mode-btn"
          :class="{ active: currentMode === mode.id }"
          @click.stop="setMode(mode.id)"
          :title="mode.desc"
        >
          <component :is="mode.icon" class="mode-icon" />
          <span class="mode-text">{{ mode.label }}</span>
        </button>
      </div>

      <div class="panel-divider"></div>

      <!-- Navigation Arrows & Counter -->
      <div class="panel-section nav-group">
        <button 
          class="panel-nav-btn" 
          @click.stop="prevSlide" 
          :disabled="currentIndex <= 0"
          aria-label="Foto Sebelumnya"
        >
          &#10094;
        </button>

        <span class="panel-counter">
          <strong>{{ formattedIndex(currentIndex + 1) }}</strong> / {{ formattedIndex(items.length) }}
        </span>

        <button 
          class="panel-nav-btn" 
          @click.stop="nextSlide" 
          :disabled="currentIndex >= items.length - 1"
          aria-label="Foto Berikutnya"
        >
          &#10095;
        </button>
      </div>

      <div class="panel-divider"></div>

      <!-- Auto Play Toggle -->
      <div class="panel-section autoplay-group">
        <button 
          class="autoplay-btn"
          :class="{ playing: isAutoplayActive }"
          @click.stop="toggleAutoplay"
          :title="isAutoplayActive ? 'Pause Rotasi Otomatis' : 'Mulai Rotasi Otomatis'"
        >
          <span class="autoplay-dot"></span>
          <span>{{ isAutoplayActive ? 'Auto: ON' : 'Auto: OFF' }}</span>
        </button>
      </div>
    </div>

    <!-- Floating Navigation Side Handles -->
    <button 
      class="side-arrow-handle prev-handle"
      v-show="currentIndex > 0"
      @click.stop="prevSlide"
      aria-label="Sebelumnya"
    >
      &#10094;
    </button>
    <button 
      class="side-arrow-handle next-handle"
      v-show="currentIndex < items.length - 1"
      @click.stop="nextSlide"
      aria-label="Berikutnya"
    >
      &#10095;
    </button>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, h } from 'vue'

const props = defineProps({
  items: {
    type: Array,
    required: true,
    default: () => []
  }
})

const emit = defineEmits(['open-lightbox'])

const containerRef = ref(null)
const currentIndex = ref(0)
const currentOffset = ref(0)
const isDragging = ref(false)
const dragStartX = ref(0)
const dragStartOffset = ref(0)
const dragLastX = ref(0)
const isHovered = ref(false)
const isAutoplayActive = ref(true)
const currentMode = ref('spiral-loose') // 'flat', 'spiral-loose', 'spiral-tight'

// Responsive viewport detection
const isMobile = ref(false)
const checkMobile = () => {
  if (typeof window !== 'undefined') {
    isMobile.value = window.innerWidth < 768
  }
}

// Icons for modes using render functions
const FlatIcon = () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [
  h('line', { x1: '3', y1: '12', x2: '21', y2: '12' }),
  h('rect', { x: '5', y: '6', width: '4', height: '12', rx: '1' }),
  h('rect', { x: '10', y: '5', width: '4', height: '14', rx: '1' }),
  h('rect', { x: '15', y: '6', width: '4', height: '12', rx: '1' })
])

const SpiralLooseIcon = () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [
  h('path', { d: 'M12 2a10 10 0 1 0 10 10 7 7 0 1 0-7-7 4 4 0 1 0 4 4' })
])

const SpiralTightIcon = () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [
  h('circle', { cx: '12', cy: '12', r: '10' }),
  h('path', { d: 'M12 6a6 6 0 1 0 6 6 3 3 0 1 0-3-3' }),
  h('circle', { cx: '12', cy: '12', r: '1' })
])

const layoutModes = [
  { id: 'flat', label: 'Datar', desc: 'Gulungan horizontal reel sejajar', icon: FlatIcon },
  { id: 'spiral-loose', label: 'Spiral Renggang', desc: 'Kurva melengkung heliks 3D terbuka', icon: SpiralLooseIcon },
  { id: 'spiral-tight', label: 'Spiral Rapat', desc: 'Kurva silinder 3D rapat memutar', icon: SpiralTightIcon }
]

const currentItem = computed(() => {
  return props.items[currentIndex.value] || props.items[0]
})

const formattedIndex = (num) => {
  return String(num).padStart(2, '0')
}

const ambientStyle = computed(() => {
  return {
    opacity: 0.65
  }
})

// Smooth snapping animation variable
let animFrame = null
const targetOffset = ref(0)

const animateToTarget = () => {
  const diff = targetOffset.value - currentOffset.value
  if (Math.abs(diff) > 0.002) {
    currentOffset.value += diff * 0.16
    animFrame = requestAnimationFrame(animateToTarget)
  } else {
    currentOffset.value = targetOffset.value
    currentIndex.value = Math.round(targetOffset.value)
  }
}

const goToIndex = (target) => {
  const maxIdx = Math.max(0, props.items.length - 1)
  const clamped = Math.max(0, Math.min(maxIdx, target))
  targetOffset.value = clamped
  cancelAnimationFrame(animFrame)
  animateToTarget()
}

const prevSlide = () => {
  if (currentIndex.value > 0) {
    goToIndex(currentIndex.value - 1)
  }
}

const nextSlide = () => {
  if (currentIndex.value < props.items.length - 1) {
    goToIndex(currentIndex.value + 1)
  } else if (isAutoplayActive.value) {
    // Loop back to start in autoplay
    goToIndex(0)
  }
}

const setMode = (mode) => {
  currentMode.value = mode
}

// 3D Transform Calculation
const getCardStyle = (idx) => {
  const diff = idx - currentOffset.value
  const absDiff = Math.abs(diff)
  
  // Cull cards that are too far away for performance
  if (absDiff > 6.5) {
    return { display: 'none' }
  }

  let x = 0
  let y = 0
  let z = 0
  let rotateY = 0
  let rotateX = 0
  let scale = 1
  let opacity = 1

  if (currentMode.value === 'flat') {
    const spacing = isMobile.value ? 200 : 310
    x = diff * spacing
    y = 0
    z = -absDiff * (isMobile.value ? 70 : 110)
    rotateY = diff * -12
    rotateX = 0
    scale = Math.max(0.68, 1 - absDiff * 0.07)
    opacity = Math.max(0.18, 1 - absDiff * 0.22)
  } else if (currentMode.value === 'spiral-loose') {
    // Gentle open helix
    const angle = diff * 0.42
    const radiusX = isMobile.value ? 240 : 420
    const radiusZ = isMobile.value ? 220 : 360
    const pitch = isMobile.value ? 20 : 32

    x = Math.sin(angle) * radiusX
    z = (Math.cos(angle) - 1) * radiusZ
    y = diff * pitch
    rotateY = -(angle * 180 / Math.PI)
    rotateX = diff * 2.5
    scale = Math.max(0.72, 1 - absDiff * 0.05)
    opacity = Math.max(0.22, 1 - absDiff * 0.16)
  } else if (currentMode.value === 'spiral-tight') {
    // Dramatic cylindrical spiral
    const angle = diff * 0.65
    const radiusX = isMobile.value ? 180 : 310
    const radiusZ = isMobile.value ? 200 : 380
    const pitch = isMobile.value ? 32 : 52

    x = Math.sin(angle) * radiusX
    z = (Math.cos(angle) - 1) * radiusZ
    y = diff * pitch
    rotateY = -(angle * 180 / Math.PI) * 1.18
    rotateX = diff * 4
    scale = Math.max(0.64, 1 - absDiff * 0.08)
    opacity = Math.max(0.2, 1 - absDiff * 0.18)
  }

  const zIndex = Math.round(1000 + z)

  return {
    transform: `translate3d(${x.toFixed(2)}px, ${y.toFixed(2)}px, ${z.toFixed(2)}px) rotateY(${rotateY.toFixed(2)}deg) rotateX(${rotateX.toFixed(2)}deg) scale(${scale.toFixed(3)})`,
    opacity: opacity.toFixed(3),
    zIndex: zIndex,
    transition: isDragging.value ? 'none' : 'transform 0.45s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease'
  }
}

// Pointer & Touch Drag Handlers
const onPointerDown = (e) => {
  isDragging.value = true
  dragStartX.value = e.clientX
  dragLastX.value = e.clientX
  dragStartOffset.value = currentOffset.value
  cancelAnimationFrame(animFrame)
  
  if (containerRef.value && e.setPointerCapture) {
    containerRef.value.setPointerCapture(e.pointerId)
  }
}

const onPointerMove = (e) => {
  if (!isDragging.value) return
  const deltaX = e.clientX - dragStartX.value
  const dragSensitivity = isMobile.value ? 0.004 : 0.0028
  
  let newOffset = dragStartOffset.value - (deltaX * dragSensitivity)
  const maxIdx = Math.max(0, props.items.length - 1)
  
  // Rubber-band resistance at boundaries
  if (newOffset < 0) {
    newOffset = newOffset * 0.35
  } else if (newOffset > maxIdx) {
    newOffset = maxIdx + (newOffset - maxIdx) * 0.35
  }
  
  currentOffset.value = newOffset
  currentIndex.value = Math.max(0, Math.min(maxIdx, Math.round(newOffset)))
  dragLastX.value = e.clientX
}

const onPointerUp = (e) => {
  if (!isDragging.value) return
  isDragging.value = false
  
  if (containerRef.value && e.releasePointerCapture) {
    try {
      containerRef.value.releasePointerCapture(e.pointerId)
    } catch (_) {}
  }
  
  const maxIdx = Math.max(0, props.items.length - 1)
  const target = Math.max(0, Math.min(maxIdx, Math.round(currentOffset.value)))
  goToIndex(target)
}

// Mouse Wheel Navigation
let wheelTimeout = null
const onWheel = (e) => {
  const delta = Math.abs(e.deltaX) > Math.abs(e.deltaY) ? e.deltaX : e.deltaY
  if (Math.abs(delta) < 15) return
  
  if (wheelTimeout) return
  wheelTimeout = setTimeout(() => {
    wheelTimeout = null
  }, 220)

  if (delta > 0) {
    nextSlide()
  } else {
    prevSlide()
  }
}

// Card Click Logic
const onCardClick = (idx) => {
  if (isDragging.value) return
  if (idx === currentIndex.value) {
    // Click active card: Open Fullscreen Lightbox
    emit('open-lightbox', idx)
  } else {
    // Click off-center card: Rotate to focus
    goToIndex(idx)
  }
}

// Autoplay
let autoplayTimer = null

const startAutoplay = () => {
  stopAutoplay()
  if (!isAutoplayActive.value) return
  autoplayTimer = setInterval(() => {
    if (!isHovered.value && !isDragging.value) {
      nextSlide()
    }
  }, 3800)
}

const stopAutoplay = () => {
  if (autoplayTimer) {
    clearInterval(autoplayTimer)
    autoplayTimer = null
  }
}

const toggleAutoplay = () => {
  isAutoplayActive.value = !isAutoplayActive.value
  if (isAutoplayActive.value) {
    startAutoplay()
  } else {
    stopAutoplay()
  }
}

const onMouseEnter = () => {
  isHovered.value = true
}

const onMouseLeave = () => {
  isHovered.value = false
}

onMounted(() => {
  checkMobile()
  if (typeof window !== 'undefined') {
    window.addEventListener('resize', checkMobile)
  }
  targetOffset.value = 0
  currentOffset.value = 0
  startAutoplay()
})

onUnmounted(() => {
  stopAutoplay()
  cancelAnimationFrame(animFrame)
  if (typeof window !== 'undefined') {
    window.removeEventListener('resize', checkMobile)
  }
})
</script>

<style scoped>
.gallery-3d-wrapper {
  position: relative;
  width: 100%;
  min-height: 580px;
  background: radial-gradient(circle at 50% 40%, rgba(30, 24, 20, 0.95) 0%, rgba(12, 11, 10, 1) 85%);
  border-radius: 8px;
  border: 1px solid var(--glass-border);
  overflow: hidden;
  user-select: none;
  touch-action: pan-y;
  cursor: grab;
  display: flex;
  flex-direction: column;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6);
}

.gallery-3d-wrapper:active {
  cursor: grabbing;
}

/* Ambient Radial Glow */
.ambient-glow {
  position: absolute;
  top: 30%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 600px;
  height: 380px;
  background: radial-gradient(ellipse, rgba(224, 43, 32, 0.16) 0%, rgba(212, 175, 55, 0.08) 45%, transparent 75%);
  filter: blur(50px);
  pointer-events: none;
  z-index: 1;
}

.radial-grid-overlay {
  position: absolute;
  inset: 0;
  background-image: 
    linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
  background-size: 40px 40px;
  pointer-events: none;
  z-index: 2;
}

/* Gallery Header */
.gallery-3d-header {
  position: relative;
  z-index: 10;
  text-align: center;
  padding: 30px 24px 10px;
}

.active-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 4px 14px;
  background: rgba(224, 43, 32, 0.12);
  border: 1px solid rgba(224, 43, 32, 0.35);
  border-radius: 20px;
  margin-bottom: 10px;
}

.pulse-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--red-hi);
  box-shadow: 0 0 10px var(--red-hi);
  animation: pulse 1.8s infinite;
}

@keyframes pulse {
  0% { transform: scale(0.9); opacity: 0.8; }
  50% { transform: scale(1.3); opacity: 1; box-shadow: 0 0 14px var(--red-hi); }
  100% { transform: scale(0.9); opacity: 0.8; }
}

.active-tag {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.12em;
  color: var(--red-hi);
  font-weight: 600;
}

.active-title {
  font-size: clamp(18px, 2.2vw, 24px);
  color: var(--white);
  font-weight: 500;
  letter-spacing: -0.01em;
  margin: 0;
  transition: all 0.3s ease;
}

.active-hint {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 12.5px;
  color: var(--grey-lt);
  margin-top: 6px;
  font-weight: 300;
}

.hint-icon {
  width: 14px;
  height: 14px;
  color: var(--gold);
}

/* 3D Stage */
.stage-3d {
  position: relative;
  flex: 1;
  min-height: 420px;
  display: flex;
  align-items: center;
  justify-content: center;
  perspective: 1200px;
  perspective-origin: 50% 50%;
  z-index: 5;
  overflow: visible;
}

.scene-3d {
  position: relative;
  width: 0;
  height: 0;
  transform-style: preserve-3d;
}

/* Card 3D */
.card-3d {
  position: absolute;
  top: -125px;
  left: -190px;
  width: 380px;
  height: 250px;
  transform-style: preserve-3d;
  will-change: transform, opacity;
  cursor: pointer;
}

.card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  border-radius: 6px;
  overflow: hidden;
  background: var(--charcoal);
  border: 1px solid var(--glass-border);
  box-shadow: 0 16px 36px rgba(0, 0, 0, 0.7);
  display: flex;
  flex-direction: column;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.card-3d.is-active .card-inner {
  border-color: rgba(224, 43, 32, 0.7);
  box-shadow: 0 20px 50px rgba(224, 43, 32, 0.25), 0 0 20px rgba(224, 43, 32, 0.3);
}

.card-image-wrap {
  position: relative;
  width: 100%;
  flex: 1;
  overflow: hidden;
  background: #090807;
}

.card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  pointer-events: none;
}

.card-glass-shine {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.08) 0%, transparent 60%);
  pointer-events: none;
}

.active-zoom-callout {
  position: absolute;
  inset: 0;
  background: rgba(14, 13, 12, 0.45);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.card-3d.is-active:hover .active-zoom-callout {
  opacity: 1;
}

.callout-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  background: var(--glass-bg);
  backdrop-filter: blur(12px);
  border: 1px solid var(--red-hi);
  color: var(--white);
  border-radius: 20px;
  font-size: 12px;
  font-family: 'IBM Plex Mono', monospace;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
}

.callout-icon {
  width: 14px;
  height: 14px;
  color: var(--red-hi);
}

.card-footer {
  padding: 10px 14px;
  background: rgba(18, 17, 16, 0.95);
  border-top: 1px solid var(--glass-border);
  display: flex;
  align-items: center;
  gap: 10px;
}

.card-num {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 11px;
  color: var(--red-hi);
  font-weight: 600;
  background: rgba(224, 43, 32, 0.12);
  padding: 2px 6px;
  border-radius: 3px;
}

.card-title {
  font-size: 12px;
  color: var(--white);
  font-weight: 400;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin: 0;
}

/* Floating Control Panel */
.floating-panel {
  position: relative;
  z-index: 20;
  margin: 0 auto 24px;
  padding: 8px 18px;
  border-radius: 30px;
  background: rgba(18, 17, 16, 0.85);
  backdrop-filter: blur(16px);
  border: 1px solid var(--glass-border);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
  display: inline-flex;
  align-items: center;
  gap: 16px;
  max-width: 90%;
  align-self: center;
}

.panel-section {
  display: flex;
  align-items: center;
  gap: 8px;
}

.panel-label {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 10px;
  color: var(--grey-lt);
  letter-spacing: 0.08em;
}

.modes-group {
  display: flex;
  gap: 4px;
}

.mode-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 12px;
  background: transparent;
  border: 1px solid transparent;
  border-radius: 18px;
  color: var(--grey-lt);
  font-size: 12px;
  cursor: pointer;
  transition: all 0.25s ease;
}

.mode-btn:hover {
  color: var(--white);
  background: rgba(255, 255, 255, 0.05);
}

.mode-btn.active {
  color: var(--white);
  background: rgba(224, 43, 32, 0.18);
  border-color: rgba(224, 43, 32, 0.5);
}

.mode-icon {
  width: 14px;
  height: 14px;
}

.mode-btn.active .mode-icon {
  color: var(--red-hi);
}

.panel-divider {
  width: 1px;
  height: 20px;
  background: var(--grey-line);
}

.panel-nav-btn {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid var(--glass-border);
  color: var(--white);
  font-size: 13px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.25s ease;
}

.panel-nav-btn:hover:not(:disabled) {
  background: var(--red-hi);
  border-color: var(--red-hi);
}

.panel-nav-btn:disabled {
  opacity: 0.3;
  cursor: not-allowed;
}

.panel-counter {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 12px;
  color: var(--grey-lt);
  padding: 0 4px;
}

.panel-counter strong {
  color: var(--white);
}

.autoplay-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 12px;
  border-radius: 16px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid var(--glass-border);
  color: var(--grey-lt);
  font-size: 11px;
  font-family: 'IBM Plex Mono', monospace;
  cursor: pointer;
  transition: all 0.25s ease;
}

.autoplay-btn.playing {
  color: var(--gold);
  border-color: rgba(212, 175, 55, 0.4);
}

.autoplay-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--grey-lt);
}

.autoplay-btn.playing .autoplay-dot {
  background: var(--gold);
  box-shadow: 0 0 8px var(--gold);
}

/* Side Arrow Handles */
.side-arrow-handle {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 44px;
  height: 60px;
  background: rgba(14, 13, 12, 0.7);
  border: 1px solid var(--glass-border);
  color: var(--white);
  font-size: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 15;
  backdrop-filter: blur(8px);
  transition: all 0.25s ease;
}

.prev-handle {
  left: 0;
  border-top-right-radius: 8px;
  border-bottom-right-radius: 8px;
  border-left: none;
}

.next-handle {
  right: 0;
  border-top-left-radius: 8px;
  border-bottom-left-radius: 8px;
  border-right: none;
}

.side-arrow-handle:hover {
  background: var(--red-hi);
  color: var(--white);
}

/* Responsive adjustments */
@media (max-width: 860px) {
  .card-3d {
    top: -95px;
    left: -130px;
    width: 260px;
    height: 175px;
  }
  .stage-3d {
    min-height: 350px;
  }
  .gallery-3d-wrapper {
    min-height: 520px;
  }
  .floating-panel {
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 16px;
  }
  .panel-divider {
    display: none;
  }
  .mode-text {
    display: none;
  }
  .mode-btn {
    padding: 6px 10px;
  }
}

@media (max-width: 540px) {
  .card-3d {
    top: -85px;
    left: -115px;
    width: 230px;
    height: 155px;
  }
  .stage-3d {
    min-height: 310px;
  }
  .gallery-3d-header {
    padding: 20px 14px 6px;
  }
  .active-title {
    font-size: 16px;
  }
  .side-arrow-handle {
    width: 34px;
    height: 48px;
    font-size: 14px;
  }
}

/* ==========================================================
   LIGHT MODE ADAPTATIONS ([data-theme="light"])
   ========================================================== */
:global([data-theme="light"]) .gallery-3d-wrapper {
  background: radial-gradient(circle at 50% 35%, #FFFFFF 0%, #F8FAFC 60%, #EEF2F6 100%);
  border-color: var(--grey-line);
  box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
}

:global([data-theme="light"]) .ambient-glow {
  background: radial-gradient(ellipse, rgba(214, 66, 52, 0.1) 0%, rgba(212, 175, 55, 0.05) 45%, transparent 75%);
}

:global([data-theme="light"]) .radial-grid-overlay {
  background-image: 
    linear-gradient(rgba(15, 23, 42, 0.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(15, 23, 42, 0.035) 1px, transparent 1px);
}

:global([data-theme="light"]) .active-badge {
  background: rgba(214, 66, 52, 0.08);
  border-color: rgba(214, 66, 52, 0.25);
}

:global([data-theme="light"]) .active-title {
  color: #0F172A;
}

:global([data-theme="light"]) .active-hint {
  color: #64748B;
}

:global([data-theme="light"]) .card-inner {
  background: #FFFFFF;
  border-color: #E2E8F0;
  box-shadow: 0 14px 34px rgba(15, 23, 42, 0.12), 0 2px 6px rgba(15, 23, 42, 0.04);
}

:global([data-theme="light"]) .card-3d.is-active .card-inner {
  border-color: var(--red-hi);
  box-shadow: 0 18px 45px rgba(214, 66, 52, 0.25), 0 0 15px rgba(214, 66, 52, 0.2);
}

:global([data-theme="light"]) .card-image-wrap {
  background: #E2E8F0;
}

:global([data-theme="light"]) .card-footer {
  background: rgba(255, 255, 255, 0.98);
  border-top-color: #E2E8F0;
}

:global([data-theme="light"]) .card-title {
  color: #0F172A;
}

:global([data-theme="light"]) .card-num {
  background: rgba(214, 66, 52, 0.09);
  color: var(--red-hi);
}

:global([data-theme="light"]) .floating-panel {
  background: rgba(255, 255, 255, 0.94);
  border-color: #E2E8F0;
  box-shadow: 0 12px 35px rgba(15, 23, 42, 0.12);
}

:global([data-theme="light"]) .panel-label {
  color: #64748B;
}

:global([data-theme="light"]) .mode-btn {
  color: #64748B;
}

:global([data-theme="light"]) .mode-btn:hover {
  color: #0F172A;
  background: rgba(15, 23, 42, 0.05);
}

:global([data-theme="light"]) .mode-btn.active {
  color: var(--red-hi);
  background: rgba(214, 66, 52, 0.1);
  border-color: rgba(214, 66, 52, 0.35);
}

:global([data-theme="light"]) .panel-divider {
  background: #E2E8F0;
}

:global([data-theme="light"]) .panel-nav-btn {
  background: #F1F5F9;
  border-color: #E2E8F0;
  color: #0F172A;
}

:global([data-theme="light"]) .panel-nav-btn:hover:not(:disabled) {
  background: var(--red-hi);
  border-color: var(--red-hi);
  color: #FFFFFF;
}

:global([data-theme="light"]) .panel-counter {
  color: #64748B;
}

:global([data-theme="light"]) .panel-counter strong {
  color: #0F172A;
}

:global([data-theme="light"]) .autoplay-btn {
  background: #F1F5F9;
  border-color: #E2E8F0;
  color: #64748B;
}

:global([data-theme="light"]) .autoplay-btn.playing {
  color: #B45309;
  border-color: rgba(180, 83, 9, 0.35);
}

:global([data-theme="light"]) .autoplay-dot {
  background: #CBD5E1;
}

:global([data-theme="light"]) .autoplay-btn.playing .autoplay-dot {
  background: #D97706;
  box-shadow: 0 0 8px #D97706;
}

:global([data-theme="light"]) .side-arrow-handle {
  background: rgba(255, 255, 255, 0.94);
  border-color: #E2E8F0;
  color: #0F172A;
  box-shadow: 0 4px 15px rgba(15, 23, 42, 0.1);
}

:global([data-theme="light"]) .side-arrow-handle:hover {
  background: var(--red-hi);
  border-color: var(--red-hi);
  color: #FFFFFF;
}

:global([data-theme="light"]) .callout-pill {
  background: rgba(255, 255, 255, 0.92);
  border-color: var(--red-hi);
  color: #0F172A;
  box-shadow: 0 4px 20px rgba(15, 23, 42, 0.15);
}
</style>
