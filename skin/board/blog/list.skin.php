<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 


// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 8;
$cmt_width = $width - 100;
// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>

if ($member[mb_id]) {
   $name = $member[mb_nick];
   $email = $member[mb_email];
   $homepage = set_http($member[mb_homepage]);
	if($is_admin) {
   		$wr_password = $write[wr_password];
    }
}

$trackback_url = ""; 
if ($member[mb_level] >= $board[bo_trackback_level]) { 
    if (isset($g4['token_time']) == false) 
        $g4['token_time'] = 3; 
    $trackback_url = "$g4[url]/$g4[bbs]/tb.php/$bo_table/$wr_id"; 
} 


/*
$list['trackback_url'] = ""; 
if ($member[mb_level] >= $board[bo_trackback_level]) { 
    if (isset($g4['token_time']) == false) 
        $g4['token_time'] = 3; 
   $list['trackback_url'] = "$g4[url]/$g4[bbs]/tb.php/$list['bo_table']/$list['wr_id']"; 

} 
*/


?>
<style>
<!--
a.text:link, a.text:visited, a.text:active { color:#A8A8A8; text-decoration:none;}
a.text:hover { color:#FFBECC; text-decoration:none;}

.no_title { font-family:나눔고딕,돋움,Tahoma,Verdana; font-size:11px; text-align:left; }
.no_by { font-family:나눔고딕,돋움,Tahoma,Verdana; font-size:11px; text-align:left;}
.color_pink1 { color:#F99FA6; }
.color_pink2 { color:#EFA8AE; }
.color_gray1 { color:#BCBCBC; }
.color_gray2 { color:#999999; }

.ed { background-color:#FFF6F6; border:1px solid #FFE6E6;}
.tx { background-color:#FFF6F6; border:1px solid #FFE6E6;
	scrollbar-face-color: #FFFFFF;
	scrollbar-highlight-color: #FFFFFF;
	scrollbar-3dlight-color: #FFDEDE;
	scrollbar-shadow-color: #FFFFFF;
	scrollbar-darkshadow-color: #FFDEDE;
	scrollbar-track-color: #FFF6F6;
	scrollbar-arrow-color: #FDB6B6;
	overflow-x:hidden; overflow-y:auto;} 

.vc_pad1 { PADDING-LEFT: 6px; PADDING-top: 5px; PADDING-BOTTOM: 5px; } 
.vc_pad2 { PADDING-RIGHT: 6px; PADDING-top: 4px; PADDING-BOTTOM: 4px; } 
-->
</style>



<table width="100%" align=center cellpadding=0 cellspacing=0>
	<tr>
		<td>

			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
                    <td align="center">
                        <p align="right"><? if ($write_href) { ?><a href="<?=$write_href?>">글올리기</a><? } ?><? if ($admin_href) { ?><a href="../chieblog/<?=$admin_href?>"><img src="../chieblog/<?=$board_skin_path?>/img/admin.gif" title="관리자" border="0" align="absmiddle"></a><? } ?></p>

					</td>
				</tr>
				<tr>
					<td align="center">
						<!-- 게시물 리스트 시작 -->
						<? 
							$lists = array();
							for ($i=0; $i<count($list); $i++) {
							$lists[$i] = $list[$i]; 
							} 
						?>
						<? for ($ii=0; $ii < count($lists); $ii++) {
							$profile = get_member($lists[$ii][mb_id]);
							
						
							include "$board_skin_path/inc.list_main.php"; 
							$secret_msg="";
							$reply_allow="";
							$wr_homepage = set_http($lists[$ii][wr_homepage]);
							if($lists[$ii][wr_option]=="secret") {
								if($member[mb_id] == $lists[$ii][mb_id] || $is_admin) {
									$reply_allow = "yes";
									$secret_msg = "<br><br><font color=#FF89A3>(관리자와 글쓴이에게만 보이는 비밀글입니다.)</font>";
									$a_update = str_replace("w=u","w=u&mode=secret",$a_update);
								} else {
									$lists[$ii][wr_content] = "<font color=#FF89A3>글쓴이와 관리자만 볼 수 있습니다.";
									if(!$lists[$ii][mb_id]) {
										$lists[$ii][wr_content] .= "<br><br> 비회원으로 쓰신 글은 글쓴이확인이 불가능하므로 내용확인이 불가능합니다.";
									}
									$lists[$ii][wr_content] .= "</font>";
									//$lists[$ii][name] = "<font color=#ff0000>비공개</font>";
									$reply_allow = "no";
									$secret_msg = "";
								}
							}
						?>
						<table width="<?=$width?>" border="0" cellspacing="0" cellpadding="0" style='table-layout:fixed;'>
							<tr>
								<td align="center">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" style='table-layout:fixed;'>
									<form name="fboardlist" method="post" action="" style="margin:0">
									<input type="hidden" name="bo_table" value="<?=$bo_table?>">
									<input type="hidden" name="sfl"      value="<?=$sfl?>">
									<input type="hidden" name="stx"      value="<?=$stx?>">
									<input type="hidden" name="spt"      value="<?=$spt?>">
									<input type="hidden" name="page"     value="<?=$page?>">
									<input type="hidden" name="sw"       value="">


										<tr>
                                            <td width="100%" height="28" class="no_title">
											<div style="width:360px; float:left; font-size:20px; font-weight:bold;"><?=$lists[$ii][subject]?></div>
											<div style="float:right; font-size:11px; line-height:28px;">No.<?=$lists[$ii][num]?> <? echo $lists[$ii][ca_name]; ?> <img src="<?=$board_skin_path?>/img/line.gif"> <span style="color:#a7a7a7"><?=date("F j, Y, g:i a", strtotime($lists[$ii][wr_datetime]))?></span> <img src="<?=$board_skin_path?>/img/line.gif"> <?=$show_update_begin?><?=$a_update?>수정</a> <img src="<?=$board_skin_path?>/img/line.gif"> <?=$show_update_end?> <?=$show_delete_begin?><?=$a_delete?>삭제</a><?=$show_delete_end?></div>
											</td>
										</tr>
										<tr><td height="1" bgcolor="#cccccc"></td></tr>
										<tr><td height="1" bgcolor="#eeeeee"></td></tr>
										
										<tr>
											<td style="border-bottom:1px solid #eee; height:28px;" align="left">

<?php
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////// 2010년 8월 14일 제작 : 테러보이 /////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
// 공통사용
/////////////////////////////////////////////////////////////////////////////////////////////
// UTF전용
$subject_con = $view[wr_subject];
/////////////////////////////////////////////////////////////////////////////////////////////
// 현제 페이지 주소 추출
$board_url = $trackback_url."".$lists[$ii][wr_id];
// 2010 10 19 수정
// 다수 파라미터 지원 불가로 게시판 주소에서 트래백으로 변경 $board_url -> $trackback_url
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////
// 트위터
/////////////////////////////////////////////////////////////////////////////////////////////
// URL붙이기 // 일부 시스템에서만 사용
$url= $subject_con."   ".$board_url;
//URL암호화
$url = urlencode($url);
/////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////
// 페이스북
/////////////////////////////////////////////////////////////////////////////////////////////
$face_url= $board_url;
$face_url = urlencode($face_url);
$face_subject = urlencode($subject_con);
/////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////
// 미투데이
/////////////////////////////////////////////////////////////////////////////////////////////
$me2_url= $board_url;
$me2_url = urlencode($me2_url);
$me2_subject = urlencode($subject_con);
$me2_url_text = $config[cf_title]; // 홈페이지 제목으로 출력
$me2_url_text = str_replace("\"","˝","$me2_url_text"); // 사이트 명에 따온표 들어 가면 출력 안되던것 수정 // 2010 10 19 수정
$me2_url_text = urlencode($me2_url_text); // 인코딩
$me2_teg = $g4['title']; // 테그 부분에 현제글 위치 표기
$me2_teg = urlencode($me2_teg); // 인코딩
/////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////
// 요즘 잘않쓰므로 삭제
/////////////////////////////////////////////////////////////////////////////////////////////
// $yozm_url= $board_url;
// $yozm_url = urlencode($yozm_url);
// $yozm_subject = urlencode($subject_con);
/////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////
// 구글, 네이버 공용
/////////////////////////////////////////////////////////////////////////////////////////////
$subject = urlencode($subject_con);
/////////////////////////////////////////////////////////////////////////////////////////////

?>




											<div style="width:360px; float:left; font-size:11px"><? echo $board_url ?></div>
											<div style="float:right; font-size:11px;">
											<a href="http://twitter.com/home/?status=<?=$url?>" target="_blank"><img src="<?=$board_skin_path?>/img/icon/twitter.png" width="18" height="18" border="0" alt="게시글을 twitter로 보내기"></a>
<a href="http://www.facebook.com/sharer.php?u=<?=$face_url?>&t=<?=$face_subject?>" target="_blank"><img src="<?=$board_skin_path?>/img/icon/facebook.png" width="18" height="18" border="0" alt="게시글을 facebook으로 보내기"></a>
<a href='http://me2day.net/posts/new?new_post[body]=<?=$me2_subject?>+++++++["<?=$me2_url_text?>":<?=$me2_url?>+]&new_post[tags]=<?=$me2_teg?>'  target="_blank"><img src="<?=$board_skin_path?>/img/icon/Me2Day.png" width="18" height="18" border="0" alt="게시글을 Me2Day로 보내기"></a>
<!--<a href="http://yozm.daum.net/api/popup/prePost?sourceid=41&link=<?=$yozm_url?>&prefix=<?=$yozm_subject?>" target="_blank"><img src="<?=$board_skin_path?>/img/icon/yozm.png" width="18" height="18" alt="게시글을 요즘으로 보내기" border="0"></a>-->
<!--------------------------------------- 새로추가 ----------------------------------------->
<a href="https://www.google.com/bookmarks/mark?op=add&title=<?=$subject?>&bkmk=<?=$board_url?>" target="_blank"><img src="<?=$board_skin_path?>/img/icon/google.png" width="18" height="18" alt="게시글을 구글로 북마크 하기" border="0"></a>
<a href="http://bookmark.naver.com/post?ns=1&title=<?=$subject?>&url=<?=$board_url?>" target="_blank"><img src="<?=$board_skin_path?>/img/icon/naver.png" width="18" height="18" alt="게시글을 네이버로 북마크 하기" border="0"></a>
											</div>
											</td>
										</tr>

										<tr>
                                            <td width="100%" align="center">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" height="22" bgcolor="white">
                                                    <tr>
                                                        <td height="22" align="center" style='word-break:break-all; padding:2px;' valign="top" width="100%">

                                                            <p align="center">        <font color=#999999><? 
		$wr_id = $lists[$ii][wr_id];
		for ($j=0; $j<=count($lists[$ii][file]); $j++) { 
			if($lists[$ii][file][$j][view]) 
				//이미지 링크를 없앤다.
				$lists[$ii][file][$j][view] = 
				str_replace("onclick='image_window(this);' style='cursor:pointer;'","",$lists[$ii][file][$j][view]);  
				echo $lists[$ii][file][$j][view];
			if ($lists[$ii][file][$j][bf_content]) {
				echo "<div style='font-family:Tahoma;font-size:11px;color:#3388DD;padding-top:8'>".$lists[$ii][file][$j][bf_content] ."</div><p>"; }
		} 
        ?>
<?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?></font></p>
   </td>
                                                    </tr>
                                                </table>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="100%" align="center" valign="top" height="196">

                                                            <p align="center"><font color=#999999><?=nl2br(stripslashes($lists[$ii][wr_content]));?><? echo $secret_msg; ?></font></p>
</td>
													</tr>
												</table>
											</td>
										</tr>
										<!--
										<tr>
											<td height="18" align="right" colspan="2"><? if($is_admin || $lists[$ii][comment_cnt]) { ?>|&nbsp;&nbsp;<? if($is_admin) { ?></span></font><span class="no_title color_pink2" style="font-size:9pt;"><a href="javascript:comment_wri('wri', '<?=$lists[$ii][wr_id]?>');"><font face="돋움" color="#CCCCCC"><? } ?><? if($lists[$ii][comment_cnt]) { ?>답변 <?=$lists[$ii][comment_cnt]?>&nbsp;<? } else { ?>답변 달기&nbsp;<? } ?><? if($is_admin) { ?></font></a></span><font face="돋움" color="#CCCCCC"><span class="no_title color_pink2" style="font-size:9pt;"><? } ?><? } ?></span></font></td>
										</tr>
										-->
									</form>
										<tr>
											<td align=right colspan="2">
												<table width="88%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td>
<font face="돋움" color="#CCCCCC"><span class="no_title color_pink2" style="font-size:9pt;">															<!-- 게시물 내용 보기 끝 -->
															<?
																$wr_id = $lists[$ii][wr_id];
																include ("$board_skin_path/view_comment.php");
															?>
</span></font>														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr><td height="1" bgcolor=#e7e7e7></td></tr>
										<tr><td height="20px"></td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="16"></td>
							</tr>
						</table>
					<?
					} 
					// 필터
					echo "<script language='javascript'> var g4_cf_filter = '$config[cf_filter]'; </script>\n";
					echo "<script language='javascript' src='$g4[path]/js/filter.js'></script>\n";

					if (!$member[mb_id]) // 비회원일 경우에만
						echo "<script language='javascript' src='$g4[path]/js/md5.js'></script>\n";
					?>
						
					<? if (count($lists) == 0) { echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td align=center colspan='2' height=100 class='content contentbg'>자료가 없습니다.</td></tr></table>"; } ?>

						<!-- 페이지 -->
						<table width="100%" cellspacing="0" cellpadding="0">
							<tr> 
								<td width="100%" align="center" height=30 valign=bottom>
									<? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/btn_search_prev.gif' border=0 title='이전검색'></a>"; } ?>
									<?
									// 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
									//echo $write_pages;
									$write_pages = str_replace("처음", "<img src='$board_skin_path/img/begin.gif' border='0' title='처음'>", $write_pages);
									$write_pages = str_replace("이전", "<img src='$board_skin_path/img/prev.gif' border='0' title='이전'>", $write_pages);
									$write_pages = str_replace("다음", "<img src='$board_skin_path/img/next.gif' border='0' title='다음'>", $write_pages);
									$write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/end.gif' border='0' title='맨끝'>", $write_pages);
									$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><font color=#666666>$1</font></b>", $write_pages);
									$write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><font color=#cccccc>$1</font></b>", $write_pages);
									?>
									<?=$write_pages?>
									<? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/btn_search_next.gif' border=0 title='다음검색'></a>"; } ?>
								</td>
							</tr>
						</table>

						<!-- 버튼 링크 -->
						<form name=fsearch method=get style="margin:0px;">
						<input type=hidden name=bo_table value="<?=$bo_table?>">
						<input type=hidden name=sca      value="<?=$sca?>">
						<table width=100% cellpadding=0 cellspacing=0>
							<tr> 
                                    <td width="80%" height="40" align="left">
<? if ($list_href) { ?><a href="<?=$list_href?>">목록</a><? } ?>
<? if ($write_href) { ?><a href="<?=$write_href?>">글올리기</a><? } ?>
								</td>
                                    <td width="20%" align="right">
								<input type="hidden" name=sfl value='wr_subject||wr_content'><input type="hidden" name=sop value="and">
								<input name=stx maxlength=15 size=20 itemname="검색어" required value="<?=$stx?>" class="ed" style="background-color:white; border-width:1; border-color:rgb(204,204,204); border-style:solid;">
								<input type=image src="<?=$board_skin_path?>/img/search.gif" border=0 align=absmiddle> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>
						</table>
						</form>

					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<script language="JavaScript">
//if ("<?=$sca?>") document.fcategory.sca.value = "<?=$sca?>";
if ("<?=$stx?>") {
    document.fsearch.sfl.value = "<?=$sfl?>";
    document.fsearch.sop.value = "<?=$sop?>";
}
</script>

<script language="JavaScript">
// HTML 로 넘어온 <img ... > 태그의 폭이 테이블폭보다 크다면 테이블폭을 적용한다.
function resize_image()
{
    var target = document.getElementsByName('target_resize_image[]');
    var image_width = parseInt('<?=$board[bo_image_width]?>');
    var image_height = 0;

    for(i=0; i<target.length; i++) { 
        // 원래 사이즈를 저장해 놓는다
        target[i].tmp_width  = target[i].width;
        target[i].tmp_height = target[i].height;
        // 이미지 폭이 테이블 폭보다 크다면 테이블폭에 맞춘다
        if(target[i].width > image_width) {
            image_height = parseFloat(target[i].width / target[i].height)
            target[i].width = image_width;
            target[i].height = parseInt(image_width / image_height);
        }
    }
}

window.onload = resize_image;
</script>

<? if ($is_checkbox) { ?>
<script language="JavaScript">
function all_checked(sw)
{
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function check_confirm(str)
{
    var f = document.fboardlist;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(str + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    return true;
}

// 선택한 게시물 삭제
function select_delete()
{
    var f = document.fboardlist;

    str = "삭제";
    if (!check_confirm(str))
        return;

    if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
        return;

    f.action = "./delete_all.php";
    f.submit();
}

// 선택한 게시물 복사 및 이동
function select_copy(sw)
{
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    if (!check_confirm(str))
        return;

    var sub_win = window.open("", "move", "left=50, top=50, width=396, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<? } ?>

