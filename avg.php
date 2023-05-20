<?include_once("./_common.php");
include_once("$g4[path]/head.sub.php");
?>

<?

	$score[0]=80;
	$score[1]=48;
	$score[2]=28;
	$score[3]=81;
	$score[4]=98;

	$sum=0;
	for($a=0;$a<=4;$a++){
		$sum=$sum+$score[$a];
	}

	$avg=$sum/5;

	echo("과목점수 $score[0],$score[1],$score[2],$score[3],$score[4]<br>");
	echo("합계 $sum, 평균$avg<br>");

?>

<?

	$score[0]=11;
	$score[1]=88;
	$score[2]=34;
	$score[3]=99;
	$score[4]=62;
	$score[5]=89;
	$score[6]=23;

	$sum=0;
	for($t=0;$t<=6;$t++){
		$sum=$sum+$score[$t];
	}

	$avg=$sum/7;

	echo("수학 $score[0]점,과학 $score[1]점,국어 $score[2],생물 $score[3],국사 $score[4],가정 $score[5],도덕 $score[6]점<br>");
	echo("합계 $sum 점, 평균 $avg 점<br>");

?>


<?
	$score=array(77,88,99,11,44);

	$sum=0;
	for($w=0; $w<=4; $w++){
		$sum=$sum+$score[$w];
	}

	$avg=$sum/5;

	echo("과목점수 경제$score[0]점,일본어 $score[1]점,중국어 $score[2]점,영어 $score[3]점,불어 $score[4]점<br> ");
	echo("합계 $sum 점, 평균 $avg 점<br>");


?>

<?

	for($i=0; $i<10; $i++)
		$e[$i]=$i+1;

	for($i=0; $i<10; $i++)
		$b[$i]=$i+101;

	for($i=0; $i<10; $i++)
		$c[$i]=$e[$i]+$b[$i];

	for($i=0;$i<10; $i++)
		echo "$e[$i]+$b[$i]=$c[$i]<br>";


?>

<?
/*
	$s[0][0]=20;
	$s[0][1]=22;
	$s[0][2]=56;
	$s[0][3]=51;
	$s[0][4]=12;

	$s[1][0]=19;
	$s[1][1]=39;
	$s[1][2]=92;
	$s[1][3]=93;
	$s[1][4]=86;

	$s[2][0]=99;
	$s[2][1]=92;
	$s[2][2]=91;
	$s[2][3]=71;
	$s[2][4]=23;
*/

	$s=array(array(21, 20,87,97,99), array(72,64,12,88,56), array(28,78,34,21,88));
	for($r=0; $r<3; $r++){
		$sum=0;

		for($y=0; $y<5; $y++){
			$sum=$sum+$s[$r][$y];
		}

	$avg=$sum/5;
	$student_num=$r+1;
	echo("$student_num 번쨰의 학생 성적 => 합계: $sum, 평균:$avg<br>");

	}


?>





<?
include_once("$g4[path]/tail.sub.php");
?>	
