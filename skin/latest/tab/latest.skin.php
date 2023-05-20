<?
	// 한화면에 다중으로 들어왔을시에 노출이 안되는오류 해결위해..
	$class_name = mt_rand(1,200);
	//echo $class_name;
?>
<style>
/* UI Object */
/* 기본: 하위박스 탭간격있음 */
.box_type<?=$class_name?>{float:left;width:100%;}
.box_type<?=$class_name?> .tab_box{text-align:left;float:left;position:relative;z-index:100;width:100%;margin-left:0px;}
.box_type<?=$class_name?> .tab_box li{float:left;margin-right:3px;border:1px solid #d4d4d4;border-bottom:none}
.box_type<?=$class_name?> .tab_box li a{display:block;padding:8px 19px 6px;color:#666;text-decoration:none}
.box_type<?=$class_name?> .tab_box li a:hover{/*background:#f4f4f4*/color:#333}
.box_type<?=$class_name?> .tab_box li.on{background:#ffffff;}
.box_type<?=$class_name?> .tab_box li.on a{font-weight:bold;letter-spacing:-1px;text-decoration:none}
.box_type<?=$class_name?> .cont{float:left;position:relative;border:1px solid #ddd;margin-top:-1px;font-size:12px;font-family:Tahoma, Geneva, sans-serif;line-height:normal;*zoom:1;width:100%;}

.box_type<?=$class_name?> .cont ul{margin:13px;padding:0;list-style:none}
.box_type<?=$class_name?> .cont li{position:relative;margin:0 0 10px 0}
.box_type<?=$class_name?> .cont li:after{display:block;clear:both;content:""}
.box_type<?=$class_name?> .cont li .bu{float:left;margin:0 4px 0 0;color:#999}
.box_type<?=$class_name?> .cont li a{float:left}
.box_type<?=$class_name?> .cont li .time{float:right;clear:right;font-size:11px;color:#a8a8a8;white-space:nowrap}
/* //UI Object */
</style>
<!--ui object --> 
<div class="box_type<?=$class_name?>" >
	<ul class="tab_box" >
		<?php
			for ($i=0; $i<count($list); $i++) {
				if($i == 0){
					$class_str = "class='on'";
				}else{
					$class_str = "";
				}
		?>
		<li <?=$class_str?>>
		<a href="<?=$g4[bbs_path]?>/board.php?bo_table=<?=$list[$i][bo_table]?>" >
		<?=$list[$i][bo_subject]?>
		</a>
		</li>
		<? } ?>
	</ul>
	

	<?php
		for ($i=0; $i<count($list); $i++) {
			if($i == 0){
				$style_str = "";
			}else{
				$style_str = "style='display:none;'";
			}
	?>
	<div class="cont" <?=$style_str?>>
		<ul>
			<?php
				for ($j=0; $j<count($list[$i])-2; $j++) {
						$li = $list[$i][$j];
				?>
			<li><span class="bu">›</span> <a href="<?=$li[href]?>"><?	echo "$li[subject]";?></a><span class="time"><?=$li[datetime]?></span></li>
			<? } ?>
		</ul>
	</div>
	<? } ?>
</div>
<div class="clear"></div>
<!--//ui object --> 
<script>
	$('div.box_type<?=$class_name?> ul.tab_box li').mouseover(function(){
		$('div.box_type<?=$class_name?> ul.tab_box li').each(function(index) {
				$(this).removeClass('on');
				$('div.box_type<?=$class_name?> div.cont').eq(index).css("display","none");
		});
		$(this).addClass('on');

		$('div.box_type<?=$class_name?> div.cont').eq($(this).index()).css("display","block");
	});


</script>