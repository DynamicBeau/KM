<?include_once("./_common.php");
include_once("$g4[path]/head.sub.php");
?>

<table border="1">
<tr>

<?

for($j=2;$j<=9;$j++){

	$col="$j*2";
	$col=preg_replace("/($j*2)/i", "<font color=red>$1</font>", $col);
	echo $col;
	echo "<td>";
	echo "구구단",$j,"단<br/>";
	echo "========<br/>";
	

	for($i=1;$i<=9;$i++){
		
		echo $j." x ". $i." = ".($j*$i). "<br>";
	}
	if($j==5){
		echo "</tr><tr>";
	}
	if($j==$j*2){
		
	}
}

?>

</tr>
</font>
</table>


<?

	function plus($a, $b){
		$c=$a+$b;
		echo $c;
	}

	plus(22, 50);
	echo "<br>";
	plus(798441, 6858777);
	echo"<br>";
	plus(2,4);

?>

<?
	function pluss($z,$x){
		$v=$z+$x;

		return $v;
	}

	$result=pluss(2,5);
	echo $result."<br>";
	$result=pluss(18,42);
	echo $result."<br>";

?>


<?
	function hap($a, $b)
	{
		$sum=0;
		while($a<=$b){
			$sum=$sum+$a;
			$a++;
		}
		return $sum;
	}
	$from=1;
	$to=55;

	$total=hap($from, $to);
	echo ("$from 에서 $to 까지의 합은 $total 입니다<br>");
	

?>

<HTML>



<?

	$operand1 = $_REQUEST['operand1'];
	$operator = $_REQUEST['operator'];
	$operand2 = $_REQUEST['operand2'];

	function add($a, $b){
		$c=($a+$b);
		return $c;
	}

	function minus($a,$b){
		$c=($a-$b);
			return $c;
	}
	
	function multiply($a,$b){
		$c=($a*$b);
		return $c;
	}
	
	function divide($a,$b){
		if($b==0){
		return 0;
		}else{
		$c=($a/$b);
		return $c;
		}
	}

	function error(){
		echo "[ERROR~] 첫번째 피연산자는 필수 입력입니다.";
	}

	function diverror(){
		echo "[ERROR!~] 0으로 나눌수 없습니다.";
	}

	if($operator=="+"){
		$result = add($operand1,$operand2);
	}

	elseif($operator=="-"){
		$result = minus($operand1,$operand2);
	}
	
	elseif($operator=="*"){
		$result = multiply($operand1,$operand2);
	}

	elseif($operatir=="/"){
		$result = divide($operand1,$operamd2);
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtmlll/DTD/xhtmlll.dtd">
<HTML xmlns="http://www.w3.org/1999/xttml" xml:lang="ko">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>계산결과</title>
</head>
<body>
<h1>계산결과</h1>
<h2>
<? if($operand1==null){
	error();
}elseif($operator=="/" && $operand2==0){
	diverror();
}else{
	if($operand2 == null){
		$operand2 = 0;
	}
	echo $operand1; echo $operator; echo $operand2; echo "="; echo $result;
}
?>

</h2>
<a href="calculator.html"> 계산기로 돌아가기</a>
</body>
</html>

<?
include_once("$g4[path]/tail.sub.php");
?>	