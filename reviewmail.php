<?php
    require "vendor/autoload.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'credentials.php';

function approve_leave_mail($hodName,$email,$status) {

    $mail = new PHPMailer(true);

    //$mail->SMTPDebug = 4;                               // Enable verbose debug output

    $mail->isSMTP();
    $mail->Host = 'smtp-relay.sendinblue.com';  // Change this to SendinBlue's SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'sib@martechs.io'; // Replace with your SendinBlue username
    $mail->Password = 'YzDtqv1ZIRMjNk6V'; // Replace with your SendinBlue password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;                                   // TCP port to connect to

    $mail->setFrom('sib@martechs.io', 'Leave Application');
    $mail->addAddress($email);              // Name is optional
    $mail->addReplyTo('vijayendrak629@gmail.com');
    
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Leave Application ".$status."";
    $mail->Body    = "
        <p></p><br>
        Your leave application has been ".$status." by ".$hodName."<br><br>
        Kindly login into the Leave Application Portal.<br>
        THANK YOU.<br><br>";
    $mail->AltBody = 'Leave Application from the Leave Management system';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo "<script>alert('Leave Application was successful.');</script>";
    }
 }
?>