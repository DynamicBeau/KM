<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<div class="ck_memo_warp">
<h1 class="title"><span>MY</span> MEMO</h1>
<div class="ck_memo_tab">
<a href="./memo.php?kind=recv" class="<?=$kind=="recv"?"this":""?>">받은 쪽지</a>
<a href="./memo.php?kind=send" class="<?=$kind=="send"?"this":""?>">보낸 쪽지</a>
<a href="./memo_form.php">쪽지보내기</a>
<span>전체 <?=$kind_title?> 쪽지 [ <B><?=$total_count?></B> ]통</span>
</div>
<div class="ck_box">
<table>
	<colgroup>
		<col width="200px" />
		<col width="100px" />
		<col width="100px" />
		<col width="" />
	</colgroup>
	<tr>
		<th><?= ($kind == "recv") ? "보낸사람" : "받는사람"; ?></th>
		<th>보낸시간</th>
		<th>읽은시간</th>
		<th>쪽지삭제</th>
	</tr>
</table>
<div class="ck_memo_list">
<table>
	<colgroup>
		<col width="200px" />
		<col width="100px" />
		<col width="100px" />
		<col width="" />
	</colgroup>
	<? for ($i=0; $i<count($list); $i++) { ?>
	<tr> 
		<td class="name"><?=$list[$i][name]?></td>
		<td class="send"><a href="<?=$list[$i][view_href]?>"><?=$list[$i][send_datetime]?></font></td>
		<td class="read"><a href="<?=$list[$i][view_href]?>"><?=substr($list[$i][me_read_datetime],0,1) == '0'?"<span>아직 읽지 않음</span>":"{$list[$i][read_datetime]}"?></font></td>
		<td class="del"><a href="javascript:del('<?=$list[$i][del_href]?>');">X<!-- <img src="<?=$member_skin_path?>/img/btn_del.gif"> --></a></td>
	</tr>
	<? } ?>
	<? if ($i == 0) echo "<tr><td colspan=5 style='text-align:center; line-height:246px;'>자료가 없습니다.</td></tr>"; ?>

</table>
</div>
<p>* 쪽지 보관일수는 최장 <?=$config[cf_memo_del]?>일 입니다.</p>
	<a href="javascript:window.close();" class="btn_close">창닫기</a>

</div>
</div>
 
