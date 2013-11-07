<?php
define( 'IMGDIR', './img/' ); //画像ディレクトリ
define ( 'THUMDIR', IMGDIR . 'thumbnail/'); //サムネイルディレクトリ
define ( 'FILENAME', date( 'Ymd', $_SERVER['REQUEST_TIME'] ) );

define ( 'THUMWIDTH', '100'); //サムネイルの幅
define ( 'THUMHEIGHT', '80'); //サムネイルの高さ

/* 画像フォルダのファイル一覧を配列で取得 */
$files = glob(IMGDIR . FILENAME . '_[0-9]*.*' );

if ( $files == NULL ) {
    $i = 0;
} else {
    natsort( $files ); //配列をソート
    end( $files ); //配列のポインタを終端へ移動
    $i = current( $files ); //現在の値を取得
    unset ($files); //$filesを解放

    /* 置換する文字列を配列に格納 */
    $trans = array(
        IMGDIR . FILENAME . '_' => '' ,
        '.jpg' => '',
        '.gif' => '',
        '.png' => ''
    );
    $i = strtr($i, $trans) + 1 ; //数字が入る。
}

foreach ($_FILES['upload']['error'] as $key => $error) {
    if( $error === UPLOAD_ERR_OK ) {
        if (! is_uploaded_file( $_FILES['upload']['tmp_name'][$key] ) ) {
            echo '不正なアップロードです';
        }

        switch ( $_FILES['upload']['type'][$key] ) {
        case 'image/jpeg':
        case 'image/pjpeg':
            $j = '.jpg';
            $l = imagecreatefromjpeg( $_FILES['upload']['tmp_name'][$key] );
            break;
        case 'image/gif':
            $j = '.gif';
            $l = imagecreatefromgif( $_FILES['upload']['tmp_name'][$key] );
            break;
        case 'image/x-png':
            $j = '.png';
            $l = imagecreatefrompng( $_FILES['upload']['tmp_name'][$key] );
            break;
        default :
            echo 'JPG/GIF/PNG以外のアップロードは受け付けません';
            exit ;
        }

        $k = IMGDIR . FILENAME . '_' . $i . $j;
        move_uploaded_file( $_FILES['upload']['tmp_name'][$key] , $k );

        /* 画像の情報を配列に取得（$n[0]が横、$n[1]が縦）*/
        $n = getimagesize($k);

        /* 画像を生成 */
        $m = imagecreatetruecolor( THUMWIDTH, THUMHEIGHT );

        /* 画像縮小し、生成した画像へコピー */
        imagecopyresampled( $m, $l, 0, 0, 0, 0, THUMWIDTH, THUMHEIGHT, $n['0'], $n['1'] );

        /* JPEGで保存 */
        imagejpeg( $m, THUMDIR . FILENAME . '_' . $i . '.jpg' );

        /* メモリの解放 */
        ImageDestroy($l);
        ImageDestroy($m);

        $i++;
    }
}
