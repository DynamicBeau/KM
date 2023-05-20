<style>

.main{width:1000px; border:0px solid red;margin:0 auto;margin-top:30px;}
.main_left{width:170px; float:left;}
.main_left ul li{padding:3px 0;}
.main_leftsub{padding-left:10px;display:none;font-size:15px;font-weight:bold;}
.main_leftsub2{line-height:80%; font-family:'나눔고딕';font-size:15px;font-weight:bold;}
.main_img{float:left;}

.main_img2{float:right;position:absolute;margin-left:498px;border:0px solid #ccc;}

.main_rolling{margin-left:20px; border:1px solid #ccc;width:828px; height:267px;}


</style>


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

	<div>
	<a href="<?=$g4[path]?>/subpage.php?p=m11"><img src="<?=$g4[path]?>/images/main_bottom3.jpg"></a>
	</div>
	<div>
	<img src="<?=$g4[path]?>/images/main_bottom4.jpg">
	</div>
<!--메인레프트-->


<script type="text/javascript">

	jQuery(".top_blank > ul > li").mouseover(function(){

		$(this).find('ul.dep3_div').css("display" , "block");

	});

	jQuery(".top_blank > ul > li").mouseout(function(){

		$(this).find('ul.dep3_div').css("display" , "none");

	});




</script>