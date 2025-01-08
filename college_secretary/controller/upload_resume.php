<?php
require '../../conn/conn.php';
$db = new DatabaseHandler();

if (isset($_FILES['uploadResume']) && isset($_SESSION['id'])) {
    // Handle file upload
    $file = $_FILES['uploadResume'];
    $user_id = $_SESSION['id'];

    // Check if file was uploaded without errors
    if ($file['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size']; // File size in bytes
        $fileType = $file['type'];

        // Define maximum file size (5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

        // Define allowed file types (images, PDF, and Word documents)
        $allowedFileTypes = [
            'image/jpeg', 'image/png', 'image/gif',
            'application/pdf',
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
            $uploadDir = '../../uploads/resume/';
            
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
                // Prepare data for insertion into the database
                
                $resume_id = $db->getIdByColumnValue("resume_upload","faculty_id",$user_id,"id");
                
                // Check for update
                if ($resume_id != "") {
                    $data_details = array(
                        'file' => $uniqueFileName,
                        'file_type' => $fileType
                    );

                     $where = [
                        'id' => $resume_id,
                        'faculty_id' => $user_id,
                    ];

                    if ($db->updateData('resume_upload', $data_details, $where)) {
                        echo '200';
                    } else {
                        echo '500'; // Database insertion error
                    }

                    exit();
                }

                $data_details = array(
                    'faculty_id' => $user_id,
                    'file' => $uniqueFileName,
                    'file_type' => $fileType
                );

                if ($db->insertData('resume_upload', $data_details)) {
                    echo '200';
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
