<?php include 'components/header.php'?>
    <style>
         .active-outline {
            outline: 1px solid #FFA500; /* Orange color */
            max-width: 100%;
            background-color: #FFFFFF; /* White */
            border-radius: 0.5rem; /* Rounded corners */
            border: 1px solid #E5E7EB; /* Border */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06); /* Shadow */
        }
  
    </style>
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                

                    <div class="container flex text-orange mb-3">
                        <a href="dashboard.php" class="mr-3">Dashboard</a>  
                        <p class="mr-3">></p>
                        <p class="mr-3">DIT Courses</p> 
                        <p class="mr-3">></p>
                        <p class="mr-3">BSIT Subjects </p>
                        <p class="mr-3">></p>
                        <p class="mr-3">Methods of Research </p>
                   </div>

                <div class="container flex items-center mb-6">
                <h1 class="text-3xl text-black mr-3">Methods of Research</h1>
                <select name="" id="" class="px-3 py-2 rounded-lg bg-orange text-orange">
                    <option value="">First Sem - 2023 -2024</option>
                    <option value="">Second Sem - 2023 -2024</option>
                </select>
                </div>

                <div  class="grid p-3  gap-x-20  md:grid-cols-2">

                    <div class="">
                    <div class="container flex mb-4 items-center">
                        <h1 class="text-base text-gray-500 font-bold mr-3">DOCUMENTS</h1>
                        <select class="px-3 py-2 text-base rounded-lg bg-orange text-orange">
                            <option value="">BSIT 3-2</option>
                        </select>
                    </div>
                        <div style="height:500px" class="card bg-white items-center flex flex-col shadow-md rounded-lg p-10 ">
                            <div class="container flex justify-end  text-right">
                                


                                <div class="relative inline-block text-left">
                                <div>
                                
                                    <i id="option_download" class="material-icons bg-orange  cursor-pointer hover:opacity-50 rounded-full ">more_horiz</i>
                                    
                                </div>

                                <div class="absolute right-0 z-10 mt-0 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" id="option_download_content" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                    <div class="py-1" role="none">

                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Lorem ipsum</a>
                                    
                                    </div>
                                </div>
                                </div>




                            </div>
                                <img style="height: 350px;" src="https://www.iconpacks.net/icons/2/free-pdf-file-icon-2614-thumb.png" class="m-0" alt="">
                                <p class="text-center font-bold ">Syllabus Acceptance</p>
                                <p class="text-center mt-4">
                                    <span class="bg-orange text-center px-10 py-2 text-orange rounded-full cursor-pointer hover:opacity-75">Open</span>
                                </p>
                        </div>
                    </div>
                <div>
                

                <div class="overflow-y-scroll px-4" style="height:500px ">
                    <p class="text-gray-500 m- my-4 font-bold text-base">Faculty Members</p>
                        
                        <div class="card mt- md:mt-0 my-3 bg-white active-outline shadow-md rounded-lg px-3 py-3">
                              <div class="grid gap-x-3 place-items-end grid-flow-col-dense grid-cols-3 items-end">
                            <img style="height:100px" src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="object-cover w-full rounded-lg ">
                            <div class="container ">
                                <p>Full Name:</p>
                                <p>Position</p>
                                <p>Specialization</p>
                                <p>Contacts</p>
                            </div>
                                <p class="bg-orange mt-3 text-center w-full text-orange px-1 py-2 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                    View
                                </p>
                            </div>
                        </div>

                        <div class="card mt- md:mt-0 bg-white my-3 shadow-md rounded-lg px-3 py-3">
                            <div class="grid gap-x-3 grid-flow-col-dense grid-cols-3 items-center">
                            <img style="height:100px"  src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="object-cover w-full rounded-lg ">
                            <div class="container ">
                                <p>Full Name:</p>
                                <p>Position</p>
                                <p>Specialization</p>
                                <p>Contacts</p>
                            </div>
                                <p class="bg-orange mt-3 text-center w-full text-orange px-1 py-2 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                    View
                                </p>
                            </div>
                        </div>

                        <div class="card mt- md:mt-0 bg-white my-3 shadow-md rounded-lg px-3 py-3">
                            <div class="grid gap-x-3 grid-flow-col-dense grid-cols-3 items-center">
                            <img style="height:100px"  src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="object-cover w-full rounded-lg ">
                            <div class="container ">
                                <p>Full Name:</p>
                                <p>Position</p>
                                <p>Specialization</p>
                                <p>Contacts</p>
                            </div>
                                <p class="bg-orange mt-3 text-center w-full text-orange px-1 py-2 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                    View
                                </p>
                            </div>
                        </div>
                        <div class="card mt- md:mt-0 bg-white my-3 shadow-md rounded-lg px-3 py-3">
                            <div class="grid gap-x-3 grid-flow-col-dense grid-cols-3 items-center">
                            <img style="height:100px"  src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="object-cover w-full rounded-lg ">
                            <div class="container ">
                                <p>Full Name:</p>
                                <p>Position</p>
                                <p>Specialization</p>
                                <p>Contacts</p>
                            </div>
                                <p class="bg-orange mt-3 text-center w-full text-orange px-1 py-2 rounded-full shadow-lg transform transition-transform duration-200 hover:scale-105 hover:shadow-xl hover:bg-orange-600">
                                    View
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                </div>

                
                
                
            </main>
    
        </div>
        
    </div>

<?php include 'components/footer.php'?>
<script>
     $('.dashboard').addClass('active-nav-link');
     $('.dashboard').removeClass('opacity-75');
</script>
<script>
    $(document).ready(function() {
            $('#option_download_content').toggle();
            // Toggle visibility when clicking the button
            $('#option_download').click(function(event) {
                $('#option_download_content').toggle();
                // Stop event from bubbling up to document
                event.stopPropagation();
            });

            // Hide the content when clicking outside
            $(document).click(function(event) {
                var target = $(event.target);

                // Check if the click target is outside the content
                if (!target.closest('#option_download_content').length && !target.is('#option_download')) {
                    $('#option_download_content').hide();
                }
            });
        });
</script>