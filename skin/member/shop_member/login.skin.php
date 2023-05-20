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
// 아이디 자동저장
$se_mb_id = get_cookie("se_mb_id");

?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<script type="text/javascript" src="<?=$g4[path]?>/js/capslock.js"></script>

<div class="ck_login_wrap" style="margin-top:60px; margin-bottom:60px;">
<h2 class="title">Member Login<!-- Sign in --></h2>
<form name="flogin" method="post" onsubmit="return flogin_submit(this);" autocomplete="off">
<input type="hidden" name="url" value='<?=$login_url?>'>
<input type="hidden" name="id_save" value="<?=$se_mb_id?"1":"0"?>" />
<div class="ck_box">
	<fieldset>
		<input type=text class="ck_input" maxLength=20 name="mb_id" id="login_mb_id" itemname="아이디" required minlength="2" value="<?=$se_mb_id?$se_mb_id:"아이디"?>">
		<input type=text class="ck_input" maxLength=20 name="mb_password2" id="login_mb_password2" value="패스워드" />
		<input type="password" class="ck_input" maxLength=20 name="mb_password" id="login_mb_password" itemname="패스워드" required onkeypress="check_capslock(event, 'login_mb_password');" />
		<div class="seved_id"><span class="<?=$se_mb_id?"on":"off"?>"><!-- 체크박스 --></span>ID 저장</div>
		<input type="submit" id="loginBtn" value="로그인" />
	</fieldset>
	<div class="ck_login_otherLinks">
		<a href="./register.php" class="ck_join_btn">회원가입</a>
		<a href="javascript:;" onclick="win_password_lost();" class="ck_find_btn">아이디/패스워드 찾기</a>
	</div>
</div>
</form>
</div>

<script type='text/javascript'>
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
	$("#login_mb_id").focus(function(){
		$(this).addClass("focus");
		if(this.value == "아이디") this.value = "";
	});
	$("#login_mb_id").blur(function(){
		$(this).removeClass("focus");
		if(this.value == "") this.value = "아이디";
	});

	$("#login_mb_password2").focus(function(){
	//	$(this).addClass("focus");
		$(this).hide();
		$("#login_mb_password").show();
		$("#login_mb_password").focus();
		$("#login_mb_password").addClass("focus");
	});
	$("#login_mb_password").blur(function(){
		if(this.value == "")$(this).hide();
		$("#login_mb_password2").show();
		$(this).removeClass("focus");
	});
	$("#login_mb_password").focus(function(){
		$(this).addClass("focus");
	});

	var seve_id = <?=$se_mb_id?"1":"0"?>;
	$('.seved_id').click(function() {
		if(!seve_id){
		$('.seved_id span.off').attr("className","on")
		seve_id = 1;
		}else{
		$('.seved_id span.on').attr("className","off")
		seve_id = 0;
		}
		document.flogin.id_save.value=seve_id;

	});
</script>

<? // 쇼핑몰 사용시 여기부터 ?>
<? if ($default[de_level_sell] == 1) { // 상품구입 권한 ?>

    <!-- 주문하기, 신청하기 -->
<? if (preg_match("/orderform.php$/", $url)) { ?>
<div class="ck_login_wrap">
<h2 class="title">Guest</h2>
<p style="font-size:22px; color:#ff0000; font-weight:bold; font-family:나눔고딕;">비회원으로 주문</p>
<div class="ck_box">

	<div style='overflow:auto;  height:100px; border:1px solid #DDD; background:#FFF; padding:10px;'><?=$default[de_guest_privacy]?></div>
	<div style='padding:6px;'><input type='checkbox' id='agree' value='1'>&nbsp;개인정보수집에 대한 내용을 읽었으며 이에 동의합니다.</div>
	<div>&nbsp;· 비회원으로 주문하시는 경우 <font color=#2E84B4>포인트는 지급하지 않습니다.</font></div>

	<div style="text-align:center; padding:10px;"><a href="javascript:guest_submit(document.flogin);"><img src='<?=$member_skin_path?>/img/btn_guest.gif' border=0></a></div>
</div>
</div>
  
 

        <script language="javascript">
        function guest_submit(f)
        {
            if (document.getElementById('agree')) {
                if (!document.getElementById('agree').checked) {
                    alert("개인정보수집에 대한 내용을 읽고 이에 동의하셔야 합니다.");
                    return;
                }
            }

            f.url.value = "<?=$g4[shop_path]?>/orderform.php";
            f.action = "<?=$g4[shop_path]?>/orderform.php";
            f.submit();
        }
        </script>

    <? } else if (preg_match("/orderinquiry.php$/", $url)) { ?>


<div class="ck_login_wrap">
<h2 class="title">Order</h2>
<form name=forderinquiry method=post action="<?=urldecode($url)?>" autocomplete="off" style="padding:0px;">
<div class="ck_box">
	<fieldset>

		<input type=text name=od_id id=od_id class=ck_input required itemname="주문서번호" value="주문서번호">

		<input type=password name=od_pwd id=od_pwd class=ck_input itemname="패스워드">
		<input type=text name=od_pwd2 id=od_pwd2 class=ck_input itemname="패스워드" value="패스워드">
		<input type="submit" id="loginBtn" value="확인" />
	</fieldset>
	<div class="ck_login_otherLinks">
                · 메일로 발송한 주문서에 있는 '주문서번호'를 입력하십시오.<br>
                · 주문서 작성시 입력한 '패스워드'를 입력하십시오.</div>
</div>
</form>
</div>

<script type='text/javascript'>
	$("#od_id").focus(function(){
		$(this).addClass("focus");
		if(this.value == "주문서번호") this.value = "";
	});
	$("#od_id").blur(function(){
		$(this).removeClass("focus");
		if(this.value == "") this.value = "주문서번호";
	});

	$("#od_pwd2").focus(function(){
		$(this).hide();
		$("#od_pwd").show();
		$("#od_pwd").focus();
		$("#od_pwd").addClass("focus");
	});
	$("#od_pwd").blur(function(){
		if(this.value == "")$(this).hide();
		$("#od_pwd2").show();
		$(this).removeClass("focus");
	});
	$("#od_pwd").focus(function(){
		$(this).addClass("focus");
	});
</script>
<!-- <form name=forderinquiry method=post action="<?=$url?>" autocomplete="off" style="padding:0px;">
        <form name=forderinquiry method=post action="<?=urldecode($url)?>" autocomplete="off" style="padding:0px;">
        <table cellpadding=2 bgcolor=#F6F6F6 align=center>
        <tr><td>
            <table width=480 bgcolor=#FFFFFF cellpadding=0>
            <tr><td align=center height=60><img src='<?=$member_skin_path?>/img/title_order.gif'></td></tr>
            <tr>
                <td>
                    <table>
                    <tr>
                        <td>
                            <table>
                            <tr>
                                <td width=120 align=right>주문서번호</td>
                                <td>&nbsp;&nbsp;<input type=text name=od_id size=18 class=ed required itemname="주문서번호" value="<? echo $od_id ?>"></td>
                            </tr>
                            <tr>
                                <td width=120 align=right>패스워드</td>
                                <td>&nbsp;&nbsp;<input type=password name=od_pwd size=18 class=ed required itemname="패스워드"></td>
                            </tr>
                            </table>
                        </td>
                        <td><input type=image src='<?=$member_skin_path?>/img/btn_confirm.gif' border=0 align=absmiddle></td>
                    </tr>
                    </table>
                </td>
            </tr>
            <tr><td background='<?=$member_skin_path?>/img/dot_line.gif'></td></tr>
            <tr><td height=60 style='padding-left:70px; line-height:150%'></td></tr>
            </table></td>
        </tr>
        </table>
        </form>
 -->
    <? } ?>

<? } ?>
