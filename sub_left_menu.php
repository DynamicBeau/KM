<style>
	/* /////////////////////이제부터는 css로 롤오버 버튼만들기.. */
	.tabB a img.over{display:none;}
	.tabB a:hover{position:relative;}/*7버젼 이하는 잘안돌아가므로..ㄷㄷ 안전방지턱*/
	.tabB a:hover img{display:none;}
	.tabB a:hover img.over{display:inline;}
	.tabB a img.on{display:none;}
	/* /////////////////////이제부터는 css로 롤오버 버튼만들기.. */
</style>

<div class="tabB">
<?
//echo "<script>alert('{$local}');</script>";

switch($local) {
	case "m11" : 
	case "m12" :

?>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m11" >
	<img src="<?=$g4[path]?>/images/left_text_11.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_11_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_11_ov.png" class="on">
	</a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m12">
	<img src="<?=$g4[path]?>/images/left_text_12.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_12_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_12_ov.png" class="on">
 </a>
<? break; ?>
<?
	case "m21" :  
	case "m22" :  
	case "m23" :
	case "m24" :  
	case "m25" :
	case "m26" :
	case "list" : 
	case "item" : 
?>
  <a onfocus="blur();"  href="<?=$g4[path]?>/shop/list.php?ca_id=4010">
	<?if($_GET[ca_id] != "4010"){?>
	<img src="<?=$g4[path]?>/images/left_text_21.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_21_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_21_ov.png" class="on">
	<?}else{?>
	<img src="<?=$g4[path]?>/images/left_text_21_ov.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_21_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_21_ov.png" class="on" >
	<?}?>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/shop/list.php?ca_id=4020">
 <?if($_GET[ca_id] != "4020"){?>
	<img src="<?=$g4[path]?>/images/left_text_22.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_22_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_22_ov.png" class="on">
	<?}else{?>
	<img src="<?=$g4[path]?>/images/left_text_22_ov.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_22_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_22_ov.png" class="on" >
	<?}?>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/shop/list.php?ca_id=4060">
 <?if($_GET[ca_id] != "4060"){?>
	<img src="<?=$g4[path]?>/images/left_text_23.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_23_ov.png"  class="over">
	<img src="<?=$g4[path]?>/images/left_text_23_ov.png" class="on">
	<?}else{?>
	<img src="<?=$g4[path]?>/images/left_text_23_ov.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_23_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_23_ov.png" class="on" >
	<?}?>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/shop/list.php?ca_id=4030">
 <?if($_GET[ca_id] != "4030"){?>
	<img src="<?=$g4[path]?>/images/left_text_24.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_24_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_24_ov.png" class="on">
	<?}else{?>
	<img src="<?=$g4[path]?>/images/left_text_24_ov.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_24_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_24_ov.png" class="on" >
	<?}?>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/shop/list.php?ca_id=4040">
 <?if($_GET[ca_id] != "4040"){?>
	<img src="<?=$g4[path]?>/images/left_text_25.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_25_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_25_ov.png" class="on">
	<?}else{?>
	<img src="<?=$g4[path]?>/images/left_text_25_ov.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_25_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_25_ov.png" class="on" >
	<?}?>
 </a>
  <a onfocus="blur();"  href="<?=$g4[path]?>/shop/list.php?ca_id=4050">
 <?if($_GET[ca_id] != "4050"){?>
	<img src="<?=$g4[path]?>/images/left_text_26.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_26_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_26_ov.png" class="on">
	<?}else{?>
	<img src="<?=$g4[path]?>/images/left_text_26_ov.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_26_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_26_ov.png" class="on" >
	<?}?>
 </a>
<? break; ?>
<?
	case "m31" :  

?>
  <a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=m31">
	<img src="<?=$g4[path]?>/images/left_text_31.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_31_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_31_ov.png" class="on">
 </a>
<? break; ?>
<?
	case "m41" :  
?>
	<a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=m41">
		<img src="<?=$g4[path]?>/images/left_text_41.png" class="nor">
		<img src="<?=$g4[path]?>/images/left_text_41_ov.png" class="over" >
		<img src="<?=$g4[path]?>/images/left_text_41_ov.png" class="on">
	</a>
<? break; ?>
<?
	case "m51" :  
	case "m52" :  
	case "m53" :
?>
  <a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=m51">
	<img src="<?=$g4[path]?>/images/left_text_51.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_51_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_51_ov.png" class="on">
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=m52">
	<img src="<?=$g4[path]?>/images/left_text_52.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_52_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_52_ov.png" class="on">
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=m53">
	<img src="<?=$g4[path]?>/images/left_text_53.png" class="nor">
	<img src="<?=$g4[path]?>/images/left_text_53_ov.png" class="over" >
	<img src="<?=$g4[path]?>/images/left_text_53_ov.png" class="on">
 </a> 
<? break; ?>
<?
	case "qna" :  
	case "notice" :  
	case "faq" :
	case "sian" :
	case "help" :
	case "m54" :
	case "m55" :
	case "schedule" :
?>
 <!--	<a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=qna">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_51.jpg" class="nor">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_51_ov.jpg" class="over" >
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_51_on.jpg" class="on">
	</a>
	<a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=faq">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_52.jpg" class="nor">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_52_ov.jpg" class="over" >
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_52_on.jpg" class="on">
 </a>
	<a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=sian">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_53.jpg" class="nor">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_53_ov.jpg"  class="over">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_53_on.jpg" class="on">
 </a>
	<a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=help">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_54.jpg" class="nor">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_54_ov.jpg"  class="over">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_54_on.jpg" class="on">
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m55">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_13.jpg" class="nor">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_13_ov.jpg"  class="over">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_13_on.jpg" class="on">
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=schedule">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_57.jpg" class="nor">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_57_ov.jpg"  class="over">
	<img src="<?=$g4[path]?>/images/sub_left_menu/subp_left_m_57_on.jpg" class="on">
 </a> -->
<? break; ?>

<? 
	case "login":
?>
 <a onfocus="blur();"  href="<?=$g4[path]?>/bbs/login.php">
	<img src="<?=$g4[path]?>/images/sub_left_menu/sub_left_menu_01.jpg" class="nor">
	<img src="<?=$g4[path]?>/images/sub_left_menu/sub_left_menu_h_01.jpg"  class="over">
	<img src="<?=$g4[path]?>/images/sub_left_menu/sub_left_menu_h_01.jpg" class="on">
 </a>
 <!-- <a onfocus="blur();"  href="#">
	<img src="<?=$g4[path]?>/images/sub_left_menu/sub_left_menu_02.jpg" class="nor">
	<img src="<?=$g4[path]?>/images/sub_left_menu/sub_left_menu_h_02.jpg"  class="over">
	<img src="<?=$g4[path]?>/images/sub_left_menu/sub_left_menu_h_02.jpg" class="on">
 </a>
 <a onfocus="blur();"  href="#">
	<img src="<?=$g4[path]?>/images/sub_left_menu/sub_left_menu_03.jpg" class="nor">
	<img src="<?=$g4[path]?>/images/sub_left_menu/sub_left_menu_h_03.jpg"  class="over">
	<img src="<?=$g4[path]?>/images/sub_left_menu/sub_left_menu_h_03.jpg" class="on">
 </a> -->
 <? break; ?>

<?	default :  ?>

<?
		$not_local = "1";
	 break;
}

if($local == "qna") {
	$local = "m51";
}

if($local == "faq") {
	$local = "m52";
}

if($local == "sian") {
	$local = "m53";
}

if($local == "help") {
	$local = "m54";
}

if($local == "login") {
	$local = "m01";
}

if( $local == "m11" && $mm == "1" ){
	$local = "m42";
}
if( $local == "m21" && $mm == "1" ){
	$local = "m43";
}
if( $local == "m31" && $mm == "1" ){
	$local = "m44";
}
if( $local == "m41" && $mm == "1" ){
	$local = "m42";
}
?>
</div>

<script>
	$(document).ready(function(){
		$('div.tabB a img.nor').each(function(index) {
			if((index+1) == '<?=substr($local,2,1)?>'){
				$('div.tabB a img.nor:eq(' + index + ')').attr('src',$('div.tabB a img.on:eq(' + index + ')').attr('src'));
				$('div.tabB a img.over:eq(' + index + ')').attr('src',$('div.tabB a img.on:eq(' + index + ')').attr('src'));
			}
		});
	});
</script>
