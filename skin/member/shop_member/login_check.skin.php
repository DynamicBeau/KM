<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 


// 아이디 저장
if ($id_save) {
    set_cookie('se_mb_id', $mb[mb_id], 86400 * 31 * 12);
}else {
    set_cookie('se_mb_id', '', 0);
}
?>
