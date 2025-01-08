<?php include 'components/header.php'?>
<?php 
 $college_id = $db->getIdByColumnValue("college_officers","college_secretary_id",$_SESSION['id'],"college_id");

?>
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">


            <div class="grid grid-cols-3 items-center">
                <h1 class="text-3xl text-black pb-6 col-span-2">Departments</h1>
                
                <p class="text-sm flex justify-end items-center">
                    <button type="button" id="openModalButton"  class="bg-orange text-orange px-5 py-2 rounded-full cursor-pointer hover:opacity-75 flex items-center">
                        <i class="material-icons mr-2">add_circle</i>
                        Add Department
                    </button>
                </p>
            </div>
                
                <div class="grid lg:grid-cols-3 md:grid-cols-2  gap-x-20 gap-y-5 p-4">
                    <?php 
                    $rows = $db->getAllRowsFromTable('department_details');
                    $count = 0;
                        foreach ($rows as $row) {
                            $id = $row['id'];
                            $depatment_college = $row['depatment_college'];
                           
                            if($college_id!=$depatment_college){
                                continue;
                            }
                            $count++;
    
                            $department_name = $row['department_name'];
                            $department_secretary = $row['department_secretary'];
                            $secretary_name = ucwords($db->getIdByColumnValue("user_details",'user_id',$department_secretary,'name'));
                            $secretary_image = ($db->getIdByColumnValue("user_details",'user_id',$department_secretary,'image')) ?? 'default.png';
                            $department_code = strtoupper($row['department_code']);
                            $department_image = $row['department_image'];
                            $depatment_college = $row['depatment_college'];
                            $department_dean = $row['department_dean'];
    
                            $data='
                                data-department_name="'.$department_name.'"
                                data-department_secretary="'.$department_secretary.'"
                                data-department_code="'.$department_code.'"
                                data-department_dean="'.$department_dean.'"
                                data-id="'.$id.'"
                            ';
    
    
                            echo '<div class="card bg-white shadow-md rounded-lg p-6 flex justify-center flex-col ">
                                        <img src="../uploads/departments/'.$department_image.'" class="max-h-full h200 rounded-lg">
                                        <div class="flex flex-row justify-between  mt-2">
                                        '.$department_code.' - '.ucwords($department_name).'
    
                                        <div class="relative inline-block text-left">
                                                    <div>
                                                        <i class="option_download material-icons bg-orange  cursor-pointer hover:opacity-50 rounded-full " data-id="'.$id.'">more_horiz</i>
                                                    </div>
                                                    <div class="absolute right-0 z-10 mt-0 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none option_download_content option_download_content_'.$id.'"
                                                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                                        
                                                    
                                                    <div class="py-1" role="none">
    
                                                        <a href="#" '.$data.' class="editBtnDepartment block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Edit</a>
                                                        <a href="#" '.$data.' class="deleteBtnDepartment block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
    
    
                                        <div class="flex flex-row items-center mt-3">
                                           <div class="x">
                                        <img src="../uploads/faculty/'.$secretary_image.'" class="mr-3 w-10 h-10 rounded-full" alt="user_image">
                                        </div>
                                            <div class="grid w-full ">
                                                <p class="text-base">'.$secretary_name.'</p>
                                                <p class="text-sm">Secretary</p>
                                            </div>
                                        </div>
                                        <div class="grid w-full justify-items-end">
                                            <a href="courses.php?i='.$id.'"  
                                            class="bg-orange text-center  text-orange px-4 py-2 rounded-full shadow-lg 
                                                    transform transition-transform duration-200 
                                                    hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                                Open
                                            </a>
                                        </div>
                                    </div>';
                        }

                        if($count==0){
                            echo 'No added Department yet';
                        }
                    
                    ?>
                    </div>
                    
                </div>
                
            </main>
    
        </div>
        
    </div>

<?php include 'components/footer.php'?>
<script>
     $('.departments').addClass('active-nav-link');
     $('.departments').removeClass('opacity-75');
</script>

<script>
    $(document).ready(function() {
            $('.origin-top-right').toggle();
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
<?php include 'modal/modal-departments.php' ?>
<?php include 'modal/modal.php' ?>
<script>
    $('.deleteBtnDepartment').on('click', function(){
        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: 'controller/delete_departments.php', // Replace with your server endpoint URL
                type: 'POST', // Use 'GET' or 'POST' depending on your server setup
                data: {mode:'Delete',id:id},
                success: function(response) {
                    // Call your custom alert maker function
                    alertMaker(response);
                },
                error: function(xhr, status, error) {
                    // Handle errors if the request fails
                    console.error('Error submitting form:', error);
                }
            });

            }
        });
    });


</script>