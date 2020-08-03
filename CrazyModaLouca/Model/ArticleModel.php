<?php

require ("Entities/ArticleEntity.php");

class ArticleModel {

    //Get articleEntity objects from the database and return them in an array.
    function GetArticles($search) {
        require 'Credentials.php';
        
        if($search != null){
            $query = "SELECT * FROM article INNER JOIN type ON type.name=article.type
                    WHERE article.name LIKE '%$search%' OR article.type LIKE '%$search%' OR type.category LIKE '%$search%'";                      
        }
        else{
            $query = "SELECT * FROM article";           
        }
        $result = mysqli_query($mysqli, $query) or die(mysqli_error());
        $articleArray = array();
        
        //Get data from database.
        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];
            $name = $row[1];
            $type = $row[2];
            $size = $row[3];
            $amount = $row[4];
            $price = $row[5];

            
            //Create article objects and store them in an array.
            $article = new ArticleEntity($id, $name, $type, $size, $amount, $price);
            array_push($articleArray, $article);
        }
        //Close connection and return result
        mysqli_close();
        return $articleArray;
    }
    
    function GetWishlistArticles($user) {
        require 'Credentials.php';
        
        $query = "SELECT * FROM article INNER JOIN wishlist ON article.id=wishlist.article_id
                  WHERE wishlist.user_id=$user";                      

        $result = mysqli_query($mysqli, $query) or die(mysqli_error());
        $articleArray = array();
        
        //Get data from database.
        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];
            $name = $row[1];
            $type = $row[2];
            $size = $row[3];
            $amount = $row[4];
            $price = $row[5];

            
            //Create article objects and store them in an array.
            $article = new ArticleEntity($id, $name, $type, $size, $amount, $price);
            array_push($articleArray, $article);
        }
        //Close connection and return result
        mysqli_close();
        return $articleArray;
    }
   
    function GetCartArticles($user) {
        require 'Credentials.php';
        
        $query = "SELECT * FROM article INNER JOIN cart ON article.id=cart.article_id
                  WHERE cart.user_id=$user";                      

        $result = mysqli_query($mysqli, $query) or die(mysqli_error());
        $articleArray = array();
        
        //Get data from database.
        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];
            $name = $row[1];
            $type = $row[2];
            $size = $row[3];
            $amount = $row[4];
            $price = $row[5];

            
            //Create article objects and store them in an array.
            $article = new ArticleEntity($id, $name, $type, $size, $amount, $price);
            array_push($articleArray, $article);
        }
        //Close connection and return result
        mysqli_close();
        return $articleArray;
    }
    
    function GetAllArticleTypes(){
        require 'Credentials.php';
        
        $query = "SELECT DISTINCT type FROM article";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error());
        $typeArray = array();
        
         while ($row = mysqli_fetch_array($result)) {            
            array_push($typeArray, $row[0]);
        }
        
        mysqli_close();
        return $typeArray;   
    }
    
    function GetAllArticleCategories(){
        require 'Credentials.php';
        
        $query = "SELECT DISTINCT type.category FROM type INNER JOIN article ON type.name=article.type";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error());
        $categoryArray = array();
        
         while ($row = mysqli_fetch_array($result)) {      
             array_push($categoryArray, $row[0]);
        }
        
        mysqli_close();
        return $categoryArray;   
    }
    
    function GetAllArticleTypesByCategory($category){
        require 'Credentials.php';
        
        $query = "SELECT DISTINCT type.name FROM type INNER JOIN article ON type.name=article.type
                  WHERE type.category LIKE '$category'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error());
        $typeArray = array();
        
         while ($row = mysqli_fetch_array($result)) {      
             array_push($typeArray, $row[0]);
        }
        
        mysqli_close();
        return $typeArray;   
    }
    
}

?>