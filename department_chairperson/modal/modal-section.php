<!-- Modal Background -->
<div
  id="modalSection"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen">
    <h2 class="sectionText text-xl font-bold mb-4">Add Section</h2>

    <form id="sectionForm" enctype="multipart/form-data">
  
      <!-- Section Name Input -->
       <input type="text" id="edit_id" name="edit_id" value="0" hidden>
       <p class="alert-delete">Are you sure you want to delete?</p>
      <div class="mb-4 form_modal">
        <label for="sectionName" class="block text-gray-700 mb-2">Name</label>
        <input
          type="text"
          id="sectionName"
          name="sectionName"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter Section Name"
          required
        />
      </div>
      <!-- Section YearLevel Input -->
      <div class="mb-4 form_modal">
        <label for="sectionYearLevel" class="block text-gray-700 mb-2">Year Level</label>
        <select name="sectionYearLevel" id="sectionYearLevel" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 ">
            <option value="">Select Year Level</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
<option value="5th Year">5th Year</option>
<option value="6th Year">6th Year</option>
        </select>
      </div>
      

      <!-- Submit and Close Buttons -->
      <div class="flex justify-end">
        <button
          type="button"
          id="submitSection"
          class="bg-green-700  text-white px-4 py-2 rounded mr-2 hover:bg-green-500 "
        >
          Add
        </button>
        <button
          type="button"
          id="closeModalButton"
          class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
        >
          Close
        </button>
      </div>
    </form>
  </div>
</div>



<script>
        $(document).ready(function(){
            $('#submitSection').click(function(event){
                var mode = $.trim($(this).text());
                event.preventDefault(); // Prevent the default form submission behavior

                var formValid = true; // Assume form is valid initially

                // Check each input and select for non-null value
                $('#sectionForm input, #sectionForm select').each(function(){
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
                var formData = new FormData($('#sectionForm')[0]);
                
                // Append the mode data
                formData.append('mode', mode);

                // Log the FormData (for debugging purposes)
                for (var pair of formData.entries()) {
                    console.log(pair[0]+ ': ' + pair[1]); 
                }

                $.ajax({
                    url: 'controller/sections.php', // Replace with your server endpoint URL
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


