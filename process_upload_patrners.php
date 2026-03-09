<?php
require 'config.php';

if (isset($_POST['upload'])) {
    $partnerName = $_POST['project_name'];

    try {
        // Check if partner already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM partners WHERE partner_name = :partner_name");
        $stmt->bindParam(':partner_name', $partnerName);
        $stmt->execute();
        $partnerExists = $stmt->fetchColumn();

        if ($partnerExists > 0) {
            // Partner already exists, show an alert
            echo "<script>
                alert('Partner with this name already exists.');
                window.location.href = 'view_partners.php'; // Corrected file name
            </script>";
        } else {
            // Partner does not exist, insert new partner
            $stmt = $pdo->prepare("INSERT INTO partners (partner_name) VALUES (:partner_name)");
            $stmt->bindParam(':partner_name', $partnerName);
            $stmt->execute();

            echo "<script>
                alert('Partner has been added successfully.');
                window.location.href = 'view_partners.php';
            </script>";
        }
    } catch (PDOException $e) {
        // More robust error handling
        error_log("Database error: " . $e->getMessage()); // Log the error to a file
        echo "<script>
            alert('A database error occurred. Please try again later.');
            window.location.href = 'view_partners.php';
        </script>";
    }
}
?>