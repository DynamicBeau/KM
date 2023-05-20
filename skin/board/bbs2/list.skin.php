<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" href="<?=$board_skin_path?>/style.css" type="text/css">

<!-- 게시판 목록 시작 -->
<table class="board_table" width=<?=$width?> ><tr><td>
<?
if($board[bo_3]){
$latest_option = explode("/", $board[bo_3]);
if(!$latest_option[3]) $latest_option[3] = "";
echo latest_option($latest_option[0] , $bo_table , $latest_option[1] , $latest_option[2], $latest_option[3] );
}
?>


	<? if ($is_category) { 
		$category = explode("|", $board[bo_category_list]);
		if($board[bo_1]=="tab" || $board[bo_1]==""){?>
		<div class="board_category_tab">
		<a href='board.php?bo_table=<?=$bo_table?>' <?=$sca?"":"class='thisTab'"?>><span>전체</span></a>
			<? for ($i=0; $i<count($category); $i++){
					$this_style='';
					 if($sca && $category[$i]==$sca)$this_style="class='thisTab'"
			?>
			<a href='<?=$category_location?><?=urlencode($category[$i])?>' <?=$this_style?>><span><?=$category[$i]?></span></a>
			<?}?>
		</div>
		<?}
		if($board[bo_1]=="select"){	
		?>
		<div class="board_category_select">
        <form name="fcategory" method="get" style="margin:0px;">
				<select name=sca onchange="location='<?=$category_location?>'+<?=strtolower($g4[charset])=='utf-8' ? "encodeURIComponent(this.value)" : "this.value"?>;">
				<option value=''>전체</option>
				<?=$category_option?>
				</select>
        </form>
		</div>
		<?}
		if($board[bo_1]=="list"){	
		?>
		<div class="board_category_list">
			<a href='board.php?bo_table=<?=$bo_table?>' <?=$sca?"":"class='thisList'"?>><span>전체</span></a>
			<? for ($i=0; $i<count($category); $i++){
				$this_style='';
				 if($sca && $category[$i]==$sca)$this_style="class='thisList'"
			?>
			<a href='<?=$category_location?><?=urlencode($category[$i])?>' <?=$this_style?>><span><?=$category[$i]?></span></a>
			<?}?>
		</div>
		<?}?>
	<?}?>
	<!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 
    <div class="board_top">
            <img src="<?=$board_skin_path?>/img/icon_total.gif" align="absmiddle">
            <span style="color:#888888; font-weight:bold;">Total <?=number_format($total_count)?></span>
            <? if ($rss_href) { ?><a href='<?=$rss_href?>'><img src='<?=$board_skin_path?>/img/btn_rss.gif' align="absmiddle"></a><?}?>
	</div>-->

    <!-- 제목 -->
    <form name="fboardlist" method="post">
    <input type='hidden' name='bo_table' value='<?=$bo_table?>'>
    <input type='hidden' name='sfl'  value='<?=$sfl?>'>
    <input type='hidden' name='stx'  value='<?=$stx?>'>
    <input type='hidden' name='spt'  value='<?=$spt?>'>
    <input type='hidden' name='page' value='<?=$page?>'>
    <input type='hidden' name='sw'   value=''>
	<?
	$list_tyle = "list";
	if($board[bo_2])$list_tyle = $board[bo_2];
	include_once("$board_skin_path/list.$list_tyle.skin.php");
	?>
    </form>

	<?if($write_pages){?>
	<div class="board_page">
		<?
		$write_pages = str_replace(" &nbsp;", "", $write_pages);
		$write_pages = str_replace("처음", "<img src='$board_skin_path/img/page_begin.gif' align='absmiddle' title='처음'>", $write_pages);
		$write_pages = str_replace("이전", "<img src='$board_skin_path/img/page_prev.gif' align='absmiddle' title='이전'>", $write_pages);
		$write_pages = str_replace("다음", "<img src='$board_skin_path/img/page_next.gif' align='absmiddle' title='다음'>", $write_pages);
		$write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/page_end.gif' align='absmiddle' title='맨끝'>", $write_pages);
		$write_pages = preg_replace("/><span>([0-9]*)<\/span>/", " class='page'>$1", $write_pages);
		$write_pages = preg_replace("/<b>([0-9]*)<\/b> /", "<span class='now'>$1</span>", $write_pages);
		?>
		<?=$write_pages?>
	</div>
	<?}?>


    <div class="board_button">
		<? if ($admin_href) { ?>
		<a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/btn_admin.gif" title="관리자" align="absmiddle"></a>
		<?}?>
        <? if ($list_href) { ?>
        <a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" align="absmiddle"></a>
        <? } ?>
        <? if ($is_checkbox) { ?>
        <a href="javascript:all_checked();"><img src="<?=$board_skin_path?>/img/all_check.gif" align="absmiddle"></a>
        <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" align="absmiddle"></a>
        <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" align="absmiddle"></a>
        <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" align="absmiddle"></a>
        <? } ?>
        <? if ($write_href) { ?>
		<a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" align="absmiddle"></a>
		<? } ?>
    </div>

    <!-- 검색 -->
    <div class="board_search">
        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?=$bo_table?>">
        <input type="hidden" name="sca"      value="<?=$sca?>">
		<table cellspacing="6" cellpadding="0" align=center>
		<tr>
			<td><select name="sfl" class="selectbox">
            <option value="wr_subject">제목</option>
            <option value="wr_content">내용</option>
            <option value="wr_subject||wr_content">제목+내용</option>
            <option value="mb_id,1">회원아이디</option>
            <option value="mb_id,0">회원아이디(코)</option>
            <option value="wr_name,1">글쓴이</option>
            <option value="wr_name,0">글쓴이(코)</option>
        </select></td>
			<td><input name="stx" class="inputbox" style="width:120px;" maxlength="15" itemname="검색어" required value='<?=stripslashes($stx)?>'></td>
			<td><input type="image" src="<?=$board_skin_path?>/img/btn_search.gif" align="absmiddle"></td>
			<td><input type="radio" name="sop" value="and"> and
        <input type="radio" name="sop" value="or"> or</td>
		</tr>
		</table>
        </form>
    </div>

</td></tr></table>

<script type="text/javascript">
if ('<?=$sca?>' && "<?=$board[bo_1]?>"=="select") document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';

    if ('<?=$sop?>' == 'and') 
        document.fsearch.sop[0].checked = true;

    if ('<?=$sop?>' == 'or')
        document.fsearch.sop[1].checked = true;
} else {
    document.fsearch.sop[0].checked = true;
}
</script>

<? if ($is_checkbox) { ?>
<script type="text/javascript">
var sw = true;
function all_checked() {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
	if(sw== true)sw = false;
	else sw = true;
}

function check_confirm(str) {
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
function select_delete() {
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
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";
                       
    if (!check_confirm(str))
        return;

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<? } ?>
<!-- 게시판 목록 끝 -->
