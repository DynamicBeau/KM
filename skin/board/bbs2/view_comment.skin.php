<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<script type="text/javascript">
// 글자수 제한
var char_min = parseInt(<?=$comment_min?>); // 최소
var char_max = parseInt(<?=$comment_max?>); // 최대
</script>

<h4 class="comment_title">Comment</h4>
<!-- 코멘트 리스트 -->
<div id="commentContents">
<?
for ($i=0; $i<count($list); $i++) {
    $comment_id = $list[$i][wr_id];
?>
<a name="c_<?=$comment_id?>"></a>
<div class="commentBox" style="margin-left:<?=strlen($list[$i][wr_comment_reply])*15?>px;">
	<div class="commentInfo">
		<?=$list[$i][name]?>
		<span class="datetime"><?=$list[$i][datetime]?></span>
		<? if ($is_ip_view) { echo "<span class='ipaddr'>({$list[$i][ip]})</span>"; } ?>
			<? if ($list[$i][is_reply]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'c');\" class='co_button'><img src='$board_skin_path/img/co_btn_reply.gif' border=0 align=absmiddle alt='답변'></a>"; } ?>
			<? if ($list[$i][is_edit]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'cu');\" class='co_button'><img src='$board_skin_path/img/co_btn_modify.gif' border=0 align=absmiddle alt='수정'></a>"; } ?>
			<? if ($list[$i][is_del])  { echo "<a href=\"javascript:comment_delete('{$list[$i][del_link]}');\" class='co_button'><img src='$board_skin_path/img/co_btn_delete.gif' border=0 align=absmiddle alt='삭제'></a>"; } ?>
	</div>
	<div class="commentContent">
		<?
			$str = $list[$i][content];
			if (strstr($list[$i][wr_option], "secret"))
			$str = "<span class='secret'>* $str</span>";

			$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
			$str = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src='$1://$2.$3' id='target_resize_image[]' onclick='image_window(this);' border='0'>", $str);
			echo $str;
			?>
			<? if ($list[$i][trackback]) { echo "<p>".$list[$i][trackback]."</p>"; } ?>
			<span id='edit_<?=$comment_id?>' style='display:none;'></span><!-- 수정 -->
			<span id='reply_<?=$comment_id?>' style='display:none;'></span><!-- 답변 -->
	</div>
		<input type=hidden id='secret_comment_<?=$comment_id?>' value="<?=strstr($list[$i][wr_option],"secret")?>">
		<textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?=get_text($list[$i][content1], 0)?></textarea>
</div>
<? } ?>
</div>
<!-- 코멘트 리스트 -->

<? if ($is_comment_write) { ?>
<!-- 코멘트 입력 -->
<div id=comment_write style="display:none;">
<form name="fviewcomment" method="post" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off" style="margin:0px;">
<input type=hidden name=w           id=w value='c'>
<input type=hidden name=bo_table    value='<?=$bo_table?>'>
<input type=hidden name=wr_id       value='<?=$wr_id?>'>
<input type=hidden name=comment_id  id='comment_id' value=''>
<input type=hidden name=sca         value='<?=$sca?>' >
<input type=hidden name=sfl         value='<?=$sfl?>' >
<input type=hidden name=stx         value='<?=$stx?>'>
<input type=hidden name=spt         value='<?=$spt?>'>
<input type=hidden name=page        value='<?=$page?>'>
<input type=hidden name=cwin        value='<?=$cwin?>'>
<input type=hidden name=is_good     value=''>
<input type=hidden id="wr_secret" name="wr_secret" value=""> 

<div class="wr_content">
	<textarea id="wr_content" class="textareabox" name="wr_content" rows=4 itemname="내용" required <? if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?}?> ></textarea>
<? if ($comment_min || $comment_max) { ?><script type="text/javascript"> check_byte('wr_content', 'char_count'); </script><?}?>
</div>

<div class="comment_w_info">
        <? if ($is_guest) { ?>
            <label>이름</label> <input type=text maxLength=20 name="wr_name" itemname="이름" required class=inputbox>
            <label>패스워드</label> <input type=password maxLength=20 name="wr_password" itemname="패스워드" required class=inputbox>
            <img id='kcaptcha_image' />
            <input title="왼쪽의 글자를 입력하세요." type="input" name="wr_key" itemname="자동등록방지" required class=inputbox>
        <? } ?>
		<div class="comment_w_option">
			<img src="<?=$board_skin_path?>/img/up.gif" onclick="textarea_decrease('wr_content', 4);"><img src="<?=$board_skin_path?>/img/start.gif" onclick="textarea_original('wr_content', 4);"><img src="<?=$board_skin_path?>/img/down.gif" onclick="textarea_increase('wr_content', 4);">
			<img src="<?=$board_skin_path?>/img/icon_secret_off.gif" alt="secret" onclick="btn_secret(this);">
			<? if ($comment_min || $comment_max) { ?><span id=char_count></span>글자<?}?>
		</div>
		<input type="image" src="<?=$board_skin_path?>/img/co_btn_write.gif" border=0 class="comment_submit" accesskey='s'>
</div>
</form>

</div>

<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
//
function btn_secret(t){
	var s= document.getElementById("wr_secret");
	if(s.value == ""){
		s.value = "secret";
		t.src = "<?=$board_skin_path?>/img/icon_secret_on.gif";
	}else{
		s.value = "";
		t.src = "<?=$board_skin_path?>/img/icon_secret_off.gif";
	}
}
//
var save_before = '';
var save_html = document.getElementById('comment_write').innerHTML;

function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    /*
    var s;
    if (s = word_filter_check(document.getElementById('wr_content').value))
    {
        alert("내용에 금지단어('"+s+"')가 포함되어있습니다");
        document.getElementById('wr_content').focus();
        return false;
    }
    */

    var subject = "";
    var content = "";
    $.ajax({
        url: "<?=$board_skin_path?>/ajax.filter.php",
        type: "POST",
        data: {
            "subject": "",
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        f.wr_content.focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("코멘트는 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("코멘트는 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("코멘트를 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('이름이 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('패스워드가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    return true;
}

jQuery.fn.extend({
    kcaptcha_load: function() {
        $.ajax({
            type: 'POST',
            url: g4_path+'/'+g4_bbs+'/kcaptcha_session.php',
            cache: false,
            async: false,
            success: function(text) {
                $('#kcaptcha_image')
                    .attr('src', g4_path+'/'+g4_bbs+'/kcaptcha_image.php?t=' + (new Date).getTime())
                    .css('cursor', '')
                    .attr('title', '');
                md5_norobot_key = text;
            }
        });
    }
});

function comment_box(comment_id, work)
{
    var el_id;
    // 코멘트 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'comment_write';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // 코멘트 수정
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('wr_secret').checked = true;
            else
                document.getElementById('wr_secret').checked = false;
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        save_before = el_id;
    }

    if (typeof(wrestInitialized) != 'undefined')
        wrestInitialized();

    jQuery(this).kcaptcha_load();
}

function comment_delete(url)
{
    if (confirm("이 코멘트를 삭제하시겠습니까?")) location.href = url;
}

comment_box('', 'c'); // 코멘트 입력폼이 보이도록 처리하기위해서 추가 (root님)
</script>
<? } ?>
