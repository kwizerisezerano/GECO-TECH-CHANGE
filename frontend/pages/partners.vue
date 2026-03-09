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
}

.content-card {
  background: white;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
  background: #f8f9fa;
  border-radius: 8px;
  border-left: 4px solid rgb(161, 83, 164);
  transition: transform 0.3s, box-shadow 0.3s;
}

.partner-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.partner-logo {
  width: 60px;
  height: 60px;
  background: rgb(161, 83, 164);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 20px;
  flex-shrink: 0;
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
  color: #333;
  font-size: 1.1rem;
}

.partner-info p {
  margin: 0 0 10px 0;
  color: #666;
  line-height: 1.5;
  font-size: 0.9rem;
}

.partner-type {
  display: inline-block;
  padding: 4px 10px;
  background: rgba(161, 83, 164, 0.1);
  color: rgb(161, 83, 164);
  border-radius: 15px;
  font-size: 0.8rem;
  font-weight: 500;
}

.partnership-info {
  margin-top: 50px;
  padding-top: 30px;
  border-top: 1px solid #e0e0e0;
}

.partnership-info h4 {
  color: #333;
  margin-bottom: 15px;
  text-align: center;
}

.partnership-info > p {
  text-align: center;
  color: #666;
  margin-bottom: 30px;
}

.partnership-benefits {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
  margin-bottom: 40px;
}

.benefit-item {
  text-align: center;
  padding: 25px;
  background: #f8f9fa;
  border-radius: 8px;
}

.benefit-item i {
  font-size: 2.5rem;
  color: rgb(161, 83, 164);
  margin-bottom: 15px;
}

.benefit-item h5 {
  margin: 0 0 10px 0;
  color: #333;
}

.benefit-item p {
  margin: 0;
  color: #666;
  font-size: 0.9rem;
  line-height: 1.4;
}

.contact-section {
  text-align: center;
  padding: 30px;
  background: linear-gradient(135deg, rgb(161, 83, 164), rgb(141, 63, 144));
  border-radius: 8px;
  color: white;
}

.contact-section h5 {
  margin: 0 0 10px 0;
  font-size: 1.3rem;
}

.contact-section p {
  margin: 0 0 20px 0;
  opacity: 0.9;
}

.btn-contact {
  padding: 12px 30px;
  background: white;
  color: rgb(161, 83, 164);
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  font-weight: 600;
  transition: all 0.3s;
}

.btn-contact:hover {
  background: #f8f9fa;
  transform: translateY(-2px);
}
</style>
