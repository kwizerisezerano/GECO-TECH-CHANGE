<?php
// Database connection details
// Retrieve the POST data (JSON)
require 'config.php';
$data = json_decode(file_get_contents("php://input"));

if (isset($data->project_id) && isset($data->action) && $data->action === 'delete') {
    $projectId = $data->project_id;

    // SQL query to delete the project
    $sql = "DELETE FROM projects WHERE project_id = :project_id";

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);

        // Execute the statement and check if it's successful
        if ($stmt->execute()) {
            // Return success response if deletion was successful
            echo json_encode(['success' => true]);
        } else {
            // Return failure response if deletion was not successful
            echo json_encode(['success' => false]);
        }
    } catch (PDOException $e) {
        // Return error if there was a problem executing the query
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    // Return error if required data is not provided
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
}
?>
