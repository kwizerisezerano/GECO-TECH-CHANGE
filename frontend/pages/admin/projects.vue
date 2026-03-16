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
      <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-up" data-aos-delay="200">
          <h5 class="text-lg font-semibold text-gray-800 mb-4">All Projects</h5>
          
          <!-- Loading State -->
          <div v-if="loading" class="flex justify-center items-center h-32">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
          </div>
          
          <!-- Projects Grid -->
          <div v-else-if="projects && projects.length > 0" class="space-y-4">
            <div
              v-for="project in projects"
              :key="project.id"
              class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition duration-300"
            >
              <!-- Project Header -->
              <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-4 relative z-5">
                <div class="flex justify-between items-start">
                  <h6 class="text-lg font-semibold">{{ project.project_name }}</h6>
                  <span :class="getStatusBadgeClass(project.status)" class="px-3 py-1 rounded-full text-xs font-semibold z-20 relative">
                    {{ project.status }}
                  </span>
                </div>
              </div>
              
              <!-- Project Body -->
              <div class="p-4">
                <div v-if="project.description" class="mb-3">
                  <p class="text-gray-700">{{ project.description }}</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
                  <div v-if="project.start_date">
                    <p class="text-sm text-gray-600">Start Date</p>
                    <p class="font-medium">{{ formatDate(project.start_date) }}</p>
                  </div>
                  <div v-if="project.end_date">
                    <p class="text-sm text-gray-600">End Date</p>
                    <p class="font-medium">{{ formatDate(project.end_date) }}</p>
                  </div>
                  <div v-if="project.budget">
                    <p class="text-sm text-gray-600">Budget</p>
                    <p class="font-medium">RWF {{ Number(project.budget).toLocaleString() }}</p>
                  </div>
                </div>
                
                <div class="mb-3">
                  <p class="text-sm text-gray-600">Created</p>
                  <p class="font-medium">{{ formatDateTime(project.created_at) }}</p>
                </div>
              </div>
              
              <!-- Project Actions -->
              <div class="bg-gray-50 px-4 py-3 border-t border-gray-200">
                <div class="flex space-x-2">
                  <button
                    @click="editProject(project)"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center"
                  >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Update
                  </button>
                  <button
                    @click="deleteProject(project.id)"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center"
                  >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Empty State -->
          <div v-else class="text-center py-12">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h5 class="text-lg font-medium text-gray-900 mb-2">No projects found</h5>
            <p class="text-gray-600">Start by adding your first project above.</p>
          </div>
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
const addingProject = ref(false)
const projects = ref([])
const successMessage = ref('')
const errorMessage = ref('')
const showAddProjectForm = ref(false)
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
    const response = await $fetch('/api/admin/projects')
    if (response.success) {
      projects.value = response.data
    } else {
      errorMessage.value = 'Failed to load projects'
    }
  } catch (err) {
    console.error('Projects fetch error:', err)
    errorMessage.value = 'Server error. Please try again.'
  } finally {
    loading.value = false
  }
}

const handleAddProject = async () => {
  addingProject.value = true
  errorMessage.value = ''
  successMessage.value = ''
  
  try {
    const response = await $fetch('/api/admin/projects', {
      method: 'POST',
      body: newProject.value
    })
    
    if (response.success) {
      successMessage.value = 'Project added successfully!'
      
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
    } else {
      errorMessage.value = response.message || 'Failed to add project'
    }
  } catch (err) {
    console.error('Add project error:', err)
    errorMessage.value = 'Server error. Please try again.'
  } finally {
    addingProject.value = false
  }
}

const editProject = (project) => {
  // For now, we'll just show an alert. In a real app, you'd open an edit modal or navigate to edit page
  Swal.fire({
    title: 'Edit Project',
    text: `Edit functionality for "${project.project_name}" would be implemented here.`,
    icon: 'info'
  })
}

const deleteProject = async (projectId) => {
  const result = await Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!'
  })

  if (result.isConfirmed) {
    try {
      const response = await $fetch(`/api/admin/projects/${projectId}`, {
        method: 'DELETE'
      })
      
      if (response.success) {
        await Swal.fire({
          icon: 'success',
          title: 'Deleted!',
          text: 'The project has been deleted.',
          timer: 2000,
          showConfirmButton: false
        })
        
        // Refresh projects list
        await fetchProjects()
      } else {
        await Swal.fire({
          icon: 'error',
          title: 'Failed!',
          text: 'There was a problem deleting the project.',
        })
      }
    } catch (err) {
      console.error('Delete project error:', err)
      await Swal.fire({
        icon: 'error',
        title: 'Failed!',
        text: 'There was a problem deleting the project.',
      })
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
