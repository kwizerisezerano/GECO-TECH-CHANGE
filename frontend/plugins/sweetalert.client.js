import Swal from 'sweetalert2'

export default defineNuxtPlugin(() => {
  // Make Swal available globally
  window.Swal = Swal
  
  // Return the plugin
  return {
    provide: {
      swal: Swal
    }
  }
})
