<template>
  <div class="strategic-page">
    <Header />
    
    <main class="main">
      <section class="page-section">
        <div class="container">
          <div class="section-title" data-aos="fade-up">
            <h2>Strategic Plan</h2>
            <p>GECO RWANDA Strategic Plan 2024-2030</p>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <div class="content-card" data-aos="fade-up">
                <h3>Our Strategic Vision</h3>
                <p>The GECO RWANDA Strategic Plan 2024-2030 outlines our comprehensive approach to addressing epilepsy and mental health challenges in Rwanda.</p>
                
                <div class="strategic-content">
                  <div class="strategic-item">
                    <h4><i class="bi bi-bullseye"></i> Mission</h4>
                    <p>To cultivate a sense of belonging within the community while empowering individuals with epilepsy and mental disabilities through professional healthcare, socio-economic initiatives, and advocacy.</p>
                  </div>
                  
                  <div class="strategic-item">
                    <h4><i class="bi bi-eye"></i> Vision</h4>
                    <p>To see a country where all individuals with epilepsy and other mental disabilities enjoy full rights, social inclusion, well-being, and self-reliance.</p>
                  </div>
                  
                  <div class="strategic-item">
                    <h4><i class="bi bi-gem"></i> Core Values</h4>
                    <ul>
                      <li><strong>Respect:</strong> We treat everyone with dignity and value their contributions</li>
                      <li><strong>Inclusion:</strong> We create welcoming environments where everyone feels valued</li>
                      <li><strong>Accountability:</strong> We ensure transparency and feedback in all our actions</li>
                      <li><strong>Equity:</strong> We guarantee fair treatment and opportunity for all</li>
                      <li><strong>Impact:</strong> We strive for measurable, beneficial change</li>
                    </ul>
                  </div>
                  
                  <div class="strategic-item">
                    <h4><i class="bi bi-calendar-check"></i> Strategic Objectives</h4>
                    <ul>
                      <li>Strengthen healthcare services for epilepsy and mental health</li>
                      <li>Expand community-based support programs</li>
                      <li>Enhance advocacy and policy influence</li>
                      <li>Develop sustainable funding mechanisms</li>
                      <li>Build organizational capacity and partnerships</li>
                    </ul>
                  </div>
                </div>
                
                <div class="download-section">
                  <h4>Download Full Strategic Plan</h4>
                  <button class="btn-download">
                    <i class="bi bi-file-pdf"></i> Download PDF (2.5 MB)
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
// Strategic plan page
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

.strategic-content {
  margin: 30px 0;
}

.strategic-item {
  margin-bottom: 30px;
  padding: 20px;
  background: #f8f9fa;
  border-radius: 8px;
  border-left: 4px solid rgb(161, 83, 164);
}

.strategic-item h4 {
  color: rgb(161, 83, 164);
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.strategic-item h4 i {
  font-size: 1.2rem;
}

.strategic-item p {
  margin-bottom: 0;
  line-height: 1.6;
}

.strategic-item ul {
  margin: 0;
  padding-left: 20px;
}

.strategic-item li {
  margin-bottom: 8px;
  line-height: 1.5;
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
