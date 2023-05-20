<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

		$qa_page_rows = 10;     // 상품문의 페이지당 목록수

        $sql_common = " from $g4[yc4_item_qa_table] where it_id = '$it[it_id]' ";

        // 테이블의 전체 레코드수만 얻음
        $sql = " select COUNT(*) as cnt " . $sql_common;
        $row = sql_fetch($sql);
        $qa_total_count = $row[cnt];

        $qa_total_page  = ceil($qa_total_count / $qa_page_rows); // 전체 페이지 계산
        if ($qa_page == "") $qa_page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
        $qa_from_record = ($qa_page - 1) * $qa_page_rows; // 시작 레코드 구함

        $sql = "select *
                 $sql_common
                 order by iq_id desc
                 limit $qa_from_record, $qa_page_rows ";
        $result = sql_query($sql);

?>

<!-- 상품문의 -->
<a name="qa"></a>
<div id="item_qa">
	<ul class='use_qa'>
        <?
        for ($i=0; $row=sql_fetch_array($result); $i++) 
        {
             $num = $qa_total_count - ($qa_page - 1) * $qa_page_rows - $i;

            $iq_name  = get_text($row[iq_name]);
            $iq_subject  = conv_subject($row[iq_subject],50,"…");
            $iq_question = conv_content($row[iq_question],0);
            $iq_answer   = conv_content($row[iq_answer],0);

            $iq_time = substr($row[iq_time], 2, 14);

			$icon_answer = "";
            $iq_answer = "";
            if ($row[iq_answer]) 
            {
                $iq_answer = "<div class='answer'>".conv_content($row[iq_answer],0)."</div>";
                $icon_answer = "<a href='javascript:;' onclick=\"qa_menu('iq$i')\"><img src='$g4[shop_img_path]/icon_answer.gif' border=0></a>";
            }
			?>
			<li>
				<p class="q">
					<span class="num"><?=$num?></span>
					<span class="name"><?=$iq_name?></span>
					<span class="subject"><a href='javascript:;' onclick="qa_menu('iq<?=$i?>')"><?=$iq_subject?><em><?=$iq_time?></em></a></span>
					<span class="icon_answer"><?=$icon_answer?></span>
				</p>
				<div class="a"  id='iq<?=$i?>' style='display:none;'>
					<?=$iq_question?>
					<?=$iq_answer?>
					<!-- //// -->
                        <textarea id='tmp_iq_id<?=$i?>' style='display:none;'><?=$row[iq_id]?></textarea>
                        <textarea id='tmp_iq_name<?=$i?>' style='display:none;'><?=$row[iq_name]?></textarea>
                        <textarea id='tmp_iq_subject<?=$i?>' style='display:none;'><?=$row[iq_subject]?></textarea>
                        <textarea id='tmp_iq_question<?=$i?>' style='display:none;'><?=$row[iq_question]?></textarea>
					<!-- //// --> 

				<?
					if ($row[mb_id] == $member[mb_id] && !$iq_answer){
					echo "<p class='btn_set'>";
					echo "<a href='javascript:itemqa_update({$i});'><img src='$g4[shop_img_path]/btn_small_modify.gif'></a>";
					echo "<a href='javascript:itemqa_delete(fitemqa_password{$i}, {$i});'><img src='$g4[shop_img_path]/btn_small_delete.gif'></a> ";

					echo "<span id='itemqa_password{$i}' style='display:none;'><form name='fitemqa_password{$i}' method='post' action='./itemqaupdate.php' autocomplete=off style='padding:0px;'>
					<input type=hidden name=w value=''>
					<input type=hidden name=iq_id value=''>
					<input type=hidden name=it_id value='{$it[it_id]}'>
					<label>패스워드 : </label><input type=password style='height:12px; padding:2px; width:60px; border:1px solid #AAA;' name=is_password required itemname='패스워드'>
					<input type=image src='{$g4[shop_img_path]}/btn_small_confirm.gif' border=0 align=absmiddle>
					</form></span>";
					echo "</p>";
				}	?>	
				</div>
			</li>
		<?}
        if (!$i){
            echo "
            <div class='no_list'>
			이 상품에 대한 질문이 아직 없습니다.<br>
			궁금하신 사항은 이곳에 질문하여 주십시오.</div>";
        }?>
	
	</ul>

	<?
	$qa_pages = get_paging(10, $qa_page, $qa_total_page, "./item.php?it_id=$it_id&$qstr&qa_page=", "#qa");
	if ($qa_pages) echo "<div style='padding:10px; text-align:center;'>$qa_pages</div>";
	?>

	<div style="padding:10px;">
		* 이 상품에 대한 궁금한 사항이 있으신 분은 질문해 주십시오. <input type=image src='<? echo "$g4[shop_img_path]/btn_qa.gif"?>' onclick="itemqa_insert(itemqa);" align=absmiddle>
	</div> 

        <!-- 상품문의 폼-->
	<div id=itemqa style='display:none;'>
        <form name="fitemqa" method="post" onsubmit="return fitemqa_submit(this);" autocomplete=off style="padding:0px;">
        <input type=hidden name=w value=''>
        <input type=hidden name=token value='<?=$token?>'>
        <input type=hidden name=iq_id value=''>
        <input type=hidden name=it_id value='<?=$it[it_id]?>'>
        <table class="table_style2">

        <? if (!$is_member) { ?>
        <tr>
            <th>이름</th>
            <td><input type="text" name="iq_name" class="inputbox" maxlength=20 minlength=2 required itemname="이름"></td>
            <th>패스워드</th>
            <td><input type="password" name="iq_password" class="inputbox" maxlength=20 minlength=3 required itemname="패스워드"></td></tr>
        <? } ?>

        <tr>
            <th>제목</th>
            <td colspan=3><input type="text" name="iq_subject" style='width:100%;' class="inputbox" required itemname="제목" maxlength=100></td></tr>
        <tr>
            <th>내용</th>
            <td colspan=3><textarea name="iq_question" rows="7" style='width:100%;' class="textareabox" required itemname="내용"></textarea></td></tr>
        <tr>
            <th><img id='kcaptcha_image_qa' /></th>
            <td colspan=3><input type='text' name='iq_key' class="inputbox" required itemname='자동등록방지용 코드'>
                * 왼쪽의 자동등록방지 코드를 입력하세요.</td></tr>
        </table>
		<div style="padding:10px; text-align:center;"><input type=image src='<?=$g4[shop_img_path]?>/btn_confirm.gif' border=0></div>
        </form>
	</div>
</div>


<script type="text/javascript">
function fitemqa_submit(f) 
{
    if (!check_kcaptcha(f.iq_key)) { 
        return false; 
    } 

    f.action = "itemqaupdate.php";
    return true;
}

function itemqa_insert()
{
    /*
    if (!g4_is_member) {
        alert("로그인 하시기 바랍니다.");
        return;
    }
    */

    var f = document.fitemqa;
    var id = document.getElementById('itemqa');

    id.style.display = 'block';

    f.w.value = '';
    f.iq_id.value = '';
    if (!g4_is_member)
    {
        f.iq_name.value = '';
        f.iq_name.readOnly = false;
        f.iq_password.value = '';
    }
    f.iq_subject.value = '';
    f.iq_question.value = '';
}

function itemqa_update(idx)
{
    var f = document.fitemqa;
    var id = document.getElementById('itemqa');

    id.style.display = 'block';

    f.w.value = 'u';
    f.iq_id.value = document.getElementById('tmp_iq_id'+idx).value;
    if (!g4_is_member)
    {
        f.iq_name.value = document.getElementById('tmp_iq_name'+idx).value;
        f.iq_name.readOnly = true;
    }
    f.iq_subject.value = document.getElementById('tmp_iq_subject'+idx).value;
    f.iq_question.value = document.getElementById('tmp_iq_question'+idx).value;
}

function itemqa_delete(f, idx)
{
    var id = document.getElementById('itemqa');

    f.w.value = 'd';
    f.iq_id.value = document.getElementById('tmp_iq_id'+idx).value;

    if (g4_is_member)
    {
        if (confirm("삭제하시겠습니까?"))
            f.submit();
    }
    else 
    {
        id.style.display = 'none';
        document.getElementById('itemqa_password'+idx).style.display = 'block';
    }
}
</script>
<!-- 상품문의 end -->
