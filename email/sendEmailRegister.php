<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['idUser'])) {
    $_SESSION["id_user"] = $_POST['idUser'];
}

// Si hace falta probar un correo se puede poner entre las comillas a la hora de traerse el nombre y el email
$userName = $_SESSION['name'] ?? $_POST['name'] ?? '';
$userEmail = $_SESSION['email'] ?? $_POST['email'] ?? '';

if (empty($userName) || empty($userEmail)) {
    die('Name and email are required.');
}
// Create a new PHPMailer instance
$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = getenv("SMTP_HOST");
    $mail->SMTPAuth   = true;
    $mail->Username   = getenv("SMTP_USERNAME");
    $mail->Password   = getenv("SMTP_PASSWORD");
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('codemacademy74@gmail.com', 'Codema Academy');
    $mail->addAddress($userEmail, $userName);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Welcome to Codema Academy!';
    
    // HTML Email Template
    $mail->Body = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Codema Academy Email</title>
        <style>
            body {
                font-family: "Poppins", "Segoe UI", "Inter", Arial, sans-serif;
                background-color: #222842;
                color: #ffffff;
                line-height: 1.7;
                margin: 0;
                padding: 0;
            }
            
            .email-container {
                max-width: 600px;
                margin: 0 auto;
                background: #191f3b;
                border-radius: 1rem;
                overflow: hidden;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            }
            
            .email-header {
                background: #292653;
                padding: 1.5rem;
                text-align: center;
                border-bottom: 3px solid #709ad0;
            }
            
            .email-logo {
                font-size: 1.8rem;
                font-weight: 700;
                color: #709ad0;
                letter-spacing: -0.5px;
                margin: 0;
            }
            
            .email-content {
                padding: 2rem;
                text-align: center;
            }
            
            .email-title {
                font-size: 1.75rem;
                color: #709ad0;
                margin-bottom: 1.5rem;
                text-align: center;
            }
            
            .email-message {
                font-size: 1rem;
                margin-bottom: 1.5rem;
                line-height: 1.6;
            }
            
            .btn {
                display: inline-block;
                padding: 0.85rem 1.75rem;
                border-radius: 0.6rem;
                font-weight: 600;
                font-size: 1rem;
                cursor: pointer;
                transition: all 0.2s;
                background: #709ad0;
                color: #ffffff;
                text-decoration: none;
                text-align: center;
                margin: 1rem 0;
            }
            
            .btn:hover {
                opacity: 0.9;
                transform: translateY(-2px);
            }
            
            .email-footer {
                background: #292653;
                padding: 1.5rem;
                text-align: center;
                font-size: 0.9rem;
                color: rgba(255, 255, 255, 0.7);
            }
            
            .social-links {
                margin: 1rem 0;
            }
            
            .social-links a {
                display: inline-block;
                margin: 0 0.5rem;
                color: #709ad0;
                text-decoration: none;
            }
            p{
                color: #ffffff;
                text-align: center;
            }
            @media screen and (max-width: 480px) {
                .email-container {
                    border-radius: 0;
                }
                
                .email-content {
                    padding: 1.5rem;
                }
                
                .email-title {
                    font-size: 1.5rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <!-- Header -->
            <div class="email-header">
                <h1 class="email-logo">Codema</h1>
            </div>
            
            <!-- Content -->
            <div class="email-content">
                <h2 class="email-title">Welcome to Codema Academy!</h2>
                
                <p class="email-message">Dear ' . htmlspecialchars($userName) . ',</p>
                
                <p class="email-message">Thank you for joining Codema Academy! We\'re excited to have you as part of our learning community. With our comprehensive courses and expert instructors, you\'ll be on your way to mastering new skills in no time.</p>
                            
                <p class="email-message">If you didn\'t create an account with Codema Academy, please ignore this email or contact our support team.</p>
                
                <p class="email-message">Happy learning!<br>The Codema Academy Team</p>

                <a href="https://codema.fun" class="btn" style="color:#ffffff">Visit Codema</a>

            </div>
            
            <!-- Footer -->
            <div class="email-footer">
                <div class="social-links">
                    <a href="#">Facebook</a> | 
                    <a href="#">Twitter</a> | 
                    <a href="#">LinkedIn</a>
                </div>
                <p>&copy; ' . date('Y') . ' Codema Academy. All rights reserved.</p>
                <p>
                    <a href="#">Privacy Policy</a> | 
                    <a href="#">Terms of Service</a>
                </p>
                <p>Codema Academy, 123 Learning St, Tech City</p>
            </div>
        </div>
    </body>
    </html>';

    // Plain text version for non-HTML email clients
    $mail->AltBody = "Welcome to Codema Academy!\n\nDear $userName,\n\nThank you for joining Codema Academy! We're excited to have you as part of our learning community.\n\nIf you didn't create an account with Codema Academy, please ignore this email.\n\nHappy learning!\nThe Codema Academy Team";

    $mail->send();
    // echo 'Message has been sent';

    header("location:/index.php");
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}