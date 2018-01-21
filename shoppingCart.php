<?php

require_once "inc/page_setup.php";

$pgTitle = "Shopping Cart";
include ('inc/header.php');
$db = new Database();
?>

</head>

<?php include ('inc/nav.php');?>
<?php
function sendEmail($db) {
	$items = $_SESSION['cartItems'];
	$numItems = $_SESSION['numItems'];
	$_SESSION['cartItems'] = array();
	$_SESSION['numItems'] = array();
	$contents = "";
	$totalCost = 0;
	// foreach($items as $key=>$value){
	// 	$contents .= "\t--" . $key . " for $" . $value . ",\n";
	// 	$totalCost+=$value;
	// }

	foreach($items as $key=>$value){
		foreach($numItems as $numKey=>$numValue){
			if($numKey==$key){
				$contents .= "\t--" . $numValue . " ". $key . "(s) for $" . $value . ",\n";
				$totalCost+=$value;
			}
		}

	}

	$contents .= "For a total cost of $" . $totalCost . "\n";
	$contents .= "\nThank you for shopping with Ingredients For You!";


	if (strcmp($contents, "") == 0)
		return;

	$sql = "SELECT * FROM users WHERE role='1'";
	$admins = $db->prepare($sql);
	$admins->execute();

	$msgBody = "Hello " . $_SESSION['sessionUser'] . "!\nAn order has been placed for the following items: \n" . $contents;
	/*foreach ($admins as $a)
		mail($a['email'], "Shopping Cart", $msgBody);*/

	$sql = "SELECT email FROM users WHERE username='" . $_SESSION['sessionUser'] . "'";
	$email = $db->prepare($sql);
	$email->execute();
	$email = $email->fetch();
	$sendTo = $email['email'];

	mail($sendTo, "Shopping Cart", $msgBody);

	header ("Location: ./shoppingCart.php");
}
?>
<!-- Start contents of main page here. -->

<div class="col-lg-3 col-md-3 hidden-sm hidden-xs"></div>

<?php if (strcmp($_SESSION ['sessionUser'], "Guest") != 0) :?>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div align="center">
			<h1>Your Shopping Cart:</h1>
			<table id="cart" class="table table-striped" style="margin: 0 auto; text-align: center;">
				<tr>
					<th style="text-align: center;">Amount</th>
					<th style="text-align: center;">Ingredient Name</th>
					<th style="text-align: center;">Total Cost</th>
				</tr>
			<?php
				if (!isset($_SESSION['cartItems'])) {
					$_SESSION['cartItems'] = array();
					$_SESSION['numItems'] = array();
				}

				if(isset($_GET['i'])){
					array_push($_SESSION['shoppingCart'], $_GET['i']);
				}


				$count = 1;


				$last = count($_SESSION['cartItems'])-1;


				$totalCost=0;

				/*foreach($_SESSION['cartItems'] as $key=>$value) {
					echo "$key: <strong>$" . $value . "</strong><br>";
					$count = $count + 1;
					$totalCost+=$value;
				}*/

				foreach($_SESSION['cartItems'] as $key=>$value) {
					foreach($_SESSION['numItems'] as $numkey=>$numvalue){
						if($key==$numkey){
							// echo '<h3>' . $numvalue . " " . $key . "(s): <strong>$" . $value . "</strong></h3>";
							echo '<tr>';
							echo '<td>' . $numvalue . '</td>';
							echo '<td>' . $key . '</td>';
							echo '<td>$' . $value . '</td>';
							echo '</tr>';
							$count = $count + 1;
							$totalCost+=$value;
						}
					}
				}

				if($totalCost==0){
					echo '<h2>Your Shopping Cart is Empty!</h2><br>';
					echo '<p>Check out our Federation Ingredient page to start shopping!</p>';
				}


			?>
			</table>
			<?php echo '<h2>Total Cost: <strong>$' . $totalCost . '</strong></h2>'; ?>
			<?php
				if(isset($_POST['submit']))
					sendEmail($db);
			?>
			<form action="./shoppingCart.php" method="POST">
				<input type="submit" name="submit" value="Checkout">
			</form>
		</div>
	</div>
<?php else: ?>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div align="center">
			<h4>Must be logged in to view cart</h4>
		</div>
	</div>
<?php endif; ?>
<!-- End of contents -->

<div class="col-lg-3 col-md-3 hidden-sm hidden-xs" ></div>


<?php include('inc/footer.php'); ?>
