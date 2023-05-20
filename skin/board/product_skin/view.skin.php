<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
 <link rel="stylesheet" href="<?=$board_skin_path?>/style.css" type="text/css">

<!-- 게시글 보기 시작 -->
<table class="board_table" width=<?=$width?>><tr><td>

	<!-- 내용 출력 -->
	<table width="762px" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td style="padding-top:20px;"><img src="<?=$view[file][0][path] .'/'. $view[file][0][file]?>" style="width:402px;height:402px;"></td>
			<td style="padding-left:51px; ">
				<table style="width:100%;">
					<tr>
						<td colspan="2"><?=cut_hangul_last(get_text($view[wr_subject]))?></td>
					</tr>
						<td>품명</td>
						<td><?=$view[wr_5]?></td>
					</tr>
					</tr>
						<td>모델명</td>
						<td><?=$view[wr_1]?></td>
					</tr>
					</tr>
						<td>규격</td>
						<td><?=$view[wr_2]?></td>
					</tr>
					</tr>
						<td>재질</td>
						<td><?=$view[wr_3]?></td>
					</tr>
					</tr>
						<td>특징</td>
						<td><?=$view[wr_4]?></td>
					</tr>
					<tr>
						<td>
							<a href="/bbs/board.php?bo_table=m31"><img src="<?=$g4[path]?>/images/estimate.png" style="margin-top:15px;"></a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="402px" height="40px" cellpadding="0" cellspacing="0" border="0">
		<tr align="center">
			
			<td style="width:33%;">
				<?if($prev_href){?>
				<a href="<?=$prev_href?>"><img src="<?=$g4[path]?>/images/previous_btn.png">&nbsp;이전상품</a>
				<?}?>
			</td>
			
			<td style="width:33%;"><img src="<?=$g4[path]?>/images/big_img_btn.png">&nbsp;큰이미지</td>
			
			<td style="width:33%;">
				<?if($next_href){?>
				<a href="<?=$next_href?>"><img src="<?=$g4[path]?>/images/next_btn.png">&nbsp;다음상품</a>
				<?}?>
			</td>
			
		</tr>
	</table>

	<div id="writeContents"><?=$view[content];?>
        
        <?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
        <!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>

	<? if ($nogood_href || $good_href) {?>
	<div style="height:55px;">
        <? if ($nogood_href) {?>
        <div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
        <div style="color:#888; margin:7px 0 5px 0;">비추천 : <?=number_format($view[wr_nogood])?></div>
        <div><a href="<?=$nogood_href?>" target="hiddenframe"><img src="<?=$board_skin_path?>/img/icon_nogood.gif" border='0' align="absmiddle"></a></div>
        </div>
        <? } ?>

        <? if ($good_href) {?>
        <div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
        <div style="color:#888; margin:7px 0 5px 0;"><span style='color:crimson;'>추천 : <?=number_format($view[wr_good])?></span></div>
        <div><a href="<?=$good_href?>" target="hiddenframe"><img src="<?=$board_skin_path?>/img/icon_good.gif" border='0' align="absmiddle"></a></div>
        </div>
        <? } ?>
	</div>
	<? } ?>
	</div>

	<? if($board[bo_2] != "movie"){?>
	<div class="fileLink">
		<ul class="info_file">
			<?
			// 가변 파일
			for ($i=0; $i<count($view[file]); $i++) {
				if ($view[file][$i][source] && !$view[file][$i][view]) {
					echo "<li>";
					echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'>";
					echo "{$view[file][$i][source]} ";
					echo "<span class='file_size'>({$view[file][$i][size]})</span>";
					echo "<span class='file_hit'>[{$view[file][$i][download]}]</span>";
					echo "</a></li>";
				}
			}
			?>
		</ul>

		<ol class="info_link">
			<?
			// 링크
			for ($i=1; $i<=$g4[link_count]; $i++) {
				if ($view[link][$i]) {
					$link = cut_str($view[link][$i], 70);
					echo "<li>";
					echo "<a href='{$view[link_href][$i]}' target=_blank>";
					echo "{$link}";
					echo "<span class='link_hit'>[{$view[link_hit][$i]}]</span>";
					echo "</a></li>";
				}
			}
			?> 
		</ol>
	</div>
	<?}?>
	<? if ($is_signature) { echo "<div class='info_signature'>$signature</div>"; } // 서명 출력 ?>



<? 
    ob_start(); 
?>


<div class="view_btn">
    <!-- <div style="float:left;">
    <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\"><img src='$board_skin_path/img/btn_prev.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
    <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\"><img src='$board_skin_path/img/btn_next.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
    </div> -->

    <!-- 링크 버튼 -->
    <div style="float:right;">
    <? if ($copy_href) { echo "<a href=\"$copy_href\"><img src='$board_skin_path/img/btn_copy.gif' border='0' align='absmiddle'></a> "; } ?>
    <? if ($move_href) { echo "<a href=\"$move_href\"><img src='$board_skin_path/img/btn_move.gif' border='0' align='absmiddle'></a> "; } ?>

    <? if ($search_href) { echo "<a href=\"$search_href\"><img src='$board_skin_path/img/btn_list_search.gif' border='0' align='absmiddle'></a> "; } ?>
    <? echo "<a href=\"$list_href\"><img src='$board_skin_path/img/btn_list.gif' border='0' align='absmiddle'></a> "; ?>
    <? if ($update_href) { echo "<a href=\"$update_href\"><img src='$board_skin_path/img/btn_modify.gif' border='0' align='absmiddle'></a> "; } ?>
    <? if ($delete_href) { echo "<a href=\"$delete_href\"><img src='$board_skin_path/img/btn_delete.gif' border='0' align='absmiddle'></a> "; } ?>
    <? if ($reply_href) { echo "<a href=\"$reply_href\"><img src='$board_skin_path/img/btn_reply.gif' border='0' align='absmiddle'></a> "; } ?>
    <? if ($write_href) { echo "<a href=\"$write_href\"><img src='$board_skin_path/img/btn_write.gif' border='0' align='absmiddle'></a> "; } ?>
    </div>
</div>

 <? if ($prev_href) {?>
 <div style="line-height:22px; border-bottom:1px solid #DDD; padding:4px;">
	<a href="<?=$prev_href?>" title="<?=$prev_wr_subject?>"><img src='<?=$board_skin_path?>/img/btn_prev.gif' border='0' align='absmiddle'><?=$prev[ca_name]?" [$prev[ca_name]] ":""?> <?=$prev_wr_subject?></a> 
</div>
<?}?>
 <? if ($next_href) {?>
 <div style="line-height:22px; border-bottom:1px solid #DDD; padding:4px;">
	<a href="<?=$next_href?>" title="<?=$next_wr_subject?>"><img src='<?=$board_skin_path?>/img/btn_next.gif' border='0' align='absmiddle'><?=$next[ca_name]?" [$next[ca_name]] ":""?> <?=$next_wr_subject?></a>
</div>
<?}?>
<?
    $link_buttons = ob_get_contents();
    ob_end_flush();
?>

<?
// 코멘트 입출력
include_once("./view_comment.php");
?>



</td></tr></table>

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
