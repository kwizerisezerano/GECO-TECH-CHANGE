export default defineNuxtPlugin((nuxtApp) => {
  // Handle hash navigation with smooth scrolling
  nuxtApp.hook('page:finish', () => {
    const hash = window.location.hash
    if (hash) {
      setTimeout(() => {
        const targetElement = document.getElementById(hash.substring(1))
        if (targetElement) {
          targetElement.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          })
        }
      }, 100)
    }
  })

  // Handle click events on anchor links
  nuxtApp.hook('vue:setup', () => {
    nuxtApp.$router.options.scrollBehavior = (to, from, savedPosition) => {
      if (to.hash) {
        return {
          el: to.hash,
          behavior: 'smooth'
        }
      } else if (savedPosition) {
        return savedPosition
      } else {
        return { top: 0 }
      }
    }
  })
})
