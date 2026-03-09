<?php
// Include the payment gateway class or functions
include 'pay_parse.php'; // Modify this to match your actual payment gateway file
// Database connection
require 'config.php'; // Include your database connection settings

// Check if the form is submitted
if (isset($_POST['add'])) {
    // Get form values
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $location = $_POST['location'];
    $donation_amount = $_POST['donation_amount'];

    // Validate inputs
    if (empty($first_name) || empty($last_name) || empty($phone_number) || empty($location) || empty($donation_amount)) {
        echo "<script>alert('All fields are required'); window.history.back();</script>";
        exit();
    }

    try {
        // Payment processing using your payment gateway
        $transaction_ref = uniqid('donation_'); // Generate a unique transaction reference
        $pay = hdev_payment::pay($phone_number, $donation_amount, $transaction_ref); // Replace with actual payment call

        // Set the payment status to 'pending' by default
        $payment_status = 'pending';

        // Prepare the SQL statement to insert donation and payment status
        $sql = "INSERT INTO donation (first_name, last_name, phone_number, location, donation_amount, transaction_ref, payment_status) 
                VALUES (:first_name, :last_name, :phone_number, :location, :donation_amount, :transaction_ref, :payment_status)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $stmt->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt->bindParam(':donation_amount', $donation_amount, PDO::PARAM_STR);
        $stmt->bindParam(':transaction_ref', $transaction_ref, PDO::PARAM_STR);
        $stmt->bindParam(':payment_status', $payment_status, PDO::PARAM_STR);

        // Execute the insertion query
        if ($stmt->execute()) {
            echo "<script>
                    alert('Donation and payment added successfully with pending status.');
                    window.location.href = 'index.php'; // Redirect after success
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to add donation and payment.');
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Database Error: " . $e->getMessage() . "');
              </script>";
    } catch (Exception $e) {
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
              </script>";
    }
}
?>
