<?
$show_update_begin = "";
$show_update_end = "";
$show_delete_begin = "";
$show_delete_end = "";
$show_reply_begin = "";
$show_reply_end = "";

if (($member[mb_id] && ($member[mb_id] == $list[$i][mb_id])) || is_admin($member[mb_id])) {
    $a_update = "<a href='./write.php?w=u&bo_table=$bo_table&wr_id={$lists[$ii][wr_id]}'>";
	set_session("ss_delete_token", $token = uniqid(time()));
    $a_delete = "<a href=\"javascript:del('./delete.php?bo_table=$bo_table&wr_id={$lists[$ii][wr_id]}&token=$token&page=$page".urldecode($qstr)."');\">";
} else if (!$data[mb_id]) { // 회원이 쓴 글이 아니라면
	if($lists[$ii][comment_cnt]) {
	    $show_update_begin = "<!--";
	    $show_update_end = "-->";
	    $show_delete_begin = "<!--";
	    $show_delete_end = "-->";
	    $a_update = "<a href='./write.php?w=u&bo_table=$bo_table&wr_id={$lists[$ii][wr_id]}'>";
	    $a_delete = "<a href='./password.php?w=d&bo_table=$bo_table&wr_id={$lists[$ii][wr_id]}'>";
    } else {
	    $a_update = "<a href='./password.php?w=u&bo_table=$bo_table&wr_id={$lists[$ii][wr_id]}'>";
	    $a_delete = "<a href='./password.php?w=d&bo_table=$bo_table&wr_id={$lists[$ii][wr_id]}'>";
    }
} else {
    $show_update_begin = "<!--";
    $show_update_end = "-->";
    $show_delete_begin = "<!--";
    $show_delete_end = "-->";
}

if ($write[wr_notice] == 0 && ($member[mb_level] >= $board[bo_reply_level])) {
    $a_reply = "<a href='./write.php?w=r&&bo_table=$bo_table&wr_id={$lists[$ii][wr_id]}'>";

} else {
    $show_reply_begin = "<!--";
    $show_reply_end = "-->";
}

?>
