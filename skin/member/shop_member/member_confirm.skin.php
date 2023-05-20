<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<script type="text/javascript" src="<?=$g4[path]?>/js/capslock.js"></script>

<div class="ck_modify_wrap">
<h2 class="title">Modify</h2>
<form name=fmemberconfirm method=post onsubmit="return fmemberconfirm_submit(this);">
<input type=hidden name=mb_id value='<?=$member[mb_id]?>'>
<input type=hidden name=w     value='u'>
<div class="ck_box">
	<div class="ck_modify_top">회원님의 아이디는 [<?=$member[mb_id]?>] 입니다.</div>
	<fieldset>
		<!-- <?=$member[mb_id]?> -->
		<INPUT type=password maxLength=20  class="ck_input" name="mb_password" id="confirm_mb_password" itemname="패스워드" required onkeypress="check_capslock('confirm_mb_password');">

		<INPUT name="image" id="btn_submit" type="submit"  value="확 인" />
	</fieldset>
	<div class="ck_modify_text">외부로부터 회원님의 정보를 안전하게 보호하기 위해
패스워드를 확인하셔야 합니다.</div>
</div>
</form>
</div>


<script type='text/javascript'>
document.onload = document.fmemberconfirm.mb_password.focus();

function fmemberconfirm_submit(f)
{
    document.getElementById("btn_submit").disabled = true;

    f.action = "<?=$url?>";
    return true;
}
</script>
