<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
    if ($i > 0 && $i % $list_mod == 0)  echo "</tr>\n\n<tr>\n";

    $href = "<a href='$g4[shop_path]/item.php?it_id=$row[it_id]' class=item>";

    // 고객선호도
    $star = "";
    if ($score = get_star_image($row[it_id]))
        $star = "<img src='$g4[shop_img_path]/star{$score}.gif' border=0>";

    $sql2 = " select * from $g4[yc4_item_table] where it_id = '$row[it_id]' ";
    $row2 = sql_fetch($sql2);

    // 특정상품아이콘
    $icon = "";
    if ($row2[it_type1]) $icon .= " <img src='$g4[shop_img_path]/icon_type1.gif' border=0 align=absmiddle>"; 
    if ($row2[it_type2]) $icon .= " <img src='$g4[shop_img_path]/icon_type2.gif' border=0 align=absmiddle>"; 
    if ($row2[it_type3]) $icon .= " <img src='$g4[shop_img_path]/icon_type3.gif' border=0 align=absmiddle>"; 
    if ($row2[it_type4]) $icon .= " <img src='$g4[shop_img_path]/icon_type4.gif' border=0 align=absmiddle>"; 
    if ($row2[it_type5]) $icon .= " <img src='$g4[shop_img_path]/icon_type5.gif' border=0 align=absmiddle>"; 
?>
    <td width="<?=$td_width?>%" align=center valign=top style="padding:5px;">
		<?=$href?><?=get_it_image($row[it_id]."_s", $img_width, $img_height)?></a>
		<p style='margin-top:5px; text-align:center;'><img src='<?=$g4[shop_img_path]?>/btn_zoom.gif'  onclick="javascript:win_open('<?=$g4[shop_path]?>/largeimage.php?it_id=<?=$row[it_id]?>', 'viewImage','left=50, top=50, width=600, height=600, scrollbars=no')" style='cursor: pointer'></p>
		<p style='padding:5px 0; text-align:center;'><?=$href?><?=stripslashes($row[it_name])?></a></p>
		<p style='text-align:center;'><strike><?=display_amount($row[it_cust_amount])?></strike></p>
		<p style='text-align:center;'  class=amount><?=display_amount(get_amount($row), $row[it_tel_inq])?></p>
		<p style='text-align:center;'><?=$star?></p>
		<p style='text-align:center;'><?=$row2[it_maker]?></p>
		<p style='text-align:center;'><?=$icon?></p>
		<p style='text-align:center;'><?=number_format($row2[it_point])?> 점</p></td>
<?}
// 나머지 td 를 채운다.
if (($cnt = $i%$list_mod) != 0)
    for ($k=$cnt; $k<$list_mod; $k++)
        echo "    <td>&nbsp;</td>\n";
?>
</tr>
</table>
