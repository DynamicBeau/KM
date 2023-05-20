<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

/*
** maintype1.inc.php 에 이미지 크게 보기 기능만 추가
*/
?>
<table width=100% cellpadding=0 cellspacing=0>
<tr>
<? for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($i > 0 && $i % $list_mod == 0) echo "</tr>\n\n<tr>\n";

    $href = "<a href='$g4[shop_path]/item.php?it_id=$row[it_id]' class=item>";
?>
    <td width="<?=$td_width?>%" align=center valign=top style="padding:5px;">
			<?=$href?><?=get_it_image($row[it_id]."_s", $img_width, $img_height)?></a>
			<p style='padding:5px 0; text-align:center;'><?=$href?><?=stripslashes($row[it_name])?></a></p>
			<p class=amount style='padding:5px 0; text-align:center;'><?=display_amount(get_amount($row), $row[it_tel_inq])?></p>
			<p><img src='<?=$g4[shop_img_path]?>/btn_zoom.gif'  onclick="javascript:win_open('<?=$g4[shop_path]?>/largeimage.php?it_id=<?=$row[it_id]?>', 'viewImage','left=50, top=50, width=600, height=600, scrollbars=no')" style='cursor: pointer'></p></td>
<?}
// 나머지 td 를 채운다.
if (($cnt = $i%$list_mod) != 0)
    for ($k=$cnt; $k<$list_mod; $k++)
        echo "<td>&nbsp;</td>\n";
?>
</tr>
</table>
 
