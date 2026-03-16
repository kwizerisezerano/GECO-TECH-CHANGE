<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Mobile Menu Toggle -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
      <button
        @click="toggleSidebar"
        class="bg-purple-600 text-white p-3 rounded-lg shadow-lg hover:bg-purple-700 transition duration-200"
      >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>

    <!-- Sidebar -->
    <div
      :class="[
        'fixed lg:static inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-purple-600 to-purple-800 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0',
        sidebarOpen ? 'translate-x-0' : '-translate-x-full'
      ]"
    >
      <!-- Logo -->
      <div class="p-6 border-b border-purple-700">
        <div class="text-center">
          <img src="/img/logo.png" alt="GECO RWANDA Logo" class="w-16 h-16 mx-auto mb-3 rounded-full bg-white p-2">
          <h3 class="text-xl font-bold">GECO RWANDA</h3>
          <p class="text-purple-200 text-sm">Admin Panel</p>
        </div>
      </div>
      
      <!-- Navigation -->
      <nav class="p-4">
        <ul class="space-y-2">
          <li>
            <NuxtLink
              to="/admin/dashboard"
              class="flex items-center px-4 py-3 rounded-lg hover:bg-purple-700 transition duration-200 bg-purple-700"
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
              class="flex items-center px-4 py-3 rounded-lg hover:bg-purple-700 transition duration-200"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
              </svg>
              Projects Management
            </NuxtLink>
          </li>
          <li>
            <NuxtLink
              to="/admin/beneficiaries"
              class="flex items-center px-4 py-3 rounded-lg hover:bg-purple-700 transition duration-200"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
              </svg>
              Beneficiaries
            </NuxtLink>
          </li>
          <li>
            <NuxtLink
              to="/admin/donations"
              class="flex items-center px-4 py-3 rounded-lg hover:bg-purple-700 transition duration-200"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
              </svg>
              Donations
            </NuxtLink>
          </li>
          <li>
            <NuxtLink
              to="/admin/members"
              class="flex items-center px-4 py-3 rounded-lg hover:bg-purple-700 transition duration-200"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
              Members
            </NuxtLink>
          </li>
          <li>
            <NuxtLink
              to="/admin/partners"
              class="flex items-center px-4 py-3 rounded-lg hover:bg-purple-700 transition duration-200"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A6.5 6.5 0 0112 18.255 6.5 6.5 0 013 13.255V12a6.5 6.5 0 0112 0v1.255zM12 15.255A4.5 4.5 0 017.5 12V8a4.5 4.5 0 119 0v4a4.5 4.5 0 01-4.5 3.255z"></path>
              </svg>
              Partners
            </NuxtLink>
          </li>
          <li>
            <NuxtLink
              to="/admin/documents"
              class="flex items-center px-4 py-3 rounded-lg hover:bg-purple-700 transition duration-200"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
              </svg>
              Upload Documents
            </NuxtLink>
          </li>
        </ul>
      </nav>
      
      <!-- Logout Button -->
      <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-purple-700">
        <button
          @click="handleLogout"
          class="w-full bg-purple-900 hover:bg-purple-950 text-white py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center"
        >
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
          </svg>
          Logout
        </button>
      </div>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
      <!-- Page Header -->
      <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="px-6 py-4">
          <div class="flex justify-between items-center">
            <div>
              <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
              <p class="text-gray-600">Welcome back, {{ authStore.currentUser?.username }}!</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Content -->
      <div class="p-6">
        <!-- Loading State -->
        <div v-if="loading" class="flex justify-center items-center h-64">
          <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600"></div>
        </div>

        <!-- Dashboard Content -->
        <div v-else-if="dashboardData" class="space-y-6">
          <!-- Statistics Cards -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Projects -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-600 hover:shadow-lg transition duration-300" data-aos="fade-up" data-aos-delay="100">
              <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-100 rounded-lg p-3">
                  <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <h3 class="text-2xl font-bold text-gray-800">{{ totalProjects }}</h3>
                  <p class="text-gray-600">Total Projects</p>
                </div>
              </div>
            </div>

            <!-- Beneficiaries -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-600 hover:shadow-lg transition duration-300" data-aos="fade-up" data-aos-delay="200">
              <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-lg p-3">
                  <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <h3 class="text-2xl font-bold text-gray-800">{{ dashboardData.totalBeneficiaries }}</h3>
                  <p class="text-gray-600">Beneficiaries</p>
                </div>
              </div>
            </div>

            <!-- Partners -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-600 hover:shadow-lg transition duration-300" data-aos="fade-up" data-aos-delay="300">
              <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-100 rounded-lg p-3">
                  <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A6.5 6.5 0 0112 18.255 6.5 6.5 0 013 13.255V12a6.5 6.5 0 0112 0v1.255zM12 15.255A4.5 4.5 0 017.5 12V8a4.5 4.5 0 119 0v4a4.5 4.5 0 01-4.5 3.255z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <h3 class="text-2xl font-bold text-gray-800">{{ dashboardData.totalPartners }}</h3>
                  <p class="text-gray-600">Partners</p>
                </div>
              </div>
            </div>

            <!-- Donations -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-600 hover:shadow-lg transition duration-300" data-aos="fade-up" data-aos-delay="400">
              <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-100 rounded-lg p-3">
                  <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <h3 class="text-2xl font-bold text-gray-800">{{ dashboardData.totalDonations }}</h3>
                  <p class="text-gray-600">Donations</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Project Status Overview & Recent Projects -->
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Project Status Overview -->
            <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-up" data-aos-delay="500">
              <h5 class="text-lg font-semibold text-gray-800 mb-4">Project Status Overview</h5>
              <div v-if="dashboardData.projectStats && dashboardData.projectStats.length > 0" class="space-y-3">
                <div v-for="stat in dashboardData.projectStats" :key="stat.status" class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                  <span class="font-medium text-gray-700 capitalize">{{ stat.status }}</span>
                  <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ stat.count }}
                  </span>
                </div>
              </div>
              <div v-else class="text-gray-500 text-center py-4">
                No project data available
              </div>
            </div>

            <!-- Recent Projects -->
            <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-up" data-aos-delay="600">
              <h5 class="text-lg font-semibold text-gray-800 mb-4">Recent Projects</h5>
              <div v-if="dashboardData.recentProjects && dashboardData.recentProjects.length > 0" class="space-y-3">
                <div v-for="project in dashboardData.recentProjects" :key="project.id" class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                  <div class="flex justify-between items-start">
                    <div>
                      <h6 class="font-medium text-gray-800">{{ project.project_name }}</h6>
                      <p class="text-sm text-gray-600">{{ formatDate(project.created_at) }}</p>
                    </div>
                    <span :class="getStatusBadgeClass(project.status)" class="px-2 py-1 rounded-full text-xs font-semibold">
                      {{ project.status }}
                    </span>
                  </div>
                </div>
              </div>
              <div v-else class="text-gray-500 text-center py-4">
                No recent projects
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-up" data-aos-delay="700">
            <h5 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h5>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
              <NuxtLink
                to="/admin/projects"
                class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Project
              </NuxtLink>
              <NuxtLink
                to="/admin/beneficiaries"
                class="bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Add Beneficiary
              </NuxtLink>
              <NuxtLink
                to="/admin/partners"
                class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Add Partner
              </NuxtLink>
              <NuxtLink
                to="/admin/documents"
                class="bg-yellow-600 hover:bg-yellow-700 text-white py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                Upload Document
              </NuxtLink>
            </div>
          </div>
        </div>

        <!-- Error State -->
        <div v-else-if="error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
          {{ error }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '~/stores/auth'

definePageMeta({
  middleware: 'auth'
})

const router = useRouter()
const authStore = useAuthStore()

const loading = ref(true)
const error = ref('')
const dashboardData = ref(null)
const sidebarOpen = ref(false)

// Computed properties
const totalProjects = computed(() => {
  if (!dashboardData.value?.projectStats) return 0
  return dashboardData.value.projectStats.reduce((total, stat) => total + stat.count, 0)
})

// Methods
const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value
}

const handleLogout = async () => {
  const result = await Swal.fire({
    title: 'Are you sure?',
    text: "You will be logged out of the admin panel",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, logout',
    cancelButtonText: 'Cancel'
  })

  if (result.isConfirmed) {
    authStore.clearAuth()
    await Swal.fire({
      icon: 'success',
      title: 'Logged Out',
      text: 'You have been successfully logged out',
      timer: 2000,
      showConfirmButton: false
    })
    router.push('/admin/login')
  }
}

const fetchDashboardData = async () => {
  try {
    const response = await $fetch('/api/admin/dashboard-stats')
    if (response.success) {
      dashboardData.value = response.data
    } else {
      error.value = 'Failed to load dashboard data'
    }
  } catch (err) {
    console.error('Dashboard data error:', err)
    error.value = 'Server error. Please try again.'
  } finally {
    loading.value = false
  }
}

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString(undefined, options)
}

const getStatusBadgeClass = (status) => {
  const baseClass = 'px-2 py-1 rounded-full text-xs font-semibold '
  switch (status.toLowerCase()) {
    case 'ongoing':
      return baseClass + 'bg-green-100 text-green-800'
    case 'pending':
      return baseClass + 'bg-yellow-100 text-yellow-800'
    case 'completed':
      return baseClass + 'bg-blue-100 text-blue-800'
    default:
      return baseClass + 'bg-gray-100 text-gray-800'
  }
}

// Initialize
onMounted(() => {
  fetchDashboardData()
})
</script>

<style scoped>
/* Custom animations for AOS */
[data-aos="fade-up"] {
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.6s ease-out;
}

[data-aos="fade-up"].aos-animate {
  opacity: 1;
  transform: translateY(0);
}
</style>
