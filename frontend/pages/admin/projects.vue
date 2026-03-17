<template>
  <AdminLayout>
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
      <div class="px-6 py-4 flex items-center justify-between">
        <h5 class="text-xl font-semibold text-gray-800">Projects Management</h5>
        <div class="flex items-center space-x-4">
          <Notifications />
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
            <div>
              <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">
                Currency
              </label>
              <select
                v-model="newProject.currency"
                id="currency"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              >
                <option value="RWF">RWF - Rwanda Franc</option>
                <option value="USD">USD - US Dollar</option>
                <option value="EUR">EUR - Euro</option>
                <option value="GBP">GBP - British Pound</option>
                <option value="CAD">CAD - Canadian Dollar</option>
              </select>
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
                    <span v-if="project.start_date" class="flex items-center gap-1">
                      📅 {{ formatShortDate(project.start_date) }}
                      <span class="text-xs text-gray-400">({{ formatRelativeDate(project.start_date) }})</span>
                    </span>
                    <span v-if="project.budget" class="flex items-center gap-1">
                      💰 {{ formatCurrency(project.budget, project.currency) }}
                      <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ project.currency || 'RWF' }}</span>
                    </span>
                  </div>
                </div>
                <div class="flex items-center gap-2">
                  <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                    {{ project.status || 'Unknown' }}
                  </span>
                  <button @click="editProject(project)" 
                          class="text-green-600 hover:text-green-800 text-sm font-medium">
                    Edit
                  </button>
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
import Notifications from '~/components/Notifications.vue'

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
  budget: '',
  currency: 'RWF'
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
  
  // Comprehensive validation
  if (!newProject.value.project_name?.trim()) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Project name is required'
    })
    return
  }
  
  // Project name validation - only letters and spaces
  const projectNameRegex = /^[a-zA-Z\s]+$/
  if (!projectNameRegex.test(newProject.value.project_name.trim())) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Project name can only contain letters and spaces'
    })
    return
  }
  
  if (!newProject.value.status) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Please select a project status'
    })
    return
  }
  
  // Description validation (optional but if provided, should be valid)
  if (newProject.value.description && newProject.value.description.length > 1000) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Description must be less than 1000 characters'
    })
    return
  }
  
  // Budget validation (optional but if provided, should be valid)
  if (newProject.value.budget) {
    const budget = parseFloat(newProject.value.budget)
    if (isNaN(budget) || budget <= 0) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Budget must be a positive number'
      })
      return
    }
    
    if (budget > 999999999) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Budget amount is too large'
      })
      return
    }
  }
  
  // Currency validation
  if (!newProject.value.currency) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Please select a currency'
    })
    return
  }
  
  // Date validation
  if (newProject.value.start_date && newProject.value.end_date) {
    const startDate = new Date(newProject.value.start_date)
    const endDate = new Date(newProject.value.end_date)
    
    if (startDate >= endDate) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'End date must be after start date'
      })
      return
    }
    
    // Check if dates are reasonable (not too far in the past or future)
    const today = new Date()
    const maxPastDate = new Date(today.getFullYear() - 10, today.getMonth(), today.getDate())
    const maxFutureDate = new Date(today.getFullYear() + 20, today.getMonth(), today.getDate())
    
    if (startDate < maxPastDate || endDate > maxFutureDate) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Project dates must be within reasonable range (past 10 years to next 20 years)'
      })
      return
    }
  }
  
  addingProject.value = true
  errorMessage.value = ''
  successMessage.value = ''
  
  try {
    console.log('Sending API request...')
    const response = await $fetch('http://localhost:3001/api/admin/projects', {
      method: 'POST',
      body: {
        ...newProject.value,
        budget: newProject.value.budget ? parseFloat(newProject.value.budget) : null
      }
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
        budget: '',
        currency: 'RWF'
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
      await Swal.fire({
        icon: 'error',
        title: 'Error',
        text: response.message || 'Failed to add project'
      })
    }
  } catch (error) {
    console.error('Add project error:', error)
    errorMessage.value = 'Failed to add project. Please try again.'
    
    // Show SweetAlert error
    await Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Failed to add project. Please try again.'
    })
  } finally {
    addingProject.value = false
  }
}

const editProject = async (project) => {
  // First, ask what to edit
  const { value: editMode } = await Swal.fire({
    title: 'Edit Project',
    text: 'What would you like to edit?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Edit All Fields',
    cancelButtonText: 'Edit Specific Field',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#6c757d',
    reverseButtons: true
  })

  if (editMode) {
    // Edit all fields - Professional modal
    const { value: formValues } = await Swal.fire({
      title: '✏️ Edit Project Details',
      html: `
        <style>
          .edit-form { max-width: 500px; margin: 0 auto; }
          .form-group { margin-bottom: 1.5rem; }
          .form-label { 
            display: block; 
            font-weight: 600; 
            color: #374151; 
            margin-bottom: 0.5rem;
            font-size: 14px;
          }
          .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
          }
          .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #3b82f6;
          }
          .form-row { display: flex; gap: 1rem; }
          .form-col { flex: 1; }
        </style>
        <div class="edit-form">
          <!-- Project Name -->
          <div class="form-group">
            <label class="form-label">📋 Project Name</label>
            <input id="swal-input1" class="form-input" placeholder="Enter project name" 
                   value="${project.project_name || ''}">
          </div>
          
          <!-- Status, Budget and Currency Row -->
          <div class="form-row">
            <div class="form-col">
              <div class="form-group">
                <label class="form-label">📊 Status</label>
                <select id="swal-input2" class="form-select">
                  <option value="">Select Status</option>
                  <option value="Ongoing" ${project.status === 'Ongoing' ? 'selected' : ''}>🔄 Ongoing</option>
                  <option value="Pending" ${project.status === 'Pending' ? 'selected' : ''}>⏳ Pending</option>
                  <option value="Completed" ${project.status === 'Completed' ? 'selected' : ''}>✅ Completed</option>
                </select>
              </div>
            </div>
            <div class="form-col">
              <div class="form-group">
                <label class="form-label">💰 Budget</label>
                <input id="swal-input6" type="number" class="form-input" placeholder="Enter budget" 
                       value="${project.budget || ''}">
              </div>
            </div>
          </div>
          
          <!-- Currency Row -->
          <div class="form-row">
            <div class="form-col">
              <div class="form-group">
                <label class="form-label">🌍 Currency</label>
                <select id="swal-input7" class="form-select">
                  <option value="RWF" ${project.currency === 'RWF' || !project.currency ? 'selected' : ''}>RWF - Rwanda Franc</option>
                  <option value="USD" ${project.currency === 'USD' ? 'selected' : ''}>USD - US Dollar</option>
                  <option value="EUR" ${project.currency === 'EUR' ? 'selected' : ''}>EUR - Euro</option>
                  <option value="GBP" ${project.currency === 'GBP' ? 'selected' : ''}>GBP - British Pound</option>
                  <option value="CAD" ${project.currency === 'CAD' ? 'selected' : ''}>CAD - Canadian Dollar</option>
                </select>
              </div>
            </div>
            <div class="form-col">
              <!-- Empty column for balance -->
            </div>
          </div>
          
          <!-- Dates Row -->
          <div class="form-row">
            <div class="form-col">
              <div class="form-group">
                <label class="form-label">📅 Start Date</label>
                <input id="swal-input4" type="date" class="form-input" 
                       value="${project.start_date || ''}">
              </div>
            </div>
            <div class="form-col">
              <div class="form-group">
                <label class="form-label">📅 End Date</label>
                <input id="swal-input5" type="date" class="form-input" 
                       value="${project.end_date || ''}">
              </div>
            </div>
          </div>
          
          <!-- Description -->
          <div class="form-group">
            <label class="form-label">📄 Description</label>
            <textarea id="swal-input3" class="form-textarea" rows="4" 
                      placeholder="Enter project description">${project.description || ''}</textarea>
          </div>
        </div>
      `,
      focusConfirm: false,
      showCancelButton: true,
      confirmButtonText: '💾 Update Project',
      cancelButtonText: '❌ Cancel',
      confirmButtonColor: '#10b981',
      cancelButtonColor: '#ef4444',
      width: '650px',
      preConfirm: () => {
        return {
          project_name: document.getElementById('swal-input1').value,
          status: document.getElementById('swal-input2').value,
          description: document.getElementById('swal-input3').value,
          start_date: document.getElementById('swal-input4').value,
          end_date: document.getElementById('swal-input5').value,
          budget: document.getElementById('swal-input6').value,
          currency: document.getElementById('swal-input7').value
        }
      }
    })

    if (formValues) {
      await updateProject(project.id, formValues)
    }
  } else {
    // Edit specific field - Show field selection
    const result = await Swal.fire({
      title: 'Select Field to Edit',
      html: `
        <div class="swal2-html-container" style="text-align: left;">
          <div class="space-y-3">
            <button class="field-btn w-full text-left p-3 border rounded-lg hover:bg-gray-100 transition-colors" data-field="project_name">
              📝 <strong>Project Name:</strong> ${project.project_name || 'Not set'}
            </button>
            <button class="field-btn w-full text-left p-3 border rounded-lg hover:bg-gray-100 transition-colors" data-field="status">
              📊 <strong>Status:</strong> ${project.status || 'Not set'}
            </button>
            <button class="field-btn w-full text-left p-3 border rounded-lg hover:bg-gray-100 transition-colors" data-field="description">
              📄 <strong>Description:</strong> ${project.description || 'Not set'}
            </button>
            <button class="field-btn w-full text-left p-3 border rounded-lg hover:bg-gray-100 transition-colors" data-field="start_date">
              📅 <strong>Start Date:</strong> ${project.start_date || 'Not set'}
            </button>
            <button class="field-btn w-full text-left p-3 border rounded-lg hover:bg-gray-100 transition-colors" data-field="end_date">
              📅 <strong>End Date:</strong> ${project.end_date || 'Not set'}
            </button>
            <button class="field-btn w-full text-left p-3 border rounded-lg hover:bg-gray-100 transition-colors" data-field="budget">
              💰 <strong>Budget:</strong> ${project.budget ? formatCurrency(project.budget) : 'Not set'}
            </button>
            <button class="field-btn w-full text-left p-3 border rounded-lg hover:bg-gray-100 transition-colors" data-field="currency">
              🌍 <strong>Currency:</strong> ${project.currency || 'RWF'}
            </button>
          </div>
        </div>
      `,
      showCancelButton: true,
      confirmButtonText: 'Cancel',
      cancelButtonText: 'Cancel',
      showConfirmButton: false,
      cancelButtonColor: '#dc3545',
      didOpen: () => {
        // Add click handlers to field buttons
        const buttons = document.querySelectorAll('.field-btn')
        buttons.forEach(btn => {
          btn.addEventListener('click', () => {
            const fieldName = btn.dataset.field
            Swal.close()
            editSingleField(project, fieldName)
          })
        })
      }
    })
  }
}

const editSingleField = async (project, fieldName) => {
  const fieldConfig = {
    project_name: {
      label: '📝 Project Name',
      type: 'text',
      placeholder: 'Enter project name',
      value: project.project_name || ''
    },
    status: {
      label: '📊 Status',
      type: 'select',
      options: [
        { value: 'Ongoing', label: '🔄 Ongoing' },
        { value: 'Pending', label: '⏳ Pending' },
        { value: 'Completed', label: '✅ Completed' }
      ],
      value: project.status || ''
    },
    description: {
      label: '📄 Description',
      type: 'textarea',
      placeholder: 'Enter project description',
      value: project.description || ''
    },
    start_date: {
      label: '📅 Start Date',
      type: 'date',
      value: project.start_date || ''
    },
    end_date: {
      label: '📅 End Date',
      type: 'date',
      value: project.end_date || ''
    },
    budget: {
      label: '💰 Budget',
      type: 'number',
      placeholder: 'Enter budget',
      value: project.budget || ''
    },
    currency: {
      label: '🌍 Currency',
      type: 'select',
      options: [
        { value: 'RWF', label: 'RWF - Rwanda Franc' },
        { value: 'USD', label: 'USD - US Dollar' },
        { value: 'EUR', label: 'EUR - Euro' },
        { value: 'GBP', label: 'GBP - British Pound' },
        { value: 'CAD', label: 'CAD - Canadian Dollar' }
      ],
      value: project.currency || 'RWF'
    }
  }

  const config = fieldConfig[fieldName]
  let inputHtml = ''

  if (config.type === 'select') {
    // Handle both string arrays and object arrays with labels
    const options = config.options.length > 0 && typeof config.options[0] === 'string'
      ? config.options.map(opt => ({ value: opt, label: opt }))
      : config.options
    
    inputHtml = `
      <select id="swal-single-input" class="swal2-select">
        <option value="">Select ${config.label.replace(/[^\w\s]/gi, '')}</option>
        ${options.map(opt => 
          `<option value="${opt.value}" ${opt.value === config.value ? 'selected' : ''}>${opt.label}</option>`
        ).join('')}
      </select>
    `
  } else if (config.type === 'textarea') {
    inputHtml = `
      <textarea id="swal-single-input" class="swal2-textarea" rows="3" 
                placeholder="${config.placeholder}">${config.value}</textarea>
    `
  } else {
    inputHtml = `
      <input id="swal-single-input" type="${config.type}" class="swal2-input" 
             placeholder="${config.placeholder}" value="${config.value}">
    `
  }

  const { value: newValue } = await Swal.fire({
    title: `Edit ${config.label}`,
    html: `
      <style>
        .single-field-form { text-align: left; }
        .form-label { 
          display: block; 
          font-weight: 600; 
          color: #374151; 
          margin-bottom: 0.5rem;
          font-size: 14px;
        }
        .form-input, .form-select, .form-textarea {
          width: 100%;
          padding: 0.75rem;
          border: 2px solid #e5e7eb;
          border-radius: 8px;
          font-size: 14px;
          transition: border-color 0.2s;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
          outline: none;
          border-color: #3b82f6;
        }
      </style>
      <div class="single-field-form">
        <label class="form-label">${config.label}</label>
        ${inputHtml}
      </div>
    `,
    focusConfirm: false,
    showCancelButton: true,
    confirmButtonText: '💾 Update',
    cancelButtonText: '❌ Cancel',
    confirmButtonColor: '#10b981',
    cancelButtonColor: '#ef4444',
    preConfirm: () => {
      return document.getElementById('swal-single-input').value
    }
  })

  // Only update if value is different and not empty
  if (newValue !== null && newValue !== '' && newValue !== config.value) {
    const updateData = { [fieldName]: newValue }
    await updateProject(project.id, updateData)
  } else if (newValue === null || newValue === '') {
    // If user cleared the field, show warning
    await Swal.fire({
      icon: 'warning',
      title: '⚠️ Field Cannot Be Empty',
      text: 'Please enter a valid value for this field.',
      timer: 2000,
      showConfirmButton: false
    })
  }
  // If value is the same, do nothing (no update needed)
}

const updateProject = async (projectId, data) => {
  // Validation for edited data
  if (data.project_name) {
    if (!data.project_name.trim()) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Project name is required'
      })
      return
    }
    
    // Project name validation - only letters and spaces
    const projectNameRegex = /^[a-zA-Z\s]+$/
    if (!projectNameRegex.test(data.project_name.trim())) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Project name can only contain letters and spaces'
      })
      return
    }
  }
  
  // Budget validation
  if (data.budget) {
    const budget = parseFloat(data.budget)
    if (isNaN(budget) || budget <= 0) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Budget must be a positive number'
      })
      return
    }
    
    if (budget > 999999999) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Budget amount is too large'
      })
      return
    }
    
    data.budget = budget // Convert to number
  }
  
  // Date validation
  if (data.start_date && data.end_date) {
    const startDate = new Date(data.start_date)
    const endDate = new Date(data.end_date)
    
    if (startDate >= endDate) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'End date must be after start date'
      })
      return
    }
    
    // Check if dates are reasonable
    const today = new Date()
    const maxPastDate = new Date(today.getFullYear() - 10, today.getMonth(), today.getDate())
    const maxFutureDate = new Date(today.getFullYear() + 20, today.getMonth(), today.getDate())
    
    if (startDate < maxPastDate || endDate > maxFutureDate) {
      await Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Project dates must be within reasonable range (past 10 years to next 20 years)'
      })
      return
    }
  }
  
  // Description validation
  if (data.description && data.description.length > 1000) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Description must be less than 1000 characters'
    })
    return
  }
  
  try {
    const response = await $fetch(`http://localhost:3001/api/admin/projects/${projectId}`, {
      method: 'PUT',
      body: data
    })
    
    if (response.success) {
      await Swal.fire({
        icon: 'success',
        title: '✅ Updated!',
        text: 'Project updated successfully!',
        timer: 2000,
        showConfirmButton: false
      })
      await fetchProjects()
    }
  } catch (error) {
    await Swal.fire({
      icon: 'error',
      title: '❌ Error',
      text: 'Failed to update project'
    })
  }
}

const deleteProject = async (projectId) => {
  const result = await Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6'
  })

  if (result.isConfirmed) {
    try {
      const response = await $fetch(`http://localhost:3001/api/admin/projects/${projectId}`, {
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
        await fetchProjects()
      }
    } catch (error) {
      await Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Failed to delete project'
      })
    }
  }
}

const formatDate = (dateString) => {
  if (!dateString) return 'Not set'
  
  const date = new Date(dateString)
  
  // Check if date is valid
  if (isNaN(date.getTime())) return 'Invalid date'
  
  // Format: "January 15, 2024"
  const options = { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric'
  }
  
  return date.toLocaleDateString('en-US', options)
}

const formatDateTime = (dateString) => {
  if (!dateString) return 'Not set'
  
  const date = new Date(dateString)
  
  // Check if date is valid
  if (isNaN(date.getTime())) return 'Invalid date'
  
  // Format: "January 15, 2024 at 2:30 PM"
  const options = { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    hour12: true
  }
  
  return date.toLocaleDateString('en-US', options).replace(',', ' at')
}

const formatShortDate = (dateString) => {
  if (!dateString) return 'Not set'
  
  const date = new Date(dateString)
  
  // Check if date is valid
  if (isNaN(date.getTime())) return 'Invalid date'
  
  // Format: "Jan 15, 2024"
  const options = { 
    year: 'numeric', 
    month: 'short', 
    day: 'numeric'
  }
  
  return date.toLocaleDateString('en-US', options)
}

const formatRelativeDate = (dateString) => {
  if (!dateString) return 'Not set'
  
  const date = new Date(dateString)
  const now = new Date()
  
  // Debug: Log the values to see what's happening
  console.log('Date string:', dateString)
  console.log('Parsed date:', date)
  console.log('Current time:', now)
  console.log('Date time:', date.getTime())
  console.log('Current time:', now.getTime())
  
  // Check if date is valid
  if (isNaN(date.getTime())) return 'Invalid date'
  
  // Calculate difference without absolute value
  const diffTime = now - date
  const diffDays = Math.floor(Math.abs(diffTime) / (1000 * 60 * 60 * 24))
  
  console.log('Time difference (ms):', diffTime)
  console.log('Days difference:', diffDays)
  console.log('Is past date:', diffTime > 0)
  
  if (diffDays === 0) {
    return 'Today'
  } else if (diffDays === 1) {
    return diffTime > 0 ? 'Yesterday' : 'Tomorrow'
  } else if (diffDays < 7) {
    return diffTime > 0 ? `${diffDays} days ago` : `In ${diffDays} days`
  } else if (diffDays < 30) {
    const weeks = Math.floor(diffDays / 7)
    return diffTime > 0 ? `${weeks} week${weeks > 1 ? 's' : ''} ago` : `In ${weeks} week${weeks > 1 ? 's' : ''}`
  } else if (diffDays < 365) {
    const months = Math.floor(diffDays / 30)
    return diffTime > 0 ? `${months} month${months > 1 ? 's' : ''} ago` : `In ${months} month${months > 1 ? 's' : ''}`
  } else {
    const years = Math.floor(diffDays / 365)
    return diffTime > 0 ? `${years} year${years > 1 ? 's' : ''} ago` : `In ${years} year${years > 1 ? 's' : ''}`
  }
}

const formatCurrency = (amount, currency = 'RWF') => {
  if (!amount || amount === 0) return `${currency} 0`
  
  // Convert to number if it's a string
  const numAmount = typeof amount === 'string' ? parseFloat(amount) : amount
  
  // Format based on currency
  if (currency === 'RWF') {
    // Rwanda Franc - no decimals, comma separators
    return new Intl.NumberFormat('en-RW', {
      minimumFractionDigits: 0,
      maximumFractionDigits: 0
    }).format(numAmount).replace(/RWF/i, `${currency} `)
  } else {
    // Other currencies - standard formatting
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: currency,
      minimumFractionDigits: 0,
      maximumFractionDigits: 0
    }).format(numAmount)
  }
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
