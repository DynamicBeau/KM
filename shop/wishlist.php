<?
include_once("./_common.php");

if (!$is_member)
    goto_url("$g4[bbs_path]/login.php?url=".urlencode("$g4[shop_path]/mypage.php"));

$g4[title] = "Wish list";
include_once("./_head.php");
?>

<div class="page_title">Wish List<!-- <img src="<?=$g4[shop_img_path]?>/top_wishlist.gif" border="0"> --></div>

<form name=fwishlist method=post action="" style="padding:0px;">
<input type=hidden name=w         value="multi">
<input type=hidden name=sw_direct value=''>
<input type=hidden name=prog      value='wish'>
<table class="table_style1">
	<colgroup>
		<col width="60px" />
		<col width="" />
		<col width="120px" />
		<col width="100px" />
		<col width="50px" />

	</colgroup>
	<tr>
		<th>이미지</th>
		<th>상품명</th>
		<th>보관일시</th>
		<th>상품체크</th>
		<th>삭제</th>
	</tr>
<?
$sql = " select * 
           from $g4[yc4_wish_table] a, 
                $g4[yc4_item_table] b
          where a.mb_id = '$member[mb_id]'
            and a.it_id  = b.it_id
          order by a.wi_id desc ";
$result = sql_query($sql);
for ($i=0; $row = mysql_fetch_array($result); $i++) {

    $out_cd = "";
    for($k=1; $k<=6; $k++){
        $opt = trim($row["it_opt{$k}"]);
        if(preg_match("/\n/", $opt)||preg_match("/;/" , $opt)) {
            $out_cd = "no";
            break;
        }
    }

    $it_amount = get_amount($row);

    if ($row[it_tel_inq]) $out_cd = "tel_inq";


    $image = get_it_image($row[it_id]."_s", 50, 50, $row[it_id]);

    $s_del = "<a href='./wishupdate.php?w=d&wi_id=$row[wi_id]'><img src='$g4[shop_img_path]/btn_del.gif' border='0' align=absmiddle alt='삭제'></a>";

    echo "<tr>\n";
    echo "<td align=center style='padding-top:5px; padding-bottom:5px;'>$image</td>\n";
    echo "<td><a href='./item.php?it_id=$row[it_id]'>".stripslashes($row[it_name])."</a></td>\n";
    echo "<td align=center>$row[wi_time]</td>\n";
    echo "<td align=center>";
    // 품절검사
    $it_stock_qty = get_it_stock_qty($row[it_id]);
    if($it_stock_qty <= 0) 
    {
        echo "<img src='$g4[shop_img_path]/icon_pumjul.gif' border=0 align=absmiddle>";
        echo "<input type=hidden name=it_id[$i] >";
    } else { //품절이 아니면 체크할수 있도록한다
        echo "<input type=checkbox name=it_id[$i]     value='$row[it_id]' onclick=\"out_cd_check(this, '$out_cd');\">";
    }
    echo "<input type=hidden   name=it_name[$i]   value='$row[it_name]'>";
    echo "<input type=hidden   name=it_amount[$i] value='$it_amount'>";
    echo "<input type=hidden   name=it_point[$i]  value='$row[it_point]'>";
    echo "<input type=hidden   name=ct_qty[$i]    value='1'>";
    echo "</td>\n";
    echo "<td align=center>$s_del</td>\n";
    echo "</tr>\n";
}

if ($i == 0)
    echo "<tr><td colspan=5 align=center height=100>보관함이 비었습니다.</td></tr>\n";
?>
</tr>
</table>
</form>

<div class="btn_div">
    <a href="javascript:fwishlist_check(document.fwishlist,'');"><img src='<?=$g4[shop_img_path]?>/btn_cart_in.gif' border=0></a>
    <a href="javascript:fwishlist_check(document.fwishlist,'direct_buy');"><img src='<?=$g4[shop_img_path]?>/btn_buy.gif' border=0></a>
</div>

<script language="JavaScript">
<!--
	function out_cd_check(fld, out_cd) 
    {
        if (out_cd == 'no'){
            alert("옵션이 있는 상품입니다.\n\n상품을 클릭하여 상품페이지에서 옵션을 선택한 후 주문하십시오.");
            fld.checked = false;
            return;
        }
 
        if (out_cd == 'tel_inq'){
            alert("이 상품은 전화로 문의해 주십시오.\n\n장바구니에 담아 구입하실 수 없습니다.");
            fld.checked = false;
            return;
        }
	}

	function fwishlist_check(f, act) 
    {
        var k = 0;
		var length = f.elements.length;
		
        for(i=0; i<length; i++) {
            if (f.elements[i].checked) {
                k++;
            }
        }
        
        if(k == 0)
        {
            alert("상품을 하나 이상 체크 하십시오");
            return;
        }  

        if (act == "direct_buy")
        {
            f.sw_direct.value = 1;
        }
        else
        {
            f.sw_direct.value = 0;
        }

        f.action="./cartupdate.php";
			                      
        f.submit();
    }
//-->
</script>

<?
include_once("./_tail.php");
?>
