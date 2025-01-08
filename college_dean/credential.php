<div class="flex flex-col md:flex-row justify-between items-center bg-white rounded-lg p-3 shadow-lg">

<span class="ml-4 text-gray-700  text-lg font-semibold">Credential List</span>


    <button 
        class="bg-green-700  text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-green-500 "
        onclick="openModal()"
    >
        Add Credentials
    </button>
</div>

<!-- Credentials List -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
    <?php 
        $user_id = $_SESSION['id'];
    if(isset($_GET['i']))
    {
        $user_id = $_GET['i'];
    }
    $rows = $db->getAllRowsFromTableWhere('credential_added', ['user_id='.$user_id]);
    if (count($rows) > 0) {
        foreach ($rows as $row) {
            // Sanitize the input data
            $id = htmlspecialchars($row['id']);  // Added id for delete action
            $title = htmlspecialchars($row['title']);
            $description = htmlspecialchars($row['description']);
            $image = htmlspecialchars($row['image']);
            $date = htmlspecialchars($row['date']);
            $file_type = htmlspecialchars($row['file_type']);
            
            // Determine whether the file is an image or a PDF
            if (in_array($file_type, ['image/jpeg', 'image/png', 'image/gif'])) {
                // If it's an image, display the image
                $documentDisplay = '<img src="../uploads/credentials/'.$image.'" alt="'.$title.'" class="w-full h-48 object-cover">';
            } elseif ($file_type === 'application/pdf') {
                // If it's a PDF, display a PDF icon or a view link
                $documentDisplay = '
                <div class="w-full h-48 flex items-center justify-center bg-gray-200">
                    <span class="text-gray-600">PDF Document</span>
                </div>';
            } else {
                // For unsupported file types, show a message
                $documentDisplay = '<div class="w-full h-48 flex items-center justify-center bg-gray-200">
                    <span class="text-red-500">Unsupported file type</span>
                </div>';
            }
            
            // Card for each credential
            echo '
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
                '.$documentDisplay.' <!-- Image or PDF display -->
                <div class="p-4">
                    <h3 class="text-lg font-bold mb-2">'.$title.'</h3>
                    <p class="text-sm text-gray-600 mb-4">'.($description).'</p>
                    <div class="text-sm text-gray-500 mb-2">
                        <span>Date: '.date("F d, Y", strtotime($date)).'</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="../uploads/credentials/'.$image.'" target="_blank" class="text-green-500 hover:underline">View Credential</a>
                        <button 
                            class="bg-red-500 text-white py-1 px-3 rounded-lg hover:bg-red-600"
                            onclick="confirmDelete('.$id.')"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            ';
            
        }
    } else {
        echo '
        <!-- No Credentials Message -->
            <div class="flex items-center col-span-4 justify-center min-h-[200px] bg-gray-50 border border-gray-200 rounded-lg shadow-lg">
                <div class="text-center p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 10h16M4 13h16M4 16h16M4 19h16" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No Credentials Added Yet</h3>
                </div>
            </div> ';    }
    ?>
</div>

<!-- Modal Background -->
<div id="credentialModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <!-- Modal Content -->
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
        <!-- Close button -->
        <button 
            class="absolute top-2 right-2 text-gray-600 hover:text-gray-900"
            onclick="closeModal()"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        
        <!-- Modal Header -->
        <h2 class="text-2xl font-bold text-center mb-4">Add Credentials</h2>

        <!-- Form -->
        <form id="credentialForm" enctype="multipart/form-data">
            <!-- Title -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Title</label>
                <input 
                    type="text" 
                    name="title"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    placeholder="Enter title name"
                    required
                />
            </div>
            
            <!-- Description -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea 
                    name="description"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    rows="3"
                    placeholder="Enter credential description"
                    required
                ></textarea>
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Upload Image</label>
                <input 
    type="file" 
    name="image"
    accept="image/*"
    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
    required
/>

            </div>

            <!-- Date -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Date</label>
                <input 
                    type="date" 
                    name="date"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    required
                />
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button 
                    type="submit" 
                    class="bg-green-700  text-white py-2 px-6 rounded-lg font-semibold hover:bg-green-500  transition"
                >
                    Add Credential
                </button>
            </div>
        </form>
    </div>
</div>

<!-- AJAX Logic -->
<script>
    // Open Modal with Fade-in Animation
    function openModal() {
        $('#credentialModal').css('display', 'flex').css('animation', 'modal-fade-in 0.3s forwards');
        $('#credentialModal > div').css('animation', 'modal-fade-in 0.3s forwards'); // Modal content scale animation
    }

    // Close Modal
    function closeModal() {
        $('#credentialModal').css('display', 'none');
    }

    // AJAX Submit Form
    $('#credentialForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        var formData = new FormData(this); // Use FormData for file uploads

        $.ajax({
            url: 'controller/add_credentials.php', // Backend PHP file
            type: 'POST',
            data: formData,
            processData: false,  // Do not process the data
            contentType: false,  // Do not set contentType
            success: function(response) {
                alertMaker(response); 
            },
            error: function(xhr, status, error) {
                alertMaker('There was an error adding the credential.');
            }
        });
    });



    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to undo this action!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to delete the credential
                $.ajax({
                    url: 'controller/delete_credentials.php', // Backend PHP file to handle deletion
                    type: 'POST',
                    data: {id: id},
                    success: function(response) {
                        alertMaker(response);
                    },
                    error: function(xhr, status, error) {
                        alertMaker(error);

                    }
                });
            }
        });
    }
</script>
