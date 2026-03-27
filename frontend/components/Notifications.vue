<template>
  <div class="relative">
    <!-- Notification Bell -->
    <button
      @click="toggleNotifications"
      class="relative p-2 text-gray-600 hover:text-gray-900 rounded-lg"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
      </svg>
      
      <!-- Unread count badge -->
      <span
        v-if="unreadCount > 0"
        class="absolute top-1 right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full transform translate-x-1/2 -translate-y-1/2"
      >
        {{ unreadCount > 99 ? '99+' : unreadCount }}
      </span>
    </button>

    <!-- Notifications Dropdown -->
    <div
      v-if="showNotifications"
      class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50 max-h-96 overflow-hidden"
    >
      <div class="p-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
          <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
          <button
            @click="markAllAsRead"
            v-if="unreadCount > 0"
            class="text-sm text-indigo-600 hover:text-indigo-800 font-medium"
          >
            Mark all as read
          </button>
        </div>
      </div>

      <div class="overflow-y-auto max-h-80">
        <!-- Loading State -->
        <div v-if="loading" class="p-4 text-center text-gray-500">
          <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-indigo-600 mx-auto mb-2"></div>
          Loading notifications...
        </div>

        <!-- Empty State -->
        <div v-else-if="notifications.length === 0" class="p-4 text-center text-gray-500">
          <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
          </svg>
          No notifications
        </div>

        <!-- Notifications List -->
        <div v-else class="divide-y divide-gray-100">
          <div
            v-for="notification in notifications"
            :key="notification.id"
            class="p-4 hover:bg-gray-50 transition-colors duration-150"
            :class="{ 'bg-blue-50': !notification.is_read }"
          >
            <div class="flex items-start">
              <!-- Notification Icon -->
              <div class="flex-shrink-0 mr-3">
                <div
                  class="w-8 h-8 rounded-full flex items-center justify-center"
                  :class="getNotificationIconClass(notification.type)"
                >
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path :d="getNotificationIconPath(notification.type)"></path>
                  </svg>
                </div>
              </div>

              <!-- Notification Content -->
              <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between">
                  <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">
                      {{ notification.title }}
                    </p>
                    <p class="text-sm text-gray-600 mt-1" v-html="notification.message"></p>
                    <p class="text-xs text-gray-500 mt-1">
                      {{ formatTime(notification.created_at) }}
                    </p>
                  </div>
                  <div class="flex items-center ml-2">
                    <!-- Unread indicator -->
                    <div
                      v-if="!notification.is_read"
                      class="w-2 h-2 bg-blue-600 rounded-full mr-2"
                    ></div>
                    <!-- Actions -->
                    <div class="flex space-x-1">
                      <button
                        v-if="!notification.is_read"
                        @click="markAsRead(notification.id)"
                        class="text-gray-400 hover:text-indigo-600 transition-colors"
                        title="Mark as read"
                      >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                      </button>
                      <button
                        @click="editNotification(notification)"
                        class="text-gray-400 hover:text-blue-600 transition-colors"
                        title="Edit"
                      >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                      </button>
                      <button
                        @click="deleteNotification(notification.id)"
                        class="text-gray-400 hover:text-red-600 transition-colors"
                        title="Delete"
                      >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div v-if="notifications.length > 0" class="p-3 border-t border-gray-200 bg-gray-50">
        <button
          @click="clearAll"
          class="w-full text-sm text-red-600 hover:text-red-800 font-medium"
        >
          Clear all notifications
        </button>
      </div>
    </div>

    <!-- Edit Notification Modal -->
    <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-semibold">Edit Notification</h3>
          <button @click="closeEditModal" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        
        <form @submit.prevent="updateNotification">
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
              <input
                v-model="editForm.title"
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
                <button type="button" @click="formatEditText('bold')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200 font-bold">B</button>
                <button type="button" @click="formatEditText('italic')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200 italic">I</button>
                <button type="button" @click="formatEditText('underline')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200 underline">U</button>
                <div class="border-l mx-1"></div>
                <button type="button" @click="formatEditText('insertUnorderedList')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">• List</button>
                <button type="button" @click="formatEditText('insertOrderedList')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">1. List</button>
                <div class="border-l mx-1"></div>
                <button type="button" @click="insertEditText('🌍')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">🌍</button>
                <button type="button" @click="insertEditText('📩')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">📩</button>
                <button type="button" @click="insertEditText('📧')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">📧</button>
                <button type="button" @click="insertEditText('✅')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">✅</button>
                <button type="button" @click="insertEditText('💡')" class="px-2 py-1 text-sm border rounded hover:bg-gray-200">💡</button>
              </div>
              
              <!-- Rich Text Editor -->
              <div 
                ref="editMessageEditor"
                contenteditable="true"
                @input="updateEditMessage"
                class="rich-editor w-full px-3 py-2 border border-gray-300 rounded-b-md focus:outline-none focus:ring-2 focus:ring-indigo-500 min-h-[300px] max-h-[400px] overflow-y-auto"
                style="white-space: pre-wrap;"
                placeholder="Enter your message here... Rich text formatting supported!"
              ></div>
              
              <!-- Hidden input to store the HTML content -->
              <input type="hidden" v-model="editForm.message" required />
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
              <select
                v-model="editForm.type"
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
              @click="closeEditModal"
              class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
            >
              Cancel
            </button>
            <button
              type="submit"
              :disabled="!editForm.title || !editForm.message || updating"
              class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {{ updating ? 'Updating...' : 'Update Notification' }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Overlay for mobile -->
    <div
      v-if="showNotifications"
      class="fixed inset-0 z-40"
      @click="toggleNotifications"
    ></div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, nextTick } from 'vue'
import Swal from 'sweetalert2'

const showNotifications = ref(false)
const notifications = ref([])
const unreadCount = ref(0)
const loading = ref(true)
let pollInterval = null

// Edit notification variables
const showEditModal = ref(false)
const updating = ref(false)
const editingNotificationId = ref(null)
const editForm = ref({
  title: '',
  message: '',
  type: 'info'
})
const editMessageEditor = ref(null)

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value
}

const fetchNotifications = async () => {
  try {
    const config = useRuntimeConfig()
    const response = await $fetch(`${config.public.apiBase}/admin/notifications`)
    if (response.success) {
      notifications.value = response.data
      // Count unread notifications
      unreadCount.value = notifications.value.filter(n => !n.is_read).length
    }
  } catch (error) {
    console.error('Error fetching notifications:', error)
    // Fallback: don't show notifications if backend is not accessible
    notifications.value = []
    unreadCount.value = 0
  } finally {
    loading.value = false
  }
}

const fetchUnreadCount = async () => {
  try {
    const config = useRuntimeConfig()
    const response = await $fetch(`${config.public.apiBase}/admin/notifications/unread/count`)
    if (response.success) {
      unreadCount.value = response.data.unread_count
    }
  } catch (error) {
    console.error('Error fetching unread count:', error)
    // Fallback: set to 0 if backend is not accessible
    unreadCount.value = 0
  }
}

const markAsRead = async (id) => {
  try {
    const config = useRuntimeConfig()
    const response = await $fetch(`${config.public.apiBase}/admin/notifications/${id}/read`, {
      method: 'PUT'
    })
    if (response.success) {
      // Update local state
      const notification = notifications.value.find(n => n.id === id)
      if (notification) {
        notification.is_read = true
        unreadCount.value--
      }
    }
  } catch (error) {
    console.error('Error marking notification as read:', error)
  }
}

const markAllAsRead = async () => {
  try {
    // Mark all unread notifications as read
    const unreadNotifications = notifications.value.filter(n => !n.is_read)
    await Promise.all(
      unreadNotifications.map(n => markAsRead(n.id))
    )
  } catch (error) {
    console.error('Error marking all notifications as read:', error)
  }
}

const deleteNotification = async (id) => {
  try {
    const config = useRuntimeConfig()
    const response = await $fetch(`${config.public.apiBase}/admin/notifications/${id}`, {
      method: 'DELETE'
    })
    if (response.success) {
      // Update local state
      const notification = notifications.value.find(n => n.id === id)
      if (notification) {
        if (!notification.is_read) {
          unreadCount.value--
        }
        notifications.value = notifications.value.filter(n => n.id !== id)
      }
    }
  } catch (error) {
    console.error('Error deleting notification:', error)
  }
}

const clearAll = async () => {
  try {
    await Promise.all(
      notifications.value.map(n => deleteNotification(n.id))
    )
  } catch (error) {
    console.error('Error clearing all notifications:', error)
  }
}

// Edit notification functions
const editNotification = (notification) => {
  editingNotificationId.value = notification.id
  editForm.value = {
    title: notification.title,
    message: notification.message,
    type: notification.type
  }
  showEditModal.value = true
  
  // Initialize editor after modal is shown
  nextTick(() => {
    if (editMessageEditor.value) {
      editMessageEditor.value.innerHTML = notification.message
      editMessageEditor.value.focus()
    }
  })
}

const closeEditModal = () => {
  showEditModal.value = false
  editingNotificationId.value = null
  editForm.value = {
    title: '',
    message: '',
    type: 'info'
  }
}

const formatEditText = (command) => {
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
  updateEditMessage()
  editMessageEditor.value?.focus()
}

const insertEditText = (text) => {
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
    editMessageEditor.value.appendChild(textNode)
    
    // Move cursor to end
    const range = document.createRange()
    range.selectNodeContents(textNode)
    range.collapse(false)
    const selection = window.getSelection()
    selection.removeAllRanges()
    selection.addRange(range)
  }
  updateEditMessage()
  editMessageEditor.value?.focus()
}

const updateEditMessage = () => {
  if (editMessageEditor.value) {
    editForm.value.message = editMessageEditor.value.innerHTML
  }
}

const updateNotification = async () => {
  if (!editForm.value.title || !editForm.value.message) {
    await Swal.fire({
      icon: 'error',
      title: 'Validation Error',
      text: 'Please fill in both title and message fields'
    })
    return
  }

  updating.value = true
  
  try {
    const config = useRuntimeConfig()
    const response = await $fetch(`${config.public.apiBase}/admin/notifications/${editingNotificationId.value}`, {
      method: 'PUT',
      body: editForm.value
    })
    
    if (response.success) {
      await Swal.fire({
        icon: 'success',
        title: '✅ Updated!',
        text: 'Notification updated successfully!',
        timer: 2000,
        showConfirmButton: false
      })
      await fetchNotifications()
      closeEditModal()
    }
  } catch (error) {
    console.error('Update notification error:', error)
    await Swal.fire({
      icon: 'error',
      title: '❌ Error',
      text: 'Failed to update notification'
    })
  } finally {
    updating.value = false
  }
}

const getNotificationIconClass = (type) => {
  const classes = {
    success: 'bg-green-100 text-green-600',
    error: 'bg-red-100 text-red-600',
    warning: 'bg-yellow-100 text-yellow-600',
    info: 'bg-blue-100 text-blue-600'
  }
  return classes[type] || classes.info
}

const getNotificationIconPath = (type) => {
  const paths = {
    success: 'M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z',
    error: 'M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z',
    warning: 'M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z',
    info: 'M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z'
  }
  return paths[type] || paths.info
}

const formatTime = (dateString) => {
  const date = new Date(dateString)
  const now = new Date()
  const diffInMinutes = Math.floor((now - date) / (1000 * 60))
  
  if (diffInMinutes < 1) {
    return 'Just now'
  } else if (diffInMinutes < 60) {
    return `${diffInMinutes} minute${diffInMinutes > 1 ? 's' : ''} ago`
  } else if (diffInMinutes < 1440) {
    const hours = Math.floor(diffInMinutes / 60)
    return `${hours} hour${hours > 1 ? 's' : ''} ago`
  } else {
    return date.toLocaleDateString()
  }
}

onMounted(() => {
  fetchNotifications()
  // Poll for new notifications every 30 seconds
  pollInterval = setInterval(fetchUnreadCount, 30000)
  
  // Listen for refresh events from other components
  window.addEventListener('refresh-notifications', fetchNotifications)
})

onUnmounted(() => {
  if (pollInterval) {
    clearInterval(pollInterval)
  }
  // Remove event listener
  window.removeEventListener('refresh-notifications', fetchNotifications)
})
</script>
