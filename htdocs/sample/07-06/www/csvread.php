<?php
define( 'NIKKICSV', '../data/nikki2009.csv');
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
/* ���L��csv�t�@�C������ǂݍ��ݕ\������ */
if ( $fp = @fopen( NIKKICSV, 'r' ) ) {
    while ( ( $nikki = fgetcsv( $fp, 1024, "\t" ) ) !== FALSE ) {
        //nikki[0] : �N nikki[1] : �� nikki[2] : ��
        //nikki[3] : �^�C�g�� nikki[4] : �C�� nikki[5] : �{��
        switch( $nikki[4] ){
        case 0: $feeling = 'Good!'; break;
        case 1: $feeling = '����'; break;
        case 2: $feeling = 'Bad'; break;
        default : $feeling = NULL;
        }
        echo '<table align="center" width="400">
<tbody>
<tr>
    <td><b>' . $nikki[0] . '�N' . $nikki[1] . '��' . $nikki[2] . '��</b>(' . $feeling . ')</td>
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
      Copyright(C)2009 �ЂƖڂł킩��PHP�J������, ALL Rights Reserved.</td>
</tr>
</tbody>
</table>

</body>
</html>