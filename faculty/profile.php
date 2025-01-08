<?php include 'components/header.php'?>
<?php 
$user_id = $_SESSION['id'];
$full_name = ucwords($db->getIdByColumnValue("user_details","user_id",$user_id,"name")) ?? "";
$specialization = ucwords($db->getIdByColumnValue("user_details","user_id",$user_id,"specialization")) ?? "";
$contacts = ucwords($db->getIdByColumnValue("user_details","user_id",$user_id,"phone")) ?? "";

$where = array(
    'college_id'=>$my_college_id,
    'current_status'=>'current',
  );
  
   $currentSem = $db->getIdByColumnValueWhere("current_year_sem",$where, "current_sem");
   $currentYear = $db->getIdByColumnValueWhere("current_year_sem",$where,"current_year");




$rows = $db->getAllRowsFromTableWhere("faculty_subject",
['faculty_id='.$user_id,'sy='."'$currentYear'",'sem='."'$currentSem'"
]);

// Fetch file details
$file_id = $db->getIdByColumnValue("resume_upload", "faculty_id", $user_id, "file");
$file_type = $db->getIdByColumnValue("resume_upload", "faculty_id", $user_id, "file_type");

$file_object = "";

// Define the upload directory
$uploadDir = '../uploads/resume/';
$filePath = $uploadDir . $file_id;

if ($file_id && file_exists($filePath)) {
    // Determine if the file is viewable in the browser
    if (in_array($file_type, ['application/pdf', 'image/jpeg', 'image/png', 'image/gif'])) {
        // Use iframe or embed to display the file
        if ($file_type === 'application/pdf') {
            // PDF can be viewed with the embed tag
            $file_object = '<embed src="' . htmlspecialchars($filePath) . '" type="application/pdf" style="width:100%; height:500px; max-height: 80vh;" />';
        } elseif (in_array($file_type, ['image/jpeg', 'image/png', 'image/gif'])) {
            // Images can be displayed directly
            $file_object = '<img src="' . htmlspecialchars($filePath) . '" style="width:100%; height:500px; max-height: 80vh; object-fit: contain;" />';
        }
    } else {
        // Provide a download link for other file types
        $file_object = '<a href="' . htmlspecialchars($filePath) . '" download class="bg-green-700  text-white px-4 py-2 rounded">Download Resume</a>';
    }
} else {
    $file_object = 'No resume uploaded or file not found.';
}
?>
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Profile</h1>

               
                <div class="flex flex-col md:flex-row justify-center items-center bg-white rounded-lg p-3">
                <img src="<?=$src?>"  class="rounded-lg text-center md:h-32 h-32">
                <div class="container mx-3 p-2 bg-white">
                    <div class="flex flex-col ">
                        <div class="flex flex-col lg:flex-row">
                            <div class="lg:w-1/5 font-semibold">Full Name:</div>
                            <div class="lg:w-4/5 font-normal"><?=$full_name?></div>
                        </div>
                        <div class="flex flex-col lg:flex-row">
                            <div class="lg:w-1/5 font-semibold">Position:</div>
                            <div class="lg:w-4/5 font-normal">Faculty</div>
                        </div>
                        <div class="flex flex-col lg:flex-row">
                            <div class="lg:w-1/5 font-semibold">Specialization:</div>
                            <div class="lg:w-4/5 font-normal"><?=$specialization?></div>
                        </div>
                        <div class="flex flex-col lg:flex-row">
                            <div class="lg:w-1/5 font-semibold">Contacts:</div>
                            <div class="lg:w-4/5 font-normal"><?=$contacts?></div>
                        </div>
                    </div>
                </div>
            </div>



                    <!-- add -->

                    <div  class="grid p-3  gap-x-10  md:grid-cols-2">

                    <div class="">
                        <p class="text-gray-400 text-center sm:text-left">Documents</p>
                        <div style="height:500px" class="card bg-white items-center flex flex-col shadow-md rounded-lg p-10 ">
                                <!-- <img style="max-height: 400px;" src="https://d.novoresume.com/images/doc/general-resume-template.png" class="m-0" alt=""> -->
                                <?php echo $file_object; ?>
                                <p class="text-black">Resume</p>
                        </div>
                    </div>
                <div>
                

                <div class="overflow-y-scroll px-4 sm:mt-0 mt-3 pb-4" style="height:500px ">

                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">
                    <?php 
                    
                    if(count($rows) != 0) {
                        foreach ($rows as $row) {

                 $sy = $row['sy'];
                            $sem = $row['sem'];
                            if($sy !=$currentYear || $sem != $currentSem)
                            {
                                continue;
                            }

     $image = $db->getIdByColumnValue('subject','id',$row['subject_id'],'image');
                            $code = $db->getIdByColumnValue('subject','id',$row['subject_id'],'code');
                            $name = $db->getIdByColumnValue('subject','id',$row['subject_id'],'name');

                            echo '
                            <div class="card bg-white shadow-md flex flex-col rounded-lg p-6">
                                <div class="flex justify-center sm:justify-center md:justify-center">
                                    <img src="../uploads/subjects/' . htmlspecialchars($image) . '" alt="Image of ' . htmlspecialchars($name) . '"  class="max-h-full h200 rounded-lg mb-3">
                                </div>                                
                                <p class="truncate md:truncate ">Subject Name: <span class="font-bold whitespace-nowrap">' . htmlspecialchars(ucwords($name)) . '</span></p>
                                <p class="truncate md:truncate">Code: <span class="font-bold  whitespace-nowrap">' . htmlspecialchars(strtoupper($code)) . '</span></p>
                                    <a href="subject-info.php?s='.$row['subject_id'].'" 
                                    class="bg-orange mt-3 text-center w-full text-orange px-1 py-2 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                    Open
                                    </a>
                            </div>
                            ';
                        }
                    } else {
                        echo '
                        <div class="card col-span-3 bg-gray-100 shadow-md flex flex-col items-center justify-center rounded-lg p-6">
                            <p class="font-semibold text-gray-700 text-center">No Added Subjects</p>
                            <p class="text-gray-500 text-center">It looks like you haven\'t added any subjects yet.</p>
                        </div>
                        ';
                    }
                    
                    
                    ?>
                    </div>
                </div>



                    <!-- end add -->

                    
                    <div>
                                </div>
                            </div>
                    </div>
                
                    <?php 
                include 'credential_list.php';
                ?>
            </main>
    
        </div>
        
    </div>

<?php include 'components/footer.php'?>
<script>
     $('.profile').addClass('active-nav-link');
     $('.profile').removeClass('opacity-75');
</script>