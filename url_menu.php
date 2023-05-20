<?
$menu = array(
	 array("회사소개", $path.'/subpage.php?p=m11', "",
		array(
			array('인사말', $path.'/subpage.php?p=m11', ''),
			array('찾아오시는길', $path.'/subpage.php?p=m12', '')
		)
	 ),
	 array("제품소개", $path."/shop/list.php?ca_id=10", "",
		array(
			array('장애인편의시설물', $path.'/shop/list.php?ca_id=4010', ''),
			array('LED차량유도등', $path.'/shop/list.php?ca_id=4020', ''),
			array('LED전광판', $path.'/shop/list.php?ca_id=4030', ''),
			array('주차도로안전시설물', $path.'/shop/list.php?ca_id=4040', ''),
			array('공동주택시설물', $path.'/shop/list.php?ca_id=4050', ''),
			array('준공사인물', $path.'/shop/list.php?ca_id=4060', '')
		)
	 ),
		array("견적문의", $path."/shop/list.php?ca_id=c0", "",
		array(
			array('견적문의', $path.'/shop/list.php?ca_id=c0', '')
		)
	 ),
		array("시공사례", $path."/bbs/board.php?bo_table=m41", "",
		array(
			array('갤러리', $path.'/bbs/board.php?bo_table=m41', '')
		)
	 ),
		array("커뮤니티", $path."/bbs/board.php?bo_table=m51", "",
		array(
			array('공지사항', $path.'/bbs/board.php?bo_table=m51', ''),
			array('Q&A', $path.'/bbs/board.php?bo_table=m52', ''),
			array('자유게시판', $path.'/bbs/board.php?bo_table=m53', '')
		)
	 )
);
?>