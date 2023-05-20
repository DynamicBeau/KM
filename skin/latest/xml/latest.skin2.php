<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
include_once("$g4[path]/lib/thumb.lib.php"); 
$img_x = '955'; //큰 썸네일 가로길이 
$img_y = '466'; //큰 썸네일 세로길이
$img_q = '100'; //퀼리티 100이하로 설정


######################환경변수#########################
$xml_dir  = "";  // 신규생성할 디렉토리 변수
$xml_path = "$latest_skin_path/gallery.xml"; // 신규생성할 xml 파일
$laguage_ = "euc-kr";



#######################################################


// file open
//$xml_file = fopen($xml_path, "w+") or die("xml file open erro.");
$xml_file = fopen($xml_path, "w+");

//파일이 존재하지 않는다면 신규생성한다.
if(!$xml_file){
fwrite($xml_file, "");
fclose($xml_file);
@chmod($xml_path, 0707);
}

/**************************** xml data start**************************/
$data[lauage]       = "<?xml version=\"1.0\"  encoding=\"{$laguage_}\" ?>";  

$data[xml_start]    = "<data>";
$data[xml_end]      = "</data>";

//$get_xml  .= $data[lauage];
$get_xml  .= $data[xml_start];

$get_xml  .= "<config>";
$get_xml  .= "<roundCorner>0</roundCorner>";
$get_xml  .= "<autoPlayTime>3</autoPlayTime>";
$get_xml  .= "<isHeightQuality>false</isHeightQuality>";
$get_xml  .= "<blendMode>normal</blendMode>";
$get_xml  .= "<transDuration>1</transDuration>";
$get_xml  .= "<windowOpen>_self</windowOpen>";
$get_xml  .= "<btnSetMargin>auto 13 440 auto</btnSetMargin>";
$get_xml  .= "<btnDistance>22</btnDistance>";
$get_xml  .= "<titleBgColor>0xff6600</titleBgColor>";
$get_xml  .= "<titleTextColor>0xffffff</titleTextColor>";
$get_xml  .= "<titleBgAlpha>.75</titleBgAlpha>";
$get_xml  .= "<titleMoveDuration>1</titleMoveDuration>";
$get_xml  .= "<btnAlpha>1</btnAlpha>";
$get_xml  .= "<btnTextColor>0x000000</btnTextColor>";
$get_xml  .= "<btnDefaultColor>0xcfcfcf</btnDefaultColor>";
$get_xml  .= "<btnHoverColor>0xffffff</btnHoverColor>";
$get_xml  .= "<btnFocusColor>0xffffff</btnFocusColor>";
$get_xml  .= "<changImageMode>click</changImageMode>";
$get_xml  .= "<isShowBtn>true</isShowBtn>";
$get_xml  .= "<isShowTitle>false</isShowTitle>";
$get_xml  .= "<scaleMode>noBorder</scaleMode>";
$get_xml  .= "<transform>".$list[0][wr_1]."</transform>"; //효과설정(alpha, blur, left, right, top, bottom, breathe, breatheBlur) 
$get_xml  .= "<isShowAbout>true</isShowAbout>";
$get_xml  .= "<titleFont>Arial</titleFont>";
$get_xml  .= "</config>";

$get_xml  .= "<channel>";

$count_num    = 7;
for ($i=0; $i<count($list); $i++) {

$get_xml    .= "<item>";
$get_xml    .= "<link>".$list[$i][wr_link1]."</link>";

$file= $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
$file1= $list[0][file][0][path] .'/'. $list[0][file][0][file];
$img= thumbnail($file, $img_x, $img_y, 0, 2, $img_q,  "", $filter); 
$get_xml    .= "<image>$img</image>";

$get_xml    .= "<title>".$list[$i][subject]."</title>";
$get_xml    .= "</item>";

 

}
$get_xml  .= "</channel>";


$get_xml      .= $data[xml_end];

/****************************xml data end**************************/

//변환
$get_xml = iconv("EUC-KR", "UTF-8",$get_xml); 

// write action
if(!fwrite($xml_file, $get_xml)) echo "file wite erro.";

// file close
fclose($xml_file);


?>


<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="<?=$img_x?>" height="<?=$img_y?>" id="flash_gal" align="middle"> 
	<param name="allowScriptAccess" value="always"> 
	<param name="allowFullScreen" value="false"> 
	<param name="wmode" value="transparent"> 
	<param name="src" value="<?=$latest_skin_path?>/gallery.swf?xml=<?=$latest_skin_path?>/gallery.xml" > 
	<param name="movie" value="<?=$latest_skin_path?>/gallery.swf?xml=<?=$latest_skin_path?>/gallery.xml" >
	<param name="quality" value="high" > 
	<param name="bgcolor" value="#ffffff">	
	<embed src="<?=$latest_skin_path?>/gallery.swf?xml=<?=$latest_skin_path?>/gallery.xml" quality="high" width="<?=$img_x?>" height="<?=$img_y?>" name="flash_gal" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" wmode="transparent" loop="false" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed> 
</object>
