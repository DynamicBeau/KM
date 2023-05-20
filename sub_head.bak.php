<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once("$g4[path]/head.sub.php");
include_once("$g4[path]/lib/outlogin.lib.php");
include_once("$g4[path]/lib/poll.lib.php");
include_once("$g4[path]/lib/visit.lib.php");
include_once("$g4[path]/lib/connect.lib.php");
include_once("$g4[path]/lib/popular.lib.php");
include_once("$g4[path]/lib/latest.lib.php");

$homeUrl = "http://uknnews.com/"; //즐겨찾기 와 시작페이지 홈 경로 설정
?>

<style>

body{background:url('<?=$g4[path]?>/images/head_bg.jpg') repeat-x left top;}

	#head{
	 width:100%;
	 height:0px;
	 padding-top:0px;
 }

	#head_con{
	 width:1000px;
	 height:0px;
	 margin:0 auto;
 }

	#top_quick ul li {float:right; display:block; padding-top:80px;}

	img   {vertical-align:top;}

</style>

<script type="text/javascript" src="<?=$g4[path]?>/js/jquery-contained-sticky-scroll.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
	    jQuery('#sidebar').containedStickyScroll();
	});
</script>

<style type="text/css">
	.grid_4{border:0px solid black; left:100%;z-index:15;}
</style>

<?
$tv_idx = get_session("ss_tv_idx");

$tv_div[top] = 0;
$tv_div[img_width] = 70;
$tv_div[img_height] = 70;
$tv_div[img_length] = 3; // 보여지는 최대 이미지수
?>

<div id="sidebar" style="border:0px solid black; width:990px;  margin:0 auto; position:relative;"><!-- 전체 틀 잡아줌 -->
 <div style="float:right;top:130px; right:-120px;position:absolute;">
 
   <div class="grid_4">
			<table width="100%" height="323px" cellpadding="0" cellspacing="0" border="0" align="center" style="text-align:center;"> <!-- background="<?=$g4[path]?>/images/quick_menu.png"  -->
				<tr>
					<td>
					<?
						// 오늘 본 상품이 있다면 	if ($tv_idx > $tv_div[img_length]){
						if ($tv_idx > 0)
						{
					
						?>
							<!--퀵메뉴 헤드,위쪽 화살표 시작-->
							<table cellpadding="0" cellspacing="0" border="0" align="center" style="margin-top:28px;">
								<tr>
									<td><img src="<?=$g4[path]?>/images/quick_head.png"></td>
								</tr>
									




								<table width="97px" cellpadding="0" cellspacing="0" border="0"  style="background-color:#fff; margin-left:3px;table-layout:fixed;">
									<tr>
										<td>											
											<tr>
												<td id="quick_top" align="center" style="padding-top:10px;"><img src="<?=$g4[path]?>/images/top_arrow.png"></td>
											</tr>											
											<tr>
												<td style="padding-top:10px;"><img src="<?=$g4[path]?>/images/quick_text.png"></td>
											</tr>
										<!--퀵메뉴 헤드,위쪽 화살표 끝-->

											
											<tr>
												<td id="quick_td" align="center" style="height:150px;">
													<div id="quick_div" style="height:150px;overflow:hidden;">
														<div id="quick_td2" style="margin-top:0px">
														<?for ($i=1; ($tv_it_id = get_session("ss_tv[$i]")); $i++){?>
															<?													
															$p_bo_table = get_session("ss_board[$i]");
															if($p_bo_table){
																$tmp_write_table = $g4['write_prefix'] . $p_bo_table; 
																$img = latest_where("latest_img", $p_bo_table, 1, 30, "wr_id = $tv_it_id");
															?>

																<a href="<?=$g4[path]?>/bbs/board.php?bo_table=<?=$p_bo_table?>&wr_id=<?=$tv_it_id?>"><img src="<?=$img?>" style="width:50px;height:50px;"></a>
																
															<?}?>
														<?}?>
														</div>	
													</div>
												</td>
											</tr>
										<!--top_btn,아래쪽 화살표 시작-->
											
											<tr>
												<td align="center"><img src="<?=$g4[path]?>/images/bottom_arrow.png"></td>
											</tr>
										
											
										<!--top_btn,아래쪽 화살표 끝-->
													</td>
												</tr>
								</table>






								<tr>
									<td><a href="#"><img src="<?=$g4[path]?>/images/quick_bottom.png"></a></td>
								</tr>

							</table>
						<?}else{?>
							<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="margin-top:28px; margin-left:-4px;">						
								<tr>
									<td align="center" height="153">오늘 본 상품</td>
								</tr>						
							</table>
						<?}?>
					</td>
				</tr>
			</table>
	 </div>

 </div>
</div>

<!-- 오늘 본 상품 -->
<script>
$(document).ready(function(){
	var div_height;
	var div_top = $("#quick_td2").css("margin-top");
	var top_over_count = <?=$tv_div[img_length]?>;
	
	div_height = parseInt(div_height);
	div_height = <?=$tv_div[img_length]?> * 50;
	alert(div_height);
	$("#quick_div").css("height", div_height+"px");
	$("#quick_td").css("height", div_height+"px");
	alert( $("#quick_td").css("height") );
	
	$("#quick_top").click(function(){
		div_top = parseInt(div_top);
		if(top_over_count < <?=$tv_idx?>){
			div_top = div_top - 50;
			$("#quick_td2").css("margin-top", div_top+"px");
			top_over_count++;
		//	alert(top_over_count);
		//	alert("<?=$tv_idx?>");
		}

	});
	
});
</script>

<script language="JavaScript">

var goods_link = new Array();
<?
echo "var goods_max = ".(int)$tv_idx.";\n";
echo "var goods_length = ".(int)$tv_div[img_length].";\n";
echo "var goods_current = goods_max;\n";
echo "\n";

for ($i=1; $i<=$tv_idx; $i++)
{
    $tv_it_id = get_session("ss_tv[$i]");
		$p_bo_table = get_session("ss_board[$i]");
		$tmp_write_table = $g4['write_prefix'] . $p_bo_table; 
    $img = latest_where("latest_img", $p_bo_table, 1, 30);

    echo "goods_link[$i] = <img src='$img'> ";
}
?>



function todayview_move(current)
{
    k = 0;
    for (i=goods_current; i>0 ; i--) 
    {
        k++;
        if (k > goods_length)
            break;
        document.getElementById('todayview_'+k).innerHTML = goods_link[i];
    }
}

function todayview_up()
{
    if (goods_current + 1 > goods_max)
        alert("오늘 본 마지막 상품입니다.");
    else
        todayview_move(goods_current++);
}

function todayview_dn()
{
    if (goods_current - goods_length == 0)
        alert("오늘 본 처음 상품입니다.");
    else
        todayview_move(goods_current--);
}

<?
$k=0;
for ($i=$tv_idx; $i>0; $i--) 
{
    $k++;
    if ($k > $tv_div[img_length])
        break;

    $tv_it_id = get_session("ss_tv[$i]");
    echo "document.getElementById('todayview_{$k}').innerHTML = goods_link[$i];\n";
}

if ($tv_idx)
{
    echo "if (document.getElementById('todayviewcount')) document.getElementById('todayviewcount').innerHTML = '$tv_idx';\n";
}
?>
</script>

<div id="container">
	<div id="header"><?include_once("$g4[path]/include/top.inc.php");?></div>
	<div><img src="<?=$g4[path]?>/images/sub_img.jpg" style="margin-top:-25px;"></div>
</div>

<div style="width:1000px; margin:0 auto; margin-top:32px;">
	<!-- 레프트 네비 -->
	<?if($left_cut != "true"){?>
	<div style="float:left; width:204">
		<div style="background:url('/images/left_menu.png') no-repeat 20px top;"><img src="<?=$g4[path]?>/images/<?=$tp[navi2]?>.png"></div>
		<div style="margin-left:-27px;"><? include ("$g4[path]/include/left.navi2.inc.php");?></div>
	</div>
	<?}?>

	<!--  컨텐츠 타이틀 -->
	<div style="float:right; width:762px;">

		<!------------------------------------------------오늘 본 상품 -------------------------------------------------------------------->




		<div><? include_once("$g4[path]/include/content_navi.inc.php");?></div>
		<!-- 컨텐츠 영역 -->
		<div>

