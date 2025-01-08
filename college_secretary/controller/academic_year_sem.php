<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
if(isset($_POST['mode']))
{
    $mode = $_POST['mode'];

    if(isset($_SESSION['id']))
    {
         $college_id = $db->getIdByColumnValue("college_officers","college_secretary_id",$_SESSION['id'],"college_id");

        if($mode =="Update")
        {
            //Adding
            if (isset($_POST["updateAcademicYear"])) {

                // Retrieve form data
                $updateAcademicYear = $_POST['updateAcademicYear'];
                $updateSemester = $_POST['updateSemester'];
                // Prepare data for insertion into the database
                $data = array(
                    'current_sem' => $updateSemester,
                    'current_year' => $updateAcademicYear,
                    'current_status' => 'current',
                    'college_id' => $college_id
                );

                $history_data = array(
                    'current_status' => 'history',
                );

                $whereClause = array(
                    'college_id' => $college_id
                );

                    $db->updateData('current_year_sem', $history_data,$whereClause);

                    if ($db->insertData('current_year_sem', $data)) {
                            echo '200'; // Success
                        } else {
                            echo '500'; // Database insertion error
                        }
                }
        }
    }
    
}

