<?php 
require '../conn/conn.php';
$db = new DatabaseHandler();
if($db->loginUser($_POST['employment_id'],$_POST['password'])){

    switch ($_SESSION['role']) {
        case 'college_secretary':
            $_SESSION['college_id'] = $db->getIdByColumnValue('college_officers','college_secretary_id',$_SESSION['id'],'college_id');
            break;

        case 'college_dean':
            $_SESSION['college_id'] = $db->getIdByColumnValue('college_officers','college_dean_id',$_SESSION['id'],'college_id');
            break;

        case 'department_chairperson':
            $college_id = $db->getIdByColumnValue('department_details','department_dean',$_SESSION['id'],'depatment_college');

            $from_added = $db->getIdByColumnValue('college_user_added','user_id',$_SESSION['id'],'college_id');
            
            $college_id = $college_id !="" ? $college_id : $from_added;

            $_SESSION['college_id']  = $college_id;

            break;

        case 'department_secretary':
            // $_SESSION['college_id'] = $db->getIdByColumnValue('department_details','department_secretary',$_SESSION['id'],'depatment_college');

            $college_id = $db->getIdByColumnValue('department_details','department_secretary',$_SESSION['id'],'depatment_college');

            $from_added = $db->getIdByColumnValue('college_user_added','user_id',$_SESSION['id'],'college_id');
            
           $college_id = $college_id !="" ? $college_id : $from_added;

            $_SESSION['college_id']  = $college_id;
            // 
            break;

        case 'faculty':
            $department_id = $db->getIdByColumnValue('department_faculty','faculty_id',$_SESSION['id'],'department_id');

            $_SESSION['college_id'] = $db->getIdByColumnValue('department_details','id',$department_id,'depatment_college');
            break;

            
        default:
            # code...
            break;
    }
    echo '200';
}else{
    echo '404';
}
