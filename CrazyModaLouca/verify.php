<?php
require 'Model/Credentials.php';
session_start();

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $mysqli->escape_string($_GET['email']);
    $hash = $mysqli->escape_string($_GET['hash']);
    
    $result = $mysqli->query("SELECT * FROM user WHERE email='$email' AND hash='$hash' AND active='0'");
    
    if($result->num_rows == 0)
    {
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";
        header("location: error.php");
    }
    else {
        $user = $result->fetch_assoc();
             
        $mysqli->query("UPDATE user SET active='1' WHERE email='$email'") or die($mysqli->error);
        
        $_SESSION['active'] = 1;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['logged_in'] = true;
        $_SESSION['message'] = "Your account has been activated!";
        
        header("location: index.php");
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for link verification!";
    header("location: error.php");
}
?>