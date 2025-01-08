<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Portfolio</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
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
            <a href="profile.php" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
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
            <a href="profile.php" class="profile flex items-center text-white opacity-75 hover:opacity-100 py-3 m-2 rounded-lg  pl-4 nav-item">
                <i class="material-icons mr-3">person</i>
                Profile
            </a>
            <a href="facultymembers.php" class="facultymembers flex items-center rounded-lg opacity-75 text-white py-3 hover:opacity-100  m-2 pl-4 nav-item">
                <i class="material-icons  mr-3">groups</i>
                Faculty Members
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
                    <!-- <i class="material-icons searchicon absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">search</i>
                    <input type="text" placeholder="Search here" class="pl-10  focus:outline-none focus:ring focus:ring-gray-300  rounded-full border-2 border-gray py-2 px-3 w-full"> -->
                </div>
            </div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <div class="grid grid-cols-2 items-center justify-center">
                    <div class="grid mr-3 flex justify-end">
                        <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                            <img src="https://www.pngall.com/wp-content/uploads/13/Secretary-Woman-PNG-Pic.png">
                            
                        </button>
                    </div>
                    <div class="grid">
                        <p class="text-base font-bold">Faculty Full Name</p>
                        <p class="text-sm font-light">Instructor 1</p>
                    </div>
                </div>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="edit-profile.php" class="block px-4 py-2 account-link hover:text-white">Your Profile</a>
                    <a href="index.php" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="profile.php" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="profile.php" class="profile flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item rounded-lg m-1">
                    <i class="material-icons mr-3">person</i>
                    Profile
                </a>
                <a href="facultymembers.php" class="facultymembers flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item rounded-lg m-1">
                    <i class="material-icons  mr-3">groups</i>
                    Faculty Members
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
               
            </nav>
          
        </header>