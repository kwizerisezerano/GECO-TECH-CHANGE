<template>
  <AdminLayout>
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
      <div class="px-6 py-4">
        <div class="flex justify-between items-center">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">Projects Management</h1>
            <p class="text-gray-600">Manage and monitor all organization projects</p>
          </div>
          <button
            @click="showAddProjectForm = true"
            class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 flex items-center"
          >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add New Project
          </button>
        </div>
      </div>
    </div>

    <!-- Add Project Form Modal -->
    <div v-if="showAddProjectForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-xl p-6 w-full max-w-2xl max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-semibold text-gray-900">Add New Project</h3>
          <button @click="showAddProjectForm = false" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <form @submit.prevent="handleAddProject">
          <div class="mb-4">
            <label for="project_name" class="block text-sm font-medium text-gray-700 mb-2">
              Project Name
            </label>
            <input
              v-model="newProject.project_name"
              type="text"
              id="project_name"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              placeholder="Enter project name"
              required
            />
          </div>
          <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
              Status
            </label>
            <select
              v-model="newProject.status"
              id="status"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              required
            >
              <option value="">Select Status</option>
              <option value="Ongoing">Ongoing</option>
              <option value="Pending">Pending</option>
              <option value="Completed">Completed</option>
            </select>
          </div>
            
          <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
              Description
            </label>
            <textarea
              v-model="newProject.description"
              id="description"
              rows="3"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              placeholder="Enter project description"
            ></textarea>
          </div>
            
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
              <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                Start Date
              </label>
              <input
                v-model="newProject.start_date"
                type="date"
                id="start_date"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              />
            </div>
            <div>
              <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                End Date
              </label>
              <input
                v-model="newProject.end_date"
                type="date"
                id="end_date"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              />
            </div>
            <div>
              <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">
                Budget (RWF)
              </label>
              <input
                v-model="newProject.budget"
                type="number"
                id="budget"
                min="0"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="Enter budget"
              />
            </div>
          </div>
            
          <div class="flex justify-end space-x-3">
            <button
              type="button"
              @click="showAddProjectForm = false"
              class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200"
            >
              Cancel
            </button>
            <button
              type="submit"
              :disabled="addingProject"
              class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="addingProject" class="flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Adding Project...
              </span>
              <span v-else class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Project
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Projects List -->
    <div class="px-6 py-6">
      <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
          <h5 class="text-lg font-semibold text-gray-800">All Projects</h5>
          <div class="text-sm text-gray-600">
            Showing {{ paginatedProjects.length }} of {{ projects.length }} projects
          </div>
        </div>
        
        <!-- Loading -->
        <div v-if="loading" class="text-center py-8">
          <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
          <p class="mt-2 text-gray-600">Loading projects...</p>
        </div>
        
        <!-- Projects List -->
        <div v-else-if="paginatedProjects && paginatedProjects.length > 0">
          <div class="space-y-3">
            <div v-for="(project, index) in paginatedProjects" :key="project.id || index" 
                 class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
              <div class="flex justify-between items-start">
                <div>
                  <h6 class="font-semibold text-lg">{{ project.project_name || 'Unknown Project' }}</h6>
                  <p class="text-gray-600 text-sm mt-1">{{ project.description || 'No description' }}</p>
                  <div class="flex gap-4 mt-2 text-sm text-gray-500">
                    <span v-if="project.start_date">📅 {{ project.start_date }}</span>
                    <span v-if="project.budget">💰 RWF {{ project.budget }}</span>
                  </div>
                </div>
                <div class="flex items-center gap-2">
                  <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                    {{ project.status || 'Unknown' }}
                  </span>
                  <button @click="deleteProject(project.id)" 
                          class="text-red-600 hover:text-red-800 text-sm">
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Pagination Controls -->
          <div v-if="totalPages > 1" class="flex justify-center items-center mt-6 space-x-2">
            <!-- Previous Button -->
            <button 
              @click="currentPage = Math.max(1, currentPage - 1)"
              :disabled="currentPage === 1"
              class="px-3 py-1 border border-gray-300 rounded text-sm disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-100"
            >
              Previous
            </button>
            
            <!-- Page Numbers -->
            <button 
              v-for="page in totalPages" 
              :key="page"
              @click="currentPage = page"
              :class="[
                'px-3 py-1 border rounded text-sm',
                currentPage === page 
                  ? 'bg-blue-500 text-white border-blue-500' 
                  : 'border-gray-300 hover:bg-gray-100'
              ]"
            >
              {{ page }}
            </button>
            
            <!-- Next Button -->
            <button 
              @click="currentPage = Math.min(totalPages, currentPage + 1)"
              :disabled="currentPage === totalPages"
              class="px-3 py-1 border border-gray-300 rounded text-sm disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-100"
            >
              Next
            </button>
          </div>
        </div>
        
        <!-- No Projects -->
        <div v-else class="text-center py-8">
          <p class="text-gray-500">No projects found. Add your first project above.</p>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '~/stores/auth'
import Swal from 'sweetalert2'

definePageMeta({
  middleware: 'auth'
})

const router = useRouter()
const authStore = useAuthStore()

const loading = ref(true)
const addingProject = ref(false)
const projects = ref([])
const successMessage = ref('')
const errorMessage = ref('')
const showAddProjectForm = ref(false)

// Pagination
const currentPage = ref(1)
const itemsPerPage = 5

// Computed properties for pagination
const totalPages = computed(() => Math.ceil(projects.value.length / itemsPerPage))
const paginatedProjects = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return projects.value.slice(start, end)
})
const sidebarOpen = ref(false)

const newProject = ref({
  project_name: '',
  status: '',
  description: '',
  start_date: '',
  end_date: '',
  budget: ''
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

const fetchProjects = async () => {
  try {
    console.log('Fetching projects...')
    loading.value = true
    errorMessage.value = ''
    
    const response = await $fetch('http://localhost:3001/api/admin/projects')
    console.log('Projects response:', response)
    
    if (response.success) {
      projects.value = response.data
      console.log('Projects loaded:', projects.value.length, 'projects')
      console.log('Projects data:', projects.value)
    } else {
      errorMessage.value = 'Failed to load projects'
      console.error('Failed to load projects:', response)
    }
  } catch (err) {
    console.error('Projects fetch error:', err)
    errorMessage.value = 'Server error. Please try again.'
  } finally {
    loading.value = false
  }
}

const handleAddProject = async () => {
  console.log('handleAddProject called')
  console.log('newProject.value:', newProject.value)
  
  // Basic validation
  if (!newProject.value.project_name || !newProject.value.status) {
    errorMessage.value = 'Please fill in all required fields'
    return
  }
  
  addingProject.value = true
  errorMessage.value = ''
  successMessage.value = ''
  
  try {
    console.log('Sending API request...')
    const response = await $fetch('http://localhost:3001/api/admin/projects', {
      method: 'POST',
      body: newProject.value
    })
    
    console.log('API response:', response)
    
    if (response.success) {
      successMessage.value = '✅ Project added successfully!'
      
      // Show SweetAlert success
      await Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Project added successfully!',
        timer: 2000,
        showConfirmButton: false
      })
      
      // Reset form
      newProject.value = {
        project_name: '',
        status: '',
        description: '',
        start_date: '',
        end_date: '',
        budget: ''
      }
      
      // Refresh projects list
      await fetchProjects()
      
      // Clear success message after 3 seconds
      setTimeout(() => {
        successMessage.value = ''
      }, 3000)
      
      // Hide form after successful addition
      showAddProjectForm.value = false
    } else {
      errorMessage.value = response.message || 'Failed to add project'
    }
  } catch (error) {
    console.error('Add project error:', error)
    console.error('Error status:', error.status)
    console.error('Error data:', error.data)
    console.error('Error message:', error.message)
    
    // Show error with SweetAlert for better visibility
    let errorMessage = 'Failed to add project'
    
    if (error.data?.message) {
      errorMessage = error.data.message
    } else if (error.status === 409) {
      errorMessage = 'A project with this name already exists. Please choose a different name.'
    } else if (error.status === 500) {
      errorMessage = 'Server error. Please try again.'
    } else if (error.message) {
      errorMessage = `Failed to add project: ${error.message}`
    }
    
    // Show SweetAlert error
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: errorMessage,
      confirmButtonColor: '#3085d6'
    })
    
    // Also set inline error message
    errorMessage.value = `❌ ${errorMessage}`
  } finally {
    addingProject.value = false
  }
}

const editProject = (project) => {
  // Simple non-blocking alert
  alert(`Edit functionality for "${project.project_name}" would be implemented here.`)
}

const deleteProject = async (projectId) => {
  // Simple confirm dialog
  if (confirm('Are you sure you want to delete this project? This action cannot be undone.')) {
    try {
      const response = await $fetch(`http://localhost:3001/api/admin/projects/${projectId}`, {
        method: 'DELETE'
      })
      
      if (response.success) {
        successMessage.value = '✅ Project deleted successfully!'
        await fetchProjects()
        
        // Clear success message after 3 seconds
        setTimeout(() => {
          successMessage.value = ''
        }, 3000)
      }
    } catch (error) {
      console.error('Delete project error:', error)
      errorMessage.value = '❌ Failed to delete project. Please try again.'
    }
  }
}

const formatDate = (dateString) => {
  if (!dateString) return 'N/A'
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString(undefined, options)
}

const formatDateTime = (dateString) => {
  if (!dateString) return 'N/A'
  const options = { 
    year: 'numeric', 
    month: 'short', 
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  }
  return new Date(dateString).toLocaleDateString(undefined, options)
}

const getStatusBadgeClass = (status) => {
  const baseClass = 'px-3 py-1 rounded-full text-xs font-semibold '
  switch (status.toLowerCase()) {
    case 'ongoing':
      return baseClass + 'bg-purple-600 text-white'
    case 'pending':
      return baseClass + 'bg-purple-400 text-white'
    case 'completed':
      return baseClass + 'bg-purple-800 text-white'
    default:
      return baseClass + 'bg-purple-300 text-white'
  }
}

// Initialize
onMounted(() => {
  fetchProjects()
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
