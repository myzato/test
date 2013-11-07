<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<style type="text/css" title="layout" media="screen">
			@import url("style.css");
		</style>

		<title>くいったー</title>
	</head>
	<body>
		<div id="container">
			<div class="contentheader"></div>
			<div class="maincontainer">
				<div class="content">
					<action="kuitter_csstop.php" method="POST">
						[ <a href="kuitter_csstop.php">トップ</a> ]
						[ <a href="kuitter_entry.php">新規投稿</a> ]
						[ <input type="text" name="search" size="30"> <input type="submit" value="検索"> ]
					</form>
					<?php
						// SQLiteデータベース「kuitter.sqlite」に接続
						$db = sqlite_open("kuitter.sqlite");

						// SQLの前半共通部分を代入
						$sql = "SELECT * FROM articles";

						// 検索語句が入力されているときはWHERE句を付ける
						if ( !empty($_POST["search"]) ) {
							echo $_POST["search"] . ' の検索結果<br>';

							$where		= "";
							$names		= "(kui_name || kui_title || kui_comment)";

							// $_POST["search"]の内容を「" "」を区切り文字として配列にする
							$keywords	= explode( " ", $_POST["search"] );

							// 検索語句の回数分繰り返してWHERE句を作る
							foreach( $keywords as $value ) {
								if ( !empty($where) ) {
									$where .= " AND ";
								}

								$where .= "$names LIKE '%$value%'"; 
							}

							// 作ったWHERE句を$sqlに追加
							$sql .= " WHERE $where";
						}

						// SQLの後半共通部分を代入
						$sql .= " ORDER BY kui_date DESC";

						// テーブルの内容を取り出すクエリーを実行する
						$query = sqlite_query( $db, $sql );

						// テーブルの内容を取得できた場合
						if ( $query ) {
							// クエリの実行結果を配列として$datasetに代入する
							$dataset = sqlite_fetch_all( $query, SQLITE_ASSOC );

							echo '<h1>今日何食った？</h1>';

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
							echo 'エラー：テーブルの内容を取得できませんでした' . $sql;
						}
					?>
				</div>
			</div>
		</div>
		<div class="bottom"></div>
	</body>
</html>
