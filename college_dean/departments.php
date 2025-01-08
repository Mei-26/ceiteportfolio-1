<?php include 'components/header.php'?>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">


            <div class="grid grid-cols-3 items-center">
                <h1 class="text-3xl text-black pb-6 col-span-2">Departments</h1>
                
            </div>
                
                <div class="grid lg:grid-cols-3 md:grid-cols-2  gap-x-20 gap-y-5 p-4">
                    <?php 
                    $rows = $db->getAllRowsFromTable('department_details');
                    $count = 0;

                    foreach ($rows as $row) {
                        $id = $row['id'];
                        $depatment_college = $row['depatment_college'];
                       
                        if($my_college_id!=$depatment_college){
                            continue;
                        }
                        $count++;
                        
                        $department_name = $row['department_name'];
                        $department_secretary = $row['department_secretary'];
                        $secretary_name = ucwords($db->getIdByColumnValue("user_details",'user_id',$department_secretary,'name'));
                        $secretary_image = ($db->getIdByColumnValue("user_details",'user_id',$department_secretary,'image')) ?? 'default.png';
                        $department_code = strtoupper($row['department_code']);
                        $department_image = $row['department_image'];
                        $depatment_college = $row['depatment_college'];
                        $department_dean = $row['department_dean'];

                        $data='
                            data-department_name="'.$department_name.'"
                            data-department_secretary="'.$department_secretary.'"
                            data-department_code="'.$department_code.'"
                            data-department_dean="'.$department_dean.'"
                            data-id="'.$id.'"
                        ';


                        echo '<div class="card bg-white shadow-md rounded-lg p-6 flex justify-center flex-col ">
                                    <img src="../uploads/departments/'.$department_image.'" class="max-h-full h200 rounded-lg">
                                    <div class="flex flex-row mt-2 truncate md:truncate">
                                    '.$department_code.' - '.ucwords($department_name).'

                                        <div class="relative inline-block text-left">
                                                
                                        </div>
                                    </div>



                        </button>
                                    <div class="flex flex-row items-center mt-3">
                                       <div class="x">
                                        <img src="../uploads/faculty/'.$secretary_image.'" class="mr-3 w-10 h-10 rounded-full" alt="user_image">
                                        </div>
                                        <div class="grid w-full ">
                                            <p class="text-base">'.$secretary_name.'</p>
                                            <p class="text-sm">Secretary</p>
                                        </div>
                                    </div>
                                    <div class="grid w-full justify-items-end">
                                            <a href="courses.php?i='.$id.'"  
                                            class="bg-orange text-center  text-orange px-4 py-2 rounded-full shadow-lg 
                                                    transform transition-transform duration-200 
                                                    hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                                Open
                                            </a>
                                        </div>
                                </div>';
                    }

                    if($count==0){
                        echo 'No added Department yet';
                    }
                    
                    ?>
                    </div>
                    
                </div>
                
            </main>
    
        </div>
        
    </div>

<?php include 'components/footer.php'?>
<script>
     $('.departments').addClass('active-nav-link');
     $('.departments').removeClass('opacity-75');
</script>
<?php include 'modal/modal.php' ?>
