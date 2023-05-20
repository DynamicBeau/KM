<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<div class="ck_scrap_warp">
<h1 class="title">SCRAP <span>BOX</span></h1>
<div class="ck_box">

<table>
	<colgroup>
		<col width="10%" />
		<col width="12%" />
		<col width="38%" />
		<col width="25%" />
		<col width="10%" />
	</colgroup>
	<tr>
		<th>번호</th>
		<th>게시판</th>
		<th>제목</th>
		<th>보관일시</th>
		<th>삭제</th>
	</tr>
	 <? for ($i=0; $i<count($list); $i++) { ?>
	<tr>
		<td class="num"><?=$list[$i][num]?></td>
		<td class="board"><a href="javascript:;" onclick="opener.document.location.href='<?=$list[$i][opener_href]?>';"><?=$list[$i][bo_subject]?></a></td>
		<td class="subject"><a href="javascript:;" onclick="opener.document.location.href='<?=$list[$i][opener_href_wr_id]?>';"><?=$list[$i][subject]?></a></td>
		<td class="date"><?=$list[$i][ms_datetime]?></td>
		<td class="del"><a href="javascript:del('<?=$list[$i][del_href]?>');"><img src="<?=$member_skin_path?>/img/btn_comment_delete.gif" width="45" height="14" border="0"></a></td>
	</tr>
	<?}?>
	<? if ($i == 0) echo "<tr><td colspan=5 style='text-align:center; line-height:100px;'>자료가 없습니다.</td></tr>"; ?>

</table>

	<div class="pagenum"><?
			$scrap_pages = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
			$scrap_pages = str_replace(" &nbsp;", "", $scrap_pages);
			$scrap_pages = str_replace("처음", "<img src='$member_skin_path/img/page_begin.gif' align='absmiddle' title='처음'>", $scrap_pages);
			$scrap_pages = str_replace("이전", "<img src='$member_skin_path/img/page_prev.gif' align='absmiddle' title='이전'>", $scrap_pages);
			$scrap_pages = str_replace("다음", "<img src='$member_skin_path/img/page_next.gif' align='absmiddle' title='다음'>", $scrap_pages);
			$scrap_pages = str_replace("맨끝", "<img src='$member_skin_path/img/page_end.gif' align='absmiddle' title='맨끝'>", $scrap_pages);
			$scrap_pages = preg_replace("/><span>([0-9]*)<\/span>/", " class='page'>$1", $scrap_pages);
			$scrap_pages = preg_replace("/<b>([0-9]*)<\/b> /", "<span class='now'>$1</span>", $scrap_pages);
			?>
			<?=$scrap_pages?>
	</div>
	<a href="javascript:window.close();" class="btn_close">창닫기</a>
</div>
</div>
