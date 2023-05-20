<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>

?>

<style>
.subheader {
	font: Bold 1.2em Verdana, 'Trebuchet MS', Sans-serif;
	color: #808080;
	border-top: 1px solid #FFFFFF;
	border-bottom: 1px solid #e1e1e1;
	background-color:#FFFFFF;
}
	.title_year {
		width:70px;
        margin-bottom:13px;
        border-bottom: 1px solid #000000;
		background-color:#FFFFFF;
		}

div.item_text { color:#636363; width:100%; padding:0 10px 0 10px; margin-top:3px; }
div.item_text2 { color:#636363; padding:0 10px 10px; margin-top:10px; margin-bottom:5px; float:left;}
div.item_text strong { font-weight:bold; color:#000000; font-family:돋움; font-size:12px; }
.year_img { float:left; }
.year_text { padding:0 10px 30px 10px;}

</style>

<? include_once("$board_skin_path/pagelist.php");?>

<script language="JavaScript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
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
<script language="JavaScript">
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
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
