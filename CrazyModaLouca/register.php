<?php
require 'mail.php';

$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string(md5(rand(0,1000)));

$result = $mysqli->query("SELECT * FROM user WHERE email='$email'") or die($mysqli->error());

if($result->num_rows > 0) {
    $_SESSION['message'] = 'User with this email already exists';
    header("location: error.php");
}
else {
    $sql = "INSERT INTO user (first_name, last_name, email, password, hash) "
            . "VALUES ('$first_name', '$last_name', '$email','$password', '$hash')";
    
    if($mysqli->query($sql)){
        
        $_SESSION['active'] = 0;
        $_SESSION['logged_in'] = true;
        $_SESSION['message'] = "Thank you! Please verify your account by clicking the link in the e-mail sent to <b style='color: #3399ff'>$email</b>";
        
        $to = $email;
        $subject = 'Account verification';
        $message_body = 'Hello, '.$first_name.',
            
Thank you for signing up!
        
Please click this link to activate your account:
        
http://192.168.1.80/tutorial/verify.php?email='.$email.'&hash='.$hash;
        
        sendMail($to, $subject, $message_body);
        
        header("location: index.php");
    }
    else {
        $_SESSION['message'] = 'Registration failed';
        header("location: error.php");
    }
}






?>

