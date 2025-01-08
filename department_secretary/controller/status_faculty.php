<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
if(isset($_POST['faculty_id'],$_POST['status'],$_SESSION['id'],$_SESSION['college_id']) && $_SESSION['college_id']!="")
{
    $status = $_POST['status'];
    $faculty_id = $_POST['faculty_id'];

    if($status == '1' || $status == '0')
     // Prepare data for update
        {
            $data = array(
                'status' => $status,
            );
        }else{
            $data = array(
                'type' => $status,
            );
        }
        


    $whereClause = array(
        'id' => $faculty_id,
        'role' => 'faculty'
    );

    // Update the password in the database
    if ($db->updateData('users', $data, $whereClause)) {
        echo '201';
    } else {
        $response['message'] = 'Failed to update the password. Please try again.';
    }
    
}