<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

//작은 이미지 사이즈
$small_width = "70";
$small_height = "50";
//큰이미지
$large_width = "540";
$large_height = "430";

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 7;

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
?>

<!-- 게시판 목록 시작 -->
<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0><tr><td>

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>

<!-- 목록 -->
<? for ($i=0; $i<count($list); $i++) { 

if(!$member[mb_id]) {
	$list[$i][href] = "#";
}

$list_file = sql_fetch("select bf_file from $g4[board_file_table] where bo_table='$bo_table' and bf_no = '0' and wr_id='{$list[$i][wr_id]}'");
if($list_file[bf_file]) {
	$list_file_view[$i] = "<img src='./../data/file/$bo_table/$list_file[bf_file]' style='cursor:pointer' border=0 width=$small_width height=$small_height onmouseover=\"document.getElementById('large').src='./../data/file/$bo_table/$list_file[bf_file]'; document.getElementById('view').href='{$list[$i][href]}'\">";
	$list_lfile_view[$i] = "<a id=view href='#'><img id=large src='./../data/file/$bo_table/$list_file[bf_file]' border=0 width=$large_width height=$large_height></a>";
}else {
	$list_file_view[$i] = "";
	$list_lfile_view[$i] = "";
}
?>

<td width="14%">
<table cellpadding="0" cellspacing="0" border=1 bordercolor="#E1E1E2"><tr><td><?=$list_file_view[$i]?></td></tr></table>
</td>

<?}?>
<? if (count($list) == 0) { echo "<td colspan='$colspan' height=50 align=center>게시물이 없습니다.</td>"; } ?>
    </tr>
</table>


<table width="100%" cellpadding="0" cellspacing="0">
<tr><td height=10></td></tr>
<tr><td>
	<table cellpadding="0" cellspacing="0" border=1 bordercolor="#E1E1E2"><tr><td><?=$list_lfile_view[0]?></td></tr></table>
</td></tr>
</table>


<!-- 페이지 -->
<table width="100%" cellspacing="0" cellpadding="0">
<tr> 
    <td width="100%" align="center" height=30 valign=bottom>
        <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/btn_search_prev.gif' border=0 align=absmiddle title='이전검색'></a>"; } ?>
        <?
        // 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
        //echo $write_pages;
        $write_pages = str_replace("처음", "<img src='$board_skin_path/img/begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
        $write_pages = str_replace("이전", "<img src='$board_skin_path/img/prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
        $write_pages = str_replace("다음", "<img src='$board_skin_path/img/next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
        $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
        $write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><font style=\"font-family:돋움; font-size:9pt; color:#797979\">$1</font></b>", $write_pages);
        $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><font style=\"font-family:돋움; font-size:9pt; color:orange;\">$1</font></b>", $write_pages);
        ?>
        <?=$write_pages?>
        <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/btn_search_next.gif' border=0 align=absmiddle title='다음검색'></a>"; } ?>
    </td>
</tr>
</table>

<!-- 버튼 링크 -->
<form name=fsearch method=get style="margin:0px;">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=sca      value="<?=$sca?>">
<table width=<?=$width?> cellpadding=0 cellspacing=0 align=center>
<tr> 
    <td width="50%" height="40">
        <? if ($list_href) { ?><a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" border="0"></a><? } ?>
        <? if ($write_href) { ?><a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border="0"></a><? } ?>
        <? if ($is_checkbox) { ?>
            <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" border="0"></a>
            <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" border="0"></a>
            <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" border="0"></a>
        <? } ?>
    </td>
    <td width="50%" align="right">
    </td>
</tr>
</table>
</form>

</td></tr></table>

