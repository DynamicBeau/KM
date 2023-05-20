<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<? 
for ($i=2; $i<3; $i++) { 
	$li = $list[$i];
	$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
?>
	<div class="main_img">
		<a id="main_first_a" href="<?=$li[wr_link1]?>"><img id="main_first_img" src="<?=$imagepath?>" style="width:510px;height:272px;"></a>
	</div>
<?
}
?>


<div class="main_img2">
<? 
for ($i=0; $i<count($list); $i++) { 
	$li = $list[$i];
	$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
	$imagepath2 = $list[$i][file][1][path]."/".$list[$i][file][1][file];
	$imagepath3 = $list[$i][file][2][path]."/".$list[$i][file][2][file];
?>
	<div class="ban<?=($i+1)?>"><a id="main_right_b_a<?=$i?>" href="<?=$li[wr_link1]?>">
		<img id="main_right_b_img<?=$i?>" <?if($i!=2){?> src="<?=$imagepath2?>" <?}else{?> src="<?=$imagepath3?>"  <?}?> first_img="<?=$imagepath?>" second_img="<?=$imagepath2?>" third_img="<?=$imagepath3?>" onmouseover="javascript:first_chn('<?=$i?>');" style="width:331px;height:90px;padding-bottom:0px;">
	</a></div>
	<div style=" width:320px;margin-left:11px;border-top:1px solid #ccc;"></div>
<?
}
?>
</div>

<script>
var i =0 ;

function first_chn(idx){

	for(i=0; i<3; i++){
		if(i==idx){
			$("#main_right_b_img"+i).attr("src", $("#main_right_b_img"+i).attr("third_img") );
		}else{
			$("#main_right_b_img"+i).attr("src", $("#main_right_b_img"+i).attr("second_img") );
		}
	}

	$("#main_first_img").attr("src", $("#main_right_b_img"+idx).attr("first_img") );
	$("#main_first_a").attr("href", $("#main_right_b_a"+idx).attr("href") );
	
}
</script>