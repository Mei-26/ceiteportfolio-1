<?php
require '../../conn/conn.php';
$db = new DatabaseHandler();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $data = [
        'status' => 1,
    ];

    $where = [
        'id' => $id,
    ];

    if ($id > 0 ) {
        $success = $db->updateData('deparment_section',$data,$where); // Implement this method in your DatabaseHandler

        if ($success) {
            echo 200;
        } else {
            echo 400;
        }
    } else {
        echo 400;
    }
} else {
    echo 400;
}
?>
