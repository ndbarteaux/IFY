<?php
require_once 'inc/page_setup.php';

if (! isset ( $_GET ["id"] )) {
	die (); // Normally would return default image or shim
}

$db = new Database ();
$imageRecord = $db->getImage ( $_GET ["id"] );
if ($imageRecord === FALSE) { // if the database can find no record of the image attempting to be accessed, kill the process
	die ();
}
// open the file in a binary mode
$name = $config->upload_dir . str_pad ( $imageRecord ["id"], $config->pad_length, "0", STR_PAD_LEFT ) . "." . $imageRecord ["ext"];
$fp = fopen ( $name, 'rb' );

// send the right headers
$contentType = "Content-Type: " . $imageRecord ["type"];
header ( $contentType );
header ( "Content-Length: " . filesize ( $name ) );

// dump the picture and stop the script
fpassthru ( $fp );
exit ();