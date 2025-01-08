<?php 
require '../../conn/conn.php';
$db = new DatabaseHandler();

if(isset($_POST['schoolyear'],$_SESSION['id']))
{
    if(trim($_POST['schoolyear'])=="")
    {
        echo "
        <div class='card text-center bg-white shadow-md flex flex-col rounded-lg p-6 col-span-3'>
            <p>It looks like you haven't added any subjects yet.</p>
        </div>
        ";
        exit;
    }
    $schoolyear = $_POST['schoolyear'];
    list($semester, $academicYear) = explode(" - ", $schoolyear);

    $user_id = $_SESSION['id'];
    // $rows = $db->getAllRowsFromTableWhere("faculty_subject",['faculty_id='.$user_id,]);
    $rows = $db->getAllRowsFromTableWhere("faculty_subject",
    ['faculty_id='.$user_id,'sy='."'$academicYear'",'sem='."'$semester'"
    ]);



    if(count($rows) != 0) {
        foreach ($rows as $row) {

            $subject_id = $row['subject_id'];
            $image = $db->getIdByColumnValue('subject','id',$subject_id,'image');
            $code = $db->getIdByColumnValue('subject','id',$subject_id,'code');
            $name = $db->getIdByColumnValue('subject','id',$subject_id,'name');
        
        echo '
        <div class="card bg-white shadow-md flex flex-col rounded-lg p-6">
        <div class="flex justify-center sm:justify-center md:justify-center">
                    <img src="../uploads/subjects/' . htmlspecialchars($image) . '" alt="Image of ' . htmlspecialchars($name) . '"  class="max-h-full h200 rounded-lg mb-3">
                </div>   
                <p class="flex"><span class="font-bold truncate md-truncate">' . htmlspecialchars(ucwords($name)) . '</span></p>
                <p><span class="font-bold">' . htmlspecialchars(strtoupper($code)) . '</span></p>
                <div class="flex flex-row items-center mt-3">
                    <div class="grid w-full">
                        <p class="text-sm text-right">
                            <a href="documents-research.php?s='.$subject_id.'&sem='.$semester.'&sy='.$academicYear.' " class="bg-orange text-center  text-orange px-4 py-2 rounded-full shadow-lg 
                            transform transition-transform duration-200 
                            hover:scale-105 hover:shadow-xl hover:bg-orange-600">Open</a>
                        </p>
                    </div>
                </div>
        </div>
        ';
        }
    }else{
        echo "
        <div class='card text-center bg-white shadow-md flex flex-col rounded-lg p-6 col-span-3'>
            <p>It looks like you haven't added any subjects yet.</p>
        </div>

        ";
    }
}

    ?>