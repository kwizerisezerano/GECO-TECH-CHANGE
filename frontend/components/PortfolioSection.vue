<template>
  <section id="portfolio" class="portfolio section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Our Impact in Action</h2>
      <p>
        We are committed to addressing the challenges and providing solutions. Your support can help us bring meaningful change.
      </p>
    </div>

    <div class="container">
      <div class="portfolio-slider" data-aos="fade-up" data-aos-delay="200">
        <!-- Slider Controls -->
        <div class="slider-controls">
          <div class="slider-nav-icon prev-icon" @click="previousSlide" :class="{ disabled: currentSlide === 0 }">
            ❮
          </div>
          <div class="slider-nav-icon next-icon" @click="nextSlide" :class="{ disabled: currentSlide === totalSlides - 1 }">
            ❯
          </div>
        </div>

        <!-- Slider Container -->
        <div class="slider-container" ref="sliderContainer">
          <div class="slider-track" :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
            <!-- Slide Groups -->
            <div class="slide" v-for="(slideGroup, slideIndex) in slideGroups" :key="slideIndex">
              <div class="slide-grid">
                <div class="portfolio-item" v-for="item in slideGroup" :key="item.id">
                  <div class="portfolio-image-container">
                    <img :src="item.image" class="portfolio-img" :alt="item.title" @error="handleImageError" />
                    <div class="image-placeholder" v-if="!item.imageLoaded">
                      <i class="bi bi-image"></i>
                    </div>
                  </div>
                  <div class="portfolio-info">
                    <h4>{{ item.title }}</h4>
                    <p>{{ item.description }}</p>
                    <div class="portfolio-actions">
                      <button @click="openLightbox(item)" class="preview-link" :title="item.title">
                        <i class="bi bi-zoom-in"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide Indicators -->
        <div class="slider-indicators">
          <button 
            v-for="(_, index) in totalSlides" 
            :key="index"
            class="indicator"
            :class="{ active: currentSlide === index }"
            @click="goToSlide(index)"
          ></button>
        </div>

        <!-- Filter Pills -->
        <div class="filter-pills">
          <button 
            v-for="filter in filters" 
            :key="filter.name"
            class="filter-pill"
            :class="{ active: activeFilter === filter.name }"
            @click="setActiveFilter(filter.name)"
          >
            {{ filter.label }}
          </button>
        </div>
      </div>
    </div>

    <!-- Lightbox Modal -->
    <div v-if="showLightbox" class="lightbox-overlay" @click="closeLightbox">
      <div class="lightbox-content" @click.stop>
        <button class="lightbox-close" @click="closeLightbox">
          <i class="bi bi-x"></i>
        </button>
        <img :src="lightboxImage" :alt="lightboxTitle" class="lightbox-image" />
        <div class="lightbox-info">
          <h3>{{ lightboxTitle }}</h3>
          <p>{{ lightboxDescription }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const portfolioItems = ref([
  {
    id: 1,
    title: 'Evidence 1',
    description: 'GECO in Partnership with HI has strengthened the capacities of health professionals in the medical care of epilepsy. In-depth knowledge will make it possible to detect epilepsy early, initiate adequate drug treatment and refer patients if necessary. We trained 67 health professionals from health centers.',
    image: '/assets/img/portfolio/app-1.jpg',
    imageLoaded: true,
    category: 'app'
  },
  {
    id: 2,
    title: 'Evidence 2',
    description: '52 vulnerable children of school age were supported with school materials, namely: notebooks and pens, backpacks and shoes to help them follow their lessons and integrate them into primary school education programs.',
    image: '/assets/img/portfolio/app-2.jpg',
    imageLoaded: true,
    category: 'app'
  },
  {
    id: 3,
    title: 'Evidence 3',
    description: 'Awareness raising in schools to ensure the integration of children with epilepsy in schools. It covered 4,233 students, 67 teachers, 180 parents and 5 local authorities.',
    image: '/assets/img/portfolio/app-3.jpg',
    imageLoaded: true,
    category: 'app'
  },
  {
    id: 4,
    title: 'Evidence 4',
    description: 'Here are the groups supported by GECO for cattle and pig farming.',
    image: '/assets/img/portfolio/branding-1.jpg',
    imageLoaded: true,
    category: 'branding'
  },
  {
    id: 5,
    title: 'Evidence 5',
    description: 'During the period of the COVID-19 epidemic and the earthquake following the volcanic eruption in Rubavu, GECO in partnership with HI was able to help 64 families who have people suffering from epilepsy.',
    image: '/assets/img/portfolio/branding-2.jpg',
    imageLoaded: true,
    category: 'branding'
  },
  {
    id: 6,
    title: 'Evidence 6',
    description: '333 people with epilepsy from 100 vulnerable families were paid medical insurance so that they could continue to receive medicine.',
    image: '/assets/img/portfolio/branding-3.jpg',
    imageLoaded: true,
    category: 'branding'
  },
  {
    id: 7,
    title: 'Evidence 7',
    description: '1,439 facilitators were trained on the etiology of epilepsy and the mode of prevention and how to help patients in different activities such as consultation by specialists.',
    image: '/assets/img/portfolio/books-1.jpg',
    imageLoaded: true,
    category: 'books'
  },
  {
    id: 8,
    title: 'Evidence 8',
    description: 'GECO in partnership with Handicap International (HI), gave financial support equivalent to 2,612,000 Rwf to 16 groups of people with epilepsy.',
    image: '/assets/img/portfolio/books-2.jpg',
    imageLoaded: true,
    category: 'books'
  },
  {
    id: 9,
    title: 'Evidence 9',
    description: 'Three groups were given 9 pigs per each, five groups were given 35 chickens per each, three groups took initiative to get engaged in vegetable agriculture.',
    image: '/assets/img/portfolio/books-3.jpg',
    imageLoaded: true,
    category: 'books'
  }
])

// Slider state
const currentSlide = ref(0)
const activeFilter = ref('all')
const sliderContainer = ref(null)
const itemsPerSlide = 1
const showBackToTop = ref(false)

// Lightbox state
const showLightbox = ref(false)
const lightboxImage = ref('')
const lightboxTitle = ref('')
const lightboxDescription = ref('')

// Filters
const filters = ref([
  { name: 'all', label: 'All' },
  { name: 'app', label: 'Part 1' },
  { name: 'branding', label: 'Part 2' },
  { name: 'books', label: 'Part 3' }
])

// Computed properties
const filteredItems = computed(() => {
  if (activeFilter.value === 'all') {
    return portfolioItems.value
  }
  return portfolioItems.value.filter(item => item.category === activeFilter.value)
})

const slideGroups = computed(() => {
  const groups = []
  const items = filteredItems.value
  
  for (let i = 0; i < items.length; i += itemsPerSlide) {
    groups.push(items.slice(i, i + itemsPerSlide))
  }
  
  return groups
})

const totalSlides = computed(() => slideGroups.value.length)

// Methods
const nextSlide = () => {
  if (currentSlide.value < totalSlides.value - 1) {
    currentSlide.value++
  }
}

const previousSlide = () => {
  if (currentSlide.value > 0) {
    currentSlide.value--
  }
}

const goToSlide = (index) => {
  currentSlide.value = index
}

const setActiveFilter = (filterName) => {
  activeFilter.value = filterName
  currentSlide.value = 0 // Reset to first slide when filter changes
}

const handleImageError = (event) => {
  const item = portfolioItems.value.find(item => item.image === event.target.src)
  if (item) {
    item.imageLoaded = false
  }
}

// Auto-play functionality
let autoPlayInterval = null

const startAutoPlay = () => {
  autoPlayInterval = setInterval(() => {
    if (currentSlide.value < totalSlides.value - 1) {
      nextSlide()
    } else {
      currentSlide.value = 0 // Loop back to first slide
    }
  }, 5000) // Change slide every 5 seconds
}

const stopAutoPlay = () => {
  if (autoPlayInterval) {
    clearInterval(autoPlayInterval)
    autoPlayInterval = null
  }
}

// Lifecycle
onMounted(() => {
  startAutoPlay()
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  stopAutoPlay()
  window.removeEventListener('scroll', handleScroll)
})

// Pause auto-play on hover
const pauseAutoPlay = () => {
  stopAutoPlay()
}

const resumeAutoPlay = () => {
  startAutoPlay()
}

// Scroll to top functionality
const scrollToTop = () => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  })
}

// Handle scroll to show/hide back to top button
const handleScroll = () => {
  showBackToTop.value = window.scrollY > 300
}

// Lightbox functions
const openLightbox = (item) => {
  lightboxImage.value = item.image
  lightboxTitle.value = item.title
  lightboxDescription.value = item.description
  showLightbox.value = true
  // Prevent body scroll when lightbox is open
  document.body.style.overflow = 'hidden'
}

const closeLightbox = () => {
  showLightbox.value = false
  // Restore body scroll
  document.body.style.overflow = 'auto'
}
</script>

<style scoped>
/* Slider Container */
.portfolio-slider {
  position: relative;
  max-width: 1200px;
  margin: 0 auto;
}

/* Slider Controls */
.slider-controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: absolute;
  top: 50%;
  left: -20px;
  right: -20px;
  transform: translateY(-50%);
  z-index: 10;
  pointer-events: none;
}

.slider-nav-icon {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 1.5rem;
  color: #7c3aed;
  background: rgba(255, 255, 255, 0.9);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.slider-nav-icon:hover:not(.disabled) {
  color: #6d28d9;
  transform: scale(1.1);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.slider-nav-icon.disabled {
  opacity: 0.3;
  cursor: not-allowed;
  color: #ccc;
}

/* Slider Track */
.slider-container {
  overflow: hidden;
  border-radius: 15px;
  position: relative;
}

.slider-track {
  display: flex;
  transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.slide {
  min-width: 100%;
  padding: 0 10px;
}

.slide-grid {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px 0;
  min-height: 500px;
  width: 100%;
}

.slide-grid .portfolio-item {
  max-width: 800px;
  width: 100%;
  margin: 0 auto;
}

/* Portfolio Items in Slider */
.portfolio-item {
  position: relative;
  background: transparent;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.portfolio-item:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(124, 58, 237, 0.2);
  border-color: rgba(124, 58, 237, 0.3);
}

.portfolio-image-container {
  position: relative;
  height: 450px;
  overflow: hidden;
  border-radius: 12px 12px 0 0;
  width: 100%;
}

.portfolio-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
  display: block;
}

.portfolio-item:hover .portfolio-img {
  transform: scale(1.05);
}

.image-placeholder {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 3rem;
}

.image-placeholder i {
  opacity: 0.5;
}

.portfolio-info {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.1), transparent);
  color: white;
  padding: 30px 20px 20px;
  transform: translateY(0);
  transition: all 0.3s ease;
  min-height: 120px;
}

.portfolio-item:hover .portfolio-info {
  background: linear-gradient(to top, rgba(124, 58, 237, 0.4), rgba(124, 58, 237, 0.2), transparent);
}

.portfolio-info h4 {
  font-size: 1.3rem;
  font-weight: 700;
  margin-bottom: 10px;
  line-height: 1.3;
  color: #ffffff;
  text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
}

.portfolio-info p {
  font-size: 0.95rem;
  margin-bottom: 15px;
  opacity: 1;
  line-height: 1.5;
  color: #ffffff;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.portfolio-actions {
  display: flex;
  gap: 10px;
}

.portfolio-actions a {
  color: white;
  font-size: 1rem;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255, 255, 255, 0.5);
}

.portfolio-actions a:hover {
  background: rgba(255, 255, 255, 0.4);
  transform: scale(1.1);
  border-color: rgba(255, 255, 255, 0.8);
}

/* Slide Indicators */
.slider-indicators {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-top: 30px;
}

.indicator {
  width: 12px;
  height: 12px;
  border: 2px solid rgba(124, 58, 237, 0.5);
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
  cursor: pointer;
  transition: all 0.3s ease;
}

.indicator.active {
  background: #7c3aed;
  border-color: #7c3aed;
  transform: scale(1.2);
}

.indicator:hover {
  background: rgba(124, 58, 237, 0.7);
  border-color: rgba(124, 58, 237, 0.8);
}

/* Filter Pills */
.filter-pills {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 30px;
}

.filter-pill {
  padding: 8px 20px;
  border: 2px solid #e5e7eb;
  border-radius: 25px;
  background: white;
  color: #6b7280;
  font-size: 0.9rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
}

.filter-pill:hover {
  border-color: #7c3aed;
  color: #7c3aed;
}

.filter-pill.active {
  background: #7c3aed;
  border-color: #7c3aed;
  color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
  .slider-controls {
    left: -10px;
    right: -10px;
  }
  
  .slider-btn {
    width: 40px;
    height: 40px;
    font-size: 1rem;
  }
  
  .slide-grid {
    padding: 15px 0;
    min-height: 400px;
  }
  
  .portfolio-image-container {
    height: 200px;
  }
  
  .portfolio-info {
    padding: 20px 15px 15px;
  }
  
  .portfolio-info h4 {
    font-size: 1.1rem;
  }
  
  .portfolio-info p {
    font-size: 0.85rem;
    -webkit-line-clamp: 2;
  }
  
  .filter-pills {
    gap: 8px;
  }
  
  .filter-pill {
    padding: 6px 15px;
    font-size: 0.85rem;
  }
}

@media (max-width: 480px) {
  .slider-btn {
    width: 35px;
    height: 35px;
    font-size: 0.9rem;
  }
  
  .portfolio-image-container {
    height: 180px;
  }
  
  .portfolio-info {
    padding: 15px 12px 12px;
  }
  
  .portfolio-info h4 {
    font-size: 1rem;
    margin-bottom: 8px;
  }
  
  .portfolio-info p {
    font-size: 0.8rem;
    margin-bottom: 10px;
  }
  
  .portfolio-actions a {
    width: 30px;
    height: 30px;
    font-size: 0.9rem;
  }
}

/* Lightbox Styles */
.lightbox-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.9);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 2000;
  padding: 20px;
}

.lightbox-content {
  position: relative;
  max-width: 90vw;
  max-height: 90vh;
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.lightbox-close {
  position: absolute;
  top: 15px;
  right: 15px;
  width: 40px;
  height: 40px;
  background: rgba(0, 0, 0, 0.7);
  color: white;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  z-index: 2001;
  transition: all 0.3s ease;
}

.lightbox-close:hover {
  background: rgba(0, 0, 0, 0.9);
  transform: scale(1.1);
}

.lightbox-image {
  width: 100%;
  max-height: 70vh;
  object-fit: contain;
  display: block;
}

.lightbox-info {
  padding: 20px;
  background: white;
}

.lightbox-info h3 {
  margin: 0 0 10px 0;
  color: #333;
  font-size: 1.3rem;
}

.lightbox-info p {
  margin: 0;
  color: #666;
  line-height: 1.5;
}

@media (max-width: 768px) {
  .lightbox-content {
    max-width: 95vw;
    max-height: 95vh;
  }
  
  .lightbox-info {
    padding: 15px;
  }
  
  .lightbox-info h3 {
    font-size: 1.1rem;
  }
  
  .lightbox-info p {
    font-size: 0.9rem;
  }
}
</style>
