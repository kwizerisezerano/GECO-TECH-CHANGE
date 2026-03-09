<template>
  <div class="rgb-page">
    <Header />
    
    <main class="main">
      <section class="page-section">
        <div class="container">
          <div class="section-title" data-aos="fade-up">
            <h2>RGB Certificate</h2>
            <p>Rwanda Governance Board Registration</p>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <div class="content-card" data-aos="fade-up">
                <h3>Rwanda Governance Board Certification</h3>
                <p>GECO RWANDA is officially registered and recognized by the Rwanda Governance Board (RGB), confirming our compliance with national standards for non-governmental organizations.</p>
                
                <div class="certificate-info">
                  <div class="certificate-image">
                    <i class="bi bi-building"></i>
                  </div>
                  <div class="certificate-details">
                    <h4>Registration Certificate</h4>
                    <p><strong>Issued by:</strong> Rwanda Governance Board</p>
                    <p><strong>Registration Number:</strong> RGB/NGO/2022/456</p>
                    <p><strong>Date of Registration:</strong> March 15, 2022</p>
                    <p><strong>Legal Status:</strong> National Non-Governmental Organization</p>
                    <p><strong>Renewal Date:</strong> March 15, 2025</p>
                  </div>
                </div>
                
                <div class="registration-details">
                  <h4>Registration Details</h4>
                  <div class="details-grid">
                    <div class="detail-item">
                      <h5><i class="bi bi-geo-alt"></i> Jurisdiction</h5>
                      <p>National coverage - Republic of Rwanda</p>
                    </div>
                    
                    <div class="detail-item">
                      <h5><i class="bi bi-bullseye"></i> Scope of Work</h5>
                      <p>Healthcare, Education, Advocacy, Social Services</p>
                    </div>
                    
                    <div class="detail-item">
                      <h5><i class="bi bi-people"></i> Beneficiaries</h5>
                      <p>People with epilepsy and mental health conditions</p>
                    </div>
                    
                    <div class="detail-item">
                      <h5><i class="bi bi-shield-check"></i> Compliance Status</h5>
                      <p>Fully compliant with all NGO regulations</p>
                    </div>
                  </div>
                </div>
                
                <div class="compliance-section">
                  <h4>Compliance Requirements Met</h4>
                  <div class="compliance-list">
                    <div class="compliance-item">
                      <i class="bi bi-check-circle-fill"></i>
                      <div class="compliance-content">
                        <h5>Legal Framework</h5>
                        <p>Full compliance with Law No. 04/2012 of 17/02/2012 governing NGOs in Rwanda</p>
                      </div>
                    </div>
                    
                    <div class="compliance-item">
                      <i class="bi bi-check-circle-fill"></i>
                      <div class="compliance-content">
                        <h5>Financial Management</h5>
                        <p>Transparent financial systems and regular audit reports</p>
                      </div>
                    </div>
                    
                    <div class="compliance-item">
                      <i class="bi bi-check-circle-fill"></i>
                      <div class="compliance-content">
                        <h5>Governance Structure</h5>
                        <p>Proper board structure and organizational governance</p>
                      </div>
                    </div>
                    
                    <div class="compliance-item">
                      <i class="bi bi-check-circle-fill"></i>
                      <div class="compliance-content">
                        <h5>Reporting Requirements</h5>
                        <p>Regular activity and financial reports submitted to RGB</p>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="benefits-section">
                  <h4>Benefits of RGB Registration</h4>
                  <div class="benefits-grid">
                    <div class="benefit-card">
                      <i class="bi bi-award"></i>
                      <h5>Legal Recognition</h5>
                      <p>Official recognition as a legitimate NGO in Rwanda</p>
                    </div>
                    
                    <div class="benefit-card">
                      <i class="bi bi-handshake"></i>
                      <h5>Partnership Opportunities</h5>
                      <p>Eligibility for government partnerships and funding</p>
                    </div>
                    
                    <div class="benefit-card">
                      <i class="bi bi-globe"></i>
                      <h5>International Credibility</h5>
                      <p>Enhanced credibility with international donors</p>
                    </div>
                    
                    <div class="benefit-card">
                      <i class="bi bi-shield-check"></i>
                      <h5>Regulatory Protection</h5>
                      <p>Legal protection and support from government agencies</p>
                    </div>
                  </div>
                </div>
                
                <div class="download-section">
                  <h4>Registration Documents</h4>
                  <div class="document-actions">
                    <button class="btn-download">
                      <i class="bi bi-file-pdf"></i> Download Registration Certificate
                    </button>
                    <button class="btn-verify">
                      <i class="bi bi-search"></i> Verify Registration
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
// RGB Certificate page
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

.registration-details {
  margin: 50px 0;
}

.registration-details h4 {
  color: #333;
  margin-bottom: 30px;
  text-align: center;
  font-size: 1.8rem;
}

.details-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
}

.detail-item {
  text-align: center;
  padding: 25px;
  background: #f8f9fa;
  border-radius: 8px;
  border-top: 3px solid rgb(161, 83, 164);
}

.detail-item h5 {
  color: rgb(161, 83, 164);
  margin: 0 0 10px 0;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

.detail-item h5 i {
  font-size: 1.2rem;
}

.detail-item p {
  margin: 0;
  color: #666;
  line-height: 1.4;
}

.compliance-section {
  margin: 50px 0;
}

.compliance-section h4 {
  color: #333;
  margin-bottom: 30px;
  text-align: center;
  font-size: 1.8rem;
}

.compliance-list {
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
}

.compliance-item {
  display: flex;
  align-items: flex-start;
  padding: 20px;
  background: #f8f9fa;
  border-radius: 8px;
  border-left: 4px solid #28a745;
}

.compliance-item i {
  color: #28a745;
  font-size: 1.5rem;
  margin-right: 20px;
  margin-top: 5px;
}

.compliance-content h5 {
  margin: 0 0 8px 0;
  color: #333;
}

.compliance-content p {
  margin: 0;
  color: #666;
  line-height: 1.4;
}

.benefits-section {
  margin: 50px 0;
}

.benefits-section h4 {
  color: #333;
  margin-bottom: 30px;
  text-align: center;
  font-size: 1.8rem;
}

.benefits-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 25px;
}

.benefit-card {
  text-align: center;
  padding: 30px 20px;
  background: linear-gradient(135deg, rgb(161, 83, 164), rgb(141, 63, 144));
  color: white;
  border-radius: 10px;
  transition: transform 0.3s;
}

.benefit-card:hover {
  transform: translateY(-5px);
}

.benefit-card i {
  font-size: 2.5rem;
  margin-bottom: 15px;
}

.benefit-card h5 {
  margin: 0 0 10px 0;
  font-size: 1.1rem;
}

.benefit-card p {
  margin: 0;
  font-size: 0.9rem;
  opacity: 0.9;
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
  
  .document-actions {
    flex-direction: column;
    align-items: center;
  }
  
  .btn-download, .btn-verify {
    width: 100%;
    max-width: 250px;
  }
}
</style>
