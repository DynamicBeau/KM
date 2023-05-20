<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$sql = " select * from $g4[yc4_new_win_table] 
          where '$g4[time_ymdhis]' between nw_begin_time and nw_end_time
          order by nw_id asc ";
$result = sql_query($sql);

?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

<style type="text/css">
.pop_win{position:absolute; background:#F6F6F6;zoom:1; z-index:999999;word-break:break-all; overflow:hidden;}
.pop_content{word-break:break-all; overflow:hidden;}
.pop_close{height:20px; background:#555; padding-right:10px; font:8pt/20px Dotum; color:#FFF; text-align:right;}
</style>

<?
for ($i=0; $row_nw=sql_fetch_array($result); $i++) 
{

    // 이미 체크 되었다면 Continue
    if ($_COOKIE["ck_notice_{$row_nw[nw_id]}"]) 
        continue;
		$style = "";
		$style .= "width:".$row_nw[nw_width]."px; ";
		$style .= "height:".($row_nw[nw_height]+20)."px; ";
		$style .= "top:".$row_nw[nw_top]."px; ";
		$style .= "left:".$row_nw[nw_left]."px; ";

		$style_content = "";
		$style_content .= "width:".$row_nw[nw_width]."px; ";
		$style_content .= "height:".$row_nw[nw_height]."px; ";
		$style_content .= "top:".$row_nw[nw_top]."px; ";
		$style_content .= "left:".$row_nw[nw_left]."px; ";
 ?>

<div class='pop_win' style='<?=$style?>' id="pop_win<?=$row_nw[nw_id]?>">
	<div class='pop_content' style='<?=$style_content?>'><?=conv_content($row_nw[nw_content], $row_nw[nw_content_html])?></div>
	<p class='pop_close' ><input type=checkbox id='check_notice_<?=$row_nw[nw_id]?>' name='check_notice_<?=$row_nw[nw_id]?>' value='1' ><font color="<?=$row_nw[nw_font_color] ?>">&nbsp;<label for='check_notice_<?=$row_nw[nw_id]?>'>오늘 하루 이창을 열지 않습니다.</label>
	<span  style="cursor:pointer;font-weight:bold;" onclick="div_close(<?=$row_nw[nw_id] ?>,<?=$row_nw[nw_disable_hours] ?>)">[ 닫기 ] </span>
	</p>
</div>
 
 <? } ?>


<script language="JavaScript">
function div_close(id,hours){
	var obj = document.getElementById("pop_win"+ id);
	var check = document.getElementById("check_notice_"+ id);

	if (check.checked == true) {
              set_cookie("ck_notice_"+id, "1" , hours);
        }
	obj.style.display = "none";
}

$(".pop_win").draggable({ cursor: 'move',scroll: false }); 
</script>
