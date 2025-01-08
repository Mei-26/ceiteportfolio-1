<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();
// var_dump($_POST);
// var_dump($_FILES);
if(isset($_POST['mode']))
{
    $mode = $_POST['mode'];

    if(isset($_SESSION['id'],$_POST['eventDescription'],$_POST['eventType']))
    {
      
        if ($mode == "Add") {
        // Adding
            $eventDescription = $_POST['eventDescription'];
            $eventType = $_POST['eventType'];
            $eventDate = $_POST['eventDate'];
            $eventTime = $_POST['eventTime'];

            // Get current date and time
            $currentDate = date('Y-m-d');
            $currentTime = date('H:i');

            // Check if the date is in the past
            if ($eventDate < $currentDate) {
                echo "Error: The selected date cannot be in the past.";
                exit;
            }

            // Check if the date is today and time is in the past
            if ($eventDate === $currentDate && $eventTime < $currentTime) {
                echo "Error: The selected time cannot be in the past.";
                exit;
            }



                $data = array(
                    'user_id' => $_SESSION['id'],
                    'description' => $eventDescription, 
                    'type' => $eventType, 
                    'date' => $eventDate, 
                    'time' => $eventTime, 
                );

               if($db->insertData('calendar', $data))
               {
                echo '200';
               }else{
                echo '500';
               }

        }else{
            echo '500';
        }
    } else {
        echo '400'; // Bad request, no data received
    }
}else{
    if(isset($_POST['id'],$_SESSION['id']))
    {
        if($db->hardDeleteCalendar($_SESSION['id'],$_POST['id']))
        {
            echo '202';
        }else{
            echo '500';
        }
    }else{
        echo '500';
    }
}