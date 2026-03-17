<template>
  <AdminLayout>
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
      <div class="px-6 py-4">
        <div class="flex justify-between items-center">
          <div>
            <h1 class="text-2xl font-bold text-gray-800">Beneficiaries Management</h1>
            <p class="text-gray-600">Manage all beneficiaries from here</p>
          </div>
          <div class="flex items-center space-x-4">
            <Notifications />
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
            <button type="button" @click="closeAddModal" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Add Beneficiary</button>
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
              <input v-model="editFormData.name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Phone Number</label>
              <input v-model="editFormData.phone_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">ID Type</label>
              <select v-model="editFormData.idno_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
                <option value="">Select ID Type</option>
                <option value="national_id">National ID</option>
                <option value="passport">Passport</option>
                <option value="driver_license">Driver License</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">ID Number</label>
              <input v-model="editFormData.idno" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
            </div>
          </div>
          <div class="mt-6 flex justify-end space-x-3">
            <button type="button" @click="closeEditModal" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Update Beneficiary</button>
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
import Notifications from '~/components/Notifications.vue'

definePageMeta({
  middleware: 'auth'
})

const router = useRouter()
const authStore = useAuthStore()

const loading = ref(true)
const beneficiaries = ref([])
const showAddModal = ref(false)
const showEditModal = ref(false)
const editingBeneficiary = ref(null)

const formData = ref({
  name: '',
  phone_number: '',
  idno_type: '',
  idno: ''
})

const editFormData = ref({
  name: '',
  phone_number: '',
  idno_type: '',
  idno: ''
})

const fetchBeneficiaries = async () => {
  try {
    const response = await $fetch('http://localhost:3001/api/admin/beneficiaries')
    if (response.success) {
      beneficiaries.value = response.data
    }
  } catch (error) {
    console.error('Error fetching beneficiaries:', error)
  } finally {
    loading.value = false
  }
}

const openAddModal = () => {
  showAddModal.value = true
  formData.value = {
    name: '',
    phone_number: '',
    idno_type: '',
    idno: ''
  }
}

const closeAddModal = () => {
  showAddModal.value = false
}

const openEditModal = (beneficiary) => {
  editingBeneficiary.value = beneficiary
  editFormData.value = {
    name: beneficiary.name,
    phone_number: beneficiary.phone_number,
    idno_type: beneficiary.idno_type,
    idno: beneficiary.idno
  }
  showEditModal.value = true
}

const closeEditModal = () => {
  showEditModal.value = false
  editingBeneficiary.value = null
}

const addBeneficiary = async () => {
  try {
    const response = await $fetch('http://localhost:3001/api/admin/beneficiaries', {
      method: 'POST',
      body: formData.value
    })
    
    if (response.success) {
      await Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Beneficiary added successfully',
        timer: 2000,
        showConfirmButton: false
      })
      closeAddModal()
      await fetchBeneficiaries()
    }
  } catch (error) {
    console.error('Error adding beneficiary:', error)
    await Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Failed to add beneficiary'
    })
  }
}

const updateBeneficiary = async () => {
  try {
    const response = await $fetch(`http://localhost:3001/api/admin/beneficiaries/${editingBeneficiary.value.id}`, {
      method: 'PUT',
      body: editFormData.value
    })
    
    if (response.success) {
      await Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Beneficiary updated successfully',
        timer: 2000,
        showConfirmButton: false
      })
      closeEditModal()
      await fetchBeneficiaries()
    }
  } catch (error) {
    console.error('Error updating beneficiary:', error)
    await Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Failed to update beneficiary'
    })
  }
}

const deleteBeneficiary = async (beneficiary) => {
  const result = await Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes, delete it!'
  })

  if (result.isConfirmed) {
    try {
      const response = await $fetch(`http://localhost:3001/api/admin/beneficiaries/${beneficiary.id}`, {
        method: 'DELETE'
      })
      
      if (response.success) {
        await Swal.fire({
          icon: 'success',
          title: 'Deleted!',
          text: 'Beneficiary deleted successfully',
          timer: 2000,
          showConfirmButton: false
        })
        await fetchBeneficiaries()
      }
    } catch (error) {
      console.error('Error deleting beneficiary:', error)
      await Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Failed to delete beneficiary'
      })
    }
  }
}

const formatDate = (dateString) => {
  if (!dateString) return 'N/A'
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString(undefined, options)
}

onMounted(() => {
  fetchBeneficiaries()
})
</script>
