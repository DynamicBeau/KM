<?
$sql = " select count(*) as cnt from $g4[yc4_category_table]
					 where  ca_use = '1' and ca_id like '{$ca3_key}%'
						order by ca_id ";
$result = sql_query($sql);
$row=sql_fetch_array($result);

if($row[cnt] >1){

	$sql = " select ca_id, ca_name from $g4[yc4_category_table]
						 where  ca_use = '1' and ca_id like '{$ca3_key}%'
							order by ca_id ";
	$result = sql_query($sql);

	?>		

	<ul class="main_leftsub dep3_div">
		<?while ($row=sql_fetch_array($result)) { ?>		
			<?if(strlen($row[ca_id]) == 4){?>
			<li class="main_leftsub2">
				<a href="<?=$g4[path]?>/shop/list.php?ca_id=<?=$row[ca_id]?>"><?=$row[ca_name]?></a>
			</li>
			<?}?>
		<?}?>
	</ul>
<?
}
?>