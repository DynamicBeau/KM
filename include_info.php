<?
#######################################################################
#  파일명 : Include_info.php  작성일 : 2007-12-14  작성자 : 최지훈    #
#######################################################################

/* 함수 부분시작 (수정하지마시길) */
function getLocal($bo_table, $p) {
	global $wr_id, $input, $p;

	if($bo_table=='' && $p){
		$gubun = explode(".",$p);
		$local = $gubun[0];
	} else if($bo_table){
		$local = $bo_table;
	} else {
		$local = basename($_SERVER[PHP_SELF],".php");

	}
	return $local;
}
function classfy($title_image='', $navi1, $navi2, $navi3, $left) {
	global $g4;

	$path = $g4[path];

	//$classfy['title'] = $path."/images/".$title_image; //타이틀
	$classfy['title'] = $navi2; //타이틀
	$classfy['navi'] = "<span style=\"font-size:12px;\"><font face=\"돋움\" color=\"#808080\">HOME > {$navi1} ></span> <span style=\"font-size:12px;\"><font style='font-weight:bold ; 'face=\"돋움\" color=\"#d84000\">{$navi2}</font></span>".$navi; //현 위치
	$classfy['navi3'] = $navi3; //플래시위치

	$classfy['sub_height'] = @explode(",", $left);
	if(strlen($title_image) > 0){
		$classfy['cont_img'] = $path."/images/".$title_image;
	}
	
	return $classfy;
}


/* 함수 부분종료 (수정하지마시길)  */

$local = getLocal($bo_table, $p); // 로컬값을 구함

switch($local){
	################################  수정해주세요^^*  ################################
	case "m11" : $tp = classfy("", "회사소개", "인사말", "left_title_1", '010101', '200,300'); break;
	case "m12" : $tp = classfy("", "회사소개", "left_title_1", '010101', '200,300'); break;
	
	case "m21" : $tp = classfy("", "제품소개", "left_title_2", '010101', '200,300'); break;
	case "m22" : $tp = classfy("", "제품소개", "left_title_2", '010101', '200,300'); break;
	case "m23" : $tp = classfy("", "제품소개", "left_title_2", '010101', '200,300'); break;
	case "m24" : $tp = classfy("", "제품소개", "left_title_2", '010101', '200,300'); break;
	case "m25" : $tp = classfy("", "제품소개", "left_title_2", '010101', '200,300'); break;
	case "m26" : $tp = classfy("", "제품소개", "left_title_2", '010101', '200,300'); break;
	case "list" : $tp = classfy("", "제품소개", "left_title_2", '010101', '200,300'); break;
	case "item" : $tp = classfy("", "제품소개", "left_title_2", '010101', '200,300'); break;
	
	case "m31" : $tp = classfy("sub_text_31.png", "견적문의", "left_title_3", '010101', '200,300'); break;
	
	case "m41" : $tp = classfy("", "임대문의", "left_title_4", '010101', '200,300'); break;
	
	case "m51" : $tp = classfy("", "커뮤니티", "left_title_5", '010101', '200,300'); break;
	case "m52" : $tp = classfy("sub_text_52.png", "커뮤니티", "left_title_5", '010101', '200,300'); break;
	case "m53" : $tp = classfy("sub_text_53.png", "커뮤니티", "left_title_5", '010101', '200,300'); break;

	case "m91" : $tp = classfy("sub_text_91.png", "커뮤니티", "left_title_2", '010101', '200,300'); break;
	
	case "main_photo" : $tp = classfy("m21.gif", "게시판", "메인화면갤러리", '010101', '200,300'); break;


	case "login" : $tp = classfy("", "로그인", "left_title_1", '010101', '200,300'); break;
	case "register" : $tp = classfy("", "회원가입", "left_title_1", '010101', '200,300'); break;
	case "register_form" : $tp = classfy("sub_text_71.png", "회원관리", "회원가입폼", '010101', '200,300'); break;

	case "notice" : $tp = classfy("m81.gif", "게시판", "공지사항", '010101', '200,300'); break;
	case "g_news" : $tp = classfy("m82.gif", "게시판", "게임뉴스", '010101', '200,300'); break;
	case "r_news" : $tp = classfy("m83.gif", "게시판", "자유게시판", '010101', '200,300'); break;
	case "event" : $tp = classfy("m84.gif", "게시판", "이벤트소식", '010101', '200,300'); break;
	case "review" : $tp = classfy("m85.gif", "게시판", "프리뷰/리뷰/분석", '010101', '200,300'); break;

	default : $tp = ""; break;
	################################  수정해주세요^^*  ################################
}
/* 프로그램 종료 */
?>