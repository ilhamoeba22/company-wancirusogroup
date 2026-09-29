// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  ssr: true,
  srcDir: '.',
  css: ['~/assets/css/main.css'],
  app: {
    head: {
      htmlAttrs: {
        lang: 'id'
      },
      title: 'PT Wanciruso Group Indonesia (WGI) — Holding Company',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { 
          name: 'description', 
          content: 'PT Wanciruso Group Indonesia (WGI) adalah perusahaan holding nasional terkemuka yang menaungi 4 unit bisnis unggulan: Alat Berat & Service, Transportasi & Angkutan Logistics, Percetakan Komersil, dan Otomotif & Detailing.' 
        },
        { 
          name: 'keywords', 
          content: 'PT Wanciruso Group Indonesia, Wanciruso Group, Wanciruso, WGI, sewa alat berat, sewa forklift crane, rental forklift, service alat berat, transportasi logistik, jasa angkutan darat, ekspedisi kargo, percetakan komersil offset digital, cetak kemasan, otomotif salon mobil detailing, holding company indonesia' 
        },
        { name: 'author', content: 'PT Wanciruso Group Indonesia' },
        { name: 'robots', content: 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' },
        
        // OpenGraph / Facebook / WhatsApp
        { property: 'og:locale', content: 'id_ID' },
        { property: 'og:type', content: 'website' },
        { property: 'og:title', content: 'PT Wanciruso Group Indonesia (WGI) — Holding Company' },
        { property: 'og:description', content: 'Satu Grup, Banyak Sektor, Satu Komitmen Mitra. Perusahaan holding dengan 4 unit bisnis: Alat Berat & Service, Transportasi Logistik, Percetakan Komersil, dan Otomotif Detailing.' },
        { property: 'og:url', content: 'https://wancirusogroupindonesia.com/' },
        { property: 'og:site_name', content: 'PT Wanciruso Group Indonesia' },
        { property: 'og:image', content: 'https://wancirusogroupindonesia.com/images/hero_bg.jpg' },
        
        // Twitter Cards
        { name: 'twitter:card', content: 'summary_large_image' },
        { name: 'twitter:title', content: 'PT Wanciruso Group Indonesia (WGI)' },
        { name: 'twitter:description', content: 'Perusahaan holding nasional terkemuka dengan 4 pilar bisnis lintas sektor strategis.' },
        { name: 'twitter:image', content: 'https://wancirusogroupindonesia.com/images/hero_bg.jpg' }
      ],
      link: [
        { rel: 'icon', type: 'image/png', href: '/icon_wgi.png' },
        { rel: 'canonical', href: 'https://wancirusogroupindonesia.com/' }
      ],
      script: [
        {
          type: 'application/ld+json',
          children: JSON.stringify({
            '@context': 'https://schema.org',
            '@type': 'Corporation',
            'name': 'PT Wanciruso Group Indonesia',
            'alternateName': ['WGI', 'Wanciruso Group', 'Wanciruso Group Indonesia'],
            'url': 'https://wancirusogroupindonesia.com',
            'logo': 'https://wancirusogroupindonesia.com/images/logo_wgi.png',
            'description': 'Perusahaan holding nasional terkemuka yang menaungi 4 unit usaha unggulan di sektor Alat Berat & Service, Transportasi Logistik, Percetakan Komersil, dan Otomotif & Detailing.',
            'address': {
              '@type': 'PostalAddress',
              'addressCountry': 'ID'
            },
            'hasOfferCatalog': {
              '@type': 'OfferCatalog',
              'name': 'Layanan Unit Usaha WGI',
              'itemListElement': [
                {
                  '@type': 'Offer',
                  'itemOffered': {
                    '@type': 'Service',
                    'name': 'Alat Berat & Service (Sewa Forklift & Crane, Maintenance)'
                  }
                },
                {
                  '@type': 'Offer',
                  'itemOffered': {
                    '@type': 'Service',
                    'name': 'Transportasi & Angkutan Logistics'
                  }
                },
                {
                  '@type': 'Offer',
                  'itemOffered': {
                    '@type': 'Service',
                    'name': 'Percetakan Komersil Offset & Digital'
                  }
                },
                {
                  '@type': 'Offer',
                  'itemOffered': {
                    '@type': 'Service',
                    'name': 'Otomotif & Detailing'
                  }
                }
              ]
            }
          })
        }
      ]
    }
  },
  runtimeConfig: {
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE || 'https://wancirusogroupindonesia.com/api/v1'
    }
  }
})
