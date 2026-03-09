<template>
  <div class="donate-page">
    <Header />
    
    <main class="main">
      <section class="page-section">
        <div class="container">
          <div class="upload-container">
            <h3>Make a Donation</h3>
            <form @submit.prevent="handleDonation">
              <div class="form-group">
                <label for="name">Full Name</label>
                <input 
                  type="text" 
                  id="name" 
                  v-model="donation.name" 
                  class="form-control" 
                  required 
                />
              </div>

              <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                  type="email" 
                  id="email" 
                  v-model="donation.email" 
                  class="form-control" 
                  required 
                />
              </div>

              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input 
                  type="tel" 
                  id="phone" 
                  v-model="donation.phone" 
                  class="form-control" 
                  required 
                />
              </div>

              <div class="form-group">
                <label for="amount">Donation Amount (RWF)</label>
                <input 
                  type="number" 
                  id="amount" 
                  v-model="donation.amount" 
                  class="form-control" 
                  min="1000" 
                  required 
                />
              </div>

              <button type="submit" class="btn-upload" :disabled="isSubmitting">
                {{ isSubmitting ? 'Processing...' : 'Donate Now' }}
              </button>
            </form>
          </div>
        </div>
      </section>
    </main>

    <Footer />
  </div>
</template>

<script setup>
import { ref } from 'vue'

const donation = ref({
  name: '',
  email: '',
  phone: '',
  amount: ''
})

const isSubmitting = ref(false)

const handleDonation = async () => {
  isSubmitting.value = true
  
  try {
    const response = await $fetch('/api/donation', {
      method: 'POST',
      body: donation.value
    })
    
    if (response.success) {
      // Show success message
      alert('Thank you for your donation! We will contact you soon.')
      // Reset form
      donation.value = {
        name: '',
        email: '',
        phone: '',
        amount: ''
      }
    }
  } catch (error) {
    console.error('Donation failed:', error)
    alert('Sorry, there was an error processing your donation. Please try again.')
  } finally {
    isSubmitting.value = false
  }
}
</script>

<style scoped>
.upload-container {
  max-width: 500px;
  margin: 100px auto;
  padding: 10px 30px;
  background: #f8f9fa;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.upload-container h3 {
  color: rgb(161, 83, 164);
  font-weight: 700;
  margin-bottom: 2px;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: 600;
  color: #333;
}

.form-control {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
  transition: border-color 0.3s;
}

.form-control:focus {
  outline: none;
  border-color: rgb(161, 83, 164);
  box-shadow: 0 0 0 2px rgba(161, 83, 164, 0.2);
}

.btn-upload {
  width: 100%;
  padding: 12px;
  background: rgb(161, 83, 164);
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn-upload:hover:not(:disabled) {
  background: rgb(141, 63, 144);
}

.btn-upload:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.page-section {
  padding: 80px 0;
}
</style>
