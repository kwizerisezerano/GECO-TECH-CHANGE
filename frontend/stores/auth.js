import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    isAuthenticated: false
  }),
  
  getters: {
    currentUser: (state) => state.user,
    isLoggedIn: (state) => state.isAuthenticated
  },
  
  actions: {
    setAuth(user) {
      this.user = user
      this.isAuthenticated = true
      
      // Store in localStorage for persistence
      if (typeof window !== 'undefined') {
        localStorage.setItem('admin_user', JSON.stringify(user))
        localStorage.setItem('is_authenticated', 'true')
      }
    },
    
    clearAuth() {
      this.user = null
      this.isAuthenticated = false
      
      // Clear from localStorage
      if (typeof window !== 'undefined') {
        localStorage.removeItem('admin_user')
        localStorage.removeItem('is_authenticated')
      }
    },
    
    // Initialize auth state from localStorage
    initAuth() {
      if (typeof window !== 'undefined') {
        const user = localStorage.getItem('admin_user')
        const isAuthenticated = localStorage.getItem('is_authenticated')
        
        if (user && isAuthenticated === 'true') {
          try {
            this.user = JSON.parse(user)
            this.isAuthenticated = true
          } catch (e) {
            this.clearAuth()
          }
        }
      }
    }
  }
})
