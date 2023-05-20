<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<style type="text/css">
.itemlist{border-collapse:collapse ; border-spacing:0px;clear:both; width:100%; table-layout:fixed;}
.itemlist th{padding:8px;}
.itemlist th table{border-collapse:collapse ; border-spacing:0px;clear:both; width:100%; table-layout:fixed;}
.itemlist a img{width:<?=$img_width?>px; height:<?=$img_height?>px; margin:0 auto; border:1px solid #DDD;}
.itemlist a:hover img{border:1px solid #AAA}
.itemlist .name_icon{padding:8px}
.itemlist .name_icon a{display:block;margin-top:10px;}

.itemlist .amount{font-weight:bold; color:#F60; text-align:right}

</style>
<table border=1 bordercolor=#DDDDD class="itemlist">
<tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    if ( ($i>0) && (($i%$list_mod)==0) )echo "</tr>\n<tr>\n";

    $image = get_it_image($row[it_id]."_s", $img_width , $img_height, $row[it_id]);

    echo "
    <th width='$td_width%' valign=top>
        <table>
        <tr>
            <td align=center width='$img_width' rowspan=2>$image</td>
            <td class='name_icon'>".it_name_icon($row)."</td>
		</tr>
		<tr>
            <td class='amount'>";
    
    if (!$row[it_gallery])
        echo display_amount(get_amount($row), $row[it_tel_inq]);

    echo "</td>
        </tr>
        </table>
    </th>";
 
}
	// 나머지 td 를 채운다.
	if (($cnt = $i%$list_mod) != 0)
		for ($k=$cnt; $k<$list_mod; $k++)
			echo "    <td>&nbsp;</td>\n";
	?>
</tr>
</table>
