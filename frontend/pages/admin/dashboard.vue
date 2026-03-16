<template>
  <AdminLayout>
    <!-- Page Header -->
    <div class="bg-white border-b border-gray-200">
      <div class="px-6 py-4">
        <div class="flex justify-between items-center">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600">Welcome back, {{ authStore.currentUser?.username || 'Admin' }}!</p>
          </div>
          <div class="flex items-center space-x-4">
            <div class="text-right hidden sm:block">
              <p class="text-sm text-gray-500">Current Time</p>
              <p class="text-lg font-semibold text-gray-900">{{ currentTime }}</p>
            </div>
            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-semibold">
              {{ authStore.currentUser?.username?.charAt(0).toUpperCase() || 'A' }}
            </div>
          </div>
        </div>
      </div>
    </div>

      <!-- Content -->
      <div class="p-6">
        <!-- Loading State -->
        <div v-if="loading" class="flex flex-col items-center justify-center h-96">
          <div class="w-12 h-12 border-4 border-gray-200 border-t-indigo-600 rounded-full animate-spin"></div>
          <p class="mt-4 text-gray-600 font-medium">Loading dashboard...</p>
        </div>

        <!-- Dashboard Content -->
        <div v-else-if="dashboardData" class="space-y-6">
          <!-- Statistics Cards -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Projects -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Total Projects</p>
                  <p class="text-3xl font-bold text-gray-900 mt-2">{{ totalProjects }}</p>
                  <div class="flex items-center mt-2">
                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="text-sm text-green-600 font-medium">+{{ getProjectGrowth() }}%</span>
                    <span class="text-xs text-gray-500 ml-1">this month</span>
                  </div>
                </div>
                <div class="bg-indigo-100 rounded-lg p-3">
                  <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Beneficiaries -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Beneficiaries</p>
                  <p class="text-3xl font-bold text-gray-900 mt-2">{{ dashboardData.totalBeneficiaries }}</p>
                  <div class="flex items-center mt-2">
                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="text-sm text-green-600 font-medium">+{{ getBeneficiaryGrowth() }}%</span>
                    <span class="text-xs text-gray-500 ml-1">this month</span>
                  </div>
                </div>
                <div class="bg-green-100 rounded-lg p-3">
                  <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Partners -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Partners</p>
                  <p class="text-3xl font-bold text-gray-900 mt-2">{{ dashboardData.totalPartners }}</p>
                  <div class="flex items-center mt-2">
                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="text-sm text-green-600 font-medium">+{{ getPartnerGrowth() }}%</span>
                    <span class="text-xs text-gray-500 ml-1">this month</span>
                  </div>
                </div>
                <div class="bg-blue-100 rounded-lg p-3">
                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A6.5 6.5 0 0112 18.255 6.5 6.5 0 013 13.255V12a6.5 6.5 0 0112 0v1.255zM12 15.255A4.5 4.5 0 017.5 12V8a4.5 4.5 0 119 0v4a4.5 4.5 0 01-4.5 3.255z"></path>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Donations -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Donations</p>
                  <p class="text-3xl font-bold text-gray-900 mt-2">{{ dashboardData.totalDonations }}</p>
                  <div class="flex items-center mt-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-sm font-medium text-green-600">${{ formatCurrency(dashboardData.totalDonationAmount) }}</span>
                    <span class="text-xs text-gray-500 ml-1">total</span>
                  </div>
                </div>
                <div class="bg-yellow-100 rounded-lg p-3">
                  <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h5 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h5>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
              <NuxtLink
                to="/admin/projects"
                class="bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center font-medium"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Project
              </NuxtLink>
              <NuxtLink
                to="/admin/beneficiaries"
                class="bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center font-medium"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Add Beneficiary
              </NuxtLink>
              <NuxtLink
                to="/admin/partners"
                class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center font-medium"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Add Partner
              </NuxtLink>
              <NuxtLink
                to="/admin/publications"
                class="bg-yellow-600 hover:bg-yellow-700 text-white py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center font-medium"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Add Publication
              </NuxtLink>
            </div>
          </div>

          <!-- Recent Activity -->
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Projects -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
              <h5 class="text-lg font-semibold text-gray-900 mb-4">Recent Projects</h5>
              <div class="space-y-3">
                <div v-for="project in dashboardData.recentProjects?.slice(0, 3)" :key="project.id" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                  <div class="flex-1">
                    <h6 class="font-medium text-gray-900">{{ project.project_name }}</h6>
                    <p class="text-sm text-gray-500">{{ formatDate(project.created_at) }}</p>
                  </div>
                  <div class="flex items-center space-x-2">
                    <span :class="getStatusBadgeClass(project.status)">
                      {{ project.status }}
                    </span>
                    <span class="text-sm font-semibold text-gray-600">${{ formatCurrency(project.budget) }}</span>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <NuxtLink to="/admin/projects" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm flex items-center">
                  View all projects
                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </NuxtLink>
              </div>
            </div>

            <!-- Recent Beneficiaries -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
              <h5 class="text-lg font-semibold text-gray-900 mb-4">Recent Beneficiaries</h5>
              <div class="space-y-3">
                <div v-for="beneficiary in dashboardData.recentBeneficiaries?.slice(0, 3)" :key="beneficiary.id" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                  <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-semibold mr-3">
                      {{ beneficiary.name.charAt(0).toUpperCase() }}
                    </div>
                    <div>
                      <h6 class="font-medium text-gray-900">{{ beneficiary.name }}</h6>
                      <p class="text-sm text-gray-500">{{ formatDate(beneficiary.created_at) }}</p>
                    </div>
                  </div>
                  <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                </div>
              </div>
              <div class="mt-4">
                <NuxtLink to="/admin/beneficiaries" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm flex items-center">
                  View all beneficiaries
                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </NuxtLink>
              </div>
            </div>
          </div>

          <!-- Budget Summary -->
          <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h5 class="text-lg font-semibold text-gray-900 mb-4">Budget Summary</h5>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
              <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600 mb-1">Total Budget</p>
                <p class="text-2xl font-bold text-gray-900">${{ formatCurrency(dashboardData.budgetSummary?.total_budget) }}</p>
              </div>
              <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600 mb-1">Average Budget</p>
                <p class="text-2xl font-bold text-gray-900">${{ formatCurrency(dashboardData.budgetSummary?.avg_budget) }}</p>
              </div>
              <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600 mb-1">Min Budget</p>
                <p class="text-2xl font-bold text-gray-900">${{ formatCurrency(dashboardData.budgetSummary?.min_budget) }}</p>
              </div>
              <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600 mb-1">Max Budget</p>
                <p class="text-2xl font-bold text-gray-900">${{ formatCurrency(dashboardData.budgetSummary?.max_budget) }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Error State -->
        <div v-else-if="error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
          <div class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4l-4-4m4 4l-4-4m-5-4h8m-4-4v8"></path>
            </svg>
            <span>{{ error }}</span>
          </div>
        </div>
      </div>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useAuthStore } from '~/stores/auth'
import Swal from 'sweetalert2'

definePageMeta({
  middleware: 'auth'
})

const authStore = useAuthStore()
const loading = ref(true)
const error = ref('')
const dashboardData = ref(null)
const currentTime = ref(new Date().toLocaleTimeString())

// Computed properties
const totalProjects = computed(() => {
  return dashboardData.value?.projectStats?.reduce((total, stat) => total + stat.count, 0) || 0
})

// Methods

const fetchDashboardData = async () => {
  try {
    loading.value = true
    error.value = ''
    
    // Try to get real data from backend
    const { apiCall } = useApi()
    const response = await apiCall('/admin/dashboard-stats')
    
    if (response && response.success) {
      dashboardData.value = response.data
      console.log('Dashboard data loaded successfully:', response.data)
    } else {
      console.warn('API response unsuccessful, using demo data')
      setDemoData()
    }
  } catch (err) {
    console.error('Dashboard data error:', err)
    error.value = 'Failed to load dashboard data. Please try again.'
    // Provide demo data for development when backend is not available
    setDemoData()
  } finally {
    loading.value = false
  }
}

const setDemoData = () => {
  console.log('Using demo data for dashboard')
  dashboardData.value = {
    projectStats: [
      { status: 'ongoing', count: 5 },
      { status: 'completed', count: 3 },
      { status: 'pending', count: 2 }
    ],
    totalBeneficiaries: 150,
    totalMembers: 25,
    totalPartners: 12,
    totalDonations: 89,
    totalDonationAmount: 15000,
    recentProjects: [
      { 
        id: 1, 
        project_name: 'Education Support Program', 
        status: 'ongoing', 
        created_at: new Date().toISOString(), 
        budget: 50000 
      },
      { 
        id: 2, 
        project_name: 'Healthcare Initiative', 
        status: 'completed', 
        created_at: new Date(Date.now() - 86400000).toISOString(), 
        budget: 30000 
      },
      { 
        id: 3, 
        project_name: 'Community Outreach', 
        status: 'pending', 
        created_at: new Date(Date.now() - 172800000).toISOString(), 
        budget: 25000 
      }
    ],
    recentBeneficiaries: [
      { 
        id: 1, 
        name: 'John Doe', 
        created_at: new Date().toISOString() 
      },
      { 
        id: 2, 
        name: 'Jane Smith', 
        created_at: new Date(Date.now() - 86400000).toISOString() 
      },
      { 
        id: 3, 
        name: 'Robert Johnson', 
        created_at: new Date(Date.now() - 172800000).toISOString() 
      }
    ],
    partnerTypes: [
      { partnership_type: 'funding', count: 5 },
      { partnership_type: 'implementation', count: 4 },
      { partnership_type: 'technical', count: 3 }
    ],
    donationTrends: [
      { month: '2024-08', count: 15, total_amount: 2500 },
      { month: '2024-09', count: 20, total_amount: 3200 },
      { month: '2024-10', count: 18, total_amount: 2800 }
    ],
    budgetSummary: {
      total_budget: 150000,
      avg_budget: 30000,
      min_budget: 10000,
      max_budget: 80000
    },
    totalPublications: 8
  }
}

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString(undefined, options)
}

const formatCurrency = (amount) => {
  if (!amount) return '0'
  return Number(amount).toLocaleString()
}

const getStatusBadgeClass = (status) => {
  const baseClass = 'px-2 py-1 rounded-full text-xs font-semibold '
  switch (status?.toLowerCase()) {
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

// Mock growth calculations (in real app, these would come from API)
const getProjectGrowth = () => Math.floor(Math.random() * 20) + 5
const getBeneficiaryGrowth = () => Math.floor(Math.random() * 15) + 8
const getPartnerGrowth = () => Math.floor(Math.random() * 10) + 3

// Update current time every second
const updateCurrentTime = () => {
  currentTime.value = new Date().toLocaleTimeString()
}

// Initialize
onMounted(() => {
  fetchDashboardData()
  setInterval(updateCurrentTime, 1000)
})
</script>

<style scoped>
/* Simple and clean animations */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.fade-in {
  animation: fadeIn 0.3s ease-out;
}

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
