<?
include_once("./_common.php");

header("Content-Type: text/html; charset=$g4[charset]");

/*
	 ���� �±׸�	����	����	ũ��
1	<<<begin>>>	    ����	��ǰ���� �˸�	�ʼ�
2	<<<pid>>>	    ��ǰID	�ش�� ��ǰ ID	�ʼ�,varchar(50)
3	<<<price>>>	    ����	��ǰ ���� 	�ʼ�,number
4	<<<pname>>>	    ��ǰ��	��ǰ��	�ʼ�,varchar(500)
5	<<<pgurl>>>	    ��ǰ��ũ	�ش� ��ǰ���� �� ��ǰURL	�ʼ�,varchar(255)
6	<<<igurl>>>	    �̹�����ũ	��ǰ�̹��� ��ũ 
                    (��ǰ�̹��� �� ���� ū�̹�����ũ)	�ʼ�,varchar(255)
7	<<<cate1>>>     ��з�ID	��з� �ڵ�	�ʼ�,varchar(20)
8	<<<cate2>>>     �ߺз�ID	�ߺз� �ڵ�	varchar(20)
9	<<<cate3>>>     �Һз�ID	�Һз� �ڵ�	varchar(20)
10	<<<cate4>>>     ���з�ID	���з� �ڵ�	varchar(20)
11	<<<catename1>>>	��з���		�ʼ�,varchar(50)
12	<<<catename2>>>	�ߺз���		varchar(50)
13	<<<catename3>>>	�Һз���		varchar(50)
14	<<<catename4>>>	���з���		varchar(50)
15	<<<model>>>	    �𵨸�		varchar(255)
16	<<<brand>>>	    �귣���		varchar(255)
17	<<<maker>>>	    ������		varchar(255)
18	<<<pdate>>>	    �����	��) 20070101	varchar(8)
19	<<<weight>>>	����ġ��	���� ( 0  ~ )
                    ���θ���з�ī�װ� ��������
                    ���θ����ο��� å���Ǵ� ��ǰ�� ����
                    �α�����	Numer(14)
20	<<<sales>>>	    �Ǹŷ�	�ش� ��ǰ�� �ȸ� �����Ǹŷ�	number(14)
21	<<<coupon>>>	��������	�ۼ�Ʈ ������ ���
                    ex) 5%�������� -> 5%
                    ������������ ������ ���
                    ex) 3000���������� -> 3000��
                    �� ǥ��
                    0%, 0���� ���� ����	varchar(255)

22	<<<pcard>>>     ������/�Һ�	ī���̸������� �������� ǥ��
                    ex) �Ｚ2~3/�Ե�3/����6
                    0���� �� ������ ���� ����	varchar(255)
23	<<<point>>>	    ������/����Ʈ	�ؽ�Ʈ����
                    0�� ������ ���� ����	varchar(255)
24	<<<deliv>>>	    ��ۺ�	������ ���� 0 
                    ������ ���� 1
                    ���Ǻι����� ���� 2 �� ǥ��	number
25	<<<deliv2>>>	��ۺ� ����	����(deliv�ʵ� �ڵ�1��) or
                    ���Ǻι���(deliv�ʵ� �ڵ�2��) 
                    �� ��쿡 �� ���� ǥ��
                    ex)3�����̸����� or 2500��	varchar(20)
26	<<<review>>>	��ǰ���	��ǰ�� ��ǰ�򰳼��� �� ������ ���ڸ� ǥ��	number
27	<<<event>>>	    �̺�Ʈ	�ش� ��ǰ�� �̺�Ʈ ������ ǥ��
                    ex) �������� �ູ�̺�Ʈ! ����� ������ 50%SALE
                    �ű�ȸ�� 5%+����ǰ 3%��������	varchar(255)
28	<<<eventurl>>>	�̺�Ʈurl	event ������ URL	varchar(255)
29	<<<sellername>>>	���Ǹ��ڼ���	������ ��ǰ�� �Ǹ��ϰ��ִ� �Ǹ��ڼ� �̸� ǥ�� (�Ǹż��� ��ǥ�ڸ��� �ƴ϶� �Ǹż���)
                        �Ǹ��ڼ����� ���� ��쿡�� �Ǹ��ھ��̵�� ǥ�� (��ü�Ǹ��ϴ� ��쿡�� ǥ��X)	varchar(20)
30	<<<sellershop>>>	���Ǹ��ڼ��ּ�	�Ǹ����� �̴ϼ� �ּ� or �Ǹ��ڼ��ּ�
                        (��ü�Ǹ��ϴ� ��쿡�� ǥ��X)	varchar(50)
31	<<<sellergrade>>>	���Ǹ��ڵ��	�Ǹ��ڵ���� 5�� ������������
                        (��ü�Ǹ��ϴ� ��쿡�� ǥ��X)	number
32	<<<end>>>	    ���˸�	���˸� �±�	�ʼ�
*/

$lt = "<<<";
$gt = ">>>";

// ��ۺ�
if ($default[de_send_cost_case] == '����') {
    $deliv  = 0;
    $deliv2 = "";
}
else {
    $deliv = 1;
    // ��ۺ� ������ ��� ���� �տ� ��ۺ�
    $send_cost_limit = explode(";", $default[de_send_cost_limit]);
    $send_cost_list  = explode(";", $default[de_send_cost_list]);
    $cost_limit = (int)$send_cost_limit[0];
    $deliv2  = (int)$send_cost_list[0]."��";
}

$sql =" select * from $g4[yc4_item_table] where it_use = '1' order by ca_id";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $cate1 = $cate2 = $cate3 = $cate4 = "";

    $row2 = sql_fetch(" select ca_id, ca_name from $g4[yc4_category_table] where ca_id = '".substr($row[ca_id],0,2)."' ");
    $cate1     = $row2[ca_id];
    $catename1 = $row2[ca_name];

    if (strlen($row[ca_id]) >= 8) {
        $row2 = sql_fetch(" select ca_id, ca_name from $g4[yc4_category_table] where ca_id = '".substr($row[ca_id],0,8)."' ");
        $cate4     = $row2[ca_id];
        $catename4 = $row2[ca_name];
    }

    if (strlen($row[ca_id]) >= 6) {
        $row2 = sql_fetch(" select ca_id, ca_name from $g4[yc4_category_table] where ca_id = '".substr($row[ca_id],0,6)."' ");
        $cate3     = $row2[ca_id];
        $catename3 = $row2[ca_name];
    }

    if (strlen($row[ca_id]) >= 4) {
        $row2 = sql_fetch(" select ca_id, ca_name from $g4[yc4_category_table] where ca_id = '".substr($row[ca_id],0,4)."' ");
        $cate2     = $row2[ca_id];
        $catename2 = $row2[ca_name];
    }

    // ��ۺ� ���Ѱ� �̸��̸� ��ۺ� ����
    $delivery = 0;
    if ($row[it_amount] < $cost_limit) {
        $delivery = $send_cost;
    }

    $pdate = date("Ymd", strtotime($row[it_time]));
    $point = ($row[it_point] <= 0) ? "" : (int)$row[it_point];

    echo <<< HEREDOC
{$lt}begin{$gt}
{$lt}pid{$gt}$row[it_id]
{$lt}price{$gt}$row[it_amount]
{$lt}pname{$gt}$row[it_name]
{$lt}pgurl{$gt}$g4[shop_url]/item.php?it_id={$row[it_id]}
{$lt}igurl{$gt}$g4[url]/data/item/{$row[it_id]}_m
{$lt}cate1{$gt}$cate1
{$lt}cate2{$gt}$cate2
{$lt}cate3{$gt}$cate3
{$lt}cate4{$gt}$cate4
{$lt}catename1{$gt}$catename1
{$lt}catename2{$gt}$catename2
{$lt}catename3{$gt}$catename3
{$lt}catename4{$gt}$catename4
{$lt}maker{$gt}$row[it_maker]
{$lt}pdate{$gt}$pdate
{$lt}point{$gt}$point
{$lt}deliv{$gt}$deliv
{$lt}deliv2{$gt}$deliv2
{$lt}end{$gt}

HEREDOC;
}
?>