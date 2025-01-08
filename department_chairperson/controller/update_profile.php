<?php
include '../../conn/conn.php';

$db = new DatabaseHandler();

if (isset($_SESSION['id'])) {
    // Check if form fields are set
    if (isset($_POST['full_name'], $_POST['contacts'], $_POST['specialization'])) {

        $user_id = $_SESSION['id'];
        $full_name = htmlspecialchars($_POST['full_name']);
        $contacts = htmlspecialchars($_POST['contacts']);
        $specialization = htmlspecialchars($_POST['specialization']);

        // Handle the profile image upload
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['profile_image'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];

            // Allowed file types
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

            // Get file extension and MIME type
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $file_mime = mime_content_type($file_tmp);

            // Validate file size (not exceeding 2MB) and file type
            if (in_array($file_mime, $allowed_types) && $file_size <= 2 * 1024 * 1024) {
                // Generate a unique filename to prevent overwriting existing files
                $new_file_name = uniqid('profile_', true) . '.' . $file_ext;

                // Set the upload directory
                $upload_dir = '../../uploads/faculty/';

                // Move the uploaded file to the target directory
                if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                    // Update the profile in the database with the new file path if upload is successful
                    $data = [
                        'name' => $full_name,
                        'phone' => $contacts,
                        'specialization' => $specialization,
                        'image' => $new_file_name // Save the filename in the DB
                    ];
                } else {
                    echo '500'; // Error during file upload
                    exit;
                }
            } else {
                echo '413'; // File too large or invalid file type
                exit;
            }
        } else {
            // Update without changing profile image
            $data = [
                'name' => $full_name,
                'phone' => $contacts,
                'specialization' => $specialization
            ];
        }

        // Specify where clause for updating the correct user
        $whereClause = ['user_id' => $user_id];

        // Update the profile data in the database
        if ($db->updateData('user_details', $data, $whereClause)) {
            echo '201'; // Success
        } else {
            echo '500'; // Database update failed
        }
    } else {
        echo '400'; // Bad request (missing form data)
    }
} else {
    echo '401'; // Unauthorized (session not set)
}
?>
