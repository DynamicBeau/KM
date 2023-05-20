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

body{}

	#head{
	 width:100%;
	 height:100px;
	 background:#fefefe;
	 border-bottom:1px solid #cdcdcd;
	 padding-top:0px;
 }

	#head_con{
	 width:1000px;
	 height:0px;
	 margin:0 auto;
 }

	#top_quick ul li {float:right; display:block; padding-top:80px;}

	img   {vertical-align:top;}

	.head_menu{width:100%; height:17px; background:#484848;font-size:10px; color:#fff;border-bottom:1px solid #cdcdcd;}
	.head_menu2{padding-top:2px;width:1000px; margin:0 auto; text-align:right;}


</style>
<div id="sidebar" style="border:0px solid black; width:990px;  margin:0 auto; position:relative;"><!-- 전체 틀 잡아줌 -->
 <div style="float:right;top:130px; right:-15px;position:absolute;">
 
   <div class="grid_4">



		<!-- 왼쪽 -->
		 <!-- <div style="float:left;width:100px;top:120px; left:-120px;position:absolute;z-index:0;">
			<div style="position:fixed;z-index:0;width:130px;">
			<?include("$g4[shop_path]/banner.inc.php");?> 
			</div>
		 </div>

		 -->

		<?include_once("$g4[path]/shop/boxtodayview.inc.php"); //퀵메뉴?>

			
	 </div>

 </div>
</div>




<div id="head">
<div class="head_menu">
	<div class="head_menu2">
	<a style="color:#fff;" href="<?=$g4[path]?>/">HOME</a>  |  
	<?if($is_guest){?><a style="color:#fff;" href="<?=$g4[path]?>/bbs/register.php">JOIN US</a>  |  <a style="color:#fff;" href="<?=$g4[path]?>/bbs/login.php">LOGIN</a>   |<?}?>   
	<?if($is_member){?><a style="color:#fff;" href="<?=$g4[path]?>/bbs/logout.php">LOGOUT</a>   |    <a style="color:#fff;" href="<?=$g4[path]?>/bbs/member_confirm.php">MY PAGE</a><?}?>
	<?if($is_admin){?>|  <a style="color:#fff;" href="<?=$g4[path]?>/adm">ADMIN</a><?}?>
	</div>
</div>
<div id="head_con">

<?include_once("$g4[path]/include/top.inc.php");?>

</div>
</div>

<Div style="clear:both;"></div>