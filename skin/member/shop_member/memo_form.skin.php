<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

if(!$me_recv_mb_id) $me_recv_mb_id = "받는 회원아이디";
?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<div class="ck_memo_warp">
<h1 class="title"><span>MY</span> MEMO</h1>
<div class="ck_memo_tab">
<a href="./memo.php?kind=recv">받은 쪽지</a>
<a href="./memo.php?kind=send">보낸 쪽지</a>
<a href="./memo_form.php" class="this">쪽지보내기</a>
</div>
<div class="ck_box">
<form name=fmemoform method=post onsubmit="return fmemoform_submit(this);" autocomplete="off">
<div class="ck_recv_id"><input type=text name="me_recv_mb_id" class="ck_input" style="width:100%" required itemname="받는 회원아이디" value="<?=$me_recv_mb_id?>" ></div>
<p>&lt;!&gt; 여러 회원에게 보낼때는 컴마( , )로 구분하세요.</p>
<div class="ck_recv_memo"><textarea name=me_memo rows=10 class="ck_textarea" style='width:100%;' required itemname='내용'><?=$content?></textarea></div>

<div class="ck_kcaptcha_image">
<img id='kcaptcha_image' />
<input type=input size=10 name=wr_key  class="ck_input" itemname="자동등록방지" required>&nbsp;&nbsp;왼쪽의 글자를 입력하세요.
</div>

<div class="ck_memo_btn">
	<input id=btn_submit type=submit value="쪽지전송">&nbsp;&nbsp;
	<input type=button value="창닫기" class="btn_close_memo" onclick="javascript:window.close();">
</div>

</form>
</div>
</div>

 
 
<script type="text/javascript" src="<?=$g4[path]?>/js/md5.js"></script>
<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
document.fmemoform.me_recv_mb_id.onfocus = function() {
	if(this.value=="받는 회원아이디"|| this.value=="받는 회원아이디를 입력하세요.") this.value="";
}
document.fmemoform.me_recv_mb_id.onblur = function() {
	if(this.value=="") this.value="받는 회원아이디를 입력하세요.";
}

 
function fmemoform_submit(f)
{
	if(!f.me_recv_mb_id.value || f.me_recv_mb_id.value=="받는 회원아이디" || f.me_recv_mb_id.value=="받는 회원아이디를 입력하세요."){
		alert("받는 회원아이디를 입력해 주세요.");
		f.me_recv_mb_id.focus();
        return false;
	}


    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    document.getElementById("btn_submit").disabled = true;

    f.action = "./memo_form_update.php";
    return true;
}
</script>
