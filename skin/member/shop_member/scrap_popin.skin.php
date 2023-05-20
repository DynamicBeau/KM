<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

?>
<form name=f_scrap_popin method=post action="./scrap_popin_update.php">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="wr_id"    value="<?=$wr_id?>">
</form>
<script type="text/javascript">
document.f_scrap_popin.submit();
</script>
