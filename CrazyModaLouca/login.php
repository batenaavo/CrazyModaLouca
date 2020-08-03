<?php


$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM user WHERE email='$email'");
$header = "location: index.php";

if($result->num_rows == 0)
{
    $_SESSION['message'] = "Invalid e-mail!";
}
else {
    $user = $result->fetch_assoc();
    if(password_verify($_POST['password'], $user['password']))
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];
        $_SESSION['logged_in'] = true;
              
        if($_SESSION['active'] == 0)
        {
            $_SESSION['message'] = "Please verify your account by clicking the link in the e-mail sent to <b style='color: #3399ff'>$email</b>";            
        }
        else {
            $header = "location: profile.php";
        }
    }
    else {
        $_SESSION['message'] = "Invalid password! Please try again";        
    }   
}

header($header);

?>