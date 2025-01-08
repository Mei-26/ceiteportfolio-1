<!-- Modal Background -->
<div id="modalSection" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity duration-300" aria-hidden="true">
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
    <h2 class="text-2xl font-bold text-gray-800 mb-4" id="modalTitle">Add Sections</h2>
    <form id="subjectSectionForm" enctype="multipart/form-data" class="space-y-4">
    <input type="text" id="subject_id" name="subject_id" hidden>
    <div id="get_section"></div>

      <!-- Submit and Close Buttons -->
      <div class="flex justify-end space-x-2">
        <button type="submit" id="submitSection" class="bg-green-700  hover:bg-green-500  text-white px-4 py-2 rounded transition-colors duration-300">Add</button>
        <button type="button"  class="closeModalButton bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors duration-300">Close</button>
      </div>
    </form>
  </div>
</div>


<script>
    $(document).ready(function() {
        $('#submitSection').click(function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            var mode = $.trim($(this).text());
            var formValid = true; // Assume form is valid initially

            if (mode === "Add") {
                // Check if at least one checkbox is checked
                if ($('#subjectSectionForm input[type="checkbox"]:checked').length === 0) {
                    formValid = false; // Set formValid to false if no checkbox is checked
                }
            }

            if (!formValid) {
                Swal.fire({
                    title: "Oops..!",
                    text: "Please select at least one subject.",
                    icon: "info"
                });
                return; // Exit the function if the form is invalid
            }

            // Create a FormData object from the form element
            var formData = new FormData($('#subjectSectionForm')[0]);

            // Append the mode data
            formData.append('mode', mode);

            // Log the FormData (for debugging purposes)
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            $.ajax({
                url: 'controller/section.php', // Replace with your server endpoint URL
                type: 'POST',
                data: formData,
                processData: false,  // Tell jQuery not to process the data
                contentType: false,  // Tell jQuery not to set contentType
                success: function(response) {
                    alertMaker(response);
                },
                error: function(xhr, status, error) {
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
