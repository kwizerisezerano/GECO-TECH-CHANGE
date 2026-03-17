<template>
  <div class="relative">
    <!-- Notification Bell -->
    <button
      @click="toggleNotifications"
      class="relative p-2 text-white hover:text-gray-200 rounded-lg"
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
                    <!-- Mark as read button -->
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
import { ref, onMounted, onUnmounted } from 'vue'

const showNotifications = ref(false)
const notifications = ref([])
const unreadCount = ref(0)
const loading = ref(true)
let pollInterval = null

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value
}

const fetchNotifications = async () => {
  try {
    const response = await $fetch('http://localhost:3001/api/admin/notifications')
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
    const response = await $fetch('http://localhost:3001/api/admin/notifications/unread/count')
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
    const response = await $fetch(`http://localhost:3001/api/admin/notifications/${id}/read`, {
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

const getNotificationIconClass = (type) => {
  const classes = {
    success: 'bg-violet-100 text-violet-600',
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
})

onUnmounted(() => {
  if (pollInterval) {
    clearInterval(pollInterval)
  }
})
</script>
