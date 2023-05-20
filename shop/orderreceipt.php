<?
include_once("./_common.php");

function proc_quot($str)
{
    return preg_replace('/\"/', "&quot;", stripslashes($str));
}

session_check();

// 장바구니가 비어있는가?
$tmp_on_uid = get_session('ss_on_uid');
if (get_cart_count($tmp_on_uid) == 0) 
    alert("장바구니가 비어 있습니다.", "./cart.php");

// 희망배송일 사용한다면
if ($default[de_hope_date_use])
{
    ereg("([0-9]{4})-([0-9]{2})-([0-9]{2})", $od_hope_date, $hope_date);
    if ($od_hope_date == "") ; // 통과
    else if (checkdate($hope_date[2], $hope_date[3], $hope_date[1]) == false)
        alert("희망배송일을 올바르게 입력해 주십시오.");
    else if ($od_hope_date < date("Y-m-d", time()+86400*$default[de_hope_date_after]))
        alert("희망배송일은 오늘부터 {$default[de_hope_date_after]}일 후 부터 입력해 주십시오.");
}

// 회원 로그인 중이라면 회원비밀번호를 주문서에 넣어줌
if ($is_member)
    $od_pwd = $mb[mb_pwd];
else
    $od_pwd = sql_password($od_pwd);

$g4[title] = "주문확인 및 결제";

include_once("./_head.php");
?>

<div class="page_title" style="text-align:center ; "><img src="<?=$g4[shop_img_path]?>/top_orderreceipt.gif" border="0"></div>

<?
$s_page = '';
$s_on_uid = $tmp_on_uid;
include_once("./cartsub.inc.php");
?>


<div style="padding:10px; font:bold 13px/20px Gulim;">&lt;!&gt; 입력하신 내용이 맞는지 다시 한번 확인하여 주십시오.</div>

<!-- 주문하시는 분 -->
<table class="table_style3">
	<caption>주문자정보</caption>
	<tr>
		<th>이름</th>
		<td><?=proc_quot($od_name) ?></td>
	</tr>
	<tr>
		<th>전화번호</th>
		<td><?=$od_tel ?></td>
	</tr>
	<tr>
		<th>핸드폰</th>
		<td><?=$od_hp ?></td>
	</tr>
	<tr>
		<th>주소</th>
		<td><?=sprintf("(%s-%s) %s %s", $od_zip1, $od_zip2, $od_addr1, $od_addr2); ?></td>
	</tr>
	<tr>
		<th>E-mail</th>
		<td><?=$od_email ?></td>
	</tr>
	<?
        if ($default[de_hope_date_use]) {// 희망배송일 사용한다면
            echo "
	<tr>
		<th>희망배송일</th>
		<td>$od_hope_date (".get_yoil($od_hope_date).")</td>
	</tr> ";
	}?>
</table>


<!-- 받으시는 분 -->
<table class="table_style3">
	<caption>배송지정보</caption>
	<tr>
		<th>이름</th>
		<td><?=proc_quot($od_b_name); ?></td>
	</tr>
	<tr>
		<th>전화번호</th>
		<td><?=$od_b_tel ?></td>
	</tr>
	<tr>
		<th>핸드폰</th>
		<td><?=$od_b_hp ?></td>
	</tr>
	<tr>
		<th>주소</th>
		<td><?=sprintf("(%s-%s) %s %s", $od_b_zip1, $od_b_zip2, $od_b_addr1, $od_b_addr2); ?></td>
	</tr>
	<? if(stripslashes($od_memo)){?>
	<tr>
		<th>전하실말씀</th>
		<td style="word-break:break-all;"><?=htmlspecialchars2(stripslashes($od_memo)) ?></td>
	</tr>
	<?}?>
</table>


 

<!-- 결제 정보 -->
<form name=frmorderreceipt method=post action='./orderupdate.php' onsubmit="return frmorderreceipt_check(this)" autocomplete="off">
        <input type=hidden name=de_card_point value="<? echo $default[de_card_point] ?>">
        <input type=hidden name=od_settle_case value="<? echo $od_settle_case ?>">
        <input type=hidden name=od_amount    value="<? echo $tot_sell_amount ?>">
        <input type=hidden name=od_send_cost value="<? echo $od_send_cost ?>">
        <input type=hidden name=od_name      value="<? echo proc_quot($od_name) ?>">
        <input type=hidden name=od_pwd       value="<? echo $od_pwd ?>">
        <input type=hidden name=od_tel       value="<? echo $od_tel ?>">
        <input type=hidden name=od_hp        value="<? echo $od_hp ?>">
        <input type=hidden name=od_zip1      value="<? echo $od_zip1 ?>">
        <input type=hidden name=od_zip2      value="<? echo $od_zip2 ?>">
        <input type=hidden name=od_addr1     value="<? echo $od_addr1 ?>">
        <input type=hidden name=od_addr2     value="<? echo $od_addr2 ?>">
        <input type=hidden name=od_email     value="<? echo $od_email ?>">
        <input type=hidden name=od_b_name    value="<? echo proc_quot($od_b_name) ?>">
        <input type=hidden name=od_b_tel     value="<? echo $od_b_tel ?>">
        <input type=hidden name=od_b_hp      value="<? echo $od_b_hp ?>">
        <input type=hidden name=od_b_zip1    value="<? echo $od_b_zip1 ?>">
        <input type=hidden name=od_b_zip2    value="<? echo $od_b_zip2 ?>">
        <input type=hidden name=od_b_addr1   value="<? echo $od_b_addr1 ?>">
        <input type=hidden name=od_b_addr2   value="<? echo $od_b_addr2 ?>">
        <input type=hidden name=od_hope_date value="<? echo $od_hope_date ?>">
        <input type=hidden name=od_memo      value="<? echo htmlspecialchars2(stripslashes($od_memo)) ?>">
        <input type=hidden name=od_settle_amount value='<?=$tot_amount?>'>
<table class="table_style3">
	<caption>결제정보</caption>
	<tr>
		<th>결제금액</th>
		<td><?=number_format($tot_amount)?></td>
	</tr>
	<? if ($od_temp_point != "") {?>
	<tr>
		<th>포인트결제</th>
		<td><?=display_point($od_temp_point)?><input type=hidden name=od_temp_point value='<?=$od_temp_point?>'></td>
	</tr>
	<?}?>
	<?
	$receipt_amount = $tot_amount - $od_temp_point;

        if ($od_settle_case == "무통장") 
        {
            // 은행계좌를 배열로 만든후
            $str = explode("\n", $default[de_bank_account]);
            if (count($str) <= 1)
            {
                $bank_account = "<input type=hidden name='od_bank_account' value='$str[0]'>$str[0]\n";
            }
            else 
            {
                $bank_account = "\n<select name=od_bank_account class=selectbox>\n";
                $bank_account .= "<option value=''>--------------- 선택하십시오 ---------------\n";
                for ($i=0; $i<count($str); $i++)
                {
                    $str[$i] = str_replace("\r", "", $str[$i]);
                    $bank_account .= "<option value='$str[$i]'>$str[$i] \n";
                }
                $bank_account .= "</select> ";
            }

            echo "<input type=hidden name=od_receipt_bank value='$receipt_amount'>";
            echo "<tr><th>무통장입금액</th><td>".number_format($receipt_amount)." (결제하실 금액)</td></tr>";
            echo "<tr><th>계좌번호</th><td>$bank_account</td></tr>";
            echo "<tr><th>입금자 이름</th><td><input type=text name=od_deposit_name class=inputbox size=10 maxlength=20 value=\"".proc_quot($od_name)."\"> (주문하시는분과 입금자가 다를 경우)</td></tr>";
            $receipt_amount = 0;
        }
		
        if ($od_settle_case == "가상계좌") 
        {
            $border_style = "";
            if ($od_receipt_bank == "") $border_style = " border-style:none;";
            echo "<input type=hidden name=od_bank_account value='가상계좌'>";
            echo "<input type=hidden name=od_deposit_name value='$od_name'>";
            echo "<input type=hidden name=od_receipt_bank value='$receipt_amount'>";
            echo "<tr><th>가상계좌</th><td>".number_format($receipt_amount)." (결제하실 금액)</td></tr>";
            $receipt_amount = 0;
        }
        if ($od_settle_case == "계좌이체") 
        {
            $border_style = "";
            if ($od_receipt_bank == "") $border_style = " border-style:none;";
            echo "<input type=hidden name=od_bank_account value='계좌이체'>";
            echo "<input type=hidden name=od_deposit_name value='$od_name'>";
            echo "<input type=hidden name=od_receipt_bank value='$receipt_amount'>";
            echo "<tr><th>계좌이체</th><td>".number_format($receipt_amount)." (결제하실 금액)</td></tr>";
            $receipt_amount = 0;
        }
        if ($od_settle_case == "신용카드") 
        {
            $border_style = "";
            if ($od_receipt_bank == "") $border_style = " border-style:none;";
            echo "<input type=hidden name=od_receipt_card value='$receipt_amount'>";
            echo "<tr><th>신용카드</th><td>".number_format($receipt_amount)." (결제하실 금액)</td></tr>";
            $receipt_amount = 0;
        }
	?>
</table>

 
<div class="btn_div">
    <span id='id_submit'>
    <a href="javascript:frmorderreceipt_check(document.frmorderreceipt);"><img src='<?=$g4[shop_img_path]?>/btn_next2.gif' border=0 title='다음'></a>&nbsp;&nbsp;&nbsp;
    <a href="javascript:history.go(-1);"><img src="<?=$g4[shop_img_path]?>/btn_back1.gif" border=0 title="뒤로"></a>
    </span>
    <span id='id_saving' style='display:none;'><img src='<?=$g4[shop_img_path]?>/saving.gif' border=0></span>
</div>
</form>

<script language='javascript'>
function frmorderreceipt_check(f) 
{
    errmsg = "";
    errfld = "";

    settle_amount = parseFloat(f.od_amount.value) + parseFloat(f.od_send_cost.value);
    od_receipt_bank = 0;
    od_receipt_card = 0;
    od_temp_point = 0;

    if (typeof(f.od_temp_point) != 'undefined')
    {
        od_temp_point = parseFloat(no_comma(f.od_temp_point.value));
        if (od_temp_point > 0)
        {
            /*
            // 포인트 최소 결제점수
            if (od_temp_point < <?=(int)($default[de_point_settle] * $default[de_point_per] / 100)?>)
            {
                //alert("포인트 결제액은 <?=display_point($default[de_point_settle])?> 이상 가능합니다.");
                alert("포인트 결제액은 <?=display_point($default[de_point_settle] * $default[de_point_per] / 100)?> 이상 가능합니다.");
                return;
            // 가지고 있는 포인트 보다 많이 입력했다면
            } 
            else 
            */
            if (od_temp_point > <? echo (int)$od_temp_point ?>) 
            {
                alert("포인트 결제액은 <? echo display_point($od_temp_point) ?> 까지 가능합니다.");
                return;
            }
        }
    }

    if (typeof(f.od_receipt_card) != 'undefined')
    {
        od_receipt_card = parseFloat(no_comma(f.od_receipt_card.value));
        if (od_receipt_card < <?=(int)($default[de_card_max_amount])?>)
        {
            alert("신용카드 결제액은 <?=number_format($default[de_card_max_amount])?> 이상 가능합니다.");
            return;
        }
    }

    if (typeof(f.od_receipt_bank) != 'undefined')
    {
        od_receipt_bank = parseFloat(no_comma(f.od_receipt_bank.value));
        if (f.od_bank_account.value == "" && od_receipt_bank > 0)
        {
            alert("무통장으로 입금하실 은행 계좌번호를 선택해 주십시오.");
            f.od_bank_account.focus();
            return;
        }

        if (f.od_deposit_name.value.length < 2)
        {
            alert("입금자분 이름을 입력해 주십시오.");
            f.od_deposit_name.focus();
            return;
        }
    }

    sum = od_receipt_bank + od_receipt_card + od_temp_point;
    if (settle_amount != sum)
    {
        alert("입력하신 입금액 합계와 결제금액이 같지 않습니다.");
        return;
    }

    // 음수일 경우 오류
    if (od_temp_point < 0 || od_receipt_card < 0 || od_receipt_bank < 0)
    {
        alert("금액은 음수가 될 수 없습니다.");
        return;
    }

    str_card = "";
    str = "총 결제하실 금액 " + number_format(f.od_settle_amount.value) + "원 중에서\n\n";
    if (typeof(f.od_temp_point) != 'undefined')
        str += "포인트 : " + number_format(f.od_temp_point.value) + "점\n\n";
    if (typeof(f.od_receipt_card) != 'undefined')
    {
        str += "신용카드 : " + number_format(f.od_receipt_card.value) + "원\n\n";
        if (parseFloat(f.od_receipt_card.value) > 0)
        {
            // 카드, 계좌이체 결제시 포인트부여 여부
            if (!f.de_card_point.value)
                str_card += "\n\n---------------------------------------\\n\\n카드, 계좌이체 결제시 적립포인트는 부여하지 않습니다.";
         }
    }
    if (typeof(f.od_receipt_bank) != 'undefined')
        str += "<?=$od_settle_case?> : " + number_format(f.od_receipt_bank.value) + "원\n\n";
    str += "으로 주문 하셨습니다.\n\n"+
           "금액이 올바른지 확인해 주십시오."+str_card;


    sw_submit = confirm(str);
    if (sw_submit == false)
        return;

    document.getElementById('id_submit').style.display = 'none';
    document.getElementById('id_saving').style.display = '';

    f.submit();
}

function compute_amount(f, fld)
{
    x = no_comma(fld.value);
    if (isNaN(x))
    {
        alert("숫자가 아닙니다.");
        fld.value = fld.defaultValue;
        fld.focus();
        return;
    }
    else if (x == "")
        x = 0;
    x = parseFloat(x);
    
    // 100점 미만 버림
    if (fld.name == "od_temp_point") {
        x = parseInt(x / 100) * 100;
    }

    fld.value = number_format(String(x));

    settle_amount = parseFloat(f.od_amount.value) + parseFloat(f.od_send_cost.value);

    od_receipt_bank = 0;
    od_receipt_card = 0;
    od_temp_point = 0;

    if (typeof(f.od_receipt_bank) != 'undefined')
        od_receipt_bank = parseFloat(no_comma(f.od_receipt_bank.value));

    if (typeof(f.od_receipt_card) != 'undefined')
        od_receipt_card = parseFloat(no_comma(f.od_receipt_card.value));

    if (typeof(f.od_temp_point) != 'undefined')
        od_temp_point   = parseFloat(no_comma(f.od_temp_point.value));

    sum = od_receipt_bank + od_receipt_card + od_temp_point;

    // 입력합계금액이 결제금액과 같지 않다면
    if (sum != settle_amount)
    {
        if (fld.name == 'od_temp_point')
        {
            if (typeof(f.od_receipt_bank) != 'undefined')
            {
                od_receipt_bank = settle_amount - (od_temp_point + od_receipt_card);
                f.od_receipt_bank.value = number_format(String(od_receipt_bank));
            }
            else if (typeof(f.od_receipt_card) != 'undefined')
            {
                od_receipt_card = settle_amount - (od_temp_point + od_receipt_bank);
                f.od_receipt_card.value = number_format(String(od_receipt_card));
            }
            else
            {
                f.od_temp_point.value = number_format(String(od_temp_point));
            }
        } 
        else if (fld.name == 'od_receipt_card')
        {
            if (typeof(f.od_receipt_bank) != 'undefined')
            {
                od_receipt_bank = settle_amount - (od_temp_point + od_receipt_card);
                f.od_receipt_bank.value = number_format(String(od_receipt_bank));
            }
            else
            {
                f.od_receipt_card.value = number_format(String(od_receipt_card));
            }
        }
        else if (fld.name == 'od_receipt_bank')
        {
            if (typeof(f.od_temp_point) == 'undefined')
            {
                if (typeof(f.od_receipt_card) == 'undefined') {
                    ;
                } else {
                    od_receipt_card = settle_amount - od_receipt_bank;
                    f.od_receipt_card.value = number_format(String(od_receipt_card));
                }
            }
        }
        return;
    }
}
</script>

<?
include_once("./_tail.php");
?>
