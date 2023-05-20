<style type="text/css">
div.left_inner { margin: 0; background: #ffc; padding: 10px; border:0; zoom:1;}
</style>
</head>

<div class="left_inner" id='left_m'><h1>Round</h1><p>$(this).corner("round 8px").parent().css('padding', '8px').corner("round 14px")</p></div>


<div id="sub_info">
<ul class="left_menu">




<?
$ll = substr($local,1,1);
	$ll = (int)$ll ;
	$ll = $ll - 1;
?>
<? for($i=0;$i<count($menu[$ll][3]);$i++){  ?>
	<?
		if (count($menu[$ll][3]) == 0 ) { 
			//$sub_str = "sub "; 
			$sub_str2 = "<!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->";
			$sub_str3 = "<!--[if lte IE 6]></td></tr></table></a><![endif]-->";
			$sub_str4 = "";
		}else{ 
			$sub_str = ""; 
			$sub_str2 = "</a>";
			$sub_str3 = "";
			$sub_str4 = "</a>";
		}
		?>
	<li class="<?=$sub_str?>"><a href="<?=$menu[$ll][3][$i][1]?>"><?=$menu[$ll][3][$i][0]?></a></li>
<? } // end for ?>
</ul>
</div> <!-- end of info -->
<script>
$(document).ready(function() { 
	$('#left_m').corner("round 8px").parent().css('padding', '8px').corner("round 14px");
});
</script>