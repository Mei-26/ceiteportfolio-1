<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
// echo $_POST['upload_id'];

// $subject_rows = $db->getAllRowsFromTable("subject");

if(isset($_POST['sy_id'],$_SESSION['id']))
{
    $depatment_college = $_SESSION['college_id']; 
    $upload_id = 14;//$_POST['upload_id'];
    $schoolyear = $_POST['sy_id'];
    $faculty_id = $_SESSION['id'];
    list($semester, $academicYear) = explode(" - ", $schoolyear);

    $my_department_id = $db->getIdByColumnValue("department_faculty","faculty_id",$_SESSION['id'],"department_id");
    $count = 0;
    
    $subject_rows = $db->getSectionsWhereCollgeFaculty($depatment_college,$semester,$academicYear,$faculty_id);


    foreach ($subject_rows as $subject_row) {
        
        $subject_course_id = ucwords($subject_row['course_id']);
        $subject_college_id = $db->getIdByColumnValue("course","id",$subject_course_id,"college_id");
        $subject_department_id = $db->getIdByColumnValue("course","id",$subject_course_id,"department_id");

        if($depatment_college!=$subject_college_id || $my_department_id !=$subject_department_id){
            continue;
        }
        $count++;

        $subject_id = ucwords($subject_row['id']);
        $subject_name = ucwords($subject_row['name']);
        $subject_code = strtoupper($subject_row['code']);
        $conditions1 = [
            "subject_id" => $subject_id,
            "sem" => $semester,
            "sy" => $academicYear,
            "faculty_id" =>$faculty_id
        ];
         $sectionCount = $db->getCountByConditions("faculty_subject_section",$conditions1);
    
         $condition_section = [
            "subject_id=". $subject_id,
            "sem='". $semester."'",
            "sy='". $academicYear."'",
            "faculty_id=". $faculty_id
        ];
         $section_rows = $db->getAllRowsFromTableWhere("faculty_subject_section",$condition_section);

         $section_checker_counter = 0;
         foreach ($section_rows as $section_row) {
            $section_id_to_check = $section_row['section_id'];
            $for_uploads_rows = $db->getAllRowsFromTable('for_uploads');
            $upload_checker = 0;
            // echo '<br>subject_id.'.$subject_id.'section_id ='. $section_row['section_id'];
            
             foreach ($for_uploads_rows as $for_uploads) {
                $upload_id_checker = $for_uploads['id'];
                $conditions2 = [
                    "subject_id" => $subject_id,
                    "upload_id" => $upload_id_checker,
                    "semester" => $semester,
                    "section_id" => $section_id_to_check,
                    "year" => $academicYear,
                    "faculty_id" =>$faculty_id
                ];
            
                $uploadedCount = $db->getCountByConditions("faculty_uploads",$conditions2);
                //  echo 'uploadedCount = ' . $uploadedCount;
                if($uploadedCount==0)
                {
                 $upload_checker += 1;
                 break;
                }
    
             }
             echo 'upload_checker = ' . $upload_checker;
             if($upload_checker!=0)
             {
                $section_checker_counter+=1;
                break;

             }
        }
        
      
        //CHECKER FOR ICONS
        // $icon = $sectionCount == $uploadedCount ? '
        // <i class="material-icons text-white bg-green-400 rounded-full p-1">task_alt</i>
        // ' : '
        // <i class="material-icons text-white bg-red-400 rounded-full p-1">error</i>
        // ';
        $icon = $section_checker_counter == 0 ? '
        <i class="material-icons text-white bg-green-400 rounded-full p-1">task_alt</i>
        ' : '
        <i class="material-icons text-white bg-red-400 rounded-full p-1">error</i>
        ';

        echo '
        <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
            <td class="p-3 block table-cell">
                <a class="syllabusInfo" href="documents-research.php?s='.$subject_id.'&uid='.$upload_id.'&sem='.$semester.'&sy='.$academicYear.'">
                    <div class="flex flex-row text-justify items-center">
                        <i class="material-icons text-orange text-5xl mr-3">folder</i>
                        <div class="flex flex-col">
                            <p class="font-semibold text-gray-800">'.$subject_code.'</p>
                            <p class="text-gray-500">'.$subject_name.'</p>
                        </div>
                    </div>
                </a>
            </td>
            <td class="p-3 block table-cell">
                '.$icon.'
            </td>
        </tr>
    
    
        ';
    }

    if($count==0)
    {
    echo '
    <tr class="block text-center table-row bg-white hover:bg-orange transition duration-200 ease-in">
        <td colspan=2>No Data</td>
    </tr>
    '; 
    }
}
?>
