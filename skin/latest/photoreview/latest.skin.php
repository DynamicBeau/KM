<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="<?=$latest_skin_path?>/js/slides.min.jquery.js"></script>

<script>

$(function(){
	$('#slides').slides({
		play: 5000,
		pause: 5000,
		hoverPause: true,
		randomize: false,
		start: 1
	});
});
</script>

<style type="text/css">
#slides_box {width:386px;height:220px;position:relative;overflow:hidden;}
#slides {position:relative;margin-top:10px;left:0px;z-index:100;width:388px;}
.slides_container {width:288px; overflow:hidden;position:relative;display:none; margin:0 auto;}
 
#slides .next{position:absolute;top:35px;width:50px;height:60px;right:0px; z-index:101;}
#slides .prev{position:absolute;top:35px;width:50px;height:60px;left:0px; z-index:102;}


#slides .slide {padding:0px; width:288px;height:250px;display:block; position:relative;}

#slides .slide .thumb_image{height:140px; width:225px;margin:0 auto; display:block}
.slide a.sj{height:25px; color:#42c4ed; border-bottom:1px solid #e9e9e9; width:225px; margin:0 auto; display:block;font:bold 12px/25px gulim;}
.slide .content{word-break:break-all; display:block; height:32px; line-height:16px;padding:6px 10px;  width:225px; overflow:hidden;margin:0 auto}
</style>


<div id="slides_box">
	<div id="slides">
		<div class="slides_container">
			<? for ($i=0; $i<count($list); $i++) { 
				
				$noimage = "$latest_skin_path/img/no-image.gif";

				$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
				$thumfile = thumnail($imagepath, 225, 140, 100, 1, 1,1);
				
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
			


				$content = formatcontent($list[$i][wr_content], 200);
				?>
			<div class="slide">
				<a href="<?=$list[$i][href]?>" class="thumb_image"><img src="<?=$thumfile?>" width="225" height="140"></a>
				<a href="<?=$list[$i][href]?>" class="sj"><?=$list[$i][subject]?></a>
				<a href="<?=$list[$i][href]?>" class="content"><?=$content?></a>
			</div>
			<?}?>
		</div>
		<a href="#" class="prev"><img src="<?=$latest_skin_path?>/img/btn_left.gif" alt="Arrow Prev"></a>
		<a href="#" class="next"><img src="<?=$latest_skin_path?>/img/btn_right.gif" alt="Arrow Next"></a>
	</div>
</div>
