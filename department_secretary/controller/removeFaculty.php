<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
if(isset($_POST['remove_faculty_id'],$_POST['section_id'],$_POST['subject_id'],$_SESSION['id']));
{
    $faculty_id = $_POST['remove_faculty_id'];
    $subject_id = $_POST['subject_id'];
    $section_id = $_POST['section_id'];

    $data_details = array(
        'status' => 1,
    );

    $whereClause = array(
        'faculty_id' => $faculty_id,
        'subject_id' => $subject_id,
        'section_id' => $section_id,
    );

    if ($db->updateData('faculty_subject_section', $data_details,$whereClause)) {
        echo '202';
    } else {
        echo '500'; // Database insertion error
    }
}