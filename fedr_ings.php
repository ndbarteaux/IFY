<?php
/*<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Federation Ingredients Page</title>

<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="./jquery.min.js"></script>
<script type="text/javascript" src="./fedr_ings.js"></script>*/
require_once "inc/page_setup.php";
$pgTitle = "Ingredients";

include ('inc/header.php');
echo '<script src="./jquery.min.js"></script>';
echo '<script type="text/javascript" src="./fedr_ings.js"></script>';
?>
</head>

<?php include ('inc/nav.php'); ?>

<!-- Start contents of main page here. -->

<div class="container">
  <div class="row">
    <div class="col-xs-1">
    </div>
    <div class="col-xs-10">
      <h3 style="text-align: center;">Ingredients For Sale</h3>
      <p style="text-align: center;">The following ingredients are for sale by us and our partners!</p>
      <table id="ings" class="table table-striped" style="margin: 0 auto;">
        <tr>
          <th>Ingredient Name</th>
          <th>Unit</th>
          <th>Price</th>
          <th>Host Website</th>
        </tr>
      </table>
      <p  style="text-align: center;">
        Status of Sites AJAX Call: <span id="output1">Unresponsive</span>
      </p>
    </div>
    <div class="col-xs-1">
    </div>
  </div>
</div>


  <!-- End of contents -->
  <?php include('inc/footer.php'); ?>
