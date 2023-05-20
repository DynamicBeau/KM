<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<div class="sort">
		<select id=it_sort name=sort onchange="if (this.value=='') return; document.location = '<? echo "$_SERVER[PHP_SELF]?ca_id=$ca_id&skin=$skin&ev_id=$ev_id&b=$b&sort=" ?>'+this.value;" class=small>
							<option value=''>출력 순서</option>
							<option value='it_amount asc'>낮은가격순</option>
							<option value='it_amount desc'>높은가격순</option>
							<option value='it_name asc'>상품명순</option>
							<option value='it_type1 desc'>히트상품</option>
							<option value='it_type2 desc'>추천상품</option>
							<option value='it_type3 desc'>최신상품</option>
							<option value='it_type4 desc'>인기상품</option>
							<option value='it_type5 desc'>할인상품</option>
		</select>
		<!-- <select id=b name=b onchange="if (this.value=='') return; document.location = '<? echo "$_SERVER[PHP_SELF]?ca_id=$ca_id&skin=$skin&ev_id=$ev_id&sort=$sort&b=" ?>'+this.value;" class=small>
							<option value=''>업체별</option>
							<option value='GE'>GE</option>
							<option value='밀레'>밀레</option>
							<option value='지멘스'>지멘스</option>
							<option value='일렉트로룩스'>일렉트로룩스</option>
							<option value='벤타AND메직볼'>벤타AND메직볼</option>
							<option value='리페르'>리페르</option>
							<option value='메직쉐프'>메직쉐프</option>
							<option value='헬러'>헬러</option>
							<option value='기타'>기타</option>
		</select> -->
	<span class=point><b><? echo number_format($total_count) ?></b></span>개의 상품이 있습니다.
</div>

<script language='JavaScript'>
document.getElementById('it_sort').value="<?=$sort?>";
if(document.getElementById('b')){
	document.getElementById('b').value="<?=$b?>";
}

</script>
