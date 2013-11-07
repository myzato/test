<?php
	$base_url	= "http://www.example.com/php/kaukau_top.php";
	$site_title	= "買う買うWeb";
	header("Content-Type: application/rss+xml; charset=utf-8");
	echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<rss version="2.0">
	<channel>
		<title><?php echo $site_title; ?></title>
		<link><?php echo $base_url; ?></link>
		<language>ja</language>
		<?php
			$db			= sqlite_open("kaukau.sqlite");
			$sql		=	"SELECT item_id, item_name, user_name, item_satisfaction, item_comment, item_date FROM items, users WHERE items.item_userid = users.user_id LIMIT 10";
			$query		= sqlite_query( $db, $sql );
			$dataset	= sqlite_fetch_all($query);
			foreach( $dataset as $record ){	
				$record["item_date"]			= date('r', strtotime( $record["item_date"]) );
				$record["item_satisfaction"]	= "満足度:" . $record["item_satisfaction"];
		        echo '<item>';
		        echo '<title>' . $record["item_name"] . '</title>';
		        echo '<link>' . $base_url . '?itemid=' . $record["item_id"] . '</link>';
		        echo '<description>' . $record["item_satisfaction"] . '<br />' . nl2br($data[item_comment]) . '</description>';
		        echo '<pubDate>' . $record["item_date"] . '</pubDate>';
		        echo '<author>' . $record["item_name"] . '</author>';
		        echo '</item>';
			}
		?>
	</channel>
</rss>
