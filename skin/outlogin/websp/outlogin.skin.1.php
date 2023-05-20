<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
$tmp_mb_id = $tmp_mb_password = "";
if (isset($is_demo))
{
    $f = @file("$g4[path]/DEMO");
    if (is_array($f))
    {
        $tmp_mb_id = $f[0];
        $tmp_mb_password = $f[1];
    }
}

if ($g4['https_url']) {
    if (isset($url)) {
        if (preg_match("/^\.\.\//", $url)) {
            $url = urlencode($g4[url]."/".preg_replace("/^\.\.\//", "", $url));
        }
        else {
            $url = $g4[url].$urlencode;
        }
    }
    else {
        $url = $g4[url];
    }
}
else {
    $url = $urlencode;
}
?>
<style>
@charset "utf-8";
/* 로그인 전 */
#websp_login {height: 105px; line-height: 15px; border: 1px solid #ddd; overflow: hidden; width:100%; }
#websp_login fieldset { position: relative; border:0px;}
#websp_login fieldset legend { display: none; }
#websp_login label { display: none; }

#websp_login .websp_id,
#websp_login .websp_password,
#websp_login .websp_txt { margin-top: 2px; padding: 2px 0 0 5px; width: 65%; height: 18px; }
#websp_login .websp_id {  background: url(<?=$outlogin_skin_path?>/img/id_bg.gif) no-repeat 5px 50%; border: 1px solid #CCC; }
#websp_login .websp_password { background: url(<?=$outlogin_skin_path?>/img/password_bg.gif) no-repeat 5px 50%; border: 1px solid #CCC; }
#websp_login .websp_txt { color: #222; border: 1px solid #CCC; }

#websp_login a { display: block; padding-left: 5px; color: #333; }
#websp_login a:hover { color: #D00; }

#websp_login .login_btn { height: 46px; vertical-align: top; position: absolute; top: 5px; right: 0; }
#websp_login .websp_btn { margin-top: 5px; padding-top: 3px; width: 50px; height: 22px; font-size: 11px; color: #FFF;	background: #333; border: 1px solid #DDD; }

#websp_login ul { margin-top: 10px; padding-bottom: 5px; }
#websp_login ul li { line-height: 17px; }

/* 로그인 후 */
#websp_login2 { padding: 5px 5px 6px; height: 105px; line-height: 15px; border: 2px solid #BC0202; overflow: hidden; }
#websp_login2 strong, #websp_login2 strong a { color: #1866B6; }
#websp_login2 p { margin-bottom: 5px; padding: 2px; text-align: center; background: #EEE; overflow: hidden; }
#websp_login2 ul.my_info { padding: 5px; border: 1px solid #E2E2E2; overflow: hidden; }
#websp_login2 ul.my_info li { padding: 2px 0; color: #222; line-height: 20px; background: #F9F9F9;  border-bottom: 1px solid #EDEDED; overflow: hidden; }
#websp_login2 ul.my_info li.lv, #websp_login2 ul.my_info li.memo { width: 49%; float: left; }
#websp_login2 ul.my_info li.lv { border-right: 1px solid #DEDEDE; }
#websp_login2 ul.my_info li.lv strong, #websp_login2 ul.my_info li.memo strong { width: 50px; }
#websp_login2 ul.my_info li strong { color: #666; text-align: center; float: left; }
#websp_login2 ul.my_info li.point { border: none; clear: both; }
#websp_login2 ul.my_info li a,
#websp_login2 ul.my_info li span { display: block; padding: 0 3px; color: #000; font-weight: bold; text-align: right; float: right; }

#websp_login2 ul.log_info { margin-top: 5px; list-style:none; }
#websp_login2 ul.log_info li { width: 49%; text-align: center; border-right: 1px solid #DEDEDE; float: left; overflow: hidden; }
#websp_login2 ul.log_info li a { display: block; }
#websp_login2 ul.log_info li.end { border: none; }

</style>
<!--login-->
<div id="websp_login">
	<fieldset>
	<legend>로그인</legend>
	<form name="flogin" method="post" onsubmit="flogin_submit(this);" action="" id="loginform">
		<input type="hidden" name="url" value="<?=$g4[https_url]?$g4[url]:$urlencode;?>" />
		<label>ID</label>
		<input type="text" class="websp_id" name="mb_id" value="<?=$tmp_mb_id?>" onfocus="this.className='websp_txt'" onblur="if (this.value.length==0) {this.className='websp_id';}else {this.className='websp_txt';}"  />
		<br />
		<label>PW</label>
		<input type="password" class="websp_password" name="mb_password" value="<?=$tmp_mb_password?>" onfocus="this.className='websp_txt'" onblur="if (this.value.length==0) {this.className='websp_password';}else {this.className='websp_txt';}" />
		<br />
		<div class="login_btn">
			<input type="checkbox" name="auto_login" value="1" onclick="if (this.checked) { if (confirm('자동로그인을 사용하시면 다음부터 회원아이디와 패스워드를 입력하실 필요가 없습니다.\n\n\공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?')) { this.checked = true; } else { this.checked = false; } }" />
			<span>자동</span><br />
			<input type="submit" class="websp_btn" value="로그인" />
		</div>
	</form>
	<ul >
		<li><a href="<?=$g4[bbs_path]?>/register_form.php" >회원가입</a></li>
		<li><a href="javascript:win_password_lost();">아이디/패스워드찾기</a></li>
	</ul>
	</fieldset>
</div>
<!--//login-->
<script type="text/javascript">
//<![CDATA[
document.getElementById("loginform").setAttribute("autocomplete","off");
	function loginform_clearSid() {
		if (document.getElementById("sid").checked) {
			document.loginform.id.style.backgroundImage = '';
		}
}

function flogin_submit(f)
{
    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/login_check.php';";
    else
        echo "f.action = '$g4[bbs_path]/login_check.php';";
    ?>

    return true;
}
//]]>
</script>
