<?include_once("./_common.php");
include_once("$g4[path]/head.sub.php");
if($sum1 & $sum2 & $mode){
	$result = calc($sum1 , $sum2 , $mode);
	echo "결과값 : ".$result ."=". $_POST[sum1].$mode.$_POST[sum2];
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtmlll/DTD/xhtmlll.dtd">
<HTML xmlns="http://www.w3.org/1999/xttml" xml:lang="ko">
<HTML>
<HEAD>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<TITLE>계산</TITLE>
</HEAD>
<BODY>
<FORM METHOD="POST" ACTION="">
<INPUT TYPE= "text" NAME="sum1" value="<?=$sum1?>">
<select name ="mode">
	<option value='+'>+</option>
	<option value='-'>-</option>
	<option value='*'>*</option>
	<option value='/'>/</option>
	</select>
	<input type="text" name="sum2" value="<?=$sum2?>">
	<input type="submit" value="계산">


</form>

<?
	
	function calc($sum1,$sum2,$mode){
		if($mode == "+")$result= $sum1 + $sum2;
		elseif($mode == "-")$result= $sum1 - $sum2;
		elseif($mode == "*")$result= $sum1 * $sum2;
		elseif($mode == "/")$result= $sum1 / $sum2;

		return $result;
	}

	?>
	</body>
	</html>

<?
include_once("$g4[path]/tail.sub.php");
?>	