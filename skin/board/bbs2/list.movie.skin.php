<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
$image_width = 80;
$image_height = 60;
?>
    <table cellspacing="10" cellpadding="0" class="board_video">
		<col width="50%" />
		<col width="50%" />
	<tr>
	<? for ($i=0; $i<count($list); $i++) { 
		if($i && $i % 2 == 0) echo "</tr><tr>";

		$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
		if(!is_file($imagepath))
		$imagepath = $board_skin_path."/img/noimage.gif";
		$image = "<img src='$imagepath' width='$image_width' height='$image_height' class=image > ";
		?>
		<td><table  cellspacing="0" cellpadding="0" width=100%>
		<tr>
			<td rowspan=3 width="<?=$image_width?>px"><?=$image?>
			<p><a href="javascript:;" onclick="view_video(<?=$list[$i][wr_id]?>)"><img src="<?=$board_skin_path?>/img/view_video_btn.gif"></a></p></td>
			<td rowspan=3 width="10px"></td>
			<td class="subject"><? if ($is_checkbox) { ?><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"><? } ?><a href='<?=$list[$i][href]?>'><?=$list[$i][subject]?></a></td>
		</tr>
		<tr>
			<td>분류: <a href='<?=$list[$i][ca_name_href]?>'><?=$list[$i][ca_name]?></a> <span>|</span> 조회: <?=$list[$i][wr_hit]?></td>
		</tr>
		<tr>
			<td><?=$list[$i][wr_name]?> <span>|</span> <?=$list[$i][datetime2]?></td>
		</tr>
		</table></td>
	<? } // end for ?>
	</tr>
	<? if (count($list) == 0) { echo "<tr><td colspan=2 style='line-height:50px; text-align:center;'>게시물이 없습니다.</td></tr>"; } ?>
	</table>



 <script language="JavaScript">
 function view_video(id){
	win_open("<?=$board_skin_path?>/view_video.php?bo_table=<?=$bo_table?>&wr_id="+id, "view_movie", "left=50,top=50,width=930,height=454,scrollbars=0");
 }
 </script>
