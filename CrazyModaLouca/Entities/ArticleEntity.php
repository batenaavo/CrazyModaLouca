<?php

class ArticleEntity
{
    public $id;
    public $name;
    public $type;
    public $size;
    public $amount;
    public $price;
    
    function __construct($id, $name, $type, $size, $amount, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->size = $size;
        $this->amount = $amount;
        $this->price = $price;
    }
}

?>