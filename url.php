<?
header("Content-type:text/xml"); print("<?xml version=\"1.0\" encoding=\"euc-kr\"?>");

$path = $_GET[path];
#####################################################################################
##### XML for PHP : 메뉴flash와 DB간 연동을 위해 제작되었습니다. 2008-12-17 지훈 ####
## ver 0.1 현재 파일연동만 가능													   ##
## tracking 코드가 들어 있어 허가되지 않은 도메인에서 사용시 법적책임이 따릅니다.  ##
#####################################################################################


#	배열을 그대로 수정하시면 됩니다. 단, XML문자를 구성하는데 아래와 같은 특수문자는
#	다음과 같이 표기하면 됩니다.
#	< (less-than sign) -> &lt;
#	> (greater-than sign) -> &gt;
#	& (ampersand) -> &amp;
#	ex) Q&A (X) -> Q&amp;A (O)

include_once("./url_menu.php");

#####################################################################################
#	아래부터는 제작자 이외에 누구도 수정하시면 안됩니다.
#####################################################################################
echo "<menu>\n";
for($i=0;$i<count($menu);$i++){
	echo "\t<depth1 name='{$menu[$i][0]}' link='{$menu[$i][1]}' target='{$menu[$i][2]}'>\n";
	for($j=0;$j<count($menu[$i][3]);$j++){
		echo "\t\t<depth2 name='{$menu[$i][3][$j][0]}' link='{$menu[$i][3][$j][1]}' target='{$menu[$i][3][$j][2]}'>\n";
		for($x=0;$x<count($menu[$i][3][$j][3]);$x++){
			echo "\t\t\t<depth3 name='{$menu[$i][3][$j][3][$x][0]}' link='{$menu[$i][3][$j][3][$x][1]}' target='{$menu[$i][3][$j][3][$x][2]}'></depth3>\n";
		}
		echo "\t\t</depth2>\n";
	}
	echo "\t</depth1>\n";
}
echo "</menu>";
?>
