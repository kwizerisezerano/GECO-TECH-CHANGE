<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];
    $project_name = $_POST['project_name'];
    $status = $_POST['status'];

    try {
        // Prepare the update query
        $query = "UPDATE projects SET project_name = :project_name, status = :status WHERE project_id = :project_id";
        $stmt = $pdo->prepare($query);

        // Bind parameters
        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            echo '<script>alert("Project updated successfully!"); window.location.href="view_projects.php";</script>';
        } else {
            echo '<script>alert("Error updating project."); window.location.href="update_project.php";</script>';
        }
    } catch (PDOException $e) {
        echo '<script>alert("Error: ' . $e->getMessage() . '"); window.location.href="update_project.php";</script>';
    }
}

if (isset($_GET['id'])) {
    $project_id = $_GET['id'];
    try {
        // Prepare and execute the query to fetch project details
        $query = "SELECT * FROM projects WHERE project_id = :project_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $project = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$project) {
            echo '<script>alert("Project not found."); window.location.href="manage_projects.php";</script>';
        }
    } catch (PDOException $e) {
        echo '<script>alert("Error: ' . $e->getMessage() . '"); window.location.href="manage_projects.php";</script>';
    }
} else {
    echo '<script>alert("Project ID not specified."); window.location.href="manage_projects.php";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GECO RWANDA - Manage Projects</title>
    
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

<!-- Project Upload Container Section -->
<div class="container">
        <div class="upload-container">
            <h3 class="text-center">Upload Project</h3>
            <form method="POST">
            <input type="hidden" name="project_id" value="<?= $project['project_id'] ?>">
            
            <div class="mb-3">
                <label for="project_name" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="project_name" name="project_name" value="<?= $project['project_name'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Project Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Ongoing" <?= $project['status'] == 'Ongoing' ? 'selected' : '' ?>>Ongoing</option>
                    <option value="Pending" <?= $project['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Completed" <?= $project['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-upload">Update Project</button>
        </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to fetch and display projects -->
    <script>
        document.getElementById('status').addEventListener('change', function() {
            let status = this.value; // Get the selected status
            if (status) {
                fetchProjects(status);
            }
        });

        function fetchProjects(status) {
            fetch('get_projects.php?status=' + status)
                .then(response => response.json()) // Parse the JSON response
                .then(data => {
                    let projectList = document.getElementById('projectList');
                    projectList.innerHTML = ''; // Clear previous project list

                    if (data.length > 0) {
                        // Loop through the projects and display them
                        data.forEach(project => {
                            let li = document.createElement('li');
                            li.innerHTML = `
                                ID: ${project.project_id} - ${project.project_name} (${project.status})
                                <div>
                                    <button class="btn-actions" onclick="updateProject(${project.project_id})">Update</button>
                                    <button class="btn-actions" onclick="deleteProject(${project.project_id})">Delete</button>
                                </div>
                            `;
                            projectList.appendChild(li);
                        });
                    } else {
                        projectList.innerHTML = '<li>No projects found.</li>';
                    }
                })
                .catch(error => console.error('Error fetching projects:', error));
        }

        function updateProject(projectId) {
            // Redirect to the update page (assuming you have an update page)
            window.location.href = `update_project.php?id=${projectId}`;
        }

        function deleteProject(projectId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`delete_project.php?id=${projectId}`, {
                        method: 'DELETE',
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Deleted!', 'The project has been deleted.', 'success');
                            fetchProjects(document.getElementById('status').value); // Refresh the project list
                        } else {
                            Swal.fire('Failed!', 'There was a problem deleting the project.', 'error');
                        }
                    })
                    .catch(error => console.error('Error deleting project:', error));
                }
            });
        }
    </script>

</body>
</html>
