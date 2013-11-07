<?php
	// セッション制御
	session_start();

	$db = sqlite_open("kaukau.sqlite");

	// パラメーターチェック
	if ( !empty($_SESSION["userid"]) && !empty($_GET["itemid"]) && is_numeric($_GET["itemid"]) ) {
		$itemid = addslashes($_GET["itemid"]);

		// ユーザーIDチェック
		$sql	= "SELECT item_userid FROM items WHERE item_id = $itemid";
		$query	= sqlite_query( $db, $sql );

		if ( sqlite_fetch_single($query) == $_SESSION["userid"] ) {
			// 削除実行
			if ( $_GET["mode"] == "del" ) {
				$sql = "DELETE FROM items WHERE item_id = $itemid";

				sqlite_query( $db, $sql );

				header("Location: kaukau_top.php");
			}
		}
	}
	else {
		header("Location: kaukau_top.php");
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>商品テーブルまたはユーザーテーブルを削除する</title>
	</head>

	<body>
		<p>
			記事を削除します。<br>
			よろしいですか？<br>
		</p>

		<a href="kaukau_del.php?mode=del&itemid=<?php echo $itemid; ?>">はい</a>
		<a href="kaukau_top.php">いいえ</a><br>
	</body>
<html>
