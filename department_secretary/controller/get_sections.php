<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();

$user_id = $_SESSION['id'];
$department_id = $db->getIdByColumnValue("department_details", "department_secretary", $user_id, 'id');
$rows = $db->getAllSections($department_id);

$count =0;
if(count($rows) > 0) {
    foreach ($rows as $row) {
        $count++;
        $id = $row['id'];
        $name = $row['name'];
        $yearlevel = $row['yearlevel'];

        echo '
        <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
            <td class="p-3 block table-cell">
                <a class="syllabusInfo">
                    <div class="flex flex-row text-justify items-center">
                        <i class="material-icons text-orange text-5xl mr-3">folder</i>
                        <div class="flex flex-col">
                            <p class="font-semibold text-gray-800">'.$name.'</p>
                            <p class="text-gray-500">'.$yearlevel.'</p>
                        </div>
                    </div>
                </a>
            </td>
            <td class="p-3 block table-cell">
                <select onchange="handleAction(this, '.$id.', \''.$name.'\', \''.$yearlevel.'\')" class="c">
                    <option value="" selected disabled>Actions</option>
                    <option value="edit">Edit</option>
                    <option value="delete">Delete</option>
                </select>
            </td>
        </tr>';
    }

    if($count == 0) {
        echo '
        <tr class="block text-center table-row bg-white hover:bg-orange transition duration-200 ease-in">
            <td colspan=2>No Data</td>
        </tr>'; 
    }
}
?>

