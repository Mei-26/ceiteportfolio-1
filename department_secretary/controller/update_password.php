<?php 
include '../../conn/conn.php';

$db = new DatabaseHandler();

$response = array('success' => false, 'message' => 'Update failed');

if (isset($_SESSION['id'])) {
    if (isset($_POST['old_password'], $_POST['new_password'])) {

        $user_id = $_SESSION['id'];

        // Fetch the hashed password from the database
        $old_password_hash = $db->getIdByColumnValue("users", "id", $user_id, "password");

        if (password_verify($_POST['old_password'], $old_password_hash)) {
            $new_password = $_POST['new_password'];

            // Prepare data for update
            $data = array(
                'password' => password_hash($new_password, PASSWORD_DEFAULT),
            );
            $whereClause = array(
                'id' => $user_id
            );

            // Update the password in the database
            if ($db->updateData('users', $data, $whereClause)) {
                echo '201';
            } else {
                $response['message'] = 'Failed to update the password. Please try again.';
            }
        } else {
            echo '402';
        }
    } else {
        echo '401';
    }
} else {
    echo '401';
}

?>
