<template>
  <div>
    <NuxtPage />
  </div>
</template>

<script setup>
// Global head configuration
useHead({
  title: 'GECO RWANDA - Global Epilepsy Connection',
  meta: [
    { name: 'description', content: 'Global Epilepsy Connection (GECO) is a Rwandan NGO working to support people with epilepsy and mental health conditions through healthcare, empowerment, and advocacy.' },
    { name: 'keywords', content: 'epilepsy, mental health, Rwanda, NGO, healthcare, advocacy, support' },
    { name: 'viewport', content: 'width=device-width, initial-scale=1.0' }
  ],
  link: [
    { rel: 'icon', type: 'image/png', href: '/assets/img/logo.png' },
    { rel: 'apple-touch-icon', href: '/assets/img/logo.png' },
    { rel: 'preconnect', href: 'https://fonts.googleapis.com' },
    { rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: true },
    { 
      rel: 'stylesheet', 
      href: 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap' 
    },
    {
      rel: 'stylesheet',
      href: 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css'
    }
  ]
})
</script>
