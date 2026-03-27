<template>
  <AdminLayout>
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
      <div class="px-4 sm:px-6 py-4">
        <div class="flex flex-wrap gap-3 items-center justify-between">
          <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Donations Management</h1>
            <p class="text-gray-600 text-sm">Manage all donations from here</p>
          </div>
          <div class="flex items-center gap-2">
            <Notifications />
          </div>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="p-4 sm:p-6">
        <!-- Loading State -->
        <div v-if="loading" class="flex justify-center items-center h-64">
          <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600"></div>
        </div>

        <!-- Donations List -->
        <div v-else-if="donations && donations.length > 0" class="bg-white rounded-xl shadow-md overflow-hidden">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ID
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Donor Name
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Amount
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Date
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="donation in donations" :key="donation.id" class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ donation.id }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ donation.donor_name || 'Anonymous' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ donation.email || 'N/A' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    RWF {{ Number(donation.amount || 0).toLocaleString() }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span :class="getPaymentStatusClass(donation.payment_status)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                      {{ donation.payment_status || 'Pending' }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ formatDate(donation.created_at) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button class="text-purple-600 hover:text-purple-900 mr-3">View</button>
                    <button class="text-red-600 hover:text-red-900">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Empty State -->
        <div v-else class="bg-white rounded-xl shadow-md p-12 text-center">
          <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
          </svg>
          <h5 class="text-lg font-medium text-gray-900 mb-2">No donations found</h5>
          <p class="text-gray-600">Donations will appear here when supporters contribute to your cause.</p>
        </div>
      </div>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '~/stores/auth'
import AdminLayout from '~/components/AdminLayout.vue'
import Notifications from '~/components/Notifications.vue'

definePageMeta({
  middleware: 'auth'
})

const router = useRouter()
const authStore = useAuthStore()

const loading = ref(true)
const donations = ref([])
const sidebarOpen = ref(false)

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

const fetchDonations = async () => {
  try {
    const response = await $fetch(`${useRuntimeConfig().public.apiBase}/admin/donations`)
    if (response.success) {
      donations.value = response.data
    }
  } catch (err) {
    console.error('Donations fetch error:', err)
  } finally {
    loading.value = false
  }
}

const formatDate = (dateString) => {
  if (!dateString) return 'N/A'
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString(undefined, options)
}

const getPaymentStatusClass = (status) => {
  switch (status?.toLowerCase()) {
    case 'success':
      return 'bg-green-100 text-green-800'
    case 'pending':
      return 'bg-yellow-100 text-yellow-800'
    case 'failed':
      return 'bg-red-100 text-red-800'
    default:
      return 'bg-gray-100 text-gray-800'
  }
}

// Initialize
onMounted(() => {
  fetchDonations()
})
</script>
