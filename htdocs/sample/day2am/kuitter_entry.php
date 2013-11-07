<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>投稿されたデータをDBに追加する</title>
	</head>

	<body>

		<?php
			// POSTで送られてきた内容から「mode」の値を読み取れる場合
			if ( !empty($_POST["mode"]) ) {
				// SQLiteデータベース「kuitter.sqlite」に接続
				$db = sqlite_open("kuitter.sqlite");

				// SQLの追加クエリを作成する
				$sql  = "INSERT INTO articles VALUES ( '"	. $_POST["date"] . "','"
															. $_POST["name"] . "','"
															. $_POST["title"]  . "','"
															. $_POST["comment"] . "', '' );";

				// SQLのクエリを実行する
				sqlite_query( $db, $sql );

				echo 'データを追加しました。<br><br>';
			}
		?>

		<form action="kuitter_entry.php" method="POST">
			日付(yyyy-mm-dd hh:mm:ss) <input type="text" name="date" size="30"><br>
			名前 <input type="text" name="name"><br>
			タイトル(店名,etc...) <input type="text" name="title" size="40"><br>
			コメント<br>
			<textarea name="comment" cols="40" rows="5"></textarea><br>
			<input type="submit" name="mode" value="投稿">
		</form>

	</body>
</html>
