<?php

class PicEntity
{
    public $id;
    public $url;
    public $article_id;
    
    function __construct($id, $url, $article_id) {
        $this->id = $id;
        $this->url = $url;
        $this->article_id = $article_id;
    }
}

?>