<?php
header('Access-Control-Allow-Origin: *');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/PHPMailer-master/src/Exception.php';
require 'phpMailer/PHPMailer-master/src/PHPMailer.php';
require 'phpMailer/PHPMailer-master/src/SMTP.php';
require 'phpMailer/crds.php';
function SendEmailPasswordChangeVerification($email_address, $verification_code) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = EMAIL;
        $mail->Password   = PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        // $mail->SMTPDebug  = 2; // Adjust debug level as needed

        // Recipients
        $mail->setFrom(EMAIL, 'E-Portfolio');
        $mail->addAddress($email_address, 'User');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Change Verification Code';
        $mail->Body    = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 20px auto;
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .header {
                    background-color: #ff9800;
                    color: #ffffff;
                    padding: 10px 0;
                    text-align: center;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                }
                .content {
                    padding: 20px;
                    text-align: center;
                }
                .footer {
                    background-color: #f4f4f4;
                    color: #888888;
                    padding: 10px 0;
                    text-align: center;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                }
                .footer a {
                    color: #ff9800;
                    text-decoration: none;
                }
                .code {
                    font-size: 24px;
                    font-weight: bold;
                    margin-top: 20px;
                    color: #ff9800;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>Password Change Verification</h2>
                </div>
                <div class='content'>
                    <p>To complete your password change, please use the following verification code:</p>
                    <p class='code'>".$verification_code."</p>
                    <p>If you did not request to change your password, please ignore this email or contact support.</p>
                </div>
                <div class='footer'>
                    <p>If you have any questions, please contact our <a href='mailto:".EMAIL."'>support team</a>.</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $mail->send();
        return "send";
    } catch (Exception $e) {
        return "Mailer Error: " . $mail->ErrorInfo;
    }
}



function SendEmailTemporaryPassword($email_address, $temporary_password) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = EMAIL;
        $mail->Password   = PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        // $mail->SMTPDebug  = 2; // Adjust debug level as needed

        // Recipients
        $mail->setFrom(EMAIL, 'E-Portfolio');
        $mail->addAddress($email_address, 'User');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Temporary Password';
        $mail->Body    = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 20px auto;
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .header {
                    background-color: #4CAF50;
                    color: #ffffff;
                    padding: 10px 0;
                    text-align: center;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                }
                .content {
                    padding: 20px;
                    text-align: center;
                }
                .footer {
                    background-color: #f4f4f4;
                    color: #888888;
                    padding: 10px 0;
                    text-align: center;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                }
                .footer a {
                    color: #4CAF50;
                    text-decoration: none;
                }
                .password {
                    font-size: 24px;
                    font-weight: bold;
                    margin-top: 20px;
                    color: #4CAF50;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>Your Temporary Password</h2>
                </div>
                <div class='content'>
                    <p>Please use Your Email and . Here is your temporary password:</p>
                    <p class='password'>".$temporary_password."</p>
                    <p>Please use this password to log in and remember to change it immediately after logging in.</p>
                </div>
                <div class='footer'>
                    <p>If you have any questions, please contact our <a href='mailto:".EMAIL."'>support team</a>.</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $mail->send();
        return "send";
    } catch (Exception $e) {
        return "Mailer Error: " . $mail->ErrorInfo;
    }
}


// Test function
