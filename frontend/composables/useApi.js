export const useApi = () => {
  const config = useRuntimeConfig()
  
  const apiCall = async (endpoint, options = {}) => {
    try {
      const url = `${config.public.apiBase}${endpoint}`
      return await $fetch(url, {
        ...options,
        headers: {
          'Content-Type': 'application/json',
          ...options.headers
        }
      })
    } catch (error) {
      console.error('API Error:', error)
      throw error
    }
  }
  
  return { apiCall }
}
