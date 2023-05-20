<?
	// Select 배열 변수로 가져온다.
	// 제작자 : 최지훈 
	// 제작일 : 2009-01-21
	// 각종 Bug 수정 및 function 추가 (조석윤) 수정일 : 2009-06-06

	//주소폼
	function getAddress($name, $key0, $key1, $key2, $key3, $val0, $val1, $val2, $val3) {

		global $g4;

		echo "
		 <input  onclick=\"win_zip('$name', '$key0', '$key1', '$key2', '$key3');\" readonly type=text name='$key0' size=5 class='blue' value='{$val0}'> - <input  onclick=\"win_zip('fconfig', '$key0', '$key1', '$key2', '$key3');\" type=text name='$key1' readonly size=5 class='blue' value='{$val1}'>
		<a href='javascript:;' onclick=\"win_zip('$name', '$key0', '$key1', '$key2', '$key3');\"><img src='{$g4[path]}/skin/member/basic/img/post_search_btn.gif' border=0 align='absmiddle'></a><br>
		 <input type=text name='$key2' size=60 class='blue' value='{$val2}'><br>
		 <input type=text name='$key3' size=60 class='blue' value='{$val3}'>
		";
	
	}

	//전화번호폼
	function getTel($type=1, $name, $value) {

		global $g4;

		switch($type){
			case 1 : $array = array('02', '031', '032', '033', '041', '042', '043', '051', '052', '053', '054', '055', '061', '062', '063', '064', '070'); break;
			case 2 : $array = array('010', '011', '016', '017', '018', '019'); break;
			case 3 : echo "<input type='text' name='{$name}[0]' value='{$value[0]}' size='4' maxlength='4' class='blue'>";
		}

		if($type != 3) echo getInput('select', $name."[0]", $value[0], $array);
		echo " - ";
		echo "<input type='text' name='{$name}[1]' value='{$value[1]}' size='4' maxlength='4' class='blue'>";
		echo " - ";
		echo "<input type='text' name='{$name}[2]' value='{$value[2]}' size='4' maxlength='4' class='blue'>";

	}

	//타입별 인풋
	function getInput($type, $name, $value, $array, $option = 1, $text = '', $script = '', $default = 0) {	
	
		global $g4;

		## --- Default 값을 0값으로 지정한다.

		if($type != "select") $value = (!$value)? $array[$default] : $value;
		
		switch($type){
			case "select" :			
				echo "<select name='{$name}' $script>";

				if($text) echo "<option value=''>{$text}</option>\n";
				
				while(list($key, $val)=each($array)){
					switch($option) {
						case 1 : 
								if($val == $value)
									echo "<option value='{$val}' selected>{$val}</option>\n";
								else 
									echo "<option value='{$val}'>{$val}</option>\n";
								break;
						case 2 :
								if($val == $value)
									echo "<option value='{$val}' selected>{$key}</option>\n";
								else 
									echo "<option value='{$val}'>{$key}</option>\n";
								break;
					}
				}
				
				echo "</select>";

			break;

			case "radio" :
				while(list($key, $val)=each($array)){
					switch($option) {
						case 1 : 
								if($val == $value)
									echo "<input type='radio' name='{$name}' value='{$val}' checked $script>{$val} \n";
								else 
									echo "<input type='radio' name='{$name}' value='{$val}' $script>{$val} \n";
								break;
						case 2 :
								if($val == $value)
									echo "<input type='radio' name='{$name}' value='{$val}' checked $script>{$key} \n";
								else 
									echo "<input type='radio' name='{$name}' value='{$val}' $script>{$key} \n";
								break;
					}
				}
			break;

			case "check" :
				
				$i = 0;
				while(list($key, $val)=each($array)){
					switch($option) {
						case 1 : 
								if(in_array($val, $value))
									echo "<input type='checkbox' name='{$name}[{$i}]' value='{$val}' checked $script>{$val} \n";
								else 
									echo "<input type='checkbox' name='{$name}[{$i}]' value='{$val}' $script>{$val} \n";
								break;
						case 2 :
								if(in_array($val, $value))
									echo "<input type='checkbox' name='{$name}[{$i}]' value='{$val}' checked $script>{$key} \n";
								else 
									echo "<input type='checkbox' name='{$name}[{$i}]' value='{$val}' $script>{$key} \n";
								break;
						## ---- Check Box를 가지런히 정리할때 -------##
						case 3 : 
								if(in_array($val, $value))
									echo "<div style='width:130px;float:left'><input type='checkbox' name='{$name}[{$i}]' value='{$val}' checked $script>{$val}</div>\n";
								else 
									echo "<div style='width:130px;float:left'><input type='checkbox' name='{$name}[{$i}]' value='{$val}'$script>{$val}</div> \n";
								break;
						## ---- Script Bug (Java Script 사용시) 추가-- ##
						case 4 : 
								if(in_array($val, $value))
									echo "<input type='checkbox' name='{$name}' value='{$val}' checked $script>{$val} \n";
								else 
									echo "<input type='checkbox' name='{$name}' value='{$val}' $script>{$val} \n";
								break;
					}					
					$i++;
				}
			break;


			case "range" : 
					echo "<select name='{$name}' $script>";
					if($text) echo "<option value=''>{$text}</option>";

					for($i=$array[0];$i<=$array[1];$i++){
						if($i == $value)
							echo "<option value='{$i}' selected>{$i}</option>";
						else if($option && $option == $i)
							echo "<option value='{$i}' selected>{$i}</option>";
						else 
							echo "<option value='{$i}'>{$i}</option>";
					}
					
					echo "</select>";

			break;
		}

	}

	/* array중 null 값을 제거 한다. */
	function cleanArray($array){

		global $g4;

		$new_array = array();

		while(list($key, $value) = each($array)){
			if(trim($value))
				$new_array[$key] = $value;
		}
		return $new_array;
	}

	## ---- Summnail Image 생성 (Return 하는 값은 Summnail경로이다)-----
	// 예) http://subnara.info/data/bo_table/thumbs/img.gif <- 값을 리턴
	function summImage($bo_table, $img, $img_w ='120', $img_h = '120'){
	
		global $g4;

		$data_path = "$g4[path]/data/file/$bo_table";
		$thumbs_path = $data_path."/thumbs";

		@mkdir($thumbs_path, 0707);
		@chmod($thumbs_path, 0707);

		$thumbs = $thumbs_path."/".$img;
		if (!file_exists($thumbs)){
			$image = $data_path."/".$img;
			$size = getimagesize($image);
			$src = imagecreatefromjpeg($image);
			if (function_exists("imagecopyresampled")) {
				$default[de_simg_width] = $img_w ;
				$default[de_simg_height] = $img_h;
				$dst = imagecreatetruecolor( $default[de_simg_width], $default[de_simg_height]);
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $default[de_simg_width], $default[de_simg_height], $size[0], $size[1]);
			} else {
				$dst = imagecreate($default[de_simg_width], $default[de_simg_height]);
				imagecopyresized($dst, $src, 0, 0, 0, 0, $default[de_simg_width], $default[de_simg_height], $size[0], $size[1]);
			}
			imagejpeg($dst, $thumbs, 100);
		}
	return $thumbs;

	}
	/*
	 * 최고관리자 -> Root로 변경 (write Form) 
	 * 인자값 : DB명 (DB명을 넣는 이유는 global로 DB명을 지정하면 보안상의 위험이 있다)
	 */
	function rootAlter($mysql_db){

		global $g4;

		$result = mysql_list_tables($mysql_db);
		$num_rows = mysql_num_rows($result);
		for ($i = 0; $i < $num_rows; $i++) {
			$table = mysql_tablename($result, $i);
			if(preg_match("/g4_write/", $table)){
				 @mysql_query( "update $table set mb_id = 'root' where mb_id = 'admin';" );
				}
			}
	}
	/*
	 * wr_id 값이 엉키는 경우 자동조정해주는 함수이다.
	 */
	function countAdjust($bo_table){
		
		global $g4;

		$sql = " select count(*) as cnt from $g4[write_prefix]$bo_table where wr_is_comment = 0 ";
		$row = sql_fetch($sql);
		$bo_count_write = $row[cnt];

		$sql = " select count(*) as cnt from $g4[write_prefix]$bo_table where wr_is_comment = 1 ";
		$row = sql_fetch($sql);
		$bo_count_comment = $row[cnt];

        $sql = " select wr_id from $g4[write_prefix]$bo_table where wr_is_comment = 0 ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $sql2 = " select count(*) as cnt from $g4[write_prefix]$bo_table where wr_parent = '$row[wr_id]' and wr_is_comment = 1 ";
            $row2 = sql_fetch($sql2);
            sql_query(" update $g4[write_prefix]$bo_table set wr_comment = '$row2[cnt]' where wr_id = '$row[wr_id]' ");
        }

		$sql = " update $g4[board_table]
					set bo_count_write = '$bo_count_write',
						bo_count_comment = '$bo_count_comment'
				  where bo_table = '$bo_table' ";
		sql_query($sql);

	}

	/*
	 * wr_1 부터 varchar 255 값을 longtext 로 변환한다.(인자값은 bo_table 이다)
	 */

	function longText($bo_table){
		
		global $g4;

		$write_table = "$g4[write_prefix]$bo_table";
		$sql="select * from $write_table"; 
		$result = sql_query($sql);

		$field = mysql_num_fields($result);

		for($i = 0; $i <$field; $i++) {
			$names[] = mysql_field_name( $result, $i );
		}
		//27번부터 wr_1 값이 존재한다.
		for($i=27; $i<count($names); $i++){
			$arraydata[] = $names[$i];
		}

		for($i=0; $i<count($arraydata); $i++){
			$sql = "alter table $write_table change {$arraydata[$i]} {$arraydata[$i]} longtext ";
			sql_query($sql);
		}
	}

	/*
	 * 원하는 write테이블 늘리기 인자값은 (bo_table, 시작값, 끝값)
	 */
	function table_one_add($bo_table,$start,$end){
		global $g4;
		for ($i=$start; $i<=$end; $i++) { 
			$sql ="alter table $g4[write_prefix]$bo_table add wr_{$i} varchar(255) not null;"; 
			@mysql_query($sql); 
		}

	}


	/*
	 *  write테이블 전체 늘리기 인자값은 (DB명, 시작값, 끝값)
	 */
	function table_add($mysql_db,$start,$end){
		$result = mysql_list_tables($mysql_db);
		$num_rows = mysql_num_rows($result);
		for ($i = 0; $i < $num_rows; $i++) {
			$table = mysql_tablename($result, $i);
			if(preg_match("/g4_write/", $table)){
					for($start=11;$start<=$end;$start++){
						@mysql_query( "alter table $table add `wr_{$start}` varchar( 255 ) not null ;" );
					}
			}
		}
	}
	/*
	 *  UTF-8 => CP949 or CP949 => UTF-8 변환함수
	 */
	function conv_uft($str){
		$str = iconv("CP949", "UTF-8", $str);
		return $str;
	}

	function conv_han($str){
		$str = iconv("UTF-8", "CP949", $str);
		return $str;
	}

	/*
	 * bo_table 에서 wr_id값이 어느 page에 속하지는 구해주는 함수이다.
	 * return 값은 page 번호이다.
	 * 예) wr_id = 85의 값은 page = 2에 속한다.
	 */
	function getPage($bo_table, $wr_id){

		global $g4;

		$sql = "select bo_sort_field, bo_page_rows from $g4[board_table] where bo_table = '$bo_table'";
		$row = sql_fetch($sql);
		$page_rows = $row[bo_page_rows]; 
		$sort_field = (!$row[bo_sort_field])? "wr_num asc" : $row[bo_sort_field];
		
		$sql = "select wr_id from $g4[write_prefix]$bo_table order by {$sort_field}";
		$result = sql_query($sql);

		$numArray = array();
		while($row = sql_fetch_array($result)){
			array_push($numArray, $row[wr_id]);
		}
		$num = array_search($wr_id, $numArray) + 1;
		$page = ceil($num/$page_rows);

		return $page;

	}
?>