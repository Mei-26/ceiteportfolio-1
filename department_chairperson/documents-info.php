<?php include 'components/header.php' ?>
<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
        <div class="container flex text-orange mb-3">
            <p class="mr-3">Documents</p> 
            <p class="mr-3">></p>
            <p class="mr-3">Tracking</p> 
        </div>
        <div class="container flex items-center mb-6">
            <h1 class="text-3xl text-black mr-3">Methods of Research</h1>
        </div>

        <div class="container p-4">
            <table class="min-w-full text-left border-collapse block table overflow-y-scroll">
                <thead class="block table-header-group">
                    <tr class="block table-row bg-orange text-black">
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Faculty Members</th>
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Status</th>
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Sections</th>
                    </tr>
                </thead>
                <tbody class="block table-row-group">
                    <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
                        <td class="p-3 block table-cell">
                            <div class="flex flex-row text-justify items-center">
                                <img src="https://hips.hearstapps.com/hmg-prod/images/of-facebook-mark-zuckerberg-walks-to-lunch-following-a-news-photo-1683662107.jpg?crop=0.663xw:0.475xh;0.162xw,0.101xh&resize=640:*" style="height: 100px; width:100px;" class="rounded-lg mr-3" alt="">
                                <div class="flex flex-col">
                                    <p class="font-semibold text-gray-800">Full Name</p>
                                    <p class="font-semibold text-gray-800">Position</p>
                                    <p class="font-semibold text-gray-800">Specialization</p>
                                    <p class="font-semibold text-gray-800">Contacts</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-3 block table-cell">
                            <i class="material-icons text-white bg-green-400 rounded-full p-1">task_alt</i>
                        </td>
                        <td class="p-3 block table-cell">BSIT 3-1</td>
                    </tr>

                    <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
                        <td class="p-3 block table-cell">
                            <div class="flex flex-row text-justify items-center">
                                <img src="https://hips.hearstapps.com/hmg-prod/images/of-facebook-mark-zuckerberg-walks-to-lunch-following-a-news-photo-1683662107.jpg?crop=0.663xw:0.475xh;0.162xw,0.101xh&resize=640:*" style="height: 100px; width:100px;" class="rounded-lg mr-3" alt="">
                                <div class="flex flex-col">
                                    <p class="font-semibold text-gray-800">Full Name</p>
                                    <p class="font-semibold text-gray-800">Position</p>
                                    <p class="font-semibold text-gray-800">Specialization</p>
                                    <p class="font-semibold text-gray-800">Contacts</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-3 block table-cell">
                            <i class="material-icons text-white bg-red-400 rounded-full p-1">error</i>
                        </td>
                        <td class="p-3 block table-cell">BSIT 3-1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>

<?php include 'components/footer.php' ?>
<script>
    $('.documents').addClass('active-nav-link');
    $('.documents').removeClass('opacity-75');
</script>
