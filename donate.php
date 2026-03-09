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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />

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
            padding: 10px 30px;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .upload-container h3 {
            color: rgb(161, 83, 164); /* Purple heading */
            font-weight: 700;
            margin-bottom: 2px;
        }

        /* Style input fields */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input:focus {
            border-color: rgb(161, 83, 164); /* Purple border on focus */
            outline: none;
        }

        /* Style for labels */
        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        /* Style for buttons */
        .btn-upload {
            background-color: rgb(161, 83, 164); /* Purple button */
            border: none;
            padding: 10px 20px;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-upload:hover {
            background-color: #5a3791; /* Darker purple on hover */
        }

        .btn-upload:focus {
            outline: none;
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
  
        <div class="upload-container">
            <h3 class="text-center">Donor</h3>
            <form action="process_donation.php" method="POST">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <div class="form-group">
                <label for="donation_amount">Donation Amount:</label>
                <input type="number" id="donation_amount" name="donation_amount" required step="0.01">
            </div>
            <button type="submit"class="btn-upload" name="add">Send Donation</button>
        </form>
        </div>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function validateForm() {
            const firstName = document.getElementById('first_name').value.trim();
            const lastName = document.getElementById('last_name').value.trim();
            const phoneNumber = document.getElementById('phone_number').value.trim();
            const idno = document.getElementById('idno').value.trim();
          

            const errors = [];

            // Validate name fields
            if (!/^[a-zA-Z ]+$/.test(firstName)) errors.push("First name must contain only letters and spaces.");
            if (!/^[a-zA-Z ]+$/.test(lastName)) errors.push("Last name must contain only letters and spaces.");

            // Validate phone number
            if (!/^\d{10,15}$/.test(phoneNumber)) {
                errors.push("Phone number must contain digits only and be between 10 and 15 digits.");
            }

         

          

            // Display errors if any
            if (errors.length > 0) {
                Swal.fire({
                    icon: "error",
                    title: "Validation Error",
                    html: errors.join("<br>"),
                    confirmButtonText: "OK"
                });
                return false;
            }

            return true;
        }

        
    </script>
</body>

</html>
