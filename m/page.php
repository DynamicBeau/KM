<?
include_once("./_common.php");
include_once("./head.sub.php");
//@include_once("./sub_head.php");
include_once("$g4[path]/lib/latest.lib.php");

if($p)
	$p = stripcslashes((strip_tags(trim($p))));
?>
<!-- 사이트 컨텐츠 -->
	<? 
		$p = $_GET['p'];
		if($p){
			if(file_exists("{$g4[path]}/ver01/{$p}.php")){
				include_once("{$g4[path]}/ver01/{$p}.php");
			}else{
			?>
			<div style="width:100%;">
				<?
				if(strlen($bo_table) == 0){
					$bo_table = "etc";
				}

				$local = getLocal($p, $p); // 로컬값을 구함

				$sql = " select * from $g4[write_prefix]$bo_table where wr_subject = '$local' ";
				$board = sql_fetch(" select * from g4_board where bo_table = '$bo_table' ");
				$board_skin_path = "{$g4['path']}/skin/board/{$board['bo_skin']}";
				//echo $sql;
				$row2 = sql_fetch($sql);
				$view = get_view($row2, $board, $board_skin_path, 255);
				?>
				<?if($is_admin && strlen($view[wr_id]) > 0){?>
				
				<img src='<?=$g4[path]?>/skin/board/basic/img/btn_modify.gif' style="cursor:pointer;" onclick="location.href='<?=$g4[admin_path]?>/write.php?bo_table=<?=$bo_table?>&w=u&wr_id=<?=$view[wr_id]?>';"/>
				<br><br>
				<?}?>
				<?
				$html = 1;
				$view[content] = conv_content($view[wr_content], $html);
				if (strstr($sfl, "content"))
						$view[content] = search_font($stx, $view[content]);
				$view[content] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' onclick='image_window(this)' style='cursor:pointer;' \\2 \\3", $view[content]);
				?>
				
				<?
				echo $view[content];
				?>
				<script type="text/javascript" src="<?=$g4[path]?>/js/board.js"></script>
				<script type="text/javascript">
				window.onload=function() {
						resizeBoardImage(700);
						drawFont();
				}
				</script>
			</div>
			<?
			}
		}else{
			alert("잘못된접근입니다.");
		}
	?>
<!-- 사이트 컨텐츠 -->
<?
//@include_once("$g4[path]/sub_tail.php");
include_once("./tail.sub.php");
?>
