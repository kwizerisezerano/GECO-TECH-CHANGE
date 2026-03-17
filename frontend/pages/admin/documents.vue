<template>
  <AdminLayout>
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
      <div class="px-6 py-4">
        <div class="flex justify-between items-center">
          <div>
            <h1 class="text-2xl font-bold text-gray-800">Document Upload</h1>
            <p class="text-gray-600">Upload and manage documents</p>
          </div>
          <div class="flex items-center space-x-4">
            <Notifications />
          </div>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="p-6">
        <!-- Upload Form -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6" data-aos="fade-up" data-aos-delay="100">
          <h5 class="text-lg font-semibold text-gray-800 mb-4">Upload New Document</h5>
          <form @submit.prevent="handleUpload">
            <div class="mb-4">
              <label for="document_title" class="block text-sm font-medium text-gray-700 mb-2">
                Document Title
              </label>
              <input
                v-model="document.title"
                type="text"
                id="document_title"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="Enter document title"
                required
              />
            </div>
            
            <div class="mb-4">
              <label for="document_category" class="block text-sm font-medium text-gray-700 mb-2">
                Category
              </label>
              <select
                v-model="document.category"
                id="document_category"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                required
              >
                <option value="">Select Category</option>
                <option value="report">Annual Report</option>
                <option value="strategic">Strategic Plan</option>
                <option value="laws">Constitution By Laws</option>
                <option value="policy">Policies</option>
                <option value="implementation">Implementation Plan</option>
                <option value="certificate">Certificate</option>
                <option value="achievement">Achievements</option>
                <option value="other">Other</option>
              </select>
            </div>
            
            <div class="mb-4">
              <label for="document_description" class="block text-sm font-medium text-gray-700 mb-2">
                Description
              </label>
              <textarea
                v-model="document.description"
                id="document_description"
                rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="Enter document description"
              ></textarea>
            </div>
            
            <div class="mb-6">
              <label for="document_file" class="block text-sm font-medium text-gray-700 mb-2">
                Select File
              </label>
              <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-purple-500 transition duration-200">
                <input
                  ref="fileInput"
                  type="file"
                  id="document_file"
                  class="hidden"
                  @change="handleFileSelect"
                  accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png"
                  required
                />
                <div v-if="!selectedFile">
                  <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                  </svg>
                  <p class="text-gray-600 mb-2">Click to upload or drag and drop</p>
                  <p class="text-sm text-gray-500">PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG (MAX. 10MB)</p>
                </div>
                <div v-else class="text-left">
                  <div class="flex items-center justify-between bg-purple-50 p-3 rounded-lg">
                    <div class="flex items-center">
                      <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                      </svg>
                      <div>
                        <p class="font-medium text-gray-900">{{ selectedFile.name }}</p>
                        <p class="text-sm text-gray-600">{{ formatFileSize(selectedFile.size) }}</p>
                      </div>
                    </div>
                    <button
                      type="button"
                      @click="removeFile"
                      class="text-red-600 hover:text-red-800"
                    >
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            
            <button
              type="submit"
              :disabled="uploading"
              class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="uploading" class="flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Uploading...
              </span>
              <span v-else class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                Upload Document
              </span>
            </button>
          </form>
        </div>

        <!-- Success/Error Messages -->
        <div v-if="successMessage" class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
          {{ successMessage }}
        </div>
        
        <div v-if="errorMessage" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
          {{ errorMessage }}
        </div>

        <!-- Existing Documents -->
        <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-up" data-aos-delay="200">
          <h5 class="text-lg font-semibold text-gray-800 mb-4">Recent Documents</h5>
          
          <!-- Document List -->
          <div class="space-y-3">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
              <div class="flex items-center">
                <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <div>
                  <p class="font-medium text-gray-900">Annual Report 2024</p>
                  <p class="text-sm text-gray-600">PDF • 2.5 MB • Uploaded 2 days ago</p>
                </div>
              </div>
              <div class="flex space-x-2">
                <button class="text-purple-600 hover:text-purple-800">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                </button>
                <button class="text-red-600 hover:text-red-800">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </div>
            </div>
            
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
              <div class="flex items-center">
                <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <div>
                  <p class="font-medium text-gray-900">Strategic Plan 2024-2030</p>
                  <p class="text-sm text-gray-600">PDF • 1.8 MB • Uploaded 1 week ago</p>
                </div>
              </div>
              <div class="flex space-x-2">
                <button class="text-purple-600 hover:text-purple-800">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                </button>
                <button class="text-red-600 hover:text-red-800">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
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

const uploading = ref(false)
const successMessage = ref('')
const errorMessage = ref('')
const sidebarOpen = ref(false)
const selectedFile = ref(null)
const fileInput = ref(null)

const document = ref({
  title: '',
  category: '',
  description: ''
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

const handleFileSelect = (event) => {
  const file = event.target.files[0]
  if (file) {
    // Check file size (10MB limit)
    if (file.size > 10 * 1024 * 1024) {
      errorMessage.value = 'File size must be less than 10MB'
      return
    }
    selectedFile.value = file
  }
}

const removeFile = () => {
  selectedFile.value = null
  if (fileInput.value) {
    fileInput.value.value = ''
  }
}

const formatFileSize = (bytes) => {
  if (bytes === 0) return '0 Bytes'
  const k = 1024
  const sizes = ['Bytes', 'KB', 'MB', 'GB']
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

const handleUpload = async () => {
  if (!selectedFile.value) {
    errorMessage.value = 'Please select a file to upload'
    return
  }

  uploading.value = true
  errorMessage.value = ''
  successMessage.value = ''

  try {
    // Create FormData for file upload
    const formData = new FormData()
    formData.append('file', selectedFile.value)
    formData.append('title', document.value.title)
    formData.append('category', document.value.category)
    formData.append('description', document.value.description)

    // Simulate upload (replace with actual API call)
    await new Promise(resolve => setTimeout(resolve, 2000))

    successMessage.value = 'Document uploaded successfully!'
    
    // Reset form
    document.value = {
      title: '',
      category: '',
      description: ''
    }
    selectedFile.value = null
    if (fileInput.value) {
      fileInput.value.value = ''
    }

    // Clear success message after 3 seconds
    setTimeout(() => {
      successMessage.value = ''
    }, 3000)

  } catch (err) {
    console.error('Upload error:', err)
    errorMessage.value = 'Failed to upload document. Please try again.'
  } finally {
    uploading.value = false
  }
}
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

/* File upload area */
.border-dashed:hover {
  border-color: rgb(147, 51, 234);
  background-color: rgb(249, 250, 251);
}
</style>
