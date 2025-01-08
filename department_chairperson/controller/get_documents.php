<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();

if (
    isset($_POST['subject_id'], $_POST['faculty_id'], $_POST['section_id'], $_POST['schoolyear'], $_SESSION['id']) &&
    !empty($_POST['subject_id']) && !empty($_POST['faculty_id']) && 
    !empty($_POST['section_id']) && !empty($_POST['schoolyear']) && 
    !empty($_SESSION['id'])
) {
    $subject_id = $_POST['subject_id'];
    $faculty_id = $_POST['faculty_id'];
    $section_id = $_POST['section_id'];
    $schoolyear = $_POST['schoolyear'];

    list($semester, $academicYear) = explode(" - ", $schoolyear);

    $where = [
        "section_id=".$section_id,
        "subject_id=".$subject_id,
        "faculty_id=".$faculty_id,
        "semester="."'".$semester."'",
        "year="."'".$academicYear."'",
        ];
    $documentRows = $db->getAllRowsFromTableWhere("faculty_uploads",$where);

    if(count($documentRows) > 0)
    {
        foreach ($documentRows as $row) {
            $upload_id = $row['upload_id'];
            $file = $row['file'];
            $fileSource = '../uploads/files/'.$file;

            $upload_name = $db->getIdByColumnValue("for_uploads", "id", $upload_id, "name");

            echo '
            <div class="card mt- md:mt-0 my-3 bg-white shadow-md rounded-lg px-3 py-3">
                <div class="grid gap-x-3 grid-flow-col-dense grid-cols-3 items-center">
                <img style="height:70px" src="https://www.iconpacks.net/icons/2/free-pdf-file-icon-2614-thumb.png">
                <div class="col-span-3 text-center">
                    <p class="whitespace-nowrap">'.$upload_name.'</p>
                </div>
                     <a href="'.$fileSource.'" class="bg-orange text-center  text-orange px-4 py-2 rounded-full shadow-lg 
                    transform transition-transform duration-200 
                    hover:scale-105 hover:shadow-xl hover:bg-orange-600" target="_blank">
                        Open
                    </a>
                </div>
            </div>
            ';
        }
    }else{
        echo '<p>No uploaded files.</p>';
    }
} 

?>