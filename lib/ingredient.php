<?php

class Ingredient {
  public $id; // id unique to each ingredient
  public $name; // name of the ingredient
  public $image_name; // name of the image of the ingredient
  public $description; // description of the ingredient
  public $price; // price f the ingredient
  public $unit;

  /*public function __construct($id=0, $name="default", $img="default.jpg", $dsc="default ingredient"){
    $this->id = $id;
    $this->$name = $name;
    $this->$image_name = $img;
    $this->description = $dsc;
  }*/

  // add any necessary functions to support Ingredients

  public static function getIngredientFromRow($row){
    $newID = $row['id'];
    $newName = $row['ingredient_name'];
    $newImg = $row['image_name'];
    $newDsc = $row['description'];
    $newPrice = $row['price'];
    $newUnit = $row['unit'];

    $ingredient = new Ingredient();
    $ingredient->id = $newID;
    $ingredient->name = $newName;
    $ingredient->image_name = $newImg;
    $ingredient->description = $newDsc;
    $ingredient->price = $newPrice;
    $ingredient->unit = $newUnit;

    // print_r($ingredient);
    return $ingredient;
  }
}


?>
