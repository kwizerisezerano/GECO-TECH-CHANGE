<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <Header />
    
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 mt-20">
      <div class="max-w-6xl mx-auto">
        <!-- Page Header -->
        <div class="text-center mb-10">
          <h1 class="text-4xl font-bold text-gray-900 mb-4">Projects Management</h1>
          <p class="text-lg text-gray-600">Manage and track all GECO Rwanda projects</p>
        </div>

        <!-- Controls Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Status Filter -->
            <div>
              <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                Filter by Status
              </label>
              <select 
                id="status" 
                v-model="selectedStatus" 
                @change="fetchProjects"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              >
                <option value="">All Projects</option>
                <option value="ongoing">Ongoing</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
              </select>
            </div>

            <!-- Add Project Button -->
            <div class="flex items-end">
              <button 
                @click="showAddModal = true"
                class="w-full bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200 flex items-center justify-center gap-2"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Project
              </button>
            </div>
          </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="text-center py-12">
          <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
          <p class="mt-4 text-gray-600">Loading projects...</p>
        </div>

        <!-- Projects Grid -->
        <div v-else-if="projects.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div 
            v-for="project in projects" 
            :key="project.id"
            class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden"
          >
            <!-- Project Header -->
            <div :class="getHeaderClass(project.status)">
              <div class="p-6">
                <h3 class="text-xl font-bold text-white mb-2">{{ project.project_name }}</h3>
                <span :class="getStatusBadgeClass(project.status)">
                  {{ project.status }}
                </span>
              </div>
            </div>

            <!-- Project Body -->
            <div class="p-6">
              <!-- Description -->
              <div v-if="project.description" class="mb-4">
                <h6 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">Description</h6>
                <p class="text-gray-700">{{ project.description }}</p>
              </div>

              <!-- Project Details -->
              <div class="space-y-3">
                <!-- Dates -->
                <div class="grid grid-cols-2 gap-4">
                  <div v-if="project.start_date">
                    <h6 class="text-sm font-semibold text-gray-600">Start Date</h6>
                    <p class="text-gray-700">{{ formatDate(project.start_date) }}</p>
                  </div>
                  <div v-if="project.end_date">
                    <h6 class="text-sm font-semibold text-gray-600">End Date</h6>
                    <p class="text-gray-700">{{ formatDate(project.end_date) }}</p>
                  </div>
                </div>

                <!-- Budget -->
                <div v-if="project.budget">
                  <h6 class="text-sm font-semibold text-gray-600">Budget</h6>
                  <p class="text-gray-700 font-medium">RWF {{ formatCurrency(project.budget) }}</p>
                </div>

                <!-- Created Date -->
                <div>
                  <h6 class="text-sm font-semibold text-gray-600">Created</h6>
                  <p class="text-gray-700">{{ formatDate(project.created_at) }}</p>
                </div>
              </div>
            </div>

            <!-- Project Actions -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
              <div class="flex gap-2">
                <button 
                  @click="editProject(project)"
                  class="flex-1 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition-colors duration-200 text-sm"
                >
                  Edit
                </button>
                <button 
                  @click="confirmDelete(project)"
                  class="flex-1 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors duration-200 text-sm"
                >
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-else class="text-center py-12">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
          </svg>
          <h3 class="mt-2 text-sm font-medium text-gray-900">No projects found</h3>
          <p class="mt-1 text-sm text-gray-500">
            {{ selectedStatus ? 'No projects match the selected status.' : 'Get started by creating a new project.' }}
          </p>
          <div class="mt-6">
            <button 
              @click="showAddModal = true"
              class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200"
            >
              Add New Project
            </button>
          </div>
        </div>
      </div>
    </main>

    <!-- Add/Edit Project Modal -->
    <div v-if="showAddModal || editingProject" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
        <h2 class="text-2xl font-bold mb-6">
          {{ editingProject ? 'Edit Project' : 'Add New Project' }}
        </h2>
        
        <form @submit.prevent="saveProject">
          <!-- Project Name -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Project Name</label>
            <input 
              v-model="projectForm.project_name"
              type="text" 
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              placeholder="Enter project name"
            >
          </div>

          <!-- Status -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select 
              v-model="projectForm.status"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
            >
              <option value="">Select Status</option>
              <option value="ongoing">Ongoing</option>
              <option value="pending">Pending</option>
              <option value="completed">Completed</option>
            </select>
          </div>

          <!-- Description -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea 
              v-model="projectForm.description"
              rows="3"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              placeholder="Enter project description"
            ></textarea>
          </div>

          <!-- Start Date -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
            <input 
              v-model="projectForm.start_date"
              type="date" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
            >
          </div>

          <!-- End Date -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
            <input 
              v-model="projectForm.end_date"
              type="date" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
            >
          </div>

          <!-- Budget -->
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Budget (RWF)</label>
            <input 
              v-model="projectForm.budget"
              type="number" 
              step="0.01"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              placeholder="Enter budget amount"
            >
          </div>

          <!-- Actions -->
          <div class="flex gap-3">
            <button 
              type="submit"
              class="flex-1 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200"
            >
              {{ editingProject ? 'Update' : 'Save' }}
            </button>
            <button 
              type="button"
              @click="closeModal"
              class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors duration-200"
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="deletingProject" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
        <div class="text-center">
          <svg class="mx-auto h-12 w-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
          </svg>
          <h3 class="mt-4 text-lg font-medium text-gray-900">Delete Project</h3>
          <p class="mt-2 text-sm text-gray-500">
            Are you sure you want to delete "{{ deletingProject.project_name }}"? This action cannot be undone.
          </p>
        </div>
        
        <div class="mt-6 flex gap-3">
          <button 
            @click="deleteProject"
            class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200"
          >
            Delete
          </button>
          <button 
            @click="deletingProject = null"
            class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors duration-200"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import Header from '~/components/Header.vue'

// State
const loading = ref(false)
const projects = ref([])
const selectedStatus = ref('')
const showAddModal = ref(false)
const editingProject = ref(null)
const deletingProject = ref(null)

// Form
const projectForm = ref({
  project_name: '',
  status: '',
  description: '',
  start_date: '',
  end_date: '',
  budget: ''
})

// API Base URL
const apiBase = process.env.apiBase || 'http://localhost:3001/api'

// Methods
const fetchProjects = async () => {
  loading.value = true
  try {
    const url = selectedStatus.value 
      ? `${apiBase}/projects?status=${selectedStatus.value}`
      : `${apiBase}/projects`
    
    const response = await fetch(url)
    if (response.ok) {
      projects.value = await response.json()
    } else {
      console.error('Failed to fetch projects')
    }
  } catch (error) {
    console.error('Error fetching projects:', error)
  } finally {
    loading.value = false
  }
}

const saveProject = async () => {
  try {
    const url = editingProject.value 
      ? `${apiBase}/projects/${editingProject.value.id}`
      : `${apiBase}/projects`
    
    const method = editingProject.value ? 'PUT' : 'POST'
    
    const response = await fetch(url, {
      method,
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(projectForm.value)
    })

    if (response.ok) {
      await fetchProjects()
      closeModal()
    } else {
      console.error('Failed to save project')
    }
  } catch (error) {
    console.error('Error saving project:', error)
  }
}

const editProject = (project) => {
  editingProject.value = project
  projectForm.value = { ...project }
}

const confirmDelete = (project) => {
  deletingProject.value = project
}

const deleteProject = async () => {
  try {
    const response = await fetch(`${apiBase}/projects/${deletingProject.value.id}`, {
      method: 'DELETE'
    })

    if (response.ok) {
      await fetchProjects()
      deletingProject.value = null
    } else {
      console.error('Failed to delete project')
    }
  } catch (error) {
    console.error('Error deleting project:', error)
  }
}

const closeModal = () => {
  showAddModal.value = false
  editingProject.value = null
  projectForm.value = {
    project_name: '',
    status: '',
    description: '',
    start_date: '',
    end_date: '',
    budget: ''
  }
}

// Helper Methods
const getHeaderClass = (status) => {
  switch (status?.toLowerCase()) {
    case 'ongoing':
      return 'bg-gradient-to-r from-green-500 to-green-600'
    case 'pending':
      return 'bg-gradient-to-r from-yellow-500 to-yellow-600'
    case 'completed':
      return 'bg-gradient-to-r from-blue-500 to-blue-600'
    default:
      return 'bg-gradient-to-r from-gray-500 to-gray-600'
  }
}

const getStatusBadgeClass = (status) => {
  const baseClass = 'inline-block px-3 py-1 rounded-full text-xs font-semibold'
  switch (status?.toLowerCase()) {
    case 'ongoing':
      return `${baseClass} bg-white text-green-700`
    case 'pending':
      return `${baseClass} bg-white text-yellow-700`
    case 'completed':
      return `${baseClass} bg-white text-blue-700`
    default:
      return `${baseClass} bg-white text-gray-700`
  }
}

const formatDate = (dateString) => {
  if (!dateString) return 'N/A'
  return new Date(dateString).toLocaleDateString()
}

const formatCurrency = (amount) => {
  if (!amount) return '0'
  return parseFloat(amount).toLocaleString()
}

// Lifecycle
onMounted(() => {
  fetchProjects()
})
</script>
