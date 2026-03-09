<?php
// Database connection
require 'config.php';

// Check if the request is coming from a valid source (POST method)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if ID is provided
    if (isset($data['id'])) {
        $id = $data['id'];

        // Delete beneficiary
        $sql = "DELETE FROM beneficiaries WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete beneficiary']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No ID provided']);
    }
}
?>
