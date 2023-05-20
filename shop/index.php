<?
include_once("./_common.php");

$g4[title] = $b . " 상품리스트";

include_once("$g4[path]/subhead.php");

$sql = "select * from $g4[yc4_category_table] where ca_use = '1' order by ca_id ";
$result = sql_query($sql);

$b=$_GET['b'];
?>


<div style="border:1px solid #DDD; margin-top:10px; background:#F6F6F6">
	<script language="JavaScript">titleFlash("<?=$g4[path]?>/img/titleView.swf", 500, 60, "<?=$b?>")</script>
</div>
<p style="font-size:0; line-height:1px; background:#EEE; border-top:1px solid #CCC; border-bottom:1px solid #F2F2F2"></p>
<?
$chk=0;
while ($row=sql_fetch_array($result)) {
	$get_ca_id=$row[ca_id];

	$sql2="select count(it_id) as cnt from $g4[yc4_item_table] where it_maker='{$b}' and it_use='1' and ca_id='{$get_ca_id}'";
	$result2=sql_fetch($sql2);
	
	if($result2[cnt]>0){
		echo "<p style='margin-top:10px;'><a href='{$g4[shop_path]}/list.php?ca_id={$row[ca_id]}&b={$b}'><img src='{$g4[path]}/img/sub_product_title_{$row[ca_id]}.gif'></a></p>";
		// 스킨파일번호, 1라인이미지수, 총라인수, 이미지폭, 이미지높이 , 분류번호
		//function display_category($no, $list_mod, $list_row, $img_width, $img_height, $ca_id="")	
		echo "<div style='border:1px solid #DDD; border-top:0'>";
		display_category2(13,6,1,120,120,$row[ca_id], $b);
		echo "</div>";
		$chk=1;
	}else{	
		if($chk==0){
		// 스킨파일번호, 1라인이미지수, 총라인수, 이미지폭, 이미지높이 , 분류번호
		//function display_category($no, $list_mod, $list_row, $img_width, $img_height, $ca_id="")	
		echo "<div style='padding-top: 10px; border-top:0;'>";
		echo "<div style='border:1px solid #DDD; height: 90px; text-align:center; padding-top: 70px;'>상품이 없습니다.</div>";
		echo "</div>";	
		$chk=1;
		}
	}
}
?>

<?
// 분류별 출력 
// 스킨파일번호, 1라인이미지수, 총라인수, 이미지폭, 이미지높이 , 분류번호
function display_category2($no, $list_mod, $list_row, $img_width, $img_height, $ca_id="", $it_maker="")
{
	global $member, $g4;

    // 상품의 갯수
    $items = $list_mod * $list_row;

    $sql = " select * from $g4[yc4_item_table] where it_use = '1'";
    if ($ca_id) 
        $sql .= " and ca_id LIKE '{$ca_id}%' ";
    if ($it_maker) 
        $sql .= " and it_maker =  '$it_maker' ";
    $sql .= " order by it_order, it_id desc limit $items ";
    $result = sql_query($sql);
    if (!mysql_num_rows($result)) {
        return false;
    }

    $file = "$g4[shop_path]/maintype{$no}.inc.php";
		//echo $file;
    if (!file_exists($file)) {
        echo "<span class=point>{$file} 파일을 찾을 수 없습니다.</span>";
    } else {
        $td_width = (int)(100 / $list_mod);
        include $file;
    }
}
include_once("$g4[path]/subtail.php");
?>
