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
          <img src="/assets/img/logo.png" alt="GECO RWANDA Logo" class="w-16 h-16 mx-auto mb-3 rounded-full bg-white p-2">
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
              class="flex items-center px-4 py-3 rounded-lg hover:bg-purple-700 transition duration-200"
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
              class="flex items-center px-4 py-3 rounded-lg hover:bg-purple-700 transition duration-200 bg-purple-700"
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
              to="/admin/publications"
              class="flex items-center px-4 py-3 rounded-lg hover:bg-purple-700 transition duration-200"
            >
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              Publications
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
              <h1 class="text-2xl font-bold text-gray-800">Beneficiaries Management</h1>
              <p class="text-gray-600">Manage all beneficiaries from here</p>
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

        <!-- Beneficiaries List -->
        <div v-else-if="beneficiaries && beneficiaries.length > 0" class="space-y-4">
          <!-- Add Beneficiary Button -->
          <div class="flex justify-end mb-4">
            <button
              @click="openAddModal"
              class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center"
            >
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              Add Beneficiary
            </button>
          </div>
          
          <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Phone Number
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      ID Type
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      ID Number
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Registered
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="beneficiary in beneficiaries" :key="beneficiary.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ beneficiary.id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ beneficiary.name || 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ beneficiary.phone_number || 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                        {{ beneficiary.idno_type || 'N/A' }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ beneficiary.idno || 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ formatDate(beneficiary.created_at) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <button @click="openEditModal(beneficiary)" class="text-green-600 hover:text-green-900 mr-3">Edit</button>
                      <button @click="deleteBeneficiary(beneficiary)" class="text-red-600 hover:text-red-900">Delete</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-else class="bg-white rounded-xl shadow-md p-12 text-center">
          <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg>
          <h5 class="text-lg font-medium text-gray-900 mb-2">No beneficiaries found</h5>
          <p class="text-gray-600 mb-4">Get started by adding your first beneficiary.</p>
          <button
            @click="openAddModal"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center mx-auto"
          >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Beneficiary
          </button>
        </div>
      </div>
    </div>
    
    <!-- Add Beneficiary Modal -->
    <div v-if="showAddModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Add New Beneficiary</h3>
        <form @submit.prevent="addBeneficiary">
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Full Name</label>
              <input v-model="formData.name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Phone Number</label>
              <input v-model="formData.phone_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">ID Type</label>
              <select v-model="formData.idno_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
                <option value="">Select ID Type</option>
                <option value="national_id">National ID</option>
                <option value="passport">Passport</option>
                <option value="driver_license">Driver License</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">ID Number</label>
              <input v-model="formData.idno" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
            </div>
          </div>
          <div class="mt-6 flex justify-end space-x-3">
            <button type="button" @click="closeModal" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
              Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
              Add Beneficiary
            </button>
          </div>
        </form>
      </div>
    </div>
    
    <!-- Edit Beneficiary Modal -->
    <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Edit Beneficiary</h3>
        <form @submit.prevent="updateBeneficiary">
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Full Name</label>
              <input v-model="formData.name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Phone Number</label>
              <input v-model="formData.phone_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">ID Type</label>
              <select v-model="formData.idno_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
                <option value="">Select ID Type</option>
                <option value="national_id">National ID</option>
                <option value="passport">Passport</option>
                <option value="driver_license">Driver License</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">ID Number</label>
              <input v-model="formData.idno" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
            </div>
          </div>
          <div class="mt-6 flex justify-end space-x-3">
            <button type="button" @click="closeModal" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
              Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
              Update Beneficiary
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '~/stores/auth'
import Swal from 'sweetalert2'

definePageMeta({
  middleware: 'auth'
})

const router = useRouter()
const authStore = useAuthStore()

const loading = ref(true)
const beneficiaries = ref([])
const sidebarOpen = ref(false)
const showAddModal = ref(false)
const showEditModal = ref(false)
const editingBeneficiary = ref(null)
const formData = ref({
  name: '',
  phone_number: '',
  idno_type: '',
  idno: ''
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

const fetchBeneficiaries = async () => {
  try {
    const response = await $fetch('/api/admin/beneficiaries')
    if (response.success) {
      beneficiaries.value = response.data
    }
  } catch (err) {
    console.error('Beneficiaries fetch error:', err)
  } finally {
    loading.value = false
  }
}

const formatDate = (dateString) => {
  if (!dateString) return 'N/A'
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString(undefined, options)
}

const resetForm = () => {
  formData.value = {
    name: '',
    phone_number: '',
    idno_type: '',
    idno: ''
  }
}

const openAddModal = () => {
  resetForm()
  showAddModal.value = true
}

const openEditModal = (beneficiary) => {
  editingBeneficiary.value = beneficiary
  formData.value = {
    name: beneficiary.name,
    phone_number: beneficiary.phone_number,
    idno_type: beneficiary.idno_type,
    idno: beneficiary.idno
  }
  showEditModal.value = true
}

const closeModal = () => {
  showAddModal.value = false
  showEditModal.value = false
  editingBeneficiary.value = null
  resetForm()
}

const addBeneficiary = async () => {
  try {
    const response = await $fetch('/api/admin/beneficiaries', {
      method: 'POST',
      body: formData.value
    })
    
    if (response.success) {
      await Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Beneficiary added successfully'
      })
      closeModal()
      fetchBeneficiaries()
    }
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Failed to add beneficiary'
    })
  }
}

const updateBeneficiary = async () => {
  try {
    const response = await $fetch(`/api/admin/beneficiaries/${editingBeneficiary.value.id}`, {
      method: 'PUT',
      body: formData.value
    })
    
    if (response.success) {
      await Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Beneficiary updated successfully'
      })
      closeModal()
      fetchBeneficiaries()
    }
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Failed to update beneficiary'
    })
  }
}

const deleteBeneficiary = async (beneficiary) => {
  const result = await Swal.fire({
    title: 'Are you sure?',
    text: `You are about to delete ${beneficiary.name}`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes, delete it!'
  })
  
  if (result.isConfirmed) {
    try {
      const response = await $fetch(`/api/admin/beneficiaries/${beneficiary.id}`, {
        method: 'DELETE'
      })
      
      if (response.success) {
        await Swal.fire({
          icon: 'success',
          title: 'Deleted',
          text: 'Beneficiary has been deleted'
        })
        fetchBeneficiaries()
      }
    } catch (error) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Failed to delete beneficiary'
      })
    }
  }
}

// Initialize
onMounted(() => {
  fetchBeneficiaries()
})
</script>
