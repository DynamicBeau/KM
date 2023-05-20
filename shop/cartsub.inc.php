<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

if ($s_page == 'cart.php' || $s_page == 'orderinquiryview.php')
    $colspan = 7;
else
    $colspan = 6;


$tot_point = 0;
$tot_sell_amount = 0;
$tot_cancel_amount = 0;

$goods = $goods_it_id = "";
$goods_count = -1;

// $s_on_uid 로 현재 장바구니 자료 쿼리
$sql = " select a.ct_id,
                a.it_opt1,
                a.it_opt2,
                a.it_opt3,
                a.it_opt4,
                a.it_opt5,
                a.it_opt6,
                a.ct_amount,
                a.ct_point,
                a.ct_qty,
                a.ct_status,
                b.it_id,
                b.it_name,
                b.ca_id
           from $g4[yc4_cart_table] a, 
                $g4[yc4_item_table] b
          where a.on_uid = '$s_on_uid'
            and a.it_id  = b.it_id
          order by a.ct_id ";
$result = sql_query($sql);
?>

<form name=frmcartlist method=post style="padding:0px;">
<table class="table_style1">
	<colgroup>
		<col width="60px" />
		<col width="" />
		<col width="50px" />
		<col width="80px" />
		<col width="80px" />
		<? if ($config[cf_use_point]) { ?>
		<col width="80px" />
		<?}?>
		<? if ($colspan == 7) echo "<col width='50px' />"; ?>
	</colgroup>
	<tr>
		<th>이미지</th>
		<th>상품명</th>
		<th>수량</th>
		<th>판매가</th>
		<th>소계</th>
		<? if ($config[cf_use_point]) { ?>
		<th>포인트</th>
		<?}?>
		<?
		if ($s_page == 'cart.php')
			echo '<th>삭제</th>';
		else if ($s_page == 'orderinquiryview.php')
			echo '<th>상태</th>';
		?>
	</tr>
	<?
	for ($i=0; $row=mysql_fetch_array($result); $i++) {
		if (!$goods)
		{
			$goods = preg_replace("/\'|\"|\||\,|\&|\;/", "", $row[it_name]);
			$goods_it_id = $row[it_id];
		}
		$goods_count++;

		if ($i==0) { // 계속쇼핑
			$continue_ca_id = $row[ca_id];
		}

		if ($s_page == "cart.php" || $s_page == "orderinquiryview.php") { // 링크를 붙이고
			$a1 = "<a href='./item.php?it_id=$row[it_id]'>";
			$a2 = "</a>";
			$image = get_it_image($row[it_id]."_s", 50, 50, $row[it_id]);
		} else { // 붙이지 않고
			$a1 = "";
			$a2 = "";
			$image = get_it_image($row[it_id]."_s", 50, 50);
		}

		$it_name = $a1 . stripslashes($row[it_name]) . $a2 . "<br>";
		$it_name .= print_item_options($row[it_id], $row[it_opt1], $row[it_opt2], $row[it_opt3], $row[it_opt4], $row[it_opt5], $row[it_opt6]);

		$point       = $row[ct_point] * $row[ct_qty];
		$sell_amount = $row[ct_amount] * $row[ct_qty];

		echo "<tr>";
		echo "<td>$image</td>";
		echo "<td>";
		echo "<input type=hidden name='ct_id[$i]'    value='$row[ct_id]'>";
		echo "<input type=hidden name='it_id[$i]'    value='$row[it_id]'>";
		echo "<input type=hidden name='ap_id[$i]'    value='$row[ap_id]'>";
		echo "<input type=hidden name='bi_id[$i]'    value='$row[bi_id]'>";
		echo "<input type=hidden name='it_name[$i]'  value='".get_text($row[it_name])."'>";
		echo $it_name;
		echo "</td>";

		// 수량, 입력(수량)
		if ($s_page == "cart.php")
			echo "<td>$row[ct_qty]</td>";
			/*echo "<td style='text-align:center'><input type=text id='ct_qty_{$i}' name='ct_qty[{$i}]' value='$row[ct_qty]' size=1 maxlength=6 class=inputbox style='text-align:right;' autocomplete='off'></td>";
		*/
		else
			echo "<td>$row[ct_qty]</td>";

		echo "<td style='text-align:right'>" . number_format($row[ct_amount]) . "</td>";
		echo "<td style='text-align:right'>" . number_format($sell_amount) . "</td>";
		if ($config[cf_use_point]) { 
		echo "<td style='text-align:right'>" . number_format($point) . "</td>";
		}

		if ($s_page == "cart.php")
			echo "<td style='text-align:center'><a href='./cartupdate.php?w=d&ct_id=$row[ct_id]'><img src='$g4[shop_img_path]/btn_del.gif' border='0' align=absmiddle alt='삭제'></a></td>";
		else if ($s_page == "orderinquiryview.php")
		{
			switch($row[ct_status])
			{
				case '주문' : $icon = "<img src='$g4[shop_img_path]/status01.gif'>"; break;
				case '준비' : $icon = "<img src='$g4[shop_img_path]/status02.gif'>"; break;
				case '배송' : $icon = "<img src='$g4[shop_img_path]/status03.gif'>"; break;
				case '완료' : $icon = "<img src='$g4[shop_img_path]/status04.gif'>"; break;
				default     : $icon = $row[ct_status]; break;
			}
			echo "<td style='text-align:center'>$icon</td>";
		}

		echo "</tr>";
	 
		if ($row[ct_status] == '취소' || $row[ct_status] == '반품' || $row[ct_status] == '품절') {
			$tot_cancel_amount += $sell_amount;
		}
		else {
			$tot_point       += $point;
			$tot_sell_amount += $sell_amount;
		}
	}
	if ($i == 0) 
		echo "<tr><td colspan='$colspan' style='text-align:center; line-height:200px;'>장바구니가 비어 있습니다.</td></tr>";
	?>
</table>

<table>
<?
if ($goods_count)
    $goods .= " 외 {$goods_count}건";

if ($i != 0) {
    // 배송비가 넘어왔다면
    if ($_POST[od_send_cost]) {
        $send_cost = (int)$_POST[od_send_cost];
    } else {
        // 배송비 계산
        if ($default[de_send_cost_case] == "없음")
            $send_cost = 0;
        else {
            // 배송비 상한 : 여러단계의 배송비 적용 가능
            $send_cost_limit = explode(";", $default[de_send_cost_limit]);
            $send_cost_list  = explode(";", $default[de_send_cost_list]);
            $send_cost = 0;
            for ($k=0; $k<count($send_cost_limit); $k++) {
                // 총판매금액이 배송비 상한가 보다 작다면
                if ($tot_sell_amount < $send_cost_limit[$k]) {
                    $send_cost = $send_cost_list[$k];
                    break;
                }
            }
        }

        // 이미 주문된 내역을 보여주는것이므로 배송비를 주문서에서 얻는다.
        $sql = "select od_send_cost from $g4[yc4_order_table] where od_id = '$od_id' ";
        $row = sql_fetch($sql);
        if ($row[od_send_cost] > 0)
            $send_cost = $row[od_send_cost];
    }
 

    // 총계 = 주문상품금액합계 + 배송비
    $tot_amount = $tot_sell_amount + $send_cost;

   
    echo "<input type=hidden name=w value=''>";
    echo "<input type=hidden name=records value='$i'>";
}
?>
<tr> 
</tr>
</table>

<?
	if($i != 0){
		echo "<div class='cartsub_price'>";
		if ($send_cost > 0)  echo "<label>배송비 :</label> ". number_format($send_cost);
			echo "<label>총계 : </label>". number_format($tot_amount);
			if ($config[cf_use_point]) { 	echo "<label>포인트 : </label>". number_format($tot_point); }
		echo "</div>";
	}
?>
<?  if ($s_page == "cart.php") {
		echo "<div class='btn_div'>";
	        if ($i == 0) {
            echo "<a href='$g4[path]'><img src='$g4[shop_img_path]/btn_shopping.gif' border='0'></a>";
        } else {
					echo "
            <input type=hidden name=url value='./orderform.php'>
            <a href=\"javascript:form_check('buy')\"><img src='$g4[shop_img_path]/btn_buy.gif' border='0' alt='구매하기'></a>
            <a href=\"javascript:form_check('alldelete');\"><img src='$g4[shop_img_path]/btn_cart_out.gif' border='0' alt='장바구니 비우기'></a>
            <a href='./list.php?ca_id=$continue_ca_id'><img src='$g4[shop_img_path]/btn_shopping.gif' border='0' alt='계속쇼핑하기'></a>";
					/*
            echo "
            <input type=hidden name=url value='./orderform.php'>
            <a href=\"javascript:form_check('buy')\"><img src='$g4[shop_img_path]/btn_buy.gif' border='0' alt='구매하기'></a>
            <a href=\"javascript:form_check('allupdate')\"><img src='$g4[shop_img_path]/btn_cart_quan.gif' border='0' alt='장바구니 수량 변경'></a>
            <a href=\"javascript:form_check('alldelete');\"><img src='$g4[shop_img_path]/btn_cart_out.gif' border='0' alt='장바구니 비우기'></a>
            <a href='./list.php?ca_id=$continue_ca_id'><img src='$g4[shop_img_path]/btn_shopping.gif' border='0' alt='계속쇼핑하기'></a>";
				*/
        }
		echo "</div>";
}
	?>
</form>


<? if ($s_page == "cart.php") { ?>
    <script language='javascript'>
    <? if ($i != 0) { ?>
        function form_check(act) {
            var f = document.frmcartlist;
            var cnt = f.records.value;

            if (act == "buy")
            {
                f.w.value = act;
                
                <? 
                if (get_session('ss_mb_id')) // 회원인 경우
                {
                    echo "f.action = './orderform.php';";
                    echo "f.submit();";
                }
                else
                    echo "document.location.href = '$g4[bbs_path]/login.php?url=".urlencode("$g4[shop_path]/orderform.php")."';";
                ?>
            }
            else if (act == "alldelete")
            {
                f.w.value = act;
                f.action = "<?="./cartupdate.php"?>";
                f.submit();
            }
            else if (act == "allupdate")
            {
                for (i=0; i<cnt; i++)
                {
                    //if (f.elements("ct_qty[" + i + "]").value == "")
                    if (document.getElementById('ct_qty_'+i).value == '')
                    {
                        alert("수량을 입력해 주십시오.");
                        //f.elements("ct_qty[" + i + "]").focus();
                        document.getElementById('ct_qty_'+i).focus();
                        return;
                    }
                    //else if (isNaN(f.elements("ct_qty[" + i + "]").value))
                    else if (isNaN(document.getElementById('ct_qty_'+i).value))
                    {
                        alert("수량을 숫자로 입력해 주십시오.");
                        //f.elements("ct_qty[" + i + "]").focus();
                        document.getElementById('ct_qty_'+i).focus();
                        return;
                    }
                    //else if (f.elements("ct_qty[" + i + "]").value < 1)
                    else if (document.getElementById('ct_qty_'+i).value < 1)
                    {
                        alert("수량은 1 이상 입력해 주십시오.");
                        //f.elements("ct_qty[" + i + "]").focus();
                        document.getElementById('ct_qty_'+i).focus();
                        return;
                    }
                }
                f.w.value = act;
                f.action = "./cartupdate.php";
                f.submit();
            }

            return true;
        }
    <? } ?>
    </script>
<? } ?>

<? if ($s_page == "cart.php") { ?>
 
 <ul class='cart_text'>
	<li><label>상품 주문하기</label> : 주문서를 작성하시려면 '주문하기' 버튼을 누르세요.</li>
	<!-- <li><label>상품 수량변경</label> : 주문수량을 변경하시려면 원하시는 수량을 입력하신 후 '수량변경' 버튼을 누르세요.</li> -->
	<li><label>상품 삭제하기</label> : 모든 주문내용을 삭제하시려면 '삭제하기' 버튼을 누르세요.</li>
	<li><label>쇼핑 계속하기</label> : 쇼핑하시던 페이지로 돌아가시려면 '쇼핑 계속하기' 버튼을 누르세요.</li>
 </ul>
<? } ?>
