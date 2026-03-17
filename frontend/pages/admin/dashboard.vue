<template>
  <AdminLayout>
    <!-- Page Header -->
    <div class="bg-white border-b border-gray-200">
      <div class="px-6 py-4">
        <div class="flex justify-between items-center">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600">Welcome back, {{ authStore.currentUser?.name || authStore.currentUser?.email?.split('@')[0] || 'Admin' }}!</p>
          </div>
          <div class="flex items-center space-x-4">
            <button
              @click="openAddNotificationModal"
              class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg flex items-center text-sm"
            >
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
              Add Notification
            </button>
            <button
              @click="forceLogout"
              class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg flex items-center text-sm"
            >
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
              </svg>
              Force Logout
            </button>
            <Notifications />
            <div class="text-right hidden sm:block">
              <p class="text-sm text-gray-500">Current Time</p>
              <p class="text-lg font-semibold text-gray-900">{{ currentTime }}</p>
            </div>
            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-semibold">
              {{ (authStore.currentUser?.name || authStore.currentUser?.email?.split('@')[0] || 'Admin').charAt(0).toUpperCase() }}
            </div>
          </div>
        </div>
      </div>
    </div>

      <!-- Content -->
      <div class="p-6">
        <!-- Loading State -->
        <div v-if="loading" class="flex flex-col items-center justify-center h-96">
          <div class="w-12 h-12 border-4 border-gray-200 border-t-indigo-600 rounded-full animate-spin"></div>
          <p class="mt-4 text-gray-600 font-medium">Loading dashboard...</p>
        </div>

        <!-- Dashboard Content -->
        <div v-else-if="dashboardData" class="space-y-6">
          <!-- Statistics Cards -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Projects -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Total Projects</p>
                  <p class="text-3xl font-bold text-gray-900 mt-2">{{ totalProjects }}</p>
                  <div class="flex items-center mt-2">
                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="text-sm text-green-600 font-medium">+{{ getProjectGrowth() }}%</span>
                    <span class="text-xs text-gray-500 ml-1">this month</span>
                  </div>
                </div>
                <div class="bg-indigo-100 rounded-lg p-3">
                  <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Members -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Members</p>
                  <p class="text-3xl font-bold text-gray-900 mt-2">{{ dashboardData.totalMembers }}</p>
                  <div class="flex items-center mt-2">
                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="text-sm text-green-600 font-medium">+{{ getMemberGrowth() || 0 }}%</span>
                    <span class="text-xs text-gray-500 ml-1">this month</span>
                  </div>
                </div>
                <div class="bg-green-100 rounded-lg p-3">
                  <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 4 1 4-1 1H7zm4-6a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 2v1c0 .55.45 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Beneficiaries -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Beneficiaries</p>
                  <p class="text-3xl font-bold text-gray-900 mt-2">{{ dashboardData.totalBeneficiaries }}</p>
                  <div class="flex items-center mt-2">
                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="text-sm text-green-600 font-medium">+{{ getBeneficiaryGrowth() }}%</span>
                    <span class="text-xs text-gray-500 ml-1">this month</span>
                  </div>
                </div>
                <div class="bg-green-100 rounded-lg p-3">
                  <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Partners -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Partners</p>
                  <p class="text-3xl font-bold text-gray-900 mt-2">{{ dashboardData.totalPartners }}</p>
                  <div class="flex items-center mt-2">
                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="text-sm text-green-600 font-medium">+{{ getPartnerGrowth() }}%</span>
                    <span class="text-xs text-gray-500 ml-1">this month</span>
                  </div>
                </div>
                <div class="bg-blue-100 rounded-lg p-3">
                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A6.5 6.5 0 0112 18.255 6.5 6.5 0 013 13.255V12a6.5 6.5 0 0112 0v1.255zM12 15.255A4.5 4.5 0 017.5 12V8a4.5 4.5 0 119 0v4a4.5 4.5 0 01-4.5 3.255z"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h5 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h5>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
              <NuxtLink
                to="/admin/projects"
                class="bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center font-medium"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Project
              </NuxtLink>
              <NuxtLink
                to="/admin/beneficiaries"
                class="bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center font-medium"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Beneficiary
              </NuxtLink>
              <NuxtLink
                to="/admin/members"
                class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center font-medium"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Member
              </NuxtLink>
              <NuxtLink
                to="/admin/partners"
                class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center font-medium"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Partner
              </NuxtLink>
            </div>
          </div>

          <!-- Recent Activity -->
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Projects -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
              <h5 class="text-lg font-semibold text-gray-900 mb-4">Recent Projects</h5>
              <div class="space-y-3">
                <div v-for="project in dashboardData.recentProjects?.slice(0, 3)" :key="project.id" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                  <div class="flex-1">
                    <h6 class="font-medium text-gray-900">{{ project.project_name }}</h6>
                    <p class="text-sm text-gray-500">{{ formatShortDate(project.created_at) }} <span class="text-xs text-gray-400">({{ formatRelativeDate(project.created_at) }})</span></p>
                  </div>
                  <div class="flex items-center space-x-2">
                    <span :class="getStatusBadgeClass(project.status)">
                      {{ project.status }}
                    </span>
                    <span class="text-sm font-semibold text-gray-600">
                      {{ formatCurrency(project.budget, project.currency) }}
                      <span class="text-xs bg-gray-100 px-2 py-1 rounded ml-1">{{ project.currency || 'RWF' }}</span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <NuxtLink to="/admin/projects" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm flex items-center">
                  View all projects
                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </NuxtLink>
              </div>
            </div>

            <!-- Recent Beneficiaries -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
              <h5 class="text-lg font-semibold text-gray-900 mb-4">Recent Beneficiaries</h5>
              <div class="space-y-3">
                <div v-for="beneficiary in dashboardData.recentBeneficiaries?.slice(0, 3)" :key="beneficiary.id" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                  <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-semibold mr-3">
                      {{ beneficiary.name.charAt(0).toUpperCase() }}
                    </div>
                    <div>
                      <h6 class="font-medium text-gray-900">{{ beneficiary.name }}</h6>
                      <p class="text-sm text-gray-500">{{ formatDate(beneficiary.created_at) }}</p>
                    </div>
                  </div>
                  <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                </div>
              </div>
              <div class="mt-4">
                <NuxtLink to="/admin/beneficiaries" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm flex items-center">
                  View all beneficiaries
                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </NuxtLink>
              </div>
            </div>
          </div>

          <!-- Budget Summary by Currency -->
          <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h5 class="text-lg font-semibold text-gray-900 mb-4">Budget Summary by Currency</h5>
            <div v-if="Object.keys(dashboardData.budgetByCurrency || {}).length > 0" class="space-y-4">
              <div v-for="(summary, currency) in dashboardData.budgetByCurrency" :key="currency" class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                  <h6 class="text-md font-semibold text-gray-800">{{ currency }} Projects</h6>
                  <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ summary.count }} projects</span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                  <div class="text-center">
                    <p class="text-xs text-gray-600 mb-1">Total</p>
                    <p class="text-lg font-bold text-gray-900">{{ formatCurrency(summary.total, currency) }}</p>
                  </div>
                  <div class="text-center">
                    <p class="text-xs text-gray-600 mb-1">Average</p>
                    <p class="text-lg font-bold text-gray-900">{{ formatCurrency(summary.average, currency) }}</p>
                  </div>
                  <div class="text-center">
                    <p class="text-xs text-gray-600 mb-1">Minimum</p>
                    <p class="text-lg font-bold text-gray-900">{{ formatCurrency(summary.min, currency) }}</p>
                  </div>
                  <div class="text-center">
                    <p class="text-xs text-gray-600 mb-1">Maximum</p>
                    <p class="text-lg font-bold text-gray-900">{{ formatCurrency(summary.max, currency) }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div v-else class="text-center py-8 text-gray-500">
              <p>No budget data available</p>
            </div>
          </div>
        </div>

        <!-- Error State -->
        <div v-else-if="error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
          <div class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4l-4-4m4 4l-4-4m-5-4h8m-4-4v8"></path>
            </svg>
            <span>{{ error }}</span>
          </div>
        </div>
      </div>

    <!-- Add Notification Modal -->
    <div v-if="showAddNotificationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-semibold">Add New Notification</h3>
          <button @click="showAddNotificationModal = false" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        
        <form @submit.prevent="addNotification">
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
              <input
                v-model="notificationForm.title"
                type="text"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Enter notification title"
              />
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Message (Rich Text Supported)</label>
              
              <!-- Rich Text Editor Toolbar -->
              <div class="border border-gray-300 rounded-t-md bg-gray-50 p-2 flex flex-wrap gap-1">
                <button type="button" @click="formatText('bold')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200 font-bold">B</button>
                <button type="button" @click="formatText('italic')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200 italic">I</button>
                <button type="button" @click="formatText('underline')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200 underline">U</button>
                <div class="border-l mx-1"></div>
                <button type="button" @click="formatText('insertUnorderedList')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">• List</button>
                <button type="button" @click="formatText('insertOrderedList')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">1. List</button>
                <div class="border-l mx-1"></div>
                <button type="button" @click="insertText('🌍')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">🌍</button>
                <button type="button" @click="insertText('📩')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">📩</button>
                <button type="button" @click="insertText('📧')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">📧</button>
                <button type="button" @click="insertText('✅')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">✅</button>
                <button type="button" @click="insertText('💡')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">💡</button>
              </div>
              
              <!-- Rich Text Editor -->
              <div 
                ref="messageEditor"
                contenteditable="true"
                @input="updateMessage"
                class="rich-editor w-full px-3 py-2 border border-gray-300 rounded-b-md focus:outline-none focus:ring-2 focus:ring-indigo-500 min-h-[300px] max-h-[400px] overflow-y-auto"
                style="white-space: pre-wrap;"
                placeholder="Enter your message here... Rich text formatting supported!"
              ></div>
              
              <!-- Hidden input to store the HTML content -->
              <input type="hidden" v-model="notificationForm.message" required />
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
              <select
                v-model="notificationForm.type"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
              >
                <option value="info">Info</option>
                <option value="success">Success</option>
                <option value="warning">Warning</option>
                <option value="error">Error</option>
              </select>
            </div>
          </div>
          
          <div class="flex justify-end space-x-3 mt-6">
            <button
              type="button"
              @click="showAddNotificationModal = false"
              class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
            >
              Cancel
            </button>
            <button
              type="submit"
              :disabled="!notificationForm.title || !notificationForm.message || addingNotification"
              class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {{ addingNotification ? 'Adding...' : 'Add Notification' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted, computed, nextTick } from 'vue'
import { useAuthStore } from '~/stores/auth'
import Swal from 'sweetalert2'
import Notifications from '~/components/Notifications.vue'

definePageMeta({
  middleware: 'auth'
})

const authStore = useAuthStore()
const loading = ref(true)
const error = ref('')
const dashboardData = ref(null)
const currentTime = ref(new Date().toLocaleTimeString())
const showAddNotificationModal = ref(false)
const addingNotification = ref(false)
const notificationForm = ref({
  title: '',
  message: '',
  type: 'info'
})

// Rich text editor ref
const messageEditor = ref(null)

// Rich text editor functions
const formatText = (command) => {
  const selection = window.getSelection()
  if (selection.rangeCount > 0) {
    const range = selection.getRangeAt(0)
    const selectedText = range.toString()
    
    if (command === 'bold') {
      document.execCommand('bold', false, null)
    } else if (command === 'italic') {
      document.execCommand('italic', false, null)
    } else if (command === 'underline') {
      document.execCommand('underline', false, null)
    } else if (command === 'insertUnorderedList') {
      // Get current line
      const parentElement = range.startContainer.parentElement
      const textContent = parentElement.textContent || ''
      
      // Check if we're already in a list
      if (parentElement.tagName === 'LI') {
        // Remove list formatting
        const li = parentElement
        const ul = li.parentElement
        const text = li.textContent
        const p = document.createElement('p')
        p.textContent = text
        ul.replaceChild(p, li)
        
        // If UL is empty, remove it
        if (ul.children.length === 0) {
          ul.remove()
        }
      } else {
        // Add bullet point
        const bulletPoint = document.createElement('li')
        bulletPoint.textContent = selectedText || '• '
        
        if (selectedText) {
          range.deleteContents()
          range.insertNode(bulletPoint)
        } else {
          const ul = document.createElement('ul')
          ul.appendChild(bulletPoint)
          range.insertNode(ul)
        }
        
        // Move cursor to end of list item
        const newRange = document.createRange()
        newRange.selectNodeContents(bulletPoint)
        newRange.collapse(false)
        selection.removeAllRanges()
        selection.addRange(newRange)
      }
    } else if (command === 'insertOrderedList') {
      // Get current line
      const parentElement = range.startContainer.parentElement
      const textContent = parentElement.textContent || ''
      
      // Check if we're already in a numbered list
      if (parentElement.tagName === 'LI' && parentElement.parentElement.tagName === 'OL') {
        // Remove list formatting
        const li = parentElement
        const ol = li.parentElement
        const text = li.textContent
        const p = document.createElement('p')
        p.textContent = text
        ol.replaceChild(p, li)
        
        // If OL is empty, remove it
        if (ol.children.length === 0) {
          ol.remove()
        }
      } else {
        // Add numbered list
        const listItem = document.createElement('li')
        listItem.textContent = selectedText || '1. '
        
        if (selectedText) {
          range.deleteContents()
          const ol = document.createElement('ol')
          ol.appendChild(listItem)
          range.insertNode(ol)
        } else {
          const ol = document.createElement('ol')
          ol.appendChild(listItem)
          range.insertNode(ol)
        }
        
        // Move cursor to end of list item
        const newRange = document.createRange()
        newRange.selectNodeContents(listItem)
        newRange.collapse(false)
        selection.removeAllRanges()
        selection.addRange(newRange)
      }
    }
  }
  updateMessage()
  messageEditor.value?.focus()
}

const insertText = (text) => {
  const selection = window.getSelection()
  if (selection.rangeCount > 0) {
    const range = selection.getRangeAt(0)
    range.deleteContents()
    const textNode = document.createTextNode(text)
    range.insertNode(textNode)
    
    // Move cursor after inserted text
    const newRange = document.createRange()
    newRange.setStartAfter(textNode)
    newRange.collapse(true)
    selection.removeAllRanges()
    selection.addRange(newRange)
  } else {
    // Insert at the end
    const textNode = document.createTextNode(text)
    messageEditor.value.appendChild(textNode)
    
    // Move cursor to end
    const range = document.createRange()
    range.selectNodeContents(textNode)
    range.collapse(false)
    const selection = window.getSelection()
    selection.removeAllRanges()
    selection.addRange(range)
  }
  updateMessage()
  messageEditor.value?.focus()
}

const updateMessage = () => {
  if (messageEditor.value) {
    notificationForm.value.message = messageEditor.value.innerHTML
  }
}

// Computed properties
const totalProjects = computed(() => {
  return dashboardData.value?.projectStats?.reduce((total, stat) => total + stat.count, 0) || 0
})

// Methods

// Notification methods
const openAddNotificationModal = () => {
  showAddNotificationModal.value = true
  // Reset form
  notificationForm.value = {
    title: '',
    message: '',
    type: 'info'
  }
  // Initialize editor after modal is shown
  nextTick(() => {
    if (messageEditor.value) {
      messageEditor.value.innerHTML = ''
      messageEditor.value.focus()
    }
  })
}

const closeAddNotificationModal = () => {
  showAddNotificationModal.value = false
  notificationForm.value = {
    title: '',
    message: '',
    type: 'info'
  }
}

const addNotification = async () => {
  if (!notificationForm.value.title || !notificationForm.value.message) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Please fill in both title and message fields'
    })
    return
  }

  addingNotification.value = true
  
  try {
    const response = await $fetch('http://localhost:3001/api/admin/notifications', {
      method: 'POST',
      body: notificationForm.value
    })
    
    if (response.success) {
      await Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Notification added successfully',
        timer: 2000,
        showConfirmButton: false
      })
      
      closeAddNotificationModal()
      // Refresh notifications in the Notifications component
      window.dispatchEvent(new CustomEvent('refresh-notifications'))
    }
  } catch (error) {
    console.error('Add notification error:', error)
    await Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Failed to add notification'
    })
  } finally {
    addingNotification.value = false
  }
}

// Force logout function for testing
const forceLogout = async () => {
  const result = await Swal.fire({
    title: 'Force Logout?',
    text: "This will clear your authentication and redirect to login page.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, force logout',
    cancelButtonText: 'Cancel'
  })

  if (result.isConfirmed) {
    authStore.clearAuth()
    await Swal.fire({
      icon: 'success',
      title: 'Logged Out',
      text: 'Authentication cleared successfully',
      timer: 2000,
      showConfirmButton: false
    })
    await navigateTo('/admin/login')
  }
}

// Dashboard methods

const fetchDashboardData = async () => {
  try {
    loading.value = true
    error.value = ''
    
    // Try to get real data from backend
    const response = await $fetch('http://localhost:3001/api/admin/dashboard-stats')
    
    if (response.success) {
      dashboardData.value = response.data
    } else {
      throw new Error(response.message || 'Failed to load dashboard data')
    }
    
  } catch (err) {
    console.error('Dashboard data error:', err)
    error.value = 'Failed to load dashboard data. Please try again.'
    // Provide demo data for development when backend is not available
    setDemoData()
  } finally {
    loading.value = false
  }
}

const setDemoData = () => {
  console.log('Using demo data for dashboard')
  
  const projects = [
    { 
      id: 1, 
      project_name: 'Education Support Program', 
      status: 'ongoing', 
      created_at: new Date().toISOString(), 
      budget: 50000,
      currency: 'RWF'
    },
    { 
      id: 2, 
      project_name: 'Healthcare Initiative', 
      status: 'completed', 
      created_at: new Date(Date.now() - 86400000).toISOString(), 
      budget: 30000,
      currency: 'USD'
    },
    { 
      id: 3, 
      project_name: 'Community Outreach', 
      status: 'pending', 
      created_at: new Date(Date.now() - 172800000).toISOString(), 
      budget: 25000,
      currency: 'EUR'
    }
  ]
  
  // Calculate budget summary by currency
  const budgetByCurrency = {}
  
  projects.forEach(project => {
    const currency = project.currency || 'RWF'
    if (!budgetByCurrency[currency]) {
      budgetByCurrency[currency] = {
        total: 0,
        count: 0,
        min: project.budget,
        max: project.budget
      }
    }
    
    budgetByCurrency[currency].total += project.budget
    budgetByCurrency[currency].count++
    budgetByCurrency[currency].min = Math.min(budgetByCurrency[currency].min, project.budget)
    budgetByCurrency[currency].max = Math.max(budgetByCurrency[currency].max, project.budget)
  })
  
  // Calculate averages
  Object.keys(budgetByCurrency).forEach(currency => {
    budgetByCurrency[currency].average = budgetByCurrency[currency].total / budgetByCurrency[currency].count
  })
  
  dashboardData.value = {
    projectStats: [
      { status: 'ongoing', count: 5 },
      { status: 'completed', count: 3 },
      { status: 'pending', count: 2 }
    ],
    totalBeneficiaries: 150,
    totalMembers: 25,
    totalUsers: 8,
    totalPartners: 12,
    totalDonations: 89,
    totalDonationAmount: 15000,
    recentProjects: projects,
    recentBeneficiaries: [
      { 
        id: 1, 
        name: 'John Doe', 
        created_at: new Date().toISOString() 
      },
      { 
        id: 2, 
        name: 'Jane Smith', 
        created_at: new Date(Date.now() - 86400000).toISOString() 
      },
      { 
        id: 3, 
        name: 'Robert Johnson', 
        created_at: new Date(Date.now() - 172800000).toISOString() 
      }
    ],
    partnerTypes: [
      { partnership_type: 'funding', count: 5 },
      { partnership_type: 'implementation', count: 4 },
      { partnership_type: 'technical', count: 3 }
    ],
    donationTrends: [
      { month: '2024-08', count: 15, total_amount: 2500 },
      { month: '2024-09', count: 20, total_amount: 3200 },
      { month: '2024-10', count: 18, total_amount: 2800 }
    ],
    budgetSummary: {
      total_budget: 150000,
      avg_budget: 30000,
      min_budget: 10000,
      max_budget: 80000
    },
    budgetByCurrency,
    totalPublications: 8
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
  console.log('Dashboard - Date string:', dateString)
  console.log('Dashboard - Parsed date:', date)
  console.log('Dashboard - Current time:', now)
  console.log('Dashboard - Date time:', date.getTime())
  console.log('Dashboard - Current time:', now.getTime())
  
  // Check if date is valid
  if (isNaN(date.getTime())) return 'Invalid date'
  
  // Calculate difference without absolute value
  const diffTime = now - date
  const diffDays = Math.floor(Math.abs(diffTime) / (1000 * 60 * 60 * 24))
  
  console.log('Dashboard - Time difference (ms):', diffTime)
  console.log('Dashboard - Days difference:', diffDays)
  console.log('Dashboard - Is past date:', diffTime > 0)
  
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
    const years = Math.floor(diffTime / 31536000000)
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
  const baseClass = 'px-2 py-1 rounded-full text-xs font-semibold '
  switch (status?.toLowerCase()) {
    case 'ongoing':
      return baseClass + 'bg-green-100 text-green-800'
    case 'pending':
      return baseClass + 'bg-yellow-100 text-yellow-800'
    case 'completed':
      return baseClass + 'bg-blue-100 text-blue-800'
    default:
      return baseClass + 'bg-gray-100 text-gray-800'
  }
}

// Mock growth calculations (in real app, these would come from API)
const getProjectGrowth = () => Math.floor(Math.random() * 20) + 5
const getBeneficiaryGrowth = () => Math.floor(Math.random() * 15) + 8
const getPartnerGrowth = () => Math.floor(Math.random() * 10) + 3
const getUserGrowth = () => Math.floor(Math.random() * 12) + 4
const getMemberGrowth = () => Math.floor(Math.random() * 8) + 2

// Update current time every second
const updateCurrentTime = () => {
  currentTime.value = new Date().toLocaleTimeString()
}

// Initialize
onMounted(() => {
  fetchDashboardData()
  setInterval(updateCurrentTime, 1000)
})
</script>

<style scoped>
/* Simple and clean animations */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.fade-in {
  animation: fadeIn 0.3s ease-out;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

/* Rich Text Editor Styles */
.rich-editor ul {
  list-style-type: disc;
  margin-left: 20px;
  margin-bottom: 10px;
}

.rich-editor ol {
  list-style-type: decimal;
  margin-left: 20px;
  margin-bottom: 10px;
}

.rich-editor li {
  margin-bottom: 5px;
  line-height: 1.5;
}

.rich-editor p {
  margin-bottom: 10px;
  line-height: 1.5;
}

::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}
</style>
