<script>
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

startList = function() {
if (document.all&&document.getElementById) {
navRoot = document.getElementById("munu_list");
for (i=0; i<navRoot.childNodes.length; i++) {
node = navRoot.childNodes[i];
if (node.nodeName=="SPAN") {
node.onmouseover=function() {this.className+=" over";}
node.onmouseout=function() {this.className=this.className.replace(" over", "");}
}
}
}
}
window.onload=startList;
</script>
<style>
#munu_list {
	position:relative;
	float:left;	
	color:#666666;
	z-index:9999
}
.munuList_none {
	z-index:9999;
	display:none;
}
.menutop {
	float:left;
	width:226px;
	height:35px;
	background:url(<?=$g4[path]?>/img/menu_bj.png);_background:none; _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="<?=$g4[path]?>/img/menu_bj.png" ,sizingMethod="crop")
}
.menumid {
	float:left;
	width:226px;
}
.menumid .menupopover {
	float:left;
	width:226px;
	background:#1a589e;
	opacity: 0.90;-moz-opacity: 0.90;filter:alpha(opacity=90);
	
}
.menumid .menupopover a{
  color:#ffffff;
	width:226px;
	display:block;
	font-size:14px;
	font-family:'맑은 고딕';
	font-weight:bold;
	padding-top:4px;
	padding-bottom:4px;
	text-decoration:none;
}
.menumid .menupopover a:hover{
	color:#ffffff;
	padding-top:4px;
	padding-bottom:4px;
	background:#e51937;
}
.menumid .menupopover div{
    padding-left:14px;
}
.menubot {
	float:left;
	width:226px;
	height:16px;
	background:url(../img/menu_bj2.png);_background:none; _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="<?=$g4[path]?>/img/menu_bj2.png" ,sizingMethod="crop")
}

span:hover div, span.over div { display: inline; }
</style>
<!-- 메뉴 정보 가져오기 -->
<?include_once("$g4[path]/url_menu.php")?>

<?
for($i=0;$i<count($menu);$i++){
	$menu[$i][0] = iconv ( "CP949" , "utf-8", $menu[$i][0]);
	$menu[$i][1] = iconv ( "CP949" , "utf-8", $menu[$i][1]);
	$menu[$i][2] = iconv ( "CP949" , "utf-8", $menu[$i][2]);
	for($j=0;$j<count($menu[$i][3]);$j++){
		$menu[$i][3][$j][0] = iconv ( "CP949" , "utf-8", $menu[$i][3][$j][0]);
		$menu[$i][3][$j][1] = iconv ( "CP949" , "utf-8", $menu[$i][3][$j][1]);
		$menu[$i][3][$j][2] = iconv ( "CP949" , "utf-8", $menu[$i][3][$j][2]);
	}
}
?>
<!-- 메뉴 정보 가져오기 -->
<div id="munu_list"> 
<?for($i=0;$i<count($menu);$i++){?>
<span id="munu_list" style="position:relative; float:left;">
	<a href="<?=$menu[$i][1]?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('top_munu_0<?=($i+1)?>','','<?=$g4[path]?>/img/menu_img_0<?=($i+1)?>over.jpg',1)"><img src="<?=$g4[path]?>/img/menu_img_0<?=($i+1)?>.jpg" name="top_munu_0<?=($i+1)?>" border="0" id="top_munu_0<?=($i+1)?>"></a>
	<div class="munuList_none" id="<?=($i+1)?>" style="left:0px;top:41px;position:absolute;width:206px;">
	<span class="menutop"></span>
	<span class="menumid">
	<?for($j=0;$j<count($menu[$i][3]);$j++){?>
		<span class="menupopover"><a href="<?=$menu[$i][3][$j][1]?>"><div><?=$menu[$i][3][$j][0]?></div></a></span>
	<? } ?>
	</span>
	<span class="menubot"></span>
	</div>
</span>
<? } ?>
</div>