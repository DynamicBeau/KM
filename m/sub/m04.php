<?include("_common.php");?>
<style>
	#bar											{width:320px; height:41px; margin:0 auto; background:url("../m/image/footer_bg.jpg") repeat-x;}
	.call											{float:left; margin:10px 10px 10px 70px;}
	.PC												{float:right; margin:10px 70px 10px 10px;}
	.ad												{width:320px; height:83px;	background-color:#dfdfdf; margin:0 auto; }
	.home											{ float:right; margin-top:42px; margin-right:8px;}
	.text1											{ margin: 0 0 0 8px; float:left; width:265px; border:0px red solid;}
	.button										{  width:280px; border:1px red solid; }
	.button li								{ list-style:none; display:inline;  margin-right:0px;}
		
</style>




<div style="width:100%;">
	<div style="width:320px; height:68px; margin:0 auto; background:url('../m/image/sub_topbg.jpg') no-repeat;">
<a href="http://dc7.co.kr/m/"><img style="margin:20px 20px 10px 45px; " src="../m/image/home.png"></a>
</div>
<div style="height:10px;">

</div>


<div style="width:320px; margin:0 auto; ">
<table style="width:100%; border:0px solid red;text-align:center; vertical-align:middle;">
			<tbody>
			<tr>
				<td><a href="../m/subpage.php?p=m01"><img style="margin-top:3px;"  src="../m/image/button1.png"></a></td>
				<td><a href="../m/subpage.php?p=m04"><img style="margin-top:3px;"src="../m/image/button3.png"></a></td>
			
			</tr>
			<tr>
				<td><a href="tel:1588-8467"><img style="margin-top:-7px;"src="../m/image/button2.png"></a></td>
				<td><a href="../m/subpage.php?p=m05"><img style="margin-top:-7px;"src="../m/image/button4.png"></a></td>
				
			</tr>
			
			</tbody>
			</table>


<div style="width:320px; margin:0 auto;text-align:center;">
	<a href="<?=$_SERVER[PHP_SELF]?>?p=<?=$p?>&cat=4010">장애인편의시설물&nbsp;|</a>
	<a href="<?=$_SERVER[PHP_SELF]?>?p=<?=$p?>&cat=4020">LED차량유도등&nbsp;&nbsp;|</a>
	<a href="<?=$_SERVER[PHP_SELF]?>?p=<?=$p?>&cat=4060">LED전광판</a>	
</div>
<div style="width:320px; margin:0 auto;text-align:center;">
	<a href="<?=$_SERVER[PHP_SELF]?>?p=<?=$p?>&cat=4030">주차도로안전시설물&nbsp;&nbsp;|</a>
	<a href="<?=$_SERVER[PHP_SELF]?>?p=<?=$p?>&cat=4040">공동주택시설물&nbsp;&nbsp;|</a>
	<a href="<?=$_SERVER[PHP_SELF]?>?p=<?=$p?>&cat=4050">준공사인물</a>
</div>
<div style="height:15px;">
</div>





<div style="min-height:356px; margin:0 auto; width:320px;text-align:center; ">
<!--<img src="../m/image/sub_img4_1.jpg" id="sub_menu_img1">
<img src="../m/image/sub_img4_2.jpg" id="sub_menu_img2" style="display:none;">-->
<?
$sql_common = " from yc4_item ";
$cat = $_GET[cat];
$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "mb_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}else{
	if(!$cat){
		$sql_search .= "and (mobile_intro = '1') ";
	}else{
		$sql_search .= "and (mobile_intro = '1') and (ca_id like '$cat%') ";
	}
}

if (!$sst) {
    $sst  = "it_id";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common 
         $sql_search 
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 5;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

for($i=0; ($it = sql_fetch_array($result)); $i++){
	//print_r2($it);
	$middle_image = $it[it_id]."_m";
	echo get_it_image($middle_image,300,300);
	echo "<br>".$it[it_name];
	?>
	<span style="font-weight:bold;color:rgb(0,153,69);">
	<?
	if($it[it_cust_amount] != "0"){
		echo "<br>".display_amount($it[it_cust_amount]);
	}else{
		echo "<br>".display_amount(get_amount($it), $it[it_tel_inq]);
	}
	?>
	</span>
	<?

	echo "<br><br>";
}
if($i == "0"){?>
<div style="height:250px;text-align:center;vertical-align:middle;">
	<span style="line-height:120px;">아직 모바일에 표시 할 상품이 없습니다.</span>
</div>
<?}?>
</div>
<?
$pagelist = get_paging(5, $page, $total_page, "$_SERVER[PHP_SELF]?p=$p&cat=$cat&page=");
?>
<table width=100% cellpadding=3 cellspacing=1>
	<tr>
		<td align=center style="text-align:center;"><span style="font-size:20px;letter-spacing:2px;"><?=$pagelist?></span></td>
	</tr>
</table>

<div style="width:100%;">

			<div id="bar">
					<div class="call">
						<a href="tel:1588-8467"><img src="../m/image/call.png"></a>
					</div>
					<div class="PC">
					<a href="http://dc7.co.kr/index.php?to=m"><img src="../m/image/pc.png"></a>
					</div>

			</div>	


			<div class="ad">
						<div class="text1">
												<p style="font-size:7.9pt;">
						서울특별시 강동구 올림픽로 98길 41(암사동,2층)<br>대표 : 최승정 | 상호: 대청애드기업|<br> COPYRIGHT(C) DC7 CO.,LTD. ALL RIGHTS RESESRVED.
						</p>
							<!-- <img src="../m/image/text.jpg"> -->
						</div>
						<div class="home">
						<a href="http://dc7.co.kr/m"><img src="../m/image/home.jpg"></a>
						</div>
			</div>
		
		
</div>




</div>



