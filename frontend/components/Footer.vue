<template>
  <footer id="footer" class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-main">
          <div class="footer-brand">
            <div class="footer-logo">
              <h3 class="footer-title">GECO RWANDA</h3>
            </div>
            <p class="footer-description">
              Leading Rwanda's fight against epilepsy through comprehensive care, 
              community education, and advocacy since 2010.
            </p>
            <div class="footer-social">
              <a href="https://web.facebook.com/search/top?q=GECO%20RWANDA" target="_blank" class="social-link">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                </svg>
              </a>
              <a href="https://x.com/geco_rwanda" target="_blank" class="social-link">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.86-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633 3.982-4.633h1.54L8.81 5.896l3.94 5.354h-2.54l-2.93-3.814L3.34 15.25H.897l5.39-6.282L0 .75h5.063l3.219 4.228L3.34 15.25h2.54l2.93-3.814 3.38 4.228h2.54zm-2.618 13.095h1.339L3.492 2.25H2.098l7.884 11.595z"/>
                </svg>
              </a>
              <a href="https://www.instagram.com/gecorwanda/" target="_blank" class="social-link">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                  <rect x="2" y="2" width="12" height="12" rx="3"/>
                  <circle cx="8" cy="8" r="3"/>
                  <circle cx="12" cy="4" r="1"/>
                </svg>
              </a>
              <a href="#" class="social-link">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.518v7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C2.4 3.934 1.9 4.478 1.9 5.234c0 .694.521 1.248 1.342 1.248h.016zm4.908 8.212V9.35c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.838h2.425V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.139 1.679h.037v-.767H6.325c.04.678 0 7.225 0 7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C5.4 3.934 4.8 4.478 4.8 5.234c0 .694.521 1.248 1.342 1.248h.016z"/>
                </svg>
              </a>
            </div>
          </div>

          <div class="footer-section">
            <h4>Quick Links</h4>
            <ul class="footer-links">
              <li><a href="#about">About Us</a></li>
              <li><a href="#services">Our Services</a></li>
              <li><a href="#stats">Our Impact</a></li>
              <li><a href="#portfolio">Success Stories</a></li>
              <li><a href="#contact">Contact Us</a></li>
            </ul>
          </div>

          <div class="footer-section">
            <h4>Get Involved</h4>
            <ul class="footer-links">
              <!-- <li><a href="#call-to-action">Donate</a></li> -->
              <li><a href="#contact">Volunteer</a></li>
              <li><a href="#contact">Partner With Us</a></li>
              <li><a href="#contact">Get Help</a></li>
              <li><a href="#contact">Report a Case</a></li>
            </ul>
          </div>

          <div class="footer-section">
            <h4>Newsletter</h4>
            <p class="newsletter-text">Stay updated with our latest news and events.</p>
            <form class="newsletter-form">
              <input type="email" placeholder="Your email" class="newsletter-input">
              <button type="submit" class="newsletter-btn">Subscribe</button>
            </form>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <div class="footer-bottom-content">
          <p>&copy; {{ currentYear }} GECO RWANDA. All rights reserved.</p>
          <div class="footer-bottom-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Cookie Policy</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { ref } from 'vue'

const currentYear = new Date().getFullYear()

const subscribeNewsletter = (event) => {
  const email = event.target.querySelector('input[type="email"]').value
  // Handle newsletter subscription
  console.log('Newsletter subscription:', email)
  // You can add actual subscription logic here
  alert('Thank you for subscribing to our newsletter!')
  event.target.reset()
}
</script>

<style scoped>
/* Modern Professional Footer Styles */
.footer {
  background: var(--gray-900);
  color: var(--gray-300);
  padding: var(--space-20) 0 0;
  position: relative;
  overflow: hidden;
}

.footer::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: var(--gradient-primary);
}

.footer-content {
  margin-bottom: var(--space-12);
}

.footer-main {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1.5fr;
  gap: var(--space-12);
  align-items: start;
}

.footer-brand {
  max-width: 400px;
}

.footer-logo {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  margin-bottom: var(--space-4);
}

.footer-logo-image {
  height: 48px;
  width: auto;
  filter: brightness(0) invert(1);
}

.footer-title {
  font-size: 1.5rem;
  font-weight: 800;
  color: white;
  margin: 0;
  background: var(--gradient-primary);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.footer-description {
  font-size: 1rem;
  line-height: 1.6;
  color: var(--gray-400);
  margin-bottom: var(--space-6);
}

.footer-contact {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.contact-item {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  color: var(--gray-400);
  font-size: 0.95rem;
}

.contact-item i {
  color: var(--accent-500);
  font-size: 1.1rem;
  flex-shrink: 0;
}

.footer-links h4 {
  font-size: 1.125rem;
  font-weight: 700;
  color: white;
  margin-bottom: var(--space-4);
}

.footer-links ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-links li {
  margin-bottom: var(--space-3);
}

.footer-links a {
  color: var(--gray-400);
  text-decoration: none;
  font-size: 0.95rem;
  transition: all var(--transition);
  display: inline-flex;
  align-items: center;
}

.footer-links a:hover {
  color: var(--accent-400);
  transform: translateX(4px);
}

.footer-newsletter h4 {
  font-size: 1.125rem;
  font-weight: 700;
  color: white;
  margin-bottom: var(--space-3);
}

.footer-newsletter p {
  color: var(--gray-400);
  font-size: 0.95rem;
  margin-bottom: var(--space-4);
}

.newsletter-form {
  display: flex;
  gap: var(--space-2);
  margin-bottom: var(--space-6);
}

.newsletter-input {
  flex: 1;
  padding: var(--space-3) var(--space-4);
  border: 1px solid var(--gray-700);
  border-radius: var(--radius-lg);
  background: var(--gray-800);
  color: white;
  font-size: 0.95rem;
  transition: all var(--transition);
}

.newsletter-input:focus {
  outline: none;
  border-color: var(--accent-500);
  box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
}

.newsletter-input::placeholder {
  color: var(--gray-500);
}

.social-links {
  display: flex;
  gap: var(--space-3);
}

.social-link {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  background: var(--gray-800);
  border: 1px solid var(--gray-700);
  border-radius: var(--radius-lg);
  color: var(--gray-400);
  text-decoration: none;
  transition: all var(--transition);
}

.social-link:hover {
  background: var(--accent-600);
  border-color: var(--accent-600);
  color: white;
  transform: translateY(-2px);
}

.footer-bottom {
  border-top: 1px solid var(--gray-800);
  padding: var(--space-6) 0;
}

.footer-bottom-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: var(--space-4);
}

.footer-bottom p {
  color: var(--gray-500);
  font-size: 0.875rem;
  margin: 0;
}

.footer-bottom-links {
  display: flex;
  gap: var(--space-6);
}

.footer-bottom-links a {
  color: var(--gray-500);
  text-decoration: none;
  font-size: 0.875rem;
  transition: color var(--transition);
}

.footer-bottom-links a:hover {
  color: var(--accent-400);
}

/* Responsive Design */
@media (max-width: 1024px) {
  .footer-main {
    grid-template-columns: 1fr 1fr;
    gap: var(--space-8);
  }
  
  .footer-brand {
    grid-column: 1 / -1;
    max-width: none;
  }
}

@media (max-width: 768px) {
  .footer {
    padding: var(--space-16) 0 0;
  }
  
  .footer-main {
    grid-template-columns: 1fr;
    gap: var(--space-8);
  }
  
  .footer-brand {
    grid-column: 1;
  }
  
  .newsletter-form {
    flex-direction: column;
  }
  
  .footer-bottom-content {
    flex-direction: column;
    text-align: center;
    gap: var(--space-2);
  }
  
  .footer-bottom-links {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .footer-logo {
    flex-direction: column;
    text-align: center;
    gap: var(--space-2);
  }
  
  .footer-logo-image {
    height: 40px;
  }
  
  .footer-title {
    font-size: 1.25rem;
  }
  
  .social-links {
    justify-content: center;
  }
}
</style>
