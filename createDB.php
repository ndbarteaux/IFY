<?php

require_once "inc/page_setup.php";
require_once "assets/passwordLib.php";

$pgTitle = "createDB";
include ('inc/header.php');

?>

</head>

<?php include ('inc/nav.php');?>


<!-- Start contents of main page here. -->

<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2>Create the Default Database and Tables</h2>
			<h3>
			On our site you will find information on some of the freshest ingredients to complement your cooking experience!
			</h3>
		</div>
	</div>
	<div class="row">

		<div class="col-xs-12">
			<ol>
				<li>Start a connection
					<?php if (!$dbh = setUpDatabaseConnection()) {die;} ?>
				</li>
				<li> Delete old ingredients, users, and comments tables.
					<?php dropTableByName("ingredients");
							dropTableByName("users");
							dropTableByName("comments");?>
				</li>
				<li>Create Tables. Ingredients then Users then Comments.
					<?php createTableIngredients();
							createTableUsers();
							createTableComments();?>
				</li>
				<li>Adding in default Ingredients, Users, and Comments.
					<?php addDefaultUsers();
							addDefaultIngredients();
							addDefaultComment();?>
				</li>
			</ol>
		</div>
	</div>
</div>

<!-- End of contents -->

<!-- Start Page Functions -->
<?php
function setupDatabaseConnection(){  //Database Setup
	try{
		$dbh = new PDO("sqlite:./ingredients.db");
		echo '<pre class="bg-success">';
		echo 'Connection successful.';
		echo '</pre>';
		return $dbh;
	} catch (PDOException $e) {
		echo '<pre class="bg-danger">';
		echo 'Connection failed: ' . $e->getMessage();
		echo '</pre>';
		return FALSE;
	}
}

function dropTableByName($tname){  // Dropping a table
	global $dbh;
   $sql = "DROP TABLE IF EXISTS $tname";
   $status = $dbh->exec ( $sql );
   if ($status === FALSE) {
      echo '<pre class="bg-danger">';
      print_r ( $dbh->errorInfo () );
      echo '</pre>';
   } else {
      echo '<pre class="bg-success">';
      echo 'Number of rows effected: ' . $status;
      echo '</pre>';
   }
}

function createTableIngredients(){  // Creating ingredient table
	$sql = "CREATE TABLE ingredients (
					id INTEGER PRIMARY KEY ASC,
					ingredient_name varchar(50),
					image_name varchar(50),
					description varchar(500),
					price varchar(15),
					unit varchar(15))";
	createTableGeneric($sql);
}

function createTableUsers(){   //Creating User Table
	$sql = "CREATE TABLE users (
					id INTEGER PRIMARY KEY ASC,
					username varchar (15),
					password varchar (50),
					email varchar(50),
					role int(2))";
	createTableGeneric($sql);
}

function createTableComments(){  //Creating Comments Table
	$sql = "CREATE TABLE comments (
					id INTEGER PRIMARY KEY ASC,
					ing_id int(5),
					comment_text varchar(500),
					user_id int(5),
					timestamp varchar(15),
					originating_ip varchar(10),
					FOREIGN KEY (ing_id) REFERENCES ingredients(id),
					FOREIGN KEY (user_id) REFERENCES uesrs(id))";
	createTableGeneric($sql);
}

function createTableGeneric($sql) {  // A generic Table
   global $dbh;
   $status = $dbh->exec ( $sql );
   if ($status === FALSE) {
      echo '<pre class="bg-danger">';
      print_r ( $dbh->errorInfo () );
      echo '</pre>';
   } else {
      echo '<pre class="bg-success">';
      echo 'Number of rows effected: ' . $status;
      echo '</pre>';
   }
}

function addDefaultIngredients(){
	//testedIngredientInsert(1, "Kale", "kale.jpg", "Kale is the nastiest shit, how anyone can ruin smoothies with this terrible ingredient is beyond me.");
	testedIngredientInsert(1,"Green Beans","greenbeans.jpg","These fresh green beans are a great source of fiber, antioxidants and vitamins.
		Steam them, fry them, or bake them in a casserole for a tasty, healthy treat!","0.99","pound");
	testedIngredientInsert(2, "Mint","mint.jpg","Use these fresh leaves to add a minty flavor to your tea or candy, or as a natural breath freshener.
		These leaves can also be used to add a pleasant aroma to any room.", "2.99","ounce");
	testedIngredientInsert(3,"Oregano","oregano.jpg","This herb is part of the mint family. Order fresh leaves to use now or let them dry out for more intense flavor!
		Oregano is wildly used Italian-American and Mediterranean cuisine.", "1.99","ounce");
}

function testedIngredientInsert($id, $ing_name, $img_name, $desc, $price, $unit){
	global $dbh;
	$sql = "INSERT INTO ingredients(id, ingredient_name, image_name, description, price, unit) VALUES ( '$id', '$ing_name', '$img_name', '$desc', '$price','$unit')";
	$status = $dbh->exec($sql);
	if($status === FALSE){
		echo '<pre class="bg-danger">';
		print_r ( $dbh->errorInfo () );
      echo '</pre>';
   } else {
      echo '<pre class="bg-success">';
      echo 'Number of rows effected: ' . $status;
      echo '</pre>';
   }
}

function addDefaultUsers(){
	testedUserInsert(1, "bpowley", "password","brendon.powley@gmail.com",1);
	testedUserInsert(2, "ndbarteaux", "password","ndbarteaux@gmail.com", 1);
	testedUserInsert(3, "ct310", "A835E0", "ct310@cs.colostate.edu", 1);
	testedUserInsert(4, "fred", "3B23E6", "ct310@cs.colostate.edu", 0);
}

function testedUserInsert($id, $username, $password, $mail, $role){  // Insert users into CSV
	global $dbh;
	$hash = password_hash($password);
	$sql = "INSERT INTO users(id, username, password, email, role) VALUES ( '$id', '$username', '$hash', '$mail', '$role')";
	$status = $dbh->exec($sql);
	if($status === FALSE){
		echo '<pre class="bg-danger">';
		print_r ( $dbh->errorInfo () );
      echo '</pre>';
   } else {
      echo '<pre class="bg-success">';
      echo 'Number of rows effected: ' . $status;
      echo '</pre>';
   }

}

function addDefaultComment(){
	//$unixTime = time() + (7 * 24 * 60 * 60);
	$unixTime = date("h:i:s");
	// echo 'now: ' . date('Y-m-d') . "\n";

	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	testedCommentInsert(1, 1, "I used to dislike green beans, but now I enjoy them!", 1, $unixTime, $ip);
}

function testedCommentInsert($id, $iID, $comment, $uID, $time, $oIP){
	global $dbh;
	$sql = "INSERT INTO comments(id, ing_id, comment_text, user_id, timestamp, originating_ip) VALUES ( '$id', '$iID', '$comment', '$uID', '$time', '$oIP')";
	$status = $dbh->exec($sql);
	if($status === FALSE){
		echo '<pre class="bg-danger">';
		print_r ( $dbh->errorInfo () );
      echo '</pre>';
   } else {
      echo '<pre class="bg-success">';
      echo 'Number of rows effected: ' . $status;
      echo '</pre>';
   }
}
?>

<!-- End Page Functions -->

<?php include('inc/footer.php'); ?>
