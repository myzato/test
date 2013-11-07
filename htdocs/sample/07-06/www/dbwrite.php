<?php
define( 'TITLE_LEN', 80 ); // úL^CgÌ·³
define( 'CONTENTS_LEN', 2000 ); // úL{¶Ì·³

/* $_SERVER['REQUEST_TIME']ðp·éÌÍµ§É¯É·é½ß */
$year = date( 'Y', $_SERVER['REQUEST_TIME'] );
$month = date( 'm', $_SERVER['REQUEST_TIME'] );
$date = date( 'd', $_SERVER['REQUEST_TIME'] );

$title = NULL;
$contents = NULL;
$feeling = 1 ;

$edit_warn = array();
$edit_error = array();

/* |Xg³ê½lÌ^Åè */
if ( isset( $_POST['title'] ) ) {
    /* ^OðíAüsR[hðí */
    $title = htmlspecialchars( $_POST['title'], ENT_QUOTES ) ;
    $title = strtr( $title, array( "\t" => '@@', "\r" => '', "\n" => '' ) );

    /* ¶GR[h`FbN */
    if ( mb_check_encoding( $title, 'utf-8' ) ) {
        /* ^CgÌ·³`FbN@*/
        $i = mb_strlen($title);
        if ( $i === 0 ){
            $edit_warn[] = 'タイトルが未記入です';
        } elseif ( $i > TITLE_LEN ) {
            $edit_warn[] = 'タイトルが長すぎます';
        }
    } else {
        $edit_error[] = 'タイトルに入力された文字が不正です';
    }
} else {
    $edit_warn[] = 'タイトルが未記入です';
}

if ( isset( $_POST['contents'] ) ) {
    $contents = htmlspecialchars( $_POST['contents'], ENT_QUOTES ) ;
    if ( mb_check_encoding( $contents, 'utf-8' ) ) {
        /* ¶ð`FbN*/
        $i = mb_strlen( $contents );
        if ( $i === 0 ){
            $edit_warn[] = '日記が未記入です';
        } elseif ( $i > CONTENTS_LEN ) {
            $edit_warn[] = '文章が長すぎます';
        }
    } else {
        $edit_error[] = '文章に入力された文字が不正です';
    }
} else {
    $edit_warn[] = '日記が未記入です';
}

if ( isset( $_POST['feeling'] ) ) {
    //lÈOüçÈ¢ÌÅ®^ÉLXg·é
    $feeling = (int) $_POST['feeling'];

    if( $feeling < 0 || $feeling > 3 ) {
        $edit_error[] = '不正なフラグがセットされました';
    }
} else {
    $edit_error[] = '不正な操作がありました errno:2';
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>úL«Ý</title>
</head>
<body>

<table align="center" bgcolor="#cc6666" width="800">
<tbody>
<tr>
    <td style="color:#ffcc99" align="center">PHP ÅìéúL </td>
</tr>
</tbody>
</table>

<?php
/* G[zñâ[jOzñªóÌê csvÉ«Ý */
if ( count( $edit_error ) === 0 && count( $edit_warn ) === 0 ) {
    /* üsð^OÖÏ·¨üsR[hðí */
    $contents = nl2br( $contents ); // üsð<br />ÉÏ·
    $contents = strtr( $contents, array( "\t" => '@@', "\r" => '', "\n" => '' ) ) ;

    /* MySQLÖÚ± */
    $link = @mysql_connect( 'localhost', 'phpuser', 'pass') or die( mysql_error() );

    /* gp·éf[^x[XÌIð */
    mysql_select_db( 'phpdiary', $link );

    /* Ú±Ì¶R[hðZbg */
    mysql_set_charset( 'utf-8', $link );

    /* NGð¶¬ */
    $query = 'INSERT INTO nikki( title,contents,feeling,year,month,date)
        VALUES (
        "' . $title . '",
        "' . $contents . '",
        "' . $feeling . '",
        "' . $year . '",
        "' . $month . '",
        "' . $date . '")';

    /* NGðÀs */
    @mysql_query( $query, $link ) or die( mysql_error() );

    echo '<br />日記の書き込みに成功しました<br />';

    /* Ú±ðØf */
    mysql_close( $link );
} elseif ( count( $edit_error ) === 0 ) {
    /* v_EtH[pÌ */
    switch( $feeling ) {
    case 0:
        $feel[0] = 'selected';
        $feel[1] = '' ;
        $feel[2] = '' ;
        break;
    case 1:
        $feel[0] = '' ;
        $feel[1] = 'selected';
        $feel[2] = '' ;
        break;
    case 2:
        $feel[0] = '' ;
        $feel[1] = '' ;
        $feel[2] = 'selected';
        break;
    }

    /* [jOðÔÅ\¦*/
    echo '<p><div align="center"><font color="red">' . "\n";
    foreach( $edit_warn as $val ) {
        echo $val . '<br />' . "\n";
    }
    echo '</font></div></p>' . "\n";

    /* tH[ðÄ\¦ */
    echo '
<table align="center">
<tbody>
<tr>
<td>
<!-- tH[Jn -->
<form method="post" action="./csvwrite.php" enctype="urlencode">
<input name="edit" value="1" type="hidden">
^CgF<br /><input name="title" type="text" size="80" maxlength="80" value="' . $title . '">
<p></p>

<textarea name="contents" cols="60" rows="10">' . $contents . '</textarea>
<br />
<p>
CªF
<select name="feeling">
    <option' . $feel[0] . ' value="0">Good!!</option>
    <option' . $feel[1] . ' value="1">Ê</option>
    <option' . $feel[2] . ' value="2">Bad</option>
</select>
</p>
<input value="«ÞI" type="submit">
<input value="Zbg" type="reset">
</form>
<!-- tH[I¹ -->
</td>
</tr>
</tbody>
</table>';
} else {
    echo '<p><font color="red">' . "\n";

    foreach( $edit_error as $val ) {
        echo $val . '<br />' . "\n";
    }
    echo '</font></p>' . "\n";
}
?>

<br />
<table align="center" bgcolor="#cc6666" width="800">
<tbody>
<tr>
    <td style="color:#ffcc99" align="center">
      Copyright(C)2009 ÐÆÚÅí©éPHPJ­üå, ALL Rights Reserved.</td>
</tr>
</tbody>
</table>

</body>
</html>
