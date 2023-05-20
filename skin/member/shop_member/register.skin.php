<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
$ck[color1] = "#3499ba"; //칼라1
?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<div id="ck_member_wrap">

<ul class="ck_register_step">
<li class="ck_this">가입약관 동의</li>
<li class="ck_arrow"></li>
<li>개인정보 입력</li>
<li class="ck_arrow"></li>
<li>회원가입 완료</li>
</ul>

<form name="fregister" method="POST" onsubmit="return fregister_submit(this);" autocomplete="off">
<input type="hidden"  value="" name=agree>
<input type="hidden"  value="" name=agree2>

<? if ($config[cf_use_jumin]) { // 주민등록번호를 사용한다면 ?>
<div class="ck_box ck_jumin_box">
	<h3 class="ck_register_title">가입여부 및 실명확인</h3>
	<p class="ck_register_ex">건전한 인터넷 문화를 조성하기 위해 실명제 기반으로 운영되고 있으며, 회원가입은 무료입니다.</p>
	<fieldset class="oneline">
		<label>이름</label>
		<input name=mb_name itemname="이름" required minlength="2" style="width:120px" nospace hangul class=ck_input>
		<label>주민등록번호</label>
		<input name=jumin1 itemname="주민등록번호" required minlength="6" style="width:80px" maxlength=6 class=ck_input onkeyup="javascript:jumin_chk();">
		-
		<input name=jumin2 itemname="주민등록번호" required minlength="7" style="width:80px" maxlength=7 class=ck_input onkeyup="javascript:jumin_chk();">
		<input type="hidden"  name=mb_jumin itemname="주민등록번호">
	</fieldset>
	<div class="ck_warning">
		개정”주민등록법”에 의해 타인의 주민등록번호를 부정 사용하는 자는 3년 이하의 징역 또는 1천만원 이하의 
		벌급이 부과될 수 있습니다.  <p>관련법률: 주민등록법 제 37조(벌칙) 제9호(시행일 2006.09.24)</p>
	</div>
</div>
<? } ?>


<div class="ck_box">
		<h3 class="ck_register_title">회원가입약관</h3>
		<div class="ck_textarea_box"><?=get_text($config[cf_stipulation],1)?></div>
		<h3 class="ck_register_title">개인정보취급방침</h3>
		<div class="ck_textarea_box"><?=get_text($config[cf_privacy],1)?></div>
		<p class="ck_agree"><span class="checkbox"><!-- 체크박스 --></span>위의 <strong>'가입약관 및 개인정보취급방침'에 동의</strong> 합니다.</p>
</div>

	<table align=center>
	<tr>
		<td style="padding:10px"><input type=submit value="동의" border=0 class="ck_next_btn">
	<a href="<?=$g4[path]?>" class="ck_cancel_btn">동의하지 않습니다</a></td>
	</tr>
	</table>



</form>
</div><!-- ck_wrap -->

<script type="text/javascript">
function fregister_submit(f) 
{
    if (!f.agree.value || !f.agree2.value) {
        alert("'가입약관 및 개인정보취급방침'에 동의하셔야 \n회원가입 하실 수 있습니다.");
        return false;
    }
    f.action = "./register_form.php";
    return true;
}
var ck_agree = 0;
$('.ck_agree').click(function() {
	if(!ck_agree){
	$('.ck_agree .checkbox').css("backgroundPosition","-33px -112px");
	ck_agree = 1;
	}else{
	$('.ck_agree .checkbox').css("backgroundPosition","-10px -112px");
	ck_agree = 0;
	}
	document.fregister.agree.value=ck_agree;
	document.fregister.agree2.value=ck_agree;

});

function jumin_chk(){ 
    var form = document.fregister; 
    var jumin1 = form.jumin1.value; 
    var jumin2 = form.jumin2.value; 
    form.mb_jumin.value = jumin1 + jumin2; 
} 

if (typeof(document.fregister.mb_name) != "undefined")
    document.fregister.mb_name.focus();

</script>
