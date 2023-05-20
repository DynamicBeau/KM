<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
$image_width = 150;
$image_height = 150;

?>

<ul style="padding:10px; border:2px solid #1c8bba; margin-bottom:20px;height:<?=$image_height +50?>px;text-align:center;">
<? for ($i=0; $i<count($list); $i++) { 
		/*$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
		$noimage = $latest_skin_path."/img/noimage.gif";
		$thumfile = thumnail($imagepath, $image_width, $image_height, 100, 1, 1,1, $noimage);
		$image = "<img src='$thumfile' width='$image_width' height='$image_height'> ";*/

		$noimage = $latest_skin_path."/img/noimage.gif";
 
		$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
		$thumfile = thumnail($imagepath, $image_width, $image_height, 100, 1, 1,1);
		if(!$thumfile){ 
			$edit_img = $list[$i]['wr_content'];
			if (eregi("data/cheditor4[^<>]*\.(gif|jp[e]?g|png)", $edit_img, $tmp)) { // data/cheditor------
				$file = '../' . $tmp[0]; // 파일명
				$thumfile = thumnail($file,$image_width, $image_height,"100", 1,1);
			}else
			if (eregi("http://[^<>]*\.(gif|jp[e]?g|png)", $edit_img, $tmp)) { // data/cheditor------
				$file = $tmp[0]; // 파일명
				$thumfile = $file;
			}
		}
		if(!$thumfile) $thumfile= $noimage;
		$image = "<img src='$thumfile' width='$image_width' height='$image_height' class=image > ";
		?>
		<li style="height:<?=$image_height +50?>px;width:<?=$image_width?>px; float:left; margin-left:20px;">
		<a href="<?=$list[$i][href]?>"><?=$image?></a>
		<a href="<?=$list[$i][href]?>" style="display:block; font-weight:bold; color:#0064FF; line-height:20px; height:20px; margin-top:10px;"><?=$list[$i][subject]?></a>
		<a href="<?=$list[$i][href]?>" style="display:block; font:normal 7pt verdana; color:#999; line-height:20px; height:20px;"><?=date("y-m-d", strtotime($list[$i][wr_datetime]))?></a></li>
<? } // end for ?>
<? if (count($list) == 0) { ?>
<li style="text-align:center; line-height:130px;">게시물이 없습니다.</li>
<? } ?>
</ul>
