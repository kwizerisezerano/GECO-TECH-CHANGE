export default defineNuxtRouteMiddleware((to, from) => {
  const authStore = useAuthStore()
  
  // Initialize auth state
  authStore.initAuth()
  
  // Check if user is authenticated
  if (!authStore.isAuthenticated || !authStore.currentUser) {
    // Clear any invalid auth state
    authStore.clearAuth()
    // Redirect to login page
    return navigateTo('/admin/login')
  }
  
  // Additional validation - check if user data is valid
  try {
    const user = authStore.currentUser
    if (!user || !user.email) {
      authStore.clearAuth()
      return navigateTo('/admin/login')
    }
  } catch (error) {
    authStore.clearAuth()
    return navigateTo('/admin/login')
  }
})
