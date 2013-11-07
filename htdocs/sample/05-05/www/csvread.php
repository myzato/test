<?php
define( 'NIKKICSV', '../data/nikki2009.csv');
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Shift-JIS" />
    <title>日記書き込み</title>
</head>
<body>

<table align="center" bgcolor="#cc6666" width="800">
<tbody>
<tr>
    <td style="color:#ffcc99" align="center">PHP で作る日記帳</td>
</tr>
</tbody>
</table>

<?php
/* 日記をcsvファイルから読み込み表示する */
if ( $fp = @fopen( NIKKICSV, 'r' ) ) {
    while ( ( $nikki = fgetcsv( $fp, 1024, "\t" ) ) !== FALSE ) {
        //nikki[0] : 年 nikki[1] : 月 nikki[2] : 日
        //nikki[3] : タイトル nikki[4] : 気分 nikki[5] : 本文
        switch( $nikki[4] ){
        case 0: $feeling = 'Good!'; break;
        case 1: $feeling = '普通'; break;
        case 2: $feeling = 'Bad'; break;
        default : $feeling = NULL;
        }
        echo '<table align="center" width="400">
<tbody>
<tr>
    <td><b>' . $nikki[0] . '年' . $nikki[1] . '月' . $nikki[2] . '日</b>(' . $feeling . ')</td>
</tr>
<tr>
    <td> ' . $nikki[3] . '</td>
</tr>
<tr>
    <td>' . $nikki[5] . '</td>
</tr>
</tbody>
</table>
<br />
';
    }
}
?>

<br />
<table align="center" bgcolor="#cc6666" width="800">
<tbody>
<tr>
    <td style="color:#ffcc99" align="center">
      Copyright(C)2009 ひと目でわかるPHP開発入門, ALL Rights Reserved.</td>
</tr>
</tbody>
</table>

</body>
</html>