<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$url = '';
if ($g4['https_url']) {
    if (preg_match("/^\./", $urlencode))
        $url = $g4[url];
    else
        $url = $g4[url].$urlencode;
} else {
    $url = $urlencode;
}
?>
<table width="218" height="100%" border="0" cellpadding="0" cellspacing="0">
<form name="flogin" method="post" onsubmit="return flogin_submit(this);" autocomplete="off">
<input type="hidden" name="url" value="<?=$url?>">
	<tr>
		<td valign="top" bgcolor="#f6f6f6">
		<table width="200" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr><td height="10" colspan="5"></td></tr>
			<tr>
				<td width="2"></td>
				<td width="136">
				<table width="136" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td><input type="text" name="mb_id" id="mb_id" class="login-mb_id" title="아이디" onfocus="this.className='login-mb_id focus';" onblur="if (this.value.length==0) {this.className='login-mb_id';}else {this.className='login-mb_id focusnot';}"></td>
					</tr>
					<tr><td height="1"></td></tr>
					<tr>
						<td><input type="password" name="mb_password" id="mb_password" class="login-mb_password" title="비밀번호" onfocus="this.className='login-mb_password focus';" onblur="if (this.value.length==0) {this.className='login-mb_password';}else {this.className='login-mb_password focusnot';}"></td>
					</tr>
				</table>
				</td>
				<td width="2"></td>
				<td width="45"><input type="image"  class="login-button" src="<?=$outlogin_skin_path?>/img/outlogin_button.gif" align="absmiddle"></td>
				<td width="2"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr><td height="1" bgcolor="#d9d9d9"></td></tr>
	<tr>
		<td bgcolor="#FFFFFF" valign="center" height="26">
		<table width="200" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td colspan="7" class="small" align="center"><a href="javascript:win_password_forget();"><font color="#74787f">아이디 / 비밀번호 찾기</font></a>&nbsp;&nbsp;<font color="#d3d3d3">|</font>&nbsp;&nbsp;<a href="<?=$g4[bbs_path]?>/register.php"><strong><font color="#434a55">회원가입</font></strong></a></td>
			</tr>
		</table>
		</td>
	</tr>
</form>
</table>

<script type="text/javascript">

function flogin_submit(f)
{
    if (!f.mb_id.value) {
        alert("회원아이디를 입력하십시오.");
        f.mb_id.focus();
        return;
    }
    if (!f.mb_password.value) {
        alert("패스워드를 입력하십시오.");
        f.mb_password.focus();
        return;
    }
	
	f.action = '<?=$g4[bbs_path]?>/login_check.php';    f.submit();
}
</script>

<style type="text/css">
#mb_id{background:#fff url(<?=$outlogin_skin_path?>/img/login.gif) no-repeat 0px 0px; border:1px solid #d2d2d2; height:20px; width:136px;}
#mb_password{background:#fff url(<?=$outlogin_skin_path?>/img/password.gif) no-repeat 0px 0px; border:1px solid #d2d2d2; height:20px; width:136px;}
.login-mb_id.focus{border:1px solid #5aa409; background:#fff !important;}
.login-mb_id.focusnot{background:#fff !important;}
.login-mb_password.focus{border:1px solid #5aa409; background:#fff !important;}
.login-mb_password.focusnot{background:#fff !important;}

#mw-outlogin .box-outside { width:199px; height:144px; background-color:#e2e2e2; }
#mw-outlogin .box-inside { position:absolute; margin:1px; width:197px; height:142px; background-color:#f3f4f3; }
#mw-outlogin .box-inside { line-height:16px; color:#7dacd8; font-size:9pt; font-family:gulim; }
#mw-outlogin .login-title { position:absolute; margin:5px 0 0 7px; }
#mw-outlogin .login-mb_id { position:absolute; margin:18px 0 0 13px; padding:3px 0 0 2px; border:1px solid #d3d3d3; width:170px; height:22px; }
#mw-outlogin .login-mb_id { font-size:8pt; color:#7dacd8; ime-mode:disabled; }
#mw-outlogin .login-mb_password { position:absolute; margin:43px 0 0 13px; padding:3px 0 0 2px; border:1px solid #d3d3d3; }
#mw-outlogin .login-mb_password { width:115px; height:22px; font-size:8pt; color:#7dacd8; }
#mw-outlogin .login-button { position:absolute; margin:43px 0 0 131px; }

#mw-outlogin .login-div { position:absolute; margin:19px 0 0 182px; }
#mw-outlogin .login-intro { position:absolute; margin:20px 0 0 199px; }
#mw-outlogin .login-intro_1 { position:absolute; margin:40px 0 0 202px; }
#mw-outlogin .login-intro_2 { position:absolute; margin:40px 0 0 221px; }
#mw-outlogin .login-intro_3 { position:absolute; margin:40px 0 0 239px; }
#mw-outlogin .login-IP { position:absolute; margin:70px 0 0 200px; }

#mw-outlogin .login-auto { position:absolute; margin:19px 0 0 115px; font-size:8pt; color:#878787; }
#mw-outlogin .login-membership { position:absolute; margin:70px 0 0 10px; padding:3px 0 0 8px; border-top:1px; }
#mw-outlogin .login-membership { text-align:center; font-size:9pt; color:#d0e1f1; }
#mw-outlogin .login-membership a { color:#7dacd8; font-size:9pt; text-decoration:none; }

#mw-outlogin .login-1 { position:absolute; margin:40px 0 0 240px; }
#mw-outlogin .login-2 { position:absolute; margin:40px 0 0 259px; }
#mw-outlogin .login-3 { position:absolute; margin:40px 0 0 278px; }

#mw-outlogin .box-outside { background-color:#e2e2e2; }
#mw-outlogin .box-inside { background-color:#f3f4f3; color:#6b7bb3; }
#mw-outlogin .login-mb_id { border:1px solid #d1d1d1; color:#666666; }
#mw-outlogin .login-mb_password { border:1px solid #d1d1d1; color:#666666; }
#mw-outlogin .login-membership { color:#4a4a4a; }
#mw-outlogin .login-membership a { color:#4a4a4a; }

</style>

