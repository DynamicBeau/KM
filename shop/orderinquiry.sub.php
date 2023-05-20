<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

if (!defined("_ORDERINQUIRY_")) exit; // 개별 페이지 접근 불가 
?>

<? if (!$limit) { echo "<p style='padding:6px; text-align:right;'>총 {$cnt} 건</p>"; } ?>
<table class="table_style1">
<colgroup>
	<col width="100px" />
	<col width="" />
	<col width="80px" />
	<col width="120px" />
	<col width="120px" />
	<col width="120px" />
</colgroup>

<tr>
    <th>주문서번호</th>
    <th>주문일시</th>
    <th>상품수</th>
    <th>주문금액</th>
    <th>입금액</th>
    <th>미입금액</th>
</tr>
<?
$sql = " select a.od_id, 
                a.*, "._MISU_QUERY_."
           from $g4[yc4_order_table] a
           left join $g4[yc4_cart_table] b on (b.on_uid=a.on_uid)
          where mb_id = '$member[mb_id]'
          group by a.od_id 
          order by a.od_id desc 
          $limit ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
{

    echo "<tr>\n";
    echo "<td align=center>";
    echo "<input type=hidden name='ct_id[$i]' value='$row[ct_id]'>\n";
    echo "<a href='./orderinquiryview.php?od_id=$row[od_id]&on_uid=$row[on_uid]'><U>$row[od_id]</U></a></td>\n";
    echo "<td align=center>".substr($row[od_time],0,16)." (".get_yoil($row[od_time]).")</td>\n";
    echo "<td align=center>$row[itemcount]</td>\n";
    echo "<td align=right>".display_amount($row[orderamount])."&nbsp;&nbsp;</td>\n";
    echo "<td align=right>".display_amount($row[receiptamount])."&nbsp;&nbsp;</td>\n";
    echo "<td align=right>".display_amount($row[misu])."&nbsp;&nbsp;</td>\n";
    echo "</tr>\n";
}

if ($i == 0)
    echo "<tr><td colspan=6  style='text-align:center; padding:60px;'>주문 내역이 없습니다.</td></tr>";
?>
</table><br>
 
