<? 
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 썸테일 이미지 삭제 
for ($i=count($tmp_array)-1; $i>=0; $i--) 
{ 
    @unlink("$g4[path]/data/file/$bo_table/thumb/$tmp_array[$i]"); //썸네일 삭제 
} 
?> 