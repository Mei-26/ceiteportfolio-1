<?php include 'components/header.php'?>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow ">

                <div class="grid grid-cols-3 items-center px-6 py-4 ">
                    <h1 class="text-3xl text-black col-span-2">About</h1>
                </div>

                <div class="grid grid-cols-3  bg-sidebar text-white py-4">

                    <div class="text-center ">
                      <i class="material-icons text-5xl searchicon">school</i>
                      <p><?=$db->getCountByConditions('course',['status' =>'0' , 'college_id' => $_SESSION['college_id']] )?></p>
                      <p> Courses</p>
                    </div>
                    <div class="text-center ">
                      <i class="material-icons text-5xl searchicon">groups</i>
                      <p><?= $db->getCounterUsersDep($_SESSION['college_id']) ?></p>
                      <p> FACULTY MEMBERS</p>
                    </div>
                    <div class="text-center ">
                      <i class="material-icons text-5xl searchicon">manage_accounts</i>
                      <p><?=$db->getCounter('department_secretary',$_SESSION['college_id'])?></p>
                      <p> SECRETARIES</p>
                    </div>

                </div>

                <div class="grid  p-3">
                  <p class="text-black p-3 text-2xl font-bold">E- Portfolio System</p>
                  <p class="text-center"> An E-Portfolio System is a digital platform designed to help users create, manage, and showcase their personal or professional portfolios online. It offers features such as personalized profiles, customizable portfolio sections for work and achievements, and content management for documents, images, and multimedia files. Users can highlight projects, list skills and certifications, and control privacy settings to manage who can view their portfolios. The system supports responsive design for accessibility on various devices, includes search and filtering options, and integrates with social media for enhanced online presence. Additionally, it provides analytics and feedback tools to track interactions and receive comments.
                  </p>
                </div>
                
                <div class="grid  p-3">
                  <p class="text-black p-3 text-2xl font-bold">Instructions </p>
                  <p class="text-center"> An E-Portfolio System is a digital platform designed to help users create, manage, and showcase their personal or professional portfolios online. It offers features such as personalized profiles, customizable portfolio sections for work and achievements, and content management for documents, images, and multimedia files. Users can highlight projects, list skills and certifications, and control privacy settings to manage who can view their portfolios. The system supports responsive design for accessibility on various devices, includes search and filtering options, and integrates with social media for enhanced online presence. Additionally, it provides analytics and feedback tools to track interactions and receive comments.
                  </p>
                </div>
                
            </main>
    
        </div>
        
    </div>

<?php include 'components/footer.php'?>
<script>
     $('.about').addClass('active-nav-link');
     $('.about').removeClass('opacity-75');
</script>