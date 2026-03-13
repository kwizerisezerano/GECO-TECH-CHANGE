<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>GECO RWANDA</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link
      href="assets/vendor/glightbox/css/glightbox.min.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet" />

    <!-- =======================================================
  * Template Name: Squadfree
  * Template URL: https://bootstrapmade.com/squadfree-free-bootstrap-template-creative/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .portfolio-item img {
  width: 100%;           /* Make the image fill the available width */
  height: 300px;         /* Set a fixed height for all images */
  object-fit: cover;     /* Ensures the image covers the given area without distortion */
}
.testimonial-img {
  width: 100px;  /* Adjust the width to your desired size */
  height: 100px; /* Adjust the height to your desired size */
  object-fit: cover; /* Ensures the image covers the area without distortion */
  border-radius: 30%; /* Optional: If you want the images to be circular */
}
/* Container for the member image */
.team .team-member .member-img {
  width: 350px;  /* Set a fixed width */
  height: 350px; /* Set a fixed height */
  display: flex;
  justify-content: center;
  align-items: flex-start;  /* Align the image to the top to ensure the head is visible */
  overflow: hidden;  /* Hide anything that overflows the container */
}

/* Styling for the image inside the container */
.team .team-member .member-img img {
  width: 100%;   /* Makes the image cover the width of the container */
  height: 100%;  /* Ensures the image takes the full height of the container */
  object-fit: cover; /* Ensures the image is cropped and maintains aspect ratio */
  object-position: top; /* Ensures the top of the image is prioritized for visibility */
}

  </style>
  </head>

  <body class="index-page">
    <!-- Dark Mode Toggle Button -->
    <button 
      id="darkModeToggle" 
      class="dark-mode-toggle"
      aria-label="Toggle dark mode"
      title="Toggle dark mode"
    >
      <i class="bi bi-moon" id="themeIcon"></i>
    </button>
    <header id="header" class="header d-flex align-items-center fixed-top">
      <div
        class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between"
      >
        <a href="index.php" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <img src="assets/img/logo.png" alt="" />
          <h1 class="sitename">GECO RWANDA</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#services">Publications</a></li>
            <li><a href="#portfolio">Actions</a></li>
            <li><a href="#team">Team</a></li>
            
            <li class="dropdown">
              <a href="#"
                ><span>Useful </span>
                <i class="bi bi-chevron-down toggle-dropdown"></i
              ></a>
              <ul>
                <!-- <li><a href="report.php">P</a></li> -->
                <li class="dropdown">
                  <a href="#"
                    ><span>GECO related Documents</span>
                    <i class="bi bi-chevron-down toggle-dropdown"></i
                  ></a>
                  <ul>
                  <li><a href="report.php">Annual Report</a></li>
                    <li><a href="strategic.php">Strategic plan</a></li>
                    <li><a href="laws.php">Constitition by laws</a></li>
                    <li><a href="policy.php">Policies</a></li>              
                    <li><a href="implementation.php">Implementation plan</a></li>
                    <li><a href="partners.php">Partners</a></li>
                    <li><a href="achievements.php">Achievements</a></li>              


                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#"
                    ><span>GECO related Certificates</span>
                    <i class="bi bi-chevron-down toggle-dropdown"></i
                  ></a>
                  <ul>
                 
                    <li><a href="ibe.php">IBE Certificate</a></li>
                    <li><a href="rgb.php">RGB Certificate</a></li>
                    <li><a href="rbc.php">RBC certificate</a></li>


                  </ul>
                </li>
                <!-- <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li> -->
              </ul>
            </li>
           
            <li><a href="#contact">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </header>

    <main class="main">
      <!-- Hero Section -->
      <section id="hero" class="hero section accent-background">
        <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in" />

        <div
          class="container text-center"
          data-aos="fade-up"
          data-aos-delay="100"
        >
          <h2>Welcome to GECO RWANDA</h2>
          <p>
            We are a committed team working to support people with epilepsy and
            mental health conditions through healthcare, empowerment, and
            advocacy.
          </p>
          <a href="#about" class="btn-scroll" title="Scroll Down"
            ><i class="bi bi-chevron-down"></i
          ></a>
        </div>
      </section>
      <!-- /Hero Section -->

      <!-- About Section -->
      <section id="about" class="about section">
        <div class="container">
          <div class="row gy-5">
            <div
              class="content col-xl-5 d-flex flex-column"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <h3>Global Epilepsy Connection (GECO)</h3>
              <p>
                Global Epilepsy Connection (GECO) is a Rwandan national
                non-governmental organization (NGO) founded on October 29, 2010.
                Born from the compassionate efforts of concerned parents,
                individuals with epilepsy, medical professionals, and other
                stakeholders, GECO emerged to address the significant unmet
                needs of people with epilepsy and other mental health
                conditions. Initially operating in Rubavu District, Western
                Province, GECO has expanded its reach nationwide, working to
                improve the lives of those affected through integrated
                approaches encompassing health, socio-economic empowerment, and
                advocacy for legislative change.
              </p>
              <a
                href="#"
                class="about-btn align-self-center align-self-xl-start"
                ><span>About us</span> <i class="bi bi-chevron-right"></i
              ></a>
            </div>

            <div class="col-xl-7" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">
                <div class="col-md-6 icon-box position-relative">
                  <i class="bi bi-eye"></i>
                  <h4>
                    <a href="" class="stretched-link">GECO Vision</a>
                  </h4>
                  <p>
                    Our Vision is to see a country where all individuals with
                    epilepsy and other mental disabilities enjoy full rights,
                    social inclusion, well-being, and self-reliance,
                    contributing to a thriving and sustainable holistic
                    development.
                  </p>
                </div>
                <!-- Icon-Box -->

                <div class="col-md-6 icon-box position-relative">
                  <i class="bi bi-flag"></i>
                  <h4>
                    <a href="" class="stretched-link">GECO Mission </a>
                  </h4>
                  <p>
                    Our mission is to cultivate a sense of belonging within the
                    community while empowering individuals with epilepsy and
                    mental disabilities through professional healthcare,
                    socioeconomic initiatives, and advocacy.
                  </p>
                </div>
                <!-- Icon-Box -->

                <div class="col-md-6 icon-box position-relative">
                  <i class="bi bi-gem"></i>
                  <h4>
                    <a href="" class="stretched-link">GECO CORE VALUES</a>
                  </h4>
                  <ul>
    <li><strong>Respect:</strong>
        <ul>
            <li>We treat everyone with dignity, valuing their contributions and building trust.</li>
        </ul>
    </li>
    <li><strong>Inclusion:</strong>
        <ul>
            <li>We create welcoming environments where everyone feels valued and can fully participate.</li>
        </ul>
    </li>
    <li><strong>Accountability:</strong>
        <ul>
            <li>We ensure participation, evaluation, transparency, and feedback in all our actions.</li>
        </ul>
    </li>
    <li><strong>Equity:</strong>
        <ul>
            <li>We guarantee fair treatment and opportunity for all, actively eliminating barriers to participation.</li>
        </ul>
    </li>
    <li><strong>Impact:</strong>
        <ul>
            <li>We strive for measurable, beneficial change.</li>
        </ul>
    </li>
</ul>

                </div>
                <!-- Icon-Box -->

                <div class="col-md-6 icon-box position-relative">
                  <i class="bi bi-bullseye"></i>
                  <h4>
                    <a href="" class="stretched-link">Objectives</a>
                  </h4>
                  <ul>
    <li><strong>Fight Against Epilepsy and Mental Illnesses:</strong>
        <ul>
            <li>Address health, psycho-social, and legislative aspects to combat epilepsy and other mental illnesses.</li>
        </ul>
    </li>
    <li><strong>Social and Educational Support:</strong>
        <ul>
            <li>Provide social and educational assistance to individuals with epilepsy and related conditions.</li>
        </ul>
    </li>
    <li><strong>HIV/AIDS Awareness and Reproductive Health Education:</strong>
        <ul>
            <li>Educate and provide information on HIV/AIDS and reproductive health to individuals with epilepsy and related mental disabilities.</li>
        </ul>
    </li>
    <li><strong>Partnership Development:</strong>
        <ul>
            <li>Build strong partnerships with national and international organizations that share similar objectives to ensure sustainability and effectiveness.</li>
        </ul>
    </li>
    <li><strong>Poverty Alleviation and Welfare Promotion:</strong>
        <ul>
            <li>Combat poverty and improve the welfare of individuals with epilepsy, mental disabilities, and their families.</li>
        </ul>
    </li>
    <li><strong>Sustainability Program:</strong>
        <ul>
            <li>Achieve financial sustainability through acquiring facilities and properties to generate local income.</li>
        </ul>
    </li>
</ul>

                </div>
                <!-- Icon-Box -->
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /About Section -->

      <!-- Services Section -->
      <section id="services" class="services section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Publications</h2>
          <p> EPILEPSY INFORMATION</p>
        </div>
        <!-- End Section Title -->

        <div class="container">
          <div class="row gy-4">
            <div
              class="col-xl-3 col-md-6 d-flex"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-list-task icon"></i></div>
                <h4>
                  <a href="service-details.html" class="stretched-link"
                    >WHAT IS EPILEPSY</a
                  >
                </h4>
                <p>
                Epilepsy is a significant public health concern in Rwanda, affecting people of all ages and backgrounds. Despite medical advances, stigma and misconceptions persist, leading to social exclusion, discrimination in education and employment, and barriers to treatment. The condition remains under-prioritized in public health agendas, with limited awareness further exacerbating the challenges faced by individuals with epilepsy and their families.
                </p>
              </div>
            </div>
            <!-- End Service Item -->

            <div
              class="col-xl-3 col-md-6 d-flex"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <div class="service-item position-relative">
                <div class="icon">
                <div class="icon positive-impact"><i class="bi bi-graph-up"></i></div>
                </div>
                <h4>
                  <a href="service-details.html" class="stretched-link"
                    >Prevalence and Impact</a
                  >
                </h4>
                <p>
                Epilepsy affects approximately 49 out of every 1,000 individuals in Rwanda, totaling more 
than 600,000 people and making it one of the most prevalent neurological disorders in the 
country. Despite its relatively high prevalence, misconceptions about epilepsy persist, leading 
to social stigma, discrimination, and barriers to treatment. Unlike diseases with more visible 
symptoms or higher mortality rates, epilepsy's invisible nature and unpredictable seizures often 
contribute to its marginalization within healthcare systems and communities.
                </p>
              </div>
            </div>
            <!-- End Service Item -->

            <div
              class="col-xl-3 col-md-6 d-flex"
              data-aos="fade-up"
              data-aos-delay="300"
            >
              <div class="service-item position-relative">
                <div class="icon">
                  <i class="bi bi-calendar4-week icon"></i>
                </div>
                <h4>
                  <a href="service-details.html" class="stretched-link"
                    >Social and Economic Burden</a
                  >
                </h4>
                <p>
                Beyond its medical implications, epilepsy imposes significant social and economic burdens on 
individuals, families, and society at large. The stigma associated with epilepsy can result in 
social exclusion, limited educational and employment opportunities, and strained family 
relationships. These psychosocial challenges further exacerbate the economic burden, as 
people with epilepsy may face higher healthcare costs and reduced earning potential.

                </p>
              </div>
            </div>
            <!-- End Service Item -->

            <div
              class="col-xl-3 col-md-6 d-flex"
              data-aos="fade-up"
              data-aos-delay="400"
            >
              <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-bandaid"></i></div>
                <h4>
                  <a href="service-details.html" class="stretched-link"
                    >Access to Healthcare</a
                  >
                </h4>
                <p>
                Access to quality healthcare remains a critical issue for people with epilepsy in Rwanda. Unlike 
diseases with dedicated national programs or extensive resources, epilepsy care often relies on 
fragmented services within primary healthcare settings. Limited availability of antiepileptic 
drugs (AEDs), lack of health insurance for some epileptic families due to poverty, insufficient 
training of healthcare providers in epilepsy management, and inadequate public awareness 
contribute to suboptimal treatment outcomes and disparities in care across regions.
                </p>
              </div>
            </div>
            <!-- End Service Item -->
          </div>
        </div>
      </section>
      <!-- /Services Section -->
      <?php
// Database connection (using your config.php)
require 'config.php';

try {
    // Query to count completed projects using PDO
    $stmt = $pdo->prepare("SELECT COUNT(*) AS completed_count FROM projects WHERE status = :status");
    $stmt->execute(['status' => 'Completed']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) { // Check if a row was returned
        $completed_count = $row["completed_count"];
    } else {
        $completed_count = 0;
    }
} catch (PDOException $e) {
    // Handle database errors properly (log them, display a user-friendly message)
    error_log("Database error: " . $e->getMessage()); // Log the error
    $completed_count = 0; // Set a default value to avoid displaying errors on the page
}

// No need to close PDO connection explicitly in most cases. PHP handles it.
?>   <!-- Stats Section -->

<?php
require 'config.php'; // Your database connection config

try {
    $stmt = $pdo->query("SELECT COUNT(*) AS total_beneficiaries FROM beneficiaries");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $total_beneficiaries = $row["total_beneficiaries"];
    } else {
        $total_beneficiaries = 0;
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $total_beneficiaries = 0;
}

// Now use $total_beneficiaries in your HTML
?>
<?php
require 'config.php'; // Your database connection config

try {
    $stmt = $pdo->query("SELECT COUNT(*) AS total_partners FROM partners");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $total_partners= $row["total_partners"];
    } else {
        $total_partners = 0;
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $total_partners = 0;
}

// Now use $total_beneficiaries in your HTML
?>

<?php
require 'config.php'; // Your database connection config

try {
    $stmt = $pdo->query("SELECT COUNT(*) AS donation FROM donation WHERE payment_status = 'success'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $total_donation = $row["donation"];
    } else {
        $total_donation= 0;
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
   $total_donation = 0;
}

// Now use $total_beneficiaries in your HTML
?>

<div class="col-lg-3 col-md-6">
    <div class="stats-item">
        <!-- <i class="bi bi-people"></i> <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_beneficiaries; ?>" data-purecounter-duration="1" class="purecounter"></span>
        <p><strong>Total Beneficiaries</strong> <span>who have been registered</span></p> -->
    </div>
</div>
      <section id="stats" class="stats section light-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4">
          <div class="col-lg-3 col-md-6">
    <div class="stats-item">
        <i class="bi bi-emoji-smile"></i>
        <span
            data-purecounter-start="0"
            data-purecounter-end="<?php echo   $total_beneficiaries; ?>" // Dynamic value here
            data-purecounter-duration="1"
            class="purecounter"
        ></span>
        <p>
            <strong>Happy beneficiaries</strong> <span>whose lives have been positively transformed</span>
        </p>
    </div>
</div>
            <!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
              <div class="stats-item">
                <i class="bi bi-journal-richtext"></i>
                <span
                  data-purecounter-start="0"
                  data-purecounter-end="<?php echo $completed_count; ?>"
                  data-purecounter-duration="1"
                  class="purecounter"
                ></span>
                <p>
                <strong>Projects</strong> <span>that aim to improve lives and create sustainable change</span>
                </p>
              </div>
            </div>
            <!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
              <div class="stats-item">
                <i class="bi bi-people"></i>
                <span
                  data-purecounter-start="0"
                  data-purecounter-end="<?php echo  $total_partners; ?>"
                  data-purecounter-duration="1"
                  class="purecounter"
                ></span>
                <p>
                <p>
                <strong>Partners</strong>
<span>We collaborate with trusted organizations to create positive impacts and provide lasting solutions.</span>

</p>

                </p>
              </div>
            </div>
            <!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
              <div class="stats-item">
                <i class="bi bi-people"></i>
                <span
                  data-purecounter-start="0"
                  data-purecounter-end="<?php echo   $total_donation; ?>"
                  data-purecounter-duration="1"
                  class="purecounter"
                ></span>
                <p>
  <strong>Supporters</strong>
  <span>dedicated individuals and organizations contributing to our mission</span>
</p>

              </div>
            </div>
            <!-- End Stats Item -->
          </div>
        </div>
      </section>
      <!-- /Stats Section -->

      <!-- Call To Action Section -->
      <section
        id="call-to-action"
        class="call-to-action section accent-background"
      >
        <img src="assets/img/cta-bg.jpg" alt="" />

        <div class="container">
          <div
            class="row justify-content-center"
            data-aos="zoom-in"
            data-aos-delay="100"
          >
            <div class="col-xl-10">
              <div class="text-center">
              <h3>Call to Action</h3>
<p>
  We invite you to join us in supporting this cause. Your involvement can make a lasting impact, bringing hope and change to those who need it most. Together, we can create a brighter future. Come and be part of the solution!
</p>

                <a class="cta-btn" href="donate.php">Call To Action</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /Call To Action Section -->

      <!-- Portfolio Section -->
      <section id="portfolio" class="portfolio section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Actions</h2>
          <p>
          We are committed to addressing the challenges and providing solutions. Your support can help us bring meaningful change. Join us in our efforts to create a positive impact. Together, we can overcome obstacles and build a better future.
          </p>
        </div>
        <!-- End Section Title -->

        <div class="container">
  <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
      <li data-filter="*" class="filter-active">All</li>
      <li data-filter=".filter-app">Part 1</li>
      <li data-filter=".filter-branding">Part 2</li>
      <li data-filter=".filter-books">Part 3</li>
    </ul>

    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
      <!-- App 1 -->
      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
        <img src="assets/img/backup/app-1.jpg" class="img-fluid portfolio-img" alt="App 1" />
        <div class="portfolio-info">
          <h4>Evidence 1</h4>
          <p>GECO in Partnership with HI has strengthened the capacities of health professionals in the medical care of epilepsy.  In-depth knowledge will make it possible to detect epilepsy early, initiate adequate drug treatment and refer patients if necessary.  We trained 67 health professionals from health centers, including the head of the mental health service and his replacement, the head of the maternity ward, the head of the pharmacy and the head of community health workers. This was to improve the care of people with epilepsy, namely screening, initiation of treatment, psychosocial support for patients and psychoeducational groups</p>
          <a href="assets/img/backup/app-1.jpg" title="App 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
          <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- App 2 -->
      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
        <img src="assets/img/backup/app-2.jpg" class="img-fluid portfolio-img" alt="App 2" />
        <div class="portfolio-info">
          <h4>Evidence 2</h4>
          <p>52 vulnerable children of school age were supported with school materials, namely: notebooks and pens, backpacks and shoes to help them follow their lessons and integrate them into primary school education programs.</p>
          <a href="assets/img/portfolio/app-2.jpg" title="App 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
          <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- App 3 -->
      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
        <img src="assets/img/backup/app-3.jpg" class="img-fluid portfolio-img" alt="App 3" />
        <div class="portfolio-info">
          <h4>Evidence 3</h4>
          <p>Awareness raising in schools to ensure the integration of children with epilepsy in schools.  It covered 4,233 students, 67 teachers, 180 parents and 5 local authorities. This awareness has increased information about epilepsy to students and teachers and reduced the stigma against people with epilepsy at school age. </p>
          <a href="assets/img/portfolio/app-3.jpg" title="App 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
          <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Branding 1 -->
      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
        <img src="assets/img/backup/branding-1.jpg" class="img-fluid portfolio-img" alt="Branding 1" />
        <div class="portfolio-info">
          <h4>Evidence 4</h4>
          <p>Here are the groups supported by GECO for cattle and pig farming.</p>
          <a href="assets/img/portfolio/branding-1.jpg" title="Branding 1" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
          <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Branding 2 -->
      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
        <img src="assets/img/backup/branding-2.jpg" class="img-fluid portfolio-img" alt="Branding 2" />
        <div class="portfolio-info">
          <h4>Evidence 5</h4>
          <p>During the period of the COVID-19 epidemic and the earthquake following the volcanic eruption in Rubavu, GECO in partnership with HI was able to help 64 families who have people suffering from epilepsy and vulnerable people composed of 336 people. we supported food from different items and construction materials to rehabilitate their homes as well as hygiene materials</p>
          <a href="assets/img/portfolio/branding-2.jpg" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
          <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Branding 3 -->
      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
        <img src="assets/img/backup/branding-3.jpg" class="img-fluid portfolio-img" alt="Branding 3" />
        <div class="portfolio-info">
          <h4>Evidence 6</h4>
          <p>333 people with epilepsy  from 100 vulnerable families were paid medical insurance so that they could continue to receive medicine</p>
          <a href="assets/img/portfolio/branding-3.jpg" title="Branding 3" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
          <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Books 1 -->
      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
        <img src="assets/img/backup/books-1.jpg" class="img-fluid portfolio-img" alt="Books 1" />
        <div class="portfolio-info">
          <h4>Evidence 7</h4>
          <p>1,439 facilitators were trained on the etiology of epilepsy and the mode of prevention and how to help patients in different activities such as consultation by specialists, psychosocial support for patients and psychoeducational groups.</p>
          <a href="assets/img/portfolio/books-1.jpg" title="Books 1" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
          <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Books 2 -->
      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
        <img src="assets/img/backup/books-2.jpg" class="img-fluid portfolio-img" alt="Books 2" />
        <div class="portfolio-info">
          <h4>Evidence 8</h4>
          <p>GECO in partnership with Handicap International (HI ), gave financial support equivalent to 2,612,000 Rwf to 16 groups of people with epilepsy of  District district. This was done after a careful accompaniment to these groups. Each group received the support on the basis of economic initiative. Three groups were given 9 pigs per each, five groups were given 35 chickens per each, three groups took initiative to get in engaged in vegetable agriculture while other 3 groups got engaged in agriculture of Irish potatoes and the last one got engaged in handcraft practices.</p>
          <a href="assets/img/portfolio/books-2.jpg" title="Books 2" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
          <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Books 3 -->
      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
        <img src="assets/img/backup/books-3.jpg" class="img-fluid portfolio-img" alt="Books 3" />
        <div class="portfolio-info">
          <h4>Evidence 9</h4>
          <p>GECO in partnership with Handicap International (HI ), gave financial support equivalent to 2,612,000 Rwf to 16 groups of people with epilepsy of  District district. This was done after a careful accompaniment to these groups. Each group received the support on the basis of economic initiative. Three groups were given 9 pigs per each, five groups were given 35 chickens per each, three groups took initiative to get in engaged in vegetable agriculture while other 3 groups got engaged in agriculture of Irish potatoes and the last one got engaged in handcraft practices.</p>
          <a href="assets/img/portfolio/books-3.jpg" title="Books 3" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
          <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>


      </section>
      <!-- /Portfolio Section -->

      <!-- Testimonials Section -->
      <section id="testimonials" class="testimonials section light-background">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Testimonials</h2>
          <p>
  Hear from our satisfied beneficiaries who have experienced exceptional service and remarkable results. Their stories reflect the value and trust we build with every project.
</p>

        </div>
        <!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": "auto",
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 1,
                    "spaceBetween": 40
                  },
                  "1200": {
                    "slidesPerView": 3,
                    "spaceBetween": 1
                  }
                }
              }
            </script>
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span
                      >It is pleasure to work with this organization</span
                    >
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                  <img
                    src="assets/img/testimonials/testimonials-2.png"
                    class="testimonial-img"
                    alt=""
                  />
                  <h3>NSHAVUJABANDI Jean</h3>
                  <h4>GECO General Secretary  </h4>
                </div>
              </div>
              <!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <!-- <span
                      >Working with this team was a remarkable experience. They demonstrated expertise, commitment, and a clear understanding of our needs. The results were outstanding, and we couldn't be more satisfied with their work.</span
                    > -->
                     <span
                      >It is pleasure to work with this organization</span
                    >
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                  <img
                    src="assets/img/testimonials/testimonials-1.png"
                    class="testimonial-img"
                    alt=""
                  />
                  <h3>MUHAWENIMANA Evariste</h3>
                  <h4>Legal Representative                               </h4>
                </div>
              </div>
              <!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <!-- <span
                      >Running my business became much easier with their support. Their solutions are tailored to meet specific needs, and the results speak for themselves. I highly recommend their services to any business owner looking for efficiency and growth.</span
                    > -->
                     <span
                      >It is pleasure to work with this organization</span
                    >
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                  <img
                    src="assets/img/testimonials/testimonials-3.png"
                    class="testimonial-img"
                    alt=""
                  />
                  <h3>Habanzintwari Theogene             </h3>
                  <h4>Deputy Legal Representative          </h4>
                </div>
              </div>
              <!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <!-- <span
                      >Collaborating with this team was seamless and rewarding. Their expertise and dedication ensured that every detail was handled perfectly. I’m extremely satisfied with the outcome and would gladly work with them again.</span
                    > -->
                    <span
                      >It is pleasure to work with this organization</span
                    >
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                  <img
                    src="assets/img/testimonials/testimonials-4.png"
                    class="testimonial-img"
                    alt=""
                  />
                  <h3>Nyirahabineza Emeritha                    </h3>
                  <h4>GECO Advisor                         </h4>
                </div>
              </div>
              <!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    
                    <!-- <span
                      >From start to finish, the team showcased professionalism and a commitment to excellence. Their innovative approach and problem-solving skills truly set them apart. I couldn’t have asked for a better experience.</span
                    > -->
                     <span
                      >It is pleasure to work with this organization</span
                    >
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                  <img
                    src="assets/img/testimonials/testimonials-5.png"
                    class="testimonial-img"
                    alt=""
                  />
                  <h3>Niyikiza Jackson </h3>
                  <h4>GECO Advisor     </h4>
                </div>
              </div>
              <!-- End testimonial item -->
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </section>
      <!-- /Testimonials Section -->

      <!-- Team Section -->
      <section id="team" class="team section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Team</h2>
          <p>
  Our team is composed of dedicated professionals committed to delivering exceptional results through collaboration, innovation, and expertise. Together, we strive to exceed expectations and create lasting value.
</p>
        </div>
        <!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-5">
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
      <!-- /Team Section -->



      <?php
// Database connection
require 'config.php';



// Query to fetch project names by status
$query = "SELECT project_name, status FROM projects";
$stmt = $pdo->prepare($query);
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organizing projects into different categories based on status
$ongoingProjects = [];
$pendingProjects = [];
$completedProjects = [];

foreach ($projects as $project) {
    if ($project['status'] == 'Ongoing') {
        $ongoingProjects[] = $project['project_name'];
    } elseif ($project['status'] == 'Pending') {
        $pendingProjects[] = $project['project_name'];
    } elseif ($project['status'] == 'Completed') {
        $completedProjects[] = $project['project_name'];
    }
}
?>

      <!-- Pricing Section -->
<section id="pricing" class="pricing section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Projects and Initiatives</h2>
        <p>
            Our projects and initiatives are driven by innovation, collaboration, and a commitment to excellence. We focus on delivering impactful solutions that address real-world challenges and create sustainable growth.
        </p>
    </div>
    <!-- End Section Title -->


    <div class="container">
        <div class="row gy-4">
            <!-- Ongoing Projects -->
            <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="pricing-item">
                    <h3>Ongoing Projects</h3>
                    <h4><?php echo count($ongoingProjects); ?> <span>/ Support</span></h4>
                    <ul>
                        <?php foreach ($ongoingProjects as $project): ?>
                            <li>
                                <i class="bi bi-check"></i>
                                <span><?php echo htmlspecialchars($project); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#" class="buy-btn">Donate Now</a>
                </div>
            </div>
            <!-- End Ongoing Projects -->

            <!-- Pending Projects -->
            <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="pricing-item featured">
                    <h3>Pending Projects</h3>
                    <h4><?php echo count($pendingProjects); ?> <span>/ Support</span></h4>
                    <ul>
                        <?php foreach ($pendingProjects as $project): ?>
                            <li>
                                <i class="bi bi-check"></i>
                                <span><?php echo htmlspecialchars($project); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="donate.php" class="buy-btn">Support Now</a>
                </div>
            </div>
            <!-- End Pending Projects -->

            <!-- Completed Projects -->
            <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="pricing-item">
                    <h3>Completed Projects</h3>
                    <h4><?php echo count($completedProjects); ?> <span>/ Achievement</span></h4>
                    <ul>
                        <?php foreach ($completedProjects as $project): ?>
                            <li>
                                <i class="bi bi-check"></i>
                                <span><?php echo htmlspecialchars($project); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="achievements.php" class="buy-btn">View Report</a>
                </div>
            </div>
            <!-- End Completed Projects -->
        </div>
    </div>
</section>
<!-- /Pricing Section -->


    

          

          
      <!-- Contact Section -->
      <section id="contact" class="contact section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
        <h2>Contact Us</h2>
<p>
  Reach out to us for inquiries, feedback, or assistance via email, phone, or social media.
</p>


        </div>
        <!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4">
            <div class="col-lg-5">
              <div class="info-wrap">
                <div
                  class="info-item d-flex"
                  data-aos="fade-up"
                  data-aos-delay="200"
                >
                  <i class="bi bi-geo-alt flex-shrink-0"></i>
                  <div>
                    <h3>Address</h3>
                    <p>Rubavu,Gisenyi</p>
                  </div>
                </div>
                <!-- End Info Item -->

                <div
                  class="info-item d-flex"
                  data-aos="fade-up"
                  data-aos-delay="300"
                >
                  <i class="bi bi-telephone flex-shrink-0"></i>
                  <div>
                    <h3>Call Us</h3>
                    <p>+250 788 507 589 / +250 788 836 616 </p>
                  </div>
                </div>
                <!-- End Info Item -->

                <div
                  class="info-item d-flex"
                  data-aos="fade-up"
                  data-aos-delay="400"
                >
                  <i class="bi bi-envelope flex-shrink-0"></i>
                  <div>
                    <h3>Email Us</h3>
                    <p>globalepelepticc@gmail.com</p>
                  </div>
                </div>
                <!-- End Info Item -->

               

              </div>
            </div>

            <div class="col-lg-7">
            <iframe
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15909.743227625324!2d29.2561874!3d-1.7065154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19db9e5b5a332b5b%3A0x39042dc62083e5a9!2sADEPR%20Gisenyi!5e0!3m2!1sen!2srw!4v1706524501234!5m2!1sen!2srw"
  frameborder="0"
  style="border: 0; width: 100%; height: 320px"
  allowfullscreen=""
  loading="lazy"
  referrerpolicy="no-referrer-when-downgrade"
></iframe>

              
        </div>
      </section>
      <!-- /Contact Section -->
    </main>

    <footer id="footer" class="footer dark-background">
      <div class="container footer-top">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="index.html" class="logo d-flex align-items-center">
              <span class="sitename">GECO RWANDA</span>
            </a>
            <div class="footer-contact pt-3">
              <p>Rubavu</p>
              <p>Gisenyi</p>
              <p class="mt-3">
                <strong>Phone:</strong> <span>+250 788 507 589 / +250 788 836 616</span>
              </p>
              <p><strong>Email:</strong> <span>globalepelepticc@gmail.com</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href="https://x.com/geco_rwanda"><i class="bi bi-twitter-x"></i></a>
              <a href="https://web.facebook.com/search/top?q=GECO%20RWANDA"><i class="bi bi-facebook"></i></a>
              <a href="https://www.instagram.com/gecorwanda/"><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Publications</a></li>
              <li><a href="#">Actions</a></li>
              <li><a href="#">Team</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><a href="#">Health & Community Outreach</a></li>
              <li><a href="#">Social and Economic Empowerment</a></li>
              <li><a href="#">Education & Inclusion</a></li>
              <li><a href="#">Advocacy & Awareness</a></li>
              <li><a href="#">Capacity Building</a></li>
              <li><a href="#">Research & Data Collection </a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-12 footer-newsletter">
            <h4>Our  Vision</h4>
            <p>
            Our Vision is to see a country where all individuals with epilepsy and other mental 
disabilities enjoy full rights, social inclusion, well-being, and self-reliance, contributing to a 
thriving and sustainable holistic development.

            </p>
           
          </div>
        </div>
      </div>

      <div class="container copyright text-center mt-4">
        <p>
          © <span>Copyright</span>
          <strong class="px-1 sitename">GECO RWANDA</strong>
          <span>All Rights Reserved</span>
        </p>
        <div class="credits">
         
          Designed by <a href="#" class="text-white"style="font-weight:bold;">KWIZERISEZERANO</a>
        </div>
      </div>
    </footer>

    <!-- Scroll Top -->
    <a
      href="#"
      id="scroll-top"
      class="scroll-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- Dark Mode Toggle Script -->
    <script>
      // Dark mode functionality
      const darkModeToggle = document.getElementById('darkModeToggle');
      const themeIcon = document.getElementById('themeIcon');
      const html = document.documentElement;

      // Check for saved theme preference or default to light mode
      const checkDarkMode = () => {
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        const isDark = savedTheme === 'dark' || (!savedTheme && prefersDark);
        updateTheme(isDark);
      };

      const toggleDarkMode = () => {
        const isDark = html.getAttribute('data-theme') === 'dark';
        const newTheme = !isDark;
        updateTheme(newTheme);
        localStorage.setItem('theme', newTheme ? 'dark' : 'light');
      };

      const updateTheme = (isDark) => {
        if (isDark) {
          html.setAttribute('data-theme', 'dark');
          html.classList.add('dark');
          themeIcon.classList.remove('bi-moon');
          themeIcon.classList.add('bi-sun');
        } else {
          html.removeAttribute('data-theme');
          html.classList.remove('dark');
          themeIcon.classList.remove('bi-sun');
          themeIcon.classList.add('bi-moon');
        }
      };

      // Initialize dark mode
      checkDarkMode();

      // Add event listener to toggle button
      darkModeToggle.addEventListener('click', toggleDarkMode);

      // Listen for system theme changes
      const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
      mediaQuery.addEventListener('change', (e) => {
        if (!localStorage.getItem('theme')) {
          updateTheme(e.matches);
        }
      });
    </script>
  </body>
</html>
