<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GECO RWANDA - Upload Project</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- SweetAlert CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet" />

    <style>
        /* Centering the upload container */
        .upload-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .upload-container h3 {
            color: rgb(161, 83, 164); /* Purple heading */
            font-weight: 700;
            margin-bottom: 20px;
        }

        .btn-upload {
            background-color: rgb(161, 83, 164); /* Purple button */
            border: none;
        }

        .btn-upload:hover {
            background-color: #5a3791; /* Darker purple on hover */
        }
    </style>
</head>
<body class="index-page">

    <!-- Header Section -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="GECO RWANDA Logo" />
                <h1 class="sitename">GECO RWANDA</h1>
            </a>
            <nav id="navmenu" class="navmenu">
            <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                     <li><a href="view_projects.php" >Projects</a></li>                    
                    <li><a href="view_beneficiaries.php">Beneficiaries</a></li>
                    <li><a href="upload_file.php">Upload Documents</a></li>
                    <!-- <li><a href="projects.php">Add Projects</a></li> -->
                    <li><a href="view_donation.php">Manage donation</a></li>
                    <li><a href="view_members.php">Manage members</a></li>
                    <!-- <li><a href="view_members.php">Manage Members</a></li> -->
                    <li><a href="parteners.php">Partners</a></li>
                    
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <!-- Project Upload Container Section -->
    <div class="container">
        <div class="upload-container">
            <h3 class="text-center">Upload Project</h3>
            <form action="process_upload_project.php" method="post" enctype="multipart/form-data">
                <!-- Project Name Input -->
                <label for="project_name" class="form-label">Project Name:</label>
                <input type="text" name="project_name" class="form-control mb-3" required placeholder="Enter project name">

                <!-- Project Status Dropdown -->
                <label for="status" class="form-label">Select Status:</label>
                <select name="status" class="form-select mb-3" required>
                    <option value="" disabled selected>Select Project Status</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>

                <!-- Submit Button -->
                <button type="submit" name="upload" class="btn btn-upload w-100">Add Project</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
