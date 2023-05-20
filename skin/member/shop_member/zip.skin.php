<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<div class="ck_zip_warp">
<h1 class="title">ZIP CODE <span>Search</span></h1>
<div class="ck_box">
<form name="fzip" method="get" autocomplete="off">
<input type=hidden name=frm_name  value='<?=$frm_name?>'>
<input type=hidden name=frm_zip1  value='<?=$frm_zip1?>'>
<input type=hidden name=frm_zip2  value='<?=$frm_zip2?>'>
<input type=hidden name=frm_addr1 value='<?=$frm_addr1?>'>
<input type=hidden name=frm_addr2 value='<?=$frm_addr2?>'>
<h3 class="ck_register_title">찾고자 하시는 주소의 동(읍/면/리)을 입력하세요.</h3>
<p class="ck_register_ex">예: 수유, 두리, 무지 (두글자이상)</p>

	<fieldset class="oneline">
		<label>동(읍/면/리)</label>
		<input type=text name=addr1 value='<?=$addr1?>' required minlength=2 itemname='동(읍/면/리)' size=30 class="ck_input">
		<input type='submit' class="ck_zipcode_search_btn" value="찾 기">
	</fieldset>
</form>
<div style="height:15px"></div>
<h3 class="ck_register_title">검색결과</h3>
<p class="ck_register_ex">총 <b><?=$search_count?></b> 건 가나다순</p>
<div class="ck_find_list">
	<?
	for ($i=0; $i<count($list); $i++) {
		echo "<a href='javascript:;' onclick=\"find_zip('{$list[$i][zip1]}', '{$list[$i][zip2]}', '{$list[$i][addr]}');\">{$list[$i][zip1]}-{$list[$i][zip2]} : {$list[$i][addr]} {$list[$i][bunji]}</a>\n";
	}
	?>
</div>
</div><!-- ck_zip_box -->
</div><!-- ck_zip_warp -->

 

<script type="text/javascript">
function find_zip(zip1, zip2, addr1)
{
    var of = opener.document.<?=$frm_name?>;

    of.<?=$frm_zip1?>.value  = zip1;
    of.<?=$frm_zip2?>.value  = zip2;

    of.<?=$frm_addr1?>.value = addr1;

    of.<?=$frm_addr2?>.focus();
    window.close();
    return false;
}
</script>
<script type='text/javascript'>
document.fzip.addr1.focus();
</script>
