<?
include_once("./_common.php");

if (!$is_member)
    goto_url("$g4[path]/bbs/login.php?url=".urlencode("$g4[shop_path]/mypage.php"));

$g4[title] = "마이페이지";
include_once("./_head.php");

//$str = $g4[title];
//include("./navigation2.inc.php");
?>

<div class="page_title"><img src="<?=$g4[shop_img_path]?>/top_mypage.gif" border=0></div>
<div style="">
<div class="mypage_top">
	<span><strong><?=$member[mb_name]?></strong> 님의 마이페이지입니다.</span>
	<? if ($is_admin == 'super') { echo "<a href='$g4[admin_path]/'>관리자</a>"; } ?>
	<a href='<?=$g4[bbs_path]?>/member_confirm.php?url=register_form.php'>정보수정</a>
	<a href="javascript:member_leave();">회원탈퇴</a>
</div> 
<p class="shadow"></p>

<ul class="mypage_info">
	<li><label>보유포인트</label><a href="javascript:win_point();"><?=number_format($member[mb_point])?>점</a></li>
	<li><label>쪽지함</label><a href="javascript:win_memo();">쪽지보기</a></li>
	<li><label>주소</label><?=sprintf("(%s-%s) %s %s", $member[mb_zip1], $member[mb_zip2], $member[mb_addr1], $member[mb_addr2]);?></li>
	<li><label>회원권한</label><?=$member[mb_level]?></li>
	<li><label>연락처</label><?=$member[mb_tel]?></li>
	<li><label>최종접속일시</label><?=$member[mb_today_login]?></li>
	<li><label>E-mail</label><?=$member[mb_email]?></li>
	<li><label>회원가입일시</label><?=$member[mb_datetime]?></li>
</ul>


<div class="mypage_list_title"><a href='./orderinquiry.php'>최근주문내역</a></div>

<?
// 최근 주문내역
define("_ORDERINQUIRY_", true);

$limit = " limit 0, 5 ";
include "$g4[shop_path]/orderinquiry.sub.php";
?>
<div class="mypage_list_title"><a href='./wishlist.php'>최근보관내역</a></div>
 

<table class="table_style1">
	<colgroup>
		<col width="60px" />
		<col width="" />
		<col width="120px" />
	</colgroup>
	<tr>
		<th>이미지</th>
		<th>상품명</th>
		<th>보관일시</th>
	</tr>
<?
$sql = " select * 
           from $g4[yc4_wish_table] a, 
                $g4[yc4_item_table] b
          where a.mb_id = '$member[mb_id]'
            and a.it_id  = b.it_id
          order by a.wi_id desc 
          limit 0, 3 ";
$result = sql_query($sql);
for ($i=0; $row = sql_fetch_array($result); $i++) 
{

    $image = get_it_image($row[it_id]."_s", 50, 50, $row[it_id]);

    echo "<tr>";
    echo "<td>$image</td>";
    echo "<td><a href='./item.php?it_id=$row[it_id]'>".stripslashes($row[it_name])."</a></td>";
    echo "<td>$row[wi_time]</td>";
    echo "</tr>";
}

if ($i == 0)
    echo "<tr><td colspan=3  style='text-align:center; padding:60px;'>보관 내역이 없습니다.</td></tr>";
?>
</table>



<script type="text/javascript">
function member_leave() 
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?")) 
            location.href = "<?=$g4[bbs_path]?>/member_confirm.php?url=member_leave.php";
}
</script>

<?
include_once("./_tail.php");
?>
