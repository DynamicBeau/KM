<?
$colspan = 2;
if ($is_checkbox) $colspan +=2;

?>

    <table cellspacing="0" cellpadding="0" class="board_faq">
		<col width="50" />
		<? if ($is_checkbox) { ?><col width="20" /><? } ?>
		<? if ($is_checkbox) { ?><col width="40" /><? } ?>
		<col width="" />
    <? for ($i=0; $i<count($list); $i++) {
		
		$html = 0;
		if (strstr($list[$i][wr_option], "html1"))
			$html = 1;
		else if (strstr($list[$i][wr_option], "html2"))
			$html = 2;

		$list[$i][content] = conv_content($list[$i][wr_content], $html);
		if (strstr($sfl, "content"))
			$list[$i][content] = search_font($stx, $list[$i][content]);
		$list[$i][content] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' onclick='image_window(this)' style='cursor:pointer;' \\2 \\3", $list[$i][content]);

		?>
    <tr> 
        <td class="num"><?=$list[$i][num]?></td>
        <? if ($is_checkbox) { ?><td class="checkbox"><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"></td><? } ?>
        <? if ($is_checkbox) { ?><td><a href="<?=$g4[bbs_path]?>/write.php?w=u&bo_table=<?=$bo_table?>&wr_id=<?=$list[$i][wr_id]?>"><img src="<?=$board_skin_path?>/img/icon_modify.gif"  align='absmiddle' /></a></td><? } ?>

        <td class="subject">
            <? 
            echo $nobr_begin;
			echo "<a href='javascript:viewContent({$list[$i][wr_id]})'>";
            echo $list[$i][subject];
            echo "</a>";
            echo $nobr_end;
            ?>
        </td>
    </tr>
	<tr style="display:none" id="content<?=$list[$i][wr_id]?>"><td colspan=<?=$colspan?> class="content"><?=$list[$i][content]?></td></tr>
    <? } // end for ?>

    <? if (count($list) == 0) { echo "<tr><td colspan='$colspan' style='line-height:100px;'>게시물이 없습니다.</td></tr>"; } ?>

    </table>
	<script language="JavaScript">
	var pnum = "";
	function viewContent(id){
		var v = document.getElementById("content"+id);
		var p = document.getElementById("content"+pnum);
		
	
		if(pnum == ""){
			v.style.display = "";
			pnum = id;
		}else if(pnum == id){
			v.style.display = "none";
			pnum = "";
		}else{
			p.style.display = "none";
			v.style.display = "";
			pnum = id;
		}
	}
	//viewContent(<?=$list[0][wr_id]?>);
	</script>
<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript">
window.onload=function() {
    resizeBoardImage(<?=(int)$board[bo_image_width]?>);
    drawFont();
}
</script>
