<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width=100% cellpadding=0 cellspacing=0>
<tr>
 

    <td><a href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>'><img src='<?=$latest_skin_path?>/img/title_notice.png' border=0></a></td>

</tr>
</table>

<table width=100% cellpadding=0 cellspacing=0>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr>
    <td  >
     <img src='<?=$latest_skin_path?>/img/latest_icon.gif' align=absmiddle>
            <?
            echo $list[$i]['icon_reply'] . " ";
            echo "<a href='{$list[$i]['href']}'>";
            if ($list[$i]['is_notice'])
                echo "<font style='font-family:돋움; font-size:8pt; color:#a7b9cb;'><strong>{$list[$i]['subject']}</strong></font>";
            else
                echo "<font style='font-family:돋움; font-size:8pt; color:#a7b9cb;'>{$list[$i]['subject']}</font>";
            echo "</a>";

           //if ($list[$i]['comment_cnt']) 
               // echo " <a href=\"{$list[$i]['comment_href']}\"><span style='font-family:돋움; font-size:8pt; color:#9A9A9A;'>{$list[$i]['comment_cnt']}</span></a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

           // echo " " . $list[$i]['icon_new'];
           // echo " " . $list[$i]['icon_file'];
           // echo " " . $list[$i]['icon_link'];
           // echo " " . $list[$i]['icon_hot'];
           // echo " " . $list[$i]['icon_secret'];
            ?></td><td><span style='font-size:7pt; font-family:Tahoma; color:#94b1bc;'><?=$list[$i][datetime]?></span></td>
</tr>
<? } ?>

<? if (count($list) == 0) { ?><tr><td colspan=4 align=center height=50><font color=#6A6A6A>게시물이 없습니다.</a></td></tr><? } ?>

</table>
