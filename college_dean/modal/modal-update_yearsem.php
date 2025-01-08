<!-- Modal Background -->
 <?php
$college_id = $db->getIdByColumnValue("college_officers","college_secretary_id",$_SESSION['id'],"college_id");
 $currentSem = $db->getIdByColumnValue("current_year_sem", "college_id", $college_id, "current_sem");
 $currentYear = $db->getIdByColumnValue("current_year_sem", "college_id", $college_id, "current_year");

 ?>
<div
  id="modalYearSem"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen">
    <h2 class="text-xl font-bold mb-4">Update Academic Year and Semester</h2>

    <form id="academicYearForm" enctype="multipart/form-data">

      <div class="mb-4">
        <label for="updateAcademicYear" class="block text-gray-700 mb-2">Update Academic Year</label>
        <select
              id="updateAcademicYear"
              name="updateAcademicYear"
              class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
              required
          >
              <option value="" disabled <?= $currentYear === null ? 'selected' : '' ?>>Select Academic Year</option>
              <?php
              $startYear = date('Y'); // Get the current year
              $endYear = $startYear + 10; // Calculate the end year

              for ($year = $startYear; $year <= $endYear; $year++) {
                  $nextYear = $year + 1;
                  $academicYear = "$year-$nextYear";
                  $selected = $currentYear === $academicYear ? 'selected' : '';
                  echo "<option value=\"$academicYear\" $selected>$academicYear</option>";
              }
              ?>
          </select>

      </div>

      <div class="mb-4">
        <label for="updateSemester" class="block text-gray-700 mb-2">Update Semester</label>
        <select
            id="updateSemester"
            name="updateSemester"
            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
            required
        >
            <option value="" disabled <?= $currentSem === null ? 'selected' : ''?>>Select Semester</option>
            <option value="1st Semester" <?= $currentSem === '1st Semester' ? 'selected' : ''?>>1st Semester</option>
            <option value="2nd Semester" <?= $currentSem === '2nd Semester' ? 'selected' : ''?>>2nd Semester</option>
            <option value="3rd Semester" <?= $currentSem === '3rd Semester' ? 'selected' : ''?>>3rd Semester</option>
            <option value="Summer" <?= $currentSem === 'Summer' ? 'selected' : ''?>>Summer</option>
        </select>

      </div>


      <!-- Submit Button -->
      <div class="flex justify-end">
        <button
          type="button" id="submitAcademicYearForm"
          class="bg-green-700  text-white px-4 py-2 rounded mr-2"
        >
          Update
        </button>
        <button
          type="button" id="btnClosemodalYearSem"
          class="bg-red-500 closeModalButton text-white px-4 py-2 rounded"
        >
          Close
        </button>
      </div>
    </form>
  </div>
</div>



<script>
        $(document).ready(function(){
            $('#submitAcademicYearForm').click(function(event){
                var mode = $.trim($(this).text());
                event.preventDefault(); // Prevent the default form submission behavior

                var formValid = true; // Assume form is valid initially

                // Check each input and select for non-null value
                $('#academicYearForm input, #academicYearForm select').each(function(){
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
                var formData = new FormData($('#academicYearForm')[0]);
                
                // Append the mode data
                formData.append('mode', mode);

                // Log the FormData (for debugging purposes)
                for (var pair of formData.entries()) {
                    console.log(pair[0]+ ': ' + pair[1]); 
                }

                $.ajax({
                    url: 'controller/academic_year_sem.php', // Replace with your server endpoint URL
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


