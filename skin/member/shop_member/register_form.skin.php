<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
$ck_star_icon = "<span class='ck_star_icon'>*</span> ";
?>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/themes/base/jquery-ui.css" rel="stylesheet" />
<style type="text/css">
<!--
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; }
-->
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
<script type="text/javascript">
/* Korean initialisation for the jQuery calendar extension. */
/* Written by DaeKwon Kang (ncrash.dk@gmail.com). */
jQuery(function($){
	$.datepicker.regional['ko'] = {
		monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
		'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
		monthNamesShort: ['1월','2월','3월','4월','5월','6월',
		'7월','8월','9월','10월','11월','12월'],
		dayNames: ['일','월','화','수','목','금','토'],
		dayNamesShort: ['일','월','화','수','목','금','토'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yymmdd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);

    $('#mb_birth').datepicker({
        showOn: 'button',
		buttonImage: '<?=$g4[path]?>/img/calendar.gif',
		buttonImageOnly: true,
        buttonText: "달력",
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
        yearRange: 'c-99:c+99',
        maxDate: '+0d'
    }); 
});
</script>
<?
//==============================================================================
?>

<script>
var member_skin_path = "<?=$member_skin_path?>";
</script>
<script type="text/javascript" src="<?=$member_skin_path?>/ajax_register_form.jquery.js"></script>
<script type="text/javascript" src="<?=$g4[path]?>/js/md5.js"></script>
<script type="text/javascript" src="<?=$g4[path]?>/js/sideview.js"></script>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">

<form id="fregisterform" name=fregisterform method=post onsubmit="return fregisterform_submit(this);" enctype="multipart/form-data" autocomplete="off">
<input type=hidden name=w                value="<?=$w?>">
<input type=hidden name=url              value="<?=$urlencode?>">
<input type=hidden name=mb_jumin         value="<?=$jumin?>">
<input type=hidden name=mb_id_enabled    value="" id="mb_id_enabled">
<input type=hidden name=mb_nick_enabled  value="" id="mb_nick_enabled">
<input type=hidden name=mb_email_enabled value="" id="mb_email_enabled">
<!-- <input type=hidden name=token value="<?=$token?>"> -->
<div id="ck_member_wrap">


<? if($w==""){?>
<ul class="ck_register_step">
<li>가입약관 동의</li>
<li class="ck_arrow"></li>
<li class="ck_this">개인정보 입력</li>
<li class="ck_arrow"></li>
<li>회원가입 완료</li>
</ul>
<?}?>

<div class="ck_box">
	<div class="ck_register_form">
		<h3 class="ck_register_title">회원로그인정보</h3>
		<table>
		<tr>
			<th><?=$ck_star_icon?>아이디</th>
			<td><input class="ck_input" maxlength=20 size=20 id='reg_mb_id' name="mb_id" value="<?=$member[mb_id]?>" <? if ($w=='u') { echo "readonly style='background-color:#dddddd;'"; } ?> <? if ($w=='') { echo "onblur='reg_mb_id_check();'"; } ?>>
                <span id='msg_mb_id'></span>
                <p>&lt;!&gt; 영문자, 숫자, _ 만 입력 가능. 최소 <b>3</b> 자이상 입력하세요.</p></td>
		</tr>
		<tr>
			<th><?=($w=="")?$ck_star_icon:"";?>패스워드</th>
			<td><input class="ck_input" type=password name="mb_password" size=20 maxlength=20 <?=($w=="")?"required":"";?> itemname="패스워드"></td>
		</tr>
		<tr>
			<th><?=($w=="")?$ck_star_icon:"";?>패스워드 확인</th>
			<td><input class="ck_input" type=password name="mb_password_re" size=20 maxlength=20 <?=($w=="")?"required":"";?> itemname="패스워드 확인"></td>
		</tr>
		</table>
		<h3 class="ck_register_title">회원기본정보</h3>
		<table>
		<tr>
			<th><?=$ck_star_icon?>이름</th>
			<td><input name=mb_name itemname="이름" class="ck_input" value="<?=$member[mb_name]?>" <?=$member[mb_name]?"readonly style='background-color:#dddddd;'":"";?>> 
			<? if ($w=='') { echo "<span>&lt;!&gt;공백없이 한글만 입력 가능</span>"; } ?></td>
		</tr>
        <? if ($member[mb_nick_date] <= date("Y-m-d", $g4[server_time] - ($config[cf_nick_modify] * 86400))) { // 별명수정일이 지났다면 수정가능 ?>
        <input type=hidden name=mb_nick_default value='<?=$member[mb_nick]?>'>
        <tr>
            <th><?=$ck_star_icon?>별명</th>
            <td>
				<input class="ck_input" type=text id='reg_mb_nick' name='mb_nick' maxlength=20 value='<?=$member[mb_nick]?>'
                    onblur="reg_mb_nick_check();">
                <span id='msg_mb_nick'></span>
                <p>&lt;!&gt; 공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상)</p>
                <? if($config[cf_nick_modify]){?><p>&lt;!&gt; 별명을 바꾸시면 앞으로 <b><?=(int)$config[cf_nick_modify]?></b> 일 이내에는 변경 할 수 없습니다. </p><?}?>
            </td>
        </tr>
        <? } else { ?>
        <input type=hidden name="mb_nick_default" value='<?=$member[mb_nick]?>'>
        <input type=hidden name="mb_nick" value="<?=$member[mb_nick]?>">
        <? } ?>

        <input type=hidden name='old_email' value='<?=$member[mb_email]?>'>
        <tr>
            <th><?=$ck_star_icon?>E-mail</th>
            <td>
                <input class="ck_input" type=text id='reg_mb_email' name='mb_email' size=30 maxlength=100 value='<?=$member[mb_email]?>' onblur="reg_mb_email_check()">
                <span id='msg_mb_email'></span>
				<p><input type=checkbox name=mb_mailling value='1' <?=($w=='' || $member[mb_mailling])?'checked':'';?>> 메일링서비스 : 정보 메일을 받겠습니다.</p>
                <? if ($config[cf_use_email_certify]) { ?>
                    <? if ($w=='') { echo "<p>e-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다.</p>"; } ?>
                    <? if ($w=='u') { echo "<p>e-mail 주소를 변경하시면 다시 인증하셔야 합니다.</p>"; } ?>
                <? } ?>
            </td>
        </tr>
        <? if ($w=="") { ?>
		<tr>
			<th><?=$ck_star_icon?>생년월일</th>
			<td><input class="ck_input" type=text id=mb_birth name='mb_birth' size=8 maxlength=8 minlength=8 required numeric itemname='생년월일' value='<?=$member[mb_birth]?>' readonly title='옆의 달력 아이콘을 클릭하여 날짜를 입력하세요.'></td>
		</tr>
        <? } ?>
        <? if ($member[mb_sex]) { ?>
		<input type=hidden name=mb_sex value='<?=$member[mb_sex]?>'>
        <? } else { ?>
		<tr>
			<th><?=$ck_star_icon?>성별</th>
			<td><input type="radio" name="mb_sex"  value='F' checked> 여자 <input type="radio" name="mb_sex"  value='M'> 남자</td>
		</tr>
        <? } ?>
        <? if ($config[cf_use_homepage]) { ?>
        <tr>
            <th><?=$config[cf_req_homepage]?$ck_star_icon:'';?>홈페이지</th>
            <td><input class="ck_input" type=text name='mb_homepage' size=38 maxlength=255 <?=$config[cf_req_homepage]?'required':'';?> itemname='홈페이지' value='<?=$member[mb_homepage]?>'></td>
        </tr>
        <? } ?>
        <? if ($config[cf_use_tel]) { ?>
        <tr>
            <th><?=$config[cf_req_tel]?$ck_star_icon:'';?>전화번호</th>
            <TD><input class="ck_input" type=text name='mb_tel' size=21 maxlength=20 <?=$config[cf_req_tel]?'required':'';?> itemname='전화번호' value='<?=$member[mb_tel]?>'></td>
        </tr>
        <? } ?>

        <? if ($config[cf_use_hp]) { ?>
        <tr>
            <th><?=$config[cf_req_hp]?$ck_star_icon:'';?>핸드폰번호</th>
            <TD><input class="ck_input" type=text name='mb_hp' size=21 maxlength=20 <?=$config[cf_req_hp]?'required':'';?> itemname='핸드폰번호' value='<?=$member[mb_hp]?>'>
			<p><input type=checkbox name=mb_sms value='1' <?=($w=='' || $member[mb_sms])?'checked':'';?>>SMS 수신여부 : 핸드폰 문자메세지를 받겠습니다.</p>
			</td>
        </tr>
        <? } ?>



        <? if ($config[cf_use_addr]) { ?>
        <tr>
            <th><?=$config[cf_req_addr]?$ck_star_icon:'';?>주소</th>
            <td><input class="ck_input" type=text name='mb_zip1' size=4 maxlength=3 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='우편번호 앞자리' value='<?=$member[mb_zip1]?>'> -  <input class="ck_input" type=text name='mb_zip2' size=4 maxlength=3 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='우편번호 뒷자리' value='<?=$member[mb_zip2]?>'>
                        &nbsp;<a href="javascript:;" onclick="win_zip2('fregisterform', 'mb_zip1', 'mb_zip2', 'mb_addr1', 'mb_addr2');" class="ck_zip_code_search_btn">우편번호찾기</a>
				<p><input class="ck_input" type=text name='mb_addr1' size=60 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='주소' value='<?=$member[mb_addr1]?>'></p>
                <p><input class="ck_input" type=text name='mb_addr2' size=60 <?=$config[cf_req_addr]?'required':'';?> itemname='상세주소' value='<?=$member[mb_addr2]?>'></p>
            </td>
        </tr>
        <? } ?>
        <? if ($config[cf_use_signature]) { ?>
        <tr>
            <th><?=$config[cf_req_signature]?$ck_star_icon:'';?>서명</th>
            <td><textarea name=mb_signature class="ck_textarea" rows=3 <?=$config[cf_req_signature]?'required':'';?> itemname='서명'><?=$member[mb_signature]?></textarea></td>
        </tr>
        <? } ?>

        <? if ($config[cf_use_profile]) { ?>
        <tr>
            <th><?=$config[cf_req_profile]?$ck_star_icon:'';?>자기소개</th>
            <td><textarea name=mb_profile class="ck_textarea" rows=3 <?=$config[cf_req_profile]?'required':'';?> itemname='자기 소개'><?=$member[mb_profile]?></textarea></td>
        </tr>
        <? } ?>


        <? if ($member[mb_level] >= $config[cf_icon_level]) { ?>
        <tr>
            <th>회원아이콘</th>
            <td><INPUT class="ck_file" type=file name='mb_icon' size=20> 
				<? if ($w == "u" && file_exists($mb_icon)) { ?>
				<span><img src='<?=$mb_icon?>' align=absmiddle> <input type=checkbox name='del_mb_icon' value='1'>삭제</span>
				<? } ?>
                <p>* 이미지 크기는 가로(<b><?=$config[cf_member_icon_width]?></b>픽셀)x세로(<b><?=$config[cf_member_icon_height]?></b>픽셀) 이하로 해주세요.</p>
				<p>(gif만 가능 / 용량:<b><?=number_format($config[cf_member_icon_size])?></b>바이트 이하만 등록됩니다.)</p>
				</td>
        </tr>
        <? } ?>
        <? if ($member[mb_open_date] <= date("Y-m-d", $g4[server_time] - ($config[cf_open_modify] * 86400))) { // 정보공개 수정일이 지났다면 수정가능 ?> 
        <input type=hidden name=mb_open_default value='<?=$member[mb_open]?>'> 
        <tr> 
            <th>정보공개</th> 
            <td><input type=checkbox name=mb_open value='1' <?=($w=='' || $member[mb_open])?'checked':'';?>>다른분들이 나의 정보를 볼 수 있도록 합니다. 
                <p>정보공개를 바꾸시면 앞으로 <b><?=(int)$config[cf_open_modify]?></b> 일 이내에는 변경이 안됩니다.</p></td> 
        </TR> 
        <? } else { ?> 
        <input type=hidden name="mb_open" value="<?=$member[mb_open]?>"> 
        <tr> 
            <th>정보공개</th> 
            <td>정보공개는 수정후 <?=(int)$config[cf_open_modify]?> 일 이내, <?=date("Y년 m월 j일", strtotime("$member[mb_open_date] 00:00:00") + ($config[cf_open_modify] * 86400))?> 까지는 변경이 안됩니다. 
			<p>이렇게 하는 이유는 잦은 정보공개 수정으로 인하여 쪽지를 보낸 후 받지 않는 경우를 막기 위해서 입니다.</p> 
            </td> 
        </tr> 
        <? } ?> 
        <? if ($w == "" && $config[cf_use_recommend]) { ?>
        <tr>
            <th>추천인아이디</th>
            <td><input type=text name=mb_recommend class="ck_input"></td>
        </TR>
        <? } ?>
        <tr>
            <td><img id='kcaptcha_image' /></td>
            <td><input type=input class="ck_input" size=10 name=wr_key itemname="자동등록방지" required>&nbsp;&nbsp;왼쪽의 글자를 입력하세요.
            </td>
        </tr>
		</table>

		<div class="ck_register_btn"><INPUT type=submit value="회원가입" class="ck_join_btn" accesskey='s'></div>
	</div><!-- ck_register_form -->

</div><!-- ck_box -->
</div><!-- ck_wrap -->

 
 
<p align=center>
    

</td></tr>
</table>

</form>


<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
$(function() {
    // 폼의 첫번째 입력박스에 포커스 주기 
    $("#fregisterform :input[type=text]:visible:enabled:first").focus(); 
});

// submit 최종 폼체크
function fregisterform_submit(f) 
{
    // 회원아이디 검사
    if (f.w.value == "") {

        reg_mb_id_check();

        if (document.getElementById('mb_id_enabled').value!='000') {
            alert('회원아이디를 입력하지 않았거나 입력에 오류가 있습니다.');
            document.getElementById('reg_mb_id').select();
            return false;
        }
    }

    if (f.w.value == '') {
        if (f.mb_password.value.length < 3) {
            alert('패스워드를 3글자 이상 입력하십시오.');
            f.mb_password.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        alert('패스워드가 같지 않습니다.');
        f.mb_password_re.focus();
        return false;
    }

    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 3) {
            alert('패스워드를 3글자 이상 입력하십시오.');
            f.mb_password_re.focus();
            return false;
        }
    }

    /*
    if (f.mb_password_q.value.length < 1) {
        alert('패스워드 분실시 질문을 선택하거나 입력하십시오.');
        f.mb_password_q.focus();
        return false;
    }

    if (f.mb_password_a.value.length < 1) {
        alert('패스워드 분실시 답변을 입력하십시오.');
        f.mb_password_a.focus();
        return false;
    }
    */

    // 이름 검사
    if (f.w.value=='') {
        if (f.mb_name.value.length < 1) {
            alert('이름을 입력하십시오.');
            f.mb_name.focus();
            return false;
        }

        var pattern = /([^가-힣\x20])/i; 
        if (pattern.test(f.mb_name.value)) {
            alert('이름은 한글로 입력하십시오.');
            f.mb_name.focus();
            return false;
        }
    }

    // 별명 검사
    if ((f.w.value == "") ||
        (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {

        reg_mb_nick_check();

        if (document.getElementById('mb_nick_enabled').value!='000') {
            alert('별명을 입력하지 않았거나 입력에 오류가 있습니다.');
            document.getElementById('reg_mb_nick').select();
            return false;
        }
    }

    // E-mail 검사
    if ((f.w.value == "") ||
        (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {

        reg_mb_email_check();

        if (document.getElementById('mb_email_enabled').value!='000') {
            alert('E-mail을 입력하지 않았거나 입력에 오류가 있습니다.');
            document.getElementById('reg_mb_email').select();
            return false;
        }

        // 사용할 수 없는 E-mail 도메인
        var domain = prohibit_email_check(f.mb_email.value);
        if (domain) {
            alert("'"+domain+"'은(는) 사용하실 수 없는 메일입니다.");
            document.getElementById('reg_mb_email').focus();
            return false;
        }
    }

    if (typeof(f.mb_birth) != 'undefined') {
        if (f.mb_birth.value.length < 1) {
            alert('달력 버튼을 클릭하여 생일을 입력하여 주십시오.');
            //f.mb_birth.focus();
            return false;
        }

        var todays = <?=date("Ymd", $g4['server_time']);?>;
        // 오늘날짜에서 생일을 빼고 거기서 140000 을 뺀다.
        // 결과가 0 이상의 양수이면 만 14세가 지난것임
        var n = todays - parseInt(f.mb_birth.value) - 140000;
        if (n < 0) {
            alert("만 14세가 지나지 않은 어린이는 정보통신망 이용촉진 및 정보보호 등에 관한 법률\n\n제 31조 1항의 규정에 의하여 법정대리인의 동의를 얻어야 하므로\n\n법정대리인의 이름과 연락처를 '자기소개'란에 별도로 입력하시기 바랍니다.");
            return false;
        }
    }

    if (typeof(f.mb_sex) != 'undefined') {
        if (f.mb_sex.value == '') {
            alert('성별을 선택하여 주십시오.');
            f.mb_sex.focus();
            return false;
        }
    }

    if (typeof f.mb_icon != 'undefined') {
        if (f.mb_icon.value) {
            if (!f.mb_icon.value.toLowerCase().match(/.(gif)$/i)) {
                alert('회원아이콘이 gif 파일이 아닙니다.');
                f.mb_icon.focus();
                return false;
            }
        }
    }

    if (typeof(f.mb_recommend) != 'undefined') {
        if (f.mb_id.value == f.mb_recommend.value) {
            alert('본인을 추천할 수 없습니다.');
            f.mb_recommend.focus();
            return false;
        }
    }

    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/register_form_update.php';";
    else
        echo "f.action = './register_form_update.php';";
    ?>

    // 보안인증관련 코드로 반드시 포함되어야 합니다.
    set_cookie("<?=md5($token)?>", "<?=base64_encode($token)?>", 1, "<?=$g4['cookie_domain']?>");

    return true;
}

// 금지 메일 도메인 검사
function prohibit_email_check(email)
{
    email = email.toLowerCase();

    var prohibit_email = "<?=trim(strtolower(preg_replace("/(\r\n|\r|\n)/", ",", $config[cf_prohibit_email])));?>";
    var s = prohibit_email.split(",");
    var tmp = email.split("@");
    var domain = tmp[tmp.length - 1]; // 메일 도메인만 얻는다

    for (i=0; i<s.length; i++) {
        if (s[i] == domain)
            return domain;
    }
    return "";
}
function win_zip2(frm_name, frm_zip1, frm_zip2, frm_addr1, frm_addr2){
        url = g4_path + "/" + g4_bbs + "/zip.php?frm_name="+frm_name+"&frm_zip1="+frm_zip1+"&frm_zip2="+frm_zip2+"&frm_addr1="+frm_addr1+"&frm_addr2="+frm_addr2;
        win_open(url, "winZip", "left=50,top=50,width=500,height=474,scrollbars=0");
    }


</script>
