<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<div id="ck_member_wrap">
<h2 class="ck_join_title">Sign up</h2>
<ul class="ck_register_step">
<li>가입약관 동의</li>
<li class="ck_arrow"></li>
<li>개인정보 입력</li>
<li class="ck_arrow"></li>
<li class="ck_this">회원가입 완료</li>
</ul>

<div class="ck_box">
		<h3 class="ck_register_title"><?=$mb[mb_name]?> [<?=$mb[mb_id]?>] 님의 회원가입을 진심으로 축하합니다.</h3>
		<div class="ck_register_text">
			<p>회원님의 패스워드는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.
			<p>아이디, 패스워드 분실시에는 회원가입시 입력하신 이메일로 찾으실 수 있습니다.
                        
			<? if ($config[cf_use_email_certify]) { ?>
			<p>E-mail(<?=$mb[mb_email]?>)로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다.
			<? } ?>

			<p>회원의 탈퇴는 언제든지 가능하며 탈퇴 후 일정기간이 지난 후, 회원님의 모든 소중한 정보는 삭제하고 있습니다.<p>감사합니다.
		</div>
	<div class="ck_gohome_btn"><a href="<?=$g4[path]?>">첫 페이지로 가기</a></div>
</div>

</div><!-- ck_wrap -->

 
