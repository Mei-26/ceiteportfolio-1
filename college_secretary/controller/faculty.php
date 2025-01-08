<?php 
require '../../conn/conn.php';
require '../../mailer/mail_function.php';
$db = new DatabaseHandler();
if(isset($_POST['mode'],$_SESSION['id'],$_SESSION['college_id']) && $_SESSION['college_id']!="")
{
    $mode = $_POST['mode'];
    $college_id = $_SESSION['college_id'];

    if($mode =="Add")
    {
        //Adding
        if (isset($_POST["facultyName"])) {
            // Retrieve form data

            
            $facultyEmploymentID = $_POST['facultyEmploymentID'];
            $facultyEmail = $_POST['facultyEmail'];
            $facultyPassword = $_POST['facultyPassword'];
            $facultyName = $_POST['facultyName'];
            $facultyAddress = $_POST['facultyAddress'];
            $facultyPosition = $_POST['facultyPosition'];
            $facultySpecialization = $_POST['facultySpecialization'];
            $facultyContacts = $_POST['facultyContacts'];
            $facultyBirthday = $_POST['facultyBirthday'];
            $facultyType = $_POST['facultyType'];
            
            $facultyDepartment = $_POST['facultyDepartment'];

            
            
            // Handle file upload
            $image = $_FILES['facultyImage'];

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
                    $uploadDir = '../../uploads/faculty/';
                    
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
                            'employment_id' => $facultyEmploymentID,
                            'email' => $facultyEmail,
                            'password' => password_hash($facultyPassword,PASSWORD_DEFAULT),
                            'role' => $facultyPosition,
                            'type' => $facultyType
                        );



                        // Insert data into the database (using your existing database connection)
                        if ($db->insertData('users', $data)) {
                            $user_id =  $db->getLastInsertId();

                            $data_details = array(
                                'name' => $facultyName,
                                'user_id' => $user_id,
                                'address' => $facultyAddress,
                                'birthday' => $facultyBirthday,
                                'phone' => $facultyContacts,
                                'specialization' => $facultySpecialization,
                                'image' => $uniqueFileName,
                                 );

                                 
                            $college_user_added_details = array(
                                'user_id' => $user_id,
                                'college_id' => $college_id,
                                 );

                            if ($db->insertData('user_details', $data_details) 
                                && $db->insertData('college_user_added', $college_user_added_details) 
                                ) {
                                    $where_college = 
                                    [
                                        'college_id' => $college_id
                                    ];

                                    if($facultyPosition == 'college_secretary')
                                    {
                                        // DISABLE PAST SECRETARY
                                        $past_secretary_id = $db->getIdByColumnValue('college_officers','college_id',$college_id,'college_secretary_id');
                                        $db->updateData('users',['status'=>1],['id'=>$past_secretary_id]);
                                        // UPDATE COLLEGE 
                                        $college_secretary = 
                                        [
                                            'college_secretary_id' => $user_id
                                        ];
                                        $db->updateData('college_officers',$college_secretary,$where_college);
                                    }
                                    if($facultyPosition == 'college_dean' )
                                    {

                                        // DISABLE PAST DEAN
                                        $past_dean_id = $db->getIdByColumnValue('college_officers','college_id',$college_id,'college_dean_id');
                                        $db->updateData('users',['status'=>1],['id'=>$past_dean_id]);
                                   
                                        
                                        $college_dean = 
                                        [
                                            'college_dean_id' => $user_id
                                        ];

                                        $db->updateData('college_officers',$college_dean,$where_college);
                                   
                                    }


                                $where = [
                                    'id' => $facultyDepartment
                                ];

                                if(SendEmailTemporaryPassword($facultyEmail,$facultyPassword))
                                {
                                    if( $facultyPosition=="department_chairperson")
                                    {
                                        $data = [
                                            'department_dean' => $user_id,     
                                        ];
    
                                    
                                        if($db->updateData('department_details',$data,$where))
                                        {
                                            echo 200;
                                        }
    
    
                                    }else if($facultyPosition=="department_secretary")
                                    {
                                        $data = [
                                            'department_secretary' => $user_id,     
                                        ];
    
    
                                        if($db->updateData('department_details',$data,$where))
                                        {
                                            echo 200;
                                        }
    
                                    }
                                    else 
                                    {
                                        echo '200';
                                    }
                                }else{
                                    echo '503'; // Database insertion error
                                }

                               
                            }
                            else{
                                echo '501'; // Database insertion error
                            }
                        } else {
                            echo '501'; // Database insertion error
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