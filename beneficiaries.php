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
                    
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <!-- Project Upload Container Section -->
    <div class="container">
        <div class="upload-container">
            <h3 class="text-center">Add Beneficiaries</h3>
            <form action="process_beneficiaries.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="modal-body">
                    <!-- First Name -->
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required>
                    </div>
                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                    </div>
                    <!-- Phone Number -->
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                    </div>
                    <!-- IDNO Type -->
                    <div class="form-group">
                        <label for="idnotype">Choose IDNO Type</label>
                        <select name="idnotype" id="idnotype" class="form-control" onchange="toggleIDNOValidation()">
                            <option value="Rwandan">Rwandan</option>
                            <option value="Foreign">Foreign</option>
                        </select>
                    </div>
                    <!-- IDNO (conditional validation) -->
                    <div class="form-group mb-4">
                        <label for="idno">IDNO</label>
                        <input type="text" id="idno" name="idno" class="form-control" >
                        <span id="idnoError" style="color: red; font-size: 0.9em;"></span>
                    </div>
                  
                </div>
                <!-- Submit Button -->
                <button type="submit" name="add" class="btn btn-upload w-100">Add Beneficiaries</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function validateForm() {
            const firstName = document.getElementById('first_name').value.trim();
            const lastName = document.getElementById('last_name').value.trim();
            const phoneNumber = document.getElementById('phone_number').value.trim();
            const idno = document.getElementById('idno').value.trim();
            const idnoType = document.getElementById('idnotype').value;
            const picture = document.getElementById('picture').files[0];

            const errors = [];

            // Validate name fields
            if (!/^[a-zA-Z ]+$/.test(firstName)) errors.push("First name must contain only letters and spaces.");
            if (!/^[a-zA-Z ]+$/.test(lastName)) errors.push("Last name must contain only letters and spaces.");

            // Validate phone number
            if (!/^\d{10,15}$/.test(phoneNumber)) {
                errors.push("Phone number must contain digits only and be between 10 and 15 digits.");
            }

            // Conditional validation for IDNO
            if (idnoType === "Rwandan") {
                if (!validateIDNO(idno)) {
                    errors.push("Invalid Rwandan National ID format.");
                }
            } else {
                if (!/^\d+$/.test(idno)) {
                    errors.push("Foreign IDNO must contain only digits.");
                }
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

        function validateIDNO(idno) {
            if (idno.length !== 16) return false;

            const nationalIdentifier = idno[0];
            if (!['1', '2', '3'].includes(nationalIdentifier)) return false;

            const birthYear = parseInt(idno.substring(1, 5), 10);
            const currentYear = new Date().getFullYear();
            if (birthYear < 1900 || birthYear > currentYear) return false;

            const genderIdentifier = idno[5];
            if (!['8', '7'].includes(genderIdentifier)) return false;

            const birthOrderNumber = idno.substring(6, 13);
            if (!/^\d{7}$/.test(birthOrderNumber)) return false;

            const issueFrequency = idno[13];
            if (!/^\d$/.test(issueFrequency)) return false;

            const securityCode = idno.substring(14, 16);
            if (!/^\d{2}$/.test(securityCode)) return false;

            return true;
        }

        function toggleIDNOValidation() {
            const idnoType = document.getElementById('idnotype').value;
            const idnoInput = document.getElementById('idno');
            const errorSpan = document.getElementById('idnoError');

            if (idnoType === "Rwandan") {
                idnoInput.setAttribute("maxlength", "16");
                errorSpan.textContent = ""; // Clear error message
            } else {
                idnoInput.removeAttribute("maxlength"); // Allow more than 16 digits
                errorSpan.textContent = ""; // Clear error message
            }
        }

        // Real-time validation for IDNO with inline feedback
        document.getElementById('idno').addEventListener('input', function () {
            const idnoType = document.getElementById('idnotype').value;
            const value = this.value;
            const errorSpan = document.getElementById('idnoError');

            if (idnoType === "Rwandan") {
                // Allow up to 16 digits only
                if (!/^\d{0,16}$/.test(value)) {
                    this.value = value.slice(0, -1); // Revert last input if invalid
                }
                if (this.value.length < 16) {
                    errorSpan.textContent = "IDNO should be exactly 16 digits.";
                } else if (!validateIDNO(this.value)) {
                    errorSpan.textContent = "Invalid Rwandan IDNO format.";
                } else {
                    errorSpan.textContent = ""; // Clear error message
                }
            }
        });
    </script>
</body>

</html>
