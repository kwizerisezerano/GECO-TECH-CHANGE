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
  background-color: var(--gray-50);
  color: var(--gray-800);
  transition: background-color 0.3s ease, color 0.3s ease;
}

.content-card {
  background: var(--surface-color);
  padding: 40px;
  border-radius: 10px;
  box-shadow: var(--shadow-lg);
  border: 1px solid rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

/* Dark mode adjustments */
@media (prefers-color-scheme: dark) {
  .page-section {
    background-color: var(--gray-50);
    color: var(--gray-200);
  }
  
  .content-card {
    background: var(--surface-color);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  }
}

[data-theme="dark"] .page-section {
  background-color: var(--gray-50);
  color: var(--gray-200);
}

[data-theme="dark"] .content-card {
  background: var(--surface-color);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.certificate-info {
  display: flex;
  align-items: center;
  margin: 40px 0;
  padding: 30px;
  background: linear-gradient(135deg, rgba(161, 83, 164, 0.1), rgba(141, 63, 144, 0.1));
  border-radius: 10px;
  border-left: 4px solid var(--primary-color);
  transition: all 0.3s ease;
}

.certificate-image {
  width: 120px;
  height: 120px;
  background: var(--primary-color);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 30px;
  flex-shrink: 0;
  transition: all 0.3s ease;
}

.certificate-image i {
  font-size: 3rem;
  color: white;
}

.certificate-details h4 {
  margin: 0 0 20px 0;
  color: var(--gray-900);
  font-size: 1.5rem;
  transition: color 0.3s ease;
}

.certificate-details p {
  margin: 8px 0;
  color: var(--gray-600);
  font-size: 1rem;
  transition: color 0.3s ease;
}

.certificate-details strong {
  color: var(--gray-800);
  min-width: 120px;
  display: inline-block;
  transition: color 0.3s ease;
}

/* Dark mode certificate details */
@media (prefers-color-scheme: dark) {
  .certificate-info {
    background: linear-gradient(135deg, rgba(168, 85, 247, 0.15), rgba(147, 51, 234, 0.15));
    border-left-color: var(--primary-color);
  }
  
  .certificate-image {
    background: var(--primary-color);
  }
  
  .certificate-details h4 {
    color: var(--gray-100);
  }
  
  .certificate-details p {
    color: var(--gray-300);
  }
  
  .certificate-details strong {
    color: var(--gray-200);
  }
}

[data-theme="dark"] .certificate-info {
  background: linear-gradient(135deg, rgba(168, 85, 247, 0.15), rgba(147, 51, 234, 0.15));
  border-left-color: var(--primary-color);
}

[data-theme="dark"] .certificate-image {
  background: var(--primary-color);
}

[data-theme="dark"] .certificate-details h4 {
  color: var(--gray-100);
}

[data-theme="dark"] .certificate-details p {
  color: var(--gray-300);
}

[data-theme="dark"] .certificate-details strong {
  color: var(--gray-200);
}

.recognition-criteria {
  margin: 50px 0;
}

.recognition-criteria h4 {
  color: var(--gray-900);
  margin-bottom: 30px;
  text-align: center;
  font-size: 1.8rem;
  transition: color 0.3s ease;
}

.criteria-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
}

.criteria-item {
  text-align: center;
  padding: 25px;
  background: var(--gray-50);
  border-radius: 8px;
  border-top: 3px solid var(--primary-color);
  transition: all 0.3s ease;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.criteria-item:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-lg);
}

.criteria-item i {
  font-size: 2.5rem;
  color: var(--primary-color);
  margin-bottom: 15px;
  transition: all 0.3s ease;
}

.criteria-item h5 {
  margin: 0 0 10px 0;
  color: var(--gray-900);
  font-size: 1.1rem;
  transition: color 0.3s ease;
}

.criteria-item p {
  margin: 0;
  color: var(--gray-600);
  font-size: 0.9rem;
  line-height: 1.4;
  transition: color 0.3s ease;
}

/* Dark mode criteria items */
@media (prefers-color-scheme: dark) {
  .recognition-criteria h4 {
    color: var(--gray-100);
  }
  
  .criteria-item {
    background: var(--gray-100);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }
  
  .criteria-item:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
  }
  
  .criteria-item h5 {
    color: var(--gray-100);
  }
  
  .criteria-item p {
    color: var(--gray-300);
  }
}

[data-theme="dark"] .recognition-criteria h4 {
  color: var(--gray-100);
}

[data-theme="dark"] .criteria-item {
  background: var(--gray-100);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

[data-theme="dark"] .criteria-item:hover {
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .criteria-item h5 {
  color: var(--gray-100);
}

[data-theme="dark"] .criteria-item p {
  color: var(--gray-300);
}

.benefits-section {
  margin: 50px 0;
}

.benefits-section h4 {
  color: var(--gray-900);
  margin-bottom: 25px;
  text-align: center;
  font-size: 1.8rem;
  transition: color 0.3s ease;
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
  background: var(--gray-50);
  border-radius: 5px;
  border-left: 3px solid var(--primary-color);
  transition: all 0.3s ease;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.benefit-item:hover {
  transform: translateX(5px);
  box-shadow: var(--shadow-md);
}

.benefit-item i {
  color: var(--primary-color);
  margin-right: 15px;
  font-size: 1.2rem;
  transition: all 0.3s ease;
}

.benefit-item span {
  color: var(--gray-800);
  font-weight: 500;
  transition: color 0.3s ease;
}

/* Dark mode benefits */
@media (prefers-color-scheme: dark) {
  .benefits-section h4 {
    color: var(--gray-100);
  }
  
  .benefit-item {
    background: var(--gray-100);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  }
  
  .benefit-item:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  }
  
  .benefit-item span {
    color: var(--gray-200);
  }
}

[data-theme="dark"] .benefits-section h4 {
  color: var(--gray-100);
}

[data-theme="dark"] .benefit-item {
  background: var(--gray-100);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

[data-theme="dark"] .benefit-item:hover {
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .benefit-item span {
  color: var(--gray-200);
}

.download-section {
  text-align: center;
  margin-top: 50px;
  padding: 40px;
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  border-radius: 10px;
  color: white;
  transition: all 0.3s ease;
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
  color: var(--primary-color);
}

.btn-download:hover {
  background: var(--gray-50);
  transform: translateY(-2px);
  box-shadow: var(--shadow-lg);
}

.btn-verify {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  border: 2px solid white;
}

.btn-verify:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

/* Dark mode buttons */
@media (prefers-color-scheme: dark) {
  .btn-download:hover {
    background: var(--gray-100);
  }
}

[data-theme="dark"] .btn-download:hover {
  background: var(--gray-100);
}

.btn-verify:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
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
    max-width: 300px;
  }
}
</style>
