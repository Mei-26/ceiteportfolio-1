<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
// var_dump($_POST);
// var_dump($_FILES);
if(isset($_POST['mode'],$_SESSION['college_id']))
{
    $mode = $_POST['mode'];
    $college_id = $_SESSION['college_id'];

    $where = array(
        'college_id'=>$college_id,
        'current_status'=>'current',
      );
      
       $currentSem = $db->getIdByColumnValueWhere("current_year_sem",$where, "current_sem");
       $currentYear = $db->getIdByColumnValueWhere("current_year_sem",$where,"current_year");
      
    if(isset($_SESSION['id'],$_POST['subjects']))
    {
      
        if ($mode == "Add") {
            // Adding
            if (isset($_POST["subjects"]) && !empty($_POST["subjects"])) {
                // Retrieve form data
                $subjects = $_POST['subjects'];
        
                foreach ($subjects as $key => $subject_id) {
                    $data = array(
                        'faculty_id' => $_SESSION['id'],
                        'subject_id' => $subject_id, 
                        'sy' => $currentYear, 
                        'sem' => $currentSem,
                    );
                    $result = $db->insertData('faculty_subject', $data);
        
                    // Check if the insertion was successful
                    if (!$result) {
                        echo '500'; // Database insertion error
                        exit;
                    }
                }
                echo '200'; // Success
            } else {
                echo '400'; // Bad request, no data received
            }
        }
        else if ($mode == "Update") {
            // Adding
            if (isset($_POST["subjects"]) && !empty($_POST["subjects"])) {
                // Retrieve form data
                $subjects = $_POST['subjects'];

                $db->hardDelete($_SESSION['id'],$currentYear,$currentSem);
        
                foreach ($subjects as $key => $subject_id) {
                    $data = array(
                        'faculty_id' => $_SESSION['id'],
                        'subject_id' => $subject_id, 
                        'sy' => $currentYear, 
                        'sem' => $currentSem,
                    );
                    $result = $db->insertData('faculty_subject', $data);
        
                    // Check if the insertion was successful
                    if (!$result) {
                        echo '500'; // Database insertion error
                        exit;
                    }
                }
                echo '201'; // Success
            } else {
                echo '400'; // Bad request, no data received
            }
        }
        
    }
        
}