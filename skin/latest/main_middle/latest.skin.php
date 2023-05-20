<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<? 
for ($i=0; $i<count($list); $i++) { 
	$li = $list[$i];
	$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
?>
	<div class="main_ban">
		<div style="position:absolute;padding:120px 0 0 190px;"><a href="<?=$li[wr_link1]?>"><img src="<?=$g4[path]?>/images/btn_go.png"></a></div><img src="<?=$imagepath?>" style="width:268px;height:165px;">
	</div>
<?
}
?>