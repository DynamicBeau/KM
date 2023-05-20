<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<style type="text/css">
.itemlist{border-collapse:collapse ; border-spacing:0px;clear:both; width:100%; table-layout:fixed; border-bottom:1px solid #AAA;}
.itemlist table{border-top:1px solid #AAA;border-collapse:collapse ; border-spacing:0px;clear:both; width:100%; table-layout:fixed;}
.itemlist .image{width:<?=$img_width+2?>px;padding:8px 0; }
.itemlist .image a img{border:1px solid #DDD;}
.itemlist .image a:hover img{border:1px solid #AAA}
.itemlist .name_icon{padding:8px}
.itemlist .name_icon a{display:block;}

.itemlist .amount{font-weight:bold; color:#F60; text-align:right}
.itemlist .point{text-align:right}
.btn_wish2{float:right; margin-top:5px;}
</style>
<div class="itemlist">
	<? for ($i=0; $row=sql_fetch_array($result); $i++) {?>
	<table>
	<tr>
		<td class="image"><?=get_it_image($row[it_id]."_s", $img_width , $img_height, $row[it_id])?></td>
		<td class="name_icon" valign=top><?=it_name_icon($row)?></td>
		<td width=70>
		<?  if (!$row[it_gallery]){?>	
			<p class=amount><?=display_amount(get_amount($row), $row[it_tel_inq])?></p>
			<p class=point><?=display_point($row[it_point])?></p>
		<?}?>
		<a href='./wishupdate.php?it_id=<?=$row[it_id]?>' class="btn_wish2"><img src="<?=$g4[shop_img_path]?>/btn_wish2.gif"  align="absmiddle"></a></td>
	</tr>
	</table>
	<?}?>
</div>

 
