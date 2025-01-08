<!-- Modal Background -->
<div
  id="modal"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen">
    <h2 class="text-xl font-bold mb-4" id="modalText">Add subject</h2>

    <form id="subjectForm" enctype="multipart/form-data">
      <!-- subject Name Input -->
       <input type="text" value="0" id="edit_id" name="edit_id" hidden>
       <p class="delete-alert">Are you sure you want to delete?</p>

       <div class="mb-4 editForm">
        <label for="subjectCode" class="block text-gray-700 mb-2">Subject Code</label>
        <input
          type="text"
          id="subjectCode"
          name="subjectCode"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter subject Code"
          required
        />
      </div>

      <div class="mb-4 editForm">
        <label for="subjectName" class="block text-gray-700 mb-2">Subject Name</label>
        <input
          type="text"
          id="subjectName"
          name="subjectName"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter subject name"
          required
        />
      </div>
    
      <!-- Subject Image Upload -->
      <div class="mb-4 editForm">
        <label for="subjectImage" class="block text-gray-700 mb-2">Subject  Image</label>
        <input
          type="file"
          id="subjectImage"
          name="subjectImage"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          accept="image/*"
          required
        />
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button
          type="submit" id="submitSubject"
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
        $('#submitSubject').click(function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            var id = <?php echo json_encode($_GET['c'])?>;
            var mode = $.trim($(this).text());
            var formValid = true; // Assume form is valid initially


            // Check each input and select for non-null value
            if(mode=="Add")
            {
              $('#subjectForm input, #subjectForm select').each(function() {
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
            var formData = new FormData($('#subjectForm')[0]);
            
            // Append the mode and id data
            formData.append('mode', mode);
            formData.append('id', id);

            // Log the FormData (for debugging purposes)
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            $.ajax({
                url: 'controller/subjects.php', // Replace with your server endpoint URL
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
