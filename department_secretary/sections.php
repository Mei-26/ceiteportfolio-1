<?php include 'components/header.php'?>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <div class="grid grid-cols-3 items-center mb-2">
                <h1 class="text-3xl text-black pb-6 col-span-2">Sections</h1>
                
                <?php 
                if($my_department_id !="")
                {
                  echo '<p class="text-sm flex justify-end items-center">
                    <button type="button" id="openModalButton1"  class="bg-orange text-orange px-5 py-2 rounded-full cursor-pointer hover:opacity-75 flex items-center">
                        <i class="material-icons mr-2">add_circle</i>
                        Add Sections
                    </button>
                </p>';
                }
                ?>
            </div>

                <div class="grid lg:grid-cols-2 md:grid-cols-2  gap-x-20 gap-y-5 p-4">

                <?php 
                $user_id = $_SESSION['id'];
                $department_id = $db->getIdByColumnValue("department_details", "department_secretary", $user_id, 'id');
                $rows = $db->getAllSections($department_id);

               if(count($rows)>0){
                foreach ($rows as $row) {

                    $id = $row['id'];
                    $name = $row['name'];
                    $yearlevel = $row['yearlevel'];

                    $data = "
                        data-id = '".$id."'
                        data-name = '".$name."'
                        data-yearlevel = '".$yearlevel."'
                    ";

                    
                    echo '
                        <div class="card mt-3 md:mt-0 my-3 bg-white active-outline shadow-md rounded-lg px-4 py-5">
                            <div class="grid grid-cols-3 gap-4 items-center">
                                <div class="col-span-2">
                                    <p class="text-lg font-semibold">Section Name: <span class="font-normal">'.ucwords($name).'</span></p>
                                    <p class="text-lg font-semibold">School Year: <span class="font-normal">'.ucwords($yearlevel).'</span></p>
                                </div>
                                <div class="col-span-1 text-right">
                                    <button '.$data.' class="text-green-600 editBtn hover:text-green-800 font-medium bg-green-100 hover:bg-green-200 py-2 px-4 rounded-lg shadow-sm transition duration-200">
                                        Edit
                                    </button>
                                    <button '.$data.' class="text-red-600 deleteBtn hover:text-red-800 font-medium bg-red-100 hover:bg-red-200 py-2 px-4 rounded-lg shadow-sm transition duration-200">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>';
                }
               }else{
                echo '
                <div class="card col-span-3  mt-3 md:mt-0 my-3 bg-white active-outline shadow-md rounded-lg px-4 py-5">
                    <div class="text-center">
                        No Added Sections yet.
                    </div>
                </div>
                    ';
               }
                ?>
                    
                </div>
                
            </main>
    
        </div>
        
    </div>

<?php include 'components/footer.php'?>
<script>
     $('.sections').addClass('active-nav-link');
     $('.sections').removeClass('opacity-75');
</script>


<?php include 'modal/modal-section.php' ?>
<?php include 'modal/modal.php' ?>
<script>
     $('#openModalButton1').click(function() {
        $('.alert-delete').hide()
        $('.form_modal').show()
        $('#modalSection').removeClass('hidden')
                    .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation
        $('#modalSection input:not(#edit_id), #modalSection select').val("");
        $('.sectionText').text('Add Section')
        $('#submitSection').text('Add')
        $('#modalSection > div').css('animation', 'modal-fade-in 0.3s forwards'); // Scale animation
    });
</script>

<script>
  // Open modal and reset form
  $('.deleteBtn').click(function() {
    $('.form_modal').hide()
    var edit_id = ($(this).data('id'))
    var name = ($(this).data('name'))
    var yearlevel = ($(this).data('yearlevel'))
    
    $('#submitSection').text('Delete')
    $('#modalSection').removeClass('hidden')
    $('.sectionText').text('Delete Section');

    $('.alert-delete').show()

    $('#modalSection #edit_id').val(edit_id)
    $('#modalSection #sectionName').val(name)
    $('#modalSection #sectionYearLevel').val(yearlevel)

    $('#modalSection').removeClass('hidden')
      .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation

    $('#modalSection > div').css('animation', 'modal-fade-in 0.3s forwards'); // Scale animation
  });
</script>
<script>
  // Open modal and reset form
  $('.editBtn').click(function() {
    $('.form_modal').show()
    $('.alert-delete').hide()
    var edit_id = ($(this).data('id'))
    var name = ($(this).data('name'))
    var yearlevel = ($(this).data('yearlevel'))
    $('#submitSection').text('Update')
    $('#modalSection').removeClass('hidden')
    $('.sectionText').text('Edit Section');

    $('#modalSection #edit_id').val(edit_id)
    $('#modalSection #sectionName').val(name)
    $('#modalSection #sectionYearLevel').val(yearlevel)

    $('#modalSection').removeClass('hidden')
      .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation

    $('#modalSection > div').css('animation', 'modal-fade-in 0.3s forwards'); // Scale animation
  });
</script>
<script>
$(document).ready(function () {
  var $modal = $('#modalSection');
  var $modalContent = $modal.find('.bg-white');

  function checkClickOutside(event) {
    if (!$modalContent.is(event.target) && $modalContent.has(event.target).length === 0) {
      $modal.addClass('hidden');
    }
  }

  // Attach click event to the modal container
  $modal.on('click', function (event) {
    if ($modal.is(':visible')) {
      checkClickOutside(event);
    }
  });

  // Close modal button event listener
  $('.closeModalButton').on('click', function () {
    $modal.addClass('hidden');
  });
});
</script>
