<?
$b=$_GET['b'];

$exists = false;

$ca_len = strlen($ca_id);
$ca_slen = strlen($ca_id)+2;

$sql = " select ca_id, ca_name from $g4[yc4_category_table]
          where ca_id like '${ca_id}%'
			and length(ca_id) > $ca_len
			and length(ca_id) <= $ca_slen
            and ca_use = '1'
          order by ca_id ";
$result = sql_query($sql);
$str ="";
while ($row=sql_fetch_array($result)) {
    $str .= "<a href='./list.php?ca_id=$row[ca_id]'>$row[ca_name] </a>";
    $exists = true;
}

if (!$exists) {
	$pa_ca_id = substr($ca_id, 0, -2);
	$pa_ca_len = strlen($pa_ca_id);


	$sql = " select ca_id, ca_name from $g4[yc4_category_table]
						where ca_id like '{$pa_ca_id}%'
				and length(ca_id) > $pa_ca_len
							and ca_use = '1'
						order by ca_id ";

	if(!$pa_ca_len){
		$pa_ca_len = 2;

		$sql = " select ca_id, ca_name from $g4[yc4_category_table]
						where  length(ca_id) = $pa_ca_len
							and ca_use = '1'
						order by ca_id ";
	}
	$result = sql_query($sql);
	$str ="";
	while ($row=sql_fetch_array($result)) {
		$class = "";
			if (preg_match("/^$row[ca_id]/", $ca_id)) $class = " class='thisca'";
			$row[ca_name] = trim($row[ca_name]);
			if($b){
				$str .= "<a href='./list.php?ca_id=$row[ca_id]&b={$b}' $class>$row[ca_name]</a>\n";
			}else{
				$str .= "<a href='./list.php?ca_id=$row[ca_id]' $class>$row[ca_name]</a>\n";
			}
			$exists = true;
	}
}

if ($exists) {
?>
<div class="listcategory">
	<?=$str?>
</div>

<p class="shadow"></p>

<?}?>
