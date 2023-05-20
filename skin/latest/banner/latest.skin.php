<?
include_once("$g4[path]/lib/thumb.lib.php");
$width_total = 500;
$img_width = 200;
$img_height = 51;
?>
<style type="text/css">
.jCarouselLite_box{position:relative; height:<?=$img_height?>px; border:0px solid red;}
.jCarouselLite_box button{position:absolute;  border:0; width:29px; height:<?=$img_height?>px; top:0; cursor:pointer; z-index:999;}


.jCarouselLite{margin:0 auto; }
.jCarouselLite ul li{margin-right:5px; display:inline; width:<?=$img_width?>px;}
.jCarouselLite ul li p.item_name{padding:0px; line-height:24px;height:24px; overflow:hidden;}
.jCarouselLite ul li p.amount{line-height:20px; padding-left:5px;}

</style>

<div class="jCarouselLite_box" >
<table >
  <tr>
    <td>
		<table align="center" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
				<script type="text/javascript">
				var sliderwidth="<?=$width_total?>px"  //스크롤 가로 사이즈
				var sliderheight="<?=$img_height?>px"  //스크롤 세로 사이즈
				var slidespeed="1"
					slidebgcolor="#ffffff"  //스크롤 배경 색상

				var leftarrowimage = "<?=$latest_skin_path?>/img/scroll_left.gif"
				var rightarrowimage = "<?=$latest_skin_path?>/img/scroll_right.gif"

				var leftrightslide=new Array()
				var finalslide='';
						<?  for ($i=0; $i<count($list); $i++) {

							//썸네일 생성
						$thumfile = "";
						$thumb = $thumb_path.'/'.$list[$i][wr_id];

						//$file = "$g4[path]/data/file/$bo_table/".urlencode($list[$i][file][0][file]);
						$file = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
						//$noimg = "$latest_skin_path/img/noimg.gif";

						// 업로드된 파일이 이미지라면
						//if (preg_match("/\.(gif|jp[e]?g|png|bmp)$/i", $file) && file_exists($file)) {

						if (preg_match("/\.(jpg|gif|png|bmp)$/i", $file) && file_exists($file)) {
							//$img=thumbnail($data_path. "/".$image, $imgwidth, $imgheight, 0, 1);  //썸네일이 없을경우 원본출력
							$thumb = thumbnail($file, $img_width, $img_height, 0, $is_crop, 90, 0, "",  $filter, $noimg); //언샾마스크추가



						} else { //에디터에서 삽입한 이미지
							$edit_img = $list[$i]['wr_content'];
							if (eregi("data/cheditor4[^<>]*\.(gif|jp[e]?g|png|bmp)", $edit_img, $tmp)) { // data/cheditor------
							$file = $g4[path].'/' . $tmp[0]; // 파일명
							$thumb=thumbnail($file, $img_width, $img_height, 0, $is_crop, 90, 0, "",  $filter, $noimg); //언샾마스크추가

							}
						}

						if(strlen($list[$i][wr_link1]) > 0){
							$href = "<a href='".set_http($list[$i][wr_link1])."' target='_blank' class=item>";
						}else{
							$href = "<a href='#null' class=item>";
						}
						
						?>
							leftrightslide[<?=$i?>]="<?=$href?><img src='<?=$thumb?>'>&nbsp;</a>";
						<?}?>
				var imagegap=""
				var slideshowgap=0

				var copyspeed=slidespeed
					leftrightslide='<nobr>'+leftrightslide.join(imagegap)+'</nobr>'
				var iedom=document.all||document.getElementById
					if (iedom)
						document.write('<span id="temp" style="visibility:hidden;position:absolute;top:-100px;left:-9000px">'+leftrightslide+'</span>')

				var actualwidth=''
				var cross_slide, ns_slide
				var righttime,lefttime

				function fillup(){
					if (iedom){
						cross_slide=document.getElementById? document.getElementById("test2") : document.all.test2
						cross_slide2=document.getElementById? document.getElementById("test3") : document.all.test3
						cross_slide.innerHTML=cross_slide2.innerHTML=leftrightslide
						actualwidth=document.all? cross_slide.offsetWidth : document.getElementById("temp").offsetWidth
						cross_slide2.style.left=actualwidth+slideshowgap+"px"
					}
					else if (document.layers){
						ns_slide=document.ns_slidemenu.document.ns_slidemenuorange
						ns_slide2=document.ns_slidemenu.document.ns_slidemenu3
						ns_slide.document.write(leftrightslide)
						ns_slide.document.close()
						actualwidth=ns_slide.document.width
						ns_slide2.left=actualwidth+slideshowgap
						ns_slide2.document.write(leftrightslide)
						ns_slide2.document.close()
					}
					lefttime=setInterval("slideleft()",30)
				}
				window.onload=fillup

				function slideleft(){
					if (iedom){
					if (parseInt(cross_slide.style.left)>(actualwidth*(-1)+8))
						cross_slide.style.left=parseInt(cross_slide.style.left)-copyspeed+"px"
					else
						cross_slide.style.left=parseInt(cross_slide2.style.left)+actualwidth+slideshowgap+"px"
					if (parseInt(cross_slide2.style.left)>(actualwidth*(-1)+8))
						cross_slide2.style.left=parseInt(cross_slide2.style.left)-copyspeed+"px"
					else
						cross_slide2.style.left=parseInt(cross_slide.style.left)+actualwidth+slideshowgap+"px"
					}
					else if (document.layers){
					if (ns_slide.left>(actualwidth*(-1)+8))
						ns_slide.left-=copyspeed
					else
						ns_slide.left=ns_slide2.left+actualwidth+slideshowgap
					if (ns_slide2.left>(actualwidth*(-1)+8))
						ns_slide2.left-=copyspeed
					else
						ns_slide2.left=ns_slide.left+actualwidth+slideshowgap
					}
				}

				function slideright(){
					if (iedom){
					if (parseInt(cross_slide.style.left)<(actualwidth+8))
						cross_slide.style.left=parseInt(cross_slide.style.left)+copyspeed+"px"
					else
						cross_slide.style.left=parseInt(cross_slide2.style.left)+actualwidth*(-1)+slideshowgap+"px"
					if (parseInt(cross_slide2.style.left)<(actualwidth+8))
						cross_slide2.style.left=parseInt(cross_slide2.style.left)+copyspeed+"px"
					else
						cross_slide2.style.left=parseInt(cross_slide.style.left)+actualwidth*(-1)+slideshowgap+"px"
					}
					else if (document.layers){
					if (ns_slide.left>(actualwidth*(-1)+8))
						ns_slide.left-=copyspeed
					else
						ns_slide.left=ns_slide2.left+actualwidth+slideshowgap
					if (ns_slide2.left>(actualwidth*(-1)+8))
						ns_slide2.left-=copyspeed
					else
						ns_slide2.left=ns_slide.left+actualwidth+slideshowgap
					}
				}

				function right(){
					if(lefttime){
						clearInterval(lefttime)
						clearInterval(righttime)
						righttime=setInterval("slideright()",30)
					}
				}

				function left(){
					if(righttime){
						clearInterval(lefttime)
						clearInterval(righttime)
						lefttime=setInterval("slideleft()",30)
					}
				}
					document.write('<table width='+sliderwidth+' border="0" cellspacing="0" cellpadding="0">');
					document.write('<tr><td align=center valign=middle width=20><img src='+leftarrowimage+' onMouseover="left(); copyspeed=2" onMouseout="copyspeed=1" style="cursor:hand"></td>')


					if (iedom||document.layers){
						with (document){
							document.write('<td>')
					if (iedom){
						write('<div style="position:relative;width:'+sliderwidth+';height:'+sliderheight+';overflow:hidden">')
						write('<div style="position:absolute;width:'+sliderwidth+';height:'+sliderheight+';background-color:'+slidebgcolor+'" onMouseover="copyspeed=0" onMouseout="copyspeed=1">')
						write('<div id="test2" style="position:absolute;left:0px;top:0px"></div>')
						write('<div id="test3" style="position:absolute;left:-900px;top:0px"></div>')
						write('</div></div>')
					}
					else if (document.layers){
						write('<ilayer width='+sliderwidth+' height='+sliderheight+' name="ns_slidemenu" bgColor='+slidebgcolor+'>')
						write('<layer name="ns_slidemenuorange" left=0 top=0 onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed"></layer>')
						write('<layer name="ns_slidemenu3" left=0 top=0 onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed"></layer>')
						write('</ilayer>')
					}
					document.write('</td>')
					}
				}

				document.write('<td width="20" align=center valign=middle><img src='+rightarrowimage+' onMouseover="right();copyspeed=2" onMouseout="copyspeed=1" style="cursor:hand"></td></tr></table>')

				</script>
				</td>
			</tr>
		</table>
    </td>
  </tr>
</table>
</div>
