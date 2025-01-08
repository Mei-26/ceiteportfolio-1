<?php include 'components/header.php' ?>
<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
        <div class="container flex items-center mb-6">
            <h1 class="text-3xl text-black mr-3">Syllabus Acceptance</h1>
            <select name="" id="" class="px-3 py-2 rounded-lg bg-orange text-orange border ">
                <option value="">First Sem - 2023 -2024</option>
                <option value="">Second Sem - 2023 -2024</option>
            </select>
        </div>

        <div class="grid p-3 gap-x-20 md:grid-cols-2">
            <div class="">
                <div class="container flex mb-4 items-center">
                    <h1 class="text-base text-gray-500 font-bold mr-3">TRACKING</h1>
                    <select class="px-3 py-2 text-base rounded-lg bg-orange text-orange border ">
                        <option value="">DIT</option>
                    </select>
                </div>
            </div>
            <div>
            </div>
        </div>
        <div class="container p-4">
            <table class="min-w-full text-left border-collapse block table overflow-y-scroll">
                <thead class="block table-header-group">
                    <tr class="block table-row bg-orange text-black">
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Subjects</th>
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Status</th>
                        <th class="p-3 font-semibold text-sm uppercase tracking-wider block table-cell">Date Modified</th>
                    </tr>
                </thead>
                <tbody class="block table-row-group">
                        <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
                  
                            <td class="p-3 block table-cell">
                                <a href="syllabustracking-info.php">
                                    <div class="flex flex-row text-justify items-center">
                                        <i class="material-icons text-orange text-5xl mr-3">folder</i>
                                        <div class="flex flex-col">
                                            <p class="font-semibold text-gray-800">DCIT60A</p>
                                            <p class="text-gray-500">Methods of Research</p>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td class="p-3 block table-cell">
                                <i class="material-icons text-white bg-green-400 rounded-full p-1">task_alt</i>
                            </td>
                            <td class="p-3 block table-cell">11/23/2023</td>
                        </tr>

                    <tr class="block table-row bg-white hover:bg-orange transition duration-200 ease-in">
                        <td class="p-3 block table-cell">
                            <a href="syllabustracking-info.php">
                                <div class="flex flex-row text-justify items-center">
                                    <i class="material-icons text-orange text-5xl mr-3">folder</i>
                                    <div class="flex flex-col">
                                        <p class="font-semibold text-gray-800">ITEC55</p>
                                        <p class="text-gray-500">System Analysis and Design</p>
                                    </div>
                                </div>
                            </a>
                        </td>
                        <td class="p-3 block table-cell">
                            <i class="material-icons text-white bg-red-400 rounded-full p-1">error</i>
                        </td>
                        <td class="p-3 block table-cell">--/--/----</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>

<?php include 'components/footer.php' ?>
<script>
    $('.syllabustracking').addClass('active-nav-link');
    $('.syllabustracking').removeClass('opacity-75');
</script>
