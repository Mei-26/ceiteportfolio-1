<?php include 'components/header.php'?>
<?php 
$semAndSchoolYearRows = $db->getSemAndSchoolyears($my_college_id);
?>
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
           
            <div class="container flex items-center mb-6">
            <h1 class="text-3xl text-black mr-3">Subjects</h1>

            <select  id="schoolyearFilter" class="px-3 py-2 rounded-lg bg-orange text-orange border ">
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
                         <div id="subjectDiv" class="grid lg:grid-cols-2 md:grid-cols-2  gap-x-5 gap-y-2 p-4"></div>
                         <div class="grid grid-cols-1">
                        <div>
                            <div class=" flex items-center mb-6 col-span-2 ">
                                <h1 class="text-sm text-gray-400 font-bold mr-3">DOCUMENT TRACKING</h1>
                            </div>

                            <div class="container">
                                <div class="container pt-2">
                                    <table class="min-w-full text-left border-collapse block table overflow-y-scroll">
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
                
            </main>
    
        </div>
        
    </div>

<?php include 'components/footer.php'?>
<script>
     $('.documents').addClass('active-nav-link');
     $('.documents').removeClass('opacity-75');
</script>

<script>
    var schoolyear = $('#schoolyearFilter').val()
    $('#schoolyearFilter').change(function(){
        getSubjects($(this).val());
        getDocument($(this).val())

    })
    getSubjects(schoolyear);
     function getSubjects(schoolyear) {
        $.ajax({
            url: 'controller/get_subjects.php', // Endpoint URL
            type: 'POST', // HTTP request method
            data: {
                schoolyear: schoolyear
            }, // Send data to the server
            success: function(response) {
                $('#subjectDiv').empty();
                $('#subjectDiv').append(response); 
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error); // Log any errors
            }
        });
    }
    getDocument(schoolyear)
    function getDocument(sy_id) {
        console.log(sy_id)
        $.ajax({
            url: 'controller/get_status_documents.php', // Endpoint URL
            type: 'POST', // HTTP request method
            data: {
                sy_id: sy_id,
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
</script>