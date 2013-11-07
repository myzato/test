<?php
 
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
 
$conn = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
 
//$result = $conn->get('account/verify_credentials');


$date_data = date("Y/m/d H:i:s a");
$msg = (date("H")==14) ? "$date_data の昼飯だよ！" : "$date_data の夕飯だよ！";
 
$params = array(
	    'status' => $msg . "宅麺がおいしいよ！ http://takumen.com "
    );
 
$result = $conn->post('statuses/update', $params);

var_dump($result);
