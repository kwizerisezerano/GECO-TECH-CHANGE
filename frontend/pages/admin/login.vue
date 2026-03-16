<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden max-w-md w-full" data-aos="fade-up">
      <!-- Header -->
      <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-8 text-center">
        <img src="/img/logo.png" alt="GECO RWANDA Logo" class="w-16 h-16 mx-auto mb-4 rounded-full bg-white p-2">
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
            <label for="username" class="block text-gray-700 text-sm font-semibold mb-2">
              Username
            </label>
            <input
              v-model="form.username"
              type="text"
              id="username"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200"
              placeholder="Enter username"
              required
            />
          </div>
          
          <div class="mb-6">
            <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">
              Password
            </label>
            <input
              v-model="form.password"
              type="password"
              id="password"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200"
              placeholder="Enter password"
              required
            />
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
  username: '',
  password: ''
})

const loading = ref(false)
const error = ref('')

const handleLogin = async () => {
  loading.value = true
  error.value = ''
  
  try {
    const response = await $fetch('/api/admin/login', {
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
      router.push('/admin/dashboard')
    } else {
      error.value = response.message || 'Login failed'
    }
  } catch (err) {
    console.error('Login error:', err)
    error.value = 'Server error. Please try again.'
  } finally {
    loading.value = false
  }
}

// Check if already logged in
onMounted(() => {
  if (authStore.isAuthenticated) {
    router.push('/admin/dashboard')
  }
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
