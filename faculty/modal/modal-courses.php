<!-- Modal Background -->
<div
  id="modal"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen">
    <h2 class="text-xl font-bold mb-4" id="modalText">Add Course</h2>

    <form id="courseForm" enctype="multipart/form-data">
      <!-- Course Name Input -->
       <input type="text" id="edit_id" value="0" name="edit_id" hidden>
       <p class="delete-alert">Are you sure you want to delete?</p>
      <div class="mb-4 editForm">
        <label for="courseName" class="block text-gray-700 mb-2">Course Name</label>
        <input
          type="text"
          id="courseName"
          name="courseName"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter course name"
          required
        />
      </div>

      <!-- course Image Upload -->
      <div class="mb-4 editForm">
        <label for="courseImage" class="block text-gray-700 mb-2">Course Image</label>
        <input
          type="file"
          id="courseImage"
          name="courseImage"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          accept="image/*"
          required
        />
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button
          type="submit" id="submitCourse"
          class="bg-green-700  text-white px-4 py-2 rounded mr-2"
        >
          Add
        </button>
        <button
          type="button" id="closeModalButton"
          class="bg-red-500 text-white px-4 py-2 rounded"
        >
          Close
        </button>
      </div>
    </form>
  </div>
</div>

<!-- DEPARTMENT -->
<script>
    $(document).ready(function() {
        $('#submitCourse').click(function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            var id = <?php echo json_encode($_GET['i'])?>;
            var mode = $.trim($(this).text());
            var formValid = true; // Assume form is valid initially


            console.log($(this).data('id')+"SSS")

            // Check each input and select for non-null value
            if(mode=="Add")
            {
              $('#courseForm input, #courseForm select').each(function() {
                if ($(this).val() === "") {
                    formValid = false; // Set formValid to false if any field is empty
                }
            });
            }

            if (!formValid) {
                Swal.fire({
                    title: "Oops..!",
                    text: "Please complete all required fields.",
                    icon: "info"
                });
                return; // Exit the function if the form is invalid
            }

            // Create a FormData object
            var formData = new FormData($('#courseForm')[0]);
            
            // Append the mode and id data
            formData.append('mode', mode);
            formData.append('id', id);

            // Log the FormData (for debugging purposes)
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            $.ajax({
                url: 'controller/courses.php', // Replace with your server endpoint URL
                type: 'POST',
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
        });

        // Close modal button functionality
        $('#closeModalButton').click(function() {
            $('#modal').addClass('hidden');
        });
    });
</script>
