<template>
  <div class="min-h-screen bg-gray-50 flex">
    <!-- Mobile Menu Toggle -->
    <div class="lg:hidden fixed top-3 left-3 z-50">
      <button
        @click="toggleSidebar"
        class="bg-indigo-600 text-white p-2.5 rounded-lg shadow-lg hover:bg-indigo-700 transition-colors duration-200"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>

    <!-- Sidebar -->
    <div
      :class="[
        'fixed lg:relative inset-y-0 left-0 z-40 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 ease-in-out flex-shrink-0',
        sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
      ]"
    >
      <!-- Logo -->
      <div class="p-6 border-b border-gray-200">
        <div class="flex items-center space-x-3">
          <img src="/assets/img/logo.png" alt="GECO RWANDA Logo" class="w-16 h-16 rounded-lg object-contain">
          <div>
            <h3 class="text-xl font-bold text-gray-900">GECO RWANDA</h3>
            <p class="text-sm text-gray-500">Admin Panel</p>
          </div>
        </div>
      </div>
      
      <!-- Navigation -->
      <nav class="p-4">
        <ul class="space-y-1">
          <li>
            <NuxtLink
              to="/admin/dashboard"
              class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
              :class="$route.path === '/admin/dashboard' 
                ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' 
                : 'text-gray-700 hover:bg-gray-100'"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
              Dashboard
            </NuxtLink>
          </li>
          <li>
            <NuxtLink
              to="/admin/projects"
              class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
              :class="$route.path.includes('/admin/projects') 
                ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' 
                : 'text-gray-700 hover:bg-gray-100'"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
              </svg>
              Projects
            </NuxtLink>
          </li>
          <li>
            <NuxtLink
              to="/admin/beneficiaries"
              class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
              :class="$route.path.includes('/admin/beneficiaries') 
                ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' 
                : 'text-gray-700 hover:bg-gray-100'"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
              </svg>
              Beneficiaries
            </NuxtLink>
          </li>
          <li>
            <NuxtLink
              to="/admin/partners"
              class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
              :class="$route.path.includes('/admin/partners') 
                ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' 
                : 'text-gray-700 hover:bg-gray-100'"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A6.5 6.5 0 0112 18.255 6.5 6.5 0 013 13.255V12a6.5 6.5 0 0112 0v1.255zM12 15.255A4.5 4.5 0 017.5 12V8a4.5 4.5 0 119 0v4a4.5 4.5 0 01-4.5 3.255z"></path>
              </svg>
              Partners
            </NuxtLink>
          </li>
          <li>
            <NuxtLink
              to="/admin/members"
              class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
              :class="$route.path.includes('/admin/members') 
                ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' 
                : 'text-gray-700 hover:bg-gray-100'"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
              </svg>
              Members
            </NuxtLink>
          </li>
          <li>
            <NuxtLink
              to="/admin/users"
              class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
              :class="$route.path.includes('/admin/users') 
                ? 'bg-indigo-50 text-indigo-700 border-l-4 border-indigo-600' 
                : 'text-gray-700 hover:bg-gray-100'"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
              </svg>
              Users
            </NuxtLink>
          </li>
        </ul>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 min-h-screen overflow-auto">
      <!-- Mobile overlay when sidebar is open -->
      <div 
        v-if="sidebarOpen" 
        class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-30"
        @click="toggleSidebar"
      ></div>
      
      <div class="lg:pl-0 pt-0">
        <!-- Spacer for mobile toggle button -->
        <div class="lg:hidden h-14"></div>
        <slot />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '~/stores/auth'

const router = useRouter()
const authStore = useAuthStore()
const sidebarOpen = ref(false)

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value
}

const handleLogout = async () => {
  try {
    authStore.clearAuth()
    await $fetch('http://localhost:3001/api/admin/logout', {
      method: 'POST'
    })
    
    // Show success message
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        icon: 'success',
        title: 'Logged Out',
        text: 'You have been successfully logged out',
        timer: 2000,
        showConfirmButton: false
      })
    }
    
    router.push('/admin/login')
  } catch (error) {
    console.error('Logout error:', error)
    router.push('/admin/login')
  }
}

// Close sidebar when route changes
watch(() => router.currentRoute.value, () => {
  if (window.innerWidth < 1024) {
    sidebarOpen.value = false
  }
})
</script>

<style scoped>
/* Custom scrollbar */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}
</style>
