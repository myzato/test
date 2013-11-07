<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>くいったー用SQLiteのファイルを作成し、テーブルを準備する</title>
	</head>

	<body>

		<p>くいったー用にSQLiteのファイルを作成し、テーブルを準備します...</p>

		<?php
			// SQLiteデータベース「kuitter.sqlite」に接続
			$db = sqlite_open("kuitter.sqlite");

			sqlite_query( $db, "DROP TABLE articles" );

			// テーブルを作成
			sqlite_query( $db, "CREATE TABLE articles ".
									"(   kui_date timestamp,".
										"kui_name text, ".
										"kui_title text, ".
										"kui_comment text, ".
										"kui_image text )" );

			// 作成したテーブルに、テスト用ダミーデータを追加
			sqlite_query( $db, "INSERT INTO articles VALUES ".
									"( '2007-01-01 00:00:00', ".
									"'dummy', 'dummy', 'dummy', '' )" );

			// 作成したテーブルの内容をすべて取り出す
			$query = sqlite_query( $db, "SELECT * FROM articles" );

			// 作成したテーブルの内容を表示
			var_dump($query);
		?>

	</body>
</html>
