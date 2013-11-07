<?php
	// セッション制御
	session_start();

	// DBファイルオープン
	$db = sqlite_open("kaukau.sqlite");

	// ログアウト処理
	if ( $_GET["mode"] == "logout" ) {
		// ログアウト処理
		$_SESSION = array();
		session_destroy();
	}
	// ログイン中または未ログイン
	else {
		// ユーザー名取得
		if ( !empty($_SESSION["userid"]) ) {
			$sql		=	"SELECT user_name FROM users WHERE user_id = " . $_SESSION["userid"];
			$query		= sqlite_query( $db, $sql );
			$username	= sqlite_fetch_string($query);
		}
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>買う買う団Web</title>
		<link rel="stylesheet" type="text/css" href="kaukau_css.css">
		<link rel="alternate" type="text/xml" title="RSS" href="kaukau_rss.php">
	</head>

	<body>
		<div id="news"><!-- 買う買う新着情報を表示：ここから -->
			<div class="title2">買う買う新着情報</div>

			<?php
				$sql		=	"SELECT item_id, item_userid, item_name, user_name, item_date, item_image FROM items, users WHERE items.item_userid = users.user_id ORDER BY item_date DESC LIMIT 5";
				$query		= sqlite_query( $db, $sql );
				$dataset	= sqlite_fetch_all($query);

				foreach( $dataset as $record ) {
					echo '<div class="new_kaukau">';
					echo '<img src="' . $record["item_image"] . '"><br>';
					echo '買った物 <a href="kaukau_top.php?itemid=' . $record["item_id"] . '">';
					echo $record["item_name"] . '</a><br>';
					echo '買った人 <a href="kaukau_top.php?userid=' . $record["item_userid"]. '">';
					echo $record["user_name"] . '</a><br>';
					echo '購入日 ' . $record["item_date"] . '<br>';
					echo '</div>';
				}

				// --- ログインフォーム --------------------
				if ( empty($_SESSION[userid]) ) {
					echo '<br>';
					echo '<form action="kaukau_login.php" method="POST">';
					echo 'ログイン名 <input type="text" name="username" size="8"><br>';
					echo 'パスワード <input type="password" name="password" size="8"><br>';
					echo '<input type="hidden" name="mode" value="login">';
					echo '<input type="submit" value="ログイン">';
					echo '</form>';
				}
				else {
					echo '<br>';
					echo $username . 'さん、こんにちは<br><br>';
					echo '<a href="kaukau_add.php">商品投稿</a><br><br>';
					echo '<a href="kaukau_top.php?mode=logout">ログアウト</a>';
				}
			?>

		</div><!-- 買う買う新着情報を表示：ここまで -->

		<div id="products"><!-- 買う買う売れ筋商品：ここから -->
			<div class="title2">買う買う売れ筋商品</div>

			<?php
				$sql		=	"SELECT count(*) AS NumberOf_Item, item_name, item_maker, item_price, item_image, item_detail FROM items GROUP BY item_name ORDER BY count(*) DESC LIMIT 5";
				$query 		= sqlite_query( $db, $sql );
				$dataset	= sqlite_fetch_all($query);

				foreach( $dataset as $record ) {
					echo '<div class="new_kaukau">';
					echo '<img src="' . $record["item_image"] . '"><br>';
					echo '商品名 <a href="' . $record["item_detail"] . '">';
					echo $record["item_name"] . '</a><br>';
					echo 'メーカー ' . $record["item_maker"]. '<br>';
					echo '価格 ' . $record["item_price"] . '<br>';
					echo '購入者数 ' . $record["NumberOf_Item"] . '<br>';
					echo '</div>';
				}
			?>

		</div><!-- 買う買う売れ筋商品：ここまで -->

		<div id="contents"><!-- 買う買うメイン：ここから -->
			<div class="title1"><a href="kaukau_top.php">買う買うWeb</a></div>

			<?php
				// --- itemidもuseridも指定されてない場合は、累計物欲王と前月物欲王を表示 ----------
				if ( empty($_GET["itemid"] ) && empty($_GET["userid"]) ) {
					echo '<div class="title2">物欲魔王ランキング</div>';

					$sql		=	"SELECT count(*) AS NumberOf_Item, sum(item_price) as SumOf_price, max(item_date) as MaxOf_date, item_userid, user_name FROM items, users WHERE items.item_userid = users.user_id GROUP BY item_userid ORDER BY sum(item_price) DESC LIMIT 5";
					$query		= sqlite_query( $db, $sql );
					$dataset	= sqlite_fetch_all($query);

					foreach ( $dataset as $record ) {
						echo '<div class="new_kaukau">';
						echo '買った人 <a href="kaukau_top.php?userid=' . $record["item_userid"] . '">';
						echo $record["user_name"] . '</a><br>';
						echo '使った金額合計 ' . $record["SumOf_price"] . '円<br>';
						echo 'これまでに買った商品 ' . $record["NumberOf_Item"] . '点<br>';
						echo '直近お買い物日 ' . $record["MaxOf_date"] . '<br>';
						echo '</div>';
					}

					echo '<br><br><div class="title2">先月の物欲魔王</div>';

					// 先月の1日から
					$pm_start	= date( "Y-m-d", mktime( 0,0,0, date("m")-1, 1, date("Y") ) );
					// 先月の終わりまで
					$pm_end		= date( "Y-m-d", mktime( 0,0,0, date("m"), 0, date("Y") ) );

					$sql		=	"SELECT user_name, count(*) as NumberOf_Item, sum(item_price) as SumOf_price FROM items, users WHERE items.item_userid = users.user_id AND items.item_date >= '$pm_start' AND items.item_date <= '$pm_end' GROUP BY item_userid ORDER BY sum(item_price) DESC LIMIT 5";
					$query		= sqlite_query($db,$sql);
					$dataset	= sqlite_fetch_all($query);

					foreach ( $dataset as $record ) {
						echo '<div class="new_kaukau">';
						echo '買った人 ' . $record["user_name"] . '<br>';
						echo '使った金額合計 ' . $record["SumOf_price"] . '円<br>';
						echo 'これまでに買った商品 ' . $record["NumberOf_Item"] . '点<br>';
						echo '</div>';
					}
				}

				// --- itemidかuseridが指定されている場合はアイテムの詳細を表示 ----------
				if ( (!empty($_GET["itemid"]) && is_numeric($_GET["itemid"]))
						or (!empty($_GET["userid"]) && is_numeric($_GET["userid"])) ) {
					// --- itemid指定 ----------
					if ( !empty($_GET["itemid"]) && is_numeric($_GET["itemid"]) ) {
						$itemid	= addslashes($_GET["itemid"]);
						$sql	=	"SELECT item_id, item_name, item_maker,".
									" item_price, item_store, item_satisfaction,".
									" item_comment, item_image, item_detail,".
									" item_userid, user_name ".
									"FROM items, users ".
									"WHERE items.item_id = $itemid".
									" AND items.item_userid = users.user_id";
					}
					// --- userid指定 ----------
					else {
						$userid	=	addslashes($_GET["userid"]);
						$sql	=	"SELECT item_id, item_name, item_maker, item_price, item_store, item_satisfaction, item_comment, item_image, item_detail, item_userid, user_name FROM items, users WHERE items.item_userid = $userid AND items.item_userid = users.user_id";
					}

					$query = sqlite_query( $db, $sql );

					if ( sqlite_num_rows($query)>0 ) {
						$dataset = sqlite_fetch_all($query);

						foreach( $dataset as $record ) {
							echo '<div class="item"><!-- 買う買うアイテム詳細：ここから -->';
							echo '<img src="' . $record["item_image"] . '"><br>';
							echo '商品名 <a href="' . $record["item_detail"] . '">' . $record["item_name"] . '</a><br>';
							echo '買った人 ' . $record["user_name"] . '<br>';
							echo '価格 ' . $record["item_price"] . '<br><br>';
							echo '【評価】';
							echo '満足度 ' . $record["item_satisfaction"] . '点<br>';
							echo nl2br($record["item_comment"]);

							if ( $record["item_userid"] == $_SESSION["userid"] ) {
								echo '<br>';
								echo '<a href="kaukau_del.php?itemid=' . $record["item_id"] . '">このアイテムを削除する</a><br>';
							}

							echo '</div>';
						}
					}
				}
			?>

			<div class="info"><?php include "kaukau_info.php"; ?></div>

			<br><br>
			このサイトのRSS配信をご希望の方は、こちらのアイコンをクリック→	
			<a href="kaukau_rss.php">
				<img src="feed-icon32x32.png" width="16" height="16" border="0">
			</a>

		</div><!-- 買う買うメイン：ここまで -->
	</body>
</html>
