<!--[navi start]-->
	<script type="text/javascript">
	/*
	버전1.0 : 각 메인메뉴들의 오버와 아웃시의 가로 값이 일정하게 정렬됩니다. 각 오버와 아웃시의 텍스트 길이가 달라고 같은 가로 값이 유지됩니다.
	버전2.0 : 서브메뉴를 생성할 수 있습니다.  생성된 메인메뉴와 서브메뉴의 오버 아웃 텍스트의 색상을 조정할 수 있습니다.
	버전3.0 :
			└ 3.1 : 각 서브 메뉴들의 슬라이드 애니메이션 효과가 추가되었습니다.
			└ 3.2 : 서브메뉴의 길이가 길어지거나 메인 내비게이션의 총길이를 넘어섰을 때 내비게이션의 가로값을 넘어가버리는 현상을 수정하였습니다.
	*/

/*
 jQuery.browser.version  => 브라우저 버전 ( 모든 브라우저에 대한 버전 표시 )
 jQuery.browser.msie => ms 익스플로러 브라우저일 때 true
 jQuery.browser.mozilla => 모질라 파이어폭스 브라우저일 때 true
 jQuery.browser.opera => 오페라 브라우저일 때 true
 jQuery.browser.safari => 사파리 브라우저일 때 true
 */

		jQuery(document).ready (function () {
			//alert ( jQuery.browser.version ) ;
			/*
			var len = jQuery('ul').children() ;
			var chkW ;
			for ( var i = 0 ; i < len.length ; i++ ) {
				chkW = jQuery(len[i]).children('.F').width() > jQuery(len[i]).children('.B').width() ? jQuery(len[i]).children('.F').width() : jQuery(len[i]).children('.B').width() ;
				jQuery(len[i]).children('.F').css('width' , chkW) ;
				jQuery(len[i]).children('.B').css('width' , chkW) ;
			}
			*/
 
			jQuery('.navi > li').mouseover(function(){
				if ( jQuery.browser.version == "6.0" || jQuery.browser.version == "7.0" ) {
					$(this).find('ol').css({'margin-top' : '36px'})
				} else {
					$(this).find('ol').css({'margin-top' : '8px'  })
				}
				$(this).find('ol').css({
					'display' : 'block'
				}).stop().animate({ opacity:'1', height:'38px' }) ;
				var pos = $(this).find('ol').position() ;
				var mWidth = $('.navi').width()  ;
				
				var sWidth = pos.left + $(this).find('ol').width() ;
				var minusWidth = sWidth - mWidth ;
				if ( sWidth > mWidth ) {
//					$(this).find('ol').css( 'margin-left' , '-' + minusWidth + "px" ) ;
				}
			}) ; 
			jQuery('.navi > li').mouseout(function(){
				$(this).find('ol').stop().animate({ opacity:'0', height:'0px' }) ;
			}) ;

			
		}) ;
	</script>
<!--[navi end]-->

<style>
div.top_navi			{ width:740px; height:41px ;margin:0 auto; position:relative; border:0px solid red; background: }
/*  navi  */
ul , ol											{ margin:0px ; padding:0px ; list-style:none ; z-index:99 ;}
ul.navi										{ float:left ; width:800px ; vertical-align:middle ; position:relative ; z-index:10 ; border:0px solid red; margin-top:-32px; margin-left:240px;}
ul.navi > li									{ float:left ; }
ul.navi > li > span							{ display:inline-block; padding:0 70px 0 80px; padding-left:6px; cursor:pointer ; text-align:center ;}
ul.navi > li > span.B						{ display:none ;}
ul.navi > li:hover > span.F				{ display:none ;}
ul.navi > li:hover > span.B				{ display:inline-block ; color:#888 ;}

ul.navi > li 									{ position:relative; height:36px;}
ul.navi > li ol								{ display:block ; opacity:0 ; height:0px ; position:absolute ; left:55px ; z-index:10 ; border:0px solid red; }
ul.navi > li ol > li							{ float:left ; overflow:hidden ; }
ol.smenu01									{ width:336px; margin-left:-68px ; padding-left:18px; }
ol.smenu02									{ width:800px; margin-left:-385px ; padding-left:18px; }
ol.smenu03									{ width:100px; margin-left:-78px ; padding-left:18px; }
ol.smenu04									{ width:100px;margin-left:-75px ; padding-left:18px; }
ol.smenu05									{ width:300px; margin-left:-220px ; padding-left:18px; } 
ol.smenu06									{ width:200px; margin-left:0px ; }

ul.navi > li ol > li > span					{ display:inline-block ; margin-top:19px; *margin-top:5px; padding:0 10px 0 10px; cursor:pointer ; color:#fff ;  font-family:맑은 고딕; font-size:15px; font-weight:bold; border:0px solid red; }/*서브처음*/

ul.navi > li ol > li > span.B				{ display:none ; border-bottom:0px solid #fff ;  }
ul.navi > li ol > li > span.B > a			{ color:#557d01 ; border-bottom:0px solid #fff ;  font-weight:bold; border:0px solid blue; }/*서브오버시*/

ul.navi > li ol > li:hover > span.F		{ display:none ;  }
ul.navi > li ol > li:hover > span.B		{ display:inline-block ; }

/*서브 BG가 안깔려있게 하는거*/
/*div.subBg	{ height:30px ; width:1024px ; background:#f4f4f4 ; position:absolute ; left:0px ; top:41px ; display:none ; z-index:9 ; }*/


/*div.subBg	{ height:30px ; width:1024px ; background:#f4f4f4 ; position:absolute ; left:0px ; top:41px ; z-index:9 ; }
div.top_navi:hover > div.subBg	{ display:block ; opacity:0.5 ; }
*/
.rePadding	{ padding:0px ; }
</style>
<!-- 메뉴 정보 가져오기 -->
<?include_once("$g4[path]/url_menu.php")?>
<?
for($i=0;$i<count($menu);$i++){
	$menu[$i][0] = iconv ( "CP949" , "utf-8", $menu[$i][0]);
	$menu[$i][1] = iconv ( "CP949" , "utf-8", $menu[$i][1]);
	$menu[$i][2] = iconv ( "CP949" , "utf-8", $menu[$i][2]);
	for($j=0;$j<count($menu[$i][3]);$j++){

	}
}
?>
<style>
.imgMenu{
	
    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)"; /* IE8 */   
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF);   /* IE6 & 7 */      
    -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    filter: alpha(opacity=100);
    -khtml-opacity: 1;
    -moz-opacity: 1;
    opacity: 1;
}
</style>
<!-- 메뉴 정보 가져오기 -->
	<div class="top_navi" >
		<ul class="navi" >
		<? for($i=0;$i<count($menu);$i++){ ?>
			<li>
				<span class="F" ><img class="num01" src="<?=$g4[path]?>/images/nom<?=($i+1)?>.png" class="imgMenu"/></span><span class="B"><a href="<?=$menu[$i][1]?>"><img class="num0<?=($i+1)?>" src="/images/nom<?=($i+1)?>_b.png" alt="<?=$menu[$i][0]?>" class="imgMenu"/></a></span>
				<ol class="smenu0<?=($i+1)?>" ><!-- style="border:1px solid red;" -->
				<?for($j=0;$j<count($menu[$i][3]);$j++){
					$str  = "";

					if($j == (count($menu[$i][3])-1)){
					$str  = "";
					}
					?>
				<!-- <li><span class="F"><?=$menu[$i][3][$j][0]?></span>
				<span class="B"><a href="<?=$menu[$i][3][$j][1]?>"><?=$menu[$i][3][$j][0]?></a> </span> <?=$str?> </li> -->
				<? } ?>
				</ol>
			</li>
		<? } ?>
		</ul>
		<div class="subBg"></div>
	</div>


<script>
jQuery('ul.navi > li > ol').css("display", "none");
</script>