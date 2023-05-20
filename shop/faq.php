<?
include_once("./_common.php");

if (!$fm_id) $fm_id = 1;

// FAQ MASTER
$sql = " select * from $g4[yc4_faq_master_table] where fm_id = '$fm_id' ";
$fm = sql_fetch($sql);
if (!$fm[fm_id]) 
    alert("등록된 내용이 없습니다.");

$g4[title] = $fm[fm_subject];
include_once("./_head.php");


$himg = "$g4[path]/data/faq/{$fm_id}_h";
if (file_exists($himg)) 
    echo "<img src='$himg' border=0>";


// 상단 HTML
echo stripslashes($fm[fm_head_html]);


$sql = " select * from $g4[yc4_faq_table]
          where fm_id = '$fm_id'
          order by fa_order , fa_id ";
$result = sql_query($sql);
?>

<style type="text/css">
/* UI Object */
#faq{}
#faq .hgroup{position:relative; text-align:right;cursor: pointer; padding:5px 10px; }
#faq  ul{border-top:1px solid #DDD;}
#faq  ul li{border-bottom:1px solid #DDD;}

#faq  ul li div.q{font-weight:bold;  cursor: pointer; padding:10px 10px; }
#faq  ul li div.a{display:none; background:#F3F3F6; padding:15px; padding-left:40px; word-break:break-all; }
#faq  ul li div.a .a_title{font-weight:bold; color:#F60; margin-left:-30px;}

</style>
 
<div id="faq">
	<div class="hgroup">답변 모두 여닫기</div>
	<ul>
	<? for ($i=1; $row=sql_fetch_array($result); $i++){ ?>
	<li class="article">
		<div class="q"><?=stripslashes($row[fa_subject]) ?></div>
		<div class="a"><span class="a_title">A :</span><?=stripslashes($row[fa_content])?></div>
	</li>
	<?}?>
	</ul>
</div> 

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
 
	$('#faq .article > .q').click(function(){
		$('#faq li.article > .a').slideUp(500); 
		if($(this).next('.a').css("display") == "none")
		$(this).next('.a').slideDown(500);
		
	});
	var k = 1;
	$(".hgroup").click(function(){
		
		if(k>0)
		$("#faq .a").slideDown(500);
		else
		$("#faq .a").slideUp(500);

		k = k*-1;
	});
});
</script>

<?
echo stripslashes($fm[fm_tail_html]);

if ($is_admin) 
    echo "<p align=center><a href='$g4[shop_admin_path]/faqmasterform.php?w=u&fm_id=$fm_id'><img src='$g4[shop_img_path]/btn_admin_modify.gif' border=0></a></p>";

$timg = "$g4[path]/data/faq/{$fm_id}_t";
if (file_exists($timg)) 
    echo "<br><img src='$timg' border=0><br>";

include_once("./_tail.php");
?>
