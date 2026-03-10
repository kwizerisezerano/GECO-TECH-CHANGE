<template>
  <div class="app">
    <Header />
    
    <main class="main-content">
      <!-- Hero Section -->
      <section id="hero" class="hero-section">
        <div class="hero-background">
          <!-- SVG Pattern Overlay -->
          <div class="hero-svg-pattern">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
              <defs>
                <pattern id="hero-pattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse">
                  <circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/>
                  <path d="M0 50 Q 25 30, 50 50 T 100 50" stroke="rgba(255,255,255,0.05)" stroke-width="1" fill="none"/>
                </pattern>
              </defs>
              <rect width="100%" height="100%" fill="url(#hero-pattern)"/>
            </svg>
          </div>
          <div class="hero-overlay"></div>
          <img src="/assets/img/hero-bg.jpg" alt="GECO RWANDA Hero" class="hero-image" />
        </div>
        <div class="hero-content">
          <div class="hero-badge">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
              <path d="M8 0l1.5 4.6h4.8l-3.9 2.8 1.5 4.6L8 9.2 4.1 12l1.5-4.6-3.9-2.8h4.8L8 0z"/>
            </svg>
            <span>Leading Epilepsy Care Since 2010</span>
          </div>
          <h1 class="hero-title">Transforming Lives Through Compassionate Care</h1>
          <p class="hero-subtitle">
            GECO RWANDA is dedicated to providing comprehensive epilepsy care, 
            fighting stigma, and building inclusive communities across Rwanda.
          </p>
          <div class="hero-stats">
            <div class="hero-stat">
              <span class="stat-number">600K+</span>
              <span class="stat-label">Lives Impacted</span>
            </div>
            <div class="hero-stat">
              <span class="stat-number">30</span>
              <span class="stat-label">Districts Reached</span>
            </div>
            <div class="hero-stat">
              <span class="stat-number">14</span>
              <span class="stat-label">Years of Service</span>
            </div>
          </div>
          <div class="hero-actions">
            <!-- <a href="#about" class="btn btn-primary">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M8 1.318C3.89 1.318 1 4.208 1 8.318c0 2.97 2.028 5.47 4.777 6.193.35.064.478-.152.478-.338 0-.167-.006-.608-.01-1.195-1.944.423-2.356-.938-2.356-.938-.318-.808-.777-1.023-.777-1.023-.635-.435.048-.426.048-.426.703.05 1.073.722 1.073.722.625 1.07 1.64.76 2.04.582.064-.453.244-.76.444-.934-.64-.723-1.023-1.823-1.023-1.823-.828-1.123.063-1.1.063-1.1.916.064 1.397 1.243 1.397 1.243.814 1.395 2.135.992 2.656.76.07-.493.282-.76.513-.934-2.556-.29-5.233-1.278-5.233-5.688 0-1.256.448-2.283 1.186-3.087-.12-.29-.514-1.462.114-3.045 0 0 .967-.31 3.168 1.18.92-.256 1.905-.384 2.886-.388.98.004 1.966.132 2.886.388 2.2-1.49 3.168-1.18 3.168-1.18.628 1.583.234 2.755.114 3.045.74.804 1.186 1.83 1.186 3.087 0 4.423-2.68 5.398-5.233 5.688.413.356.778 1.057.778 2.132 0 1.54-.014 2.782-.014 3.162 0 .186.128.402.478.338 2.75-.723 4.777-3.223 4.777-6.193 0-4.11-2.89-7-7-7z"/>
              </svg>
              Support Our Mission
            </a> -->
            <a href="#contact" class="btn btn-outline-light">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
              </svg>
              Get Help Now
            </a>
          </div>
        </div>
        <div class="scroll-indicator">
          <a href="#about" class="scroll-link">
            <span>Discover Our Impact</span>
            <svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor">
              <path d="M8 12a.5.5 0 0 0 .354-.146l4-4a.5.5 0 0 0-.708-.708L8.5 11.293V1.5a.5.5 0 0 0-1 0v9.793L4.354 7.146a.5.5 0 1 0-.708.708l4 4A.5.5 0 0 0 8 12z"/>
            </svg>
          </a>
        </div>
      </section>

      <!-- About Section -->
      <section id="about" class="section section-light">
        <div class="container">
          <div class="section-header">
            <div class="section-badge">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 0 1 1 0 0 1 0 2z"/>
              </svg>
              <span>Our Story</span>
            </div>
            <h2 class="section-title">Pioneers in Epilepsy Care</h2>
            <p class="section-subtitle">
              From a small initiative in Rubavu to Rwanda's leading epilepsy advocacy organization
            </p>
          </div>
          
          <div class="about-grid">
            <div class="about-main">
              <div class="about-content">
                <div class="about-text">
                  <h3>A Journey of Hope and Transformation</h3>
                  <p>
                    Founded in 2010, GECO RWANDA began as a response to the overwhelming need 
                    for epilepsy care and support in Rwanda. What started as a small group of 
                    dedicated volunteers has grown into a nationwide movement touching hundreds 
                    of thousands of lives.
                  </p>
                  <p>
                    Today, we operate across all 30 districts of Rwanda, providing medical 
                    support, community education, and advocacy for people living with epilepsy. 
                    Our work is driven by the belief that everyone deserves access to quality 
                    healthcare and opportunity to live with dignity.
                  </p>
                </div>
                <div class="impact-numbers">
                  <div class="impact-item">
                    <div class="impact-number">600K+</div>
                    <div class="impact-label">People Reached</div>
                  </div>
                  <div class="impact-item">
                    <div class="impact-number">50+</div>
                    <div class="impact-label">Healthcare Partners</div>
                  </div>
                  <div class="impact-item">
                    <div class="impact-number">1000+</div>
                    <div class="impact-label">Volunteers</div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="about-sidebar">
              <div class="mission-card">
                <div class="mission-icon">
                  <svg width="24" height="24" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                  </svg>
                </div>
                <h4>Our Vision</h4>
                <p>
                  A Rwanda where epilepsy is understood, treated, and where every person 
                  affected can live their full potential without stigma or barriers.
                </p>
              </div>
              
              <div class="mission-card">
                <div class="mission-icon">
                  <svg width="24" height="24" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M14.778.085a.5.5 0 0 1 .45.634l-4 16a.5.5 0 0 1-.986-.165l-2-8a.5.5 0 0 1 .11-.425l4-5a.5.5 0 0 1 .576-.094zM4.02 4a.5.5 0 0 1 .496.426l-1 5a.5.5 0 0 1-.986-.165l.854-4.27L2.034 4.5a.5.5 0 0 1 .473-.5H4z"/>
                  </svg>
                </div>
                <h4>Our Mission</h4>
                <p>
                  To provide comprehensive care, advance medical treatment, educate communities, 
                  and advocate for policies that protect and empower people with epilepsy.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Services Section -->
      <section id="services" class="section section-white">
        <div class="container">
          <div class="section-header">
            <div class="section-badge">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1-7 7z"/>
              </svg>
              <span>Our Services</span>
            </div>
            <h2 class="section-title">Comprehensive Epilepsy Care</h2>
            <p class="section-subtitle">
              Providing holistic support through medical care, education, and community empowerment
            </p>
          </div>

          <div class="services-grid">
            <div class="service-card">
              <div class="service-icon">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg>
              </div>
              <h3>Medical Support</h3>
              <p>
                Access to anti-epileptic medications, regular check-ups, and specialized 
                medical care through our network of healthcare partners.
              </p>
              <ul class="service-features">
                <li>Free medication distribution</li>
                <li>Regular health screenings</li>
                <li>Specialist consultations</li>
              </ul>
            </div>

            <div class="service-card">
              <div class="service-icon">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M7 14s-1 0-1-1 1-4 5-4 5 4 1 4-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                  <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 2v1c0 .55.45 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                </svg>
              </div>
              <h3>Community Support</h3>
              <p>
                Building inclusive communities through support groups, counseling, 
                and stigma reduction campaigns across Rwanda.
              </p>
              <ul class="service-features">
                <li>Peer support groups</li>
                <li>Family counseling</li>
                <li>Community education</li>
              </ul>
            </div>

            <div class="service-card">
              <div class="service-icon">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687z"/>
                </svg>
              </div>
              <h3>Education & Training</h3>
              <p>
                Empowering patients, families, and healthcare workers with knowledge 
                about epilepsy management and best practices.
              </p>
              <ul class="service-features">
                <li>Healthcare worker training</li>
                <li>Patient education programs</li>
                <li>School awareness campaigns</li>
              </ul>
            </div>

            <div class="service-card">
              <div class="service-icon">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M14.778.085a.5.5 0 0 1 .45.634l-4 16a.5.5 0 0 1-.986-.165l-2-8a.5.5 0 0 1 .11-.425l4-5a.5.5 0 0 1 .576-.094zM4.02 4a.5.5 0 0 1 .496.426l-1 5a.5.5 0 0 1-.986-.165l.854-4.27L2.034 4.5a.5.5 0 0 1 .473-.5H4z"/>
                </svg>
              </div>
              <h3>Advocacy & Policy</h3>
              <p>
                Championing epilepsy rights and influencing policy to create better 
                healthcare systems and social protection.
              </p>
              <ul class="service-features">
                <li>Policy advocacy</li>
                <li>Rights awareness</li>
                <li>Government partnerships</li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      <!-- Impact Stats Section -->
      <section id="stats" class="stats-section">
        <div class="container">
          <div class="section-header">
            <div class="section-badge">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M12.433 10.07C14.133 10.585 16 11.15 16 8a8 8 0 1 0-8 8c1.996 0 3.887-.736 5.333-1.994-.246.927-.93 1.72-1.901 2.32l.459 1.378a.5.5 0 0 1-.906.417l-1.377-.459C9.326 14.98 8.263 15.5 7 15.5c-1.326 0-2.504-.56-3.434-1.399L2.017 14.07a.5.5 0 0 1-.48-.596c.47-.873 1.023-1.677 1.641-2.417l-.088-.416a.5.5 0 0 1-.196-.399C2.505 9.255 2 7.686 2 6a6 6 0 0 1 12 0c0 .19-.042.375-.078.562.282.409.516.858.688 1.331.422.873.665 1.788.688 2.742zm-1.458-3.262-.453-1.09a.5.5 0 0 1 .184-.546l1.09-.453a.5.5 0 0 1 .362.016.5.5 0 0 1 .184.546l-.453 1.09a.5.5 0 0 1-.184.546l-1.09.453a.5.5 0 0 1-.362-.016.5.5 0 0 1-.184-.546l.453-1.09z"/>
              </svg>
              <span>Our Impact</span>
            </div>
            <h2 class="section-title">Transforming Communities</h2>
            <p class="section-subtitle">
              Every number represents a life changed, a family supported, and a community transformed
            </p>
          </div>
          
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-icon">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M7 14s-1 0-1-1 1-4 5-4 5 4 1 4-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                  <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 2v1c0 .55.45 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                </svg>
              </div>
              <div class="stat-number">{{ stats.beneficiaries }}+</div>
              <div class="stat-label">Direct Beneficiaries</div>
              <div class="stat-description">Receiving comprehensive care and support services</div>
            </div>

            <div class="stat-card">
              <div class="stat-icon">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg>
              </div>
              <div class="stat-number">30</div>
              <div class="stat-label">Districts</div>
              <div class="stat-description">Active presence across all Rwanda</div>
            </div>

            <div class="stat-card">
              <div class="stat-icon">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687z"/>
                </svg>
              </div>
              <div class="stat-number">{{ stats.partners }}+</div>
              <div class="stat-label">Partners</div>
              <div class="stat-description">Healthcare facilities and organizations</div>
            </div>

            <div class="stat-card">
              <div class="stat-icon">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                  <path fill-rule="evenodd" d="M8 1.314C12.438-1.248 16 4.43 16 9.5c0 5.253-4.134 9.5-9.279 9.5-2.144 0-4.16-.742-5.721-1.997l.988-.95C5.48 17.44 6.704 18 8 18c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8c0 1.336.33 2.594.914 3.698l-.979.982A9.496 9.496 0 0 1 0 9.5c0-5.07 3.562-10.748 8-8.186z"/>
                  <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 8 13.5 5.5 5.5 0 0 0 0-11zm1 5.5a1 1 0 1 1-2 0 1 1 0 0 1-2 0z"/>
                </svg>
              </div>
              <div class="stat-number">{{ stats.donations }}+</div>
              <div class="stat-label">Supporters</div>
              <div class="stat-description">Making our work possible every day</div>
            </div>
          </div>
        </div>
      </section>

      <!-- Call to Action Section -->
      <section id="call-to-action" class="cta-section">
        <div class="cta-background">
          <!-- SVG Pattern Overlay -->
          <div class="cta-svg-pattern">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
              <defs>
                <pattern id="cta-pattern" x="0" y="0" width="80" height="80" patternUnits="userSpaceOnUse">
                  <circle cx="40" cy="40" r="3" fill="rgba(168, 85, 247, 0.1)"/>
                  <path d="M0 40 Q 20 20, 40 40 T 80 40" stroke="rgba(168, 85, 247, 0.05)" stroke-width="2" fill="none"/>
                </pattern>
              </defs>
              <rect width="100%" height="100%" fill="url(#cta-pattern)"/>
            </svg>
          </div>
          <div class="cta-overlay"></div>
          <img src="/assets/img/cta-bg.jpg" alt="Join GECO RWANDA" class="cta-image" />
        </div>
        <div class="container">
          <div class="cta-content">
            <div class="section-badge">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path fill-rule="evenodd" d="M8 2.42c-.879-2.46-2.94-2.46-3.82 0l-6.36 17.78c-.494 1.38.091 2.53 1.31 2.53.696 0 1.225-.46 1.513-1.1L7 11.85V5.5a1 1 0 1 1 2 0v6.35l2.357 6.28c.288.64.817 1.1 1.513 1.1 1.219 0 1.804-1.15 1.31-2.53L8 2.42z"/>
              </svg>
              <span>Take Action Today</span>
            </div>
            <h2 class="cta-title">Be Part of the Change</h2>
            <p class="cta-description">
              Your support helps us provide life-saving medication, education, and hope to 
              thousands of Rwandans living with epilepsy. Together, we can build a more 
              inclusive and compassionate society.
            </p>
            <div class="cta-impact">
              <div class="impact-item">
                <span class="impact-number">$25</span>
                <span class="impact-text">Provides medication for one person for a month</span>
              </div>
              <div class="impact-item">
                <span class="impact-number">$100</span>
                <span class="impact-text">Supports a family education workshop</span>
              </div>
              <div class="impact-item">
                <span class="impact-number">$500</span>
                <span class="impact-text">Trains community healthcare workers</span>
              </div>
            </div>
            <div class="cta-actions">
              <!-- <NuxtLink to="/donate" class="btn btn-primary btn-large">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                  <path fill-rule="evenodd" d="M8 1.314C12.438-1.248 16 4.43 16 9.5c0 5.253-4.134 9.5-9.279 9.5-2.144 0-4.16-.742-5.721-1.997l.988-.95C5.48 17.44 6.704 18 8 18c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8c0 1.336.33 2.594.914 3.698l-.979.982A9.496 9.496 0 0 1 0 9.5c0-5.07 3.562-10.748 8-8.186z"/>
                  <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 8 13.5 5.5 5.5 0 0 0 0-11zm1 5.5a1 1 0 1 1-2 0 1 1 0 0 1-2 0z"/>
                </svg>
                Donate Now
              </NuxtLink> -->
              <a href="#contact" class="btn btn-primary btn-large">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                </svg>
                Partner With Us
              </a>
            </div>
          </div>
        </div>
      </section>

      <!-- Portfolio/Actions Section -->
      <PortfolioSection />
      
      <!-- Testimonials Section -->
      <section id="testimonials" class="section section-light">
        <div class="container">
          <div class="section-header">
            <div class="section-badge">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M7.982 1.566a1.5 1.5 0 0 1 1.036 1.036l1.733 1.733a1.5 1.5 0 0 1 0 2.121l-1.733 1.733a1.5 1.5 0 0 1 0 2.121l1.733 1.733a1.5 1.5 0 0 1 0-2.121L4.464 4.464a1.5 1.5 0 0 1 0-2.121L6.197.61a1.5 1.5 0 0 1 1.036-.044z"/>
                <path d="M12.152 6.596a1.5 1.5 0 0 1-2.121 0l-1.733-1.733a1.5 1.5 0 0 1 0-2.121l1.733 1.733a1.5 1.5 0 0 1 2.121z"/>
              </svg>
              <span>Testimonials</span>
            </div>
            <h2 class="section-title">Success Stories</h2>
            <p class="section-subtitle">
              Real stories from people whose lives have been transformed through our programs and support services.
            </p>
          </div>
          
          <!-- Professional Testimonials Grid -->
          <div class="testimonials-grid">
            <div class="testimonial-card">
              <div class="testimonial-avatar">
                <img src="/assets/img/testimonials/testimonials-2.png" alt="NSHAVUJABANDI Jean" />
              </div>
              <div class="testimonial-content">
                <div class="testimonial-text">
                  <p>"GECO has transformed my life through their comprehensive epilepsy care program. I now have access to proper medication and support services."</p>
                </div>
                <div class="testimonial-author">
                  <h4>NSHAVUJABANDI Jean</h4>
                  <p class="author-role">GECO General Secretary</p>
                </div>
              </div>
            </div>

            <div class="testimonial-card">
              <div class="testimonial-avatar">
                <img src="/assets/img/testimonials/testimonials-1.png" alt="MUHAWENIMANA Evariste" />
              </div>
              <div class="testimonial-content">
                <div class="testimonial-text">
                  <p>"The training programs provided by GECO have equipped our healthcare workers with essential skills to manage epilepsy effectively in our communities."</p>
                </div>
                <div class="testimonial-author">
                  <h4>MUHAWENIMANA Evariste</h4>
                  <p class="author-role">Legal Representative</p>
                </div>
              </div>
            </div>

            <div class="testimonial-card">
              <div class="testimonial-avatar">
                <img src="/assets/img/testimonials/testimonials-3.png" alt="Habanzintwari Theogene" />
              </div>
              <div class="testimonial-content">
                <div class="testimonial-text">
                  <p>"It is a pleasure to work with this organization that truly understands the needs of people with epilepsy and mental health conditions."</p>
                </div>
                <div class="testimonial-author">
                  <h4>Habanzintwari Theogene</h4>
                  <p class="author-role">Deputy Legal Representative</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <!-- Team Section -->
      <section id="team" class="section section-white">
        <div class="container">
          <div class="section-header">
            <div class="section-badge">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M7 14s-1 0-1-1 1-4 5-4 5 4 1 4-1 1H7zm4-6a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 2v1c0 .55.45 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
              </svg>
              <span>Our Team</span>
            </div>
            <h2 class="section-title">Dedicated Professionals</h2>
            <p class="section-subtitle">
              Our team is composed of dedicated professionals committed to delivering exceptional results through collaboration, innovation, and expertise.
            </p>
          </div>
          
          <div class="team-grid">
            <!-- Legal Representative -->
            <div class="team-member">
              <div class="member-image">
                <img src="/assets/img/team/team-1.png" alt="MUHAWENIMANA Evariste" />
              </div>
              <div class="member-info">
                <h4>Legal Representative</h4>
                <p class="member-name">MUHAWENIMANA Evariste</p>
                <p class="member-phone">0788507589</p>
                <div class="member-social">
                  <a href="https://x.com/geco_rwanda" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.86-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633 3.982-4.633h1.54L8.81 5.896l3.94 5.354h-2.54l-2.93-3.814L3.34 15.25H.897l5.39-6.282L0 .75h5.063l3.219 4.228L3.34 15.25h2.54l2.93-3.814 3.38 4.228h2.54zm-2.618 13.095h1.339L3.492 2.25H2.098l7.884 11.595z"/>
                    </svg>
                  </a>
                  <a href="https://web.facebook.com/search/top?q=GECO%20RWANDA" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                  </a>
                  <a href="https://www.instagram.com/gecorwanda/" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <rect x="2" y="2" width="12" height="12" rx="3"/>
                      <circle cx="8" cy="8" r="3"/>
                      <circle cx="12" cy="4" r="1"/>
                    </svg>
                  </a>
                  <a href="#" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.518v7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C2.4 3.934 1.9 4.478 1.9 5.234c0 .694.521 1.248 1.342 1.248h.016zm4.908 8.212V9.35c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.838h2.425V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.139 1.679h.037v-.767H6.325c.04.678 0 7.225 0 7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C5.4 3.934 4.8 4.478 4.8 5.234c0 .694.521 1.248 1.342 1.248h.016z"/>
                    </svg>
                  </a>
                </div>
              </div>
            </div>

            <!-- Deputy Legal Representative -->
            <div class="team-member">
              <div class="member-image">
                <img src="/assets/img/team/team-3.png" alt="Habanzintwari Theogene" />
              </div>
              <div class="member-info">
                <h4>Deputy Legal Representative</h4>
                <p class="member-name">Habanzintwari Theogene</p>
                <p class="member-phone">0788557821</p>
                <div class="member-social">
                  <a href="https://x.com/geco_rwanda" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.86-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633 3.982-4.633h1.54L8.81 5.896l3.94 5.354h-2.54l-2.93-3.814L3.34 15.25H.897l5.39-6.282L0 .75h5.063l3.219 4.228L3.34 15.25h2.54l2.93-3.814 3.38 4.228h2.54zm-2.618 13.095h1.339L3.492 2.25H2.098l7.884 11.595z"/>
                    </svg>
                  </a>
                  <a href="https://web.facebook.com/search/top?q=GECO%20RWANDA" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                  </a>
                  <a href="https://www.instagram.com/gecorwanda/" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <rect x="2" y="2" width="12" height="12" rx="3"/>
                      <circle cx="8" cy="8" r="3"/>
                      <circle cx="12" cy="4" r="1"/>
                    </svg>
                  </a>
                  <a href="#" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.518v7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C2.4 3.934 1.9 4.478 1.9 5.234c0 .694.521 1.248 1.342 1.248h.016zm4.908 8.212V9.35c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.838h2.425V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.139 1.679h.037v-.767H6.325c.04.678 0 7.225 0 7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C5.4 3.934 4.8 4.478 4.8 5.234c0 .694.521 1.248 1.342 1.248h.016z"/>
                    </svg>
                  </a>
                </div>
              </div>
            </div>

            <!-- GECO Executive Secretary -->
            <div class="team-member">
              <div class="member-image">
                <img src="/assets/img/team/team-6.png" alt="Nshokeyinka B.Light" />
              </div>
              <div class="member-info">
                <h4>GECO Executive Secretary</h4>
                <p class="member-name">Nshokeyinka B.Light</p>
                <p class="member-phone">0788219039</p>
                <div class="member-social">
                  <a href="https://x.com/geco_rwanda" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.86-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633 3.982-4.633h1.54L8.81 5.896l3.94 5.354h-2.54l-2.93-3.814L3.34 15.25H.897l5.39-6.282L0 .75h5.063l3.219 4.228L3.34 15.25h2.54l2.93-3.814 3.38 4.228h2.54zm-2.618 13.095h1.339L3.492 2.25H2.098l7.884 11.595z"/>
                    </svg>
                  </a>
                  <a href="https://web.facebook.com/search/top?q=GECO%20RWANDA" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                  </a>
                  <a href="https://www.instagram.com/gecorwanda/" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <rect x="2" y="2" width="12" height="12" rx="3"/>
                      <circle cx="8" cy="8" r="3"/>
                      <circle cx="12" cy="4" r="1"/>
                    </svg>
                  </a>
                  <a href="#" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.518v7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C2.4 3.934 1.9 4.478 1.9 5.234c0 .694.521 1.248 1.342 1.248h.016zm4.908 8.212V9.35c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.838h2.425V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.139 1.679h.037v-.767H6.325c.04.678 0 7.225 0 7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C5.4 3.934 4.8 4.478 4.8 5.234c0 .694.521 1.248 1.342 1.248h.016z"/>
                    </svg>
                  </a>
                </div>
              </div>
            </div>

            <!-- GECO General Secretary -->
            <div class="team-member">
              <div class="member-image">
                <img src="/assets/img/team/team-2.png" alt="Nshavujabandi Jean" />
              </div>
              <div class="member-info">
                <h4>GECO General Secretary</h4>
                <p class="member-name">Nshavujabandi Jean</p>
                <p class="member-phone">0788836616</p>
                <div class="member-social">
                  <a href="https://x.com/geco_rwanda" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.86-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633 3.982-4.633h1.54L8.81 5.896l3.94 5.354h-2.54l-2.93-3.814L3.34 15.25H.897l5.39-6.282L0 .75h5.063l3.219 4.228L3.34 15.25h2.54l2.93-3.814 3.38 4.228h2.54zm-2.618 13.095h1.339L3.492 2.25H2.098l7.884 11.595z"/>
                    </svg>
                  </a>
                  <a href="https://web.facebook.com/search/top?q=GECO%20RWANDA" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                  </a>
                  <a href="https://www.instagram.com/gecorwanda/" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <rect x="2" y="2" width="12" height="12" rx="3"/>
                      <circle cx="8" cy="8" r="3"/>
                      <circle cx="12" cy="4" r="1"/>
                    </svg>
                  </a>
                  <a href="#" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.518v7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C2.4 3.934 1.9 4.478 1.9 5.234c0 .694.521 1.248 1.342 1.248h.016zm4.908 8.212V9.35c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.838h2.425V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.139 1.679h.037v-.767H6.325c.04.678 0 7.225 0 7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C5.4 3.934 4.8 4.478 4.8 5.234c0 .694.521 1.248 1.342 1.248h.016z"/>
                    </svg>
                  </a>
                </div>
              </div>
            </div>

            <!-- GECO Treasurer -->
            <div class="team-member">
              <div class="member-image">
                <img src="/assets/img/team/team-7.png" alt="Barankunda Gaspard" />
              </div>
              <div class="member-info">
                <h4>GECO Treasurer</h4>
                <p class="member-name">Barankunda Gaspard</p>
                <p class="member-phone">0788415920</p>
                <div class="member-social">
                  <a href="https://x.com/geco_rwanda" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.86-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633 3.982-4.633h1.54L8.81 5.896l3.94 5.354h-2.54l-2.93-3.814L3.34 15.25H.897l5.39-6.282L0 .75h5.063l3.219 4.228L3.34 15.25h2.54l2.93-3.814 3.38 4.228h2.54zm-2.618 13.095h1.339L3.492 2.25H2.098l7.884 11.595z"/>
                    </svg>
                  </a>
                  <a href="https://web.facebook.com/search/top?q=GECO%20RWANDA" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                  </a>
                  <a href="https://www.instagram.com/gecorwanda/" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <rect x="2" y="2" width="12" height="12" rx="3"/>
                      <circle cx="8" cy="8" r="3"/>
                      <circle cx="12" cy="4" r="1"/>
                    </svg>
                  </a>
                  <a href="#" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.518v7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C2.4 3.934 1.9 4.478 1.9 5.234c0 .694.521 1.248 1.342 1.248h.016zm4.908 8.212V9.35c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.838h2.425V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.139 1.679h.037v-.767H6.325c.04.678 0 7.225 0 7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C5.4 3.934 4.8 4.478 4.8 5.234c0 .694.521 1.248 1.342 1.248h.016z"/>
                    </svg>
                  </a>
                </div>
              </div>
            </div>

            <!-- GECO Advisor -->
            <div class="team-member">
              <div class="member-image">
                <img src="/assets/img/team/team-8.png" alt="Benimana Philippe" />
              </div>
              <div class="member-info">
                <h4>GECO Advisor</h4>
                <p class="member-name">Benimana Philippe</p>
                <p class="member-phone">0788265713</p>
                <div class="member-social">
                  <a href="https://x.com/geco_rwanda" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.86-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633 3.982-4.633h1.54L8.81 5.896l3.94 5.354h-2.54l-2.93-3.814L3.34 15.25H.897l5.39-6.282L0 .75h5.063l3.219 4.228L3.34 15.25h2.54l2.93-3.814 3.38 4.228h2.54zm-2.618 13.095h1.339L3.492 2.25H2.098l7.884 11.595z"/>
                    </svg>
                  </a>
                  <a href="https://web.facebook.com/search/top?q=GECO%20RWANDA" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                  </a>
                  <a href="https://www.instagram.com/gecorwanda/" target="_blank" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <rect x="2" y="2" width="12" height="12" rx="3"/>
                      <circle cx="8" cy="8" r="3"/>
                      <circle cx="12" cy="4" r="1"/>
                    </svg>
                  </a>
                  <a href="#" class="social-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                      <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.518v7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C2.4 3.934 1.9 4.478 1.9 5.234c0 .694.521 1.248 1.342 1.248h.016zm4.908 8.212V9.35c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.838h2.425V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.139 1.679h.037v-.767H6.325c.04.678 0 7.225 0 7.225h2.425zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248 0-.709-.52-1.248-1.342-1.248C5.4 3.934 4.8 4.478 4.8 5.234c0 .694.521 1.248 1.342 1.248h.016z"/>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <!-- Contact Section -->
      <section id="contact" class="contact-section">
        <div class="container">
          <div class="section-header">
            <div class="section-badge">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM1.5 8a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0z"/>
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5zM10 2v1H6V2h4z"/>
              </svg>
              <span>Connect With Us</span>
            </div>
            <h2 class="section-title">Get in Touch</h2>
            <p class="section-subtitle">
              We're here to listen, help, and welcome you to our community
            </p>
          </div>
          
          <div class="contact-grid">
            <!-- Email Card -->
            <div class="contact-card">
              <div class="contact-icon">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                </svg>
              </div>
              <h3>Email</h3>
              <p>info@gecorwanda.org</p>
            </div>
            
            <!-- Phone Card -->
            <div class="contact-card">
              <div class="contact-icon">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329-.423.795-.643 1.273-.643s.945.22 1.274.643l2.78 2.306c.825.682 1.895 1.057 2.997 1.057 1.102 0 2.172-.375 2.997-1.057L15.775 4.15c.646-.533.646-1.398 0-1.931l-2.78-2.306C12.17-.3 11.1-.675 9.998-.675S7.826-.3 7.001.233L4.221 2.539c-.825.682-1.895 1.057-2.997 1.057-1.102 0-2.172-.375-2.997-1.057L.495 1.674A1.745 1.745 0 0 1 0 .511C0-.19.495-.675 1.105-.675h13.79c.61 0 1.105.485 1.105 1.186s-.495 1.186-1.105 1.186H2.99c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h11.905c.055 0 .105-.044.105-.186 0-.141-.05-.185-.105-.185H1.105C1.05 0 1 .044 1 .186c0 .141.05.185.105.185h.78z"/>
                </svg>
              </div>
              <h3>Phone</h3>
              <p>+250 788 123 456</p>
            </div>
            
            <!-- Visit Card -->
            <div class="contact-card">
              <div class="contact-icon">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg>
              </div>
              <h3>Visit</h3>
              <p>Kigali, Rwanda</p>
            </div>
          </div>
          
          <div class="contact-form-wrapper">
            <form class="contact-form">
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label">Your Name</label>
                  <input type="text" class="form-input" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-input" placeholder="your@email.com" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label">Phone</label>
                  <input type="tel" class="form-input" placeholder="+250 7xx xxx xxx" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Subject</label>
                  <input type="text" class="form-input" placeholder="How can we help?" required>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Message</label>
                <textarea class="form-textarea" placeholder="Share your thoughts..." required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M15.854.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L14.5 1.707V4.5a.5.5 0 0 1 1 0V1.707l2.146 2.147a.5.5 0 0 1 0 .708z"/>
                  <path d="M1 14s-1 0-1-1 1-4 5-4 5 4 1 4-1 1H1zm4-6a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg>
                Send Message
              </button>
            </form>
          </div>
        </div>
      </section>
    </main>

    <Footer />
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import PortfolioSection from '~/components/PortfolioSection.vue'
import '~/assets/css/svg-enhanced.css'

const stats = ref({
  beneficiaries: 0,
  projects: 0,
  partners: 0,
  donations: 0
})

onMounted(async () => {
  try {
    const response = await $fetch('/api/stats')
    stats.value = response
  } catch (error) {
    console.error('Failed to fetch stats:', error)
  }
})
</script>
