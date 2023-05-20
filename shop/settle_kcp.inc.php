<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

if ($default['de_kcp_mid'] == 'T0007')                       
{
    $default['de_kcp_site_key'] = '2.mDT7R4lUIfHlHq4byhYjf__';
    if (strtolower($g4['charset']) == 'utf-8')
        $js_url = "https://pay.kcp.co.kr/plugin/payplus_test_un.js";
    else
        $js_url = "https://pay.kcp.co.kr/plugin/payplus_test.js";
    //$js_url = "http://testpay.kcp.co.kr/plugin/payplus.js";
}
else
{
    if (strtolower($g4['charset']) == 'utf-8')
        $js_url = "https://pay.kcp.co.kr/plugin/payplus_un.js";
    else
        $js_url = "https://pay.kcp.co.kr/plugin/payplus.js";
}
?>

<script language='javascript' src='<?=$js_url?>'></script>
<script language='javascript'>
// 플러그인 설치(확인)
StartSmartUpdate();

function OpenWindow() 
//function jsf__pay( form )
{
    var form = document.order_info;

    if( document.Payplus.object == null ) {
        openwin = window.open( './kcp/chk_plugin.html', 'chk_plugin', 'width=420, height=100, top=300, left=300' );
    }

    if ( MakePayMessage( form ) == true ) {
        openwin = window.open( './kcp/proc_win.html', 'proc_win', 'width=420, height=100, top=300, left=300' );
        form.submit();
    }
}
</script>

<form name="order_info" method="post" action='./kcp/pp_ax_hub.php'>
<!-- 사용자 변수 -->
<input type=hidden name='d_url'         value='<?=$g4['url']?>'>
<input type=hidden name='shop_dir'      value='<?=$g4['shop']?>'>
<input type=hidden name='on_uid'        value='<?=$_SESSION['ss_temp_on_uid']?>'>

<?
switch ($settle_case)
{
    case '계좌이체' :
        $settle_method = "010000000000";
        break;
    case '가상계좌' :
        $settle_method = "001000000000";
        break;
    default : // 신용카드
        $settle_method = "100000000000";
        break;
}
?>
<input type=hidden name='pay_method'    value='<?=$settle_method?>'>
<input type=hidden name='currency'      value='WON'>
<input type=hidden name='good_name'     value='<?=$goods?>'>
<input type=hidden name='good_mny'      value='<?=$settle_amount?>'>
<input type=hidden name='buyr_name'     value='<?=addslashes($od['od_name'])?>' >
<input type=hidden name='buyr_mail'     value='<?=$od['od_email']?>'>
<input type=hidden name='buyr_tel1'     value='<?=$od['od_tel']?>'>
<input type=hidden name='buyr_tel2'     value='<?=$od['od_hp']?>'>

<input type=hidden name='quotaopt'      value='12'>

<input type=hidden name='rcvr_name'     value='<?=addslashes($od['od_b_name'])?>'>
<input type=hidden name='rcvr_tel1'     value='<?=$od['od_b_tel']?>'>
<input type=hidden name='rcvr_tel2'     value='<?=$od['od_b_hp']?>'>
<input type=hidden name='rcvr_mail'     value='<?=$od['od_email']?>'>
<input type=hidden name='rcvr_zipx'     value='<?=$od['od_b_zip1'].$od['od_b_zip2']?>'>
<input type=hidden name='rcvr_add1'     value='<?=addslashes($od['od_b_addr1'])?>'>
<input type=hidden name='rcvr_add2'     value='<?=addslashes($od['od_b_addr2'])?>'>

<?
$good_info = "";
$sql = " select a.ct_id,
                a.it_opt1,
                a.it_opt2,
                a.it_opt3,
                a.it_opt4,
                a.it_opt5,
                a.it_opt6,
                a.ct_amount,
                a.ct_point,
                a.ct_qty,
                a.ct_status,
                b.it_id,
                b.it_name,
                b.ca_id
           from $g4[yc4_cart_table] a, 
                $g4[yc4_item_table] b
          where a.on_uid = '$s_on_uid'
            and a.it_id  = b.it_id
          order by a.ct_id ";
$result = sql_query($sql);
for ($i=1; $row=mysql_fetch_array($result); $i++) 
{
    if ($i>1)
        $good_info .= chr(30);
    $good_info .= "seq=".$i.chr(31);
    $good_info .= "ordr_numb={$od['od_id']}_".sprintf("%04d", $i).chr(31);
    $good_info .= "good_name=".addslashes($row['it_name']).chr(31);
    $good_info .= "good_cntx=".$row['ct_qty'].chr(31);
    $good_info .= "good_amtx=".$row['ct_amount'].chr(31);
}
?>

<!-- 필수 항목 -->

<!-- 요청종류 승인(pay)/취소,매입(mod) 요청시 사용 -->
<input type='hidden' name='req_tx'    value='pay'>
<!-- 테스트 결제시 : T0007 으로 설정, 리얼 결제시 : 부여받은 사이트코드 입력 -->
<input type='hidden' name='site_cd'   value='<?=$default['de_kcp_mid']?>'>

<!-- MPI 결제창에서 사용 한글 사용 불가 -->
<input type='hidden' name='site_name' value='YoungCart'>
<!-- http://testpay.kcp.co.kr/Pay/Test/site_key.jsp 로 접속하신후 부여받은 사이트코드를 입력하고 나온 값을 입력하시기 바랍니다. -->
<input type='hidden' name='site_key'  value='<?=$default['de_kcp_site_key']?>'>

<!-- 필수 항목 : PULGIN 설정 정보 변경하지 마세요 -->
<input type='hidden' name='module_type' value='01'>

<input type='hidden' name='ordr_idxx' value='<?=$od['od_id']?>'>

<!-- 에스크로 항목 -->

<!-- 에스크로 사용 여부 : 반드시 Y 로 세팅 -->
<input type='hidden' name='escw_used' value='Y'>

<!-- 에스크로 결제처리 모드 : 에스크로: Y, 일반: N, KCP 설정 조건: O -->
<input type='hidden' name='pay_mod' value='O'>

<!-- 배송 소요일 : 예상 배송 소요일을 입력 -->
<input type='hidden' name='deli_term' value='03'>

<!-- 장바구니 상품 개수 : 장바구니에 담겨있는 상품의 개수를 입력 -->
<input type='hidden' name='bask_cntx' value='<?=(int)($goods_count+1)?>'>

<!-- 장바구니 상품 상세 정보 (자바 스크립트 샘플(create_goodInfo()) 참고) -->
<input type='hidden' name='good_info' value='<?=$good_info?>'>

<!-- 필수 항목 : PLUGIN에서 값을 설정하는 부분으로 반드시 포함되어야 합니다. ※수정하지 마십시오.-->
<input type='hidden' name='res_cd'         value=''>
<input type='hidden' name='res_msg'        value=''>
<input type='hidden' name='tno'            value=''>
<input type='hidden' name='trace_no'       value=''>
<input type='hidden' name='enc_info'       value=''>
<input type='hidden' name='enc_data'       value=''>
<input type='hidden' name='ret_pay_method' value=''>
<input type='hidden' name='tran_cd'        value=''>
<input type='hidden' name='bank_name'      value=''>
<input type='hidden' name='use_pay_method' value=''>

<!-- 현금영수증 등록 창을 출력 여부 셋팅 - 5000원 이상 금액에만 보여지게 됩니다.-->
<input type="hidden" name="disp_tax_yn"           value="N">
<!-- 현금영수증 관련 정보 : PLUGIN 에서 내려받는 정보입니다 -->
<input type="hidden" name="cash_tsdtime"          value="">
<input type="hidden" name="cash_yn"               value="">
<input type="hidden" name="cash_authno"           value="">
<input type="hidden" name="cash_tr_code"          value="">
<input type="hidden" name="cash_id_info"          value="">

<!-- 계좌이체 서비스사 구분 -->
<input type="hidden" name="bank_issu"      value="">
</form>
