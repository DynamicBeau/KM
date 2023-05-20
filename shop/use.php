<?
include_once("./_common.php");
$g4[title] = "이용후기";
include_once("./_head.php");
$sql_common = " from $g4[yc4_item_ps_table] where is_confirm = '1' ";
$sql_order = " order by is_time desc ";
$sql = " select count(*) as cnt $sql_common ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
?>
<br>
<table width=100% align=center cellpadding=0 cellspacing=0>

<tr><td height=10></td></tr>
</table>
<table width=100% align=center cellpadding=0 cellspacing=0>
<colgroup width=80></colgroup>
<colgroup width=''></colgroup>
<colgroup width=150></colgroup>
<colgroup width=150></colgroup>
<colgroup width=150></colgroup>
<tr><td colspan="5" height="2" bgcolor="#ededed"></td></tr>
<tr height=30 bgcolor="#f7f7f7" align=center>
 <td>번호</td>
 <td>상품후기</td>
 <td>작성자</td>
 <td>작성일</td>
 <td>평가점수</td>
</tr>
<tr><td colspan="5" height="1" bgcolor="#ededed"></td></tr>
<?
$sql = " select * $sql_common $sql_order limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
 $num = $total_count - ($page - 1) * $rows - $i;
 $star = get_star($row[is_score]);
    echo "
    <tr height=30>
        <td align=center>$num</td>
        <td>
   <table>
   <tr><td rowspan='2' width='120' align='center'><a href='$g4[shop_path]/item.php?it_id=$row[it_id]'><img src='$g4[path]/data/item/{$row[it_id]}_m' width='80'></a></td>
    <td><a href='$g4[shop_path]/item.php?it_id=$row[it_id]'>$row[is_subject]</a></td>
   </tr>
   <tr><td><img src='$g4[pd_path]/img/icon_reply1.gif' align='absmiddle'> $row[is_content]</td></tr>
   </table>
  </td>
  <td align=center>$row[is_name]</td>
        <td align=center>".substr($row[is_time],0,10)."</td>
        <td align=center><img src='$g4[shop_img_path]/star{$star}.gif' border=0></td>
    </tr>
 <tr><td colspan=5 height=1 bgcolor='#ededed'></td></tr>
    ";
}
if ($i == 0)
    echo "<tr><td colspan=5 align=center height=100>자료가 없습니다.</td></tr>";
?>
</table>
<br><br>
<table width='100%' cellpadding=3 cellspacing=0>
<tr><td height=45 align=center><?=get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td></tr>
</table>
<?
include_once("./_tail.php");
?>