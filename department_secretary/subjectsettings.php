<?php include 'components/header.php'?>
<?php 


    $title="Subject Settings";
     $_SESSION['dashboard'] = '<a href="subjectsettings.php"  class="mr-3">'.$title.'</a> ';
     $row_Courses = $db->getAllCourseByDepartment($my_department_id);

?>
    
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col ">
            <main class="w-full flex-grow p-6 ">
                
            <div class="container  flex text-orange mb-3">
                    <?=$title?>
                    </div>
                <div class="grid grid-cols-3 items-center">
                    <h1 class="text-3xl text-black pb-2 col-span-2"><?=$title?></h1>
                </div>
                <?php 
                if($my_department_id !="")
                {
                  echo '<p class="text-sm flex justify-end items-center">
                    <button type="button" id="openModalButton1"  class="bg-orange text-orange px-5 py-2 rounded-full cursor-pointer hover:opacity-75 flex items-center">
                        <i class="material-icons mr-2">add_circle</i>
                        Add Sections
                    </button>
                </p>';
                }
                ?>

                
                <div class="grid lg:grid-cols-2 md:grid-cols-1 gap-x-5 gap-y-5 p-4">
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


                <div class="grid lg:grid-cols-2 md:grid-cols-2 gap-x-5 gap-y-5">

                <?php 
                        $rows = $db->getSubjectsByDepartments($my_department_id);
                        if (count($rows) > 0) {
                            foreach ($rows as $row) {

                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $image = $row['image'];
                                $secretary_id = $row['secretary_id'];
                                $course_id = $row['course_id'];

                                $data = '
                                data-id="'.$id.'"
                                data-name="'.$name.'"
                                data-code="'.$code.'"
                                ';

                                $secretary_image = ucwords($db->getIdByColumnValue("user_details","user_id",$secretary_id,"image"));
                                $secretary_name = ucwords($db->getIdByColumnValue("user_details","user_id",$secretary_id,"name"));

                                echo '<div data-course="'.$course_id.'" class="card bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                                <img src="../uploads/subjects/'.$image.'" class="max-h-full h200 rounded-lg">
                                <div class="flex flex-row items-center mt-2 w-full justify-between">
                                    
                                <div class="flex flex-row items-center mt-3 w-full">
                                    
                                    <div class="grid w-full">
                                        <p class="text-base trucate md:truncate">'.$name.'</p>
                                        <p class="text-sm">'.$code.'</p>
                                
                                        </div>
                                </div>
                                
                                   
                                </div>
                               
                                <div class="grid w-full justify-items-end mt-2">
                                            <a href="subject-add-faculty.php?s='.$id.'"  
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

                <div class="grid grid-cols-1 overflow-y-scroll "style="height: 600px;" >
                        <div>
                            <div class="container">
                                <div class="container pt-2">
                                    <table class="min-w-full text-center border-collapse block table overflow-y-scroll">
                                        <thead class="block table-header-group">
                                            <tr class="block table-row bg-orange text-black">
                                                <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Sections</th>
                                                <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sectionDiv" class="block table-row-group">
                                               
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
     $('.subjectsettings').addClass('active-nav-link');
     $('.subjectsettings').removeClass('opacity-75');
</script>
<?php include 'modal/modal-section.php' ?>
<?php include 'modal/modal.php' ?>
<script>
     $('#openModalButton1').click(function() {
        $('.alert-delete').hide()
        $('.form_modal').show()
        $('#modalSection').removeClass('hidden')
                    .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation
        $('#modalSection input:not(#edit_id), #modalSection select').val("");
        $('.sectionText').text('Add Section')
        $('#submitSection').text('Add')
        $('#modalSection > div').css('animation', 'modal-fade-in 0.3s forwards'); // Scale animation
    });
</script>

<script>
$(document).ready(function () {
  var $modal = $('#modalSection');
  var $modalContent = $modal.find('.bg-white');


  // Close modal button event listener
  $('#closeModalButton').on('click', function () {
    $modal.addClass('hidden');
  });
});
</script>

<script>
    
</script>




<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-4">Edit Section</h2>
        <input type="hidden" id="editSectionId">
        <div class="mb-4">
            <label for="editSectionName" class="block text-sm font-medium text-gray-700">Section Name</label>
            <input type="text" id="editSectionName" class="w-full border border-gray-300 p-2 rounded mt-1">
        </div>
        <div class="mb-4">
            <label for="editYearLevel" class="block text-sm font-medium text-gray-700">Year Level</label>
            <select name="sectionYearLevel" id="editYearLevel" class="w-full border border-gray-300 p-2 rounded mt-1">
                <option value="">Select Year Level</option>
                <option value="1st Year">1st Year</option>
                <option value="2nd Year">2nd Year</option>
                <option value="3rd Year">3rd Year</option>
                <option value="4th Year">4th Year</option>
                <option value="5th Year">5th Year</option>
                <option value="6th Year">6th Year</option>
            </select>
            
        </div>
        <div class="flex justify-end space-x-2">
            <button onclick="closeModal('editModal')" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
            <button onclick="updateSection()" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-4">Delete Section</h2>
        <p>Are you sure you want to delete this section?</p>
        <input type="hidden" id="deleteSectionId">
        <div class="flex justify-end space-x-2 mt-4">
            <button onclick="closeModal('deleteModal')" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
            <button onclick="deleteSection()" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
        </div>
    </div>
</div>

<script>
    // Function to handle the dropdown selection
    function handleAction(select, id, name, yearlevel) {
        if (select.value === 'edit') {
            openEditModal(id, name, yearlevel);
        } else if (select.value === 'delete') {
            openDeleteModal(id);
        }
        select.value = ''; // Reset dropdown
    }

    // Open the Edit Modal and populate with section data
    function openEditModal(id, name, yearlevel) {
        document.getElementById('editSectionId').value = id;
        document.getElementById('editSectionName').value = name;
        document.getElementById('editYearLevel').value = yearlevel;
        document.getElementById('editModal').classList.remove('hidden');
    }

    // Open the Delete Modal
    function openDeleteModal(id) {
        document.getElementById('deleteSectionId').value = id;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    // Close modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // AJAX request to update section data
    function updateSection() {
        const id = document.getElementById('editSectionId').value;
        const name = document.getElementById('editSectionName').value;
        const yearlevel = document.getElementById('editYearLevel').value;

        $.ajax({
            url: 'controller/update_section.php',
            type: 'POST',
            data: { id: id, name: name, yearlevel: yearlevel },
            success: function(response) {
                if(response=="200")
                {
                    Swal.fire(
                                'Success!',
                                'The section has been updated.',
                                'success'
                            ).then(() => {
                                location.reload(); // Refresh the page to see updated data
                            });
                }else{
                    Swal.fire(
                            'Error!',
                             'There was a problem updating the section.',
                            'error'
                        );
                }
            },
            error: function(xhr, status, error) {
                alert('Error updating section');
            }
        });
    }

    // AJAX request to delete section
    function deleteSection() {
        const id = document.getElementById('deleteSectionId').value;

        $.ajax({
            url: 'controller/delete_section.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if(response=="200")
                {
                    Swal.fire(
                                'Success!',
                                'The section has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload(); // Refresh the page to see updated data
                            });
                }else{
                    Swal.fire(
                            'Error!',
                             'There was a problem deleting the section.',
                            'error'
                        );
                }
            },
            error: function(xhr, status, error) {
                alert('Error deleting section');
            }
        });
    }
</script>



<script>
    $.ajax({
            url: 'controller/get_sections.php', // Endpoint URL
            success: function(response) {
                $('#sectionDiv').empty();
                $('#sectionDiv').append(response); 
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error); // Log any errors
            }
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