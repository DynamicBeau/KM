<?
$g4_path = "../../..";

include_once("$g4_path/common.php");

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

include_once("$g4[path]/head.sub.php");

$view = get_view($write, $board, $board_skin_path);

if (strstr($sfl, "subject"))
    $view[subject] = search_font($stx, $view[subject]);

$html = 0;
if (strstr($view[wr_option], "html1"))
    $html = 1;
else if (strstr($view[wr_option], "html2"))
    $html = 2;

$view[content] = conv_content($view[wr_content], $html);
if (strstr($sfl, "content"))
    $view[content] = search_font($stx, $view[content]);
$view[content] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' onclick='image_window(this)' style='cursor:pointer;' \\2 \\3", $view[content]);

// 트랙백
$trackback_url = "";
if ($member[mb_level] >= $board[bo_trackback_level]) 
    $trackback_url = "$g4[url]/$g4[bbs]/tb.php/$bo_table/$wr_id";

// 현재글의 스크랩 카운트
$temp =mysql_fetch_array(mysql_query("select count(*) from g4_scrap where bo_table='$bo_table' and wr_id = $wr_id")); 
$scrap_count = $temp[0];

// 이모티콘
function emoticon_html($str, $board_skin_path)
{

	for($i=1; $i<=120; $i++) {
		if($i < 10) {
			$emo_id = "emoticon_00$i";
		} else if($i < 100) {
			$emo_id = "emoticon_0$i";
		} else {
			$emo_id = "emoticon_$i";
		}
		$img_src = "<img src='$board_skin_path/emoticons/$i.gif' width=18 height=18 border=0 title=$emo_id>";
		$str = eregi_replace($emo_id, $img_src, $str);
	}

	return $str;
}

?>

<script language="javascript" src="<?=$g4[path]?>/js/sideview.js"></script>

<!--<link rel='stylesheet' href='<?=$board_skin_path?>/style01.css' type='text/css'> -->

<style>
a:link, a:visited, a:active { text-decoration:none; color:#707070; }
a:hover { text-decoration:underline; color:#ff6600; }
.content { color:#000000; font-size:10pt; font-weight: normal; } /* 내용보기에서 본문 */
.lh  { line-height:200%; } /* 내용보기에서 줄간격 */
.mytitle { font: 14px 돋움,tahoma; font-weight:bold; color:#545454; }
.mytext { font: 11px 돋움,tahoma; color:#707070; float:left; }
.mytext2 { font: 9px tahoma; color:#9d9d9d; float:right; }
</style>

<br>

<table width=95% border=0 align=center cellpadding=0 cellspacing=0>
<tr><td colspan=2 height=1 bgcolor=#ddd></td></tr>
<tr><td colspan=2 height=30 class=mytitle>제 목 : <?=$view[subject]?></td></tr>
<tr><td colspan=2 height=1 bgcolor=#ddd></td></tr>
<tr><td height=25 width=50% class=mytext>작 성 : <?=$view[name]?></td><td width=50% align=right class=mytext2>DATE : <?=substr($view[wr_datetime],2,14)?>&nbsp;&nbsp;</td></tr>
<tr>
	<td colspan=2 height=25 class=mytext>

	<? if ($trackback_url) { ?>
        Trackback URL : <a href="javascript:clipboard_trackback('<?=$trackback_url?>');" style="letter-spacing:0;" title='이 글을 소개할 때는 이 주소를 사용하세요'><?=$trackback_url?></a>&nbsp;
        <script language="JavaScript">
            function clipboard_trackback(str) {
                if (g4_is_gecko)
                    prompt("이 글의 고유주소입니다. Ctrl+C를 눌러 복사하세요.", str);
                else if (g4_is_ie) {
                    window.clipboardData.setData("Text", str);
                    alert("트랙백 주소가 복사되었습니다.\n\n<?=$trackback_url?>");
                }
            }
        </script>
	<? } ?>

	</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#ddd></td></tr>
<tr>
    <td colspan=2>
        <table width=100% cellpadding=5>
        <tr>
            <td style='word-break:break-all;' class='lh' height=100>
		
			<? 	
			// 파일 출력
			for ($i=0; $i<=count($view[file]); $i++) {
				if ($view[file][$i][view]) 
					echo $view[file][$i][view] . "<p>" . $view[file][$i][content] . "<p>";
				
			}

			$view[content] = emoticon_html($view[content], $board_skin_path);
			echo "<span class='content' style='font-size:9pt;'>$view[content]</span>";
			?>

			<?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>

                <!-- 테러 태그 방지용 -->
                </xml></xmp><a href=""></a><a href=''></a>
            </td>
        </tr>


<?
// 가변 파일
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) {
    if ($view[file][$i][source] && !$view[file][$i][view]) {
        $cnt++;
        echo <<<HEREDOC
        <tr><td class=tt>&nbsp;<img src='$board_skin_path/img/icon_file.gif' align='absmiddle'> <a href='{$view[file][$i][href]}' title='{$view[file][$i][content]}'><span class=tt>{$view[file][$i][source]}</span> ({$view[file][$i][size]}), Down:{$view[file][$i][download]}, {$view[file][$i][datetime]}</a></td></tr>
HEREDOC;
    }
}

// 링크
$cnt = 0;
for ($i=1; $i<=$g4[link_count]; $i++) {
    if ($view[link][$i]) {
        $cnt++;
        $link = cut_str($view[link][$i], 70);
        echo <<<HEREDOC
        <tr><td class=tt>&nbsp;<img src='$board_skin_path/img/icon_link.gif' align='absmiddle'> <a href="{$view[link_href][$i]}" target="_blank"><span class=tt>{$link}</span></a>, Hit:{$view[link_hit][$i]}</td></tr>
HEREDOC;
    }
}
?>


         <? if ($is_signature) { echo "<tr><td>$signature</td></tr>"; } // 서명 출력 ?>
        </table>
    </td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#ddd></td></tr>
</table>

<!-- 코멘트 시작 -->
<?
// 자동등록방지
include_once ("$g4[bbs_path]/norobot.inc.php");

$list = array();

$is_comment_write = false;
if ($member[mb_level] >= $board[bo_comment_level]) 
    $is_comment_write = true;

// 코멘트 출력
$sql = " select * from $write_table where wr_parent = '$wr_id' and wr_comment  < 0 order by wr_comment desc, wr_comment_reply ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
    $list[$i] = $row;

    //$list[$i][name] = get_sideview($row[mb_id], cut_str($row[wr_name], 20, ''), $row[wr_email], $row[wr_homepage]);

    $tmp_name = get_text(cut_str($row[wr_name], $config[cf_cut_name])); // 설정된 자리수 만큼만 이름 출력
    if ($board[bo_use_sideview])
        $list[$i][name] = get_sideview($row[mb_id], $tmp_name, $row[wr_email], $row[wr_homepage]);
    else
        $list[$i][name] = "<span class='".($row[mb_id]?'member':'guest')."'>$tmp_name</span>";

    
    // 공백없이 연속 입력한 문자 자르기 (way 보드 참고. way.co.kr)
    //$list[$i][content] = eregi_replace("[^ \n<>]{130}", "\\0\n", $row[wr_content]);
    $list[$i][content] = conv_content($row[wr_content], 0, 'wr_content');
    $list[$i][content] = search_font($stx, $list[$i][content]);

    $list[$i][trackback] = url_auto_link($row[wr_trackback]);
    $list[$i][datetime] = substr($row[wr_datetime],2,14);

    // 관리자가 아니라면 중간 IP 주소를 감춘후 보여줍니다.
    $list[$i][ip] = $row[wr_ip];
    if (!$is_admin)
        $list[$i][ip] = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.♡.\\3.\\4", $row[wr_ip]);

    $list[$i][is_reply] = false;
    $list[$i][is_edit] = false;
    $list[$i][is_del]  = false;
    if ($is_comment_write || $is_admin) 
    {
        if ($member[mb_id]) 
        {
            if ($row[mb_id] == $member[mb_id] || $is_admin) 
            {
                $list[$i][del_link]  = "./delete_comment.php?bo_table=$bo_table&comment_id=$row[wr_id]&page=$page".$qstr;
                $list[$i][is_edit]   = true;
                $list[$i][is_del]    = true;
            }
        } 
        else 
        {
            if (!$row[mb_id]) {
                $list[$i][del_link] = "./password.php?w=x&bo_table=$bo_table&comment_id=$row[wr_id]&page=$page".$qstr;
                $list[$i][is_del]   = true;
            }
        }

        if (strlen($row[wr_comment_reply]) < 5)
            $list[$i][is_reply] = true;
    }

    // 05.05.22
    // 답변있는 코멘트는 수정, 삭제 불가
    if ($i > 0 && !$is_admin)
    {
        if ($row[wr_comment_reply]) 
        {
            $tmp_comment_reply = substr($row[wr_comment_reply], 0, strlen($row[wr_comment_reply]) - 1);
            if ($tmp_comment_reply == $list[$i-1][wr_comment_reply])
            {
                $list[$i-1][is_edit] = false;
                $list[$i-1][is_del] = false;
            }
        }
    }
}

//  코멘트수 제한 설정값
if ($is_admin)
{
    $comment_min = $comment_max = 0;
}
else
{
    $comment_min = (int)$board[bo_comment_min];
    $comment_max = (int)$board[bo_comment_max];
}

//include_once("$board_skin_path/view_comment_print.skin.php");

// 필터
echo "<script language='javascript'> var g4_cf_filter = '$config[cf_filter]'; </script>\n";
echo "<script language='javascript' src='$g4[path]/js/filter.js'></script>\n";

if (!$member[mb_id]) // 비회원일 경우에만
    echo "<script language='javascript' src='$g4[path]/js/md5.js'></script>\n";
?>

<br>
<!-- 코멘트 리스트 -->
<? 
for ($i=0; $i<count($list); $i++) { 
    $comment_id = $list[$i][wr_id];
?>
<a name="c_<?=$comment_id?>"></a>
<table width=95% border=0 align=center cellpadding=0 cellspacing=0>
<tr>
	<td valign=top><? for ($k=0; $k<strlen($list[$i][wr_comment_reply]); $k++) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td>
	<td width='100%'>
		<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="100%" cellspacing="0" cellpadding="0">
				<tr><td colspan=2 height=1 bgcolor=#000000></td></tr>
				<tr>
					<td width="" height="25" align="left" valign="middle" class='vc_pad2'><?=$list[$i][name]?><? if ($is_admin == "super") { ?><? if ($is_ip_view) { echo "&nbsp;({$list[$i][ip]})"; } ?><? } ?></td>
					<td width="300" align="right" valign="middle" class='vc_pad2'>
						<table width="100%" cellspacing="0" cellpadding="0">
							<tr>
								<td align="right" style="PADDING-RIGHT: 5px"><?=$list[$i][datetime]?></td>
							</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr> 
			<td colspan="2" align="left" valign="top" class='vc_pad1 lh' height="50" style='word-break:break-all;'>
				<!-- 코멘트 출력 -->
				<? $list[$i][content] = emoticon_html($list[$i][content], $board_skin_path); ?>

				<span class="content"><?=$list[$i][content]?></span>
				<? if ($list[$i][trackback]) { echo "<p>".$list[$i][trackback]."</p>"; } ?>

				<table width="100%" cellspacing="0" cellpadding="0">
				<tr><td height=20></td></tr></table>
				<textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?=get_text($list[$i][wr_content], 0)?></textarea>
				<span id='edit_<?=$comment_id?>' style='display:none;'></span><!-- 수정 -->
				<span id='reply_<?=$comment_id?>' style='display:none;'></span><!-- 답변 -->
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<? } ?>
<!-- 코멘트 리스트 -->

<!-- 코멘트 끝 -->

<table width=95% border=0 align=center cellpadding=0 cellspacing=0>
<tr>
	<td colspan=2 height="35" align="center"><b><a href=javascript:self.close()><img src="<?=$board_skin_path?>/img/btn_close.gif" border="0"></a>&nbsp;&nbsp;&nbsp;<a href="javascript:window.print();"><img src="<?=$board_skin_path?>/img/btn_print.gif" border="0"></a>&nbsp;&nbsp;
	</td>
</tr> 
</table><br>


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
