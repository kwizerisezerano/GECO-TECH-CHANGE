<template>
  <div class="ibe-page">
    <Header />
    
    <main class="main">
      <section class="page-section">
        <div class="container">
          <div class="section-title" data-aos="fade-up">
            <h2>IBE Certificate</h2>
            <p>International Bureau for Epilepsy Certification</p>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <div class="content-card" data-aos="fade-up">
                <h3>International Bureau for Epilepsy Recognition</h3>
                <p>GECO RWANDA is proud to be recognized by the International Bureau for Epilepsy (IBE) for our commitment to supporting people with epilepsy in Rwanda.</p>
                
                <div class="certificate-info">
                  <div class="certificate-image">
                    <i class="bi bi-award"></i>
                  </div>
                  <div class="certificate-details">
                    <h4>Certificate of Recognition</h4>
                    <p><strong>Issued by:</strong> International Bureau for Epilepsy</p>
                    <p><strong>Date:</strong> October 2023</p>
                    <p><strong>Certificate Number:</strong> IBE-RW-2023-015</p>
                    <p><strong>Valid Until:</strong> October 2026</p>
                  </div>
                </div>
                
                <div class="recognition-criteria">
                  <h4>Recognition Criteria</h4>
                  <div class="criteria-grid">
                    <div class="criteria-item">
                      <i class="bi bi-check-circle"></i>
                      <h5>Quality Healthcare Services</h5>
                      <p>Provision of comprehensive epilepsy care and treatment services</p>
                    </div>
                    
                    <div class="criteria-item">
                      <i class="bi bi-check-circle"></i>
                      <h5>Community Engagement</h5>
                      <p>Active involvement in community awareness and education programs</p>
                    </div>
                    
                    <div class="criteria-item">
                      <i class="bi bi-check-circle"></i>
                      <h5>Professional Standards</h5>
                      <p>Adherence to international standards in epilepsy management</p>
                    </div>
                    
                    <div class="criteria-item">
                      <i class="bi bi-check-circle"></i>
                      <h5>Advocacy Impact</h5>
                      <p>Significant contributions to epilepsy advocacy and policy development</p>
                    </div>
                  </div>
                </div>
                
                <div class="benefits-section">
                  <h4>Benefits of IBE Recognition</h4>
                  <div class="benefits-list">
                    <div class="benefit-item">
                      <i class="bi bi-star"></i>
                      <span>International credibility and recognition</span>
                    </div>
                    <div class="benefit-item">
                      <i class="bi bi-star"></i>
                      <span>Access to global epilepsy network</span>
                    </div>
                    <div class="benefit-item">
                      <i class="bi bi-star"></i>
                      <span>Opportunities for collaboration and partnerships</span>
                    </div>
                    <div class="benefit-item">
                      <i class="bi bi-star"></i>
                      <span>Enhanced funding opportunities</span>
                    </div>
                    <div class="benefit-item">
                      <i class="bi bi-star"></i>
                      <span>Technical support and capacity building</span>
                    </div>
                  </div>
                </div>
                
                <div class="download-section">
                  <h4>View Certificate</h4>
                  <div class="certificate-actions">
                    <button class="btn-download">
                      <i class="bi bi-file-pdf"></i> Download Certificate PDF
                    </button>
                    <button class="btn-verify">
                      <i class="bi bi-shield-check"></i> Verify Certificate
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
// IBE Certificate page
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
  min-width: 120px;
  display: inline-block;
}

.recognition-criteria {
  margin: 50px 0;
}

.recognition-criteria h4 {
  color: #333;
  margin-bottom: 30px;
  text-align: center;
  font-size: 1.8rem;
}

.criteria-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
}

.criteria-item {
  text-align: center;
  padding: 25px;
  background: #f8f9fa;
  border-radius: 8px;
  border-top: 3px solid rgb(161, 83, 164);
}

.criteria-item i {
  font-size: 2.5rem;
  color: rgb(161, 83, 164);
  margin-bottom: 15px;
}

.criteria-item h5 {
  margin: 0 0 10px 0;
  color: #333;
  font-size: 1.1rem;
}

.criteria-item p {
  margin: 0;
  color: #666;
  font-size: 0.9rem;
  line-height: 1.4;
}

.benefits-section {
  margin: 50px 0;
}

.benefits-section h4 {
  color: #333;
  margin-bottom: 25px;
  text-align: center;
  font-size: 1.8rem;
}

.benefits-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 15px;
}

.benefit-item {
  display: flex;
  align-items: center;
  padding: 15px 20px;
  background: #f8f9fa;
  border-radius: 5px;
  border-left: 3px solid rgb(161, 83, 164);
}

.benefit-item i {
  color: rgb(161, 83, 164);
  margin-right: 15px;
  font-size: 1.2rem;
}

.benefit-item span {
  color: #333;
  font-weight: 500;
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

.certificate-actions {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.btn-download, .btn-verify {
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

.btn-verify {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  border: 2px solid white;
}

.btn-verify:hover {
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
  
  .certificate-actions {
    flex-direction: column;
    align-items: center;
  }
  
  .btn-download, .btn-verify {
    width: 100%;
    max-width: 250px;
  }
}
</style>
