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

        /* Enhanced project card styling */
        .project-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .project-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .project-header {
            background: linear-gradient(135deg, rgb(161, 83, 164), #5a3791);
            color: white;
            padding: 20px;
            position: relative;
        }

        .project-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            margin-bottom: 10px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-ongoing {
            background-color: #28a745;
            color: white;
        }

        .status-pending {
            background-color: #ffc107;
            color: #212529;
        }

        .status-completed {
            background-color: #007bff;
            color: white;
        }

        .project-body {
            padding: 20px;
        }

        .project-info {
            margin-bottom: 15px;
        }

        .project-info h6 {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .project-info p {
            margin: 0;
            font-size: 1rem;
            color: #212529;
        }

        .project-actions {
            background: #f8f9fa;
            padding: 15px 20px;
            border-top: 1px solid #e9ecef;
        }

        .btn-actions {
            background-color: rgb(161, 83, 164);
            border: none;
            color: white;
            padding: 8px 16px;
            margin-right: 8px;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .btn-actions:hover {
            background-color: #5a3791;
            transform: translateY(-1px);
        }

        .btn-actions a {
            color: white;
            text-decoration: none;
        }

        .no-projects {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .no-projects i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #dee2e6;
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

    <!-- Project Status Filter Section -->
    <div class="container">
        <div class="upload-container">
            <h3 class="text-center">Manage Projects</h3>
            
            <!-- Status Dropdown -->
            <label for="status" class="form-label">Select Project Status:</label>
            <select name="status" id="status" class="form-select mb-3">
                <option value="" disabled selected>Select Project Status</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
            </select>
            
            <!-- Project List -->
            <div class="project-list">
                <div id="projectList"></div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
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
                            let statusClass = project.status.toLowerCase() === 'ongoing' ? 'status-ongoing' : 
                                             project.status.toLowerCase() === 'pending' ? 'status-pending' : 'status-completed';
                            
                            let projectCard = document.createElement('div');
                            projectCard.className = 'project-card';
                            projectCard.innerHTML = `
                                <div class="project-header">
                                    <h5 class="project-title">${project.project_name}</h5>
                                    <span class="status-badge ${statusClass}">${project.status}</span>
                                </div>
                                <div class="project-body">
                                    ${project.description ? `
                                        <div class="project-info">
                                            <h6>Description</h6>
                                            <p>${project.description}</p>
                                        </div>
                                    ` : ''}
                                    <div class="row">
                                        ${project.start_date ? `
                                            <div class="col-md-6">
                                                <div class="project-info">
                                                    <h6>Start Date</h6>
                                                    <p>${new Date(project.start_date).toLocaleDateString()}</p>
                                                </div>
                                            </div>
                                        ` : ''}
                                        ${project.end_date ? `
                                            <div class="col-md-6">
                                                <div class="project-info">
                                                    <h6>End Date</h6>
                                                    <p>${new Date(project.end_date).toLocaleDateString()}</p>
                                                </div>
                                            </div>
                                        ` : ''}
                                    </div>
                                    ${project.budget ? `
                                        <div class="project-info">
                                            <h6>Budget</h6>
                                            <p>RWF ${parseFloat(project.budget).toLocaleString()}</p>
                                        </div>
                                    ` : ''}
                                    <div class="project-info">
                                        <h6>Created</h6>
                                        <p>${new Date(project.created_at).toLocaleDateString()}</p>
                                    </div>
                                </div>
                                <div class="project-actions">
                                    <button class="btn-actions"><a href="projects.php" class="text-white">Add Project</a></button>
                                    <button class="btn-actions" onclick="updateProject(${project.id})">Update</button>
                                    <button class="btn-actions" onclick="deleteProject(${project.id})">Delete</button>
                                </div>
                            `;
                            projectList.appendChild(projectCard);
                        });
                    } else {
                        projectList.innerHTML = `
                            <div class="no-projects">
                                <i class="bi bi-folder-x"></i>
                                <h5>No projects found</h5>
                                <p>No projects match the selected status.</p>
                            </div>
                        `;
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
            // Send the DELETE request using POST with a method parameter
            fetch(`delete_project.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ project_id: projectId, action: 'delete' }), // Pass the project ID and action
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
