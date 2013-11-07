<?php
define( 'TITLE_LEN', 80 ); // ���L�^�C�g���̒���
define( 'CONTENTS_LEN', 2000 ); // ���L�{���̒���

/* $_SERVER['REQUEST_TIME']�𗘗p����̂͌����ɓ������ɂ��邽�� */
$year = date( 'Y', $_SERVER['REQUEST_TIME'] );
$month = date( 'm', $_SERVER['REQUEST_TIME'] );
$date = date( 'd', $_SERVER['REQUEST_TIME'] );

$title = NULL;
$contents = NULL;
$feeling = 1 ;

$edit_warn = array();
$edit_error = array();

/* �|�X�g���ꂽ�l�̌^�Œ� */
if ( isset( $_POST['title'] ) ) {
    /* �^�O���폜�A���s�R�[�h���폜 */
    $title = htmlspecialchars( $_POST['title'], ENT_QUOTES ) ;
    $title = strtr( $title, array( "\t" => '�@�@', "\r" => '', "\n" => '' ) );

    /* �����G���R�[�h�`�F�b�N */
    if ( mb_check_encoding( $title, 'CP932' ) ) {
        /* �^�C�g���̒����`�F�b�N�@*/
        $i = mb_strlen($title);
        if ( $i === 0 ){
            $edit_warn[] = '�^�C�g�������L���ł�';
        } elseif ( $i > TITLE_LEN ) {
            $edit_warn[] = '�^�C�g�����������܂�';
        }
    } else {
        $edit_error[] = '�^�C�g���ɓ��͂��ꂽ�������s���ł�';
    }
} else {
    $edit_warn[] = '�^�C�g�������L���ł�';
}

if ( isset( $_POST['contents'] ) ) {
    $contents = htmlspecialchars( $_POST['contents'], ENT_QUOTES ) ;
    if ( mb_check_encoding( $contents, 'CP932' ) ) {
        /* ���������`�F�b�N*/
        $i = mb_strlen( $contents );
        if ( $i === 0 ){
            $edit_warn[] = '���L�����L���ł�';
        } elseif ( $i > CONTENTS_LEN ) {
            $edit_warn[] = '���͂��������܂�';
        }
    } else {
        $edit_error[] = '���͂ɓ��͂��ꂽ�������s���ł�';
    }
} else {
    $edit_warn[] = '���L�����L���ł�';
}

if ( isset( $_POST['feeling'] ) ) {
    //���l�ȊO����Ȃ��̂Ő����^�ɃL���X�g����
    $feeling = (int) $_POST['feeling'];

    if( $feeling < 0 || $feeling > 3 ) {
        $edit_error[] = '�s���ȃt���O���Z�b�g����܂���';
    }
} else {
    $edit_error[] = '�s���ȑ��삪����܂��� errno:2';
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Shift-JIS" />
    <title>���L��������</title>
</head>
<body>

<table align="center" bgcolor="#cc6666" width="800">
<tbody>
<tr>
    <td style="color:#ffcc99" align="center">PHP �ō����L��</td>
</tr>
</tbody>
</table>

<?php
/* �G���[�z��⃏�[�j���O�z�񂪋�̏ꍇ csv�ɏ������� */
if ( count( $edit_error ) === 0 && count( $edit_warn ) === 0 ) {
    /* ���s���^�O�֕ϊ������s�R�[�h���폜 */
    $contents = nl2br( $contents ); // ���s��<br />�ɕϊ�
    $contents = strtr( $contents, array( "\t" => '�@�@', "\r" => '', "\n" => '' ) ) ;

    if ( $fp = @fopen( NIKKICSV, 'a' ) ) {
        /* �������ݗp�̒l�𐶐� */
        $out = $year . "\t";
        $out .= $month . "\t";
        $out .= $date . "\t";
        $out .= $title . "\t";
        $out .= $feeling . "\t";
        $out .= $contents . "\r\n";

        if ( @fwrite( $fp, $out ) ) {
            echo '<p><div align="center">���L�̏������݂ɐ������܂���</div></p>' . "\n";
        } else {
            $edit_error[] = 'csv�t�@�C���ւ̏������݂Ɏ��s���܂���';
        }
        fclose( $fp );
    } else {
        $edit_error[] = 'csv�t�@�C���̃I�[�v���Ɏ��s���܂���';
    }
} elseif ( count( $edit_error ) === 0 ) {
    /* �v���_�E���t�H�[���p�̏��� */
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

    /* ���[�j���O��Ԏ��ŕ\��*/
    echo '<p><div align="center"><font color="red">' . "\n";
    foreach( $edit_warn as $val ) {
        echo $val . '<br />' . "\n";
    }
    echo '</font></div></p>' . "\n";

    /* �t�H�[�����ĕ\�� */
    echo '
<table align="center">
<tbody>
<tr>
<td>
<!-- �t�H�[���J�n -->
<form method="post" action="./csvwrite.php" enctype="urlencode">
<input name="edit" value="1" type="hidden">
�^�C�g���F<br /><input name="title" type="text" size="80" maxlength="80" value="' . $title . '">
<p></p>

<textarea name="contents" cols="60" rows="10">' . $contents . '</textarea>
<br />
<p>
�C���F
<select name="feeling">
    <option' . $feel[0] . ' value="0">Good!!</option>
    <option' . $feel[1] . ' value="1">����</option>
    <option' . $feel[2] . ' value="2">Bad</option>
</select>
</p>
<input value="�������ށI" type="submit">
<input value="���Z�b�g" type="reset">
</form>
<!-- �t�H�[���I�� -->
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
      Copyright(C)2009 �ЂƖڂł킩��PHP�J������, ALL Rights Reserved.</td>
</tr>
</tbody>
</table>

</body>
</html>
