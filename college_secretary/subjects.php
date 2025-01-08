<?php include 'components/header.php'?>
<?php 

    if(isset($_GET['c']) && $_GET['c']!="")
    {
        $id =  preg_replace('/\D/', '', $_GET['c']);
        if($db->getIdByColumnValue("course","id",$id,'id')=="")
        {
            echo '
            <script>
                window.location.href="dashboard.php"
            </script>
            ';
        }
    }else{
        echo '
        <script>
            window.location.href="dashboard.php"
        </script>
        ';
    }

    $department_id = ucwords($db->getIdByColumnValue("course","id",$id,"department_id"));
    $department_name = ucwords($db->getIdByColumnValue("department_details","id",$department_id,"department_name")).' Courses';
    $department_secretary_id = ucwords($db->getIdByColumnValue("department_details","id",$department_id,"department_secretary"));

    $course_name = ucwords($db->getIdByColumnValue("course","id",$id,"name")).' Subjects';
    $title = '
        <a href="departments.php" class="mr-3">Departments</a>
        <p class="mr-3">></p>
        <a href="courses.php?i='.$department_id.'" class="mr-3">' . htmlspecialchars($department_name, ENT_QUOTES, 'UTF-8') . '</a> 
        <a class="mr-3">></a>
        <a href="subjects.php?c='.$id.'" class="mr-3">' . htmlspecialchars($course_name, ENT_QUOTES, 'UTF-8') . '</a>
    ';
    $_SESSION['dashboard']=$title;
?>
    
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                

                    <div class="container flex text-orange mb-3">
                        <?=$title?>
                   </div>

                <h1 class="text-3xl text-black pb-6 col-span-2"><?=$course_name?></h1>

                
                <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-x-20 gap-y-5 p-4">
                    <?php 
                        $rows = $db->getAllRowsFromTableWhere("subject",["course_id=".$_GET['c']]);
                        if (count($rows) > 0) {
                            foreach ($rows as $row) {

                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $image = $row['image'];
                                $secretary_id = $department_secretary_id;

                                $data = '
                                data-id="'.$id.'"
                                data-name="'.$name.'"
                                data-code="'.$code.'"
                                ';

                                $secretary_image = ucwords($db->getIdByColumnValue("user_details","user_id",$secretary_id,"image"));
                                $secretary_name = ucwords($db->getIdByColumnValue("user_details","user_id",$secretary_id,"name"));

                                echo '<div class="card bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                                <img src="../uploads/subjects/'.$image.'" class="max-h-full h200 rounded-lg">
                                <div class="flex flex-row items-center mt-2 w-full justify-between">
                                    <span class="truncate md:truncate">'.$name.'</span>
                                
                                    
                                </div>
                                
                                <div class="flex flex-row items-center mt-3 w-full">
                                   <div class="x">
                                        <img src="../uploads/faculty/'.$secretary_image.'" class="mr-3 w-10 h-10 rounded-full" alt="user_image">
                                        </div>
                                    <div class="grid w-full">
                                        <p class="text-base whitespace-nowrap">'.$secretary_name.'</p>
                                        <p class="text-sm">Secretary</p>
                                
                                    </div>
                                </div>
                                <div class="grid w-full justify-items-end">
                                    <a href="documents-research.php?s='.$id.'"  
                                    class="bg-orange text-center  text-orange px-4 py-2 rounded-full shadow-lg 
                                                    transform transition-transform duration-200 
                                                    hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                        Open
                                    </a>
                                </div>
                                
                            </div>';
                            }
                        } else {
                            echo '<p class="text-gray-500">No subjects added yet.</p>';
                        }
                    ?>
                </div>
                
            </main>
    
        </div>
        
    </div>

<?php include 'components/footer.php'?>
<script>
     $('.departments').addClass('active-nav-link');
     $('.departments').removeClass('opacity-75');
</script>