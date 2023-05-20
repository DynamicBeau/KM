<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

/* 
** 1.00.03
** 여러가지 상품을 선택하여 한꺼번에 바로구매 및 장바구니에 담기할 수 있는 페이지 입니다.
** 그러나 옵션이 있는 상품, 경매 또는 공동구매가 진행중인 상품은 선택할 수 없습니다.
*/
?>
<style type="text/css">
.itemlist{border-collapse:collapse ; border-spacing:0px;clear:both; width:100%; table-layout:fixed; border-bottom:1px solid #999;}
.itemlist td{padding:10px 0; border-top:1px solid #AAA}
.itemlist td a img{width:<?=$img_width?>px; height:<?=$img_height?>px; margin:0 auto; border:1px solid #DDD;}
.itemlist td a:hover img{border:1px solid #AAA}

.itemlist td p{line-height:16px;}
.itemlist .name_icon a{display:block;margin-top:10px;}
.itemlist .cust_amount{text-decoration: line-through;  }
.itemlist .amount{font-weight:bold; color:#F60}
.btn_set{padding:10px 0; text-align:center;}
</style>

<form name=flist3 method=post action="./cartupdate.php">
<input type=hidden name=w value="multi">
<input type=hidden name=sw_direct value="">
<table class="itemlist">
<tr>
<?
for ($i=0; $row=mysql_fetch_array($result); $i++) {
    if ( ($i>0) && (($i%$list_mod)==0) ) echo "</tr>\n<tr>\n";

	echo "<td width='{$td_width}%' align=center valign=top>";

    $it_amount = get_amount($row);
    echo "<input type=hidden name=it_name[$i] value='".stripslashes($row[it_name])."'>\n";
    echo "<input type=hidden name=it_amount[$i] value='$it_amount'>\n";
    echo "<input type=hidden name=it_point[$i] value='$row[it_point]'>\n";
    echo "<input type=hidden name=ct_qty[$i] value='0'>";
    echo "<input type=hidden name=it_id[$i] value='$row[it_id]' >\n";

	
	echo get_it_image($row[it_id]."_s", $img_width , $img_height, $row[it_id]);
	echo "<p class='name_icon'>".it_name_icon($row)."</p>";
    
    if ($row[it_cust_amount] && !$row[it_gallery])
		echo "<p class='cust_amount'>".display_amount($row[it_cust_amount], $row[it_tel_inq])."</p>";

/*
	$onclick_str = "";

    // 옵션이 있는 상품은 선택할 수 없음
    if (preg_match("/;|\\r/", trim($row[it_opt1]).trim($row[it_opt2]).trim($row[it_opt3]).trim($row[it_opt4]).trim($row[it_opt5]).trim($row[it_opt6]))) {
        $onclick_str = "옵션이 있는 상품은 선택하실 수 없습니다.";
    }

    if ($onclick_str) {
         $onclick_str = "onclick=\"alert('$onclick_str'); this.checked=false;\"";
    } else {
         $onclick_str = "onclick=\"document.flist3.elements['ct_qty[$i]'].value = this.checked ? '1' : '0';\"";
    }

*/
     
	$onclick_str = "<input type='checkbox' name='chk[$i]' onclick=\"document.flist3.elements['ct_qty[$i]'].value = this.checked ? '1' : '0';\" /> ";

    // 옵션이 있는 상품은 선택할 수 없음
    if (preg_match("/;|\\r/", trim($row[it_opt1]).trim($row[it_opt2]).trim($row[it_opt3]).trim($row[it_opt4]).trim($row[it_opt5]).trim($row[it_opt6]))) {
        $onclick_str = "";
    } 


    if (!$row[it_gallery])
        echo "<p class=amount>$onclick_str".display_amount($it_amount)."</p>";

    echo "</td>";
}

// 나머지 td 를 채운다.
if (($cnt = $i%$list_mod) != 0)
    for ($k=$cnt; $k<$list_mod; $k++)
        echo "    <td>&nbsp;</td>\n";
$length = $i;
?>
</tr>
</table>

<div class="btn_set">
        <a href="javascript:flist3_check('buy');"><img src="<?=$g4[shop_img_path]?>/btn_buy.gif"  align="absmiddle"></a>
        <a href="javascript:flist3_check('cart');"><img src="<?=$g4[shop_img_path]?>/btn_cart_in.gif"  align="absmiddle"></a>
    </div>
</form>
<script language="JavaScript">

function flist3_check(act)
{
    var f = document.flist3; 

    if (act == 'buy') // 바로 구매
        f.sw_direct.value = '1';
    else  // 장바구니에 담기
        f.sw_direct.value = '0';

    checked = false;
    for (i=0; i<<? echo $length ?>; i++) 
    {
		if(f.elements['chk['+i+']'])
        if (f.elements['chk['+i+']'].checked==true) 
        {
            checked = true;
            break;
        }
    }

    if (checked == false) {
        alert("상품을 한개 이상 선택하여 주십시오.");
        return;
    }

    f.submit();
}
</script>
