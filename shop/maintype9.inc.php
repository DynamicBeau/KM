<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 


?>

<? for ($i=0; $row=sql_fetch_array($result); $i++) {

    $href = "<a href='$g4[shop_path]/item.php?it_id=$row[it_id]' class=item>";
?>
    <li style="width:<?=$img_width+5?>px;">
			<?=$href?><?=get_it_image($row[it_id]."_s", $img_width, $img_height)?></a>
		</li>
<?
}

// 나머지 td 를 채운다.
if (($cnt = $i%$list_mod) != 0)
    for ($k=$cnt; $k<$list_mod; $k++)
        echo "<li style='width:100px;height:100px;'>&nbsp;</li>\n";
?>

