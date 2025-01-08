<?php 
include '../../conn/conn.php';
$db = new DatabaseHandler();

if (isset($_POST['Type'])) {
    $type = $_POST['Type'];

    if ($type == "Add") {
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Address = $_POST['Address'];
        $Birthday = $_POST['Birthday'];
        $Phone = $_POST['Phone'];
        $Position = $_POST['Position'];

        $password = generateRandomPassword();

        $data = array(
            'email' => $Email,            
            'password' => password_hash($password, PASSWORD_DEFAULT),            
            'role' => 'employee',            
        );

        // Attempt to insert user data
        if ($db->insertData("users", $data)) {
            // Try sending the email and store the result

            // Check if the email was sent successfully
                // Get the last inserted ID for users table
                $last_id = $db->getLastInsertId();

                // Prepare data for user_details table
                $data = array(
                    'user_id' => $last_id,
                    'name' => $Name,
                    'address' => $Address,
                    'birthday' => $Birthday,
                    'phone' => $Phone,
                    'position' => $Position,
                );

                // Attempt to insert user details data
                if ($db->insertData("user_details", $data)) {
                    echo "User added successfully!";
                } else {
                    echo "Error adding user details.";
                }
           
        } else {
            echo "Error adding user.";
        }
    }
    else if($type =="Update")
    {
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Address = $_POST['Address'];
        $Birthday = $_POST['Birthday'];
        $Phone = $_POST['Phone'];
        $Position = $_POST['Position'];

         //Edit 
         $id = $_POST["id"];

            $data = array(
                'email' => $Email,
            );
            $password = trim($_POST['changepassword']);
                
            if ($password != "") {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT); 
            }

             $whereClause = array(
                     'id' => $id
                 );
         
     
             if(($db->updateData('users',$data,$whereClause))){
                

                $data_details = array(
                    'name' => $Name,
                    'address' => $Address,
                    'birthday' => $Birthday,
                    'phone' => $Phone,
                    'position' => $Position,
                );

               

                $whereClause = array(
                    'user_id' => $id
                );
                if(($db->updateData('user_details',$data_details,$whereClause))){
                    echo "User Edited successfully!";
                }else{
                    echo "Error Updating details";
                }

             }else{
                echo "User Duplicated Email!";
             }
                   
    }
    else if($type =="Delete")
    {

         //Soft Delete 
         $id = $_POST["id"];

             $data = array(
                 'status' =>1,
             );
             $whereClause = array(
                     'id' => $id
                 );
         
     
             if(($db->updateData('users',$data,$whereClause))){
                echo "User Deleted successfully!";
             }else{
                echo "User Not Deleted!";
             }
    }else if($type =="Restore")
    {

         //Soft Delete 
         $id = $_POST["id"];

             $data = array(
                 'status' =>0,
             );
             $whereClause = array(
                     'id' => $id
                 );
         
     
             if(($db->updateData('users',$data,$whereClause))){
                echo "User Restored successfully!";
             }else{
                echo "User Not Restored!";
             }
    }
}

function generateRandomPassword($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+';
    $charactersLength = strlen($characters);
    $randomPassword = '';

    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomPassword;
}

