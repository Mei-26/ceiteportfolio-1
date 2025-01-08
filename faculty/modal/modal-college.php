<!-- Modal Background -->
<div
  id="modal"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
>
  <!-- Modal Content -->
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 md:mx-auto overflow-auto max-h-screen">
    <h2 class="text-xl font-bold mb-4">Add College</h2>

    <form id="collegeForm" enctype="multipart/form-data">
      <!-- Department Name Input -->
      <div class="mb-4">
        <label for="collegeName" class="block text-gray-700 mb-2">College Name</label>
        <input
          type="text"
          id="collegeName"
          name="collegeName"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter College Name"
          required
        />
      </div>

      <!-- college Code Input -->
      <div class="mb-4">
        <label for="collegeCode" class="block text-gray-700 mb-2">College Code</label>
        <input
          type="text"
          id="collegeCode"
          name="collegeCode"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          placeholder="Enter College Code"
          required
        />
      </div>

      <!-- college Image Upload -->
      <div class="mb-4">
        <label for="collegeImage" class="block text-gray-700 mb-2">College Image</label>
        <input
          type="file"
          id="collegeImage"
          name="collegeImage"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
          accept="image/*"
          required
        />
      </div>

       <!-- College Head Input -->
       <div class="mb-4">
        <label for="collegeDean" class="block text-gray-700 mb-2">College Dean</label>
        <select id="collegeDean"
          name="collegeDean"
        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
        >
        <option value="">Select Chairperson</option>
        <?php 
        $rows = $db->getUsers('college_dean');

        foreach ($rows as $row) {
          $id = $row['user_id'];
          $name = $row['name'];
          $added = $row['added'];
          if($added == "0")
          {
            echo '<option value="'.$id.'">'.$name.'</option>';
          }
        }
        ?>
        </select>
        
      </div>

      <!-- College Head Input -->
      <div class="mb-4">
        <label for="collegeSecretary" class="block text-gray-700 mb-2">College Secretary</label>

        <select id="collegeSecretary"
          name="collegeSecretary"
        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-green-500 "
        >
        <option value="">Select College Secretary</option>
        <?php 
        $rows = $db->getUsers('college_secretary');

        foreach ($rows as $row) {
          $id = $row['user_id'];
          $name = $row['name'];
          echo '<option value="'.$id.'">'.$name.'</option>';
        }
        ?>
        </select>
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button
          type="button" id="submitCollege"
          class="bg-green-700  text-white px-4 py-2 rounded mr-2"
        >
          Add
        </button>
        <button
          type="button" id="closeModalButton"
          class="bg-red-500 text-white px-4 py-2 rounded"
        >
          Close
        </button>
      </div>
    </form>
  </div>
</div>
