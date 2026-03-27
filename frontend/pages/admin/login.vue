<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden max-w-md w-full" data-aos="fade-up">
      <!-- Header -->
      <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-8 text-center">
        <img src="/assets/img/logo.png" alt="GECO RWANDA Logo" class="w-full h-40 mx-auto mb-4 object-contain">
        <h2 class="text-2xl font-bold mb-2">Admin Login</h2>
        <p class="text-purple-100">GECO RWANDA Management System</p>
      </div>
      
      <!-- Login Form -->
      <div class="p-8">
        <div v-if="error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
          {{ error }}
        </div>
        
        <form @submit.prevent="handleLogin">
          <div class="mb-6">
            <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">
              Email
            </label>
            <input
              v-model="form.email"
              type="email"
              id="email"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200"
              placeholder="Enter admin email"
              required
            />
          </div>
          
          <div class="mb-6">
            <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">
              Password
            </label>
            <div class="relative">
              <input
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                id="password"
                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200"
                placeholder="Enter password"
                required
              />
              <button
                type="button"
                @click="showPassword = !showPassword"
                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none"
              >
                <svg v-if="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                </svg>
                <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
              </button>
            </div>
          </div>
          
          <button
            type="submit"
            :disabled="loading"
            class="w-full bg-gradient-to-r from-purple-600 to-purple-800 text-white font-semibold py-3 rounded-lg hover:from-purple-700 hover:to-purple-900 transition duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span v-if="loading" class="flex items-center justify-center">
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              Logging in...
            </span>
            <span v-else class="flex items-center justify-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
              </svg>
              Login
            </span>
          </button>
        </form>
        
        <div class="mt-6 text-center">
          <NuxtLink 
            to="/" 
            class="text-purple-600 hover:text-purple-800 font-semibold text-sm transition duration-200"
          >
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Website
          </NuxtLink>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '~/stores/auth'

definePageMeta({
  layout: false
})

const router = useRouter()
const authStore = useAuthStore()

const form = ref({
  email: '',
  password: ''
})

const showPassword = ref(false)

const loading = ref(false)
const error = ref('')

const handleLogin = async () => {
  loading.value = true
  error.value = ''
  
  try {
    if (!form.value.email || !form.value.password) {
      error.value = 'Please enter both email and password'
      return
    }
    
    const config = useRuntimeConfig()
    try {
      const response = await $fetch(`${config.public.apiBase}/admin/login`, {
        method: 'POST',
        body: form.value
      })
      
      if (response.success) {
        // Store authentication state
        authStore.setAuth(response.user)
        
        // Show success message
        await Swal.fire({
          icon: 'success',
          title: 'Login Successful',
          text: 'Welcome to the admin dashboard!',
          timer: 2000,
          showConfirmButton: false
        })
        
        // Redirect to dashboard
        navigateTo('/admin/dashboard')
        return
      } else {
        error.value = response.message || 'Invalid email or password'
      }
    } catch (apiError) {
      console.error('API login error:', apiError)
      
      // Check if it's an authentication error (401) or server error
      if (apiError.response && apiError.response.status === 401) {
        error.value = 'Invalid email or password'
      } else if (apiError.response && apiError.response.status === 400) {
        error.value = apiError.response.data?.message || 'Invalid email or password'
      } else {
        error.value = 'Login server is not available. Please contact administrator.'
      }
    }
  } catch (err) {
    console.error('Login error:', err)
    error.value = 'Login failed. Please try again.'
  } finally {
    loading.value = false
  }
}

// Check if already logged in and redirect to login if needed
onMounted(() => {
  // Clear any existing auth state to force login
  authStore.clearAuth()
})
</script>

<style scoped>
/* Custom animations */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

[data-aos="fade-up"] {
  animation: fadeIn 0.6s ease-out;
}

/* Gradient background animation */
.bg-gradient-to-br {
  background-size: 400% 400%;
  animation: gradientShift 15s ease infinite;
}

@keyframes gradientShift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}
</style>
