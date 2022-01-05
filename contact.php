<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $msg = $_POST['msg'];

    $mail->SMTPDebug = 0;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtpout.secureserver.net';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@egamazonconsultancy.com';                 // SMTP username
    $mail->Password = 'hamzachaudhry';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom('info@egamazonconsultancy.com', 'EG Consultancy & Marketing Services');
    $mail->addAddress('info@egamazonconsultancy.com');     // Add a recipient
    $mail->addReplyto($_POST['email']);

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'New Mail from EG Consultancy';
    $mail->Body    = "<h3>Name: $fname".".<br></br>Email: ".$email.".<br></br>Number: ".$number.".<br></br>Message: ".$msg.".</h3>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    if($mail->send()) {
        header('Location: contactus.html');
        exit();
    } else {
        header('Location: contactus.html');
        exit();
    }
}
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}