<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
// echo $_POST['upload_id'];


if(isset($_POST['upload_id'],$_POST['sy_id']) && $_POST['sy_id']!="")
{
    $upload_id = 14; //SYLLABUS ACCEPTANCE ID 

    $department_id = $_POST['upload_id'];

    $schoolyear = $_POST['sy_id'];
    list($semester, $academicYear) = explode(" - ", $schoolyear);

    $my_college_id = $_SESSION['college_id'];


    // $subject_rows = $db->getSections();
    $subject_rows = $db->getSectionsWhereCollge2($my_college_id,$semester,$academicYear,$department_id);

    if(count($subject_rows)>0) {
        foreach ($subject_rows as $subject_row) {
            $subject_id = ucwords($subject_row['id']);
            $subject_name = ucwords($subject_row['name']);
            $subject_code = strtoupper($subject_row['code']);
            

          $conditions1 = [
                "subject_id" => $subject_id,
                "sy" => $academicYear,
                "sem" => $semester,
            ];

            $sectionCount = $db->getCountByConditions("faculty_subject_section",$conditions1);
        
            $conditions2 = [
                "subject_id" => $subject_id,
                "upload_id" => $upload_id,
                "year" => $academicYear,
                "semester" => $semester,
            ];

            $uploadedCount = $db->getCountByConditions("faculty_uploads",$conditions2);
        
            //CHECKER FOR ICONS
            $icon = $sectionCount == $uploadedCount ? '
            <i class="material-icons text-white bg-green-400 rounded-full p-1">task_alt</i>
            ' : '
            <i class="material-icons text-white bg-red-400 rounded-full p-1">error</i>
            ';
    
            $max_date = $db->getMaxDate($subject_id,$upload_id,$semester,$academicYear);
    
            if($max_date!="")
            {
                $date = new DateTime($max_date);
                $formatted_date = $date->format('F j, Y / g:i A');
                $date =$formatted_date;
            }else{
                $date ='--/--/----';
            }
      
    
    
            echo '
            <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
                <td class="p-3 block table-cell">
                    <a class="syllabusInfo" href="syllabustracking-info.php?s='.$subject_id.'&uid='.$upload_id.'&sem='.$semester.'&sy='.$academicYear.'">
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
                <td class="p-3 block table-cell">
                    '.$date.'
                </td>
            </tr>
        
        
            ';
        }
    }else {
        echo '
        <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
                <td class="p-3 block table-cell text-center " colspan="4">
                No data.
                </td>
            </tr>
        ';
    }
}else{
    echo '
        <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
                <td class="p-3 block table-cell text-center " colspan="4">
                No data.
                </td>
            </tr>
        ';
}
?>

