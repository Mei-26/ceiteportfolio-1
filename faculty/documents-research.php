<?php include 'components/header.php'?>
<?php 
    if(isset($_GET['s']) && $_GET['s']!="")
    {
      
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

      


    $getSectionForDocuments_rows = $db->getSectionForDocuments($subject_id,$_SESSION['id']);
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
                        <a href="documents.php" class="mr-3">Documents</a> 
                        <p class="mr-3">></p>
                        <p class="mr-3"><?=$courseName;?> </p>
                   </div>

                <div class="container flex items-center mb-6">
                <h1 class="text-3xl text-black mr-3"><?=$courseName;?></h1>
                    <select id="documentFilter" class="px-3 py-2 text-base rounded-lg bg-orange text-orange">
                        <?php 
                        if(count($getSectionForDocuments_rows)>0)
                        {
                            foreach ($getSectionForDocuments_rows as $row) {
                                $sy_section =  $row['sy'];
                                $sem_section =  $row['sem'];

                                if($semester == $sem_section && $sy == $sy_section)
                                {
                                    echo '<option value="'.$row['section_id'].'">'.$row['name'].'</option>';
                                }
                            }
                        }else{
                            echo '<option value="">Section not added</option>';
                        }
                        ?>
                        
                    </select>
                </div>


                    <div class="">
                    <div class="container flex mb-4 items-center">
                        <h1 class="text-base text-gray-500 font-bold mr-3">DOCUMENTS</h1>
                        
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10">
                        

                    <?php 
                     if(count($getSectionForDocuments_rows)>0)
                     {
                         foreach ($getSectionForDocuments_rows as $SectionForDocuments_row) {
                            $rows = $db->getAllRowsFromTable("for_uploads");

                            $section_document_id = $SectionForDocuments_row['section_id'];
                            foreach ($rows as $row) {
        
                                $file_name = $row['name'];
                                $file_id = $row['id'];
                              
                                $data = 
                                '
                                data-section_id="'.$section_document_id.'"
                                data-file_id="'.$file_id.'"
                                data-file_name="'.$file_name.'"
                                ';
        
                                $where = [
                                    "section_id=".$section_document_id,
                                    "subject_id=".$subject_id,
                                    "faculty_id=".$_SESSION['id'],
                                    "upload_id=".$file_id,
                                    "semester="."'$semester'",
                                    "year="."'$sy'"
                                    ];

                                if($current_sem_system == $semester && $current_year_system == $sy)
                                {
                                    $checkRows = $db->getAllRowsFromTableWhere("faculty_uploads",$where );
                                    $status = count($checkRows)!=0  ? '
                                     <p '.$data.' class="uploadDocumentBtn bg-green-300 text-center px-5 py-2 font-bold text-white rounded-full cursor-pointer hover:opacity-75">
                                       Update     </p>
                                    ' : 
                                    '
                                     <p '.$data.' class="uploadDocumentBtn bg-orange text-center px-5 py-2 font-bold text-orange rounded-full cursor-pointer hover:opacity-75">
                                       Upload     </p>
                                    ';
                                }else {
                                    $checkRows = $db->getAllRowsFromTableWhere("faculty_uploads",$where );
                                    $status = count($checkRows)!=0  ? '
                                     <p '.$data.' class=" bg-green-300 text-center px-5 py-2 font-bold text-white rounded-full cursor-not-allowed ">
                                       Uploaded     </p>
                                    ' : 
                                    '
                                     <p '.$data.' class=" bg-orange text-center px-5 py-2 font-bold text-orange rounded-full cursor-not-allowed ">
                                       Cannot Upload     </p>
                                    ';
                                }

                              
                                
        
                                echo '
                                <div data-id="'.$section_document_id.'" class="card mt- md:mt-0 my-3 bg-white shadow-md rounded-lg px-3 py-3">
                                      <div class="grid gap-x-3 place-items-end grid-flow-col-dense grid-cols-3 items-end">
                                    <img style="height:70px" src="../assets/image/file.png">
                                    <div class="container ">
                                        <p class="font-bold">'.ucwords($file_name).'</p>
                                    </div>
                                            '.$status.'
                                    </div>
                                </div>
                                ';
                            }
                         }
                     }else{
                        echo '
                        <div class="card col-span-2 mt- md:mt-0 my-3 bg-white shadow-md rounded-lg px-3 py-3">
                            <div  class="grid gap-x-3 text-center grid-flow-col-dense  items-center">
                                No data yet.
                            </div>
                        </div>
                        '; 
                     }
                    ?>

                            </div>
                        <div>
                    </div>
                </div>
            </main>
        </div>
    </div>
<?php include 'modal/modal-upload_documents.php'?>
<?php include 'components/footer.php'?>
<script>
     $('.documents').addClass('active-nav-link');
     $('.documents').removeClass('opacity-75');
</script>
<script>
    $('.card').each(function(){
        if($('#documentFilter').val()!=$(this).data('id')){
            if($('#documentFilter').val()!=""){
                $(this).hide();
            }
        }
    })
    // $('#documentFilter').change(function(){
    //     var filter_id = $(this).val();
    //     $('.card').each(function(){
    //         if(filter_id!=$(this).data('id')){
    //             $(this).hide();
    //         }else{
    //             $(this).show();
    //         }
    //     })
    // })

    // On page load, check if a filter is stored in localStorage and apply it
    $(document).ready(function() {
    var savedFilterId = localStorage.getItem('selectedFilterId');
    if (savedFilterId && $('#documentFilter option[value="' + savedFilterId + '"]').length > 0) {
        $('#documentFilter').val(savedFilterId).change(); // Set the select value and trigger change
    }
});

// When the filter changes, store the selected value in localStorage and apply the filter
$('#documentFilter').change(function() {
    var filter_id = $(this).val();
    localStorage.setItem('selectedFilterId', filter_id); // Save the selected filter to localStorage
    
    $('.card').each(function() {
        if (filter_id != $(this).data('id')) {
            $(this).hide();
        } else {
            $(this).show();
        }
    });
});
</script>