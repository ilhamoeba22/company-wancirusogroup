export default defineNuxtPlugin((nuxtApp) => {
  const router = useRouter()
  const config = useRuntimeConfig()
  const apiBase = config.public.apiBase || 'https://wancirusogroupindonesia.com/api/v1'

  const track = (path: string) => {
    try {
      const targetPath = path || window.location.pathname || '/'
      const payload = {
        path: targetPath,
        referer: document.referrer || null
      }

      // Gunakan $fetch POST non-blocking
      $fetch(`${apiBase}/track-visit`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: payload
      }).catch(() => {
        // Silent catch agar performa frontend 100% terjaga
      })
    } catch (e) {
      // Ignore client side analytics errors
    }
  }

  if (process.client) {
    // Catat kunjungan awal setelah halaman termuat
    setTimeout(() => {
      track(window.location.pathname)
    }, 600)

    // Catat perpindahan rute halaman Nuxt berikutnya
    router.afterEach((to) => {
      setTimeout(() => {
        track(to.fullPath)
      }, 400)
    })
  }
})
