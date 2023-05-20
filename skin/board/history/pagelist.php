<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0" border="0">
<tr><td height="5"></td></tr>
<tr><td>
 <!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
		 <div style="float:left;">
            <!--
			<form name="fcategory" method="get" style="margin:0px;">
            <? if ($is_category) { ?>
            <select name=sca onchange="location='<?=$category_location?>'+this.value;">
            <option value=''>전체</option>
            <?=$category_option?>
            </select>
            <? } ?>
            </form>
			-->
        </div>
        <div style="float:right;">
            <? if ($rss_href) { ?><a href='<?=$rss_href?>'><img src='<?=$board_skin_path?>/img/btn_rss.gif' border='0' align="absmiddle"></a><?}?>
            <? if ($admin_href) { ?>
			<a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/btn_admin.gif" border='0' title="관리자" align="absmiddle"></a><?}?>
        </div>
</td></tr>
<tr><td height="5"></td></tr>
<tr><td>
<!-- 제목 -->
<form name="fboardlist" method="post" style="margin:0;">
<input type='hidden' name='bo_table' value='<?=$bo_table?>'>
<input type='hidden' name='sfl'  value='<?=$sfl?>'>
<input type='hidden' name='stx'  value='<?=$stx?>'>
<input type='hidden' name='spt'  value='<?=$spt?>'>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='sw'   value=''>
<?

	//카테고리를 읽는다.
	$sql = " SELECT bo_category_list FROM $g4[board_table] WHERE bo_table = '$bo_table' ";
    $row = sql_fetch($sql);
    $arr = explode("|", $row[bo_category_list]); // 구분자가 | 로 되어 있음
	rsort($arr); 
	for ($i=0; $i<count($arr); $i++) {	//카테고리 루프 시작
		//각 카테고리 별로 글을 읽어와서 뿌려준다.
		$his_year = trim($arr[$i]);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="60" valign="top"><?
	 $year = "<font style=\"font-family: 'NanumGothicBold'; font-size:24px;letter-spacing:-2pt; line-height:150%;\" color=\"#79A0D7\"><strong>$his_year</strong></span>";
     echo $year;
    ?></td>
    <td align="left" valign="top" style="padding-top:5px;"><?
		$sql1 = " SELECT wr_id,wr_subject,wr_content FROM $write_table WHERE ca_name = '$arr[$i]' ORDER BY wr_subject DESC";
		$row1 = mysql_query($sql1);
		for ($j=0; $ca=mysql_fetch_array($row1); $j++) {	//글별 루프 시작
			//echo $ca['wr_subject']."<br>".$ca['wr_content']."<br><br>";
			$his_date = $ca['wr_subject'];	//날짜
			$his_content = conv_content($ca['wr_content'],true);	//내용
			//해당 카테고리별 포함된 글들
?>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
	<? if ($is_checkbox) { ?><td width="10" valign="top"><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>">
    </td><? }?>
    
  <!--  <td align="right" valign="top"><b>
	<?
	$name=explode("/", $his_date);
	echo $name[0]."월".$name[1]."일"?></b></td> -->
    
    <td align="left" >

<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"> <img src='<?=$board_skin_path;?>/img/icon.gif' border='0' align=absmiddle hspace="5" vspace="10"></td>
    <td align="left" style="line-height:170%;"><?
	$name_arr = explode("~",$his_date);
	$name1=explode(".", $name_arr[0]);
	$name2=explode(".", $name_arr[1]);
	echo $name1[0]."월".$name1[1]."일"?><?if(strlen($name2[0]) > 0 ){?> ~ <?echo $name2[0]; if(strlen($name2[1]) > 0){echo "월";}else{ echo  "일";}   } if(strlen($name2[1]) > 0 ){ $name2[1]."일";?> <? }?> <font color="#666666"><?=$his_content?></font><? if ($is_admin == "super" || $is_admin == "group")  { ?>
   <font style="font-size:12px;"> <a href='<?=$g4[path]?>/bbs/board.php?bo_table=<?=$bo_table?>&wr_id=<?=$ca['wr_id']?>'>[내용]</a>
	<a href='<?=$g4[path]?>/bbs/write.php?bo_table=<?=$bo_table?>&w=u&wr_id=<?=$ca['wr_id']?>'>[수정]</a> 
	<a href="javascript:del('./delete.php?bo_table=<?=$bo_table?>&wr_id=<?=$ca[wr_id]?>&page=');">[삭제]</a></font>
      <? } ?></td>
  </tr>
</table>
	
	</td>
        </tr>
    </table>
<?
		}	//글별 루프 끝
?>

</td>

  </tr>
  <tr><td colspan="2" style="padding:22px 0px 5px 0px;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#CCCCCC">
  <tr>
    <td height="1" bgcolor="#CCCCCC"></td>
  </tr>
</table>

  <Td>
</table>



<br class='clear' />
<?
	}	//카테고리 루프 끝
?>

<br class='clear' />
</form>
<table cellspacing="0" cellpadding="0" width="100%">
	 <tr><td colspan="4" align="center" style="padding-bottom:10px;">
	  
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
   </td></tr>
   <tr><td class="listBL" width="8" height="42"></td>
	<td class="listBC" style="padding-top:3px;" height="42">
        <!--
		<form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?=$bo_table?>"> 
        <input type="hidden" name="sca" value="<?=$sca?>">
        <select name="sfl">
            <option value="wr_subject">제목</option>
            <option value="wr_content">내용</option>
            <option value="wr_subject||wr_content">제목+내용</option>
            <option value="wr_name,1">글쓴이</option>
            </select>
        <input name="stx"  class="ed" style='height:20px;' maxlength="10" itemname="검색어" required value='<?=$stx?>'>
        <input type="image" src="<?=$board_skin_path?>/img/btn_search.gif" border='0' align="absmiddle">
       </form>
	   -->
        </td> 
        <td align="right" class="listBC" style="padding-bottom:3px;" height="42">
        
        <? if ($list_href) { ?>
        <a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" align="absmiddle" border='0'></a>
        <? } ?>
        <? if ($is_checkbox) { ?>
        <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" align="absmiddle" border='0'></a>
        <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" align="absmiddle" border='0'></a>
        <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" align="absmiddle" border='0'></a>
        <? } ?>
        <? if ($write_href) { ?><a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif"  align="absmiddle" border='0'></a><? } ?>
        </td><td class="listBR" width="8">
        </td></tr>
   </table>
	<!-- 검색 -->

</td></tr></table>