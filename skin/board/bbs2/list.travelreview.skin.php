<?
$colspan = 3;
if ($is_checkbox) $colspan++;
?>
    <table cellspacing="0" cellpadding="0" class="board_list">
		<col width="50" />
		<? if ($is_checkbox) { ?><col width="20" /><? } ?>
		<? if($is_category) {?><col width="110" /><? } ?>
		<col />
    <tr>
        <th>번호</th>
        <? if ($is_checkbox) { ?><th><input onclick="if (this.checked) all_checked(true); else all_checked(false);" type="checkbox"></th><?}?>
        <? if($is_category) {?><th>후기유형</th><? } ?>
        <th>제&nbsp;&nbsp;&nbsp;목</th>
    </tr>

    <? for ($i=0; $i<count($list); $i++) { ?>
    <tr> 
        <td class="num">
            <? 
            if ($list[$i][is_notice]) // 공지사항 
                echo "<img src='$board_skin_path/img/icon_notice.gif' align='absmiddle' />";
            else if ($wr_id == $list[$i][wr_id]) // 현재위치
                echo "<span class='current'>{$list[$i][num]}</span>";
            else
                echo $list[$i][num];
            ?>
        </td>
        <? if ($is_checkbox) { ?><td class="checkbox"><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"></td><? } ?>
        <td class="subject"><a href='<?=$list[$i][ca_name_href]?>'><?=$list[$i][ca_name]?></a></td>
        <td class="subject">
            <? 
            echo $nobr_begin;
            echo "<a href='{$list[$i][href]}'>{$list[$i][subject]}</a>";

            echo " " . $list[$i][icon_new];
            echo " " . $list[$i][icon_file];
            echo " " . $list[$i][icon_link];
            echo " " . $list[$i][icon_hot];
            echo " " . $list[$i][icon_secret];
            echo $nobr_end;
            ?>
        </td>
    </tr>
    <? } // end for ?>

    <? if (count($list) == 0) { echo "<tr><td colspan='$colspan' style='line-height:120px; text-align:center;'>게시물이 없습니다.</td></tr>"; } ?>

    </table>
