<?php 
header('Content-Type: application/json');
require '../../conn/conn.php';
$db = new DatabaseHandler();
$userId = $_SESSION['id']; // Assuming the user ID is stored in session

$where = [
    "user_id=".$_SESSION['id'],
];
$rows = $db->getAllRowsFromTableWhere("calendar", $where);
$events = [];
foreach ($rows as $row) {
    // Adjust the 'end' date if needed
    $endDate = $row['date']; // Assuming end date is the same as start date for single-day events
    $time24 = $row['time']; // Assuming $row['time'] is in 24-hour format, e.g., "14:00"
    $time12 = date('g:i A', strtotime($time24)); // Convert to 12-hour format with AM/PM

    if ($row['type'] === 'Events') {
     
        $events[] = [
            'id' => $row['id'],
            'title' => ucwords($row['description']).' - '.$time12,
            'start' => $row['date'],
            'end' => $row['date'],
            'color' => '#e07330' // Optional: set color based on type
        ];
    } elseif ($row['type'] === 'ToDo') {
        $events[] = [
            'id' => $row['id'],
            'title' => ucwords($row['description']).' - '.$time12,
            'start' => $row['date'],
            'end' => $row['date'],
            'color' => '#1d4ed8' // Optional: set color based on type
        ];
    }
}

echo json_encode($events);
?>
