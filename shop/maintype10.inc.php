<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<table width=100% cellpadding=0 cellspacing=0>
<tr>
<? for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($i > 0 && $i % $list_mod == 0) echo "</tr>\n\n<tr>\n";

    $href = "<a href='$g4[shop_path]/item.php?it_id=$row[it_id]' class=item>";
?>
    <td width="<?=$td_width?>%" align=center valign=top style="padding:5px;">
			<?=$href?><?=get_it_image($row[it_id]."_m", $img_width, $img_height)?></a>

			<!-- <p class="pro_no"><?=$row[it_codename]?></p> -->
			<p class="pro_name"><?=$row[it_name]?></p>
			<p class="pro_price" style='padding:5px 0; text-align:center;'><?=display_amount(get_amount($row), $row[it_tel_inq])?></p></td>
<?
/*
// 이미지 오른쪽에 구분선을 두는 경우 (이미지로 대체 가능)
    if ($i%$list_mod!=$list_mod-1)
        echo "<td width=1 bgcolor=#eeeeee></td>";
*/
}

// 나머지 td 를 채운다.
if (($cnt = $i%$list_mod) != 0)
    for ($k=$cnt; $k<$list_mod; $k++)
        echo "<td>&nbsp;</td>\n";
?>
</tr>
</table>
