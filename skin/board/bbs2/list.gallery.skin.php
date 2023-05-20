<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
$image_width = 150;
$image_height = 150;
?>
    <ul class="board_gallery">
	<? for ($i=0; $i<count($list); $i++) { 
		$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
		$noimage = $board_skin_path."/img/noimage.gif";
		$thumfile = thumnail($imagepath, $image_width, $image_height, 100, 1, 1,1, $noimage);
		$image = "<img src='$thumfile' width='$image_width' height='$image_height' class=image > ";
		?>
	<li style="height:<?=$image_height +50?>px;width:<?=$image_width?>px;">
		<a href="<?=$list[$i][href]?>" class="photo"><?=$image?></a>
		<a href="<?=$list[$i][href]?>" class="subject"><?=$list[$i][subject]?><?=$i?></a>
		<a href="<?=$list[$i][href]?>" class="datetime"><?=date("y-m-d", strtotime($list[$i][wr_datetime]))?></a></li>
    <? } // end for ?>

    <? if (count($list) == 0) { echo "<div style='line-height:50px; text-align:center;'>게시물이 없습니다.</div>"; } ?>
    </ul>
