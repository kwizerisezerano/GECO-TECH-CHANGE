<template>
  <div class="achievements-page">
    <Header />
    
    <!-- Hero Section -->
    <section class="hero-section" data-aos="fade-down">
      <div class="hero-overlay"></div>
      <div class="container">
        <div class="hero-content">
          <h1 class="hero-title">Our Impact & Achievements</h1>
          <p class="hero-subtitle">Transforming lives and communities through dedicated support and advocacy</p>
          <div class="hero-stats">
            <div class="hero-stat" v-for="stat in achievementStats.slice(0, 3)" :key="stat.id">
              <div class="hero-stat-number">{{ stat.number }}</div>
              <div class="hero-stat-label">{{ stat.label }}</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Stats Section -->
    <section class="stats-section" data-aos="fade-up">
      <div class="container">
        <div class="stats-grid">
          <div class="stat-card" v-for="stat in achievementStats" :key="stat.id" data-aos="zoom-in" :data-aos-delay="(stat.id - 1) * 100">
            <div class="stat-card-icon">
              <i :class="stat.icon"></i>
            </div>
            <div class="stat-card-content">
              <div class="stat-number">{{ stat.number }}</div>
              <div class="stat-label">{{ stat.label }}</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Key Achievements Timeline -->
    <section class="achievements-section">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2>Key Achievements</h2>
          <p>Milestones that mark our journey of impact</p>
        </div>
        
        <div class="achievements-timeline">
          <div class="timeline-item" v-for="(achievement, index) in achievements" :key="achievement.id" data-aos="fade-up" :data-aos-delay="index * 150">
            <div class="timeline-marker">
              <div class="timeline-dot"></div>
              <div class="timeline-year">{{ achievement.year }}</div>
            </div>
            <div class="timeline-content">
              <div class="achievement-card">
                <h3>{{ achievement.title }}</h3>
                <p>{{ achievement.description }}</p>
                <div class="achievement-impact">
                  <span class="impact-tag">{{ achievement.impact }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Success Stories -->
    <section class="stories-section">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2>Success Stories</h2>
          <p>Real lives transformed through our programs</p>
        </div>
        
        <div class="stories-grid">
          <div class="story-card" v-for="(story, index) in successStories" :key="story.id" data-aos="fade-up" :data-aos-delay="index * 100">
            <div class="story-header">
              <div class="story-icon">
                <i :class="story.icon"></i>
              </div>
              <h3>{{ story.title }}</h3>
            </div>
            <div class="story-content">
              <p>{{ story.story }}</p>
              <div class="story-outcome">
                <div class="outcome-label">Outcome</div>
                <div class="outcome-text">{{ story.outcome }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Recognition Section -->
    <section class="recognition-section">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2>Recognition & Awards</h2>
          <p>Honored for our commitment and impact</p>
        </div>
        
        <div class="recognition-grid">
          <div class="recognition-card" v-for="(recognition, index) in recognitions" :key="recognition.id" data-aos="fade-up" :data-aos-delay="index * 100">
            <div class="recognition-icon">
              <i class="bi bi-award"></i>
            </div>
            <div class="recognition-content">
              <h3>{{ recognition.title }}</h3>
              <p class="organization">{{ recognition.organization }}</p>
              <p class="year">{{ recognition.year }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" data-aos="fade-up">
      <div class="container">
        <div class="cta-content">
          <h2>Be Part of Our Impact Story</h2>
          <p>Join us in creating lasting change in communities across Rwanda</p>
          <div class="cta-buttons">
            <NuxtLink to="/donate" class="btn btn-primary">Support Our Work</NuxtLink>
            <NuxtLink to="/partners" class="btn btn-secondary">Partner With Us</NuxtLink>
          </div>
        </div>
      </div>
    </section>

    <Footer />
  </div>
</template>

<script setup>
const achievementStats = ref([
  { id: 1, icon: 'bi bi-people', number: '600+', label: 'Beneficiaries Supported' },
  { id: 2, icon: 'bi bi-geo-alt', number: '5', label: 'Districts Covered' },
  { id: 3, icon: 'bi bi-building', number: '15', label: 'Partner Organizations' },
  { id: 4, icon: 'bi bi-person-check', number: '67', label: 'Healthcare Workers Trained' }
])

const achievements = ref([
  {
    id: 1,
    year: '2023',
    title: 'Healthcare Worker Training Program',
    description: 'Successfully trained 67 healthcare professionals from health centers in epilepsy management, including screening, treatment initiation, and psychosocial support.',
    impact: 'Healthcare System Strengthening'
  },
  {
    id: 2,
    year: '2023',
    title: 'Educational Support Program',
    description: 'Provided school materials including notebooks, pens, backpacks, and shoes to 52 vulnerable children of school age.',
    impact: 'Educational Inclusion'
  },
  {
    id: 3,
    year: '2023',
    title: 'School Awareness Campaign',
    description: 'Conducted awareness raising in schools covering 4,233 students, 67 teachers, 180 parents, and 5 local authorities.',
    impact: 'Stigma Reduction'
  },
  {
    id: 4,
    year: '2022',
    title: 'Economic Empowerment Initiative',
    description: 'Provided financial support equivalent to 2,612,000 Rwf to 16 groups of people with epilepsy for various economic initiatives.',
    impact: 'Economic Empowerment'
  },
  {
    id: 5,
    year: '2022',
    title: 'Emergency Relief Support',
    description: 'Supported 64 families affected by COVID-19 and volcanic eruption with food, construction materials, and hygiene supplies.',
    impact: 'Emergency Response'
  }
])

const successStories = ref([
  {
    id: 1,
    icon: 'bi bi-person-heart',
    title: 'Jean\'s Journey to Independence',
    story: 'Jean, a 28-year-old with epilepsy, received vocational training and start-up capital to open a small shop.',
    outcome: 'Now financially independent and supporting his family'
  },
  {
    id: 2,
    icon: 'bi bi-mortarboard',
    title: 'Marie Returns to School',
    story: 'Marie, 15, had to drop out due to seizures. With medication and support, she returned to school.',
    outcome: 'Top of her class and aspiring to become a teacher'
  },
  {
    id: 3,
    icon: 'bi bi-people',
    title: 'Community Support Group',
    story: 'Established a support group that brings together 30 people with epilepsy monthly for peer support.',
    outcome: 'Reduced isolation and improved mental health outcomes'
  }
])

const recognitions = ref([
  {
    id: 1,
    title: 'Excellence in Community Health',
    organization: 'Ministry of Health',
    year: '2023'
  },
  {
    id: 2,
    title: 'Best NGO Practice in Mental Health',
    organization: 'Rwanda Biomedical Center',
    year: '2022'
  },
  {
    id: 3,
    title: 'Innovation in Healthcare Delivery',
    organization: 'Handicap International',
    year: '2022'
  }
])
</script>

<style scoped>
/* Hero Section */
.hero-section {
  position: relative;
  min-height: 60vh;
  display: flex;
  align-items: center;
  background: linear-gradient(135deg, #a153a4 0%, #8d3f90 100%);
  overflow: hidden;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grain)"/></svg>') repeat;
  opacity: 0.3;
}

.hero-content {
  position: relative;
  z-index: 2;
  text-align: center;
  color: white;
  max-width: 800px;
  margin: 0 auto;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 700;
  margin-bottom: 20px;
  line-height: 1.2;
}

.hero-subtitle {
  font-size: 1.3rem;
  margin-bottom: 40px;
  opacity: 0.9;
  line-height: 1.5;
}

.hero-stats {
  display: flex;
  justify-content: center;
  gap: 60px;
  flex-wrap: wrap;
}

.hero-stat {
  text-align: center;
}

.hero-stat-number {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 5px;
}

.hero-stat-label {
  font-size: 0.9rem;
  opacity: 0.8;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Stats Section */
.stats-section {
  padding: 80px 0;
  background: #f8f9fa;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 30px;
}

.stat-card {
  background: white;
  border-radius: 15px;
  padding: 40px 30px;
  text-align: center;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.stat-card:hover {
  transform: translateY(-10px);
  border-color: #a153a4;
  box-shadow: 0 20px 40px rgba(161, 83, 164, 0.2);
}

.stat-card-icon {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, #a153a4, #8d3f90);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
}

.stat-card-icon i {
  font-size: 2rem;
  color: white;
}

.stat-card-content .stat-number {
  font-size: 2.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 10px;
}

.stat-card-content .stat-label {
  color: #666;
  font-size: 0.95rem;
  line-height: 1.4;
}

/* Section Headers */
.section-header {
  text-align: center;
  margin-bottom: 60px;
}

.section-header h2 {
  font-size: 2.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 15px;
}

.section-header p {
  font-size: 1.1rem;
  color: #666;
  max-width: 600px;
  margin: 0 auto;
}

/* Achievements Timeline */
.achievements-section {
  padding: 80px 0;
}

.achievements-timeline {
  position: relative;
  max-width: 1000px;
  margin: 0 auto;
}

.achievements-timeline::before {
  content: '';
  position: absolute;
  left: 50%;
  top: 0;
  bottom: 0;
  width: 3px;
  background: linear-gradient(180deg, #a153a4, #8d3f90);
  transform: translateX(-50%);
}

.timeline-item {
  display: flex;
  margin-bottom: 50px;
  position: relative;
}

.timeline-item:nth-child(odd) {
  flex-direction: row-reverse;
}

.timeline-marker {
  position: absolute;
  left: 50%;
  top: 20px;
  transform: translateX(-50%);
  z-index: 2;
}

.timeline-dot {
  width: 20px;
  height: 20px;
  background: #a153a4;
  border: 4px solid white;
  border-radius: 50%;
  box-shadow: 0 0 0 3px rgba(161, 83, 164, 0.2);
}

.timeline-year {
  background: #a153a4;
  color: white;
  padding: 5px 15px;
  border-radius: 20px;
  font-weight: 600;
  font-size: 0.9rem;
  margin-top: 10px;
  text-align: center;
}

.timeline-content {
  width: calc(50% - 40px);
}

.achievement-card {
  background: white;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.achievement-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.achievement-card h3 {
  color: #333;
  margin-bottom: 15px;
  font-size: 1.3rem;
}

.achievement-card p {
  color: #666;
  line-height: 1.6;
  margin-bottom: 20px;
}

.impact-tag {
  display: inline-block;
  padding: 8px 16px;
  background: rgba(161, 83, 164, 0.1);
  color: #a153a4;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Stories Section */
.stories-section {
  padding: 80px 0;
  background: #f8f9fa;
}

.stories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 30px;
}

.story-card {
  background: white;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.story-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.story-header {
  background: linear-gradient(135deg, #a153a4, #8d3f90);
  padding: 30px;
  text-align: center;
  color: white;
}

.story-icon {
  width: 60px;
  height: 60px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
}

.story-icon i {
  font-size: 1.8rem;
  color: white;
}

.story-header h3 {
  margin: 0;
  font-size: 1.3rem;
}

.story-content {
  padding: 30px;
}

.story-content p {
  color: #666;
  line-height: 1.6;
  margin-bottom: 20px;
}

.story-outcome {
  background: rgba(161, 83, 164, 0.1);
  padding: 15px;
  border-radius: 10px;
}

.outcome-label {
  font-weight: 600;
  color: #a153a4;
  margin-bottom: 5px;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.outcome-text {
  color: #333;
  font-weight: 500;
}

/* Recognition Section */
.recognition-section {
  padding: 80px 0;
}

.recognition-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 30px;
}

.recognition-card {
  background: white;
  border-radius: 15px;
  padding: 40px 30px;
  text-align: center;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  border-top: 4px solid #a153a4;
}

.recognition-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.recognition-icon {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, #a153a4, #8d3f90);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 25px;
}

.recognition-icon i {
  font-size: 2rem;
  color: white;
}

.recognition-content h3 {
  color: #333;
  margin-bottom: 10px;
  font-size: 1.2rem;
}

.recognition-content .organization {
  color: #666;
  margin-bottom: 5px;
  font-weight: 500;
}

.recognition-content .year {
  color: #a153a4;
  font-weight: 600;
  font-size: 0.9rem;
}

/* CTA Section */
.cta-section {
  padding: 80px 0;
  background: linear-gradient(135deg, #a153a4, #8d3f90);
  color: white;
  text-align: center;
}

.cta-content h2 {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 20px;
}

.cta-content p {
  font-size: 1.2rem;
  margin-bottom: 40px;
  opacity: 0.9;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}

.cta-buttons {
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

.btn {
  padding: 15px 35px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
  display: inline-block;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-size: 0.9rem;
}

.btn-primary {
  background: white;
  color: #a153a4;
}

.btn-primary:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.btn-secondary {
  background: transparent;
  color: white;
  border: 2px solid white;
}

.btn-secondary:hover {
  background: white;
  color: #a153a4;
  transform: translateY(-3px);
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .hero-subtitle {
    font-size: 1.1rem;
  }
  
  .hero-stats {
    gap: 30px;
  }
  
  .achievements-timeline::before {
    left: 30px;
  }
  
  .timeline-item {
    flex-direction: column !important;
    padding-left: 60px;
  }
  
  .timeline-marker {
    left: 30px;
  }
  
  .timeline-content {
    width: 100%;
  }
  
  .stories-grid {
    grid-template-columns: 1fr;
  }
  
  .cta-buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .btn {
    width: 250px;
    text-align: center;
  }
}

@media (max-width: 480px) {
  .hero-title {
    font-size: 2rem;
  }
  
  .section-header h2 {
    font-size: 2rem;
  }
  
  .cta-content h2 {
    font-size: 2rem;
  }
  
  .stats-grid {
    grid-template-columns: 1fr;
  }
}
</style>
