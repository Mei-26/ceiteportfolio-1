<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
$user_id = $_SESSION['id'];

$department_id = $db->getIdByColumnValue("department_faculty", "faculty_id", $user_id, 'department_id');
$rows = $db->getAllSectionsByDepartment($department_id);

$where = array(
    'college_id'=>$_SESSION['college_id'],
    'current_status'=>'current',
  );
  
   $currentSem = $db->getIdByColumnValueWhere("current_year_sem",$where, "current_sem");
   $currentYear = $db->getIdByColumnValueWhere("current_year_sem",$where,"current_year");


$selected_sections = [];  // Initialize an empty array to store selected section IDs
if(isset($_POST['subject_id']))
{
    $subject_id = $_POST['subject_id'];
    $faculty_subject_section_rows = $db->getAllRowsFromTableWhere("faculty_subject_section",['faculty_id='.$user_id,'subject_id='.$subject_id,'sy='."'$currentYear'",'sem='."'$currentSem'"]);

    // Extract section_ids from the result and store them in $selected_sections array
    $selected_sections = array_column($faculty_subject_section_rows, 'section_id');
}

if(count($rows)>0)
{
    foreach ($rows as $row) {
        $is_checked = in_array($row['id'], $selected_sections) ? 'checked' : '';  // Check if the section_id is in $selected_sections
    
        echo '
        <div class="flex items-center space-x-3">
        <input
            type="checkbox"
            name="section_id[]"
            value="' . htmlspecialchars($row['id']) . '"
            class="form-checkbox h-5 w-5 text-green-600 focus:ring-green-500"
            ' . $is_checked . '  
        />
        <label class="text-gray-700 cursor-pointer">
            ' . ucwords(htmlspecialchars($row['name'])) . '
        </label>
        </div>';
    }
}else{
    echo '<p>No data</p>';
}
?>
