<?
include_once("./_common.php");

// 장바구니가 비어있는가?
$tmp_on_uid = get_session('ss_temp_on_uid');
if (get_cart_count($tmp_on_uid) == 0)// 장바구니에 담기
    alert("장바구니가 비어 있습니다.\\n\\n이미 주문하셨거나 장바구니에 담긴 상품이 없는 경우입니다.", "./cart.php");

$sql = " select * from $g4[yc4_order_table] where on_uid = '$tmp_on_uid' ";
$od = sql_fetch($sql);

//print_r2($od);

$g4[title] = "주문 및 결제완료";

include_once("./_head.php");

// 상품명만들기
$sql = " select a.it_id, b.it_name 
           from $g4[yc4_cart_table] a, $g4[yc4_item_table] b
          where a.it_id = b.it_id 
            and a.on_uid = '$tmp_on_uid' 
          order by ct_id
          limit 1 ";
$row = sql_fetch($sql);
?>

<div class="page_title" style="text-align:center ; "><img src="<?=$g4[shop_img_path]?>/top_orderconfirm.gif" border=0></div>

<?
$s_page = '';
$s_on_uid = $tmp_on_uid;
$od_id = $od[od_id];
include_once("./cartsub.inc.php");
?>

<div style="padding:10px; font:bold 13px/20px Gulim;">&lt;!&gt; 주문번호: <span style=" COLOR:#D60B69"><?=$od[od_id]?></span></div>
 
<!-- 주문하시는 분 -->
<table class="table_style3">
	<caption>주문자정보</caption>
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
	<? if ($default[de_hope_date_use]) {// 희망배송일 사용한다면?>
	<tr>
		<th>희망배송일</th>
		<td><?=$od[od_hope_date]?> (<?=get_yoil($od[od_hope_date])?>)</td>
	</tr> 
	<?}?>
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
	<? if($od[od_memo]){?>
	<tr>
		<th>전하실말씀</th>
		<td style="word-break:break-all;"><?=nl2br(htmlspecialchars2($od[od_memo])); ?></td>
	</tr>
	<?}?>
</table>

<!-- 결제 정보 -->
<table class="table_style3">
	<caption>결제정보</caption>
	<? if ($od[od_receipt_point] > 0) { ?>
	<tr>
		<th>포인트결제</th>
		<td><? echo display_point($od[od_receipt_point]) ?></td>
	</tr>
	<? } ?>

	<? if ($od['od_temp_bank'] > 0) { ?>
	<tr>
		<th><?=$od[od_settle_case]?></th>
		<td><? echo display_amount($od[od_temp_bank]) ?>  (결제하실 금액)</td>
	</tr>
	<? if ($od[od_settle_case] == '무통장') { ?>
	<tr>
		<th>계좌번호</th>
		<td><? echo $od[od_bank_account]; ?></td>
	</tr>
	<? } ?>
	<tr>
		<th>입금자 이름</th>
		<td><? echo $od[od_deposit_name]; ?></td>
	</tr>
	<? } ?>

	<? if ($od[od_temp_card] > 0) { ?>
	<tr>
		<th>신용카드</th>
		<td><? echo display_amount($od[od_temp_card]) ?> (결제하실 금액)</td>
	</tr>
	<? } ?>
 </table>
 

<?
/*
if ($od[od_temp_card]) 
{
    include "./ordercard{$default[de_card_pg]}.inc.php";
    echo "<p align=center><input type='image' src='$g4[shop_img_path]/btn_card.gif' border=0 onclick='OpenWindow();'></p>";
    echo "<p align=left>&nbsp; &middot; 결제가 제대로 되지 않은 경우 <a href='./orderinquiryview.php?od_id=$od[od_id]&on_uid=$od[on_uid]'><u>주문상세조회 페이지</u></a>에서 다시 결제하실 수 있습니다.</p>";
} 
else if ($od[od_temp_bank] && $od[od_bank_account] == "실시간 계좌이체")  
{
    include "./orderiche{$default[de_card_pg]}.inc.php";
    echo "<p align=center><input type='image' src='$g4[shop_img_path]/btn_iche.gif' border=0 onclick='OpenWindow();'></p>";
    echo "<p align=left>&nbsp; &middot; 결제가 제대로 되지 않은 경우 [<a href='./orderinquiryview.php?od_id=$od[od_id]&on_uid=$od[on_uid]'><u>주문상세조회 페이지</u></a>] 에서 다시 결제하실 수 있습니다.</p>";
} 
else 
{
    //echo "<a href='$g4[path]'><img src='$g4[shop_img_path]/btn_confirm3.gif' border=0 align=absmiddle></a>";
    //echo "주문이 완료 되었습니다. 입금 확인 후 배송하도록 하겠습니다. 감사합니다.";
    echo "<p align=center><a href='{$g4[path]}'><img src='{$g4[shop_img_path]}/btn_order_end.gif' border=0></a>";
}
*/
?>
<? 
// 파일이 존재한다면 ...
if (file_exists("./settle_{$default[de_card_pg]}.inc.php")) 
{
    $settle_case = $od['od_settle_case'];
    if ($settle_case == '')
    {
        echo "*** 결제방법 없음 오류 ***";
    }
    else if ($settle_case == '무통장')
    {
        echo "<div class='order_confirm'><p>주문이 완료 되었습니다.</p><a href='./orderinquiryview.php?od_id=$od[od_id]&on_uid=$od[on_uid]'> 입금을 확인한 후 배송하도록 하겠습니다.</br>주문해 주셔서 감사합니다.</a></div>";
    }
    else 
    {
        if ($settle_case == '신용카드')
            $settle_amount = $od['od_temp_card'];
        else
            $settle_amount = $od['od_temp_bank'];

        include "./settle_{$default[de_card_pg]}.inc.php";
        echo "<div class='btn_div'><input type='image' src='$g4[shop_img_path]/btn_settle.gif' border=0 onclick='OpenWindow();'></div>";
        echo "<div class='settle_text'>결제가 제대로 되지 않은 경우 [<a href='./orderinquiryview.php?od_id=$od[od_id]&on_uid=$od[on_uid]'>주문상세조회 페이지</a>] 에서 다시 결제하실 수 있습니다.</div>";
    }
}
else
{
    if ($od[od_temp_card]) {
        include "./ordercard{$default[de_card_pg]}.inc.php";
        echo "<div class='btn_div'><input type='image' src='$g4[shop_img_path]/btn_card.gif' border=0 onclick='OpenWindow();'></div>";
        echo "<div class='settle_text'>결제가 제대로 되지 않은 경우 [<a href='./orderinquiryview.php?od_id=$od[od_id]&on_uid=$od[on_uid]'>주문상세조회 페이지</a>]에서 다시 결제하실 수 있습니다.</div>";
    } else if ($od[od_temp_bank] && $od[od_bank_account] == "계좌이체")  {
        include "./orderiche{$default[de_card_pg]}.inc.php";
        echo "<div class='btn_div'><input type='image' src='$g4[shop_img_path]/btn_iche.gif' border=0 onclick='OpenWindow();'></div>";
        echo "<div class='settle_text'>결제가 제대로 되지 않은 경우 [<a href='./orderinquiryview.php?od_id=$od[od_id]&on_uid=$od[on_uid]'>주문상세조회 페이지</a>] 에서 다시 결제하실 수 있습니다.</div>";
    } else {
        echo "<div class='order_confirm'><p>주문이 완료 되었습니다.</p><a href='{$g4[path]}'>입금을 확인한 후 배송하도록 하겠습니다.</br>주문해 주셔서 감사합니다.</a></div>";
    }
}
?>
<br><br>

<?
include_once("./_tail.php");
?>
