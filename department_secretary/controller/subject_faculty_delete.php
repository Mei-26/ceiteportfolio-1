<?php
require '../../conn/conn.php';
$db = new DatabaseHandler();

if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
        // Delete the record from the database
        if ($db->hardDeleteFacultySubjectBySection($_POST['id'])) {
            echo '202'; // Success
        } else {
            echo '500'; // Database deletion error
        }
} else {
    echo '400'; // Invalid request
}
