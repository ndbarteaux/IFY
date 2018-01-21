<?php

require_once "inc/page_setup.php";

$db = new Database();
$pgTitle = "Home";

include ('inc/header.php');
?>
</head>

<?php include ('inc/nav.php');
?>

<!-- Start contents of main page here. -->

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h2>Welcome to Ingredients For You!</h2>
			<h3>
			The following are ingedients hosted specifically on our website! <br>
			To find a complete list of ingredients from us and all our associates, please visit our 'Federation Ingredients' page!
			</h3>
		</div>
	</div>

	<?php
		$ingredients = $db->getIngredients();
		foreach($ingredients as $ingredient) {
		?>
		<div class="row" style="text-align: center; padding: 10px; margin-bottom: 2px; border-top: 1px solid black;">
			<div class="col-xs-12">
				<h3> <a href="/viewIngredient.php?i=<?php echo $ingredient["ingredient_name"]?>"><?php echo $ingredient["ingredient_name"]?></a>:</h3>
				<!--<p>DESCRIPTION: <i> <?php //echo $ingredient["description"]?></i></p>-->
				<a href="viewIngredient.php?i=<?php echo $ingredient["ingredient_name"]?>"><img class="img-circle" style="height: 200px; width: 200px; margin-bottom: 5px;" src="assets/img/<?php echo $ingredient["image_name"];?>" alt="<?php echo $ingredient["ingredient_name"];?>" /></a>

			</div>
		</div>
	<?php }; // end the foreach loop ?>
</div>

<!-- End of contents -->
<?php include('inc/footer.php'); ?>
