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
                $('#modal input, #modal select').val("")
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

                if (event.target.id === 'btnClosemodalYearSem' ) {
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

            case "501":
            Swal.fire({
                title: "Oops..!",
                text: "Email or Employment ID is already used",
                icon: "info"
            });
            break;
            case "503":
            Swal.fire({
                title: "Oops..!",
                text: "There was something wrong in sending the email.",
                icon: "error"
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
                    title: "Unknown Response",
                    text: response,
                    icon: "warning"
                });
                break;
        }
    }
</script>




<!-- COLLEGE -->
    
    <script>
        $(document).ready(function(){
            $('#submitCollege').click(function(event){
                var mode = $.trim($(this).text());
                event.preventDefault(); // Prevent the default form submission behavior

                var formValid = true; // Assume form is valid initially

                // Check each input and select for non-null value
                $('#collegeForm input, #collegeForm select').each(function(){
                    if ($(this).val() === "") {
                        formValid = false; // Set formValid to false if any field is empty
                    } 
                });

                if (!formValid) {
                    Swal.fire({
                        title: "Oops..!",
                        text: "Please complete all required fields.",
                        icon: "info"
                    });
                    return; // Exit the function if the form is invalid
                }

                // Create a FormData object
                var formData = new FormData($('#collegeForm')[0]);
                
                // Append the mode data
                formData.append('mode', mode);

                // Log the FormData (for debugging purposes)
                for (var pair of formData.entries()) {
                    console.log(pair[0]+ ': ' + pair[1]); 
                }

                $.ajax({
                    url: 'controller/college.php', // Replace with your server endpoint URL
                    type: 'POST', // Use 'GET' or 'POST' depending on your server setup
                    data: formData,
                    processData: false,  // Tell jQuery not to process the data
                    contentType: false,  // Tell jQuery not to set contentType
                    success: function(response) {
                      alertMaker(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if the request fails
                        console.error('Error submitting form:', error);
                    }
                });
            });
        });


    </script>



<!-- FACULTY -->
    
<script>
        $(document).ready(function() {
    $('#submitFaculty').click(function(event) {
        var mode = $.trim($(this).text());
        event.preventDefault(); // Prevent the default form submission behavior

        var formValid = true; // Assume form is valid initially
        var facultyEmail = $('#facultyEmail').val();

        // Check if the email ends with @cvsu.edu.ph
        if (!facultyEmail.endsWith('@cvsu.edu.ph')) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Email',
                text: 'Email must end with @cvsu.edu.ph!',
            });
            return;
        }

        var facultyPassword = $('#facultyPassword').val();

        // Check if the password length is at least 8 characters
        if (facultyPassword.length < 8) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Password',
                text: 'Password must be at least 8 characters long!',
            });
            return;
        }

        // Check for at least one uppercase letter and one symbol
        const regex = /^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).+$/;
        if (!regex.test(facultyPassword)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Password',
                text: 'Password must contain at least one uppercase letter and one symbol!',
            });
            return;
        }

        $('#facultyForm input, #facultyForm select').each(function() {
            if ($(this).val() === "") {
                // Special logic for facultyDepartment
                if ($(this).attr('id') === "facultyDepartment") {
                    var facultyPosition = $('#facultyPosition').val();
                    if (facultyPosition === "department_secretary" || facultyPosition === "department_chairperson") {
                        formValid = false; // Set formValid to false if conditions match
                    }
                } else {
                    formValid = false; // Set formValid to false for other empty fields
                }
            }
        });
        const contactValue = $('#facultyContacts').val();
      
        // Check if length is exactly 11
        if (contactValue.length !== 11) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Contact number',
                text: 'Contact number must be exactly 11 characters long.',
            });
            return;
        }

        if (!formValid) {
            Swal.fire({
                title: "Oops..!",
                text: "Please complete all required fields.",
                icon: "info"
            });
            return; // Exit the function if the form is invalid
        }

        // Create a FormData object
        var formData = new FormData($('#facultyForm')[0]);

        // Append the mode data
        formData.append('mode', mode);

        // Log the FormData (for debugging purposes)
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        // Show Swal loading alert
        Swal.fire({
            title: 'Submitting...',
            text: 'Please wait while we process your request.',
            icon: 'info',
            allowOutsideClick: false, // Prevent clicking outside the modal
            didOpen: () => {
                Swal.showLoading(); // Show loading spinner
            }
        });

        $.ajax({
            url: 'controller/faculty.php', // Replace with your server endpoint URL
            type: 'POST', // Use 'GET' or 'POST' depending on your server setup
            data: formData,
            processData: false,  // Tell jQuery not to process the data
            contentType: false,  // Tell jQuery not to set contentType
            success: function(response) {
                // Close the Swal loading alert
                Swal.close();

                // Handle the response with your alertMaker
                alertMaker(response);
            },
            error: function(xhr, status, error) {
                // Close the Swal loading alert
                Swal.close();

                // Show an error alert
                Swal.fire({
                    icon: 'error',
                    title: 'Submission Failed',
                    text: 'An error occurred while submitting the form. Please try again.',
                });
                console.error('Error submitting form:', error);
            }
        });
    });
});



    </script>


