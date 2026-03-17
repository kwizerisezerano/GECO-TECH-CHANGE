<template>
  <AdminLayout>
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
      <div class="px-6 py-4">
        <div class="flex justify-between items-center">
          <div>
            <h1 class="text-2xl font-bold text-gray-800">Partners Management</h1>
            <p class="text-gray-600">Manage all partner organizations from here</p>
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

        <!-- Partners List -->
        <div v-else-if="partners && partners.length > 0" class="space-y-4">
          <!-- Add Partner Button -->
          <div class="flex justify-end mb-4">
            <button
              @click="openAddModal"
              class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center"
            >
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              Add Partner
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
                      Organization Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Contact Person
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Phone
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Partnership Type
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Joined
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="partner in partners" :key="partner.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ partner.id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ partner.partner_name || 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ partner.contact_person || 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ partner.email || 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ partner.phone || 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                        {{ partner.partnership_type || 'General' }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ formatDate(partner.created_at) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <button @click="openEditModal(partner)" class="text-purple-600 hover:text-purple-900 mr-3">Edit</button>
                      <button @click="deletePartner(partner)" class="text-red-600 hover:text-red-900">Delete</button>
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
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A6.5 6.5 0 0112 18.255 6.5 6.5 0 013 13.255V12a6.5 6.5 0 0112 0v1.255zM12 15.255A4.5 4.5 0 017.5 12V8a4.5 4.5 0 119 0v4a4.5 4.5 0 01-4.5 3.255z"></path>
          </svg>
          <h5 class="text-lg font-medium text-gray-900 mb-2">No partners found</h5>
          <p class="text-gray-600 mb-4">Get started by adding your first partner organization.</p>
          <button
            @click="openAddModal"
            class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center mx-auto"
          >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Partner
          </button>
        </div>
      </div>
    
    <!-- Add Partner Modal -->
    <div v-if="showAddModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Add New Partner</h3>
        <form @submit.prevent="addPartner">
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Organization Name</label>
              <input v-model="formData.partner_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Contact Person</label>
              <input v-model="formData.contact_person" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Email</label>
              <input v-model="formData.email" type="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Phone</label>
              <input v-model="formData.phone" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Partnership Type</label>
              <select v-model="formData.partnership_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border">
                <option value="">Select Type</option>
                <option value="funding">Funding Partner</option>
                <option value="implementation">Implementation Partner</option>
                <option value="technical">Technical Partner</option>
                <option value="general">General Partner</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Description</label>
              <textarea v-model="formData.description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border"></textarea>
            </div>
          </div>
          <div class="mt-6 flex justify-end space-x-3">
            <button type="button" @click="closeModal" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
              Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
              Add Partner
            </button>
          </div>
        </form>
      </div>
    </div>
    
    <!-- Edit Partner Modal -->
    <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Edit Partner</h3>
        <form @submit.prevent="updatePartner">
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Organization Name</label>
              <input v-model="formData.partner_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Contact Person</label>
              <input v-model="formData.contact_person" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Email</label>
              <input v-model="formData.email" type="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Phone</label>
              <input v-model="formData.phone" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Partnership Type</label>
              <select v-model="formData.partnership_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border">
                <option value="">Select Type</option>
                <option value="funding">Funding Partner</option>
                <option value="implementation">Implementation Partner</option>
                <option value="technical">Technical Partner</option>
                <option value="general">General Partner</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Description</label>
              <textarea v-model="formData.description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-2 border"></textarea>
            </div>
          </div>
          <div class="mt-6 flex justify-end space-x-3">
            <button type="button" @click="closeModal" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
              Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
              Update Partner
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
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
const partners = ref([])
const sidebarOpen = ref(false)
const showAddModal = ref(false)
const showEditModal = ref(false)
const editingPartner = ref(null)
const formData = ref({
  partner_name: '',
  contact_person: '',
  email: '',
  phone: '',
  description: '',
  partnership_type: ''
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

const fetchPartners = async () => {
  try {
    const response = await $fetch('http://localhost:3001/api/admin/partners')
    if (response.success) {
      partners.value = response.data
    }
  } catch (error) {
    console.error('Error fetching partners:', error)
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
    partner_name: '',
    contact_person: '',
    email: '',
    phone: '',
    description: '',
    partnership_type: ''
  }
}

const openAddModal = () => {
  resetForm()
  showAddModal.value = true
}

const openEditModal = (partner) => {
  editingPartner.value = partner
  formData.value = {
    partner_name: partner.partner_name,
    contact_person: partner.contact_person,
    email: partner.email,
    phone: partner.phone,
    description: partner.description,
    partnership_type: partner.partnership_type
  }
  showEditModal.value = true
}

const closeModal = () => {
  showAddModal.value = false
  showEditModal.value = false
  editingPartner.value = null
  resetForm()
}

const addPartner = async () => {
  try {
    const response = await $fetch('http://localhost:3001/api/admin/partners', {
      method: 'POST',
      body: formData.value
    })
    
    if (response.success) {
      await Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Partner added successfully'
      })
      closeModal()
      fetchPartners()
    }
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Failed to add partner'
    })
  }
}

const updatePartner = async () => {
  try {
    const response = await $fetch(`http://localhost:3001/api/admin/partners/${editingPartner.value.id}`, {
      method: 'PUT',
      body: formData.value
    })
    
    if (response.success) {
      await Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Partner updated successfully'
      })
      closeModal()
      fetchPartners()
    }
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Failed to update partner'
    })
  }
}

const deletePartner = async (partner) => {
  const result = await Swal.fire({
    title: 'Are you sure?',
    text: `You are about to delete ${partner.partner_name}`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes, delete it!'
  })
  
  if (result.isConfirmed) {
    try {
      const response = await $fetch(`http://localhost:3001/api/admin/partners/${partner.id}`, {
        method: 'DELETE'
      })
      
      if (response.success) {
        await Swal.fire({
          icon: 'success',
          title: 'Deleted',
          text: 'Partner has been deleted'
        })
        fetchPartners()
      }
    } catch (error) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Failed to delete partner'
      })
    }
  }
}

// Initialize
onMounted(() => {
  fetchPartners()
})
</script>
