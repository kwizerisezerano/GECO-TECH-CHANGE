<?php
require 'config.php';

if (isset($_POST['upload'])) {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $selectedType = $_POST['file_type'];

        // Validate file type (PDF only)
        $allowedTypes = ['application/pdf'];
        if (!in_array($fileType, $allowedTypes)) {
            echo "<script>
                alert('Invalid File Type: Only PDF files are allowed.');
                window.location.href = 'index.php';
            </script>";
            exit;
        }

        // Validate dropdown file type
        $validTypes = [
            'strategic plan', 'report', 'constitution with laws',
            'policies', 'achievements', 'implementation plan', 'partners','rgb', 'rbc', 'ibe'
        ];
        if (!in_array($selectedType, $validTypes)) {
            echo "<script>
                alert('Invalid File Type Selected: Please select a valid file type.');
                window.location.href = 'index.php';
            </script>";
            exit;
        }

        // Read file content
        $fileData = file_get_contents($fileTmpPath);

        try {
            // Check if file type already exists
            $stmt = $pdo->prepare("SELECT id FROM pdf_files WHERE file_type = :file_type");
            $stmt->bindParam(':file_type', $selectedType);
            $stmt->execute();
            $existingFile = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingFile) {
                // Update existing record
                $stmt = $pdo->prepare("
                    UPDATE pdf_files 
                    SET file_name = :file_name, file_data = :file_data, uploaded_at = CURRENT_TIMESTAMP()
                    WHERE file_type = :file_type
                ");
                $stmt->bindParam(':file_name', $fileName);
                $stmt->bindParam(':file_data', $fileData, PDO::PARAM_LOB);
                $stmt->bindParam(':file_type', $selectedType);

                if ($stmt->execute()) {
                    echo "<script>
                        alert('File Updated: PDF file updated successfully for \"$selectedType\".');
                        window.location.href = 'index.php';
                    </script>";
                    exit;
                }
            } else {
                // Insert new record
                $stmt = $pdo->prepare("
                    INSERT INTO pdf_files (file_name, file_data, file_type) 
                    VALUES (:file_name, :file_data, :file_type)
                ");
                $stmt->bindParam(':file_name', $fileName);
                $stmt->bindParam(':file_data', $fileData, PDO::PARAM_LOB);
                $stmt->bindParam(':file_type', $selectedType);

                if ($stmt->execute()) {
                    echo "<script>
                        alert('Upload Successful: PDF uploaded as \"$selectedType\".');
                        window.location.href = 'index.php';
                    </script>";
                    exit;
                }
            }

        } catch (PDOException $e) {
            echo "<script>
                alert('Database Error: " . addslashes($e->getMessage()) . "');
                window.location.href = 'index.php';
            </script>";
            exit;
        }

    } else {
        echo "<script>
            alert('No File Selected: Please select a file to upload.');
            window.location.href = 'index.php';
        </script>";
        exit;
    }
}
?>

