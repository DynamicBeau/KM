<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<table width="218" height="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="10" bgcolor="#f6f6f6">&nbsp;</td>
		<td valign="center" bgcolor="#f6f6f6" height="30">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td colspan="6"><? if ($is_admin) { ?><a href="<?=$g4[admin_path]?>/index.php"><? } ?><strong><?=$nick?></strong></td>
				<td align="right"><a href="<?=$g4[bbs_path]?>/logout.php?url=<?=$urlencode?>" class="small"><font color="#7A7A7A">로그아웃</font></a></strong></td>
			</tr>
		</table>
		</td>
		<td width="10" bgcolor="#f6f6f6">&nbsp;</td>
	</tr>
	<tr><td colspan="3" height="1" bgcolor="#d9d9d9"></td></tr>
	<tr>
		<td width="10"></td>
		<td bgcolor="#FFFFFF" align="center" valign="center">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td style="border:1px solid #EEEEEE;" width="43" height="43" align="center"><img src="<?=$outlogin_skin_path?>/img/man.gif"></td>
				<td width="10"></td>
				<td valign="top">

				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr><td colspan="5" height="3"></td></tr>
					<tr>
						<td class="small"><a href="javascript:win_memo();"><font color="#444444">쪽지 : <strong><?=$memo_not_read?></strong></font></a></td>
						<td width="5"></td>
						<td class="small"><a href="javascript:win_point();"><font color="#444444">포인트 : <strong><?=$point?></strong></font></a></td>
					</tr>
					<tr><td colspan="3" height="10"></td></tr>
					<tr>
						<td colspan="3" class="small" bgcolor="#EFEFEF" style="padding:5px;"><a href="javascript:win_scrap();"><font color="#7A7A7A">스크랩</font></a><span>&nbsp;&nbsp;<font color="#CCCCCC">|</font>&nbsp;&nbsp;</span><a href="<?=$g4[bbs_path]?>/member_confirm.php?url=register_form.php"><font color="#7A7A7A">회원정보수정</font></a></td>
					</tr>
				</table>
				
				</td>
			</tr>
		</table>
		</td>
		<td width="10"></td>
	</tr>
</table>