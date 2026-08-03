import { ref, onMounted } from 'vue'

export const useTheme = () => {
  const theme = ref<'dark' | 'light'>('dark')

  const toggleTheme = () => {
    theme.value = theme.value === 'dark' ? 'light' : 'dark'
    if (process.client) {
      document.documentElement.setAttribute('data-theme', theme.value)
      localStorage.setItem('wgi-theme', theme.value)
    }
  }

  const initTheme = () => {
    if (process.client) {
      const saved = localStorage.getItem('wgi-theme') as 'dark' | 'light' | null
      if (saved) {
        theme.value = saved
      } else {
        theme.value = 'dark'
      }
      document.documentElement.setAttribute('data-theme', theme.value)
    }
  }

  return {
    theme,
    toggleTheme,
    initTheme
  }
}
