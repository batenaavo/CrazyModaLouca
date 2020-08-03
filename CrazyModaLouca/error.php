<?php

session_start();

$title = 'Error Page';

if(isset($_SESSION['message']) AND !empty($_SESSION['message'])):
    $content = "<h1><center>ERROR</center></h1>" . $_SESSION['message'];
else:
    header("location: index.php");
endif;
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name=”viewport” content=”width=device-width, initial-scale=1, maximum-scale=1”>
        <title><?php echo $title; ?></title>    
        <?php include 'Styles/style.php'; ?>
    </head>
    <body>
        <nav id="navbar">
        </nav>
        <div class="content-area" style="font-size: 50px">
            <?php echo $content; ?>
        </div>  
   </body>
</html>



