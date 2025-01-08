<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();

if(isset($_POST['mode'],$_POST['id'],$_SESSION['college_id']))
{
    $mode = $_POST['mode'];
    $college_id = $_SESSION['college_id'];

        if($mode =="Delete")
        {
            //Adding
                $id = $_POST['id'];

                $data = array(
                    'status' => 1,
                );

                $whereClause = array(
                        'id' => $id,
                        'depatment_college' => $college_id
                    );

                    if($db->updateData('department_details',$data,$whereClause)){
                        echo '202';
                    }else{
                        echo '500';
                    }
               
            } else {
                echo '400'; // Bad request, no data received
            }
}