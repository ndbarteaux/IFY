<?php
header ( 'Content-Type: text/json' );
header ( "Access-Control-Allow-Origin: *" );

require_once "inc/page_setup.php";
$db = new Database();

if(isset($_GET["ing"])){
	$displayIngredient = $_GET["ing"];

	$checkString1 = substr($displayIngredient,0,1);
	$checkString2 = substr($displayIngredient,-1,1);
	if(($checkString1 == '"') && ($checkString2 =='"')){
		$searchIng = substr($displayIngredient,1,-1);
		$ingimg = $db->getImage($searchIng);
	}else{
		$ingimg = $db->getImage($displayIngredient);
	}
	/* Check if ingredient exists in our files */
	$img_path = "/Users/nathanbarteaux/IFY/assets/img/" . $ingimg['image_name'];
	$im = file_get_contents($img_path);
	$imdata = base64_encode($im);
	echo json_encode($imdata);
}else{
	echo "there is no specified ingredient's data to display!";
}

?>
