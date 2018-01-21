<?php
/*<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Federation Status Page</title>

<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>*/

require_once "inc/page_setup.php";
$pgTitle = "Federation Status Page";

include ('inc/header.php');
echo '<script src="./jquery.min.js"></script>';
echo '<script type="text/javascript" src="./fedr_status.js"></script>';

?>
</head>

<?php include ('inc/nav.php'); ?>

<!-- Start contents of main page here. -->
<div class="container">
  <div class="row">
    <div class="col-xs-1">
    </div>
    <div class="col-xs-10">
      <h3 style="text-align: center;">Federation Status Page</h3>
      <p style="text-align: center;"> This page should display which sites are open (green), closed (red), and not responding (yellow) within our ingredients federation</p>
      <table id="sites" class="table" style="margin: 0 auto;">
        <tr>
          <th style="text-align: right;">Status</th>
          <th style="text-align: right;">Team #</th>
          <th style="text-align: right;">Name Short</th>
          <th style="text-align: right;">Name Long</th>
          <th style="text-align: right;">URL</th>
        </tr>
      </table>
      <p style="text-align: center; padding-top: 2em;">
        Status of Sites AJAX Call: <span id="output1">Unresponsive</span>
      </p>
    </div>
    <div class="col-xs-1">
    </div>
  </div>
</div>

  <!-- End of contents -->
  <?php include('inc/footer.php'); ?>
