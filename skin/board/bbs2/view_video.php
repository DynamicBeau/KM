<? //-- 일반동영상(wmv,swf) PLAY

$g4_path = "../../..";
$movie_path = "/movie";  //동영상 업로드 폴더의 경로
include_once("$g4_path/common.php");
include_once("$g4[path]/lib/latest.lib.php");
include_once("$g4[path]/lib/common.lib.php");
include_once("$g4[path]/head.sub.php"); 

// wr_id 값이 있으면 글읽기 
if ($wr_id) {
    // 글이 없을 경우 해당 게시판 목록으로 이동
    if (!$write[wr_id]) {
        $msg = "글이 존재하지 않습니다.\\n\\n글이 삭제되었거나 이동된 경우입니다.";
        if ($cwin)
            alert_close($msg);
        else
            alert($msg, "./board.php?bo_table=$bo_table");
    }

    // 로그인된 회원의 권한이 설정된 읽기 권한보다 작다면
    if ($member[mb_level] < $board[bo_read_level]) {
        if ($member[mb_id]) 
            alert("글을 읽을 권한이 없습니다.");
        else 
            alert("글을 읽을 권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보십시오.", "./login.php?wr_id=$wr_id{$qstr}&url=".urlencode("board.php?bo_table=$bo_table&wr_id=$wr_id"));
    }

    // 자신의 글이거나 관리자라면 통과
    if (($write[mb_id] && $write[mb_id] == $member[mb_id]) || $is_admin)
        ;
    else {
        // 비밀글이라면
        if (strstr($write[wr_option], "secret")) {
            $ss_name = "ss_secret_{$bo_table}_$write[wr_num]";
            //$ss_name = "ss_secret_{$bo_table}_{$wr_id}";
            // 한번 읽은 게시물의 번호는 세션에 저장되어 있고 같은 게시물을 읽을 경우는 다시 패스워드를 묻지 않습니다.
            // 이 게시물이 저장된 게시물이 아니면서 관리자가 아니라면
            //if ("$bo_table|$write[wr_num]" != get_session("ss_secret")) 
            if (!get_session($ss_name)) 
                goto_url("./password.php?w=s&bo_table=$bo_table&wr_id=$wr_id{$qstr}");

            set_session($ss_name, TRUE);
        }
    }

    // 한번 읽은글은 브라우저를 닫기전까지는 카운트를 증가시키지 않음
    $ss_name = "ss_view_{$bo_table}_{$wr_id}";
    if (!get_session($ss_name)) 
    {
        sql_query(" update $write_table set wr_hit = wr_hit + 1 where wr_id = '$wr_id' ");

        // 자신의 글이면 통과
        if ($write[mb_id] && $write[mb_id] == $member[mb_id])
            ;
        else {
            // 회원이상 글읽기가 가능하다면
            //if ($board[bo_read_level] > 1) {
                // 글읽기 포인트가 음수이고 회원의 포인트가 0 이거나 작다면
                //if ($board[bo_read_point] < 0 && $member[mb_point] <= 0)
                if ($member[mb_point] + $board[bo_read_point] < 0)
                    alert("보유하신 포인트(".number_format($member[mb_point]).")가 없어나 모자라서 글읽기(".number_format($board[bo_read_point]).")가 불가합니다.\\n\\n포인트를 모으신 후 다시 글읽기 해 주십시오.");

                insert_point($member[mb_id], $board[bo_read_point], "$board[bo_subject] $wr_id 글읽기");
            //}
        }

        set_session($ss_name, TRUE);
    }

    $g4[title] = "$group[gr_subject] > $board[bo_subject] > " . strip_tags(conv_subject($write[wr_subject], 255));
} else {
    if ($member[mb_level] < $board[bo_list_level]) {
        if ($member[mb_id]) 
            alert("목록을 볼 권한이 없습니다.");
        else 
            alert("목록을 볼 권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보십시오.", "./login.php?wr_id=$wr_id{$qstr}&url=".urlencode("board.php?bo_table=$bo_table&wr_id=$wr_id"));
    }

    if (!$page) $page = 1; 

    $g4[title] = "$group[gr_subject] > $board[bo_subject] $page 페이지";
}

$view = get_view($write, $board, $board_skin_path);

$html = 0;
if (strstr($view[wr_option], "html1"))
    $html = 1;
else if (strstr($view[wr_option], "html2"))
    $html = 2;

$view[content] = conv_content($view[wr_content], $html);
if (strstr($sfl, "content"))
    $view[content] = search_font($stx, $view[content]);
$view[content] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' onclick='image_window(this)' style='cursor:pointer;' \\2 \\3", $view[content]);

?>




<table cellpadding=0 cellspacing=0 width=100%>
<tr>
	<!-- <td width=600 height=453 background="<?=$board_skin_path?>/img/movie/movie_bg.jpg"> --><td width=600 height=453 ><div style="width:560px; height:349px; margin-top:75px; margin-left:20px;overflow: hidden;">
	
	<?
	/*
	$wr_9 = $view[wr_9];
	$wr_9 = preg_replace("/(width=[\"|\']?[0-9]{0,4}[\"|\']?)/", "width=560", $wr_9);
	$wr_9 = preg_replace("/(height=[\"|\']?[0-9]{0,4}[\"|\']?)/", "height=349", $wr_9);
	$wr_9 = preg_replace("/(\>\<\/embed\>?)/", " wmode=\"transparent\" ></embed>", $wr_9);
	$wr_9 = preg_replace("/(\>\<\/object\>?)/", " ><param name=\"wmode\" value=\"transparent\" /></object>", $wr_9);
	echo $wr_9;
	*/
	?>
		<?=$view[wr_9]?>
	</div></td>
	<td valign=top><h4 style="border:1px solid #DDD; background:url(<?=$board_skin_path?>/img/moive/movie_title_bg.gif) repeat-x; height:38px; line-height:38px;margin:20px 10px; text-align:center; font-weight:bold;"><?=cut_hangul_last(get_text($view[wr_subject]))?></h4>
	<div id="writeContents" style="margin:0 10px; height:370px;overflow:auto; width:310px;"><?=$view[content];?>
        
        <?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
        <!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>
	</div></td>
</tr>
</table>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript">
window.onload=function() {
    resizeBoardImage("300");
    drawFont();
}
</script>
<?
include_once("$g4[path]/tail.sub.php"); 

?>
