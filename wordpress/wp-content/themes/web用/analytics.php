<?php
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_AnalyticsService.php';

session_start();

$client = new Google_Client();

$client->setClientId( 'XXXXXXXXXXXX.apps.googleusercontent.com' );   // [A] Client ID
$client->setClientSecret( 'XXXXXXXXXXXXXXXXXXXXXXXX' );  // [B] Client secret
$client->setRedirectUri( 'http://example.com' ); // [C] Redirect URIs

$token_path = 'google-api-php-client/gapi_token.txt';
$result_path = 'google-api-php-client/gapi_anaresult.txt';

$service = new Google_AnalyticsService( $client );

if( isset( $_GET[ 'code' ] ) ) {
	$client->authenticate();
	$_SESSION[ 'token' ] = $client->getAccessToken();
	header( 'Location: http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
	exit;
}

if( isset( $_SESSION[ 'token' ] ) ) {
	$string = $_SESSION[ 'token' ];
	$fp = fopen( $token_path, "w" );
	@fwrite( $fp, $string, strlen( $string ) );
	fclose( $fp );
	unset( $string );
	$client->setAccessToken( $_SESSION[ 'token' ] );
} elseif( file_exists( $token_path ) ) {
	$token = @file( $token_path );
	$client->setAccessToken( $token[0] );
}

if( $client->getAccessToken() ) {
	try {
		$ids = 'ga:XXXXXXXX';   // [D] プロファイルID
		$start_date = date( 'Y-m-d', strtotime( "-30 day", time() ) );  // [E] 30日前から
		$end_date = date( 'Y-m-d', strtotime( "today", time() ) );  // [E] 今日までの期間
		$metrics = 'ga:pageviews';  // [F] メトリクス
		$dimensions = 'ga:pageTitle, ga:pagePath';  // [G] ディメンション
		$sort = '-ga:pageviews';    // [H] ソート
		$filters = null;    // [I] フィルター
		$max_results = 10;  // [J] 表示する投稿数より多くしておく
		$optParams = array( 'dimensions' => $dimensions, 'sort' => $sort, 'filters' => $filters, 'max-results' => $max_results );
		$data = $service->data_ga->get( $ids, $start_date, $end_date, $metrics, $optParams );

		$results = array();
		foreach( $data[ 'rows' ] as $row => $value ) {
			foreach( $data[ 'columnHeaders' ] as $key => $header ) {
				$results[ $row ][ $header[ 'name' ] ] = $value[ $key ];
			}
		}

		foreach( $results as $result ) {
			$string .= "{$result[ 'ga:pagePath' ]}, {$result[ 'ga:pageTitle' ]}, {$result[ 'ga:pageviews' ]}\n";
		}

		$fp = fopen( $result_path, "w" );
		@fwrite( $fp, $string, strlen( $string ) );
		fclose( $fp );

		echo $string;

	} catch( apiServiceException $e ) {
		echo $e->getMessage();
	}
} else {
	$auth_url = $client->createAuthUrl();
	echo 'トークンを入手できませんでした。<a href="' . $auth_url . '">ここをクリックしてアクセスを許可してください。</a>';
}
