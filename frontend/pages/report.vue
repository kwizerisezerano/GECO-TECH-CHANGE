<template>
  <div class="report-page">
    <Header />
    
    <main class="main">
      <section class="page-section">
        <div class="container">
          <div class="section-title" data-aos="fade-up">
            <h2>Annual Report</h2>
            <p>GECO RWANDA Annual Reports and Documentation</p>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <div class="content-card" data-aos="fade-up">
                <h3>Annual Reports</h3>
                <p>Download our annual reports to learn about our progress and achievements.</p>
                
                <div class="document-list">
                  <div class="document-item">
                    <i class="bi bi-file-pdf"></i>
                    <div class="document-info">
                      <h4>Annual Report 2023</h4>
                      <p>Comprehensive report on our activities and impact in 2023</p>
                    </div>
                    <button class="btn-download">Download</button>
                  </div>
                  
                  <div class="document-item">
                    <i class="bi bi-file-pdf"></i>
                    <div class="document-info">
                      <h4>Annual Report 2022</h4>
                      <p>Review of our programs and achievements in 2022</p>
                    </div>
                    <button class="btn-download">Download</button>
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
// Annual reports page
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
  margin-bottom: 30px;
}

.document-list {
  margin-top: 30px;
}

.document-item {
  display: flex;
  align-items: center;
  padding: 20px;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  margin-bottom: 15px;
  transition: all 0.3s;
}

.document-item:hover {
  border-color: rgb(161, 83, 164);
  box-shadow: 0 3px 10px rgba(161, 83, 164, 0.1);
}

.document-item i {
  font-size: 2rem;
  color: rgb(161, 83, 164);
  margin-right: 20px;
}

.document-info {
  flex: 1;
}

.document-info h4 {
  margin: 0 0 5px 0;
  color: #333;
}

.document-info p {
  margin: 0;
  color: #666;
  font-size: 0.9rem;
}

.btn-download {
  padding: 10px 20px;
  background: rgb(161, 83, 164);
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn-download:hover {
  background: rgb(141, 63, 144);
}
</style>
