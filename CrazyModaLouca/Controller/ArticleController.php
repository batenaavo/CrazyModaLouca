<?php

require ("Model/ArticleModel.php");
require ("Model/PicModel.php");
require ("Model/WishlistModel.php");
require ("Model/CartModel.php");

class ArticleController {

        
    function CreateArticleDisplay($query, $type)
    {
        $articleModel = new ArticleModel();
        $picModel = new PicModel();
        $wishlistModel = new WishlistModel();
        $cartModel = new CartModel();
        $result = "";
        $otherElements = "";
        
        if($type == 1){
            $articleArray = $articleModel->GetArticles($query);
            $class = 'article';
        }
        elseif($type == 2){
            $user = $_SESSION['user_id'];
            $articleArray = $articleModel->GetWishlistArticles($user);
            $class = 'wishlist-article';
        }
        elseif($type == 3){
            $user = $_SESSION['user_id'];
            $articleArray = $articleModel->GetCartArticles($user);
            $class = 'cart-article';
        }
        //Generate an articleDisplay for each articleEntity in array
        foreach ($articleArray as $key => $article) 
        {
            $picArray = $picModel->GetArticlePics($article->id);
            $result = $result . "<div class='$class' id='$article->id'>
                                 <div class='article-pic' onclick='showNext(this)'>";
            
            $i = 0;
            
            foreach($picArray as $key => $pic){               
                if($i == 0){
                    $result = $result . "<img src='$pic->url'  id='art-{$article->id}-pic-{$pic->id}'/>";              
                
                }else{   
                    $result = $result . "<img src='$pic->url'  id='art-{$article->id}-pic-{$pic->id}' class='hidden'/>";           
                }
                $i++;
            }
                        
            if(isset($_SESSION['active']) && $_SESSION['active'] == 1)
            {
                $inWishlist = $wishlistModel->exists($article->id, $_SESSION['user_id']);
                $inCart = $cartModel->exists($article->id, $_SESSION['user_id']);
                
                if($inWishlist)
                {
                    $wishlist='wishlist wishlist-on';
                }
                else {$wishlist='wishlist';}
                
                if($inCart)
                {
                    $addToCart = 'add-to-cart added-to-cart';
                }
                else {$addToCart = 'add-to-cart';}             
            }
            else {
                $wishlist='wishlist';
                $addToCart = 'add-to-cart';
            }         
            
            
            if($type == 2){
                //ALTERAR
                $otherElements = "<button class='$wishlist' id='$article->id'></button> 
                                 <button class='$addToCart' id='$article->id'></button>";
            }
            if($type == 3)
            {   
                $articleCount = $cartModel->getAmount($user, $article->id);
                $otherElements = "<button class='remove-button' id='$article->id'>-</button>
                                <p class='article-count' id='$article->id'>$articleCount</p>
                                <button class='add-button' id='$article->id'>+</button>"; 
            }
            else{
                $otherElements = "<button class='$wishlist' id='$article->id'></button> 
                                 <button class='$addToCart' id='$article->id'></button>";
            }
            $result = $result . 
                        "</div>
                         <p class='article-title'>$article->name</p>
                         <p class='article-size'>$article->size</p>
                         <p class='article-price'>{$article->price}€</p>"
                          . $otherElements .
                    "</div>";     
        }          
        
        if($result == "" && $type == 1){
            $result = "<center class='unmatched-search'><h1>No items match your search.</h1></center>";
        }
        elseif($result == "" && $type == 2){
            $result = "<center class='unmatched-search' id='empty-wishlist'><h1>Your Wishlist is empty.</h1></center>";
        }
        elseif($result == "" && $type == 3){
            $result = "<center class='unmatched-search' id='empty-cart'><h1>Your Shopping Cart is empty.</h1></center>";
        }
        
        return $result;    
    }
    
    function createSideBar($logout)
    {
        $articleModel = new ArticleModel();
        $categoryArray = $articleModel->GetAllArticleCategories();
        $result = "";
        
        foreach($categoryArray as $key => $category)
        {
            $result = $result . "<button class='category-button'>$category</button><div class='items-section'>";
            $typeArray = $articleModel->GetAllArticleTypesByCategory($category);
           
            foreach($typeArray as $key => $type)
            {
                $result = $result . "<a class='sidebar-item' href='http://192.168.1.214/tutorial/index.php?query=$type' class='sidebar-category'>$type</a>";
            }
            $result = $result . "<a class='sidebar-item' href='http://192.168.1.214/tutorial/index.php?query=$category' class='sidebar-category'>All $category</a></div>";            
        }
        
        if($logout){
            $result = $result . "<form action='logout.php'>
                                <button class='category-button' style='background-color: #ffe793'>Log Out</button>
                                </form>";
        }
        return $result;
    }
    
    function getWishlistTotal(){        
        $wishlistModel = new WishlistModel();
        
        $user = $_SESSION['user_id'];
        
        $count = $wishlistModel->getTotal($user);
        
        return $count;
    }
    
    function getCartTotal(){        
        $cartModel = new CartModel();
        
        $user = $_SESSION['user_id'];
        
        $count = $cartModel->getTotal($user);
        
        return $count;
    }
}

?>