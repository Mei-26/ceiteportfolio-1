<!-- Modal Background -->
<div
  id="modal"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen">
    <h2 class="text-xl font-bold mb-4" id="modalText">Add Faculty</h2>

    <form id="facultyForm" enctype="multipart/form-data">
  
      <!-- Faculty Employment ID Input -->
  <div class="mb-4">
        <label for="facultyEmploymentID"  class="block text-gray-700 mb-2">Employment ID</label>
        <input
          type="number"
          id="facultyEmploymentID"
          name="facultyEmploymentID"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter faculty Employment ID"
          required
        />
      </div>

      <!-- Faculty Name Input -->
      <div class="mb-4">
        <label for="facultyName" class="block text-gray-700 mb-2">Name</label>
        <input
          type="text"
          id="facultyName"
          name="facultyName"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter faculty name"
          required
        />
      </div>
    

      <!-- Faculty Email Input -->
      <div class="mb-4">
        <label for="facultyEmail" class="block text-gray-700 mb-2">Email</label>
        <input
          type="email"
          id="facultyEmail"
          name="facultyEmail"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter faculty email"
          required
        />
      </div>

      
      <!-- Faculty Email Input -->
      <div class="mb-4">
          <label for="facultyPassword" class="block text-gray-700 mb-2">Password</label>
          <div class="relative">
            <input
              type="password"
              id="facultyPassword"
              name="facultyPassword"
              class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 pr-10"
              placeholder="Enter faculty password"
              required
            />
            <!-- Eye Icon -->
            <button 
              type="button" 
              id="togglePassword" 
              class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500"
            >
              <svg 
                id="eyeIcon" 
                xmlns="http://www.w3.org/2000/svg" 
                class="h-5 w-5" 
                viewBox="0 0 20 20" 
                fill="currentColor"
              >
                <path d="M10 3c-5 0-9 4.418-9 7s4 7 9 7 9-4.418 9-7-4-7-9-7zm0 12c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5zm0-8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z"/>
              </svg>
            </button>
          </div>
          <button 
            type="button" 
            id="generatePassword" 
            class="bg-green-300 px-3 py-2 mt-3 rounded-full"
          >
            Generate Password
          </button>
        </div>

      <!-- Faculty Position Input -->
      <div class="mb-4">
        <label for="facultyPosition" class="block text-gray-700 mb-2">Position</label>
        <select id="facultyPosition"
        name="facultyPosition" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 ">
          <option value="">Select Position</option>
          <option value="college_dean">College Dean</option>
          <option value="college_secretary">College Secretary</option>
          <option value="department_secretary">Department Secretary</option>
          <option value="department_chairperson">Department Chair person</option>
        </select>
      </div>

        <!-- Faculty Departments -->
        <div class="mb-4" id="faculty_dep">
        <label for="facultyDepartment" class="block text-gray-700 mb-2">Department</label>
        <select id="facultyDepartment"
        name="facultyDepartment" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 ">
          <option value="" >Select Department</option>
        </select>
      </div>

       <!-- Faculty Type Input -->
       <div class="mb-4">
        <label for="facultyType" class="block text-gray-700 mb-2">Type</label>
        <select id="facultyType"
        name="facultyType" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 ">
          <option value="">Select Type</option>
          <option value="Regular">Regular</option>
          <option value="Contractual">Contractual</option>
        </select>
      </div>

      <!-- Faculty Specialization Input -->
      <div class="mb-4">
        <label for="facultySpecialization" class="block text-gray-700 mb-2">Specialization</label>
        <input
          type="text"
          id="facultySpecialization"
          name="facultySpecialization"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter faculty specialization"
          required
        />
      </div>

      <div class="mb-4">
        <label for="facultyAddress" class="block text-gray-700 mb-2">Address</label>
        <input
          type="text"
          id="facultyAddress"
          name="facultyAddress"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter faculty address"
          required
        />
      </div>

      <div class="mb-4">
        <label for="facultyBirthday" class="block text-gray-700 mb-2">Birthday</label>
        <input
          type="date"
          id="facultyBirthday"
          name="facultyBirthday"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter faculty birthday"
          required
        />
      </div>

      <!-- Faculty Contacts Input -->
      <div class="mb-4">
        <label for="facultyContacts" class="block text-gray-700 mb-2">Contacts</label>
        <input
          type="number"
          max="11"
          id="facultyContacts"
          name="facultyContacts"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter faculty contacts"
          required
        />
      </div>

      <!-- Faculty Image Upload -->
      <div class="mb-4">
        <label for="facultyImage" class="block text-gray-700 mb-2">Image</label>
        <input
          type="file"
          id="facultyImage"
          name="facultyImage"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          accept="image/*"
          required
        />
      </div>

      <!-- Submit and Close Buttons -->
      <div class="flex justify-end">
        <button
          type="button"
          id="submitFaculty"
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
  $('#faculty_dep').hide()
  $('#facultyPosition').change(function(){
      var position = $(this).val();
      $('#faculty_dep').val('')
      if(position === "department_secretary" || position === "department_chairperson")
      {
        $('#faculty_dep').show()

        $.ajax({
              url: 'controller/get_department.php', // Replace with your server endpoint URL
              type: 'POST', // Use 'GET' or 'POST' depending on your server setup
              data: {position:position},
              success: function(response) {
                // Clear the select element before appending new options
                $('#facultyDepartment').empty();

                // Re-add the default placeholder option
                $('#facultyDepartment').append('<option value="">Select Department</option>');

                // Append the response (should contain <option> elements)
                $('#facultyDepartment').append(response);
                console.log(response)
              },
              error: function(xhr, status, error) {
                  // Handle errors if the request fails
                  console.error('Error submitting form:', error);
              }
          });


      }else{
        $('#faculty_dep').hide()
      }
  });
</script>

<script>
  // Toggle password visibility
  const passwordInput = document.getElementById('facultyPassword');
  const togglePasswordButton = document.getElementById('togglePassword');
  const eyeIcon = document.getElementById('eyeIcon');

  togglePasswordButton.addEventListener('click', () => {
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    // Toggle the eye icon
    eyeIcon.innerHTML = isPassword 
      ? '<path d="M10 3c-5 0-9 4.418-9 7s4 7 9 7 9-4.418 9-7-4-7-9-7zm0 12c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5zm0-8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z"/>' 
      : '<path d="M10 3c-5 0-9 4.418-9 7s4 7 9 7 9-4.418 9-7-4-7-9-7zm0 12c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5zM13.293 9.707a1 1 0 010-1.414l2-2a1 1 0 10-1.414-1.414l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 10-1.414 1.414l2 2a1 1 0 010 1.414l-2 2a1 1 0 101.414 1.414l2-2a1 1 0 011.414 0l2 2a1 1 0 001.414-1.414l-2-2z"/>';
  });

  // Generate random password
  document.getElementById('generatePassword').addEventListener('click', () => {
    const randomPassword = generateRandomPassword(10);
    passwordInput.value = randomPassword;
  });

  // Random password generator
  function generateRandomPassword(length) {
    const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
    let password = "";
    for (let i = 0; i < length; i++) {
      const randomIndex = Math.floor(Math.random() * charset.length);
      password += charset[randomIndex];
    }
    return password;
  }
</script>
<script>
  // Get the input element
  const dateInput = document.getElementById('facultyBirthday');

  // Calculate the maximum date for 18 years old
  const today = new Date();
  const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate())
    .toISOString()
    .split('T')[0];

  // Set the max attribute to the calculated date
  dateInput.max = maxDate;
</script>