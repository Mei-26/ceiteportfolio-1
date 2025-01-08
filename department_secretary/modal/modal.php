<style>
      /* Adding custom keyframes for animation */
      @keyframes modal-fade-in {
        from {
          opacity: 0;
          transform: scale(0.9);
        }
        to {
          opacity: 1;
          transform: scale(1);
        }
      }

      @keyframes modal-fade-out {
        from {
          opacity: 1;
          transform: scale(1);
        }
        to {
          opacity: 0;
          transform: scale(0.9);
        }
      }
</style>


 <script>
        $(document).ready(function() {
            // Open the modal
            $('#openModalButton').click(function() {
                $('#modal input:not(#edit_id), #modal select').val("");
                $('#submitDepartment').text('Add')
                $('#modal').removeClass('hidden')
                           .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation

                $('#modal > div').css('animation', 'modal-fade-in 0.3s forwards'); // Scale animation
            });

            $('#openYearSem').click(function() {
                $('#modalYearSem').removeClass('hidden')
                           .css('animation', 'modal-fade-in 0.3s forwards'); // Apply fade-in animation

                $('#modalYearSem > div').css('animation', 'modal-fade-in 0.3s forwards'); // Scale animation
            
            });

           


            
            // Close the modal
            $('#closeModalButton, #modal ,.closeModalButton, #modalYearSem').click(function(event) {
                if ( event.target.id === 'closeModalButton') {
                    $('#modal').css('animation', 'modal-fade-out 0.3s forwards');

                    $('#modal > div').css('animation', 'modal-fade-out 0.3s forwards');


                    
                    setTimeout(() => {
                        $('#modal').addClass('hidden');
                    }, 300); // Duration of the transition
                }

                if (event.target.id === 'modalYearSem' || event.target.id === 'btnClosemodalYearSem' ) {
                    $('#modalYearSem').css('animation', 'modal-fade-out 0.3s forwards');

                    $('#modalYearSem > div').css('animation', 'modal-fade-out 0.3s forwards');

                    setTimeout(() => {
                        $('#modalYearSem').addClass('hidden');
                    }, 300); // Duration of the transition
                }

                $('.mowdal').css('animation', 'modal-fade-out 0.3s forwards');

                $('.mowdal > div').css('animation', 'modal-fade-out 0.3s forwards');



                setTimeout(() => {
                    $('.mowdal').addClass('hidden');
                }, 300); // Duration of the transition

            });

            
        });
    </script>

<!-- ALERT MAKER -->
    <script>
    function alertMaker(response) {
        // Handle the response from the server
        switch (response) {
            case "300":
                Swal.fire({
                    title: "Oops..!",
                    text: "Please fill in all the fields.",
                    icon: "info"
                });
                break;
            case "301":
                Swal.fire({
                    title: "Oops..!",
                    text: "New Password and Confirm Password do not match.",
                    icon: "info"
                });
                break;
            case "401":
                Swal.fire({
                    title: "Oops..!",
                    text: "Update Failed.",
                    icon: "error"
                });
                break;
            case "402":
                Swal.fire({
                    title: "Oops..!",
                    text: "Password is incorrect",
                    icon: "error"
                });
                break;
            case "413":
                Swal.fire({
                    title: "Oops..!",
                    text: "Image is too large",
                    icon: "info"
                });
                break;
            case "415":
                Swal.fire({
                    title: "Oops..!",
                    text: "Unsupported media type",
                    icon: "info"
                });
                break;
            case "500":
                Swal.fire({
                    title: "Oops..!",
                    text: "Insertion Error",
                    icon: "info"
                });
                break;
            case "200":
                Swal.fire({
                    title: "Success!",
                    text: "Added Successfully",
                    icon: "success"
                }).then(() => {
                    location.reload(); // Reload the page after the alert is closed
                });
                break;
            case "201":
                Swal.fire({
                    title: "Success!",
                    text: "Updated Successfully",
                    icon: "success"
                }).then(() => {
                    location.reload(); // Reload the page after the alert is closed
                });
                break;
            case "202":
                Swal.fire({
                    title: "Success!",
                    text: "Deleted Successfully",
                    icon: "success"
                }).then(() => {
                    location.reload(); // Reload the page after the alert is closed
                });
                break;
            default:
                Swal.fire({
                    title: "Response",
                    text: response,
                    icon: "warning"
                });
                break;
        }
    }
</script>

