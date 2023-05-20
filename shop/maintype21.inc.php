<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<SCRIPT src="<?=$g4['shop_path']?>/js/lib.min.js" type=text/javascript></SCRIPT>

<style type="text/css">
.jCarouselLite_box{position:relative; }
.jCarouselLite_box button{position:absolute;  border:0; width:20px; height:240px; top:0; cursor:pointer}
.jCarouselLite_box button.prev{left:0px; background:url(<?=$g4['shop_img_path']?>/btn_left.gif) center center no-repeat;}
.jCarouselLite_box button.next{right:0px; background:url(<?=$g4['shop_img_path']?>/btn_right.gif) center center no-repeat;}

.jCarouselLite{margin:0 auto;}
.jCarouselLite ul{}
.jCarouselLite ul li{background:#EEE; height:200px; text-align:center; margin:10px;  padding:10px; display:inline;}
.jCarouselLite ul li p.item_name{margin-top:5px;line-height:14px; overflow:hidden;}
.jCarouselLite ul li p.amount{color:#06F; font-weight:bold; margin-top:5px;}

</style>
<div class="jCarouselLite_box">
	<button class=prev>&nbsp;</button> 
	<button class=next>&nbsp;</button> 
	<div class=jCarouselLite>
		<ul>
			<? for ($i=0; $row=sql_fetch_array($result); $i++) {
				$href = "<a href='$g4[shop_path]/item.php?it_id=$row[it_id]' class=item>";
				?>
				<li>
				<?=$href?><?=get_it_image($row[it_id]."_s", $img_width, $img_height)?></a>
				<p class="item_name"><?=$href?><?=stripslashes($row[it_name])?></a></p>
				<p class="amount"><?=display_amount(get_amount($row), $row[it_tel_inq])?></p>
				</li>
			<?}?>
		</ul>
	</div>
</div>

     
<script language="JavaScript">
	$(function() {
    $(".jCarouselLite").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev",
		auto: 3000,
		speed: 1000,
		mouseWheel: true,
		visible: <?=$list_mod?>,
        easing: "easeinout"
    });       
    
});
</script>
