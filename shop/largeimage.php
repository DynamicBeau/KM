<?
include_once("./_common.php");

$sql = " select it_name from $g4[yc4_item_table] where it_id='$it_id' ";
$row = sql_fetch_array(sql_query($sql));

$g4[title] = "$row[it_name] ($it_id)";
include_once("$g4[path]/head.sub.php");
if(!$t) $t = 1;
$imagefile = "$g4[path]/data/item/{$it_id}_l$t";
if(!file_exists($imagefile)) alert_close("이미지를 찾을 수 없습니다.");
$size = getimagesize($imagefile);

?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script> 
<style type="text/css">
h1{text-align:center;font-weight:bold; line-height:15px; padding:6px 0; font-size:14px; word-break:break-all;}
/*.image_view{position:relative; border:1px solid #DDD;  margin:0px auto; width:560px; overflow:hidden;   height:460px;text-align:center; }*/
.image_view{position:relative; border:1px solid #DDD;  margin:0px auto;   text-align:center; }
 .thum_img{text-align:center;}
.thum_img img{margin:6px; border:1px solid #DDD;cursor: pointer}
</style>
<h1><?=$g4[title]?></h1>

<!-- <div class="image_view"><span id="imgbox"><img src='<?=$imagefile?>'  alt='<?=$row[it_name]?>' border=0></span></div> -->
<div class="image_view"><span id="imgbox"><img src='<?=$imagefile?>'  alt='<?=$row[it_name]?>' border=0></span></div>
<div class='thum_img'>
	 <?
        for ($i=1; $i<=5; $i++)
        {
            if (file_exists("$g4[path]/data/item/{$it_id}_l{$i}")){
                echo "<img id='large{$i}' src='$g4[path]/data/item/{$it_id}_l{$i}' border=0 width=50 height=50>";
			}
        }
        ?>
</div>
<script type="text/javascript"> 
  
$(document).ready(function() {
	/*
	ste_image();
	$("#imgbox").draggable({ cursor: 'move',scroll: false }); 
	$(".thum_img img").click(function(){
		$("#imgbox img").attr("src",this.src);
		$(this).nextAll("img").css("border","1px solid #DDD");
		$(this).prevAll("img").css("border","1px solid #DDD");
		$(this).css("border","1px solid #F60");
		ste_image();
	});*/

 
	// 이미지 더블클릭시 팝업창 닫아버린다
	$("#imgbox").dblclick(function(e){
		window.close();
	});

}); 
//이미지 위치지정
function ste_image(){
	var imgObj = new Image();
		imgObj.src = $("#imgbox img").attr("src");

		$(imgObj).load(function () {
		

		$("#imgbox").css("top",(460-imgObj.height)/2+"px");
		$("#imgbox").css("left",(560-imgObj.width)/2+"px");
		if(imgObj.height > 460)
		$("#imgbox").css("top","0px");


		}).error(function () {
		alert("파일을 찾을 수 없습니다.");
		});


}



</script>
<?
include_once("$g4[path]/tail.sub.php");
?>
