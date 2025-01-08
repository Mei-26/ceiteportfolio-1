<?php include 'components/header.php'?>
<?php 
unset($_SESSION['dashboard']);
$_SESSION['root']="Documents";
$user_id = $_SESSION['id'];
$department_id = $db->getIdByColumnValue("department_details","department_dean",$user_id,"id");
$rows = $db->getAllSubjectsbyDepartment($department_id);
$row_Courses = $db->getAllCourseByDepartment($department_id);
$semAndSchoolYearRows = $db->getSemAndSchoolyears($my_college_id);

?>
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">


            <div class="container flex items-center mb-6">
            <h1 class="text-3xl text-black mr-3">Documents</h1>
            <select id="schoolYearFilter" class="px-3 py-2 rounded-lg bg-orange text-orange border ">
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

          
                <div class="grid  sm:grid-cols-2">

                <select id="courseFilter" class="px-3 py-2 rounded-lg w-1/5 col-span-2 bg-orange text-orange border ">
                    <?php
                            if(count($row_Courses)>0)
                            {
                                echo '<option value="">Select Course</option>';
                                foreach ($row_Courses as $row) {
                                    $semester = $row['current_sem'];
                                    $course_id = $row['id'];
                                    $course_name = $row['name'];
                                    echo '<option value="'.$course_id.'">'.$course_name.'</option>';
                                } 
                            }else{
                                echo '<option  value="">No added Courses';
                            }
                            ?>
                    </select>
                    <div class="grid lg:grid-cols-2 md:grid-cols-1  gap-x-5 gap-y-2 p-4">

                 <h1 class="text-sm text-gray-400 font-bold pb-6 col-span-2">SUBJECTS</h1>
                
                 <?php 
                 if(count($rows)>0) {
                    foreach ($rows as $row) {
                        $subject_id = $row['id'];
                        $image = $row['image'];
                        $code = $row['code'];
                        $name = $row['name'];
                        $course_id = $row['course_id'];
                    
                        echo '
                        <div data-course="'.$course_id.'" class="card bg-white shadow-md flex flex-col rounded-lg p-6">
                            <div class="flex justify-center sm:justify-center md:justify-center">
                                   <img src="../uploads/subjects/' . htmlspecialchars($image) . '" alt="Image of ' . htmlspecialchars($name) . '" class="max-h-full h200 rounded-lg mb-3" >
                            </div>   
                            <p>Subject Name: <span class="font-bold">' . htmlspecialchars(ucwords($name)) . '</span></p>
                            <p>Subject Code: <span class="font-bold">' . htmlspecialchars(strtoupper($code)) . '</span></p>
                            <div class="flex-grow"></div>
                            <div class="flex justify-end mt-3">
                                <a href="documents-research.php?s=' . $subject_id . '" class="bg-orange text-center text-orange px-4 py-2 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 hover:shadow-xl hover:bg-orange-600">Open</a>
                            </div>
                        </div>
                    ';
                      
            }
                 }else{
                    echo '
                        <div class="card  bg-white shadow-md flex col-span-2 rounded-lg p-6">
                            
                            <p>No data.</p>
                          
                        </div>
                    ';
                 }
                 ?>
                       
                        
                    </div>

                    
                    <div class="grid grid-cols-1">
                        <div>
                            <div class=" flex items-center justify-end mb-6 col-span-2">
                                <h1 class="text-sm text-gray-400 font-bold mr-3">DOCUMENT TRACKING</h1>
                                <select id="documentFilter" class="px-3 py-2 rounded-lg bg-orange text-orange border ">
                                    <?php 
                                    $rows = $db->getAllRowsFromTable("for_uploads");

                                    foreach ($rows as $row) {
                                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                    }
                                    ?>
                                    
                                </select>
                            </div>

                            <div class="container mx-auto">
                                <div class="container pt-2">
                                    <div class="p-4 rounded-lg">
                                        <div class="overflow-y-auto max-h-96">
                                            <table class="min-w-full text-left border-collapse">
                                        <thead class="block table-header-group">
                                            <tr class="block table-row bg-orange text-black">
                                                <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Subjects</th>
                                                <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="documentDiv" class="block table-row-group">
                                               
                                        </tbody>
                                    </table>
                                   </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
            </main>
    
        </div>
        
    </div>

<?php include 'components/footer.php'?>
<script>
     $('.documents').addClass('active-nav-link');
     $('.documents').removeClass('opacity-75');
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
                courses:courses,
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
    $(document).on('change', '#courseFilter', function() {
    var course_id = $(this).val();
    var sy = $('#schoolYearFilter').val()
    var document = $('#documentFilter').val()
    getDocument(document,sy,course_id);
    });
    
</script>
<script>
    $('#courseFilter').change(function(){
        var course = ($(this).val())

        $('.card').each(function(){
            var card_course = ($(this).data('course'))

            if(course==card_course)
            {
                $(this).show();
            }else if(course==""){
                $(this).show();
            }else{
                $(this).hide();
            }
        })
    })
</script>