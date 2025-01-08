<?php include 'components/header.php'?>
<?php 

    if(isset($_GET['c']) && $_GET['c']!="")
    {
        $id =  preg_replace('/\D/', '', $_GET['c']);
        if($db->getIdByColumnValue("course","id",$id,'id')=="")
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

    $department_id = ucwords($db->getIdByColumnValue("course","id",$id,"department_id"));
    $department_name = ucwords($db->getIdByColumnValue("department_details","id",$department_id,"department_name")).' Courses';
    $course_name = ucwords($db->getIdByColumnValue("course","id",$id,"name")).' Subjects';

    $title = '
        <a href="dashboard.php" class="mr-3">Dashboard</a>
        <p class="mr-3">></p>
        <a href="courses.php?i='.$department_id.'" class="mr-3">' . htmlspecialchars($department_name, ENT_QUOTES, 'UTF-8') . '</a> 
        <a class="mr-3">></a>
        <a href="subjects.php?c='.$id.'" class="mr-3">' . htmlspecialchars($course_name, ENT_QUOTES, 'UTF-8') . '</a>
    ';
    $_SESSION['dashboard']=$title;

?>
    
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                
                <div class="container flex text-orange mb-3">
                <?=$title?>
                </div>

                <div class="grid grid-cols-3 items-center">
                    <h1 class="text-3xl text-black pb-6 col-span-2"><?=$course_name?></h1>
                    
                    <p class="text-sm flex justify-end items-center">
                        <button type="button" id="openModalButton" class="bg-orange text-orange px-5 py-2 rounded-full cursor-pointer hover:opacity-75 flex items-center">
                            <i class="material-icons mr-2">add_circle</i>
                            Add Subjects
                        </button>
                    </p>

                </div>

                
                <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-x-20 gap-y-5 p-4">
                    <?php 
                        $rows = $db->getAllRowsFromTableWhere("subject",["course_id=".$_GET['c']]);
                        if (count($rows) > 0) {
                            foreach ($rows as $row) {

                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $image = $row['image'];
                                $secretary_id = $row['secretary_id'];

                                $data = '
                                data-id="'.$id.'"
                                data-name="'.$name.'"
                                data-code="'.$code.'"
                                ';

                                $secretary_image = ucwords($db->getIdByColumnValue("user_details","user_id",$secretary_id,"image"));
                                $secretary_name = ucwords($db->getIdByColumnValue("user_details","user_id",$secretary_id,"name"));

                                echo '<div class="card bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                                <img src="../uploads/subjects/'.$image.'" class="max-h-full h200 rounded-lg">
                                <div class="flex flex-row items-center mt-2 w-full justify-between">
                                    <span class="truncate md:truncate">'.$code.' - '.$name.'</span>
                                
                                    <div class="relative inline-block text-left">
                                        <i class="option_download material-icons bg-orange cursor-pointer hover:opacity-50 rounded-full" data-id="'.$id.'">more_horiz</i>
                                        
                                        <div class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 hidden option_download_content option_download_content_'.$id.'"
                                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                            <div class="py-1" role="none">
                                                <a href="#" '.$data.' class="editBtnSubject block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Edit</a>
                                            </div>
                                            <div class="py-1" role="none">
                                                <a href="#" '.$data.' class="deleteBtnSubject block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-row items-center mt-3 w-full">
                                   <div class="x">
                                        <img src="../uploads/faculty/'.$secretary_image.'" class="mr-3 w-10 h-10 rounded-full" alt="user_image">
                                        </div>
                                    <div class="grid w-full">
                                        <p class="text-base">'.$secretary_name.'</p>
                                        <p class="text-sm">Secretary</p>
                                
                                        </div>
                                </div>
                                <div class="grid w-full justify-items-end">
                                            <a href="documents-research.php?s='.$id.'"  
                                            class="bg-orange text-center  text-orange px-4 py-2 rounded-full shadow-lg 
                                                    transform transition-transform duration-200 
                                                    hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                                Open
                                            </a>
                                        </div>
                            </div>';
                            }
                        } else {
                            echo '<p class="text-gray-500">No subjects added yet.</p>';
                        }
                    ?>
                </div>

                
            </main>
    
        </div>
        
    </div>
<?php include 'modal/modal-subjects.php' ?>
<?php include 'components/footer.php'?>
<script>
     $('.delete-alert').hide()
     $('.dashboard').addClass('active-nav-link');
     $('.dashboard').removeClass('opacity-75');
</script>
<script>
    $(document).ready(function() {
            // Toggle visibility when clicking the button
            $('.option_download').click(function(event) {
                var id = $(this).data('id');
                $('.option_download_content_'+id).toggle();
                // Stop event from bubbling up to document
                event.stopPropagation();
            });

            // Hide the content when clicking outside
            $(document).click(function(event) {
                var target = $(event.target);
                // Check if the click target is outside the content
                if (!target.closest('.option_download_content').length && !target.is('.option_download')) {
                    $('.option_download_content').hide();
                }
            });
        });
</script>


<script>
    $('.delete-alert').hide()
    $('.editBtnSubject').click(function(){
        $('.option_download_content').hide();
        $('#subjectForm .editForm').show()
        $('.delete-alert').hide()
        $('#modal').removeClass('hidden')
          .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation
          $('#modal > div').css('animation', 'modal-fade-in 0.3s forwards');
          $('#modalText').text("Edit Subject");

         $('#edit_id').val($(this).data('id'));
         $('#subjectName').val($(this).data('name'));
         $('#subjectCode').val($(this).data('code'));
         $('#submitSubject').text('Edit');
    })

    $('.deleteBtnSubject').click(function(){
        $('.option_download_content').hide();
        $('.delete-alert').show()
        $('#subjectForm .editForm').hide()
        $('#modal').removeClass('hidden')
          .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation
          $('#modal > div').css('animation', 'modal-fade-in 0.3s forwards');
          $('#modalText').text("Delete Course");

         $('#edit_id').val($(this).data('id'));
         $('#submitSubject').text('Delete');
    })
    $('#openModalButton').click(function(){
        $('.delete-alert').hide()
        $('#modalText').text("Add Course");
        $('#subjectForm .editForm').show()
        $('#submitSubject').text('Add');
    })
</script>