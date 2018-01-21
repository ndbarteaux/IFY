<?php
require_once "inc/page_setup.php";
$pgTitle = "AJAX View Ingredient";
include ('inc/header.php');
echo '<script src="./jquery.min.js"></script>';
echo '<script type="text/javascript" src="./ajax_viewingr.js"></script>';

if(isset($_GET["ing"])){
	if(isset($_GET["link"])){
		$displayIngredient = $_GET["ing"];
		$displayLink = $_GET["link"];
		// echo 'display ingredient [' . $displayIngredient . ']';
		// echo ' display link [' . $displayLink . ']';
	}
}

?>
</head>

<?php include ('inc/nav.php');?>

<!-- Start contents of main page here. -->
<?php
echo "<script> insertIngr('$displayIngredient', '$displayLink') </script>"
?>

<div class="col-lg-2 col-md-2 hidden-sm hidden-xs" ></div>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
	<h2 id="ingrTitle">[Ingredient Name]</h2>
	<p>
		Description:
		<span id="ingrDesc">[Ingredient Description]</span>
		<br>
	</p>
	<p style="text-align: center;">
		Price: <b> $<span id="ingrPrice">[Ingredient Price]</span> / <span id="ingrUnits">[Ingredient Units]</span> </b>
	</p>

	<!-- <p id="output1"> ... </p> -->
	<p>Ingredient Data Status: <span id="output1">...</span></p>
	<p>Ingredient Image Status: <span id="output2">...(images take a couple seconds to load)</span></p>
</div>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
	<img id="ingrImg" src="" class="img-circle img-responsive" alt="Picture of ingredient" />

	<?php if($_SESSION["sessionUser"] != 'Guest'){ ?>
	<br><form action="#" style="text-align:center;" method="post">
		<input type="submit" name="cart" value="Add To Cart" style = "color: black;">
	</form>
	<?php }; ?>
	<?php
		static $cartItems = array();
		static $numItems = array();
		// echo '<br><form action="#" style="text-align:center;" method="post"> <input type="submit" name="cart" value="Add To Cart" style = "color: black;"> </form>';

		if(isset($_POST['cart'])) {

			$ingName = $_GET['ing'];
			$ingCost = $_GET['cost'];


			if(isset($_SESSION['cartItems'])) {
				$cartItems=$_SESSION['cartItems'];
				$numItems=$_SESSION['numItems'];
			}

			if(array_key_exists($ingName,$cartItems)){
				$cartItems[$ingName]+=$ingCost;
			}else{
				$cartItems[$ingName]=$ingCost;
			}

			if(array_key_exists($ingName,$numItems)){
				$numItems[$ingName]+=1;
			}else{
				$numItems[$ingName]=1;
			}

			$_SESSION['cartItems'] = $cartItems;
			$_SESSION['numItems'] = $numItems;

			//echo 'numItems: ';
			//print_r($numItems);
			//echo 'cartItems: ';
			//print_r($cartItems);
			echo '<p><center>[' . $ingName . '] added to the cart with cost of [$' . $ingCost . ']!</center></p>';
		}
				?>
</div>

<div class="col-lg-2 col-md-2 hidden-sm hidden-xs" ></div>

<!-- End of contents -->


<?php include('inc/footer.php'); ?>
