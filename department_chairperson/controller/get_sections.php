<?php 
//GET ALL FACULTY THAT HANDLE THE SUBJECTS
require '../../conn/conn.php';
$db = new DatabaseHandler();
    foreach ($sectionRows as $row) {
        $section_name = $row['name'];
        $section_id = $row['section_id'];
        $faculty_id = $row['faculty_id'];
        $sy_section = $row['sy'];
        $sem_section = $row['sem'];
        $val = $sem_section.' - '.$sy_section;

        echo '<option data-sy="'.$val.'" data-faculty_id="'.$faculty_id.'" value="'.$section_id.'">'.ucwords($section_name).'</option>';
    }
    ?>