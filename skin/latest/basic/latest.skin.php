<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<style>
/* UI Object */
.section_ul{position:relative;border:0px solid red;background:url("<?=$g4[path]?>/images/bbs_bg.jpg") no-repeat;font-size:11px;font-family:Tahoma, Geneva, sans-serif;line-height:normal;*zoom:1;width:100%;z-index:0;}
.section_ul a{color:#666;text-decoration:none}
.section_ul a:hover,
.section_ul a:active,
.section_ul a:focus{text-decoration:underline}
.section_ul em{font-style:normal}
.section_ul h2{margin:0;padding:10px 0 8px 13px;border-bottom:1px solid #ddd;font-size:12px;color:#333}
.section_ul h2 em{color:#001757}
.section_ul ul{margin:10px;padding:0;list-style:none}
.section_ul li{position:relative;margin:0 0 10px 0}
.section_ul li:after{display:block;clear:both;content:""}
.section_ul li .bu{float:left;margin:0 4px 0 0;color:#999}
.section_ul li a{float:left}
.section_ul li .time{float:right;clear:right;font-size:11px;color:#a8a8a8;white-space:nowrap}
.section_ul .more{position:absolute;top:10px;right:13px;font:11px Dotum, 돋움;text-decoration:none !important}
.section_ul .more span{margin:0 2px 0 0;font-size:16px;font-weight:bold;color:#d76ea9;vertical-align:middle}
/* //UI Object */	
</style>
<!-- UI Object -->
<div class="section_ul">
	<h2> <em><?php echo $board[bo_subject]?></em></h2>
	<ul>
	<?php
    for ($i=0; $i<count($list); $i++) {
        $li = $list[$i];
		?>
	<li><span class="bu">›</span> <a href="<?=$li[href]?>"><?	echo "$li[subject]";?></a><span class="time"><?=$li[datetime]?></span></li>
	<? } ?>
	</ul>
	<a href="<?php echo $g4[bbs_path]?>/board.php?bo_table=<?php echo $bo_table?>" class="more"><span></span>| more |</a>
</div>
<!-- //UI Object -->


