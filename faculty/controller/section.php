<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
// var_dump($_POST);
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
      
    if(isset($_SESSION['id'],$_POST['section_id']))
    {
      $user_id = $_SESSION['id'];
        if ($mode == "Add") {
            // Adding
            if (isset($_POST["section_id"]) && !empty($_POST["section_id"])) {
                // Retrieve form data
                $subject_id = $_POST['subject_id'];
                $section_ids = $_POST['section_id'];
        
                foreach ($section_ids as $key => $section_id) {
                    $data = array(
                        'faculty_id' => $user_id,
                        'section_id' => $section_id, 
                        'subject_id' => $subject_id, 
                        'sy' => $currentYear, 
                        'sem' => $currentSem,
                    );
                    $result = $db->insertData('faculty_subject_section', $data);
        
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
        }else if ($mode == "Update") {
            // Update
            if (isset($_POST["section_id"]) && !empty($_POST["section_id"])) {
                // Retrieve form data
                $subject_id = $_POST['subject_id'];
                $section_ids = $_POST['section_id'];

                $db->hardDeleteFacultySubject($user_id,$subject_id,$currentYear,$currentSem);
        
                foreach ($section_ids as $key => $section_id) {
                    $data = array(
                        'faculty_id' => $user_id,
                        'section_id' => $section_id, 
                        'subject_id' => $subject_id, 
                        'sy' => $currentYear, 
                        'sem' => $currentSem, 
                    );
                    $result = $db->insertData('faculty_subject_section', $data);
        
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