<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 3;

//if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>



?>
<style>
.board_top { clear:both; }

.board_list { clear:both; width:100%; table-layout:fixed; margin:5px 0 0 0; }
.board_list th { font-weight:bold; font-size:12px; } 
.board_list th { background:url(<?=$board_skin_path?>/img/title_bg.gif) repeat-x; } 
.board_list th { white-space:nowrap; height:34px; overflow:hidden; text-align:center; } 
.board_list th { border-top:1px solid #ddd; border-bottom:1px solid #ddd; } 

.board_list tr.bg0 { background-color:#fafafa; } 
.board_list tr.bg1 { background-color:#ffffff; } 

.board_list td { padding:.5em; }
.board_list td.num { font:8pt tahoma;color:#999999; text-align:center; }
.board_list td.checkbox { text-align:center; }
.board_list td.subject { overflow:hidden;color:#333; }
.board_list td.name { padding:0;text-align:center; }
.board_list td.datetime { font:normal 11px tahoma; color:#BABABA; text-align:center; }
.board_list td.hit { font:normal 11px tahoma; color:#BABABA; text-align:center; }
.board_list td.good { font:normal 11px tahoma; color:#BABABA; text-align:center; }
.board_list td.nogood { font:normal 11px tahoma; color:#BABABA; text-align:center; }
a.board {color:#2D2C2D; text-decoration:none;}
a.board:hover {text-decoration:underline;}

.board_list .notice { font-weight:normal; }
.board_list .current { font:bold 12px tahoma; color:#E15916; }
.board_list .comment { font-family:Tahoma; font-size:10px; color:#EE5A00; }

.board_button { clear:both; margin:10px 0 0 0; }

.board_page { clear:both; text-align:center; margin:3px 0 0 0; }
.board_page a:link { color:#777; }

.board_search { text-align:center; margin:10px 0 0 0;font:normal 11px tahoma; }
.board_search .stx { height:21px; border:1px solid #9A9A9A; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; }

.board_catogory01 {font:12px verdana,굴림;color:#666;letter-spacing:-0.05em;}
.board_catogory02 {font:11px verdana,굴림;color:#aaa;letter-spacing:-0.05em;}
.neue_t01 {font:9pt verdana,굴림;letter-spacing:-0.05em;}
</style>
</br>
<!-- 게시판 목록 시작 -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
  
          <form name="fcategory" method="get" style="margin:0px;">
            <? if ($is_category) { ?>
            <select name=sca onchange="location='<?=$category_location?>'+this.value;">
              <option value=''>전체</option>
              <?=$category_option?>
            </select>
            <? } ?>
          </form>
    
 
       
       
    
	  <br />

<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td align="center" style="padding-bottom:10px;">
	
	<form name="fsearch" method="get">
          <input type="hidden" name="bo_table" value="<?=$bo_table?>">
          <input type="hidden" name="sca"      value="<?=$sca?>">
		 <table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="2"><img src="<?=$board_skin_path?>/img/qna.jpg" /></td>
    <td >     <table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0" background="<?=$board_skin_path?>/img/fnabar.jpg" width="365" style="background-repeat:no-repeat;">
  <tr><input type="hidden" name="sfl" value="wr_subject||wr_content">
    <td height="25" align="center" style="padding-top:1px;"><input name="stx" value='<?=$stx?>' size="65" maxlength="15" itemname="검색어" style="border:none;border-right:0px; border-top:0px; boder-left:0px; boder-bottom:0px;background-color: #D6D6D6;"  required></td>
  </tr>
</table></td>
    <td><input type="image" src="<?=$board_skin_path?>/img/btn_search2.gif" border='0' align="absmiddle"></td>
  </tr>
</table>
 </td>
</tr>
  <tr>
    <td align="center"> <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>질문전에 자주묻는 질문을 먼저 확인하세요.</td>
        <td><input type="radio" name="sop" value="and" /></td>
        <td>and</td>
        <td><input type="radio" name="sop" value="or" /></td>
        <td>or</td>
      </tr>
    </table>                    </td>
    </tr>
</table>

		  
          
          
		  
        </form>
	
	</td>
  </tr>
</table>

	  
	  
      <!-- 제목 -->
      <form name="fboardlist" method="post">
        <input type='hidden' name='bo_table' value='<?=$bo_table?>'>
        <input type='hidden' name='sfl'  value='<?=$sfl?>'>
        <input type='hidden' name='stx'  value='<?=$stx?>'>
        <input type='hidden' name='spt'  value='<?=$spt?>'>
        <input type='hidden' name='page' value='<?=$page?>'>
        <input type='hidden' name='sw'   value=''>
        <table cellspacing="0" cellpadding="0" border=0 width="100%">
          <col width="50" />
          <? if ($is_checkbox) { ?>
          <col width="40" />
          <? } ?>
          <col />
          <col />
          <tr>
            <th><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="3"><img src="<?=$board_skin_path?>/img/bar1.jpg" border='0' /></td>
                <td background="<?=$board_skin_path?>/img/barb.jpg" style="background-repeat:repeat-x;" align="center"><img src="<?=$board_skin_path?>/img/bar_no.jpg"></td>
                <td width="3"><img src="<?=$board_skin_path?>/img/bar3.jpg" border='0' /></td>
              </tr>
            </table></th>
            <? if ($is_checkbox) { ?>
            <th><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="3" style="padding-left:5px;"><img src="<?=$board_skin_path?>/img/bar1.jpg" border='0' /></td>
                <td background="<?=$board_skin_path?>/img/barb.jpg" style="background-repeat:repeat-x;" align="center"><input name="checkbox" type="checkbox" onclick="if (this.checked) all_checked(true); else all_checked(false);" /></td>
                <td width="3"><img src="<?=$board_skin_path?>/img/bar3.jpg" border='0' /></td>
              </tr>
            </table></th>
            <?}?>
            <th><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="3" style="padding-left:5px;"><img src="<?=$board_skin_path?>/img/bar1.jpg" border='0' /></td>
                <td background="<?=$board_skin_path?>/img/barb.jpg" style="background-repeat:repeat-x;" align="center"><img src="<?=$board_skin_path?>/img/bar_title.jpg"></td>
                <td width="3"><img src="<?=$board_skin_path?>/img/bar3.jpg" border='0' /></td>
              </tr>
            </table></th>
          </tr>
          <? 
    for ($i=0; $i<count($list); $i++) { 
        $bg = $i%2 ? 0 : 1;


    ?>
          <tr class="bg<?=$bg?>" height="30">
            <td class="num" style="padding-left:0px;" align="center"><? //=$list[$i][num];?><img src="<?=$board_skin_path?>/img/icon_q.gif" /> </td><? if ($is_checkbox) { ?>
            <td class="checkbox" align="center" style="padding-left:3px;"><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"></td><? } ?>
            <td class="subject" style="cursor:pointer;padding-left:10px;"><? 
            echo $nobr_begin;            echo $list[$i][reply];            echo $list[$i][icon_reply];            if ($is_category && $list[$i][ca_name]) { 
			echo "<span class=board_catogory01><a href='{$list[$i][ca_name_href]}'><span style=color:{$ca_color};>{$list[$i][ca_name]}</span></a></span><span class=board_catogory02> | </span> ";}?>
              <a onclick=view(<?=$list[$i][num]?>) class=board><span class="neue_t01" style="color:#333;"><?=$list[$i][subject]?></span></a>
			  <? if ($is_admin == "super" || $is_admin == "group")  { ?>
              <a href="<?=$write_href?>&w=u&wr_id=<?=$list[$i][wr_id]?>&page=<?=$page?>"><span style="font:9pt verdana,굴림;letter-spacing:-0.05em;">수정</span></a> | 
			  <a href="javascript:del('./delete.php?bo_table=<?=$bo_table?>&wr_id=<?=$list[$i][wr_id]?>&page=');"><span style="font:9pt verdana,굴림;letter-spacing:-0.05em;">삭제</span></a>
              <? } ?>
            </td>
          </tr>
          <tr>
            <td colspan="<?=$colspan?>"  style="background-color:#EFEFEF;vertical-align:top;padding:1px;"><div id="view_<?=$list[$i][num]?>" style="display:none;">
                <table border="0" cellspacing="0" cellpadding="0" width="98%">
                  <tr>
                    <td valign="top" style="padding-left:10px;padding-top:10px;"><img src="<?=$board_skin_path?>/img/icon_a.gif" hspace="5" vspace="5" /></td>
                    <td style="padding-top:10px;"><div style="padding:0px 20px 10px 5px;text-align:justify;line-height:1.5;">
                        <?=trim($list[$i][content])?>
                    </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <? } // end for ?>
          <? if (count($list) == 0) { echo "<tr><td colspan='$colspan' height=100 align=center>게시물이 없습니다.</td></tr>"; } ?>
        </table>
      </form>
   
    <table width=100%><tr><td>
          <? if ($list_href) { ?>
          <a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" align="absmiddle" border='0'></a>
          <? } ?>
          <? if ($is_checkbox) { ?>
          <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" align="absmiddle" border='0'></a> <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" align="absmiddle" border='0'></a> <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" align="absmiddle" border='0'></a>
          <? } ?>   <? if ($admin_href) { ?>
          <a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/btn_admin.gif" border='0' title="관리자" align="absmiddle"></a>
          <?}?>
     </td><td align=right>
    
          <? if ($write_href) { ?>
          <a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border='0'></a>
          <? } ?>
      </td></tr></table>
   
      <!-- 페이지 -->
      <div class="board_page">
        <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border='0' align=absmiddle title='이전검색'></a>"; } ?>
        <?
        // 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
        //echo $write_pages;
        $write_pages = str_replace("처음", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
        $write_pages = str_replace("이전", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
        $write_pages = str_replace("다음", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
        $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
        //$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
        $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
        ?>
        <?=$write_pages?>
        <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border='0' align=absmiddle title='다음검색'></a>"; } ?>
      </div>
      <!-- 검색 -->
      </td>
  </tr>
</table>
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
<!-- view화면 출력 스크립트-->
<script>
var old_i; // 전에 클릭했던 글의 번호값 저장 
function view(i) { // 답변 표시여부 조정하는 js함수
	if (old_i==i) {
		var mode=document.getElementById('view_'+i).style.display;
		if (mode=='inline') document.getElementById('view_'+i).style.display='none';
		else document.getElementById('view_'+i).style.display='inline';
	}
	else {
		if (old_i) document.getElementById('view_'+old_i).style.display='none';
		document.getElementById('view_'+i).style.display='inline';
	}
	old_i=i;
}
</script>
