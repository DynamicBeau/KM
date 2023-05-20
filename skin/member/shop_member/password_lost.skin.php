<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<div class="ck_find_warp">
<h1 class="title"><span>Find</span> ID & Password</h1>
<div class="ck_box">
<form name="fpasswordlost" method="post" onsubmit="return fpasswordlost_submit(this);" autocomplete="off">
<div class="ck_find_email">
	<input type="text" name="mb_email" class="ck_input" required email  style="width:500px" itemname="이메일주소" value="회원가입시 등록하신 이메일주소를 입력하세요." />
</div>


<div class="ck_kcaptcha_image">
<img id='kcaptcha_image' />
<input type=input size=10 name=wr_key  class="ck_input" itemname="자동등록방지" required>&nbsp;&nbsp;왼쪽의 글자를 입력하세요.
</div>

<div class="ck_find_btn"><input id=btn_submit type=submit value="확인"></div>

</form>
</div>
</div>


 
 



<script type="text/javascript" src="<?="$g4[path]/js/md5.js"?>"></script>
<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">

document.fpasswordlost.mb_email.onfocus = function() {
	if(this.value=="회원가입시 등록하신 이메일주소를 입력하세요.") this.value="";
}
document.fpasswordlost.mb_email.onblur = function() {
	if(this.value=="") this.value="회원가입시 등록하신 이메일주소를 입력하세요.";
}


function fpasswordlost_submit(f)
{
    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/password_lost2.php';";
    else
        echo "f.action = './password_lost2.php';";
    ?>

    return true;
}


$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});
</script>
