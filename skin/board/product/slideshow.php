<? 
$g4_path = "../../..";
include_once("$g4_path/common.php");

        // 파일 출력 
$sql = "select * from $g4[board_file_table] where `bo_table`='$bo_table' and `wr_id`='$wr_id'"; 
$result=mysql_query($sql); 
for($i=0 ; $row = mysql_fetch_array($result) ; $i++){ 
$img[$i]="$g4[path]/data/file/$bo_table/$row[bf_file]"; 
} 
?>
<script language="JavaScript">
<!--
function transimg(place) {
if (place==1) dare.src="<?=$img[0]?>";
if (place==2) dare.src="<?=$img[1]?>";
if (place==3) dare.src="<?=$img[2]?>";
}
// -->
</script>
&nbsp;&nbsp;<b>[이미지 상세보기]</b>
<table cellpadding="0" cellspacing="0" width="851" height="498">
	<tr>
		<td width="650" valign="top">
			<table cellpadding="0" cellspacing="0" width="650" height="498">
				<tr>
					<td width="10" height="10"></td>
					<td width="640" height="10"></td>
				</tr>
				<tr>
					<td width="10"><p>&nbsp;</p></td>
					<td width="640">
						<img src="<?=$img[0]?>" width="640" height="480" style='border:1 solid #cccccc;' name=dare>
					</td>
				</tr>
			</table>
		</td>
		<td width="1"></td>
		<td width="200" height=498 valign=top>
			<table cellpadding="0" cellspacing="0" width="200">
				<tr>
					<td width="10" height="10"></td>
					<td width="191" height="10"></td>
				</tr>
				<tr>
					<td width="10" height="498"><p>&nbsp;</p></td>
					<td width="191" height="498" valign=top>
						<table cellpadding="0" cellspacing="0" width="190">
							<tr>
								<td height="3"></td>
							</tr>
							<tr>
								<td width="190" height="150">
								<?if($img[0]!=''){?>
								<span style="cursor:hand" onMouseOver="transimg(1)"><img src="<?=$img[0]?>" width="190" height="150" style='border:1 solid #cccccc;'></span>
								<?}else{?>
								<img src="<?=$board_skin_path?>/img/noimg.jpg" width="190" height="150" style='border:1 solid #cccccc;'>
								<?}?>
								</td>
							</tr>
							<tr>
								<td width="190" height="12"></td>
							</tr>
							<tr>
								<td width="190" height="150">
								<?if($img[1]!=''){?>
								<span style="cursor:hand" onMouseOver="transimg(2)"><img src="<?=$img[1]?>" width="190" height="150" style='border:1 solid #cccccc;'></span>
								<?}else{?>
								<img src="<?=$board_skin_path?>/img/noimg.jpg" width="190" height="150" style='border:1 solid #cccccc;'>
								<?}?>
								</td>
							</tr>
							<tr>
								<td width="190" height="12"></td>
							</tr>
							<tr>
								<td width="190" height="150">
								<?if($img[2]!=''){?>
								<span style="cursor:hand" onMouseOver="transimg(3)"><img src="<?=$img[2]?>" width="190" height="150" style='border:1 solid #cccccc;'></span>
								<?}else{?>
								<img src="<?=$board_skin_path?>/img/noimg.jpg" width="190" height="150" style='border:1 solid #cccccc;'>
								<?}?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table width="850" cellpadding="0" cellspacing="0">
    <tr>
        <td width="850" valign="middle" align="center" height="30"><a href="javascript:window.close()" onfocus=blur()><img src="<?=$board_skin_path?>/img/close.jpg" border="0"></a></td>
    </tr>
</table>