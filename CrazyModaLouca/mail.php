<?php
require 'PHPMailerAutoload.php';

function sendMail($to, $subject, $body) { 
 global $error;
 $mail = new PHPMailer;  // create a new object
 $mail->IsSMTP(); // enable SMTP
 $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
 $mail->SMTPAuth = true;  // authentication enabled
 $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
 $mail->Host = 'smtp.gmail.com';
 $mail->Port = 587; 
 $mail->Username = 'joaquimfbsimoes@gmail.com';  
 $mail->Password = 'loaded123';           
 $mail->SetFrom('joaquimfbsimoes@gmail.com', 'Quim');
 $mail->Subject = $subject;
 $mail->Body = $body;
 $mail->AddAddress($to);
 if(!$mail->Send()) {
 $error = 'Mail error: '.$mail->ErrorInfo; 
 return false;
 } else {
 $error = 'Message sent!';
 return true;
 }
}

?>