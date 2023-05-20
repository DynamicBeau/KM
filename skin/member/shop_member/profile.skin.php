<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<div class="ck_profile_warp">
<h1 class="title">PROFILE</h1>
<div class="ck_box">
<table>
	<tr>
		<th>이름</th>
		<td><?=$mb[mb_name]?></td>
	</tr>
	<tr>
		<th>별명</th>
		<td><?=$mb_nick?></td>
	</tr>
	<tr>
		<th>회원권한</th>
		<td><?=$mb[mb_level]?></td>
	</tr>
	<? if($config[cf_use_point]){?>
	<tr>
		<th>포인트</th>
		<td><?=number_format($mb[mb_point])?> 점</td>
	</tr>
	<?}?>
	<? if ($mb_homepage) { ?>
	<tr> 
		<th>홈페이지</th>
		<td><a href="<?=$mb_homepage?>" target="<?=$config[cf_link_target]?>"><?=$mb_homepage?></a></td>
	</tr>
	<? } ?>
	<tr> 
		<th>회원가입일</th>
		<td><?=($member[mb_level] >= $mb[mb_level]) ?  substr($mb[mb_datetime],0,10) ." (".$mb_reg_after." 일)" : "알 수 없음"; ?></td>
	</tr>
	<tr> 
		<th>최종접속일</th>
		<td><?=($member[mb_level] >= $mb[mb_level]) ? $mb[mb_today_login] : "알 수 없음";?></td>
	</tr>
	<tr> 
		<th>자기소개</th>
		<td class="ck_prifile_view"><?=$mb_profile?></td>
	</tr>
</table>


	<a href="javascript:window.close();" class="btn_close">창닫기</a>
</div>
</div>

