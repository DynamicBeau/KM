<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($g4['https_url']) {
    $outlogin_url = $_GET['url'];
    if ($outlogin_url) {
        if (preg_match("/^\.\.\//", $outlogin_url)) {
            $outlogin_url = urlencode($g4[url]."/".preg_replace("/^\.\.\//", "", $outlogin_url));
        }
        else {
            $purl = parse_url($g4[url]);
            if ($purl[path]) {
                $path = urlencode($purl[path]);
                $urlencode = preg_replace("/".$path."/", "", $urlencode);
            }
            $outlogin_url = $g4[url].$urlencode;
        }
    }
    else {
        $outlogin_url = $g4[url];
    }
}
else {
    $outlogin_url = $urlencode;
}
?>

<script type="text/javascript" src="<?=$g4[path]?>/js/capslock.js"></script>
<script type="text/javascript">
// 엠파스 로긴 참고
var bReset = true;
function chkReset(f)
{
    if (bReset) { if ( f.mb_id.value == 'ID' ) f.mb_id.value = ''; bReset = false; }
    document.getElementById("pw1").style.display = "none";
    document.getElementById("pw2").style.display = "";
}
</script>
<style>
input{margin:0; padding:0;}
#box{width:215px; height:117px; border:1px solid #dbd4d0; background-color:#fbfbfb; text-align:center; padding:17px 0 17px 0;}
#box_top{width:183px; margin:auto;}
.t1{border:1 solid #dedede; border-bottom:0; padding:0; margin:0; width:128px; height:22px; vertical-align:text-bottom; padding-top:3px;}
.t2{border:1 solid #dedede; padding:0; margin:0; width:128px; height:22px; vertical-align:text-bottom; padding-top:3px;}
#t3{float:right;}
#l_table{width:100%;}
.t_text a:link, a:active, a:visited{color:#a09b98; font-family:돋움; font-size:11px; text-decoration:none;}
.t_text a:hover{color:#a09b98; font-family:돋움; font-size:11px; text-decoration:none;}

#box_middle{margin-top:8px;}
#saveImg{background:url(<?=$outlogin_skin_path?>/img/saveID.gif) no-repeat; width:54px; height:10px;}
.list_1{ list-style:none; padding:0; margin:0;}
.list_1 li{display:inline;}
.line{width:100%; height:1px; background-color:#dcd6d2; margin:10px 0 10px 0; font-size:1px;}
.list_2{list-style:none; padding:0; margin:0;}
.list_2 li{float:left;}
#ch{padding:0; margin:0; border:0; width:13px; height:13px;}
</style>

<!-- 로그인 전 외부로그인 시작 -->
<form name="fhead" method="post" onsubmit="return fhead_submit(this);" autocomplete="off" style="margin:0px;">
<input type="hidden" name="url" value="<?=$outlogin_url?>">
<div id="box">
<div id="box_top">
<table border="0" cellpadding="0" cellspacing="0" id="l_table">
<tr>
<td><input name="mb_id" type="text" class="t1" maxlength="20" required itemname="아이디" value='ID' onMouseOver='chkReset(this.form);' onFocus='chkReset(this.form);' /></td>
<td rowspan="2"><input type="image" src="<?=$outlogin_skin_path?>/img/login.jpg" id="t3" width="47px" height:"43px" /></td>
</tr>
<tr>
<td id=pw1><input type="text" class="t2" maxlength="20" required itemname="패스워드" value='PW' onMouseOver='chkReset(this.form);' onfocus='chkReset(this.form);'></td>
<td id=pw2 style='display:none;'><input name="mb_password" id="outlogin_mb_password" type="password" class="t2" maxlength="20" itemname="패스워드" onMouseOver='chkReset(this.form);' onfocus='chkReset(this.form);' onKeyPress="check_capslock(event, 'outlogin_mb_password');"></td>
</tr>
</table>
<div id="box_middle">
<ul class="list_1" style="text-align:left; padding:0; margin:0;">
<li><input id="ch" type="checkbox" name="auto_login" value="1" onclick="if (this.checked) { if (confirm('자동로그인을 사용하시면 다음부터 회원아이디와 패스워드를 입력하실 필요가 없습니다.\n\n\공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?')) { this.checked = true; } else { this.checked = false; } }"></li>
<li><img src="<?=$outlogin_skin_path?>/img/saveID.gif"></li>
</ul>
</div>
<div class="line"> <!-- --> </div>
<div>
<ul class=list_2>
<li><img src="<?=$outlogin_skin_path?>/img/icon1.gif" /></li>
<li class="t_text"><a href="<?=$g4[bbs_path]?>/register.php" >아이디/비밀번호 찾기</a></li>
<li>&nbsp;</li>
<li><img src="<?=$outlogin_skin_path?>/img/icon2.gif" /></li>
<li class="t_text"><a href="javascript:win_password_lost();">회원가입</a></li>
</ul>
</div>
</div>
</div>
</form>
<script type="text/javascript">
function fhead_submit(f)
{
    if (!f.mb_id.value) {
        alert("회원아이디를 입력하십시오.");
        f.mb_id.focus();
        return false;
    }

    if (document.getElementById('pw2').style.display!='none' && !f.mb_password.value) {
        alert("패스워드를 입력하십시오.");
        f.mb_password.focus();
        return false;
    }

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/login_check.php';";
    else
        echo "f.action = '$g4[bbs_path]/login_check.php';";
    ?>

    return true;
}
</script>
<!-- 로그인 전 외부로그인 끝 -->
