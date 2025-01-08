<div>
    <table class="min-w-full text-left border-collapse block table overflow-y-scroll">
        <thead class="block table-header-group">
            <tr class="block table-row text-black">
                <th style="font-size:13px" class="font-semibold uppercase tracking-wider block table-cell">
                    Faculty Members
                </th>
                <th style="font-size:13px" class="font-semibold uppercase tracking-wider block table-cell"></th>
                <th style="font-size:13px" class="font-semibold uppercase tracking-wider block table-cell">Status</th>
            </tr>
        </thead>
        <tbody class="block table-row-group">
            <tr>
                <td class="bg-red-300 togler" rowspan="5" width="110px">
                    <img width="80%" src="../uploads/faculty/66bd97ce4c5eb-a.jpg" alt="">
                </td>
            </tr>
            <tr>
                <td style="font-size:11px">Full Name : </td>
                <td rowspan="4" style="font-size:11px">
                    <i class="material-icons text-white bg-red-400 rounded-full p-1">error</i>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:11px">Position :</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:11px">Specialization :</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:11px">Contacts :</td>
            </tr>

            <!-- Toggler Section -->
            <tr>
                <td colspan="3">
                    <button data-card="1" class="toggle-btn bg-gray-200 text-gray-600 px-2 py-1 rounded-md text-xs font-medium hover:bg-gray-300">
                        Toggle Document Status
                    </button>
                </td>
            </tr>

            <!-- Collapsible Section -->
            <tr data-card_col="1" class="collapse hidden">
                <td colspan="3">
                    <h1 style="font-size:11px" class="text-gray-400 font-bold mt-3 mb-3">
                        DOCUMENT STATUS - <span class="text-red-500">PENDING</span>
                    </h1>
                </td>
            </tr>
            <tr data-card_col="1" class="collapse hidden">
                <td style="font-size:11px" class="font-semibold text-gray-400 uppercase tracking-wider block table-cell">
                    Subjects
                </td>
                <td style="font-size:11px" class="font-semibold text-gray-400 uppercase tracking-wider block table-cell">
                    Status
                </td>
                <td style="font-size:11px" class="font-semibold text-gray-400 uppercase tracking-wider block table-cell">
                    Section
                </td>
            </tr>
            <tr data-card_col="1" class="collapse hidden">
                <td colspan="3">
                    <div class="card p-2">
                        <div class="grid grid-cols-3 items-center">
                            <!-- Link Section -->
                            <a class=" items-center gap-4" href="syllabustracking-info.php?s='.$subject_id.'&uid='.$upload_id.'&sem='.$semester.'&sy='.$academicYear.'">
                                <i class="material-icons text-orange text-5xl">folder</i>
                                <div class="flex flex-col" style="font-size: 8px;">
                                    <p class="font-semibold text-gray-800">DCIT60A</p>
                                    <p class="text-gray-500">Methods of Research</p>
                                </div>
                            </a>

                            <!-- Icon Section -->
                            <div class="flex justify-center">
                                <i class="material-icons text-white bg-red-400 rounded-full p-1">task_alt</i>
                            </div>

                            <!-- Label Section -->
                            <p style="font-size: 8px;" class="text-center text-gray-700 font-medium">BSIT 1</p>
                        </div>
                    </div>
                </td>
            </tr>



          

        </tbody>
    </table>
</div>

