<?php include 'components/header.php'?>
<?php 
    if(isset($_GET['s']) && $_GET['s']!="")
    {
        $id =  preg_replace('/\D/', '', $_GET['s']);
        if($db->getIdByColumnValue("subject","id",$id,'id')=="")
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
     $subject_name = ucwords($db->getIdByColumnValue("subject","id",$id,"name"));
     $subject_code = $db->getIdByColumnValue("subject","id",$id,"code");

     $sectionRows = $db->getAllFacultySectionsBySubjectID($id);

          $semAndSchoolYearRows = $db->getSemAndSchoolyears($my_college_id);

     if(isset($_SESSION['dashboard']))
        {
            $title = $_SESSION['dashboard'] . '
            <p class="mr-3">></p>
            <p class="mr-3">' . htmlspecialchars($subject_name, ENT_QUOTES, 'UTF-8') . '</p>';

        }else{
            $title = '
            <a href="documents.php" class="mr-3">Documents</a> 
            <p class="mr-3">></p>
            <p class="mr-3">'.$subject_name.'</p>
            ';
        }
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
                        <?=$title?>
                   </div>

                <div class="container flex items-center mb-6">
                <h1 class="text-3xl text-black mr-3"><?=$subject_name?></h1>
                <select  id="schoolyearFilter" class="px-3 py-2 rounded-lg bg-orange text-orange">
                <?php
                if(count($semAndSchoolYearRows)>0)
                {
                    foreach ($semAndSchoolYearRows as $row) {
                        $semester = $row['current_sem'];
                        $schoolyear = $row['current_year'];
                        $val = $semester.' - '.$schoolyear;
    
                        $selected = $row['current_status'] =='current' ? 'selected' : '';
    
                        echo '<option '.$selected.' value="'.$val.'">'.$val.'</option>';
                    } 
                }else{
                    echo '<option  value="">Update Academic Year and Semester First </option>';
                }
                ?>
                </select>
                </div>

                <div  class="grid p-3  gap-x-20  md:grid-cols-2">

                    <div class="">
                    <div class="container flex mb-4 items-center">
                        <h1 class="text-base text-gray-500 font-bold mr-3">DOCUMENTS</h1>
                        <select id="documentFilter" class="px-3 py-2 text-base rounded-lg bg-orange text-orange">
                            <?php 
                            foreach ($sectionRows as $row) {
                                $section_name = $row['name'];
                                $section_id = $row['section_id'];
                                $faculty_id = $row['faculty_id'];
                                $sy_section = $row['sy'];
                                $sem_section = $row['sem'];
                                $val = $sem_section.' - '.$sy_section;

                                echo '<option data-sy="'.$val.'" data-faculty_id="'.$faculty_id.'" value="'.$section_id.'">'.ucwords($section_name).'</option>';
                            }
                            ?>
                            
                        </select>
                    </div>

                    
                    <div id="documentDiv"></div>
                       
                    </div>
                <div>
                

                    <div class="overflow-y-scroll px-4" style="height:500px ">
                        <p class="text-gray-500 m- my-4 font-bold text-base">Faculty Members</p>
                        
                        <div id="faculty_members">
                        <?php 
                        //GET ALL FACULTY THAT HANDLE THE SUBJECTS

                        $faculty_rows = $db->getAllRowsFromTableWhereGroup("faculty_subject_section",["subject_id=".$id],'faculty_id ASC');
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
                            <a href="facultymembers-info.php?i='.$faculty_id.'" class="bg-orange text-center px-5 py-2 text-orange rounded-full cursor-pointer hover:opacity-75">
                                        View
                                    </a>
                            '; 

                            echo 
                            '
                                <div class="card cursor-pointer hover:bg-red-50  mt- md:mt-0 my-3 bg-white  shadow-md rounded-lg px-3 py-3" data-faculty-id="'.$faculty_id.'">
                                  <div class="grid gap-x-3 place-items-end grid-flow-col-dense grid-cols-3 items-end">
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
                        }

                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
        
    </div>

<?php include 'modal/modal-documents-research.php' ?>
<?php include 'components/footer.php'?>
<script>
     $('.documents').addClass('active-nav-link');
     $('.documents').removeClass('opacity-75');
</script>
<script>
   function getDocument(subject_id, faculty_id, section_id, schoolyear) {
        $.ajax({
            url: 'controller/get_documents.php', // Endpoint URL
            type: 'POST', // HTTP request method
            data: {
                subject_id: subject_id,
                faculty_id: faculty_id,
                section_id: section_id,
                schoolyear: schoolyear
            }, // Send data to the server
            success: function(response) {
                $('#documentDiv').empty();
                $('#documentDiv').append(response); 
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error); // Log any errors
            }
        });
    }

    function first_documentFilter(faculty_id,schoolyear)
    {
        var id = "";
        $('#documentFilter option').each(function(){
            if($(this).data('faculty_id') == faculty_id && $(this).data('sy')==schoolyear)
            {
                $(this).show();
                id = $(this).val();
                
            }else{
                $(this).hide();   
            }
        });
        return id;
    }
    function documentFilter(faculty_id,schoolyear)
    {
        $('#documentFilter option').each(function(){
            if($(this).data('faculty_id') == faculty_id && $(this).data('sy')==schoolyear)
            {
                $(this).show();
            }else{
                $(this).hide();   
            }
        });
    }

    function selectThefirst(first_section_id,first_faculty_id){
        var matchingOption = $('#documentFilter option').filter(function() {
            return $(this).val() === first_section_id && $(this).data('faculty_id') === first_faculty_id;
        });

        // Check if the option exists and then set it as the selected option
        if (matchingOption.length > 0) {
            matchingOption.prop('selected', true);
        } else {
            console.log('No matching option found with data-faculty_id = ' + first_faculty_id + ' and value = ' + first_section_id);
        }
    }
</script>

<script>
$(document).ready(function() {
    // Select the first card and get the faculty_id
    var $firstCard = $('.card').first();
    var first_faculty_id = $firstCard.data('faculty-id');
    $firstCard.addClass('active-outline');
    var first_schoolyear = $('#schoolyearFilter').val();
    const subject_id = <?php echo json_encode($id)?>;
    
    var first_section_id = (first_documentFilter(first_faculty_id,first_schoolyear))
    selectThefirst(first_section_id,first_faculty_id)
    getDocument(subject_id,first_faculty_id,first_section_id,first_schoolyear);




    $('.card').click(function(){
        $('.card').removeClass('active-outline');
        $(this).addClass('active-outline');
        var faculty_id = $(this).data('faculty-id');
        // var section_id = $('#documentFilter').val();
        var schoolyear = $('#schoolyearFilter').val();
        documentFilter(faculty_id,schoolyear);
        var section_id = (first_documentFilter(faculty_id,schoolyear))
        selectThefirst(section_id,faculty_id)
        getDocument(subject_id,faculty_id,section_id,schoolyear);
    })

    $('#documentFilter').change(function(){
        var section_id = $(this).val();
        var schoolyear = $('#schoolyearFilter').val();
        var $activeCard = $('.card.active-outline');
        // Optional: Do something with the active card
        if ($activeCard.length > 0) {
            var faculty_id = $activeCard.data('faculty-id');

            getDocument(subject_id,faculty_id,section_id,schoolyear);
        } 
    })
    $('#schoolyearFilter').change(function(){
        
        var section_id = $('#documentFilter').val();
        var schoolyear = $(this).val();
        var $activeCard = $('.card.active-outline');
        // Optional: Do something with the active card
        if ($activeCard.length > 0) {
            var faculty_id = $activeCard.data('faculty-id');
            getDocument(subject_id,faculty_id,section_id,schoolyear);
        } 
       
        $.ajax({
            url: 'controller/get_faculties.php', // Endpoint URL
            type: 'POST', // HTTP request method
            data: {
                schoolyear: schoolyear,
                subject_id: subject_id
            }, // Send data to the server
            success: function(response) {
                 $('#faculty_members').empty();
                 $('#faculty_members').append(response); 


                 const firstCard = $('.card').first(); // Select the first '.card' element
                console.log(firstCard);

                // Check if the element exists
                if (firstCard.length) {
                    // Remove 'active-outline' class from all '.card' elements
                    $('.card').removeClass('active-outline');

                    // Add 'active-outline' class to the first '.card' element
                    firstCard.addClass('active-outline');

                    // Get the 'data-faculty-id' attribute from the first '.card' element
                    const faculty_id = firstCard.data('faculty-id');
                    const schoolyear = $('#schoolyearFilter').val(); // Get the value of '#schoolyearFilter'

                    // Call functions with the necessary parameters
                    documentFilter(faculty_id, schoolyear);

                    const section_id = first_documentFilter(faculty_id, schoolyear); // Fetch section ID
                    selectThefirst(section_id, faculty_id); // Select the first section
                    getDocument(subject_id, faculty_id, section_id, schoolyear); // Fetch document
                }


                 $('.card').click(function(){
              
                $('.card').removeClass('active-outline');
                $(this).addClass('active-outline')
                var faculty_id = $(this).data('faculty-id');
                // var section_id = $('#documentFilter').val();
                var schoolyear = $('#schoolyearFilter').val();
                documentFilter(faculty_id,schoolyear);
                var section_id = (first_documentFilter(faculty_id,schoolyear))
                selectThefirst(section_id,faculty_id)
                getDocument(subject_id,faculty_id,section_id,schoolyear);
                

            })
            
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error); // Log any errors
            }
        });
    })
    

});

</script>
<script>
$(document).ready(function () {
  var $modal = $('#modalFacultyResarch');
  var $modalContent = $modal.find('.bg-white');

  function checkClickOutside(event) {
    if (!$modalContent.is(event.target) && $modalContent.has(event.target).length === 0) {
      $modal.addClass('hidden');
    }
  }

  // Attach click event to the modal container
  $modal.on('click', function (event) {
    if ($modal.is(':visible')) {
      checkClickOutside(event);
    }
  });

  // Close modal button event listener
  $('.closeModalButton').on('click', function () {
    $modal.addClass('hidden');
  });
});
</script>

<script>
    $('.removeFacultyBtn').click(function(){
        var section_id = $('#documentFilter').val();

        if(section_id!="")
        {
            // modalFacultyResarch
            $('#modalFacultyResarch').removeClass('hidden')
                        .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation

            $('#modalFacultyResarch > div').css('animation', 'modal-fade-in 0.3s forwards'); // Scale animation
            $('#remove_faculty_id').val($(this).data('id'))
        }
       
    })
</script>

<script>
    $('#submitRemoveFaculty').click(function(){
        var section_id = $('#documentFilter').val();
        var formData = new FormData($('#removefacultyForm')[0]);
        const subject_id = <?php echo json_encode($id)?>;

        formData.append('section_id', section_id);
        formData.append('subject_id', subject_id);

        $.ajax({
            url: 'controller/removeFaculty.php', // Replace with your server endpoint URL
            type: 'POST', // Use 'GET' or 'POST' depending on your server setup
            data: formData,
            processData: false,  // Tell jQuery not to process the data
            contentType: false,  // Tell jQuery not to set contentType
            success: function(response) {
                alertMaker(response);
            },
            error: function(xhr, status, error) {
                // Handle errors if the request fails
                console.error('Error submitting form:', error);
            }
        });
    })
</script>
