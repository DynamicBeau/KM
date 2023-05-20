<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
$image_width = 90;
$image_height = 100;
include_once("$board_skin_path/fun.php");
?>
<ul class="board_webzine">
	<? for ($i=0; $i<count($list); $i++) { 
		$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
		$noimage = $board_skin_path."/img/noimage.gif";
		$thumfile = thumnail($imagepath, $image_width, $image_height, 100, 1, 1,1);
		if($thumfile)
		$image = "<span class='thumb'><img src='$thumfile' width='$image_width' height='$image_height' class=image ></span>";
		?>
	<li>
		<a href="<?=$list[$i][href]?>"><?=$image?>
		<strong><?=$list[$i][subject]?></strong>
		</a>
		<p class="wz_content"><?=cut_str(strip_tags($list[$i][wr_content]),"100")?></p>
		<ul class="wz_info">
			<li class="wz_info_name"><?=$list[$i][name]?></li>
			<li class="wz_info_date"><?=date("y-m-d", strtotime($list[$i][wr_datetime]))?></li>
			<li class="wz_info_hit"><?=$list[$i][wr_hit]?></li>
		</ul>
	</li>
    <? } // end for ?>

    <? if (count($list) == 0) { echo "<div style='line-height:50px; text-align:center;'>게시물이 없습니다.</div>"; } ?>
    </ul>
