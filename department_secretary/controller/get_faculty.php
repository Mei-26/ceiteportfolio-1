<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
if (
    isset($_POST['subject_id'], $_POST['section_id'], $_POST['schoolyear'], $_SESSION['id']) &&
    !empty($_POST['subject_id']) && 
    !empty($_POST['section_id']) && !empty($_POST['schoolyear']) && 
    !empty($_SESSION['id'])
) {
    $subject_id = $_POST['subject_id'];
    $section_id = $_POST['section_id'];
    $schoolyear = $_POST['schoolyear'];

    list($semester, $academicYear) = explode(" - ", $schoolyear);
}
else{
    exit;
}
//GET ALL FACULTY THAT HANDLE THE SUBJECTS
$faculty_rows = $db->getAllRowsFromTableWhere("faculty_subject",[
    "subject_id =".'"'.$subject_id.'"',
    "sy =".'"'.$academicYear.'"',
    "sem =".'"'.$semester.'"'
]);

if(count($faculty_rows) > 0)
{
    foreach ($faculty_rows as $faculty_row) {

       $faculty_id = $faculty_row['faculty_id'];
                            $new_role =  $db->getIdByColumnValue('users','id',$faculty_id,'role');
                            if($new_role!="faculty")
                            {
                                continue;
                            }

        $faculty_name = ucwords($db->getIdByColumnValue("user_details",'user_id',$faculty_id,'name'));
        $faculty_image = ucwords($db->getIdByColumnValue("user_details",'user_id',$faculty_id,'image'));
        $position = 'Faculty';
        $specialization = ucwords($db->getIdByColumnValue("user_details",'user_id',$faculty_id,'specialization'));
        $contacts = ucwords($db->getIdByColumnValue("user_details",'user_id',$faculty_id,'phone'));


        $image = "../uploads/faculty/".$faculty_image;


        $buttonFacultyAction = //isset($_SESSION['dashboard']) ? 
        '
        <p data-id="'.$faculty_id.'" class="bg-orange removeFacultyBtn text-center px-5 py-2 text-orange rounded-full cursor-pointer hover:opacity-75">
                    Remove
                </p>
        '; 

        echo 
        '
            <div class="card cursor-pointer hover:bg-red-50  mt- md:mt-0 my-3 bg-white  shadow-md rounded-lg px-3 py-3" data-faculty-id="'.$faculty_id.'">
              <div class="grid gap-x-3 place-items-end grid-flow-col-dense grid-cols-3 items-end">
            <img style="height:100px" src="'.$image.'" class="object-cover w-full rounded-lg ">
            <div class="container ">
                <p class="whitespace-nowrap">'.$faculty_name.'</p>
                <p>'.$position.'</p>
                <p class="whitespace-nowrap">'.$specialization.'</p>
                <p>'.$contacts.'</p>
            </div>
                '.$buttonFacultyAction.'
            </div>
        </div>
        ';
    }
}else{
    echo '<p>No data.</p>';
}

?>
