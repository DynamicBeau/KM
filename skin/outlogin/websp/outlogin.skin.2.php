<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<style>
@charset "utf-8";
/* 로그인 전 */
#websp_login { height: 103px;  overflow: hidden; }
#websp_login fieldset { position: relative; }
#websp_login fieldset legend { display: none; }
#websp_login label { display: none; }

#websp_login .websp_id,
#websp_login .websp_password,
#websp_login .websp_txt { margin-top: 2px; padding: 2px 0 0 5px; width: 65%; height: 18px; }
#websp_login .websp_id {  background: url(../img/id_bg.gif) no-repeat 5px 50%; border: 1px solid #CCC; }
#websp_login .websp_password { background: url(../img/password_bg.gif) no-repeat 5px 50%; border: 1px solid #CCC; }
#websp_login .websp_txt { color: #222; border: 1px solid #CCC; }

#websp_login a { display: block; padding-left: 5px; color: #333; }
#websp_login a:hover { color: #D00; }

#websp_login .login_btn { height: 46px; vertical-align: top; position: absolute; top: 5px; right: 0; }
#websp_login .websp_btn { margin-top: 5px; padding-top: 3px; width: 50px; height: 22px; font-size: 11px; color: #FFF;	background: #333; border: 1px solid #DDD; }

#websp_login ul { margin-top: 10px; padding-bottom: 5px; }
#websp_login ul li { line-height: 17px; }

/* 로그인 후 */
#websp_login2 { padding: 5px 5px 6px; height: 105px; line-height: 15px; overflow: hidden; }
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
<!--logout-->
<div id="websp_login2">
	<? if ($is_admin == "super" || $is_auth) { ?><p><strong><a href="<?=$g4['admin_path']?>/"><?=$nick?></a></strong> 님! 어서오세요 ^^</p>
	<? } else { ?><p><strong><?=$nick?></strong> 님! 어서오세요 ^^</p>
	<? } ?> 
	<ul class="my_info">
		<li class="lv"><strong>레벨 :</strong> <span><?=$member[mb_level]?></span></li>
		<li class="memo"><strong>쪽지 :</strong> <a href="javascript:win_memo();"><?=$memo_not_read?> 개</a></li>
		<li class="point"><strong>포인트 :</strong> <a href="javascript:win_point();"><?=$point?> P</a></li>
	</ul>
	<ul class="log_info">
		<li><a href="<?=$g4[bbs_path]?>/member_confirm.php?url=register_form.php">정보수정</a></li>
		<li class="end"><a href="<?=$g4[bbs_path]?>/logout.php">로그아웃</a></li>
	</ul>
</div>
<!--//logout-->
<!-- 로그인 후 외부로그인 끝 -->
