<?php
// Database connection
require 'config.php';

// Check if form is submitted
if (isset($_POST['add'])) {
    // Get form values
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $idno_type = $_POST['idnotype'];
    $idno = $_POST['idno'];

    // Validate inputs (You can add more validation if needed)
    if (empty($first_name) || empty($last_name) || empty($phone_number) ) {
        echo "<script>alert('All fields are required'); window.history.back();</script>";
        exit();
    }

    try {
        // Check if the ID number already exists (only check ID number)
        $sql_check = "SELECT COUNT(*) FROM beneficiaries WHERE idno = :idno";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->bindParam(':idno', $idno, PDO::PARAM_STR);
        $stmt_check->execute();

        // Get the count of matching records
        $count = $stmt_check->fetchColumn();

        // If the count is greater than 0, it means the ID number already exists
        if ($count > 0) {
            echo "<script>alert('The ID number already exists.'); window.history.back();</script>";
            exit();
        }

        // Prepare the SQL statement for insertion
        $sql = "INSERT INTO beneficiaries (first_name, last_name, phone_number, idno_type, idno) 
                VALUES (:first_name, :last_name, :phone_number, :idno_type, :idno)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $stmt->bindParam(':idno_type', $idno_type, PDO::PARAM_STR);
        $stmt->bindParam(':idno', $idno, PDO::PARAM_STR);

        // Execute statement
        if ($stmt->execute()) {
            echo "<script>
                    alert('Beneficiary added successfully.');
                    window.location.href = 'view_beneficiaries.php'; // Redirect after success
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to add beneficiary.');
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Database Error: " . $e->getMessage() . "');
              </script>";
    }
}
?>
