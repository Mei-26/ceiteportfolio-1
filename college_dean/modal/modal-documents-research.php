<!-- Modal Background -->
<div
  id="modalFacultyResarch"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen">
    <h2 class="text-xl font-bold mb-4">Remove Faculty</h2>

    <form id="removefacultyForm" enctype="multipart/form-data">
  
      <input type="text" id="remove_faculty_id" name="remove_faculty_id" hidden>
      <div class="mb-4">
            <label for="facultyEmploymentID" class="block text-gray-700 mb-2">Are you sure you want to remove this faculty?</label>
      </div>

      <!-- Submit and Close Buttons -->
      <div class="flex justify-end">
        <button
          type="button"
          id="submitRemoveFaculty"
          class="bg-green-700  text-white px-4 py-2 rounded mr-2 hover:bg-green-500 "
        >
          Remove
        </button>
        <button
          type="button"
          class="bg-red-500 closeModalButton text-white px-4 py-2 rounded hover:bg-red-600"
        >
          Close
        </button>
      </div>
    </form>
  </div>
</div>





