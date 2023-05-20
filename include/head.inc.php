<ul>
<li><a href="/">HOME</a></li>
<li><a href="<?=$g4[path]?>/bbs/board.php?bo_table=m43">커뮤니티 |</a></li>
<li><a href="javascript:bookmarksite('□■프로테스트■□','http://<?=$_SERVER[HTTP_HOST]?>');">즐겨찾기 |</a></li>
<?if (strlen($member[mb_id]) > 0) { ?>
<li><a href="<?=$g4[bbs_path]?>/logout.php?url=<?=$urlencode?>">LOGOUT |</a></li>
<? } else {?>
<li><a href="<?=$g4[bbs_path]?>/login.php?url=<?=$urlencode?>">LOGIN |</a></li>
<? } ?>
<?if (strlen($member[mb_id]) > 0) { ?>
<li><a href="<?=$g4[path]?>/shop/mypage.php">마이페이지 |</a></li>
<li><a href="<?=$g4[path]?>/bbs/member_confirm.php?url=register_form.php">정보수정 |</a></li>
<? } else {?>
<li><a href="<?=$g4[bbs_path]?>/register.php">JOIN |</a></li>
<? } ?>
<? if($is_admin){?>
<li><a href="<?=$g4[path]?>/adm/" target="_blank">ADMIN |</a></li>
<? } ?>
</ul>
<ul style='width:500px;'>
<? if ($is_member) { ?>
<li>
포인트 : <a href="javascript:win_point();"><?=number_format($member[mb_point])?>원</a></li>
<li>[
<?
if($member[mb_level]=="2"){
echo "일반";
}else if($member[mb_level]=="3"){ 
echo "업체"; 
}else if($member[mb_level]=="4"){
echo "사원";
}else if($member[mb_level] > 4){
echo "관리자";
}
?>

] <?=cut_str($member[mb_nick],6)?>님 반갑습니다.
<? if($member[mb_level]=="3"){  ?>
(담당사원 - <?$op = get_member($member[mb_1]); echo $op[mb_name].":".$op[mb_hp]; ?>)
<? }?>
</li>

<? } ?>
</ul>
