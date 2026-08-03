export const useApiData = () => {
  const config = useRuntimeConfig()
  const apiBase = config.public.apiBase || 'http://localhost:8000/api/v1'

  const fetchUnitUsaha = async () => {
    try {
      const { data, error } = await useFetch(`${apiBase}/unit-usaha`)
      if (!error.value && data.value?.data) {
        return data.value.data
      }
    } catch (e) {
      console.warn('API Offline, using fallback unit usaha data')
    }
    return null
  }

  const fetchUnitBySlug = async (slug: string) => {
    try {
      const { data, error } = await useFetch(`${apiBase}/unit-usaha/${slug}`)
      if (!error.value && data.value?.data) {
        return data.value.data
      }
    } catch (e) {
      console.warn('API Offline, using fallback slug data')
    }
    return null
  }

  const fetchSertifikasi = async () => {
    try {
      const { data, error } = await useFetch(`${apiBase}/sertifikasi`)
      if (!error.value && data.value?.data) {
        return data.value.data
      }
    } catch (e) {
      console.warn('API Offline, using fallback sertifikasi data')
    }
    return null
  }

  const fetchBerita = async () => {
    try {
      const { data, error } = await useFetch(`${apiBase}/berita`)
      if (!error.value && data.value?.data) {
        return data.value.data
      }
    } catch (e) {
      console.warn('API Offline, using fallback berita data')
    }
    return null
  }

  const sendKemitraan = async (payload: any) => {
    return await $fetch(`${apiBase}/kemitraan`, {
      method: 'POST',
      body: payload
    })
  }

  const sendInvestorRequest = async (payload: any) => {
    return await $fetch(`${apiBase}/investor-request`, {
      method: 'POST',
      body: payload
    })
  }

  return {
    fetchUnitUsaha,
    fetchUnitBySlug,
    fetchSertifikasi,
    fetchBerita,
    sendKemitraan,
    sendInvestorRequest
  }
}
