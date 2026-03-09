<template>
  <div class="policy-page">
    <Header />
    
    <main class="main">
      <section class="page-section">
        <div class="container">
          <div class="section-title" data-aos="fade-up">
            <h2>Policies</h2>
            <p>GECO RWANDA Organizational Policies</p>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <div class="content-card" data-aos="fade-up">
                <h3>Organizational Policies</h3>
                <p>Our policies ensure transparency, accountability, and effective governance in all aspects of our operations.</p>
                
                <div class="policy-content">
                  <div class="policy-section">
                    <h4><i class="bi bi-shield-check"></i> Child Protection Policy</h4>
                    <p>GECO RWANDA is committed to protecting children from harm and abuse. We have zero tolerance for any form of child exploitation and ensure all staff and volunteers undergo thorough background checks.</p>
                  </div>
                  
                  <div class="policy-section">
                    <h4><i class="bi bi-heart"></i> Health and Safety Policy</h4>
                    <p>We maintain high standards of health and safety in all our programs and facilities, ensuring the well-being of beneficiaries, staff, and volunteers.</p>
                  </div>
                  
                  <div class="policy-section">
                    <h4><i class="bi bi-lock"></i> Data Protection Policy</h4>
                    <p>We protect the personal information of our beneficiaries and stakeholders, complying with data protection regulations and ensuring confidentiality.</p>
                  </div>
                  
                  <div class="policy-section">
                    <h4><i class="bi bi-balance-scale"></i> Equal Opportunity Policy</h4>
                    <p>GECO RWANDA promotes equal opportunities and non-discrimination in all aspects of our work, ensuring fair treatment regardless of gender, age, disability, or background.</p>
                  </div>
                  
                  <div class="policy-section">
                    <h4><i class="bi bi-cash-stack"></i> Financial Management Policy</h4>
                    <p>We maintain transparent financial management practices, ensuring proper use of funds and regular reporting to stakeholders.</p>
                  </div>
                  
                  <div class="policy-section">
                    <h4><i class="bi bi-people"></i> Volunteer Management Policy</h4>
                    <p>Our volunteer policy ensures proper recruitment, training, and support for volunteers who contribute to our mission.</p>
                  </div>
                </div>
                
                <div class="download-section">
                  <h4>Download Complete Policy Document</h4>
                  <button class="btn-download">
                    <i class="bi bi-file-pdf"></i> Download PDF (2.1 MB)
                  </button>
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
// Policies page
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

.policy-content {
  margin: 30px 0;
}

.policy-section {
  margin-bottom: 25px;
  padding: 20px;
  background: #f8f9fa;
  border-radius: 8px;
  border-left: 4px solid rgb(161, 83, 164);
}

.policy-section h4 {
  color: rgb(161, 83, 164);
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.policy-section h4 i {
  font-size: 1.2rem;
}

.policy-section p {
  margin-bottom: 0;
  line-height: 1.6;
}

.download-section {
  text-align: center;
  margin-top: 40px;
  padding: 30px;
  background: #f8f9fa;
  border-radius: 8px;
}

.download-section h4 {
  margin-bottom: 20px;
  color: #333;
}

.btn-download {
  padding: 12px 30px;
  background: rgb(161, 83, 164);
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  transition: background-color 0.3s;
}

.btn-download:hover {
  background: rgb(141, 63, 144);
}
</style>
