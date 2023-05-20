<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$sc_height =  $img_height + 14 + 16 + 5 + 5;
?>
<SCRIPT src="<?=$g4['shop_path']?>/js/lib.min.js" type="text/javascript"></SCRIPT>

<style type="text/css">

.jCarouselLite{}
.jCarouselLite ul{padding:10px 0;}
.jCarouselLite ul li{height:<?=$sc_height?>px;}
.jCarouselLite ul li .item_box{width:<?=$img_width+20?>px;height:<?=$sc_height?>px; margin-left:18px; display:inline-block;  }

.jCarouselLite ul li p{width:<?=$img_width+20?>px;text-align:center;}
.jCarouselLite ul li p.item_name{margin-top:5px;height:14px; line-height:14px; overflow:hidden;}
.jCarouselLite ul li p.amount{height:16px; line-height:16px; font-weight:bold; margin-top:5px;}

</style>

	<div class=jCarouselLite>
		<ul>
			<? for ($i=0; $row=sql_fetch_array($result); $i++) {
				$href = "<a href='$g4[shop_path]/item.php?it_id=$row[it_id]'>";
				if($i%$list_mod == 0) echo "<li>\n";
				?>
					<span class="item_box">
						<p><?=$href?><?=get_it_image($row[it_id]."_s", $img_width, $img_height)?></a></p>
						<p class="item_name"><?=$href?><?=stripslashes($row[it_name])?></a></p>
						<p class="amount"><?=display_amount(get_amount($row), $row[it_tel_inq])?></p>
					</span>
					<?
					if($i%$list_mod == $list_mod-1) echo "\n</li>";
					}?>
		</ul>
</div>
 
 <script language="JavaScript">
	$(function() {
    $(".jCarouselLite").jCarouselLite({
		auto: 3000,
		speed: 1000,
		mouseWheel: true,
		visible: <?=$list_mod?>,
		vertical: true,
		easing: "easeinout"
    });
});
</script>
