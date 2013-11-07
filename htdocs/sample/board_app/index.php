<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>一言</title>
</head>
<body>
<form action="regist.php" method="post">
  名前：<br />
  <input type="text" name="name" size="30" value="" /><br />
  メッセージ：<br />
  <textarea name="message" cols="30" rows="5"></textarea><br />
  <br />
  <input type="submit" value="投稿する" />
</form>
<?php

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

$result = mysql_query('SELECT * FROM messages ORDER BY no DESC', $con);
while ($data = mysql_fetch_array($result)) {
  echo "<p>\n";
  echo '<strong>[No.' . $data['no'] . '] ' . htmlspecialchars($data['name'], ENT_QUOTES) . ' ' . $data['created'] . "</strong><br />\n";
  echo "<br />\n";
  echo nl2br(htmlspecialchars($data['message'], ENT_QUOTES));
  echo "</p>\n";
}

$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}

?>

</body>
</html>
