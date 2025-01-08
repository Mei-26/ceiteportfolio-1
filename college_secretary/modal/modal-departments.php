<!-- Modal Background -->
<div
  id="modal"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen">
    <h2 class="text-xl font-bold mb-4" id="modalText">Add Department</h2>

    <form id="departmentForm" enctype="multipart/form-data">
      <!-- Department Name Input -->
      <div class="mb-4">
        <label for="departmentName" class="block text-gray-700 mb-2">Department Name</label>
        <input
          type="text"
          id="departmentName"
          name="departmentName"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter department name"
          required
        />
      </div>

      <!-- Department Code Input -->
      <div class="mb-4">
        <label for="departmentCode" class="block text-gray-700 mb-2">Department Code</label>
        <input
          type="text"
          id="departmentCode"
          name="departmentCode"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter department code"
          required
        />
      </div>

      <!-- Department Image Upload -->
      <div class="mb-4">
        <label for="departmentImage" class="block text-gray-700 mb-2">Department Image</label>
        <input
          type="file"
          id="departmentImage"
          name="departmentImage"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          accept="image/*"
          required
        />

      </div>


      <!-- Submit Button -->
      <div class="flex justify-end">
        <button
          type="button" id="submitDepartment"
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
<!-- editBtnDepartment -->

<script>
  $('.editBtnDepartment').click(function(){
    $('.option_download_content').hide();
    $('#modal').removeClass('hidden')
          .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation
          $('#modal > div').css('animation', 'modal-fade-in 0.3s forwards');
          $('#modalText').text("Edit Department");

          var dep_id = ($(this).data('id'))
          var department_name = ($(this).data('department_name'))
          var department_code = ($(this).data('department_code'))

        
          
          $('#submitDepartment').text('Edit');
          $('#submitDepartment').attr('data',dep_id);



          $('#departmentName').val(department_name)
          $('#departmentCode').val(department_code)
  })

</script>



<!-- DEPARTMENT -->
<script>
        $(document).ready(function(){
            $('#submitDepartment').click(function(event){
                var id = ($(this).attr('data'))
                var mode = $.trim($(this).text());
                event.preventDefault(); // Prevent the default form submission behavior
                console.log(mode)
                var formValid = true; // Assume form is valid initially
                if(mode=="Add")
                {
                  // Check each input and select for non-null value
                  $('#departmentForm input, #departmentForm select').each(function(){
                      if ($(this).val() === "") {
                        formValid = false; // Set formValid to false if any field is empty
                      } 
                  });
               }else{
                 // Check each input and select for non-null value
                 $('#departmentForm input[type="text"], #departmentForm select').each(function(){
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
                var formData = new FormData($('#departmentForm')[0]);
                
                // Append the mode data
                formData.append('mode', mode);
                formData.append('id', id);
                

                // Log the FormData (for debugging purposes)
                for (var pair of formData.entries()) {
                    console.log(pair[0]+ ': ' + pair[1]); 
                }

                $.ajax({
                    url: 'controller/departments.php', // Replace with your server endpoint URL
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
