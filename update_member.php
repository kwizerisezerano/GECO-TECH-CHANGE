
<?php
require 'config.php';

// Fetch Member Data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM members WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$member) {
        die("Member not found.");
    }
} else {
    die("ID is missing.");
}

// Update Member Data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $role = $_POST['role'];

    $sql = "UPDATE members SET first_name = :first_name, last_name = :last_name, phone_number = :phone_number, role = :role WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
      echo "<script>
      alert('Member updated successfully!');
      window.location.href = 'view_members.php';
    </script>";
exit;
    } else {
      echo "<script>
      alert('An error occurred while updating the member.');
    </script>";
print_r($stmt->errorInfo());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GECO RWANDA - Manage Members</title>
    
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

        /* Project list styling */
        .project-list {
            margin-top: 20px;
        }

        .project-list ul {
            list-style-type: none;
            padding: 0;
        }

        .project-list li {
            background-color: #f1f1f1;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-actions {
            background-color: rgb(161, 83, 164);
            border: none;
            color: white;
        }

        .btn-actions:hover {
            background-color: #5a3791;
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

    < <div class="container">
        <div class="upload-container">
            <h3 class="text-center mb-4">Update Member</h3>

            <form action="update_member.php?id=<?= $member['id'] ?>" method="POST" onsubmit="return validateForm()">
                <input type="hidden" name="id" value="<?= $member['id'] ?>">
                
                <div class="mb-3">
                    <label class="form-label">First Name:</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" value="<?= htmlspecialchars($member['first_name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" value="<?= htmlspecialchars($member['last_name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?= htmlspecialchars($member['phone_number']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role:</label>
                    <select name="role" class="form-select" required>
                    <option value="" disabled selected>Select Role</option>
                            <option value="Legal Representative">Legal Representative</option>
                            <option value="Deputy Legal Representative">Deputy Legal Representative</option>
                            <option value="GECO Executive Secretary">GECO Executive Secretary</option>
                            <option value="GECO General Secretary">GECO General Secretary</option>
                            <option value="GECO Treasurer">GECO Treasurer</option>
                            <option value="GECO Advisor">GECO Advisor</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-upload w-100">Update Member</button>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for validation -->
    <script>
        function validateForm() {
            var firstName = document.getElementById('first_name').value.trim();
            var lastName = document.getElementById('last_name').value.trim();
            var phoneNumber = document.getElementById('phone_number').value.trim();

            var namePattern = /^[A-Za-z\s]+$/;
            var phonePattern = /^\d{10,15}$/;

            if (!namePattern.test(firstName)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Input',
                    text: 'First name can only contain letters and spaces.',
                });
                return false;
            }

            if (!namePattern.test(lastName)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Input',
                    text: 'Last name can only contain letters and spaces.',
                });
                return false;
            }

            if (!phonePattern.test(phoneNumber)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Input',
                    text: 'Phone number must be between 10 and 15 digits.',
                });
                return false;
            }

            return true; 
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>