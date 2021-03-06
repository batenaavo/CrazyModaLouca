<?php
require 'Model/Credentials.php';
require 'Model/WishlistModel.php';
session_start();

$wishlistModel = new WishlistModel();

$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    if(isset($_POST['article']) && !empty($_POST['article']))
    {       
        if(isset($_POST['type']) && $_POST['type'] == 'post')
        {
            $user_id = $_SESSION['user_id'];
            $article_id = intval($_POST['article']);
            $wishlistModel->insert($user_id, $article_id);
        }
        elseif(isset($_POST['type']) && $_POST['type'] == 'delete')
        {
            $user_id = $_SESSION['user_id'];
            $article_id = intval($_POST['article']);
            $wishlistModel->delete($user_id, $article_id);
        }
    }
}

