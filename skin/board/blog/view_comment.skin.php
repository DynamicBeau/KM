<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<script language="JavaScript">
// 글자수 제한
var char_min = parseInt(<?=$comment_min?>); // 최소
var char_max = parseInt(<?=$comment_max?>); // 최대
</script>
<!-- 코멘트 리스트 -->


<table width="100%" cellspacing="0" cellpadding="0" align="right">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>

<!-- 코멘트 리스트 -->
<?
for ($i=0; $i<count($list); $i++) {
    $comment_id = $list[$i][wr_id];
?>
<a name="c_<?=$comment_id?>"></a>


<table width="100%" cellpadding=0 cellspacing=0>
<tr><td colspan="2" height="1" style="background: url('<?=$board_skin_path?>/img/ver3_dot.gif') left;"></td></tr>
<tr>
    <td valign="top">
        <table width=100% cellpadding=0 cellspacing=0>
	        <tr><td height="12"></td></tr>
	        <tr><td height="1"><? for ($k=0; $k<strlen($list[$i][wr_comment_reply]); $k++) echo "&nbsp;&nbsp;&nbsp;<img src='$board_skin_path/img/icon_comment_reply.gif' border='0'>"; ?></td></tr>
	    </table>
    </td>
    <td width='100%'>
        <table width=100% cellpadding=0 cellspacing=0>
        <tr><td colspan="2" height="5" width="1022"></td></tr>
                            <tr>
            <td width="8"></td>
                                <td valign="top" style="padding:4px;" width="1087">
                                    <!-- 코멘트 출력 -->
                                    <table width="100%" height="100%" cellpadding=0 cellspacing=0>
                                        <tr>
                                            <td height="24"><b><?=$list[$i][name]?></b></td>
		    		</tr>
                                        <tr>
                                            <td style="line-height:150%; word-break:break-all;"><span class="ct lh"><font color=#999999><?=$list[$i][content]?></font></span>
                                                <? if ($list[$i][trackback]) { echo "<p>".$list[$i][trackback]."</p>"; } ?></td>
		    		</tr>
                                        <tr>
                                            <td height="20" align="right"><font face="돋움" color="#CCCCCC"><span style="font-size:9pt;"><?=$list[$i][datetime]?>&nbsp;&nbsp;<? if ($is_ip_view) { echo "|&nbsp;&nbsp;{$list[$i][ip]}&nbsp;&nbsp;|&nbsp;&nbsp;"; } ?>
<? if ($list[$i][is_del])  { echo "<a href=\"javascript:comment_delete('{$list[$i][del_link]}');\"><img src='$board_skin_path/img/btn_comment_delete.gif' alt='삭제' border=0 align=absmiddle></a> "; } ?>
</span></font>		    			</td>
		    		</tr>
		    	</table>
			</td>
		</tr>
	</table>
	</td>
</tr>
<? if ($i+1 < count($list)) { //마지막 라인 생략?>
<tr>
<tr><td colspan="2" height="1" style="background: url('<?=$board_skin_path?>/img/ver3_dot.gif') left;"></td></tr>
<? } ?>
</table>

<? } ?>
<!-- 코멘트 리스트 -->
		<span id="wri<?=$wr_id?>" style="display:none;">
			<!-- 코멘트 입력테이블시작 -->
			<form name="fviewcomment<?=$wr_id?>" method="post" action="./write_comment_update.php" autocomplete="off" style="margin:0;">
			<input type=hidden name=w           id=w value='c'>
			<input type=hidden name=bo_table    value='<?=$bo_table?>'>
			<input type=hidden name=wr_id       value='<?=$wr_id?>'>
			<input type=hidden name=comment_id  id='comment_id' value=''>
			<input type=hidden name=sfl         value='<?=$sfl?>'>
			<input type=hidden name=stx         value='<?=$stx?>'>
			<input type=hidden name=spt         value='<?=$spt?>'>
			<input type=hidden name=page        value='<?=$page?>'>
			<input type=hidden name=cwin        value='<?=$cwin?>'>
			<input type=hidden name=wr_10       value="<?=$wr_10?>">
			<input type=hidden name=url        value='./board.php?bo_table=<?=$bo_table?>&page=<?=$page?>'>
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr><td height="1" style="background: url('<?=$board_skin_path?>/img/ver3_dot.gif') left;"></td></tr>
			</table>
<? if ($is_comment_write) { ?>
		<table width=100% cellpadding=3 cellspacing=0>
		<tr><td width=60></td>
			<td colspan=2 class="s11 color_pink1">
				<table width="100%" height="18" cellpadding="0" cellspacing="0" border="0">
					<tr>
				    <? if ($is_guest) { ?>
						<td width="80" align="center" class="s11 color_pink1">name</td>
						<td><INPUT type=text maxLength=20 size=15 name="wr_name" itemname="이름" required class=ed style="border-width:1; border-color:rgb(204,204,204); border-style:solid;"></td>
						<td width="80" align="center" class="s11 color_pink1">password</td>
				        <td><INPUT type=password maxLength=20 size=15 name="wr_password" itemname="비밀번호" required class=ed style="border-width:1; border-color:rgb(204,204,204); border-style:solid;"></td>
				            <? if ($is_norobot) { ?>
							<td width="80" align="center" class="s11"><?=$norobot_str?></td>
							<td><INPUT title="왼쪽의 글자중 빨간글자만 순서대로 입력하세요." type="input" name="wr_key" itemname="자동등록방지" required class=ed style="border-width:1; border-color:rgb(204,204,204); border-style:solid;"></td>
				            <? } ?>
				    <? } else { ?>
						<td width="80" align="center">&nbsp;</td>
						<td>&nbsp;</td>
				    <? } ?>
				    </tr>
				</table></td>
			<td width=60></td></tr>
		<tr><td width=60></td>
		    <td width="85%">
		        <textarea id="wr_content" name="wr_content" rows="3" itemname="내용" required 
		            <? if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?}?> style="background-color:white; border-width:1; border-color:rgb(204,204,204); border-style:solid; width:100%; word-break:break-all;" class=tx></textarea>
		            <? if ($comment_min || $comment_max) { ?><script language="javascript"> check_byte('wr_content', 'char_count'); </script><?}?></td>
		    <td width=80 align=center><input type="image" src="<?=$board_skin_path?>/img/ok_btn.gif" border=0 accesskey='s'></td>
		    <td width=60></td></tr>
		<tr><td colspan=4 height=6></td></tr>
		</table>
<? } ?>
			</span>
			</form>
		</td>
	</tr>
</table>

<? if($cwin==1) { ?><p align=center><a href="javascript:window.close();"><img src="<?=$board_skin_path?>/img/close.gif" border="0"></a><? } ?>

<script language='JavaScript'>
function fviewcomment<?=$wr_id?>_submit(f)
{
    return true;
}
</script>
<? 
include_once("$board_skin_path/view_skin_js.php");
?>
