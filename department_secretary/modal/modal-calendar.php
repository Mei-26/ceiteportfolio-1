<!-- Modal Background -->
<div id="modalCalendar" style="z-index: 9!important;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity duration-300" aria-hidden="true">
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
    <h2 class="text-2xl font-bold text-gray-800 mb-4" id="modalTitle">Add Description</h2>
    <form id="subjectSectionForm" enctype="multipart/form-data" class="space-y-4">

    <div class="mb-4">
        <label for="eventDescription" class="block text-gray-700 mb-2">Description</label>
        <input
          type="text"
          id="eventDescription"
          name="eventDescription"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter Description"
          required
        />
      </div>
      <div class="mb-4">
        <label for="eventType" class="block text-gray-700 mb-2">Type</label>
        <select name="eventType" id="eventType" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 ">
            <option value="Events">Events</option>
            <option value="ToDo">ToDo</option>
        </select>
      </div>
      <div class="mb-4">
        <label for="eventDate" class="block text-gray-700 mb-2">Date</label>
        <input
        type="date"
        id="eventDate"
        name="eventDate"
        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
        placeholder="Enter Date"
        min="<?php echo date('Y-m-d'); ?>"
        required
    />

      </div>

      <div class="mb-4">
        <label for="eventTime" class="block text-gray-700 mb-2">Time</label>
        <input
          type="time"
          id="eventTime"
          name="eventTime"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter Time"
          required
        />
      </div>

      <div class="flex justify-end space-x-2">
        <button type="submit" id="submitCalendar" class="bg-green-700  hover:bg-green-500  text-white px-4 py-2 rounded transition-colors duration-300">Add</button>
        <button type="button"  class="closeModalButton bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors duration-300">Close</button>
      </div>
    </form>
  </div>
</div>


<script>
    $(document).ready(function() {
        $('#submitCalendar').click(function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            var mode = $.trim($(this).text());
            var formValid = true; // Assume form is valid initially

            if (mode === "Add") {
                // Check if at least one checkbox is checked
                $('#subjectSectionForm input, #subjectSectionForm select').each(function(){
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

            // Create a FormData object from the form element
            var formData = new FormData($('#subjectSectionForm')[0]);

            // Append the mode data
            formData.append('mode', mode);

            $.ajax({
                url: 'controller/calendar.php', // Replace with your server endpoint URL
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
