<?
include_once("./_common.php");

ob_start();

$lt = "";
$gt = "<!>";

// ��ۺ�
if ($default[de_send_cost_case] == '����')
    $delivery = 0;
else
{
    // ��ۺ� ������ ��� ���� �տ� ��ۺ� �� �ݾ� ����
    $tmp = explode(';', $default[de_send_cost_limit]);
    $delivery_limit = (int)$tmp[0];

    // ��ۺ� ������ ��� ���� �տ� ��ۺ�
    $tmp = explode(';', $default[de_send_cost_list]);
    $delivery = (int)$tmp[0];
}

$time = date("Y-m-d 00:00:00", $g4[server_time] - 86400);
$sql =" select * from $g4[yc4_item_table] where it_use = '1' and it_time >= '$time' order by ca_id";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $ca_id1 = "";
    $ca_id2 = "";
    $ca_id3 = "";
    $ca_id4 = "";
    $ca_name1 = "";
    $ca_name2 = "";
    $ca_name3 = "";
    $ca_name4 = "";

    $ca_id1 = substr($row[ca_id],0,2);
    $row2 = sql_fetch(" select ca_name from $g4[yc4_category_table] where ca_id = '$ca_id1' ");
    $ca_name1 = $row2[ca_name];

    if (strlen($row[ca_id]) >= 4) {
        $ca_id2 = substr($row[ca_id],0,4);
        $row2 = sql_fetch(" select ca_name from $g4[yc4_category_table] where ca_id = '$ca_id2' ");
        $ca_name2 = $row2[ca_name];
    }

    if (strlen($row[ca_id]) >= 6) {
        $ca_id3 = substr($row[ca_id],0,6);
        $row2 = sql_fetch(" select ca_name from $g4[yc4_category_table] where ca_id = '$ca_id3' ");
        $ca_name3 = $row2[ca_name];
    }

    if (strlen($row[ca_id]) >= 8) {
        $ca_id4 = substr($row[ca_id],0,8);
        $row2 = sql_fetch(" select ca_name from $g4[yc4_category_table] where ca_id = '$ca_id4' ");
        $ca_name4 = $row2[ca_name];
    }

    $PRDATE = substr($row[it_time], 0, 10);

echo "{$lt}$row[it_id]{$gt}"; // ���θ� ��ǰID
echo "{$lt}C{$gt}"; // ��ǰ���� C/U/D ��üEP�� �ϰ������� C
echo "{$lt}$row[it_name]{$gt}"; // ��ǰ��
echo "{$lt}$row[it_amount]{$gt}"; // �ǸŰ���
echo "{$lt}$g4[shop_url]/item.php?it_id=$row[it_id]{$gt}"; // ��ǰ�� �������� �ּ�
echo "{$lt}$g4[url]/data/item/{$row[it_id]}_l1{$gt}"; // �̹��� URL
echo "{$lt}$ca_id1{$gt}"; // ��з� ī�װ� �ڵ�
echo "{$lt}$ca_id2{$gt}"; // �ߺз� ī�װ� �ڵ�
echo "{$lt}$ca_id3{$gt}"; // �Һз� ī�װ� �ڵ�
echo "{$lt}$ca_id4{$gt}"; // ���з� ī�װ� �ڵ�
echo "{$lt}$ca_name1{$gt}"; // �� ī�װ���
echo "{$lt}$ca_name2{$gt}"; // �� ī�װ���
echo "{$lt}$ca_name3{$gt}"; // �� ī�װ���
echo "{$lt}$ca_name4{$gt}"; // �� ī�װ���
echo "{$lt}{$gt}"; // �𵨸�
echo "{$lt}{$gt}"; // �귣��
echo "{$lt}$row[it_maker]{$gt}"; // ����Ŀ
echo "{$lt}$row[it_origin]{$gt}"; // ������
echo "{$lt}$PRDATE{$gt}"; // ��ǰ�������
echo "{$lt}$delivery{$gt}"; // ��ۺ�
echo "{$lt}{$gt}"; // �̺�Ʈ
echo "{$lt}{$gt}"; // �����ݾ�
echo "{$lt}{$gt}"; // ������
echo "{$lt}$row[it_point]{$gt}"; // ������
echo "{$lt}Y{$gt}"; // �̹������濩��
echo "{$lt}{$gt}"; // ��ǰƯ������
echo "{$lt}{$gt}"; // ������ �������
echo "{$lt}"; // ��ǰ���� ����ð�
echo "\r\n";
}

$content = ob_get_contents();
ob_end_clean();

// 100124 : ���ǿ����� ���� utf-8 �� �������� �ʰ� ����
if (strtolower($g4[charset]) == 'utf-8') {
    $content = iconv('utf-8', 'euc-kr', $content);
}

echo $content;
?>