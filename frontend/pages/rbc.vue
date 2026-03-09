<template>
  <div class="rbc-page">
    <Header />
    
    <main class="main">
      <section class="page-section">
        <div class="container">
          <div class="section-title" data-aos="fade-up">
            <h2>RBC Certificate</h2>
            <p>Rwanda Biomedical Center Partnership</p>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <div class="content-card" data-aos="fade-up">
                <h3>Rwanda Biomedical Center Recognition</h3>
                <p>GECO RWANDA is officially recognized and partnered with the Rwanda Biomedical Center (RBC) for our contributions to healthcare delivery and epilepsy management in Rwanda.</p>
                
                <div class="certificate-info">
                  <div class="certificate-image">
                    <i class="bi bi-hospital"></i>
                  </div>
                  <div class="certificate-details">
                    <h4>Partnership Certificate</h4>
                    <p><strong>Issued by:</strong> Rwanda Biomedical Center</p>
                    <p><strong>Partnership ID:</strong> RBC-PART-2023-089</p>
                    <p><strong>Date of Issue:</strong> June 10, 2023</p>
                    <p><strong>Partnership Type:</strong> Healthcare Service Delivery</p>
                    <p><strong>Status:</strong> Active Partnership</p>
                  </div>
                </div>
                
                <div class="partnership-details">
                  <h4>Partnership Scope</h4>
                  <div class="scope-grid">
                    <div class="scope-item">
                      <h5><i class="bi bi-heart-pulse"></i> Clinical Services</h5>
                      <p>Support for epilepsy diagnosis, treatment, and follow-up care</p>
                    </div>
                    
                    <div class="scope-item">
                      <h5><i class="bi bi-people"></i> Training & Capacity Building</h5>
                      <p>Healthcare worker training in epilepsy management</p>
                    </div>
                    
                    <div class="scope-item">
                      <h5><i class="bi bi-megaphone"></i> Community Outreach</h5>
                      <p>Awareness campaigns and community education programs</p>
                    </div>
                    
                    <div class="scope-item">
                      <h5><i class="bi bi-graph-up"></i> Data Collection</h5>
                      <p>Epidemiological data collection and research support</p>
                    </div>
                  </div>
                </div>
                
                <div class="achievements-section">
                  <h4>Key Achievements Through Partnership</h4>
                  <div class="achievements-timeline">
                    <div class="achievement-milestone" v-for="milestone in milestones" :key="milestone.id">
                      <div class="milestone-date">{{ milestone.date }}</div>
                      <div class="milestone-content">
                        <h5>{{ milestone.title }}</h5>
                        <p>{{ milestone.description }}</p>
                        <div class="milestone-impact">
                          <span class="impact-badge">{{ milestone.impact }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="collaboration-section">
                  <h4>Collaboration Impact</h4>
                  <div class="impact-stats">
                    <div class="impact-item" v-for="stat in impactStats" :key="stat.id">
                      <div class="impact-number">{{ stat.number }}</div>
                      <div class="impact-label">{{ stat.label }}</div>
                    </div>
                  </div>
                </div>
                
                <div class="future-section">
                  <h4>Future Collaboration Plans</h4>
                  <div class="future-grid">
                    <div class="future-item">
                      <i class="bi bi-rocket-takeoff"></i>
                      <h5>Telemedicine Program</h5>
                      <p>Launch telemedicine services for remote epilepsy consultation</p>
                    </div>
                    
                    <div class="future-item">
                      <i class="bi bi-database"></i>
                      <h5>National Registry</h5>
                      <p>Establish national epilepsy registry for better data management</p>
                    </div>
                    
                    <div class="future-item">
                      <i class="bi bi-book"></i>
                      <h5>Research Initiatives</h5>
                      <p>Collaborative research on epilepsy prevalence and treatment</p>
                    </div>
                  </div>
                </div>
                
                <div class="download-section">
                  <h4>Partnership Documents</h4>
                  <div class="document-actions">
                    <button class="btn-download">
                      <i class="bi bi-file-pdf"></i> Download Partnership Certificate
                    </button>
                    <button class="btn-view">
                      <i class="bi bi-eye"></i> View Partnership Details
                    </button>
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
const milestones = ref([
  {
    id: 1,
    date: 'Q2 2023',
    title: 'Healthcare Worker Training',
    description: 'Trained 67 healthcare professionals in epilepsy management and care protocols.',
    impact: 'Capacity Building'
  },
  {
    id: 2,
    date: 'Q3 2023',
    title: 'School Awareness Program',
    description: 'Reached 4,233 students with epilepsy education and awareness campaigns.',
    impact: 'Community Education'
  },
  {
    id: 3,
    date: 'Q4 2023',
    title: 'Medical Insurance Support',
    description: 'Facilitated health insurance coverage for 333 people with epilepsy.',
    impact: 'Healthcare Access'
  },
  {
    id: 4,
    date: 'Q1 2024',
    title: 'Economic Empowerment',
    description: 'Supported 16 groups with financial assistance for income-generating activities.',
    impact: 'Economic Inclusion'
  }
])

const impactStats = ref([
  { id: 1, number: '67', label: 'Healthcare Workers Trained' },
  { id: 2, number: '4,233', label: 'Students Reached' },
  { id: 3, number: '333', label: 'Insurance Coverage Provided' },
  { id: 4, number: '16', label: 'Economic Groups Supported' }
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

.certificate-info {
  display: flex;
  align-items: center;
  margin: 40px 0;
  padding: 30px;
  background: linear-gradient(135deg, rgba(161, 83, 164, 0.1), rgba(141, 63, 144, 0.1));
  border-radius: 10px;
  border-left: 4px solid rgb(161, 83, 164);
}

.certificate-image {
  width: 120px;
  height: 120px;
  background: rgb(161, 83, 164);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 30px;
  flex-shrink: 0;
}

.certificate-image i {
  font-size: 3rem;
  color: white;
}

.certificate-details h4 {
  margin: 0 0 20px 0;
  color: #333;
  font-size: 1.5rem;
}

.certificate-details p {
  margin: 8px 0;
  color: #666;
  font-size: 1rem;
}

.certificate-details strong {
  color: #333;
  min-width: 140px;
  display: inline-block;
}

.partnership-details {
  margin: 50px 0;
}

.partnership-details h4 {
  color: #333;
  margin-bottom: 30px;
  text-align: center;
  font-size: 1.8rem;
}

.scope-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
}

.scope-item {
  text-align: center;
  padding: 25px;
  background: #f8f9fa;
  border-radius: 8px;
  border-top: 3px solid rgb(161, 83, 164);
}

.scope-item h5 {
  color: rgb(161, 83, 164);
  margin: 0 0 10px 0;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

.scope-item h5 i {
  font-size: 1.2rem;
}

.scope-item p {
  margin: 0;
  color: #666;
  line-height: 1.4;
}

.achievements-section {
  margin: 50px 0;
}

.achievements-section h4 {
  color: #333;
  margin-bottom: 30px;
  text-align: center;
  font-size: 1.8rem;
}

.achievements-timeline {
  position: relative;
  padding-left: 30px;
}

.achievements-timeline::before {
  content: '';
  position: absolute;
  left: 15px;
  top: 0;
  bottom: 0;
  width: 2px;
  background: rgb(161, 83, 164);
}

.achievement-milestone {
  position: relative;
  margin-bottom: 30px;
  padding-left: 40px;
}

.achievement-milestone::before {
  content: '';
  position: absolute;
  left: -9px;
  top: 5px;
  width: 20px;
  height: 20px;
  background: rgb(161, 83, 164);
  border-radius: 50%;
  border: 3px solid white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.milestone-date {
  font-weight: 600;
  color: rgb(161, 83, 164);
  margin-bottom: 5px;
}

.milestone-content h5 {
  margin: 0 0 5px 0;
  color: #333;
}

.milestone-content p {
  margin: 0 0 10px 0;
  color: #666;
  font-size: 0.9rem;
  line-height: 1.4;
}

.impact-badge {
  display: inline-block;
  padding: 4px 10px;
  background: rgba(161, 83, 164, 0.1);
  color: rgb(161, 83, 164);
  border-radius: 15px;
  font-size: 0.8rem;
  font-weight: 500;
}

.collaboration-section {
  margin: 50px 0;
}

.collaboration-section h4 {
  color: #333;
  margin-bottom: 30px;
  text-align: center;
  font-size: 1.8rem;
}

.impact-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 25px;
}

.impact-item {
  text-align: center;
  padding: 30px 20px;
  background: linear-gradient(135deg, rgb(161, 83, 164), rgb(141, 63, 144));
  color: white;
  border-radius: 10px;
  transition: transform 0.3s;
}

.impact-item:hover {
  transform: translateY(-5px);
}

.impact-number {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 10px;
}

.impact-label {
  font-size: 0.9rem;
  opacity: 0.9;
}

.future-section {
  margin: 50px 0;
}

.future-section h4 {
  color: #333;
  margin-bottom: 30px;
  text-align: center;
  font-size: 1.8rem;
}

.future-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 25px;
}

.future-item {
  text-align: center;
  padding: 30px;
  background: #f8f9fa;
  border-radius: 8px;
  border-left: 4px solid rgb(161, 83, 164);
}

.future-item i {
  font-size: 2.5rem;
  color: rgb(161, 83, 164);
  margin-bottom: 15px;
}

.future-item h5 {
  margin: 0 0 10px 0;
  color: #333;
}

.future-item p {
  margin: 0;
  color: #666;
  line-height: 1.4;
}

.download-section {
  text-align: center;
  margin-top: 50px;
  padding: 40px;
  background: linear-gradient(135deg, rgb(161, 83, 164), rgb(141, 63, 144));
  border-radius: 10px;
  color: white;
}

.download-section h4 {
  margin: 0 0 30px 0;
  font-size: 1.8rem;
}

.document-actions {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.btn-download, .btn-view {
  padding: 12px 30px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  transition: all 0.3s;
}

.btn-download {
  background: white;
  color: rgb(161, 83, 164);
}

.btn-download:hover {
  background: #f8f9fa;
  transform: translateY(-2px);
}

.btn-view {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  border: 2px solid white;
}

.btn-view:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: translateY(-2px);
}

@media (max-width: 768px) {
  .certificate-info {
    flex-direction: column;
    text-align: center;
  }
  
  .certificate-image {
    margin-right: 0;
    margin-bottom: 20px;
  }
  
  .document-actions {
    flex-direction: column;
    align-items: center;
  }
  
  .btn-download, .btn-view {
    width: 100%;
    max-width: 250px;
  }
}
</style>
