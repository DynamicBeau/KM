<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<script type="text/javascript" src="<?=$g4['shop_path']?>/js/jquery.cycle.all.latest.js"></script>
<script type="text/javascript">
// options url  http://jquery.malsup.com/cycle/options.html
$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'scrollUp',
		 speed: 1000,
		timeout: 3000
	});
});
</script>
<style type="text/css">
.slideshow{border:1px solid #DDD; height:200px; overflow:hidden; }
.item_slideshow{height:200px; overflow:hidden; padding:5px;}
.item_slideshow_box{width:150px; height:190px; margin-right:5px; display:inline; float:left; overflow:hidden; text-align:center;}
</style>
<div class="slideshow">
		<? for ($i=0; $row=sql_fetch_array($result); $i++) {
			$href = "<a href='$g4[shop_path]/item.php?it_id=$row[it_id]' class=item>";

			if($i%$list_mod == 0) echo "<div class='item_slideshow'>";
			?>
			<span class="item_slideshow_box">
			<?=$href?><?=get_it_image($row[it_id]."_s", $img_width, $img_height)?></a>
			<p style='padding:3px 0; text-align:center;'><?=$href?><?=stripslashes($row[it_name])?></a></p>
			<p class=amount><?=display_amount(get_amount($row), $row[it_tel_inq])?></p>
			</span>
		<?
			if($i%$list_mod == $list_mod-1) echo "</div>";
			}?>
</div>

  
