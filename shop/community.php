<?
include_once("./_common.php");
include_once("$g4[path]/lib/latest.lib.php");

$list_mod = 2; // �Ѷ��ο� ��� ����Ұ�����?
$list_row = 3; // �ѰԽ��Ǵ� ���྿ ����Ұ�����?
$subject_len = 70; // ������ ���̴�?

$g4[title] = "Ŀ�´�Ƽ";
include_once("./_head.php");
?>

<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
    <?
    //  �ֽű� ����
    $sql = " select bo_table, bo_subject from $g4[board_table] order by gr_id, bo_table ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        // tr �ٲٱ�
        if (($i > 0) && ($i % $list_mod == 0))
            echo "</tr><tr>";

        echo "
        <td width=50% valign=top>
            <table width=98% cellpadding=0 cellspacing=0 align=center>
            <tr>
                <td colspan=2>";

        // �� �Լ��� �ٷ� �ֽű��� �����ϴ� ������ �մϴ�.
        // �����
        // latest(��Ų, �Խ��Ǿ��̵�, ��¶���, ���ڼ�);
        // ��Ų�� �Է����� ���� ��� ��� > ȯ�漳���� �ֽű� ��Ų��θ� �⺻ ��Ų���� �մϴ�.
        echo latest("", $row[bo_table], $list_row, $subject_len);

        echo "</td></tr></table><br></td>";
    }

    if ($i > 0 && ($i % $list_mod == 1))
        echo "<td width=50% valign=top>&nbsp;</td>";
    ?>
</tr>
</table>

<?
include_once("./_tail.php");
?>