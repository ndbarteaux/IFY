<?php
header('Content-Type: text/json');
header("Access-Control-Allow-Origin: *");

$a = array ('status' => 'open');

echo json_encode($a);

?>
