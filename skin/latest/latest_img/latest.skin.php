<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<?
	for ($i=0; $i<count($list); $i++) {
		$file = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
		echo $file;
	}
?>



