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
        <label for="facultyPassword" class="block text-gray-700 mb-2">Faculty Password</label>
        <input
          type="password"
          id="facultyPassword"
          name="facultyPassword"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter faculty password"
          required
        />
      </div>

      <!-- Faculty Position Input -->
      <div class="mb-4">
        <label for="facultyPosition" class="block text-gray-700 mb-2">Faculty Position</label>
        <select id="facultyPosition"
        name="facultyPosition" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 ">
          <option value="">Select Position</option>
          <option value="college_dean">College Dean</option>
          <option value="college_secretary">College Secretary</option>
          <option value="department_secretary">Department Secretary</option>
          <option value="department_chairperson">Department Chair person</option>
        </select>
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
          type="tel"
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
