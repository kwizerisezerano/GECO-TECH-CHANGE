<template>
  <header id="header" class="header">
      <div class="header-content">
        <NuxtLink to="/" class="logo">
          <img src="/assets/img/logo.png" alt="GECO RWANDA Logo" class="logo-image" />
        </NuxtLink>

        <nav class="nav" :class="{ active: isMobileMenuOpen }">
          <ul class="nav-list">
            <li><a href="#hero" class="nav-link">Home</a></li>
            <li><a href="#about" class="nav-link">About</a></li>
            <li><a href="#services" class="nav-link">Services</a></li>
            <li><a href="#stats" class="nav-link">Impact</a></li>
            <li><a href="#portfolio" class="nav-link">Stories</a></li>
            <li><a href="#contact" class="nav-link">Contact</a></li>
          </ul>
        </nav>

        <div class="header-actions">
          <button class="mobile-nav-toggle" :class="{ active: isMobileMenuOpen }" @click="toggleMobileMenu">
            <span class="hamburger"></span>
          </button>
        </div>
      </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const isMobileMenuOpen = ref(false)
const activeSection = ref('hero')

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
}

const closeMobileMenu = () => {
  isMobileMenuOpen.value = false
}

const updateActiveSection = () => {
  const sections = ['hero', 'about', 'services', 'portfolio', 'stats', 'contact']
  const scrollPosition = window.scrollY + 100

  for (const section of sections) {
    const element = document.getElementById(section)
    if (element) {
      const { offsetTop, offsetHeight } = element
      if (scrollPosition >= offsetTop && scrollPosition < offsetTop + offsetHeight) {
        activeSection.value = section
        break
      }
    }
  }
}

const handleScroll = () => {
  updateActiveSection()
  
  // Add header background on scroll
  const header = document.getElementById('header')
  if (window.scrollY > 50) {
    header.classList.add('scrolled')
  } else {
    header.classList.remove('scrolled')
  }
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
  updateActiveSection()
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
/* Modern Professional Header Styles */
.header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  transition: all var(--transition);
  background: #581c87;
  box-shadow: none;
  border: none;
}

.header.scrolled {
  background: #581c87;
  box-shadow: none;
  border: none;
}

.header-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 var(--space-4) 0 0;
  max-width: 100%;
  margin: 0;
  height: 70px;
}

.logo {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  text-decoration: none;
  transition: all var(--transition);
  flex-shrink: 0;
  padding: 0;
  margin: 0;
  margin-left: 0;
  background: transparent;
  border: none !important;
  border-radius: 0;
  outline: none !important;
  height: 100%;
}

.logo-image {
  height: 100%;
  width: auto;
  transition: all var(--transition);
  display: block;
  object-fit: contain;
  max-width: 200px;
  vertical-align: middle;
  background: transparent !important;
  border: none !important;
  border-radius: 0 !important;
  padding: 0 !important;
  margin: 0 !important;
}

.logo-text {
  font-size: 1.5rem;
  font-weight: 700;
  color: white;
  letter-spacing: -0.025em;
  margin: 0;
  padding: 0;
  line-height: 1;
  background: transparent;
  text-shadow: none;
}

.logo:hover .logo-image {
  transform: scale(1.05);
}

.logo:hover .logo-text {
  color: #f3e8ff;
}

.nav {
  display: flex;
  align-items: center;
  flex-shrink: 0;
  margin-left: auto;
  height: 100%;
}

.nav-list {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: var(--space-2);
  height: 100%;
  align-items: center;
}

.nav-link {
  display: block;
  padding: var(--space-3) var(--space-4);
  color: white;
  text-decoration: none;
  font-weight: 600;
  font-family: var(--font-display);
  background: transparent !important;
  border-radius: 0;
  transition: none;
  position: relative;
  font-size: 0.95rem;
  white-space: nowrap;
}

.nav-link:hover {
  background: rgba(255, 255, 255, 0.1);
  color: #f3e8ff;
  transform: none;
}

.nav-link.active {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  box-shadow: none;
}

.header-actions {
  display: flex;
  align-items: center;
  gap: var(--space-4);
  flex-shrink: 0;
}

.btn-sm {
  padding: var(--space-2) var(--space-4);
  font-size: 0.875rem;
  font-weight: 600;
}

.btn-primary {
  background: white !important;
  color: var(--primary-dark) !important;
  border: 1px solid white !important;
  border-radius: 6px !important;
  text-decoration: none;
  transition: all var(--transition);
  font-weight: 600;
}

.btn-primary:hover {
  background: rgba(255, 255, 255, 0.9) !important;
  color: var(--primary-dark) !important;
  border-color: white !important;
  transform: translateY(-1px);
}

.mobile-nav-toggle {
  display: none;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 44px;
  height: 44px;
  background: var(--accent-50);
  border: 2px solid var(--accent-200);
  border-radius: var(--radius-lg);
  cursor: pointer;
  padding: 0;
  transition: all var(--transition);
}

.mobile-nav-toggle:hover {
  background: var(--accent-100);
  border-color: var(--accent-300);
}

.hamburger {
  position: relative;
  width: 20px;
  height: 2px;
  background: var(--accent-700);
  transition: all var(--transition);
}

.hamburger::before,
.hamburger::after {
  content: '';
  position: absolute;
  width: 20px;
  height: 2px;
  background: inherit;
  transition: all var(--transition);
}

.hamburger::before {
  transform: translateY(-6px);
}

.hamburger::after {
  transform: translateY(6px);
}

.mobile-nav-toggle.active .hamburger {
  background: transparent;
}

.mobile-nav-toggle.active .hamburger::before {
  transform: rotate(45deg);
}

.mobile-nav-toggle.active .hamburger::after {
  transform: rotate(-45deg);
}

/* Mobile Responsive */
@media (max-width: 1024px) {
  .header-content {
    padding: 0 var(--space-4) 0 0;
    height: 70px;
  }
  
  .nav-list {
    gap: var(--space-1);
  }
  
  .nav-link {
    padding: var(--space-2) var(--space-3);
    font-size: 0.9rem;
  }
}

@media (max-width: 768px) {
  .mobile-nav-toggle {
    display: flex;
  }
  
  .header-actions {
    gap: var(--space-2);
  }
  
  .nav {
    position: fixed;
    top: 0;
    right: -100%;
    width: 80%;
    max-width: 320px;
    height: 100vh;
    background: white;
    box-shadow: -5px 0 20px rgba(0, 0, 0, 0.15);
    transition: right var(--transition);
    z-index: 999;
  }
  
  .nav.active {
    right: 0;
  }
  
  .nav-list {
    flex-direction: column;
    padding: var(--space-20) var(--space-4) var(--space-4);
    gap: 0;
  }
  
  .nav-link {
    padding: var(--space-4) var(--space-4);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-2);
    color: var(--gray-700);
    font-size: 1rem;
    width: 100%;
    text-align: left;
    font-weight: 600;
  }
  
  .nav-link:hover {
    background: var(--accent-50);
    color: var(--accent-700);
  }
  
  .nav-link.active {
    background: var(--gradient-primary);
    color: white;
  }
}

@media (max-width: 480px) {
  .header-content {
    padding: 0 var(--space-2) 0 0;
    height: 60px;
  }
  
  .logo-text {
    font-size: 1.5rem;
  }
  
  .mobile-nav-toggle {
    width: 40px;
    height: 40px;
  }
  
  .hamburger {
    width: 18px;
    height: 2px;
  }
  
  .hamburger::before,
  .hamburger::after {
    width: 18px;
    height: 2px;
  }
  
  .hamburger::before {
    transform: translateY(-5px);
  }
  
  .hamburger::after {
    transform: translateY(5px);
  }
}
</style>
