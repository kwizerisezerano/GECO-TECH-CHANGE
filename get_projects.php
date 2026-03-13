<?php
// get_projects.php

// Include your database connection
include('config.php');  // Assuming you have a db_connection.php file for the DB connection

// Get the status from the URL query parameters
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Prepare the SQL query
$sql = "SELECT id, project_name, status, description, start_date, end_date, budget, created_at FROM projects WHERE status = :status";

// Prepare the statement
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':status', $status, PDO::PARAM_STR);

// Execute the query
$stmt->execute();

// Fetch the results
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if any projects were found and return the JSON response
if ($projects) {
    echo json_encode($projects);
} else {
    echo json_encode([]);
}
?>
