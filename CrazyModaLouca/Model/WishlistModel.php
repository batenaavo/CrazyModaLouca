<?php


class WishlistModel {
    
    function exists($article, $user){
        require 'Credentials.php';
        
        $query = "SELECT * FROM wishlist WHERE article_id = $article AND user_id=$user";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error());
        
        
        mysqli_close();
        
        if($result->num_rows > 0){
             return 1;           
        }
        else {
            return 0;            
        }
    }
    
    function insert($user, $article){
        require 'Credentials.php';
        
        $query = "INSERT INTO wishlist (user_id, article_id) VALUES ($user, $article)";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error());
        
        mysqli_close();
        
        if($result){
            return 1;
        }
        else{
            return 0;
        }                
    }
    
    function delete($user, $article){
        require 'Credentials.php';
        
        $query = "DELETE w FROM wishlist w WHERE w.article_id=$article AND w.user_id=$user";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error());
        
        mysqli_close();
        
        if($result){
            return 1;
        }
        else{
            return 0;
        }
    }
    
    function getTotal($user){
        require 'Credentials.php';
        
        $query = "SELECT * FROM wishlist WHERE user_id=$user";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error());
        $rows = mysqli_num_rows($result);
        
        mysqli_close();
        
        return $rows;

    }
}
