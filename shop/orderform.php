<?
include_once("./_common.php");

// 장바구니가 비어있는가?
$tmp_on_uid = get_session('ss_on_uid');
if (get_cart_count($tmp_on_uid) == 0) 
    alert("장바구니가 비어 있습니다.", "./cart.php");

// 포인트 결제 대기 필드 추가
//sql_query(" ALTER TABLE `$g4[yc4_order_table]` ADD `od_temp_point` INT NOT NULL AFTER `od_temp_card` ", false);

$g4[title] = "주문서 작성";

include_once("./_head.php");
?>

<div class="page_title" style="text-align:center ; "><img src="<?=$g4[shop_img_path]?>/top_orderform.gif" border="0"></div>

<?
$s_page = 'orderform.php';
$s_on_uid = $tmp_on_uid;
include_once("./cartsub.inc.php");
?>

<form name=forderform method=post action="./orderreceipt.php" onsubmit="return forderform_check(this);" autocomplete=off>
<input type=hidden name=od_amount    value='<?=$tot_sell_amount?>'>
<input type=hidden name=od_send_cost value='<?=$send_cost?>'>

<!-- 주문자정보 -->
<table class="table_style3">
	<caption>주문자정보</caption>
	<tr>
		<th>이름</th>
		<td><input type=text id=od_name name=od_name value='<?=$member[mb_name]?>' maxlength=20 class=inputbox></td>
	</tr>
	<? if (!$is_member) { // 비회원이면 ?>
	<tr>
		<th>비밀번호</th>
		<td><input type=password name=od_pwd class=inputbox maxlength=20> <span>영,숫자 3~20자 (주문서 조회시 필요)</span></td>
	</tr>
	<?}?>
	<tr>
		<th>전화번호</th>
		<td><input type=text name=od_tel value='<?=$member[mb_tel]?>' maxlength=20 class=inputbox></td>
	</tr>
	<tr>
		<th>핸드폰</th>
		<td><input type=text name=od_hp value='<?=$member[mb_hp]?>' maxlength=20 class=inputbox></td>
	</tr>
	<tr>
		<th>주소</th>
		<td><input type=text name=od_zip1 size=3 maxlength=3 value='<?=$member[mb_zip1]?>' class=inputbox readonly>
                -
			  <input type=text name=od_zip2 size=3 maxlength=3 value='<?=$member[mb_zip2]?>' class=inputbox readonly>
			  <a href="javascript:;" onclick="win_zip('forderform', 'od_zip1', 'od_zip2', 'od_addr1', 'od_addr2');"><img 
                    src="<?=$g4[shop_img_path]?>/btn_zip_find.gif"></a>
			  <p><input type=text name=od_addr1 size=35 maxlength=50 value='<?=$member[mb_addr1]?>' class=inputbox readonly> <input type=text name=od_addr2 size=20 maxlength=50 value='<?=$member[mb_addr2]?>' class=inputbox> (상세주소)</p>
			  </td>
	</tr>
	<tr>
		<th>E-mail</th>
		<td><input type=text name=od_email size=35 maxlength=100 value='<?=$member[mb_email]?>' class=inputbox></td>
	</tr>
	<? if ($default[de_hope_date_use]) { // 배송희망일 사용 ?>
	<tr>
		<th>희망배송일</th>
		<td><select name=od_hope_date>
                <option value=''>선택하십시오.
                <? 
                for ($i=0; $i<7; $i++) {
                    $sdate = date("Y-m-d", time()+86400*($default[de_hope_date_after]+$i));
                    echo "<option value='$sdate'>$sdate (".get_yoil($sdate).")\n";
                }
                ?>
                </select></td>
	</tr>
	<? } ?>
</table>

 
<!-- 배송지정보 -->

<table class="table_style3">
	<caption>배송지정보 </caption>
	<tr>
		<th></th>
		<td><input type=checkbox id=same name=same onclick="javascript:gumae2baesong(document.forderform);">
		<label for='same'>주문자정보와 배송지정보가 동일한 경우 체크하세요.</label></td>
	</tr>
	<tr>
		<th>이름</th>
		<td><input type=text name=od_b_name class=inputbox maxlength=20></td>
	</tr>
	<tr>
		<th>전화번호</th>
		<td><input type=text name=od_b_tel class=inputbox maxlength=20></td>
	</tr>
	<tr>
		<th>핸드폰</th>
		<td><input type=text name=od_b_hp class=inputbox maxlength=20></td>
	</tr>
	<tr>
		<th>주 소</th>
		<td><input type=text name=od_b_zip1 size=3 maxlength=3 class=inputbox readonly>
                -
                <input type=text name=od_b_zip2 size=3 maxlength=3 class=inputbox readonly>
                <a href="javascript:;" onclick="win_zip('forderform', 'od_b_zip1', 'od_b_zip2', 'od_b_addr1', 'od_b_addr2');"><img 
                    src="<?=$g4[shop_img_path]?>/btn_zip_find.gif" border="0" align=absmiddle></a>
                </a>
                <p><input type=text name=od_b_addr1 size=35 maxlength=50 class=inputbox readonly>
                <input type=text name=od_b_addr2 size=20 maxlength=50 class=inputbox> (상세주소)</p>
		</td>
	</tr>
	<tr>
		<th>전하실말씀</th>
		<td><textarea name=od_memo rows=4 class="textareabox"></textarea></td>
	</tr>
</table> 


<!-- 결제 정보 -->

<table class="table_style3">
	<caption>결제정보</caption>
	<tr>
		<th>결제방법 선택</th>
		<td> <?
                $multi_settle == 0;
                $checked = "";

                // 무통장입금 사용
                if ($default[de_bank_use]) {
                    $multi_settle++;
                    echo "<input type='radio' id=od_settle_bank name='od_settle_case' value='무통장' $checked><label for='od_settle_bank'>무통장입금</label>";
                    $checked = "";
                }

                // 가상계좌 사용
                if ($default[de_vbank_use]) {
                    $multi_settle++;
                    echo "<input type='radio' id=od_settle_vbank name=od_settle_case value='가상계좌' $checked><label for='od_settle_vbank'>가상계좌</label>";
                    $checked = "";
                }

                // 계좌이체 사용
                if ($default[de_iche_use]) {
                    $multi_settle++;
                    echo "<input type='radio' id=od_settle_iche name=od_settle_case value='계좌이체' $checked><label for='od_settle_iche'>계좌이체</label>";
                    $checked = "";
                }

                // 신용카드 사용
                if ($default[de_card_use]) {
                    $multi_settle++;
                    echo "<input type='radio' id=od_settle_card name=od_settle_case value='신용카드' $checked><label for='od_settle_card'>신용카드</label>";
                    $checked = "";
                }

                // 회원이면서 포인트사용이면
                if ($is_member && $config[cf_use_point]) 
                {
                    // 포인트 결제 사용 포인트보다 회원의 포인트가 크다면
                    if ($member[mb_point] >= $default[de_point_settle])
                    {
                        $temp_point = $tot_amount * ($default[de_point_per] / 100); // 포인트 결제 % 적용
                        $temp_point = (int)((int)($temp_point / 100) * 100); // 100점 단위

                        $member_point = (int)((int)($member[mb_point] / 100) * 100); // 100점 단위
                        if ($temp_point > $member_point) 
                            $temp_point = $member_point;

                        echo "<div style='margin-top:10px;'><input type=checkbox id=od_temp_point name=od_temp_point value='$temp_point' checked>";
                        echo "<label for='od_temp_point'>보유포인트 ".display_point($temp_point)." 사용 : 주문금액의 {$default[de_point_per]}% 내에서 포인트 결제가 가능합니다.</label></div>";
                        $multi_settle++;
                    }
                }

                if ($multi_settle == 0)
                    echo "<p>결제할 방법이 없습니다. </p>";

                if (!$default[de_card_point])
                    echo "<p>· '무통장입금' 이외의 결제 수단으로 결제하시는 경우 포인트를 적립해드리지 않습니다.</p>";
                ?></td>
	</tr>
</table>

 

	<div class="btn_div">
		<input type="image" src="<?=$g4[shop_img_path]?>/btn_next2.gif" border=0 alt="다음">
		<a href='javascript:history.go(-1);'><img src="<?=$g4[shop_img_path]?>/btn_back1.gif" alt="뒤로" border=0></a>
	</div>
</form>

<!-- <? if ($default[de_card_use] || $default[de_iche_use]) { echo "결제대행사 : $default[de_card_pg]"; } ?> -->
 
<script language='javascript'>
function forderform_check(f) 
{
    errmsg = "";
    errfld = "";
    var deffld = "";

    check_field(f.od_name, "주문하시는 분 이름을 입력하십시오.");
    if (typeof(f.od_pwd) != 'undefined')
    {
        clear_field(f.od_pwd);
        if( (f.od_pwd.value.length<3) || (f.od_pwd.value.search(/([^A-Za-z0-9]+)/)!=-1) )
            error_field(f.od_pwd, "회원이 아니신 경우 주문서 조회시 필요한 비밀번호를 3자리 이상 입력해 주십시오.");
    }
    check_field(f.od_tel, "주문하시는 분 전화번호를 입력하십시오.");
    check_field(f.od_addr1, "우편번호 찾기를 이용하여 주문하시는 분 주소를 입력하십시오.");
    check_field(f.od_addr2, " 주문하시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_zip1, "");
    check_field(f.od_zip2, "");

    clear_field(f.od_email);
    if(f.od_email.value=='' || f.od_email.value.search(/(\S+)@(\S+)\.(\S+)/) == -1)
        error_field(f.od_email, "E-mail을 바르게 입력해 주십시오.");

    if (typeof(f.od_hope_date) != "undefined") 
    {
        clear_field(f.od_hope_date);
        if (!f.od_hope_date.value) 
            error_field(f.od_hope_date, "희망배송일을 선택하여 주십시오.");
    }

    check_field(f.od_b_name, "받으시는 분 이름을 입력하십시오.");
    check_field(f.od_b_tel, "받으시는 분 전화번호를 입력하십시오.");
    check_field(f.od_b_addr1, "우편번호 찾기를 이용하여 받으시는 분 주소를 입력하십시오.");
    check_field(f.od_b_addr2, "받으시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_b_zip1, "");
    check_field(f.od_b_zip2, "");

    // 배송비를 받지 않거나 더 받는 경우 아래식에 + 또는 - 로 대입
    f.od_send_cost.value = parseInt(f.od_send_cost.value);

    if (errmsg) 
    {
        alert(errmsg);
        errfld.focus();
        return false;
    }

    var settle_case = document.getElementsByName("od_settle_case");
    var settle_check = false;
    for (i=0; i<settle_case.length; i++)
    {
        if (settle_case[i].checked)
        {
            settle_check = true;
            break;
        }
    }
    if (!settle_check)
    {
        alert("결제방식을 선택하십시오.");
        return false;
    }

    return true;
}

// 구매자 정보와 동일합니다.
function gumae2baesong(f)
{
	if(f.same.checked == true){
		f.od_b_name.value = f.od_name.value;
		f.od_b_tel.value  = f.od_tel.value;
		f.od_b_hp.value   = f.od_hp.value;
		f.od_b_zip1.value = f.od_zip1.value;
		f.od_b_zip2.value = f.od_zip2.value;
		f.od_b_addr1.value = f.od_addr1.value;
		f.od_b_addr2.value = f.od_addr2.value;
	}else{
		f.od_b_name.value = "";
		f.od_b_tel.value  = "";
		f.od_b_hp.value   = "";
		f.od_b_zip1.value = "";
		f.od_b_zip2.value = "";
		f.od_b_addr1.value = "";
		f.od_b_addr2.value = "";
	}
}
</script>

<?
include_once("./_tail.php");
?>