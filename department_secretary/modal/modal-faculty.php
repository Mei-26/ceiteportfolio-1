<!-- Modal Background -->
<div
  id="modal"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen">
    <h2 class="text-xl font-bold mb-4">Add Faculty</h2>

    <form id="facultyForm" enctype="multipart/form-data">
  
      <!-- Faculty Employment ID Input -->
  <div class="mb-4">
        <label for="facultyEmploymentID" class="block text-gray-700 mb-2">Faculty Employment ID</label>
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
        <label for="facultyName" class="block text-gray-700 mb-2">Faculty Name</label>
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
        <label for="facultyEmail" class="block text-gray-700 mb-2">Faculty Email</label>
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

       <!-- Faculty Type Input -->
       <div class="mb-4">
        <label for="facultyType" class="block text-gray-700 mb-2">Faculty Type</label>
        <select id="facultyType"
        name="facultyType" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 ">
          <option value="">Select Type</option>
          <option value="Regular">Regular</option>
          <option value="Contractual">Contractual</option>
        </select>
      </div>

      <!-- Faculty Specialization Input -->
      <div class="mb-4">
        <label for="facultySpecialization" class="block text-gray-700 mb-2">Faculty Specialization</label>
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
        <label for="facultyAddress" class="block text-gray-700 mb-2">Faculty Address</label>
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
        <label for="facultyBirthday" class="block text-gray-700 mb-2">Faculty Birthday</label>
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
        <label for="facultyContacts" class="block text-gray-700 mb-2">Faculty Contacts</label>
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
        <label for="facultyImage" class="block text-gray-700 mb-2">Faculty Image</label>
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
        $(document).ready(function(){
            $('#submitFaculty').click(function(event){
                var mode = $.trim($(this).text());
                event.preventDefault(); // Prevent the default form submission behavior

                var formValid = true; // Assume form is valid initially
                var facultyEmail = $('#facultyEmail').val();
                // Check if the email ends with @cvsu.edu.ph
                if (!facultyEmail.endsWith('@cvsu.edu.ph')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Email',
                        text: 'Email must end with @cvsu.edu.ph!',
                    });
                    return;
                }
                var facultyPassword = $('#facultyPassword').val();

                // Check if the password length is at least 8 characters
                if (facultyPassword.length < 8) {
    Swal.fire({
        icon: 'error',
        title: 'Invalid Password',
        text: 'Password must be at least 8 characters long!',
    });
    return;
}

// Check for at least one uppercase letter and one symbol
const regex = /^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).+$/;

if (!regex.test(facultyPassword)) {
    Swal.fire({
        icon: 'error',
        title: 'Invalid Password',
        text: 'Password must contain at least one uppercase letter and one symbol!',
    });
    return;
}

const contactValue = $('#facultyContacts').val();
      
      // Check if length is exactly 11
      if (contactValue.length !== 11) {
          Swal.fire({
              icon: 'error',
              title: 'Invalid Contact number',
              text: 'Contact number must be exactly 11 characters long.',
          });
          return;
      }

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