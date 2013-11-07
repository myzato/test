<?php
$array =  array("aiueo","kakikukeo");

foreach($array as $f){
	echo $f;
}

require_once "Gurunavi.php";

$gurunavi = new Gurunavi();

$rests = $gurunavi->search();

foreach ($rests as $rest) {
	$name = $rest->get_name(). "\n";
	$image_url = $rest->get_image_url() . "\n";
	$page_url = $rest->get_page_url(). "\n";
	$latitude = $rest->get_latitude() . " " . $rest->get_longitude() . "\n";
	$address = $rest->get_address() . "\n";
}


?>
