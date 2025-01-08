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
                );

                $whereClause = array(
                    'college_id' => $college_id
                );

                // Insert or Add
                if( $db->getIdByColumnValue("current_year_sem","college_id",$college_id,"college_id")==""){
                    // Insert data into the database (using your existing database connection)
                    echo $db->getIdByColumnValue("current_year_sem","college_id",$college_id,"college_id");
                    $data['college_id'] = $college_id;

                    if ($db->insertData('current_year_sem', $data)) {
                            echo '200'; // Success
                        } else {
                            echo '500'; // Database insertion error
                        }
                }else{
                    // Update data into the database (using your existing database connection)
                    if ($db->updateData('current_year_sem', $data,$whereClause)) {
                        echo '201'; // Success
                    } else {
                        echo '500'; // Database insertion error
                    }
                }
            } else {
                echo '400'; // Bad request, no data received
            }
        }
    }
    
}

