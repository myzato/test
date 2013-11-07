<?php
define( 'HOLIDAYCSV', '../lib/holiday.csv');

function cal_out( $y, $m, $today, $csv )
{
    /* 変数を初期化 */
    $y = (int) $y;
    $m = (int) $m;
    $today = (int) $today;

    $holiday_array = array();

    if ( file_exists( $csv ) ) {
        $handle = fopen( $csv, 'r' );
        /* $data配列にcsvを1行ずつ読み込み、$holiday_arrayに代入する */
        while ( ( $data = fgetcsv( $handle, 256, ',' ) ) !== FALSE) {
            /* 年と月が一致する行だけ取得 */
            if ( $data[0] == $y && $data[1] == $m ) {
                $holiday_array[] = $data[2]; // 日付が入る
            }
        }
        fclose( $handle );
    }

    if ( checkdate( $m, 1, $y ) ) {

        /* 月初めの曜日と、今月の最終日は何日かを求める */
        $fdow  = date( 'w', mktime(0, 0, 0, $m, 1, $y ) ); // 0～6が入る
        $edate = date( 't', mktime(0, 0, 0, $m, 1, $y ) ); // 28～31が入る

echo '<table>
<tbody>
<tr>
  <td colspan="7">' . $y . '年' . $m . '月のカレンダー</td>
</tr>
<tr>
  <th>日</th>
  <th>月</th>
  <th>火</th>
  <th>水</th>
  <th>木</th>
  <th>金</th>
  <th>土</th>
</tr>
<tr>
';
        /* 月頭の空白を出力する　*/
        switch ( $fdow ) {
        case 0 : break;
        case 1 : echo '<td>&nbsp;</td>' . "\n";
                 break;
        default: echo '<td colspan="' . $fdow . '">&nbsp;</td>' . "\n";
        }

        $j = $fdow; // 変数$jに1日の曜日を代入

        for ( $d = 1; $d <= $edate ; $d++ ) {
            /* 曜日で背景の色を変えるための処理 カラムの装飾設定 */
            switch( $j ) {
            case 0: //日曜日
                $tdcol = ' bgcolor="#ccccff" ';
                break;
            case 6: //土曜日
                $tdcol = ' bgcolor="#ccccff" ';
                break;
            default: //平日
                /* 休日対応 csvから読み込んだ配列から検索 */
                if ( array_search( $d, $holiday_array ) !== FALSE ) {
                    $tdcol = ' bgcolor="#ccccff" ';
                } else {
                    $tdcol = NULL ;
                }
            }

            /* 今日を太字にするための処理*/
            $sb = NULL;
            $eb = NULL;

            if ( $d === $today ) {
                $sb = '<b>' ;
                $eb = '</b>';
            }
            echo ' <td' . $tdcol . '>' . $sb . $d . $eb . '</td>' . "\n";            if ( $j == 6 ){
                echo '</tr>' . "\n" . '</tr>' . "\n"; //土曜日の場合は改行を出力
                $j = 0;
            } else {
                $j++; // 曜日を1つずらす
            }
        }

        /* 月末の空白を出力する　*/
        switch( $j ){
        case 6 : break;
        case 5 : echo '<td>&nbsp;</td>' . "\n";
                 break;
        default: echo '<td colspan="' . ( 7 - $j ). '">&nbsp;</td>' . "\n";
        }
        echo '</tr>
<tbody>
</table>
';
    } else {
        echo '日付の指定が不正です' . "\n";
    }
}
?>

<html>
<head>
<meta http-equiv="Content-Type" /content="text/html; charset=Shift_JIS">
<title>カレンダー出力サンプルプログラム1</title>
</head>
<body>
<?php
/* 現在の年月日の取得 */
$year  = date('Y'); // 現在の年を取得
$month = date('m'); // 現在の月を取得
$date  = date('d'); // 現在の日を取得

echo '■今月のカレンダーを出力<br />' . "\n";
cal_out( $year, $month, $date, HOLIDAYCSV );
echo '<br />' . "\n";

if( isset( $_GET['year'] ) )
    $year = htmlspecialchars($_GET['year'], ENT_QUOTES);
if( isset( $_GET['month'] ) )
    $month = htmlspecialchars($_GET['month'], ENT_QUOTES);
if( isset( $_GET['date'] ) )
    $date = htmlspecialchars($_GET['date'], ENT_QUOTES);

echo '■指定された日付のカレンダーを出力<br />' . "\n";
cal_out( $year, $month, $date, HOLIDAYCSV );
echo '<br />' . "\n";
?>
</body>
</html>