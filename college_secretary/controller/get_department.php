<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
$my_college_id = $_SESSION['college_id'];
$position = $_POST['position'];



if($position =="department_secretary")
{
    $rows = $db->getAllRowsFromTableWhere('department_details',[
        'depatment_college='.'"'.$my_college_id.'"',
        'department_secretary=0',
    ]);
}
if($position =="department_chairperson")
{
    $rows = $db->getAllRowsFromTableWhere('department_details',[
        'depatment_college='.'"'.$my_college_id.'"',
        'department_dean=0',
    ]);
}

foreach ($rows as $row) {
    $department_name = ucwords($row['department_name']);
    $department_id = $row['id'];
    echo '<option value="'.$department_id.'">'.$department_name.'</option>';
  }

?>
