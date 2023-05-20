<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<style type="text/css">
.itemlist{border-collapse:collapse ; border-spacing:0px;clear:both; width:100%; table-layout:fixed; border-bottom:1px solid #999;}
.itemlist td{padding:10px 0; border-top:1px solid #AAA}
.itemlist td a img{width:<?=$img_width?>px; height:<?=$img_height?>px; margin:0 auto; border:1px solid #DDD;}
.itemlist td a:hover img{border:1px solid #AAA}

.itemlist .name_icon a{display:block;margin-top:10px;}
.itemlist .cust_amount{text-decoration: line-through}
.itemlist .amount{font-weight:bold; color:#009945}
</style>

<table class="itemlist">
	<tr>
	<?
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		if ( ($i>0) && (($i%$list_mod)==0) ) echo "</tr>\n<tr>\n";


		echo "<td width='{$td_width}%' align=center valign=top>";
		echo get_it_image($row[it_id]."_s", $img_width , $img_height, $row[it_id]);

		echo "<p class='name_icon'>".it_name_icon($row)."</p>";
		if ($row[it_cust_amount] && !$row[it_gallery])
			echo "<p class='cust_amount'>".display_amount($row[it_cust_amount])."</p>";
		if (!$row[it_gallery])
			echo "<p class=amount>".display_amount(get_amount($row), $row[it_tel_inq])."</p>";
		echo "</td>";
	}
	// 나머지 td 를 채운다.
	if (($cnt = $i%$list_mod) != 0)
		for ($k=$cnt; $k<$list_mod; $k++)
			echo "    <td>&nbsp;</td>\n";
	?>
	</tr>
</table>
