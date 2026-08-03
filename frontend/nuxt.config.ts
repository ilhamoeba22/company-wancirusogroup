// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  ssr: true,
  srcDir: '.',
  css: ['~/assets/css/main.css'],
  app: {
    head: {
      title: 'PT Wanciruso Group Indonesia (WGI) — Holding Company',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { name: 'description', content: 'PT Wanciruso Group Indonesia (WGI) adalah perusahaan holding nasional yang menaungi 8 unit usaha lintas sektor: Perdagangan & Ekspor-Impor, Alat Berat, Transportasi, Otomotif, Manufaktur, Konstruksi & Real Estate, Percetakan, dan Agribisnis.' }
      ],
      link: [
        { rel: 'icon', type: 'image/png', href: '/icon_wgi.png' }
      ]
    }
  },
  runtimeConfig: {
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE || 'http://localhost:8000/api/v1'
    }
  }
})
