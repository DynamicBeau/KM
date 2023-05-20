<? 
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 썸테일 이미지 삭제 
@unlink("$g4[path]/data/file/$bo_table/thumb/$write[wr_id]"); //썸네일 삭제 
?> 