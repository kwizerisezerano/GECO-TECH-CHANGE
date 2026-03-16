/**
 * API composable for making backend requests
 */
export const useApi = () => {
  const config = useRuntimeConfig()
  
  const apiCall = async (endpoint, options = {}) => {
    try {
      // For admin endpoints, use the full backend URL
      const url = endpoint.startsWith('/admin') 
        ? `http://localhost:3001/api${endpoint}`
        : `${config.public.apiBase}${endpoint}`
      
      console.log('API Call:', url, options)
      
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
  
  return {
    apiCall
  }
}
