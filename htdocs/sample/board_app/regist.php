<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>一言</title>
</head>
<body>
<?php

if ($_REQUEST['name'] == '' or $_POST['message'] == '') {
  exit('error');
}

$con = mysql_connect('localhost', 'board_user', 'pass');
if (!$con) {
  exit('データベースに接続できませんでした。');
}

$result = mysql_select_db('board_app', $con);
if (!$result) {
  exit('データベースを選択できませんでした。');
}

$result = mysql_query('SET NAMES utf8', $con);
if (!$result) {
  exit('文字コードを指定できませんでした。');
}

#$name    = $_REQUEST['name'];
#$message = $_REQUEST['message'];
#$created = date('Y-m-d H:i:s');
#
#$result = mysql_query("INSERT INTO messages(name, message, created) VALUES('$name', '$message', '$created')", $con);
#if (!$result) {
#  exit('データを登録できませんでした。');
#}

require_once "Gurunavi.php";

$gurunavi = new Gurunavi();

$rests = $gurunavi->search();

foreach ($rests as $rest) {
	$name =  $rest->get_name();
	$image_url = $rest->get_image_url();
	$latitude = $rest->get_latitude();
	$page_url = "aiueo";
	$adress = $rest->get_address();
	$longitude = $rest->get_longitude();
}

$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}

?>
<p>メッセージを投稿しました。</p>
<ul>
  <li><a href="index.php">一覧へ戻る</a></li>
</ul>
</body>
</html>
