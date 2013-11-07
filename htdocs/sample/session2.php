<?php session_start(); ?>

<html>
<body>

<?php
	$b = $_SESSION['bridge'];
print "ページ2の値は $b です <BR>¥n";
?>

<a href = "session1.php">ページ1へ</a>

</body>
</html>
