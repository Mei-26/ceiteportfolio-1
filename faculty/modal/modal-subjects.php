<!-- Modal Background -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity duration-300" aria-hidden="true">
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
    <h2 class="text-2xl font-bold text-gray-800 mb-4" id="modalTitle">Add Subject</h2>
    <form id="subjectForm" enctype="multipart/form-data" class="space-y-4">
      <!-- Hidden Field for Edit ID -->
      <input type="hidden" id="edit_id" name="edit_id" value="0">
      <?php 
      $department_id = $db->getIdByColumnValue("department_faculty", "faculty_id", $_SESSION['id'], 'department_id');
      $rows = $db->getAllSubjects($department_id);
      $faculty_subject_rows = $db->getAllRowsFromTableWhere("faculty_subject", ['faculty_id='.$_SESSION['id']]);

      // Create an array of subject_ids that are assigned to the faculty
      $assigned_subject_ids = array_column($faculty_subject_rows, 'subject_id');

      foreach ($rows as $row) {
          $isChecked = in_array($row['id'], $assigned_subject_ids) ? 'checked' : '';

          echo '
          <div class="flex items-center space-x-3">
            <input
              type="checkbox"
              name="subjects[]"
              value="' . htmlspecialchars($row['id']) . '"
              class="form-checkbox h-5 w-5 text-green-600 focus:ring-green-500"
              ' . $isChecked . '
            />
            <label class="text-gray-700 cursor-pointer">
              ' . ucwords(htmlspecialchars($row['name'])) . '
            </label>
          </div>';
      }

      ?>

      <!-- Submit and Close Buttons -->
      <div class="flex justify-end space-x-2">
        <button type="submit" id="submitSubject" class="bg-green-700  hover:bg-green-500  text-white px-4 py-2 rounded transition-colors duration-300">Add</button>
        <button type="button" id="closeModalButton" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors duration-300">Close</button>
      </div>
    </form>
  </div>
</div>

<!-- JavaScript -->
<script>
    $(document).ready(function() {
        $('#submitSubject').click(function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            var mode = $.trim($(this).text());
            var formValid = true; // Assume form is valid initially

            if (mode === "Add") {
                // Check if at least one checkbox is checked
                if ($('#subjectForm input[type="checkbox"]:checked').length === 0) {
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
            var formData = new FormData($('#subjectForm')[0]);

            // Append the mode data
            formData.append('mode', mode);

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
