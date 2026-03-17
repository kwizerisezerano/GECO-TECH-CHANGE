<template>
  <AdminLayout>
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
      <div class="px-4 sm:px-6 py-4">
        <div class="flex flex-wrap gap-3 items-center justify-between">
          <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Users Management</h1>
            <p class="text-gray-600 text-sm">Manage all system users from here</p>
          </div>
          <div class="flex items-center gap-2">
            <button
              @click="openAddUserModal"
              class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg flex items-center text-sm font-medium"
            >
              <svg class="w-4 h-4 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              <span class="hidden sm:inline">Add User</span>
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
          <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
        </div>

        <!-- Users List -->
        <div v-else-if="users && users.length > 0" class="bg-white rounded-xl shadow-md overflow-hidden">
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
                    Email
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Role
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Last Login
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ user.id }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ user.name || 'N/A' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ user.email || 'N/A' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ user.role || 'User' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                          :class="getStatusBadgeClass(user.status)">
                      {{ user.status || 'Active' }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ formatDate(user.last_login) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button 
                      @click="openEditUserModal(user)"
                      class="text-indigo-600 hover:text-indigo-900 mr-3"
                    >
                      Edit
                    </button>
                    <button 
                      @click="deleteUser(user.id, user.name)"
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
          <h5 class="text-lg font-medium text-gray-900 mb-2">No users found</h5>
          <p class="text-gray-600">Get started by adding your first system user.</p>
          <button
            @click="openAddUserModal"
            class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg inline-flex items-center text-sm font-medium"
          >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add User
          </button>
        </div>
      </div>

      <!-- Add/Edit User Modal -->
      <div v-if="showUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">{{ editingUser ? 'Edit User' : 'Add New User' }}</h3>
            <button @click="closeUserModal" class="text-gray-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          
          <form @submit.prevent="saveUser">
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                <input
                  v-model="userForm.name"
                  type="text"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  placeholder="Enter user name"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input
                  v-model="userForm.email"
                  type="email"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  placeholder="Enter email address"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                <div class="relative">
                  <input
                    v-model="userForm.password"
                    :type="showPassword ? 'text' : 'password'"
                    :required="!editingUser"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 pr-10"
                    :placeholder="editingUser ? 'Leave blank to keep current password' : 'Enter password'"
                  />
                  <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                  >
                    <svg 
                      class="w-5 h-5 text-gray-400 hover:text-gray-600" 
                      fill="none" 
                      stroke="currentColor" 
                      viewBox="0 0 24 24"
                    >
                      <path 
                        v-if="showPassword"
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        stroke-width="2" 
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"
                      ></path>
                      <path 
                        v-else
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        stroke-width="2" 
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
                <select
                  v-model="userForm.role"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                  <option value="">Select role</option>
                  <option value="admin">Admin</option>
                  <option value="manager">Manager</option>
                  <option value="staff">Staff</option>
                  <option value="user">User</option>
                </select>
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select
                  v-model="userForm.status"
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
                @click="closeUserModal"
                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
              >
                Cancel
              </button>
              <button
                type="submit"
                :disabled="savingUser"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                {{ savingUser ? 'Saving...' : (editingUser ? 'Update User' : 'Add User') }}
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
const users = ref([])
const showUserModal = ref(false)
const editingUser = ref(null)
const savingUser = ref(false)
const showPassword = ref(false)
const userForm = ref({
  name: '',
  email: '',
  password: '',
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

const fetchUsers = async () => {
  try {
    const response = await $fetch('http://localhost:3001/api/admin/users')
    if (response.success) {
      users.value = response.data
    }
  } catch (err) {
    console.error('Users fetch error:', err)
    // Use demo data if API fails
    users.value = [
      {
        id: 1,
        name: 'Admin User',
        email: 'admin@gecorwanda.org',
        role: 'admin',
        status: 'active',
        last_login: new Date().toISOString()
      },
      {
        id: 2,
        name: 'Manager User',
        email: 'manager@gecorwanda.org',
        role: 'manager',
        status: 'active',
        last_login: new Date(Date.now() - 86400000).toISOString()
      }
    ]
  } finally {
    loading.value = false
  }
}

// User management methods
const openAddUserModal = () => {
  editingUser.value = null
  userForm.value = {
    name: '',
    email: '',
    password: '',
    role: '',
    status: 'active'
  }
  showUserModal.value = true
}

const openEditUserModal = (user) => {
  editingUser.value = user
  userForm.value = {
    name: user.name || '',
    email: user.email || '',
    password: '',
    role: user.role || 'user',
    status: user.status || 'active'
  }
  showUserModal.value = true
}

const closeUserModal = () => {
  showUserModal.value = false
  editingUser.value = null
  userForm.value = {
    name: '',
    email: '',
    password: '',
    role: '',
    status: 'active'
  }
}

const saveUser = async () => {
  savingUser.value = true
  
  // Validation
  if (!userForm.value.name.trim()) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Name is required'
    })
    savingUser.value = false
    return
  }
  
  // Name validation - only letters and spaces
  const nameRegex = /^[a-zA-Z\s]+$/
  if (!nameRegex.test(userForm.value.name.trim())) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Name can only contain letters and spaces'
    })
    savingUser.value = false
    return
  }
  
  // Email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!emailRegex.test(userForm.value.email.trim())) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Please enter a valid email address'
    })
    savingUser.value = false
    return
  }
  
  // Password validation for new users
  if (!editingUser.value) {
    if (!userForm.value.password) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Password is required for new users'
      })
      savingUser.value = false
      return
    }
    
    if (userForm.value.password.length < 6) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Password must be at least 6 characters long'
      })
      savingUser.value = false
      return
    }
    
    // Password strength validation
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/
    if (!passwordRegex.test(userForm.value.password)) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Password must contain at least one uppercase letter, one lowercase letter, and one number'
      })
      savingUser.value = false
      return
    }
  } else {
    // For existing users, if password is provided, validate it
    if (userForm.value.password) {
      if (userForm.value.password.length < 6) {
        await Swal.fire({
          icon: 'error',
          title: 'Validation Error',
          text: 'Password must be at least 6 characters long'
        })
        savingUser.value = false
        return
      }
      
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/
      if (!passwordRegex.test(userForm.value.password)) {
        await Swal.fire({
          icon: 'error',
          title: 'Validation Error',
          text: 'Password must contain at least one uppercase letter, one lowercase letter, and one number'
        })
        savingUser.value = false
        return
      }
    }
  }
  
  // Required fields validation
  if (!userForm.value.role) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Please select a role'
    })
    savingUser.value = false
    return
  }
  
  if (!userForm.value.status) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Please select a status'
    })
    savingUser.value = false
    return
  }
  
  try {
    let response
    if (editingUser.value) {
      // Update existing user
      response = await $fetch(`http://localhost:3001/api/admin/users/${editingUser.value.id}`, {
        method: 'PUT',
        body: userForm.value
      })
    } else {
      // Add new user
      response = await $fetch('http://localhost:3001/api/admin/users', {
        method: 'POST',
        body: userForm.value
      })
    }
    
    if (response.success) {
      await Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: editingUser.value ? 'User updated successfully' : 'User added successfully',
        timer: 2000,
        showConfirmButton: false
      })
      
      closeUserModal()
      fetchUsers() // Refresh the list
    }
  } catch (error) {
    console.error('Save user error:', error)
    await Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Failed to save user'
    })
  } finally {
    savingUser.value = false
  }
}

const deleteUser = async (userId, userName) => {
  const result = await Swal.fire({
    title: 'Are you sure?',
    text: `You are about to delete user "${userName}". This action cannot be undone.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete',
    cancelButtonText: 'Cancel'
  })
  
  if (result.isConfirmed) {
    try {
      const response = await $fetch(`http://localhost:3001/api/admin/users/${userId}`, {
        method: 'DELETE'
      })
      
      if (response.success) {
        await Swal.fire({
          icon: 'success',
          title: 'Deleted!',
          text: 'User has been deleted successfully',
          timer: 2000,
          showConfirmButton: false
        })
        
        fetchUsers() // Refresh the list
      }
    } catch (error) {
      console.error('Delete user error:', error)
      await Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Failed to delete user'
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
  if (!dateString) return 'Never'
  const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' }
  return new Date(dateString).toLocaleDateString(undefined, options)
}

// Initialize
onMounted(() => {
  fetchUsers()
})
</script>
