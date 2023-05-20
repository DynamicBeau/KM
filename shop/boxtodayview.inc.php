<?
$tv_idx = get_session("ss_tv_idx");

$tv_div[top] = 115;
$tv_div[img_width] = 54;
$tv_div[img_height] = 48;
$tv_div[img_length] = 5; // 보여지는 최대 이미지수

$sql = " select count(*) as cnt from $g4[yc4_cart_table] where on_uid = '".get_session('ss_on_uid')."' ";
$row = sql_fetch($sql);
$total_cad_cnt = number_format($row[cnt]);

$row = sql_fetch("select count(*) as cnt from $g4[yc4_wish_table]  where mb_id = '$member[mb_id]'");
$total_wish_cnt = number_format($row[cnt]);

?>
<style type="text/css">
	.today_itemTable img{border:1px solid #DDD; margin-top:2px;}
</style>

<div id='divTodayHidden' style="position:absolute; right:0;top:<?=$tv_div[top]?>;display:none;"><a href='javascript:todayview_visible();'><img src='<?=$g4[shop_img_path]?>/todayview.gif' border=0></a></div>

<div id='divToday' style="margin-top:50px; margin:0px ; padding:0px ;position:fixed;">

<table cellpadding=0 cellspacing=0 border="0" align="center" style='margin:0px ; padding:0px ; text-align:center;' >
<tr>
	<td><img src="<?=$g4[path]?>/images/quick_head.gif"></td>
</tr>
<?
// 오늘 본 상품이 있다면
if ($tv_idx)
{
    // 오늘 본 상품갯수가 보여지는 최대 이미지 수 보다 크다면 위로 화살표를 보임
    if ($tv_idx > $tv_div[img_length])
        echo "<tr><td align='center'><img src='{$g4[path]}/images/top_arrow.gif' border='0' onclick='javascript:todayview_up();' style='cursor:pointer; '></td></tr>";
		?>
		<tr>
			<td style="padding-top:0px;"><img src="<?=$g4[path]?>/images/quick_line.gif"></td>
		</tr>
		<?
    // 오늘 본 상품 이미지 출력
    echo "<tr><td><table width='100%' cellpadding='0' class='today_itemTable' >";
    for ($i=1; $i<=$tv_div[img_length]; $i++)
    {
        echo "<tr><td align=center>";
        echo "<span id='todayview_{$i}'></span>";
        echo "</td></tr>";
    }
    echo "</table></td></tr>";


    // 오늘 본 상품갯수가 보여지는 최대 이미지 수 보다 크다면 아래로 화살표를 보임

    if ($tv_idx > $tv_div[img_length])
        echo "<tr><td style='padding-top:10px;'><img src='{$g4[path]}/images/quick_line.gif'></td></tr>";
        echo "<tr><td style='padding-top:0px;'><img src='{$g4[path]}/images/bottom_arrow.gif' border='0' onclick='javascript:todayview_dn();' style='cursor:pointer;'></td></tr>";
}
else
{
    echo "<tr><td style='font:8pt/80px Dotum; text-align:center;letter-spacing:-2px;background:url(".$g4[path]."/images/quick_bg.jpg) repeat-y'>아직없습니다.</td></tr>";
}
?>

<!--
<tr><td style="background:url(<?=$g4[shop_img_path]?>/quick4.gif) no-repeat; text-align:center; color:#FFF; height:76px; border-collapse:collapse ; margin:0px; padding:0px ; ">
<a href='<?=$g4[shop_path]?>/cart.php' style="color:#DDD; display:block;">장바구니</a>
(<?=$total_cad_cnt?> 개)
<a href='<?=$g4[shop_path]?>/wishlist.php' style="color:#DDD; display:block;">관심상품</a>
(<?=$total_wish_cnt?> 개)

</td></tr>
-->
<tr><td><a href='<?=$g4[path]?>/shop/cart.php'><img src='<?=$g4[path]?>/images/quick_4.gif' border=0></a></td></tr>
<tr><td><a href='<?=$g4[path]?>/shop/wishlist.php'><img src='<?=$g4[path]?>/images/quick_5.gif' border=0></a></td></tr>
<tr><td><img src='<?=$g4[path]?>/images/quick_bottom.gif' border=0></td></tr>

</table>

</div>

<!-- 오늘 본 상품 -->
<script language="JavaScript">
var goods_link = new Array();
<?
echo "var goods_max = ".(int)$tv_idx.";\n";
echo "var goods_length = ".(int)$tv_div[img_length].";\n";
echo "var goods_current = goods_max;\n";
echo "\n";

for ($i=1; $i<=$tv_idx; $i++)
{
    $tv_it_id = get_session("ss_tv[$i]");
    $rowx = sql_fetch(" select it_name from $g4[yc4_item_table] where it_id = '$tv_it_id' ");
    $it_name = get_text(addslashes($rowx['it_name']));
    $img = get_it_image($tv_it_id."_s", $tv_div['img_width'], $tv_div['img_height'], $tv_it_id);
    $img = preg_replace("/\<a /", "<a title='$it_name' ", $img);
    echo "goods_link[$i] = \"{$img}<br/><!-- <span class=small>".cut_str($it_name,10,"")."</span> -->\";\n";
}
?>

var divSave = null;
 
function todayview_move(current)
{
    k = 0;
    for (i=goods_current; i>0 ; i--) 
    {
        k++;
        if (k > goods_length)
            break;
        document.getElementById('todayview_'+k).innerHTML = goods_link[i];
    }
}

function todayview_up()
{
    if (goods_current + 1 > goods_max)
        alert("오늘 본 마지막 상품입니다.");
    else
        todayview_move(goods_current++);
}

function todayview_dn()
{
    if (goods_current - goods_length == 0)
        alert("오늘 본 처음 상품입니다.");
    else
        todayview_move(goods_current--);
}

<?
$k=0;
for ($i=$tv_idx; $i>0; $i--) 
{
    $k++;
    if ($k > $tv_div[img_length])
        break;

    $tv_it_id = get_session("ss_tv[$i]");
    echo "document.getElementById('todayview_{$k}').innerHTML = goods_link[$i];\n";
}
 
?>
</script>

<script language=javascript>


<?
if ($_COOKIE['ck_tvhidden'])
    echo "todayview_hidden();";
?>
//-->
</script> 
