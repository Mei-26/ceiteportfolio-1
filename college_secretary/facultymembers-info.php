<?php include 'components/header.php'?>
<?php 
  if(isset($_GET['i']) && $_GET['i']!="")
  {
      $id =  trim(preg_replace('/\D/', '', $_GET['i']));
      if($db->getIdByColumnValue("user_details","user_id",$id,'user_id')=="")
      {
          echo '
          <script>
              window.location.href="dashboard.php"
          </script>
          ';
      }
  }else{
      echo '
      <script>
          window.location.href="dashboard.php"
      </script>
      ';
  }


  if(isset($_SESSION['dashboard']))
  {
    $title = $_SESSION['dashboard']  .'<p class="mr-3">></p> Profile'
    
    ;
  }else{
    $title = "Profile";
    $_SESSION['dashboard'] = "Profile";
  }
  $_SESSION['temp_faculty_id']=$id;


$user_id = $id;
$full_name = ucwords($db->getIdByColumnValue("user_details","user_id",$user_id,"name")) ?? "";
$specialization = ucwords($db->getIdByColumnValue("user_details","user_id",$user_id,"specialization")) ?? "";
$contacts = ucwords($db->getIdByColumnValue("user_details","user_id",$user_id,"phone")) ?? "";
$image = $db->getIdByColumnValue("user_details","user_id",$user_id,"image") ?? "";

$rows = $db->getAllRowsFromTableWhere("faculty_subject",['faculty_id='.$user_id]);
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

$position = $db->getIdByColumnValue("users", "id", $user_id, "role");
$positionDisplay = $position!="faculty" ? "hidden": "";
$positionDisplay2 = $position=="faculty" ? "hidden": "";
?>
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
            <div class="container flex text-orange mb-3">
                        <?=$title?>
                   </div>
                <h1 class="text-3xl text-black pb-6">Profile</h1>

               
                <div class="flex flex-col md:flex-row justify-center items-center bg-white rounded-lg p-3">
                <img src="<?='../uploads/faculty/'.$image?>" class="rounded-lg text-center md:h-32 h-100">
                <div class="container mx-3 p-2 bg-white">
                    <div class="flex flex-col ">
                        <div class="flex flex-col lg:flex-row">
                            <div class="lg:w-1/5 font-semibold">Full Name:</div>
                            <div class="lg:w-4/5 font-normal"><?=$full_name?></div>
                        </div>
                        <div class="flex flex-col lg:flex-row">
                            <div class="lg:w-1/5 font-semibold">Position:</div>
                            <div class="lg:w-4/5 font-normal"><?=ucwords(str_replace('_', ' ', $position))?></div>
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

                <div class="grid p-3  gap-x-10  md:grid-cols-2">

                    <div  <?=$positionDisplay?> class="">
                        <p class="text-gray-400 text-center sm:text-left">Documents</p>
                        <div style="height:500px" class="card bg-white items-center flex flex-col shadow-md rounded-lg p-10 ">
                                <!-- <img style="max-height: 400px;" src="https://d.novoresume.com/images/doc/general-resume-template.png" class="m-0" alt=""> -->
                                <?php echo $file_object; ?>
                                <p class="text-black">Resume</p>
                        </div>
                    </div>
                <div>
                

                <div  <?=$positionDisplay?> class="overflow-y-scroll px-4 sm:mt-0 mt-3 pb-4" style="height:500px ">

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
                                <p class="truncate md:truncate">Subject Name: <span class="font-bold whitespace-nowrap">' . htmlspecialchars(ucwords($name)) . '</span></p>
                                <p class="truncate md:truncate">Code: <span class="font-bold whitespace-nowrap">' . htmlspecialchars(strtoupper($code)) . '</span></p>
                                    <a href="documents-research.php?s='.$row['subject_id'].'"
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
                            <p class="text-gray-500 text-center">It looks like haven\'t added any subjects yet.</p>
                        </div>
                        ';
                    }
                    
                    
                    ?>
                    </div>
                </div>

                </div>
                </div>

                    <!-- add -->

                    <div  class="grid p-3  gap-x-10  ">

                    <div class="" <?=$positionDisplay2?>>
                        <p class="text-gray-400 text-center sm:text-left">Resume</p>
                        <div style="height:500px" class="card bg-white items-center flex flex-col shadow-md rounded-lg p-10 ">
                                <?php echo $file_object; ?>
                        </div>
                    </div>
                <div>

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
     $('.facultymembers').addClass('active-nav-link');
     $('.facultymembers').removeClass('opacity-75');
</script>