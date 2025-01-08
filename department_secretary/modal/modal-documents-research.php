<!-- Modal Background -->
<div
  id="modalFacultyResarch"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen">
    <h2 class="text-xl font-bold mb-4">Remove Faculty</h2>

    <form id="removefacultyForm" enctype="multipart/form-data">
  
      <input type="text" id="remove_faculty_id" name="remove_faculty_id" hidden>
      <div class="mb-4">
            <label for="facultyEmploymentID" class="block text-gray-700 mb-2">Are you sure you want to remove this faculty?</label>
      </div>

      <!-- Submit and Close Buttons -->
      <div class="flex justify-end">
        <button
          type="button"
          id="submitRemoveFaculty"
          class="bg-green-700  text-white px-4 py-2 rounded mr-2 hover:bg-green-500 "
        >
          Remove
        </button>
        <button
          type="button"
          class="bg-red-500 closeModalButton text-white px-4 py-2 rounded hover:bg-red-600"
        >
          Close
        </button>
      </div>
    </form>
  </div>
</div>



<script>
        $(document).ready(function(){
            $('#submitFaculty').click(function(event){
                var mode = $.trim($(this).text());
                event.preventDefault(); // Prevent the default form submission behavior

                var formValid = true; // Assume form is valid initially

                // Check each input and select for non-null value
                $('#facultyForm input, #facultyForm select').each(function(){
                    if ($(this).val() === "") {
                        formValid = false; // Set formValid to false if any field is empty
                    } 
                });

                if (!formValid) {
                    Swal.fire({
                        title: "Oops..!",
                        text: "Please complete all required fields.",
                        icon: "info"
                    });
                    return; // Exit the function if the form is invalid
                }

                // Create a FormData object
                var formData = new FormData($('#facultyForm')[0]);
                
                // Append the mode data
                formData.append('mode', mode);

                // Log the FormData (for debugging purposes)
                for (var pair of formData.entries()) {
                    console.log(pair[0]+ ': ' + pair[1]); 
                }

                $.ajax({
                    url: 'controller/faculty.php', // Replace with your server endpoint URL
                    type: 'POST', // Use 'GET' or 'POST' depending on your server setup
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
        });
    </script>


