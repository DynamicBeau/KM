<?
include_once("./_common.php");

// 불법접속을 할 수 없도록 세션에 아무값이나 저장하여 hidden 으로 넘겨서 다음 페이지에서 비교함
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);

$rand = rand(4, 6);
$norobot_key = substr($token, 0, $rand);
set_session('ss_norobot_key', $norobot_key);

// 오늘 본 상품 저장 시작
// tv 는 today view 약자
$saved = false;
$tv_idx = (int)get_session("ss_tv_idx");
if ($tv_idx > 0) {
    for ($i=1; $i<=$tv_idx; $i++) {
        if (get_session("ss_tv[$i]") == $it_id) {
            $saved = true;
            break;
        }
    }
}

if (!$saved) {
    $tv_idx++;
    set_session("ss_tv_idx", $tv_idx);
    set_session("ss_tv[$tv_idx]", $it_id);
}
// 오늘 본 상품 저장 끝

// 조회수 증가
if ($_COOKIE[ck_it_id] != $it_id) {
    sql_query(" update $g4[yc4_item_table] set it_hit = it_hit + 1 where it_id = '$it_id' "); // 1증가
    setcookie("ck_it_id", $it_id, time() + 3600, $config[cf_cookie_dir], $config[cf_cookie_domain]); // 1시간동안 저장
}

// 분류사용, 상품사용하는 상품의 정보를 얻음
$sql = " select a.*,
                b.ca_name,
                b.ca_use
           from $g4[yc4_item_table] a,
                $g4[yc4_category_table] b
          where a.it_id = '$it_id'
            and a.ca_id = b.ca_id ";
$it = sql_fetch($sql);
if (!$it[it_id])
    alert("자료가 없습니다.");
if (!($it[ca_use] && $it[it_use])) {
    if (!$is_admin)
        alert("판매가능한 상품이 아닙니다.");
}

// 분류 테이블에서 분류 상단, 하단 코드를 얻음
$sql = " select ca_include_head, ca_include_tail
           from $g4[yc4_category_table]
          where ca_id = '$it[ca_id]' ";
$ca = sql_fetch($sql);

$g4[title] = "상품 상세보기 : $it[ca_name] - $it[it_name] ";

// 분류 상단 코드가 있으면 출력하고 없으면 기본 상단 코드 출력
if ($ca[ca_include_head])
    @include_once($ca[ca_include_head]);
else
    include_once("./_head.php");

// 분류 위치
// HOME > 1단계 > 2단계 ... > 6단계 분류
$ca_id = $it[ca_id];
include "$g4[shop_path]/navigation.inc.php";

$himg = "$g4[path]/data/item/{$it_id}_h";
if (file_exists($himg))
    echo "<img src='$himg' border=0><br>";

// 상단 HTML
echo stripslashes($it[it_head_html]);


// 이 분류에 속한 하위분류 출력
include "$g4[shop_path]/listcategory.inc.php";

// 이전 상품보기
$sql = " select it_id, it_name from $g4[yc4_item_table]
          where it_id > '$it_id'
            and SUBSTRING(ca_id,1,4) = '".substr($it[ca_id],0,4)."'
            and it_use = '1'
          order by it_id asc
          limit 1 ";
$row = sql_fetch($sql);
if ($row[it_id]) {
    $prev_title = "[이전상품보기] $row[it_name]";
    $prev_href = "<a href='./item.php?it_id=$row[it_id]'>";
} else {
    $prev_title = "[이전상품없음]";
    $prev_href = "";
}

// 다음 상품보기
$sql = " select it_id, it_name from $g4[yc4_item_table]
          where it_id < '$it_id'
            and SUBSTRING(ca_id,1,4) = '".substr($it[ca_id],0,4)."'
            and it_use = '1'
          order by it_id desc
          limit 1 ";
$row = sql_fetch($sql);
if ($row[it_id]) {
    $next_title = "[다음상품보기] $row[it_name]";
    $next_href = "<a href='./item.php?it_id=$row[it_id]'>";
} else {
    $next_title = "[다음상품없음]";
    $next_href = "";
}

// 관련상품의 갯수를 얻음
$sql = " select count(*) as cnt
           from $g4[yc4_item_relation_table] a
           left join $g4[yc4_item_table] b on (a.it_id2=b.it_id and b.it_use='1')
          where a.it_id = '$it[it_id]' ";
$row = sql_fetch($sql);
$item_relation_count = $row[cnt];
//상품중간이미지
$middle_image = $it[it_id]."_l1";
?>
<link rel="stylesheet" href="<?=$g4['shop_path']?>/style.css" type="text/css">
<script language="JavaScript" src="<?=$g4[path]?>/js/shop.js"></script>
<script language="JavaScript" src="<?=$g4[path]?>/js/md5.js"></script>



<table class="item_img_info">
<tr>
	<td width="<?=$default[de_mimg_width]+70?>px" valign=top><table class="img_line_box" width="<?=$default[de_mimg_width]+30?>px">
	<tr>
		<td class="line_tl">상단좌측</td>
		<td class="line_t">상단</td>
		<td class="line_tr">상단우측</td>
	</tr>
	<tr>
		<td class="line_l">좌측</td>
		<td class="line_c"><a href="javascript:;" onclick="javascript:win_open('./largeimage.php?it_id=<?=$it_id?>', 'viewImage','left=50, top=50, width=600, height=600')"><?=get_it_image($middle_image,350,350);?></a><table class="thum_img">
		<tr>
		<?
                for ($i=1; $i<=5; $i++){
                    if (file_exists("$g4[path]/data/item/{$it_id}_l{$i}")){
                            echo "<td><img id='middle{$i}' src='$g4[path]/data/item/{$it_id}_l{$i}' border=0 width=40 height=40 onmouseover=\"document.getElementById('$middle_image').src=document.getElementById('middle{$i}').src;\"  style='cursor: pointer' onclick=\"javascript:win_open('./largeimage.php?it_id={$it_id}&t=$i', 'viewImage','left=50, top=50, width=600, height=600, scrollbars=no')\"></td>";}
                }
                ?>
		</tr>
		</table>
		<table class="zoom_next_prev">
		<tr>
			<td align=left><!-- <?=$prev_href?><img src='<?=$g4[shop_img_path]?>/prev.gif' border=0 title='<?=$prev_title?>'></a> --></td>
			<td align=center><img src="<?=$g4[shop_img_path]?>/btn_zoom.gif" onclick="javascript:win_open('./largeimage.php?it_id=<?=$it_id?>', 'viewImage','left=50, top=50, width=600, height=600, scrollbars=no')" style="cursor: pointer"></td>
			<td align=right><!-- <?=$next_href?><img src='<?=$g4[shop_img_path]?>/next.gif' border=0 title='<?=$next_title?>'></a> --></td>
		</tr>
		</table>
		</td>
		<td class="line_r">우측</td>
	</tr>
	<tr>
		<td class="line_bl">하단좌측</td>
		<td class="line_b">하단</td>
		<td class="line_br">하단우측</td>
	</tr>
	</table></td>
	<td valign=top>
		<h3 class="name_icon"><?=it_name_icon($it, stripslashes($it[it_name]), 1)?></h3>
		<form name=fitem method=post action="./cartupdate.php">
		<input type=hidden name=it_id value='<?=$it[it_id]?>'>
		<input type=hidden name=it_name value='<?=$it[it_name]?>'>
		<input type=hidden name=sw_direct>
		<input type=hidden name=url>
		<ul class="info_list">
			<? if ($score = get_star_image($it[it_id])) { ?>
			<li><label>고객선호도</label>: <img src='<?="$g4[shop_img_path]/star{$score}.gif"?>' border=0></li>
			<? } ?>
			<? if ($it[it_maker]) { ?>
			<li><label>제조사</label>: <?=$it[it_maker]?></li>
			<? } ?>
			<? if ($it[it_origin]) { ?>
			<li><label>원산지</label>: <?=$it[it_origin]?></li>
			<? } ?>
			<?
			// 선택옵션 출력
			for ($i=1; $i<=6; $i++)
			{
				// 옵션에 문자가 존재한다면
				$str = get_item_options(trim($it["it_opt{$i}_subject"]), trim($it["it_opt{$i}"]), $i);
				if ($str)
					echo "<li><label>".$it["it_opt{$i}_subject"]."</label>: $str</li>";
			}
			?>
			<? if (!$it[it_gallery]) { // 갤러리 형식이라면 가격, 구매하기 출력하지 않음 ?>
            <? if ($it[it_tel_inq]) { // 전화문의일 경우 ?>

                <li><label>판매가격</label>: 전화문의</li>
								<li class="end" style="text-align:center;"><span style="color:red;">배송비는 착불입니다.</span></li>

            <? } else { ?>

                <? if ($it[it_cust_amount]) { // 1.00.03 ?>
                <li><label>시중가격</label>: <input type=text name=disp_cust_amount style='text-align:right; border:none; border-width:0px; font-weight:bold;background-color:transparent; width:80px; color:#777777; text-decoration:line-through;' readonly value='<?=number_format($it[it_cust_amount])?>'> 원</li>
                <? } ?>


                <li><label>판매가격</label>: <input type=text name=disp_sell_amount style='text-align:right; border:none; border-width:0px; font-weight:bold;background-color:transparent; width:80px; font-family:Tahoma;' class=amount readonly> 원<input type=hidden name=it_amount value='0'><span style="color:red;"> VAT포함</span></li>

                <?
                /* 재고를 표시하는 경우 주석을 풀어주세요.
                <li><label>재고수량</label>:<?=number_format(get_it_stock_qty($it_id))?> 개</li>
                */
                ?>

                <? if ($config[cf_use_point]) { // 포인트 사용한다면 ?>
                <li><label>포인트</label>: <input type=text name=disp_point style='text-align:right; border:none; border-width:0px;;background-color:transparent; width:80px;' readonly> 점<input type=hidden name=it_point value='0'></li>
                <? } ?>

                <li><label>수량</label>: <input type=text name=ct_qty value='1' size=4 maxlength=4 class=ed autocomplete='off' style='text-align:right;' onkeyup='amount_change()'>
								<img src='<?=$g4[shop_img_path]?>/qty_control.gif' border=0 align=absmiddle usemap="#qty_control_map"> 개
								<? if (strlen($it[it_min_order]) > 0 && $it[it_min_order] > 0){ ?>
								&nbsp;&nbsp;최소수량 : <span style="font-weight:bold;color:red;"><?=$it[it_min_order]?></span>
								<? } ?>
								<? if (strlen($it[it_max_order]) > 0 && $it[it_max_order] > 0){ ?>
								&nbsp;&nbsp;최대수량 : <span style="font-weight:bold;color:red;"><?=$it[it_max_order]?></span>
								<? } ?>
								&nbsp;
								<map name="qty_control_map">
								<area shape="rect" coords="0, 0, 10, 9" href="javascript:qty_add(+1);">
								<area shape="rect" coords="0, 10, 10, 19" href="javascript:qty_add(-1);">
								</map></li>
								<li class="end" style="text-align:center;"><span style="color:red;">배송비는 착불입니다.</span></li>
            <? } ?>
			<?}?>
		</ul>
		<div class="btn_set">
            <? if (!$it[it_tel_inq] && !$it[it_gallery]) { ?>
            <a href="javascript:fitemcheck(document.fitem, 'direct_buy');"><img src='<?=$g4[shop_img_path]?>/btn2_now_buy.gif' border=0></a>
            <a href="javascript:fitemcheck(document.fitem, 'cart_update');"><img src='<?=$g4[shop_img_path]?>/btn2_cart.gif' border=0></a>
            <? } ?>

            <? if (!$it[it_gallery]) { ?>
            <a href="javascript:item_wish(document.fitem, '<?=$it[it_id]?>');"><img src='<?=$g4[shop_img_path]?>/btn2_wish.gif' border=0></a>
            <? } ?>
		</div>
		</form>
		<? if ($it[it_basic]) { ?><div class="it_basic"><?=$it[it_basic]?></div><? } ?>
	</td>
</tr>
</table>


<script language="JavaScript">
function item_wish(f, it_id)
{
    f.url.value = "<?=$g4[shop_path]?>/wishupdate.php?it_id="+it_id;
    f.action = "<?=$g4[shop_path]?>/wishupdate.php";
    f.submit();
}
</script>

<div class="item_tab">
	<a name="#item_explan">상품정보</a>
	<a name="#item_use">사용후기 (<span id=item_use_count>0</span>)</a>
	<a name="#item_qa">상품문의 (<span id=item_qa_count>0</span>)</a>
	<? if ($default[de_baesong_content]) { ?><a name="#item_baesong">배송정보</a><?}?>
	<? if ($default[de_change_content]) { ?><a name="#item_change">교환/반품</a><?}?>
	<a name="#item_relation">관련상품(<span id=item_relation_count>0</span>)</a>
</div> 

<script language="JavaScript">
$(document).ready(function(){
	$(".item_content > div").hide();
	showhide(0);
	$(".item_tab a").click(function(){
		var id = $(this).index();
		showhide(id);
	});
});

var de = 0;
function showhide(id){

	$(".item_content > div").eq(de).slideUp();
	$(".item_content > div").eq(id).slideDown();

	$(".item_tab a.this_tab").removeClass("this_tab");
	$(".item_tab > a").eq(id).addClass("this_tab");
	de = id;
	
	//set icon
	//var po_s = $(".item_tab > a:first").position();
	//var po_t = $(".item_tab > a:eq("+id+")").position();
	//var icon_left = po_t.left - po_s.left + (parseFloat($(".item_tab > a:eq("+id+")").css("width"))+42 -7)/2;
	//$("#thiscontent").animate({"left": icon_left}, "slow");
}
</script>

<div class="item_content">
<!-- 상품설명 -->
<div id='item_explan'><?=conv_content($it[it_explan], 1);?></div>
<!-- 상품설명 end -->

<?
	// 사용후기
	include_once("./itemuse.inc.php");


	// 상품문의
	include_once("./itemqa.inc.php");
?>


<? if ($default[de_baesong_content]) { // 배송정보 내용이 있다면 ?>
<div id='item_baesong'><?=conv_content($default[de_baesong_content], 1);?></div>
<? } ?>

<? if ($default[de_change_content]) { // 교환/반품 내용이 있다면 ?>
<div id='item_change'><?=conv_content($default[de_change_content], 1);?></div>
<? } ?>


<!-- 관련상품 -->
<div id='item_relation'>
        <?
        $list_mod   = $default[de_rel_list_mod];
        $img_width  = $default[de_rel_img_width];
        $img_height = $default[de_rel_img_height];
        $td_width = (int)(100 / $list_mod);

        $sql = " select b.*
                   from $g4[yc4_item_relation_table] a
                   left join $g4[yc4_item_table] b on (a.it_id2=b.it_id)
                  where a.it_id = '$it[it_id]'
                    and b.it_use='1' ";
        $result = sql_query($sql);
        $num = @mysql_num_rows($result);
        if ($num)
            include "$g4[shop_path]/maintype10.inc.php";
        else
            echo "이 상품과 관련된 상품이 없습니다.";
        ?>
</div>
<!-- 관련상품 end -->


</div>





 


<script language="JavaScript">
function qty_add(num)
{

    var f = document.fitem;
    var qty = parseInt(f.ct_qty.value);
		<? if($it[it_min_order] > 0) {?>
			if(<?=$it[it_min_order]?> > (qty + num)){
				alert("최소수량보다 작은 금액입니다.");
				f.ct_qty.value = <?=$it[it_min_order]?>;
				return ;
			}
		<? } ?>

		<? if(strlen($it[it_max_order]) > 0 && $it[it_max_order] != 0) {?>
			if(<?=$it[it_max_order]?> < (qty + num)){
				alert("최대수량보다 큰 금액입니다.");
				f.ct_qty.value = <?=$it[it_max_order]?>;
				return ;
			}
		<? } ?>


    if (num < 0 && qty <= 1)
    {
        alert("수량은 1 이상만 가능합니다.");
        qty = 1;
    }
    else if (num > 0 && qty >= 9999)
    {
        alert("수량은 9999 이하만 가능합니다.");
        qty = 9999;
    }
    else
    {
        qty = qty + num;
    }

    f.ct_qty.value = qty;

    amount_change();
}

function get_amount(data)
{
    var str = data.split(";");
    var num = parseInt(str[1]);
    if (isNaN(num)) {
        return 0;
    } else {
        return num;
    }
}

function amount_change()
{
		qty=fitem.ct_qty.value  ;
		<? if($it[it_min_order] > 0) {?>
			if(<?=$it[it_min_order]?> > (qty )){
			
				alert("최소수량보다 작은 금액입니다.");
				fitem.ct_qty.value = <?=$it[it_min_order]?>;
				return ;
			}
		<? } ?>

		<? if(strlen($it[it_max_order]) > 0 && $it[it_max_order] != 0) {?>
			if(<?=$it[it_max_order]?> < (qty)){
				alert("최대수량보다 큰 금액입니다.");
				fitem.ct_qty.value = <?=$it[it_max_order]?>;
				return ;
			}
		<? } ?>

    var basic_amount = parseInt('<?=get_amount($it)?>');
    var basic_point  = parseFloat('<?=$it[it_point]?>');
    var cust_amount  = parseFloat('<?=$it[it_cust_amount]?>');

    var f = document.fitem;
    var opt1 = 0;
    var opt2 = 0;
    var opt3 = 0;
    var opt4 = 0;
    var opt5 = 0;
    var opt6 = 0;
    var ct_qty = 0;

    if (typeof(f.ct_qty) != 'undefined')
        ct_qty = parseInt(f.ct_qty.value);

    if (typeof(f.it_opt1) != 'undefined') opt1 = get_amount(f.it_opt1.value);
    if (typeof(f.it_opt2) != 'undefined') opt2 = get_amount(f.it_opt2.value);
    if (typeof(f.it_opt3) != 'undefined') opt3 = get_amount(f.it_opt3.value);
    if (typeof(f.it_opt4) != 'undefined') opt4 = get_amount(f.it_opt4.value);
    if (typeof(f.it_opt5) != 'undefined') opt5 = get_amount(f.it_opt5.value);
    if (typeof(f.it_opt6) != 'undefined') opt6 = get_amount(f.it_opt6.value);

    var amount = basic_amount + opt1 + opt2 + opt3 + opt4 + opt5 + opt6;
    var point  = parseInt(basic_point);

    if (typeof(f.it_amount) != 'undefined')
        f.it_amount.value = amount;

    if (typeof(f.disp_sell_amount) != 'undefined')
        f.disp_sell_amount.value = number_format(String(amount * ct_qty));

    if (typeof(f.disp_cust_amount) != 'undefined')
        f.disp_cust_amount.value = number_format(String(cust_amount * ct_qty));

    if (typeof(f.it_point) != 'undefined') {
        f.it_point.value = point;
        f.disp_point.value = number_format(String(point * ct_qty));
    }
}

<? if (!$it[it_gallery]) { 
		if($it[it_min_order] > 0) { 
			echo "fitem.ct_qty.value='".$it[it_min_order]."';";
		} 
		echo "amount_change();"; 
	} // 처음시작시 한번 실행 ?>

// 바로구매 또는 장바구니 담기
function fitemcheck(f, act)
{
    // 판매가격이 0 보다 작다면
    if (f.it_amount.value < 0)
    {
        alert("전화로 문의해 주시면 감사하겠습니다.");
        return;
    }

    for (i=1; i<=6; i++)
    {
        if (typeof(f.elements["it_opt"+i]) != 'undefined')
        {
            if (f.elements["it_opt"+i].value == '선택') {
                alert(f.elements["it_opt"+i+"_subject"].value + '을(를) 선택하여 주십시오.');
                f.elements["it_opt"+i].focus();
                return;
            }
        }
    }

    if (act == "direct_buy") {
        f.sw_direct.value = 1;
    } else {
        f.sw_direct.value = 0;
    }

    if (!f.ct_qty.value) {
        alert("수량을 입력해 주십시오.");
        f.ct_qty.focus();
        return;
    } else if (isNaN(f.ct_qty.value)) {
        alert("수량을 숫자로 입력해 주십시오.");
        f.ct_qty.select();
        f.ct_qty.focus();
        return;
    } else if (parseInt(f.ct_qty.value) < 1) {
        alert("수량은 1 이상 입력해 주십시오.");
        f.ct_qty.focus();
        return;
    }

    amount_change();

    f.submit();
}

function addition_write(element_id)
{
    if (element_id.style.display == 'none') { // 안보이면 보이게 하고
        element_id.style.display = 'block';
    } else { // 보이면 안보이게 하고
        element_id.style.display = 'none';
    }
}


var save_use_id = null;
function use_menu(id)
{
    if (save_use_id != null)
        document.getElementById(save_use_id).style.display = "none";
    menu(id);
    save_use_id = id;
}

var save_qa_id = null;
function qa_menu(id)
{
    if (save_qa_id != null)
        document.getElementById(save_qa_id).style.display = "none";
    menu(id);
    save_qa_id = id;
}

if (document.getElementById("item_use_count"))
    document.getElementById("item_use_count").innerHTML = "<?=$use_total_count?>";
if (document.getElementById("item_qa_count"))
    document.getElementById("item_qa_count").innerHTML = "<?=$qa_total_count?>";
if (document.getElementById("item_relation_count"))
    document.getElementById("item_relation_count").innerHTML = "<?=$item_relation_count?>";

// 상품상세설명에 있는 이미지의 사이즈를 줄임
function explan_resize_image()
{
    var image_width = 600;
    var div_explan = document.getElementById('div_explan');
    if (div_explan) {
        var explan_img = div_explan.getElementsByTagName('img');
        for(i=0;i<explan_img.length;i++)
        {
            //document.write(explan_img[i].src+"<br>");
            img = explan_img[i];
            if (img.width) {
                imgx = parseInt(img.width);
                imgy = parseInt(img.height);
            }
            else {
                imgx = parseInt(img.style.width);
                imgy = parseInt(img.style.height);
            }
            if (imgx > image_width)
            {
                image_height = parseFloat(imgx / imgy)
                if (img.width) {
                    img.width = image_width;
                    img.height = parseInt(image_width / image_height);
                }
                else {
                    img.style.width = image_width;
                    img.style.height = parseInt(image_width / image_height);
                }
            }
            /*
            // 이미지를 가운데로 정렬하는 경우에 주석을 풀어줌
            img.style.position = 'relative';
            img.style.left = '50%';
            img.style.marginLeft = '-300px'; // image_width 의 절반
            */
        }
    }
}
</script>

<script type="text/javascript">
var md5_norobot_key = '';

$(function() {
    $.ajax({
        type: 'POST',
        url: g4_path+'/'+g4_bbs+'/kcaptcha_session.php',
        cache: false,
        async: false,
        success: function(text) {
            $('#kcaptcha_image_use, #kcaptcha_image_qa').attr('src', g4_path+'/'+g4_bbs+'/kcaptcha_image.php?t=' + (new Date).getTime());
            md5_norobot_key = text;
        }
    });

    /*
    $('#kcaptcha_image_use, #kcaptcha_image_qa').bind('click', function() {
        var $fld = $(this);
        $.ajax({
            type: 'POST',
            url: g4_path+'/'+g4_bbs+'/kcaptcha_session.php',
            cache: false,
            async: false,
            success: function(text) {
                $fld.attr('src', g4_path+'/'+g4_bbs+'/kcaptcha_image.php?t=' + (new Date).getTime());
                md5_norobot_key = text;
            }
        });
    })
    .css('cursor', 'pointer')
    .attr('title', '글자가 잘 안보이시는 경우 클릭하시면 새로운 글자가 나옵니다.')
    .attr('width', '120')
    .attr('height', '60')
    .trigger('click');
    */


    explan_resize_image();
});
</script>

<script type="text/javascript" src="<?=$g4[path]?>/js/jquery.kcaptcha.js"></script>
<script type="text/javascript">
$(function() {
    $("#kcaptcha_image_use, #kcaptcha_image_qa").bind("click", function() {
        $.ajax({
            type: 'POST',
            url: g4_path+'/'+g4_bbs+'/kcaptcha_session.php',
            cache: false,
            async: false,
            success: function(text) {
                $("#kcaptcha_image_use, #kcaptcha_image_qa").attr('src', g4_path+'/'+g4_bbs+'/kcaptcha_image.php?t=' + (new Date).getTime());
            }
        });
    })
    .css('cursor', 'pointer')
    .attr('title', '글자가 잘 안보이시는 경우 클릭하시면 새로운 글자가 나옵니다.')
    .attr('width', '120')
    .attr('height', '60')
    .trigger('click');

    explan_resize_image();
});
</script>

<?
if ($is_admin)
    echo "<p align=center><a href='$g4[shop_admin_path]/itemform.php?w=u&it_id=$it_id'><img src='$g4[shop_img_path]/btn_admin_modify.gif' border=0></a></p>";

// 하단 HTML
echo stripslashes($it[it_tail_html]);

$timg = "$g4[path]/data/item/{$it_id}_t";
if (file_exists($timg))
    echo "<img src='$timg' border=0><br>";

if ($ca[ca_include_tail])
    @include_once($ca[ca_include_tail]);
else
    include_once("./_tail.php");
?>
