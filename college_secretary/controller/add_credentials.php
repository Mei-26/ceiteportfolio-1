<?php
require '../../conn/conn.php';
$db = new DatabaseHandler();

// Check if file and form data are submitted, and session user ID exists
if (isset($_FILES['image'], $_POST['title'], $_POST['description'], $_POST['date']) && isset($_SESSION['id'])) {
    // Sanitize form inputs
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $date = htmlspecialchars($_POST['date']);
    $user_id = $_SESSION['id'];

    // Handle file upload
    $file = $_FILES['image'];

    // Check if file was uploaded without errors
    if ($file['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size']; // File size in bytes
        $fileType = $file['type'];

        // Define maximum file size (5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

        // Define allowed file types (images and PDFs)
        $allowedFileTypes = [
            'image/jpeg', 'image/png', 'image/gif', // Image types
            'application/pdf' // PDF type
        ];

        // Check if file size is within the limit
        if ($fileSize > $maxFileSize) {
            echo '413'; // File size too large
            exit;
        }

        // Check if file type is allowed
        if (in_array($fileType, $allowedFileTypes)) {
            // Sanitize filename by removing special characters
            $fileName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $fileName);

            // Define upload directory
            $uploadDir = '../../uploads/credentials/';
            
            // Ensure upload directory exists
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Generate unique file name to prevent overwriting
            $uniqueFileName = uniqid() . '-' . $fileName;

            // Full path to save the uploaded file
            $fileFullPath = $uploadDir . $uniqueFileName;

            // Move the uploaded file to the server
            if (move_uploaded_file($fileTmpPath, $fileFullPath)) {
                // File successfully uploaded
                $data_details = array(
                    'user_id' => $user_id,
                    'title' => $title,
                    'description' => $description,
                    'image' => $uniqueFileName,
                    'file_type' => $fileType,
                    'date' => $date
                );

                // Insert into database
                if ($db->insertData('credential_added', $data_details)) {
                    echo '200'; // Success
                } else {
                    echo '500'; // Database insertion error
                }
            } else {
                echo '403'; // Error moving file
            }
        } else {
            echo '415'; // Unsupported media type
        }
    } else {
        echo '400'; // File upload error
    }
} else {
    echo '600'; // Missing file or session ID
}
?>
