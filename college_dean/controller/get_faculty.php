<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();

$subject_id = $_POST['subject_id'];
$section_id = $_POST['section_id'];
$schoolyear = $_POST['schoolyear'];
list($semester, $academicYear) = explode(" - ", $schoolyear);

                        //GET ALL FACULTY THAT HANDLE THE SUBJECTS
                    $where = [
                        "subject_id=".$subject_id,
                        "sem="."'".$semester."'",
                        "sy="."'".$academicYear."'",
                    ];
                        $faculty_rows = $db->getAllRowsFromTableWhere("faculty_subject",$where);

                        if(count($faculty_rows)>0)
                        {
                        $counter =0;
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
                                <a href="facultymembers-info.php?i='.$faculty_id.'" data-id="'.$faculty_id.'" class="bg-orange  text-center px-5 py-2 text-orange rounded-full cursor-pointer hover:opacity-75">
                                            View
                                        </a>
                                '; 


                                $addClass = '';
                                if($counter==0)
                                {
                                    $addClass = 'active-outline';
                                }
                                echo 
                                '
                                    <div class="card '.$addClass.' cursor-pointer hover:bg-red-50  mt- md:mt-0 my-3 bg-white  shadow-md rounded-lg px-3 py-3" data-faculty-id="'.$faculty_id.'">
                                      <div class="grid   gap-x-3 place-items-end grid-flow-col-dense grid-cols-3 items-end">
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
                             $counter+=1;
                            }
                        }else{
                            echo 
                                '
                                    <div class="card   mt- md:mt-0 my-3 bg-white  shadow-md rounded-lg px-3 py-3" >
                                      <div class="grid gap-x-3 place-items-end grid-flow-col-dense grid-cols-3 items-end">
                                    <div class="container ">
                                        <p class="whitespace-nowrap">No Data</p>
                                       
                                    </div>
                                    </div>
                                </div>';
                        }

                        ?>