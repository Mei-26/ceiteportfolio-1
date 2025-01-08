<?php include 'components/header.php'?>
<?php 
    if(isset($_GET['i']) && $_GET['i']!="")
    {
        $id =  preg_replace('/\D/', '', $_GET['i']);
        if($db->getIdByColumnValue("department_details","id",$id,'id')=="")
        {
            echo '
            <script>
                window.location.href="departments.php"
            </script>
            ';
        }else{
        }
    }else{
        echo '
        <script>
            window.location.href="departments.php"
        </script>
        ';
    }
    $department_name = ucwords($db->getIdByColumnValue("department_details","id",$id,"department_name")).' Courses';
    $department_secretary_id = ucwords($db->getIdByColumnValue("department_details","id",$id,"department_secretary"));
?>
    
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                    <div class="container flex text-orange mb-3">
                    <a href="departments.php" class="mr-3">Departments</a> 
                        <p class="mr-3">></p>
                        <p class="mr-3"><?=$department_name?></p> 
                    </div>
                    <h1 class="text-3xl text-black pb-6 col-span-2"><?=$department_name?></h1>

                
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-x-20 gap-y-5 p-4">
                    <?php 
                        $rows = $db->getAllRowsFromTableWhere("course",["department_id=".$_GET['i']]);
                        if (count($rows) > 0) {
                            foreach ($rows as $row) {

                                $id = $row['id'];
                                $name = $row['name'];
                                $image = $row['image'];
                                $secretary_id = $department_secretary_id;

                                $data='
                                data-id="'.$id.'"
                                data-name="'.$name.'"
                                ';

                                $secretary_image = ucwords($db->getIdByColumnValue("user_details","user_id",$secretary_id,"image"));
                                $secretary_name = ucwords($db->getIdByColumnValue("user_details","user_id",$secretary_id,"name"));

                                echo '<div class="card bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                                <img src="../uploads/courses/'.$image.'" class="max-h-full h200 rounded-lg">
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
                                        <a href="subjects.php?c='.$id.'"  
                                        class="bg-orange text-center  text-orange px-4 py-2 rounded-full shadow-lg 
                                                transform transition-transform duration-200 
                                                hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                            Open
                                        </a>
                                    </div>
                            </div>';
                            }
                        } else {
                            echo '<p class="text-gray-500">No courses added yet.</p>';
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