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
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
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
  background: var(--gray-50);
  transition: background-color 0.3s ease;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 30px;
}

.stat-card {
  background: var(--surface-color);
  border-radius: 15px;
  padding: 40px 30px;
  text-align: center;
  box-shadow: var(--shadow-lg);
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.stat-card:hover {
  transform: translateY(-10px);
  border-color: var(--primary-color);
  box-shadow: 0 20px 40px rgba(168, 85, 247, 0.2);
}

.stat-card-icon {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  transition: all 0.3s ease;
}

.stat-card-icon i {
  font-size: 2rem;
  color: white;
}

.stat-card-content .stat-number {
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--gray-900);
  margin-bottom: 10px;
  transition: color 0.3s ease;
}

.stat-card-content .stat-label {
  color: var(--gray-600);
  font-size: 0.95rem;
  line-height: 1.4;
  transition: color 0.3s ease;
}

/* Section Headers */
.section-header {
  text-align: center;
  margin-bottom: 60px;
}

.section-header h2 {
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--gray-900);
  margin-bottom: 15px;
  transition: color 0.3s ease;
}

.section-header p {
  font-size: 1.1rem;
  color: var(--gray-600);
  max-width: 600px;
  margin: 0 auto;
  transition: color 0.3s ease;
}

/* Dark mode adjustments */
@media (prefers-color-scheme: dark) {
  .stats-section {
    background: var(--gray-50);
  }
  
  .stat-card {
    background: var(--surface-color);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  }
  
  .stat-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  }
  
  .stat-card-content .stat-number {
    color: var(--gray-100);
  }
  
  .stat-card-content .stat-label {
    color: var(--gray-300);
  }
  
  .section-header h2 {
    color: var(--gray-100);
  }
  
  .section-header p {
    color: var(--gray-300);
  }
}

[data-theme="dark"] .stats-section {
  background: var(--gray-50);
}

[data-theme="dark"] .stat-card {
  background: var(--surface-color);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .stat-card:hover {
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}

[data-theme="dark"] .stat-card-content .stat-number {
  color: var(--gray-100);
}

[data-theme="dark"] .stat-card-content .stat-label {
  color: var(--gray-300);
}

[data-theme="dark"] .section-header h2 {
  color: var(--gray-100);
}

[data-theme="dark"] .section-header p {
  color: var(--gray-300);
}

/* Achievements Timeline */
.achievements-section {
  padding: 80px 0;
  background: var(--gray-50);
  transition: background-color 0.3s ease;
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
  background: linear-gradient(180deg, var(--primary-color), var(--primary-dark));
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
  background: var(--primary-color);
  border: 4px solid white;
  border-radius: 50%;
  box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.2);
}

.timeline-year {
  background: var(--primary-color);
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
  background: var(--surface-color);
  padding: 30px;
  border-radius: 15px;
  box-shadow: var(--shadow-lg);
  transition: all 0.3s ease;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.achievement-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.achievement-card h3 {
  color: var(--gray-900);
  margin-bottom: 15px;
  font-size: 1.3rem;
  transition: color 0.3s ease;
}

.achievement-card p {
  color: var(--gray-600);
  line-height: 1.6;
  margin-bottom: 20px;
  transition: color 0.3s ease;
}

.impact-tag {
  display: inline-block;
  padding: 8px 16px;
  background: rgba(168, 85, 247, 0.1);
  color: var(--primary-color);
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
}

/* Dark mode timeline adjustments */
@media (prefers-color-scheme: dark) {
  .achievements-section {
    background: var(--gray-50);
  }
  
  .achievement-card {
    background: var(--surface-color);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  }
  
  .achievement-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  }
  
  .achievement-card h3 {
    color: var(--gray-100);
  }
  
  .achievement-card p {
    color: var(--gray-300);
  }
  
  .impact-tag {
    background: rgba(168, 85, 247, 0.2);
  }
}

[data-theme="dark"] .achievements-section {
  background: var(--gray-50);
}

[data-theme="dark"] .achievement-card {
  background: var(--surface-color);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .achievement-card:hover {
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}

[data-theme="dark"] .achievement-card h3 {
  color: var(--gray-100);
}

[data-theme="dark"] .achievement-card p {
  color: var(--gray-300);
}

[data-theme="dark"] .impact-tag {
  background: rgba(168, 85, 247, 0.2);
}

/* Stories Section */
.stories-section {
  padding: 80px 0;
  background: var(--gray-50);
  transition: background-color 0.3s ease;
}

.stories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 30px;
}

.story-card {
  background: var(--surface-color);
  border-radius: 15px;
  overflow: hidden;
  box-shadow: var(--shadow-lg);
  transition: all 0.3s ease;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.story-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.story-header {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
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
  transition: all 0.3s ease;
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
  color: var(--gray-600);
  line-height: 1.6;
  margin-bottom: 20px;
  transition: color 0.3s ease;
}

.story-outcome {
  background: rgba(168, 85, 247, 0.1);
  padding: 15px;
  border-radius: 10px;
  transition: all 0.3s ease;
}

.outcome-label {
  font-weight: 600;
  color: var(--primary-color);
  margin-bottom: 5px;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: color 0.3s ease;
}

.outcome-text {
  color: var(--gray-800);
  font-weight: 500;
  transition: color 0.3s ease;
}

/* Recognition Section */
.recognition-section {
  padding: 80px 0;
  background: var(--gray-50);
  transition: background-color 0.3s ease;
}

.recognition-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 30px;
}

.recognition-card {
  background: var(--surface-color);
  border-radius: 15px;
  padding: 40px 30px;
  text-align: center;
  box-shadow: var(--shadow-lg);
  transition: all 0.3s ease;
  border-top: 4px solid var(--primary-color);
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.recognition-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

/* Dark mode stories and recognition adjustments */
@media (prefers-color-scheme: dark) {
  .stories-section {
    background: var(--gray-50);
  }
  
  .story-card {
    background: var(--surface-color);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  }
  
  .story-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  }
  
  .story-content p {
    color: var(--gray-300);
  }
  
  .story-outcome {
    background: rgba(168, 85, 247, 0.2);
  }
  
  .outcome-text {
    color: var(--gray-200);
  }
  
  .recognition-section {
    background: var(--gray-50);
  }
  
  .recognition-card {
    background: var(--surface-color);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  }
  
  .recognition-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  }
}

[data-theme="dark"] .stories-section {
  background: var(--gray-50);
}

[data-theme="dark"] .story-card {
  background: var(--surface-color);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .story-card:hover {
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}

[data-theme="dark"] .story-content p {
  color: var(--gray-300);
}

[data-theme="dark"] .story-outcome {
  background: rgba(168, 85, 247, 0.2);
}

[data-theme="dark"] .outcome-text {
  color: var(--gray-200);
}

[data-theme="dark"] .recognition-section {
  background: var(--gray-50);
}

[data-theme="dark"] .recognition-card {
  background: var(--surface-color);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .recognition-card:hover {
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}

.recognition-icon {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 25px;
  transition: all 0.3s ease;
}

.recognition-icon i {
  font-size: 2rem;
  color: white;
}

.recognition-card h3 {
  color: var(--gray-900);
  margin-bottom: 15px;
  font-size: 1.3rem;
  transition: color 0.3s ease;
}

.recognition-card p {
  color: var(--gray-600);
  line-height: 1.6;
  margin-bottom: 0;
  transition: color 0.3s ease;
}

/* Dark mode recognition adjustments */
@media (prefers-color-scheme: dark) {
  .recognition-icon {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  }
  
  .recognition-card h3 {
    color: var(--gray-100);
  }
  
  .recognition-card p {
    color: var(--gray-300);
  }
}

[data-theme="dark"] .recognition-icon {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
}

[data-theme="dark"] .recognition-card h3 {
  color: var(--gray-100);
}

[data-theme="dark"] .recognition-card p {
  color: var(--gray-300);
}

/* CTA Section */
.cta-section {
  padding: 80px 0;
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
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
  color: var(--primary-color);
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
  color: var(--primary-color);
  transform: translateY(-3px);
}

/* Dark mode CTA adjustments */
@media (prefers-color-scheme: dark) {
  .btn-primary:hover {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
  }
}

[data-theme="dark"] .btn-primary:hover {
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
}

/* Responsive Design - Professional Mobile Layout */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .hero-stats {
    gap: 30px;
  }
  
  .achievements-timeline::before {
    left: 30px;
  }
  
  .timeline-item {
    flex-direction: row !important;
  }
  
  .timeline-marker {
    left: 30px;
    transform: translateX(-50%);
  }
  
  .timeline-content {
    width: calc(100% - 80px);
    margin-left: 80px;
  }
  
  .stories-grid {
    grid-template-columns: 1fr;
    gap: 20px;
    padding: 0 16px;
  }
  
  .story-card {
    padding: 24px;
    border-radius: 16px;
    margin-bottom: 16px;
  }
  
  .story-header {
    margin-bottom: 16px;
  }
  
  .story-icon {
    width: 50px;
    height: 50px;
    margin-bottom: 12px;
  }
  
  .story-content h3 {
    font-size: 1.25rem;
    margin-bottom: 12px;
  }
  
  .story-content p {
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 16px;
  }
  
  .recognition-grid {
    grid-template-columns: 1fr;
    gap: 20px;
    padding: 0 16px;
  }
  
  .recognition-item {
    padding: 24px;
    border-radius: 16px;
    margin-bottom: 16px;
  }
  
  .recognition-icon {
    width: 50px;
    height: 50px;
    margin-bottom: 12px;
  }
  
  .recognition-content h3 {
    font-size: 1.25rem;
    margin-bottom: 12px;
  }
  
  .recognition-content p {
    font-size: 0.95rem;
    line-height: 1.6;
  }
  
  .cta-section {
    padding: 60px 20px;
  }
  
  .cta-content h2 {
    font-size: 1.8rem;
    margin-bottom: 16px;
  }
  
  .cta-content p {
    font-size: 1rem;
    margin-bottom: 24px;
  }
  
  .cta-buttons {
    flex-direction: column;
    align-items: center;
    gap: 16px;
  }
  
  .btn {
    width: 100%;
    max-width: 280px;
    text-align: center;
    padding: 16px 24px;
    font-size: 1rem;
    border-radius: 12px;
  }
}

@media (max-width: 480px) {
  .hero-stats {
    grid-template-columns: 1fr;
    gap: 20px;
  }
  
  .stat-card {
    padding: 20px;
    text-align: center;
  }
  
  .stat-number {
    font-size: 2rem;
  }
  
  .stories-grid {
    padding: 0 12px;
    gap: 16px;
  }
  
  .story-card {
    padding: 20px;
  }
  
  .recognition-grid {
    padding: 0 12px;
    gap: 16px;
  }
  
  .recognition-item {
    padding: 20px;
  }
  
  .cta-section {
    padding: 40px 16px;
  }
  
  .btn {
    max-width: 240px;
    padding: 14px 20px;
  }
}
</style>
