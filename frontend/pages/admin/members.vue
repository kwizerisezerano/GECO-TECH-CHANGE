<template>
  <AdminLayout>
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
      <div class="px-4 sm:px-6 py-4">
        <div class="flex flex-wrap gap-3 items-center justify-between">
          <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Members Management</h1>
            <p class="text-gray-600 text-sm">Manage all team members from here</p>
          </div>
          <div class="flex items-center gap-2">
            <button
              @click="openAddMemberModal"
              class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg flex items-center text-sm font-medium"
            >
              <svg class="w-4 h-4 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              <span class="hidden sm:inline">Add Member</span>
            </button>
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

        <!-- Members List -->
        <div v-else-if="members && members.length > 0" class="bg-white rounded-xl shadow-md overflow-hidden">
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
                    Role
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
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
                <tr v-for="member in members" :key="member.id" class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ member.id }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ member.name || 'N/A' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ member.phone_number || 'N/A' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ member.role || 'Member' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                          :class="getStatusBadgeClass(member.status)">
                      {{ member.status || 'Active' }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ formatDate(member.created_at) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button 
                      @click="openEditMemberModal(member)"
                      class="text-indigo-600 hover:text-indigo-900 mr-3"
                    >
                      Edit
                    </button>
                    <button 
                      @click="deleteMember(member.id, member.name)"
                      class="text-red-600 hover:text-red-900"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Empty State -->
        <div v-else class="bg-white rounded-xl shadow-md p-12 text-center">
          <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
          <h5 class="text-lg font-medium text-gray-900 mb-2">No members found</h5>
          <p class="text-gray-600">Get started by adding your first team member.</p>
          <button
            @click="openAddMemberModal"
            class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg inline-flex items-center text-sm font-medium"
          >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Member
          </button>
        </div>
      </div>

      <!-- Add/Edit Member Modal -->
      <div v-if="showMemberModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">{{ editingMember ? 'Edit Member' : 'Add New Member' }}</h3>
            <button @click="closeMemberModal" class="text-gray-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          
          <form @submit.prevent="saveMember">
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                <input
                  v-model="memberForm.name"
                  type="text"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  placeholder="Enter member name"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                <input
                  v-model="memberForm.phone_number"
                  type="tel"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  placeholder="Enter phone number"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ID Type *</label>
                <select
                  v-model="memberForm.idno_type"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                  <option value="">Select ID type</option>
                  <option value="national_id">National ID</option>
                  <option value="passport">Passport</option>
                  <option value="driver_license">Driver's License</option>
                  <option value="other">Other</option>
                </select>
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ID Number *</label>
                <input
                  v-model="memberForm.idno"
                  type="text"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  placeholder="Enter ID number"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
                <select
                  v-model="memberForm.role"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                  <option value="">Select role</option>
                  <option value="member">Member</option>
                  <option value="volunteer">Volunteer</option>
                  <option value="staff">Staff</option>
                  <option value="coordinator">Coordinator</option>
                  <option value="manager">Manager</option>
                </select>
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select
                  v-model="memberForm.status"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                  <option value="suspended">Suspended</option>
                </select>
              </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
              <button
                type="button"
                @click="closeMemberModal"
                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
              >
                Cancel
              </button>
              <button
                type="submit"
                :disabled="savingMember"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                {{ savingMember ? 'Saving...' : (editingMember ? 'Update Member' : 'Add Member') }}
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
import AdminLayout from '~/components/AdminLayout.vue'
import Notifications from '~/components/Notifications.vue'

definePageMeta({
  middleware: 'auth'
})

const router = useRouter()
const authStore = useAuthStore()

const loading = ref(true)
const members = ref([])
const sidebarOpen = ref(false)
const showMemberModal = ref(false)
const editingMember = ref(null)
const savingMember = ref(false)
const memberForm = ref({
  name: '',
  phone_number: '',
  idno_type: '',
  idno: '',
  role: '',
  status: 'active'
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

const fetchMembers = async () => {
  try {
    const response = await $fetch(`${useRuntimeConfig().public.apiBase}/admin/members`)
    if (response.success) {
      members.value = response.data
    }
  } catch (err) {
    console.error('Members fetch error:', err)
    // Use demo data if API fails
    members.value = [
      {
        id: 1,
        name: 'John Doe',
        email: 'N/A',
        phone_number: '+250788123456',
        role: 'member',
        status: 'active',
        idno_type: 'national_id',
        idno: '1199080012345678',
        created_at: new Date().toISOString()
      },
      {
        id: 2,
        name: 'Jane Smith',
        email: 'N/A',
        phone_number: '+250787987654',
        role: 'volunteer',
        status: 'active',
        idno_type: 'passport',
        idno: 'PA1234567',
        created_at: new Date(Date.now() - 86400000).toISOString()
      }
    ]
  } finally {
    loading.value = false
  }
}

// Member management methods
const openAddMemberModal = () => {
  editingMember.value = null
  memberForm.value = {
    name: '',
    phone_number: '',
    email: '',
    idno_type: '',
    idno: '',
    role: '',
    status: 'active'
  }
  showMemberModal.value = true
}

const openEditMemberModal = (member) => {
  editingMember.value = member
  memberForm.value = {
    name: member.name || '',
    phone_number: member.phone_number || '',
    idno_type: member.idno_type || '',
    idno: member.idno || '',
    role: member.role || 'member',
    status: member.status || 'active'
  }
  showMemberModal.value = true
}

const closeMemberModal = () => {
  showMemberModal.value = false
  editingMember.value = null
  memberForm.value = {
    name: '',
    phone_number: '',
    idno_type: '',
    idno: '',
    role: '',
    status: 'active'
  }
}

const saveMember = async () => {
  savingMember.value = true
  
  // Validation
  if (!memberForm.value.name.trim()) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Name is required'
    })
    savingMember.value = false
    return
  }
  
  // Name validation - only letters and spaces
  const nameRegex = /^[a-zA-Z\s]+$/
  if (!nameRegex.test(memberForm.value.name.trim())) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Name can only contain letters and spaces'
    })
    savingMember.value = false
    return
  }
  
  // Phone number validation - 10 to 17 digits
  const phoneRegex = /^\d{10,17}$/
  const cleanPhone = memberForm.value.phone_number.replace(/\D/g, '') // Remove non-digits
  if (!phoneRegex.test(cleanPhone)) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Phone number must be between 10 and 17 digits'
    })
    savingMember.value = false
    return
  }
  
  // ID number validation - exactly 16 digits
  const idnoRegex = /^\d{16}$/
  const cleanIdno = memberForm.value.idno.replace(/\D/g, '') // Remove non-digits
  if (!idnoRegex.test(cleanIdno)) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'ID number must be exactly 16 digits'
    })
    savingMember.value = false
    return
  }
  
  // Required fields validation
  if (!memberForm.value.idno_type) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Please select ID type'
    })
    savingMember.value = false
    return
  }
  
  if (!memberForm.value.role) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Please select a role'
    })
    savingMember.value = false
    return
  }
  
  try {
    let response
    if (editingMember.value) {
      // Update existing member
      response = await $fetch(`${useRuntimeConfig().public.apiBase}/admin/members/${editingMember.value.id}`, {
        method: 'PUT',
        body: {
          ...memberForm.value,
          phone_number: cleanPhone,
          idno: cleanIdno
        }
      })
    } else {
      // Add new member
      response = await $fetch(`${useRuntimeConfig().public.apiBase}/admin/members`, {
        method: 'POST',
        body: {
          ...memberForm.value,
          phone_number: cleanPhone,
          idno: cleanIdno
        }
      })
    }
    
    if (response.success) {
      await Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: editingMember.value ? 'Member updated successfully' : 'Member added successfully',
        timer: 2000,
        showConfirmButton: false
      })
      
      closeMemberModal()
      fetchMembers() // Refresh the list
    }
  } catch (error) {
    console.error('Save member error:', error)
    await Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Failed to save member'
    })
  } finally {
    savingMember.value = false
  }
}

const deleteMember = async (memberId, memberName) => {
  const result = await Swal.fire({
    title: 'Are you sure?',
    text: `You are about to delete member "${memberName}". This action cannot be undone.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete',
    cancelButtonText: 'Cancel'
  })
  
  if (result.isConfirmed) {
    try {
      const response = await $fetch(`${useRuntimeConfig().public.apiBase}/admin/members/${memberId}`, {
        method: 'DELETE'
      })
      
      if (response.success) {
        await Swal.fire({
          icon: 'success',
          title: 'Deleted!',
          text: 'Member has been deleted successfully',
          timer: 2000,
          showConfirmButton: false
        })
        
        fetchMembers() // Refresh the list
      }
    } catch (error) {
      console.error('Delete member error:', error)
      await Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Failed to delete member'
      })
    }
  }
}

const getStatusBadgeClass = (status) => {
  switch (status) {
    case 'active':
      return 'bg-green-100 text-green-800'
    case 'inactive':
      return 'bg-gray-100 text-gray-800'
    case 'suspended':
      return 'bg-red-100 text-red-800'
    default:
      return 'bg-green-100 text-green-800'
  }
}

const formatDate = (dateString) => {
  if (!dateString) return 'N/A'
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString(undefined, options)
}

// Initialize
onMounted(() => {
  fetchMembers()
})
</script>
