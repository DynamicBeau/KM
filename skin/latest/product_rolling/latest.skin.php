<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<!-- UI Object -->

<?php
	for ($i=0; $i<count($list); $i++) {
			$li = $list[$i];
	?>
		<li><a href="<?=$li[href]?>"><img src="<?=$list[$i][file][0][path]."/".$list[$i][file][0][file]?>" style="width:100px;"></a></li>
<? } ?>

<!-- //UI Object -->


