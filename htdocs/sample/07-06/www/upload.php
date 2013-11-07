<?php
define( 'IMGDIR', './img/' ); //�摜�f�B���N�g��
define ( 'THUMDIR', IMGDIR . 'thumbnail/'); //�T���l�C���f�B���N�g��
define ( 'FILENAME', date( 'Ymd', $_SERVER['REQUEST_TIME'] ) );

define ( 'THUMWIDTH', '100'); //�T���l�C���̕�
define ( 'THUMHEIGHT', '80'); //�T���l�C���̍���

/* �摜�t�H���_�̃t�@�C���ꗗ��z��Ŏ擾 */
$files = glob(IMGDIR . FILENAME . '_[0-9]*.*' );

if ( $files == NULL ) {
    $i = 0;
} else {
    natsort( $files ); //�z����\�[�g
    end( $files ); //�z��̃|�C���^���I�[�ֈړ�
    $i = current( $files ); //���݂̒l���擾
    unset ($files); //$files�����

    /* �u�����镶�����z��Ɋi�[ */
    $trans = array(
        IMGDIR . FILENAME . '_' => '' ,
        '.jpg' => '',
        '.gif' => '',
        '.png' => ''
    );
    $i = strtr($i, $trans) + 1 ; //����������B
}

foreach ($_FILES['upload']['error'] as $key => $error) {
    if( $error === UPLOAD_ERR_OK ) {
        if (! is_uploaded_file( $_FILES['upload']['tmp_name'][$key] ) ) {
            echo '�s���ȃA�b�v���[�h�ł�';
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
            echo 'JPG/GIF/PNG�ȊO�̃A�b�v���[�h�͎󂯕t���܂���';
            exit ;
        }

        $k = IMGDIR . FILENAME . '_' . $i . $j;
        move_uploaded_file( $_FILES['upload']['tmp_name'][$key] , $k );

        /* �摜�̏���z��Ɏ擾�i$n[0]�����A$n[1]���c�j*/
        $n = getimagesize($k);

        /* �摜�𐶐� */
        $m = imagecreatetruecolor( THUMWIDTH, THUMHEIGHT );

        /* �摜�k�����A���������摜�փR�s�[ */
        imagecopyresampled( $m, $l, 0, 0, 0, 0, THUMWIDTH, THUMHEIGHT, $n['0'], $n['1'] );

        /* JPEG�ŕۑ� */
        imagejpeg( $m, THUMDIR . FILENAME . '_' . $i . '.jpg' );

        /* �������̉�� */
        ImageDestroy($l);
        ImageDestroy($m);

        $i++;
    }
}
