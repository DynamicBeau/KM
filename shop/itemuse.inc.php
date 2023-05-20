<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
	
		$use_page_rows = 10;    // 사용후기 페이지당 목록수
	
        $sql_common = " from $g4[yc4_item_ps_table] where it_id = '$it[it_id]' and is_confirm = '1' ";

        // 테이블의 전체 레코드수만 얻음
        $sql = " select COUNT(*) as cnt " . $sql_common;
        $row = sql_fetch($sql);
        $use_total_count = $row[cnt];

        $use_total_page  = ceil($use_total_count / $use_page_rows); // 전체 페이지 계산
        if ($use_page == "") $use_page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
        $use_from_record = ($use_page - 1) * $use_page_rows; // 시작 레코드 구함

        $sql = "select * $sql_common order by is_id desc limit $use_from_record, $use_page_rows ";
        $result = sql_query($sql);

?>

<!-- 사용후기 -->
<a name="use"></a>
<div id='item_use'>
	<ul class='use_qa'>
		<?
			for ($i=0; $row=sql_fetch_array($result); $i++) 
			{
				$num = $use_total_count - ($use_page - 1) * $use_page_rows - $i;
				$star = get_star($row[is_score]);
				$is_name = get_text($row[is_name]);
				$is_subject = conv_subject($row[is_subject],50,"…");
				$is_content = conv_content($row[is_content],0);
				$is_time = substr($row[is_time], 2, 14);
		?>
		<li>
			<p class="q">
				<span class="num"><?=$num?></span>
				<span class="star"><img src='<?=$g4[shop_img_path]?>/star<?=$star?>.gif' border=0></span>
				<span class="name"><?=$is_name?></span>
				<span class="subject"><a href='javascript:;' onclick="use_menu('is<?=$i?>')"><?=$is_subject?><em><?=$is_time?></em></a></span>
			</p>
			<div class="a" id='is<?=$i?>'>
				<?=$is_content?>
				<!-- //// -->
					<textarea id='tmp_is_id<?=$i?>' style='display:none;'><?=$row[is_id]?></textarea>
					<textarea id='tmp_is_name<?=$i?>' style='display:none;'><?=$row[is_name]?></textarea>
					<textarea id='tmp_is_subject<?=$i?>' style='display:none;'><?=$row[is_subject]?></textarea>
					<textarea id='tmp_is_content<?=$i?>' style='display:none;'><?=$row[is_content]?></textarea>
				<!-- //// -->
				<?
					if ($row[mb_id] == $member[mb_id]){
					echo "<div class='btn_set'>";
					echo "<a href='javascript:itemuse_update({$i});'><img src='$g4[shop_img_path]/btn_small_modify.gif'></a>";
					echo "<a href='javascript:itemuse_delete(fitemuse_password{$i}, {$i});'><img src='$g4[shop_img_path]/btn_small_delete.gif'></a> ";

					echo "<span id='itemuse_password{$i}' ><form name='fitemuse_password{$i}' method='post' action='./itemuseupdate.php' autocomplete=off style='padding:0px;'>
					<input type=hidden name=w value=''>
					<input type=hidden name=is_id value=''>
					<input type=hidden name=it_id value='{$it[it_id]}'>
					<label>패스워드 : </label>
					<input type=password style='height:12px; padding:2px; width:60px; border:1px solid #AAA;' name=is_password required itemname='패스워드'>
					<input type=image src='{$g4[shop_img_path]}/btn_small_confirm.gif' border=0>
					</form>
					</span>";
					echo "</div>";
				}	?>	
			</div>
		</li>
		<?}
        if (!$i){
            echo "
            <div class='no_list'>이 상품에 대한 사용후기가 아직 없습니다.<br>
                    사용후기를 작성해 주시면 다른 분들께 많은 도움이 됩니다.</div>";
        }?>
	</ul>
	<?
	$use_pages = get_paging(10, $use_page, $use_total_page, "./item.php?it_id=$it_id&$qstr&use_page=", "#use");
	if ($use_pages) echo "<div style='padding:10px; text-align:center;'>$use_pages</div>";
	?>

	<div style="padding:10px;">* 이 상품을 사용해 보셨다면 사용후기를 써 주십시오.  <input type=image src='<?="$g4[shop_img_path]/btn_story.gif"?>' onclick="itemuse_insert();"  align=absmiddle>
	</div>
	<!-- 사용후기 폼 -->
	<div id=itemuse style='display:none;'>
        <form name="fitemuse" method="post" onsubmit="return fitemuse_submit(this);" autocomplete=off style="padding:0px;">
        <input type=hidden name=w value=''>
        <input type=hidden name=token value='<?=$token?>'>
        <input type=hidden name=is_id value=''>
        <input type=hidden name=it_id value='<?=$it[it_id]?>'> 
        <table class="table_style2">
        <? if (!$is_member) { ?>
        <tr>
            <th>이름</th>
            <td><input type="text" name="is_name" class='inputbox' maxlength=20 minlength=2 required itemname="이름"></td>
            <th>패스워드</th>
            <td><input type="password" name="is_password" class='inputbox' maxlength=20 minlength=3 required itemname="패스워드"></td></tr>
        <? } ?>
        <tr>
            <th>제목</th>
            <td colspan=3><input type="text" name="is_subject"  style="width:100%;" class='inputbox' required itemname="제목"></td></tr>
        <tr>
            <th>내용</th>
            <td colspan=3><textarea name="is_content" rows="7"  style="width:100%;" class='textareabox' required itemname="내용"></textarea></td></tr>
        <tr>
            <th>평가</th>
            <td colspan=3>
                <input type=radio name=is_score value='10' checked><img src='<?=$g4[shop_img_path]?>/star5.gif' align=absmiddle>
                <input type=radio name=is_score value='8'><img src='<?=$g4[shop_img_path]?>/star4.gif' align=absmiddle>
                <input type=radio name=is_score value='6'><img src='<?=$g4[shop_img_path]?>/star3.gif' align=absmiddle>
                <input type=radio name=is_score value='4'><img src='<?=$g4[shop_img_path]?>/star2.gif' align=absmiddle>
                <input type=radio name=is_score value='2'><img src='<?=$g4[shop_img_path]?>/star1.gif' align=absmiddle></td></tr>
        <tr>
            <th><img id='kcaptcha_image_use' /></th>
            <td colspan=3>
                <input type='text' name='is_key' class='inputbox' required itemname='자동등록방지용 코드'>
                * 왼쪽의 자동등록방지 코드를 입력하세요.</td></tr>
        </table>
		<div style="padding:10px; text-align:center;"><input type=image src='<?=$g4[shop_img_path]?>/btn_confirm.gif' border=0></div>
        </form>
	</div>

</div>


<script type="text/javascript">
function fitemuse_submit(f) 
{
    if (!check_kcaptcha(f.is_key)) { 
        return false; 
    } 

    f.action = "itemuseupdate.php"
    return true;
}

function itemuse_insert()
{
    /*
    if (!g4_is_member) {
        alert("로그인 하시기 바랍니다.");
        return;
    }
    */

    var f = document.fitemuse;
    var id = document.getElementById('itemuse');

    id.style.display = 'block';

    f.w.value = '';
    f.is_id.value = '';
    if (!g4_is_member)
    {
        f.is_name.value = '';
        f.is_name.readOnly = false;
        f.is_password.value = '';
    }
    f.is_subject.value = '';
    f.is_content.value = '';
}

function itemuse_update(idx)
{
    var f = document.fitemuse;
    var id = document.getElementById('itemuse');

    id.style.display = 'block';

    f.w.value = 'u';
    f.is_id.value = document.getElementById('tmp_is_id'+idx).value;
    if (!g4_is_member)
    {
        f.is_name.value = document.getElementById('tmp_is_name'+idx).value;
        f.is_name.readOnly = true;
    }
    f.is_subject.value = document.getElementById('tmp_is_subject'+idx).value;
    f.is_content.value = document.getElementById('tmp_is_content'+idx).value;
}

function itemuse_delete(f, idx)
{
    var id = document.getElementById('itemuse');

    f.w.value = 'd';
    f.is_id.value = document.getElementById('tmp_is_id'+idx).value;

    if (g4_is_member)
    {
        if (confirm("삭제하시겠습니까?"))
            f.submit();
    }
    else 
    {
        id.style.display = 'none';
        document.getElementById('itemuse_password'+idx).style.display = 'inline';
    }
}
</script>
<!-- 사용후기 end -->
