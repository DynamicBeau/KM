<style type="text/css">
#sub_info {height:450px;}

.left_menu, .left_menu ul {padding:0; margin:0; list-style:none;}
.left_menu {margin-left:10px;} /* this demo only */
.left_menu {width:180px; height:252px; background:#fcfcfc; border:1px solid #ddd; border-width:1px 0 1px 1px; position:relative; z-index:500;}
.left_menu table {border-collapse:collapse; padding:0; margin:0 0 -1px 0; width:0; height:0; font-size:1em;}
.left_menu ul {position:absolute; left:-9999px;}

.left_menu li {width:180px; height:42px; float:left; border-right:1px solid #ddd;}

.left_menu li a {display:block; width:100%; height:42px; line-height:42px; color:#777; text-decoration:none; font-size:13px; font-family:"lucida grande", arial, sans-serif; text-indent: 15px; float:left;}

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

<body>
<div id="sub_info">

<ul class="left_menu">
	<li class="home"><a href="#">Home</a></li>
	<li class="sub products"><a href="#"><b>Products</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			<li class="sub"><a href="../menu/">Cameras<!--[if IE 7]><!--></a><!--<![endif]-->
					<!--[if lte IE 6]><table><tr><td><![endif]-->
					<ul>
						<li><a href="../mozilla/">Nikon</a></li>
						<li><a href="../ie/">Minolta</a></li>
						<li><a href="../opacity/">Pentax</a></li>
					</ul>
					<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			<li class="sub"><a href="../boxes/"><b>Lenses</b><!--[if IE 7]><!--></a><!--<![endif]-->
					<!--[if lte IE 6]><table><tr><td><![endif]-->
					<ul>
						<li><a href="../mozilla/">Wide Angle</a></li>
						<li><a href="../ie/">Standard</a></li>
						<li><a href="../opacity/">Telephoto</a></li>
						<li class="sub"><a href="../menu/"><b>Zoom</b><!--[if IE 7]><!--></a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
							<ul>
								<li><a href="../mozilla/">35mm - 125mm</a></li>
								<li><a href="../opacity/"><b>50mm - 250mm</b></a></li>
								<li><a href="../menu/">125mm - 500mm</a></li>
							</ul>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
						<li><a href="../boxes/">Mirror</a></li>
						<li class="sub"><a href="../opacity/">Non-standard<!--[if IE 7]><!--></a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
							<ul>
								<li><a href="../mozilla/">Bayonet mount</a></li>
								<li><a href="../opacity/">Screw mount</a></li>
							</ul>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
					</ul>
					<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			<li><a href="../mozilla/">Flash Guns</a></li>
			<li><a href="../ie/">Tripods</a></li>
			<li><a href="../opacity/">Filters</a></li>
		</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li class="sub services"><a href="#">Services<!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			<li><a href="../menu/">Printing</a></li>
			<li><a href="../layouts/">Photo Framing</a></li>
			<li><a href="../boxes/">Retouching</a></li>
			<li><a href="../mozilla/">Archiving</a></li>
		</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li class="sub shop"><a href="#">Shop<!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			<li><a href="../ie/">Online</a></li>
			<li><a href="../opacity/">Catalogue</a></li>
			<li><a href="../menu/">Mail Order</a></li>
		</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li class="sub contacts"><a href="#">Contacts<!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			<li><a href="../layouts/">Support</a></li>
			<li class="sub"><a href="../boxes/">Sales<!--[if IE 7]><!--></a><!--<![endif]-->
				<!--[if lte IE 6]><table><tr><td><![endif]-->
				<ul>
					<li><a href="../mozilla/">USA</a></li>
					<li><a href="../ie/">Canadian</a></li>
					<li><a href="../opacity/">South American</a></li>
					<li class="sub"><a href="../menu/">European<!--[if IE 7]><!--></a><!--<![endif]-->
						<!--[if lte IE 6]><table><tr><td><![endif]-->
						<ul>
							<li class="sub current"><a href="../mozilla/">British<!--[if IE 7]><!--></a><!--<![endif]-->
								<!--[if lte IE 6]><table><tr><td><![endif]-->
								<ul>
									<li><a href="../ie/">London</a></li>
									<li><a href="../menu/">Liverpool</a></li>
									<li><a href="../boxes/">Glasgow</a></li>
									<li class="sub"><a href="../opacity/">Bristol<!--[if IE 7]><!--></a><!--<![endif]-->
										<!--[if lte IE 6]><table><tr><td><![endif]-->
										<ul>
											<li><a href="../ie/">Redland</a></li>
											<li><a href="../opacity/">Hanham</a></li>
											<li><a href="../menu/">Eastville</a></li>
										</ul>
										<!--[if lte IE 6]></td></tr></table></a><![endif]-->
									</li>
									<li><a href="../layouts/">Cardiff</a></li>
									<li><a href="../mozilla/">Belfast</a></li>
								</ul>
								<!--[if lte IE 6]></td></tr></table></a><![endif]-->
							</li>
							<li><a href="../opacity/">French</a></li>
							<li><a href="../menu/">German</a></li>
							<li><a href="../boxes/">Spanish</a></li>
						</ul>
						<!--[if lte IE 6]></td></tr></table></a><![endif]-->
					</li>
					<li><a href="../boxes/">Canadian</a></li>
					<li><a href="../boxes/">Asian</a></li>
				</ul>
				<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			<li><a href="../mozilla/">Buying</a></li>
			<li><a href="../ie/">Photographers</a></li>
			<li><a href="../opacity/">Stockist</a></li>
			<li><a href="../menu/">General</a></li>
		</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li class="privacy"><a href="#">Privacy Policy</a></li>
</ul>

</div> <!-- end of info -->