<?php include 'components/header.php'; ?>

<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <main class=" p-6">
    <h1 class="text-3xl text-black pb-6 text-left">Settings</h1>

        <div class="container w-full max-w-lg mx-auto">
            <div class="card bg-white shadow-md rounded-lg px-5 py-5 my-4">
                <div class="flex items-center justify-between">
                    <i class="material-icons">school</i>
                    <p class="text-lg font-bold">Update Academic Year and  Semester</p>
                    <a href="#" id="openYearSem" class="bg-orange text-center px-5 py-1 text-black-500 rounded-lg cursor-pointer hover:opacity-75">
                         <i class="material-icons">edit</i>
                    </a>
                </div>
            </div>

            <div class="card bg-white shadow-md rounded-lg px-5 py-5 my-4" hidden>
                <div class="flex items-center justify-between">
                    <i class="material-icons">menu_book</i>
                    <p class="text-lg font-bold">Add New College</p>
                    <a href="#" id="openModalButton" class="bg-orange text-center px-5 py-1 text-black-500 rounded-lg cursor-pointer hover:opacity-75">
                         <i class="material-icons">edit</i>
                    </a>
                </div>
            </div>

            <div class="card bg-white shadow-md rounded-lg px-5 py-5 my-4">
                <div class="flex items-center justify-between">
                    <i class="material-icons">menu_book</i>
                    <p class="text-lg font-bold">Add New Department</p>
                    <a href="departments.php" class="bg-orange text-center px-5 py-1 text-black-500 rounded-lg cursor-pointer hover:opacity-75">
                         <i class="material-icons">edit</i>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'components/footer.php'; ?>

<script>
    $('.settings').addClass('active-nav-link');
    $('.settings').removeClass('opacity-75');
</script>
<?php include 'modal/modal-college.php' ?>
<?php include 'modal/modal-update_yearsem.php' ?>
<?php include 'modal/modal.php' ?>