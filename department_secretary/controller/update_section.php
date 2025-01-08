<?php
require '../../conn/conn.php';
$db = new DatabaseHandler();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $yearlevel = isset($_POST['yearlevel']) ? trim($_POST['yearlevel']) : '';
    $data = [
        'name' => $name,
        'yearlevel' => $yearlevel,
    ];

    $where = [
        'id' => $id,
    ];

    if ($id > 0 && !empty($name) && !empty($yearlevel)) {
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
