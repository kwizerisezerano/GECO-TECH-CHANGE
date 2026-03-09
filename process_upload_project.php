<?php
require 'config.php';

if (isset($_POST['upload'])) {
    $projectName = $_POST['project_name'];
    $status = $_POST['status'];

    try {
        // Check if project already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM projects WHERE project_name = :project_name");
        $stmt->bindParam(':project_name', $projectName);
        $stmt->execute();
        $projectExists = $stmt->fetchColumn();

        if ($projectExists > 0) {
            // Project exists, update the existing project
            $stmt = $pdo->prepare("UPDATE projects SET status = :status WHERE project_name = :project_name");
            $stmt->bindParam(':project_name', $projectName);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            echo "<script>
                alert('Project status has been updated successfully.');
                window.location.href = 'projects.php';
            </script>";
        } else {
            // Project does not exist, insert new project
            $stmt = $pdo->prepare("INSERT INTO projects (project_name, status) VALUES (:project_name, :status)");
            $stmt->bindParam(':project_name', $projectName);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            echo "<script>
                alert('Project has been uploaded successfully.');
                window.location.href = 'projects.php';
            </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
            alert('Database Error: " . addslashes($e->getMessage()) . "');
            window.location.href = 'upload_project.php';
        </script>";
    }
}
?>
