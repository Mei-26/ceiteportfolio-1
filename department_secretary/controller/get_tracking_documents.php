<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
// echo $_POST['upload_id'];

// $subject_rows = $db->getAllRowsFromTable("subject");
if(isset($_POST['upload_id'],$_POST['sy_id'],$_SESSION['id']))
{
    $depatment_college = $_SESSION['college_id']; 
    $upload_id = $_POST['upload_id'];
    $schoolyear = $_POST['sy_id'];
    if($upload_id == "" || $schoolyear == "")
    {
        echo '
        <tr class="block text-center table-row bg-white hover:bg-orange transition duration-200 ease-in">
            <td colspan=2>No Data</td>
        </tr>
    '; 
    exit;
    }
    $my_department_id = $db->getIdByColumnValue("department_details","department_secretary",$_SESSION['id'],"id");

    list($semester, $academicYear) = explode(" - ", $schoolyear);

    $subject_rows = $db->getSectionsWhereCollge($depatment_college,$semester,$academicYear);

    $count = 0;
    foreach ($subject_rows as $subject_row) {
        
        $subject_course_id = ucwords($subject_row['course_id']);
        $subject_college_id = $db->getIdByColumnValue("course","id",$subject_course_id,"college_id");
        $subject_department_id = $db->getIdByColumnValue("course","id",$subject_course_id,"department_id");

        if($depatment_college!=$subject_college_id || $my_department_id !=$subject_department_id){
            continue;
        }
        $count++;
        echo 111111111111;

        $subject_id = ucwords($subject_row['id']);
        $subject_name = ucwords($subject_row['name']);
        $subject_code = strtoupper($subject_row['code']);
        $conditions1 = [
                "subject_id" => $subject_id,
                "sy" => $academicYear,
                "sem" => $semester,
            ];
        //  $sectionCount = $db->getCountByConditions("faculty_subject_section",$conditions1);
        $condition_section = [
            "subject_id=".  $subject_id,
            "sy='".$academicYear."'",
            "sem='".$semester."'",
        ];
        $section_rows = $db->getAllRowsFromTableWhere('faculty_subject_section',$condition_section);
      
        $upload_checker = 0;
        foreach ($section_rows as $section_row) {

            $section_id = $section_row['section_id'];

            $conditions2 = [
                "section_id" => $section_id,
                "subject_id" => $subject_id,
                "upload_id" => $upload_id,
                "semester" => $semester,
                "year" => $academicYear,
            ];
             $uploadedCount = $db->getCountByConditions("faculty_uploads",$conditions2);
            if($uploadedCount==0)
            {
                $upload_checker+=1;
                break;
            }

        }

       


  
    
        
 
        //CHECKER FOR ICONS

        $icon = $upload_checker == 0 ? '
        <i class="material-icons text-white bg-green-400 rounded-full p-1">task_alt</i>
        ' : '
        <i class="material-icons text-white bg-red-400 rounded-full p-1">error</i>
        ';


        // $icon = $sectionCount == $uploadedCount ? '
        // <i class="material-icons text-white bg-green-400 rounded-full p-1">task_alt</i>
        // ' : '
        // <i class="material-icons text-white bg-red-400 rounded-full p-1">error</i>
        // ';


        echo '
        <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
            <td class="p-3 block table-cell">
                <a class="syllabusInfo" style="font-size:11px" href="syllabustracking-info.php?s='.$subject_id.'&uid='.$upload_id.'&sem='.$semester.'&sy='.$academicYear.'">
                    <div class="flex flex-row text-left items-center">
                        <i class="material-icons text-orange text-5xl mr-3">folder</i>
                        <div class="flex flex-col">
                            <p style="font-size:11px" class="font-semibold text-gray-800">'.$subject_code.'</p>
                            <p style="font-size:11px" class="text-gray-500">'.$subject_name.'</p>
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
