<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" href="<?=$member_skin_path?>/style.css" type="text/css">
<div class="ck_memo_warp">
<h1 class="title"><span>MY</span> MEMO</h1>
<div class="ck_memo_tab">
<a href="./memo.php?kind=recv">받은 쪽지</a>
<a href="./memo.php?kind=send">보낸 쪽지</a>
<a href="./memo_form.php">쪽지보내기</a>
<a href="<?=$next_link?>" class="ck_memo_next"><!-- 다음 --></a>
<a href="<?=$prev_link?>" class="ck_memo_prev"><!-- 이전 --></a>
</div>
<div class="ck_box">
<p><?
        //$nick = cut_str($mb[mb_nick], $config[cf_cut_name]);
        $nick = get_sideview($mb[mb_id], $mb[mb_nick], $mb[mb_email], $mb[mb_homepage]);
        if ($kind == "recv")
            echo "<b>$nick</b> 님께서 {$memo[me_send_datetime]}에 보내온 쪽지의 내용입니다.";

        if ($kind == "send") 
            echo "<b>$nick</b> 님께 {$memo[me_send_datetime]}에 보낸 쪽지의 내용입니다."; 
        ?></p>

<div class="ck_memo_view"><?=conv_content($memo[me_memo], 0)?></div>


	<a href="javascript:window.close();" class="btn_close">창닫기</a>
</div>
</div>
