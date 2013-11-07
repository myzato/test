<?php
define( 'TITLE_LEN', 80 ); // 日記タイトルの長さ
define( 'CONTENTS_LEN', 2000 ); // 日記本文の長さ

/* $_SERVER['REQUEST_TIME']を利用するのは厳密に同時刻にするため */
$year = date( 'Y', $_SERVER['REQUEST_TIME'] );
$month = date( 'm', $_SERVER['REQUEST_TIME'] );
$date = date( 'd', $_SERVER['REQUEST_TIME'] );

$title = NULL;
$contents = NULL;
$feeling = 1 ;

$edit_warn = array();
$edit_error = array();

/* ポストされた値の型固定 */
if ( isset( $_POST['title'] ) ) {
    /* タグを削除、改行コードを削除 */
    $title = htmlspecialchars( $_POST['title'], ENT_QUOTES ) ;
    $title = strtr( $title, array( "\t" => '　　', "\r" => '', "\n" => '' ) );

    /* 文字エンコードチェック */
    if ( mb_check_encoding( $title, 'CP932' ) ) {
        /* タイトルの長さチェック　*/
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
    if ( mb_check_encoding( $contents, 'CP932' ) ) {
        /* 文字数をチェック*/
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
    //数値以外入らないので整数型にキャストする
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
/* エラー配列やワーニング配列が空の場合 csvに書き込み */
if ( count( $edit_error ) === 0 && count( $edit_warn ) === 0 ) {
    /* 改行をタグへ変換→改行コードを削除 */
    $contents = nl2br( $contents ); // 改行を<br />に変換
    $contents = strtr( $contents, array( "\t" => '　　', "\r" => '', "\n" => '' ) ) ;

    if ( $fp = @fopen( NIKKICSV, 'a' ) ) {
        /* 書き込み用の値を生成 */
        $out = $year . "\t";
        $out .= $month . "\t";
        $out .= $date . "\t";
        $out .= $title . "\t";
        $out .= $feeling . "\t";
        $out .= $contents . "\r\n";

        if ( @fwrite( $fp, $out ) ) {
            echo '<p><div align="center">日記の書き込みに成功しました</div></p>' . "\n";
        } else {
            $edit_error[] = 'csvファイルへの書き込みに失敗しました';
        }
        fclose( $fp );
    } else {
        $edit_error[] = 'csvファイルのオープンに失敗しました';
    }
} elseif ( count( $edit_error ) === 0 ) {
    /* プルダウンフォーム用の処理 */
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

    /* ワーニングを赤字で表示*/
    echo '<p><div align="center"><font color="red">' . "\n";
    foreach( $edit_warn as $val ) {
        echo $val . '<br />' . "\n";
    }
    echo '</font></div></p>' . "\n";

    /* フォームを再表示 */
    echo '
<table align="center">
<tbody>
<tr>
<td>
<!-- フォーム開始 -->
<form method="post" action="./csvwrite.php" enctype="urlencode">
<input name="edit" value="1" type="hidden">
タイトル：<br /><input name="title" type="text" size="80" maxlength="80" value="' . $title . '">
<p></p>

<textarea name="contents" cols="60" rows="10">' . $contents . '</textarea>
<br />
<p>
気分：
<select name="feeling">
    <option' . $feel[0] . ' value="0">Good!!</option>
    <option' . $feel[1] . ' value="1">普通</option>
    <option' . $feel[2] . ' value="2">Bad</option>
</select>
</p>
<input value="書き込む！" type="submit">
<input value="リセット" type="reset">
</form>
<!-- フォーム終了 -->
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
      Copyright(C)2009 ひと目でわかるPHP開発入門, ALL Rights Reserved.</td>
</tr>
</tbody>
</table>

</body>
</html>
