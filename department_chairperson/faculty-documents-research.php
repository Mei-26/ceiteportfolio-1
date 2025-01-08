<?php include 'components/header.php'?>
<?php 

$my_college_id = $_SESSION['college_id'] ;
$my_department_id = $db->getIdByColumnValue("department_details" ,"department_secretary",$_SESSION['id'],"id");

$where = array(
    'college_id'=>$my_college_id,
    'current_status'=>'current',
  );
  
$currentSem = $db->getIdByColumnValueWhere("current_year_sem",$where, "current_sem");
$currentYear = $db->getIdByColumnValueWhere("current_year_sem",$where,"current_year");

$icon_done = '<i class="material-icons text-white bg-green-400 rounded-full p-1">task_alt</i>';
$icon_not_done = '<i class="material-icons text-white bg-red-400 rounded-full p-1">error</i>';

$faculty_id = 54;
    if(isset($_GET['s']) && $_GET['s']!="")
    {
      
        $s =  preg_replace('/\D/', '', $_GET['s']);
        $subject_id =  preg_replace('/\D/', '', $_GET['s']);
        if($db->getIdByColumnValue("subject","id",$subject_id,'id')=="")
        {
            echo '
            <script>
                window.location.href="profile.php"
            </script>
            ';
        }else{
            if($db->getIdByColumnValue("faculty_subject","subject_id",$subject_id,'id')=="")
            {
                echo '
                <script>
                    window.location.href="profile.php"
                </script>
                ';
            }else
            {
                $courseName = htmlspecialchars(ucwords($db->getIdByColumnValue("subject","id",$subject_id,'name')));
                $semester=$currentSem;
                $sy=$currentYear;
                $faculty_id = preg_replace('/\D/', '', $_GET['faculty_id']);
                $section_id = preg_replace('/\D/', '', $_GET['section_id']);
                $sectionName = htmlspecialchars(ucwords($db->getIdByColumnValue("deparment_section","id",$section_id,'name')));


            }
                
        }
    }else{
        echo '
        <script>
            window.location.href="profile.php"
        </script>
        ';
    }

    $where = array(
        'college_id'=>$_SESSION['college_id'],
        'current_status'=>'current',
      );
      
       $current_sem_system = $db->getIdByColumnValueWhere("current_year_sem",$where, "current_sem");
       $current_year_system = $db->getIdByColumnValueWhere("current_year_sem",$where,"current_year");

      


    $getSectionForDocuments_rows = $db->getSectionForDocuments($subject_id,$faculty_id);
?>
    <style>
         .active-outline {
            outline: 1px solid #FFA500; /* Orange color */
            max-width: 100%;
            background-color: #FFFFFF; /* White */
            border-radius: 0.5rem; /* Rounded corners */
            border: 1px solid #E5E7EB; /* Border */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06); /* Shadow */
        }
  
    </style>
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                

                    <div class="container flex text-orange mb-3">
                        <a href="index.php" class="mr-3">Dashboard</a> 
                        <p class="mr-3">></p>
                        <p class="mr-3"><?=$courseName;?> </p>

                   </div>

                <div class="container flex items-center mb-6">
                <h1 class="text-3xl text-black mr-3"><?=$courseName;?> ><?=$sectionName;?> </h1>
                    <!-- <select id="documentFilter" class="px-3 py-2 text-base rounded-lg bg-orange text-orange">
                        <?php 
                        if(count($getSectionForDocuments_rows)>0)
                        {
                            foreach ($getSectionForDocuments_rows as $row) {
                                echo '<option value="'.$row['section_id'].'">'.$row['name'].'</option>';
                            }
                        }else{
                            echo '<option value="">Section not added</option>';
                        }
                        ?>
                        
                    </select> -->
                </div>


                    <div class="">
                    <div class="container flex mb-4 items-center">
                        <h1 class="text-base text-gray-500 font-bold mr-3">DOCUMENTS</h1>
                        
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-1 gap-x-10">
                        

                    <div class="card col-span-2 mt- md:mt-0 my-3 bg-white shadow-md rounded-lg px-3 py-3">

                    <div class="grid grid-cols-3 text-center">
                        <h1 style="font-size: 12px;" class="text-base text-gray-500 font-bold mr-3">All Documents</h1> 
                        <h1 style="font-size: 12px;" class="text-base text-gray-500 font-bold mr-3">Status</h1>
                        <h1 style="font-size: 12px;" class="text-base text-gray-500 font-bold mr-3">Date Modified</h1>
                    </div>

                    <?php 

                    $rows = $db->getAllRowsFromTable('for_uploads');
                    
                    foreach ($rows as $row) {
                        $uploadedCount =0;
                       
                        $upload_id = $row['id'];
                        $datetime_created = "";
                        
                        $file_name = $db->getIdByColumnValue('for_uploads','id',$upload_id,'name');
                       
                        $conditions2 = [
                            "faculty_id" => $faculty_id,
                            "section_id" => $section_id,
                            "upload_id" => $upload_id,
                            "year" => $currentYear,
                            "semester" => $currentSem,
                        ];
                        $uploadedCount = $db->getCountByConditions("faculty_uploads",$conditions2);


                        if($uploadedCount=="0")
                        {
                            $icon = $icon_not_done;
                            $datetime_created = '--/--/----';
                        }

                        if($uploadedCount=="1")
                        {
                        $icon = $icon_done;
                        $datetime_created = $db->getIdByColumnValueWhere('faculty_uploads',$conditions2,'datetime_created');
                        $date = new DateTime($datetime_created);
                        $formatted_date = $date->format('F j, Y / g:i A');
                        $datetime_created =$formatted_date;
                            
                        }

                    

                     echo '
                     <div  class="grid mb-2 grid-cols-3 text-center grid-flow-col-dense  items-center">
                                <div>
                               


                                <div class="grid grid-cols-2 justify-items-center items-center">

                                <div class="justify-items-center">
                                <img style="height:70px" src="../assets/image/file.png">
                                </div>
                                    <div class="container ">
                                        <p class="font-bold">'.ucwords($file_name).'</p>
                                    </div>

                                </div>


                                </div>
                                <div>
                                
                                        '.$icon.'
                                </div>
                                <div>
                               
                                '.$datetime_created.'
                                </div>
                            </div>
                     ';
                    }
                    ?>


                            
                        </div>

                            </div>
                        <div>
                    </div>
                </div>
            </main>
        </div>
    </div>
<?php include 'components/footer.php'?>
<script>
     $('.dashboard').addClass('active-nav-link');
     $('.dashboard').removeClass('opacity-75');
</script>
