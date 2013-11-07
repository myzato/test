<?php
define( 'HOLIDAYCSV', '../lib/holiday.csv');

function cal_out( $y, $m, $today, $csv )
{
    /* �ϐ��������� */
    $y = (int) $y;
    $m = (int) $m;
    $today = (int) $today;

    $holiday_array = array();

    if ( file_exists( $csv ) ) {
        $handle = fopen( $csv, 'r' );
        /* $data�z���csv��1�s���ǂݍ��݁A$holiday_array�ɑ������ */
        while ( ( $data = fgetcsv( $handle, 256, ',' ) ) !== FALSE) {
            /* �N�ƌ�����v����s�����擾 */
            if ( $data[0] == $y && $data[1] == $m ) {
                $holiday_array[] = $data[2]; // ���t������
            }
        }
        fclose( $handle );
    }

    if ( checkdate( $m, 1, $y ) ) {

        /* �����߂̗j���ƁA�����̍ŏI���͉����������߂� */
        $fdow  = date( 'w', mktime(0, 0, 0, $m, 1, $y ) ); // 0�`6������
        $edate = date( 't', mktime(0, 0, 0, $m, 1, $y ) ); // 28�`31������

echo '<table>
<tbody>
<tr>
  <td colspan="7">' . $y . '�N' . $m . '���̃J�����_�[</td>
</tr>
<tr>
  <th>��</th>
  <th>��</th>
  <th>��</th>
  <th>��</th>
  <th>��</th>
  <th>��</th>
  <th>�y</th>
</tr>
<tr>
';
        /* �����̋󔒂��o�͂���@*/
        switch ( $fdow ) {
        case 0 : break;
        case 1 : echo '<td>&nbsp;</td>' . "\n";
                 break;
        default: echo '<td colspan="' . $fdow . '">&nbsp;</td>' . "\n";
        }

        $j = $fdow; // �ϐ�$j��1���̗j������

        for ( $d = 1; $d <= $edate ; $d++ ) {
            /* �j���Ŕw�i�̐F��ς��邽�߂̏��� �J�����̑����ݒ� */
            switch( $j ) {
            case 0: //���j��
                $tdcol = ' bgcolor="#ccccff" ';
                break;
            case 6: //�y�j��
                $tdcol = ' bgcolor="#ccccff" ';
                break;
            default: //����
                /* �x���Ή� csv����ǂݍ��񂾔z�񂩂猟�� */
                if ( array_search( $d, $holiday_array ) !== FALSE ) {
                    $tdcol = ' bgcolor="#ccccff" ';
                } else {
                    $tdcol = NULL ;
                }
            }

            /* �����𑾎��ɂ��邽�߂̏���*/
            $sb = NULL;
            $eb = NULL;

            if ( $d === $today ) {
                $sb = '<b>' ;
                $eb = '</b>';
            }
            echo ' <td' . $tdcol . '>' . $sb . $d . $eb . '</td>' . "\n";            if ( $j == 6 ){
                echo '</tr>' . "\n" . '</tr>' . "\n"; //�y�j���̏ꍇ�͉��s���o��
                $j = 0;
            } else {
                $j++; // �j����1���炷
            }
        }

        /* �����̋󔒂��o�͂���@*/
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
        echo '���t�̎w�肪�s���ł�' . "\n";
    }
}
?>

<html>
<head>
<meta http-equiv="Content-Type" /content="text/html; charset=Shift_JIS">
<title>�J�����_�[�o�̓T���v���v���O����1</title>
</head>
<body>
<?php
/* ���݂̔N�����̎擾 */
$year  = date('Y'); // ���݂̔N���擾
$month = date('m'); // ���݂̌����擾
$date  = date('d'); // ���݂̓����擾

echo '�������̃J�����_�[���o��<br />' . "\n";
cal_out( $year, $month, $date, HOLIDAYCSV );
echo '<br />' . "\n";

if( isset( $_GET['year'] ) )
    $year = htmlspecialchars($_GET['year'], ENT_QUOTES);
if( isset( $_GET['month'] ) )
    $month = htmlspecialchars($_GET['month'], ENT_QUOTES);
if( isset( $_GET['date'] ) )
    $date = htmlspecialchars($_GET['date'], ENT_QUOTES);

echo '���w�肳�ꂽ���t�̃J�����_�[���o��<br />' . "\n";
cal_out( $year, $month, $date, HOLIDAYCSV );
echo '<br />' . "\n";
?>
</body>
</html>