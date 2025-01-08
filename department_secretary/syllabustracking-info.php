<?php include 'components/header.php'?>
<?php 
    if(isset($_GET['s']) && $_GET['s']!="" && isset($_GET['uid']) && $_GET['uid']!="")
    {
        $id =  preg_replace('/\D/', '', $_GET['s']);
        $uid =  preg_replace('/\D/', '', $_GET['uid']);
        if($db->getIdByColumnValue("subject","id",$id,'id')=="" || $db->getIdByColumnValue("for_uploads","id",$uid,"name")=="")
        {
            echo '
            <script>
                window.location.href="dashboard.php"
            </script>
            ';
        }else{
            $semester=$_GET['sem'];
                $sy=$_GET['sy'];


                // Validate semester: Only allow "1st Semester" or "2nd Semester"
                if ($semester !== '1st Semester' && $semester !== '2nd Semester' && $semester !== '3rd Semester' && $semester !== 'Summer') {
                    die('Invalid semester. ');
                }

                // Validate school year: Must follow the format "YYYY-YYYY" where YYYY is a 4-digit number
                if (!preg_match('/^\d{4}-\d{4}$/', $sy)) {
                    die('Invalid school year format');
                }

                // Further validation: Ensure the difference between the two years is exactly 1
                $years = explode('-', $sy);
                if ((int)$years[1] - (int)$years[0] !== 1) {
                    die('Invalid school year.');
                }
        }
    }else{
        echo '
        <script>
            window.location.href="dashboard.php"
        </script>
        ';
    }
    $root= $_SESSION['root'];
    $subject_name = ucwords($db->getIdByColumnValue("subject","id",$id,"name"));
    $for_uploads = ucwords($db->getIdByColumnValue("for_uploads","id",$uid,"name"));

    $where = [
        'subject_id='.$id,
        "sem='". $semester."'",
        "sy='". $sy."'",
    ];
    $sectionRows = $db->getAllRowsFromTableWhere("faculty_subject_section", $where);

    if($root!="Documents")
    {
        echo "<script>
            $('.dashboard').addClass('active-nav-link');
            $('.dashboard').removeClass('opacity-75');
        </script>";

        
        $nav = '
             <a href="dashboard.php" class="mr-3">'.$root.'</a> 
            <p class="mr-3">></p>
            <p class="mr-3">'.$subject_name.'</p> 
        ';
    }else{
        echo "<script>
            $('.documents').addClass('active-nav-link');
            $('.documents').removeClass('opacity-75');
        </script>";

        $nav = '
             <a href="documents.php" class="mr-3">'.$root.'</a> 
            <p class="mr-3">></p>
            <p class="mr-3">'.$subject_name.'</p> 
        ';
    }
 

?>

<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
        <div class="container flex text-orange mb-3">
            <?= $nav?>
        </div>
        <div class="container flex items-center mb-6">
            <h1 class="text-3xl text-black mr-3"><?=$subject_name?></h1>
        </div>

        <div class="container p-4">
            <table class="min-w-full text-left border-collapse block table overflow-y-scroll">
                <thead class="block table-header-group">
                    <tr class="block table-row bg-orange text-black">
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Faculty Members</th>
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Status</th>
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Sections</th>
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Date Modified</th>
                    </tr>
                </thead>
                <tbody class="block table-row-group">

                <?php 
                           $count = 0;

                foreach ($sectionRows as $section_row) {

                    $section_id = $section_row['section_id'];
                    $faculty_id = $section_row['faculty_id'];

                    $new_role =  $db->getIdByColumnValue('users','id',$faculty_id,'role');
                    $new_role = ucwords(str_replace('_', ' ', $new_role));
                    // if($new_role!="faculty")
                    // {
                    //     continue;
                    // }


                    $subject_id = $section_row['subject_id'];

                    $section_name = strtoupper($db->getIdByColumnValue("deparment_section","id",$section_id,"name"));
                    $faculty_name = ucwords($db->getIdByColumnValue("user_details","user_id",$faculty_id,"name"));
                    $faculty_image = ucwords($db->getIdByColumnValue("user_details","user_id",$faculty_id,"image"));
                    $faculty_position = 'Faculty';
                    $faculty_specialization = ucwords($db->getIdByColumnValue("user_details","user_id",$faculty_id,"specialization"));
                    $faculty_phone = ucwords($db->getIdByColumnValue("user_details","user_id",$faculty_id,"phone"));


                    $where = [
                                'subject_id='.$subject_id,
                                'faculty_id='.$faculty_id,
                                'upload_id='.$uid,
                                'section_id='.$section_id,
                                'semester='."'$semester'",
                                'year='."'$sy'",
                
                            ];
               
                    $facultyUploadChecker = $db->getAllRowsFromTableWhere("faculty_uploads", $where);
                    $icon = count($facultyUploadChecker) == 1 ? '
                                        <i class="material-icons text-white bg-green-400 rounded-full p-1">task_alt</i>
                    ' : '
                                         <i class="material-icons text-white bg-red-400 rounded-full p-1">error</i>
                    ';
                    $max_date = $db->getMaxDateProctor($subject_id,$uid,$semester,$sy,$section_id,$faculty_id);
    
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
                            <div class="flex flex-row text-justify items-center">
                                <img src="../uploads/faculty/'.$faculty_image.'" style="height: 100px; width:100px;" class="rounded-lg mr-3" alt="">
                                <div class="flex flex-col">
                                    <p class="font-semibold text-gray-800">'.$faculty_name.'</p>
                                    <p class="font-semibold text-gray-800">'.$new_role.'</p>
                                    <p class="font-semibold text-gray-800">'.$faculty_specialization.'</p>
                                    <p class="font-semibold text-gray-800">'.$faculty_phone.'</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-3 block table-cell">
                           '.$icon.'
                        </td>
                        <td class="p-3 block table-cell">'.$section_name.'</td>
                        <td class="p-3 block table-cell">'.$date.'</td>
                    </tr>
                    ';
                    $count++;

                }

               if($count==0)
               {
                echo '
                <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
                        <td class="p-3 block table-cell text-center" colspan=3>
                            No Faculty has add this subject yet.
                        </td>
                    </tr>
                ';
               }
                ?>
                    
                </tbody>
            </table>
        </div>
    </main>
</div>

<?php include 'components/footer.php' ?>



