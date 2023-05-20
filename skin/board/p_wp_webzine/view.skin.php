<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<style type="text/css">
#sns { padding : 2px 0 0 10px; }
</style>

<div style="height:12px; line-height:1px; font-size:1px;">&nbsp;</div>

<!-- 게시글 보기 시작 -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>



<div style="padding:1px 0 0 10px;">
        &nbsp;<span style="font: 10px tahoma; color:#909090;"><?=$view[name]?><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?> | <span style="font: 10px tahoma; color:#707070;"> <?=date("F j, Y", strtotime($view[wr_datetime]))?> | view <strong><?=number_format($view[wr_hit])?></strong></span>
        </div>


<div style="clear:both;">
    <table border=0 cellpadding=0 cellspacing=0 width="100%">
    <tr>
        <td style="padding:18px 0 0 10px;">		
		   <div style="color:#6c83b3; font-size:11px; font-weight:normal; word-break:break-all;">
            <!--<? if ($is_category) { echo ($category_name ? "「$view[ca_name]」 " : ""); } ?>-->
			<span style="font-size: 35px; font-family:'Malgun Gothic',돋움,tahoma; font-weight:bold; color:#545454;"><?=cut_hangul_last(get_text($view[wr_subject]))?></span>&nbsp;
            </div>
			
        </td>
        <td align="right">
		<!--<a href="javascript:scaleFont(+1);"><img src='<?=$board_skin_path?>/img/btn_fontsize_up.gif' border=0 title='글자 확대'></a><a href="javascript:scaleFont(-1);"><img src='<?=$board_skin_path?>/img/btn_fontsize_down.gif' border=0 title='글자 축소'></a>
		<a href="#" onClick="window.open('<?="$board_skin_path/print.php?bo_table=$bo_table&wr_id=$wr_id"?>', '', 'left=150, top=10, width=700, height=500, scrollbars=1');" style="font-size:8pt"><img src="<?=$board_skin_path?>/img/btn_print_article.gif" border="0"  title="프린트하기"></a><a href="javascript:;" onclick="win_formmail('<?=$view[mb_id]?>','<?=$view[wr_name]?>','<?=base64_encode($view[wr_email])?>');"><img src="<?=$board_skin_path?>/img/mail.gif" border="0" title="메일보내기"></a><? if ($scrap_href) { echo "<a href=\"javascript:;\" onclick=\"win_scrap('$scrap_href');\"><img src='$board_skin_path/img/btn_scrap_article.gif' border='0'></a> "; } ?>
            <!--<? if ($trackback_url) { ?><a href="javascript:trackback_send_server('<?=$trackback_url?>');" style="letter-spacing:0;" title='주소 복사'><img src="<?=$board_skin_path?>/img/btn_trackback.gif" border='0' align="absmiddle"></a><?}?>-->
        </td>
    </tr>
    </table>
</div>


<div style="height:20px">


<!-- SNS : 1 -->
<tr><td colspan="2">
<div id="sns">
<!--Linkedin-->
<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
<script type="IN/Share" data-counter="right"></script>
<!--Twitter-->
<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> 
<!--Facebook-->
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like data-send="true" layout="button_count" show_faces="false"></fb:like>
<!--Cyworld-->
<iframe src="http://csp.cyworld.com/ac/external_sp.php?U=<?=$g4['url']?>&B=H"  frameBorder='0' scrolling='no' allowTransparency='true' width='100' height='20'></iframe>
<!--Digg-->
<script type="text/javascript">
(function() {
var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
s.type = 'text/javascript';
s.async = true;
s.src = 'http://widgets.digg.com/buttons.js';
s1.parentNode.insertBefore(s, s1);
})();
</script>
<a class="DiggThisButton DiggCompact"></a>
<!--stumbleupon-->
<script src="http://www.stumbleupon.com/hostedbadge.php?s=1"></script>

</div></td></tr>


<!-- SNS : 1 finish-->

<div style="height:20px">



    <td height="150" style="word-break:break-all; padding:10px;">
        <? 
        // 파일 출력
        for ($i=0; $i<=count($view[file]); $i++) {
            if ($view[file][$i][view]) 
                echo $view[file][$i][view] . "<p>";
        }
        ?>

				<?
// 가변 파일
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) {
    if ($view[file][$i][source] && !$view[file][$i][view]) {
        $cnt++;
        //echo "<tr><td height=30 background=\"$board_skin_path/img/view_dot.gif\">";
        echo "&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_big_file.gif' align=absmiddle border='0'>";
        echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'>";
        echo "&nbsp;<span style=\"font-family:'Malgun Gothic',Tahoma,굴림; font-size:12pt; font-weight:bold; color:#888;\">{$view[file][$i][source]} ({$view[file][$i][size]})</span>";
        echo "&nbsp;<span style=\"color:#ff6600; font-size:11px;\">Download count:{$view[file][$i][download]}</span>";
        //echo "&nbsp;<span style=\"color:#d3d3d3; font-size:11px;\">DATE : {$view[file][$i][datetime]}</span>";
       echo "</a><br>";
    }
}
?>



<?
// 링크
$cnt = 0;
for ($i=1; $i<=$g4[link_count]; $i++) {
    if ($view[link][$i]) {
        $cnt++;
        $link = cut_str($view[link][$i], 70);
        //echo "<tr><td height=30 background=\"$board_skin_path/img/view_dot.gif\">";
        echo "&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_big_link.gif' align=absmiddle border='0'>";
        echo "<a href='{$view[link_href][$i]}' target=_blank>";
        echo "&nbsp;<span style=\"font-family:'Malgun Gothic',Tahoma,굴림; font-size:12pt; font-weight:bold; color:#888;\">{$link}</span>";
        echo "&nbsp;<span style=\"color:#ff6600; font-size:11px;\">Click count:{$view[link_hit][$i]}</span>";
        echo "</a>";
		echo "</a><br><br>";
    }
}
?> 


        <!-- 내용 출력 -->
        <span id="writeContents"><?=$view[content];?></span>
	


		       
        <?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
        <!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>

        <? if ($nogood_href) {?>
        <div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
        <div style="color:#888; margin:7px 0 5px 0;"><span style='font: 11px tahoma; color:#ff6600;'>Bad : <?=number_format($view[wr_nogood])?></span></div>
        <div><a href="<?=$nogood_href?>" target="hiddenframe"><img src="<?=$board_skin_path?>/img/icon_nogood.gif" border='0' align="absmiddle"></a></div>
        </div>
        <? } ?>

        <? if ($good_href) {?>
        <div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
        <div style="color:#888; margin:7px 0 5px 0;"><span style='font: 11px tahoma; color:#3b5998;'>Good : <?=number_format($view[wr_good])?></span></div>
        <div><a href="<?=$good_href?>" target="hiddenframe"><img src="<?=$board_skin_path?>/img/icon_good.gif" border='0' align="absmiddle"></a></div>
        
        <? } ?>
</div>
</td>
</tr>
<? if ($is_signature) { echo "<tr><td align='center' style='border-bottom:1px solid #E7E7E7; padding:5px 0;'>$signature</td></tr>"; } // 서명 출력 ?>
</table>
<br>







<?
// 코멘트 입출력
include_once("./view_comment.php");
?>

<div style="height:1px; line-height:1px; font-size:1px; background-color:#ddd; clear:both;">&nbsp;</div>

<div style="clear:both; height:43px;">
    <div style="float:left; margin-top:10px;">
    <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\"><img src='$board_skin_path/img/btn_prev.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
    <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\"><img src='$board_skin_path/img/btn_next.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
    </div>

    <!-- 링크 버튼 -->
    <div style="float:right; margin-top:10px;">
    <? 
    ob_start(); 
    ?>
    <? if ($copy_href) { echo "<a href=\"$copy_href\"><img src='$board_skin_path/img/btn_copy.gif' border='0' align='absmiddle'></a> "; } ?>
    <? if ($move_href) { echo "<a href=\"$move_href\"><img src='$board_skin_path/img/btn_move.gif' border='0' align='absmiddle'></a> "; } ?>

    <? if ($search_href) { echo "<a href=\"$search_href\"><img src='$board_skin_path/img/btn_list_search.gif' border='0' align='absmiddle'></a> "; } ?>
    <? echo "<a href=\"$list_href\"><img src='$board_skin_path/img/btn_list.gif' border='0' align='absmiddle'></a> "; ?>
    <? if ($update_href) { echo "<a href=\"$update_href\"><img src='$board_skin_path/img/btn_modify.gif' border='0' align='absmiddle'></a> "; } ?>
    <? if ($delete_href) { echo "<a href=\"$delete_href\"><img src='$board_skin_path/img/btn_delete.gif' border='0' align='absmiddle'></a> "; } ?>
    <? if ($reply_href) { echo "<a href=\"$reply_href\"><img src='$board_skin_path/img/btn_reply.gif' border='0' align='absmiddle'></a> "; } ?>
    <? if ($write_href) { echo "<a href=\"$write_href\"><img src='$board_skin_path/img/btn_write.gif' border='0' align='absmiddle'></a> "; } ?>
    <?
    $link_buttons = ob_get_contents();
    ob_end_flush();
    ?>
    </div>
</div>

<div style="height:1px; line-height:1px; font-size:1px; background-color:#dedede; clear:both;">&nbsp;</div>

</td></tr></table><br>

<script type="text/javascript">
function file_download(link, file) {
    <? if ($board[bo_download_point] < 0) { ?>if (confirm("'"+file+"' 파일을 다운로드 하시면 포인트가 차감(<?=number_format($board[bo_download_point])?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))<?}?>
    document.location.href=link;
}
</script>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript">
window.onload=function() {
    resizeBoardImage(<?=(int)$board[bo_image_width]?>);
    drawFont();
}
</script>
<!-- 게시글 보기 끝 -->