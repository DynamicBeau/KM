<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$image_width = 1024;
$image_height = 380;
?>

	
	<link rel="stylesheet" href="<?=$latest_skin_path?>/css/global.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script src="http://gsgd.co.uk/sandbox/jquery/easing/jquery.easing.1.3.js"></script>
	<script src="<?=$latest_skin_path?>/js/slides.min.jquery.js"></script>
	<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: '<?=$board_skin_path?>/img/loading.gif',
				play: 5000,
				pause: 2500,
				hoverPause: true
			});
		});
	</script>

	<div id="container2" style="border:1px solid red;">
		<div id="example">
			<div id="slides">
				<div class="slides_container"style="border:1px solid yellow;">





				<?php
					for ($i=0; $i<count($list); $i++) {
							$li = $list[$i];


					$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
					$noimage = $board_skin_path."/img/noimage.gif";
					$thumfile = thumnail($imagepath, $image_width, $image_height, 100, 1, 1,1, $noimage);
					$image = "<img src='$thumfile' width='$image_width' height='$image_height'  alt='Slide ".($i+1)."'> ";
					?>

				
				<a href="<?=$imagepath?>" title="<?=$list[$i][subject]?>" target="_blank"><img src="<?=$thumfile?>" alt="Slide <?=($i+1)?>"></a>

				<? } ?>




				</div>
				<a href="#" class="prev"><img src="<?=$latest_skin_path?>/img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="<?=$latest_skin_path?>/img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
			</div>
		</div>

	</div>




