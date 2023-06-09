<?
include_once("./_common.php");

// 상품이미지 사이즈(폭, 높이)를 몇배 축소 할것인지를 설정
// 0 으로 설정하면 오류남 : 기본 2
$image_rate = 2;

$g4[title] = "상품 검색";
include_once("./_head.php");
?>

<div class="page_title"><img src="<?=$g4[shop_img_path]?>/top_search.gif" border="0"></div>

<div style="padding:6px;">찾으시는 검색어는 &quot;<b><?=stripslashes(get_text($search_str))?></b>&quot; 입니다.</div>

<?
        // QUERY 문에 공통적으로 들어가는 내용
        // 상품명에 검색어가 포한된것과 상품판매가능인것만
        $sql_common = " from $g4[yc4_item_table] a, 
                             $g4[yc4_category_table] b
                       where a.ca_id=b.ca_id
                         and a.it_use = 1 
                         and b.ca_use = 1
                       /* 중복검색에 대한 오류로 인해 막음 : where (a.ca_id=b.ca_id or a.ca_id2=b.ca_id or a.ca_id3=b.ca_id) */ ";
        if ($search_str) {
            $sql_common .= " and ( a.it_id like '$search_str%' or 
                                   a.it_name like   '%$search_str%' or
                                   a.it_basic like  '%$search_str%' or
                                   a.it_explan like '%$search_str%' ) ";
        }
        /*
        // 공백을 구분하여 검색을 할때는 이 코드를 사용하십시오. or 조건
        if ($search_str) {
            $s_str = explode(" ", $search_str);
            $or = " ";
            $sql_common .= " and ( ";
            for ($i=0; $i<count($s_str); $i++) {
                $sql_common .= " $or (a.it_id like '$s_str[$i]%' or a.it_name like '%$s_str[$i]%' or a.it_basic like  '%$s_str[$i]%' or a.it_explan like '%$s_str[$i]%' ) ";
                $or = " or ";
            }
            $sql_common .= " ) ";
        }
        */

        // 분류선택이 있다면 특정 분류만
        if ($search_ca_id != "")
            $sql_common .= " and a.ca_id like '$search_ca_id%' ";

        // 검색된 내용이 몇행인지를 얻는다
        $sql = " select COUNT(*) as cnt $sql_common ";
        $row = sql_fetch($sql);
        $total_count = $row[cnt];
        echo "<div style='padding:5px;'>입력하신 검색어로 총 <b>{$total_count}건</b>의 상품이 검색 되었습니다.</div>";

        // 임시배열에 저장해 놓고 분류별로 출력한다.
        // write_serarch_save() 함수가 임시배열에 있는 내용을 출력함
        if ($total_count > 0) {
            if (trim($search_str)) {
                // 인기검색어
                $sql = " insert into $g4[popular_table]
                            set pp_word = '$search_str',
                                pp_date = '$g4[time_ymd]',
                                pp_ip = '$_SERVER[REMOTE_ADDR]' ";
                sql_query($sql, FALSE);
            }

            unset($save); // 임시 저장 배열
            $sql = " select a.ca_id, 
                            a.it_id
                     $sql_common
                     order by a.ca_id, a.it_id desc ";
            $result = sql_query($sql);
            for ($i=0; $row=mysql_fetch_array($result); $i++) {
                if ($save[ca_id] != $row[ca_id]) {
                    if ($save[ca_id]) {
                        write_search_save($save);
                        unset($save);
                    }
                    $save[ca_id] = $row[ca_id];
                    $save[cnt] = 0;
                }
                $save[it_id][$save[cnt]] = $row[it_id];
                $save[cnt]++;
            }
            mysql_free_result($result);
            write_search_save($save);
        }
?>

<?
function write_search_save($save) 
{
	global $g4, $search_str , $default , $image_rate , $cart_dir;

    $sql = " select ca_name from $g4[yc4_category_table] where ca_id = '$save[ca_id]' ";
    $row = sql_fetch($sql);

     $ca_temp = "";
     if(strlen($save['ca_id']) > 2) // 중분류 이하일 경우
     {
         $sql2 = " select ca_name from $g4[yc4_category_table] where ca_id='".substr($save[ca_id],0,2)."' ";
        $row2 = sql_fetch($sql2);
        $ca_temp = "<b><a href='./list.php?ca_id=".substr($save[ca_id],0,2)."'>$row2[ca_name]</a></b> &gt; ";
     }
    echo "
    <table width=100% class='table_style1'>
		<colgroup>
			<col width='80px' />
			<col width='' />
			<col width='120px' />
			<col width='100px' />
		</colgroup>
    <tr>
        <th>이미지</th>
        <th>{$ca_temp}<a href='./list.php?ca_id={$save[ca_id]}'>$row[ca_name]</a> ($save[cnt])</th>
        <th>판매가격</th>
        <th>포인트</th>
    </tr>";

    for ($i=0; $i<$save[cnt]; $i++) {
        $sql = " select it_id,
                        it_name, 
                        it_amount,
                        it_amount2,
                        it_amount3,
                        it_tel_inq,
                        it_point,
                        it_type1,
                        it_type2,
                        it_type3,
                        it_type4,
                        it_type5
                   from $g4[yc4_item_table] where it_id = '{$save[it_id][$i]}' ";
        $row = sql_fetch($sql);

        $image = get_it_image("$row[it_id]_s", (int)($default[de_simg_width] / $image_rate), (int)($default[de_simg_height] / $image_rate), $row[it_id]);


        echo "
            <tr>
                <td>$image</td>
                <td>&nbsp;".it_name_icon($row)."</td>
                <!-- <td align=right class=amount>".display_amount($row[it_amount])."&nbsp;</td> -->
                <td align=right class=amount>".display_amount(get_amount($row), $row[it_tel_inq])."&nbsp;</td>
                <td align=right>".display_point($row[it_point])."&nbsp;</td>
            </tr>";
    } 
    echo "</table>\n";
}

include_once("./_tail.php");
?>
