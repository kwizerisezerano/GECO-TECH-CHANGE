<?php
// Database connection
require 'config.php';
include'pay_parse.php';

// Count Payment Status (Success, Failed, Pending)
$statusCountSql = "SELECT 
    SUM(payment_status = 'success') AS success_count,
    SUM(payment_status = 'failed') AS failed_count,
    SUM(payment_status = 'pending') AS pending_count
FROM donation";
$statusStmt = $pdo->prepare($statusCountSql);
$statusStmt->execute();
$statusCounts = $statusStmt->fetch(PDO::FETCH_ASSOC);

// Pagination Logic
$limit = 10; // Records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch Paginated Donation Data
$sql = "SELECT * FROM donation ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$donations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Total Records for Pagination
$totalSql = "SELECT COUNT(*) AS total FROM donation";
$totalStmt = $pdo->prepare($totalSql);
$totalStmt->execute();
$totalRecords = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalRecords / $limit);

// Update Payment Status for Pending Payments
$loanPaymentsSql = "SELECT donation_id, transaction_ref, payment_status FROM donation ";
$loanStmt = $pdo->prepare($loanPaymentsSql);
$loanStmt->execute();
$loanPayments = $loanStmt->fetchAll(PDO::FETCH_ASSOC);

// Loop through pending payments
foreach ($loanPayments as $payment) {
    $ref_id = $payment['transaction_ref'];
    $id = $payment['donation_id'];

    // Fetch payment status from the payment gateway
    $paymentResponse = hdev_payment::get_pay($ref_id); // Replace with your actual payment gateway logic

    if ($paymentResponse) {
        $status1 = $paymentResponse->status ?? null;

        // Map payment status
        $newStatus = match ($status1) {
            'success' => "success",
            'failed' => "failed",
            'pending', 'initiated' => "pending",
            default => "unknown",
        };

        if ($newStatus === "unknown") {
            error_log("Unexpected payment status: {$status1} for transaction ref: {$ref_id}, Payment ID: {$id}");
        }

        // Update payment status in the database
        $updateStmt = $pdo->prepare("
            UPDATE donation 
            SET payment_status = :payment_status 
            WHERE donation_id = :id
        ");
        $updateStmt->bindValue(':payment_status', $newStatus);
        $updateStmt->bindValue(':donation_id', $id, PDO::PARAM_INT);

        try {
            $updateStmt->execute();

            if ($updateStmt->rowCount() === 0) {
                error_log("No rows updated for donation ID: {$id}");
            }
        } catch (PDOException $e) {
            error_log("Database update error for ID {$id}: " . $e->getMessage());
        }
    } else {
        error_log("Payment gateway response missing for transaction ref: {$ref_id}");
    }
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
        .status-summary {
            margin: 60px 0;
        }
        .status-summary .card {
            text-align: center;
            font-weight: bold;
        }
        .status-summary .card h5 {
            margin-bottom: 2px;
        }
        .project-table {
            margin-top: 30px;
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

    <!-- Status Summary Section -->
    <div class="container mt-1 pt-5">
        <h3 class="text-center"></h3>
        <div class="row status-summary">
            <div class="col-md-4">
                <div class="card bg-success text-white p-3">
                    <h5 class="text-white">Success</h5>
                    <p><?= $statusCounts['success_count'] ?? 0 ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white p-3">
                    <h5 class="text-white">Pending</h5>
                    <p><?= $statusCounts['pending_count'] ?? 0 ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white p-3">
                    <h5 class="text-white">Failed</h5>
                    <p><?= $statusCounts['failed_count'] ?? 0 ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Donation Records Table -->
    <div class="container project-table">
        <h3 class="text-center mt-1">Donation Records</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Location</th>
                    <th>Donation Amount</th>
                    <th>Payment Status</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donations as $donation): ?>
                    <tr>
                        <td><?= htmlspecialchars($donation['donation_id']) ?></td>
                        <td><?= htmlspecialchars($donation['first_name']) ?></td>
                        <td><?= htmlspecialchars($donation['last_name']) ?></td>
                        <td><?= htmlspecialchars($donation['phone_number']) ?></td>
                        <td><?= htmlspecialchars($donation['location']) ?></td>
                        <td><?= htmlspecialchars($donation['donation_amount']) ?></td>
                        <td><?= htmlspecialchars($donation['payment_status']) ?></td>
                        <td><?= htmlspecialchars($donation['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>


    
</body>
</html>
