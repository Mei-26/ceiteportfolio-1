<?php include 'components/header.php' ?>
<?php 
    if (isset($_GET['s']) && $_GET['s'] != "") {
        $id = preg_replace('/\D/', '', $_GET['s']);

        $subject_id_link = $id;

        if ($db->getIdByColumnValue("subject", "id", $id, 'id') == "") {
            echo '<script>window.location.href="dashboard.php"</script>';
        }
    } else {
        echo '<script>window.location.href="dashboard.php"</script>';
    }
    $subject_name = ucwords($db->getIdByColumnValue("subject", "id", $id, "name"));
    $subject_code = $db->getIdByColumnValue("subject", "id", $id, "code");

    $sectionRows = $db->getAllFacultySectionsBySubjectID($id);
    $semAndSchoolYearRows = $db->getSemAndSchoolyears($my_college_id);
   
 
   
    $title = $_SESSION['dashboard'] . '
        <p class="mr-3">></p>
        <p class="mr-3">' . htmlspecialchars($subject_name, ENT_QUOTES, 'UTF-8') . '</p>';
?>
<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
        
        <div class="container flex items-center text-orange mb-3 space-x-3">
            <p><?= $title ?></p> 
        </div>
        
        <div class="grid grid-cols-3 items-center mb-6">
            <h1 class="text-3xl font-semibold text-black col-span-2"><?= $subject_name ?></h1>
        </div>

        <div class="flex items-center justify-center bg-gray-100">
        <div class="card bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Add Section to Faculty</h3>

            <div class="space-y-4">
                <div>
                    <label for="faculty" class="block text-sm font-medium text-gray-600">Faculty Member</label>
                    <input type="text" value="<?=$id ?>" id="subject_id" hidden>
                    <select id="faculty" name="faculty" class="w-full mt-1 border border-gray-300 rounded-md p-2 bg-gray-50 focus:ring-orange-500 focus:border-orange-500">
                        <option value="">Select Faculty Member</option>
                        <?php 

                        $rows = $db->getAllFaculties();
                        $count=0;
                        foreach ($rows as $row) {


                            
                            $id = $row['id'];
                            $name = $row['name'];
                            $college_id =  $db->getIdByColumnValue('college_user_added','user_id',$id,'college_id');
                            $department_id =  $db->getIdByColumnValue('department_faculty','faculty_id',$id,'department_id');

                            if($college_id !=$my_college_id || $department_id != $my_department_id)
                            {
                                continue;
                            }
                            else{
                                echo '<option value="'.$id.'">'.$name.'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label for="section-name" class="block text-sm font-medium text-gray-600">Section Name</label>
                    
                    <?php 
                    $user_id = $_SESSION['id'];
                    $department_id = $db->getIdByColumnValue("department_details", "department_secretary", $user_id, 'id');
                    $rows = $db->getAllSections($department_id);
                ?>

                <!-- Select dropdown for section name -->
                <select id="section-name" multiple="multiple"  name="section[]" class="w-full mt-1 border border-gray-300 rounded-md p-2 bg-gray-50 focus:ring-orange-500 focus:border-orange-500">
                    <?php
                        if(count($rows) > 0) {
                            foreach ($rows as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                echo "<option value='$id'>$name</option>";
                            }
                        }
                    ?>
                </select>


                </div>


                <div>
                    
                    <button id="addFaculty"  class="bg-orange text-center  text-orange px-1 py-2 rounded-full shadow-lg w-full transform transition-transform duration-200 
                                                        hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                        Add
                    </button>
                </div>
            </div>

        </div>
        </div>

        <div class="flex items-center justify-center bg-gray-100 mt-3">
    <div class="card bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Faculty Member Section</h3>

        <div class="space-y-4">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden">
                <thead>
                    <tr class="text-black">
                        <th class="p-3 text-sm font-semibold uppercase tracking-wide text-left">Faculty</th>
                        <th class="p-3 text-sm font-semibold uppercase tracking-wide text-left">Section</th>
                        <th class="p-3 text-sm font-semibold uppercase tracking-wide text-left">Subject</th>
                        <th class="p-3 text-sm font-semibold uppercase tracking-wide text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php 
                        $rows = $db->getfaculty_subject_section_by_department($my_department_id,$subject_id_link,$currentYear,$currentSem);

                        if ($rows && count($rows) > 0) {
                            foreach ($rows as $row) {
                                $id = htmlspecialchars($row['id']);
                                $faculty_id = htmlspecialchars($row['faculty_id']);
                                $section_id = htmlspecialchars($row['section_id']);
                                $subject_id = htmlspecialchars($row['subject_id']);


                                $name = $db->getIdByColumnValue('user_details','user_id',$faculty_id,'name');
                                $section = $db->getIdByColumnValue('deparment_section','id',$section_id,'name');
                                $subject = $db->getIdByColumnValue('subject','id',$subject_id,'name');

                                echo '
                                <tr class="border-t border-gray-300 hover:bg-gray-100 transition">
                                    <td class="p-3 text-sm">'.$name.'</td>
                                    <td class="p-3 text-sm">'.$section.'</td>
                                    <td class="p-3 text-sm">'.$subject.'</td>
                                    <td class="p-3 text-sm">
                                        <button onclick="confirmDelete('.$id.')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="4" class="p-3 text-center text-gray-500">No data available</td>
                            </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Function to show the SweetAlert confirmation
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Call the delete function or send an AJAX request to delete the entry
                $.ajax({
                    url: 'controller/subject_faculty_delete.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'The entry has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to reflect changes
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'There was a problem deleting the entry.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>



</div>

    </main>
</div>
<?php include 'components/footer.php' ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
<!-- Initialize Select2 on the dropdown -->
<script>
    $(document).ready(function() {
        $('#section-name').select2({
            placeholder: 'Select or search a section',
            allowClear: true
        });
    });
</script>

<script>
    $('.subjectsettings').addClass('active-nav-link');
    $('.subjectsettings').removeClass('opacity-75');
</script>

<script>
    $('#addFaculty').click(function() {
    var section = $('#section-name').val();  // This will be an array of selected section IDs
    var faculty = $('#faculty').val();
    var subject_id = $('#subject_id').val();
    
    // Check if all fields are completed
    if (!section || !faculty || !subject_id) {
        Swal.fire({
            title: "Oops..! ",
            text: "Please complete all required fields.",
            icon: "info"
        });
    } else {
        // AJAX request to send data to the server
        $.ajax({
            url: 'controller/subject-faculty.php', // URL to the server-side script
            type: 'POST',
            data: {
                'section[]': section,  // Use 'section[]' to ensure it's recognized as an array
                faculty: faculty,
                subject_id: subject_id
            },
            traditional: true,  // This setting ensures arrays are sent as individual items, like section[]=1&section[]=2
            success: function(response) {
                if(response=="200")
                {
                    Swal.fire(
                                'Success!',
                                'Added Successfully.',
                                'success'
                            ).then(() => {
                                location.reload(); // Refresh the page to see updated data
                            });
                }else{
                    Swal.fire(
                            'Error!',
                             'There was a problem adding the section.',
                            'error'
                        );
                }
            },
            error: function() {
                Swal.fire({
                    title: "Error!",
                    text: "An unexpected error occurred.",
                    icon: "error"
                });
            }
        });
    }
});

</script>