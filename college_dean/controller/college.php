<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
// var_dump($_POST);
// var_dump($_FILES);
if(isset($_POST['mode']))
{
    $mode = $_POST['mode'];

    if($mode =="Add")
    {
        //Adding
        if (isset($_POST["collegeName"])) {
            // Retrieve form data
            $collegeName = $_POST['collegeName'];
            $collegeCode = $_POST['collegeCode'];
            $collegeDean = $_POST['collegeDean'];
            $collegeSecretary = $_POST['collegeSecretary'];

            // Handle file upload
            $image = $_FILES['collegeImage'];

            // Check if file was uploaded without errors
            if ($image['error'] == UPLOAD_ERR_OK) {
                $imageTmpPath = $image['tmp_name'];
                $imageName = $image['name'];
                $imageSize = $image['size']; // File size in bytes
                $imageType = $image['type'];

                // Define maximum file size (1MB)
                $maxFileSize = 1 * 1024 * 1024; // 1MB in bytes

                // Define allowed file types
                $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];

                // Check if file size is within the limit
                if ($imageSize > $maxFileSize) {
                    echo '413'; // File size too large
                    exit;
                }

                // Check if file type is allowed
                if (in_array($imageType, $allowedFileTypes)) {
                    // Define upload directory
                    $uploadDir = '../../uploads/college/';
                    
                    // Ensure upload directory exists
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    // Generate unique file name to prevent overwriting
                    $uniqueFileName = uniqid() . '-' . $imageName;

                    // Full path to save the uploaded file
                    $imageFullPath = $uploadDir . $uniqueFileName;

                    // Move the uploaded file to the server
                    if (move_uploaded_file($imageTmpPath, $imageFullPath)) {
                        // File successfully uploaded
                        // Prepare data for insertion into the database
                        $data = array(
                            'college_name' => $collegeName,
                            'college_image' => $uniqueFileName,
                        );

                        // Insert data into the database (using your existing database connection)
                        if ($db->insertData('college_details', $data)) {
                             $college_id = $db->getLastInsertId();

                            $college_officer = array(
                                'college_id' => $college_id,
                                'college_secretary_id' => $collegeSecretary,
                                'college_dean_id' => $collegeDean,
                            );
                            if ($db->insertData('college_officers', $college_officer)) {

                                $data = array(
                                    'added' => '1' 
                                );
                                $whereClause = array(
                                        'id' => $collegeSecretary
                                    );
                                    $whereClause2 = array(
                                        'id' => $collegeDean
                                    );
                            
                                if(($db->updateData('users',$data,$whereClause)) && ($db->updateData('users',$data,$whereClause2))){
                                    echo '200';
                                }else{
                                    echo '500';
                                }
                            }else{
                            echo '500'; // Database insertion error
                            }
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
    echo '400'; // Bad request, no data received
}

    }
}