$("#loginForm").submit(function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Get form data
    var formData = $(this).serialize();

    // Send an Ajax POST request
    $.ajax({
      type: "POST",
      url: "controller/login.php", // Replace with your server-side script
      data: formData,
      success: function(response) {
        if (response === '200') {
            console.log(response)
          // Show a success SweetAlert
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Login successful!',
            buttons: {
              confirm: {
                text: "OK",
                value: true,
                visible: true,
                className: "btn-green", // Add custom class
                closeModal: true,
              }
            },

          }).then(function() {
            // Redirect to index.php
            window.location.href = 'index.php';
          });
        } else {
          // Show an error SweetAlert
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Incorrect Employment ID Or Password!',
          });
        }
      },
      error: function() {
        // Handle errors
        $("#result").html("An error occurred.");
      }
    });
  });