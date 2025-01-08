<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
// var_dump($_POST);
// var_dump($_FILES);
if(isset($_POST['mode']))
{
    $mode = $_POST['mode'];

    if(isset($_SESSION['id'],$_POST['id']))
    {
        $secretary_id = $_SESSION['id'];
        $department_id = $_POST['id'];
        $college_id = $db->getIdByColumnValue("department_details","id",$department_id,"depatment_college");

        if($mode =="Add")
        {
            //Adding
            if (isset($_POST["courseName"])) {
                // Retrieve form data
                $courseName = $_POST['courseName'];
                // Handle file upload
                $image = $_FILES['courseImage'];

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
                        $uploadDir = '../../uploads/courses/';
                        
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
                                'name' => $courseName,
                                'secretary_id' => $secretary_id,
                                'department_id' => $department_id,
                                'image' => $uniqueFileName, // Save file name to the database
                                'college_id' => $college_id, // Save file name to the database
                                
                            );

                            // Insert data into the database (using your existing database connection)
                            if ($db->insertData('course', $data)) {
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
        else if($mode == "Edit") {
            // Adding
            if (isset($_POST["courseName"])) {
                // Retrieve form data
                $courseName = trim($_POST['courseName']);
                $department_id = $_POST['id'];
                $edit_id = $_POST['edit_id'];
                $image = $_FILES['courseImage'];
        
                $data = array();
        
                if($courseName != "") {
                    $data['name'] = $courseName;
                }
        
                if($image['name'] != "") {
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
                            $uploadDir = '../../uploads/courses/';
        
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
                                $data["image"] = $uniqueFileName;
                            } else {
                                echo '403'; // File upload error
                                exit;
                            }
                        } else {
                            echo '415'; // Unsupported Media Type
                            exit;
                        }
                    } else {
                        echo '400'; // Bad request due to file upload error
                        exit;
                    }
                }
        
                // Update the database if there's data to update
                if (!empty($data)) {
                    $whereClause = array('id' => $edit_id);
        
                    if ($db->updateData('course', $data, $whereClause)) {
                        echo '201'; // Success
                    } else {
                        echo '500'; // Internal Server Error
                    }
                } else {
                    echo '400'; // No data to update
                }
        
            } else {
                echo '400'; // Bad request, no data received
            }
        }
        else if($mode == "Delete") {
            // Adding
            if (isset($_POST["courseName"])) {
                $edit_id = $_POST['edit_id'];
        
                $data = array(
                    'status' => '1'
                );
        
                $whereClause = array('id' => $edit_id);
    
                if ($db->updateData('course', $data, $whereClause)) {
                    echo '202'; // Success
                } else {
                    echo '500'; // Internal Server Error
                }
        
            } else {
                echo '400'; // Bad request, no data received
            }
        }
    }
        
}