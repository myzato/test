<?php
define( 'NIKKICSV', '../data/nikki2009.csv');
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Shift-JIS" />
    <title>úL«Ý</title>
</head>
<body>

<table align="center" bgcolor="#cc6666" width="800">
<tbody>
<tr>
    <td style="color:#ffcc99" align="center">PHPで作る日記帳</td>
</tr>
</tbody>
</table>

<?php
/* úLðf[^x[X©çÇÝÝ\¦·é */

/* »ÝÌútðæ¾ */
$year = date( 'Y', $_SERVER['REQUEST_TIME'] );
$month = date( 'm', $_SERVER['REQUEST_TIME'] );

/* MySQLÖÚ± */
$link = @mysqli_connect('localhost', 'phpuser', 'pass', phpdiary ) or die( mysqli_connect_error() );

/* Ú±Ì¶R[hðZbg */
mysqli_set_charset( $link, 'utf-8' );

/* NGð¶¬Bdidðí·é±ÆÉÓ */
$query = 'SELECT title,contents,feeling,year,month,date FROM nikki WHERE year = ? AND month = ? ORDER BY did DESC';

/* NGðo^ */
if ( $stmt = mysqli_prepare( $link, $query ) ) {
    /* ÏðNGÉoCh */
    mysqli_stmt_bind_param($stmt, 'ii', $year, $month );

    /* NGðÀs */
    mysqli_stmt_execute( $stmt ) or die( mysqli_stmt_error( $stmt ) );

    /* ÊÏðoCh */
    mysqli_stmt_bind_result($stmt, $title, $contents, $feeling, $year, $month, $date );

    while ( mysqli_stmt_fetch( $stmt ) ) {
        switch( $feeling ){
        case 0: $feeling = 'Good!'; break;
        case 1: $feeling = 'Ê'; break;
        case 2: $feeling = 'Bad'; break;
        default : $feeling = NULL;
        }
    /* úLðoÍ */
    echo '<table align="center" width="400">
<tbody>
<tr>
    <td><b>' . $year . 'N' . $month . '' . $date . 'ú</b>(' . $feeling . ')</td>
</tr>
<tr>
    <td> ' . $title . '</td>
</tr>
<tr>
    <td>' . $contents . '</td>
</tr>
</tbody>
</table>
<br />
';
    }
    mysqli_stmt_close( $stmt );
}
/* Ú±ðI¹·é */
mysqli_close( $link );
?>

<br />
<table align="center" bgcolor="#cc6666" width="800">
<tbody>
<tr>
    <td style="color:#ffcc99" align="center">
      Copyright(C)2009 ひと目で分かるPHP開発入門, ALL Rights Reserved.</td>
</tr>
</tbody>
</table>

</body>
</html>
