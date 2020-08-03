<?php
require 'Model/Credentials.php';
require 'Controller/ArticleController.php';
session_start();


$stylesheet = "<link rel='stylesheet' type='text/css' href='Styles/indexStylesheet.css'>";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['register']))
    {
        require 'register.php';
    }
    elseif(isset($_POST['login']))
    {
        require 'login.php';
    }
    elseif(isset($_POST['close']))
    {
        unset($_SESSION['message']);
    }
    
}

$articleController = new ArticleController();

if(isset($_GET['query']) && !empty($_GET['query']))
{
    $query = $mysqli->escape_string($_GET['query']);
    $articleDisplay = $articleController->CreateArticleDisplay($query, 1);
}
else {
    $articleDisplay = $articleController->CreateArticleDisplay(null, 1);
}

//Output page data
$title = 'Index Page';
$messageBox = ""; 

$formBox = "<div id='form-box' class='modal'>
             <div class='modal-content'>
              <button class='form-button' id='login-form-button'>Log In</button>
              <button class='form-button' id='register-form-button'>Register</button>
              <form action='index.php' id='login-form' method='post'>
                <input type='email' class='form-input' id='input-login-mail' name='email' placeholder='E-mail'/>
                <input type='password' class='form-input' id='input-login-password' name='password' placeholder='Password'/>
                <p id='forgot'><a class='click-here' href=''>Forgot password?</a></p>
                <button class='submit-button' name='login' id='login-button'>Log in</button>
             </form>
             <form action='index.php' id='register-form' method='post' autocomplete='on'>
                <input type='text' class='form-input' id='input-first-name' name='firstname' placeholder='First Name*' required>
                <input type='text' class='form-input' id='input-last-name' name='lastname' placeholder='Last Name*'required>
                <input type='email' class='form-input' id='input-register-mail' name='email' placeholder='E-mail*'required>
                <input type='password' class='form-input' id='input-register-password' name='password' placeholder='Password*' required>
                <button class='submit-button' name='register' id='register-button'>Register</button>
             </form>
            </div>
           </div>";


if(isset($_SESSION['active']) && $_SESSION['active'] == 1)
{
    $wishlist = 1;
    $addToCart = 1;
    $profile = "<form id='profile' action='profile.php'>
                <button class='profile-button'></button>
               </form>";
    $cart = "<form id='cart' action='cart.php'>
                <button class='cart-button'></button>
               </form>";
    $sidebar = $articleController->createSideBar(1);
} 
else {
    $wishlist = 0;
    $addToCart = 0;
    $cart = "<div id='cart'>
                <button id='cart-button' class='cart-button'></button>
               </div>";
    $profile = "<div id='profile'>
                <button id='profile-button' class='profile-button'></button>
               </div>";
    $sidebar = $articleController->createSideBar(0);
}

if(isset($_SESSION['message']) && !empty($_SESSION['message']))
{   
    $messageBox = "<div id='message-box' class='modal' style='display: block; padding-top: 500px'>
                    <div class='modal-message'>
                        <center>" . $_SESSION['message'] . "</center>
                          <form action='index.php' method='post'>
                         <center><button name='close' class='close-button' onclick='closeMessage()'>Close</button></center>
                         </form>
                    </div>
                   </div>";   
    $content = $messageBox . $formBox . $articleDisplay;
}
else{
    $content = $formBox . $articleDisplay;
}
        
include 'template.php';

?>