<?php

function uranai($uranai)
{
	$min=0;
	$max=count($uranai)-1;
	$key=mt_rand($min,$max);
	$result = $uranai[$key];

	return $result;
}


$uranai[]="uranai1";
$uranai[]="uranai2";
$uranai[]="uranai3";
$uranai[]="uranai4";
$uranai[]="uranai5";
$uranai[]="uranai6";
$uranai[]="uranai7";

print uranai($uranai);
?>
