<template>
  <div></div>
</template>

<script setup>
// Redirect to dashboard when accessing /admin
definePageMeta({
  middleware: 'auth'
})

onMounted(() => {
  navigateTo('/admin/dashboard')
})
</script>
