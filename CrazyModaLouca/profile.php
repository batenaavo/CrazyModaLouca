<?php
require 'Model/Credentials.php';
require 'Controller/ArticleController.php';
session_start();

if($_SESSION['active'] == 1){
    $stylesheet = "<link rel='stylesheet' type='text/css' href='Styles/profilestylesheet.css'>";
    $articleController = new ArticleController();
    

    $title = 'Profile Page';
    $wishlist = 1;
    $addToCart = 1;
    $profile = "<form id='profile' action='profile.php'>
                    <button class='profile-button'></button>
                   </form>";
    $cart = "<form id='cart' action='cart.php'>
                    <button class='cart-button'></button>
                   </form>";

    $sidebar = $articleController->createSideBar(1);
    $wishlistCount = $articleController->getWishlistTotal();
    $cartCount = $articleController->getCartTotal();
    $orderCount = 0;

    $menu = "<div id='my-content'>
                     <div class='button-wrapper'>
                        <button class='my-content-button my-wishlist-off' id='my-wishlist'>
                        <p class='my-content-button-count' id='wishlist-count'>$wishlistCount</p>
                        </button>
                    </div>
                    <div class='button-wrapper'>
                        <button class='my-content-button my-cart-off' id='my-cart'>
                        <p class='my-content-button-count' id='cart-count'>$cartCount</p>
                        </button>
                    </div>
                    <div class='button-wrapper'>
                        <button class='my-content-button my-orders-off' id='my-orders'>
                        <p class='my-content-button-count' id='order-count'>$orderCount</p>
                        </button>
                    </div>
                    <div class='button-wrapper'>
                        <button class='my-content-button my-settings-off settings-button' id='my-settings'>
                        <p class='my-content-button-text'></p>
                        </button>
                    </div>
                 </div>";

     $wishlistDisplay = $articleController->CreateArticleDisplay(null, 2);
     $emptyWishlist = "<center id='empty-wishlist' class='unmatched-search invisible'><h1>Your Wishlist is empty.</h1></center>";
     $wishlistPage = "<div class='content-display invisible' id='wishlist-display'>
                        <p class='my-content-title' id='my-wishlist-title'>Wishlist</p>
                        $wishlistDisplay $emptyWishlist
                     </div>";
     
     $cartDisplay = $articleController->CreateArticleDisplay(null, 3);
     $emptyCart = "<center id='empty-cart' class='unmatched-search invisible'><h1>Your Shopping Cart is empty.</h1></center>";
     $cartTotal = "<div class='cart-total'>
                   </div>";
             
     $cartPage = "<div class='content-display invisible' id='cart-display'>
                    <p class='my-content-title' id='my-cart-title'>Shopping Cart</p>
                    $cartDisplay $emptyCart 
                  </div>";
     
     $ordersPage = "<div class='content-display invisible' id='orders-display'>
                        <p class='my-content-title' id='my-orders-title'>Wishlist</p>
                     </div>";
     
     $settingsDisplay = "<h1 class='content-display invisible' id='settings-display'>HEllo settings<h1>";

     
  
    $scripts = "<script>
                    $('#my-wishlist').click(function(){
                        $('#wishlist-display').removeClass('invisible');
                        $('#cart-display').addClass('invisible');
                        $('#orders-display').addClass('invisible');
                        $('#settings-display').addClass('invisible');
                        $('#my-cart').removeClass('my-cart-on my-content-button-on');
                        $('#my-orders').removeClass('my-orders-on my-content-button-on');
                        $('#my-settings').removeClass('my-settings-on my-content-button-on');
                        $('#my-cart').addClass('my-cart-off');
                        $('#my-orders').addClass('my-orders-off');
                        $('#my-settings').addClass('my-settings-off');
                        $(this).removeClass('my-wishlist-off');
                        $(this).addClass('my-wishlist-on my-content-button-on');
                    });
                    
                    $('#my-cart').click(function(){
                        $('#cart-display').removeClass('invisible');
                        $('#wishlist-display').addClass('invisible');
                        $('#orders-display').addClass('invisible');
                        $('#settings-display').addClass('invisible');
                        $('#my-wishlist').removeClass('my-wishlist-on my-content-button-on');
                        $('#my-orders').removeClass('my-orders-on my-content-button-on');
                        $('#my-settings').removeClass('my-settings-on my-content-button-on');
                        $('#my-wishlist').addClass('my-wishlist-off');
                        $('#my-orders').addClass('my-orders-off');
                        $('#my-settings').addClass('my-settings-off');
                        $(this).removeClass('my-cart-off');
                        $(this).addClass('my-cart-on my-content-button-on');
                    });
                    
                    $('#my-orders').click(function(){
                        $('#orders-display').removeClass('invisible');
                        $('#wishlist-display').addClass('invisible');
                        $('#cart-display').addClass('invisible');
                        $('#settings-display').addClass('invisible');
                        $('#my-wishlist').removeClass('my-wishlist-on my-content-button-on');
                        $('#my-cart').removeClass('my-cart-on my-content-button-on');
                        $('#my-settings').removeClass('my-settings-on my-content-button-on');
                        $('#my-wishlist').addClass('my-wishlist-off');
                        $('#my-cart').addClass('my-cart-off');
                        $('#my-settings').addClass('my-settings-off');
                        $(this).removeClass('my-orders-off');
                        $(this).addClass('my-orders-on my-content-button-on');
                    });
                    
                    $('#my-settings').click(function(){
                        $('#settings-display').removeClass('invisible');
                        $('#wishlist-display').addClass('invisible');
                        $('#orders-display').addClass('invisible');
                        $('#cart-display').addClass('invisible');
                        $('#my-wishlist').removeClass('my-wishlist-on my-content-button-on');
                        $('#my-cart').removeClass('my-cart-on my-content-button-on');
                        $('#my-orders').removeClass('my-orders-on my-content-button-on');
                        $('#my-wishlist').addClass('my-wishlist-off');
                        $('#my-cart').addClass('my-cart-off');
                        $('#my-orders').addClass('my-orders-off');
                        $(this).removeClass('my-settings-off');
                        $(this).addClass('my-settings-on my-content-button-on');
                    });
                    
                    $('.wishlist').click(function(){
                      if(!($(this).hasClass('wishlist-on'))){
                       $.ajax({
                       url: 'wishlist.php',
                       type: 'POST',
                       data: {
                        'article' : $(this).prop('id'),
                        'type': 'post'
                       },
                       success: function() {                     
                           }
                       });
                       $('#wishlist-display').children('#' + $(this).prop('id')).find('.wishlist').addClass('wishlist-on');  
                       
                       var newCount = parseInt($('#wishlist-count').text()) + 1;
                       $('#wishlist-count').text(newCount);
                       $('#empty-wishlist').addClass('invisible');
                      }
                      else
                      {
                       $.ajax({
                       url: 'wishlist.php',
                       type: 'POST',
                       data: {
                        'article' : $(this).prop('id'),
                        'type': 'delete'
                       },
                       success: function() {                     
                           }
                       });                        
                        $('#wishlist-display').children('#' + $(this).prop('id')).addClass('invisible'); 
                        
                        var newCount = parseInt($('#wishlist-count').text()) - 1;
                        $('#wishlist-count').text(newCount);
                        if(newCount == 0){
                            $('#empty-wishlist').removeClass('invisible');
                        }
                      }
                   });
                   

                    $('.add-to-cart').click(function(){
                      if(!($(this).hasClass('added-to-cart'))){
                       $.ajax({
                       url: 'cart.php',
                       type: 'POST',
                       data: {
                        'article' : $(this).prop('id'),
                        'type': 'post'
                       },
                       success: function() {
                           }
                       });
                       $('#cart-count').text(parseInt($('#cart-count').text()) + 1);
                       $('#empty-cart').addClass('invisible');
                      }
                      else
                      {
                       $.ajax({
                       url: 'cart.php',
                       type: 'POST',
                       data: {
                        'article' : $(this).prop('id'),
                        'type': 'delete'
                       },
                       success: function() {                     
                           }
                       });
                      }
                   });
                </script>";
    $content =  $menu . $wishlistPage . $ordersPage . $cartPage  . $settingsDisplay . $scripts;

}
else{
    header("location: index.php");
}

include 'template.php';
?>


