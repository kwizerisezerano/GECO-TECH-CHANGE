<?php
// Database connection
require 'config.php';

// Check if the incoming request is a POST request and contains JSON data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = $data['id'];

    // Prepare the DELETE statement
    $stmt = $pdo->prepare("DELETE FROM partners WHERE partner_id = ?");
    $stmt->execute([$id]);

    // Check if the deletion was successful
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete partner.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No partner ID provided.']);
}
?>
