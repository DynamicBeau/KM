<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
$hsql = " select a.it_id, b.it_name, a.ct_qty from $g4[yc4_cart_table] a, $g4[yc4_item_table] b
          where a.on_uid = '".get_session('ss_on_uid')."'
            and a.it_id  = b.it_id
          order by a.ct_id ";
$hresult = sql_query($hsql);

?>

<?/*?>
<a href='<?=$g4[shop_path]?>/cart.php' style="display:block; padding:4px 6px; background:#EEE; border:1px solid #DDD;  font-weight:bold; text-align:left; ">장바구니</a>

<ul style="padding:0; margin:0; margin-top:6px; list-style:none;">
<? for ($i=0; $row=sql_fetch_array($hresult); $i++){?>
    <li style="padding:0; margin:0; list-style:none; height:22px; overflow:hidden; line-height:22px; border-bottom:1px solid #DDD;  padding-left:5px;"><a href="<?=$g4[shop_path]?>/item.php?it_id=<?=$row[it_id]?>"><?=get_text($row[it_name])?></a></li>
<?}
if ($i==0) echo "<p style='text-align:center;'><img src='$g4[shop_img_path]/nocart.gif'></p>";
?>
</ul>

 
<?*/?>

<a href='<?=$g4[shop_path]?>/cart.php' style="display:block; padding:4px 6px; background:#EEE; border:1px solid #DDD;  font-weight:bold; text-align:left; ">장바구니</a>

<ul style="padding:0; margin:0; margin-top:6px; list-style:none;">
<? for ($i=0; $row=sql_fetch_array($hresult); $i++){?>
    <li style="float:left; display:inline; margin: 4px 0px 0px 4px; list-style:none;"><a href="<?=$g4[shop_path]?>/item.php?it_id=<?=$row[it_id]?>"><?=get_it_image($row[it_id]."_s", 50, 50, $row[it_id])?></a></li>
<?}
if ($i==0) echo "<p style='text-align:center;'><img src='$g4[shop_img_path]/nocart.gif'></p>";
?>
	
</ul> 
