<style>
	/* /////////////////////이제부터는 css로 롤오버 버튼만들기.. */
	.tabB{min-height:200px;}
	.left_blank{height:35px;}
	.tabB a{display:block; width:170px; height:25px; line-height:25px; text-align:left; border:0px solid red;}
	.tabB a:hover{display:block; width:170px; height:25px; line-height:25px; text-align:left; border:0px solid red;}
	.l_off {padding-left:10px;}
	.l_over {padding-left:10px;}
	.l_on {color:#ffffff; padding-right:15px; font-weight:bold;}

	.l_bg{background:#1f4187; display:block; height:23px; }
</style>


<div class="tabB">

<?
switch($local) {
	
	case "m12" :
	case "m13_0" :
	case "m14" :
	case "m15" :
	case "m11" :
	case "m11_1" :
	case "m11__1" :
	case "m11_1_1" :
	case "m11_1_2" :
	case "m11_2" :
	case "m11_2_1" :
	case "m11_3" :
	case "m11_4" :
	case "m11_4_1" :
	case "m11_5" :
	case "m11_5_1" :
	case "m11_5_2" :
	case "m11_6" :
	case "m11_7" :
	case "m12_1" :
	case "m13_1" :
	case "m13_1_1" :
	case "m13_1_3" :
	case "m13_1_4" :
	case "m14_1" :
	case "m14_2" :
	case "m14_3" :
	case "m14_4" :
	case "m14_2_1" :
	case "m15_08_01" :
	case "m15_08_02" :
	case "m15_08_03" :
	case "m15_08_04" :
	case "m15_08_05" :
	case "m15_08_06" :

?>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m11__1" >
	<span class="l_off">금융단말시스템</span>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m12" >
	<span class="l_off">금융자동화기기</span>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m13_0">
	<span class="l_off">솔루션</span>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m14">
	<span class="l_off">RF시스템</span>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m15">
	<span class="l_off">소모품</span>
 </a>
<? break; ?>








<?
	case "m21" : 
	case "m22" :
	case "m23" :
?>
  <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m21">
	<span class="l_off">연구소현황</span>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m22">
	<span class="l_off">연구개발분야</span>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m23">
	<span class="l_off">연구개발실적</span>
 </a>
<? break; ?>






<?
	case "m31" :  
	case "m32" :  
	case "m33" :
	case "m34" :

/*수정해야하는부분 시작*/
	case "m34//" :
/*수정해야하는부분 끝*/

	/*case "m35" :*/
?>
  <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m31">
	<span class="l_off">원격제어</span>
 </a>
 <!-- <a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=m33">
	<span class="l_off">공지사항</span>
 </a> -->
 <a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=m32">
	<span class="l_off">기술자료실</span>
 </a>

<!--수정해야하는부분 시작-->
 <!--<a onfocus="blur();"  href="ftp://www.konetech.com">-->
 <a onfocus="blur();"  href="ftp://203.239.44.131">
	<span class="l_off">FTP</span>
 </a>
<!--수정해야하는부분 끝-->
 
<!--<a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m35">
	<span class="l_off">Fund</span>
 </a>-->
<? break; ?>






<?
	case "m41" :
	case "m41__" :
	case "m41_1" :
	case "m41_2" :
	case "m41_3" :
	case "m41_4" :
	case "m41_5" :
	case "m41_6" :
	case "m41_7" :
	case "m42__" :
	case "m42_1" :
	case "m42_2" :
	case "m43" :
	case "m43_1" :
	case "m44" :

?>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m41__">
	<span class="l_off">기업정보</span>
 </a>
  <a onfocus="blur();"  href="<?=$g4[path]?>/subpage.php?p=m42__">
	<span class="l_off">홍보관</span>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/bbs/board.php?bo_table=m43_1">
	<span class="l_off">인재채용</span>
 </a>
<? break; ?>

<?
	case "m51" :
	case "m52" :
	case "m53" :
	case "m54" :
	case "m55" :
	case "m56" :
?>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage_en.php?p=m51">
	<span class="l_off">overview</span>
 </a>
  <a onfocus="blur();"  href="<?=$g4[path]?>/subpage_en.php?p=m52">
	<span class="l_off">history</span>
 </a>
 <a onfocus="blur();"  href="<?=$g4[path]?>/subpage_en.php?p=m53">
	<span class="l_off">vision of company</span>
 </a>
  <a onfocus="blur();"  href="<?=$g4[path]?>/subpage_en.php?p=m54">
	<span class="l_off">CEO</span>
 </a>
  <a onfocus="blur();"  href="<?=$g4[path]?>/subpage_en.php?p=m55">
	<span class="l_off">business</span>
 </a>
  <a onfocus="blur();"  href="<?=$g4[path]?>/subpage_en.php?p=m56">
	<span class="l_off">business showings</span>
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




<?	default :  ?>

<?
	 break;
}

if($local == "m13_0") {
	$local = "m13";
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




?>
</div>

