<?
include_once("./_common.php");

// 브라우저에서 쿠키를 허용하지 않은 경우라고 볼 수 있음.
$tmp_on_uid = get_session('ss_on_uid');
if (!$tmp_on_uid) 
{
    alert("더 이상 작업을 진행할 수 없습니다.\\n\\n브라우저의 쿠키 허용을 사용하지 않음으로 설정한것 같습니다.\\n\\n브라우저의 인터넷 옵션에서 쿠키 허용을 사용으로 설정해 주십시오.\\n\\n그래도 진행이 되지 않는다면 쇼핑몰 운영자에게 문의 바랍니다.");
}


// 레벨(권한)이 상품구입 권한보다 작다면 상품을 구입할 수 없음.
if ($member[mb_level] < $default[de_level_sell]) 
{
    alert("상품을 구입할 수 없습니다.\\n\\n회원제로 운영되고 있습니다.",$g4[path]."/bbs/login.php");
}


if ($w == "d") // 삭제이면
{    
    $sql = " delete from $g4[yc4_cart_table]
              where ct_id = '$ct_id'
                and on_uid = '$tmp_on_uid' ";
    sql_query($sql);
} 
else if ($w == "alldelete") // 모두 삭제이면
{    
    $sql = " delete from $g4[yc4_cart_table]
              where on_uid = '$tmp_on_uid' ";
    sql_query($sql);
} 
else if ($w == "allupdate") // 수량 변경이면 : 모두 수정이면
{	
    $fldcnt = count($_POST[ct_id]);

    // 수량 변경, 재고등을 검사
    $error = "";
	for ($i=0; $i<$fldcnt; $i++) 
    {
        // 재고 구함 
        $stock_qty = get_it_stock_qty($_POST[it_id][$i]);

        // 변경된 수량이 재고수량보다 크면 오류
        if ($_POST[ct_qty][$i] > $stock_qty)
            $error .= "{$_POST[it_name][$i]} 의 재고수량이 부족합니다. 현재 재고수량 : $stock_qty 개\\n\\n";
    }

    // 오류가 있다면 오류메세지 출력
    if ($error != "") { alert($error); }

	for ($i=0; $i<$fldcnt; $i++) 
    {
        $sql = " update $g4[yc4_cart_table]
                    set ct_qty = '{$_POST[ct_qty][$i]}'
                  where ct_id  = '{$_POST[ct_id][$i]}'
                    and on_uid = '$tmp_on_uid' ";
        sql_query($sql);
    }
} 
else if ($w == "multi") // 온라인견적(등)에서 여러개의 상품이 한꺼번에 들어옴.
{
    // 보관함에서 금액이 제대로 반영되지 않던 오류를 수정
    $fldcnt = count($_POST[it_name]);

    // 재고등을 검사
    $error = "";
	for ($i=0; $i<$fldcnt; $i++) 
    {
        if ($_POST[it_id][$i] == "" || $_POST[ct_qty][$i] <= 0) { continue; }

        // 비회원가격과 회원가격이 다르다면
        if (!$is_member && $default[de_different_msg])
        {
            $sql = " select it_amount, it_amount2 from $g4[yc4_item_table] where it_id = '{$_POST[it_id][$i]}' ";
            $row = sql_fetch($sql);
            if ($row[it_amount2] && $row[it_amount] != $row[it_amount2]) {
                $error .= "\"{$_POST[it_name][$i]}\" 의 비회원가격과 회원가격이 다릅니다. 로그인 후 구입하여 주십시오.\\n\\n";
            }
        }

        // 이미 장바구니에 있는 같은 상품의 수량합계를 구한다.
        $sql = " select SUM(ct_qty) as cnt from $g4[yc4_cart_table] where it_id = '{$_POST[it_id][$i]}' and on_uid = '$tmp_on_uid' ";
        $row = sql_fetch($sql);
        $sum_qty = $row[cnt];

        // 재고 구함
        $it_stock_qty = get_it_stock_qty($_POST[it_id][$i]);
        if ($_POST[ct_qty][$i] + $sum_qty > $it_stock_qty) {
            $error .= "{$_POST[it_name][$i]} 의 재고수량이 부족합니다. 현재 재고수량 : $it_stock_qty\\n\\n";
        }
    }
	
    // 오류가 있다면 오류메세지 출력
    if ($error != "") { alert($error); }

	for ($i=0; $i<$fldcnt; $i++) 
    {
        if ($_POST[it_id][$i] == "" || $_POST[ct_qty][$i] <= 0) continue;

        // 포인트 사용하지 않는다면
        if (!$config[cf_use_point]) $_POST[it_point][$i] = 0;

        // 장바구니에 Insert
        $sql = " insert $g4[yc4_cart_table]
                    set on_uid       = '$tmp_on_uid',
                        it_id        = '{$_POST[it_id][$i]}',
                        ct_status    = '쇼핑',
                        ct_amount    = '{$_POST[it_amount][$i]}',
                        ct_point     = '{$_POST[it_point][$i]}',
                        ct_point_use = '0',
                        ct_stock_use = '0',
                        ct_qty       = '{$_POST[ct_qty][$i]}',
                        ct_time      = '$g4[time_ymdhis]',
                        ct_ip        = '$REMOTE_ADDR' ";
        sql_query($sql);
    }
}
else // 장바구니에 담기
{
    if (!$_POST[it_id])
        alert("장바구니에 담을 상품을 선택하여 주십시오.");

    if ($_POST[ct_qty] < 1)
        alert("수량은 1 이상 입력해 주십시오.");

    // 비회원가격과 회원가격이 다르다면
    if (!$is_member && $default[de_different_msg])
    {
        $sql = " select it_amount, it_amount2 from $g4[yc4_item_table] where it_id = '$_POST[it_id]' ";
        $row = sql_fetch($sql);
        if ($row[it_amount2] && $row[it_amount] != $row[it_amount2]) {
            echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$g4[charset]\">";
            echo "<script>alert('비회원가격과 회원가격이 다릅니다. 로그인 후 구입하여 주십시오.');</script>";
        }
    }

    //--------------------------------------------------------
    //  재고 검사
    //--------------------------------------------------------
    // 이미 장바구니에 있는 같은 상품의 수량합계를 구한다.
    $sql = " select SUM(ct_qty) as cnt from $g4[yc4_cart_table] 
              where it_id = '$_POST[it_id]' 
                and on_uid = '$tmp_on_uid' ";
    $row = sql_fetch($sql);
    $sum_qty = $row[cnt];

    // 재고 구함
    $it_stock_qty = get_it_stock_qty($_POST[it_id]);
    if ($ct_qty + $sum_qty > $it_stock_qty) 
    {
        alert("$it_name 의 재고수량이 부족합니다.\\n\\n현재 재고수량 : " . number_format($it_stock_qty) . " 개");
    }
    //--------------------------------------------------------

    // 포인트 사용하지 않는다면
    if (!$config[cf_use_point]) { $_POST[it_point] = 0; }

    // 장바구니에 Insert
    $sql = " insert $g4[yc4_cart_table]
                set on_uid       = '$tmp_on_uid',
                    it_id        = '$_POST[it_id]',
                    it_opt1      = '$_POST[it_opt1]',
                    it_opt2      = '$_POST[it_opt2]',
                    it_opt3      = '$_POST[it_opt3]',
                    it_opt4      = '$_POST[it_opt4]',
                    it_opt5      = '$_POST[it_opt5]',
                    it_opt6      = '$_POST[it_opt6]',
                    ct_status    = '쇼핑',
                    ct_amount    = '$_POST[it_amount]',
                    ct_point     = '$_POST[it_point]',
                    ct_point_use = '0',
                    ct_stock_use = '0',
                    ct_qty       = '$_POST[ct_qty]',
                    ct_time      = '$g4[time_ymdhis]',
                    ct_ip        = '$REMOTE_ADDR' ";
    sql_query($sql);
}

// 바로 구매일 경우
if ($sw_direct) 
{
    if ($member[mb_id]) 
    {
    	goto_url("./orderform.php");
    } 
    else 
    {
    	goto_url("$g4[bbs_path]/login.php?url=".urlencode("$g4[shop_path]/orderform.php"));
    }
} 
else 
{
    goto_url("./cart.php");
}
?>
