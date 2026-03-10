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
.page-section {
  padding: 80px 0;
  background: var(--gray-50);
  transition: background-color 0.3s ease;
}

.upload-container {
  max-width: 500px;
  margin: 100px auto;
  padding: 40px 30px;
  background: var(--surface-color);
  border-radius: 15px;
  box-shadow: var(--shadow-lg);
  border: 1px solid rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.upload-container:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.upload-container h3 {
  color: var(--primary-color);
  font-weight: 700;
  margin-bottom: 30px;
  font-size: 1.8rem;
  text-align: center;
  transition: color 0.3s ease;
}

.form-group {
  margin-bottom: 25px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: var(--gray-800);
  font-size: 0.95rem;
  transition: color 0.3s ease;
}

.form-control {
  width: 100%;
  padding: 14px 16px;
  border: 2px solid var(--gray-200);
  border-radius: 8px;
  font-size: 16px;
  transition: all 0.3s ease;
  background: var(--surface-color);
  color: var(--gray-800);
}

.form-control:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
  background: var(--surface-color);
}

.form-control::placeholder {
  color: var(--gray-400);
}

.btn-upload {
  width: 100%;
  padding: 14px 24px;
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  box-shadow: 0 4px 15px rgba(168, 85, 247, 0.3);
}

.btn-upload:hover:not(:disabled) {
  background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(168, 85, 247, 0.4);
}

.btn-upload:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none;
}

/* Dark mode adjustments */
@media (prefers-color-scheme: dark) {
  .page-section {
    background: var(--gray-50);
  }
  
  .upload-container {
    background: var(--surface-color);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  }
  
  .upload-container:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  }
  
  .upload-container h3 {
    color: var(--primary-color);
  }
  
  .form-group label {
    color: var(--gray-200);
  }
  
  .form-control {
    background: var(--surface-color);
    border-color: rgba(255, 255, 255, 0.1);
    color: var(--gray-200);
  }
  
  .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.2);
  }
  
  .form-control::placeholder {
    color: var(--gray-500);
  }
  
  .btn-upload:hover:not(:disabled) {
    box-shadow: 0 8px 25px rgba(168, 85, 247, 0.5);
  }
}

[data-theme="dark"] .page-section {
  background: var(--gray-50);
}

[data-theme="dark"] .upload-container {
  background: var(--surface-color);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .upload-container:hover {
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}

[data-theme="dark"] .upload-container h3 {
  color: var(--primary-color);
}

[data-theme="dark"] .form-group label {
  color: var(--gray-200);
}

[data-theme="dark"] .form-control {
  background: var(--surface-color);
  border-color: rgba(255, 255, 255, 0.1);
  color: var(--gray-200);
}

[data-theme="dark"] .form-control:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.2);
}

[data-theme="dark"] .form-control::placeholder {
  color: var(--gray-500);
}

[data-theme="dark"] .btn-upload:hover:not(:disabled) {
  box-shadow: 0 8px 25px rgba(168, 85, 247, 0.5);
}

/* Responsive Design */
@media (max-width: 768px) {
  .upload-container {
    margin: 50px 20px;
    padding: 30px 20px;
  }
  
  .upload-container h3 {
    font-size: 1.5rem;
  }
  
  .form-control {
    padding: 12px 14px;
    font-size: 15px;
  }
  
  .btn-upload {
    padding: 12px 20px;
    font-size: 15px;
  }
}
</style>
