<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
$b=$_GET['b']; 
?>
<table width=100% cellpadding=0 cellspacing=0 >
<tr>
<? for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($i > 0 && $i % $list_mod == 0) echo "</tr>\n\n<tr>\n";
		if($b){
			$href = "<a href='$g4[shop_path]/item.php?it_id=$row[it_id]&b={$b}' class=item>";
		}else{
			$href = "<a href='$g4[shop_path]/item.php?it_id=$row[it_id]' class=item>";
		}
?>
    <td width="<?=$td_width?>%" align=center valign=top style="padding-top:20px;">
			<?=$href?><?=get_it_image($row[it_id]."_s", $img_width, $img_height)?></a>
			<p style='padding:10px 0; text-align:center;'><?=$href?><?=stripslashes($row[it_name])?></a></p>
			<p class=amount style='padding:10px 0; text-align:center;'><?=display_amount(get_amount($row), $row[it_tel_inq])?></p></td>
<?

// 이미지 오른쪽에 구분선을 두는 경우 (이미지로 대체 가능)
    if ($i%$list_mod!=$list_mod-1)
        echo "<td width=1><img src='$g4[path]/img/maintype_line.gif'></td>";

}

// 나머지 td 를 채운다.
if (($cnt = $i%$list_mod) != 0)
    for ($k=$cnt; $k<$list_mod; $k++)
        echo "<td>&nbsp;</td>\n";
?>
</tr>
</table>
