<?php session_start(); ?>

<html>
<body>

<?php
	$_SESSION['bridge'] = 100;
	$b = $_SESSION['bridge'];
	print "ページ1の値は $b です。<BR>¥n";
?>

<a href ='session2.php'>ページ2へ<a>
</body>
<html>


