<?
include_once("./_common.php");

// 불법접속을 할 수 없도록 세션에 아무값이나 저장하여 hidden 으로 넘겨서 다음 페이지에서 비교함
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);

$sql = "select * from $g4[yc4_order_table] where od_id = '$od_id' and on_uid = '$on_uid' ";
$od = sql_fetch($sql);
if (!$od[od_id]) {
    echo "$od_id $on_uid $MxIssueNO";
    alert("조회하실 주문서가 없습니다.", $g4[path]);
}

// 결제방법
$settle_case = $od[od_settle_case];

set_session('ss_temp_on_uid', $on_uid);

$g4[title] = "주문상세내역 : 주문번호 - $od_id";
include_once("./_head.php");
?>

<div class="page_title"><img src="<?=$g4[shop_img_path]?>/top_orderinquiryview.gif" border=0></div>

<?
$s_on_uid = $od[on_uid];
$s_page = "orderinquiryview.php";
include "./cartsub.inc.php";
?>

<!-- 
<div style="text-align:right; padding:10px;">
	<img src='<?=$g4[shop_img_path]?>/status01.gif' align=absmiddle> : 주문대기 &nbsp;&nbsp;
	<img src='<?=$g4[shop_img_path]?>/status02.gif' align=absmiddle> : 상품준비중 &nbsp;&nbsp;
	<img src='<?=$g4[shop_img_path]?>/status03.gif' align=absmiddle> : 배송중 &nbsp;&nbsp;
	<img src='<?=$g4[shop_img_path]?>/status04.gif' align=absmiddle> : 배송완료 &nbsp;&nbsp;
</div>
 -->
<div style="padding:10px; font:bold 13px/20px Gulim;">&lt;!&gt; 주문번호: <span style=" COLOR:#D60B69"><?=$od[od_id]?></span></div>


<!-- 주문하시는 분 -->
<table class="table_style3">
	<caption>주문자정보</caption>
	<tr>
		<th>주문일시</th>
		<td><?=$od[od_time] ?></td>
	</tr>
	<tr>
		<th>이름</th>
		<td><?=$od[od_name] ?></td>
	</tr>
	<tr>
		<th>전화번호</th>
		<td><?=$od[od_tel] ?></td>
	</tr>
	<tr>
		<th>핸드폰</th>
		<td><?=$od[od_hp] ?></td>
	</tr>
	<tr>
		<th>주소</th>
		<td><?=sprintf("(%s-%s) %s %s", $od[od_zip1], $od[od_zip2], $od[od_addr1], $od[od_addr2]); ?></td>
	</tr>
	<tr>
		<th>E-mail</th>
		<td><?=$od[od_email] ?></td>
	</tr>
</table>


<!-- 받으시는 분 -->
<table class="table_style3">
	<caption>배송지정보</caption>
	<tr>
		<th>이름</th>
		<td><?=$od[od_b_name]; ?></td>
	</tr>
	<tr>
		<th>전화번호</th>
		<td><?=$od[od_b_tel] ?></td>
	</tr>
	<tr>
		<th>핸드폰</th>
		<td><?=$od[od_b_hp] ?>&nbsp;</td>
	</tr>
	<tr>
		<th>주소</th>
		<td><?=sprintf("(%s-%s) %s %s", $od[od_b_zip1], $od[od_b_zip2], $od[od_b_addr1], $od[od_b_addr2]); ?></td>
	</tr>
	<? 
        // 희망배송일을 사용한다면
        if ($default[de_hope_date_use]) 
        {
            echo "<tr>";
            echo "<th>희망배송일</th>";
            echo "<td>".substr($od[od_hope_date],0,10)." (".get_yoil($od[od_hope_date]).")</td>";
            echo "</tr>";
        } 
        
        if ($od[od_memo]) {
            echo "<tr>";
            echo "<th>전하실 말씀</th>";
            echo "<td style='word-break:break-all;'>".conv_content($od[od_memo], 0)."</td>";
            echo "</tr>";        
        }
        ?>

</table>


<!-- 배송정보 -->
<?
	// 배송회사 정보
	$dl = sql_fetch(" select * from $g4[yc4_delivery_table] where dl_id = '$od[dl_id]' ");
	if ($od[od_invoice] || !$od[misu]) {
?>
<table class="table_style3">
	<caption>배송정보</caption>
	<? if (is_array($dl)){?>
	<tr>
		<th>배송회사</th>
		<td><?=$dl[dl_company]?> &nbsp;&nbsp;[<a href='<?=$dl[dl_url]?><?=$invoice?>' target=_new>배송조회하기</a>]</td>
	</tr>
	<tr>
		<th>운송장번호</th>
		<td><?=$od[od_invoice]?></td>
	</tr>
	<tr>
		<th>배송일시</th>
		<td><?=$od[od_invoice_time]?></td>
	</tr>
	<tr>
		<th>고객센터 전화</th>
		<td><?=$dl[dl_tel]?></td>
	</tr>
	<?}else{?>
	<tr><td style='padding:20px; text-align:center; color:#789'>아직 배송하지 않았거나 배송정보를 입력하지 못하였습니다.</td></tr>
	<?}?>
</table>
<?}?>


<!-- 결제정보 -->
<?
$receipt_amount = $od[od_receipt_bank] 
                + $od[od_receipt_card] 
                + $od[od_receipt_point] 
                - $od[od_cancel_card]
                - $od[od_refund_amount];

$misu = true;

if ($tot_amount - $tot_cancel_amount == $receipt_amount) {
    $wanbul = " (완불)"; 
    $misu = false; // 미수금 없음
}

$misu_amount = $tot_amount - $tot_cancel_amount - $receipt_amount - $od[od_dc_amount];

?>
<table class="table_style3">
	<caption>결제정보</caption>
	<?
	if ($od[od_settle_case] == '신용카드'){
		echo "<tr><th>결제방식</th><td>신용카드 결제</td></tr>";
		if ($od[od_receipt_card]){
			echo "<tr><th>결제금액</th><td>" . display_amount($cd[cd_amount]) . "</td></tr>";
			echo "<tr><th>승인일시</th><td>$cd[cd_trade_ymd] $cd[cd_trade_hms]</td>";
			echo "<tr><th>승인번호</th><td>$cd[cd_app_no]</td>";

			if ($default[de_card_pg] == 'kcp') {
				// KCP 신용카드 영수증 출력 코드
				echo "<tr><th>영수증</th><td><a href='javascript:;' onclick=\"window.open('http://admin.kcp.co.kr/Modules/Sale/Card/ADSA_CARD_BILL_Receipt.jsp?c_trade_no=$od[od_escrow1]', 'winreceipt', 'width=620,height=670')\">영수증 출력</a></td></tr>"; 
			}
			else if ($default[de_card_pg] == 'dacom' || $default[de_card_pg] == 'dacom_xpay') {
				// LG텔레콤 신용카드 영수증 출력 코드
				echo "<script language=\"JavaScript\" src=\"http://pg.dacom.net/mert/pg/eCredit.js\"></script>";
				echo "<tr><th>영수증</th><td><a href=\"javascript:showReceipt('$default[de_dacom_mid]','$od[od_id]','service')\">카드영수증보기</a></td>";
			}
			else if ($default[de_card_pg] == 'inicis') {
				// 이니시스 신용카드 영수증 출력 코드
				echo "<tr><th>영수증</th><td><a href='javascript:;' onclick=\"javascript:window.open('https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=$od[od_escrow1]&noMethod=1', 'inicisReceipt', 'width=410,height=710')\">카드영수증보기</a></td>";
			}
			else if ($default[de_card_pg] == 'allthegate') {
				// 올더게이트 신용카드 영수증 출력 코드
				$send_dt = date("Ymd", strtotime($od[od_time]));
				echo "<tr><th>영수증</th><td><a href='javascript:;' onclick=\"javascript:window.open('http://www.allthegate.com/customer/receiptLast3.jsp?sRetailer_id=$default[de_allthegate_mid]&approve=$od[od_escrow1]&send_no=$od[od_id]&send_dt={$send_dt}', 'window', 'toolbar=no,location=no,directories=no,status=,menubar=no,scrollbars=no,resizable=no,width=420,height=700,top=0,left=150')\">카드영수증보기</a></td>";
			}
		}else if ($default[de_card_use]){
			$settle_amount = $od['od_temp_card'];
			echo "<tr><th>결제정보</th><td>아직 승인되지 않았거나 승인을 확인하지 못하였습니다.</td>";
			echo "<tr><td colspan=2 style='text-align:center; padding:5px;'>";
			if ((int)$member[mb_point] >= $od[od_temp_point]) {
				include "./settle_{$default[de_card_pg]}.inc.php";
				echo "<input type='image' src='$g4[shop_img_path]/btn_settle.gif' border=0 onclick='OpenWindow();'>";
			} else {
				echo "<font color=red>· 보유포인트가 모자라서 결제할 수 없습니다. 주문후 다시 결제하시기 바랍니다.</font>";
			}
			echo "</td></tr>";
		}
	}else{
		echo "<tr><th>결제방식</th><td>{$od['od_settle_case']}</td></tr>";
    
		if ($od[od_receipt_bank]) {
			echo "<tr><th>입금액</th><td>" . display_amount($od[od_receipt_bank]) . "</td></tr>";
			echo "<tr><th>입금확인일시</th><td>$od[od_bank_time]</td></tr>";
		}else{
			echo "<tr><th>입금액</th><td>아직 입금되지 않았거나 입금정보를 입력하지 못하였습니다.</td></tr>";
		}
	if ($od[od_settle_case] != '계좌이체')
		echo "<tr><th>계좌번호</th><td>$od[od_bank_account]</td></tr>";
    echo "<tr><th>입금자명</th><td>$od[od_deposit_name]</td></tr>";

		if ($od[od_receipt_bank] == 0){
			if ($od['od_settle_case'] == '계좌이체' && $default[de_iche_use]) {
				$settle_amount = $od['od_temp_bank'];
				echo "<tr><td colspan=2 style='text-align:center; padding:5px;'>";
				if ($member[mb_point] >= $od[od_temp_point]) {
					include "./settle_{$default[de_card_pg]}.inc.php";
					echo "<input type='image' src='$g4[shop_img_path]/btn_settle.gif' border=0 onclick='OpenWindow();'>";
				} else {
					echo "<font color=red>· 보유포인트가 모자라서 결제할 수 없습니다. 주문후 다시 결제하시기 바랍니다.</font>";
				}
				echo "</td></tr>";
			}
			if ($od['od_settle_case'] == '가상계좌' && $od['od_bank_account'] == '가상계좌' && $default[de_vbank_use]) {
				$settle_amount = $od['od_temp_bank'];
				echo "<tr><td colspan=2 style='text-align:center; padding:5px;'>";
				if ($member[mb_point] >= $od[od_temp_point]) {
					include "./settle_{$default[de_card_pg]}.inc.php";
					echo "<input type='image' src='$g4[shop_img_path]/btn_settle.gif' border=0 onclick='OpenWindow();'>";
				} else {
					echo "<font color=red>· 보유포인트가 모자라서 결제할 수 없습니다. 주문후 다시 결제하시기 바랍니다.</font>";
				}
				echo "</td></tr>";
			}
		}
	}

	if ($od[od_receipt_point] > 0) { 
		echo "<tr><th>포인트결제</th><td>" . display_point($od[od_receipt_point]) . "</td></tr>";
	} else if ($od[od_temp_point] > 0 && $member[mb_point] >= $od[od_temp_point]) {
		echo "<tr><th>포인트결제</th><td>" . display_point($od[od_temp_point]) . "</td></tr>";
	}

	if ($od[od_cancel_card] > 0) 
		echo "<tr><th>승인취소 금액</th><td>" . display_amount($od[od_cancel_card]) . "</td></tr>";

	if ($od[od_refund_amount] > 0)
		echo "<tr><th>환불 금액</th><td>" . display_amount($od[od_refund_amount]) . "</td></tr>";


	// 취소한 내역이 없다면
	if ($tot_cancel_amount == 0) {
		if (($od[od_temp_bank] > 0 && $od[od_receipt_bank] == 0) ||
			($od[od_temp_card] > 0 && $od[od_receipt_card] == 0)) {
			echo "<form method='post' action='./orderinquirycancel.php' style='margin:0;'>";
			echo "<input type=hidden name=od_id  value='$od[od_id]'>";
			echo "<input type=hidden name=on_uid value='$od[on_uid]'>";
			echo "<input type=hidden name=token  value='$token'>";
			echo "<tr><th>주문취소</th><td><a href='javascript:;' onclick=\"document.getElementById('_ordercancel').style.display='block';\">위의 주문을 취소합니다.</a></td></tr>";
			echo "<tr id='_ordercancel' style='display:none;'><th>취소사유</th><td><input type=text name='cancel_memo' class='inputbox' size=40 maxlength=100 required itemname='취소사유'>  <input type=submit value='확인'></td></tr>";
			echo "</form>";
		} else if ($od[od_invoice] == "") {
			echo "<tr><td colspan=2 style='color:blue;'>· 이 주문은 직접 취소가 불가하므로 상점에 전화 연락 후 취소해 주십시오.</td></tr>";
		}
	} else {
		$misu_amount = $misu_amount - $send_cost;
		echo "<tr><td colspan=2 style='color:red;'>· 주문 취소, 반품, 품절된 내역이 있습니다.</td></tr>";
	}

	// 현금영수증 발급을 사용하는 경우에만
	if ($default[de_taxsave_use]) { 
		if ($misu_amount == 0 && $od[od_receipt_bank]) { // 미수금이 없고 현금일 경우에만 현금영수증을 발급 할 수 있습니다.
			echo "<tr><th>현금영수증</th><td>";
			if ($default[de_card_pg] == 'kcp') {
				if ($od["od_cash"]) 
					echo "<a href=\"javascript:;\" onclick=\"window.open('https://admin.kcp.co.kr/Modules/Service/Cash/Cash_Bill_Common_View.jsp?cash_no=$od[od_cash_no]', 'taxsave_receipt', 'width=360,height=647,scrollbars=0,menus=0');\">현금영수증 확인하기</a>";
				else
					echo "<a href=\"javascript:;\" onclick=\"window.open('taxsave_kcp.php?od_id=$od_id&on_uid=$od[on_uid]', 'taxsave', 'width=550,height=400,scrollbars=1,menus=0');\">현금영수증을 발급하시려면 클릭하십시오.</a>";
			}else if ($default[de_card_pg] == 'tgcorp') {
				if ($od["od_cash"]) {
					echo "<script>function tgcorpBill(mxid, mxissueno, smode, billtype) { var url = \"https://npg.tgcorp.com/dlp/tgcorpbill.jsp?MxID=\"+mxid+\"&MxIssueNO=\"+mxissueno+\"&Smode=\"+smode+\"&BillType=\"+billtype; var win = window.open(url, \"tgcorp\", \"width=400,height=640,menubar=no,resizable=yes\"); if(win.focus) win.focus(); }</script>";
					echo "<a href=\"javascript:;\" onclick=\"tgcorpBill('{$default[de_tgcorp_mxid]}', '{$od[od_cash_tgcorp_mxissueno]}', '0001', '00');\">현금영수증 확인하기</a>";
				} 
				else {
					// "&a=a" 는 뒤의 ? 를 무력화하기 위해 넣었습니다
					echo "<a href=\"javascript:;\" onclick=\"window.open('$g4[shop_path]/taxsave_tgcorp.php?od_id=$od_id&on_uid=$od[on_uid]&redirpath=".urlencode($_SERVER[REQUEST_URI]."&a=a")."', 'TG_PAY', 'width=390,height=360,scrollbars=0,menus=0');\">현금영수증을 발급하시려면 클릭하십시오.</a>";
				}
			}else if ($default[de_card_pg] == 'allthegate') {
				if ($od["od_cash"]) {
					echo "<a href=\"javascript:;\" onclick=\"window.open('$g4[shop_path]/taxsave_allthegate_receipt.php?od_id=$od_id&on_uid=$od[on_uid]', 'allthegate_receipt', 'width=440,height=550,scrollbars=0,menus=0');\">현금영수증 확인하기</a>";
				} 
				else {
					echo "<a href=\"javascript:;\" onclick=\"window.open('$g4[shop_path]/taxsave_allthegate.php?od_id=$od_id&on_uid=$od[on_uid]', 'allthegate', 'width=440,height=550,scrollbars=0,menus=0');\">현금영수증을 발급하시려면 클릭하십시오.</a>";
				}
			}else if ($default[de_card_pg] == 'inicis') {
				if ($od["od_cash"]) {
					echo "<script>function showreceipt(tid) { var showreceiptUrl = 'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/Cash_mCmReceipt.jsp?noTid=' + tid + '&clpaymethod=22'; window.open(showreceiptUrl,'showreceipt','width=380,height=540, scrollbars=no,resizable=no'); } </script>";
					echo "<a href=\"javascript:;\" onclick=\"showreceipt('$od[od_cash_inicis_tid]');\">현금영수증 확인하기</a>";
				} 
				else {
					echo "<a href=\"javascript:;\" onclick=\"window.open('$g4[shop_path]/taxsave_inicis.php?od_id=$od_id&on_uid=$od[on_uid]', 'inicis', 'width=632,height=655,scrollbars=0,menus=0');\">현금영수증을 발급하시려면 클릭하십시오.</a>";
				}
			}else if ($default[de_card_pg] == 'dacom' || $default[de_card_pg] == 'dacom_xpay') {
				if ($od["od_cash"]) {
					if (preg_match("/^tsi_/", $default[de_dacom_mid])) {
						echo "<script>function showreceipt(tid) { var showreceiptUrl = 'http://pg.dacom.net:7080/transfer/cashreceipt.jsp?orderid=$od[od_id]&mid=$default[de_dacom_mid]&servicetype=SC0100'; window.open(showreceiptUrl,'showreceipt','menubar=0,toolbar=0,scrollbars=no,width=380,height=600,resize=1,left=252,top=116'); } </script>";
					} else {
						echo "<script>function showreceipt(tid) { var showreceiptUrl = 'http://pg.dacom.net/transfer/cashreceipt.jsp?orderid=$od[od_id]&mid=$default[de_dacom_mid]&servicetype=SC0100'; window.open(showreceiptUrl,'showreceipt','menubar=0,toolbar=0,scrollbars=no,width=380,height=600,resize=1,left=252,top=116'); } </script>";
					}
					echo "<a href=\"javascript:;\" onclick=\"showreceipt('$od[od_cash_receiptnumber]');\">현금영수증 확인하기</a>"; // od_cash_receiptnumber 는 실제 사용하지 않으므로 의미 없음
				} 
				else {
					echo "<a href=\"javascript:;\" onclick=\"window.open('$g4[shop_path]/taxsave_dacom.php?od_id=$od_id&on_uid=$od[on_uid]', 'dacom', 'width=632,height=655,scrollbars=0,menus=0');\">현금영수증을 발급하시려면 클릭하십시오.</a>";
				}
			}
		}
	}

	?> 
</table>

<div style="padding:10px; margin:10px 0; border:1px solid #AAA; text-align:right; font-weight:bold; line-height:20px">
결제 합계 : <span style="color:#06F;"><?=$wanbul ?> <?=display_amount($receipt_amount) ?></span><br>
<? if ($od[od_dc_amount] > 0) echo display_amount($od[od_dc_amount])."<br>" ?>
<? if ($misu_amount > 0) echo "아직 결제하지 않으신 금액 : <span style='color:#A00' >".display_amount($misu_amount)."</span>"?>
</div>

 

<?
include_once("./_tail.php");
?>
