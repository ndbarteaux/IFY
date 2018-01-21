<?php
header('Content-Type: text/json');
header("Access-Control-Allow-Origin: *");

/* Indicates whether our server is good to go */
$a = array ('status' => 'open');

echo json_encode($a);

?>
