<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<ul style="padding:10px; border:2px solid #1c8bba; margin-bottom:20px;">
<? for ($i=0; $i<count($list); $i++) { ?>
<li style="position:relative; height:25px;font:bold 13px/25px '맑은 고딕'; border-bottom:1px solid #EEE;"><img src='<?=$latest_skin_path?>/img/blot.gif' align=absmiddle width=2 height=4> &nbsp;
    <a href='<?=$list[$i][href]?>'><font color="#0064FF"><?=$list[$i][subject]?></font></a>
	<span style="position:absolute;top:0; right:0; height:25px; line-height:25px;font:normal 7pt verdana; color:#999;"><?=date("y-m-d", strtotime($list[$i][wr_datetime]))?></span>
	</li>
<? } ?>
<? if (count($list) == 0) { ?>
<li style="text-align:center; line-height:130px;">게시물이 없습니다.</li>
<? } ?>
</ul>
