<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<script type="text/javascript" src="<?=$g4[path]?>/js/capslock.js"></script>
<div class="ck_password_wrap">
<h2 class="title">Secrecy</h2>

<form name="fboardpassword" method=post onsubmit="return fboardpassword_submit(this);">
<input type=hidden name=w           value="<?=$w?>">
<input type=hidden name=bo_table    value="<?=$bo_table?>">
<input type=hidden name=wr_id       value="<?=$wr_id?>">
<input type=hidden name=comment_id  value="<?=$comment_id?>">
<input type=hidden name=sfl         value="<?=$sfl?>">
<input type=hidden name=stx         value="<?=$stx?>">
<input type=hidden name=page        value="<?=$page?>">
<div class="ck_box">
	<fieldset>
		<INPUT type=password class="ck_input" name="wr_password" id="password_wr_password" itemname="패스워드" required onkeypress="check_capslock(event, 'password_wr_password');">
		<INPUT name="image" id="loginBtn" type="submit"  value="확 인" />
	</fieldset>
	<div class="ck_password_text">이 게시물의 패스워드를 입력하십시오.</div>
</div>
</form>
</div>

</form>

<script type='text/javascript'>
document.fboardpassword.wr_password.focus();

function fboardpassword_submit(f)
{
    f.action = "<?=$action?>";
    return true;
}
</script>
