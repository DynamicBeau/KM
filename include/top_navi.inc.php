<style>
/* navi css start */
div.top_navi							{ width:970px ; height:34px; background:url("/images/menu_bg.jpg") repeat-x left top ; box-sizing:border-box ; z-index:9999 ; float:left ; }
ul , ol									{ margin:0px ; padding:0px ; list-style:none ; z-index:99 ; font-size:8pt ;  }
ul.navi									{ float:left ; width:970px ;vertical-align:middle ; position:relative ; z-index:10 ; margin:0px ; }
ul.navi li.babo							{ font-family:'Arial', Helventica, sans-serif; font-size:12pt ; color:red ; font-weight:bold }
ul.navi li.babo span a.topFont			{ font-family:'Arial', Helventica, sans-serif; font-size:12pt ; color:blue ;  }

ul.navi li span							{ display:inline-block ; padding:0px  ; cursor:pointer ; text-align:center ; margin:0px ; }
ul.navi li span.B						{ display:none ; }
ul.navi li:hover span.F					{ display:none ; }
ul.navi li:hover span.B					{ display:inline-block ; color:blue ; }

ul.navi li.nom1 						{ position:relative ; margin:0px ; float:left ;  }
ul.navi li ol							{ display:block ; opacity:0 ; height:0px ; position:absolute ; left:0px ; z-index:10 ; }
ul.navi li ol li						{ overflow:hidden ; }
ol.smenu01								{ width:238px; margin-left:1px ; }
ol.smenu02								{ width:238px; margin-left:1px ; }
ol.smenu03								{ width:238px; margin-left:1px ; }
ol.smenu04								{ width:238px; margin-left:1px ; }

ul.navi > li ol > li > span				{ display:inline-block ; padding:5px 0px ; margin:3px ; cursor:pointer ; color:#fff ; font-size:13px ; padding-left:10px; }
ul.navi > li ol > li > span.B			{ display:none ; }
ul.navi > li ol > li > span.B:hover		{ display:none ; }
ul.navi li.babo ol.smenu_font li span a { color:black ; font-family:'Helventica' ; font-size:11pt ; font-weight:bold ; padding-left:15px; background:url('/images/icon06.png') no-repeat 0px 3px ; }
ul.navi > li ol > li > span.B > a		{ color:#444 ; font-family:'Helventica' ; font-size:11pt ; padding-left:15px; background:url('/images/icon06.png') no-repeat 0px 3px ; }
ul.navi > li ol > li > span.B > a:hover		{ color:#fff ; font-family:'Helventica' ; font-size:11pt ;  }

ul.navi > li ol > li:hover > span.F		{ display:none ;  }
ul.navi > li ol > li:hover > span.B		{ display:inline-block ; }

ul.navi li ol li						{ opacity:1 ; width:236px ; border:1px solid #ddd ; margin:0px ; z-index:9999 ;   }
ul.navi li ol li:hover					{ opacity:1 ; width:236px ;  }
ul.navi li ol.smenu01 li:hover			{ background:#00a678 ; }
ul.navi li ol.smenu02 li:hover			{ background:#97a600 ; }
ul.navi li ol.smenu03 li:hover			{ background:#a64300 ; }
ul.navi li ol.smenu04 li:hover			{ background:#0090a0 ; }
ul.navi li ol li						{ display:block ; opacity:1 ; width:236 px ; background:#000 ; color:#fff ; background:#fafafa ; -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)"; filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); 
}
/* navi css end */
</style>
<div id='div_top_navi' class="top_navi" style="display:none;">
	<ul class="navi">
	<li class="nom1 babo">
		<span class="F"><img src="/images/menu01.gif" alt="game" title="game"/></span>
		<span class="B"><a href="/shop/list.php?ca_id=10" class="topFont"><img src="/images/menu01_h.gif" alt="game" title="game"/></a></span>
		<ol class="smenu01 smenu_font">
		<?
		if(strlen($_GET[ca_id])  == 0){
			$ca_id = "01";
			$_GET[ca_id] = "01";
			
		}
		$wr_ca_id = 10;
		
		$sql = " select ca_id, ca_name from $g4[yc4_category_table]
						 where ca_id like '$wr_ca_id%'
						 and ca_use = '1'
						 and length(ca_id) = 4 order by ca_id ";
		$result = sql_query($sql);
		?>
		<?while ($row=sql_fetch_array($result)) {?>
		<li><span class="F"><a href="<?=$g4[shop_path]?>/list.php?ca_id=<?=$row[ca_id]?>"><?=$row[ca_name]?></a></span><span class="B"><a href="<?=$g4[shop_path]?>/list.php?ca_id=<?=$row[ca_id]?>"><?=$row[ca_name]?></a></span></li>
		<? } ?>
		

		</ol>		
	</li>
	<li class="nom1 babo">
		<span class="F"><img src="/images/menu02.gif" alt="mobile" title="mobile"/></span>
		<span class="B"><a href="/shop/list.php?ca_id=20" class="topFont"><img src="/images/menu02_h.gif" alt="mobile" title="mobile"/></a></span>
		<ol class="smenu02 smenu_font">
		<?
		if(strlen($_GET[ca_id])  == 0){
			$ca_id = "01";
			$_GET[ca_id] = "01";
		}
		$wr_ca_id = 20;
		
		$sql = " select ca_id, ca_name from $g4[yc4_category_table]
						 where ca_id like '$wr_ca_id%'
						 and ca_use = '1'
						 and length(ca_id) = 4 order by ca_id ";
		$result = sql_query($sql);
		?>
		<?while ($row=sql_fetch_array($result)) {?>
		<li><span class="F"><a href="<?=$g4[shop_path]?>/list.php?ca_id=<?=$row[ca_id]?>"><?=$row[ca_name]?></a></span><span class="B"><a href="<?=$g4[shop_path]?>/list.php?ca_id=<?=$row[ca_id]?>"><?=$row[ca_name]?></a></span></li>
		<? } ?>
		</ol>
	</li>
	<li class="nom1 babo">
		<span class="F"><img src="/images/menu03.gif" alt="let's Original" title="let's Original"/></span>
		<span class="B"><a href="/shop/list.php?ca_id=30" class="topFont"><img src="/images/menu03_h.gif" alt="let's Original" title="let's Original"/></a></span>
		<ol class="smenu03 smenu_font">
		<?
		if(strlen($_GET[ca_id])  == 0){
			$ca_id = "01";
			$_GET[ca_id] = "01";
		}
		$wr_ca_id = 30;
		
		$sql = " select ca_id, ca_name from $g4[yc4_category_table]
						 where ca_id like '$wr_ca_id%'
						 and ca_use = '1'
						 and length(ca_id) = 4 order by ca_id ";
		$result = sql_query($sql);
		?>
		<?while ($row=sql_fetch_array($result)) {?>
		<li><span class="F"><a href="<?=$g4[shop_path]?>/list.php?ca_id=<?=$row[ca_id]?>"><?=$row[ca_name]?></a></span><span class="B"><a href="<?=$g4[shop_path]?>/list.php?ca_id=<?=$row[ca_id]?>"><?=$row[ca_name]?></a></span></li>
		<? } ?>
		</ol>
	</li>
	<li class="nom1 babo">
		<span class="F"><img src="/images/menu04.gif" alt="others" title="others"/></span>
		<span class="B"><a href="/shop/list.php?ca_id=40" class="topFont"><img src="/images/menu04_h.gif" alt="others" title="others"/></a></span>
		<ol class="smenu04 smenu_font">
		<?
		if(strlen($_GET[ca_id])  == 0){
			$ca_id = "01";
			$_GET[ca_id] = "01";
		}
		$wr_ca_id = 40;
		
		$sql = " select ca_id, ca_name from $g4[yc4_category_table]
						 where ca_id like '$wr_ca_id%'
						 and ca_use = '1'
						 and length(ca_id) = 4 order by ca_id ";
		$result = sql_query($sql);
		?>
		<?while ($row=sql_fetch_array($result)) {?>
		<li><span class="F"><a href="<?=$g4[shop_path]?>/list.php?ca_id=<?=$row[ca_id]?>"><?=$row[ca_name]?></a></span><span class="B"><a href="<?=$g4[shop_path]?>/list.php?ca_id=<?=$row[ca_id]?>"><?=$row[ca_name]?></a></span></li>
		<? } ?>
		</ol>
	</li>
	</ul>
<div class="subBg"></div>
</div>

<!--[navi start]-->
<script type="text/javascript">
/*zx
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
		if(!document.getElementById('div_top_navi')){
			return;
		}
		//alert ( jQuery.browser.version ) ;
		document.getElementById('div_top_navi').style.display = 'block';
		
		var len = jQuery('ul').children() ;
		var chkW ;
		$('ul > li > ol').css({'opacity':'0'}).hide() ;
		for ( var i = 0 ; i < len.length ; i++ ) {
			chkW = jQuery(len[i]).children('.F').width() > jQuery(len[i]).children('.B').width() ? jQuery(len[i]).children('.F').width() : jQuery(len[i]).children('.B').width() ;
			jQuery(len[i]).children('.F').css('width' , chkW) ;
			jQuery(len[i]).children('.B').css('width' , chkW) ;
		}

		jQuery('.navi > li').mouseover(function(){
			if ( jQuery.browser.version == "6.0" || jQuery.browser.version == "7.0" ) {
				$(this).find('ol').css({'margin-top' : '35px' })
			} else {
				$(this).find('ol').css({'margin-top' : '-1px' })
			}
			$(this).find('ol').css({
				'display' : 'block'
			}).stop().animate({ opacity:'1', height:'500px' }, 500 ) ;
			var pos = $(this).find('ol').position() ;
			var mWidth = $('.navi').width() + 220 ;
			if(pos){
				var sWidth = pos.left + $(this).find('ol').width() ;
			}
			
			var minusWidth = sWidth - mWidth ;
			if ( sWidth > mWidth ) {
				$(this).find('ol').css( 'margin-left' , '-' + minusWidth + "px" ) ;
			}
		}) ; 
		jQuery('.navi > li').mouseout(function(){
			$(this).find('ol').stop().animate({ opacity:'0.5', height:'0px' }) ;
		}) ;
	}) ;
</script>
<!--[navi end]-->