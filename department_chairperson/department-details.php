<?php include 'components/header.php' ?>
<?php 
    if(isset($_GET['i']) && $_GET['i']!="")
    {
        $id = preg_replace('/\D/', '', $_GET['i']);
        if($db->getIdByColumnValue("department_details", "id", $id, 'id') == "")
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
    
    $department_name = ucwords($db->getIdByColumnValue("department_details", "id", $id, "department_name")) . ' Management';
?>

<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
        <div class="container flex text-orange mb-3">
            <a href="dashboard.php" class="mr-3">Dashboard</a> 
            <p class="mr-3">></p>
            <p class="mr-3"><?=$department_name?></p> 
        </div>

        <div class="grid grid-cols-3 items-center">
            <h1 class="text-3xl text-black pb-6 col-span-2"><?=$department_name?></h1>
        </div>

        <?php 
            // Fetching details for dean and secretary
            $department_dean_id = $db->getIdByColumnValue("department_details", "id", $id, 'department_dean');
            $department_secretary_id = $db->getIdByColumnValue("department_details", "id", $id, 'department_secretary');

            $department_dean_name = $db->getIdByColumnValue("user_details", "user_id", $department_dean_id, 'name');
            $department_dean_image = $db->getIdByColumnValue("user_details", "user_id", $department_dean_id, 'image');
            $department_secretary_name = $db->getIdByColumnValue("user_details", "user_id", $department_secretary_id, 'name');
            $department_secretary_image = $db->getIdByColumnValue("user_details", "user_id", $department_secretary_id, 'image');
            
            // Assuming faculty members are fetched here
            
            $faculty_members = $db->getAllRowsFromTableWhere("department_faculty", ['department_id='.$id]);
        ?>

        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-x-8 gap-y-5 p-4">
            <!-- Dean Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <img src="../uploads/faculty/<?=$department_dean_image?>" alt="Dean Image" class="w-32 h-32 rounded-full mx-auto mb-4">
                <h2 class="text-xl font-semibold"><?=$department_dean_name?></h2>
                <p class="text-gray-600">Department Chairperson</p>
            </div>

            <!-- Secretary Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <img src="../uploads/faculty/<?=$department_secretary_image?>" alt="Secretary Image" class="w-32 h-32 rounded-full mx-auto mb-4">
                <h2 class="text-xl font-semibold"><?=$department_secretary_name?></h2>
                <p class="text-gray-600">Department Secretary</p>
            </div>

            <!-- Faculty Members -->
            <?php foreach ($faculty_members as $faculty): 
                $faculty_name = $db->getIdByColumnValue("user_details", "user_id", $faculty['faculty_id'], 'name');
                $faculty_image = $db->getIdByColumnValue("user_details", "user_id", $faculty['faculty_id'], 'image');
                
                ?>


                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="../uploads/faculty/<?=$faculty_image?>" alt="Faculty Image" class="w-32 h-32 rounded-full mx-auto mb-4">
                    <h2 class="text-xl font-semibold"><?=ucwords($faculty_name)?></h2>
                    <p class="text-gray-600">Faculty Member</p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php include 'modal/modal-courses.php' ?>
<?php include 'components/footer.php' ?>
<script>
    $('.dashboard').addClass('active-nav-link');
    $('.dashboard').removeClass('opacity-75');
</script>
