<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
// echo '<pre>';
// var_dump($_POST);


if(isset($_POST['section'],$_POST['faculty'],$_SESSION['college_id'],$_POST['subject_id']) && !empty($_POST["subject_id"]) && !empty($_POST["section"])  )
{
    $section = $_POST['section'];
    $faculty = $_POST['faculty'];
    $college_id = $_SESSION['college_id'] ;
    $subject_id = $_POST['subject_id'];
    
    
    $where = array(
        'college_id'=>$college_id,
        'current_status'=>'current',
      );
      
       $currentSem = $db->getIdByColumnValueWhere("current_year_sem",$where, "current_sem");
       $currentYear = $db->getIdByColumnValueWhere("current_year_sem",$where,"current_year");
      
    if(isset($_SESSION['id'],$_POST['subject_id']))
    {
      
            // Adding

                $data = array(
                    'faculty_id' => $faculty,
                    'subject_id' => $subject_id, 
                    'sy' => $currentYear, 
                    'sem' => $currentSem,
                );

                $where = array(
                    'faculty_id'=>$faculty,
                    'subject_id'=>$subject_id,
                    'sy'=>$currentYear,
                    'sem'=>$currentSem,
                  );
                $checker = $db->getIdByColumnValueWhere('faculty_subject',$where,'id');
                
                if($checker=="")
                {
                    $result = $db->insertData('faculty_subject', $data);
                }
                
                  $db->hardDeleteFacultySubject($faculty,$subject_id,$currentYear,$currentSem);

                        
                    foreach ($section as $key => $section_id) {
                        $data = array(
                            'faculty_id' => $faculty,
                            'section_id' => $section_id, 
                            'subject_id' => $subject_id, 
                            'sy' => $currentYear, 
                            'sem' => $currentSem,
                        );
                        $result = $db->insertData('faculty_subject_section', $data);

                        // Check if the insertion was successful
                        if (!$result) {
                            echo '500'; // Database insertion error
                            exit;
                        }
                    }
                    echo '200'; // Success
                
        }else{
            echo '400'; // Bad Request
        }
        
}



    