<template>
  <div class="partners-page">
    <Header />
    
    <main class="main">
      <section class="page-section">
        <div class="container">
          <div class="section-title" data-aos="fade-up">
            <h2>Our Partners</h2>
            <p>Organizations Supporting Our Mission</p>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <div class="content-card" data-aos="fade-up">
                <h3>Strategic Partners</h3>
                <p>We collaborate with various organizations to achieve our mission of supporting people with epilepsy and mental health conditions in Rwanda.</p>
                
                <div class="partners-grid">
                  <div class="partner-card" v-for="partner in partners" :key="partner.id" data-aos="fade-up">
                    <div class="partner-logo">
                      <i :class="partner.icon"></i>
                    </div>
                    <div class="partner-info">
                      <h4>{{ partner.name }}</h4>
                      <p>{{ partner.description }}</p>
                      <span class="partner-type">{{ partner.type }}</span>
                    </div>
                  </div>
                </div>
                
                <div class="partnership-info">
                  <h4>Become a Partner</h4>
                  <p>We welcome partnerships with organizations that share our vision and commitment to supporting people with epilepsy and mental health conditions.</p>
                  
                  <div class="partnership-benefits">
                    <div class="benefit-item">
                      <i class="bi bi-handshake"></i>
                      <h5>Collaborative Impact</h5>
                      <p>Work together to create meaningful change in communities</p>
                    </div>
                    
                    <div class="benefit-item">
                      <i class="bi bi-globe"></i>
                      <h5>Global Recognition</h5>
                      <p>Join a network of organizations making a difference</p>
                    </div>
                    
                    <div class="benefit-item">
                      <i class="bi bi-graph-up"></i>
                      <h5>Shared Resources</h5>
                      <p>Leverage combined expertise and resources for greater impact</p>
                    </div>
                  </div>
                  
                  <div class="contact-section">
                    <h5>Interested in Partnership?</h5>
                    <p>Contact us to explore collaboration opportunities</p>
                    <button class="btn-contact">Contact Partnership Team</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <Footer />
  </div>
</template>

<script setup>
const partners = ref([
  {
    id: 1,
    name: 'Handicap International (HI)',
    description: 'International organization working to support people with disabilities and vulnerable populations.',
    type: 'International NGO',
    icon: 'bi bi-hospital'
  },
  {
    id: 2,
    name: 'Rwanda Biomedical Center (RBC)',
    description: 'National health implementation agency supporting healthcare initiatives across Rwanda.',
    type: 'Government Agency',
    icon: 'bi bi-shield-check'
  },
  {
    id: 3,
    name: 'Ministry of Health',
    description: 'Government ministry responsible for health policy and healthcare delivery in Rwanda.',
    type: 'Government Ministry',
    icon: 'bi bi-building'
  },
  {
    id: 4,
    name: 'World Health Organization',
    description: 'United Nations agency directing international health within the UN system.',
    type: 'UN Agency',
    icon: 'bi bi-globe2'
  },
  {
    id: 5,
    name: 'Local Health Centers',
    description: 'Network of primary healthcare facilities providing essential services to communities.',
    type: 'Healthcare Network',
    icon: 'bi bi-geo-alt'
  },
  {
    id: 6,
    name: 'Community-Based Organizations',
    description: 'Local organizations working at the grassroots level to support community needs.',
    type: 'Community Partners',
    icon: 'bi bi-people'
  }
])
</script>

<style scoped>
.page-section {
  padding: 80px 0;
  background: var(--gray-50);
  transition: background-color 0.3s ease;
}

.content-card {
  background: var(--surface-color);
  padding: 40px;
  border-radius: 15px;
  box-shadow: var(--shadow-lg);
  border: 1px solid rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.content-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.content-card h3 {
  color: var(--gray-900);
  margin-bottom: 20px;
  font-size: 1.8rem;
  text-align: center;
  transition: color 0.3s ease;
}

.content-card > p {
  color: var(--gray-600);
  text-align: center;
  margin-bottom: 40px;
  font-size: 1.1rem;
  line-height: 1.6;
  transition: color 0.3s ease;
}

.partners-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 25px;
  margin: 30px 0;
}

.partner-card {
  display: flex;
  align-items: flex-start;
  padding: 25px;
  background: var(--gray-50);
  border-radius: 12px;
  border-left: 4px solid var(--primary-color);
  transition: all 0.3s ease;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.partner-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-lg);
}

.partner-logo {
  width: 60px;
  height: 60px;
  background: var(--primary-color);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 20px;
  flex-shrink: 0;
  transition: all 0.3s ease;
}

.partner-logo:hover {
  transform: scale(1.1);
  box-shadow: 0 4px 15px rgba(168, 85, 247, 0.3);
}

.partner-logo i {
  font-size: 1.5rem;
  color: white;
}

.partner-info {
  flex: 1;
}

.partner-info h4 {
  margin: 0 0 10px 0;
  color: var(--gray-900);
  font-size: 1.1rem;
  font-weight: 600;
  transition: color 0.3s ease;
}

.partner-info p {
  margin: 0 0 10px 0;
  color: var(--gray-600);
  line-height: 1.5;
  font-size: 0.9rem;
  transition: color 0.3s ease;
}

.partner-type {
  display: inline-block;
  padding: 4px 12px;
  background: rgba(168, 85, 247, 0.1);
  color: var(--primary-color);
  border-radius: 15px;
  font-size: 0.8rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
}

.partnership-info {
  margin-top: 50px;
  padding-top: 30px;
  border-top: 2px solid var(--gray-200);
}

.partnership-info h4 {
  color: var(--gray-900);
  margin-bottom: 15px;
  text-align: center;
  font-size: 1.5rem;
  transition: color 0.3s ease;
}

.partnership-info > p {
  text-align: center;
  color: var(--gray-600);
  margin-bottom: 30px;
  font-size: 1.1rem;
  line-height: 1.6;
  transition: color 0.3s ease;
}

.partnership-benefits {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
  margin-bottom: 40px;
}

.benefit-item {
  text-align: center;
  padding: 30px 25px;
  background: var(--gray-50);
  border-radius: 12px;
  border: 1px solid rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.benefit-item:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-md);
  background: var(--surface-color);
}

.benefit-item i {
  font-size: 2.5rem;
  color: var(--primary-color);
  margin-bottom: 15px;
  transition: all 0.3s ease;
}

.benefit-item:hover i {
  transform: scale(1.1);
  color: var(--primary-light);
}

.benefit-item h5 {
  margin: 0 0 10px 0;
  color: var(--gray-900);
  font-weight: 600;
  transition: color 0.3s ease;
}

.benefit-item p {
  margin: 0;
  color: var(--gray-600);
  font-size: 0.9rem;
  line-height: 1.4;
  transition: color 0.3s ease;
}

.contact-section {
  text-align: center;
  padding: 40px;
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  border-radius: 12px;
  color: white;
  box-shadow: var(--shadow-lg);
  transition: all 0.3s ease;
}

.contact-section:hover {
  transform: translateY(-3px);
  box-shadow: 0 20px 40px rgba(168, 85, 247, 0.3);
}

.contact-section h5 {
  margin: 0 0 10px 0;
  font-size: 1.3rem;
  font-weight: 700;
}

.contact-section p {
  margin: 0 0 20px 0;
  opacity: 0.95;
  font-size: 1rem;
}

.btn-contact {
  padding: 14px 35px;
  background: white;
  color: var(--primary-color);
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  font-weight: 600;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
}

.btn-contact:hover {
  background: var(--gray-50);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
}

/* Dark mode adjustments */
@media (prefers-color-scheme: dark) {
  .page-section {
    background: var(--gray-50);
  }
  
  .content-card {
    background: var(--surface-color);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  }
  
  .content-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  }
  
  .content-card h3 {
    color: var(--gray-100);
  }
  
  .content-card > p {
    color: var(--gray-300);
  }
  
  .partner-card {
    background: var(--gray-100);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }
  
  .partner-card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
  }
  
  .partner-info h4 {
    color: var(--gray-100);
  }
  
  .partner-info p {
    color: var(--gray-300);
  }
  
  .partner-type {
    background: rgba(168, 85, 247, 0.2);
  }
  
  .partnership-info {
    border-top-color: rgba(255, 255, 255, 0.1);
  }
  
  .partnership-info h4 {
    color: var(--gray-100);
  }
  
  .partnership-info > p {
    color: var(--gray-300);
  }
  
  .benefit-item {
    background: var(--gray-100);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  }
  
  .benefit-item:hover {
    background: var(--surface-color);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  }
  
  .benefit-item h5 {
    color: var(--gray-100);
  }
  
  .benefit-item p {
    color: var(--gray-300);
  }
  
  .btn-contact:hover {
    background: var(--gray-100);
  }
}

[data-theme="dark"] .page-section {
  background: var(--gray-50);
}

[data-theme="dark"] .content-card {
  background: var(--surface-color);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .content-card:hover {
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}

[data-theme="dark"] .content-card h3 {
  color: var(--gray-100);
}

[data-theme="dark"] .content-card > p {
  color: var(--gray-300);
}

[data-theme="dark"] .partner-card {
  background: var(--gray-100);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

[data-theme="dark"] .partner-card:hover {
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .partner-info h4 {
  color: var(--gray-100);
}

[data-theme="dark"] .partner-info p {
  color: var(--gray-300);
}

[data-theme="dark"] .partner-type {
  background: rgba(168, 85, 247, 0.2);
}

[data-theme="dark"] .partnership-info {
  border-top-color: rgba(255, 255, 255, 0.1);
}

[data-theme="dark"] .partnership-info h4 {
  color: var(--gray-100);
}

[data-theme="dark"] .partnership-info > p {
  color: var(--gray-300);
}

[data-theme="dark"] .benefit-item {
  background: var(--gray-100);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

[data-theme="dark"] .benefit-item:hover {
  background: var(--surface-color);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .benefit-item h5 {
  color: var(--gray-100);
}

[data-theme="dark"] .benefit-item p {
  color: var(--gray-300);
}

[data-theme="dark"] .btn-contact:hover {
  background: var(--gray-100);
}

/* Responsive Design - Professional Mobile Layout */
@media (max-width: 768px) {
  .content-card {
    padding: 32px 20px;
    margin: 0 16px;
    border-radius: 16px;
  }
  
  .content-card h3 {
    font-size: 1.5rem;
    margin-bottom: 16px;
  }
  
  .content-card > p {
    font-size: 1rem;
    margin-bottom: 32px;
  }
  
  .partners-grid {
    grid-template-columns: 1fr;
    gap: 16px;
    padding: 0 16px;
  }
  
  .partner-card {
    flex-direction: column;
    text-align: center;
    padding: 24px;
    border-radius: 16px;
    margin-bottom: 0;
  }
  
  .partner-logo {
    margin-right: 0;
    margin-bottom: 16px;
    width: 60px;
    height: 60px;
  }
  
  .partner-info h4 {
    font-size: 1.1rem;
    margin-bottom: 8px;
  }
  
  .partner-info p {
    font-size: 0.95rem;
    margin-bottom: 12px;
  }
  
  .partner-type {
    font-size: 0.8rem;
    padding: 6px 12px;
  }
  
  .partnership-info {
    margin-top: 40px;
    padding-top: 32px;
  }
  
  .partnership-info h4 {
    font-size: 1.3rem;
    margin-bottom: 12px;
  }
  
  .partnership-info > p {
    font-size: 1rem;
    margin-bottom: 24px;
  }
  
  .partnership-benefits {
    grid-template-columns: 1fr;
    gap: 16px;
    padding: 0 16px;
  }
  
  .benefit-item {
    padding: 24px;
    border-radius: 16px;
    text-align: center;
  }
  
  .benefit-item i {
    font-size: 2rem;
    margin-bottom: 12px;
  }
  
  .benefit-item h5 {
    font-size: 1.1rem;
    margin-bottom: 8px;
  }
  
  .benefit-item p {
    font-size: 0.9rem;
    line-height: 1.5;
  }
  
  .contact-section {
    padding: 32px 20px;
    margin: 0 16px;
    border-radius: 16px;
  }
  
  .contact-section h5 {
    font-size: 1.2rem;
    margin-bottom: 12px;
  }
  
  .contact-section p {
    font-size: 0.95rem;
    margin-bottom: 20px;
  }
  
  .btn-contact {
    width: 100%;
    max-width: 280px;
    padding: 16px 24px;
    font-size: 1rem;
    border-radius: 12px;
  }
}

@media (max-width: 480px) {
  .content-card {
    padding: 24px 16px;
    margin: 0 12px;
  }
  
  .content-card h3 {
    font-size: 1.4rem;
  }
  
  .partners-grid {
    padding: 0 12px;
    gap: 12px;
  }
  
  .partner-card {
    padding: 20px;
  }
  
  .partner-logo {
    width: 50px;
    height: 50px;
  }
  
  .partnership-benefits {
    padding: 0 12px;
    gap: 12px;
  }
  
  .benefit-item {
    padding: 20px;
  }
  
  .benefit-item i {
    font-size: 1.8rem;
  }
  
  .contact-section {
    padding: 24px 16px;
    margin: 0 12px;
  }
  
  .btn-contact {
    max-width: 240px;
    padding: 14px 20px;
  }
}
</style>
