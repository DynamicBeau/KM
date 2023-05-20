<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

<?

if (preg_match('/iPhone|iPod|iPad|BlackBerry|Android|Windows CE|LG|MOT|SAMSUNG|SonyEricsson|IEMobile|Mobile|lgtelecom|PPC|opera mobi|opera mini|nokia|webos/',$_SERVER['HTTP_USER_AGENT']) && $_GET[to] != "m" ) { 
//echo "<script type='text/javascript'>location.href = '{$g4[path]}/m/index.php';</script>"; 
}
?>

<style>

.main{width:1000px; border:0px solid red;margin:0 auto;margin-top:30px;}
.main_left{width:140px; float:left;}
.main_left ul li{padding:3px 0;}
.main_leftsub{padding-left:10px;padding-top:5px; display:none;font-size:13px;font-weight:bold;}
.main_leftsub2{line-height:80%; font-family:'나눔고딕';font-size:15px;font-weight:bold;}
.main_img{float:left;border-right:1px solid #ccc;}

.main_img2{float:right;position:absolute;margin-left:499px;border:0px solid #ccc;}

.main_rolling{margin-left:20px; border:1px solid #ccc; width:830px; height:272px;}

.main_right{width:857px;float:right;}

.main_ban{border:1px solid #ccc; width:268px; height:165px;float:left;margin-right:9px;}

.ban1{}
.ban2{border-top:0px solid #ccc;}
.ban3{border-top:0px solid #ccc;}

.prod{border:0px solid red; padding-top:30px;}
.prod_tit{padding:5px 0;}

.item{width:150px;text-align:center; border:0px solid red; float:left;}

p.pro_no{font-weight:bold; color:#666;}
p.pro_name{color:#666;}
p.pro_price{font-weight:bold; color:red;}


.prod_con{width:970px; margin:0 auto; border:0px solid red;}
.prod_con li{width:153px; float:left; text-align:center; border:0px solid red; margin-right:8px; list-style:none; margin-top:30px;}


.bbs_not{float:left; background:url("<?=$g4[path]?>/images/bbs_bg.jpg") no-repeat; width:310px; height:137px; margin-right:10px;}
.bbs_faq{float:left; background:url("<?=$g4[path]?>/images/bbs_bg.jpg") no-repeat; width:310px; height:137px; margin-right:10px;}

.cust{border:0px solid red;margin-top:30px;}
.cust_1{float:left;padding:0 5px;}

.line{border-bottom:1px dashed #ccc;padding:20px 0;}
</style>




<div class="main">

<!--메인레프트-->
	<div class="main_left top_blank">
		<ul>
			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=10"><img src="<?=$g4[path]?>/images/sub_left_11.gif"></a>
				<?$ca3_key = "10"; include("$g4[path]/ca3_include.php"); ?>
			</li>
			
			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=20"><img src="<?=$g4[path]?>/images/sub_left_12.gif"></a>
				<?$ca3_key = "20"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=30"><img src="<?=$g4[path]?>/images/sub_left_13.gif"></a>
				<?$ca3_key = "30"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=40"><img src="<?=$g4[path]?>/images/sub_left_14.gif"></a>
				<?$ca3_key = "40"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=50"><img src="<?=$g4[path]?>/images/sub_left_15.gif"></a>
				<?$ca3_key = "50"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=60"><img src="<?=$g4[path]?>/images/sub_left_16.gif"></a>
				<?$ca3_key = "60"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=70"><img src="<?=$g4[path]?>/images/sub_left_17.gif"></a>
				<?$ca3_key = "70"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=80"><img src="<?=$g4[path]?>/images/sub_left_18.gif"></a>
				<?$ca3_key = "80"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=90"><img src="<?=$g4[path]?>/images/sub_left_19.gif"></a>
				<?$ca3_key = "90"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=a0"><img src="<?=$g4[path]?>/images/sub_left_20.gif"></a>
				<?$ca3_key = "a0"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=b0"><img src="<?=$g4[path]?>/images/sub_left_21.gif"></a>
				<?$ca3_key = "b0"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=d0"><img src="<?=$g4[path]?>/images/sub_left_23.gif"></a>
				<?$ca3_key = "d0"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=c0"><img src="<?=$g4[path]?>/images/sub_left_22.gif"></a>
				<?$ca3_key = "c0"; include("$g4[path]/ca3_include.php"); ?>
			</li>

			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=e0"><img src="<?=$g4[path]?>/images/sub_left_24.gif"></a>
				<?$ca3_key = "e0"; include("$g4[path]/ca3_include.php"); ?>
			</li>
			<li>
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=f0"><img src="<?=$g4[path]?>/images/sub_left_25.gif"></a>
				<?$ca3_key = "f0"; include("$g4[path]/ca3_include.php"); ?>
			</li>

		</ul>
	</div>
<!--메인레프트-->

<!--메인롤링이미지-->
	<div class="main_right">
	<div class="main_rolling">
		<?=latest("main_top", "main_top", 3 ,99);?>
	</div>
		<div style="clear:both;"></div>
		<div style="padding:10px 0 0 20px;"><img src="<?=$g4[path]?>/images/main_tit3.gif" alt="EVENT Product"></div>
		<div style="padding:10px 0 0 20px;">
			<?=latest("main_middle", "main_middle", 3, 99);?>
		</div>
	</div>
<!--메인롤링이미지-->

<div style="clear:both;"></div>
<div class="line"></div>
<!--상품리스트-->
	<div class="prod">
		<div class="prod_tit">
			<img src="<?=$g4[path]?>/images/main_tit1.gif" alt="New Product">
		</div>
		<div class="prod_con">
			<?
			$type = 3;
		
			if ($default["de_type{$type}_list_use"]) 
			{
				echo "<a href='$g4[shop_path]/listtype.php?type={$type}'></a><br>";
				display_type($type, $default["de_type{$type}_list_skin"], $default["de_type{$type}_list_mod"], $default["de_type{$type}_list_row"], $default["de_type{$type}_img_width"], $default["de_type{$type}_img_height"]);
			}
			?>
		</div>
	</div>
<!--상품리스트-->
<div style="clear:both;"></div>
<!--상품리스트-->
	<div class="prod">
		<div class="prod_tit">
			<img src="<?=$g4[path]?>/images/main_tit2.gif" alt="Best Product">
		</div>
		
		<div class="prod_con">
			<?
			$type = 2;
		
			if ($default["de_type{$type}_list_use"]) 
			{
				echo "<a href='$g4[shop_path]/listtype.php?type={$type}'></a><br>";
				display_type($type, $default["de_type{$type}_list_skin"], $default["de_type{$type}_list_mod"], $default["de_type{$type}_list_row"], $default["de_type{$type}_img_width"], $default["de_type{$type}_img_height"]);
			}
			?>
		</div>
	</div>
<!--상품리스트-->
<div style="clear:both;"></diV>
<!--고객센터-->
<div class="cust">
	<div class="bbs_not"><?=latest("basic",m51,4,45);?></div>
	<div class="bbs_faq"><?=latest("basic",m41,4,45);?></div>
	<div class="cust_1"><a href="<?=$g4[path]?>/subpage.php?p=m11"><img src="<?=$g4[path]?>/images/main_bottom3.jpg"></a></div>
	<div class="cust_1"><img src="<?=$g4[path]?>/images/main_bottom4.jpg"></div>
</div>

<!--고객센터-->

</div>

<div style="clear:both;"></div>

<script type="text/javascript">

	jQuery(".top_blank > ul > li").mouseover(function(){

		$(this).find('ul.dep3_div').css("display" , "block");

	});

	jQuery(".top_blank > ul > li").mouseout(function(){

		$(this).find('ul.dep3_div').css("display" , "none");

	});




</script>