<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<style>
input{margin:0; padding:0;}
#box{width:215px; height:117px; border:1px solid #dbd4d0; background-color:#fbfbfb; text-align:center; padding:17px 0 17px 0;}
#box_top{width:183px; margin:auto;}
.t1{border:1 solid #dedede; border-bottom:0; padding:0; margin:0; width:128px; height:22px;}
.t2{border:1 solid #dedede; padding:0; margin:0; width:128px; height:22px;}
#t3{float:right;}
#l_table{width:100%;}
.t_text{color:#a09b98; font-family:돋움; font-size:11px;}
.t_text a:link, a:active, a:visited{color:#a09b98; font-family:돋움; font-size:11px; text-decoration:none;}
.t_text a:hover{color:#a09b98; font-family:돋움; font-size:11px; text-decoration:none;}
a.t_text2:link, a.t_text2:active, a.t_text2:visited{color:#ff6c00; font-family:돋움; font-size:13px; text-decoration:none; font-weight:bold;}
a.t_text2:hover{color:#ff6c00; font-family:돋움; font-size:13px; text-decoration:none; font-weight:bold;}
#saveImg{background:url(<?=$outlogin_skin_path?>/img/saveID.gif) no-repeat; width:54px; height:10px;}
.list_1{ list-style:none; padding:0; margin:0;}
.list_1 li{display:inline;}
.line{width:100%; height:1px; background-color:#dcd6d2; margin:10px 0 10px 0; font-size:1px;}
.list_2{list-style:none; padding:0; margin:0;}
.list_2 li{float:left;}
.align_center{ text-align:center; vertical-align:middle;}
.gap{height:10px;}
.em{border:0;}
.align_right{ text-align:right;}
</style>

<div id="box">
<div id="box_top">
<div><span class="t_text" style="float:left;"><?=$nick?>님, 환영합니다~</span><span style="float:right;"><? if ($is_admin == "super" || $is_auth){ ?><a href="<?=$g4['admin_path']?>/"><img src="<?=$outlogin_skin_path?>/img/admin.gif" class="em" /></a><? } ?></span></div>
<div class="gap">&nbsp;</div>
<div class="align_center" style="clear:both; margin-top:8px;">
<ul class="list_1" style="clear:both;">
<li><img src="<?=$outlogin_skin_path?>/img/point.gif" /></li>
<li><a href="javascript:win_point();" class="t_text2"><?=$point?></a></li>
<li>&nbsp;&nbsp;&nbsp;</li>
<li><img src="<?=$outlogin_skin_path?>/img/level.gif" /></li>
<li><a href="javascript:win_level();" class="t_text2"><?=$member[mb_level]?></a></li>
</ul>
</div>
<div class="line"> <!-- --> </div>
<div class="align_center">
<ul class="list_1">
<li class="t_text"><a href="javascript:win_memo();">쪽지</a></li>
<li class="t_text">|</li>
<li class="t_text"><a href="#">내가 쓴글</a></li>
<li class="t_text">|</li>
<li class="t_text"><a href="javascript:win_scrap();" class="t_text">스크랩</a></li>
</ul>
</div>
<div class="gap">&nbsp;</div>
<div class="align_center">
<span style="float:left;"><a href="<?=$g4['bbs_path']?>/member_confirm.php?url=register_form.php"><img src="<?=$outlogin_skin_path?>/img/btn_1.gif" class="em" /></a></span><span style="float:right;"><a href="<?=$g4['bbs_path']?>/logout.php"><img src="<?=$outlogin_skin_path?>/img/btn_2.gif" class="em" /></a></span>
</div>
</div>
</div>



<script type="text/javascript">
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave() 
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?")) 
            location.href = "<?=$g4['bbs_path']?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- 로그인 후 외부로그인 끝 -->
