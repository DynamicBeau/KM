<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<style>
#carousel_container { width: 500px;;height: 10em; position: relative;}
.carousel { margin: 30px 0 0 0;}
.carousel li { width: 500px; height: 100px;}
.carousel p { padding-left: 0; }
#carousel_container .button { cursor: pointer; }
#carousel_container .prev { position: static; width: 5%; margin-top: 4em; position: absolute; top: 5px; left: 5px;}
#carousel_container .next { position: static; width: 5%; margin-top: 4em;  position: absolute; top: 5px; right: 5px;}
#carousel_container .carousel {  float: left; position: relative; width: 85%; }

#carousel_container h2 { margin: 0; color: #999; font-size: 123.1%; }
#carousel_container h2 strong { color: #000; }
</style>



	<script type="text/javascript" src="<?=$g4[path]?>/js/jcarousellite_1.0.1.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function(){
        $(".foot_banner_img").jCarouselLite({		

            visible:3,
            //auto:1500,
            speed:500,
						auto: 3000,
						over: true,
            btnNext: ".foot_banner .next",
            btnPrev: ".foot_banner .prev"
        });
    });
	</script>

<div class="foot_banner" style="width:100%">
	<TABLE align="center" style="text-align:center;BORDER-BOTTOM: #000000 0px solid; BORDER-LEFT: #000000 0px solid; WIDTH: 100%; BORDER-COLLAPSE: collapse; BORDER-TOP: #000000 0px solid; BORDER-RIGHT: #000000 0px solid">
		<tr>
			<!--<td width="30px"><img src="../skin_default/main_images/leftslide.png" class="prev"></td>-->
			<td width="100%" height="100%">   							
				<div class="foot_banner_img" style="visibility: visible; z-index: 2; left: 0px; width: 550px; overflow: hidden; position: relative;">
					<ul>
						<?=display_category_check('9',  10, 1, 100, 100);?>
					</ul> 
				</div>							
			</td>		
			<!--<td width="30px"><img src="../skin_default/main_images/rightslide.png" class="next"></td>-->
		 </tr>
	</table>
</div>