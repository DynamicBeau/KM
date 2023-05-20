<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<style type="text/css">
.itemlist{border-collapse:collapse ; border-spacing:0px;clear:both; width:100%; table-layout:fixed; border-bottom:1px solid #AAA;}
.itemlist table{border-top:1px solid #AAA; border-collapse:collapse ; border-spacing:0px;clear:both; width:100%; table-layout:fixed; }
.itemlist .image{width:<?=$img_width+2?>px; padding:8px 0;}
.itemlist .image a img{border:1px solid #DDD;}
.itemlist .image a:hover img{border:1px solid #AAA}
.itemlist .name_icon{padding:8px}
.itemlist .name_icon a{display:block;}

.itemlist .amount{font-weight:bold; color:#F60; text-align:right}
.itemlist .point{text-align:right}
.btn_cart_in{float:right; margin-top:5px;}
</style>



<div class="itemlist">
	<? for ($i=0; $row=sql_fetch_array($result); $i++){

		$onclick_str = "";

		// 옵션이 있는 상품은 선택할 수 없음
		if (preg_match("/;|\\r/", trim($row['it_opt1']).trim($row['it_opt2']).trim($row['it_opt3']).trim($row['it_opt4']).trim($row['it_opt5']).trim($row['it_opt6']))) {
			$onclick_str = "옵션이 있는 상품이므로 바로 장바구니에 담을 수 없습니다.";
		}

		$it_amount = get_amount($row);		
		?>
    <form name='flistskin7_<?=$i?>' method='post' action='./cartupdate.php'>
    <input type='hidden' name='sw_direct' value='0'>
    <input type='hidden' name='it_id' value='<?=$row[it_id]?>'>
    <input type='hidden' name='it_name' value='<?=stripslashes($row[it_name])?>'>
    <input type='hidden' name='it_amount' value='<?=$it_amount?>'>
    <input type='hidden' name='it_point' value='<?=$row[it_point]?>'>
    <input type='hidden' name='ct_qty' value='1'>

	<table>
	<tr>
		<td class="image"><?=get_it_image($row[it_id]."_s", $img_width , $img_height, $row[it_id])?></td>
		<td class="name_icon" valign=top><?=it_name_icon($row)?><br>
			  <?=get_text($row['it_basic'])?></td>
			<? if (!$row['it_gallery']){?>
		<td width=100>
			<p class=amount><?=display_amount($it_amount, $row['it_tel_inq'])?></p>
			<p class=point><?=display_point($row['it_point'])?></p>
			<? if ($onclick_str){?>
				<a href="javascript:alert('<?=$onclick_str?>'); location.href='./item.php?it_id=<?=$row[it_id]?>';" class="btn_cart_in">장바구니 담기</a>
			<?}else{?>
				<a href="javascript:document.flistskin7_<?=$i?>.submit();" class="btn_cart_in"><img src="<?=$g4[shop_img_path]?>/btn_cart_in.gif"  align="absmiddle"></a>
			<?}?>
		</td>
		<?}?>
	</tr>
	</table>
	</form>
	<?}?>
</div>

<?/*?>
<table width=100% cellpadding=4 cellspacing=1>
<?
$btn_img = "<img src='$g4[shop_img_path]/btn_cart_in.gif' border=0 alt='장바구니 담기'>";
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
    $onclick_str = "";

    // 옵션이 있는 상품은 선택할 수 없음
    if (preg_match("/;|\\r/", trim($row['it_opt1']).trim($row['it_opt2']).trim($row['it_opt3']).trim($row['it_opt4']).trim($row['it_opt5']).trim($row['it_opt6']))) {
        $onclick_str = "옵션이 있는 상품이므로 바로 장바구니에 담을 수 없습니다.";
    }

    $it_amount = get_amount($row);

    echo "
    <form name='flistskin7_$i' method='post' action='./cartupdate.php'>
    <input type='hidden' name='sw_direct' value='0'>
    <input type='hidden' name='it_id' value='$row[it_id]'>
    <input type='hidden' name='it_name' value='".stripslashes($row[it_name])."'>
    <input type='hidden' name='it_amount' value='$it_amount'>
    <input type='hidden' name='it_point' value='$row[it_point]'>
    <input type='hidden' name='ct_qty' value='1'>
    <tr>
        <td>
            <table width=100% cellpadding=0 cellspacing=0>
            <tr>
                <td width='".($img_width+20)."' align=center>".get_it_image($row[it_id]."_s", $img_width , $img_height, $row[it_id])."</td>
                <td>
                    <a href='./item.php?it_id=$row[it_id]' class=item>".it_name_icon($row)."</a><br>
                    ".get_text($row['it_basic'])."
                </td>
            </tr>
            </table>
        </td>
        <td align=center>$row[it_maker]</td>
        <td align=right>";

    if (!$row['it_gallery']) {
        echo "
            <span class=amount>".display_amount($it_amount, $row['it_tel_inq'])."</span>
            <br>".display_point($row['it_point'])."</td>";
    }

    echo "<td align=center>";

    if (!$row['it_gallery']) {
        if ($onclick_str)
            echo "<a href=\"javascript:alert('$onclick_str'); location.href='./item.php?it_id=$row[it_id]';\">$btn_img</a>";
        else
            echo "<a href=\"javascript:document.flistskin7_$i.submit();\">$btn_img</a>";
    }

    echo "</td></tr></form>";
}
?>
</table>

<?*/?>
