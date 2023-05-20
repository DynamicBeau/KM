<?
include_once("$g4[path]/lib/kaka.lib.php");

//신청할 수 있는 배너 리스트 보여주는 파일 
$bo_t="banner";
$tab_banner=$g4['write_prefix'].$bo_t;
$charset="utf-8";

$sql_ba="select * from $tab_banner where wr_1='Y'";
$result_ba=mysql_query($sql_ba);

$oba = array();

for($i=0;$row=sql_fetch_array($result_ba);$i++){
	array_push($oba, $row);
}
$banner_cnt=count($oba);

$board=get_board($bo_t); //타이틀, 컬럼넓이. 순서 설정값 테이블에서 끌어옴 
//print_r2($board);

$title=explode("|",$board[bo_1]);
$width=explode("|",$board[bo_2]);
$seq=explode("|",$board[bo_3]);

/*타이틀*/
$prod['col_title'][0] = $title[0];
$prod['col_title'][1] = $title[1];
$prod['col_title'][2] = $title[2];
$prod['col_title'][3] = $title[3];
$prod['col_title'][4] = $title[4];
$prod['col_title'][5] = $title[5];
/*컬럼넓이*/
$prod['col_wid'][0] = $width[0];
$prod['col_wid'][1] = $width[1];
$prod['col_wid'][2] = $width[2];
$prod['col_wid'][3] = $width[3];
$prod['col_wid'][4] = $width[4];
$prod['col_wid'][5] = $width[5];
/*번화와 라디오버튼 제외한 순서*/
$prod['colum'][1] = $seq[1];
$prod['colum'][2] = $seq[2];
$prod['colum'][3] = $seq[3];
$prod['colum'][4] = $seq[4];

$imp_t="신청불가";

$col_cnt=count($prod['col_title']);
$col_cnt2=count($prod['colum']);

?>
<head>
	<link rel="stylesheet" href="<?=$g4['path']?>/style.css" type="text/css"> <!--버튼에 필요한 스타일-->
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">
</head>
<style>
	body{margin:0px; padding:0px;}
	table.ban_table {border-left:solid 1px #E1E1E1; border-top:solid 1px #E1E1E1; border-collapse:collapse; width:100%; text-align:center;}
	table.ban_table tr {}
	table.ban_table tr th{border-right:solid 1px #E1E1E1; border-bottom:solid 1px #E1E1E1; font-size:12px; color:#FF0000; background:#F7F7F7; font-weight:lighter; height:30px;}
	table.ban_table tr td{border-right:solid 1px #E1E1E1; border-bottom:solid 1px #E1E1E1; font-size:12px; color:#646464; }
	
	a.b_com:link, a.b_com:visited, a.b_com:active { text-decoration:none; color:red; }
	a.b_com:hover {text-decoration:underline; color:#222;};

	a.b_img:link, a.b_com:visited, a.b_com:active { text-decoration:none; color:#2683f4; }
	a.b_img:hover {text-decoration:underline; color:#0651ec;};
</style>
<style>
	div.ex {border:double #D5E4F5; width:100%; margin:10px; padding:10px;}
</style>
<body>


<div class="ex">
	banner 게시판에서 설정한 값들이 노출(Y)<br>
	번호와 신청버튼을 제외한 칼럼의 순서 변경 가능.<br>
	게시판 설정에서 bo_1(타이틀),bo_2(칼럼넓이), bo_3(순서) 변경할 수 있음.<br> 
	(단, 번호와 신청 라디오 박스 라인은 제외.)<br>
	구분자는 '|'.
</div>


<form name="fbanner" method="post">
<table class="ban_table">
<?for($a=0;$a<$col_cnt;$a++){ //넓이
	echo "<colgroup width='{$prod['col_wid'][$a]}'>";
}?>
	<tr>
	<?for($b=0;$b<$col_cnt;$b++){ //제목
		echo "<th>".$prod['col_title'][$b]."</th>";
	}?>
	</tr>
		<?for($j=0;$j<$banner_cnt;$j++){ //실제 뿌려지는 내용

		$id=$oba[$j][wr_id]; //리스트 번호와 관계없는 실제 상품 번호(wr_id);	
		$b_subj=$oba[$j][wr_subject];
		
		/*
		b_application
		wr_1	banner 키값
		wr_5 - 2011110	시작일
		wr_6 - 2011110	종룐일
		*/

		$priode=substr($oba[$j][ca_name],0,1); //노출 주(week) 앞자리만
		$strd =date("Ymd",strtotime("+2 day")); //오늘로 부터 2틀 후
		$endd =date("Ymd",strtotime("$strd +$priode week")); //오늘로 부터 2틀 후 부터 종료일
				
		$sql_num="select wr_3, wr_id from g4_write_banner where wr_subject='".$b_subj."' order by wr_id asc limit 1";
		$row_n=sql_fetch($sql_num);
		$maxn=$row_n[wr_3]; //배너 최대 노출 갯수
		$fid=$row_n[wr_id]; //제목이 같은 상품의 개별 wr_id
		
		$sql_cnt="select count(wr_id) as cnt, min(wr_6) as dmin from g4_write_b_application where wr_3='".$b_subj."' and wr_6 >= ".$strd;
		
		$row_c=sql_fetch($sql_cnt); 
		$useb=$row_c[cnt]; //이틀 후 보다 종료일이 큰 배너들의 갯수
		$dmin=$row_c[dmin]; //이틀 후 보다 종료일이 큰 배너들 중 가장 작은 날짜 
		?>
		<tr>
		<td><?=$j+1?></td>
		<?for($k=1;$k<=$col_cnt2;$k++){?>
			<?if($prod['colum'][$k]=="wr_2"){
				echo "<td>".number_format($oba[$j][$prod['colum'][$k]])." 원</td>";
			}else if($prod['colum'][$k]=="wr_subject"){
				$idf=$oba[$j][wr_id];	
				$imgf[file]=get_file($bo_t,$idf);
				
				if($imgf[file][count]>0){
					$imgName=$imgf[file][0][file]; //파일이름 얻기
				}else{
					$imgf[file]=get_file($bo_t,$fid);
					$imgName=$imgf[file][0][file]; //파일이름 얻기2 (제목이 같은 상품의 첫번째 id를 이용)
				}
			?>
				<td><a class="b_img" href='javascript:winOpen("<?=$bo_t?>","<?=$imgName?>");'><?=$oba[$j][$prod['colum'][$k]]?></a></td>
			<?}else{
				echo "<td>".$oba[$j][$prod['colum'][$k]]."</td>";
			}
		}?>
		<td> 
			<?if($useb<$maxn){ //최대 배너 수 보다 등록된 수가 적으면?>
				<input type="radio" name="ba_id" id="ba_id" value="<?=$id?>">
			<?}else{?> 
				<a href='javascript:comment_banner(<?=$dmin?>);' class="b_com"><?=$imp_t?></a>
			<?}?>
		</td>
		</tr>
	<?}?>	
</table>
<form>
<span class="button white normal" style="margin-top:10px;"><a href="javascript:fbanner_submit();">다음</a></span>
</body>


<script type="text/javascript">
<!--
function winOpen(_bo,_imgName){
	var imgb=_bo;
	var imgN=_imgName;
	window.open("<?=$g4[path]?>/data/file/"+imgb+"/"+imgN);
}

function comment_banner(_val){	
	var val=String(_val);
	var year = val.substr(0,4);
	var month = val.substr(4,2);
	var day = val.substr(6,2);
	
	if(val){ 
		alert(year+"년"+month+"월"+day+"일 이후에 신청하실 수 있습니다.");	
	}
}
function fbanner_submit(){
	var f=document.fbanner;

	var chk=0;
		for(var i=0; i<fbanner.elements.length; i++){		
			if(document.getElementsByName('ba_id')[i].checked==true){
				chk=1;	
				<?
				if ($g4[https_url])
					echo "f.action = '$g4[https_url]/$g4[bbs]/b_proc.php';";
				else
					echo "f.action = './bbs/b_proc.php';";
				?>  
				fbanner.submit();
			}
		}		
		if(chk==0){
			alert("결제할 상품을 선택해 주세요");
				return;
		}
}
//-->
</script>