
<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>


<?
echo mw_popup();
include_once("$g4[path]/tail.sub.php");
?>


<style>

	#tail{
	 width:100%;
	 height:78px;
	 margin:0 auto;
	 border-top:1px solid #ccc;
	
 }

	#tail_con{
	 width:1000px;
	 height:78px;
	 margin:0 auto;
 }

</style>



<div id="tail" style="margin-top:30px;">

<div id="tail_con">

<div style="float:left; margin-top:23px;"><img src="<?=$g4[path]?>/images/tail_logo.png"></div>
<div style="float:left; margin-top:23px;margin-left:15px; font-size:11px; ">
<img src="<?=$g4[path]?>/images/tail_img.jpg"> <?if($is_admin){?><br><a href="<?=$g4[path]?>/adm/">관리자모드</a><?}?>
</div>
<div style="float:left; margin-top:16px;margin-left:15px; font-size:11px; ">

<form name="shop_check" method="post" action="http://admin.kcp.co.kr/Modules/escrow/kcp_pop.jsp">
	<input type="hidden" name="site_cd" value="E8769">
	<a href="javascript:go_check()" alt="가입사실확인"  onfocus="this.blur()"><img src="<?=$g4[path]?>/images/kcp.jpg"></a>
</form>

</div>


<div style="clear:both;"></div>

</div>

</div>

<script language="JavaScript">
	function go_check()
	{
		var status  = "width=500 height=450 menubar=no,scrollbars=no,resizable=no,status=no";
		var obj     = window.open('', 'kcp_pop', status);

		document.shop_check.method = "post";
		document.shop_check.target = "kcp_pop";
		document.shop_check.action = "http://admin.kcp.co.kr/Modules/escrow/kcp_pop.jsp";

		document.shop_check.submit();
	}
</script>
