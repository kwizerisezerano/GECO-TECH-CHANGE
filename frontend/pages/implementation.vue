<template>
  <div class="implementation-page">
    <Header />
    
    <main class="main">
      <section class="page-section">
        <div class="container">
          <div class="section-title" data-aos="fade-up">
            <h2>Implementation Plan</h2>
            <p>GECO RWANDA Strategic Implementation Framework</p>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <div class="content-card" data-aos="fade-up">
                <h3>Strategic Implementation Plan 2024-2030</h3>
                <p>Our comprehensive implementation plan outlines the strategic actions and timelines for achieving our mission and vision.</p>
                
                <div class="implementation-content">
                  <div class="implementation-phase">
                    <h4><i class="bi bi-calendar-range"></i> Phase 1: Foundation Building (2024-2025)</h4>
                    <ul>
                      <li>Strengthen organizational capacity and governance</li>
                      <li>Establish strategic partnerships with healthcare providers</li>
                      <li>Develop community outreach programs in 3 target districts</li>
                      <li>Train 100 healthcare workers in epilepsy management</li>
                      <li>Establish monitoring and evaluation systems</li>
                    </ul>
                  </div>
                  
                  <div class="implementation-phase">
                    <h4><i class="bi bi-graph-up-arrow"></i> Phase 2: Program Expansion (2026-2027)</h4>
                    <ul>
                      <li>Expand services to 5 additional districts</li>
                      <li>Launch economic empowerment initiatives for 200 beneficiaries</li>
                      <li>Establish epilepsy support groups in 10 communities</li>
                      <li>Implement school awareness programs reaching 5,000 students</li>
                      <li>Develop telemedicine capabilities for remote areas</li>
                    </ul>
                  </div>
                  
                  <div class="implementation-phase">
                    <h4><i class="bi bi-trophy"></i> Phase 3: Sustainability (2028-2030)</h4>
                    <ul>
                      <li>Achieve nationwide coverage across all districts</li>
                      <li>Establish sustainable funding mechanisms</li>
                      <li>Develop social enterprise programs</li>
                      <li>Strengthen advocacy for policy changes</li>
                      <li>Create knowledge sharing platforms</li>
                    </ul>
                  </div>
                </div>
                
                <div class="timeline-section">
                  <h4>Key Implementation Milestones</h4>
                  <div class="timeline">
                    <div class="timeline-item">
                      <div class="timeline-date">Q2 2024</div>
                      <div class="timeline-content">
                        <h5>Staff Recruitment and Training</h5>
                        <p>Complete recruitment of core team and comprehensive training programs</p>
                      </div>
                    </div>
                    
                    <div class="timeline-item">
                      <div class="timeline-date">Q4 2024</div>
                      <div class="timeline-content">
                        <h5>First District Launch</h5>
                        <p>Launch comprehensive services in Rubavu District</p>
                      </div>
                    </div>
                    
                    <div class="timeline-item">
                      <div class="timeline-date">Q2 2025</div>
                      <div class="timeline-content">
                        <h5>Partnership Development</h5>
                        <p>Establish formal partnerships with 5 major healthcare facilities</p>
                      </div>
                    </div>
                    
                    <div class="timeline-item">
                      <div class="timeline-date">Q1 2026</div>
                      <div class="timeline-content">
                        <h5>Program Expansion</h5>
                        <p>Expand to 3 additional districts with full service coverage</p>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="download-section">
                  <h4>Download Full Implementation Plan</h4>
                  <button class="btn-download">
                    <i class="bi bi-file-pdf"></i> Download PDF (3.2 MB)
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
// Implementation plan page
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

.implementation-content {
  margin: 30px 0;
}

.implementation-phase {
  margin-bottom: 30px;
  padding: 25px;
  background: #f8f9fa;
  border-radius: 8px;
  border-left: 4px solid rgb(161, 83, 164);
}

.implementation-phase h4 {
  color: rgb(161, 83, 164);
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.implementation-phase h4 i {
  font-size: 1.2rem;
}

.implementation-phase ul {
  margin: 0;
  padding-left: 20px;
}

.implementation-phase li {
  margin-bottom: 8px;
  line-height: 1.5;
}

.timeline-section {
  margin: 40px 0;
}

.timeline-section h4 {
  margin-bottom: 25px;
  color: #333;
  text-align: center;
}

.timeline {
  position: relative;
  padding-left: 30px;
}

.timeline::before {
  content: '';
  position: absolute;
  left: 15px;
  top: 0;
  bottom: 0;
  width: 2px;
  background: rgb(161, 83, 164);
}

.timeline-item {
  position: relative;
  margin-bottom: 30px;
  padding-left: 40px;
}

.timeline-item::before {
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

.timeline-date {
  font-weight: 600;
  color: rgb(161, 83, 164);
  margin-bottom: 5px;
}

.timeline-content h5 {
  margin: 0 0 5px 0;
  color: #333;
}

.timeline-content p {
  margin: 0;
  color: #666;
  font-size: 0.9rem;
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
