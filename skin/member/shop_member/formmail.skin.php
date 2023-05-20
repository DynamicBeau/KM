<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<div class="ck_mail_warp">
<h1 class="title"><span>FORM</span>E-MAIL</h1>

<div class="ck_box">
<form name="fformmail" method="post" onsubmit="return fformmail_submit(this);" enctype="multipart/form-data" style="margin:0px;">
<input type="hidden" name="to"     value="<?=$email?>">
<input type="hidden" name="attach" value="2">
<input type="hidden" name="token"  value="<?=$token?>">
<p><b><?=$name?></b>님께 메일보내기</p>
<table>

	<? if ($is_member) { // 회원이면 ?>
		<input type='hidden' name='fnick'  value='<?=$member[mb_nick]?>'>
		<input type='hidden' name='fmail'  value='<?=$member[mb_email]?>'>
	<? } else { ?>
	<tr> 
		<th>이름</th>
		<td><input type=text class="ck_input" name='fnick' required minlength=2 itemname='이름'></td>
		<th>E-mail</th>
		<td><input type=text class="ck_input"  name='fmail' required email itemname='E-mail'></td>
	</tr>
	<? } ?>
	<tr>
		<th>제목</th>
		<td colspan=3><input type=text class="ck_input" style='width:100%;' name='subject' required itemname='제목'></td>
	</tr>
	<tr>
		<th>선택</th>
		<td colspan=3><input type='radio' name='type' value='0' checked> TEXT <input type='radio' name='type' value='1' > HTML <input type='radio' name='type' value='2' > TEXT+HTML</td>
	</tr>
	<tr>
		<th>내용</th>
		<td colspan=3><textarea name="content" class="ck_textarea" style='width:100%;' rows='7' required itemname='내용'></textarea></td>
	</tr>
	<tr>
		<th>첨부파일 1</th>
		<td colspan=3><input type=file class='ck_file' name='file1'></td>
	</tr>
	<tr>
		<th>첨부파일 2</th>
		<td colspan=3><input type=file class='ck_file' name='file2'></td>
	</tr>
	<tr>
		<td><img id='kcaptcha_image' /></td>
		<td colspan=3><input type=input size=10 name=wr_key  class="ck_input" itemname="자동등록방지" required>&nbsp;&nbsp;왼쪽의 글자를 입력하세요.</td>
	</tr>
</table> 
<div class="ck_mail_btn">
	<input id=btn_submit type=submit value="메일전송">&nbsp;&nbsp;
	<input type=button value="창닫기" class="btn_close_mail" onclick="javascript:window.close();">
</div>


</form>
</div>
</div>
 

<script type="text/javascript" src="<?="$g4[path]/js/md5.js"?>"></script>
<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
with (document.fformmail) {
    if (typeof fname != "undefined")
        fname.focus();
    else if (typeof subject != "undefined")
        subject.focus();
}

function fformmail_submit(f)
{
    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    if (f.file1.value || f.file2.value) {
        // 4.00.11
        if (!confirm("첨부파일의 용량이 큰경우 전송시간이 오래 걸립니다.\n\n메일보내기가 완료되기 전에 창을 닫거나 새로고침 하지 마십시오."))
            return false;
    }

    document.getElementById('btn_submit').disabled = true;

    f.action = "./formmail_send.php";
    return true;
}
</script>
