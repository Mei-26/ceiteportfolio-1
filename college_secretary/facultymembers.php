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
                
                <p class="text-sm flex justify-end items-center">
                    <button type="button" id="openModalButton"  class="bg-orange text-orange px-5 py-2 rounded-full cursor-pointer hover:opacity-75 flex items-center">
                        <i class="material-icons mr-2">add_circle</i>
                        Add Faculty
                    </button>
                </p>
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
                    card($college_dean_type,'college_dean',$college_dean_image,$college_dean_name,$college_dean_specialization,$college_dean_phone,$college_dean_id,$college_dean_id,'');
                    }  
                        //    DEPARTMENT SECRETARY
                    if($college_secretary_name!="xx")
                    {
                        card($college_secretary_type,'college_secretary',$college_secretary_image,$college_secretary_name,$college_secretary_specialization,$college_secretary_phone,$college_secretary_id,$college_secretary_id,'');
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
                    if($depatment_college !=$my_college_id)
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
                $data='
                    data-id="'.$department_dean_id.'"
                    data-role="dean"
                    data-department_id="'.$department_id.'"
                ';
                if($dean_name!="xx")
                {
                    card($dean_type,'department_dean',$dean_image,$dean_name,$dean_specialization,$dean_phone,$department_dean_id,$department_id,$data);
                }
                 
                   
                //    DEPARTMENT SECRETARY
                $data='
                    data-id="'.$department_secretary_id.'"
                    data-role="secretary"
                    data-department_id="'.$department_id.'"
                ';

                if($secretary_name!="xx")
                {
                    card($secretary_type,'department_secretary',$secretary_image,$secretary_name,$secretary_specialization,$secretary_phone,$department_secretary_id,$department_id,$data);
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

                    //    DEPARTMENT SECRETARY
                    $data='
                    data-id="'.$id.'"
                    data-role="faculty"
                    data-department_id="'.$faculty_department_id.'"
                    ';

                
                    
                    echo '<div data-type="'.$type.'" data-id="'.$department_id.'" data-role="'.$role.'" class="card card_'.$department_id.' mt- md:mt-0 my-3 bg-white active-outline shadow-md rounded-lg px-3 py-3">
                      <div class="grid gap-x-3 place-items-end grid-flow-col-dense grid-cols-3 items-end">
                    <img style="height:100px" src="../uploads/faculty/'.$image.'" class="object-cover w-full rounded-lg ">
                    <div class="container ">
                        <p>'.ucwords($name).'</p>
                        <p>'.ucwords($specialization).'</p>
                        <p>'.ucwords($phone).'</p>
                        <p class="whitespace-nowrap">'.str_replace(' ', ' ', ucwords(str_replace('_', ' ', $role))).'</p>
                    </div>
                          <div class="s w-full">
                    
                      <div class="grid">
                     <div class="relative inline-block text-right">
                        <div>
                            <i class="option_download material-icons bg-orange  cursor-pointer hover:opacity-50 rounded-full " data-id="'.$row['id'].'">more_horiz</i>
                        </div>
                        <div class="absolute right-0 z-10 mt-0 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none option_download_content option_download_content_'.$row['id'].'"
                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            
                        
                        <div class="py-1 text-center" role="none">
                                        <a href="#" '.$data.' class="editBtnDepartment block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Change Status</a>
                                        <a href="#" '.$data.' class="editBtnType block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">Change Type</a>
                                        <a href="#" '.$data.' class="editBtnRole block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">Change Role</a>
                                        </div>
                                    </div>
                                </div>
                    </div>
                       
                        
                        <div class="grid">
                            <a href="facultymembers-info.php?i='.$id.'" class="bg-orange mt-3 text-center w-full m text-orange px-1 py-2 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                View
                            </a>
                        </div>

                    </div>

                    </div>
                </div>';
                }




                   
                   echo '</div>';
                   echo '</div>';

               



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


<?php include 'modal/modal-faculty.php' ?>
<?php include 'modal/modal.php' ?>

<?php 
function card($type,$role,$image,$name,$specialization,$phone,$id,$department_id,$data)
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
    $data_opt ='';
    if($data!="")
    {
        $data_opt = '
        <div class="grid">
                     <div class="relative inline-block text-right">
                        <div>
                            <i class="option_download material-icons bg-orange  cursor-pointer hover:opacity-50 rounded-full " data-id="'.$id.'">more_horiz</i>
                        </div>
                        <div class="absolute right-0 z-10 mt-0 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none option_download_content option_download_content_'.$id.'"
                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            
                        
                        <div class="py-1 text-center" role="none">
                                        <a href="#" '.$data.' class="editBtnDepartment block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Change Status</a>
                                        <a href="#" '.$data.' class="editBtnType block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">Change Type</a>
                                        <a href="#" '.$data.' class="editBtnRole block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">Change Role</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
        ';
    }
    
    echo '<div data-type="'.$type.'" data-role="'.$role.'" class="card card_'.$department_id.' mt- md:mt-0 my-3 bg-white active-outline shadow-md rounded-lg px-3 py-3">
    <div class="grid gap-x-3 place-items-end grid-flow-col-dense grid-cols-3 items-center">
  <img style="height:100px" src="../uploads/faculty/'.$image.'" class="object-cover w-full rounded-lg ">
  <div class="container ">
      <p>'.ucwords($name).'</p>
      <p>'.ucwords($specialization).'</p>
      <p>'.ucwords($phone).'</p>
      <p class="whitespace-nowrap">'.str_replace(' ', ' ', ucwords(str_replace('_', ' ', $name_role))).'</p>
  </div>

  
 
  
      <div class="s w-full flex flex-col justify-end">
                    
                      
                       '.$data_opt.'
                        
                        <div class="grid ">
                            <a href="facultymembers-info.php?i='.$id.'" class="bg-orange mt-3 text-center w-full m text-orange px-1 py-2 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                View
                            </a>
                        </div>

                    </div>

 </div>
</div>';
}

?>
<script>
    $(document).ready(function() {
            $('.origin-top-right').toggle();
            // Toggle visibility when clicking the button
            $('.option_download').click(function(event) {
                var id = $(this).data('id');
                $('.option_download_content_'+id).toggle();
                // Stop event from bubbling up to document
                event.stopPropagation();
            });

            // Hide the content when clicking outside
            $(document).click(function(event) {
                var target = $(event.target);
                // Check if the click target is outside the content
                if (!target.closest('.option_download_content').length && !target.is('.option_download')) {
                    $('.option_download_content').hide();
                }
            });
        });
</script>

<script>
    $('.editBtnDepartment').click(function(){
        $('.option_download_content').hide();
        var faculty_id = $(this).data('id');

        // SweetAlert confirmation alert with dropdown for status selection
        Swal.fire({
            title: 'Change Account Status',
            text: "Do you want to delete this account?",
            icon: 'question',
            input: 'select',
            inputOptions: {
                '1': 'Delete'    // Value = 0 for disable
            },
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value === '') {
                        resolve('You need to select a status!')
                    } else {
                        resolve();
                    }
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var selectedStatus = result.value; // Pass selected status here

                // AJAX call to status_faculty.php with faculty_id and selected status
                $.ajax({
                    url: 'controller/status_faculty.php',
                    method: 'POST',
                    data: {
                        faculty_id: faculty_id,  // Send faculty_id
                        status: selectedStatus   // Send selected status (1 = Activate, 0 = Disable)
                    },
                    success: function(response) {
                        alertMaker(response)
                    }
                });
            }
        });
    });
</script>
<script>
    $('.editBtnType').click(function(){
        $('.option_download_content').hide();
        var faculty_id = $(this).data('id');

        // SweetAlert confirmation alert with dropdown for status selection
        Swal.fire({
            title: 'Change Account Type',
            text: "Do you want to change type?",
            icon: 'question',
            input: 'select',
            inputOptions: {
                'Regular': 'Regular',  // Value = 1 for activate
                'Contractual': 'Contractual'    // Value = 0 for disable
            },
            inputPlaceholder: 'Select account status',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value === '') {
                        resolve('You need to select a status!')
                    } else {
                        resolve();
                    }
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var selectedStatus = result.value; // Pass selected status here

                // AJAX call to status_faculty.php with faculty_id and selected status
                $.ajax({
                    url: 'controller/status_faculty.php',
                    method: 'POST',
                    data: {
                        faculty_id: faculty_id,  // Send faculty_id
                        status: selectedStatus   // Send selected status (1 = Activate, 0 = Disable)
                    },
                    success: function(response) {
                        alertMaker(response)
                    }
                });
            }
        });
    });
</script>

<script>
    $('.editBtnRole').click(function(){
        $('.option_download_content').hide();
        var faculty_id = $(this).data('id');
        var role = $(this).data('role');
        var department_id = $(this).data('department_id');

        // SweetAlert confirmation alert with dropdown for status selection
        Swal.fire({
            title: 'Change Account Role',
            text: "Do you want to change role?",
            icon: 'question',
            input: 'select',
            inputOptions: {
                'college_secretary': 'College Secretary',  // Value = 1 for activate
                'college_dean': 'College Dean',  // Value = 1 for activate
                'department_chairperson': 'Department Chairperson',  // Value = 1 for activate
                'department_secretary': 'Department Secretary',    // Value = 0 for disable
                'faculty': 'Faculty'    // Value = 0 for disable
            },
            inputPlaceholder: 'Select account role',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value === '') {
                        resolve('You need to select a status!')
                    } else {
                        resolve();
                    }
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var selectedStatus = result.value; // Pass selected status here

                // AJAX call to status_faculty.php with faculty_id and selected status
                $.ajax({
                    url: 'controller/change_role.php',
                    method: 'POST',
                    data: {
                        faculty_id: faculty_id,  // Send faculty_id
                        role_selected: selectedStatus,  // Send selected status (1 = Activate, 0 = Disable)
                        past_role: role,  // Send selected status (1 = Activate, 0 = Disable)
                        department_id: department_id,  // Send selected status (1 = Activate, 0 = Disable)
                    },
                    success: function(response) {
                        alertMaker(response)
                    }
                });
            }
        });
    });
</script>

