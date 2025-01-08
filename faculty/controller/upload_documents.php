<?php
require '../../conn/conn.php';
$db = new DatabaseHandler();

if (isset($_FILES['uploadFile'], $_POST['form_id'], $_POST['subject_id'],$_POST['section_id'], $_SESSION['id'])) {
    // Handle file upload
    $user_id = $_SESSION['id'];

    $department_id = $db->getIdByColumnValue("department_faculty", "faculty_id", $user_id, 'department_id');
    $college_id = $db->getIdByColumnValue("department_details","id",$department_id,"depatment_college");

    $where = array(
        'college_id'=>$_SESSION['college_id'],
        'current_status'=>'current',
      );
      
    $current_sem = $db->getIdByColumnValueWhere("current_year_sem",$where, "current_sem");
    $current_year = $db->getIdByColumnValueWhere("current_year_sem",$where,"current_year");

    
    $file = $_FILES['uploadFile'];
    $upload_id = $_POST['form_id'];
    $subject_id = $_POST['subject_id'];
    $section_id = $_POST['section_id'];

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
            $uploadDir = '../../uploads/files/';
            
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
                
                $where = [
                    "section_id=".$section_id,
                    "subject_id=".$subject_id,
                    "faculty_id=".$user_id,
                    "upload_id=".$upload_id,
                    "semester="."'$current_sem'",
                    "year="."'$current_year'",
            ];
                $checkRows = $db->getAllRowsFromTableWhere("faculty_uploads",$where );
                if(count($checkRows)!=0)
                {
                    $date = new DateTime();

                    // Format the date-time in 'Y-m-d H:i:s' format
                    $datetime_created = $date->format('Y-m-d H:i:s');

                    // Output the formatted date-time
                    $data_details = array(
                        'file' => $uniqueFileName, // Save the filename, not the file array
                        'datetime_created' => $datetime_created // Save the filename, not the file array
                    );
                    $where = [
                        "section_id" => $section_id,
                        "subject_id" => $subject_id,
                        "faculty_id" => $user_id,
                        "upload_id" => $upload_id,
                        "semester" => $current_sem,
                        "year" => $current_year,
                    ];
                    // echo '<pre>';
                    // var_dump($where);
                    if ($db->updateData('faculty_uploads', $data_details, $where)) {
                        echo '201';
                    } else {
                        echo '500'; // Database insertion error
                    }

                    exit();
                }


                $data_details = array(
                    "section_id" => $section_id,
                    'faculty_id' => $user_id,
                    'subject_id' => $subject_id,
                    'upload_id' => $upload_id,
                    'file' => $uniqueFileName, // Save the filename, not the file array
                    'semester' => $current_sem, // Save the filename, not the file array
                    'year' => $current_year // Save the filename, not the file array
                );

                if ($db->insertData('faculty_uploads', $data_details)) {
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
