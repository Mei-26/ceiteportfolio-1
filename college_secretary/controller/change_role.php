<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();

if (isset($_POST['faculty_id'])) {
    $faculty_id = $_POST['faculty_id'];
    $role_selected = $_POST['role_selected'];
    $past_role = $_POST['past_role'];
    $department_id = $_POST['department_id'];
    $college_id = $_SESSION['college_id'];

    // Update department details if role is not faculty
    if ($role_selected != "faculty") {
        $data = [];

        if ($role_selected == "college_dean") {
            $data['college_dean_id'] = $faculty_id;

            // GET THE PAST ROLE ID THEN SET TO FACULTY 

            $past_selected_role_id = $db->getIdByColumnValue('college_officers','college_id',$college_id,'college_dean_id');

            // UPDATE IT FIRST TO FACULTY

              $db->updateData('users', ['role' => 'faculty'], ['id' => $past_selected_role_id]);
            //   THEN ADD TO LIST OF FACULTY
              $db->insertData('department_faculty', ['department_id' => $department_id , 'faculty_id' => $past_selected_role_id]);



        }else if ($role_selected == "college_secretary") {
            $data['college_secretary_id'] = $faculty_id;

            // GET THE PAST ROLE ID THEN SET TO FACULTY 

            $past_selected_role_id = $db->getIdByColumnValue('college_officers','college_id',$college_id,'college_secretary_id');
            // UPDATE IT FIRST TO FACULTY

              $db->updateData('users', ['role' => 'faculty'], ['id' => $past_selected_role_id]);
            //   THEN ADD TO LIST OF FACULTY
              $db->insertData('department_faculty', ['department_id' => $department_id , 'faculty_id' => $past_selected_role_id]);



        } elseif ($role_selected == "department_secretary") {
            $data['department_secretary'] = $faculty_id;

            // GET THE PAST ROLE ID THEN SET TO FACULTY 

            $past_selected_role_id = $db->getIdByColumnValue('department_details','college_id',$department_id,'department_secretary');

            // UPDATE IT FIRST TO FACULTY

              $db->updateData('users', ['role' => 'faculty'], ['id' => $past_selected_role_id]);
            //   THEN ADD TO LIST OF FACULTY
              $db->insertData('department_faculty', ['department_id' => $department_id , 'faculty_id' => $past_selected_role_id]);



        } elseif ($role_selected == "department_chairperson") {
            $data['department_dean'] = $faculty_id;

            // GET THE PAST ROLE ID THEN SET TO FACULTY 
            $past_selected_role_id = $db->getIdByColumnValue('department_details','id',$department_id,'department_dean');
            // UPDATE IT FIRST TO FACULTY
              $db->updateData('users', ['role' => 'faculty'], ['id' => $past_selected_role_id]);
            //   THEN ADD TO LIST OF FACULTY
              $db->insertData('department_faculty', ['department_id' => $department_id , 'faculty_id' => $past_selected_role_id]);
       
            }

        if (!empty($data)) {
            if($role_selected == 'department_chairperson' || $role_selected == 'department_secretary')
            {
                // echo 1;
                $db->updateData('department_details', $data, ['id' => $department_id]);
            }
            if($role_selected == 'college_dean' || $role_selected == 'college_secretary')
            {
                // echo 2;
                $db->updateData('college_officers', $data, ['college_id' => $college_id]);
            }
        }
    }
    if($role_selected == 'faculty')
    {
        $db->insertData('department_faculty', ['department_id' => $department_id , 'faculty_id' => $faculty_id]);

    }

    // Update user role
    $db->updateData('users', ['role' => $role_selected], ['id' => $faculty_id]);

    // Reset past role in department details if applicable
    if ($past_role != "faculty") {
        $data = [];

        if ($past_role == "secretary") {
            $data['department_secretary'] = 0;
        } elseif ($past_role == "dean") {
            $data['department_dean'] = 0;
        }elseif ($past_role == "college_secretary") {
            $data['college_secretary_id'] = 0;
        }elseif ($past_role == "college_dean") {
            $data['college_dean_id'] = 0;
        }

        if (!empty($data)) {
            if($past_role == 'dean' || $past_role == 'secretary')
            {
                // echo 3;
                $db->updateData('department_details', $data, ['id' => $department_id]);
            }
            if($past_role == 'college_dean' || $past_role == 'college_secretary')
            {
                // echo 4;
                $db->updateData('college_officers', $data, ['college_id' => $college_id]);
            }
        }
    }
    if ($past_role == 'faculty')
    {
        // echo 5;
        $db->hardDeleteFacultyList($faculty_id,$department_id);
    }
    // Send success response
    echo 200;
} else {
    // Send error response if faculty_id is not set
    echo 400;
}
?>
