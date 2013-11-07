<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>くいったー</title>
	</head>

	<body>

		<?php
			// SQLiteデータベース「kuitter.sqlite」に接続
			$db = sqlite_open("kuitter.sqlite");

			// テーブルの内容を作成日時降順（新しい順）で
			// すべて取り出すクエリーを実行する
			$query = sqlite_query( $db,	"SELECT * FROM articles ".
											"ORDER BY kui_date DESC" );

			// テーブルの内容を取得できた場合
			if ( $query ) {
				// クエリの実行結果を配列として$datasetに代入する
				$dataset = sqlite_fetch_all( $query, SQLITE_ASSOC );

				echo '<h1>クエリの実行結果</h1>';

				// $datasetの各レコードを巡回する
				foreach( $dataset as $record ) {
					echo '<h2>' . $record["kui_title"] . '</h2>';
					echo $record["kui_name"] . '／';
					echo $record["kui_date"] . '<br>';
					echo nl2br($record["kui_comment"]);
					echo '<hr>';
				}
			}
			else
			{
				echo 'エラー：クエリを実行できませんでした';
			}
		?>

	</body>
</html>
