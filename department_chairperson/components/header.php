<?php include '../conn/conn.php';
$db = new DatabaseHandler();
if(isset($_SESSION['role']))
{
    if($_SESSION['role']!="department_chairperson")
    {
        echo '<script>
                window.location.href = "../login.php";
        </script>';
    }
}else{
echo '<script>
        window.location.href = "../login.php";
</script>';
}
$defaultSrc = "https://www.pngall.com/wp-content/uploads/13/Secretary-Woman-PNG-Pic.png";
 $src = $db->getIdByColumnValue("user_details","user_id",$_SESSION['id'],"image");
$src = $src!="" ? '../uploads/faculty/'.$src: $defaultSrc;

$my_college_id = $_SESSION['college_id'];
$my_department_id = $db->getIdByColumnValue("department_details", "department_dean", $_SESSION['id'], 'id');

$where = array(
    'college_id'=>$my_college_id,
    'current_status'=>'current',
  );
  
$currentSem = $db->getIdByColumnValueWhere("current_year_sem",$where, "current_sem");
$currentYear = $db->getIdByColumnValueWhere("current_year_sem",$where,"current_year");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Portfolio</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #1e502d; }
        .cta-btn { color: #1e502d; }
        .active-nav-link { background: #f27c22; }
        .searchicon { color: #f27c22; }
        .nav-item:hover { background: #f27c22; }
        .account-link:hover { background: #1e502d; }
        .bg-orange { background: #f8ecdc; }
        .text-orange { color: #e07330; }
        .h200{height: 200px;}
        /* Track */
        ::-webkit-scrollbar {width: 10px;}        
        /* Track */
        ::-webkit-scrollbar-track {box-shadow: inset 0 0 5px grey; border-radius: 10px;}
        /* Handle */::-webkit-scrollbar-thumb {background: #e07330; border-radius: 10px;}
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-2">
            <a href="dashboard.php" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
                <div class="grid grid-cols-2 flex  items-center ">
                    <div>
                        <img src="assets/image/logo.png" alt="">
                    </div>
                    <!-- ... -->
                    <div class="overflow-hidden text-xs ">
                        <p>CEIT</p>
                        <p>Electronic Portfolio</p>
                    </div>
                  </div>
            </a>
        </div>
        <nav class="text-white text-base font-semibold pt-3 ">
            <a href="dashboard.php" class="dashboard flex items-center text-white opacity-75 hover:opacity-100 py-3 m-2 rounded-lg  pl-4 nav-item">
                <i class="material-icons mr-3">menu_book</i>
                Dashboard
            </a>
            <a href="facultymembers.php" class="facultymembers flex items-center rounded-lg opacity-75 text-white py-3 hover:opacity-100  m-2 pl-4 nav-item">
                <i class="material-icons  mr-3">groups</i>
                Faculty Members
            </a>
            <a href="sections.php" class="sections flex items-center rounded-lg opacity-75 text-white py-3 hover:opacity-100  m-2 pl-4 nav-item">
                <i class="material-icons  mr-3">fact_check</i>
                Sections
            </a>
            <a href="documents.php" class="documents flex items-center text-white opacity-75 hover:opacity-100 py-3 m-2 rounded-lg  pl-4 nav-item">
                <i class="material-icons mr-3">fact_check</i>
                Documents
            </a>
            <a href="calendar.php" class="calendar flex items-center text-white opacity-75 hover:opacity-100 py-3 m-2 rounded-lg  pl-4 nav-item">
                <i class="material-icons mr-3">calendar_month</i>
                Calendar
            </a>
            <a href="about.php" class="about flex items-center text-white opacity-75 hover:opacity-100 py-3 m-2 rounded-lg  pl-4 nav-item">
                <i class="material-icons mr-3">info</i>
                About
            </a>
            
        </nav>
    </aside>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-3 px-6 hidden sm:flex">
            <div class="w-1/2">
                <div class="relative w-3/4">
                <?php 
                    $faculty_rows = $db->getAllFaculties();
                    ?>
                    <i class="material-icons searchicon absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">search</i>
                    <input type="text" id="facultySearch" placeholder="Search here" class="pl-10 focus:outline-none focus:ring focus:ring-gray-300 rounded-full border-2 border-gray py-2 px-3 w-full" oninput="searchFaculty()">

                    <!-- Container for displaying search suggestions -->
                    <div id="suggestions" class="absolute bg-white border border-gray-200 mt-2 rounded-md w-full z-10 hidden"></div>
                    </div>
            </div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <div class="grid grid-cols-2 items-center justify-center">
                    <div class="grid mr-3 flex justify-end">
                        <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                            <img src="<?=$src?>">
                        </button>
                    </div>
                    <div class="grid">
                        <p class="text-base font-bold"><?=ucwords($db->getIdByColumnValue("user_details","user_id",$_SESSION['id'],"name"))?></p>
                        <p class="text-sm font-light"><?=ucwords(str_replace(' ', ' ', ucwords(str_replace('_', ' ', $_SESSION['role']))))?></p>
                    </div>
                </div>
                <div x-show="isOpen" style="z-index: 99999;" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="edit-profile.php" class="block px-4 py-2 account-link hover:text-white">Your Profile</a>
                    <a href="#" id="openAccountButton" class="block px-4 py-2 account-link hover:text-white">Account</a>
                    <a href="logout.php" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false, isProfileOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="dashboard.php" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="dashboard.php" class="dashboard flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item rounded-lg m-1">
                    <i class="material-icons mr-3">menu_book</i>
                    Dashboard
                </a>
                <a href="facultymembers.php" class="facultymembers flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item rounded-lg m-1">
                    <i class="material-icons  mr-3">groups</i>
                    Faculty Members
                </a>
                <a href="sections.php" class="sections flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item rounded-lg m-1">
                    <i class="material-icons  mr-3">fact_check</i>
                    Sections
                </a>
                <a href="documents.php" class="documents flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item rounded-lg m-1">
                    <i class="material-icons mr-3">fact_check</i>
                    Documents
                </a>
                <a href="calendar.php" class="calendar flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item rounded-lg m-1">
                    <i class="material-icons mr-3">calendar_month</i>
                    Calendar
                </a>
                <a href="about.php" class="about flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item rounded-lg m-1">
                    <i class="material-icons mr-3">info</i>
                    About
                </a>

                <div class="border-t border-white mt-2 pt-2">
                    
                    <button @click="isProfileOpen = !isProfileOpen" class="text-white text-left w-full px-4 py-2 focus:outline-none">
                    <div class="flex flex-col text-center items-center">
                        <img src="https://www.pngall.com/wp-content/uploads/13/Secretary-Woman-PNG-Pic.png" class="h-8 w-8 rounded-full border-2 border-gray-300" alt="Profile">
                        <p class="text-sm font-light"><?=ucwords(str_replace(' ', ' ', ucwords(str_replace('_', ' ', $_SESSION['role']))))?></p>
                    </div>
                    </button>
                    <div x-show="isProfileOpen" class="bg-white text-black mt-2 rounded-lg shadow-lg py-2">
                        <a href="edit-profile.php" class="block px-4 py-2 account-link hover:text-white">Your Profile</a>
                        <a href="#" id="openAccountButton2" class="block px-4 py-2 account-link hover:text-white">Account</a>
                        <a href="logout.php" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                    </div>
                </div>
               
            </nav>
          
        </header>

        
        
<script>
   const facultyList = [
    <?php
    $facultyArray = [];
    foreach ($faculty_rows as $row) {
        $facultyArray[] = "{name: '" . addslashes($row['name']) . "', id: '" . $row['id'] . "'}";
    }
    echo implode(",\n", $facultyArray);  // Join array elements with commas
    ?>
];


    function searchFaculty() {
        const input = document.getElementById("facultySearch").value.toLowerCase();
        const suggestionsBox = document.getElementById("suggestions");
        suggestionsBox.innerHTML = ''; // Clear previous suggestions

        // Filter faculty list based on the search input
        const matchingFaculties = facultyList.filter(faculty => faculty.name.toLowerCase().includes(input));

        // Show suggestions if there are matches
        if (matchingFaculties.length > 0) {
            suggestionsBox.classList.remove('hidden');
            matchingFaculties.forEach(faculty => {
                const suggestionItem = document.createElement('div');
                suggestionItem.className = 'p-2 cursor-pointer hover:bg-gray-100';
                suggestionItem.innerHTML = faculty.name;

                // On clicking a suggestion, redirect to that faculty member's page
                suggestionItem.onclick = () => {
                    window.location.href = `facultymembers-info.php?i=${faculty.id}`;
                };
                
                suggestionsBox.appendChild(suggestionItem);
            });
        } else {
            suggestionsBox.classList.add('hidden');
        }
    }
</script>
