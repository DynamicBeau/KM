<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<ul style="padding:10px; border:2px solid #1c8bba; margin-bottom:20px;clear:both;">
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
    <li style="position:relative; height:25px;font:bold 13px/25px '맑은 고딕'; background:#F6F6F6; border-bottom:1px solid #EEE;">&nbsp;&nbsp;<img src='<?=$latest_skin_path?>/img/blot.gif' align=absmiddle width=2 height=4>&nbsp;&nbsp;<? 
            echo $nobr_begin;
			echo "<a href='javascript:viewContent({$list[$i][wr_id]})'>";
            echo $list[$i][subject];
            echo "</a>";
            echo $nobr_end;
            ?>
        </li>
	<div style="display:none; border:1px solid #DDD;border-top:0; padding:10px" id="content<?=$list[$i][wr_id]?>"><?=$list[$i][content]?></div>
    <? } // end for ?>

    <? if (count($list) == 0) { echo "<div style='line-height:100px;text-align:center;'>게시물이 없습니다.</div>"; } ?>

</ul>



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

<!-- <ul style="padding:10px; border:2px solid #1c8bba; margin-bottom:20px;">
<? for ($i=0; $i<count($list); $i++) { ?>
<li style="position:relative; height:25px;font:bold 13px/25px '맑은 고딕'; border-bottom:1px solid #EEE;"><img src='<?=$latest_skin_path?>/img/blot.gif' align=absmiddle width=2 height=4> &nbsp;
    <a href='<?=$list[$i][href]?>'><?=$list[$i][subject]?></a>
	<span style="position:absolute;top:0; right:0; height:25px; line-height:25px;font:normal 7pt verdana; color:#999;"><?=date("y-m-d", strtotime($list[$i][wr_datetime]))?></span>
	</li>
<? } ?>
<? if (count($list) == 0) { ?>
<li style="text-align:center; line-height:130px;">게시물이 없습니다.</li>
<? } ?>
</ul> -->
