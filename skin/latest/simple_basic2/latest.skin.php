<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<!-- UI Object -->

	<ul>
	<?php
    for ($i=0; $i<count($list); $i++) {
        $li = $list[$i];
		?>
	<li><span class="bu">›</span> <a href="<?=$li[href]?>"><?	echo "$li[subject]";?></a><span class="time"><?=$li[datetime]?></span></li>
	<? } ?>
	</ul>

<!-- //UI Object -->


