<?php
define( 'TITLE_LEN', 80 ); // úL^CgÌ·³
define( 'CONTENTS_LEN', 2000 ); // úL{¶Ì·³
define( 'NIKKICSV', '../data/nikki2009.csv');

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
    if ( mb_check_encoding( $title, 'CP932' ) ) {
        /* ^CgÌ·³`FbN@*/
        $i = mb_strlen($title);
        if ( $i === 0 ){
            $edit_warn[] = '^Cgª¢LüÅ·';
        } elseif ( $i > TITLE_LEN ) {
            $edit_warn[] = '^Cgª··¬Ü·';
        }
    } else {
        $edit_error[] = '^CgÉüÍ³ê½¶ªs³Å·';
    }
} else {
    $edit_warn[] = '^Cgª¢LüÅ·';
}

if ( isset( $_POST['contents'] ) ) {
    $contents = htmlspecialchars( $_POST['contents'], ENT_QUOTES ) ;
    if ( mb_check_encoding( $contents, 'CP932' ) ) {
        /* ¶ð`FbN*/
        $i = mb_strlen( $contents );
        if ( $i === 0 ){
            $edit_warn[] = 'úLª¢LüÅ·';
        } elseif ( $i > CONTENTS_LEN ) {
            $edit_warn[] = '¶Íª··¬Ü·';
        }
    } else {
        $edit_error[] = '¶ÍÉüÍ³ê½¶ªs³Å·';
    }
} else {
    $edit_warn[] = 'úLª¢LüÅ·';
}

if ( isset( $_POST['feeling'] ) ) {
    //lÈOüçÈ¢ÌÅ®^ÉLXg·é
    $feeling = (int) $_POST['feeling'];

    if( $feeling < 0 || $feeling > 3 ) {
        $edit_error[] = 's³ÈtOªZbg³êÜµ½';
    }
} else {
    $edit_error[] = 's³Èìª èÜµ½ errno:2';
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

    if ( $fp = @fopen( NIKKICSV, 'a' ) ) {
        /* «ÝpÌlð¶¬ */
        $out = $year . "\t";
        $out .= $month . "\t";
        $out .= $date . "\t";
        $out .= $title . "\t";
        $out .= $feeling . "\t";
        $out .= $contents . "\r\n";

        if ( @fwrite( $fp, $out ) ) {
            echo '<p><div align="center">úLÌ«ÝÉ¬÷µÜµ½</div></p>' . "\n";
        } else {
            $edit_error[] = 'csvt@CÖÌ«ÝÉ¸sµÜµ½';
        }
        fclose( $fp );
    } else {
        $edit_error[] = 'csvt@CÌI[vÉ¸sµÜµ½';
    }
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
