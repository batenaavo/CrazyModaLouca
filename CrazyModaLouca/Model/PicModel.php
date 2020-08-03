<?php

require ("Entities/PicEntity.php");


class PicModel {

    function GetArticlePics($id) {
        require 'Credentials.php';
        
        $query = "SELECT * FROM pic WHERE article_id = $id";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error());
        $picArray = array();
        
        //Get data from database.
        while ($row = mysqli_fetch_array($result)) {
                $id = $row[0];
                $url = $row[1];
                $article_id = $row[2];

                $pic = new PicEntity($id, $url, $article_id);
                array_push($picArray, $pic);
        }
        //Close connection and return result
        mysqli_close();
        return $picArray;
    }
}

?>