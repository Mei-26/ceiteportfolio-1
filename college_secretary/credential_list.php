<div class="flex flex-col md:flex-row justify-between items-center bg-white rounded-lg p-3 shadow-lg">

<span class="ml-4 text-gray-700  text-lg font-semibold">Credential List</span>


</div>

<!-- Credentials List -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
    <?php 
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
                        
                    </div>
                </div>
            </div>
            ';
            
        }
    } else {
        echo '
        <!-- No Credentials Message -->
            <div class="flex col-span-4 items-center justify-center min-h-[200px] bg-gray-50 border border-gray-200 rounded-lg shadow-lg">
                <div class="text-center p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 10h16M4 13h16M4 16h16M4 19h16" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No Credentials Added Yet</h3>
                </div>
            </div>';
    }
    ?>
</div>
