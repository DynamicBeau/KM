<style type="text/css">
#sub_info {height:170px; }

.left_menu, .left_menu ul {padding:0; margin:0; list-style:none; background:url('<?=$g4[path]?>/images/left_box.png' ) no-repeat left top; margin-top:-4px;}
.left_menu {margin-left:10px;} /* this demo only */
.left_menu {width:160px; height:300px; border:0px solid #ddd;  position:relative; padding-top:15px; padding-left:6px; z-index:1; margin-left:27px;}
.left_menu table {border-collapse:collapse; padding:0; width:0; height:0; font-size:1em;}
.left_menu ul {position:absolute; left:-9999px;}



.left_menu li a {display:block; width:100%; float:left;  text-indent: 10px;}


.left_menu li span.F						{ display:inline-block ; padding:0px  ; cursor:pointer ; text-align:center ; margin:0px ; }
.left_menu li span.B						{ display:none ; }
.left_menu li:hover > span.F			{ display:none ; }
.left_menu li:hover > span.B			{ display:inline-block ; }




.left_menu li.sub a {background:url('<?=$g4[path]?>/img/grey.gif') no-repeat 150px center;}

.left_menu li a:hover {white-space:nowrap; position:relative; color:#06f;}

.left_menu li.sub a:hover {background:url('<?=$g4[path]?>/img/blue.gif') no-repeat 150px center; color:#06f;}
.left_menu li.sub a b {display:block; color:#06f; font-weight:normal;}

.left_menu li:hover {position:relative;}
.left_menu li:hover.sub > a {background:url('<?=$g4[path]?>/img/blue.gif' ) no-repeat 150px center; color:#06f;}

/*
.left_menu li.home {background:url('<?=$g4[path]?>/img/home.gif') no-repeat 10px center;}
.left_menu li.products {background:url('<?=$g4[path]?>/img/graph.gif') no-repeat 10px center;}
.left_menu li.services {background:url('<?=$g4[path]?>/img/services.gif') no-repeat 10px center;}
.left_menu li.shop {background:url('<?=$g4[path]?>/img/flower.gif') no-repeat 10px center;}
.left_menu li.contacts {background:url('<?=$g4[path]?>/img/mail.gif') no-repeat 10px center;}
.left_menu li.privacy {background:url('<?=$g4[path]?>/img/lock.gif') no-repeat 10px center;}
*/
.left_menu :hover ul
{width:120px; height:auto; left:165px; top:7px; background:#fcfcfc; border:1px solid #ddd;}
.left_menu :hover ul :hover ul,
.left_menu :hover ul :hover ul :hover ul,
.left_menu :hover ul :hover ul :hover ul :hover ul,
.left_menu :hover ul :hover ul :hover ul :hover ul :hover ul
{width:120px; height:auto; left:115px; top:-1px; background:#fcfcfc; border:1px solid #ddd; border-width:1px 0 1px 1px;}

.left_menu :hover ul ul,
.left_menu :hover ul :hover ul ul,
.left_menu :hover ul :hover ul :hover ul ul,
.left_menu :hover ul :hover ul :hover ul :hover ul ul
{left:-9999px; width:0; height:0;}

.left_menu :hover ul li,
.left_menu :hover ul li a
{width:120px; height:25px; line-height:25px; text-indent:10px; float:none;}

.left_menu:hover ul li.sub a,
.left_menu:hover ul :hover ul li.sub a,
.left_menu:hover ul :hover ul :hover ul li.sub a,
.left_menu:hover ul :hover ul :hover ul :hover li.sub a,
.left_menu:hover ul :hover ul :hover ul :hover ul :hover li.sub a
{background:url('<?=$g4[path]?>/img/grey.gif') no-repeat 100px center; color:#777;}

.left_menu:hover ul li.sub a:hover,
.left_menu:hover ul :hover ul li.sub a:hover,
.left_menu:hover ul :hover ul :hover ul li.sub a:hover,
.left_menu:hover ul :hover ul :hover ul :hover ul li.sub a:hover
{background:url('<?=$g4[path]?>/img/blue.gif') no-repeat 100px center; color:#06f;}
.left_menu:hover ul li.sub:hover > a,
.left_menu:hover ul :hover ul li.sub:hover > a,
.left_menu:hover ul :hover ul :hover ul li.sub:hover > a,
.left_menu:hover ul :hover ul :hover ul :hover ul li.sub:hover > a
{background:url('<?=$g4[path]?>/img/blue.gif) no-repeat 100px center; color:#06f;}

.left_menu:hover ul li a,
.left_menu:hover ul :hover ul li a,
.left_menu:hover ul :hover ul :hover ul li a,
.left_menu:hover ul :hover ul :hover ul :hover ul li a,
.left_menu:hover ul :hover ul :hover ul :hover :hover ul li a
{background:#fcfcfc; color:#777;}

.left_menu:hover ul li a:hover,
.left_menu:hover ul :hover ul li a:hover,
.left_menu:hover ul :hover ul :hover ul li a:hover,
.left_menu:hover ul :hover ul :hover ul :hover ul li a:hover,
.left_menu:hover ul :hover ul :hover ul :hover ul :hover ul li a:hover
{background:#fcfcfc; color:#06f;}

.left_menuli.sub a b,
.left_menu:hover li.sub a b,
.left_menu:hover ul :hover li.sub a b,
.left_menu:hover ul :hover ul :hover li.sub a b,
.left_menu:hover ul :hover ul :hover ul :hover li.sub a b,
.left_menu:hover ul :hover ul :hover ul :hover ul :hover li.sub a b
{display:block; color:#06f; font-weight:normal;}

.left_menuli.sub a.selected b,
.left_menu:hover ul li.sub a.selected b,
.left_menu:hover ul :hover ul li.sub a.selected b,
.left_menu:hover ul :hover ul :hover ul li.sub a.selected b,
.left_menu:hover ul :hover ul :hover ul :hover ul li.sub a.selected b,
.left_menu:hover ul :hover ul :hover ul :hover ul :hover ul li.sub a.selected b
{display:block; background:#fcfcfc; color:#06f; font-weight:normal;}
</style>
</head>

<div id="sub_info">
<?if($page_stat != "1"){?>
<ul class="left_menu">
<?
$ll = substr($local,1,1);
	$ll = (int)$ll ;
	$ll = $ll - 1;
	$i=0;
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
	<li class="<?=$sub_str?>">
		<?include_once("$g4[path]/sub_left_menu.php")?>
		<!-- <span class="F"><img src="<?=$g4[path]?>/images/left_text_<?=$menu[$ll][3][$i][0]?>.png"></span>
		<span class="B"><a href="<?=$menu[$ll][3][$i][1]?>"><img src="<?=$g4[path]?>/images/left_text_<?=$menu[$ll][3][$i][0]?>_ov.png"></a></span> -->
	</li>

<? } // end for ?>
<?
	if($i == 0){?>
		<li class="<?=$sub_str?>">
	<?
		include_once("$g4[path]/sub_left_menu.php");
	?>
		</li>

<?}
?>
<?//if($local) echo "<script>alert('{$i}');</script>";?>
</ul>
<?}?>
</div> <!-- end of info -->
