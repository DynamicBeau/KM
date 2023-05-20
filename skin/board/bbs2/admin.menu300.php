<?
$menu["menu300"] = array (
    array("300000", "게시판관리", ""),
    
		array("300100", "인등상담", "$g4[admin_path]/board.php?bo_table=consult"),
		array("300100", "인생유료상담", "$g4[admin_path]/board.php?bo_table=consult2"),
		array("300100", "무료토정비결", "$g4[admin_path]/board.php?bo_table=consult3"),
		array("300100", "온라인결제", "$g4[admin_path]/board.php?bo_table=card"),
    array("-"),	
		array("300100", "게시판관리", "$g4[admin_path]/board_list.php"),
    array("300200", "게시판그룹관리", "$g4[admin_path]/boardgroup_list.php"),
    array("-"),
    array("300300", "인기검색어관리", "$g4[admin_path]/popular_list.php"),
    array("300400", "인기검색어순위", "$g4[admin_path]/popular_rank.php"),
    array("-"),
    array("300400", "팝업관리", "$g4[admin_path]/popup.php")
);
//, array("300500", "로고등록", "$g4[admin_path]/board.php?bo_table=logo")
?>