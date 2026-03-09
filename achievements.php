<?php
// view_report.php
require 'config.php'; // Database connection

try {
    // Fetch file details where file_type is 'report'
    $query = "SELECT file_name, file_data FROM pdf_files WHERE file_type = 'achievements' LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $file = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($file) {
        // Display PDF in an iframe with a Close button
        echo "<html><head><title>View Report</title></head>";
        echo "<body style='margin: 0;'>";

        echo "<iframe src='data:application/pdf;base64," . base64_encode($file['file_data']) . "' 
                style='width: 100%; height: 90vh; border: none;' 
                title='Report'></iframe>";
        
        // Add a close button
        echo "<div style='text-align: center; padding: 10px;'>
                <button onclick='closeDocument()' style='padding: 10px 20px; font-size: 16px;background-color:skyblue;border:none;border-radius: 5px;'>Close Document</button>
              </div>";
        
        // Close function with redirection
        echo "<script>
                function closeDocument() {
                    if (confirm('Are you sure you want to close this document?')) {
                        window.location.href = 'index.php';
                    }
                }
              </script>";

        echo "</body></html>";
    } else {
        // Error message if file not found
        echo "<script>
            alert('Report not found.');
            window.location.href = 'index.php';
        </script>";
    }
} catch (PDOException $e) {
    // Display error message
    echo "<script>
        alert('Database Error: " . addslashes($e->getMessage()) . "');
        window.location.href = 'index.php';
    </script>";
}
?>
