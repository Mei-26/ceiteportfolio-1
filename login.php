<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: 'Karla', sans-serif; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
        .bg-body { background: #1e502d; }
        .bg-darkgreen { background: #1b4728; }
        .bg-orange { background: #f27c22; }
        
    </style>
</head>
<body class="bg-body font-family-karla flex items-center justify-center h-screen">
    <div class="flex flex-col items-center bg-darkgreen text-white rounded-lg sm:p-8  p-10 shadow-md  sm:w-1/2 w-full ">
        <img class="w-36 mb-0 p-0 " src="assets/image/logo.png" alt="Logo">
        <h1 class="text-xl mt-0 font-bold ">CEIT </h1>
        <h1 class="text-xl font-bold ">E-Portfolio </h1>
        
        <form id="loginForm" class="w-full flex flex-col items-center mt-4">
            <div class="mb-4 w-1/2">
                <!-- <label for="employment-id" class="block text-sm mb-2">Employment ID</label> -->
                <input type="text" 
                name="employment_id" id="employment_id" placeholder="Employment ID" class="w-full p-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-green-500 bg-white text-black">
            </div>
            <div class="mb-4 w-1/2">
                <!-- <label for="password" class="block text-sm mb-2">Password</label> -->
                <input type="password" value="Testing12345678." name="password" id="password" placeholder="Password" class="w-full p-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-green-500 bg-white text-black">
            </div>
            <button type="submit" id="login" class="w-2/5 py-2 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-full">Log-in</button>
        </form>
        <div class="mt-4 w-full flex justify-end" >
            <p class="text-sm text-gray-400 hover:underline cursor-pointer" id="forgot">Forgot your Password?</p>
        </div>
    </div>
</body>
</html>
<script>
    $('#forgot').click(function() {
    Swal.fire({
        title: "Forgot your password?",
        input: "email",
        inputLabel: "Your email address",
        inputPlaceholder: "Enter your email address",
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return 'Please enter your email address!';
            }
            if (!value.endsWith('@cvsu.edu.ph')) {
                return 'Email must end with @cvsu.edu.ph!';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const email = result.value;
            
            // Show loading spinner
            Swal.fire({
                title: 'Sending Email...',
                text: 'Please wait while we send the verification email.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Send the email via AJAX
            $.ajax({
                url: 'controller/changepassword.php', // Replace with your server endpoint
                type: 'POST',
                data: { email: email },
                dataType: 'json',
                success: function(response) {
                    Swal.close(); // Close the loading spinner

                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: response.title,
                            text: response.message,
                        }).then(() => {
                            // Proceed to ask for verification code
                            Swal.fire({
                                title: "Enter Verification Code",
                                input: "text",
                                inputLabel: "Verification Code",
                                inputPlaceholder: "Enter the verification code sent to your email",
                                html: `
                                    <p>If you don't see the email in your inbox, please check your spam folder and mark it as 'Not Spam' to ensure future emails are delivered to your inbox.</p>
                                `,
                                showCancelButton: true,
                                inputValidator: (value) => {
                                    if (!value) {
                                        return 'Please enter the verification code!';
                                    }
                                }
                            }).then((codeResult) => {
                                if (codeResult.isConfirmed) {
                                    const verificationCode = codeResult.value;

                                    // Proceed to ask for new password
                                    Swal.fire({
                                        title: "Set New Password",
                                        html: `
                                            <input type="password" id="newPassword" class="swal2-input" placeholder="New Password">
                                            <input type="password" id="confirmPassword" class="swal2-input" placeholder="Confirm New Password">
                                        `,
                                        focusConfirm: false,
                                        preConfirm: () => {
                                            const newPassword = Swal.getPopup().querySelector('#newPassword').value;
                                            const confirmPassword = Swal.getPopup().querySelector('#confirmPassword').value;

                                            if (!newPassword || !confirmPassword) {
                                                Swal.showValidationMessage('Please enter both password fields');
                                                return false;
                                            }

                                            if (newPassword !== confirmPassword) {
                                                Swal.showValidationMessage('Passwords do not match');
                                                return false;
                                            }

                                            return {
                                                verificationCode: verificationCode,
                                                newPassword: newPassword
                                            };
                                        },
                                        showCancelButton: true
                                    }).then((passwordResult) => {
                                        if (passwordResult.isConfirmed) {
                                            const { verificationCode, newPassword } = passwordResult.value;
                                            
                                            // Show loading spinner
                                            Swal.fire({
                                                title: 'Resetting Password...',
                                                text: 'Please wait while we reset your password.',
                                                allowOutsideClick: false,
                                                didOpen: () => {
                                                    Swal.showLoading();
                                                }
                                            });

                                            // Send the verification code and new password via AJAX
                                            $.ajax({
                                                url: 'controller/resetpassword.php', // Replace with your server endpoint
                                                type: 'POST',
                                                data: {
                                                    email: email,
                                                    verification_code: verificationCode,
                                                    new_password: newPassword
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    Swal.close(); // Close the loading spinner
                                                    // Handle success response
                                                    Swal.fire({
                                                        icon: response.status,
                                                        title: response.title,
                                                        text: response.message,
                                                    }).then(() => {
                                                        if (response.status === 'success') {
                                                            location.reload(); // Reload the page after success
                                                        }else{
                                                            location.reload(); // Reload the page after success
                                                        }
                                                    });
                                                },
                                                error: function(xhr, status, error) {
                                                    Swal.close(); // Close the loading spinner
                                                    // Handle error response
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Oops...',
                                                        text: 'Something went wrong! Please try again later.',
                                                    }).then(() => {
                                                            location.reload(); // Reload the page after success
                                                    });
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        });
                    } else {
                        // Email not found or other errors
                        Swal.fire({
                            icon: response.status,
                            title: response.title,
                            text: response.message,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.close(); // Close the loading spinner
                    // Handle error response
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again later.',
                    });
                }
            });
        }
    });
});

</script>
<script src="js/login.js"></script>