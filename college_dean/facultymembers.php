<?php include 'components/header.php'?>
<?php 
 $title = '
 <a href="facultymembers.php" class="mr-3">Faculty Members</a>
 ';
$_SESSION['dashboard'] =$title;

?>
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
                <!-- <div class="grid lg:grid-cols-2 md:grid-cols-2  gap-x-20 gap-y-5 p-4"> -->

                <?php 

                // $college_rows = $db->getAllRowsFromTable('college_officers');
                // foreach($college_rows as $college_row)
                //     {
                            
                    $college_secretary_id = $db->getIdByColumnValue('college_officers','college_id',$my_college_id,'college_secretary_id') ?? 'xx' ;
                    $college_dean_id = $db->getIdByColumnValue('college_officers','college_id',$my_college_id,'college_dean_id') ?? 'xx' ;

                    $college_dean_name = $db->getIdByColumnValue('user_details','user_id',$college_dean_id,'name') ?? 'xx';
                    $college_dean_specialization = $db->getIdByColumnValue('user_details','user_id',$college_dean_id,'specialization') ?? 'xx';
                    $college_dean_phone = $db->getIdByColumnValue('user_details','user_id',$college_dean_id,'phone') ?? 'xx';
                    $college_dean_image = $db->getIdByColumnValue('user_details','user_id',$college_dean_id,'image') ?? 'xx';
                    $college_dean_type = $db->getIdByColumnValue('users','id',$college_dean_id,'type') ?? 'xx';


                    $college_secretary_name = $db->getIdByColumnValue('user_details','user_id',$college_secretary_id,'name') ?? 'xx';
                    $college_secretary_specialization = $db->getIdByColumnValue('user_details','user_id',$college_secretary_id,'specialization') ?? 'xx';
                    $college_secretary_phone = $db->getIdByColumnValue('user_details','user_id',$college_secretary_id,'phone') ?? 'xx';
                    $college_secretary_image = $db->getIdByColumnValue('user_details','user_id',$college_secretary_id,'image') ?? 'xx';
                    $college_secretary_type = $db->getIdByColumnValue('users','id',$college_secretary_id,'type') ?? 'xx';
                    
                    echo '<div class="grid lg:grid-cols-2 md:grid-cols-2  gap-x-20 gap-y-5 p-4">';

                     //    DEPARTMENT SECRETARY
                     if($college_dean_name!="xx")
                     {
                     card($college_dean_type,'college_dean',$college_dean_image,$college_dean_name,$college_dean_specialization,$college_dean_phone,$college_dean_id,$college_dean_id);
                     }  
                     //    DEPARTMENT SECRETARY
                     if($college_secretary_name!="xx")
                     {
                        card($college_secretary_type,'college_secretary',$college_secretary_image,$college_secretary_name,$college_secretary_specialization,$college_secretary_phone,$college_secretary_id,$college_secretary_id);
                     }

                     echo '</div>';


                        $count=0;
                        $department_rows = $db->getAllRowsFromTable('department_details');


                        foreach($department_rows as $department_row)
                        {
                    
                            
                            $department_id = $department_row['id'];
                            $department_name = $department_row['department_name'];
                            $department_code = $department_row['department_code'];
                            $department_dean_id = $department_row['department_dean'];
                            $department_secretary_id = $department_row['department_secretary'];
                            $depatment_college = $department_row['depatment_college'];

                            if($depatment_college !=$my_college_id )
                            {
                                continue;
                            }
                           
                            $dean_name = $db->getIdByColumnValue('user_details','user_id',$department_dean_id,'name') ?? 'xx';
                            $dean_specialization = $db->getIdByColumnValue('user_details','user_id',$department_dean_id,'specialization') ?? 'xx';
                            $dean_phone = $db->getIdByColumnValue('user_details','user_id',$department_dean_id,'phone') ?? 'xx';
                            $dean_image = $db->getIdByColumnValue('user_details','user_id',$department_dean_id,'image') ?? 'xx';
                            $dean_type = $db->getIdByColumnValue('users','id',$department_dean_id,'type') ?? 'xx';


                            $secretary_name = $db->getIdByColumnValue('user_details','user_id',$department_secretary_id,'name') ?? 'xx';
                            $secretary_specialization = $db->getIdByColumnValue('user_details','user_id',$department_secretary_id,'specialization') ?? 'xx';
                            $secretary_phone = $db->getIdByColumnValue('user_details','user_id',$department_secretary_id,'phone') ?? 'xx';
                            $secretary_image = $db->getIdByColumnValue('user_details','user_id',$department_secretary_id,'image') ?? 'xx';
                            $secretary_type = $db->getIdByColumnValue('users','id',$department_secretary_id,'type') ?? 'xx';
                            
                        echo '<div class="container depCode" data-id="'.$department_id.'">'; 
                        echo '<p class="text-gray-700   text-lg font-semibold uppercase">'.$department_code.'</p>';

                        echo '<div class="grid lg:grid-cols-2 md:grid-cols-2  gap-x-20 gap-y-5 p-4">';
                        
                        //    DEPARTMENT SECRETARY
                        if($dean_name!="xx")
                        {
                        card($dean_type,'department_dean',$dean_image,$dean_name,$dean_specialization,$dean_phone,$department_dean_id,$department_id);
                        }  
                        //    DEPARTMENT SECRETARY
                        if($secretary_name!="xx")
                        {
                        card($secretary_type,'department_secretary',$secretary_image,$secretary_name,$secretary_specialization,$secretary_phone,$department_secretary_id,$department_id);
                        }

                            //    GET ALL FACULTY

                        $rows = $db->getAllFaculties2();
                        $count=0;
                        foreach ($rows as $row) {

                            $id = $row['id'];

                            $faculty_department_id = $db->getIdByColumnValue('department_faculty','faculty_id',$id,'department_id');

                            if($department_id != $faculty_department_id)
                            {
                                continue;
                            }

                            $role = $row['role'];
                            $name = $row['name'];
                            $specialization = $row['specialization'];
                            $phone = $row['phone'];
                            $image = $row['image'];
                            $type = $row['type'];



                            $count++;



                        
                            
                            echo '<div data-type="'.$type.'" data-id="'.$department_id.'" data-role="'.$role.'" class="card card_'.$department_id.' mt- md:mt-0 my-3 bg-white active-outline shadow-md rounded-lg px-3 py-3">
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




                        
                        echo '</div>';
                        echo '</div>';

                    



                        }
                    // }

                ?>
                    
                </div>
                
            </main>
    
        </div>
        
    </div>
<?php 
function card($type,$role,$image,$name,$specialization,$phone,$id,$department_id)
{
    if($role=="department_dean")
    {
        $name_role="Department Chairperson";
    }
    else if($role=="department_secretary")
    {
        $name_role="Department Secretary";
    }
    else {
        $name_role = str_replace(' ', ' ', ucwords(str_replace('_', ' ', $role)));
    }

    echo '<div data-type="'.$type.'" data-role="'.$role.'" class="card card_'.$department_id.' mt- md:mt-0 my-3 bg-white active-outline shadow-md rounded-lg px-3 py-3">
    <div class="grid gap-x-3 place-items-end grid-flow-col-dense grid-cols-3 items-end">
  <img style="height:100px" src="../uploads/faculty/'.$image.'" class="object-cover w-full rounded-lg ">
  <div class="container ">
      <p>'.ucwords(string: $name).'</p>
      <p>'.ucwords($specialization).'</p>
      <p>'.ucwords($phone).'</p>
      <p class="whitespace-nowrap">'.str_replace(' ', ' ', ucwords(str_replace('_', ' ', $name_role))).'</p>
  </div>
      <a href="facultymembers-info.php?i='.$id.'" class="bg-orange mt-3 text-center w-full text-orange px-1 py-2 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 hover:shadow-xl hover:bg-orange-600">
          View
      </a>
  </div>
</div>';
}

?>
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


        $('.depCode').each(function() {
            var counter = 0; // Initialize a counter for visible cards under this depCode
            var department_id = $(this).data('id')
            $(".card_"+department_id).each(function() {
                var type = $(this).data('type'); // Get the type of the card
                var role = $(this).data('role'); // Get the role of the card (if applicable)

                if (filter === "All") {
                    $(this).show();
                    counter += 1; // Increment counter for visible cards
                } else if (filter === "Department Secretaries") {
                    if (role === "department_secretary") {
                        $(this).show();
                        counter += 1; // Increment counter for department secretaries
                    } else {
                        $(this).hide();
                    }
                } else {
                    if (type != filter) {
                        $(this).hide();
                    } else {
                        $(this).show();
                        counter += 1; // Increment counter for matching types
                    }
                }
            });
    console.log(counter)
    // Show or hide depCode based on whether any cards are visible
    if (counter === 0) {
        $(this).hide(); // Hide depCode if no associated cards are visible
    } else {
        $(this).show(); // Show depCode if associated cards are visible
    }
});



    //    $(".card").each(function(){
    //         var type = $(this).data('type');

    //         if(filter==="All")
    //         {
    //             $(this).show()
    //             $('.depCode').each(function() {
    //                 $(this).show();
    //             });

    //         }else if(filter==="Department Secretaries"){
    //             var role = $(this).data('role');

    //             if(role=="department_secretary"){
    //                 $(this).show()
    //             }else{
    //                 $(this).hide()
    //             }
    //         }else{
    //             if(type!=filter){
    //                 $(this).hide()
    //             }else{
    //                 $(this).show()
    //             }
    //         }
    //     });
     })
    
</script>


<?php include 'modal/modal-faculty.php' ?>
<?php include 'modal/modal.php' ?>
