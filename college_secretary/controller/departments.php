<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
// var_dump($_POST);
// var_dump($_FILES);
if(isset($_POST['mode']))
{
    $mode = $_POST['mode'];

    if(isset($_SESSION['college_id']))
    {
        $college_id = $_SESSION['college_id'];
        if($mode =="Add")
        {
            //Adding
            if (isset($_POST["departmentName"])) {
                // Retrieve form data
                $departmentName = $_POST['departmentName'];
                $departmentCode = $_POST['departmentCode'];

                // Handle file upload
                $image = $_FILES['departmentImage'];

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
                        $uploadDir = '../../uploads/departments/';
                        
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
                                'department_name' => $departmentName,
                                'department_code' => $departmentCode,
                                'department_image' => $uniqueFileName, // Save file name to the database
                                'depatment_college' => $college_id, // Save file name to the database
                                
                            );

                            // Insert data into the database (using your existing database connection)
                            if ($db->insertData('department_details', $data)) {
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
                echo '400'; // Bad request, no data received
            }
        }
        else if($mode =="Edit")
        {
            //Adding
            if (isset($_POST["departmentName"])) {
                // Retrieve form data
                $departmentName = $_POST['departmentName'];
                $departmentCode = $_POST['departmentCode'];
                $id = $_POST['id'];

                // Handle file upload

                
                $image = $_FILES['departmentImage'];

                $data = array(
                    'department_name' => $departmentName,
                    'department_code' => $departmentCode,
                );

                if($image['name']!="")
                {
                    
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
                            $uploadDir = '../../uploads/departments/';
                            
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
                                $data["department_image"] = $uniqueFileName;
                            }else{
                                echo '403'; // File upload error
                            }
                        }else{
                            echo '415'; // File upload error
                        }
                    }else{
                        echo '400'; // File upload error
                    }

                }
                   
                    $whereClause = array(
                        'id' => $id
                    );

                    if($db->updateData('department_details',$data,$whereClause)){
                        echo '201';
                    }else{
                        echo '500';
                    }

               
            } else {
                echo '400'; // Bad request, no data received
            }
        }
    }
}