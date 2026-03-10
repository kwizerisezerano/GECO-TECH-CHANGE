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
  background: var(--gray-50);
  transition: background-color 0.3s ease;
}

.content-card {
  background: var(--surface-color);
  padding: 40px;
  border-radius: 15px;
  box-shadow: var(--shadow-lg);
  border: 1px solid rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.content-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.content-card h3 {
  color: var(--gray-900);
  margin-bottom: 25px;
  font-size: 1.8rem;
  text-align: center;
  transition: color 0.3s ease;
}

.content-card > p {
  color: var(--gray-600);
  margin-bottom: 30px;
  font-size: 1.1rem;
  line-height: 1.6;
  text-align: center;
  transition: color 0.3s ease;
}

.strategic-content {
  margin: 30px 0;
}

.strategic-item {
  margin-bottom: 30px;
  padding: 25px;
  background: var(--gray-50);
  border-radius: 12px;
  border-left: 4px solid var(--primary-color);
  transition: all 0.3s ease;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.strategic-item:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow-md);
  background: var(--surface-color);
}

.strategic-item h4 {
  color: var(--primary-color);
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 1.2rem;
  font-weight: 600;
  transition: color 0.3s ease;
}

.strategic-item h4 i {
  font-size: 1.2rem;
  transition: all 0.3s ease;
}

.strategic-item:hover h4 i {
  transform: scale(1.1);
}

.strategic-item p {
  margin-bottom: 0;
  line-height: 1.6;
  color: var(--gray-600);
  transition: color 0.3s ease;
}

.strategic-item ul {
  margin: 0;
  padding-left: 20px;
  color: var(--gray-600);
  transition: color 0.3s ease;
}

.strategic-item li {
  margin-bottom: 8px;
  line-height: 1.5;
  color: var(--gray-600);
  transition: color 0.3s ease;
}

.strategic-item li strong {
  color: var(--gray-800);
  font-weight: 600;
  transition: color 0.3s ease;
}

.download-section {
  text-align: center;
  margin-top: 40px;
  padding: 40px;
  background: var(--gray-50);
  border-radius: 12px;
  border: 1px solid rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.download-section:hover {
  background: var(--surface-color);
  box-shadow: var(--shadow-md);
}

.download-section h4 {
  margin-bottom: 20px;
  color: var(--gray-900);
  font-size: 1.3rem;
  font-weight: 600;
  transition: color 0.3s ease;
}

.btn-download {
  padding: 14px 35px;
  background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 600;
  box-shadow: 0 4px 15px rgba(168, 85, 247, 0.3);
}

.btn-download:hover {
  background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(168, 85, 247, 0.4);
}

/* Dark mode adjustments */
@media (prefers-color-scheme: dark) {
  .page-section {
    background: var(--gray-50);
  }
  
  .content-card {
    background: var(--surface-color);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  }
  
  .content-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  }
  
  .content-card h3 {
    color: var(--gray-100);
  }
  
  .content-card > p {
    color: var(--gray-300);
  }
  
  .strategic-item {
    background: var(--gray-100);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  }
  
  .strategic-item:hover {
    background: var(--surface-color);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  }
  
  .strategic-item p {
    color: var(--gray-300);
  }
  
  .strategic-item ul {
    color: var(--gray-300);
  }
  
  .strategic-item li {
    color: var(--gray-300);
  }
  
  .strategic-item li strong {
    color: var(--gray-200);
  }
  
  .download-section {
    background: var(--gray-100);
    border: 1px solid rgba(255, 255, 255, 0.1);
  }
  
  .download-section:hover {
    background: var(--surface-color);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  }
  
  .download-section h4 {
    color: var(--gray-100);
  }
  
  .btn-download:hover {
    box-shadow: 0 8px 25px rgba(168, 85, 247, 0.5);
  }
}

[data-theme="dark"] .page-section {
  background: var(--gray-50);
}

[data-theme="dark"] .content-card {
  background: var(--surface-color);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .content-card:hover {
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}

[data-theme="dark"] .content-card h3 {
  color: var(--gray-100);
}

[data-theme="dark"] .content-card > p {
  color: var(--gray-300);
}

[data-theme="dark"] .strategic-item {
  background: var(--gray-100);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

[data-theme="dark"] .strategic-item:hover {
  background: var(--surface-color);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .strategic-item p {
  color: var(--gray-300);
}

[data-theme="dark"] .strategic-item ul {
  color: var(--gray-300);
}

[data-theme="dark"] .strategic-item li {
  color: var(--gray-300);
}

[data-theme="dark"] .strategic-item li strong {
  color: var(--gray-200);
}

[data-theme="dark"] .download-section {
  background: var(--gray-100);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

[data-theme="dark"] .download-section:hover {
  background: var(--surface-color);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

[data-theme="dark"] .download-section h4 {
  color: var(--gray-100);
}

[data-theme="dark"] .btn-download:hover {
  box-shadow: 0 8px 25px rgba(168, 85, 247, 0.5);
}

/* Responsive Design - Professional Mobile Layout */
@media (max-width: 768px) {
  .content-card {
    padding: 32px 20px;
    margin: 0 16px;
    border-radius: 16px;
  }
  
  .content-card h3 {
    font-size: 1.5rem;
    margin-bottom: 20px;
  }
  
  .content-card > p {
    font-size: 1rem;
    margin-bottom: 24px;
  }
  
  .strategic-item {
    padding: 24px;
    border-radius: 16px;
    margin-bottom: 16px;
  }
  
  .strategic-item h4 {
    font-size: 1.1rem;
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
  }
  
  .strategic-item h4 i {
    font-size: 1.2rem;
    margin-bottom: 8px;
  }
  
  .strategic-item p {
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 16px;
  }
  
  .strategic-item ul {
    margin: 0;
    padding-left: 20px;
  }
  
  .strategic-item li {
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 10px;
  }
  
  .strategic-item li strong {
    font-weight: 600;
  }
  
  .download-section {
    padding: 24px 20px;
    margin: 0 16px;
    border-radius: 16px;
  }
  
  .download-section h4 {
    font-size: 1.2rem;
    margin-bottom: 16px;
  }
  
  .btn-download {
    width: 100%;
    max-width: 280px;
    padding: 16px 24px;
    font-size: 1rem;
    border-radius: 12px;
  }
}

@media (max-width: 480px) {
  .content-card {
    padding: 24px 16px;
    margin: 0 12px;
  }
  
  .content-card h3 {
    font-size: 1.4rem;
  }
  
  .strategic-item {
    padding: 20px;
  }
  
  .strategic-item h4 {
    font-size: 1rem;
    gap: 8px;
  }
  
  .strategic-item h4 i {
    font-size: 1rem;
  }
  
  .strategic-item p {
    font-size: 0.9rem;
  }
  
  .strategic-item li {
    font-size: 0.9rem;
  }
  
  .download-section {
    padding: 20px 16px;
    margin: 0 12px;
  }
  
  .download-section h4 {
    font-size: 1.1rem;
  }
  
  .btn-download {
    max-width: 240px;
    padding: 14px 20px;
    font-size: 0.95rem;
  }
}
</style>
