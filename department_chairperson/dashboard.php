<?php include 'components/header.php'?>
<?php 
$user_id = $_SESSION['id'];
$_SESSION['root']="Dashboard";
$college_id = $my_college_id;
$semAndSchoolYearRows = $db->getSemAndSchoolyears($my_college_id) ?? array();
?>
<style>
    .rounded-full {
        font-size: 12px !important; /* Ensure consistent icon size */
    }
    .ro {
    height: 400px;
    overflow-y: auto;
  }

  /* Remove style on small screens */
  @media (max-width: 768px) { /* Adjust breakpoint as needed */
    .ro {
      height: auto;
      overflow-y: visible;
    }
  }
</style>
<select hidden id="schoolYearFilter" class="px-3 py-2 rounded-lg bg-orange text-orange border ">
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

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">


            <div class="grid">
                <h1 class="text-3xl text-black pb-6 ">Dashboard</h1>
            </div>

                <div class="grid  md:grid-cols-3 gap-x-5 gap-y-2">

                <div class="ro bg-green-100 p-3 rounded-lg">
                    <h1 class="text-sm text-gray-400 font-bold mr-3 mb-2">FACULTY DOCUMENT STATUS - <span class="text-green-500">COMPLETED</span></h1>
                    <div class="card bg-white shadow-md rounded-lg p-6 flex justify-center flex-col">
                      <div>
                            <!-- COMPLETED -->
                            <table class="min-w-full bordered text-left border-collapse block table overflow-y-scroll gap-x-3 p-3" >
                            <thead class="block table-header-group">
                                <tr class="block table-row text-black">
                                    <th style="font-size:13px" colspan="4" class="font-semibold  uppercase tracking-wider text-left block table-cell">Faculty Members</th>


                                    <th style="font-size:13px" class="font-semibold  text-center  uppercase tracking-wider block table-cell">Status</th>
                                </tr>
                            </thead>
                             <tbody class="block table-row-group" id="table_complete">
                                
                               
                            </tbody>
                        </table>
                        
                      </div>
                    </div>
                </div>
                <div class="ro  bg-red-100 p-3 rounded-lg">
                <h1 class="text-sm text-gray-400 font-bold mr-3 mb-2">FACULTY DOCUMENT STATUS - <span class="text-red-500">PENDING</span></h1>
                <div class="card bg-white shadow-md rounded-lg p-6 flex justify-center flex-col">
                      <div>
                            <!-- COMPLETED -->
                            <table class="min-w-full bordered text-left border-collapse block table overflow-y-scroll gap-x-3 p-3" >
                            <thead class="block table-header-group">
                                <tr class="block table-row text-black">
                                    <th style="font-size:13px" colspan="4" class="font-semibold  uppercase tracking-wider text-left block table-cell">Faculty Members</th>

                                    <th style="font-size:13px" class="font-semibold  text-center  uppercase tracking-wider block table-cell">Status</th>
                                </tr>
                            </thead>
                             <tbody class="block table-row-group" id="table_pending">
                                
                               
                            </tbody>
                        </table>
                        
                      </div>
                    </div>
                </div>

                <div class="ro bg-gray-200 p-3 rounded-lg">
                <div class=" flex mb-2 col-span-2 ">
                                <h1 class="text-sm text-gray-400 font-bold mr-3 ">DOCUMENT TRACKING</h1>
                                <select id="documentFilter" class="min-w-100 px-3 py-0 rounded-lg bg-orange text-orange border w-full sm:w-1/2 md:w-1/2 px-3 ">
                                    <?php 
                                    $rows = $db->getAllRowsFromTable("for_uploads");

                                    foreach ($rows as $row) {
                                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                    <div class="card bg-white shadow-md rounded-lg p-6 flex justify-center flex-col ">
                        <div>
                        <table class="min-w-full bordered text-left border-collapse block table overflow-y-scroll gap-x-3 p-3">
                                        <thead class="block table-header-group">
                                            <tr class="block table-row  text-black">
                                                <th style="font-size:13px" class="font-semibold text-sm uppercase tracking-wider block table-cell">Subjects</th>
                                                <th style="font-size:13px" class="font-semibold text-sm uppercase tracking-wider block table-cell">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="documentDiv" class="block table-row-group">
                                        <!-- <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
                                        <td style="font-size:11px" class="block table-cell">
                                            <a class="syllabusInfo" href="syllabustracking-info.php?s='.$subject_id.'&uid='.$upload_id.'&sem='.$semester.'&sy='.$academicYear.'">
                                                <div class="flex flex-row text-justify items-center">
                                                    <i class="material-icons text-orange text-5xl mr-3">folder</i>
                                                    <div class="flex flex-col">
                                                        <p class="font-semibold text-gray-800">DCIT60A</p>
                                                        <p class="text-gray-500">Methods of Research</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="p-3 block table-cell">
                                        <i class="material-icons text-white bg-green-400 rounded-full p-1">task_alt</i>
                                        </td>
                                    </tr>    -->
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
                 

                  
                </div>

                <h1 class="text-sm text-gray-400 font-bold mt-3 col-span-2">DEPARTMENTS</h1>
                <div class="grid  lg:grid-cols-4 md:grid-cols-4  gap-x-5 gap-y-2 p-4">


                    <?php 
                    $rows = $db->getAllRowsFromTable('department_details');

                    foreach ($rows as $row) {
                        $id = $row['id'];
                        $department_name = $row['department_name'];
                        $department_secretary = $row['department_secretary'];
                        $department_dean = $row['department_dean'];
                        $secretary_image = ($db->getIdByColumnValue("user_details",'user_id',$department_secretary,'image')) ?? 'default.png';
                        $department_code = strtoupper($row['department_code']);
                        $department_image = $row['department_image'];
                        $depatment_college = $row['depatment_college'];
                        $department_dean = $row['department_dean']; 

                        if($college_id!=$depatment_college)
                        {
                            continue;
                        }


                        $not_your_department = $department_dean !=$user_id ? 'href="department-details.php?i='.$id.'"':'href="courses.php?i='.$id.'"';
                        

                        $full_name = ucwords($db->getIdByColumnValue("user_details", 'user_id', $department_secretary, 'name'));

                        $words = explode(' ', $full_name);
                        $initials = '';

                        $initials .= ucwords($words[0]);

                        $secretary_name = $initials;

                        echo '<div class="card bg-white shadow-md rounded-lg p-6 flex justify-center flex-col ">
                                    <img src="../uploads/departments/'.$department_image.'" class="max-h-full h200 rounded-lg">
                                    <div class="flex flex-row truncate md:truncate">
                                     '.$department_code.' - '.ucwords($department_name).'

                                    </div>


                                    <div class="flex flex-row items-center mt-3">
                                       <div class="x">
                                        <img src="../uploads/faculty/'.$secretary_image.'" class="mr-3 w-10 h-10 rounded-full" alt="user_image">
                                        </div>
                                        <div class="grid w-full ">
                                                <p class="text-base truncate md:truncate">'.$full_name.'</p>
                                                <p class="text-sm">Secretary</p>
                                        </div>
                                    </div>
                                    <div class="grid w-full justify-items-end mt-4">
                                            <a '.$not_your_department.'  
                                            class="bg-orange text-center  text-orange px-4 py-2 rounded-full shadow-lg 
                                                    transform transition-transform duration-200 
                                                    hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                                Open
                                            </a>
                                        </div>
                                </div>';
                        }?>

                        
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
<script>
    get_allFacultyDashboard_Complete('complete')
    get_allFacultyDashboard_Pending('pending')
    function get_allFacultyDashboard_Complete(status) {
        $.ajax({
            url: 'controller/get_all_faculty_dashboard_complete.php', // Endpoint URL
            type: 'POST', // HTTP request method
            data: {
                status: status,
            }, // Send data to the server
            success: function(response) {
                $('#table_complete').empty();
                $('#table_complete').append(response); 
                toggler()
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error); // Log any errors
            }
        });
    }
    function get_allFacultyDashboard_Pending(status) {
        $.ajax({
            url: 'controller/get_all_faculty_dashboard_pending.php', // Endpoint URL
            type: 'POST', // HTTP request method
            data: {
                status: status,
            }, // Send data to the server
            success: function(response) {
                $('#table_pending').empty();
                $('#table_pending').append(response); 
                toggler2()
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error); // Log any errors
            }
        });
    }
</script>

<script>
    // Add event listeners to all toggle buttons
    function toggler()
    {
        document.querySelectorAll(".toggle-btn").forEach(button => {
        button.addEventListener("click", function () {
            const dataCard = this.dataset.card; // Get the card ID from the clicked button

            // Find matching collapsible rows
            document.querySelectorAll(".collapse").forEach(element => {
                console.log(element.dataset.card_col)
                console.log(dataCard)
                if (element.dataset.card_col === dataCard) {
                    element.classList.toggle("hidden"); // Toggle visibility
                }
            });
        });
    });
    }
        // Add event listeners to all toggle buttons
        function toggler2()
    {
        document.querySelectorAll(".toggle-btn2").forEach(button => {
        button.addEventListener("click", function () {
            const dataCard = this.dataset.card; // Get the card ID from the clicked button

            // Find matching collapsible rows
            document.querySelectorAll(".collapse2").forEach(element => {
                console.log(element.dataset.card_col)
                console.log(dataCard)
                if (element.dataset.card_col === dataCard) {
                    element.classList.toggle("hidden"); // Toggle visibility
                }
            });
        });
    });
    }
</script>
<script>
     function getDocument(upload_id,sy_id,courses="all") {
        console.log(upload_id)
        console.log(sy_id)
        $.ajax({
            url: 'controller/get_tracking_documents.php', // Endpoint URL
            type: 'POST', // HTTP request method
            data: {
                upload_id: upload_id,
                sy_id: sy_id,
                courses: courses,
            }, // Send data to the server
            success: function(response) {
                $('#documentDiv').empty();
                $('#documentDiv').append(response); 

                $('.syllabusInfo').each(function(){
                    let href = $(this).attr('href');
                    // Use URLSearchParams to manipulate the query parameters
                    let params = new URLSearchParams(href.split('?')[1]); // Get the query string part
                    params.set('uid', upload_id); // Change the uid value to 5
                    let newHref = href.split('?')[0] + '?' + params.toString(); 
                    $(this).attr('href', newHref); // Update the href attribute with the new URL
                });


            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error); // Log any errors
            }
        });
    }
    getDocument($('#documentFilter').val(),$('#schoolYearFilter').val());

    $('#documentFilter').change(function(){
        var document = $(this).val();
        var sy = $('#schoolYearFilter').val()
        getDocument(document,sy);

    })
    $(document).on('change', '#schoolYearFilter', function() {
    
        var sy = $(this).val();
        var document = $('#documentFilter').val()
        getDocument(document,sy);
    });

</script>
