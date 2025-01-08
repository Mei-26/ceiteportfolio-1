<?php include 'components/header.php'?>
<style>
  .fc .fc-toolbar.fc-header-toolbar {
    background-color: #e07330; /* Change this to your desired color */
    color: #ffff;            /* Text color for better readability */
    border-radius: 8px;        /* Optional: Add rounded corners */
    padding: 8px;              /* Optional: Add padding */
  }

  .fc .fc-toolbar.fc-header-toolbar h2 {
    color: #ffff;            /* Title color */
    margin: 0;                 /* Remove default margin */
    padding: 0;                /* Remove default padding */
  }

  .fc .fc-button {
    background-color: #e07330; /* Button background color */
    border: none;              /* Remove border */
    color: #ffff;            /* Button text color */
    margin: 2px;               /* Optional: Add margin between buttons */
  }

  .fc .fc-button:hover {
    opacity: 50px; /* Button hover color */
  }

  .fc .fc-button:focus {
    box-shadow: none;          /* Remove focus outline */
    outline: none;             /* Remove outline on focus */
  }

  .fc .fc-button-primary:not(:disabled):active {
    opacity: 50px; /* Button active color */
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script>
      // document.addEventListener('DOMContentLoaded', function() {
      //   var calendarEl = document.getElementById('calendar');
      //   var calendar = new FullCalendar.Calendar(calendarEl, {
      //     initialView: 'dayGridMonth',
      //     headerToolbar: {
      //       left: 'prev ',
      //       center: 'title',
      //       right:'next'
      //     },
         
      //   });
      //   calendar.render();
      // });

      document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        events: 'controller/get_events.php', // Replace with the actual path to your PHP script
        editable: true, // Optional: allows you to drag and drop events
        selectable: true, // Optional: allows you to select time slots
        eventClick: function(info) {
          console.log(info.event)
          console.log(info.event.extendedProps)
          console.log(info.event.extendedProps.propertyIsEnumerable())
            // Show SweetAlert with event details
            Swal.fire({
                title: info.event.title, // Event title
                icon: 'info',
                confirmButtonText: 'Close',
                // Optional: handle button actions
                preConfirm: () => {
                    // Code for edit action (if needed)
                    // For example, you could open an edit form/modal
                    console.log('Edit clicked');
                }
            });
        },
        eventDidMount: function(info) {
            // Customize appearance of events based on type
            if (info.event.extendedProps.type === 'todo') {
                info.el.style.backgroundColor = '#007bff'; // Custom color for todos
                info.el.style.borderColor = '#007bff';
            } else if (info.event.extendedProps.type === 'event') {
                info.el.class.backgroundColor = '#e07330'; // Custom color for events
                info.el.class.borderColor = '#e07330';
            }
        }
    });
    calendar.render();
});



    </script>
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">

                <div class="grid grid-cols-3 items-center">
                    <h1 class="text-3xl text-black pb-6 col-span-2">Faculty Calendar</h1>
                    
                    <p class="text-sm flex justify-end items-center">
                        <button type="button" class="btnAddCalendar bg-orange text-orange px-5 py-2 rounded-full cursor-pointer hover:opacity-75 flex items-center">
                            <i class="material-icons mr-2">add_circle</i>
                            Add New
                        </button>
                    </p>

                </div>

                <div class="grid grid-cols-1 gap-0 sm:gap-10 md:grid-cols-3 ">
                    <div class="col-span-2 border-2 border-gray-300 rounded-xl">
                        <div id='calendar'></div>
                    </div>
                    <div>
                        <div style="height:250px" class="grid overflow-y-scroll  border-2 my-4 border-gray-300">
                            <p style="height:25px" class="active-nav-link text-center text-white font-bold">Events</p>
                            <div class="flex  justify-center">
                            <ul class="list-disc pl-5">
                              <?php 
                              $rows = $db->getAllCalendar($_SESSION['id'], 'Events');
                              
                              if(count($rows)>0){
                                foreach ($rows as $row) {
                                  echo '
                                  <li class="my-2 text-gray-400 flex justify-between">
                                      <span>' . ucwords($row['description']) . '</span>
                                      <button class="text-red-600 deleteItem" data-id="' . $row['id'] . '" data-type="Events">
                                          <i class="material-icons">delete</i>
                                      </button>
                                  </li>
                                  ';
                                }
                              }else{
                                echo '<p>No data.</p>';
                              }
                              ?>  
                          </ul>
                        </div>
                        </div>
                        
                        <div style="height:250px" class="grid overflow-y-scroll  border-2 my-4 border-gray-300">
                            <p style="height:25px"  class="text-center bg-green-700 text-white font-bold">ToDo</p>
                            <div class="flex  justify-center">
                            <ul class="list-disc pl-5">
                                <?php 
                                $rows = $db->getAllCalendar($_SESSION['id'], 'ToDo');
                                
                                if(count($rows)>0){
                                  foreach ($rows as $row) {
                                    echo '
                                    <li class="my-2 text-gray-700 flex justify-between">
                                        <span>' . ucwords($row['description']) . '</span>
                                        <button class="text-red-600 deleteItem" data-id="' . $row['id'] . '" data-type="ToDo">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </li>
                                    ';
                                }
                                }else{
                                  echo '<p>No data.</p>';
                                }
                                ?>  
                            </ul>
                          </div>
                    </div>


                </div>

                
                
                
            </main>
    
        </div>
        
    </div>
<?php include 'modal/modal-calendar.php'?>
<?php include 'modal/modal.php'?>
<?php include 'components/footer.php'?>
<script>
     $('.calendar').addClass('active-nav-link');
     $('.calendar').removeClass('opacity-75');
</script>

<script>
  $('.btnAddCalendar').click(function(){
        $('#subject_id').val($(this).data('id'))
        $('#modalTitle').text('Add Event')
        $('#submitCalendar').text('Add')
        $('#modalCalendar').removeClass('hidden')
                    .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation

        $('#modalCalendar > div').css('animation', 'modal-fade-in 0.3s forwards'); // Scale animation
    
    })
</script>
<script>
  $(document).ready(function () {
  var $modal = $('#modalCalendar');
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
<script>
  $(document).on('click', '.deleteItem', function() {
      var itemId = $(this).data('id');
      var itemType = $(this).data('type');
      
      // Use SweetAlert to show a confirmation modal
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {
              // If the user confirms, proceed with the deletion
              $.ajax({
                  url: 'controller/calendar.php',
                  type: 'POST',
                  data: { id: itemId, type: itemType },
                  success: function(response) {
                      alertMaker(response)
                  },
                  error: function() {
                      Swal.fire(
                          'Error!',
                          'There was an error deleting the item.',
                          'error'
                      );
                  }
              });
          }
      });
  });
</script>

