<?php
class Ingredient{

    public $ingredient_name;
    public $image;
    public $description;
    public $timestamp;
    public $ip_addr;
    public $ingredient_id;
    
    
    public static function getIngrdientFromRow($row) {
        $ingredient = new Ingredient();
        $ingredient->ingredient_name = $row['ingredient_name'];
        $ingredient->image = $row['image'];
        $ingredient->description = $row['description'];
        $ingredient->timestamp = $row['timestamp'];
        $ingredient->ip_addr = $row['ip_addr'];
        $ingredient->ingredient_id = $row['ingredient_id'];
        
        return $ingredient;
    
    
    }
    
    function __toString() {
        return $this->ingred_description;
    }
    
}
