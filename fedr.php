<?php
header ( 'Content-Type: text/json' );
header ( "Access-Control-Allow-Origin: *" );
$a = array();
$i = 0;

// [{"Team":"1","nameShort":"Yammy","nameLong":"Ingredients are Yammy","baseURL":"http:\/\/www.cs.colostate.edu\/~yammy\/project3\/"}]

$a [$i++] = array('Team' => '1', 'nameShort' => 'Kale', 'nameLong' => 'Kale sucks', 'baseURL' => 'http://www.cs.colostate.edu/~bpowley/project3/');
$a [$i++] = array('Team' => '2', 'nameShort' => 'Herbivore', 'nameLong' => 'I think Ive met herbivore!', 'baseURL' => 'http://www.cs.colostate.edu/~brandtr/Project_3/');
$a [$i++] = array('Team' => '3', 'nameShort' => 'Empo', 'nameLong' => 'Ingredients Emporium', 'baseURL' => 'http://www.cs.colostate.edu/~mjrerle/p3/');

echo json_encode ( $a );
?>
