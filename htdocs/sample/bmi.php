<?php
header("Content-Type: text/html; charset=UTF-8");
function bmi ($height,$mass) 
{
	  $height = $height / 100;
	    $mass = $mass / ($height * $height);
	    return $mass;
}

function h($str) { 
	 return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html>
<body>
<?php 
if (isset($_POST["submit"])) { 
	$bmi = bmi($_POST["height"], $_POST["mass"]); 
	print "あなたの BMI 値は" . h($bmi) . "です ";
} else {
	print "BMI 値を計算します ";
}
?> 
<form action="bmi.php" method="post"> 
身長 <br>
<input type="text" name="height"><br>
体重 <br>
<input type="text" name="mass"><br>
<input type="submit" name="submit" value=" 送信 "><br>
</form>
</body>
</html>
