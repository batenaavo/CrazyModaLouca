<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name=”viewport” content=”width=device-width, initial-scale=1, maximum-scale=1”>
        <title><?php echo $title; ?></title>    
        <link rel="stylesheet" type="text/css" href="Styles/stylesheet.css">
        <?php echo $stylesheet; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <nav id="navbar">
            <div id="list">
                <button id="list-button" onclick="sidebarOpen()"></button>
            </div>       
            <div class="logo"></div>            
            <div class="account-links">
                <form id="search-form" name="searchform" method="get" action="index.php">
                    <input type="text" name="query" id="search"  autocomplete='off'/>
                </form>    
                    <div id="mag-glass">
                        <button id="glass-button"></button>
                    </div>
                    <img id=""/>
                    <?php echo $profile;?>
                    <?php echo $cart;?>
            </div>
        </nav>
        <div id="sidebar">
            <button id="sidebar-button" onclick="sidebarClose()">
                <p id="categories">Categorias</p></button>
        <?php echo $sidebar;?>
        </div>
        <div class="content-area">
            <?php echo $content; ?>            
        </div> 
        <div id="footer">
            <p>Copyrights belong to Quim</p>
        </div>
        <script>
            /*var prevScrollpos = window.pageYOffset;
            
            window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
              if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar").style.top = "0";
              } else {
                document.getElementById("navbar").style.top = "-200px";
              }
              prevScrollpos = currentScrollPos;
            }*/
            
            function showNext(obj){
               var done = 0;
               var children = obj.children;
               
                for (var i = 0; i < children.length; i++) {
                  if(done){
                      break;
                  }  
                  else{
                    var child = children[i];
                    if(!child.classList.contains("hidden")){
                        child.classList.add("hidden");
                        if(i === 0){
                            children[children.length - 1].classList.remove("hidden");
                        }
                        else{
                            children[i-1].classList.remove("hidden");
                        }
                        done = 1;
                    }
                  }
                }
            }           
            </script>
            <script>
             var formBox = document.getElementById("form-box");
             var messageBox = document.getElementById("message-box");
             
             var profile = document.getElementById("profile-button");
             var cart = document.getElementById("cart-button");
             var wishButtons = document.getElementsByClassName("wishlist-off");
             var cartButtons = document.getElementsByClassName("add-to-cart");
             
             var loginButton = document.getElementById("login-form-button");
             var registerButton = document.getElementById("register-form-button");
             var loginForm = document.getElementById("login-form");
             var registerForm = document.getElementById("register-form");
             
             
             registerButton.onclick = function() {
                 loginForm.style.display="none";
                 registerForm.style.display="grid";
                 loginButton.style.background="#a9adb9";
                 loginButton.style.color="white";
                 loginButton.style.border="20px solid #a9adb9";
                 registerButton.style.color="black";
                 registerButton.style.background="white";
                 registerButton.style.border="20px solid white";
             };
             
             loginButton.onclick = function() {
                 loginForm.style.display="grid";
                 registerForm.style.display="none";
                 loginButton.style.background="white";
                 loginButton.style.color="black";
                 loginButton.style.border="20px solid white";
                 registerButton.style.color="white";
                 registerButton.style.background="#a9adb9";
                 registerButton.style.border="20px solid #a9adb9";
             };
             
             $(".wishlist").click(function(){
                 if(<?php echo $wishlist ?> && !($(this).hasClass("wishlist-on"))){
                  $.ajax({
                  url: 'wishlist.php',
                  type: 'POST',
                  data: {
                   'article' : $(this).attr('id'),
                   'type': 'post'
                  },
                  success: function() {                     
                      }
                  });
                  $(this).addClass("wishlist-on");
                 }
                 else if(<?php echo $wishlist ?>)
                 {
                  $.ajax({
                  url: 'wishlist.php',
                  type: 'POST',
                  data: {
                   'article' : $(this).attr('id'),
                   'type': 'delete'
                  },
                  success: function() {                     
                      }
                  });
                   $(this).removeClass("wishlist-on");
                 }
                 else formPopUp();
             });
             
              $(".add-to-cart").click(function(){
                 if(<?php echo $addToCart ?> && !($(this).hasClass("added-to-cart"))){
                  $.ajax({
                  url: 'cart.php',
                  type: 'POST',
                  data: {
                   'article' : $(this).attr('id'),
                   'type': 'post'
                  },
                  success: function() {                     
                      }
                  });
                  $(this).addClass("added-to-cart");
                 }
                 else if(<?php echo $addToCart ?>)
                 {
                  $.ajax({
                  url: 'cart.php',
                  type: 'POST',
                  data: {
                   'article' : $(this).attr('id'),
                   'type': 'delete'
                  },
                  success: function() {                     
                      }
                  });
                   $(this).removeClass("added-to-cart");
                 }
                 else formPopUp();
             });
             
             for(let item of cartButtons){
                 item.ontouchstart = function() {
                    <?php echo $addToCart; ?>
                };
             }
             
            cart.onclick = function() {
              formPopUp();
            };
            
            profile.onclick = function() {
              formPopUp();
            };
             
             function formPopUp(){
                 formBox.style.display = "block";
             }
             
             function formClose(){
                 formBox.style.display = "none";
                 loginForm.style.display="grid";
                 registerForm.style.display="none";
                 loginButton.style.background="white";
                 loginButton.style.color="black";
                 loginButton.style.border="20px solid white";
                 registerButton.style.color="white";
                 registerButton.style.background="#a9adb9";
                 registerButton.style.border="20px solid #a9adb9";
             }

                
            function closeMessage(){
                messageBox.style.display="none";
            }

            window.ontouchend = function(event) {
              if (event.target == formBox) {
                formClose();
              }
              else if(event.target == messageBox){
                messageBox.style.display = "none";  
              }
            };
            </script>
            <script>
              var glass = document.getElementById("glass-button");
              var search = document.getElementById("search");
              
             
              search.onblur = function(){
                  document.searchform.query.value = "";
              };
              
              glass.onclick = function() {
                      search.focus();                
              };
             </script>
             <script>
              var sidebar = document.getElementById("sidebar");
              var categories = document.getElementsByClassName("category-button");
              
              function sidebarOpen(){
                  sidebar.style.left="0";
              }
              
              function sidebarClose(){
                  sidebar.style.left = "-55%";
              }
                
              for(let item of categories){
                 item.ontouchend = function() { 
                    var section = item.nextSibling;
                    if(section != null){
                        section.classList.toggle("visible-grid");
                    }
                 };
              }
          </script> 
    </body>
</html>
