<html>
<body>

<?php
	if(move_uploaded_file(
		$_FILES['upfile']['tmp_name'],
		"./htdocs"
	)==FALSE){
		print "aiueo";
	}else{
		print ($_FILES['upfile']['name']);
		print "をアップしました";
	}
?>

</body>
</html>
