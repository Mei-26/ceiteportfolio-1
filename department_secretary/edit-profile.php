<?php include 'components/header.php'?>
<?php 
$user_id = $_SESSION['id'];
$full_name = ucwords($db->getIdByColumnValue("user_details","user_id",$user_id,"name")) ?? "";
$specialization = ucwords($db->getIdByColumnValue("user_details","user_id",$user_id,"specialization")) ?? "";
$contacts = ucwords($db->getIdByColumnValue("user_details","user_id",$user_id,"phone")) ?? "";

$rows = $db->getAllRowsFromTableWhere("faculty_subject",['faculty_id='.$user_id]);


if(count($rows)==0)
{
    $add_subjectBtn = '
    <button type="button" id="openModalButton" class="bg-orange text-orange text-sm px-5 py-2 rounded-full cursor-pointer hover:opacity-75 flex items-center">
        <i class="material-icons mr-2">add_circle</i>
        Add Subject
    </button>';
}else{
    $add_subjectBtn = '
    <button type="button" id="openModalButton" class="editBtnSubject bg-orange text-orange text-sm px-5 py-2 rounded-full cursor-pointer hover:opacity-75 flex items-center">
        <i class="material-icons mr-2">edit</i>
        Edit Subject
    </button>';
}

// Fetch file details
$file_id = $db->getIdByColumnValue("resume_upload", "faculty_id", $user_id, "file");
$file_type = $db->getIdByColumnValue("resume_upload", "faculty_id", $user_id, "file_type");

$file_object = "";

// Define the upload directory
$uploadDir = '../uploads/resume/';
$filePath = $uploadDir . $file_id;

if ($file_id && file_exists($filePath)) {
    // Determine if the file is viewable in the browser
    if (in_array($file_type, ['application/pdf', 'image/jpeg', 'image/png', 'image/gif'])) {
        // Use iframe or embed to display the file
        if ($file_type === 'application/pdf') {
            // PDF can be viewed with the embed tag
            $file_object = '<embed src="' . htmlspecialchars($filePath) . '" type="application/pdf" style="width:100%; height:500px; max-height: 80vh;" />';
        } elseif (in_array($file_type, ['image/jpeg', 'image/png', 'image/gif'])) {
            // Images can be displayed directly
            $file_object = '<img src="' . htmlspecialchars($filePath) . '" style="width:100%; height:500px; max-height: 80vh; object-fit: contain;" />';
        }
    } else {
        // Provide a download link for other file types
        $file_object = '<a href="' . htmlspecialchars($filePath) . '" download class="bg-green-700  text-white px-4 py-2 rounded">Download Resume</a>';
    }
} else {
    $file_object = 'No resume uploaded or file not found.';
}
?>
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Profile</h1>

               
                <div class="flex flex-col md:flex-row  bg-white rounded-lg p-3">
                <div class="container mx-3 p-2 bg-white">
                   

                    <div class="flex flex-col md:flex-row bg-white rounded-lg p-3">
    <!-- Profile Image -->
    <div class="relative">
        <img id="profileImagePreview" src="<?=$src?>" style="width: 150px;" class="rounded-lg text-center md:h-32 h-100">
        <label for="profileImage" class="cursor-pointer absolute bottom-0 right-0 bg-green-700  text-white p-2 rounded-full">
            <i class="material-icons">edit</i>
        </label>
        <input type="file" id="profileImage" class="hidden" accept="image/*">
    </div>

    <!-- Profile Details -->
    <div class="container mx-3 p-2 bg-white">
        <!-- Full Name -->
        <div class="flex flex-col lg:flex-row">
            <div class="lg:w-1/5 font-semibold">Full Name:</div>
            <div class="lg:w-4/5 font-normal">
                <input type="text" id="full_name" class="w-1/2 my-1 px-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" value="<?=$full_name?>">
            </div>
        </div>
        <!-- Specialization -->
        <div class="flex flex-col lg:flex-row">
            <div class="lg:w-1/5 font-semibold">Specialization:</div>
            <div class="lg:w-4/5 font-normal">
                <input type="text" id="specialization" class="w-1/2 my-1 px-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" value="<?=$specialization?>">
            </div>
        </div>
        <!-- Contacts -->
        <div class="flex flex-col lg:flex-row">
            <div class="lg:w-1/5 font-semibold">Contacts:</div>
            <div class="lg:w-4/5 font-normal">
                <input type="text" id="contacts" class="w-1/2 my-1 px-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" value="<?=$contacts?>">
            </div>
        </div>

        <!-- Save Changes Button -->
        <div class="flex">
            <button type="submit" class="bg-green-700  text-white btnSaveProfile py-2 px-4 rounded-lg font-semibold hover:bg-green-500  transition">
                Save Changes
            </button>
        </div>
    </div>
</div>

                </div>
            </div>


                    <!-- add -->

                    <div  class="grid p-3  gap-x-10  ">

                    <div class="">
                        <p class="text-gray-400 text-center sm:text-left">Documents</p>
                        <div style="height:500px" class="card bg-white items-center flex flex-col shadow-md rounded-lg p-10 ">
                                <?php echo $file_object; ?>
                                <p class="text-black">Resume</p>
                                <div class="grid w-full ">
                                    <p class="text-sm text-right ">
                                        <a href="#" id="modalUploadBtn" class="bg-orange text-center  text-orange px-4 py-2 rounded-full shadow-lg 
                                                    transform transition-transform duration-200 
                                                    hover:scale-105 hover:shadow-xl hover:bg-orange-600">Upload</a>
                                    </p>
                                </div>
                        </div>
                    </div>
                <div>
                

                    <!-- end add -->


                                    <div>
                                </div>
                            </div>
                    </div>
                
                
                
                <?php 
                include 'credential.php';
                ?>


            </main>
    
        </div>
        
    </div>

<?php include 'modal/modal-section.php'?>
<?php include 'modal/modal-subjects.php'?>
<?php include 'modal/modal-upload.php'?>
<?php include 'components/footer.php'?>

<script>
     $('.dashboard').addClass('active-nav-link');
     $('.dashboard').removeClass('opacity-75');
</script>

<script>
    $('#openModalButton').click(function(){
        $('#modalText').text("Add Subject");
        $('#submitSubject').text('Add');
    })
    $('.editBtnSubject').click(function(){
        $('#modalTitle').text("Update Subject");
        $('#submitSubject').text('Update');
    })
</script>

<script>
// SECTION
    $('.btnSectionAdd').click(function(){
        $('#subject_id').val($(this).data('id'))
        $('#modalTitle').text('Add Section')
        $('#submitSection').text('Add')
        $('#modalSection').removeClass('hidden')
                    .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation

        $('#modalSection > div').css('animation', 'modal-fade-in 0.3s forwards'); // Scale animation
    
        $.ajax({
            url: 'controller/get_section.php', // Endpoint URL
            type: 'POST', // HTTP request method
            success: function(response) {
                $('#get_section').empty(); // Clear the content of the target element
                $('#get_section').append(response); // Append the server response to the target element
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error); // Log any errors
            }
        });
    })

    $('.btnSectionUpdate').click(function(){
        var subject_id = $(this).data('id');
        $('#subject_id').val(subject_id)
        $('#modalTitle').text('Update Section')
        $('#submitSection').text('Update')
        $('#modalSection').removeClass('hidden')
                    .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation

        $('#modalSection > div').css('animation', 'modal-fade-in 0.3s forwards'); // Scale animation
    
        $.ajax({
            url: 'controller/get_section.php', // Endpoint URL
            type: 'POST', // HTTP request method
            data: {
                subject_id:subject_id
            }, // HTTP request method
            success: function(response) {
                $('#get_section').empty(); 
                $('#get_section').append(response); 
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error); // Log any errors
            }
        });
    })
</script>
<script>
$(document).ready(function () {
  var $modal = $('#modalSection');
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
    $(document).ready(function () {
    // Preview profile image on selection
    $('#profileImage').on('change', function () {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#profileImagePreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // Save profile details including image
    $('.btnSaveProfile').on('click', function () {
        var full_name = $('#full_name').val();
        var contacts = $('#contacts').val();
        var specialization = $('#specialization').val();
        var profileImage = $('#profileImage')[0].files[0];

        // Use FormData to handle file uploads
        var formData = new FormData();
        formData.append('full_name', full_name);
        formData.append('contacts', contacts);
        formData.append('specialization', specialization);
        if (profileImage) {
            formData.append('profile_image', profileImage);
        }

        $.ajax({
            url: 'controller/update_profile.php', // Endpoint URL
            type: 'POST',
            data: formData,
            contentType: false, // Required for file upload
            processData: false, // Required for file upload
            success: function (response) {
                alertMaker(response);
            },
            error: function (xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
    });
});

</script>