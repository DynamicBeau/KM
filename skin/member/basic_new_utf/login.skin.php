<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($g4['https_url']) {
    $login_url = $_GET['url'];
    if ($login_url) {
        if (preg_match("/^\.\.\//", $url)) {
            $login_url = urlencode($g4[url]."/".preg_replace("/^\.\.\//", "", $login_url));
        }
        else {
            $purl = parse_url($g4[url]);
            if ($purl[path]) {
                $path = urlencode($purl[path]);
                $urlencode = preg_replace("/".$path."/", "", $urlencode);
            }
            $login_url = $g4[url].$urlencode;
        }
    }
    else {
        $login_url = $g4[url];
    }
}
else {
    $login_url = $urlencode;
}
?>

<script type="text/javascript" src="<?=$g4[path]?>/js/capslock.js"></script>

<form name="flogin" method="post" onsubmit="return flogin_submit(this);" autocomplete="off">
<input type="hidden" name="url" value='<?=$login_url?>'>

<table width="100" border="0" cellspacing="0" cellpadding="0">

</table>

<table width="728" border="0" cellspacing="0" cellpadding="0" style="margin-left:-40px; margin-top:20px;">
  <tr>
    <td width=100>&nbsp;</td> <td>
<table width="628" border="0" cellspacing="0" cellpadding="0" background="<?=$member_skin_path?>/img/bg.gif" >

<tr>
	<td width=200 align=right>
		<TABLE  cellspacing="0" cellpadding="0" >
		<TR>
			<TD height=60></TD>
		</TR>
		<TR>
			<TD height=214 valign=top><img src="<?=$member_skin_path?>/img/login_text.gif" width="151" height="74"></TD>
		</TR>
	</TABLE></td>
    <td width="428" align="center">
        <table width="428" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="428" height="274" align="center" valign="top">
                <table width="350" border="0" cellpadding="0" cellspacing="0">
				<tr><td height=74></td></tr>
                <tr>
                    <td width="250">
                        <table width="250" border="0" cellpadding="0" cellspacing="0">
                        <tr> 
                            <td width="100" height="26">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?=$member_skin_path?>/img/etc_login_text_id.gif"></td>
                            <td width="150"><INPUT type=text class=ed maxLength=30 size=30 name=mb_id itemname="아이디" required minlength="2"></td>
                        </tr>
                        <tr>
                            <td width="100" height="26">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?=$member_skin_path?>/img/etc_login_text_pass.gif"></td>
                            <td width="150"><INPUT type=password class=ed maxLength=30 size=30 name=mb_password id="login_mb_password" itemname="패스워드" required onkeypress="check_capslock(event, 'login_mb_password');"></td>
                        </tr>
                        </table>
                    </td>
                    <td width=100 align=left>&nbsp;&nbsp;<INPUT type=image src="<?=$member_skin_path?>/img/btn_login.gif" border=0></td>
                </tr>
                <tr>
                    <td height="5" colspan="2"></td>
                </tr>
                <tr>
                    <td height="1" colspan="2"></td>
                </tr>
                <tr>
                    <td height="25" colspan="2"></td>
                </tr>
                <tr>
                    <td height="26" colspan="2"><img src="<?=$member_skin_path?>/img/icon.gif" width="3" height="3"> 아직 회원이 아니십니까?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./register.php"><img  src="<?=$member_skin_path?>/img/btn_register.gif" border=0 align="absmiddle"></a></td>
                </tr>
                <tr>
                    <td height="26" colspan="2"><img src="<?=$member_skin_path?>/img/icon.gif" width="3" height="3"> 아이디/패스워드를 잊으셨습니까?&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="win_password_lost();"><img src="<?=$member_skin_path?>/img/btn_password_forget.gif" border=0 align="absmiddle"></td>
                </tr>
                </table></td>
        </tr>
        </table></td>
   
</tr>
</table></td>
  </tr>
</table>

</form>

<script type='text/javascript'>
document.flogin.mb_id.focus();

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
</script>
