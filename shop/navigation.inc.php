<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($ca_id)
{    
    $str = $bar = "";
    $len = strlen($ca_id) / 2;
    for ($i=1; $i<=$len; $i++) 
    {
        $code = substr($ca_id,0,$i*2);
        $sql = " select ca_name from $g4[yc4_category_table] where ca_id = '$code' ";
        $row = sql_fetch($sql);

        $style = "";
        if ($ca_id == $code)
            $class = " class='thiscode'";

        $str .= $bar . "<a href='./list.php?ca_id=$code' $class>$row[ca_name]</a>";
        $bar = " > ";
    }
}
else
    $str = $g4[title];
?>
<div class="navigation" style="float:left;font-size:12pt;font-family:맑은 고딕;"> <!-- <img src="http://daechungadd.subnara.info/images/icon.jpg"> --><?=$str?></div>
<div class="navigation" style="float:right;">현재위치 : <a href='<?=$g4[path]?>/'>Home</a> > <?=$str?></div>

<div style="clear:both"></div>
