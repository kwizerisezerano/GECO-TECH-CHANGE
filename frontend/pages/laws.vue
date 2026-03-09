<template>
  <div class="laws-page">
    <Header />
    
    <main class="main">
      <section class="page-section">
        <div class="container">
          <div class="section-title" data-aos="fade-up">
            <h2>Constitution & By-Laws</h2>
            <p>GECO RWANDA Governing Documents</p>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <div class="content-card" data-aos="fade-up">
                <h3>Constitution and By-Laws</h3>
                <p>The governing documents that establish the legal framework and operational guidelines for GECO RWANDA.</p>
                
                <div class="laws-content">
                  <div class="law-section">
                    <h4><i class="bi bi-book"></i> Article I: Name and Purpose</h4>
                    <p>The organization shall be known as Global Epilepsy Connection (GECO) RWANDA, a non-governmental organization dedicated to supporting people with epilepsy and mental health conditions.</p>
                  </div>
                  
                  <div class="law-section">
                    <h4><i class="bi bi-shield-check"></i> Article II: Mission and Vision</h4>
                    <p>Our mission is to cultivate a sense of belonging within the community while empowering individuals with epilepsy and mental disabilities through professional healthcare, socio-economic initiatives, and advocacy.</p>
                  </div>
                  
                  <div class="law-section">
                    <h4><i class="bi bi-people"></i> Article III: Membership</h4>
                    <p>Membership shall be open to individuals and organizations who support our mission and agree to abide by our constitution and by-laws.</p>
                  </div>
                  
                  <div class="law-section">
                    <h4><i class="bi bi-briefcase"></i> Article IV: Governance</h4>
                    <p>The organization shall be governed by a Board of Directors elected by the members, responsible for strategic direction and oversight.</p>
                  </div>
                  
                  <div class="law-section">
                    <h4><i class="bi bi-currency-dollar"></i> Article V: Financial Management</h4>
                    <p>All financial activities shall be conducted with transparency and accountability, following established accounting principles and regulatory requirements.</p>
                  </div>
                </div>
                
                <div class="download-section">
                  <h4>Download Complete Constitution</h4>
                  <button class="btn-download">
                    <i class="bi bi-file-pdf"></i> Download PDF (1.8 MB)
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
// Constitution and by-laws page
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

.laws-content {
  margin: 30px 0;
}

.law-section {
  margin-bottom: 25px;
  padding: 20px;
  background: #f8f9fa;
  border-radius: 8px;
  border-left: 4px solid rgb(161, 83, 164);
}

.law-section h4 {
  color: rgb(161, 83, 164);
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.law-section h4 i {
  font-size: 1.2rem;
}

.law-section p {
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
