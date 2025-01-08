<!-- Modal Background -->
<div
  id="modalAccount"
  class="fixed mowdal inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen">
    <h2 class="text-xl font-bold mb-4">Change Password</h2>

    <form id="accountForm" enctype="multipart/form-data">
      <!-- Department Name Input -->
      <div class="mb-4">
        <label for="old_password" class="block text-gray-700 mb-2">Old Password</label>
        <input
          type="password"
          id="old_password"
          name="old_password"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter Old Password"
          required
        />
      </div>

      <div class="mb-4">
        <label for="new_password" class="block text-gray-700 mb-2">New Password</label>
        <input
          type="password"
          id="new_password"
          name="new_password"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter New Password"
          required
        />
      </div>

      <div class="mb-4">
        <label for="confirm_password" class="block text-gray-700 mb-2">Confirm New Password</label>
        <input
          type="password"
          id="confirm_password"
          name="confirm_password"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter Confirm New Password"
          required
        />
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button
          type="button" id="submitModalAccount"
          class="bg-green-700  text-white px-4 py-2 rounded mr-2"
        >
      Save Changes    
      </button>
        <button
          type="button"
          class="bg-red-500 closeModalButton text-white px-4 py-2 rounded"
        >
          Close
        </button>
      </div>
    </form>
  </div>
</div>


<script>
$('#submitModalAccount').on('click', function() {

    // Get form values
    var oldPassword = $('#old_password').val();
    var newPassword = $('#new_password').val();
    var confirmPassword = $('#confirm_password').val();

     // Check if the password length is at least 8 characters
     if (newPassword.length < 8) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Password',
            text: 'Password must be at least 8 characters long!',
        });
        return;
    }


    // Basic validation
    if (!oldPassword || !newPassword || !confirmPassword) {
        alertMaker("300")
        return; // Stop the submission if fields are empty
    }

    if (newPassword !== confirmPassword) {
        alertMaker("301")
        return; // Stop the submission if passwords don't match
    }

    // Get form data
    var formData = new FormData($('#accountForm')[0]);

    // AJAX request
    $.ajax({
        url: 'controller/update_password.php', // Replace with your server endpoint URL
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
            alert('An error occurred while processing your request.');
        }
    });
});

// Close modal
document.querySelectorAll('.closeModalButton').forEach(function(button) {
    button.addEventListener('click', function() {
        document.getElementById('modalAccount').classList.add('hidden');
    });
});

</script>