<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
if(isset($_POST['mode'],$_SESSION['id']));
{
    $mode = $_POST['mode'];

    if($mode =="Add")
    {
        //Adding
        if (isset($_POST["sectionName"])) {
            $user_id = $_SESSION['id'];

            $sectionName = $_POST['sectionName'];
            $sectionYearLevel = $_POST['sectionYearLevel'];
            $department_id = $db->getIdByColumnValue("department_details", "department_secretary", $user_id, 'id');
            $college_id = $db->getIdByColumnValue("department_details", "department_secretary", $user_id, 'depatment_college');
            $current_sem = $db->getIdByColumnValue("current_year_sem","college_id",$college_id,"current_sem");
            $current_year = $db->getIdByColumnValue("current_year_sem","college_id",$college_id,"current_year");
        
            $data_details = array(
                'name' => $sectionName,
                'yearlevel' => $sectionYearLevel,
                'semester' => $current_sem,
                'schoolyear' => $current_year, // Save the filename, not the file array
                'department_id' => $department_id // Save the filename, not the file array
            );

            if ($db->insertData('deparment_section', $data_details)) {
                echo '200';
            } else {
                echo 'Section Name is Already Used'; // Database insertion error
            }


        } else {
            echo '400'; // Bad request, no data received
        }
    }else if($mode =="Update")
    {
        //Update
        if (isset($_POST["sectionName"])) {
            $user_id = $_SESSION['id'];

            $edit_id = $_POST['edit_id'];
            $sectionName = $_POST['sectionName'];
            $sectionYearLevel = $_POST['sectionYearLevel'];

            $department_id = $db->getIdByColumnValue("department_details", "department_secretary", $user_id, 'id');
            $college_id = $db->getIdByColumnValue("department_details", "department_secretary", $user_id, 'depatment_college');
        
            $data_details = array(
                'name' => $sectionName,
                'yearlevel' => $sectionYearLevel,
            );

            $whereClause = array(
                'id' => $edit_id,
                'department_id' => $department_id
            );

            if ($db->updateData('deparment_section', $data_details,$whereClause)) {
                echo '201';
            } else {
                echo 'Section Name is Already Used'; // Database insertion error
            }


        } else {
            echo '400'; // Bad request, no data received
        }
    }else if($mode =="Delete")
    {
        //Delete
        if (isset($_POST["sectionName"])) {
            $user_id = $_SESSION['id'];

            $edit_id = $_POST['edit_id'];
            $sectionName = $_POST['sectionName'];
            $sectionYearLevel = $_POST['sectionYearLevel'];

            $department_id = $db->getIdByColumnValue("department_details", "department_secretary", $user_id, 'id');
            $college_id = $db->getIdByColumnValue("department_details", "department_secretary", $user_id, 'depatment_college');
        
            $data_details = array(
                'status' => 1,
            );

            $whereClause = array(
                'id' => $edit_id,
                'department_id' => $department_id
            );

            if ($db->updateData('deparment_section', $data_details,$whereClause)) {
                echo '202';
            } else {
                echo 'Section Name is Already Used'; // Database insertion error
            }


        } else {
            echo '400'; // Bad request, no data received
        }
    }
}