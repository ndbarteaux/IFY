<?php
header ( 'Content-Type: text/json' );
header ( "Access-Control-Allow-Origin: *" );

require_once "inc/page_setup.php";
$db = new Database();
$a = array ();
$i = 0;

$ingredients = $db->getIngredients();
foreach($ingredients as $ingredient) {
  $toaddName = $ingredient['ingredient_name'];
  $toaddDesc = $ingredient['description'];
  $toaddShort = substr($toaddDesc, 0, 10);
  $toaddShort = $toaddShort . "...";
  $toaddUnit = $ingredient['unit'];
  $toaddPrice = $ingredient['price'];

  $a [$i++] = array ('name' => $toaddName, 'short' => $toaddShort, 'unit' => $toaddUnit, 'cost' => $toaddPrice);
}

echo json_encode ( $a );

?>
