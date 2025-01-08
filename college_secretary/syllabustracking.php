<?php include 'components/header.php'?>
<?php 
unset($_SESSION['dashboard']);
$_SESSION['root']="Documents";
$user_id = $_SESSION['id'];
$college_id = $db->getIdByColumnValue("college_officers","college_secretary_id",$user_id,"college_id");
$rows = $db->getAllSubjectsbyCollege($college_id);
$semAndSchoolYearRows = $db->getSemAndSchoolyears($college_id);
?>
<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
        <div class="container flex items-center mb-6">
            <h1 class="text-3xl text-black mr-3">Syllabus Acceptance</h1>
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

        <div class="w-full flex-grow p-6">
            <div class="">
                <div class="container flex mb-4 items-center">
                <h1 class="text-sm text-gray-400 font-bold mr-3">DOCUMENT TRACKING</h1>
                    <select id="documentFilter" class="px-3 py-2 text-base rounded-lg bg-orange text-orange border">
                        <?php 
                        $rows = $db->getAllRowsFromTable("department_details");
                        foreach ($rows as $row) {

                            $department_id = $row['id'];
                            $department_name = $row['department_name'];
                            $department_code = $row['department_code'];
                            $course_rows = $db->getAllRowsFromTableWhere("course",["department_id=".$department_id]);

                            foreach ($course_rows as $course_row) {
                                # code...
                                $course_id = $course_row['id'];
                                $course_name = $course_row['name'];
                                $course_id = $course_row['id'];
                                echo '<option value="'.$course_id.'">'.$department_code.'-'.$course_name.'</option>';
                            }

                                // echo '<option value="'.$row['id'].'">'.$row['department_code'].'-'.$row['department_name'].'</option>';
                        }
                        ?>      
                    </select>
                </div>
            </div>
            <div>
            </div>
        </div>
        <div class="container p-4">
            <table class="min-w-full text-left border-collapse block table overflow-y-scroll">
                <thead class="block table-header-group">
                    <tr class="block table-row bg-orange text-black">
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Subjects</th>
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Status</th>
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Date Modified</th>
                    </tr>
                </thead>
                <tbody id="documentDiv" class="block table-row-group">
                        
                </tbody>
            </table>
        </div>
    </main>
</div>

<?php include 'components/footer.php' ?>
<script>
    $('.syllabustracking').addClass('active-nav-link');
    $('.syllabustracking').removeClass('opacity-75');
</script>
<script>
     function getDocument(upload_id) {
        var sy_id = $('#schoolYearFilter').val();
        $.ajax({
            url: 'controller/get_syllabus.php', // Endpoint URL
            type: 'POST', // HTTP request method
            data: {
                upload_id: upload_id,
                sy_id: sy_id,
            }, // Send data to the server
            success: function(response) {
                $('#documentDiv').empty();
                $('#documentDiv').append(response); 

                // $('.syllabusInfo').each(function(){
                //     let href = $(this).attr('href');
                //     // Use URLSearchParams to manipulate the query parameters
                //     let params = new URLSearchParams(href.split('?')[1]); // Get the query string part
                //     params.set('uid', upload_id); // Change the uid value to 5
                //     let newHref = href.split('?')[0] + '?' + params.toString(); 
                //     $(this).attr('href', newHref); // Update the href attribute with the new URL
                // });


            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error); // Log any errors
            }
        });
    }
    getDocument($('#documentFilter').val());

    $('#documentFilter').change(function(){
        var document = $(this).val();
        getDocument(document);

    })
</script>

<script>
    $('#schoolYearFilter').change(function(){
        getDocument($('#documentFilter').val())
    })
</script>
