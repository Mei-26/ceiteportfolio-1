<?php include 'components/header.php'?>
    
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <div class="grid grid-cols-3 items-center mb-2">
                <h1 class="text-3xl text-black pb-6 col-span-2">Faculty Members</h1>
                
            </div>


                <div class="flex">
                    <p class="md:px-10 px-1 faculty-type cursor-pointer hover:bg-gray-300 hover:text-white py-2 border-2 border-gray bg-white mr-3 rounded-lg">All</p>
                    <p class="md:px-10 px-1 faculty-type cursor-pointer hover:bg-gray-300 hover:text-white py-2 border-2 border-gray bg-white mr-3 rounded-lg">Regular</p>
                    <p class="md:px-10 px-1 faculty-type cursor-pointer hover:bg-gray-300 hover:text-white py-2 border-2 border-gray bg-white mr-3 rounded-lg">Contractual</p>
                    <p class="md:px-10 px-1 faculty-type cursor-pointer hover:bg-gray-300 hover:text-white py-2 border-2 border-gray bg-white mr-3 rounded-lg">Department Secretaries</p>
                </div>

                <p class="my-4 font-bold text-xl"></p>
                <div class="grid lg:grid-cols-2 md:grid-cols-2  gap-x-20 gap-y-5 p-4">

                <?php 
                $rows = $db->getAllFaculties();
                $count=0;

                foreach ($rows as $row) {

                    $id = $row['id'];
                    
                    $college_id =  $db->getIdByColumnValue('college_user_added','user_id',$id,'college_id');

                    $role = $row['role'];
                    $name = $row['name'];
                    $specialization = $row['specialization'];
                    $phone = $row['phone'];
                    $image = $row['image'];
                    $type = $row['type'];


                    if($role =="college_secretary" )
                    {
                        $checker = $db->getIdByColumnValue('college_officers','college_secretary_id',$id,'college_id');
                        if($checker !=$my_college_id)
                        {
                            continue;
                        }
                    }else if($role =="college_secretary" )
                    {
                        $checker = $db->getIdByColumnValue('college_officers','college_dean_id',$id,'college_id');
                        if($checker !=$my_college_id)
                        {
                            continue;
                        }
                    }else{
                        if($college_id !=$my_college_id)
                        {
                            continue;
                        }
                    }
                  





                    $count++;
                   
                    
                    echo '<div data-type="'.$type.'" data-role="'.$role.'" class="card mt- md:mt-0 my-3 bg-white active-outline shadow-md rounded-lg px-3 py-3">
                      <div class="grid gap-x-3 place-items-end grid-flow-col-dense grid-cols-3 items-end">
                    <img style="height:100px" src="../uploads/faculty/'.$image.'" class="object-cover w-full rounded-lg ">
                    <div class="container ">
                        <p>'.ucwords($name).'</p>
                        <p>'.ucwords($specialization).'</p>
                        <p>'.ucwords($phone).'</p>
                        <p class="whitespace-nowrap">'.str_replace(' ', ' ', ucwords(str_replace('_', ' ', $role))).'</p>
                    </div>
                        <a href="facultymembers-info.php?i='.$row['id'].'" class="bg-orange mt-3 text-center w-full text-orange px-1 py-2 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                            View
                        </a>
                    </div>
                </div>';
                }

                
                if($count==0)
                {
                    echo '
                    <div class="card mt- md:mt-0 my-3 bg-white active-outline shadow-md rounded-lg px-3 py-3">
                    No data.
                </div>
                    ';
                }
                ?>
                    
                </div>
                
            </main>
    
        </div>
        
    </div>

<?php include 'components/footer.php'?>
<script>
     $('.facultymembers').addClass('active-nav-link');
     $('.facultymembers').removeClass('opacity-75');

     $('.faculty-type').click(function(){
        $('.faculty-type').removeClass('active-nav-link');
        $('.faculty-type').removeClass('text-white');
        $(this).addClass('active-nav-link');
        $(this).addClass('text-white');
        var filter = $.trim($(this).text());

       $(".card").each(function(){
            var type = $(this).data('type');

            if(filter==="All")
            {
                $(this).show()
            }else if(filter==="Department Secretaries"){
                var role = $(this).data('role');

                if(role=="department_secretary"){
                    $(this).show()
                }else{
                    $(this).hide()
                }
            }else{
                if(type!=filter){
                    $(this).hide()
                }else{
                    $(this).show()
                }
            }
        });
     })
    
</script>


<?php include 'modal/modal.php' ?>
