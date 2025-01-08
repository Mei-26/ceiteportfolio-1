<!-- Modal Background -->
<div id="modalUpload" class="mowdal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity duration-300" >
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen" >
    <h2 class="text-2xl font-bold text-gray-800 mb-4" id="upload_title">Upload</h2>
    <form id="uploadForm" enctype="multipart/form-data" class="space-y-4">


    <input type="text" id="section_id" name="section_id" hidden>
    <input type="text" id="form_id" name="form_id" hidden>
     <!-- upload Image Upload -->
     <div class="mb-4">
        <label for="uploadFile" class="block text-gray-700 mb-2">Upload File</label>
        <input
          type="file"
          id="uploadFile"
          name="uploadFile"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          accept="application/pdf"
          required
        />
      </div>

      <!-- Submit and Close Buttons -->
      <div class="flex justify-end space-x-2">
        <button type="submit" id="submitDocumentUpload" class="bg-green-700  hover:bg-green-500  text-white px-4 py-2 rounded transition-colors duration-300">Upload</button>
        <button type="button" class="closeModalButton bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors duration-300">Close</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Open modal and reset form
  $('.uploadDocumentBtn').click(function() {
    var file_id = ($(this).data('file_id'))
    var file_name = ($(this).data('file_name'))
    var section_id = ($(this).data('section_id'))
    $('#upload_title').text(file_name)
    $('#form_id').val(file_id)
    $('#section_id').val(section_id)
    
    $('#modalUpload').removeClass('hidden')
      .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation

    $('#modalUpload > div').css('animation', 'modal-fade-in 0.3s forwards'); // Scale animation
  });
</script>

<script>
$(document).ready(function () {
  var $modal = $('#modalUpload');
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
  $('#submitDocumentUpload').on('click', function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Get the file input element
    var fileInput = $('#uploadFile')[0];
    var file = fileInput.files[0];

    var subject_id = <?php echo json_encode($subject_id)?>;
    // Check if a file has been selected
    if (!file) {
      alertMaker("300")
        return; // Stop the submission if no file is selected
    }

    // Get form data
    var formData = new FormData($('#uploadForm')[0]);

    formData.append("subject_id",subject_id);
    // AJAX request
    $.ajax({
        url: 'controller/upload_documents.php', // Replace with your server endpoint URL
        type: 'POST', // Use 'POST' for form submission
        data: formData,
        processData: false,  // Prevent jQuery from processing the data
        contentType: false,  // Prevent jQuery from setting the content type
        success: function(response) {
              alertMaker(response)
        },
        error: function(xhr, status, error) {
            // Handle errors if the request fails
            console.error('Error submitting form:', error);
            alertMaker(error)
        }
    });
});

</script>